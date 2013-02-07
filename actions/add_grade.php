<?php
$student_id = addslashes($_POST['student_id']);
$session_id = addslashes($_POST['session_id']);
$student_name = addslashes($_POST['student_name']);
$course_id = addslashes($_POST['course_id']);
$grade_percent = addslashes($_POST['grade_percent']);

if($session_id == '' || $grade_percent == '') {
	$_SESSION['POST'] = $_POST;
	redirect('./','Please provide all information.','danger');
	die();
}

// Connect to DB
$conn = connect();

// Query for adding student
$sql = "UPDATE sessions SET grade=$grade_percent, grade_timestamp=NOW() WHERE session_id=$session_id";
$conn->query($sql);

// If the insertion fails...
if($conn->errno > 0) {
	$message = "An error occurred and the $student_name's grade was not saved. Please try again.";
	$message .= "<br/>SQL: <code>$sql</code>";
	$message .= "<br/>Error: <code>{$conn->error}</code>";
	redirect('./',$message,'danger');
	die();
} else {
	redirect('./',"$student_name's grade has been saved.",'info');
}