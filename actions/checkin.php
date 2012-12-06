<?php
session_start();

// Connect to DB
$conn = connect();

// Student ID
$id = addslashes($_GET['id']);

// Query for student id
$sql = "INSERT INTO sessions (student_id) VALUES($id)";
$conn->query($sql);

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
redirect('./',$message,$type);