<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part( 'templates/entry-meta' ); ?>
    </header>
    <div class="entry-content">
      <?php do_action( 'shoestrap_before_the_content' ); ?>
      <?php the_content(); ?>
      <?php do_action( 'shoestrap_after_the_content' ); ?>
    </div>
    <footer>
      <?php wp_link_pages( array( 'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'shoestrap' ), 'after' => '</p></nav>' ) ); ?>
      <?php the_tags( '<i class="icon-tags"></i>',', ','' ); ?>
    </footer>
    <?php comments_template( '/templates/comments.php' ); ?>
  </article>
<?php endwhile;