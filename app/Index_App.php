<?php
/**
 * App file for all Index (not network) pages.
 * Inspired by botskonet's Aspen-Framework
 * http://github.com/botskonet/Aspen-Framework/
 * @package nasonfish.CloudBot-UI
 */

include 'Module.php';

/**
 * Class Index_App A class containing
 * all of the page's backend statements
 * that are passed to the template file.
 *
 */
class Index_App extends Module{
    /**
     * Welcome page
     * @param bool $api Are we using the api?
     */
    function index($api = false){
        if($api){
            include 'index' . DS . '404.api.php'; // They shouldn't be on this page.
            exit;
        }
        $this->template_display();
    }
}