<?php
function prime_shortcode_gallery($atts, $content = null)
{
    $defaults = array(
        'width' => '212',
        'height' => '200',
        'desktop' => '4',
        'tablet' => '3',
        'mobile' => '2',
        'lightbox' => 'true',
        'autoresize' => 'true'
    );
    extract(shortcode_atts($defaults, $atts));

    // Retrieve images
    global $post;
    $images = get_children(array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID'));

    ob_start();

    $autoresize = $autoresize == "false" ? false : true;
    $lightbox = $lightbox == "false" ? false : true;

    ?>
<div class="prime-gallery" data-imgwidth="<?php echo $width; ?>" data-imgheight="<?php echo $height; ?>" data-autoresize="<?php echo $autoresize; ?>" data-desktop-columns="<?php echo $desktop; ?>" data-tablet-columns="<?php echo $tablet; ?>" data-mobile-columns="<?php echo $mobile; ?>">
    <?php

    $desktop_counter = 0;
    $tablet_counter = 0;
    $mobile_counter = 0;
    foreach ($images as $attachment_id => $image) {
        $desktop_counter++;
        $tablet_counter++;
        $mobile_counter++;
        $classes = 'gallery-image';
        if ($desktop_counter % $desktop == 0) {
            $classes .= ' desktop-row';
        }
        if ($tablet_counter % $tablet == 0) {
            $classes .= ' tablet-row';
        }
        if ($mobile_counter % $mobile == 0) {
            $classes .= ' mobile-row';
        }

        $vt_crop = 'enable';//get_option_tree('pis_hard_crop');
        // Use double-sized widths and heights for hires displays
        $vt_image = vt_resize(null, wp_get_attachment_url($image->ID), $width * 2, $height * 2, $vt_crop);
        $preview_image_url = $vt_image['url'];

        if ($lightbox) {
            echo "<a style=\"position:relative;display:inline-block;\" class=\"image-link no-frame " . $classes . "\" href='" . wp_get_attachment_url($image->ID) . "' rel=\"prettyPhoto[pp_gal]\">";
        } else {
            echo "<a style=\"position:relative;display:inline-block;\" class=\"image-link no-frame " . $classes . "\" href='" . get_attachment_link($image->ID) . "'>";
        }
        ?>
        <!-- <span class="image-overlay" style=""></span> -->
        <!-- <span class="overlay-thumbnail"><i class="icon-zoom-in"></i></span> -->
        <?php
        prime_image(array('id' => get_the_ID(),
                         'width' => $width,
                         'height' => $height,
                         'src' => $preview_image_url,
                         'class' => $classes));
        ?>

        <?php
        echo "</a>";

    }
    ?>
</div>
    <?php

    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}