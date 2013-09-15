<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 5/1/12
 * Time: 11:53 AM
 * To change this template use File | Settings | File Templates.
 */

class PrimeContentSlider extends PrimeBaseSlider
{
    function PrimeContentSlider()
    {
        $this->__construct();
    }

    function __construct()
    {
        global $FRONTEND_STRINGS;
        parent::__construct('content_slide',
            'content_slide_category',
            $FRONTEND_STRINGS['content_slide_labels'],
            $FRONTEND_STRINGS['content_slide_category_labels']);
    }

    /**
     * Slider Rendering Methods
     * For usage in the Loop
     * Helper methods for SC's
     */
    function get_slide_image()
    {
        global $post;

        $title = NULL;
        $slide_image = get_post_meta($post->ID, '_prime_slide_image', true);
        $tablet_image = get_post_meta($post->ID, '_prime_slide_image_tablet', true);
        $mland_image = get_post_meta($post->ID, '_prime_slide_image_mlandscape', true);
        $mpor_image = get_post_meta($post->ID, '_prime_slide_image_mportrait', true);

        $style = 'position:absolute;top:0;left:0;';

        $img_sc = '[responsive_image style="%s" title="%s" alt="%s" desktopsrc="%s" tabletsrc="%s" mobilelandscapesrc="%s" mobileportraitsrc="%s" /]';
        $img_sc = sprintf($img_sc, $style, $title, $title, $slide_image, $tablet_image, $mland_image, $mpor_image);

        return do_shortcode($img_sc);
    }

    function get_slide_content()
    {
        return sprintf('<div class="row-fluid slide-content"><div class="span12">%s</div></div>',
            do_shortcode(balanceTags(get_the_content(), true)));

    }

    /**
     * Page Rendering
     */
    function render_page_slider()
    {

        if (is_home() && is_front_page()) {
            //frontpage blog page. Get slider vals from
            $categories = get_prime_options('_prime_content_slide_categories');
            $categories = explode(',', $categories);
            $orderDirection = get_prime_options('_prime_slider_order');
            $orderby = get_prime_options('_prime_slider_orderby');
            $slider_speed = get_prime_options('_prime_slider_speed');
        }
        else {
            global $post;
            $pid = is_home() ? get_option('page_for_posts') : $post->ID;

            $categories = get_post_meta($pid, '_prime_content_slide_categories', true);
            $orderDirection = get_post_meta($pid, '_prime_content_slider_order', true);
            $orderby = get_post_meta($pid, '_prime_content_slider_orderby', true);
            $slider_speed = get_post_meta($pid, '_prime_content_slider_speed', true);
        }

        $this->render_page_slider_with($categories, $orderDirection, $orderby, $slider_speed);
    }

    function render_page_slider_with($categories, $orderDirection, $orderby, $slider_speed)
    {
        ?>
    <div class="frontpage-slider-wrapper">
        <div id="frontpageslider-container">
            <?php
            $categories_str = '';

            $orderDirection = !empty($orderDirection) ? sprintf('slider_order="%s"', $orderDirection) : '';
            $orderby = !empty($orderby) ? sprintf('slider_orderby="%s"', $orderby) : '';
            $slider_speed = !empty($slider_speed) ? sprintf('slideshow_speed="%s"', $slider_speed) : '';
            //check for unset slide categories
            if (!empty($categories)) {
                foreach ($categories as $cat) {
                    $term = get_term_by('id', $cat, 'content_slide_category');
                    $categories_str .= $term ? ',' . $term->slug : '';
                }
                $categories_str = trim($categories_str, ',');
            }

            echo do_shortcode(sprintf('[content_slider categories="%s" %s %s %s]',
                $categories_str, $orderby, $orderDirection, $slider_speed));
            ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <?php
    }
}