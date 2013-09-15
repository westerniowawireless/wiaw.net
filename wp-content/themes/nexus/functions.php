<?php  // https://github.com/retlehs/roots/wiki
//REVISION: 0ab8e17a5746

if (!function_exists('_log')) {
    function _log($message)
    {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        }
        else {
            error_log($message);
        }
    }
}

load_theme_textdomain('prime', get_template_directory() . '/lang');

if (!isset($content_width))
    $content_width = 584;

//Set some global vars for PRIME's usage
define('PRIME_THEME_ROOT_URI', trailingslashit(get_template_directory_uri()));
define('PRIME_THEME_NAME', 'nexus');
define('PRIME_THEME_DISPLAY_NAME', 'Nexus');
define('PRIME_THEME_VERSION', '0.0.0.1');
define('THEME_DIR', get_template_directory());
define('PRIME_DEVELOPMENT_MODE', true);
define('PRIME_OPTIONS_KEY', 'prime_options');
define('PRIME_PREVIEW', false);

if (!defined('__DIR__')) define('__DIR__', dirname(__FILE__));

//Import frontend-strings that have been centrally defined
require_once get_template_directory() . '/frontend-strings.php';
//import OptionTree
require_once get_template_directory() . '/prime-option/index.php';
//Import Roots
require_once get_template_directory() . '/inc/index.php';
//import Prime
require_once get_template_directory() . '/prime/index.php';

remove_filter('the_content', 'wpautop');

?>
