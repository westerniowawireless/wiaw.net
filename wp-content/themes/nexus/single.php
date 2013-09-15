<?php get_header(); ?>
<?php roots_content_before(); ?>

<?php roots_main_before(); ?>
<div class="main has-sidebar" role="main">
    <div class="subheader-wrapper">
        <div class="container_12">
            <div class="grid_12">
                <div id="subheader">
                    <?php
                    global $post;
                    global $prime_frontend;
                    $prime_frontend->prime_blog_title_and_subtitle();
                    ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <div class="content-wrapper">
        <div class="overlay-divider"></div>
        <div class="clearfix page-container row-fluid">
            <div class="span8">
                <!--PAGE CONTENT-->
                <div class="prime-page">
                    <?php roots_loop_before(); ?>
                    <?php get_template_part('loop', 'single'); ?>
                    <?php roots_loop_after(); ?>
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
