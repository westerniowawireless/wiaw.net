<?php

if (!function_exists('prime_attachment_image_url')) {

    if (!function_exists('prime_attachment_image_url')) {

        function prime_attachment_image_url($args)
        {
            $poster = null;

            $att_id = NULL;
            $width = NULL;
            $height = NULL;
            extract($args);
            $thumb_id = $att_id;

            if ($thumb_id) {
                if ($height === NULL) {
                    $img = wp_get_attachment_image_src($thumb_id, 'full');
                    if ($img) {
                        $ratio = $img[2] / $img[1]; // height/width
                        $height = round($width * $ratio);
                    }
                    else {
                        $height = $width;
                    }
                }

                $vt_crop = 'enable'; //get_option_tree('pis_hard_crop');
                if ($vt_crop == 'enable') $vt_crop = true; else $vt_crop = false;
                $vt_image = vt_resize($thumb_id, '', $width, $height, $vt_crop);
                $poster = $vt_image['url']; //url is the first entry

            }

            return $poster;
        }
    }
}

if (!function_exists('prime_render_preview_image')) {

    /**
     * Args -
     * width
     * height
     * @param array $args
     * @return void
     */
    function prime_render_preview_image($args = array())
    {
        $post_id = get_the_ID();
        $width = 191;
        $height = 173;
        $class = '';
        $img_dimension_attrs = false;
        $before = '';
        $after = '';

        extract($args);

        $preview_image_url = get_post_meta($post_id, '_prime_preview_image', true);

        $image_args = array('id' => $post_id,
            'width' => $width,
            'height' => $height,
            'class' => $class,
            'link' => 'img',
            'hires' => true,
            'before' => $before,
            'after' => $after,
            'img_dimension_attrs' => $img_dimension_attrs);
        if (!empty($preview_image_url)) {
            $image_args['src'] = $preview_image_url;
        }


        prime_image($image_args);

        $image_args['link'] = 'url';
        $image_args['return'] = true;

    }
}

if (!function_exists('prime_get_preview_image_url')) {
    /**
     * Args -
     * width
     * height
     * @param array $args
     * @return void
     */
    function prime_get_preview_image_url($args = array())
    {
        $post_id = get_the_ID();
        $width = 191;
        $height = 173;

        extract($args);

        $preview_image_url = get_post_meta($post_id, '_prime_preview_image', true);

        $image_args = array('id' => $post_id,
            'width' => $width,
            'height' => $height,
            'link' => 'img',
            'return' => true,
            'link' => 'url'
        );
        if (!empty($preview_image_url)) {
            $image_args['src'] = $preview_image_url;
        }

        return prime_image($image_args);
    }
}

if (!function_exists('prime_image')) {
    /** Parameters are fed through an $args array.
     * @param link - 'src', 'img'. Src will output markup for an anchor around the img. Img will just output the image markup
     * @param width - the desired width of the image
     * @param height - the desired height of the image
     * @param id - the post id. This will default to get_the_ID()
     * @param src - the URL to the image to be resized. The usage of src is mutually exclusive from the usage of id. If the
     *      URL provided is a hotlinked image, the image will not be resized.
     * @param return - true/false - determines if the output is echo'd or returned. (default false)
     *
     * @return int|string
     */
    function prime_image($args)
    {

        /* ------------------------------------------------------------------------- */
        /* SET VARIABLES */
        /* ------------------------------------------------------------------------- */

        global $post;

        //Defaults
        $key = 'image';
        $width = null;
        $height = null;
        $class = '';
        $quality = 90;
        $id = null;
        $link = 'src';
        $repeat = 1;
        $offset = 0;
        $before = '';
        $after = '';
        $single = false;
        $force = false;
        $return = false;
        $is_auto_image = false;
        $src = '';
        $meta = '';
        $alignment = '';
        $size = '';

        $alt = '';
        $img_link = '';

        $img_dimension_attrs = true;

        $hires = false;

        $attachment_id = array();
        $attachment_src = array();

        if (!is_array($args))
            parse_str($args, $args);

        extract($args);

        // Set post ID
        if (empty($id)) {
            $id = $post->ID;
        }

        $thumb_id = get_post_meta($id, '_thumbnail_id', true);

        // Set alignment
        if ($alignment == '')
            $alignment = get_post_meta($id, '_image_alignment', true);

        // Get standard sizes
        if (!$width && !$height) {
            $width = '100';
            $height = '100';
        }

        $arg_width = $width;
        $arg_height = $height;

        /* ------------------------------------------------------------------------- */
        /* FIND IMAGE TO USE */
        /* ------------------------------------------------------------------------- */

        // When a custom image is sent through
        if ($src != '') {
            $custom_field = $src;
            $link = 'img';

            // Dynamically resize the post thumbnail
            $vt_crop = true;
            $vt_image = vt_resize(NULL, $src, $width, $height, $vt_crop, $hires);

            // Set fields for output
            $custom_field = $vt_image['url'];
            $width = $vt_image['width'];
            $height = $vt_image['height'];

            // WP 2.9 Post Thumbnail support
        } elseif (!empty($thumb_id)) {


            // Dynamically resize the post thumbnail
            $vt_crop = 'enable'; //get_option_tree('pis_hard_crop');
            if ($vt_crop == 'enable') $vt_crop = true; else $vt_crop = false;
            $vt_image = vt_resize($thumb_id, '', $width, $height, $vt_crop, $hires);

            // Set fields for output
            $custom_field = $vt_image['url'];
            $width = $vt_image['width'];
            $height = $vt_image['height'];


            // Grab the image from custom field
        } else {
            $custom_field = get_post_meta($id, $key, true);
        }

        // Automatic Image Thumbs - get first image from post attachment
        if (empty($custom_field) && empty($img_link) && !(is_singular() AND in_the_loop() AND $link == "src")) {

            if ($offset >= 1)
                $repeat = $repeat + $offset;

            $attachments = get_children(array('post_parent' => $id,
                    'numberposts' => $repeat,
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'order' => 'DESC',
                    'orderby' => 'menu_order date')
            );

            // Search for and get the post attachment
            if (!empty($attachments)) {

                $counter = -1;
                $size = 'large';
                foreach ($attachments as $att_id => $attachment) {
                    $counter++;
                    if ($counter < $offset)
                        continue;

                    // Dynamically resize the post thumbnail
                    $vt_crop = 'enable'; //get_option_tree('pis_hard_crop');
                    if ($vt_crop == 'enable') $vt_crop = true; else $vt_crop = false;
                    $vt_image = vt_resize($att_id, '', $width, $height, $vt_crop, $hires);

                    // Set fields for output
                    $custom_field = $vt_image['url'];
                    $width = $vt_image['width'];
                    $height = $vt_image['height'];

                    $thumb_id = $att_id;
                    $is_auto_image = true;
                }

                // Get the first img tag from content
            } else {

                $first_img = '';
                $post = get_post($id);
                ob_start();
                ob_end_clean();
                $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
                if (!empty($matches[1][0])) {

                    // Save Image URL
                    $custom_field = $matches[1][0];

                    // Search for ALT tag
                    $output = preg_match_all('/<img.+alt=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
                    if (!empty($matches[1][0])) {
                        $alt = $matches[1][0];
                    }
                }

            }

        }

        // Check if there is YouTube embed
        if (empty($custom_field) && empty($img_link)) {
            $embed = get_post_meta($id, "embed", true);
            if ($embed)
                $custom_field = prime_get_video_image($embed);
        }

        // Return if there is no attachment or custom field set
        if (empty($custom_field) && empty($img_link)) {

            // Check if default placeholder image is uploaded
            $placeholder = get_prime_options('placeholder_image');
            if ($placeholder && !(is_singular() AND in_the_loop())) {
                $custom_field = $placeholder;

                // Dynamically resize the post thumbnail
                $vt_crop = 'enable'; //get_option_tree('pis_hard_crop');
                if ($vt_crop == 'enable') $vt_crop = true; else $vt_crop = false;
                $vt_image = vt_resize('', $placeholder, $width, $height, $vt_crop, $hires);

                // Set fields for output
                $custom_field = $vt_image['url'];
                $width = $vt_image['width'];
                $height = $vt_image['height'];

            } else {
                return;
            }

        }

        if (empty($src_arr) && empty($img_link)) {
            $src_arr[] = $custom_field;
        }

        /* ------------------------------------------------------------------------- */
        /* BEGIN OUTPUT */
        /* ------------------------------------------------------------------------- */

        $output = '';

        // Set output height and width
        $set_width = ' width="' . $width . '" ';
        $set_height = ' height="' . $height . '" ';
        if ($height == null OR $height == '') $set_height = '';

        if (!$img_dimension_attrs) {
            $set_width = '';
            $set_height = '';
        }
        else if ($hires) {
            $set_width = ' width="' . $arg_width . '" ';
            $set_height = ' height="' . $arg_height . '" ';
        }

        // Set standard class
        if ($class) $class = 'prime-image ' . $class; else $class = 'prime-image';

        // Do check to verify if images are smaller then specified.
        if ($force == true) {
            $set_width = '';
            $set_height = '';
        }

        // WP Post Thumbnail
        if (!empty($img_link)) {

            if ($link == 'img') { // Output the image without anchors
                $output .= $before;
                $output .= $img_link;
                $output .= $after;

            } elseif ($link == 'url') { // Output the large image

                $src = wp_get_attachment_image_src($thumb_id, 'large', true);
                $custom_field = $src[0];
                $output .= $custom_field;

            } else { // Default - output with link

                if ((is_single() OR is_page()) AND $single == false) {
                    $rel = 'rel="lightbox"';
                    $href = false;
                } else {
                    $href = get_permalink($id);
                    $rel = '';
                }

                $title = 'title="' . get_the_title($id) . '"';

                $output .= $before;
                if ($href == false) {
                    $output .= $img_link;
                } else {
                    $output .= '<a class="image-link" ' . $title . ' href="' . $href . '" ' . $rel . '>' . $img_link . '</a>';
                }

                $output .= $after;
            }
        }
        else {

            foreach ($src_arr as $key => $custom_field) {

                //Set the ID to the Attachment's ID if it is an attachment
                if ($is_auto_image == true AND isset($attachment_id[$key])) {
                    $quick_id = $attachment_id[$key];
                } else {
                    $quick_id = $id;
                }

                //Set custom meta
                if ($meta) {
                    $alt = $meta;
                    $title = 'title="' . $meta . '"';
                } else {
                    if ($alt == '') $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                    $title = 'title="' . get_the_title($quick_id) . '"';
                }

                $img_link = '<img src="' . $custom_field . '" alt="' . $alt . '" ' . $set_width . $set_height . ' class="' . stripslashes($class) . '" />';

                if ($link == 'img') { // Just output the image
                    $output .= $before;
                    $output .= $img_link;
                    $output .= $after;

                } elseif ($link == 'url') { // Output the URL to original image
                    if ($vt_image['url'] || $is_auto_image) {
                        $src = wp_get_attachment_image_src($thumb_id, 'full', true);
                        $custom_field = $src[0];
                    }
                    $output .= $custom_field;

                } else { // Default - output with link

                    if ((is_single() OR is_page()) AND $single == false) {

                        // Link to the large image if single post
                        if ($vt_image['url'] || $is_auto_image) {
                            $src = wp_get_attachment_image_src($thumb_id, 'full', true);
                            $custom_field = $src[0];
                        }

                        $href = $custom_field;
                        $rel = 'rel="lightbox"';
                    } else {
                        $href = get_permalink($id);
                        $rel = '';
                    }

                    $output .= $before;
                    $output .= '<a class="image-link"  href="' . $href . '" ' . $rel . $title . '>' . $img_link . '</a>';
                    $output .= $after;
                }
            }
        }

        // Return or echo the output
        if ($return == TRUE)
            return $output;
        else
            echo $output; // Done

    }
}

/* Get thumbnail from Video Embed code */

if (!function_exists('prime_get_video_image')) {
    function prime_get_video_image($embed)
    {

        // YouTube - get the video code if this is an embed code (old embed)
        preg_match('/youtube\.com\/v\/([\w\-]+)/', $embed, $match);

        // YouTube - if old embed returned an empty ID, try capuring the ID from the new iframe embed
        if ($match[1] == '')
            preg_match('/youtube\.com\/embed\/([\w\-]+)/', $embed, $match);

        // YouTube - if it is not an embed code, get the video code from the youtube URL
        if ($match[1] == '')
            preg_match('/v\=(.+)&/', $embed, $match);

        // YouTube - get the corresponding thumbnail images
        if ($match[1] != '')
            $video_thumb = "http://img.youtube.com/vi/" . $match[1] . "/0.jpg";

        // return whichever thumbnail image you would like to retrieve
        return $video_thumb;
    }
}


if (!function_exists('prime_get_size_of_image')) {
    /** Will return the dimensions of an image on the server identified by its URL. If the file isn't found, NULL is returned
     * @param $img_url
     * @return array|null
     */
    function prime_get_size_of_image($img_url)
    {
        $file_path = NULL;
        // this is an attachment, so we have the ID

        $file_path = parse_url($img_url);
        $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

        if (file_exists($file_path) && !is_dir($file_path)) {
            $orig_size = getimagesize($file_path);
            return $orig_size;
        }
        else {
            return NULL;
        }
    }
}

/*-----------------------------------------------------------------------------------*/
/* vt_resize - Resize images dynamically using wp built in functions
/*-----------------------------------------------------------------------------------*/
/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 *
 * <?php
 * $thumb = get_post_thumbnail_id();
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * $param bool $hires will try and double the width and height of the image
 * @return array
 */
if (!function_exists('vt_resize')) {
    function vt_resize($attach_id = null, $img_url = null, $width, $height, $crop = false, $hires = false)
    {
        $param_width = $width;
        $param_height = $height;

        // this is an attachment, so we have the ID
        if ($attach_id) {

            $image_src = wp_get_attachment_image_src($attach_id, 'full');
            $file_path = get_attached_file($attach_id);

            // this is not an attachment, let's use the image url
        } else if ($img_url) {

            $file_path = parse_url($img_url);
            $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

            //$file_path = ltrim( $file_path['path'], '/' );
            //$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];

            if (file_exists($file_path)) {
                $orig_size = getimagesize($file_path);

                $image_src[0] = $img_url;
                $image_src[1] = $orig_size[0];
                $image_src[2] = $orig_size[1];
            }
            else {
                return array(
                    'url' => $img_url,
                    'width' => $width,
                    'height' => $height
                );
            }
        }

        if ($hires) {
            $hires_width = 2 * $width;
            $hires_height = 2 * $height;

            if ($image_src[1] > $hires_width && $image_src[2] > $hires_height) {
                $width = $hires_width;
                $height = $hires_height;
            }
        }

        $file_info = pathinfo($file_path);

        // check if file exists
        $base_file = $file_info['dirname'] . '/' . $file_info['filename'] . '.' . $file_info['extension'];
        if (!file_exists($base_file))
            return;

        $extension = '.' . $file_info['extension'];

        // the image path without the extension
        $no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

        $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

        // checking if the file size is larger than the target size
        // if it is smaller or the same size, stop right here and return
        if ($image_src[1] > $width) {

            // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
            if (file_exists($cropped_img_path)) {

                $cropped_img_url = str_replace(basename($image_src[0]), basename($cropped_img_path), $image_src[0]);

                $vt_image = array(
                    'url' => $cropped_img_url,
                    'width' => $width,
                    'height' => $height
                );

                return $vt_image;
            }

            // $crop = false or no height set
            if ($crop == false OR !$height) {

                // calculate the size proportionaly
                $proportional_size = wp_constrain_dimensions($image_src[1], $image_src[2], $width, $height);
                $resized_img_path = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

                // checking if the file already exists
                if (file_exists($resized_img_path)) {

                    $resized_img_url = str_replace(basename($image_src[0]), basename($resized_img_path), $image_src[0]);

                    $vt_image = array(
                        'url' => $resized_img_url,
                        'width' => $proportional_size[0],
                        'height' => $proportional_size[1]
                    );

                    return $vt_image;
                }
            }

            // check if image width is smaller than set width
            $img_size = getimagesize($file_path);
            if ($img_size[0] <= $width) $width = $img_size[0];

            // Check if GD Library installed
            if (!function_exists('imagecreatetruecolor')) {
                echo 'GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library';
                return;
            }

            // no cache files - let's finally resize it
            $new_img_path = image_resize($file_path, $width, $height, $crop);
            $new_img_size = getimagesize($new_img_path);
            $new_img = str_replace(basename($image_src[0]), basename($new_img_path), $image_src[0]);

            // resized output
            $vt_image = array(
                'url' => $new_img,
                'width' => $new_img_size[0],
                'height' => $new_img_size[1]
            );

            return $vt_image;
        }

        // default output - without resizing
        $vt_image = array(
            'url' => $image_src[0],
            'width' => $width,
            'height' => $height
        );

        return $vt_image;
    }
}

/*-----------------------------------------------------------------------------------*/
/* Tidy up the image source url */
/*-----------------------------------------------------------------------------------*/
function cleanSource($src)
{

    // remove slash from start of string
    if (strpos($src, "/") == 0) {
        $src = substr($src, -(strlen($src) - 1));
    }

    // Check if same domain so it doesn't strip external sites
    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    if (!strpos($src, $host))
        return $src;


    $regex = "/^((ht|f)tp(s|):\/\/)(www\.|)" . $host . "/i";
    $src = preg_replace($regex, '', $src);
    $src = htmlentities($src);

    // remove slash from start of string
    if (strpos($src, '/') === 0) {
        $src = substr($src, -(strlen($src) - 1));
    }

    return $src;
}

if (!function_exists('prime_pagination')) {

    function prime_pagination($args = array(), $query = '')
    {
        global $wp_query, $wp_rewrite;
        global $FRONTEND_STRINGS;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        $next_text = $FRONTEND_STRINGS['pagination_older'];
        if (key_exists('next_text', $args)) {
            $next_text = $args['next_text'];
        }
        $prev_text = $FRONTEND_STRINGS['pagination_newer'];
        if (key_exists('prev_text', $args)) {
            $prev_text = $args['prev_text'];
        }

        $pagination = array(
            'base' => @add_query_arg('paged', '%#%'),
            'format' => '',
            'total' => $wp_query->max_num_pages,
            'current' => $current,
            'show_all' => false,
            'type' => 'list',
            'next_text' => $next_text,
            'prev_text' => $prev_text,
            'end_size' => 2,
            'mid_size' => 2
        );

        if ($wp_rewrite->using_permalinks())
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');

        if (!empty($wp_query->query_vars['s']))
            $pagination['add_args'] = array('s' => get_query_var('s'));

        echo paginate_links($pagination);
    } // End prime_pagination()

} // End IF Statement

if (!function_exists('prime_portfolio_type')) {
    function prime_portfolio_type($pid)
    {
        $portfolioWrapper = new PrimePortfolioPost($pid);

        return $portfolioWrapper->get_portfolio_type();
    }
}

if (!function_exists('prime_portfolio_type_class')) {
    function prime_portfolio_type_class($pid)
    {
        $portfolio_type = 'image';
        switch (prime_portfolio_type($pid)) {
            case 'EMBED':
                $portfolio_type = 'video';
                break;
            default:
                $portfolio_type = 'image';
                break;
        }
        return $portfolio_type;
    }
}

if (!function_exists('prime_jplayer_swf_url')) {
    function prime_jplayer_swf_url()
    {
        return get_template_directory_uri() . '/js/Jplayer.swf';
    }
}

if (!function_exists('prime_post_nav')) {
    function prime_post_nav()
    {
        ?>
    <a title="previous entry" id="prev-post"
       href="<?php echo get_permalink(get_adjacent_post(false, '', true)); ?>">Previous</a>
    <a title="next entry" id="next-post"
       href="<?php echo get_permalink(get_adjacent_post(false, '', false)); ?>">Next</a>
    <?php

    }
}

//http://www.distractedbysquirrels.com/blog/wordpress-improved-dynamic-excerpt/
if (!function_exists('prime_excerpt')) {
    // Variable & intelligent excerpt length.
    function prime_excerpt($length)
    { // Max excerpt length. Length is set in characters
        global $post;
        $text = $post->post_excerpt;

        if (has_excerpt()) {
            echo apply_filters('the_excerpt', $text);
        }
        else {

            if ('' == $text) {
                $text = get_the_content('');
            }
            $text = strip_shortcodes($text); // optional, recommended
            $text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

            $text = substr($text, 0, $length);
            if (get_prime_options('excerpt_nearest_sentence') == 'Yes') {
                $excerpt = reverse_strrchr($text, '.', 1);
            }
            else {
                $excerpt = trim(reverse_strrchr($text, ' ', 1));
                //trim out characters that shouldn't be followed by an ellipse
                $excerpt = rtrim($excerpt, ':');
                $excerpt = rtrim($excerpt, ';');
                $excerpt = rtrim($excerpt, '&hellip;');
                $last_char = $excerpt[strlen($excerpt) - 1];
                //If not end of sentence, add an ellipse
                if (!in_array($last_char, array('.', '!', '?'))) {
                    $excerpt .= get_prime_options('excerpt_continuation_string');
                }
            }
            if ($excerpt) {
                echo apply_filters('the_excerpt', $excerpt);
            } else {
                echo apply_filters('the_excerpt', $text);
            }
        }
    }

    // Returns the portion of haystack which goes until the last occurrence of needle
    function reverse_strrchr($haystack, $needle, $trail)
    {
        return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
    }
}

if (!function_exists('prime_archive_excerpt')) {
    function prime_archive_excerpt()
    {
        $excerpt_length = intval(get_prime_options('archives_excerpt_length'));
        $excerpt_length = $excerpt_length == 0 ? 150 : $excerpt_length;
        prime_excerpt($excerpt_length);
    }
}

if (!function_exists('prime_recent_posts_excerpt')) {
    function prime_recent_posts_excerpt()
    {
        $excerpt_length = intval(get_prime_options('recent_posts_excerpt_length'));
        $excerpt_length = $excerpt_length == 0 ? 150 : $excerpt_length;
        prime_excerpt($excerpt_length);
    }
}

if (!function_exists('prime_print_text_shadow_css')) {
    function prime_print_text_shadow_css($color, $x, $y, $size, $opacity, $css_selector)
    {
        if ($color) {
            $color_rgba = html2rgb($color);
            $opacity = $opacity ? $opacity : 1;
            printf($css_selector . ' {');

            printf('text-shadow: ' . $x . 'px ' . $y . 'px ' . $size . 'px rgba(' . $color_rgba[0] . ', ' . $color_rgba[2] . ', ' . $color_rgba[2] . ', ' . $opacity . ');');

            printf('}');
        }
    }
}

if (!function_exists('prime_print_box_shadow_css')) {
    function prime_print_box_shadow_css($color, $x, $y, $size, $opacity, $css_selector)
    {
        if ($color) {
            $color_rgba = html2rgb($color);
            $value = $x . 'px ' . $y . 'px ' . $size . 'px rgba(' . $color_rgba[0] . ', ' . $color_rgba[2] . ', ' . $color_rgba[2] . ', ' . $opacity . ');';
            printf($css_selector . ' {');
            printf('box-shadow: ' . $value);
            printf('-webkit-box-shadow: ' . $value);
            printf('-moz-box-shadow: ' . $value);
            printf('}');
        }
    }
}

if (!function_exists('prime_print_border_css')) {
    function prime_print_border_css($color, $width, $pattern, $top, $right, $bottom, $left, $css_selector)
    {
        if ($width && $pattern && $color && $css_selector) {
            print($css_selector . '{');
            if ($top) {
                print('border-top: ' . $width . 'px ' . $pattern . ' ' . $color . ';');
            }
            if ($right) {
                print('border-right: ' . $width . 'px ' . $pattern . ' ' . $color . ';');
            }
            if ($bottom) {
                print('border-bottom: ' . $width . 'px ' . $pattern . ' ' . $color . ';');
            }
            if ($left) {
                print('border-left: ' . $width . 'px ' . $pattern . ' ' . $color . ';');
            }

            print('}');
        }
    }
}

if (!function_exists('prime_print_gradient_fill_css')) {
    function prime_print_gradient_fill_css($color_1, $color_2, $css_selector)
    {

        printf($css_selector . ' {');
        printf('background: ' . $color_2 . ';');
        printf("filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='" . $color_1 . "', endColorstr='" . $color_2 . "');");
        printf("background: -webkit-gradient(linear, left top, left bottom, from(" . $color_1 . "), to(" . $color_2 . "));");
        printf("background: -moz-linear-gradient(top,  " . $color_1 . ",  " . $color_2 . ");");
        printf('} ');

    }
}


if (!function_exists('prime_print_color_css')) {
    function prime_print_color_css($color, $css_selector, $return)
    {
        if($return) {
            return $css_selector . ' { color:' . $color . ';}';
        } else {
            printf($css_selector . ' { color:' . $color . ';}');
        }
    }
}

if (!function_exists('prime_print_background_color_css')) {
    function prime_print_background_color_css($color, $css_selector, $return) {
        $retstring = $css_selector . ' { background-color: ' . $color . ';}';
        if($return) {
            return $retstring;
        } else {
            echo $retstring;
        }
    }
}


if (!function_exists('prime_print_background_image_css')) {
    function prime_print_background_image_css($url, $url_hires, $css_selector)
    {
        if ($url && strlen($url) > 0) {
            printf($css_selector . ' {');
            printf('background-image: url(' . $url . ');');
            printf('}');
        }
        if ($url_hires && strlen($url_hires) > 0) {
            printf('@media only screen and (-webkit-min-device-pixel-ratio: 1.5) {');
            printf($css_selector . ' {');
            printf('background-image: url(' . $url_hires . ');');
            printf('}');
            printf('}');
        }
    }
}


if (!function_exists('prime_print_background_css')) {
    function prime_print_background_css($background, $css_selector)
    {
        $background_options = array('background-color',
            'background-repeat',
            'background-attachment',
            'background-position',
            'background-image');
        if ($background) {

            printf($css_selector . '{');

            // Check to see if only color has been set
            if (!empty($background['background-color']) && empty($background['background-image'])) {
                printf('background: ' . $background['background-color'] . ';');
            }
            else {
                $hasSetting = false;
                foreach ($background_options as $o) {
                    if (!empty($background[$o])) {
                        $hasSetting = true;
                        break;
                    }
                }
                if ($hasSetting) {
                    foreach ($background_options as $o) {
                        if ($o == 'background-image') {
                            printf('%s: url("%s");', $o, $background[$o]);
                        }
                        else {
                            printf('%s: %s;', $o, $background[$o]);
                        }
                    }
                }
            }
            printf('}');
        }
    }
}

if (!function_exists('prime_print_inline_background_css')) {
    function prime_print_inline_background_css($background)
    {
        $background_options = array('background-color',
            'background-repeat',
            'background-attachment',
            'background-position',
            'background-image');

        if ($background) {


            // Check to see if only color has been set
            if (!empty($background['background-color']) && empty($background['background-image'])) {
                printf('background: ' . $background['background-color'] . ';');
            }
            else {
                $hasSetting = false;
                foreach ($background_options as $o) {
                    if (!empty($background[$o])) {
                        $hasSetting = true;
                        break;
                    }
                }
                if ($hasSetting) {
                    foreach ($background_options as $o) {
                        if ($o == 'background-image') {
                            printf('%s: url("%s");', $o, $background[$o]);
                        }
                        else {
                            printf('%s: %s;', $o, $background[$o]);
                        }
                    }
                }
            }

        }
    }
}

if (!function_exists('html2rgb')) {
    function html2rgb($color)
    {
        if ($color[0] == '#')
            $color = substr($color, 1);

        if (strlen($color) == 6)
            list($r, $g, $b) = array($color[0] . $color[1],
                $color[2] . $color[3],
                $color[4] . $color[5]);
        elseif (strlen($color) == 3)
            list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        else
            return false;

        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);

        return array($r, $g, $b);
    }
}

if (!function_exists('get_portfolio_shuffle_text')) {
    function get_portfolio_shuffle_text()
    {
        $text = get_prime_options('shuffle_link_text');
        if (!$text || strlen($text) == 0) {
            $text = 'shuffle';
        }
        return $text;
    }
}

if (!function_exists('get_portfolio_all_filter_text')) {
    function get_portfolio_all_filter_text()
    {
        $text = get_prime_options('all_filter_text');
        if (!$text || strlen($text) == 0) {
            $text = 'all';
        }
        return $text;
    }
}

if (!function_exists('prime_print_layout_class')) {
    function prime_print_layout_class()
    {
        printf('boxed-layout');
    }
}

if (!function_exists('prime_print_skin_class')) {
    function prime_print_skin_class()
    {
        $cookie_skin_key = 'nova_wp_preview_skins';
        if (PRIME_PREVIEW) {
            if(array_key_exists($cookie_skin_key, $_COOKIE)
                && strlen($_COOKIE[$cookie_skin_key]) > 0) {
                    echo $_COOKIE[$cookie_skin_key];
            }
            else {
                echo('skin-teal-grey');
            }
        }
        elseif (get_prime_options('skin')) {
            $skin = str_replace(' ', '-', strtolower(get_prime_options('skin')));
            printf('skin-' . $skin);
        } else {
            echo('skin-teal-grey');
        }
    }
}

if (!function_exists('prime_print_preview_class')) {
    function prime_print_preview_class()
    {
        if(PRIME_PREVIEW) {
            echo 'preview-site';
        }
    }
}

if (!function_exists('get_background_array_from_string')) {
    function get_background_array_from_string($option_string)
    {
        $background = explode(',', $option_string);
        $background_array = array('background-color' => $background[0], 'background-repeat' => $background[1], 'background-attachment' => $background[2],
            'background-position' => $background[3], 'background-image' => $background[4]);
        return $background_array;
    }
}


function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    $start = $length * -1; //negative
    return (substr($haystack, $start) === $needle);
}