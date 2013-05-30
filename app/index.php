<?php
/**
 * Our index file. Anytime someone tries to
 * access a page on this interface (NOT a picture or something)
 * this index file is where they end up (See: .htaccess file).
 * From here, we take the URI of the request and figure out
 * where we're going.
 */
function getConfig(){
    include '../config.php';
    return $config;
}
getConfig();
$URI = explode('?', $_SERVER["REQUEST_URI"]);
define("URI", $URI[0]);
define("DEBUG", $config['debug']);
define("BASE_DIRECTORY", dirname(__FILE__));
define("DS", DIRECTORY_SEPARATOR);
define("PERSIST_DIR", dirname(__FILE__) . DS . '..' . DS . '..' . DS);
$URI_ARGS = explode("/", URI);
if(count($URI_ARGS) == 2 && $URI_ARGS[1] !== ""){
    include 'Index_App.php';
    $module = new Index_App();
    if(method_exists($module, $URI_ARGS[1])){
        $module->{$URI_ARGS[1]};
    } else {
        $module->error_404();
    }
} else if(count($URI_ARGS) == 1 || (($URI_ARGS[0]) === "" && $URI_ARGS[1] === "")){
    include 'Index_App.php';
    $module = new Index_App();
    $module->index();
    exit;
} else if(count($URI_ARGS) == 3){
    foreach($config['bot']['networks'] as $network){
        if(strcasecmp($URI_ARGS[1], $network) == 0){
            define('NETWORK', $network);
            include 'Network_App.php';
            $module = new Network_App();
            if(method_exists($module, $URI_ARGS[2])){
                $module->{$URI_ARGS[2]};
            } else {
                $module->error_404();
            }
            exit;
        }
    }
    include 'Index_App.php';
    $module = new Index_App();
    $module->error_404();
} else if(count($URI_ARGS) == 4 && strcasecmp($URI_ARGS[3], 'api') == 0){
}
/*
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
			include 'index.php';
			if(DEBUG) print("including index.php");
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
	}*/
?>