/**
 * Creating a new jQuery Plugin using the Prime Plugin System
 *
 * 1. Define an object literal (ex. PrimeMyPlugin) for your plugin definition with the following members
 *      1. 'options: {}' - an object literal containing mappings for default options of the plugin
 *      2. '_build: function(){...}' - the main entry point for your plugin
 * 2. Register the object literal against the plugin name in the self-calling function at the bottom of
 *    prime-plugins.js. (ex. jQuery.plugin('primeMyPlugin', PrimeMyPlugin); )
 * 3. You can now call your plugin with the syntax: jQuery('#myObj').primeMyPlugin({'option1': 'Value'});
 *      1. The object literal you provide to the plugin call will be available in your plugin definition through
 *          the 'options' member of the plugin definition
 *
 *  Patterns for usage within the the plugin definition
 *  * Example: jQuery('#myObj').primeMyPlugin({'option1': 'Value'});
 *
 *  * The options declared on the plugin definition are merged with the options provided in the plugin call. The options
 *    fed to the plugin call take precedence.
 *
 *  * the jQuery('#myObj') value is available in the plugin by calling this.jQueryElem
 *
 *  * In any given method member of the plugin definition the 'this' keyword will refer to the plugin definition itself.
 *    However, if a callback is nested inside a member method, the 'this' keyword in the callback scope will refer to the
 *    object the callback is associated with this. In order to access the plugin definition inside a callback, we define
 *    a variable ('that' by convention) above the callback scope that can be accessed within the callback closure.
 *    ex.
 *
 var that = this;
 jQuery(window).resize(function() {

 if (that.scrollview == null) {
 that._setupScrollview();
 }
 else {
 that.jQueryElem.css("width", jQuery(this).width() - 10);
 }
 that._updateEnable();
 });
 this._updateEnable();
 *
 */
var primeGlobals = {};

/**
 * Handles changing image src with layout. Example image declaration
 *
 * <img id="image-1" class="prime-ajax-image" data-prime-desktop-src="..." data-prime-tablet-src="..."
 * data-prime-mobile-landscape-src="..." data-prime-mobile-portrait-src="..." />
 */
var PrimeAJAXReponsiveImage = {
    options:{},
    _build:function () {
        if (this.jQueryElem.length > 0) {
            var that = this;
            jQuery('body').on('primeLayoutChanged', function (e, oldLayout, newLayout) {
                that._handleLayoutUpdate(oldLayout, newLayout);
            });
        }
    },
    _handleLayoutUpdate:function (oldLayout, newLayout) {
        var dataSelector = 'data-' + newLayout + '-src';
        var newSrc = this.jQueryElem.attr(dataSelector);

        if (newSrc) {
            this.jQueryElem.removeClass('hidden');

            var that = this;
            var loaderImage = $('<img/>')
            //do a load of the image
            loaderImage.load(function () {
                that.jQueryElem.attr('src', newSrc);
                that.jQueryElem.trigger('primeImageLoaded', [that.jQueryElem]);
            });
            loaderImage.attr('src', newSrc);
        }
        else {
            this.jQueryElem.addClass('hidden');
            this.jQueryElem.trigger('primeImageLoaded', [this.jQueryElem]);
        }
    }
};

/**
 * Keeps the prime-* layout class synced on the element it is called on and fires 'primeLayoutChanged' event when the
 * layout changes.
 * This should generally be called once on the 'body' element.
 * To register for the layout changed event do the following:
 *
 * jQuery('body').on('primeLayoutChanged', function (e, oldLayout, newLayout) { ... });
 */
var PrimeLayoutTracker = {
    options:{},
    _build:function () {
        var that = this;

        if (jQuery('.ie8').length > 0 || jQuery('.ie7').length > 0) {
            var newLayout = 'prime-desktop';
            this.jQueryElem.trigger('primeLayoutChanged', [newLayout, newLayout]);
            this.jQueryElem.addClass(newLayout);
            this.currentLayout = newLayout;
            this.jQueryElem.attr('data-prime-layout', newLayout);
        }
        else {
            jQuery(window).resize(function () {
                that.updateLayout();
            })
            this.updateLayout();
        }
    },
    updateLayout:function () {
        var winWidth = jQuery(window).width();

        var newLayout = null;
        if (winWidth >= 960) {
            newLayout = 'prime-desktop';
        }
        else if (winWidth >= 768) {
            newLayout = 'prime-tablet';
        }
        else if (winWidth >= 480) {
            newLayout = 'prime-mobile-landscape'
        }
        else {
            newLayout = 'prime-mobile-portrait'
        }

        if (this.currentLayout !== newLayout) {
            //update the class on the body
            this.jQueryElem.removeClass(this.currentLayout);
            this.jQueryElem.addClass(newLayout);

            this.jQueryElem.attr('data-prime-layout', newLayout);

            //trigger 'prime-layout-changed' event parameterized with old and new layouts
            this.jQueryElem.trigger('primeLayoutChanged', [this.currentLayout, newLayout]);
            this.currentLayout = newLayout;
        }

    },
    currentLayout:''
}
    ;

var PrimeToggleIcon = {
    options:{},
    _build:function () {
        var that = this;
        if (this.jQueryElem.hasClass('closed')) {
            var $icon = jQuery("i.toggle-icon", this.jQueryElem);
            $icon.rotate('-90deg');
        }
        jQuery(this.jQueryElem.attr('href')).on('show', function () {
            that.toggleShow();
        })
        jQuery(this.jQueryElem.attr('href')).on('hide', function () {
            that.toggleHide();
        })
    },
    toggleShow:function () {
        var $icon = jQuery("i.toggle-icon", this.jQueryElem);
        $icon.animate({rotate:'0deg'}, 200);
        this.jQueryElem.removeClass('closed');
    },
    toggleHide:function () {
        var $icon = jQuery("i.toggle-icon", this.jQueryElem);
        $icon.animate({rotate:'-90deg'}, 200);
        this.jQueryElem.addClass('closed');
    }
};


var PrimeEmbedSizing = {
    options:{},
    _build:function () {
        var that = this;
        jQuery(window).resize(function () {
            that.updateEmbedSizes();
        })
        jQuery(window).trigger('resize');
    },
    updateEmbedSizes:function (e) {
        var $target = this.jQueryElem;
        var width = $target.attr('data-width');
        var height = $target.attr('data-height');
        $target.css('height', Math.floor(height / width * $target.width()));
    }
};

var PrimeDividerSmoothScroll = {
    options:{},
    _build:function () {
        this.jQueryElem.smoothScroll({offset:-100});
    }
};

//Declare object literal for PrimeTabControl
var PrimeTabControl = {
    options:{},
    _build:function () {
        this._initActivePane();
        var that = this;
        this.jQueryElem.find('li > a').click(function (e) {
            that._onActiveTabChange(e);
        })
        jQuery(window).resize(function () {
            that.checkTabOverflow();
        });
        jQuery(window).trigger('resize');
    },
    _initActivePane:function () {
        this.jQueryElem.find('li.active').each(function () {
            jQuery(this).next().addClass('right-of-active');
            paneSelector = jQuery(this).find('a').first().attr('href');
            jQuery(this).parent('ul').next('div.tab-content').children(paneSelector).addClass('active');
        });
    },
    _onActiveTabChange:function (e) {
        var $target = jQuery(e.target);
        $target.parent().add($target.parent().siblings()).removeClass(('right-of-active'));
        $target.parent().next().addClass('right-of-active');
    },
    checkTabOverflow:function (e) {
        var $tabul = this.jQueryElem;
        var $tabs = jQuery('li', $tabul);
        var tab_width = 0;
        var $over_tab = null;
        $tabs.each(function (index) {
            tab_width += jQuery(this).width();
            if ($over_tab == null && tab_width > $tabul.width()) $over_tab = jQuery(this);
        });
    }
};

var PrimeGallery = {
    options:{},
    _build:function () {
        var that = this;
        if (jQuery('html.ie8').length == 0) {
            jQuery(window).resize(function () {
                that.checkGalleries();
            });
            jQuery(window).trigger('resize');
        } else {
            that.checkGalleries();
        }
    },
    checkGalleries:function () {
        var $element = this.jQueryElem;
        var windowWidth = jQuery(window).width();
        var columnCount = 3;
        var dataWidth = $element.attr('data-imgwidth');
        var dataHeight = $element.attr('data-imgheight');
        if (jQuery('html.ie8').length != 0) {
            columnCount = $element.attr('data-desktop-columns');
        } else if (windowWidth < 768) {
            columnCount = $element.attr('data-mobile-columns');
        } else if (windowWidth < 960) {
            columnCount = $element.attr('data-tablet-columns');
        } else {
            columnCount = $element.attr('data-desktop-columns');
        }


        // Add an addition 18px to the gallery widget to account for the fact that the first image-link in each row has no margin-left
        var galleryWidth = $element.width() + 18;

        // imagewidth + 18px[margin-right]
        var imageWidth = Math.floor(galleryWidth / columnCount) - 18;
        if (jQuery('html.msie').length != 0) {
            imageWidth = imageWidth - 3;
        }


        var imageHeight = Math.floor(dataHeight / dataWidth * imageWidth);
        var images = $element.find('img');


        images.css('width', imageWidth);
        images.css('height', imageHeight);

        // Position image overlay icon
        var left = Math.floor((imageWidth - 40) / 2);
        var top = Math.floor((imageHeight - 40) / 2);

//        jQuery('span.overlay-thumbnail', $element).css('top', top + 'px').attr('data-left', left);
    }
};

var PrimeSidebarPositioning = {
    options:{},
    _build:function () {
        var that = this;
        // Sidebar Bg Height
        jQuery('div#sidebar > div.sidebar-bg').css('height', jQuery(document).height() + 'px');
        jQuery(window).resize(function () {
            that.checkSidebarPositioning();
        });
        this.checkSidebarPositioning();
    },
    checkSidebarPositioning:function () {

        var $sidebarbg = jQuery('.sidebar-bg');
        var $main = jQuery('div.main.has-sidebar');
        if ($sidebarbg.length > 0 && $main.length > 0) {
            var mainWidth = $main.width();
            if (mainWidth > 768 && mainWidth < 1024) {
                offset = (mainWidth - 1024) / 2;
                $sidebarbg.css('right', offset + 'px');
            } else {
                $sidebarbg.css('right', '0');
            }
        }
    }
};

var PrimeIE8Shadow = {
    options:{},
    _build:function () {
        var that = this;
        jQuery(window).resize(function () {
            that.update_ie8_shadow();
        });
        this.update_ie8_shadow();
    },
    update_ie8_shadow:function () {
        var bodyWidth = jQuery('body').width();
        if (jQuery('html.ie8').length > 0) {
            var windowWidth = jQuery(window).width();
            var padding = (windowWidth - bodyWidth) / 2;
            if (padding < 0) padding = 0;
            jQuery('body').css('padding-left', padding);
            jQuery('body').css('padding-right', padding);
        }
    }
};

var PrimeSearchBox = {
    options:{},
    _build:function () {
        if (this.jQueryElem.length > 0) {
            var that = this;
            // Set up searchbox focus
            this.jQueryElem.focusin(function () {
                that.jQueryElem.closest('fieldset').addClass('has-focus');
            });
            this.jQueryElem.focusout(function () {
                that.jQueryElem.closest('fieldset').removeClass('has-focus');
            });
        }
    }
};

var PrimeImageOverlay = {
    options:{},
    _build:function () {
        var that = this;
        // Set up the position of the overlay icons
        jQuery('html.no-touch a.image-link').each(function () {
            that.updatePosition();
        });
        // Recheck the position when the window is resized
        jQuery(window).smartresize(function () {
            jQuery('html.no-touch a.image-link').each(function () {
                that.updatePosition();
            });
        });
        // Animate the overlay icon in and out
        this.jQueryElem.hover(function () {
            that.animateOverlayIn();
        }, function () {
            that.animateOverlayOut();
        });
    },
    updatePosition:function () {
        var $link = this.jQueryElem;
        var $image = jQuery('img', $link);
        var imageHeight = $image.height();
        var imageWidth = $image.width();
        var left = Math.floor((imageWidth - 40) / 2);
        var top = Math.floor((imageHeight - 40) / 2);
        jQuery('span.overlay-thumbnail', $link).css('top', top + 'px').attr('data-left', left);
    },
    animateOverlayIn:function () {
        var $thumbnail = jQuery('span.overlay-thumbnail', this.jQueryElem);
        $thumbnail.stop(true, true).animate({left:$thumbnail.attr('data-left'), opacity:1}, 300, 'swing');
    },
    animateOverlayOut:function () {
        var $thumbnail = jQuery('span.overlay-thumbnail', this.jQueryElem);
        $thumbnail.stop(true, true).animate({left:$thumbnail.attr('data-left') * 2 + 42, opacity:0}, 300, 'swing', function () {
            $thumbnail.css('left', '-40px');
        });
    }
};

var PrimeHTML5Audio = {
    options:{},
    _build:function () {
        if (this.jQueryElem.length > 0) {
            var that = this
            var mp4 = this.jQueryElem.attr('data-mp4');
            var ogg = this.jQueryElem.attr('data-ogg');
            var interface = '#' + this.jQueryElem.attr('data-interface');
            var swf = this.jQueryElem.attr('data-swf');
            //Instantiate jPlayer Audio
            this.jQueryElem.jPlayer({
                ready:function () {
                    that.jQueryElem.jPlayer("setMedia", {
                        mp3:mp4,
                        oga:ogg,
                        end:""
                    });
                },
                swfPath:swf,
                cssSelectorAncestor:interface,
                supplied:"oga,mp3, all",
                size:{width:'100%' }
            });

        }
    }
};

var PrimeHTML5Video = {
    options:{},
    _build:function () {
        if (this.jQueryElem.length > 0) {
            var that = this;

            if (this.isMobileSafari() || this.isAndroid()) {
                this.jQueryElem.find(".jp_interface").addClass('no-volume');

                if (this.isAndroid()) {
                    this.jQueryElem.find('.native-video > video').removeAttr('controls');
                }

                var nativeVid = that.jQueryElem.find('.native-video');

                jQuery(".native-video").slideToggle(1000, function () {
                    jQuery(this).find('video').delay(200).animate({opacity:1}, 1000, function () {
                        if (that.isAndroid()) {
                            var overlayTop = (nativeVid.height() - 74) / 2;
                            nativeVid.append(
                                '<div class="video-overlay" style="top:' + overlayTop + 'px;"></div>');
                        }
                    });
                });

                if (this.isAndroid()) {
                    nativeVid.addClass('android');

                    //play logic for android
                    var video = nativeVid.find('> video');
                    video.click(function () {
                        jQuery(this).get(0).play();
                    });
                }
            }
            else if (jQuery().jPlayer) {
                this.jQueryElem.find(".jp-video-container").css('display', 'block');

                this.jQueryElem.find('.root-jplayer').each(function () {
                    var m4v = jQuery(this).attr('data-m4v');
                    var ogv = jQuery(this).attr('data-ogv');
                    var webm = jQuery(this).attr('data-webm');
                    var poster = jQuery(this).attr('data-poster');
                    var interface = '#' + jQuery(this).attr('data-interface');
                    var swf = jQuery(this).attr('data-swf');
                    jQuery(this).jPlayer({
                        ready:function () {
                            jQuery(this).jPlayer("setMedia", {
                                m4v:m4v,
                                ogv:ogv,
                                webmv:webm,
                                poster:poster
                            });
                        },
                        swfPath:swf,
                        cssSelectorAncestor:interface,
                        supplied:"m4v, ogv,  webm",
                        size:{width:'100%', height:'auto'}
                    });
                });
            }

            this.jQueryElem.find('div.video-overlay').live('click', function () {
                var video = jQuery('.native-video > video');
                video.click();
            });

            jQuery(window).resize(function () {
                if (that.isAndroid()) {
                    that.jQueryElem.find('.video-overlay').each(function () {
                        var overlayTop = (nativeVid.height() - 74) / 2;
                        jQuery(this).css('top', overlayTop + 'px');
                    });
                }
            });
        }
    },
    isMobileSafari:function () {
        var isiPod = navigator.userAgent.match(/iPod/i) != null;
        var isiPad = navigator.userAgent.match(/iPad/i) != null;
        var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
        return isiPod || isiPad || isiPhone;
    },
    isAndroid:function () {
        var ua = navigator.userAgent.toLowerCase();
        return ua.indexOf("android") > -1;
    }
};

var PrimeMobileNav = {
    options:{
        'origMenuSelector':'ul#topmenu',
        'cloneMenuID':'mobile-nav-ul'
    },
    _build:function () {
        if (this.jQueryElem.length > 0) {
            var that = this;
            // Clone the menu and remove any sf-menu and #topmenu id css by removing the class and id
            this.jQueryElem.find('> div.modal-body').html(
                jQuery(this.options.origMenuSelector).clone().removeClass('sf-menu').attr("id", this.options.cloneMenuID));
            this.jQueryElem.modal({ backdrop:true, keyboard:true});
            jQuery('a.mobile-menu').click(function () {
                that.jQueryElem.modal('show');
            });

        }
    }
};

var PrimeGallerySlider = {
    options:{
        'animation':'slide',
        'slideshow':false,
        'slideshowSpeed':7000,
        'directionNav':false
    },
    _build:function () {
        if (this.jQueryElem.length > 0) {

            var count = 0;
            var initialized = false;
            var that = this;

            var firstSlideImages = this.jQueryElem.find('img.prime-ajax-image');

            if (firstSlideImages.length > 0) {
                //Register for the primeImageLoaded event on each of the prime-ajax-images.
                //The primeAJAXReponsiveImage plugin should take care of loading the image
                //and firing the primeImageLoaded event.
                firstSlideImages.each(function () {
                    jQuery(this).one('primeImageLoaded', function (e, jQueryElem) {
                        count++;

                        if (count == firstSlideImages.length) {
                            window.setTimeout(function () {
                                if (!initialized) {
                                    that._constructSlider();
                                    initialized = true;
                                }
                            }, 100);
                        }
                    });
                });
            }
            else {
                if (!initialized) {
                    that._constructSlider();
                    initialized = true;
                }
            }

            // Add a 5 second timeout so that if one or more of the images just don't load,
            // the slider still gets initialized.
            window.setTimeout(function () {
                if (!initialized) {
                    that._constructSlider();
                }
            }, 5000);
        }
    },
    _constructSlider:function () {

        var fpsDiv = this.jQueryElem;
        var slideshowAttr = fpsDiv.attr('data-slideshow');
        var slideshow = false;

        if (typeof slideshowAttr !== 'undefined' && slideshowAttr !== false) {
            slideshow = true;
        }

        var slideshowSpeed = parseInt(fpsDiv.attr('data-slideshow-speed'));
        if (isNaN(slideshowSpeed) || typeof slideshowSpeed === 'undefined' || slideshowSpeed === false || slideshowSpeed < 1) {
            slideshowSpeed = this.options.slideshowSpeed;
        }

        var that = this;

        if (jQuery('html.touch').length == 0) this.options.animation = 'fade';

        fpsDiv.flexslider({
            animation:this.options.animation,
            slideshow:slideshow,
            slideshowSpeed:slideshowSpeed,
            directionNav:this.options.directionNav,
            start:function (slider) {
                jQuery('ul.slider-arrows li i.next-slide-arrow', slider.parent()).click(function () {
                    var numSlides = slider.count;
                    var currentSlide = slider.currentSlide;
                    var targetNextSlide = currentSlide + 1;
                    if (targetNextSlide >= numSlides) {
                        targetNextSlide = 0;
                    }
                    slider.flexAnimate(targetNextSlide);
                });
                jQuery('ul.slider-arrows li i.previous-slide-arrow', slider.parent()).click(function () {
                    var currentSlide = slider.currentSlide;
                    var targetPreviousSlide = currentSlide - 1;
                    if (targetPreviousSlide < 0) {
                        targetPreviousSlide = slider.count - 1;
                    }
                    slider.flexAnimate(targetPreviousSlide);
                });
                jQuery('ol.flex-control-nav', that.jQueryElem).prepend('<li><a class="icon-play"></a></li><li><a class="icon-pause"></a></li>');
                jQuery('ol.flex-control-nav > li > a.icon-play', that.jQueryElem).click(function () {
                    slider.pause();
                    var target = slider.getTarget('next');
                    slider.flexAnimate(target);
                    slider.resume();
                    jQuery('ol.flex-control-nav > li > a.icon-pause', that.jQueryElem).removeClass('is-paused');
                });
                jQuery('ol.flex-control-nav > li > a.icon-pause', that.jQueryElem).click(function () {
                    var $pausebtn = jQuery('ol.flex-control-nav > li > a.icon-pause', that.jQueryElem);
                    if ($pausebtn.hasClass('is-paused')) {
                        slider.resume();
                        $pausebtn.removeClass('is-paused');
                    } else {
                        slider.pause();
                        $pausebtn.addClass('is-paused');
                    }

                });

                var nextSlideElement = slider.slides[slider.animatingTo];
                //Animate the height of the slider so that it will
                //accomodate the slide
                var dataSelector = that._get_layout();
                var newHeight = jQuery(nextSlideElement).attr(dataSelector);
                that._animateHeight(newHeight);

                jQuery('body').on('primeLayoutChanged', function (e, oldLayout, newLayout) {
                    var dataSelector = that._get_layout();
                    var currentSlide = jQuery(slider.slides[slider.currentSlide]);
                    if (currentSlide.length > 0) {
                        newHeight = currentSlide.first().attr(dataSelector);
                        that._updateHeight(newHeight);
                    }
                });
            },
            before:function (slider) {
                var nextSlideElement = slider.slides[slider.animatingTo];
                //Animate the height of the slider so that it will
                //accomodate the slide
                var dataSelector = that._get_layout();
                var newHeight = jQuery(nextSlideElement).attr(dataSelector);
                that._animateHeight(newHeight);
            }
        });


    },
    _get_layout:function () {
        return 'data-' + jQuery('body').attr('data-prime-layout') + '-height';
    },
    _animateHeight:function (height) {
        this.jQueryElem.find('ul.slides').animate({
            height:height
        }, {duration:750});
//        this._updateHeight(height);
    },
    _updateHeight:function (height) {
        this.jQueryElem.find('ul.slides').css('height', height);
    }
}
    ;

var PrimePricingTableAnimate = {
    options:{},
    _build:function () {
        // var that = this;
        // jQuery('div.plan', this.jQueryElem).mouseenter(function () {
        //     jQuery(this).stop(true, true).animate({opacity:1}, 400);
        //     jQuery(this).siblings('div.plan').stop(true, true).animate({opacity:0.5}, 400);
        // });
        // this.jQueryElem.mouseleave(function () {
        //     jQuery('div.plan', this).stop(true, true).animate({opacity:1}, 400);
        // });
    }
};

var PrimePortfolio = {
    options:{
        'shuffleSelector':'#portfolio-shuffle',
        'filterListSelector':'ul#filters',
        'mobileFilterListSelector':'ul#filters'
    },
    _build:function () {
        if (this.jQueryElem.length > 0) {
            this.oldWidth = this.getWindowWidth();
            this.layoutMode = 'fitRows';
            this.isotopeInitialized = false;

            this.initializeIsotope();
        }
        jQuery(window).trigger('resize');
    },
    getWindowWidth:function () {
        return jQuery(window).width();
    },
    initializeIsotope:function () {

        if (this.isotopeInitialized) {
            this.updateLayout();
        }
        else {
            this._updateElementLayout();
            this.jQueryElem.isotope({
                itemSelector:'article.item',
                layoutMode:this.layoutMode,
                masonry:{
                    columnWidth:this.columnWidth,
                    gutterWidth:this.gutterWidth
                }
            });
            this._configureFilters();

            jQuery(window).resize(function () {
                that.updateLayout();
            });

            //We create a local var 'that' so that this object can be accessed from the
            //event handling closures. This allows us to easily trigger handling methods
            //contained in this plugin object.
            var that = this;

            //Isotope Aux functionality
            jQuery(this.options.shuffleSelector).click(function (event) {
                event.preventDefault();
                that.jQueryElem.isotope('shuffle', function () {
                });
            });

            isotopeInitialized = true;
            this.jQueryElem.find('article.item').css({'display':'block'}).animate({opacity:1}, 800);
        }

    },
    _configureFilters:function () {
        var that = this;
        var lis = jQuery(this.options.filterListSelector + ' > li, ' + this.options.mobileFilterListSelector + ' > li');
        var liDivs = jQuery(this.options.mobileFilterListSelector + ' > li > div');

        lis.click(function (e) {
            /* Retrieve data filter */
            var selector = jQuery(this).children('li > div, li > a').attr('data-filter');
            /* Remove current class from both the normal and mobile filter links */
            return that.applyIsotopeFilter(selector);
        });

        liDivs.click(function (e) {
            var selector = jQuery(this).attr('data-filter');
            return that.applyIsotopeFilter(selector);
        });

        jQuery('select.filter').change(function () {
            var selector = jQuery(this).find('option:selected').attr('data-filter');
            return that.applyIsotopeFilter(selector);
        });


    },
    applyIsotopeFilter:function (selector) {
        jQuery(this.options.filterListSelector + ' > li > a.current, ' +
            this.options.mobileFilterListSelector + ' > li > div.current').removeClass('current');
        /* Add current class to the applied the normal and mobile filter links */
        jQuery(this.options.filterListSelector + ' > li > a[data-filter="' + selector + '"], ' +
            this.options.mobileFilterListSelector + ' > li > div[data-filter="' + selector + '"]').addClass('current');
        /* Apply filter */
        this.jQueryElem.isotope({ filter:selector });
        /* Prevent browser from navigating to '#' */
        return false;
    },
    updateLayout:function () {
        return;
        this._updateElementLayout();
        this.jQueryElem.isotope('option', {
            itemSelector:'article.item',
            layoutMode:this.layoutMode,
            masonry:{
                columnWidth:this.columnWidth,
                gutterWidth:this.gutterWidth
            }
        });
        this.jQueryElem.isotope('reLayout');
    },
    isMobile:function () {
        return !(this.getWindowWidth() > 767 || jQuery('html.ie8').length > 0);
    },
    _updateElementLayout:function () {
        return;
        // Get Measurements
        if (!this.isMobile()) {
            this.jQueryElem.removeClass('isMobile');
            this.columnWidth = 191;
            this.gutterWidth = 24;
            var items = this.jQueryElem.find('article.item, div#masonry-container > article.item img,  div#masonry-container > article.item div.portfolio-preview-video, div#masonry-container > article.item iframe');
            items.css('width', this.columnWidth - 2);
            this.jQueryElem.find('article.item, div#masonry-container > article.item img').css('height', 'auto');
            this.jQueryElem.find('article.item div.portfolio-preview-video, div#masonry-container > article.item iframe').css('height', '173');
        }
        else {
            /* 2 wide */
            this.jQueryElem.addClass('isMobile');
            var portfolioWidth = this.jQueryElem.width();

            this.gutterWidth = 0;
            this.columnWidth = Math.floor((portfolioWidth - this.gutterWidth) / 2);
            this.rowHeight = Math.floor(this.columnWidth / 218 * 201);
            var images = this.jQueryElem.find('article.item, div#masonry-container > article.item img, div#masonry-container > article.item iframe, div#masonry-container > article.item div.portfolio-preview-video');
            images.css('width', this.columnWidth);
            images.css('height', this.rowHeight);


            this.masonryWidth = this.gutterWidth * 3 + this.columnWidth * 2;
            this.containerWidth = this.jQueryElem.find('#masonry-container').width();
            if (this.masonryWidth > this.containerWidth) {
                this.gutterWidth--;
            }
            else {
                this.gutterWidth = this.gutterWidth - (this.getWindowWidth() - this.masonryWidth);
            }
        }
        // Reposition icon overlays

    }
};

//Works on #scrollview-container
var PrimeFilterScrollview = {
    options:{
        'scrollviewID':'scrollview',
        'srcNodeSelector':'#scrollview-content',
        'flickMinDist':10,
        'flickMinVelocity':0.3,
        'flickAxis':'x'
    },
    _build:function () {
        if (this.jQueryElem.length > 0) {
            this._setupScrollview();
            var that = this;
            jQuery(window).resize(function () {
                /* Scrollview */
                if (that.scrollview == null) {
                    that._setupScrollview();
                }
                else {
                    that.jQueryElem.css("width", jQuery(this).width() - 10);
                }
                that._updateEnable();
            });
            this._updateEnable();

        }
    },
    isMobile:function () {
        return !(this.getWindowWidth() > 767 || jQuery('html.ie8').length > 0);
    },
    getWindowWidth:function () {
        return jQuery(window).width();
    },
    _setupScrollview:function () {
        if (this.scrollview == null
            && this.jQueryElem.css('display') == 'block' &&
            this.jQueryElem.css('visibility') == 'visible') {

            var that = this;
            YUI().use('scrollview', function (Y) {

                that.scrollview = new Y.ScrollView({
                    id:that.options.scrollviewID,
                    srcNode:that.options.srcNodeSelector,
                    flick:{
                        minDistance:that.flickMinDist,
                        minVelocity:that.flickMinVelocity,
                        axis:that.flickAxis
                    }
                });

                that.scrollview.render();
            });

            // Keep the width of the scrollview container equal to the width of the page
            this.jQueryElem.css("width", this.getWindowWidth());

        } else {
            this.render();
        }
    },
    _updateEnable:function () {
        // Get Measurements
        if (!this.isMobile()) {
            if (this.scrollview != null) {
                this.scrollview.disable();
            }
        }
        else {
            // Enable filters
            if (this.scrollview != null) {
                this.scrollview.enable();
            }
        }
    },
    render:function () {
        if (this.scrollview != null) this.scrollview.render();
    }
};

var PrimeHeaderMenu = {
    options:{
        'menuSelector':'ul.topmenu',
        'desktopMenuSelector':'.desktop-menu',
        'tabletMenuPortraitSelector':'.tablet-menu-portrait',
        'tabletMenuLandscapeSelector':'.tablet-menu-landscape',
        'mobileMenuSelector':'.mobile-menu'
    },
    _build:function () {
        var that = this;
        jQuery(window).smartresize(function () {
            that.initializeMenus();
        });
        jQuery(window).trigger('resize');
    },
    isDesktop:function () {
        return (this.getWindowWidth() > 959 || jQuery('html.ie8').length > 0);
    },
    isMobile:function () {
        return !(this.getWindowWidth() > 767 || jQuery('html.ie8').length > 0);
    },
    isTablet:function () {
        return(this.getWindowWidth() < 960 && this.getWindowWidth() > 767);
    },
    initializeMenus:function () {
        var menuSelector = this.options.menuSelector;
        if (this.isDesktop()) {
            menuSelector = jQuery('html.touch').length > 0 ? this.options.tabletMenuLandscapeSelector : this.options.desktopMenuSelector;
        }
        else if (this.isTablet()) {
            menuSelector = this.options.tabletMenuPortraitSelector;
        } else if (this.isMobile()) {
            return;
        }
        var $menuList = jQuery(menuSelector);
        // Only run if the menu hasn't already been initialized
        if ($menuList.length > 0 && $menuList.attr('class').indexOf('sf-js-enabled') == -1) {
            $menuList.supersubs({
                minWidth:15, // minimum width of sub-menus in em units
                maxWidth:30, // maximum width of sub-menus in em units
                extraWidth:1     // extra width can ensure lines don't sometimes turn over
                // due to slight rounding differences and font-family
            }).superfish({
                    delay:200,
                    animation:{opacity:'show', height:'show'},
                    speed:'fast',
                    autoArrows:false,
                    dropShadows:false
                });
        }
    },
    getWindowWidth:function () {
        return jQuery(window).width();
    }
};

var PrimeMobileMenuToggle = {
    options:{'mobileButtonSelector':'.mobile-menu-btn'},
    _build:function () {
        var that = this;
        jQuery(this.options.mobileButtonSelector).click(function () {
            jQuery(this).toggleClass('menu-open');
        });
    }
};

var PrimeTabletSubmenuClose = {
    options:{},
    _build:function () {
        var that = this;
        that.jQueryElem.click(function () {
            var $parent = jQuery(this).parent('li.menu-parent-item');
            if ($parent.hasClass('sfHover')) {
                $parent.hideSuperfishUl();
            } else {
                $parent.showSuperfishUl();
            }
            return false;
        });
    }
};

var PrimeMenuHover = {
    options:{},
    _build:function () {
        jQuery('ul.desktop-menu li, ul.tablet-menu li').hover(function () {
            jQuery(this).addClass('sfHover');
        });

        jQuery('ul.desktop-menu li, ul.tablet-menu li').mouseleave(function () {
            jQuery(this).removeClass('sfHover');
        });
    }
};


var PrimeProjectWidget = {
    options:{
        'scrollviewID':'lp-slider',
        'srcNodeSelector':'.slides_container',
        'flickMinDist':10,
        'flickMinVelocity':0.3,
        'flickAxis':'x'
    },
    _build:function () {
        if (this.jQueryElem.length > 0) {
            this._setupScrollview();
        }
    },
    isMobile:function () {
        return !(this.getWindowWidth() > 767 || jQuery('html.ie8').length > 0);
    },
    isAndroid:function () {
        var ua = navigator.userAgent.toLowerCase();
        return isAndroid = ua.indexOf("android") > -1;
    },
    getWindowWidth:function () {
        return jQuery(window).width();
    },
    _setupScrollview:function () {
        // LATEST PROJECTS SLIDER
        var that = this;
        YUI().use('scrollview', 'scrollview-paginator', function (Y) {
            that.scrollview = new Y.ScrollView({
                id:'lp-slider',
                srcNode:'.slides_container',
                flick:{
                    minDistance:10,
                    minVelocity:0.3,
                    axis:"x"
                }
            });
            if (!that.isAndroid()) {
                // This fix doesn't work in ICS
                that.scrollview._prevent.move = false;
            }
            that.scrollview.plug(Y.Plugin.ScrollViewPaginator, {
                selector:'li'
            });
            that.jQueryElem.find('.latest-projects > li.slide > a > img').attr('height', 'auto').attr('width', 'auto');
            that.jQueryElem.find('.latest-projects > li.slide').css('display', 'inline-block');
            that.scrollview.render();

            var content = that.scrollview.get("contentBox");

            content.delegate("click", function (e) {
                // For mouse based devices, we need to make sure the click isn't fired
                // at the end of a drag/flick. We use 2 as an arbitrary threshold.
                if (Math.abs(that.scrollview.lastScrolledAmt) < 2) {
                    //on click logic
                }
            }, "img");

            // Prevent default image drag behavior
            content.delegate("mousedown", function (e) {
                e.preventDefault();
            }, "img");

            jQuery('#scrollview-next').bind('click', function (e) {
                e.preventDefault();
                var orig_index = that.scrollview.pages.get('index');
                var next_ret_val = that.scrollview.pages.next();
                var new_index = that.scrollview.pages.get('index');

                if (orig_index == new_index) {
                    that.scrollview.pages.set('index', 0);
                }
            });

            jQuery('#scrollview-prev').bind('click', function (e) {
                e.preventDefault();
                var orig_index = that.scrollview.pages.get('index');
                that.scrollview.pages.prev();
                var new_index = that.scrollview.pages.get('index');

                if (orig_index == new_index) {
                    that.scrollview.pages.set('index', that.scrollview.pages.get('total') - 1);
                }
            });

        });
    }
};

var PrimeVimeoHelper = {
    options:{},
    _build:function () {

        //the bindAll method makes the 'this' keyword in all
        //object function attributes this object.
        //when called without function names, it applies to all object functions

        _.bindAll(this, 'onPlayerReady', 'onPlay', 'onPause', 'onFinish', 'pauseVideo', 'refreshFrame');

        //shove an ID on the video if it doesn't have one.
        //Froogaloop requires that the iframes associated with
        //Vimeo have an id.
        if (window.VimeoCount == undefined) window.VimeoCount = 1;
        if (!this.jQueryElem.attr('id')) {
            this.jQueryElem.attr('id', 'vimeo-vid-' + window.VimeoCount);
            window.VimeoCount = window.VimeoCount + 1;
            this.jQueryElem.attr('src', this.jQueryElem.attr('src') + '&player_id=' + this.jQueryElem.attr('id'));
        }

        var iframe = this.jQueryElem.get(0);
        this.player = Froogaloop(iframe);
        var player = this.player;

        // When the player is ready, add listeners for pause, finish, and playProgress
        player.addEvent('ready', this.onPlayerReady);

    },
    onPlayerReady:function () {
        var player = this.player;
        player.addEvent('play', this.onPlay);
        player.addEvent('pause', this.onPause);
        player.addEvent('finish', this.onFinish);
    },
    onPlay:function (id) {
        this.jQueryElem.trigger('video_play', {id:id, primePlugin:this});
    },
    onPause:function (id) {
        this.jQueryElem.trigger('video_pause', {id:id, primePlugin:this});
    },
    onFinish:function (id) {
        this.jQueryElem.trigger('video_finish', {id:id, primePlugin:this});
    },
    pauseVideo:function () {
        if (this.isMobileSafari()) {
            this.refreshFrame();
        }
        else {
            this.player.api('pause');
        }
    },
    isMobileSafari:function () {
        var isiPod = navigator.userAgent.match(/iPod/i) != null;
        var isiPad = navigator.userAgent.match(/iPad/i) != null;
        var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
        return isiPod || isiPad || isiPhone;
    },
    refreshFrame:function () {
        var iframe = this.jQueryElem.get(0);
        _.defer(function () {
            iframe.src = iframe.src;
        });
    }
};


function onYouTubePlayerAPIReady() {
    if (window.YTAPIImported !== true) {
        window.YTAPIImported = true;
        jQuery('body').trigger('youtube_api_ready');
    }
}

var PrimeYoutubeHelper = {
    options:{},
    _build:function () {

        _.bindAll(this, 'onAPIReady', 'onStateChange', 'pauseVideo', 'refreshFrame');

        if (window.YoutubeCount == undefined) window.YoutubeCount = 1;
        if (!this.jQueryElem.attr('id')) {
            this.jQueryElem.attr('id', 'youtube-vid-' + window.YoutubeCount);
            window.YoutubeCount = window.YoutubeCount + 1;
        }

        //load the Youtube API if not already imported
        //and cue up the onAPIReady callback
        if (window.YTAPIImported !== true) {
            jQuery('body').bind('youtube_api_ready', this.onAPIReady);
            // 2. This code loads the IFrame Player API code asynchronously.

            var tag = document.createElement('script');
            tag.async = true;
            tag.src = "http://www.youtube.com/player_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        }
        else {
            this.onAPIReady();
        }
    },
    onAPIReady:function () {
        this.player = new YT.Player(this.jQueryElem.attr('id'), {
            events:{
                'onStateChange':this.onStateChange
            }
        });
    },
    onStateChange:function (event) {

        var id = this.jQueryElem.attr('id');
        switch (event.data) {
            case 0:
                log('Video Finish');
                this.jQueryElem.trigger('video_finish', {id:id, primePlugin:this});
                break;
            case 1:
                this.jQueryElem.trigger('video_play', {id:id, primePlugin:this});
                break;
            case 3:
            case 2:
                this.jQueryElem.trigger('video_pause', {id:id, primePlugin:this});
                break;
        }
    },
    pauseVideo:function () {
        if (this.isMobileSafari()) {
            this.refreshFrame();
        }
        else if (this.player && this.player.pauseVideo !== undefined) {
            this.player.pauseVideo();
        }
    },
    isMobileSafari:function () {
        var isiPod = navigator.userAgent.match(/iPod/i) != null;
        var isiPad = navigator.userAgent.match(/iPad/i) != null;
        var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
        return isiPod || isiPad || isiPhone;
    },
    refreshFrame:function () {
        var iframe = this.jQueryElem.get(0);
        _.defer(function () {
            iframe.src = iframe.src;
        });
    }
};

var PrimeVideoHelper = {
    options:{},
    _build:function () {

        //the bindAll method makes the 'this' keyword in all
        //object function attributes this object.
        //when called without function names, it applies to all object functions

        _.bindAll(this, 'pauseVideo');

        var provider = this.jQueryElem.attr('src').match(/http:\/\/(?:www\.|player\.)?(vimeo|youtube)\.com\/(?:embed\/|video\/)?(.*?)(?:\z|$|\?)/)[1];
        this.provider = provider;

        if (provider == 'vimeo') {
            this.jQueryElem.primeVimeoHelper({});
            this.playerPlugin = this.jQueryElem.data('primeVimeoHelper');
        }
        else if (provider == 'youtube') {
            this.jQueryElem.primeYoutubeHelper({});
            this.playerPlugin = this.jQueryElem.data('primeYoutubeHelper');
        }
    },
    pauseVideo:function () {
        if (this.playerPlugin) {
            this.playerPlugin.pauseVideo();
        }
    }
}

var PrimeCPSlider = {
    options:{},
    _build:function () {
        _.bindAll(this,
            'toggleSlideshowPlay',
            'playSlideshow',
            'pauseSlideshow',
            'placeSlideshowHold',
            'removeSlideshowHold');
        if (this.jQueryElem.length > 0) {
            var count = 0;
            var initialized = false;
            var that = this;

            if (this.jQueryElem.find('.slide').length > 1) {
                var firstSlideImages = this.jQueryElem.find('.slide:first img.prime-ajax-image');

                if (firstSlideImages.length > 0) {
                    //Register for the primeImageLoaded event on each of the prime-ajax-images.
                    //The primeAJAXReponsiveImage plugin should take care of loading the image
                    //and firing the primeImageLoaded event.
                    firstSlideImages.each(function () {
                        jQuery(this).one('primeImageLoaded', function (e, jQueryElem) {
                            count++;

                            if (count == firstSlideImages.length) {
                                window.setTimeout(function () {
                                    if (!initialized) {
                                        that.initCycleSlider();
                                        initialized = true;
                                    }
                                }, 100);
                            }
                        });
                    });
                }
                else {
                    if (!initialized) {
                        that.initCycleSlider();
                        initialized = true;
                    }
                }

                // Add a 5 second timeout so that if one or more of the images just don't load,
                // the slider still gets initialized.
                window.setTimeout(function () {
                    if (!initialized) {
                        that.initCycleSlider();
                    }
                }, 5000);

                jQuery('body').on('primeLayoutChanged', function (e, oldLayout, newLayout) {
                    var dataSelector = that._get_layout();

                    var currentSlide = that.jQueryElem.find('.slide.current');
                    if (currentSlide.length > 0) {
                        newHeight = currentSlide.first().attr(dataSelector);
                        that._updateHeight(newHeight);

                        //pause the current slide's iframes
                        currentSlide.find('.embed-wrapper iframe').each(function () {
                            var videoPlugin = jQuery.data(this, 'primeVideoHelper');
                            if (videoPlugin)
                                videoPlugin.pauseVideo();
                        });
                    }
                });
            }
            else {
                var slide = this.jQueryElem.find('.slide').first();
                var sliderWrapper = this.jQueryElem.parentsUntil('.slider-wrapper').parent();

                sliderWrapper.find('#nav').addClass('hidden');

                jQuery('body').on('primeLayoutChanged', function (e, oldLayout, newLayout) {
                    var dataSelector = that._get_layout();
                    that.jQueryElem.removeClass('hidden');
                    newHeight = slide.attr(dataSelector);
                    that._updateHeight(newHeight);
                    slide.css('display', 'block');
                });
            }
        }
    },
    isIPad:function () {
        return navigator.userAgent.match(/iPad/i) != null;
    },
    initCycleSlider:function () {

        var isIPad = this.isIPad();
        this.jQueryElem.removeClass('hidden');

        var that = this;

        var timeout = parseInt(this.jQueryElem.attr('data-slideshow-speed'));
        this.timeout = timeout;

        if (jQuery('.mozilla').length > 0) {
            that._remove_animate_classes(that.jQueryElem.find('[data-transition]'));
        }

        var fx = 'fade';

        this.jQueryElem.cycle({
            fx:fx,
            speed:500,
            prev:'#prev',
            next:'#next',
            pager:'#nav-pager',
            timeout:timeout,
            containerResize:0,
            slideResize:0,
            before:function (currSlideElement, nextSlideElement, options, forwardFlag) {
                //Pause all video iframes
                jQuery(currSlideElement).find('.embed-wrapper iframe').each(function () {
                    var videoPlugin = jQuery.data(this, 'primeVideoHelper');
                    if (videoPlugin)
                        videoPlugin.pauseVideo();
                });

                //Animate the height of the slider so that it will
                //accomodate the slide
                var dataSelector = that._get_layout();
                var newHeight = jQuery(nextSlideElement).attr(dataSelector);
                that._animateHeight(newHeight);

                jQuery(currSlideElement).removeClass('current');
                jQuery(nextSlideElement).addClass('current');
                if (jQuery('.mozilla').length > 0) {
                    that._add_animate_classes(jQuery(nextSlideElement).find('[data-transition]'));
                    //if the currSlide and nextSlide are the same, then it's the first slide load,
                    //and we don't want to clear out the animation. Otherwise, it's clearing out
                    //the currSlide so when it's come back to, the animate classes will be "new"
                    //so it'll trigger the mozilla animation.
                    if (currSlideElement != nextSlideElement) {
                        that._remove_animate_classes(jQuery(currSlideElement).find('[data-transition]'));
                    }
                }


            }
        });

        that.jQueryElem.touchwipe({
            preventDefaultEvents:false,
            wipeLeft:function () {
                that.jQueryElem.cycle("next");

            },
            wipeRight:function () {
                that.jQueryElem.cycle("prev");
            }
        });


        var iframes = this.jQueryElem.find('.embed-wrapper iframe');
        this.videoIframes = iframes;
        iframes.primeVideoHelper({});

        //When the slider is supposed to be a slideshow
        if (timeout > 0) {
            //pause button
            var wrapper = this.jQueryElem.parentsUntil('.slider-wrapper').parent();
            var pause = wrapper.find('#nav #pause');
            var next = wrapper.find('#nav #next');

            pause.first().on('click', function (e) {
                e.preventDefault();
                that.toggleSlideshowPlay();
            });

            next.first().on('click', function (e) {
                e.preventDefault();
                that.playSlideshow();
            });

            //pause the animation on input focus
            //resume animation when input loses focus (blur)
            var inputs = that.jQueryElem.find('input');
            var inputFocus = 0;
            inputs.focus(function () {
                that.jQueryElem.cycle('pause');
                inputFocus++;
            });
            inputs.blur(function () {
//                that.jQueryElem.cycle('resume');
                inputFocus--;
                _.delay(
                    function () {
                        if (inputFocus < 1)that.playSlideshow();
                    }
                    , that.timeout);
            });

            //vimeo video handling

            iframes.bind('video_play', this.placeSlideshowHold);
            iframes.bind('video_pause', this.removeSlideshowHold);
            iframes.bind('video_finish', this.removeSlideshowHold);

        }
        else {
            var wrapper = this.jQueryElem.parentsUntil('.cpslider-wrapper').parent();
            var pause = wrapper.find('#nav #pause');
            pause.hide();
        }
    },
    slideshowPlaying:true,
    pauseSlideshow:function () {
        var wrapper = this.jQueryElem.parentsUntil('.slider-wrapper').parent();
        var pause = wrapper.find('#nav #pause');
        this.jQueryElem.cycle('pause');
        pause.addClass('is-paused');
        this.slideshowPlaying = false;
    },
    playSlideshow:function () {
        var wrapper = this.jQueryElem.parentsUntil('.slider-wrapper').parent();

        var pause = wrapper.find('#nav #pause');
        if (!this.onSlideshowVideoHold)
            this.jQueryElem.cycle('resume');

        pause.removeClass('is-paused');
        this.slideshowPlaying = true;
    },
    toggleSlideshowPlay:function () {
        if (this.slideshowPlaying) {
            this.pauseSlideshow();
        }
        else {
            this.playSlideshow();
        }
    },
    onSlideshowVideoHold:false,
    placeSlideshowHold:function () {
        this.jQueryElem.cycle('pause');
        this.onSlideshowVideoHold = true;
    },
    removeSlideshowHold:function () {
        if (this.slideshowPlaying) {
            _.delay(this.playSlideshow, this.timeout);
        }
        this.onSlideshowVideoHold = false;
    },
    _add_animate_classes:function (transitionElements, delay) {
        if (delay === null) delay = 500;
        transitionElements.each(function () {
            var ele = jQuery(this);
            var trans = ele.attr('data-transition');
            ele.delay(delay).addClass('animated ' + trans);
        });
    },
    _remove_animate_classes:function (transitionElements) {
        transitionElements.each(function () {
            var ele = jQuery(this);
            var trans = ele.attr('data-transition');
            ele.removeClass('animated').removeClass(trans);
        });
    },
    _get_layout:function () {
        var newLayout;
        if (jQuery('.ie8').length > 0 || jQuery('.ie7').length > 0) {
            var newLayout = 'prime-desktop';
        }
        else {
            newLayout = jQuery('body').attr('data-prime-layout');
        }
        return 'data-' + newLayout + '-height';
    },
    _animateHeight:function (height) {
        this.jQueryElem.animate({
            height:height
        }, {duration:750});
//        this._updateHeight(height);
    },
    _updateHeight:function (height) {
        this.jQueryElem.css('height', height);
    },
    _firstSlideLoad:true
};

var PrimePreview = {
    options:{},
    _build:function () {
        var that = this;
        var cookie_skins = 'nova_wp_preview_skins';
        jQuery('ul.topmenu > li > a[title="skin-picker"] + ul li a').click(function () {
            jQuery.cookie(cookie_skins, jQuery(this).attr('title'), {path:'/', Path:'/'});
            that.updateStyle();
        });
    },
    updateStyle:function () {
        location.reload();
    }
};


/*
 Register our object literal
 */
!function ($) {
    jQuery.plugin('primeLayoutTracker', PrimeLayoutTracker);
    jQuery.plugin('primetabs', PrimeTabControl);
    jQuery.plugin('primeportfolio', PrimePortfolio);
    jQuery.plugin('primeFilterScrollview', PrimeFilterScrollview);
    jQuery.plugin('primeProjectWidget', PrimeProjectWidget);
    jQuery.plugin('primeGallerySlider', PrimeGallerySlider);
    jQuery.plugin('primeMobileNav', PrimeMobileNav);
    jQuery.plugin('primeHTML5Video', PrimeHTML5Video);
    jQuery.plugin('primeHTML5Audio', PrimeHTML5Audio);
//    jQuery.plugin('primeGoogleMap', PrimeGoogleMap);
    jQuery.plugin('primeSearchBox', PrimeSearchBox);
    jQuery.plugin('primeIE8Shadow', PrimeIE8Shadow);
    jQuery.plugin('primeSidebarPositioning', PrimeSidebarPositioning);
    jQuery.plugin('primeGallery', PrimeGallery);
    jQuery.plugin('primeEmbedSizing', PrimeEmbedSizing);
    jQuery.plugin('primeDividerSmoothScroll', PrimeDividerSmoothScroll);
    jQuery.plugin('primeToggleIcon', PrimeToggleIcon);
    jQuery.plugin('primeHeaderMenu', PrimeHeaderMenu);
    jQuery.plugin('primeMobileMenuToggle', PrimeMobileMenuToggle);
    jQuery.plugin('primeTabletSubmenuClose', PrimeTabletSubmenuClose);
    jQuery.plugin('primeMenuHover', PrimeMenuHover);
    jQuery.plugin('primeImageOverlay', PrimeImageOverlay);
    jQuery.plugin('primePricingTableAnimate', PrimePricingTableAnimate);
    jQuery.plugin('primeCPSlider', PrimeCPSlider);
    jQuery.plugin('primeAJAXReponsiveImage', PrimeAJAXReponsiveImage);
    jQuery.plugin('primePreview', PrimePreview);
    jQuery.plugin('primeVimeoHelper', PrimeVimeoHelper);
    jQuery.plugin('primeYoutubeHelper', PrimeYoutubeHelper);
    jQuery.plugin('primeVideoHelper', PrimeVideoHelper);
}(window.jQuery || window.ender);