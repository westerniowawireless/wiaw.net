<?php

if (!class_exists('WP_Import')) {
    if (!defined('WP_LOAD_IMPORTERS')) define('WP_LOAD_IMPORTERS', true);
    $wp_import = get_template_directory() . '/prime-option/classes/wordpress-importer.php';
    require_once($wp_import);
}

/**
 *  Responsible for importing demo.xml, demo.php theme options, and demo menus
 */
class PrimeImport extends WP_Import
{
}