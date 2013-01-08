<form action="./?action=add_student" method="post" class="form-inline">
	<input type="hidden" name="student_number" value="<?php echo $student_number ?>"/>
	<input type="hidden" name="redirect" value="<?php echo isset($checkin_only) ? 'checkin/home' : 'admin/dashboard' ?>" />
	<div class="control-group">
		<label class="control-label" for="student_firstname">New Student <small><?php echo $student_number ?></small></label>
		<div class="controls">
			<input class="span5" type="text" name="student_firstname" placeholder="first" />
			<input class="span5" type="text" name="student_lastname" placeholder="last" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="course_name">Course</label>
		<div class="controls">
			<input type="hidden" name="course_id" value="" />
			<input class="span10" type="text" name="course_name" placeholder="course" autocomplete="off"/>
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-success">Add</button>
		<button type="button" class="btn" data-action="remove" data-target=".student">Cancel</button>
	</div>
</form>