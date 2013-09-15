<?php get_header(); ?>

<div class="sixteen columns ">
	<div class="intro">  
		<?php $intro = get_option('leon_intro'); echo stripslashes($intro); ?>
	</div>
</div>

<div id="homecontent">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="one-third column">

<article class="post" id="post-<?php the_ID(); ?>">

<?php
if ( has_post_thumbnail() ) { ?>
	<a href="<?php the_permalink() ?>"><img class="scale-with-grid" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=250&amp;w=450&amp;zc=1" alt=""/></a>
<?php } else { ?>
	<a href="<?php the_permalink() ?>"><img class="scale-with-grid" src="<?php bloginfo('template_directory'); ?>/images/dummy.jpg" alt="" /></a>
<?php } ?>

<div class="btitle">
	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
</div>
<hr class="remove-bottom">
<div class="postmeta">
		<span class="author"> <?php the_author(); ?> </span>
		<span class="clock"> <?php the_time('M - j - Y'); ?></span>
</div>
<hr class="remove-bottom remove-top">
<div class="boxentry">
<?php wpe_excerpt('wpe_excerptlength_index', ''); ?>
<div class="clear"></div>
</div>

</article>
</div>

<?php if(++$counter % 3 == 0) : ?>
<div class="clear"></div>
<?php endif; ?>
<?php endwhile; ?>
<div class="clear"></div>
<?php getpagenavi(); ?>

<?php else : ?>
		<h1 class="title">Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>
<?php endif; ?>
  
</div>

<?php get_footer(); ?>