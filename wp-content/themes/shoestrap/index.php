<?php get_template_part( 'templates/page', 'header' ); ?>

<?php do_action( 'shoestrap_index_begin' ); ?>
<?php if ( !have_posts() ) : ?>
  <div class="alert">
    <?php _e( 'Sorry, no results were found.', 'shoestrap' ); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>
  <?php do_action( 'shoestrap_in_loop_start_action' ); ?>
  <?php get_template_part( 'templates/content', get_post_format() ); ?>
<?php endwhile; ?>

<?php if ( $wp_query -> max_num_pages > 1 ) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link( __( '&larr; Older posts', 'shoestrap' ) ); ?></li>
      <li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'shoestrap' ) ); ?></li>
    </ul>
  </nav>
<?php endif; ?>

<?php do_action( 'shoestrap_index_end' ); ?>