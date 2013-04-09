<?php
	include '../config.php';
	include 'default.tpl.php';
	define("URI", $_SERVER["REQUEST_URI"]);
	define("DEBUG", $config['debug']);
	$URI_ARGS = explode("/", URI);
	if(isset($URI_ARGS[1])){
		foreach($config['bot']['networks'] as $network){
			if($URI_ARGS[1] == $network){
				define(NETWORK, $network);
				if(isset($URI_ARGS[2])){
					if(file_exists('network/'.$URI_ARGS[2].'.php')){
						include 'network/'.$URI_ARGS[2] . '.php';
						if(DEBUG) print ("including network/" . $URI_ARGS[2] . '.php');
						exit();
					} else {
						include '404.php';
						if(DEBUG) print ("including 404.php");
						exit();
					}
				} else {
					include 'network/index.php';
					if(DEBUG) print ("including network/" . "index" . '.php');
					exit();
				}
			}
		}
		if(isset($URI_ARGS[1]) && file_exists($URI_ARGS[1] . ".php")){
			include $URI_ARGS[1] . '.php';
			if(DEBUG) print("including $URI_ARGS[1]" . '.php');
			exit();
		}
	} else {
		include 'welcome.php';
		if(DEBUG) print("including welcome.php");
		exit();
	}
?>