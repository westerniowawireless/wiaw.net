<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
<?php roots_post_before(); ?>
<?php global $FRONTEND_STRINGS; ?>


<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <?php roots_post_inside_before(); ?>
    <div class="post">
        <h1 class="post-title"><?php the_title() ?></h1>
	    <p class="post-meta">
			<span class="categories"><?php the_category(' '); ?></span>
			<span class="spacer spacer-first">//</span>
			<span class="author icon-user"><?php the_author_link(); ?></span>
			<span class="spacer">//</span>
			<span class="date icon-calendar"><?php the_time(get_option('date_format'));?></span>
			<span class="spacer spacer-last">//</span>
			<span class="comment-count icon-comment"><?php comments_number($FRONTEND_STRINGS['no_comments_meta'], $FRONTEND_STRINGS['one_comment_meta'], $FRONTEND_STRINGS['x_comments_meta']); ?></span>
		</p>
        <?php prime_image(array('id' => get_the_ID(), 'width' => 596, 'height' => 300, 'class' => 'post-image')); ?>

        <div class="post-content">
            <?php the_content(); ?>
        </div>
    </div>
    <!-- .post -->
    <?php roots_post_inside_after(); ?>
</article>
<?php comments_template(); ?>
<?php roots_post_after(); ?>
<?php endwhile; // End the loop ?>
