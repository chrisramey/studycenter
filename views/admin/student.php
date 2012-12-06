<div class="student">
<?php
extract($_POST);

if(!isset($student_number) || $student_number == '') {
	echo '<div class="alert">No student id was given.</div>';
	return;
}

// Connect to DB
$conn = connect();

// Query for student id
$sql = "SELECT * FROM students WHERE student_number=$student_number";
$results = $conn->query($sql);
$students = get_results($results);
$conn->close();

if(count($students) == 1){ 
	extract($students[0]);?>
	<h4><?php echo "$student_firstname $student_lastname" ?> <a class="btn btn-mini btn-danger" data-action="remove" data-target=".student" href="#"><i class="icon-remove icon-white"></i></a> <a class="btn btn-mini btn-success" href="./?action=checkin&id=<?php echo $student_id ?>">check in</a></h4>
<?php } else {
	echo '<div class="alert">No student with that ID was found. You can add this student below</div>';
	include('views/admin/addstudent.php');
}
?>
</div>