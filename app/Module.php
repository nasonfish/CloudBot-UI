<?php
/**
 * A base file that all *_App
 * files extend, contains functions
 * for displaying templates, as well
 * as a 404 method.
 *
 * Inspired by the awesome aspen-framework by botskonet.
 * @package nasonfish.CloudBot-UI
 */

/**
 * Class Module The class containing
 * methods, we extend this.
 */
class Module{

    public function error_404($api = false){
        include 'index' . DS . ($api ? '404.api.php' : '404.php');
        exit;
    }

    public function template_display($data = array()){
        include 'Utils.php';
        $utils = new Utils;
        $caller = $utils->getCaller();
        foreach($data as $key => $value){
            $$key = $value;
        }
        include 'index' . DS . 'default.tpl.php';
        include substr(strtolower($caller['class']), 0, strlen($caller['class']) - 4) . DS . strtolower($caller['function']) . '.php';
        include 'index' . DS . 'default_end.tpl.php';
    }
}