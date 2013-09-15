<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 5/1/12
 * Time: 9:04 AM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Example Usage: [content_slider slider="Content Slider 1"]
 * @param $atts
 * @param null $content
 * @return string
 */

function prime_shortcode_content_slider($atts, $content = null)
{
    global $prime_content_slider;

    $defaults = array(
        'categories' => 'cat1',
        'slideshow_speed' => 9000,
        'slider_orderby' => 'menu_order',
        'slider_order' => 'ASC'
    );

    $sc_args = shortcode_atts($defaults, $atts);
    extract($sc_args);
    ob_start();?>

<div class="content-slider-wrapper slider-wrapper">
    <div class="content-slider-inner-wrap">
		<div class="border"></div>
        <div
            <?php
            if (intval($slideshow_speed) > 0) {
                echo 'data-slideshow-speed="' . $slideshow_speed . '"';
            }
            else {
                echo 'data-slideshow-speed="0"';
            }
            ?>
            class="prime-content-slider hidden">

            <?php
            $args = $prime_content_slider->get_slide_args_for($sc_args);

            global $wp_query;
            $temp_query = $wp_query;

            $wp_query = new WP_Query($args);
            ?>

            <!--FOR EACH SLIDE-->
            <?php while (have_posts()) : the_post(); ?>

            <?php
            global $post;

            ?>

            <div class="slide" <?php echo $prime_content_slider->get_data_height_attrs(); ?>>
	
                <?php
                echo $prime_content_slider->get_slide_image();
                echo $prime_content_slider->get_slide_content();
                ?>
                <div class="clear"></div>
            </div>

            <?php endwhile; // End the loop ?>

        </div>

    </div>

    <div>
        <div id="nav">
			<div class="nav-controls"><a id="next" href="javascript:void(0)"><i class="icon-play"></i></a><a href="javascript:void(0)" id="pause"><i class="icon-pause"></i></a></div><div id="nav-pager"></div>
            

        </div>
    </div>
</div>

<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    $wp_query = $temp_query;
    wp_reset_query();

    return $ret_val;
}
