<?php if(isset($_SESSION['flash'])) {?>
	<div class="alert alert-<?php echo $_SESSION['flash']['type'] ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<p><?php echo $_SESSION['flash']['message'] ?></p>
	</div>
<?php 
	unset($_SESSION['flash']);
}
?>