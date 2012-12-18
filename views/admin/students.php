<?php 
// Connect to DB
$conn = connect();

// Query DB
$sql = "SELECT students.*, sessions.* FROM students
			INNER JOIN sessions ON students.student_id=sessions.student_id
		WHERE CURDATE()=DATE(session_timein) AND session_timeout IS NULL
		ORDER BY student_firstname";
$results = $conn->query($sql);
$students = get_results($results);

// Close DB connection
$conn->close();
?>
<h3>Currently checked in</h3>
<?php if(count($students) == 0): ?>
	<p class="alert">There are no checked in students.</p>
<?php else: ?>
	<ul class="students nav nav-tabs nav-stacked">
	<?php foreach($students as $s):?>
		<?php 
		$name = "{$s['student_firstname']} {$s['student_lastname']}";
		?>
		<li data-session-id="<?php echo $s['session_id'] ?>" data-course-id="<?php echo $s['course_id'] ?>" data-student-id="<?php echo $s['student_id'] ?>" data-student-name="<?php echo $name ?>" data-teacher-id="<?php echo $s['teacher_id'] ?>"><a href="#"><?php echo $name ?><button class="grade pull-right btn btn-mini btn-info">enter grade</button><button class="checkout pull-right btn btn-mini btn-inverse">checkout</button></a></li>
	<?php endforeach ?>
	</ul>
<?php endif ?>