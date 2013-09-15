<?php
/*
Template Name: Page with Left Sidebar
*/
?>
<?php get_header(); ?>
<?php roots_content_before(); ?>

<?php roots_main_before(); ?>
<div class="main has-sidebar left-sidebar <?php $prime_frontend->slider_classes(); ?>" role="main">

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

    <div class="row-fluid clearfix">
        <div class="intro">
            <?php $prime_frontend->prime_page_intro(); ?>
        </div>
    </div>

	<div class="content-wrapper">
		<div class="overlay-divider"></div>

	    <div class="row-fluid clearfix page-container">
	        <?php roots_sidebar_before(); ?>
			<div class="sidebar-wrapper span4">
		        <div id="sidebar" class=" sidebar-left">
		            <?php roots_sidebar_inside_before(); ?>

		            <?php get_sidebar(); ?>

		            <?php roots_sidebar_inside_after(); ?>
		        </div>
			</div>

	        <!-- /#sidebar -->
	        <?php roots_sidebar_after(); ?>

	        <div class="span8" >
	            <!--PAGE CONTENT-->
	            <div class="prime-page">
	                <?php roots_loop_before(); ?>
	                <?php get_template_part('loop', 'page'); ?>
	                <?php roots_loop_after(); ?>
	            </div>

	        </div>

			<div class="right-sidebar-wrapper sidebar-wrapper span4">
	        <?php roots_sidebar_before(); ?>
		        <div id="sidebar" class=" sidebar-left">
		            <?php // roots_sidebar_inside_before(); ?>
					<?php include( TEMPLATEPATH . '/sidebar.php'); ?>
		            <?php get_sidebar(); ?>

		            <?php roots_sidebar_inside_after(); ?>
		        </div>
	        <!-- /#sidebar -->
	        <?php roots_sidebar_after(); ?>
			
			</div>

	    </div>

	</div>
    <?php get_footer(); ?>
</div><!-- /.main -->
<?php roots_main_after(); ?>
<?php roots_content_after(); ?>

