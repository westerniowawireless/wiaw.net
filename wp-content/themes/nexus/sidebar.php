<?php

$option_tree = get_option(PRIME_OPTIONS_KEY);
$sidebars = isset($option_tree['unlimited_sidebar_slider']) ? $option_tree['unlimited_sidebar_slider'] : array();

$page = get_queried_object();
$custom_sidebar_ids = array();

$post_type = get_post_type(get_the_ID());

if ($post_type == 'portfolio') {
//    $cats = wp_get_post_terms(get_the_ID(), 'portfolio_category');
//    $cat_ids = array();
//    foreach ($cats as $c) {
//        $cat_ids[] = $c->term_id;
//    }
//
//    foreach ($sidebars as $s) {
//        if (isset($s['portfolio_categories'])) {
//            $intersection = array_intersect($cat_ids, $s['portfolio_categories']);
//            if (count($intersection) > 0) {
//                $custom_sidebar_ids[] = $s['id'];
//            }
//        }
//    }
    //portfolios are now full width
}
else if (is_single()) {
    $cats = wp_get_post_categories(get_the_ID());
    foreach ($sidebars as $s) {
        if (isset($s['sidebar_categories'])) {
            $intersection = array_intersect($cats, $s['sidebar_categories']);
            if (count($intersection) > 0) {
                $custom_sidebar_ids[] = $s['id'];
            }
        }
    }
}
else {
    foreach ($sidebars as $s) {
        if ($page && key_exists('sidebar_pages', $s) && in_array($page->ID, $s['sidebar_pages'])) {
            $custom_sidebar_ids[] = $s['id'];
        }
    }
}


if (count($custom_sidebar_ids) > 0) {
    foreach ($custom_sidebar_ids as $sid) {
        dynamic_sidebar($sid);
    }
}
else {
    dynamic_sidebar('roots-sidebar');
}

?>