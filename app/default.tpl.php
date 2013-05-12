<!DOCTYPE html>
<html>
		<?php
			error_reporting(E_ALL);
			ini_set("error_reporting", 1); 
			include '../libs/gradient.php';
		?>
		<title><?=$config['page']['title']?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="CloudBot Web Interface">
		<meta name="author" content="nasonfish">
		<style type="text/css">
			body<?=Background::getBackground($config['theme']['background1'], 
					$config['theme']['background2'], 
					$config['theme']['background3'], 
					Direction::Bottom_Right); ?>
		</style>
		<link href="/css/bootstrap.css" rel="stylesheet">
		<link href="/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="/css/cloudbot.css" rel="stylesheet">
		<div class=" row-fluid">
			<div class="alert alert-info header-box span10 offset1">
				<h2><?=$config['page']['header']?></h2>
				<p><?=$config['page']['description']?></p>
                <?php if((isset($URI_ARGS[1]) && !empty($URI_ARGS[1]))): ?>
                    <span id='back' style='text-align: left'><a href='<?=empty($_GET) ? '../' : './'?>'><i class="icon-arrow-left"></i> Go Back.</a></span>
                <?php endif; ?>
  			</div>
		</div>
		<script src="/js/bootstrap.min.js"></script>