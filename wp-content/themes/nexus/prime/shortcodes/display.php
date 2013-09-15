<?php

function prime_shortcode_display($atts, $content = null) {
    $defaults = array(
        'desktop' => 'false',
        'tablet_landscape' => 'false',
        'tablet_portrait' => 'false',
        'mobile_landscape' => 'false',
        'mobile_portrait' => 'false'
    );
    extract(shortcode_atts($defaults, $atts));

    $desktop = $desktop == 'false' ? false : true;
    $tablet_landscape = $tablet_landscape == 'false' ? false : true;
    $tablet_portrait = $tablet_portrait == 'false' ? false : true;
    $mobile_landscape = $mobile_landscape == 'false' ? false : true;
    $mobile_portrait = $mobile_portrait == 'false' ? false : true;

    $class = 'responsive-display';
    $desktopClass = $desktop ? 'display-desktop' : 'hide-desktop';
    $tabletLandscapeClass = $tablet_landscape ? 'display-tablet-landscape' : 'hide-tablet-landscape';
    $tabletPortraitClass = $tablet_portrait ? 'display-tablet-portrait' : 'hide-tablet-portrait';
    $mobileLandscapeClass = $mobile_landscape ? 'display-mobile-landscape' : 'hide-mobile-landscape';
    $mobilePortraitClass = $mobile_portrait ? ' display-mobile-portrait' : 'hide-mobile-portrait';

    echo '<span ' . build_class_attribute($class, $desktopClass, $tabletLandscapeClass, $tabletPortraitClass, $mobileLandscapeClass, $mobilePortraitClass) . '>';
    echo prime_remove_autop(do_shortcode($content));
    echo '</span>';
}

function build_class_attribute() {
    $classes = func_get_args();
    if(count($classes) > 0) {
        $retstring = '';
        foreach($classes as $class) {
            $retstring .= ' ';
            $retstring .= $class;
        }
        return 'class="' . trim($retstring) . '"';
    }
}

function prime_shortcode_display_desktop($atts, $content = null)
{
    $defaults = array(
        'style' => 'left',
    );
    extract(shortcode_atts($defaults, $atts));

    ob_start();
    ?>

<div class="visible-desktop"><?php echo prime_remove_autop(do_shortcode($content)); ?></div>

<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}

function prime_shortcode_display_tablet($atts, $content = null)
{
    $defaults = array(
        'style' => 'left',
    );
    extract(shortcode_atts($defaults, $atts));

    ob_start();
    ?>

<div class="visible-tablet"><?php echo prime_remove_autop(do_shortcode($content)); ?></div>

<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}

function prime_shortcode_display_mobile_landscape($atts, $content = null)
{
    $defaults = array(
        'style' => 'left',
    );
    extract(shortcode_atts($defaults, $atts));

    ob_start();
    ?>

<div class="visible-phone-landscape"><?php echo prime_remove_autop(do_shortcode($content)); ?></div>

<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}

function prime_shortcode_display_mobile_portrait($atts, $content = null)
{
    $defaults = array(
        'style' => 'left',
    );
    extract(shortcode_atts($defaults, $atts));

    ob_start();
    ?>

<div class="visible-phone-portrait"><?php echo prime_remove_autop(do_shortcode($content)); ?></div>

<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}