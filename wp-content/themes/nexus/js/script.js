/* Author:
 Adaptive Themes
 */

jQuery(document).ready(function ($) {



    jQuery('.cpslider').primeCPSlider({});
    jQuery('.prime-content-slider').primeCPSlider({});

    jQuery('.prime-ajax-image').primeAJAXReponsiveImage({});

//    jQuery('.map-canvas').primeGoogleMap({});

    jQuery('.tabs').primetabs({});
    jQuery('#scrollview-container').primeFilterScrollview({});

    jQuery('.flex-sc').primeGallerySlider({});

    jQuery('.jquery-player-wrapper').primeHTML5Video({});

    jQuery('.root-jplayer-audio').primeHTML5Audio({});

    jQuery('.search-widget input[type="text"]').primeSearchBox({});

    jQuery('div.video-embed-shortcode.autosize').primeEmbedSizing({});

    jQuery('a.divider-top-link').primeDividerSmoothScroll({});

    jQuery('ul.topmenu').primeHeaderMenu({});

    jQuery('a.mobile-menu-btn').primeMobileMenuToggle({});

    jQuery('ul.tablet-menu li.menu-parent-item > a').primeTabletSubmenuClose();

    jQuery(document).primeMenuHover({});

    jQuery('a.accordion-toggle').primeToggleIcon({});

    jQuery('.prime-gallery[data-autoresize="1"]').primeGallery({});

    jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false, overlay_gallery:false, deeplinking:false});

    if (jQuery('html.ie8').length == 0) jQuery('html.no-touch div.pricing-table').primePricingTableAnimate({});

    jQuery('html.preview-site').primePreview({});

    //Call Twitter Bootstrap plugins
    jQuery(".alert-message").alert();

    // Prevent iOS from zooming in on elements on focus
    var $viewportMeta = jQuery('meta[name="viewport"]');
    jQuery('input, select, textarea').bind('focus blur', function (event) {
        $viewportMeta.attr('content', 'width=device-width,initial-scale=1,maximum-scale=' + (event.type == 'blur' ? 10 : 1));
    });

    // Assign column & row labels to tds
    jQuery('div.styled-table').each(function () {
        var $columns = jQuery('table > thead > tr > th', jQuery(this));
        var $rows = jQuery('table > tbody > tr');
        for (var i = 0; i < $columns.length; i++) {
            var $row = $rows[i];
            var $cells = jQuery('td', $row);
            for (var j = 0; j < $cells.length; j++) {
                jQuery($cells[j]).attr('data-col-label', $columns[j].innerHTML);
                jQuery($cells[j]).attr('data-row-label', $cells[0].innerHTML);
            }
        }
    });

    prettyPrint();

    jQuery('body').primeLayoutTracker({});

    jQuery('div.social-shortcode.counter-right div.fb-like').each(function () {
        // Needed or the facebook like button becomes extremely wide
//        jQuery(this).css('max-width', (parseInt(jQuery(this).attr('data-width')) + 15) + 'px');
    })

    var os = (function () {
        var ua = navigator.userAgent.toLowerCase();
        return {
            isWin2K:/windows nt 5.0/.test(ua),
            isXP:/windows nt 5.1/.test(ua),
            isVista:/windows nt 6.0/.test(ua),
            isWin7:/windows nt 6.1/.test(ua),
            isMac:/macintosh/.test(ua)
        };
    }());


    // Needed for IE10 Touch Hover
    jQuery('li.menu-parent-item > a').attr('aria-haspopup', 'true');

    if (jQuery.browser.mozilla) jQuery('html').addClass('mozilla');
    if (jQuery.browser.msie) {
        jQuery('html').addClass('msie');
        if (jQuery.browser.version == '8.0') {
            jQuery('html').addClass('ie8');
        } else if (jQuery.browser.version == '9.0') {
            jQuery('html').addClass('ie9');
        } else if (jQuery.browser.version == '10.0') {
            jQuery('html').addClass('ie10');
        }
    }
    if (jQuery.browser.webkit) jQuery('html').addClass('webkit');
    if (os.isWin7 || os.isVista || os.isXP || os.isWin2K) {
        jQuery('html').addClass('ms-windows');
    } else if (os.isMac) {
        jQuery('html').addClass('macintosh');
    }

    // Code to differentiate between Safari and Chrome
    var userAgent = navigator.userAgent.toLowerCase();
    jQuery.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase());
    // Is this a version of Chrome?
    if(jQuery.browser.chrome){
        userAgent = userAgent.substring(userAgent.indexOf('chrome/') +7);
        userAgent = userAgent.substring(0,userAgent.indexOf('.'));
        jQuery.browser.version = userAgent;
        // If it is chrome then jQuery thinks it's safari so we have to tell it it isn't
        jQuery.browser.safari = false;
        jQuery('html').addClass('chrome');
    }
    // Is this a version of Safari?
    if(jQuery.browser.safari){
        userAgent = userAgent.substring(userAgent.indexOf('safari/') +7);
        userAgent = userAgent.substring(0,userAgent.indexOf('.'));
        jQuery.browser.version = userAgent;
        jQuery('html').addClass('safari');
    }



});

jQuery(document).ready(function() {
    if(jQuery('html.ie8').length > 0) {
        var head = document.getElementsByTagName('head')[0],
            style = document.createElement('style');
        style.type = 'text/css';
        style.styleSheet.cssText = ':before,:after{content:none !important';
        head.appendChild(style);
        setTimeout(function(){
            head.removeChild(style);
        }, 0);
    }
});

// The overlay icon needs to be initialized here, and not in document.ready(),
// or jQuery doesn't detect the image heights correctly.
jQuery(window).load(function () {
    jQuery("html.no-touch a.image-link").primeImageOverlay({});
});

// The Portfolio logic has to be called from window load for the initial mobile display
// to be rendered correctly.
jQuery(window).load(function () {
    jQuery('div#masonry-container').primeportfolio({});
});

(function (w, d, s) {
    function go() {

        //Facebook Like load code
        // http://developers.facebook.com/docs/reference/plugins/like/
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        //Twitter Tweet
        //https://dev.twitter.com/docs/tweet-button
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = "//platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);
            }
        })(document, "script", "twitter-wjs");

        //Linked In loaded with the same async pattern provided by FB and Twitter
        //http://pinterest.com/about/goodies/
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = "//platform.linkedin.com/in.js";
                fjs.parentNode.insertBefore(js, fjs);
            }
        })(document, "script", "linkedin-wjs");

        //Google Plus
        // http://www.google.com/webmasters/+1/button/
        (function () {
            var po = document.createElement('script');
            po.type = 'text/javascript';
            po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(po, s);
        })();

        //Twitter Feed JS
        //get the .twitter-feed elements
        //get the tweet() params from data-* attributes
        var feeds = jQuery('.twitter-feed');
        feeds.each(function () {
            var f = jQuery(this);
            var usr = f.attr('data-usr');
            var count = parseInt(f.attr('data-count'));

            f.tweet({
                avatar_size:38,
                username:usr,
                count:count,
                template:"{avatar}{join}{text}{time}"
            });
        });

    }

    if (w.addEventListener) {
        w.addEventListener("load", go, false);
    }
    else if (w.attachEvent) {
        w.attachEvent("onload", go);
    }
}(window, document, 'script'));

jQuery(document).ready(function () {
    if (jQuery('div.fb-like').length > 0) {
        jQuery.getJSON("https://graph.facebook.com/fql?q=SELECT url, normalized_url, share_count, like_count, comment_count, total_count,commentsbox_count, comments_fbid, click_count FROM link_stat WHERE url='" + window.location.href + "'",
            function (data) {
                if(data.data.length > 0) {
                    var totalCount = data.data[0].total_count;
                    if (parseInt(totalCount) > 0) {
                        jQuery('div.fb-like').addClass('hasLikes');
                    }
                }
            }
        );
    }
});