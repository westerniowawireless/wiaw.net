<?php
function get_text_align_class($atts)
{
    extract(shortcode_atts(array(
                                'text_align' => 'left',
                           ), $atts));
    $text_align_class = 'text-align-left';
    if ($text_align == 'right') $text_align_class = 'text-align-right';
    if ($text_align == 'center') $text_align_class = 'text-align-center';
    return $text_align_class;
}

function get_margin_string($atts)
{
    extract(shortcode_atts(array(
                                'margin' => '',
                           ), $atts));
    $ret = 'style="margin:';

    if ($margin != '') {
        $ret .= $margin;
    }
    else {
        return '';
    }

    $ret .= ';" ';
    return $ret;
}

/*
 * Encapsulates the repeatable attributes from shortcode attributes.
 */
function get_opening_div_common($atts)
{
    return get_text_align_class($atts) . '" ' . get_margin_string($atts);
}

function prime_one_third($atts, $content = null)
{
    return ('<div class="one_third ' . get_opening_div_common($atts) . '>' . do_shortcode($content) . '</div>');
}

add_shortcode('one_third', 'prime_one_third');

function prime_one_third_last($atts, $content = null)
{
    return ('<div class="one_third last ' . get_opening_div_common($atts) . '>' . do_shortcode($content)
                         . '</div><div class="clearboth"></div>');
}

add_shortcode('one_third_last', 'prime_one_third_last');

function prime_two_third($atts, $content = null)
{
    return ('<div class="two_third ' . get_opening_div_common($atts) . '>' . do_shortcode($content) . '</div>');
}

add_shortcode('two_third', 'prime_two_third');

function prime_two_third_last($atts, $content = null)
{
    return ('<div class="two_third last ' . get_opening_div_common($atts) . '>' . do_shortcode($content)
                         . '</div><div class="clearboth"></div>');
}

add_shortcode('two_third_last', 'prime_two_third_last');

function prime_one_half($atts, $content = null)
{
    return prime_remove_autop('<div class="one_half ' . get_opening_div_common($atts) . '>' . do_shortcode($content) . '</div>');
}

add_shortcode('one_half', 'prime_one_half');

function prime_one_half_last($atts, $content = null)
{
    return prime_remove_autop('<div class="one_half last ' . get_opening_div_common($atts) . '>' . do_shortcode($content)
                         . '</div><div class="clearboth"></div>');
}

add_shortcode('one_half_last', 'prime_one_half_last');

function prime_one_fourth($atts, $content = null)
{
    return ('<div class="one_fourth ' . get_opening_div_common($atts) . '>' . do_shortcode($content) . '</div>');
}

add_shortcode('one_fourth', 'prime_one_fourth');

function prime_one_fourth_last($atts, $content = null)
{
    return ('<div class="one_fourth last ' . get_opening_div_common($atts) . '>' . do_shortcode($content)
                         . '</div><div class="clearboth"></div>');
}

add_shortcode('one_fourth_last', 'prime_one_fourth_last');

function prime_three_fourth($atts, $content = null)
{
    return ('<div class="three_fourth ' . get_opening_div_common($atts) . '>' . do_shortcode($content) . '</div>');
}

add_shortcode('three_fourth', 'prime_three_fourth');

function prime_three_fourth_last($atts, $content = null)
{
    return ('<div class="three_fourth last ' . get_opening_div_common($atts) . '>' . do_shortcode($content)
                         . '</div><div class="clearboth"></div>');
}

add_shortcode('three_fourth_last', 'prime_three_fourth_last');

function prime_one_fifth($atts, $content = null)
{
    return ('<div class="one_fifth ' . get_opening_div_common($atts) . '>' . do_shortcode($content) . '</div>');
}

add_shortcode('one_fifth', 'prime_one_fifth');

function prime_one_fifth_last($atts, $content = null)
{
    return ('<div class="one_fifth last ' . get_opening_div_common($atts) . '>' . do_shortcode($content)
                         . '</div><div class="clearboth"></div>');
}

add_shortcode('one_fifth_last', 'prime_one_fifth_last');

function prime_two_fifth($atts, $content = null)
{
    return ('<div class="two_fifth ' . get_opening_div_common($atts) . '>' . do_shortcode($content) . '</div>');
}

add_shortcode('two_fifth', 'prime_two_fifth');

function prime_two_fifth_last($atts, $content = null)
{
    return ('<div class="two_fifth last ' . get_opening_div_common($atts) . '>' . do_shortcode($content)
                         . '</div><div class="clearboth"></div>');
}

add_shortcode('two_fifth_last', 'prime_two_fifth_last');

function prime_three_fifth($atts, $content = null)
{
    return ('<div class="three_fifth ' . get_opening_div_common($atts) . '>' . do_shortcode($content) . '</div>');
}

add_shortcode('three_fifth', 'prime_three_fifth');

function prime_three_fifth_last($atts, $content = null)
{
    return ('<div class="three_fifth last ' . get_opening_div_common($atts) . '>' . do_shortcode($content)
                         . '</div><div class="clearboth"></div>');
}

add_shortcode('three_fifth_last', 'prime_three_fifth_last');

function prime_four_fifth($atts, $content = null)
{
    return ('<div class="four_fifth ' . get_opening_div_common($atts) . '>' . do_shortcode($content) . '</div>');
}

add_shortcode('four_fifth', 'prime_four_fifth');

function prime_four_fifth_last($atts, $content = null)
{
    return ('<div class="four_fifth last ' . get_opening_div_common($atts) . '>' . do_shortcode($content)
                         . '</div><div class="clearboth"></div>');
}

add_shortcode('four_fifth_last', 'prime_four_fifth_last');

function prime_one_sixth($atts, $content = null)
{
    return ('<div class="one_sixth ' . get_opening_div_common($atts) . '>' . do_shortcode($content) . '</div>');
}

add_shortcode('one_sixth', 'prime_one_sixth');

function prime_one_sixth_last($atts, $content = null)
{
    return ('<div class="one_sixth last ' . get_opening_div_common($atts) . '>' . do_shortcode($content)
                         . '</div><div class="clearboth"></div>');
}

add_shortcode('one_sixth_last', 'prime_one_sixth_last');

function prime_five_sixth($atts, $content = null)
{
    return ('<div class="five_sixth ' . get_opening_div_common($atts) . '>' . do_shortcode($content) . '</div>');
}

add_shortcode('five_sixth', 'prime_five_sixth');

function prime_five_sixth_last($atts, $content = null)
{
    return ('<div class="five_sixth last ' . get_opening_div_common($atts) . '>' . do_shortcode($content)
                         . '</div><div class="clearboth"></div>');
}

add_shortcode('five_sixth_last', 'prime_five_sixth_last');
 