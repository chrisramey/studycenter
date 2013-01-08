<div class="page-header">
	<?php if(is_logged_in()): ?>
		<div id="user">
			<span>Logged in as</span> <?php echo "{$_SESSION['user']['user_firstname']} {$_SESSION['user']['user_lastname']}" ?>
			<a href="./?action=authenticate&amp;logout=true">logout</a>
		</div>
	<?php endif ?>
	<h1>Wildcat Tracks <small>staying on the road to success</small></h1>
</div>