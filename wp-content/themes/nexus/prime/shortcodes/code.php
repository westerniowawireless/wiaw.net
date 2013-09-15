<?php

function prime_shortcode_codebox($atts, $content = null)
{
    $defaults = array(
        'line_numbers' => 'true',
        'remove_breaks' => 'true',
        'lang' => NULL
    );
    extract(shortcode_atts($defaults, $atts));

    $line_numbers = $line_numbers == "false" ? false : true;

    $content = prime_remove_autop($content);
    $content = preg_replace("#<br\s?\/?>\n#", '
', $content);
    $content = c2c_wpuntexturize($content);
    if($lang == 'html') $content = esc_html($content);
    ob_start();
    ?><pre class="prettyprint <?php if($line_numbers) echo 'linenums' ?> <?php if(!empty($lang)) printf('lang-%s', $lang); ?>"><?php echo $content; ?></pre><?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}
function c2c_wpuntexturize( $text ) {
    $char_codes = array( '&#8216;', '&#8217;', '&#8220;', '&#8221;', '&#8242;', '&#8243;' );
    $replacements = array( "'", "'", '"', '"', "'", '"' );
    return str_replace( $char_codes, $replacements, $text );
}