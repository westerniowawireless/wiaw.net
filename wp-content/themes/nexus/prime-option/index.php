<?php
/*
Plugin Name: OptionTree
Plugin URI: http://wp.envato.com
Description: Customizable WordPress Theme Options Admin Interface
Version: 1.1.8.1
Author: Derek Herman
Author URI: http://valendesigns.com
License: GPLv2
*/

global $displayAdminOnTypes;
$displayAdminOnTypes = array('post', 'page', 'portfolio', 'flex_slide', 'content_slide', 'cp_slide');

function is_prime_admin_options_page()
{
    global $displayAdminOnTypes;

    $post_type = get_post_type();
    if (isset($_GET['post'])) $post_type = get_post_type($_GET['post']);

    return is_admin() && (in_array($post_type, $displayAdminOnTypes) || strstr($_SERVER['SCRIPT_NAME'], 'wp-admin/post-new.php'));
}

/**
 * Definitions
 *
 * @since 1.0.0
 */
define('PO_VERSION', '1.1.8.9');
define('PO_PLUGIN_DIR', trailingslashit(get_template_directory()) . 'prime-option');
define('PO_PLUGIN_URL', trailingslashit(get_template_directory_uri()) . 'prime-option');

/**
 * Required Files
 *
 * @since 1.0.0
 */
require_once(PO_PLUGIN_DIR . '/functions/functions.load.php');
require_once(PO_PLUGIN_DIR . '/theme-options.php');
require_once(PO_PLUGIN_DIR . '/classes/prime-class-admin.php');

/**
 * Instantiate Classe
 *
 * @since 1.0.0
 */
global $po_admin;
$po_admin = new PO_Admin();

/**
 * Required action filters
 *
 * @uses add_action()
 *
 * @since 1.0.0
 */
add_action('init', array($po_admin, 'create_option_post'), 5);
add_action('admin_menu', array($po_admin, 'option_tree_admin'));

///* All the AJAX to run OT */
add_action('wp_ajax_prime_options_array_save', array($po_admin, 'prime_options_array_save'));
add_action('wp_ajax_prime_options_array_reset', array($po_admin, 'prime_options_array_reset'));

add_action('wp_ajax_prime_options_import_data', array($po_admin, 'prime_options_import_data'));
add_action('wp_ajax_prime_options_add_slider', array($po_admin, 'prime_options_add_slider'));

add_action('wp_ajax_prime_options_import_demo', array($po_admin, 'prime_options_import_demo'));

