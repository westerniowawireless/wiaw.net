<?php

class PrimeWorksWidget extends WP_Widget
{
    var $prime_widget_cssclass;
    var $prime_widget_description;
    var $prime_widget_idbase;
    var $prime_widget_title;

    function PrimeWorksWidget()
    {
        global $FRONTEND_STRINGS;
        /* Widget variable settings. */
        $this->prime_widget_cssclass = 'widget_prime_works';
        $this->prime_widget_description = $FRONTEND_STRINGS['works_widget_desc'];
        $this->prime_widget_idbase = 'prime_works';
        $this->prime_widget_title = $FRONTEND_STRINGS['works_widget_title'];

        /* Widget settings. */
        $widget_ops = array('classname' => $this->prime_widget_cssclass, 'description' => $this->prime_widget_description);

        /* Widget control settings. */
        $control_ops = array('width' => 250, 'height' => 350, 'id_base' => $this->prime_widget_idbase);

        /* Create the widget. */
        $this->WP_Widget($this->prime_widget_idbase, $this->prime_widget_title, $widget_ops, $control_ops);
    }

    /*
     * frontend display of the widget
     */
    function widget($args, $instance)
    {
        global $FRONTEND_STRINGS;
        extract($args);
        extract($instance);

        echo $before_widget;
        if ($title) {
            echo $before_title, $title, $after_title;
        }

        //show the works
        //        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $query_args = array(
            'post_type' => 'portfolio',
//            'paged' => $paged,
            'posts_per_page' => $limit,
            'orderby' => 'menu_order',
        );

        query_posts($query_args);

        if (have_posts()) {

            ?>
        <div id="latest-projects-slider">

            <a href="#" id="scrollview-prev" class="projects-paginator prev" title="Back"></a>
            <a href="#" id="scrollview-next" class="projects-paginator next" title="Forward"></a>

            <div id="scrollview-wrapper">
                <div class="slides_container yui3-scrollview-loading">
                    <ul class="latest-projects">
                        <?php
                        $count = 0;
                        while (have_posts()) {
                            the_post();
                            $subtitle = get_post_meta(get_the_ID(), '_prime_preview_caption', true);
                            $count++; ?>

                            <li class="slide">
                                <?php
                                global $post;
                                $permalink = get_permalink($post->ID);
                                ?>
                                <a href="<?php echo get_permalink($post->ID); ?>">
                                    <span class="overlay"></span>
                                <?php

                                    prime_render_preview_image();

                                    ?>
                                </a>

                                <div class="overlay <?php echo prime_portfolio_type_class(get_the_ID()); ?>">
                                    <h2><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></h2>

                                    <p><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $subtitle; ?></a>

                                    <p>
                                </div>
                            </li>

                                <?php

                        } // End WHILE Loop
                        ?>
                    </ul>
                </div>
            </div>
        </div>
                        <?php

        } else {
            ?>

        <div <?php post_class(); ?>>
            <p><?php global $FRONTEND_STRINGS; echo $FRONTEND_STRINGS['no_matching_posts']; ?></p>
        </div><!-- /.post -->
        <?php

        }

        wp_reset_query();


        echo $after_widget;
    }


    function update($new_instance, $old_instance)
    {
        return $this->enforce_default($new_instance);
    } // End update()

    function enforce_default($instance)
    {
        global $FRONTEND_STRINGS;
        /* Set up some default widget settings. */
        $defaults = array(
            'title' => $FRONTEND_STRINGS['works_default_title'],
            'limit' => 5
        );

        $instance = wp_parse_args((array)$instance, $defaults);
        $instance['title'] = strip_tags($instance['title']);
        $instance['limit'] = intval($instance['limit']);
        if ($instance['limit'] < 1)
            $instance['limit'] = 5;
        return $instance;
    }

    function form($instance)
    {
        global $FRONTEND_STRINGS;
        $instance = $this->enforce_default($instance);
        extract($instance);

        ?>
    <!-- Widget Title: Text Input -->
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo $FRONTEND_STRINGS['optional_title'] ?></label>
        <input type="text" name="<?php echo $this->get_field_name('title'); ?>"
               value="<?php echo $instance['title']; ?>" class="widefat"
               id="<?php echo $this->get_field_id('title'); ?>"/>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('limit'); ?>"><?php echo $FRONTEND_STRINGS['limit'] ?></label>
        <input type="text" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo esc_attr($limit); ?>"
               class="" size="3" id="<?php echo $this->get_field_id('limit'); ?>"/>
    </p>
    <?php

    } // End form()
}

add_action('widgets_init', create_function('', 'return register_widget("PrimeWorksWidget");'), 1);
