<form action="./?action=add_student" method="post" class="form-inline">
	<input type="hidden" name="student_number" value="<?php echo $student_number ?>"/>
	<div class="control-group">
		<label class="control-label" for="student_firstname">New Student <small><?php echo $student_number ?></small></label>
		<div class="controls">
			<input class="span2" type="text" name="student_firstname" placeholder="first" />
			<input class="span2" type="text" name="student_lastname" placeholder="last" />
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-success">Add</button>
		<button type="button" class="btn" data-action="remove" data-target=".student">Cancel</button>
	</div>
</form>