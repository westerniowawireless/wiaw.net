<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 2/4/13
 * Time: 5:36 PM
 * To change this template use File | Settings | File Templates.
 */

//rev slider integration
define('REVSLIDER_EXISTS', function_exists('rev_slider_shortcode'));

if (REVSLIDER_EXISTS) {

    if (!defined('REV_POST_META_KEY'))
        define("REV_POST_META_KEY", 'rev_slider_id');

    add_action('revslider', 'adap_rev_slider');
    //add class to the body tag via filter if a rev slider is on that page
    add_filter('body_class', 'adap_revslider_body_class');

    global $pageHasRev;
    $pageHasRev = false;
    function adap_rev_slider()
    {
//        echo do_shortcode('[rev_slider slider-1]');
        //figure out if a slider should be rendered on this page by checking it's
        //custom post data
        global $post;
        global $wp_query;

        $page_id = $wp_query->get_queried_object_id();

        if ($page_id) {
            $shortcode = get_post_meta($page_id, REV_POST_META_KEY, true);

            if (!empty($shortcode)) {
                echo do_shortcode($shortcode);
                global $pageHasRev;
                $pageHasRev = true;
            }

        } else return false;

    }

    function  adap_revslider_body_class($classes)
    {
        global $wp_query;

        $page_id = $wp_query->get_queried_object_id();

        if ($page_id) {
            $shortcode = get_post_meta($page_id, REV_POST_META_KEY, true);

            if (!empty($shortcode)) {
                $classes[] = 'hasRevSlider';
            }
            // return the $classes array
            return $classes;
        }
    }


//register new custom metabox and store post meta against it
    add_action('add_meta_boxes', array('AdapRevsliderGeneralAdmin', 'add_slider_selection_box'));
    /* Do something with the data entered */
    add_action('save_post', array('AdapRevsliderGeneralAdmin', 'save_postdata'));

    class AdapRevsliderGeneralAdmin
    {
        public static function add_slider_selection_box()
        {
            add_meta_box('revslider_slider_selection', 'Rev Slider Selection', array('AdapRevsliderGeneralAdmin'
            , 'render_slider_selection'));
        }

        public static function render_slider_selection($post)
        {
            // Use nonce for verification
            wp_nonce_field(plugin_basename(__FILE__), 'revslider_metabox_nonce');

            $selectedValue = get_post_meta($post->ID, REV_POST_META_KEY, true);

            $slider = new RevSlider();
            $arrSliders = $slider->getArrSliders();

            // The actual fields for data entry
            echo '<label for="revslider_slider_selection_field">';
            _e("The slider to display:", 'prime');
            echo '</label> ';
            echo '<select id="revslider_slider_selection_field" name="revslider_slider_selection_field" >';
            echo '<option value="NULL">None</option>';
//        foreach ($selectVals as $id => $title) {
//            $selected = ($id == $selectedValue) ? 'selected="selected"' : '';
//            printf('<option value="%s" %s>%s</option>', $id, $selected, $title);
//        }

            foreach ($arrSliders as $slider) {
                $shortcode = $slider->getShortcode();
                $selected = ($shortcode == $selectedValue) ? 'selected="selected"' : '';

                printf('<option value="%s" %s>%s</option>', $shortcode, $selected, $shortcode);
            }
            echo '</select>';
        }

        public static function save_postdata($post_id)
        {
            // don't run the echo if the function is called for saving revision.
            if (wp_is_post_revision($post_id)) return;

            // verify if this is an auto save routine.
            // If it is our form has not been submitted, so we dont want to do anything
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;

            // verify this came from the our screen and with proper authorization,
            // because save_post can be triggered at other times

            if (!wp_verify_nonce($_POST['revslider_metabox_nonce'], plugin_basename(__FILE__)))
                return;


            // Check permissions
            if ('page' == $_POST['post_type']) {
                if (!current_user_can('edit_page', $post_id))
                    return;
            } else {
                if (!current_user_can('edit_post', $post_id))
                    return;
            }

            // OK, we're authenticated: we need to find and save the data

            $mydata = $_POST['revslider_slider_selection_field'];

            if (empty($mydata) || $mydata == 'NONE' || $mydata == 'NULL') {
                $mydata = NULL;
            }

            // Do something with $mydata
            // probably using add_post_meta(), update_post_meta(), or
            // a custom table (see Further Reading section below)

            update_post_meta($post_id, REV_POST_META_KEY, $mydata);
        }

    }
}