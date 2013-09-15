<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 12/1/11
 * Time: 9:02 AM
 * To change this template use File | Settings | File Templates.
 */

function prime_shortcode_button($atts, $content = null)
{
    extract(shortcode_atts(array('size' => '',
                                'text' => 'Default',
                                'class' => '',
                                'link' => '#',
                                'color' => '',
                                'window' => '',), $atts));

    if ($window && $window == 'true')
        $window = 'target="_blank" ';

    $class_att = sprintf('class="%s %s %s"', 'btn', $size, $class);
    $style_att = $color == '' ? '' : 'style="background-color:' . $color . ';"';
    $href_att = sprintf('href="%s"', $link);
    $ret_val = sprintf('<a %s %s %s %s>%s</a>', $window, $class_att, $href_att, $style_att, prime_remove_autop(trim($content)));

    return prime_remove_autop($ret_val);
}
