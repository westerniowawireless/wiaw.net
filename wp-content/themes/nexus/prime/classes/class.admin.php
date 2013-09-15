<?php

class PrimeAdmin
{
    private $theme_name;
    private $theme_version;
    private $theme_lc_name;

    private $activation_key;
    private $activation_hook_name;
    private $deactivation_hook_name;

    private $version_key;

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    * CONSTRUCTOR
    * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    */

    function PrimeAdmin()
    {
        $this->__construct();
    }

    function __construct()
    {
        // Setup for PrimeAdmin
        $this->theme_name = PRIME_THEME_NAME;
        $this->theme_version = PRIME_THEME_VERSION;

        $this->theme_lc_name = strtolower($this->theme_name);

        $this->activation_key = sprintf('theme_is_activated_%s', $this->theme_name);
        $this->activation_hook_name = 'prime_theme_activated';
        $this->deactivation_hook_name = 'prime_theme_deactivated';

        $this->version_key = sprintf('%s_version', $this->theme_lc_name);

        // Due to wordpress core implementation this hook can only be received by
        //currently active theme (which is going to be deactivated as admin has chosen another one.
        // Your theme can perceive this hook as a deactivation hook.)
        add_action('switch_theme', array($this, 'theme_deactivate'));

        add_action('widgets_init', array($this, 'register_sidebars'));

        add_action('admin_menu', array($this, 'post_options_add_metabox'));
        add_action('admin_menu', array($this, 'options_save_metabox'));

        add_action('admin_enqueue_scripts', array($this, 'enqueue_media_resources'));

    }

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    * ACTIVATION AND DEACTIVATION
    * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    */

    /*
     * Check for if the theme needs to be activated. If the theme needs to be activated,
     * trigger prime_theme_activated action.
     */
    function theme_activate()
    {
        // based off http://www.krishnakantsharma.com/2011/01/activationdeactivation-hook-for-wordpress-theme/
        // We check if the theme activation key has been set in options yet. If it isn't, then the theme
        // hasn't been activated.
        if (!get_option($this->activation_key)) {
            //trigger register activation callbacks
            do_action($this->activation_hook_name);
            //update options so that we can keep track of versioning
            //and activation
            update_option($this->activation_key, 1);
            update_option($this->version_key, $this->theme_version);
        }
    }

    /*
     * Is used as a callback for WordPress switch_theme hook.
     */
    function theme_deactivate()
    {
        do_action($this->deactivation_hook_name);
        //We remove the option so that if the theme gets activated
        //again, it will trigger activation

        delete_option($this->activation_key);
        delete_option($this->version_key);
    }

    function add_activation_action($func)
    {
        add_action($this->activation_hook_name, $func);
    }

    function add_deactivation_action($func)
    {
        add_action($this->deactivation_hook_name, $func);
    }

    function register_sidebars()
    {
        $option_tree = get_option(PRIME_OPTIONS_KEY);
        $sidebars = isset($option_tree['unlimited_sidebar_slider']) ? $option_tree['unlimited_sidebar_slider']
            : array();
        $count = 1;
        foreach ($sidebars as $s) {
            $name = $s['title'];
            $desc = $s['sidebar_description'];
            $id = $s['id'];
            register_sidebar(
                array(
                    'id' => $id,
                    'name' => $name,
                    'description' => $desc,
                    'before_widget' => '<div class="divider sidebar-divider" style=""></div><div class="clear"></div><article id="%1$s" class="widget %2$s"><div class="container sidebar-widget">',
                    'after_widget' => '</div></article>',
                    'before_title' => '<h3>',
                    'after_title' => '</h3>'
                ));
            $count++;
        }
    }


    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    * POST META OPTIONS METABOX
    * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    */

    /**
     * This is a callback that is hooked to 'admin_menu' in the constructor. It adds the metaboxes to the
     * post, page, and custom post type edit pages.
     * @return void
     */
    function post_options_add_metabox()
    {
        $this->add_options_metabox('post');
        $this->add_options_metabox('page');
        $this->add_options_metabox('portfolio');
        $this->add_options_metabox('flex_slide');
        $this->add_options_metabox('content_slide');
        $this->add_options_metabox('cp_slide');

    }

    /**
     * A helper method used by $this->post_options_add_metabox() in order to add metaboxes
     * @param string $post_type the post type to add the metabox to
     * @return void
     */
    function add_options_metabox($post_type)
    {
        global $FRONTEND_STRINGS;


        $settings = array(
            'id' => 'prime-settings',
            'title' => $FRONTEND_STRINGS['custom_settings'],
            'callback' => array($this, 'options_render_metabox'),
            'priority' => 'normal',
            'callback_args' => ''
        );

        add_meta_box($settings['id'], $settings['title'], $settings['callback'],
            $post_type, $settings['priority'], $settings['callback_args']);
    }

    /**
     * A callback that is hooked up to the add_metabox calls done by $this->post_options_add_metabox. This method is
     * in charge of rendering the options metabox. It retrieves the options schema from the
     * prime_get_options_schema_factory($post_type). The prime_get_options_schema_factory is in charge of returning
     * the correct options schema on the basis of the post_type. See /prime/options.php for the declaration.
     * @param $post
     * @param $pt_array
     * @return void
     */
    function options_render_metabox($post, $pt_array)
    {

        ?>

    <div class="post-meta-options">
        <div style="display:block;" id="option_general_default"
             class="block ui-tabs-panel ui-widget-content ui-corner-bottom">

            <?php


            global $post;
            $post_id = $post->ID;


            $post_type = get_post_type($post_id);
            $pt_array = prime_get_options_schema_factory($post_type)->get_schema_object();


            $settings = array(); //this will be the settings we get from the Post Meta

            // set count
            $count = 0;
            // loop options & load corresponding function
            foreach ($pt_array as $value) {
                $settings[$value->item_id] = get_post_meta($post_id, $value->item_id, true);
                $count++;
                if ($value->item_type == 'upload' || $value->item_type == 'background' || $value->item_type == 'slider') {
                    $int = $post_id;
                } else if ($value->item_type == 'textarea' || $value->item_type == 'css') {
                    $int = (is_numeric(trim($value->item_options))) ? trim($value->item_options)
                        : ($value->item_type == 'css' ? 24 : 8);
                }
                else {
                    $int = $count;
                }

                //prevent uninitialized string offset errors with empty backgrounds.
                if ($value->item_type == 'background') {
                    if (!isset($settings[$value->item_id]['background-attachment'])) {
                        $settings[$value->item_id]['background-attachment'] = '';
                    }

                    if (!isset($settings[$value->item_id]['background-repeat'])) {
                        $settings[$value->item_id]['background-repeat'] = '';
                    }

                    if (!isset($settings[$value->item_id]['background-position'])) {
                        $settings[$value->item_id]['background-position'] = '';
                    }
                }

                call_user_func_array('prime_options_option_tree_' . $value->item_type, array($value, $settings, $int));
            }
            ?>
            <div class="clear"></div>
        </div>
    </div>
    <?php

    }


    /**
     * Callback that's hooked to admin_menu in the constructor. This method is responsible for updating the post_meta
     * on the basis of the values based to it through $_POST.
     * @param $allowed_post_type
     * @return
     */
    function options_save_metabox($allowed_post_type)
    {
        $pID = '';
        global $globals, $post;

        // Sanitize post ID.

        if (isset($_POST['post_ID'])) {

            $pID = intval($_POST['post_ID']);

        } // End IF Statement

        // Don't continue if we don't have a valid post ID.

        if ($pID == 0) {

            return;

        } // End IF Statement


        if (isset($_POST['action']) && ($_POST['action'] == 'editpost' || $_POST['action'] == 'edit')) {

            $post_type = get_post_type($pID);
            $pt_array = prime_get_options_schema_factory($post_type)->get_schema_object();

            $settings = NULL; //this will be the settings we get from the Post Meta

            // set count
            $count = 0;
            // loop options check for value and save it to post meta
            foreach ($pt_array as $value) {
                $var = $value->item_id;

                $posted_value = isset($_POST[$var]) ? $_POST[$var] : NULL;
                $current_value = get_post_meta($pID, $var, true);
                if (isset($_POST[$value->item_id])) {
                    update_post_meta($pID, $var, $posted_value);
                } elseif (!isset($_POST[$var]) && $value->item_type == 'checkbox') {
                    update_post_meta($pID, $var, 'false');

                } else {
                    delete_post_meta($pID, $var, $current_value); // Deletes check boxes OR no $_POST
                }
            }
        }

    }

    /*
     * OptionTree only loads its CSS/JS resources on OptionTree pages, so we check if
     * we're working with a post type with post meta options and call option_tree_load
     * if we need to have the CSS/JS because we're calling option_tree_* for the frontend
     */
    function enqueue_media_resources($hook)
    {
        $post_type = get_post_type();

        if (is_prime_admin_options_page()) {
            global $po_admin;
            $po_admin->option_tree_load();

            wp_enqueue_script('jquery-prime-option-admin', PRIME_THEME_ROOT_URI . '/prime/js/prime-admin.js',
                array('jquery', 'jquery-prime-plugin-base'));

            /**
             * Use wp_localize_script in order to writeout the flex sliders to JS for
             * usage by the SC-GEN
             */
            $options = get_option(PRIME_OPTIONS_KEY);

            $content_categories = &get_categories(array('hide_empty' => false, 'taxonomy' => 'content_slide_category'));
            $cp_categories = &get_categories(array('hide_empty' => false, 'taxonomy' => 'cp_slide_category'));
            $flex_categories = &get_categories(array('hide_empty' => false, 'taxonomy' => 'flex_slide_category'));

            $portfolio_categories = &get_categories(array('hide_empty' => false, 'taxonomy' => 'portfolio_category'));
            $post_categories = &get_categories(array('hide_empty' => false, 'taxonomy' => 'category'));

            $sc_gen_vars = array(
                'prime_framework_url' => PRIME_THEME_ROOT_URI . '/prime/',
                'fonts' => '',
                'content_slide_categories' => $content_categories,
                'cp_slide_categories' => $cp_categories,
                'flex_slide_categories' => $flex_categories,
                'portfolio_categories' => $portfolio_categories,
                'post_categories' => $post_categories
            );

            wp_localize_script('jquery-prime-option-admin', 'PrimeSCGen', $sc_gen_vars);
        }
    }
}

//Override the default Option Tree fields for the slide option type.
add_filter('image_slider_fields', 'new_slider_fields', 10, 2);