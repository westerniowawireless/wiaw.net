<?php get_header(); ?>
<?php roots_content_before();
global $FRONTEND_STRINGS ?>

<?php roots_main_before(); ?>
<div class="main has-sidebar" role="main">

    <div class="subheader-wrapper">
        <div class="container_12">
            <div class="grid_12">
                <div id="subheader">
                    <?php if (is_day()) : ?>
                    <?php echo '<h1>' . $FRONTEND_STRINGS['daily_archive'] . '</h1><h2>' . get_the_date() . '</h2>'; ?>
                    <?php elseif (is_month()) : ?>
                    <?php echo '<h1>' . $FRONTEND_STRINGS['monthly_archive'] . '</h1><h2>' . get_the_date('F Y') . '</h2>'; ?>
                    <?php  elseif (is_year()) : ?>
                    <?php echo '<h1>' . $FRONTEND_STRINGS['yearly_archive'] . '</h1><h2>' . get_the_date('Y') . '</h2>'; ?>
                    <?php  else : ?>
                    <?php echo  '<h1>' . $FRONTEND_STRINGS['archive_category'] . '</h1><h2>';
                    single_cat_title();
                    echo '</h2>'; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="content-wrapper">
        <div class="overlay-divider"></div>
        <div class="clearfix page-container row-fluid"">

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

