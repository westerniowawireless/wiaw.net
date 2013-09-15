<?php  /* If there are no posts to display, such as an empty archive page */
global $FRONTEND_STRINGS;
?>
<?php if (!have_posts()) : ?>
<div class="notice">
    <p class="bottom"><?php echo $FRONTEND_STRINGS['no_results']; ?></p>
</div>
<?php get_search_form(); ?>
<?php endif; ?>

<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
<?php roots_post_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php roots_post_inside_before(); ?>
    <header>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php roots_entry_meta(); ?>
    </header>
    <div class="entry-content">
        <?php
        prime_archive_excerpt();
        ?>
    </div>
    <footer>
        <?php $tag = get_the_tags(); if (!$tag) {
    } else {
        ?><p><?php the_tags(); ?></p><?php } ?>
    </footer>
    <?php roots_post_inside_after(); ?>
</article>
<?php roots_post_after(); ?>
<?php endwhile; // End the loop ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ($wp_query->max_num_pages > 1) : ?>
<nav id="post-nav">
    <div class="post-previous"><?php next_posts_link($FRONTEND_STRINGS['older_posts']); ?></div>
    <div class="post-next"><?php previous_posts_link($FRONTEND_STRINGS['newer_posts']); ?></div>
</nav>
<?php endif; ?>
