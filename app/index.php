<?php
	include '../config.php';
	$URI = explode('?', $_SERVER["REQUEST_URI"]);
	define("URI", $URI[0]);
	define("DEBUG", $config['debug']);
	define("BASE_DIRECTORY", dirname(__FILE__));
	define("DS", DIRECTORY_SEPARATOR);
	define("PERSIST_DIR", dirname(__FILE__) . DS . '..' . DS . '..' . DS);
	$URI_ARGS = explode("/", URI);
	if($URI_ARGS[1] != "api"){ // We don't want this stuff in the api.
		include 'default.tpl.php';
		if(isset($URI_ARGS[1]) && !empty($URI_ARGS[1])){
			foreach($config['bot']['networks'] as $network){
				if(strcasecmp($URI_ARGS[1], $network) == 0){
					define(NETWORK, $network);
					if(isset($URI_ARGS[2]) && !empty($URI_ARGS[2])){
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
			} else {
				include "404.php";
				if(DEBUG) print("including 404.php");
				exit();
			}
		} else {
			include 'welcome.php';
			if(DEBUG) print("including welcome.php");
			exit();
		}
	} else { // We're using the api! :D
		foreach($config['bot']['networks'] as $network){
			if(strcasecmp($URI_ARGS[2], $network) == 0){
				define("NETWORK", $network);
				if(isset($URI_ARGS[3])){
					if(file_exists('network/'.$URI_ARGS[3].'.api.php')){
						include 'network/'.$URI_ARGS[3] . '.api.php';
						exit();
					} else {
						include '404.api.php';
						exit();
					}
				}
			}
		}
		include '404.api.php';
		exit();
	}
?>