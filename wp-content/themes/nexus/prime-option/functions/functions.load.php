<?php if (!defined('PO_VERSION')) exit('No direct script access allowed');
/**
 * Functions Load
 *
 * @package     WordPress
 * @subpackage  OptionTree
 * @since       1.0.0
 * @author      Derek Herman
 */
include(PO_PLUGIN_DIR . '/functions/functions.php');
include(PO_PLUGIN_DIR . '/functions/option.helpers.php');

if ((is_admin() && isset($_GET['page']) && strpos('_' . $_GET['page'], 'option_tree'))
    || is_prime_admin_options_page()
) {
    include(PO_PLUGIN_DIR . '/functions/admin/export.php');
    include(PO_PLUGIN_DIR . '/functions/admin/import-export.php');
    include(PO_PLUGIN_DIR . '/functions/admin/heading.php');
    include(PO_PLUGIN_DIR . '/functions/admin/input.php');
    include(PO_PLUGIN_DIR . '/functions/admin/checkbox.php');
    include(PO_PLUGIN_DIR . '/functions/admin/radio.php');
    include(PO_PLUGIN_DIR . '/functions/admin/select.php');
    include(PO_PLUGIN_DIR . '/functions/admin/textarea.php');
    include(PO_PLUGIN_DIR . '/functions/admin/upload.php');
    include(PO_PLUGIN_DIR . '/functions/admin/colorpicker.php');
    include(PO_PLUGIN_DIR . '/functions/admin/textblock.php');
    include(PO_PLUGIN_DIR . '/functions/admin/post.php');
    include(PO_PLUGIN_DIR . '/functions/admin/page.php');
    include(PO_PLUGIN_DIR . '/functions/admin/category.php');
    include(PO_PLUGIN_DIR . '/functions/admin/tag.php');
    include(PO_PLUGIN_DIR . '/functions/admin/custom-post.php');
    include(PO_PLUGIN_DIR . '/functions/admin/measurement.php');
    include(PO_PLUGIN_DIR . '/functions/admin/slider.php');
    include(PO_PLUGIN_DIR . '/functions/admin/background.php');
    include(PO_PLUGIN_DIR . '/functions/admin/typography.php');
    include(PO_PLUGIN_DIR . '/functions/admin/css.php');
}
include(PO_PLUGIN_DIR . '/functions/get-option-tree.php');
