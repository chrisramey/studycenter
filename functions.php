<?php
// Get a DB connection
function connect() {
	return new mysqli('localhost',DB_USERNAME,DB_PASSWORD,DB_NAME);
}

// Gets the results of a SELECT query as a standard array
function get_results($result_set) {
	$results = array();
	while($row = $result_set->fetch_assoc()) {
		$results[] = $row;
	}
	
	return $results;
}
/**
 * Checks to see if user has access to file requested
 */
function has_permission($file) {
	$action = isset($_GET['action']) ? $_GET['action'] : null;
	
	// Get requested directory from file path
	$parts = explode('/',$file);
	$dir_name = $parts[0];
	
	// If logged in
	if(is_logged_in()) { // allow actions & access to public & admin directories
		return  $action != null || $dir_name == 'public' || $dir_name == 'admin' || $dir_name = 'checkin';
	} else if($action == 'authenticate' || $dir_name == 'public') { // allow public users access to public directory
		return true;
	} else { // NINJA USER! *karate chop to the head*
		return false;
	}
}

/**
 * Determines whether or not the user is logged in
 * @return True if logged in, false if not
 */
function is_logged_in() {
	return isset($_SESSION['user']);
}

/**
 * Loads the file, if it exists. If the file doesn't exist, 
 * a location header for the 404 page is sent back to the browser
 * @param String $file File to load
 */
function load_file($file) {
	if(file_exists($file)) {
		require_once($file);
	} else {
		header('Location:./?p=public/404');
	}
}

/**
 * Helper function to send location headers, with an optional message
 * @param String $location Absolute or relative URL of destination
 * @param String $message Optional message to display upon redirection
 */
function redirect($location,$message=null,$type='') {
	if($message != null) {
		$_SESSION['flash'] = array('message' => $message, 'type' => $type);
	}
	header("Location:$location");
}

function resolve_ajax_url($location) {
	if(isset($_GET['ajax'])) {
		$append = !strpos($location,'?') ? '?' : '&';
		$location .= "{$append}ajax=true";	
	}
	return $location;
}

function add_script($script) {
	$_SESSION['scripts'][] = $script;
}