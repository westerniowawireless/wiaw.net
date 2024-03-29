<?php if (!defined('PO_VERSION')) exit('No direct script access allowed');
/**
 * Input Option
 *
 * @access public
 * @since 1.0.0
 *
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 */
function prime_options_option_tree_input($value, $settings, $int)
{
    $class = '';
    if (isset($value->item_options) && isset($value->item_options->class)) $class = $value->item_options->class;

    ?>
<div class="option option-input">
    <h3><?php echo htmlspecialchars_decode($value->item_title); ?></h3>

    <div class="section">
        <div class="element">
            <input type="text" class="<?php echo $class; ?>"
                   name="<?php echo isset($value->item_name) ? $value->item_name : $value->item_id; ?>"
                   id="<?php echo $value->item_id; ?>" value="<?php if (isset($settings[$value->item_id])) {
                echo htmlspecialchars(stripslashes($settings[$value->item_id]), ENT_QUOTES);
            } ?>"/>
        </div>
        <div class="description">
            <?php echo htmlspecialchars_decode($value->item_desc); ?>
        </div>
    </div>
</div>
<?php

}