<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 5/1/12
 * Time: 11:53 AM
 * To change this template use File | Settings | File Templates.
 */

class PrimeCPSlider extends PrimeBaseSlider
{
    function PrimeCPSlider()
    {
        $this->__construct();
    }

    function __construct()
    {
        global $FRONTEND_STRINGS;
        parent::__construct('cp_slide',
            'cp_slide_category',
            $FRONTEND_STRINGS['cp_slide_labels'],
            $FRONTEND_STRINGS['cp_slide_category_labels']);
    }

    /**
     * Slider Rendering Methods
     * For usage in the Loop
     * Used by the shortcodes generally
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
        global $post;
        $right_alignment = get_post_meta($post->ID, '_prime_alignment', true) == 'Right';

        $left_content = $this->get_slide_mce_content();
        $right_content = $this->get_slide_fg_image();

        if ($right_alignment) {
            $left_content = $this->get_slide_fg_image(true);
            $right_content = $this->get_slide_mce_content(true);
        }

        return sprintf('<div class="row-fluid slide-content">
                %s %s
        </div>', $left_content, $right_content);
    }

    function get_slide_mce_content($right = false)
    {
        $trans = $right ? 'fadeInRight' : 'fadeInLeft';

        return sprintf('<div class="span6 text-content animated %s" data-transition="%s">%s</div>', $trans, $trans, do_shortcode(balanceTags(get_the_content(), true)));
    }

    function get_slide_fg_image($right = false)
    {
        global $post;

        $trans = $right ? 'fadeInLeft' : 'fadeInRight';
        $fg_image = get_post_meta($post->ID, '_prime_foreground_image', true);
        $fg_tablet = get_post_meta($post->ID, '_prime_foreground_image_tablet', true);
        $fg_mlandscape = get_post_meta($post->ID, '_prime_foreground_image_mlandscape', true);
        $fg_mportrait = get_post_meta($post->ID, '_prime_foreground_image_mportrait', true);
        $title = NULL;

        $class = $right ? 'left' : 'right';
        $class .= ' fg-image';

        $img_sc = '[responsive_image data_transition="%s" class="%s" title="%s" alt="%s" desktopsrc="%s" tabletsrc="%s" mobilelandscapesrc="%s" mobileportraitsrc="%s" /]';
        $img_sc = sprintf($img_sc, $trans, $class, $title, $title, $fg_image, $fg_tablet, $fg_mlandscape, $fg_mportrait);

        $disp_image = do_shortcode($img_sc);

        return sprintf('
            <div class="span6 ' . $class . '">%s</div>', $disp_image);
    }

    /**
     * Page Slider Rendering
     */
    function render_page_slider()
    {

        if (is_home() && is_front_page()) {
            //frontpage blog page. Get slider vals from
            $categories = get_prime_options('_prime_cp_slide_categories');
            $categories = explode(',', $categories);
            $orderDirection = get_prime_options('_prime_slider_order');
            $orderby = get_prime_options('_prime_slider_orderby');
            $slider_speed = get_prime_options('_prime_slider_speed');
        }
        else {
            global $post;
            $pid = is_home() ? get_option('page_for_posts') : $post->ID;

            $categories = get_post_meta($pid, '_prime_cp_slide_categories', true);
            $orderDirection = get_post_meta($pid, '_prime_cp_slider_order', true);
            $orderby = get_post_meta($pid, '_prime_cp_slider_orderby', true);
            $slider_speed = get_post_meta($pid, '_prime_cp_slider_speed', true);
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
                    $term = get_term_by('id', $cat, 'cp_slide_category');
                    $categories_str .= $term ? ',' . $term->slug : '';
                }
                $categories_str = trim($categories_str, ',');
            }

            echo do_shortcode(sprintf('[cpslider categories="%s" %s %s %s]',
                $categories_str, $orderby, $orderDirection, $slider_speed));
            ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <?php
    }
}