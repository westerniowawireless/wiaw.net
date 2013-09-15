<?php
function prime_shortcode_spacer($atts, $content = null)
{
    $defaults = array(
        'height' => '0px'
    );
    extract(shortcode_atts($defaults, $atts));

    ob_start();
    if ($content == null) $content = '';
    ?><div class="spacer" style="height:<?php echo $height; ?>;"></div><?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return prime_remove_autop($ret_val);
}