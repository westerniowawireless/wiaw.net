<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 4/5/12
 * Time: 11:15 AM
 * To change this template use File | Settings | File Templates.
 */

function prime_shortcode_map($atts, $content = null)
{
    global $prime_sc_helper;

    $sc_atts = shortcode_atts(array('width' => '100%',
                                   'height' => '500px',
                                   'address' => 'Atlanta, GA',
                                   'latitude' => '',
                                   'longitude' => '',
                                   'zoom' => '8',
                                   'html' => '',
                                   'pancontrol' => 'true',
                                   'zoomcontrol' => 'true',
                                   'maptypecontrol' => 'true',
                                   'scalecontrol' => 'true',
                                   'streetviewcontrol' => 'true',
                                   'overviewmapcontrol' => 'true',
                                   'scrollwheel' => 'true',
                                   'maptype' => 'ROADMAP',
                                   'marker' => 'true',
                                   'style' => '',
									'full' => 'false'
                              ), $atts);
    extract($sc_atts);

	$full = $full == 'true' ? true : false;

    if($full) {
        $width = "auto";
    }

    ob_start();
    ?>
<div style="width:<?php echo $width; ?>;" class="map-wrapper <?php if($full) echo 'full'; ?>">
<div id="map_canvas" class="map-canvas <?php echo $style; ?>"
     style="height:<?php echo $height; ?>"
    <?php $prime_sc_helper->print_data_attributes($sc_atts); ?>></div>
<?php if($full) { ?>
	<div class="overlay-divider" style="bottom: 0;top:auto;"></div>
<?php } ?>
</div>
<?php

    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}