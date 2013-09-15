<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
<div class="notice">
    <p class="bottom"><?php global $FRONTEND_STRINGS; echo $FRONTEND_STRINGS['no_results']; ?></p>
</div>
<?php get_search_form(); ?>
<?php endif; ?>

<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
<?php roots_post_before(); ?>
<?php global $FRONTEND_STRINGS; ?>

<div id="post-<?php the_ID(); ?>" class="post-preview">
    <?php roots_post_inside_before(); ?>

    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <p class="post-meta">
		<span class="categories"><?php the_category(' '); ?></span>
		<span class="spacer spacer-first">//</span>
		<span class="author icon-user"><?php the_author_link(); ?></span>
		<span class="spacer">//</span>
		<span class="date icon-calendar"><?php the_time(get_option('date_format'));?></span>
		<span class="spacer spacer-last">//</span>
		<span class="comment-count icon-comment"><?php comments_number($FRONTEND_STRINGS['no_comments_meta'], $FRONTEND_STRINGS['one_comment_meta'], $FRONTEND_STRINGS['x_comments_meta']); ?></span>
	</p>
    <?php
    prime_render_preview_image(array(
        'before'=> sprintf('<a class="image-link" href="%s">', get_permalink()),
                           'after' => '</a>',
        'width' => 596, 'height' => 300, 'class' => 'post-image', 'img_dimension_attrs' => true))
    ?>
    <div class="post-content">

        <?php prime_archive_excerpt(); ?>

        <p class="read-more-link"><a href="<?php the_permalink(); ?>"><?php echo $FRONTEND_STRINGS['read_more'];?></a>
        </p>

    </div>
    <div class="clear"></div>

    <?php roots_post_inside_after();    ?>
</div>

<?php roots_post_after(); ?>

<?php echo do_shortcode('[divider]'); ?>

<?php endwhile; // End the loop ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ($wp_query->max_num_pages > 1) : ?>
<div class="paginators">

    <?php prime_pagination(); ?>

</div>
<div class="clear"></div>

<?php endif; ?>
