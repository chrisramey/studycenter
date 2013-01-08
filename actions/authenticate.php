<?php
extract($_POST);
$type = 'info';
if(isset($_GET['logout'])) {
	// Remove user from session data
	unset($_SESSION['user']);
	$message = null;
	$context = null;
	$location = './?p=login';
} elseif($user_username != '' && $user_password != '') {	// If a username AND password were entered
	// Connect to DB
	$conn = new mysqli('localhost',DB_USERS_USERNAME,DB_USERS_PASSWORD,DB_USERS_NAME);
	
	// Query DB
	$user_username = addslashes($user_username);
	$user_password = md5(addslashes($user_password));
	$sql = "SELECT * FROM users WHERE user_username='$user_username' AND user_password='$user_password'";
	$results = $conn->query($sql);
	$users = get_results($results);
	$user = count($users == 1) ? $users[0] : null;
	
	// Close connection
	$conn->close();
	
	if($user != null) {		// User found
		$_SESSION['user'] = $user;
		$message = null;//"Welcome back, {$user['user_firstname']}!";
		$location = './';
	} else {					// User not found
		$message = 'You have entered an invalid username and password combination. Please try again.';
		$type = 'danger';
		$location = './?p=public/login';
	}
} else {		// Either username or password is missing
	$message = 'Please enter a username and password.';
	$type = 'danger';
	$location = './?p=public/login';
}
redirect($location,$message,$type);