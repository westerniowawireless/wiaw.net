<?php
function prime_shortcode_video($atts, $content = null)
{
    $defaults = array(
        'width' => '600',
        'height' => '400',
        'src' => '',
        'autosize' => 'true',
        'autoplay' => 'false'
    );
    extract(shortcode_atts($defaults, $atts));

    // If there's no src, there's nothing to do
    if (!$src || $src == null || strlen($src) == 0) {
        return;
    }

    $autosize = $autosize == "false" ? false : true;
    $autoplay = $autoplay !== 'false' ? 1 : 0;

    //call the embed
    $shortcode = sprintf('[embed%s%s%s controls="1"]%s[/embed]',
        sprintf(' width="%s" ', $height),
        sprintf(' width="%s" ', $width),
        sprintf(' autoplay="%s"', $autoplay),
        $src);
    $wp_embed = new WP_Embed();
    $post_embed = $wp_embed->run_shortcode($shortcode);

    ob_start();

    $autosize_class = $autosize ? 'autosize' : '';
    $width_attribute = $autosize ? '' : 'width:' . $width . 'px;';

    echo '<div class="embed-wrapper framed-image video-embed-shortcode ' . $autosize_class . '" style="' . $width_attribute . 'height: ' . $height . 'px;" data-width="' . $width . '" data-height="' . $height . '">';

    echo $post_embed;

    echo '</div>';

    ?>
<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}