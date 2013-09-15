<?php
function prime_shortcode_pullquote($atts, $content = null)
{
    $defaults = array(
        'style' => 'left',
    );
    extract(shortcode_atts($defaults, $atts));

    ob_start();
    ?>
    <span class="pullquote <?php echo $style; ?>"><?php echo prime_remove_autop(do_shortcode($content)); ?></span>

<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}