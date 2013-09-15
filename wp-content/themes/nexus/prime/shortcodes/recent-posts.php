<?php

function prime_shortcode_recent_posts($atts, $content = null)
{
    $defaults = array(
        'num_posts' => '5',
        'show_image' => 'true',
        'category_slugs' => NULL
    );
    extract(shortcode_atts($defaults, $atts));

    $show_image = $show_image == "false" ? false : true;


    $num_posts = 3;

    $num_cols = $num_posts;

    $column_class = 'span3';

    ob_start();

    $query_args = array(
        'post_type' => 'post',
        'posts_per_page' => $num_posts,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    if (!empty($category_slugs)) {
        $query_args['category_name'] = $category_slugs;
    }

    query_posts($query_args);

    if (have_posts()) {
        ?>

    <div class="grid_12 alpha omega recent-projects">
        <div class="row-fluid recent-projects recent-posts">
            <div class="span3"><?php echo prime_remove_autop(do_shortcode($content));
                ?>
                <div class="rpc-paginators">
                    <a href="#" class="recent-posts-prev" onclick="return false;"><i class="icon-chevron-left"></i></a>
                    <a href="#" class="recent-posts-next" onclick="return false;"><i class="icon-chevron-right"></i></a>
                </div>
            </div>
<!--			<div class="recent-projects-divider"></div>-->
<!--            <div class="recent-posts-carousel">-->

                    <?php
                    global $FRONTEND_STRINGS;
                    $count = 0;

                    $pid = get_the_ID();
                    $portfolioWrapper = new PrimePortfolioPost($pid);

                    while (have_posts()) {
                        the_post();
                        $count++;
                        ?>
                        <div class="span3">
                            <article class="item">

                                <?php if ($show_image) $portfolioWrapper->render_permalink_wrapped_image();
                                ?>
                                <div class="description image">
                                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
									<p class="post-date"><?php the_date(); ?></p>
                                    <p class="post-meta"><?php the_category(' '); ?></p>
                                    <p><?php prime_recent_posts_excerpt(); ?></p>

                                    <p><a class="continue-link"
                                          href="<?php the_permalink(); ?>"><?php echo $FRONTEND_STRINGS['read_more'];?></a>
                                    </p>
                                </div>
                            </article>
                        </div>
                        <?php

                    }
                    ?>
<!--            </div>-->
        </div>
    </div>
    <div class="clear"></div>
    <?php

    }
    wp_reset_query();


    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}