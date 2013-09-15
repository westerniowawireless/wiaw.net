<?php get_header(); ?>
<?php roots_content_before(); ?>

<?php roots_main_before(); ?>
<div class="main has-sidebar" role="main">

    <div class="subheader-wrapper">
        <div class="container_12">
            <div class="grid_12">
                <div id="subheader">
                    <h1><?php global $FRONTEND_STRINGS; echo $FRONTEND_STRINGS['search_results']; ?>
                        "<?php echo get_search_query(); ?>"</h1>

                    <h2><?php echo get_prime_options('prime_search_subtitle'); ?></h2>

                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>



    <div class="content-wrapper">
        <div class="overlay-divider"></div>
        <div class="clearfix page-container row-fluid">
            <div class="span8">
                <div class="prime-page">
                    <!--PAGE CONTENT-->
                    <?php get_template_part('loop', 'index'); ?>
                </div>
            </div>
            <?php roots_sidebar_before(); ?>
            <div class="span4 sidebar-wrapper">
                <div id="sidebar">

                    <?php roots_sidebar_inside_before(); ?>

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

