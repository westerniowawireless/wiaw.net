<?php

/*
 * Use an action for the_excerpt to make the system more modular
 */
function shoestrap_do_the_excerpt() {
  the_excerpt();
}
add_action( 'shoestrap_the_excerpt', 'shoestrap_do_the_excerpt' );

/*
 * The main content template for posts
 */
function shoestrap_article_content_action() { ?>
  <article <?php post_class(); ?>>
    <header>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-summary">
      <?php do_action( 'shoestrap_entry_summary_begin' ); ?>
      <?php do_action( 'shoestrap_the_excerpt' ); ?>
      <?php do_action( 'shoestrap_entry_summary_end' ); ?>
    </div>
    <footer>
      <?do_action( 'shoestrap_post_footer' ); ?>
    </footer>
  </article>
  <?php
}
add_action( 'shoestrap_article_content', 'shoestrap_article_content_action', 10 );


/*
 * The metadata template
 */
function shoestrap_article_metadata() { ?>
  <p class="byline author vcard"><?php echo __( 'By', 'shoestrap' ); ?>
    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a>
  </p>
  <div class="row-fluid">
    <div class="span4">
      <i class="time-icon icon-time-alt"></i>
      <time class="updated" datetime="<?php echo get_the_time( 'c' ); ?>" pubdate><?php echo get_the_date(); ?></time>
    </div>
    <div class="span4">
      <?php if ( has_tag() ) { ?>
        <i class="icon-tags"></i>
        <?php the_tags(''); ?>
      <?php } ?>
    </div>
    <div class="span4">
      <?php if ( get_comments_number() >= 1 ) { ?>
        <i class="icon-comment"></i>
        <?php comments_number(); ?>
      <?php } ?>
    </div>
  </div>
  <?php
}
add_action( 'shoestrap_do_metadata', 'shoestrap_article_metadata', 10 );
