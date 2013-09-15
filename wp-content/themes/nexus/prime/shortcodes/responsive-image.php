<?php

/**
 * Shortcode that outputs image tag with data-*-src tags for the different layouts that get loaded by
 * PrimeAJAXResponsiveImage js plugin.
 * @param $atts
 * @param null $content
 * @return string
 */
function prime_shortcode_responsive_image($atts, $content = null)
{
    $defaults = array(
        'class' => '',
        'id' => NULL,
        'style' => NULL,
        'data_transition' => NULL,
        'title' => '',
        'alt' => '',
        'desktopsrc' => NULL,
        'tabletsrc' => NULL,
        'mobilelandscapesrc' => NULL,
        'mobileportraitsrc' => NULL
    );

    extract(shortcode_atts($defaults, $atts));
    ob_start();
    $data_trans_class = '';
    ?>
<img <?php if (!empty($id)) {
    echo sprintf('id="%s"', $id);
}?>
    <?php if (!empty($title)) {
    echo sprintf('title="%s"', $title);
}?>
    <?php if (!empty($alt)) {
    echo sprintf('alt="%s"', $alt);
} ?>
    <?php if (!empty($style)) {
    echo sprintf('style="%s"', $style);
} ?>
    <?php if (!empty($data_transition)) {
    echo sprintf('data-transition="%s"', $data_transition);
    $data_trans_class = 'animated ' . $data_transition;
} ?>
    class="prime-ajax-image <?php echo $class ?> <?php echo $data_trans_class; ?>"
    data-prime-desktop-src="<?php echo $desktopsrc ?>"
    data-prime-tablet-src="<?php echo $tabletsrc ?>"
    data-prime-mobile-landscape-src="<?php echo $mobilelandscapesrc ?>"
    data-prime-mobile-portrait-src="<?php echo $mobileportraitsrc ?>"/>
<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}