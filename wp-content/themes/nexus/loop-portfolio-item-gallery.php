<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
<?php roots_post_before(); ?>



<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <?php roots_post_inside_before(); ?>
    <div class="post portfolio-item">

        <?php
                        $chosen_slider_id = get_post_meta($post->ID, '_prime_flex_slider_choice', true);
        if (!empty($chosen_slider_id)) {
            $options = get_option(PRIME_OPTIONS_KEY);
            $sliders = $options['flexslider_slider'];
            $this_slider = NULL;
            foreach ($sliders as $s) {
                if ($s['id'] == $chosen_slider_id) {
                    $this_slider = $s;
                    break;
                }
            }

//            echo do_shortcode(sprintf('[flex_slider slider="%s"]', $s['title']));
        }
        ?>

        <div class="post-content">
            <?php the_content(); ?>
        </div>
    </div>
    <!-- .post -->
    <?php roots_post_inside_after(); ?>
</article>
<?php roots_post_after(); ?>
<?php endwhile; // End the loop
?>
