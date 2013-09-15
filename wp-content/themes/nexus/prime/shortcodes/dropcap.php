<?php

function prime_shortcode_dropcap($atts, $content = null)
{
	$defaults = array(
		'style'=> 'circle',
        'color' => '#444'
    );
    extract(shortcode_atts($defaults, $atts));
	
	$class_att = "dropcap";
	if($style=='circle') $class_att .= ' dropcap-circle';
	
	
	$style_att = $color == ''  || $style != 'circle' ? '' : 'style="background-color:' . $color . ';"';
    
	
    ob_start();
    ?><span class="<?php echo $class_att; ?>" <?php echo $style_att; ?>><?php echo do_shortcode($content); ?></span><?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}