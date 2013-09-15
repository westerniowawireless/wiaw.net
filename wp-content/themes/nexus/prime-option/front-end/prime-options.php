<?php if (!defined('PO_VERSION')) exit('No direct script access allowed'); ?>
<div id="framework_wrap" class="wrap">

    <!-- <div id="header">
        <h1>OptionTree</h1>
        <span class="icon">&nbsp;</span>
        <div class="version">
          <?php // echo PO_VERSION; ?>
        </div>
    </div> -->

    <div id="icon-options-general" class="icon32"></div>
    <h2>Theme Options</h2>

    <div id="content_wrap">

        <form method="post" id="the-theme-options">

            <div class="info top-info is-option-page">

                <input type="submit"
                       value="<?php global $FRONTEND_STRINGS; echo $FRONTEND_STRINGS['ot_save_all_changes'] ?>"
                       class="button-framework save-options" name="submit"/>

                <div class="top-layout-bar">

                    <div class="save-layout-wrap">
                        <input type="text" name="options_name" value="" id="save_theme_layout"/>
                        <input type="submit" value="<?php echo $FRONTEND_STRINGS['ot_new_layout']; ?>"
                               class="button-framework user-save-layout" name="user-save-layout"/>
                    </div>


                </div>

            </div>

            <div class="ajax-message<?php if (isset($message) || isset($_GET['updated']) || isset($_GET['layout']) || isset($_GET['layout_saved'])) {
                echo ' show';
            } ?>">
                <?php if (isset($_GET['updated'])) {
                echo '<div class="message"><span>&nbsp;</span>Theme Options were updated.</div>';
            } ?>
                <?php if (isset($_GET['layout'])) {
                echo '<div class="message"><span>&nbsp;</span>Your Layout has been activated.</div>';
            } ?>
                <?php if (isset($_GET['layout_saved'])) {
                echo '<div class="message"><span>&nbsp;</span>Layout Saved Successfully.</div>';
            } ?>
                <?php if (isset($message)) {
                echo $message;
            } ?>
            </div>

            <div id="content">

                <div id="options_tabs">

                    <ul class="options_tabs">
                    <?php
                                            foreach ($ot_array as $value)
                    {
                        if ($value->item_type == 'heading') {
                            echo '<li><a href="#option_' . $value->item_id . '">' . htmlspecialchars_decode($value->item_title) . '</a><span></span></li>';
                        }
                    }
                        ?>
                    </ul>

                    <?php
                    // loop options & load corresponding function
                    foreach ($ot_array as $value) {
                        option_tree_render_single_element($value);
                    }
                    // close heading
                    echo '</div>';
                    ?>

                    <br class="clear"/>

                </div>

            </div>

            <div class="info bottom">

                <input type="submit" value="<?php echo $FRONTEND_STRINGS['ot_reset_options']; ?>"
                       class="button-framework reset" name="reset"/>
                <input type="submit" value="<?php echo $FRONTEND_STRINGS['ot_save_all_changes']; ?>"
                       class="button-framework save-options"
                       name="submit"/>

            </div>

            <?php wp_nonce_field('_theme_options', '_ajax_nonce', false); ?>

        </form>

    </div>

</div>
<!-- [END] framework_wrap -->