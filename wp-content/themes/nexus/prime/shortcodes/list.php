<?php

$styled_list_icon = null;

function prime_shortcode_list($atts, $content = null)
{
    $defaults = array(
        'icon' => 'star',
    );
    extract(shortcode_atts($defaults, $atts));

    global $styled_list_icon;
    $styled_list_icon = $icon;

    ob_start();
    ?>
<ul><?php echo wpautop(prime_remove_autop(do_shortcode($content))); ?></ul>
<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    $styled_list_icon = null;
    return wpautop(prime_remove_autop($ret_val));
}

function prime_shortcode_list_item($atts, $content = null)
{
    $defaults = array(
        'icon' => null,
    );
    extract(shortcode_atts($defaults, $atts));
    ob_start();

    global $styled_list_icon;
    if ($icon == null) {
        $icon = $styled_list_icon;
    }
    $icon = 'icon-' . $icon;

    ?>
<li class="<?php echo $icon; ?>"><?php echo do_shortcode($content); ?></li>
<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;

}
