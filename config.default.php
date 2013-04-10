<?php

/**
 * This is the config where you can define
 * things specific to your bot, so we don't
 * have to assume anything.
 * @package nasonfish.CBWeb
 */
/**
 * First we're going to do some internal
 * stuff. Just ignore this.
 */
$config = array();
$config['bot'] = array();
$config['theme'] = array();
$config['page'] = array();

/**
 * Ignore this unless you want annoying
 * messages saying which files are
 * being used. This is for developer use
 */
$config['debug'] = false;

/**
 * This is the bot's name. This won't make
 * much of a difference, depending on some
 * certain things. You can just leave this
 * as-is if you wish.
 */
$config['bot']['nick'] = "CloudBot";

/**
 * Make an array of all the networks that
 * the bot is on that you want to use in
 * the interface.
 * 
 * These should match the names of the
 * .db files in the /persist/ directory. 
 */
$config['bot']['networks'] = array("EsperNet");

/**
 * Page title to be used.
 */
$config['page']['title'] = "CloudBot Web Interface";

/**
 * This will appear at the top of every page.
 * You can use HTML in this.
 */
$config['page']['header'] = "Welcome to the unofficial CloudBot web interface!";

/**
 * This will appear below the header at the 
 * top of every page. You can use HTML
 * in this.
 */
$config['page']['description'] = "This web interface will allow you to view CloudBot factoids, and soon, much more!";

/**
 * Theme it. It is gradient, so it will go
 * from top with background1, to middle with
 * background2, to bottem with background3, and
 * repeat. I suggest you make
 * background1 and background3 the same.
 */
$config['theme']['background1'] = "#33CC33";
$config['theme']['background2'] = "#D6F5D6";
$config['theme']['background3'] = "#33CC33";
?>
