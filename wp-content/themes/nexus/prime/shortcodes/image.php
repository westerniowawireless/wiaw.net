<?php
function prime_shortcode_image($atts, $content = null)
{
    $defaults = array(
        'lightbox' => 'false',
        'clickthrough' => 'false',
        'width' => '300',
        'height' => '240',
        'src' => '',
        'title' => '',
        'autoresize' => 'true',
        'linkto' => '',
        'alt' => null
    );
    extract(shortcode_atts($defaults, $atts));

    // If there's no src, there's nothing to do
    if (!$src || $src == null || strlen($src) == 0) {
        return;
    }

    $has_linkto = strlen($linkto) > 0;

    $lightbox = $lightbox == "false" ? false : true;
    $clickthrough = $clickthrough == "false" ? false : true;
    $autoresize = $autoresize == "false" ? '0' : '1';
    $alt = !empty($alt) ? $alt : '';
    $desktop = 1;
    $tablet = 1;
    $mobile = 1;

    ob_start();

    ?>
<div class="prime-gallery single-image" data-imgwidth="<?php echo $width; ?>" data-imgheight="<?php echo $height; ?>"
     data-autoresize="<?php echo $autoresize; ?>" data-desktop-columns="<?php echo $desktop; ?>"
     data-tablet-columns="<?php echo $tablet; ?>" data-mobile-columns="<?php echo $mobile; ?>">

    <?php

    $classes = 'gallery-image';

    $vt_crop = 'enable';//get_option_tree('pis_hard_crop');
    // Use double-sized widths and heights for hires displays
    $vt_image = vt_resize(null, $src, $width * 2, $height * 2, $vt_crop);
    $preview_image_url = $vt_image['url'];

    if ($lightbox) {
        echo "<a style=\"\" class=\"image-link " . $classes . "\" href='" . $src . "' rel=\"prettyPhoto\" title=\"" . $title . "\">";
    } elseif ($clickthrough) {
        echo "<a style=\"\" class=\"image-link " . $classes . "\" href='" . $src . "'>";
    } elseif ($has_linkto) {
        echo "<a style=\"\" class=\"image-link " . $classes . "\" href='" . $linkto . "'>";
    }
    ?>

    <?php
    prime_image(array('id' => get_the_ID(),
        'width' => $width,
        'height' => $height,
        'src' => $preview_image_url,
        'class' => $classes,
        'title' => $title,
        'alt' => $alt
    ));

    if ($lightbox || $clickthrough || $has_linkto) echo "</a>";

    ?>
</div>
<?php

    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}