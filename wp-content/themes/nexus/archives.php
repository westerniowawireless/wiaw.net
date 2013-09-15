<?php
/*
Template Name: Archives
*/
get_header(); ?>
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
                    $prime_frontend->prime_title_and_subtitle();
                    ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>


    <div class="content-wrapper">
        <div class="overlay-divider"></div>
        <div class="clearfix page-container row-fluid">
            <div class="span8">

                <!--PAGE CONTENT-->
                <div class="prime-page prime-archives">
                    <?php roots_loop_before(); ?>

                    <h4><?php global $FRONTEND_STRINGS; echo $FRONTEND_STRINGS['latest_posts']; ?></h4>
                    <ul><?php
                        $recent_posts = wp_get_recent_posts();
                        foreach ($recent_posts as $recent) {
                            echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look ' . $recent["post_title"] . '" >' . $recent["post_title"] . '</a> </li> ';
                        }
                        ?>
                    </ul>

                    <h4><?php echo $FRONTEND_STRINGS['browse_month']; ?></h4>
                    <ul>
                        <?php wp_get_archives('type=monthly'); ?>
                    </ul>

                    <h4><?php echo $FRONTEND_STRINGS['browse_category']; ?></h4>
                    <ul>
                        <?php wp_list_categories(array('title_li' => null, 'hierarchical' => false)); ?>
                    </ul>

                    <?php get_template_part('loop', 'page'); ?>

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

