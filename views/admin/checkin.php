<h3>Check In</h3>
<form id="form-validate-id" action="./?p=admin/search" method="post">
	<input type="hidden" name="redirect" value="<?php echo isset($checkin_only) ? 'checkin/home' : 'admin/dashboard' ?>" />
	<div class="input-append">
		<input id="student_number" class="span4" name="student_number" type="text" pattern="[0-9]*" placeholder="STUDENT ID" autocomplete="off"/>
		<button class="btn" type="submit"><i class="icon-search"></i></button>
	</div>
</form>