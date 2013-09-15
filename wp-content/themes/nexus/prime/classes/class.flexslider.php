<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 5/23/12
 * Time: 10:00 AM
 * To change this template use File | Settings | File Templates.
 */

class PrimeFlexSlider extends PrimeBaseSlider
{
    function PrimeFlexSlider()
    {
        $this->__construct();
    }

    function __construct()
    {
        global $FRONTEND_STRINGS;
        parent::__construct('flex_slide',
            'flex_slide_category',
            $FRONTEND_STRINGS['flex_slide_labels'],
            $FRONTEND_STRINGS['flex_slide_category_labels'],
            array('title', 'page-attributes'));
    }

    function render_page_slider()
    {
        if (is_home() && is_front_page()) {
            //frontpage blog page. Get slider vals from
            $categories = get_prime_options('_prime_flex_slide_categories');
            $categories = explode(',', $categories);
            $orderDirection = get_prime_options('_prime_slider_order');
            $orderby = get_prime_options('_prime_slider_orderby');
            $slider_speed = get_prime_options('_prime_slider_speed');
        }
        else {
            global $post;
            $pid = is_home() ? get_option('page_for_posts') : $post->ID;

            $categories = get_post_meta($pid, '_prime_flex_slide_categories', true);
            $orderDirection = get_post_meta($pid, '_prime_flex_slider_order', true);
            $orderby = get_post_meta($pid, '_prime_flex_slider_orderby', true);
            $slider_speed = get_post_meta($pid, '_prime_flex_slider_speed', true);
        }

        $this->render_page_slider_with($categories, $orderDirection, $orderby, $slider_speed);

    }


    function render_page_slider_with($categories, $orderDirection, $orderby, $slider_speed)
    {
        ?>
    <div class="frontpage-slider-wrapper">
        <div id="frontpageslider-container">
            <?php
            //check for unset slide categories
            $categories_str = '';
            if (!empty($categories)) {
                foreach ($categories as $cat) {
                    $term = get_term_by('id', $cat, 'flex_slide_category');
                    $categories_str .= $term ? ',' . $term->slug : '';
                }
                $categories_str = trim($categories_str, ',');
            }

            $orderDirection = !empty($orderDirection) ? sprintf('slider_order="%s"', $orderDirection) : '';
            $orderby = !empty($orderby) ? sprintf('slider_orderby="%s"', $orderby) : '';

            $slider_speed = !empty($slider_speed) ? sprintf('slideshow_speed="%s"', $slider_speed) : '';

            echo do_shortcode(sprintf('[flex_slider categories="%s" %s %s %s]',
                $categories_str, $orderby, $orderDirection, $slider_speed));
            ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <?php
    }
}