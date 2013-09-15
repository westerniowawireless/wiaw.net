<?php

function prime_shortcode_recent_projects($atts, $content = null)
{
    $defaults = array(
        'type' => 'warning',
        'block_message' => '',
        'show_close' => '',
        'count' => '5',
        'category_slugs' => NULL
    );
    extract(shortcode_atts($defaults, $atts));

    ob_start();   ?>

<?php
    //show the works

    $count = 3;
    $query_args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => $count,
        'orderby' => 'menu_order',
    );

    if (!empty($category_slugs)) {
        $category_slugs = explode(',', $category_slugs);
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => 'portfolio_category',
                'field' => 'slug',
                'terms' => array_values($category_slugs),
                'include_children' => true,
            )
        );
    }

    query_posts($query_args);

    global $prime_sc_helper;

    global $prime_frontend;
    global $prime_portfolio;
    $portfolio_item_count = 0;
    ?>
<div class="grid_12 alpha omega recent-projects">
    <div class="row-fluid recent-projects">
        <div class="span3">
            <?php echo prime_remove_autop(do_shortcode($content)); ?>
            <div class="rpc-paginators">
                <a href="#" class="rpc-prev" onclick="return false;"><i class="icon-chevron-left"></i></a>
                <a href="#" class="rpc-next" onclick="return false;"><i class="icon-chevron-right"></i></a>
            </div>

        </div>

    <?php

    $count = 0;
    while (have_posts()) : the_post(); ?>
        <?php
        $portfolio_item_count++;
        $pid = get_the_ID();

        $portfolioWrapper = new PrimePortfolioPost($pid);

        switch ($portfolioWrapper->get_portfolio_type()) {
            case 'EMBED':
            default:
                $portfolio_type = 'image';
                break;
        }
        ?>
        <div class="span3">
            <article class="item">

                <?php
                $permalink = get_permalink(get_the_ID());
                $portfolioWrapper->render_preview();
                ?>

                <div class="description <?php echo $portfolio_type; ?>">
                    <?php echo do_shortcode(get_the_excerpt());?>

                </div>
            </article>
        </div>
        <?php endwhile; // End the loop ?>
    </div>
</div>
<div class="clear"></div>

<?php

    wp_reset_query();
    $ret_val = ob_get_contents();
    ob_end_clean();

    return prime_remove_autop($ret_val);
}

 
