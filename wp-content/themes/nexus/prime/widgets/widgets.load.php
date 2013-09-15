<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 12/1/11
 * Time: 1:18 PM
 * To change this template use File | Settings | File Templates.
 */
 
$shortcodes_dir = THEME_DIR . '/prime/widgets/%s';

//import to widgets
require_once sprintf($shortcodes_dir, 'embed.php');
require_once sprintf($shortcodes_dir, 'popular-posts.php');
//require_once sprintf($shortcodes_dir, 'recent-projects.php');
require_once sprintf($shortcodes_dir, 'twitter-feed.php');