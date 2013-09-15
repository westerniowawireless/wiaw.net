<?php

$accordion_parent_id = null;

function prime_shortcode_accordion($atts, $content = null)
{
    $defaults = array('sync' => 'true');

    extract(shortcode_atts($defaults, $atts));

    $sync = $sync == "false" ? false : true;

    global $accordion_parent_id;
    $accordion_parent_id = $sync ? uniqid('accordion_') : null;

    $ret_val = '<div class="accordion" id="' . $accordion_parent_id . '">' . wpautop(prime_remove_autop(do_shortcode($content))) . '</div>';
    $accordion_parent_id = null;
    return wpautop(prime_remove_autop($ret_val));
}

function prime_shortcode_accordion_item($atts, $content = null)
{
    $defaults = array(
        'title' => 'Accordion Item',
        'open' => 'false',
		'color' => '',
		'border' => '');

    extract(shortcode_atts($defaults, $atts));

    $open = $open == "false" ? false : true;
    $open_class = $open ? 'in' : '';

    $icon_class = 'icon-chevron-down';
    $link_class = $open ? '' : 'closed';

	$color_css = $color == '' ? '' : 'background-color:' . $color . ';';
	$border_css = $border == '' ? '' : 'border-color:' . $border . ';';
	$a_style_att = $color == ''? '' : 'style="' . $color_css . ';"';
	$inner_style_att = $border == ''? '' : 'style="' . $border_css . ';"';

    global $accordion_parent_id;
    $accordion_item_id = uniqid('accordion_item_');

    $ret_val = '<div class="accordion-group">';
    $ret_val .= '<div class="accordion-heading">';
    $ret_val .= '<a class="accordion-toggle ' . $link_class . '" data-toggle="collapse" data-parent="#' . $accordion_parent_id . '" href="#' . $accordion_item_id . '" ' . $a_style_att . '>';
    $ret_val .= '<i class="toggle-icon ' . $icon_class . '"></i>';
    $ret_val .= '<span>' . $title . '</span>';
    $ret_val .= '</a>';
    $ret_val .= '</div>';
    $ret_val .= '<div id="' . $accordion_item_id . '" class="accordion-body collapse ' . $open_class . '">';
    $ret_val .= '<div class="accordion-inner" ' . $inner_style_att . '>';
    $ret_val .= do_shortcode($content);
    //    $ret_val .= prime_raw_wrap(prime_remove_raw(do_shortcode($content)));
    $ret_val .= '</div></div></div>';

    return $ret_val;
}