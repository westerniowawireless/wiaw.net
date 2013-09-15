<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
  <?php roots_post_before(); ?>
    <?php roots_post_inside_before(); ?>
      <?php the_content(); ?>
      <?php global $FRONTEND_STRINGS; wp_link_pages(array('before' => '<nav id="page-nav"><p>' . $FRONTEND_STRINGS['pages'], 'after' => '</p></nav>' )); ?>
    <?php roots_post_inside_after(); ?>
  <?php roots_post_after(); ?>
<?php //comments_template(); ?>
<?php endwhile; // End the loop ?>
