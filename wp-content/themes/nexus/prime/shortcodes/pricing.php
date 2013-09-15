<?php
function prime_shortcode_pricing($atts, $content = null) {

    $defaults = array('style' => 'default', 'full' => 'false',
		'columns' => '4');
    
	extract(shortcode_atts($defaults, $atts));


	$full = $full == 'true' ? true : false;
    $columns = intval($columns);

	ob_start(); ?>
	
	<div class="pricing-table columns-<?php echo $columns; ?> <?php if($full) echo 'full'; ?>">
		<?php echo prime_remove_autop(do_shortcode($content)); ?>
		<div class="clear"></div>
	</div>
	
	<?php
	$retval = ob_get_contents();
	ob_end_clean();
	$retval = prime_remove_autop($retval);
	$retval = str_replace('<br />', '', $retval);
	return $retval;
}

function prime_shortcode_plan($atts, $content = null) {
    $defaults = array('style' => 'default',
        'title' => 'Edition',
        'button_link' => '#',
        'button_label' => 'Sign Up',
        'price' => '$25',
        'per' => 'month',
        'featured' => 'false',
        'color' => '#191919',
        'symbol' => '$'
    );

    extract(shortcode_atts($defaults, $atts));

    $featured = $featured == "false" ? false : true;

    ob_start();?>
	<div class="plan <?php if($featured) echo 'featured'; ?>">
        <div class="inner">
	        <div class="plan-header">
                <h3><?php echo $title; ?></h3>
	            <div class="price"><?php echo $price; ?></div>
				<div class="period"><?php echo $per; ?></div>
				<div class="plan-action">
	                <?php echo do_shortcode('[button link="'
	                . $button_link
	                . '" style="default" window="false"]'
	                . $button_label
	                . '[/button]'); ?>
	            </div>
	        </div>

	        <?php echo prime_remove_autop(do_shortcode($content)); ?>

		</div>
    </div>

    <?php
    $ret_val = ob_get_contents();
    ob_end_clean();
    return prime_remove_autop($ret_val);
}

?>