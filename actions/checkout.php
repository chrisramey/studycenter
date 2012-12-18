<?php

// Connect to DB
$conn = connect();

// Student ID
$student_id = addslashes($_POST['student_id']);
$session_id = addslashes($_POST['session_id']);
$teacher_id = addslashes($_POST['teacher_id']);
$session_notes = addslashes($_POST['session_notes']);

// Validate that all info was provided
if($student_id == '' || $session_id == '' || $teacher_id == '' || $session_notes == '') {
	$message = 'Please provide all info when checking out.';
	redirect('./',$message,'danger');
	die();
}

// Insert student
$sql = "UPDATE sessions SET session_timeout=NOW(), session_notes='$session_notes', teacher_id=$teacher_id WHERE session_id=$session_id AND session_timeout IS NULL";
$conn->query($sql);

// If an error occurred
if($conn->error != '') {
	$message = 'An error occurred and the student was not checked out. Please try again.';
	$message .= "<br/>SQL: <code>$sql</code>";
	$message .= "<br/>Error: <code>{$conn->error}</code>";
	$type = 'danger';
} else {
	$message = null;
	$type = '';
}

// Close DB connection
$conn->close();

// Redirect
redirect('./',$message,$type);