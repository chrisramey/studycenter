<?php
$student_firstname = addslashes($_POST['student_firstname']);
$student_lastname = addslashes($_POST['student_lastname']);
$student_number = addslashes($_POST['student_number']);

if($student_firstname == '' || $student_lastname == '') {
	$_SESSION['POST'] = $_POST;
	redirect('./','Please provide all information.','danger');
	die();
}

// Connect to DB
$conn = connect();

// Query for adding student
$sql = "INSERT INTO students (student_number,student_firstname,student_lastname) VALUES($student_number,'$student_firstname','$student_lastname')";
$conn->query($sql);

// Checkin the student
$_POST['id'] = $conn->insert_id;
require('checkin.php');
/*
// If an error occurred
if($conn->error != '') {
	$message = 'An error occurred and the student was not checked in. Please try again.';
	$type = 'danger';
} else {
	$message = null;
	$type = '';
}

// Close DB connection
$conn->close();

// Redirect
redirect('./',$message,$type);*/