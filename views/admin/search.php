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
	<div>
		<h3 class="student-name"><?php echo "$student_firstname $student_lastname" ?></h3>
		<!--<a class="btn btn-mini btn-danger" data-action="remove" data-target=".student" href="#">
			<i class="icon-remove icon-white"></i>
		</a>-->
		<form class="form-inline" action="./?action=checkin" method="post">
			<input type="hidden" name="redirect" value="<?php echo $redirect ?>" />
			<input type="hidden" name="id" value="<?php echo $student_id ?>" />
			<input type="hidden" name="course_id" value="" />
			<div class="input-append">
				<input class="span10" type="text" name="course_name" placeholder="course" autocomplete="off"/>
				<button class="btn" type="submit"><i class="icon-check"></i></button>
			</div>
			<a href="#" data-action="remove" data-target=".student">cancel</a>
		</form>
	</div>
<?php } else {
	echo '<div class="alert">No student with that ID was found. You can add this student below</div>';
	include('views/admin/addstudent.php');
}
?>
</div>