<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 3/23/12
 * Time: 10:08 AM
 * To change this template use File | Settings | File Templates.
 */

class PrimePortfolio
{
    function PrimePortfolio()
    {
        $this->__construct();
    }

    function __construct()
    {
        add_action('init', array($this, 'register_portfolio_item'), 5);
    }

    function render_html5_video($portfolio_id)
    {
        $pid = $portfolio_id;
        $m4v = get_post_meta($pid, '_prime_video_m4v_url', true);
        $ogv = get_post_meta($pid, '_prime_video_ogv_url', true);
        $webm = get_post_meta($pid, '_prime_video_webmv_url', true);

        //Get the resized poster.
        $poster = false;
        $thumb_id = get_post_meta($pid, '_thumbnail_id', true);
        if ($thumb_id) {
            $vt_crop = 'enable'; //get_option_tree('pis_hard_crop');
            if ($vt_crop == 'enable') $vt_crop = true; else $vt_crop = false;
            $vt_image = vt_resize($thumb_id, '', 656, 270, $vt_crop);
            $poster = $vt_image['url']; //url is the first entry
        }

        $data_m4v = !empty($m4v) ? sprintf('data-%s="%s"', 'm4v', $m4v) : $m4v;
        $data_ogv = !empty($ogv) ? sprintf('data-%s="%s"', 'ogv', $ogv) : $ogv;
        $data_webm = !empty($webm) ? sprintf('data-%s="%s"', 'webm', $webm) : $webm;
        $data_poster = !empty($poster) ? sprintf('data-%s="%s"', 'poster', $poster) : $poster;

        $data_swf = sprintf('data-swf="%s"', prime_jplayer_swf_url());
        $interface_id = uniqid('interface-');

        $data_interface_id = sprintf('data-%s="%s"', 'interface', $interface_id);
        ?>

        <div class="jquery-player-wrapper">
            <div class="native-video" style="display:none;position:relative;">
                <video style="width:100%;height:auto;opacity:0;"
                       poster="<?php echo $poster; ?>" controls="true">
                    <source src="<?php echo $m4v; ?>"
                            type="video/mp4"/>
                    <source src="<?php echo $ogv; ?>" type="video/ogg"/>
                    Your browser does not support the video tag.
                </video>
            </div>
        <div class="jp-jplayer jp-jplayer-video root-jplayer"
            <?php echo $data_m4v . ' ' . $data_ogv . ' ' . $data_webm . ' ' . $data_poster . ' ' . $data_interface_id . ' ' . $data_swf  ?>></div>
        <div style="display:none;" class="jp-video-container">
            <div class="jp-video">
                <div class="jp-type-single">
                    <div id="<?php echo $interface_id; ?>" class="jp-interface">
                        <ul class="jp-controls">
                            <li>
                                <div class="seperator-first"></div>
                            </li>
                            <li>
                                <div class="seperator-second"></div>
                            </li>
                            <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                            <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                            <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                            <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                        </ul>
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                        <div class="jp-volume-bar-container">
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

    }

    function render_filter_list_item($f)
    {
        ?>
        <li>
            <div data-filter='article[data-filters*="<?php echo $f->slug; ?>"]'><?php echo $f->name; ?></div>
        </li>
        <?php

    }

    function render_all_filter_list_item()
    {
        ?>
        <li>
            <div class="current" data-filter="*"><?php echo get_portfolio_all_filter_text(); ?></div>
        </li>
        <?php

    }

    function render_portfolio_shuffle()
    {
        ?>
        <li>
            <a id="portfolio-shuffle" title="Shuffle"><span
                    id="portfolio-shuffle-canvas"></span><?php echo get_portfolio_shuffle_text(); ?>
            </a>
        </li>
    <?php

    }

    /**
     * Gets the portfolio items associated through categories specified for a given
     * portfolio instance in the Theme Options.
     * @param $page_id
     * @return void
     */
    function get_portfolio_item_args_for($page_id)
    {
        $portfolio_instance = get_option(PRIME_OPTIONS_KEY);
        $this_portfolio = NULL;
        $categories = NULL;
        foreach ($portfolio_instance['portfolio_instance_slider'] as $p) {
            if ($p['portfolio_page'] == $page_id) {
                $this_portfolio = $p;
                $categories = isset($p['portfolio_categories']) ? $p['portfolio_categories'] : NULL;
                break;
            }
        }

        $args = NULL;
        if ($categories) {
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'portfolio_category',
                        'field' => 'id',
                        'terms' => array_values($categories),
                        'include_children' => true,
                    )
                ),
                'posts_per_page' => -1,
            );
        }

        if ($args == NULL) {
            $args = $this->get_default_portfolio_query_args();
        }

        if (isset($this_portfolio['portfolio_order']) && !empty($this_portfolio['portfolio_order'])) {
            $args['order'] = $this_portfolio['portfolio_order'];
        }

        if (isset($this_portfolio['portfolio_orderby']) && !empty($this_portfolio['portfolio_orderby'])) {
            $args['orderby'] = $this_portfolio['portfolio_orderby'];
        }

        return $args;
    }

    function get_portfolio_options($page_id)
    {
        $portfolio_instance = get_option(PRIME_OPTIONS_KEY);
        $categories = NULL;
        foreach ($portfolio_instance['portfolio_instance_slider'] as $p) {
            if ($p['portfolio_page'] == $page_id) {
                return $p;
                break;
            }
        }
    }


    function get_default_portfolio_query_args()
    {
        return array(
            'post_type' => 'portfolio',
            'orderby' => 'menu_order',
            'posts_per_page' => -1
        );
    }

    function get_portfolio_type($pid)
    {
        $portfolio_type = get_post_meta($pid, '_prime_portfolio_item_type', true);

        switch ($portfolio_type) {
            case 'Featured Image':
                return 'IMAGE';
                break;
            case 'Embedded Video':
                return 'EMBED';
                break;
            case 'Gallery':
                return 'GALLERY';
                break;
            default:
                return 'IMAGE';
        }
    }

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    * CUSTOM POST TYPES
    * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    */

    function register_portfolio_filter_taxonomy()
    {
        global $FRONTEND_STRINGS;
        // Add new taxonomy, NOT hierarchical (like tags)
        $labels = $FRONTEND_STRINGS['portfolio_filter_labels'];

        register_taxonomy(
            'portfolio_filter',
            'portfolio',
            array(
                 'hierarchical' => false,
                 'labels' => $labels,
                 'show_ui' => true,
                 'update_count_callback' => '_update_post_term_count',
                 'query_var' => true,
                 'show_in_nav_menus' => false
            ));
    }

    function register_portfolio_category_taxonomy()
    {
        global $FRONTEND_STRINGS;
        // Add new taxonomy, hierarchical (like Category)
        $labels = $FRONTEND_STRINGS['portfolio_category_labels'];

        register_taxonomy(
            'portfolio_category',
            'portfolio',
            array(
                 'hierarchical' => true,
                 'labels' => $labels,
                 'show_ui' => true,
                 'update_count_callback' => '_update_post_term_count',
                 'query_var' => true,
                 'show_in_nav_menus' => false
            ));
    }



    function register_portfolio_item()
    {
        $this->register_portfolio_filter_taxonomy();
        $this->register_portfolio_category_taxonomy();

        // "Portfolio Item" Custom Post Type
        global $FRONTEND_STRINGS;
        $labels = $FRONTEND_STRINGS['portfolio_item_labels'];

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
            'rewrite' => array('slug' => 'items', 'with_front' => false),
            'supports' => array('title', 'excerpt', 'editor', 'page-attributes', 'thumbnail'),
            'taxonomies' => array('portfolio_filter')
        );

        register_post_type('portfolio', $args);
    }
}

