<?php
function prime_shortcode_table($atts, $content = null)
{
    $defaults = array(
        'color' => '#444'
    );
    extract(shortcode_atts($defaults, $atts));

    $table_id = uniqid('flexslider');

    ob_start();

    if($color != '') {
    ?>

    <style type="text/css">
        #<?php echo $table_id ?> > table > thead > tr > th{
            background-color: <?php echo $color; ?>;
        }
    </style>
    <?php } ?>

<div class="styled-table" id="<?php echo $table_id; ?>">
    <?php echo wpautop(prime_remove_autop(do_shortcode($content))); ?>
</div>
<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}
