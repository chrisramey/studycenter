<p>Copyright &copy; <?php echo date('Y') ?> Chris Ramey</p>
<!-- JSON DATA -->
<script>
<?php
// Write JSON for list of teachers
$conn = new mysqli('localhost',DB_USERS_USERNAME,DB_USERS_PASSWORD,DB_USERS_NAME);
// Get all users not part of Admin (2), Counseling (9), Custodial (14), General (17), Unassigned (0)
$sql = 'SELECT user_firstname,user_lastname,user_id FROM users WHERE user_department NOT IN(0,2,9,14,17) ORDER BY user_lastname, user_firstname';
$results = $conn->query($sql);
$users = get_results($results);
$teacher_ids = array();
$teacher_names = array();
foreach($users as $u) {
	$teacher_ids[] = $u['user_id'];
	$teacher_names[] = "{$u['user_firstname']} {$u['user_lastname']}";
}
$conn->close();
echo 'var teacher_ids = '.json_encode($teacher_ids).';';
echo 'var teacher_names = '.json_encode($teacher_names).';';

// Write JSON for list of courses
$conn = new mysqli('localhost',DB_COURSES_USERNAME,DB_COURSES_PASSWORD,DB_COURSES_NAME);
$sql = 'SELECT course_id, course_name FROM courses ORDER BY course_name';
$results = $conn->query($sql);
$courses = get_results($results);
$course_ids = array();
$course_names = array();
foreach($courses as $c) {
	$course_ids[] = $c['course_id'];
	$course_names[] = $c['course_name'];
}
$conn->close();
echo 'var course_ids = '.json_encode($course_ids).';';
echo 'var course_names = '.json_encode($course_names).';';
?>
</script>