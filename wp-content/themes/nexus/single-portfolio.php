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
                    $prime_frontend->prime_title_and_subtitle();
                    ?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="clear"></div>


    <div class="content-wrapper">
        <div class="overlay-divider"></div>
        <div class="row-fluid clearfix page-container">
            <!--PAGE CONTENT-->
            <div class="prime-page prime-full-width">
                <?php roots_loop_before(); ?>
                <?php

                $ptype = $prime_portfolio->get_portfolio_type(get_the_ID());

                switch ($ptype) {
                    case 'EMBED':
                        get_template_part('loop', 'portfolio-item-embed');
                        break;
                    case 'IMAGE':
                        get_template_part('loop', 'portfolio-item');
                        break;
                    default:
                        get_template_part('loop', 'portfolio-item-gallery');
                        break;
                }
                ?>
                <?php roots_loop_after(); ?>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
</div><!-- /.main -->
<?php roots_main_after(); ?>
<?php roots_content_after(); ?>
