(function () {
    window.pricing_code = '[pricing columns="4"]\
    [plan title="Starter" button_link="http://www.themeforest.net" button_label="Get Started Today" price="$35"\
    per="per month"]<ul>\
        <li><strong>Free</strong> setup</li>\
        <li><strong>Unlimited</strong> websites</li>\
        <li><strong>30</strong> Site Evaluations</li>\
        <li><strong>25</strong> Projects</li>\
        <li><strong>10GB</strong> Storage</li>\
        <li><strong>$20</strong> Google Adwords credit</li>\
        <li><strong>$20</strong> Amazon Ad credit</li>\
        <li><strong>$20</strong> Bing credit</li>\
        <li><strong>Starter Features:</strong>\
            <ul>\
                <li>Amazing feature</li>\
                <li>Unlimited sweet stuff</li>\
                <li>Our awesomely undying gratitude</li>\
                <li>Plenty of new cool friends</li>\
                <li><a href="#">Tons of other features</a></li>\
            </ul>\
        </li>\
    </ul>\
    [/plan]\
    [plan title="Standard" button_link="http://www.themeforest.net" button_label="Get Started Today" price="$75"\
    per="per month"]\
    <ul>\
        <li><strong>Free</strong> setup</li>\
        <li><strong>Unlimited</strong> websites</li>\
        <li><strong>60</strong> Site Evaluations</li>\
        <li><strong>50</strong> Projects</li>\
        <li><strong>20GB</strong> Storage</li>\
        <li><strong>$40</strong> Google Adwords credit</li>\
        <li><strong>$40</strong> Amazon Ad credit</li>\
        <li><strong>$40</strong> Bing credit</li>\
        <li><strong>Standard Features:</strong>\
            <ul>\
                <li>Amazing feature</li>\
                <li>Unlimited sweet stuff</li>\
                <li>Our awesomely undying gratitude</li>\
                <li>Plenty of new cool friends</li>\
                <li><a href="#">Tons of other features</a></li>\
            </ul>\
        </li>\
    </ul>\
    [/plan]\
    [plan title="Business" button_link="http://www.themeforest.net" button_label="Get Started Today" price="$125"\
    per="per month" featured="true" featured_msg="Most Popular"]\
    <ul>\
        <li><strong>Free</strong> setup</li>\
        <li><strong>Unlimited</strong> websites</li>\
        <li><strong>90</strong> Site Evaluations</li>\
        <li><strong>100</strong> Projects</li>\
        <li><strong>30GB</strong> Storage</li>\
        <li><strong>$60</strong> Google Adwords credit</li>\
        <li><strong>$60</strong> Amazon Ad credit</li>\
        <li><strong>$100</strong> Bing credit</li>\
        <li><strong>Business Features:</strong>\
            <ul>\
                <li>Amazing feature</li>\
                <li>Unlimited sweet stuff</li>\
                <li>Our awesomely undying gratitude</li>\
                <li>Plenty of new cool friends</li>\
                <li><a href="#">Tons of other features</a></li>\
            </ul>\
        </li>\
    </ul>\
    [/plan]\
    [plan title="Executive" button_link="http://www.themeforest.net" button_label="Get Started Today" price="$200"\
    per="per month"]\
    <ul>\
        <li><strong>Free</strong> setup</li>\
        <li><strong>Unlimited</strong> websites</li>\
        <li><strong>120</strong> Site Evaluations</li>\
        <li><strong>200</strong> Projects</li>\
        <li><strong>40GB</strong> Storage</li>\
        <li><strong>$80</strong> Google Adwords credit</li>\
        <li><strong>$80</strong> Amazon Ad credit</li>\
        <li><strong>$200</strong> Bing credit</li>\
        <li><strong>Executive Features:</strong>\
            <ul>\
                <li>Amazing feature</li>\
                <li>Unlimited sweet stuff</li>\
                <li>Our awesomely undying gratitude</li>\
                <li>Plenty of new cool friends</li>\
                <li><a href="#">Tons of other features</a></li>\
            </ul>\
        </li>\
    </ul>\
    [/plan]\
    [/pricing]';

    window.iconIconOptions = [
        'adduser',
        'airplane',
        'attachment',
        'back',
        'backarrow',
        'bag',
        'beginningtrack',
        'bell',
        'bolt',
        'bookmark',
        'brokenlink',
        'cabinet',
        'calender',
        'camera',
        'cancel',
        'caution',
        'checkmark',
        'clock',
        'clockwise',
        'cloud',
        'cloudupload',
        'comment',
        'compass',
        'compasshand',
        'conversation',
        'copydocument',
        'counterclockwise',
        'creativecommons',
        'crosshair',
        'crosspaths',
        'document',
        'doubleback',
        'downarrow',
        'downarrowcircle',
        'downarrowsmall',
        'download',
        'endtrack',
        'envato',
        'eye',
        'flag',
        'flashlight',
        'folder',
        'forward',
        'gear',
        'hdd',
        'heart',
        'home',
        'hourglass',
        'info',
        'infocircle',
        'landscape',
        'leftarrow',
        'leftarrowcircle',
        'leftarrowsmall',
        'lifesaver',
        'link',
        'list',
        'listadd',
        'lock',
        'looparrow',
        'mail',
        'map',
        'mappin',
        'maximize',
        'microphone',
        'minus',
        'minuscircle',
        'moon',
        'mouse',
        'music',
        'musicnote',
        'newwindow',
        'nexttrack',
        'palette',
        'pause',
        'phone',
        'photos',
        'play',
        'plus',
        'pluscircle',
        'portrait',
        'previoustrack',
        'printer',
        'profile',
        'questioncircle',
        'questionmark',
        'record',
        'rightarrow',
        'rightarrowcircle',
        'rightarrowsmall',
        'rightquote',
        'rings',
        'roadsign',
        'rss',
        'signal',
        'smartphone',
        'star',
        'stop',
        'tag',
        'thumbsup',
        'trash',
        'trophy',
        'unlock',
        'uparrow',
        'uparrowcircle',
        'uparrowsmall',
        'upload',
        'user',
        'usergroup',
        'video',
        'volume',
        'volumeoff',
        'volumeon',
        'widewindow',
        'window',
        'write',
        'xmark',
        'xmarkcircle',
        'zoomin',
        'zoomout'
    ];
}());

function prime_js_querystring(ji) {

    hu = window.location.search.substring(1);
    gy = hu.split("&");
    for (i = 0; i < gy.length; i++) {

        ft = gy[i].split("=");
        if (ft[0] == ji) {

            return ft[1];

        } // End IF Statement

    } // End FOR Loop

} // End prime_js_querystring()

(

    function () {

        // Get the URL to this script file (as JavaScript is loaded in order)
        // (http://stackoverflow.com/questions/2255689/how-to-get-the-file-path-of-the-currenctly-executing-javascript-code)

        var scripts = document.getElementsByTagName("script"),
            src = scripts[scripts.length - 1].src;

        if (scripts.length) {

            for (i in scripts) {

                var scriptSrc = '';

                if (typeof scripts[i].src != 'undefined') {
                    scriptSrc = scripts[i].src;
                } // End IF Statement

                var txt = scriptSrc.search('shortcode-generator');

                if (txt != -1) {

                    src = scripts[i].src;

                } // End IF Statement

            } // End FOR Loop

        } // End IF Statement

        var framework_url = src.split('/js/');

        var icon_url = framework_url[0] + '/images/shortcode-icon.png';

        tinymce.create(
            "tinymce.plugins.PrimeShortcodes",
            {
                init:function (d, e) {
                    d.addCommand("primeVisitPrime", function () {
                        window.open("http://primethemes.com/")
                    });

                    d.addCommand("primeOpenDialog", function (a, c) {

                            // Grab the selected text from the content editor.
                            selectedText = '';

                            if (d.selection.getContent().length > 0) {

                                selectedText = d.selection.getContent();

                            } // End IF Statement

                            primeSelectedShortcodeType = c.identifier;
                            primeSelectedShortcodeTitle = c.title;


                            jQuery.get(e + "/dialog.php",
                                function (b) {

                                    jQuery('#prime-options').addClass('shortcode-' + primeSelectedShortcodeType);
                                    jQuery('#prime-preview').addClass('shortcode-' + primeSelectedShortcodeType);

                                    // Skip the popup on certain shortcodes.

                                    switch (primeSelectedShortcodeType) {

                                        // Dropcap

//                                        case 'dropcap':
//
//                                            var a = '[dropcap]' + selectedText + '[/dropcap]';
//
//                                            tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
//
//                                            break;

                                        default:

                                            jQuery("#prime-dialog").remove();
                                            jQuery("body").append(b);
                                            jQuery("#prime-dialog").hide();
                                            var f = jQuery(window).width();
                                            b = jQuery(window).height();
                                            f = 720 < f ? 720 : f;
                                            f -= 80;
                                            b -= 84;

                                            tb_show("Insert Prime " + primeSelectedShortcodeTitle + " Shortcode", "#TB_inline?width=" + f + "&height=" + b + "&inlineId=prime-dialog");
                                            jQuery("#prime-options h3:first").text("Customize the " + c.title + " Shortcode");

                                            break;

                                    } // End SWITCH Statement

                                }

                            )

                        }
                    );

                },

                createControl:function (d, e) {

                    if (d == "primethemes_shortcodes_button") {

                        d = e.createMenuButton("primethemes_shortcodes_button", {
                            title:"Insert Prime Shortcode",
                            image:icon_url,
                            icons:false
                        });

                        var a = this;
                        d.onRenderMenu.add(function (c, b) {
                            a.addWithDialog(b, 'Accordion', 'accordion');
                            a.addWithDialog(b, "Alert", "alert");
                            a.addWithDialog(b, "Animate", 'animate');
                            a.addWithDialog(b, "Blockquote", "blockquote");
                            a.addWithDialog(b, "Button", "button");
                            a.addWithDialog(b, "Codebox", "codebox");
                            a.addWithDialog(b, "Display", "display");

                            a.addImmediate(b, 'Display Desktop', '[display_desktop]<p>This content will only be displayed when the window is 960px+ wide.</p>[/display_desktop]');
                            a.addImmediate(b, 'Display Tablet', '[display_tablet]<p>This content will only be displayed when the window is between 768px and 959px wide.</p>[/display_tablet]');
                            a.addImmediate(b, 'Display Mobile (Land.)', '[display_mobile_landscape]<p>This content will only be displayed when the window is between 480px and 767px wide.</p>[/display_mobile_landscape]');
                            a.addImmediate(b, 'Display Mobile (Port.)', '[display_mobile_portrait]<p>This content will only be displayed when the window is less than 480px wide.</p>[/display_mobile_portrait]');

                            a.addImmediate(b, "Divider", "[divider] ");
                            a.addWithDialog(b, "Dropcap", 'dropcap');
                            a.addWithDialog(b, "Flex Slider", 'flex_slider');
                            a.addWithDialog(b, "Gallery", "prime_gallery");
                            a.addWithDialog(b, "Icon", "icon");

                            a.addWithDialog(b, "Image", "image");
                            a.addWithDialog(b, "List", "list");
                            a.addWithDialog(b, "List Item", "list_item");

                            a.addWithDialog(b, "Message", "message");

                            a.addImmediate(b, 'Pricing', window.pricing_code);

                            a.addWithDialog(b, "Pullquote", "pullquote");
                            a.addWithDialog(b, "Recent Posts", "recent_posts");
                            a.addWithDialog(b, "Recent Posts (Vertical)", "recent_posts_vertical");
                            a.addWithDialog(b, "Recent Projects", "recent_projects");
                            a.addWithDialog(b, "Social", "social");

                            a.addWithDialog(b, "Spacer", "spacer");

                            a.addImmediate(b, "Table", '[table]<table class="custom-table" summary="Sample Table">\<' +
                                'thead><tr><th scope="col">Header 1</th><th scope="col">Header 2</th><th scope="col">' +
                                'Header 3</th><th scope="col">Header 4</th></tr></thead><tbody><tr><td>Item 1</td><td>' +
                                'Description</td><td>Subtotal:</td><td>$0.00</td></tr><tr><td>Item 2</td><td>Description' +
                                '</td><td>Discount:</td><td>$0.00</td></tr><tr><td>Item 3</td><td>Description</td><td>' +
                                'Shipping:</td><td>$0.00</td></tr><tr><td>Item 4</td><td>Description</td><td>Tax:</td><td>' +
                                '$0.00</td></tr><tr><td>Item 1:</td><td>Description</td><td><strong>TOTAL:</strong></td><td>' +
                                '<strong>$0.00</strong></td></tr></tbody><tfoot><tr><td colspan="4">*Table Footer here...</td>' +
                                '</tr></tfoot></table>[/table]');
                            a.addWithDialog(b, "Toggle", "toggle");
                            a.addWithDialog(b, "Video Embed", "video");
                            b.addSeparator();
                            a.addWithDialog(b, "Column Layout", "column");
                            a.addWithDialog(b, "Tab Layout", "tab");
                        });
                        return d

                    } // End IF Statement

                    return null
                },

                addImmediate:function (d, e, a) {
                    d.add({title:e, onclick:function () {
                        tinyMCE.activeEditor.execCommand("mceInsertContent", false, a)
                    }})
                },

                addWithDialog:function (d, e, a) {
                    d.add({title:e, onclick:function () {
                        tinyMCE.activeEditor.execCommand("primeOpenDialog", false, {title:e, identifier:a})
                    }})
                },

                getInfo:function () {
                    return{longname:"Prime Shortcode Generator", author:"VisualShortcodes.com", authorurl:"http://visualshortcodes.com", infourl:"http://visualshortcodes.com/shortcode-ninja", version:"1.0"}
                }
            }
        );

        tinymce.PluginManager.add("PrimeShortcodes", tinymce.plugins.PrimeShortcodes)
    }
    )();
