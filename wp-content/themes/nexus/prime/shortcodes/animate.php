<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 5/23/12
 * Time: 11:18 AM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Shortcode that wraps content with a div with classes to apply animate.css behaviors.
 * @param $atts
 * @param null $content
 * @return string
 */
function prime_shortcode_animate($atts, $content = null)
{
    $defaults = array(
        'animation' => 'bounceInLeft',
        'duration' => NULL,
        'delay' => NULL,
        'iterations' => NULL
    );

    extract(shortcode_atts($defaults, $atts));

    $style = '';

    if (!empty($duration)) {
        $style .= sprintf('animation-duration: %1$s;-moz-animation-duration: %1$s;-webkit-animation-duration: %1$s;-ms-animation-duration: %1$s;-o-animation-duration: %1$s;',
            $duration);
    }

    if (!empty($delay)) {
        $style .= sprintf('animation-delay: %1$s;-moz-animation-delay: %1$s;-webkit-animation-delay: %1$s;-ms-animation-delay: %1$s;-o-animation-delay: %1$s;',
            $delay);
    }

    if (!empty($iterations)) {
        $style .= sprintf('animation-iteration-count: %1$s;-moz-animation-iteration-count: %1$s;-webkit-animation-iteration-count: %1$s;-ms-animation-iteration-count: %1$s;-o-animation-iteration-count: %1$s;',
            $iterations);
    }

    ob_start();
    ?>
<div class="animated <?php echo $animation; ?>" data-transition="<?php echo $animation; ?>"
     style="<?php echo $style; ?>"
    >
    <?php echo do_shortcode($content); ?>
</div>
<?php

    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}