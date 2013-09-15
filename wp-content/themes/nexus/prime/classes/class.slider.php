<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 3/29/12
 * Time: 10:10 AM
 * To change this template use File | Settings | File Templates.
 */

abstract class PrimeBaseSlider
{
    protected $slide_custom_post_type_name;
    protected $slide_category_name;
    protected $slide_labels;
    protected $slide_cat_labels;
    protected $slide_supports;

    abstract function render_page_slider();

    function PrimeBaseSlider($slide_slug, $slide_cat_slug, $slide_labels, $slide_cat_labels,
                             $slide_supports = array('title', 'editor', 'page-attributes'))
    {
        $this->__construct($slide_slug, $slide_cat_slug, $slide_labels, $slide_cat_labels, $slide_supports);
    }

    function __construct($slide_slug, $slide_cat_slug, $slide_labels, $slide_cat_labels,
                         $slide_supports = array('title', 'editor', 'page-attributes'))
    {
        add_action('init', array($this, 'register_custom_post_types'), 5);
        add_filter('get_media_item_args', array($this, 'get_media_item_args'));
        $this->slide_custom_post_type_name = $slide_slug;
        $this->slide_category_name = $slide_cat_slug;

        $this->slide_labels = $slide_labels;
        $this->slide_cat_labels = $slide_cat_labels;

        $this->slide_supports = $slide_supports;
    }

    /**
     * Filter method to make sure that the 'Set Option' button shows up
     * @param $args
     * @return array
     */
    function get_media_item_args($args)
    {
        $args['send'] = true;
        return $args;
    }

    function register_custom_post_types()
    {
        $this->register_slide_category_taxonomy();
        $this->register_slide_post_type();
    }

    function register_slide_post_type()
    {
        // "Portfolio Item" Custom Post Type
        global $FRONTEND_STRINGS;
        $labels = $this->slide_labels;

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => null,
            'has_archive' => true,
            'supports' => $this->slide_supports,
            'taxonomies' => array($this->slide_category_name)
        );

        register_post_type($this->slide_custom_post_type_name, $args);
    }

    function register_slide_category_taxonomy()
    {
        global $FRONTEND_STRINGS;
        // Add new taxonomy, NOT hierarchical (like tags)
        $labels = $this->slide_cat_labels;

        register_taxonomy(
            $this->slide_category_name,
            $this->slide_custom_post_type_name,
            array(
                'hierarchical' => false,
                'labels' => $labels,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'show_in_nav_menus' => false
            ));
    }

    /**
     * Called by shortcodes to construct the Query Args for
     * a given slider
     * @param $sc_args
     * @return array
     */
    function get_slide_args_for($sc_args)
    {
        extract($sc_args);

        $args = $this->get_default_slider_query_args();

        //if categories was specified in the SC attributes that are fed
        //to this method
        if ($categories) {
            $categories = explode(',', $categories);
            foreach ($categories as &$cat) {
                $cat = trim($cat);
            }

            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => $this->slide_category_name,
                        'field' => 'slug',
                        'terms' => $categories,
                        'include_children' => true,
                    )
                ),
                'posts_per_page' => -1,
            );
        }

        if (!empty($slider_order)) {
            $args['order'] = $slider_order;
        }

        if (!empty($slider_orderby)) {
            $args['orderby'] = $slider_orderby;
        }

        return $args;
    }

    /**
     * The default query args to use
     * @return array
     */
    function get_default_slider_query_args()
    {
        return array(
            'post_type' => $this->slide_custom_post_type_name,
            'posts_per_page' => -1,
            'orderby' => 'menu_order'
        );
    }

    function get_data_height_attrs()
    {
        global $post;

        $dheight = get_post_meta($post->ID, '_prime_desktop_height', true);
        $theight = get_post_meta($post->ID, '_prime_tablet_height', true);
        $mlheight = get_post_meta($post->ID, '_prime_mobile_landscape_height', true);
        $mpheight = get_post_meta($post->ID, '_prime_mobile_portrait_height', true);

        $dheight = empty($dheight) ? 400 : $dheight;
        $theight = empty($theight) ? 400 : $theight;
        $mlheight = empty($mlheight) ? 400 : $mlheight;
        $mpheight = empty($mpheight) ? 400 : $mpheight;


        $attrs = 'data-prime-desktop-height="%s" data-prime-tablet-height="%s"
        data-prime-mobile-landscape-height="%s" data-prime-mobile-portrait-height="%s"';

        return sprintf($attrs, $dheight, $theight, $mlheight, $mpheight);
    }

}

