<?php
/*
 * type: 'warning', 'success', 'info', 'error'
 */
function prime_shortcode_alert($atts, $content = null)
{
    $defaults = array(
        'type' => 'warning',
        'block_message' => '',
        'show_close' => '',
		'color' => ''
    );
    extract(shortcode_atts($defaults, $atts));

    if ($block_message && $block_message != 'false') $block_message = 'block-message';

	$style_att = $color == '' ? '' : 'style="background-color:' . $color . ';"';
	

    ob_start();
    ?>
<div class="alert-message alert-shortcode <?php echo sprintf('%s %s', $type, $block_message); ?> fade in" data-alert="alert" <?php echo $style_att; ?>>
    <?php if($show_close != 'false') echo '<a class="close" href="#">&times;</a>'; ?><?php echo do_shortcode($content); ?>
</div>

<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}

function prime_shortcode_message($atts, $content = null)
{
    $defaults = array(
        'type' => 'warning',
        'block_message' => 'true',
        'show_close' => '',
		'color' => '',
		'border' => '',
    );
    extract(shortcode_atts($defaults, $atts));

    if ($block_message && $block_message != 'false') $block_message = 'block-message';

	$color_css = $color == '' ? '' : 'background-color:' . $color . ';';
	$border_css = $border == '' ? '' : 'border-color:' . $border . ';';
	
	$style_att = $color == '' && $border == '' ? '' : 'style="' . $color_css . $border_css . '"';
	

    ob_start();
    ?>
<div class="alert-message <?php echo sprintf('%s %s', $type, $block_message); ?> fade in" data-alert="alert" <?php echo $style_att; ?>>
    <?php if($show_close != 'false') echo '<a class="close" href="#">&times;</a>'; ?>
    <?php echo do_shortcode($content); ?>
</div>

<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}