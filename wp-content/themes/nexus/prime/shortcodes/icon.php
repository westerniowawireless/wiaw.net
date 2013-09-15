<?php

function prime_shortcode_icon($atts, $content = null) {
    $defaults = array(
        'icon' => 'star',
        'color' => '#444444',
        'circle' => 'false'
    );
    extract(shortcode_atts($defaults, $atts));
    ob_start();

    $icon = 'icon ' . $icon;

    $span_class = 'icon-bg ';
    $span_style= '';
    if($circle != 'false') {
        $span_class .= ' circle';
        $span_style .= ' background-color:' . $circle . ';';
    }

    ?><ul class="entypo-icon-list <?php if($circle != 'false') { echo 'has-circle'; }?>">
        <li><span class="icon-wrapper"><i style="color: <?php echo $color; ?>;" class="<?php echo $icon; ?>"></i></span><span class="<?php echo $span_class;?>"  style="<?php echo $span_style; ?>"><i style="color: <?php echo $color; ?>;" class="<?php echo $icon; ?>"></i></span><?php echo do_shortcode($content); ?></li></ul><?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}