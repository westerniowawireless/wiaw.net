<?php

function prime_shortcode_divider($atts, $content = null)
{
    $defaults = array(
        'style' => 'thick',
    );
    extract(shortcode_atts($defaults, $atts));

    $style = $style == "thin" ? "thin" : "thick";

    ob_start();

    global $FRONTEND_STRINGS;

    ?><div class="divider shortcode-divider <?php echo $style; ?>"></div><?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return prime_remove_autop($ret_val);
}