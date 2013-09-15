<?php

class PrimeEmbedWidget extends WP_Widget
{
    var $prime_widget_cssclass;
    var $prime_widget_description;
    var $prime_widget_idbase;
    var $prime_widget_title;

    function PrimeEmbedWidget()
    {
        global $FRONTEND_STRINGS;
        /* Widget variable settings. */
        $this->prime_widget_cssclass = 'widget_prime_embed';
        $this->prime_widget_description = $FRONTEND_STRINGS['embed_widget_desc'];
        $this->prime_widget_idbase = 'prime_embed';
        $this->prime_widget_title = $FRONTEND_STRINGS['embed_widget_title'];

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

        $width = sprintf(' width="%s" ', $width);
        $height = sprintf(' height="%s" ', $height);

        //call the embed

        $shortcode = sprintf('[video src="%s" width="%s" height="%s"]', $url, $width, $height);
        echo do_shortcode($shortcode);

        ?>
    <div class="embed-widget-text">
        <?php echo isset($instance['filter']) ? wpautop($text) : $text; ?>
    </div>
    <?php

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
            'title' => $FRONTEND_STRINGS['embed_default_title'],
            'url' => '',
            'width' => 300,
            'height' => 200
        );

        $instance = wp_parse_args((array)$instance, $defaults);
        $instance['title'] = strip_tags($instance['title']);
        $instance['url'] = esc_url_raw(strip_tags($instance['url']));

        //        $instance['filter'] = isset($instance['filter']);

        if (current_user_can('unfiltered_html'))
            $instance['text'] = isset($instance['text']) ? $instance['text'] : '';
        else
            $instance['text'] = stripslashes(wp_filter_post_kses(addslashes($instance['text']))); // wp_filter_post_kses() expects slashed


        foreach (array('width', 'height') as $setting) {
            $instance[$setting] = absint($instance[$setting]);
            if ($instance[$setting] < 1)
                $instance[$setting] = $defaults[$setting];
        }

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
        <label for="<?php echo $this->get_field_id('url'); ?>"><?php echo $FRONTEND_STRINGS['url_option'] ?></label>
        <input type="text" name="<?php echo $this->get_field_name('url'); ?>"
               value="<?php echo $instance['url']; ?>" class="widefat"
               id="<?php echo $this->get_field_id('url'); ?>"/>
    </p>
    <p style="display: none; visibility: collapse;">
        <label for="<?php echo $this->get_field_id('width'); ?>"><?php echo $FRONTEND_STRINGS['size_option']; ?></label>
        <input type="text" size="2" name="<?php echo $this->get_field_name('width'); ?>"
               value="<?php echo esc_attr($width); ?>" class="" id="<?php echo $this->get_field_id('width'); ?>"/>
        <?php echo $FRONTEND_STRINGS['size_by_marker'] ?>
        <input type="text" size="2" name="<?php echo $this->get_field_name('height'); ?>"
               value="<?php echo esc_attr($height); ?>" class=""
               id="<?php echo $this->get_field_id('height'); ?>"/>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('text'); ?>"><?php echo $FRONTEND_STRINGS['text_option']; ?></label>
        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>"
                  name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
    </p>
    <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>"
              type="checkbox" <?php if (isset($instance['filter'])) echo 'checked'; ?> />&nbsp;<label
            for="<?php echo $this->get_field_id('filter'); ?>"><?php echo $FRONTEND_STRINGS['embed_autop']; ?></label>
    </p>
    <?php

    } // End form()
}

add_action('widgets_init', create_function('', 'return register_widget("PrimeEmbedWidget");'), 1);
