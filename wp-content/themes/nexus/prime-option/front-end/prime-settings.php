<?php if (!defined('PO_VERSION')) exit('No direct script access allowed'); ?>

<div id="framework_wrap" class="wrap">

    <!--	<div id="header">-->
    <!--    <h1>OptionTree</h1>-->
    <!--    <span class="icon">&nbsp;</span>-->
    <!--    <div class="version">-->
    <!--      --><?php //echo // PO_VERSION; ?>
    <!--    </div>-->
    <!--	</div>-->

    <div id="icon-tools" class="icon32"></div>
    <h2>Theme Options - Import &amp; Export</h2>

    <div id="content_wrap">

        <!--    <div class="info top-info">-->
        <!--    </div>-->

        <div class="ajax-message<?php if (isset($_GET['xml']) || isset($_GET['error']) || isset($_GET['nofile']) || isset($_GET['empty']) || isset($_GET['layout']) || isset($message)) {
            echo ' show';
        } ?>">
            <?php if (isset($_GET['xml'])) {
            echo '<div class="message"><span>&nbsp;</span>Theme Options Created</div>';
        } ?>
            <?php if (isset($_GET['error'])) {
            echo '<div class="message warning"><span>&nbsp;</span>Wrong File Type!</div>';
        } ?>
            <?php if (isset($_GET['nofile'])) {
            echo '<div class="message warning"><span>&nbsp;</span>Please add a file.</div>';
        } ?>
            <?php if (isset($_GET['empty'])) {
            echo '<div class="message warning"><span>&nbsp;</span>An error occurred while importing your data.</div>';
        } ?>
            <?php if (isset($_GET['layout'])) {
            echo '<div class="message"><span>&nbsp;</span>Your Layouts were successfully imported.</div>';
        } ?>
            <?php if (isset($message)) {
            echo $message;
        } ?>
        </div>

        <div id="content">
            <div id="options_tabs">
                <ul class="options_tabs">
                    <li><a href="#import_options">Import</a><span></span></li>
                    <li><a href="#export_options">Export</a><span></span></li>
                </ul>

                <div id="import_options" class="block">
                    <h2>Import</h2>

                    <form method="post" id="import-data">
                        <div class="option option-input">
                            <h3>Theme Options Data</h3>

                            <div class="section">
                                <div class="element">
                                    <textarea name="import_options_data" rows="8" id="import_options_data"
                                              class="import_options_data"></textarea>
                                </div>
                                <div class="description">
                                    <p>Only after you've imported the Theme Options XML file should you try and update
                                        your Theme Options Data.</p>

                                    <p>To import the values of your theme options copy and paste what appears to be a
                                        random string of alpha numeric characters into this textarea and press the
                                        "Import Data" button below.</p>

                                    <p>NOTE: The Portfolio theme options and Custom Sidebar theme options depend on Page
                                        IDs. So, if you've imported your theme content via the WordPress Importer
                                        Plugin, after you're done importing your theme options here, you'll want to
                                        check <em>Appearance > Theme Options > Portfolios</em> and <em>Appearance >
                                            Theme Options > Custom Sidebars</em> to ensure that your sidebars and
                                        portfolios are displaying on the pages you want them to.</p>
                                </div>
                            </div>
                            <input type="submit" value="Import Data" class="ob_button right import-data"/>
                        </div>
                        <?php wp_nonce_field('_import_data', '_ajax_nonce', false); ?>
                    </form>

                </div>

                <div id="export_options" class="block">
                    <h2>Export</h2>

                    <div class="option option-input">
                        <h3>Theme Options Data</h3>

                        <div class="section">
                            <div class="element">
                                <textarea name="export_data" id="export_data"
                                          rows="8"><?php echo $exportString; ?></textarea>
                            </div>
                            <div class="description">
                                Export your saved Theme Options data by highlighting this text and doing a copy/paste
                                into a blank .txt file. Then save the file for importing into another install of
                                WordPress later. Alternatively, you could just paste it into the <code>OptionTree->Settings->Import</code>
                                on another web site.
                            </div>
                        </div>
                    </div>
                </div>

                <br class="clear"/>
            </div>
        </div>
        <div class="info bottom">
            <input type="hidden" name="action" value="save"/>
        </div>
    </div>

</div>
<!-- [END] framework_wrap -->