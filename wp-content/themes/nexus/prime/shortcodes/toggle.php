<?php
function prime_shortcode_toggle($atts, $content = null)
{

    $defaults = array('title' => 'Toggle',
        'open' => 'false',
		'color' => '',
		'border' => '');

    extract(shortcode_atts($defaults, $atts));

    //Explicitly apply wptexturize and wpautop to tab contents since the all
    //the tab values are contained in a [raw] shortcode.
    $content = wptexturize(wpautop(trim($content)));

    $open = $open == "false" ? false : true;
    $open_class = $open ? 'in' : '';

    $icon_class = 'icon-chevron-down';
    $link_class = $open ? '' : 'closed';

	$color_css = $color == '' ? '' : 'background-color:' . $color . ';';
	$border_css = $border == '' ? '' : 'border-color:' . $border . ';';
	$a_style_att = $color == ''? '' : 'style="' . $color_css . ';"';
	$inner_style_att = $border == ''? '' : 'style="' . $border_css . ';"';

    global $accordion_parent_id;
    $accordion_parent_id = uniqid('accordion_');

    $bodyid = uniqid('collapseOne');

    $ret_val = '<div class="accordion" id="' . $accordion_parent_id . '">';
    $ret_val .= '<div class="accordion-group">';
    $ret_val .= '<div class="accordion-heading">';
    $ret_val .= '<a class="accordion-toggle ' . $link_class . '" data-toggle="collapse" data-parent="#' . $accordion_parent_id . '" href="#' . $bodyid . '" ' . $a_style_att . '>';
    $ret_val .= '<i class="toggle-icon ' . $icon_class . '"></i>';
    $ret_val .= '<span>' . $title . '</span>';
    $ret_val .= '</a>';
    $ret_val .= '</div>';
    $ret_val .= '<div id="' . $bodyid . '" class="accordion-body collapse ' . $open_class .'">';
    $ret_val .= '<div class="accordion-inner" ' . $inner_style_att . '>';
    $ret_val .= wpautop(prime_remove_autop(do_shortcode($content)));
//    $ret_val .= prime_raw_wrap(prime_remove_raw(do_shortcode($content)));
    $ret_val .= '</div></div></div></div>';

    return $ret_val;

} // End prime_shortcode_toggle()