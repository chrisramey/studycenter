<div class="page-header">
	<div id="user">&nbsp;
	<?php if(is_logged_in()): ?>
		<span>Logged in as</span> <?php echo "{$_SESSION['user']['user_firstname']} {$_SESSION['user']['user_lastname']}" ?>
		<a href="./?action=authenticate&amp;logout=true">logout</a>
	<?php endif ?>
	</div>
	
	<h1>Wildcat Tracks <small>staying on the road to success</small><a class="btn" href="./?p=admin/analytics" data-placement="left" data-toggle="tooltip" data-original-title="View analytics"><img src="assets/img/wildcat-small.png" alt="" /></a></h1>
</div>