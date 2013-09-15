<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 4/10/12
 * Time: 11:28 AM
 * To change this template use File | Settings | File Templates.
 */


function prime_shortcode_flex_slider($atts, $content = null)
{
    $defaults = array(
        'categories' => NULL,
        'slideshow' => false,
        'slideshow_speed' => 9000,
        'slider_orderby' => 'menu_order',
        'slider_order' => 'ASC');
    $sc_args = shortcode_atts($defaults, $atts);
    extract($sc_args);

    global $prime_flex_slider;

    ob_start();?>

<?php

    $args = $prime_flex_slider->get_slide_args_for($sc_args);

    $slider_id = uniqid('flexslider');
    $numslides = 0;

    global $wp_query;
    $temp_query = $wp_query;
    $wp_query = new WP_Query($args);
    ?>


<div
    <?php
    if (intval($slideshow_speed) > 0) {
        echo 'data-slideshow="true" ';
        echo 'data-slideshow-speed="' . $slideshow_speed . '"';
    }
    ?> class="flexslider galleryslider flexslider-shortcode flex-sc
    <?php
    if (intval($slideshow_speed) > 0) {
        echo 'autoplay';
    }
    else {
        echo 'no-autoplay';
    }
    ?>" id="<?php echo $slider_id; ?>">
    <ul class="slides">
        <?php while (have_posts()) : the_post(); ?>
        <?php
        global $post;
        $numslides++;
        $caption = get_post_meta($post->ID, '_prime_slide_caption', true);
        $subcaption = get_post_meta($post->ID, '_prime_slide_subcaption', true);

        $slide_image = get_post_meta($post->ID, '_prime_slide_image', true);
        $tablet_image = get_post_meta($post->ID, '_prime_slide_image_tablet', true);
        $mland_image = get_post_meta($post->ID, '_prime_slide_image_mlandscape', true);
        $mpor_image = get_post_meta($post->ID, '_prime_slide_image_mportrait', true);

        $link_url = get_post_meta($post->ID, '_prime_link_url', true);
        $link_new_window = get_post_meta($post->ID, '_prime_gallery_link_new_window', true);
        $has_link = strlen($link_url) > 0;
        $link_new_window = $link_new_window != null && is_array($link_new_window) && $link_new_window[0] == 'Yes' ? ' target="_blank"' : '';

        $title = get_the_title();

        $caption_pos = get_post_meta($post->ID, '_prime_caption_position', true);
        $caption_pos = empty($caption_pos) ? 'top-left' : $caption_pos;

        global $prime_flex_slider;
        ?>
        <li <?php echo $prime_flex_slider->get_data_height_attrs(); ?>>
            <?php if ($has_link) { ?>
                <a href="<?php echo $link_url ?>"<?php echo $link_new_window; ?>>
            <?php } ?>

            <?php
            $img_sc = '[responsive_image title="%s" alt="%s" desktopsrc="%s" tabletsrc="%s" mobilelandscapesrc="%s" mobileportraitsrc="%s" /]';
            $img_sc = sprintf($img_sc, $title, $title, $slide_image, $tablet_image, $mland_image, $mpor_image);

            echo do_shortcode($img_sc);
            ?>
            <?php if ($has_link) { ?></a> <?php } ?>

            <div class="flex-caption <?php echo $caption_pos; ?>">
                <?php if (strlen($caption) > 0) { ?>
                <div class="caption"><?php echo $caption; ?></div>
                <div class="clear"></div><?php } ?>
                <?php if (strlen($subcaption) > 0) { ?>
                <div class="subcaption"><p><?php echo $subcaption; ?></p></div><?php } ?>
            </div>
        </li>
        <?php endwhile; // End the loop ?>
    </ul>
    <ul class="slider-arrows">
        <li>
            <div class="arrow-left"><span class="arrow-wrapper left-arrow-wrapper"><i
                class="icon-chevron-left previous-slide-arrow"></i></span></div>
        </li>
        <li>
            <div class="arrow-right"><span class="arrow-wrapper right-arrow-wrapper"><i
                class="icon-chevron-right next-slide-arrow"></i></span></div>
        </li>
    </ul>
</div>

<?php

    $ret_val = ob_get_contents();
    ob_end_clean();

    $wp_query = $temp_query;
    wp_reset_query();

    return $ret_val;
}