<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 2/22/12
 * Time: 11:52 AM
 * To change this template use File | Settings | File Templates.
 */

function prime_options_option_tree_option_data($value, $settings, $int)
{
    ?>
<div class="option option-textarea">
    <h3><?php echo htmlspecialchars_decode($value->item_title); ?></h3>

    <div class="section">
        <div class="element">
            <textarea readonly rows="<?php echo $int; ?>"><?php echo base64_encode(serialize($settings)); ?></textarea>
        </div>

        <div class="description">
            <?php echo htmlspecialchars_decode($value->item_desc); ?>
        </div>
    </div>
</div>
<?php

}

function prime_options_option_tree_demo_import($value, $settings, $int)
{
    ?>
<div class="option option-textarea">
    <h3><?php echo htmlspecialchars_decode($value->item_title); ?></h3>

    <div class="section">
        <div class="element">
            <div id="import_demo_options" class="block">
                <input type="submit" value="Import Content & Options" class="ob_button right import-demo"/>
            </div>
        </div>

        <div class="description">
            <?php echo htmlspecialchars_decode($value->item_desc); ?>
        </div>
    </div>
</div>
<?php

}