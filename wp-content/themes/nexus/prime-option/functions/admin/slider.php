<?php if (!defined('PO_VERSION')) exit('No direct script access allowed');
/**
 * Image Slider Option
 *
 * @access public
 * @since 1.1.3
 *
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 */
function prime_options_option_tree_slider($value, $settings, $int)
{
    ?>
<div class="option option-option-tree-slider">
    <h3><?php echo htmlspecialchars_decode($value->item_title); ?></h3>

    <div class="section">
        <div class="element">
            <?php $count = 0; ?>
            <ul class="ui-sortable option-tree-slider-wrap" id="<?php echo $value->item_id; ?>_list">
                <?php
                        if (!empty($settings[$value->item_id])) {
                foreach ($settings[$value->item_id] as $image) {
                    ?>
                    <li><?php prime_options_option_tree_slider_view($value->item_id, $image, $int, $count, $value->item_options); ?></li><?php
                    $count++;
                }
            }
                ?>
            </ul>
            <a href="#" id="<?php echo $value->item_id; ?>" class="button-framework light add-slide right">Add</a>
        </div>
        <div class="description">
            <?php echo htmlspecialchars_decode($value->item_desc); ?>
        </div>
    </div>
</div>
                <?php

}


/**
 * Image Slider HTML
 *
 * @access public
 * @since 1.1.3
 *
 * @param string $id
 * @param array $image
 * @param int $count
 *
 * @return string
 */
function prime_options_option_tree_slider_view($id, $image, $int, $count, $image_slider_fields)
{
    ?>
<div id="option-tree-slider-editor_<?php echo $count; ?>" class="option-tree-slider">
    <div class="open">
        <?php echo empty($image['title']) ? "Slide " . ($count + 1) : stripslashes($image['title']); ?>
    </div>
    <a href="#" class="edit">Edit</a>
    <a href="#" class="trash remove-slide">Delete</a>

    <div class="option-tree-slider-body">
        <?php
        foreach ($image_slider_fields as $field) {
        $field = arrayToObject($field);
        $field->item_id = sprintf('%s-%s-%s', $id, $field->item_local_id, $count);
        $field->item_name = sprintf('%s[%s][%s]', $id, $count, $field->item_local_id);

        $image[$field->item_id] = isset($image[$field->item_local_id]) ? $image[$field->item_local_id] : NULL;

        option_tree_render_single_slider_element($field, $image);
    }
        ?>
    </div>
</div>
        <?php

}