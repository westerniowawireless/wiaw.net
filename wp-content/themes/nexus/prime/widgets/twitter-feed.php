<?php

class PrimeTwitterWidget extends WP_Widget
{
    var $prime_widget_cssclass;
    var $prime_widget_description;
    var $prime_widget_idbase;
    var $prime_widget_title;

    function PrimeTwitterWidget()
    {
        global $FRONTEND_STRINGS;
        /* Widget variable settings. */
        $this->prime_widget_cssclass = 'widget_prime_twitter';
        $this->prime_widget_description = $FRONTEND_STRINGS['twitter_widget_desc'];
        $this->prime_widget_idbase = 'prime_twitter';
        $this->prime_widget_title = $FRONTEND_STRINGS['twitter_widget_title'];

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
        $theme_options = get_option(PRIME_OPTIONS_KEY);

        echo $before_widget;
        if ($title) {
            echo $before_title, $title, $after_title;
        }

        if (isset($theme_options['prime_twitter_usr']) && $theme_options['prime_twitter_usr'] != '') {
            $usr = $theme_options['prime_twitter_usr'];
            printf('<div class="twitter-feed" data-usr="%s" data-count="%s"></div>', $usr, $limit);
        }

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
            'title' => $FRONTEND_STRINGS['twitter_default_title'],
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

add_action('widgets_init', create_function('', 'return register_widget("PrimeTwitterWidget");'), 1);
