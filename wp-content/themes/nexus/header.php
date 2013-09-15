<!doctype html>
<html class="no-js <?php prime_print_layout_class(); ?> <?php prime_print_skin_class(); ?> <?php prime_print_preview_class(); ?> std-selector" <?php language_attributes(); ?>>
<!--<![endif]-->
<head><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta content="text/html; charset=UTF-8" http-equiv="content-type"/>

    <title><?php
    if (!defined('WPSEO_VERSION')) {
        wp_title('|', true, 'right');
        bloginfo('name');
    }
    else {
        //IF WordPress SEO by Yoast is activated
        wp_title('');
    }?></title>


    <meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1">


    <?php roots_stylesheets(); ?>

    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed"
          href="<?php echo home_url(); ?>/feed/">

    <script src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-2.0.6.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery-1.7.1.min.js"><\/script>')</script>
    <script>
    	$(function () {
    		$(window).resize();
    	});
    </script>

    <?php wp_head(); ?>
    <?php roots_head(); ?>

    <style>

        div.cpslider-wrapper,
        div.content-slider-wrapper {
            width: 100%;
            position: relative;
            margin: 0 auto;
        }

        div.cpslider > div.slide,
        div.content-slider > div.slide{
            margin: 0 auto;
            width: 100%;
        }

        .cpslider-inner-wrap,
        .content-slider-inner-wrap{
            position: relative;
            margin: 0 auto;
            height: 100%;
            overflow: hidden;
        }

        .cpslider > .slide,
        .content-slider > .slide{
            display: none;
        }

        .cpslider > .slide > .slide-content,
        .content-slider > .slide > .slide-content{
            margin: 0 auto;
            padding: 0;
            width: auto;
            position: relative;
            height: 100%;
        }

        div.cpslider > div.slide .cp-anim-image,
        div.content-slider > div.slide .cp-anim-image{
            bottom: 0;
            display: block;
            vertical-align: bottom;
        }

        .long-anim {
            -webkit-animation-duration: 3s;
            -webkit-animation-delay: .5s;
        }

    </style>

</head>

<body <?php body_class(roots_body_class()); ?>>

<?php roots_wrap_before(); ?>

<div id="wrap" class="container document-container" role="document">

    <?php roots_header_before(); ?>
	<div class="header-bg"><div class="header-bg-fill"></div></div>
    <header>
        <?php roots_header_inside(); ?>

		<nav>
                <div class="logo">
                    <a name="header-logo" href="<?php echo home_url(); ?>">
                    </a>
                </div>
                <div class="tagline">
                    <?php echo get_bloginfo('description'); ?>
                </div>
                <?php
                $show_text_mobile_menu_btn = get_prime_options('enable_mobile_menu_button_text') == "Enable";
                ?>
				<a class="mobile-menu-btn btn" href="javascript:void(0)" data-toggle="collapse"
	               data-target="#mobile-menu-wrapper">
                    <?php if($show_text_mobile_menu_btn) { ?>
                        <?php echo get_prime_options('mobile_menu_button_text'); ?>
                    <?php } else {?>
	                <span class="list-icon-row"></span>
	                <span class="list-icon-row"></span>
	                <span class="list-icon-row"></span>
                    <?php } ?>
	            </a>
			<div class="header-content standard-header-content">

<?php if (get_prime_options('enable_alternate_content') == 'Enable') { echo do_shortcode(get_prime_options('alternate_content')); } else { ?>

				<div class="social-links">
                    <?php if (get_prime_options('enable_facebook_link') == 'Enable') { ?>
					<a id="fb-root" class="facebook-link" href="<?php echo get_prime_options('facebook_url'); ?>"><?php echo get_prime_options('facebook_text'); ?></a>
                    <?php } ?>
                    <?php if (get_prime_options('enable_twitter_link') == 'Enable') { ?>
                    <a class="twitter-link" href="<?php echo get_prime_options('twitter_url'); ?>"><?php echo get_prime_options('twitter_text'); ?></a>
                    <?php } ?>
                    <?php if (get_prime_options('enable_linkedin_link') == 'Enable') { ?>
                    <a class="linkedin-link" href="<?php echo get_prime_options('linkedin_url'); ?>"><?php echo get_prime_options('linkedin_text'); ?></a>
                    <?php } ?>
				</div>

				<?php if (get_prime_options('enable_call_button') == 'Enable') {
                    ?><span class="call-us-button"><?php
                        echo '' . do_shortcode('[button link="' . get_prime_options('call_button_url') . '"]<span class="call-button-inner"><i class="call-us-icon"></i>' . get_prime_options('call_button_text') . '</span>[/button]');
                    ?></span><?php
                } ?>

            <?php } ?>

			</div>

			<div class="clear"></div>
			<div class="menu-wrapper">

	           <?php
	                // Desktop Menu
	                wp_nav_menu(array(
	                                 'theme_location' => 'primary_navigation',
	                                 'walker' => new roots_nav_walker(),
	                                 'menu_id' => 'topmenu',
	                                 'menu_class' => 'sf-menu desktop-menu topmenu',
	                                 'fallback_cb' => 'prime_menu_fallback'
	                            ));
	                // Tablet Menu (Portrait)
	                wp_nav_menu(array(
	                                 'theme_location' => 'tablet_navigation',
	                                 'walker' => new roots_nav_walker(),
	                                 'menu_id' => 'topmenu',
	                                 'menu_class' => 'sf-menu tablet-menu tablet-menu-portrait topmenu',
	                                 'fallback_cb' => 'prime_menu_fallback'
	                            ));
	                // Tablet Menu (Landscape)
	                wp_nav_menu(array(
	                                 'theme_location' => 'tablet_navigation_landscape',
	                                 'walker' => new roots_nav_walker(),
	                                 'menu_id' => 'topmenu',
	                                 'menu_class' => 'sf-menu tablet-menu tablet-menu-landscape topmenu',
	                                 'fallback_cb' => 'prime_menu_fallback'
	                            ));

	                ?>

					<div class="clear"></div>
					</div>
				</nav>

            <!-- </div>
            <div class="clear"></div>
        </div> -->
		<div id="mobile-menu-wrapper" class="mobile-menu-wrapper collapse">
				<div class="mobile-menu-tip"></div>
	           <?php
	                                   // Mobile Menu
	               wp_nav_menu(array(
	                                'theme_location' => 'mobile_navigation',
	                                'walker' => new roots_nav_walker(),
	                                'menu_id' => 'topmenu',
	                                'menu_class' => 'mobile-menu topmenu',
	                                'fallback_cb' => 'prime_menu_fallback'
	                           )); ?>
	               <div class="clear"></div>
	    </div>
		<div class="clear"></div>
		<div class="header-content mobile-header-content">
            <?php if (get_prime_options('enable_alternate_content') == 'Enable') {
                    echo do_shortcode(get_prime_options('alternate_content_mobile'));
            } else { ?>

                <?php if (get_prime_options('enable_call_button') == 'Enable') { ?>
                <span class="call-us-button">
                <?php
                    $mobile_button_link = get_prime_options('call_button_mobile_url') == "Enable" ?
                        get_prime_options('call_button_url') :
                        'tel:' . get_prime_options('call_button_number');
                ?>
                <?php echo '' . do_shortcode('[button link="' . $mobile_button_link . '"]<span class="call-button-inner"><i class="call-us-icon"></i>' . get_prime_options('call_button_text') .'</span>[/button]');?>
                </span>
                <?php
                }

                $num_buttons = 0;
                if(get_prime_options('enable_facebook_link') == 'Enable') {
                    $num_buttons++;
                }
                if (get_prime_options('enable_twitter_link') == 'Enable') {
                    $num_buttons++;
                }
                if (get_prime_options('enable_linkedin_link') == 'Enable') {
                    $num_buttons++;
                }
                if($num_buttons != 0) {
                ?>
                <div class="social-links">
                    <?php

                    $num_class = 'num-buttons-' . $num_buttons;

                    if (get_prime_options('enable_facebook_link') == 'Enable') {
                        echo do_shortcode('[button link="' . get_prime_options('facebook_url') .
                            '" class="facebook-link ' . $num_class . '"]' . get_prime_options('facebook_text') . '[/button]');
                    }
                    if (get_prime_options('enable_twitter_link') == 'Enable') {
                        echo do_shortcode('[button link="' . get_prime_options('twitter_url') .
                            '" class="twitter-link ' . $num_class . '"]' . get_prime_options('twitter_text') . '[/button]');
                    }
                    if (get_prime_options('enable_linkedin_link') == 'Enable') {
                        echo do_shortcode('[button link="' . get_prime_options('linkedin_url') .
                            '" class="linkedin-link ' . $num_class . '"]' . get_prime_options('linkedin_text') . '[/button]');
                    }
                    ?>
                </div>
                <?php } ?>
            <?php } ?>
		</div>
    </header>

    <?php roots_header_after(); ?>

