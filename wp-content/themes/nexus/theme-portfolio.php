<?php
/*
The template that is used to render pages that are targeted by the multiple portfolio behavior of Prime.
*/
get_header(); ?>
<?php roots_content_before(); ?>

<?php roots_main_before(); ?>

<?php
global $prime_portfolio;
$portfolio_instance = get_option(PRIME_OPTIONS_KEY);
$show_filter = false;
$page = get_queried_object();
foreach ($portfolio_instance['portfolio_instance_slider'] as $p) {
    if(key_exists('portfolio_show_filters', $p) && $p['portfolio_show_filters'][0] == 'Yes' && $p['portfolio_page'] == $page->ID) {
        $show_filter = true;
    }
}
?>

<div class="main portfolio-main <?php if($show_filter) { echo 'show-filter'; } else { echo 'no-filter'; }?>" role="main">
	<div class="subheader-wrapper">
	    <div class="container_12">
	        <div class="grid_12">
	            <div id="subheader">
                    <?php
                    global $post;
                    global $prime_frontend;
                    $prime_frontend->prime_title_and_subtitle();
                    ?>
					<?php if($show_filter) {  ?>
						<div class="table select-table">
							<select class="filter">
			                   <option data-filter="*"><?php echo get_portfolio_all_filter_text(); ?></option>
							<?php
			                   global $prime_portfolio;
			                   $prime_portfolio->render_all_filter_list_item();
			                   $page = get_queried_object();

							    $portfolio_instance = get_option(PRIME_OPTIONS_KEY);
							    $filters = NULL;
							    foreach ($portfolio_instance['portfolio_instance_slider'] as $p) {
							        if ($p['portfolio_page'] == $page->ID) {
							            $filters = isset($p['portfolio_filters']) ? $p['portfolio_filters'] : NULL;
							            break;
							        }
							    }
							
			                   if (!empty($filters)) {
			                       foreach ($filters as $fil) {
			                           $f = get_term($fil, 'portfolio_filter');
			                           ?>
			                           <option data-filter='article[data-filters*="<?php echo $f->slug; ?>"]'>
			                               <?php echo $f->name; ?>
			                           </option>
			                           <?php

			                       }
			                   }


			                   ?>
			               </select>
						</div>
					<?php } ?>
	            </div>	
	        </div>
	    </div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<div class="content-wrapper">
		<div class="overlay-divider"></div>
            
			<?php if($show_filter) { ?>
				<div class="filter-wrapper">
					<div class="table">
	                    <ul id="filters">
							<?php
						    $prime_portfolio->render_all_filter_list_item();
						    $page = get_queried_object();

						    $portfolio_instance = get_option(PRIME_OPTIONS_KEY);
						    $filters = NULL;
						    foreach ($portfolio_instance['portfolio_instance_slider'] as $p) {
						        if ($p['portfolio_page'] == $page->ID) {
						            $filters = isset($p['portfolio_filters']) ? $p['portfolio_filters'] : NULL;
						            break;
						        }
						    }

						    if (!empty($filters)) {
						        foreach ($filters as $fil) {
						            $f = get_term($fil, 'portfolio_filter');
						            $prime_portfolio->render_filter_list_item($f);
						        }
						    }
						    ?>
						</ul>
					</div>
					<div class="overlay-divider bottom"></div>
					<div class="clear"></div>
				</div>          
			<?php } ?>		
            

<?php
    $page = get_queried_object();
    $page_portfolio_properties = $prime_portfolio->get_portfolio_options($page->ID);

    global $wp_query;
    $temp_query = $wp_query;

    $orig_query_vars = $temp_query->query_vars;

    $args = $prime_portfolio->get_portfolio_item_args_for($page->ID);

    $posts_per_page = -1;
    if (isset($page_portfolio_properties['portfolio_posts_per_page'])) {
        $posts_per_page = $page_portfolio_properties['portfolio_posts_per_page'];
        $posts_per_page = empty($posts_per_page) ? -1 : intval($posts_per_page);
    }
    $args['posts_per_page'] = $posts_per_page;

    if (!empty($orig_query_vars['paged'])) {
        $args['paged'] = intval($orig_query_vars['paged']);
    }
    else if (!empty($orig_query_vars['page'])) {
        $args['paged'] = intval($orig_query_vars['page']);
    }

    $wp_query = new WP_Query($args);

    $paginated = $wp_query->max_num_pages > 1 ? 'paginated' : '';
    ?>

    <div class="portfolio-wrapper">
	    <div class="row-fluid clearfix page-container">
	        <div class="span12">
                <!--PAGE CONTENT-->
                <div class="prime-page prime-full-width prime-portfolio <?php echo $paginated; ?>">
                    <div id="masonry-container">
                        <?php get_template_part('loop', 'portfolio'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

	</div>
    <?php get_footer(); ?>
</div>

<?php roots_main_after(); ?>
<?php roots_content_after(); ?>

 
