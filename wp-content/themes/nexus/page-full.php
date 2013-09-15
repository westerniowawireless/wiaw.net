<?php
/*
Template Name: Full Width
*/
get_header(); ?>
<?php roots_content_before(); ?>

<?php roots_main_before(); ?>
<div class="main <?php $prime_frontend->slider_classes(); ?>" role="main">
	<div class="subheader-wrapper">
	    <div class="container_12">
	        <div class="grid_12">
	            <div id="subheader">
                    <?php
                    global $post;
                    global $prime_frontend;
                    $prime_frontend->prime_title_and_subtitle();
                    ?>
	            </div>
	        </div>
	    </div>
		<div class="clear"></div>
	</div>
    <div class="clear"></div>

    <div class="row-fluid clearfix">
        <div class="intro">
            <?php $prime_frontend->prime_page_intro(); ?>
        </div>
    </div>

	<div class="content-wrapper">
		<div class="overlay-divider"></div>
	    <div class="row-fluid clearfix page-container">
	        <div class="span12">
	            <!--PAGE CONTENT-->
	            <div class="prime-page prime-full-width">
	                <?php roots_loop_before(); ?>
	                <?php get_template_part('loop', 'page'); ?>
	                <?php roots_loop_after(); ?>
	            </div>
	            <div class="clear"></div>
	        </div>
	    </div>
	</div>
	<?php get_footer(); ?>
</div><!-- /.main -->
<?php roots_main_after(); ?>
<?php roots_content_after(); ?>

