<?php
// Get the path to the root.
$full_path = __FILE__;

$path_bits = explode('wp-content', $full_path);

$url = $path_bits[0];

// Require WordPress bootstrap.
require_once($url . '/wp-load.php');

$prime_framework_path = dirname(__FILE__) . '/../../';

$prime_framework_url = PRIME_THEME_ROOT_URI . '/prime/';

//$prime_shortcode_css = $prime_framework_path . 'css/shortcodes.css';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<div id="prime-dialog">

    <div id="prime-options-buttons" class="clear">
        <div class="alignleft">

            <input type="button" id="prime-btn-cancel" class="button" name="cancel" value="Cancel" accesskey="C"/>

        </div>
        <div class="alignright">
            <input type="button" id="prime-btn-insert" class="button-primary" name="insert" value="Insert"
                   accesskey="I"/>

        </div>
        <div class="clear"></div>
        <!--/.clear-->
    </div>
    <!--/#prime-options-buttons .clear-->

    <div id="prime-options" class="alignleft">
        <h3><?php global $FRONTEND_STRINGS; echo $FRONTEND_STRINGS['customize_sc']; ?></h3>

        <table id="prime-options-table">
        </table>

    </div>

    <div class="clear"></div>

    <script type="text/javascript"
            src="<?php echo $prime_framework_url; ?>js/shortcode-generator/js/column-control.js"></script>
    <script type="text/javascript"
            src="<?php echo $prime_framework_url; ?>js/shortcode-generator/js/tab-control.js"></script>

    <!--    We use wp_localize_script in class.admin.php in order to generate dynamic JS vars for dialog.js -->
    <script type="text/javascript"
            src="<?php echo $prime_framework_url; ?>js/shortcode-generator/js/dialog.js"></script>

</div>

</body>
</html>