<!DOCTYPE html>
<html>
	<head>
		<?php
			error_reporting(E_ALL);
			ini_set("error_reporting", 1); 
			include '../libs/gradient.php';
		?>
		<title><?=$config['pagetitle']?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="CloudBot Web Interface">
		<meta name="author" content="nasonfish">
		<style type="text/css">
			body<?=Background::getBackground($config['theme']['background1'], 
					$config['theme']['background2'], 
					$config['theme']['background3'], 
					Direction::Bottom_Right); ?>
			p{}
		</style>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/bootstrap-responsive.css" rel="stylesheet">
		<link href="../css/cloudbot.css" rel="stylesheet">
		<div class="alert alert-info header-box container-narrow navbar-static-top">
			<h2>Refract Web Interface</h2>
			<p>This is the bot Refract's web interface with interacting with the bot outside of IRC.</p>
			<p>Currently we only have a list of Factoids, but come back soon for more stuff!</p>
		</div>
</html>