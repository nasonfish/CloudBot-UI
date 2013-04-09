<?php
	$result = array();
	$result['success'] = false;
	$result['error'] = "Error 404: Page not found. URI: " . $_SERVER["REQUEST_URI"] . ". Perhaps the Network does not exist or the config is done improperly?";
	print(json_encode($result));
?>