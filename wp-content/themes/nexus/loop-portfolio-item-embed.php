<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
<?php roots_post_before(); ?>



<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <?php roots_post_inside_before(); ?>
    <div class="post portfolio-item">

        <?php
            /*
             * Use WP_Embed in order to construct the embed.
             */
        $pid = get_the_ID();
        $embed_url = get_post_meta($pid, '_prime_video_embed_url', true);

        $shortcode = sprintf('[video src="%s" width="%s" height="%s"]', $embed_url, 940, 627);
//        echo do_shortcode($shortcode);
        ?>

        <div class="post-content">
            <?php the_content(); ?>
        </div>
    </div>
    <!-- .post -->
    <?php roots_post_inside_after(); ?>
</article>
<?php roots_post_after(); ?>
<?php endwhile; // End the loop ?>
