<?php

function prime_shortcode_recent_posts_vert($atts, $content = null)
{
    $defaults = array(
        'num_posts' => '3',
        'show_image' => 'false',
        'category_slugs' => NULL

    );
    extract(shortcode_atts($defaults, $atts));

    $show_image = $show_image == "false" ? false : true;
    $num_posts = intval($num_posts);

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
    <div class="recent-posts-shortcode vertical">
<!--        <div class="row-fluid">-->

        <?php
        global $FRONTEND_STRINGS;
        $count = 0;
        while (have_posts()) {
            the_post();
            $count++;
            ?>
            <!--            <div>-->
                <div class=" text-align-left recent-posts-item row-fluid">
                    <?php if ($show_image) {
                echo "<div class=\"span4\">";
                ?>
                <a style="width: 100%;" href="<?php echo the_permalink(); ?>" class="image-link no-frame span6">
                    <?php prime_render_preview_image(array('width' => 220,
                                                          'height' => 195,
                                                          'class' => 'post-image'
                                                     )); ?>
                </a>
                <div class="clear"></div>
                    </div>
                    <?php } ?>
            <div class="preview-content span8">
                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<p class="post-date"><?php the_date(); ?></p>
                <p class="post-meta"><?php the_category(' '); ?></p>
                <p><?php prime_recent_posts_excerpt(); ?></p>

                <p><a class="continue-link" href="<?php the_permalink(); ?>"><?php echo $FRONTEND_STRINGS['read_more'];?></a>
                </p>
            </div>
                </div>
<!--            </div>-->
        <?php

        }
        ?>
    <!--        <div class="clear"></div>-->
    <!--    </div>-->
    </div>
        <?php

    }
    wp_reset_query();


    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}