<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
<?php roots_post_before(); ?>



<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <?php roots_post_inside_before(); ?>
    <div class="post portfolio-item">

        <?php // prime_image(array('id' => get_the_ID(), 'width' => 940, 'class' => 'post-image')); ?>

        <div class="post-content">
            <?php the_content(); ?>
        </div>

    </div>
    <!-- .post -->
    <?php roots_post_inside_after(); ?>
</article>
<?php roots_post_after(); ?>
<?php endwhile; // End the loop ?>
