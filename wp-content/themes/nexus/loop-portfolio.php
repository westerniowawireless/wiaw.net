<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
<div class="notice">
    <p class="bottom"><?php global $FRONTEND_STRINGS; echo $FRONTEND_STRINGS['no_results']; ?></p>
</div>
<?php get_search_form(); ?>
<?php endif; ?>

<?php
global $prime_frontend;
global $prime_portfolio;
global $portfolio_item_count;
$page_id = get_the_ID();

$portfolio_item_count = 0; ?>

<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
<?php //roots_post_before(); ?>
<?php //roots_post_inside_before(); ?>
<?php
    $portfolio_item_count++;
    $pid = get_the_ID();

    $portfolioWrapper = new PrimePortfolioPost($pid);

    switch ($portfolioWrapper->portfolioType) {
        case 'EMBED':
            $portfolio_type = 'video';
            break;
        default:
            $portfolio_type = 'image';
            break;
    }
    ?>

<article class="item <?php if ($portfolio_item_count % 3 == 0) {
    echo 'portfolio-item-third';
} ?> <?php if ($portfolio_item_count % 4 == 0) {
    echo 'portfolio-item-fourth';
}?> <?php if ($portfolio_item_count % 2 == 0) {
    echo 'portfolio-item-second';
} ?>" data-filters="<?php

    $filters = get_the_terms(get_the_ID(), 'portfolio_filter');
    if ($filters) {
        foreach ($filters as $f) {
            echo $f->slug . ' ';
        }
    }
    ?>">

    <?php
    $permalink = get_permalink(get_the_ID());
    $portfolioWrapper->render_preview();

    global $page;
    $page_portfolio_properties = $prime_portfolio->get_portfolio_options($page_id);
    $read_more = isset($page_portfolio_properties['portfolio_readmore_text']) ?
        $page_portfolio_properties['portfolio_readmore_text'] : NULL;
    ?>

    <div class="description <?php echo $portfolio_type; ?>">
        <?php echo do_shortcode(get_the_excerpt());?>
        <?php if (!empty($read_more)) { ?>
        <p><a href="<?php the_permalink(); ?>"><?php echo $read_more; ?></a></p>
        <?php }?>
    </div>
</article>
<!--    --><?php //roots_post_inside_after(); ?>
<!--    --><?php //roots_post_after(); ?>
<?php endwhile; // End the loop ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ($wp_query->max_num_pages > 1) : ?>

<div class="paginators">
    <?php
    global $FRONTEND_STRINGS;
    prime_pagination(array('next_text' => $FRONTEND_STRINGS['portfolio_pagination_next'], 'prev_text' => $FRONTEND_STRINGS['portfolio_pagination_prev']));
    ?>
</div>
<?php endif; ?>
