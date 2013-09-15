<?php get_header(); ?>
<?php roots_content_before();
global $FRONTEND_STRINGS; ?>


<?php roots_main_before(); ?>
<div class="main has-sidebar" role="main">
    <div class="subheader-wrapper">
        <div class="container_12">
            <div class="grid_12">
                <div id="subheader">
                            <?php
                            global $prime_frontend;
                            $prime_frontend->print_prime_title_and_subtitle($FRONTEND_STRINGS['404'], $FRONTEND_STRINGS['not_found']);
                            ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
shared on W P L O C K E R .C O M
    <div class="content-wrapper">
        <div class="overlay-divider"></div>
        <div class="clearfix page-container row-fluid">
            <div class="span8">
                <!--PAGE CONTENT-->
                <div class="prime-page">
                    <div class="error">
                        <p class="bottom">
                            <?php echo $FRONTEND_STRINGS['page_missing']; ?></p>
                    </div>
                    <p>
                        <?php
                        echo $FRONTEND_STRINGS['try_the_following']; ?>
                    </p>
                    <ul>
                        <li><?php echo $FRONTEND_STRINGS['check_spelling']; ?> </li>
                        <li>
                            <?php printf($FRONTEND_STRINGS['return_to_home'], home_url()); ?>
                        </li>
                        <li><?php echo $FRONTEND_STRINGS['click_back'] ?></li>
                    </ul>
                </div><!-- /.page -->
            </div><!-- /.span8 -->


            <?php roots_sidebar_before(); ?>
            <div class="span4 sidebar-wrapper">
                <div id="sidebar">
                <?php roots_sidebar_inside_before(); ?>

                <?php get_sidebar(); ?>

                <?php roots_sidebar_inside_after(); ?>

                </div>
            </div>
            <!-- /#sidebar -->
            <?php roots_sidebar_after(); ?>
        </div>
    </div>
    <?php get_footer(); ?>
</div><!-- /#main -->
<?php roots_main_after(); ?>

<?php roots_content_after(); ?>

