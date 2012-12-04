<?php
// Get the page from the QS
$page = isset($_GET['p']) ? $_GET['p'] : 'admin/dashboard';

include("views/$page.php");