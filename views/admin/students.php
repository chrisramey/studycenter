<?php 
// Connect to DB
$conn = connect();

// Query DB
$sql = "SELECT students.*, sessions.* FROM students INNER JOIN sessions ON students.student_id=sessions.student_id
		WHERE CURDATE()=DATE(session_timein) AND session_timeout IS NULL";
$results = $conn->query($sql);
$students = get_results($results);

// Close DB connection
$conn->close();


?>

<h3>Currently checked in</h3>
<?php if(count($students) == 0): ?>
	<p class="alert">There are no checked in students.</p>
<?php else: ?>
	<ul>
	<?php foreach($students as $s):?>
		<li><?php echo "{$s['student_firstname']} {$s['student_lastname']}" ?></li>
	<?php endforeach ?>
	</ul>
<?php endif ?>