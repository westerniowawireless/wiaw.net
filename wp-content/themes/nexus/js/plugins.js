window.log = function () {
    log.history = log.history || [];
    log.history.push(arguments);
    if (this.console) {
        arguments.callee = arguments.callee.caller;
        var a = [].slice.call(arguments);
        (typeof console.log === "object" ? log.apply.call(console.log, console, a) : console.log.apply(console, a))
    }
};
(function (b) {
    function c() {
    }

    for (var d = "assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,timeStamp,profile,profileEnd,time,timeEnd,trace,warn".split(","), a; a = d.pop();) {
        b[a] = b[a] || c
    }
})((function () {
    try {
        console.log();
        return window.console;
    } catch (err) {
        return window.console = {};
    }
})());

/**
 * Isotope v1.4.110906
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Commercial use requires one-time license fee
 * http://metafizzy.co/#licenses
 *
 * Copyright 2011 David DeSandro / Metafizzy
 */
/*jshint curly: true, eqeqeq: true, forin: false, immed: false, newcap: true, noempty: true, undef: true */
/*global Modernizr: true */
(function (a, b, c) {
    function f(a) {
        var b = document.documentElement.style, c;
        if (typeof b[a] == "string")return a;
        a = d(a);
        for (var f = 0, g = e.length; f < g; f++) {
            c = e[f] + a;
            if (typeof b[c] == "string")return c
        }
    }

    function d(a) {
        return a.charAt(0).toUpperCase() + a.slice(1)
    }

    var e = "Moz Webkit Khtml O Ms".split(" "), g = f("transform"), h = {csstransforms:function () {
        return!!g
    }, csstransforms3d:function () {
        var a = !!f("perspective");
        if (a) {
            var c = " -o- -moz- -ms- -webkit- -khtml- ".split(" "), d = "@media (" + c.join("transform-3d),(") + "modernizr)", e = b("<style>" + d + "{#modernizr{height:3px}}" + "</style>").appendTo("head"), g = b('<div id="modernizr" />').appendTo("html");
            a = g.height() === 3, g.remove(), e.remove()
        }
        return a
    }, csstransitions:function () {
        return!!f("transitionProperty")
    }};
    if (a.Modernizr)for (var i in h)Modernizr.hasOwnProperty(i) || Modernizr.addTest(i, h[i]); else a.Modernizr = function () {
        var a = {_version:"1.6ish: miniModernizr for Isotope"}, c = " ", d, e;
        for (e in h)d = h[e](), a[e] = d, c += " " + (d ? "" : "no-") + e;
        b("html").addClass(c);
        return a
    }();
    if (Modernizr.csstransforms) {
        var j = Modernizr.csstransforms3d ? {translate:function (a) {
            return"translate3d(" + a[0] + "px, " + a[1] + "px, 0) "
        }, scale:function (a) {
            return"scale3d(" + a + ", " + a + ", 1) "
        }} : {translate:function (a) {
            return"translate(" + a[0] + "px, " + a[1] + "px) "
        }, scale:function (a) {
            return"scale(" + a + ") "
        }}, k = function (a, c, d) {
            var e = b.data(a, "isoTransform") || {}, f = {}, h, i = {}, k;
            f[c] = d, b.extend(e, f);
            for (h in e)k = e[h], i[h] = j[h](k);
            var l = i.translate || "", m = i.scale || "", n = l + m;
            b.data(a, "isoTransform", e), a.style[g] = n
        };
        b.cssNumber.scale = !0, b.cssHooks.scale = {set:function (a, b) {
            k(a, "scale", b)
        }, get:function (a, c) {
            var d = b.data(a, "isoTransform");
            return d && d.scale ? d.scale : 1
        }}, b.fx.step.scale = function (a) {
            b.cssHooks.scale.set(a.elem, a.now + a.unit)
        }, b.cssNumber.translate = !0, b.cssHooks.translate = {set:function (a, b) {
            k(a, "translate", b)
        }, get:function (a, c) {
            var d = b.data(a, "isoTransform");
            return d && d.translate ? d.translate : [0, 0]
        }}
    }
    var l = b.event, m;
    l.special.smartresize = {setup:function () {
        b(this).bind("resize", l.special.smartresize.handler)
    }, teardown:function () {
        b(this).unbind("resize", l.special.smartresize.handler)
    }, handler:function (a, b) {
        var c = this, d = arguments;
        a.type = "smartresize", m && clearTimeout(m), m = setTimeout(function () {
            jQuery.event.handle.apply(c, d)
        }, b === "execAsap" ? 0 : 100)
    }}, b.fn.smartresize = function (a) {
        return a ? this.bind("smartresize", a) : this.trigger("smartresize", ["execAsap"])
    }, b.Isotope = function (a, c) {
        this.element = b(c), this._create(a), this._init()
    };
    var n = ["overflow", "position", "width", "height"];
    b.Isotope.settings = {resizable:!0, layoutMode:"masonry", containerClass:"isotope", itemClass:"isotope-item", hiddenClass:"isotope-hidden", hiddenStyle:Modernizr.csstransforms && !b.browser.opera ? {opacity:0, scale:.001} : {opacity:0}, visibleStyle:Modernizr.csstransforms && !b.browser.opera ? {opacity:1, scale:1} : {opacity:1}, animationEngine:b.browser.opera ? "jquery" : "best-available", animationOptions:{queue:!1, duration:800}, sortBy:"original-order", sortAscending:!0, resizesContainer:!0, transformsEnabled:!0, itemPositionDataEnabled:!1}, b.Isotope.prototype = {_create:function (c) {
        this.options = b.extend({}, b.Isotope.settings, c), this.styleQueue = [], this.elemCount = 0;
        var d = this.element[0].style;
        this.originalStyle = {};
        for (var e = 0, f = n.length; e < f; e++) {
            var g = n[e];
            this.originalStyle[g] = d[g] || ""
        }
        this.element.css({overflow:"visible", position:"relative"}), this._updateAnimationEngine(), this._updateUsingTransforms();
        var h = {"original-order":function (a, b) {
            b.elemCount++;
            return b.elemCount
        }, random:function () {
            return Math.random()
        }};
        this.options.getSortData = b.extend(this.options.getSortData, h), this.reloadItems();
        var i = b(document.createElement("div")).prependTo(this.element);
        this.offset = i.position(), i.remove();
        var j = this;
        setTimeout(function () {
            j.element.addClass(j.options.containerClass)
        }, 0), this.options.resizable && b(a).bind("smartresize.isotope", function () {
            j.resize()
        }), this.element.delegate("." + this.options.hiddenClass, "click", function () {
            return!1
        })
    }, _getAtoms:function (a) {
        var b = this.options.itemSelector, c = b ? a.filter(b).add(a.find(b)) : a, d = {position:"absolute"};
        this.usingTransforms && (d.left = 0, d.top = 0), c.css(d).addClass(this.options.itemClass), this.updateSortData(c, !0);
        return c
    }, _init:function (a) {
        this.$filteredAtoms = this._filter(this.$allAtoms), this._sort(), this.reLayout(a)
    }, option:function (a) {
        if (b.isPlainObject(a)) {
            this.options = b.extend(!0, this.options, a);
            var c;
            for (var e in a)c = "_update" + d(e), this[c] && this[c]()
        }
    }, _updateAnimationEngine:function () {
        var a = this.options.animationEngine.toLowerCase().replace(/[ _\-]/g, "");
        switch (a) {
            case"css":
            case"none":
                this.isUsingJQueryAnimation = !1;
                break;
            case"jquery":
                this.isUsingJQueryAnimation = !0;
                break;
            default:
                this.isUsingJQueryAnimation = !Modernizr.csstransitions
        }
        this._updateUsingTransforms()
    }, _updateTransformsEnabled:function () {
        this._updateUsingTransforms()
    }, _updateUsingTransforms:function () {
        this.usingTransforms = this.options.transformsEnabled && Modernizr.csstransforms && Modernizr.csstransitions && !this.isUsingJQueryAnimation, this.getPositionStyles = this.usingTransforms ? this._translate : this._positionAbs
    }, _filter:function (a) {
        var b = this.options.filter === "" ? "*" : this.options.filter;
        if (!b)return a;
        var c = this.options.hiddenClass, d = "." + c, e = a.filter(d), f = e;
        if (b !== "*") {
            f = e.filter(b);
            var g = a.not(d).not(b).addClass(c);
            this.styleQueue.push({$el:g, style:this.options.hiddenStyle})
        }
        this.styleQueue.push({$el:f, style:this.options.visibleStyle}), f.removeClass(c);
        return a.filter(b)
    }, updateSortData:function (a, c) {
        var d = this, e = this.options.getSortData, f, g;
        a.each(function () {
            f = b(this), g = {};
            for (var a in e)!c && a === "original-order" ? g[a] = b.data(this, "isotope-sort-data")[a] : g[a] = e[a](f, d);
            b.data(this, "isotope-sort-data", g)
        })
    }, _sort:function () {
        var a = this.options.sortBy, b = this._getSorter, c = this.options.sortAscending ? 1 : -1, d = function (d, e) {
            var f = b(d, a), g = b(e, a);
            f === g && a !== "original-order" && (f = b(d, "original-order"), g = b(e, "original-order"));
            return(f > g ? 1 : f < g ? -1 : 0) * c
        };
        this.$filteredAtoms.sort(d)
    }, _getSorter:function (a, c) {
        return b.data(a, "isotope-sort-data")[c]
    }, _translate:function (a, b) {
        return{translate:[a, b]}
    }, _positionAbs:function (a, b) {
        return{left:a, top:b}
    }, _pushPosition:function (a, b, c) {
        b += this.offset.left, c += this.offset.top;
        var d = this.getPositionStyles(b, c);
        this.styleQueue.push({$el:a, style:d}), this.options.itemPositionDataEnabled && a.data("isotope-item-position", {x:b, y:c})
    }, layout:function (a, b) {
        var c = this.options.layoutMode;
        this["_" + c + "Layout"](a);
        if (this.options.resizesContainer) {
            var d = this["_" + c + "GetContainerSize"]();
            this.styleQueue.push({$el:this.element, style:d})
        }
        this._processStyleQueue(), b && b.call(a), this.isLaidOut = !0
    }, _processStyleQueue:function () {
        var a = this.isLaidOut ? this.isUsingJQueryAnimation ? "animate" : "css" : "css", c = this.options.animationOptions, d = this._isInserting && this.isUsingJQueryAnimation, e;
        b.each(this.styleQueue, function (b, f) {
            e = d && f.$el.hasClass("no-transition") ? "css" : a, f.$el[e](f.style, c)
        }), this.styleQueue = []
    }, resize:function () {
        this["_" + this.options.layoutMode + "ResizeChanged"]() && this.reLayout()
    }, reLayout:function (a) {
        this["_" + this.options.layoutMode + "Reset"](), this.layout(this.$filteredAtoms, a)
    }, addItems:function (a, b) {
        var c = this._getAtoms(a);
        this.$allAtoms = this.$allAtoms.add(c), b && b(c)
    }, insert:function (a, b) {
        this.element.append(a);
        var c = this;
        this.addItems(a, function (a) {
            var d = c._filter(a, !0);
            c._addHideAppended(d), c._sort(), c.reLayout(), c._revealAppended(d, b)
        })
    }, appended:function (a, b) {
        var c = this;
        this.addItems(a, function (a) {
            c._addHideAppended(a), c.layout(a), c._revealAppended(a, b)
        })
    }, _addHideAppended:function (a) {
        this.$filteredAtoms = this.$filteredAtoms.add(a), a.addClass("no-transition"), this._isInserting = !0, this.styleQueue.push({$el:a, style:this.options.hiddenStyle})
    }, _revealAppended:function (a, b) {
        var c = this;
        setTimeout(function () {
            a.removeClass("no-transition"), c.styleQueue.push({$el:a, style:c.options.visibleStyle}), c._processStyleQueue(), delete c._isInserting, b && b(a)
        }, 10)
    }, reloadItems:function () {
        this.$allAtoms = this._getAtoms(this.element.children())
    }, remove:function (a) {
        this.$allAtoms = this.$allAtoms.not(a), this.$filteredAtoms = this.$filteredAtoms.not(a), a.remove()
    }, shuffle:function () {
        this.updateSortData(this.$allAtoms), this.options.sortBy = "random", this._sort(), this.reLayout()
    }, destroy:function () {
        var c = this.usingTransforms;
        this.$allAtoms.removeClass(this.options.hiddenClass + " " + this.options.itemClass).each(function () {
            this.style.position = "", this.style.top = "", this.style.left = "", this.style.opacity = "", c && (this.style[g] = "")
        });
        var d = this.element[0].style;
        for (var e = 0, f = n.length; e < f; e++) {
            var h = n[e];
            d[h] = this.originalStyle[h]
        }
        this.element.unbind(".isotope").undelegate("." + this.options.hiddenClass, "click").removeClass(this.options.containerClass).removeData("isotope"), b(a).unbind(".isotope")
    }, _getSegments:function (a) {
        var b = this.options.layoutMode, c = a ? "rowHeight" : "columnWidth", e = a ? "height" : "width", f = a ? "rows" : "cols", g = this.element[e](), h, i = this.options[b] && this.options[b][c] || this.$filteredAtoms["outer" + d(e)](!0) || g;
        h = Math.floor(g / i), h = Math.max(h, 1), this[b][f] = h, this[b][c] = i
    }, _checkIfSegmentsChanged:function (a) {
        var b = this.options.layoutMode, c = a ? "rows" : "cols", d = this[b][c];
        this._getSegments(a);
        return this[b][c] !== d
    }, _masonryReset:function () {
        this.masonry = {}, this._getSegments();
        var a = this.masonry.cols;
        this.masonry.colYs = [];
        while (a--)this.masonry.colYs.push(0)
    }, _masonryLayout:function (a) {
        var c = this, d = c.masonry;
        a.each(function () {
            var a = b(this), e = Math.ceil(a.outerWidth(!0) / d.columnWidth);
            e = Math.min(e, d.cols);
            if (e === 1)c._masonryPlaceBrick(a, d.colYs); else {
                var f = d.cols + 1 - e, g = [], h, i;
                for (i = 0; i < f; i++)h = d.colYs.slice(i, i + e), g[i] = Math.max.apply(Math, h);
                c._masonryPlaceBrick(a, g)
            }
        })
    }, _masonryPlaceBrick:function (a, b) {
        var c = Math.min.apply(Math, b), d = 0;
        for (var e = 0, f = b.length; e < f; e++)if (b[e] === c) {
            d = e;
            break
        }
        var g = this.masonry.columnWidth * d, h = c;
        this._pushPosition(a, g, h);
        var i = c + a.outerHeight(!0), j = this.masonry.cols + 1 - f;
        for (e = 0; e < j; e++)this.masonry.colYs[d + e] = i
    }, _masonryGetContainerSize:function () {
        var a = Math.max.apply(Math, this.masonry.colYs);
        return{height:a}
    }, _masonryResizeChanged:function () {
        return this._checkIfSegmentsChanged()
    }, _fitRowsReset:function () {
        this.fitRows = {x:0, y:0, height:0}
    }, _fitRowsLayout:function (a) {
        var c = this, d = this.element.width(), e = this.fitRows;
        a.each(function () {
            var a = b(this), f = a.outerWidth(!0), g = a.outerHeight(!0);
            e.x !== 0 && f + e.x > d && (e.x = 0, e.y = e.height), c._pushPosition(a, e.x, e.y), e.height = Math.max(e.y + g, e.height), e.x += f
        })
    }, _fitRowsGetContainerSize:function () {
        return{height:this.fitRows.height}
    }, _fitRowsResizeChanged:function () {
        return!0
    }, _cellsByRowReset:function () {
        this.cellsByRow = {index:0}, this._getSegments(), this._getSegments(!0)
    }, _cellsByRowLayout:function (a) {
        var c = this, d = this.cellsByRow;
        a.each(function () {
            var a = b(this), e = d.index % d.cols, f = ~~(d.index / d.cols), g = (e + .5) * d.columnWidth - a.outerWidth(!0) / 2, h = (f + .5) * d.rowHeight - a.outerHeight(!0) / 2;
            c._pushPosition(a, g, h), d.index++
        })
    }, _cellsByRowGetContainerSize:function () {
        return{height:Math.ceil(this.$filteredAtoms.length / this.cellsByRow.cols) * this.cellsByRow.rowHeight + this.offset.top}
    }, _cellsByRowResizeChanged:function () {
        return this._checkIfSegmentsChanged()
    }, _straightDownReset:function () {
        this.straightDown = {y:0}
    }, _straightDownLayout:function (a) {
        var c = this;
        a.each(function (a) {
            var d = b(this);
            c._pushPosition(d, 0, c.straightDown.y), c.straightDown.y += d.outerHeight(!0)
        })
    }, _straightDownGetContainerSize:function () {
        return{height:this.straightDown.y}
    }, _straightDownResizeChanged:function () {
        return!0
    }, _masonryHorizontalReset:function () {
        this.masonryHorizontal = {}, this._getSegments(!0);
        var a = this.masonryHorizontal.rows;
        this.masonryHorizontal.rowXs = [];
        while (a--)this.masonryHorizontal.rowXs.push(0)
    }, _masonryHorizontalLayout:function (a) {
        var c = this, d = c.masonryHorizontal;
        a.each(function () {
            var a = b(this), e = Math.ceil(a.outerHeight(!0) / d.rowHeight);
            e = Math.min(e, d.rows);
            if (e === 1)c._masonryHorizontalPlaceBrick(a, d.rowXs); else {
                var f = d.rows + 1 - e, g = [], h, i;
                for (i = 0; i < f; i++)h = d.rowXs.slice(i, i + e), g[i] = Math.max.apply(Math, h);
                c._masonryHorizontalPlaceBrick(a, g)
            }
        })
    }, _masonryHorizontalPlaceBrick:function (a, b) {
        var c = Math.min.apply(Math, b), d = 0;
        for (var e = 0, f = b.length; e < f; e++)if (b[e] === c) {
            d = e;
            break
        }
        var g = c, h = this.masonryHorizontal.rowHeight * d;
        this._pushPosition(a, g, h);
        var i = c + a.outerWidth(!0), j = this.masonryHorizontal.rows + 1 - f;
        for (e = 0; e < j; e++)this.masonryHorizontal.rowXs[d + e] = i
    }, _masonryHorizontalGetContainerSize:function () {
        var a = Math.max.apply(Math, this.masonryHorizontal.rowXs);
        return{width:a}
    }, _masonryHorizontalResizeChanged:function () {
        return this._checkIfSegmentsChanged(!0)
    }, _fitColumnsReset:function () {
        this.fitColumns = {x:0, y:0, width:0}
    }, _fitColumnsLayout:function (a) {
        var c = this, d = this.element.height(), e = this.fitColumns;
        a.each(function () {
            var a = b(this), f = a.outerWidth(!0), g = a.outerHeight(!0);
            e.y !== 0 && g + e.y > d && (e.x = e.width, e.y = 0), c._pushPosition(a, e.x, e.y), e.width = Math.max(e.x + f, e.width), e.y += g
        })
    }, _fitColumnsGetContainerSize:function () {
        return{width:this.fitColumns.width}
    }, _fitColumnsResizeChanged:function () {
        return!0
    }, _cellsByColumnReset:function () {
        this.cellsByColumn = {index:0}, this._getSegments(), this._getSegments(!0)
    }, _cellsByColumnLayout:function (a) {
        var c = this, d = this.cellsByColumn;
        a.each(function () {
            var a = b(this), e = ~~(d.index / d.rows), f = d.index % d.rows, g = (e + .5) * d.columnWidth - a.outerWidth(!0) / 2, h = (f + .5) * d.rowHeight - a.outerHeight(!0) / 2;
            c._pushPosition(a, g, h), d.index++
        })
    }, _cellsByColumnGetContainerSize:function () {
        return{width:Math.ceil(this.$filteredAtoms.length / this.cellsByColumn.rows) * this.cellsByColumn.columnWidth}
    }, _cellsByColumnResizeChanged:function () {
        return this._checkIfSegmentsChanged(!0)
    }, _straightAcrossReset:function () {
        this.straightAcross = {x:0}
    }, _straightAcrossLayout:function (a) {
        var c = this;
        a.each(function (a) {
            var d = b(this);
            c._pushPosition(d, c.straightAcross.x, 0), c.straightAcross.x += d.outerWidth(!0)
        })
    }, _straightAcrossGetContainerSize:function () {
        return{width:this.straightAcross.x}
    }, _straightAcrossResizeChanged:function () {
        return!0
    }}, b.fn.imagesLoaded = function (a) {
        function h() {
            --e <= 0 && this.src !== f && (setTimeout(g), d.unbind("load error", h))
        }

        function g() {
            a.call(b, d)
        }

        var b = this, d = b.find("img").add(b.filter("img")), e = d.length, f = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
        e || g(), d.bind("load error", h).each(function () {
            if (this.complete || this.complete === c) {
                var a = this.src;
                this.src = f, this.src = a
            }
        });
        return b
    };
    var o = function (a) {
        this.console && console.error(a)
    };
    b.fn.isotope = function (a) {
        if (typeof a == "string") {
            var c = Array.prototype.slice.call(arguments, 1);
            this.each(function () {
                var d = b.data(this, "isotope");
                if (!d)o("cannot call methods on isotope prior to initialization; attempted to call method '" + a + "'"); else {
                    if (!b.isFunction(d[a]) || a.charAt(0) === "_") {
                        o("no such method '" + a + "' for isotope instance");
                        return
                    }
                    d[a].apply(d, c)
                }
            })
        } else this.each(function () {
            var c = b.data(this, "isotope");
            c ? (c.option(a), c._init()) : b.data(this, "isotope", new b.Isotope(a, this))
        });
        return this
    }
})(window, jQuery);

/*
 * Slides, A Slideshow Plugin for jQuery
 * Intructions: http://slidesjs.com
 */
(function (a) {
    a.fn.slides = function (b) {
        return b = a.extend({}, a.fn.slides.option, b), this.each(function () {
            function w(g, h, i) {
                if (!p && o) {
                    p = !0, b.animationStart(n + 1);
                    switch (g) {
                        case"next":
                            l = n, k = n + 1, k = e === k ? 0 : k, r = f * 2, g = -f * 2, n = k;
                            break;
                        case"prev":
                            l = n, k = n - 1, k = k === -1 ? e - 1 : k, r = 0, g = 0, n = k;
                            break;
                        case"pagination":
                            k = parseInt(i, 10), l = a("." + b.paginationClass + " li." + b.currentClass + " a", c).attr("href").match("[^#/]+$"), k > l ? (r = f * 2, g = -f * 2) : (r = 0, g = 0), n = k
                    }
                    h === "fade" ? b.crossfade ? d.children(":eq(" + k + ")", c).css({zIndex:10}).fadeIn(b.fadeSpeed, b.fadeEasing, function () {
                        b.autoHeight ? d.animate({height:d.children(":eq(" + k + ")", c).outerHeight()}, b.autoHeightSpeed, function () {
                            d.children(":eq(" + l + ")", c).css({display:"none", zIndex:0}), d.children(":eq(" + k + ")", c).css({zIndex:0}), b.animationComplete(k + 1), p = !1
                        }) : (d.children(":eq(" + l + ")", c).css({display:"none", zIndex:0}), d.children(":eq(" + k + ")", c).css({zIndex:0}), b.animationComplete(k + 1), p = !1)
                    }) : d.children(":eq(" + l + ")", c).fadeOut(b.fadeSpeed, b.fadeEasing, function () {
                        b.autoHeight ? d.animate({height:d.children(":eq(" + k + ")", c).outerHeight()}, b.autoHeightSpeed, function () {
                            d.children(":eq(" + k + ")", c).fadeIn(b.fadeSpeed, b.fadeEasing)
                        }) : d.children(":eq(" + k + ")", c).fadeIn(b.fadeSpeed, b.fadeEasing, function () {
                            a.browser.msie && a(this).get(0).style.removeAttribute("filter")
                        }), b.animationComplete(k + 1), p = !1
                    }) : (d.children(":eq(" + k + ")").css({left:r, display:"block"}), b.autoHeight ? d.animate({left:g, height:d.children(":eq(" + k + ")").outerHeight()}, b.slideSpeed, b.slideEasing, function () {
                        d.css({left:-f}), d.children(":eq(" + k + ")").css({left:f, zIndex:5}), d.children(":eq(" + l + ")").css({left:f, display:"none", zIndex:0}), b.animationComplete(k + 1), p = !1
                    }) : d.animate({left:g}, b.slideSpeed, b.slideEasing, function () {
                        d.css({left:-f}), d.children(":eq(" + k + ")").css({left:f, zIndex:5}), d.children(":eq(" + l + ")").css({left:f, display:"none", zIndex:0}), b.animationComplete(k + 1), p = !1
                    })), b.pagination && (a("." + b.paginationClass + " li." + b.currentClass, c).removeClass(b.currentClass), a("." + b.paginationClass + " li:eq(" + k + ")", c).addClass(b.currentClass))
                }
            }

            function x() {
                clearInterval(c.data("interval"))
            }

            function y() {
                b.pause ? (clearTimeout(c.data("pause")), clearInterval(c.data("interval")), u = setTimeout(function () {
                    clearTimeout(c.data("pause")), v = setInterval(function () {
                        w("next", i)
                    }, b.play), c.data("interval", v)
                }, b.pause), c.data("pause", u)) : x()
            }

            a("." + b.container, a(this)).children().wrapAll('<div class="slides_control"/>');
            var c = a(this), d = a(".slides_control", c), e = d.children().size(), f = d.children().outerWidth(), g = d.children().outerHeight(), h = b.start - 1, i = b.effect.indexOf(",") < 0 ? b.effect : b.effect.replace(" ", "").split(",")[0], j = b.effect.indexOf(",") < 0 ? i : b.effect.replace(" ", "").split(",")[1], k = 0, l = 0, m = 0, n = 0, o, p, q, r, s, t, u, v;
            if (e < 2)return a("." + b.container, a(this)).fadeIn(b.fadeSpeed, b.fadeEasing, function () {
                o = !0, b.slidesLoaded()
            }), a("." + b.next + ", ." + b.prev).fadeOut(0), !1;
            if (e < 2)return;
            h < 0 && (h = 0), h > e && (h = e - 1), b.start && (n = h), b.randomize && d.randomize(), a("." + b.container, c).css({overflow:"hidden", position:"relative"}), d.children().css({position:"absolute", top:0, left:d.children().outerWidth(), zIndex:0, display:"none"}), d.css({position:"relative", width:f * 3, height:g, left:-f}), a("." + b.container, c).css({display:"block"}), b.autoHeight && (d.children().css({height:"auto"}), d.animate({height:d.children(":eq(" + h + ")").outerHeight()}, b.autoHeightSpeed));
            if (b.preload && d.find("img:eq(" + h + ")").length) {
                a("." + b.container, c).css({background:"url(" + b.preloadImage + ") no-repeat 50% 50%"});
                var z = d.find("img:eq(" + h + ")").attr("src") + "?" + (new Date).getTime();
                a("img", c).parent().attr("class") != "slides_control" ? t = d.children(":eq(0)")[0].tagName.toLowerCase() : t = d.find("img:eq(" + h + ")"), d.find("img:eq(" + h + ")").attr("src", z).load(function () {
                    d.find(t + ":eq(" + h + ")").fadeIn(b.fadeSpeed, b.fadeEasing, function () {
                        a(this).css({zIndex:5}), a("." + b.container, c).css({background:""}), o = !0, b.slidesLoaded()
                    })
                })
            } else d.children(":eq(" + h + ")").fadeIn(b.fadeSpeed, b.fadeEasing, function () {
                o = !0, b.slidesLoaded()
            });
            b.bigTarget && (d.children().css({cursor:"pointer"}), d.children().click(function () {
                return w("next", i), !1
            })), b.hoverPause && b.play && (d.bind("mouseover", function () {
                x()
            }), d.bind("mouseleave", function () {
                y()
            })), b.generateNextPrev && (a("." + b.container, c).after('<a href="#" class="' + b.prev + '">Prev</a>'), a("." + b.prev, c).after('<a href="#" class="' + b.next + '">Next</a>')), a("." + b.next, c).click(function (a) {
                a.preventDefault(), b.play && y(), w("next", i)
            }), a("." + b.prev, c).click(function (a) {
                a.preventDefault(), b.play && y(), w("prev", i)
            }), b.generatePagination ? (b.prependPagination ? c.prepend("<ul class=" + b.paginationClass + "></ul>") : c.append("<ul class=" + b.paginationClass + "></ul>"), d.children().each(function () {
                a("." + b.paginationClass, c).append('<li><a href="#' + m + '">' + (m + 1) + "</a></li>"), m++
            })) : a("." + b.paginationClass + " li a", c).each(function () {
                a(this).attr("href", "#" + m), m++
            }), a("." + b.paginationClass + " li:eq(" + h + ")", c).addClass(b.currentClass), a("." + b.paginationClass + " li a", c).click(function () {
                return b.play && y(), q = a(this).attr("href").match("[^#/]+$"), n != q && w("pagination", j, q), !1
            }), a("a.link", c).click(function () {
                return b.play && y(), q = a(this).attr("href").match("[^#/]+$") - 1, n != q && w("pagination", j, q), !1
            }), b.play && (v = setInterval(function () {
                w("next", i)
            }, b.play), c.data("interval", v))
        })
    }, a.fn.slides.option = {preload:!1, preloadImage:"/img/loading.gif", container:"slides_container", generateNextPrev:!1, next:"next", prev:"prev", pagination:!0, generatePagination:!0, prependPagination:!1, paginationClass:"pagination", currentClass:"current", fadeSpeed:350, fadeEasing:"", slideSpeed:350, slideEasing:"", start:1, effect:"slide", crossfade:!1, randomize:!1, play:0, pause:0, hoverPause:!1, autoHeight:!1, autoHeightSpeed:350, bigTarget:!1, animationStart:function () {
    }, animationComplete:function () {
    }, slidesLoaded:function () {
    }}, a.fn.randomize = function (b) {
        function c() {
            return Math.round(Math.random()) - .5
        }

        return a(this).each(function () {
            var d = a(this), e = d.children(), f = e.length;
            if (f > 1) {
                e.hide();
                var g = [];
                for (i = 0; i < f; i++)g[g.length] = i;
                g = g.sort(c), a.each(g, function (a, c) {
                    var f = e.eq(c), g = f.clone(!0);
                    g.show().appendTo(d), b !== undefined && b(f, g), f.remove()
                })
            }
        })
    }
})(jQuery)

/* ==========================================================
 * bootstrap-twipsy.js v1.3.0
 * ========================================================== */


!function ($) {

    /* CSS TRANSITION SUPPORT (https://gist.github.com/373874)
     * ======================================================= */

    var transitionEnd

    $(document).ready(function () {

        $.support.transition = (function () {
            var thisBody = document.body || document.documentElement
                , thisStyle = thisBody.style
                , support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined
            return support
        })()

        // set CSS transition event type
        if ($.support.transition) {
            transitionEnd = "TransitionEnd"
            if ($.browser.webkit) {
                transitionEnd = "webkitTransitionEnd"
            } else if ($.browser.mozilla) {
                transitionEnd = "transitionend"
            } else if ($.browser.opera) {
                transitionEnd = "oTransitionEnd"
            }
        }

    })


    /* TWIPSY PUBLIC CLASS DEFINITION
     * ============================== */

    var Twipsy = function (element, options) {
        this.$element = $(element)
        this.options = options
        this.enabled = true
        this.fixTitle()
    }

    Twipsy.prototype = {

        show:function () {
            var pos
                , actualWidth
                , actualHeight
                , placement
                , $tip
                , tp

            if (this.getTitle() && this.enabled) {
                $tip = this.tip()
                this.setContent()

                if (this.options.animate) {
                    $tip.addClass('fade')
                }

                $tip
                    .remove()
                    .css({ top:0, left:0, display:'block' })
                    .prependTo(document.body)

                pos = $.extend({}, this.$element.offset(), {
                    width:this.$element[0].offsetWidth, height:this.$element[0].offsetHeight
                })

                actualWidth = $tip[0].offsetWidth
                actualHeight = $tip[0].offsetHeight

                placement = maybeCall(this.options.placement, this, [ $tip[0], this.$element[0] ])

                switch (placement) {
                    case 'below':
                        tp = {top:pos.top + pos.height + this.options.offset, left:pos.left + pos.width / 2 - actualWidth / 2}
                        break
                    case 'above':
                        tp = {top:pos.top - actualHeight - this.options.offset, left:pos.left + pos.width / 2 - actualWidth / 2}
                        break
                    case 'left':
                        tp = {top:pos.top + pos.height / 2 - actualHeight / 2, left:pos.left - actualWidth - this.options.offset}
                        break
                    case 'right':
                        tp = {top:pos.top + pos.height / 2 - actualHeight / 2, left:pos.left + pos.width + this.options.offset}
                        break
                }

                $tip
                    .css(tp)
                    .addClass(placement)
                    .addClass('in')
            }
        }, setContent:function () {
            var $tip = this.tip()
            $tip.find('.twipsy-inner')[this.options.html ? 'html' : 'text'](this.getTitle())
            $tip[0].className = 'twipsy'
        }, hide:function () {
            var that = this
                , $tip = this.tip()

            $tip.removeClass('in')

            function removeElement() {
                $tip.remove()
            }

            $.support.transition && this.$tip.hasClass('fade') ?
                $tip.bind(transitionEnd, removeElement) :
                removeElement()
        }, fixTitle:function () {
            var $e = this.$element
            if ($e.attr('title') || typeof($e.attr('data-original-title')) != 'string') {
                $e.attr('data-original-title', $e.attr('title') || '').removeAttr('title')
            }
        }, getTitle:function () {
            var title
                , $e = this.$element
                , o = this.options

            this.fixTitle()

            if (typeof o.title == 'string') {
                title = $e.attr(o.title == 'title' ? 'data-original-title' : o.title)
            } else if (typeof o.title == 'function') {
                title = o.title.call($e[0])
            }

            title = ('' + title).replace(/(^\s*|\s*$)/, "")

            return title || o.fallback
        }, tip:function () {
            if (!this.$tip) {
                this.$tip = $('<div class="twipsy" />').html('<div class="twipsy-arrow"></div><div class="twipsy-inner"></div>')
            }
            return this.$tip
        }, validate:function () {
            if (!this.$element[0].parentNode) {
                this.hide()
                this.$element = null
                this.options = null
            }
        }, enable:function () {
            this.enabled = true
        }, disable:function () {
            this.enabled = false
        }, toggleEnabled:function () {
            this.enabled = !this.enabled
        }

    }


    /* TWIPSY PRIVATE METHODS
     * ====================== */

    function maybeCall(thing, ctx, args) {
        return typeof thing == 'function' ? thing.apply(ctx, args) : thing
    }

    /* TWIPSY PLUGIN DEFINITION
     * ======================== */

    $.fn.twipsy = function (options) {
        $.fn.twipsy.initWith.call(this, options, Twipsy, 'twipsy')
        return this
    }

    $.fn.twipsy.initWith = function (options, Constructor, name) {
        var twipsy
            , binder
            , eventIn
            , eventOut

        if (options === true) {
            return this.data(name)
        } else if (typeof options == 'string') {
            twipsy = this.data(name)
            if (twipsy) {
                twipsy[options]()
            }
            return this
        }

        options = $.extend({}, $.fn[name].defaults, options)

        function get(ele) {
            var twipsy = $.data(ele, name)

            if (!twipsy) {
                twipsy = new Constructor(ele, $.fn.twipsy.elementOptions(ele, options))
                $.data(ele, name, twipsy)
            }

            return twipsy
        }

        function enter() {
            var twipsy = get(this)
            twipsy.hoverState = 'in'

            if (options.delayIn == 0) {
                twipsy.show()
            } else {
                twipsy.fixTitle()
                setTimeout(function () {
                    if (twipsy.hoverState == 'in') {
                        twipsy.show()
                    }
                }, options.delayIn)
            }
        }

        function leave() {
            var twipsy = get(this)
            twipsy.hoverState = 'out'
            if (options.delayOut == 0) {
                twipsy.hide()
            } else {
                setTimeout(function () {
                    if (twipsy.hoverState == 'out') {
                        twipsy.hide()
                    }
                }, options.delayOut)
            }
        }

        if (!options.live) {
            this.each(function () {
                get(this)
            })
        }

        if (options.trigger != 'manual') {
            binder = options.live ? 'live' : 'bind'
            eventIn = options.trigger == 'hover' ? 'mouseenter' : 'focus'
            eventOut = options.trigger == 'hover' ? 'mouseleave' : 'blur'
            this[binder](eventIn, enter)[binder](eventOut, leave)
        }

        return this
    }

    $.fn.twipsy.Twipsy = Twipsy

    $.fn.twipsy.defaults = {
        animate:true, delayIn:0, delayOut:0, fallback:'', placement:'above', html:false, live:false, offset:0, title:'title', trigger:'hover'
    }

    $.fn.twipsy.elementOptions = function (ele, options) {
        return $.metadata ? $.extend({}, options, $(ele).metadata()) : options
    }

}(window.jQuery || window.ender);

/* ==========================================================
 * bootstrap-alerts.js v1.3.0
 * http://twitter.github.com/bootstrap/javascript.html#alerts
 * ==========================================================
 * ========================================================== */


!function ($) {

    /* CSS TRANSITION SUPPORT (https://gist.github.com/373874)
     * ======================================================= */

    var transitionEnd

    $(document).ready(function () {

        $.support.transition = (function () {
            var thisBody = document.body || document.documentElement
                , thisStyle = thisBody.style
                , support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined
            return support
        })()

        // set CSS transition event type
        if ($.support.transition) {
            transitionEnd = "TransitionEnd"
            if ($.browser.webkit) {
                transitionEnd = "webkitTransitionEnd"
            } else if ($.browser.mozilla) {
                transitionEnd = "transitionend"
            } else if ($.browser.opera) {
                transitionEnd = "oTransitionEnd"
            }
        }

    })

    /* ALERT CLASS DEFINITION
     * ====================== */

    var Alert = function (content, options) {
        this.settings = $.extend({}, $.fn.alert.defaults, options)
        this.$element = $(content)
            .delegate(this.settings.selector, 'click', this.close)
    }

    Alert.prototype = {

        close:function (e) {
            var $element = $(this).parent('.alert-message')

            e && e.preventDefault()
            $element.removeClass('in')

            function removeElement() {
                $element.remove()
            }

            $.support.transition && $element.hasClass('fade') ?
                $element.bind(transitionEnd, removeElement) :
                removeElement()
        }

    }


    /* ALERT PLUGIN DEFINITION
     * ======================= */

    $.fn.alert = function (options) {

        if (options === true) {
            return this.data('alert')
        }

        return this.each(function () {
            var $this = $(this)

            if (typeof options == 'string') {
                return $this.data('alert')[options]()
            }

            $(this).data('alert', new Alert(this, options))

        })
    }

    $.fn.alert.defaults = {
        selector:'.close'
    }

    $(document).ready(function () {
        new Alert($('body'), {
            selector:'.alert-message[data-alert] .close'
        })
    })

}(window.jQuery || window.ender);

/* ========================================================
 * bootstrap-tab.js v2.0.1
 * http://twitter.github.com/bootstrap/javascript.html#tabs
 * ========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ======================================================== */


!function ($) {

    "use strict"

    /* TAB CLASS DEFINITION
     * ==================== */

    var Tab = function (element) {
        this.element = $(element)
    }

    Tab.prototype = {

        constructor:Tab, show:function () {
            var $this = this.element
                , $ul = $this.closest('ul:not(.dropdown-menu)')
                , selector = $this.attr('data-target')
                , previous
                , $target

            if (!selector) {
                selector = $this.attr('href')
                selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') //strip for ie7
            }

            if ($this.parent('li').hasClass('active')) return

            previous = $ul.find('.active a').last()[0]

            $this.trigger({
                type:'show', relatedTarget:previous
            })

            $target = $(selector)

            this.activate($this.parent('li'), $ul)
            this.activate($target, $target.parent(), function () {
                $this.trigger({
                    type:'shown', relatedTarget:previous
                })
            })
        }, activate:function (element, container, callback) {
            var $active = container.find('> .active')
                , transition = callback
                && $.support.transition
                && $active.hasClass('fade')

            function next() {
                $active
                    .removeClass('active')
                    .find('> .dropdown-menu > .active')
                    .removeClass('active')

                element.addClass('active')

                if (transition) {
                    element[0].offsetWidth // reflow for transition
                    element.addClass('in')
                } else {
                    element.removeClass('fade')
                }

                if (element.parent('.dropdown-menu')) {
                    element.closest('li.dropdown').addClass('active')
                }

                callback && callback()
            }

            transition ?
                $active.one($.support.transition.end, next) :
                next()

            $active.removeClass('in')
        }
    }


    /* TAB PLUGIN DEFINITION
     * ===================== */

    $.fn.tab = function (option) {
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('tab')
            if (!data) $this.data('tab', (data = new Tab(this)))
            if (typeof option == 'string') data[option]()
        })
    }

    $.fn.tab.Constructor = Tab


    /* TAB DATA-API
     * ============ */

    $(function () {
        $('body').on('click.tab.data-api', '[data-toggle="tab"], [data-toggle="pill"]', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    })

}(window.jQuery);


/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 */

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend(jQuery.easing,
    {
        def:'easeOutQuad',
        swing:function (x, t, b, c, d) {
            //alert(jQuery.easing.default);
            return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
        },
        easeInQuad:function (x, t, b, c, d) {
            return c * (t /= d) * t + b;
        },
        easeOutQuad:function (x, t, b, c, d) {
            return -c * (t /= d) * (t - 2) + b;
        },
        easeInOutQuad:function (x, t, b, c, d) {
            if ((t /= d / 2) < 1) return c / 2 * t * t + b;
            return -c / 2 * ((--t) * (t - 2) - 1) + b;
        },
        easeInCubic:function (x, t, b, c, d) {
            return c * (t /= d) * t * t + b;
        },
        easeOutCubic:function (x, t, b, c, d) {
            return c * ((t = t / d - 1) * t * t + 1) + b;
        },
        easeInOutCubic:function (x, t, b, c, d) {
            if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
            return c / 2 * ((t -= 2) * t * t + 2) + b;
        },
        easeInQuart:function (x, t, b, c, d) {
            return c * (t /= d) * t * t * t + b;
        },
        easeOutQuart:function (x, t, b, c, d) {
            return -c * ((t = t / d - 1) * t * t * t - 1) + b;
        },
        easeInOutQuart:function (x, t, b, c, d) {
            if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
            return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
        },
        easeInQuint:function (x, t, b, c, d) {
            return c * (t /= d) * t * t * t * t + b;
        },
        easeOutQuint:function (x, t, b, c, d) {
            return c * ((t = t / d - 1) * t * t * t * t + 1) + b;
        },
        easeInOutQuint:function (x, t, b, c, d) {
            if ((t /= d / 2) < 1) return c / 2 * t * t * t * t * t + b;
            return c / 2 * ((t -= 2) * t * t * t * t + 2) + b;
        },
        easeInSine:function (x, t, b, c, d) {
            return -c * Math.cos(t / d * (Math.PI / 2)) + c + b;
        },
        easeOutSine:function (x, t, b, c, d) {
            return c * Math.sin(t / d * (Math.PI / 2)) + b;
        },
        easeInOutSine:function (x, t, b, c, d) {
            return -c / 2 * (Math.cos(Math.PI * t / d) - 1) + b;
        },
        easeInExpo:function (x, t, b, c, d) {
            return (t == 0) ? b : c * Math.pow(2, 10 * (t / d - 1)) + b;
        },
        easeOutExpo:function (x, t, b, c, d) {
            return (t == d) ? b + c : c * (-Math.pow(2, -10 * t / d) + 1) + b;
        },
        easeInOutExpo:function (x, t, b, c, d) {
            if (t == 0) return b;
            if (t == d) return b + c;
            if ((t /= d / 2) < 1) return c / 2 * Math.pow(2, 10 * (t - 1)) + b;
            return c / 2 * (-Math.pow(2, -10 * --t) + 2) + b;
        },
        easeInCirc:function (x, t, b, c, d) {
            return -c * (Math.sqrt(1 - (t /= d) * t) - 1) + b;
        },
        easeOutCirc:function (x, t, b, c, d) {
            return c * Math.sqrt(1 - (t = t / d - 1) * t) + b;
        },
        easeInOutCirc:function (x, t, b, c, d) {
            if ((t /= d / 2) < 1) return -c / 2 * (Math.sqrt(1 - t * t) - 1) + b;
            return c / 2 * (Math.sqrt(1 - (t -= 2) * t) + 1) + b;
        },
        easeInElastic:function (x, t, b, c, d) {
            var s = 1.70158;
            var p = 0;
            var a = c;
            if (t == 0) return b;
            if ((t /= d) == 1) return b + c;
            if (!p) p = d * .3;
            if (a < Math.abs(c)) {
                a = c;
                var s = p / 4;
            }
            else var s = p / (2 * Math.PI) * Math.asin(c / a);
            return -(a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b;
        },
        easeOutElastic:function (x, t, b, c, d) {
            var s = 1.70158;
            var p = 0;
            var a = c;
            if (t == 0) return b;
            if ((t /= d) == 1) return b + c;
            if (!p) p = d * .3;
            if (a < Math.abs(c)) {
                a = c;
                var s = p / 4;
            }
            else var s = p / (2 * Math.PI) * Math.asin(c / a);
            return a * Math.pow(2, -10 * t) * Math.sin((t * d - s) * (2 * Math.PI) / p) + c + b;
        },
        easeInOutElastic:function (x, t, b, c, d) {
            var s = 1.70158;
            var p = 0;
            var a = c;
            if (t == 0) return b;
            if ((t /= d / 2) == 2) return b + c;
            if (!p) p = d * (.3 * 1.5);
            if (a < Math.abs(c)) {
                a = c;
                var s = p / 4;
            }
            else var s = p / (2 * Math.PI) * Math.asin(c / a);
            if (t < 1) return -.5 * (a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b;
            return a * Math.pow(2, -10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p) * .5 + c + b;
        },
        easeInBack:function (x, t, b, c, d, s) {
            if (s == undefined) s = 1.70158;
            return c * (t /= d) * t * ((s + 1) * t - s) + b;
        },
        easeOutBack:function (x, t, b, c, d, s) {
            if (s == undefined) s = 1.70158;
            return c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b;
        },
        easeInOutBack:function (x, t, b, c, d, s) {
            if (s == undefined) s = 1.70158;
            if ((t /= d / 2) < 1) return c / 2 * (t * t * (((s *= (1.525)) + 1) * t - s)) + b;
            return c / 2 * ((t -= 2) * t * (((s *= (1.525)) + 1) * t + s) + 2) + b;
        },
        easeInBounce:function (x, t, b, c, d) {
            return c - jQuery.easing.easeOutBounce(x, d - t, 0, c, d) + b;
        },
        easeOutBounce:function (x, t, b, c, d) {
            if ((t /= d) < (1 / 2.75)) {
                return c * (7.5625 * t * t) + b;
            } else if (t < (2 / 2.75)) {
                return c * (7.5625 * (t -= (1.5 / 2.75)) * t + .75) + b;
            } else if (t < (2.5 / 2.75)) {
                return c * (7.5625 * (t -= (2.25 / 2.75)) * t + .9375) + b;
            } else {
                return c * (7.5625 * (t -= (2.625 / 2.75)) * t + .984375) + b;
            }
        },
        easeInOutBounce:function (x, t, b, c, d) {
            if (t < d / 2) return jQuery.easing.easeInBounce(x, t * 2, 0, c, d) * .5 + b;
            return jQuery.easing.easeOutBounce(x, t * 2 - d, 0, c, d) * .5 + c * .5 + b;
        }
    });

/* =========================================================
 * bootstrap-modal.js v1.3.0
 * http://twitter.github.com/bootstrap/javascript.html#modal
 * =========================================================
 * Copyright 2011 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */


!function ($) {

    /* CSS TRANSITION SUPPORT (https://gist.github.com/373874)
     * ======================================================= */

    var transitionEnd

    $(document).ready(function () {

        $.support.transition = (function () {
            var thisBody = document.body || document.documentElement
                , thisStyle = thisBody.style
                , support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined
            return support
        })()

        // set CSS transition event type
        if ($.support.transition) {
            transitionEnd = "TransitionEnd"
            if ($.browser.webkit) {
                transitionEnd = "webkitTransitionEnd"
            } else if ($.browser.mozilla) {
                transitionEnd = "transitionend"
            } else if ($.browser.opera) {
                transitionEnd = "oTransitionEnd"
            }
        }

    })


    /* MODAL PUBLIC CLASS DEFINITION
     * ============================= */

    var Modal = function (content, options) {
        this.settings = $.extend({}, $.fn.modal.defaults, options)
        this.$element = $(content)
            .delegate('.close', 'click.modal', $.proxy(this.hide, this))

        if (this.settings.show) {
            this.show()
        }

        return this
    }

    Modal.prototype = {

        toggle:function () {
            return this[!this.isShown ? 'show' : 'hide']()
        }, show:function () {
            var that = this
            this.isShown = true
            this.$element.trigger('show')

            escape.call(this)
            backdrop.call(this, function () {
                var transition = $.support.transition && that.$element.hasClass('fade')

                that.$element
                    .appendTo(document.body)
                    .show()

                if (transition) {
                    that.$element[0].offsetWidth // force reflow
                }

                that.$element
                    .addClass('in')

                transition ?
                    that.$element.one(transitionEnd, function () {
                        that.$element.trigger('shown')
                    }) :
                    that.$element.trigger('shown')

            })

            return this
        }, hide:function (e) {
            e && e.preventDefault()

            if (!this.isShown) {
                return this
            }

            var that = this
            this.isShown = false

            escape.call(this)

            this.$element
                .trigger('hide')
                .removeClass('in')

            function removeElement() {
                that.$element
                    .hide()
                    .trigger('hidden')

                backdrop.call(that)
            }

            $.support.transition && this.$element.hasClass('fade') ?
                this.$element.one(transitionEnd, removeElement) :
                removeElement()

            return this
        }

    }


    /* MODAL PRIVATE METHODS
     * ===================== */

    function backdrop(callback) {
        var that = this
            , animate = this.$element.hasClass('fade') ? 'fade' : ''
        if (this.isShown && this.settings.backdrop) {
            var doAnimate = $.support.transition && animate

            this.$backdrop = $('<div class="modal-backdrop ' + animate + '" />')
                .appendTo(document.body)

            if (this.settings.backdrop != 'static') {
                this.$backdrop.click($.proxy(this.hide, this))
            }

            if (doAnimate) {
                this.$backdrop[0].offsetWidth // force reflow
            }

            this.$backdrop.addClass('in')

            doAnimate ?
                this.$backdrop.one(transitionEnd, callback) :
                callback()

        } else if (!this.isShown && this.$backdrop) {
            this.$backdrop.removeClass('in')

            function removeElement() {
                that.$backdrop.remove()
                that.$backdrop = null
            }

            $.support.transition && this.$element.hasClass('fade') ?
                this.$backdrop.one(transitionEnd, removeElement) :
                removeElement()
        } else if (callback) {
            callback()
        }
    }

    function escape() {
        var that = this
        if (this.isShown && this.settings.keyboard) {
            $(document).bind('keyup.modal', function (e) {
                if (e.which == 27) {
                    that.hide()
                }
            })
        } else if (!this.isShown) {
            $(document).unbind('keyup.modal')
        }
    }


    /* MODAL PLUGIN DEFINITION
     * ======================= */

    $.fn.modal = function (options) {
        var modal = this.data('modal')

        if (!modal) {

            if (typeof options == 'string') {
                options = {
                    show:/show|toggle/.test(options)
                }
            }

            return this.each(function () {
                $(this).data('modal', new Modal(this, options))
            })
        }

        if (options === true) {
            return modal
        }

        if (typeof options == 'string') {
            modal[options]()
        } else if (modal) {
            modal.toggle()
        }

        return this
    }

    $.fn.modal.Modal = Modal

    $.fn.modal.defaults = {
        backdrop:false, keyboard:false, show:false
    }


    /* MODAL DATA- IMPLEMENTATION
     * ========================== */

    $(document).ready(function () {
        $('body').delegate('[data-controls-modal]', 'click', function (e) {
            e.preventDefault()
            var $this = $(this).data('show', true)
            $('#' + $this.attr('data-controls-modal')).modal($this.data())
        })
    })

}(window.jQuery || window.ender);

/*
 * jPlayer Plugin for jQuery JavaScript Library
 * http://www.jplayer.org
 *
 * Copyright (c) 2009 - 2011 Happyworm Ltd
 * Dual licensed under the MIT and GPL licenses.
 *  - http://www.opensource.org/licenses/mit-license.php
 *  - http://www.gnu.org/copyleft/gpl.html
 *
 * Author: Mark J Panaghiston
 * Version: 2.1.0
 * Date: 1st September 2011
 */

/* Code verified using http://www.jshint.com/ */
/*jshint asi:false, bitwise:false, boss:false, browser:true, curly:true, debug:false, eqeqeq:true, eqnull:false, evil:false, forin:false, immed:false, jquery:true, laxbreak:false, newcap:true, noarg:true, noempty:true, nonew:true, nomem:false, onevar:false, passfail:false, plusplus:false, regexp:false, undef:true, sub:false, strict:false, white:false */
/*global jQuery:false, ActiveXObject:false, alert:false */

(function ($, undefined) {

    // Adapted from jquery.ui.widget.js (1.8.7): $.widget.bridge
    $.fn.jPlayer = function (options) {
        var name = "jPlayer";
        var isMethodCall = typeof options === "string",
            args = Array.prototype.slice.call(arguments, 1),
            returnValue = this;

        // allow multiple hashes to be passed on init
        options = !isMethodCall && args.length ?
            $.extend.apply(null, [ true, options ].concat(args)) :
            options;

        // prevent calls to internal methods
        if (isMethodCall && options.charAt(0) === "_") {
            return returnValue;
        }

        if (isMethodCall) {
            this.each(function () {
                var instance = $.data(this, name),
                    methodValue = instance && $.isFunction(instance[options]) ?
                        instance[ options ].apply(instance, args) :
                        instance;
                if (methodValue !== instance && methodValue !== undefined) {
                    returnValue = methodValue;
                    return false;
                }
            });
        } else {
            this.each(function () {
                var instance = $.data(this, name);
                if (instance) {
                    // instance.option( options || {} )._init(); // Orig jquery.ui.widget.js code: Not recommend for jPlayer. ie., Applying new options to an existing instance (via the jPlayer constructor) and performing the _init(). The _init() is what concerns me. It would leave a lot of event handlers acting on jPlayer instance and the interface.
                    instance.option(options || {}); // The new constructor only changes the options. Changing options only has basic support atm.
                } else {
                    $.data(this, name, new $.jPlayer(options, this));
                }
            });
        }

        return returnValue;
    };

    $.jPlayer = function (options, element) {
        // allow instantiation without initializing for simple inheritance
        if (arguments.length) {
            this.element = $(element);
            this.options = $.extend(true, {},
                this.options,
                options
            );
            var self = this;
            this.element.bind("remove.jPlayer", function () {
                self.destroy();
            });
            this._init();
        }
    };
    // End of: (Adapted from jquery.ui.widget.js (1.8.7))

    // Emulated HTML5 methods and properties
    $.jPlayer.emulateMethods = "load play pause";
    $.jPlayer.emulateStatus = "src readyState networkState currentTime duration paused ended playbackRate";
    $.jPlayer.emulateOptions = "muted volume";

    // Reserved event names generated by jPlayer that are not part of the HTML5 Media element spec
    $.jPlayer.reservedEvent = "ready flashreset resize repeat error warning";

    // Events generated by jPlayer
    $.jPlayer.event = {
        ready:"jPlayer_ready",
        flashreset:"jPlayer_flashreset", // Similar to the ready event if the Flash solution is set to display:none and then shown again or if it's reloaded for another reason by the browser. For example, using CSS position:fixed on Firefox for the full screen feature.
        resize:"jPlayer_resize", // Occurs when the size changes through a full/restore screen operation or if the size/sizeFull options are changed.
        repeat:"jPlayer_repeat", // Occurs when the repeat status changes. Usually through clicks on the repeat button of the interface.
        click:"jPlayer_click", // Occurs when the user clicks on one of the following: poster image, html video, flash video.
        error:"jPlayer_error", // Event error code in event.jPlayer.error.type. See $.jPlayer.error
        warning:"jPlayer_warning", // Event warning code in event.jPlayer.warning.type. See $.jPlayer.warning

        // Other events match HTML5 spec.
        loadstart:"jPlayer_loadstart",
        progress:"jPlayer_progress",
        suspend:"jPlayer_suspend",
        abort:"jPlayer_abort",
        emptied:"jPlayer_emptied",
        stalled:"jPlayer_stalled",
        play:"jPlayer_play",
        pause:"jPlayer_pause",
        loadedmetadata:"jPlayer_loadedmetadata",
        loadeddata:"jPlayer_loadeddata",
        waiting:"jPlayer_waiting",
        playing:"jPlayer_playing",
        canplay:"jPlayer_canplay",
        canplaythrough:"jPlayer_canplaythrough",
        seeking:"jPlayer_seeking",
        seeked:"jPlayer_seeked",
        timeupdate:"jPlayer_timeupdate",
        ended:"jPlayer_ended",
        ratechange:"jPlayer_ratechange",
        durationchange:"jPlayer_durationchange",
        volumechange:"jPlayer_volumechange"
    };

    $.jPlayer.htmlEvent = [ // These HTML events are bubbled through to the jPlayer event, without any internal action.
        "loadstart",
        // "progress", // jPlayer uses internally before bubbling.
        // "suspend", // jPlayer uses internally before bubbling.
        "abort",
        // "error", // jPlayer uses internally before bubbling.
        "emptied",
        "stalled",
        // "play", // jPlayer uses internally before bubbling.
        // "pause", // jPlayer uses internally before bubbling.
        "loadedmetadata",
        "loadeddata",
        // "waiting", // jPlayer uses internally before bubbling.
        // "playing", // jPlayer uses internally before bubbling.
        "canplay",
        "canplaythrough",
        // "seeking", // jPlayer uses internally before bubbling.
        // "seeked", // jPlayer uses internally before bubbling.
        // "timeupdate", // jPlayer uses internally before bubbling.
        // "ended", // jPlayer uses internally before bubbling.
        "ratechange"
        // "durationchange" // jPlayer uses internally before bubbling.
        // "volumechange" // jPlayer uses internally before bubbling.
    ];

    $.jPlayer.pause = function () {
        $.each($.jPlayer.prototype.instances, function (i, element) {
            if (element.data("jPlayer").status.srcSet) { // Check that media is set otherwise would cause error event.
                element.jPlayer("pause");
            }
        });
    };

    $.jPlayer.timeFormat = {
        showHour:false,
        showMin:true,
        showSec:true,
        padHour:false,
        padMin:true,
        padSec:true,
        sepHour:":",
        sepMin:":",
        sepSec:""
    };

    $.jPlayer.convertTime = function (s) {
        var myTime = new Date(s * 1000);
        var hour = myTime.getUTCHours();
        var min = myTime.getUTCMinutes();
        var sec = myTime.getUTCSeconds();
        var strHour = ($.jPlayer.timeFormat.padHour && hour < 10) ? "0" + hour : hour;
        var strMin = ($.jPlayer.timeFormat.padMin && min < 10) ? "0" + min : min;
        var strSec = ($.jPlayer.timeFormat.padSec && sec < 10) ? "0" + sec : sec;
        return (($.jPlayer.timeFormat.showHour) ? strHour + $.jPlayer.timeFormat.sepHour : "") + (($.jPlayer.timeFormat.showMin) ? strMin + $.jPlayer.timeFormat.sepMin : "") + (($.jPlayer.timeFormat.showSec) ? strSec + $.jPlayer.timeFormat.sepSec : "");
    };

    // Adapting jQuery 1.4.4 code for jQuery.browser. Required since jQuery 1.3.2 does not detect Chrome as webkit.
    $.jPlayer.uaBrowser = function (userAgent) {
        var ua = userAgent.toLowerCase();

        // Useragent RegExp
        var rwebkit = /(webkit)[ \/]([\w.]+)/;
        var ropera = /(opera)(?:.*version)?[ \/]([\w.]+)/;
        var rmsie = /(msie) ([\w.]+)/;
        var rmozilla = /(mozilla)(?:.*? rv:([\w.]+))?/;

        var match = rwebkit.exec(ua) ||
            ropera.exec(ua) ||
            rmsie.exec(ua) ||
            ua.indexOf("compatible") < 0 && rmozilla.exec(ua) ||
            [];

        return { browser:match[1] || "", version:match[2] || "0" };
    };

    // Platform sniffer for detecting mobile devices
    $.jPlayer.uaPlatform = function (userAgent) {
        var ua = userAgent.toLowerCase();

        // Useragent RegExp
        var rplatform = /(ipad|iphone|ipod|android|blackberry|playbook|windows ce|webos)/;
        var rtablet = /(ipad|playbook)/;
        var randroid = /(android)/;
        var rmobile = /(mobile)/;

        var platform = rplatform.exec(ua) || [];
        var tablet = rtablet.exec(ua) ||
            !rmobile.exec(ua) && randroid.exec(ua) ||
            [];

        if (platform[1]) {
            platform[1] = platform[1].replace(/\s/g, "_"); // Change whitespace to underscore. Enables dot notation.
        }

        return { platform:platform[1] || "", tablet:tablet[1] || "" };
    };

    $.jPlayer.browser = {
    };
    $.jPlayer.platform = {
    };

    var browserMatch = $.jPlayer.uaBrowser(navigator.userAgent);
    if (browserMatch.browser) {
        $.jPlayer.browser[ browserMatch.browser ] = true;
        $.jPlayer.browser.version = browserMatch.version;
    }
    var platformMatch = $.jPlayer.uaPlatform(navigator.userAgent);
    if (platformMatch.platform) {
        $.jPlayer.platform[ platformMatch.platform ] = true;
        $.jPlayer.platform.mobile = !platformMatch.tablet;
        $.jPlayer.platform.tablet = !!platformMatch.tablet;
    }

    $.jPlayer.prototype = {
        count:0, // Static Variable: Change it via prototype.
        version:{ // Static Object
            script:"2.1.0",
            needFlash:"2.1.0",
            flash:"unknown"
        },
        options:{ // Instanced in $.jPlayer() constructor
            swfPath:"js", // Path to Jplayer.swf. Can be relative, absolute or server root relative.
            solution:"html, flash", // Valid solutions: html, flash. Order defines priority. 1st is highest,
            supplied:"mp3", // Defines which formats jPlayer will try and support and the priority by the order. 1st is highest,
            preload:'metadata', // HTML5 Spec values: none, metadata, auto.
            volume:0.8, // The volume. Number 0 to 1.
            muted:false,
            wmode:"opaque", // Valid wmode: window, transparent, opaque, direct, gpu.
            backgroundColor:"#000000", // To define the jPlayer div and Flash background color.
            cssSelectorAncestor:"#jp_container_1",
            cssSelector:{ // * denotes properties that should only be required when video media type required. _cssSelector() would require changes to enable splitting these into Audio and Video defaults.
                videoPlay:".jp-video-play", // *
                play:".jp-play",
                pause:".jp-pause",
                stop:".jp-stop",
                seekBar:".jp-seek-bar",
                playBar:".jp-play-bar",
                mute:".jp-mute",
                unmute:".jp-unmute",
                volumeBar:".jp-volume-bar",
                volumeBarValue:".jp-volume-bar-value",
                volumeMax:".jp-volume-max",
                currentTime:".jp-current-time",
                duration:".jp-duration",
                fullScreen:".jp-full-screen", // *
                restoreScreen:".jp-restore-screen", // *
                repeat:".jp-repeat",
                repeatOff:".jp-repeat-off",
                gui:".jp-gui", // The interface used with autohide feature.
                noSolution:".jp-no-solution" // For error feedback when jPlayer cannot find a solution.
            },
            fullScreen:false,
            autohide:{
                restored:false, // Controls the interface autohide feature.
                full:true, // Controls the interface autohide feature.
                fadeIn:200, // Milliseconds. The period of the fadeIn anim.
                fadeOut:600, // Milliseconds. The period of the fadeOut anim.
                hold:1000 // Milliseconds. The period of the pause before autohide beings.
            },
            loop:false,
            repeat:function (event) { // The default jPlayer repeat event handler
                if (event.jPlayer.options.loop) {
                    $(this).unbind(".jPlayerRepeat").bind($.jPlayer.event.ended + ".jPlayer.jPlayerRepeat", function () {
                        $(this).jPlayer("play");
                    });
                } else {
                    $(this).unbind(".jPlayerRepeat");
                }
            },
            nativeVideoControls:{
                // Works well on standard browsers.
                // Phone and tablet browsers can have problems with the controls disappearing.
            },
            noFullScreen:{
                msie:/msie [0-6]/,
                ipad:/ipad.*?os [0-4]/,
                iphone:/iphone/,
                ipod:/ipod/,
                android_pad:/android [0-3](?!.*?mobile)/,
                android_phone:/android.*?mobile/,
                blackberry:/blackberry/,
                windows_ce:/windows ce/,
                webos:/webos/
            },
            noVolume:{
                ipad:/ipad/,
                iphone:/iphone/,
                ipod:/ipod/,
                android_pad:/android(?!.*?mobile)/,
                android_phone:/android.*?mobile/,
                blackberry:/blackberry/,
                windows_ce:/windows ce/,
                webos:/webos/,
                playbook:/playbook/
            },
            verticalVolume:false, // Calculate volume from the bottom of the volume bar. Default is from the left. Also volume affects either width or height.
            // globalVolume: false, // Not implemented: Set to make volume changes affect all jPlayer instances
            // globalMute: false, // Not implemented: Set to make mute changes affect all jPlayer instances
            idPrefix:"jp", // Prefix for the ids of html elements created by jPlayer. For flash, this must not include characters: . - + * / \
            noConflict:"jQuery",
            emulateHtml:false, // Emulates the HTML5 Media element on the jPlayer element.
            errorAlerts:false,
            warningAlerts:false
        },
        optionsAudio:{
            size:{
                width:"0px",
                height:"0px",
                cssClass:""
            },
            sizeFull:{
                width:"0px",
                height:"0px",
                cssClass:""
            }
        },
        optionsVideo:{
            size:{
                width:"480px",
                height:"270px",
                cssClass:"jp-video-270p"
            },
            sizeFull:{
                width:"100%",
                height:"100%",
                cssClass:"jp-video-full"
            }
        },
        instances:{}, // Static Object
        status:{ // Instanced in _init()
            src:"",
            media:{},
            paused:true,
            format:{},
            formatType:"",
            waitForPlay:true, // Same as waitForLoad except in case where preloading.
            waitForLoad:true,
            srcSet:false,
            video:false, // True if playing a video
            seekPercent:0,
            currentPercentRelative:0,
            currentPercentAbsolute:0,
            currentTime:0,
            duration:0,
            readyState:0,
            networkState:0,
            playbackRate:1,
            ended:0

            /*		Persistant status properties created dynamically at _init():
             width
             height
             cssClass
             nativeVideoControls
             noFullScreen
             noVolume
             */
        },

        internal:{ // Instanced in _init()
            ready:false
            // instance: undefined
            // domNode: undefined
            // htmlDlyCmdId: undefined
            // autohideId: undefined
        },
        solution:{ // Static Object: Defines the solutions built in jPlayer.
            html:true,
            flash:true
        },
        // 'MPEG-4 support' : canPlayType('video/mp4; codecs="mp4v.20.8"')
        format:{ // Static Object
            mp3:{
                codec:'audio/mpeg; codecs="mp3"',
                flashCanPlay:true,
                media:'audio'
            },
            m4a:{ // AAC / MP4
                codec:'audio/mp4; codecs="mp4a.40.2"',
                flashCanPlay:true,
                media:'audio'
            },
            oga:{ // OGG
                codec:'audio/ogg; codecs="vorbis"',
                flashCanPlay:false,
                media:'audio'
            },
            wav:{ // PCM
                codec:'audio/wav; codecs="1"',
                flashCanPlay:false,
                media:'audio'
            },
            webma:{ // WEBM
                codec:'audio/webm; codecs="vorbis"',
                flashCanPlay:false,
                media:'audio'
            },
            fla:{ // FLV / F4A
                codec:'audio/x-flv',
                flashCanPlay:true,
                media:'audio'
            },
            m4v:{ // H.264 / MP4
                codec:'video/mp4; codecs="avc1.42E01E, mp4a.40.2"',
                flashCanPlay:true,
                media:'video'
            },
            ogv:{ // OGG
                codec:'video/ogg; codecs="theora, vorbis"',
                flashCanPlay:false,
                media:'video'
            },
            webmv:{ // WEBM
                codec:'video/webm; codecs="vorbis, vp8"',
                flashCanPlay:false,
                media:'video'
            },
            flv:{ // FLV / F4V
                codec:'video/x-flv',
                flashCanPlay:true,
                media:'video'
            }
        },
        _init:function () {
            var self = this;

            this.element.empty();

            this.status = $.extend({}, this.status); // Copy static to unique instance.
            this.internal = $.extend({}, this.internal); // Copy static to unique instance.

            this.internal.domNode = this.element.get(0);

            this.formats = []; // Array based on supplied string option. Order defines priority.
            this.solutions = []; // Array based on solution string option. Order defines priority.
            this.require = {}; // Which media types are required: video, audio.

            this.htmlElement = {}; // DOM elements created by jPlayer
            this.html = {}; // In _init()'s this.desired code and setmedia(): Accessed via this[solution], where solution from this.solutions array.
            this.html.audio = {};
            this.html.video = {};
            this.flash = {}; // In _init()'s this.desired code and setmedia(): Accessed via this[solution], where solution from this.solutions array.

            this.css = {};
            this.css.cs = {}; // Holds the css selector strings
            this.css.jq = {}; // Holds jQuery selectors. ie., $(css.cs.method)

            this.ancestorJq = []; // Holds jQuery selector of cssSelectorAncestor. Init would use $() instead of [], but it is only 1.4+

            this.options.volume = this._limitValue(this.options.volume, 0, 1); // Limit volume value's bounds.

            // Create the formats array, with prority based on the order of the supplied formats string
            $.each(this.options.supplied.toLowerCase().split(","), function (index1, value1) {
                var format = value1.replace(/^\s+|\s+$/g, ""); //trim
                if (self.format[format]) { // Check format is valid.
                    var dupFound = false;
                    $.each(self.formats, function (index2, value2) { // Check for duplicates
                        if (format === value2) {
                            dupFound = true;
                            return false;
                        }
                    });
                    if (!dupFound) {
                        self.formats.push(format);
                    }
                }
            });

            // Create the solutions array, with prority based on the order of the solution string
            $.each(this.options.solution.toLowerCase().split(","), function (index1, value1) {
                var solution = value1.replace(/^\s+|\s+$/g, ""); //trim
                if (self.solution[solution]) { // Check solution is valid.
                    var dupFound = false;
                    $.each(self.solutions, function (index2, value2) { // Check for duplicates
                        if (solution === value2) {
                            dupFound = true;
                            return false;
                        }
                    });
                    if (!dupFound) {
                        self.solutions.push(solution);
                    }
                }
            });

            this.internal.instance = "jp_" + this.count;
            this.instances[this.internal.instance] = this.element;

            // Check the jPlayer div has an id and create one if required. Important for Flash to know the unique id for comms.
            if (!this.element.attr("id")) {
                this.element.attr("id", this.options.idPrefix + "_jplayer_" + this.count);
            }

            this.internal.self = $.extend({}, {
                id:this.element.attr("id"),
                jq:this.element
            });
            this.internal.audio = $.extend({}, {
                id:this.options.idPrefix + "_audio_" + this.count,
                jq:undefined
            });
            this.internal.video = $.extend({}, {
                id:this.options.idPrefix + "_video_" + this.count,
                jq:undefined
            });
            this.internal.flash = $.extend({}, {
                id:this.options.idPrefix + "_flash_" + this.count,
                jq:undefined,
                swf:this.options.swfPath + (this.options.swfPath.toLowerCase().slice(-4) !== ".swf" ? (this.options.swfPath && this.options.swfPath.slice(-1) !== "/" ? "/" : "") + "Jplayer.swf" : "")
            });
            this.internal.poster = $.extend({}, {
                id:this.options.idPrefix + "_poster_" + this.count,
                jq:undefined
            });

            // Register listeners defined in the constructor
            $.each($.jPlayer.event, function (eventName, eventType) {
                if (self.options[eventName] !== undefined) {
                    self.element.bind(eventType + ".jPlayer", self.options[eventName]); // With .jPlayer namespace.
                    self.options[eventName] = undefined; // Destroy the handler pointer copy on the options. Reason, events can be added/removed in other ways so this could be obsolete and misleading.
                }
            });

            // Determine if we require solutions for audio, video or both media types.
            this.require.audio = false;
            this.require.video = false;
            $.each(this.formats, function (priority, format) {
                self.require[self.format[format].media] = true;
            });

            // Now required types are known, finish the options default settings.
            if (this.require.video) {
                this.options = $.extend(true, {},
                    this.optionsVideo,
                    this.options
                );
            } else {
                this.options = $.extend(true, {},
                    this.optionsAudio,
                    this.options
                );
            }
            this._setSize(); // update status and jPlayer element size

            // Determine the status for Blocklisted options.
            this.status.nativeVideoControls = this._uaBlocklist(this.options.nativeVideoControls);
            this.status.noFullScreen = this._uaBlocklist(this.options.noFullScreen);
            this.status.noVolume = this._uaBlocklist(this.options.noVolume);

            // The native controls are only for video and are disabled when audio is also used.
            this._restrictNativeVideoControls();

            // Create the poster image.
            this.htmlElement.poster = document.createElement('img');
            this.htmlElement.poster.id = this.internal.poster.id;
            this.htmlElement.poster.onload = function () { // Note that this did not work on Firefox 3.6: poster.addEventListener("onload", function() {}, false); Did not investigate x-browser.
                if (!self.status.video || self.status.waitForPlay) {
                    self.internal.poster.jq.show();
                }
            };
            this.element.append(this.htmlElement.poster);
            this.internal.poster.jq = $("#" + this.internal.poster.id);
            this.internal.poster.jq.css({'width':this.status.width, 'height':this.status.height});
            this.internal.poster.jq.hide();
            this.internal.poster.jq.bind("click.jPlayer", function () {
                self._trigger($.jPlayer.event.click);
            });

            // Generate the required media elements
            this.html.audio.available = false;
            if (this.require.audio) { // If a supplied format is audio
                this.htmlElement.audio = document.createElement('audio');
                this.htmlElement.audio.id = this.internal.audio.id;
                this.html.audio.available = !!this.htmlElement.audio.canPlayType && this._testCanPlayType(this.htmlElement.audio); // Test is for IE9 on Win Server 2008.
            }
            this.html.video.available = false;
            if (this.require.video) { // If a supplied format is video
                this.htmlElement.video = document.createElement('video');
                this.htmlElement.video.id = this.internal.video.id;
                this.html.video.available = !!this.htmlElement.video.canPlayType && this._testCanPlayType(this.htmlElement.video); // Test is for IE9 on Win Server 2008.
            }

            this.flash.available = this._checkForFlash(10);

            this.html.canPlay = {};
            this.flash.canPlay = {};
            $.each(this.formats, function (priority, format) {
                self.html.canPlay[format] = self.html[self.format[format].media].available && "" !== self.htmlElement[self.format[format].media].canPlayType(self.format[format].codec);
                self.flash.canPlay[format] = self.format[format].flashCanPlay && self.flash.available;
            });
            this.html.desired = false;
            this.flash.desired = false;
            $.each(this.solutions, function (solutionPriority, solution) {
                if (solutionPriority === 0) {
                    self[solution].desired = true;
                } else {
                    var audioCanPlay = false;
                    var videoCanPlay = false;
                    $.each(self.formats, function (formatPriority, format) {
                        if (self[self.solutions[0]].canPlay[format]) { // The other solution can play
                            if (self.format[format].media === 'video') {
                                videoCanPlay = true;
                            } else {
                                audioCanPlay = true;
                            }
                        }
                    });
                    self[solution].desired = (self.require.audio && !audioCanPlay) || (self.require.video && !videoCanPlay);
                }
            });
            // This is what jPlayer will support, based on solution and supplied.
            this.html.support = {};
            this.flash.support = {};
            $.each(this.formats, function (priority, format) {
                self.html.support[format] = self.html.canPlay[format] && self.html.desired;
                self.flash.support[format] = self.flash.canPlay[format] && self.flash.desired;
            });
            // If jPlayer is supporting any format in a solution, then the solution is used.
            this.html.used = false;
            this.flash.used = false;
            $.each(this.solutions, function (solutionPriority, solution) {
                $.each(self.formats, function (formatPriority, format) {
                    if (self[solution].support[format]) {
                        self[solution].used = true;
                        return false;
                    }
                });
            });

            // Init solution active state and the event gates to false.
            this._resetActive();
            this._resetGate();

            // Set up the css selectors for the control and feedback entities.
            this._cssSelectorAncestor(this.options.cssSelectorAncestor);

            // If neither html nor flash are being used by this browser, then media playback is not possible. Trigger an error event.
            if (!(this.html.used || this.flash.used)) {
                this._error({
                    type:$.jPlayer.error.NO_SOLUTION,
                    context:"{solution:'" + this.options.solution + "', supplied:'" + this.options.supplied + "'}",
                    message:$.jPlayer.errorMsg.NO_SOLUTION,
                    hint:$.jPlayer.errorHint.NO_SOLUTION
                });
                if (this.css.jq.noSolution.length) {
                    this.css.jq.noSolution.show();
                }
            } else {
                if (this.css.jq.noSolution.length) {
                    this.css.jq.noSolution.hide();
                }
            }

            // Add the flash solution if it is being used.
            if (this.flash.used) {
                var htmlObj,
                    flashVars = 'jQuery=' + encodeURI(this.options.noConflict) + '&id=' + encodeURI(this.internal.self.id) + '&vol=' + this.options.volume + '&muted=' + this.options.muted;

                // Code influenced by SWFObject 2.2: http://code.google.com/p/swfobject/
                // Non IE browsers have an initial Flash size of 1 by 1 otherwise the wmode affected the Flash ready event.

                if ($.browser.msie && Number($.browser.version) <= 8) {
                    var objStr = '<object id="' + this.internal.flash.id + '" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="0" height="0"></object>';

                    var paramStr = [
                        '<param name="movie" value="' + this.internal.flash.swf + '" />',
                        '<param name="FlashVars" value="' + flashVars + '" />',
                        '<param name="allowScriptAccess" value="always" />',
                        '<param name="bgcolor" value="' + this.options.backgroundColor + '" />',
                        '<param name="wmode" value="' + this.options.wmode + '" />'
                    ];

                    htmlObj = document.createElement(objStr);
                    for (var i = 0; i < paramStr.length; i++) {
                        htmlObj.appendChild(document.createElement(paramStr[i]));
                    }
                } else {
                    var createParam = function (el, n, v) {
                        var p = document.createElement("param");
                        p.setAttribute("name", n);
                        p.setAttribute("value", v);
                        el.appendChild(p);
                    };

                    htmlObj = document.createElement("object");
                    htmlObj.setAttribute("id", this.internal.flash.id);
                    htmlObj.setAttribute("data", this.internal.flash.swf);
                    htmlObj.setAttribute("type", "application/x-shockwave-flash");
                    htmlObj.setAttribute("width", "1"); // Non-zero
                    htmlObj.setAttribute("height", "1"); // Non-zero
                    createParam(htmlObj, "flashvars", flashVars);
                    createParam(htmlObj, "allowscriptaccess", "always");
                    createParam(htmlObj, "bgcolor", this.options.backgroundColor);
                    createParam(htmlObj, "wmode", this.options.wmode);
                }

                this.element.append(htmlObj);
                this.internal.flash.jq = $(htmlObj);
            }

            // Add the HTML solution if being used.
            if (this.html.used) {

                // The HTML Audio handlers
                if (this.html.audio.available) {
                    this._addHtmlEventListeners(this.htmlElement.audio, this.html.audio);
                    this.element.append(this.htmlElement.audio);
                    this.internal.audio.jq = $("#" + this.internal.audio.id);
                }

                // The HTML Video handlers
                if (this.html.video.available) {
                    this._addHtmlEventListeners(this.htmlElement.video, this.html.video);
                    this.element.append(this.htmlElement.video);
                    this.internal.video.jq = $("#" + this.internal.video.id);
                    if (this.status.nativeVideoControls) {
                        this.internal.video.jq.css({'width':this.status.width, 'height':this.status.height});
                    } else {
                        this.internal.video.jq.css({'width':'0px', 'height':'0px'}); // Using size 0x0 since a .hide() causes issues in iOS
                    }
                    this.internal.video.jq.bind("click.jPlayer", function () {
                        self._trigger($.jPlayer.event.click);
                    });
                }
            }

            // Create the bridge that emulates the HTML Media element on the jPlayer DIV
            if (this.options.emulateHtml) {
                this._emulateHtmlBridge();
            }

            if (this.html.used && !this.flash.used) { // If only HTML, then emulate flash ready() call after 100ms.
                setTimeout(function () {
                    self.internal.ready = true;
                    self.version.flash = "n/a";
                    self._trigger($.jPlayer.event.repeat); // Trigger the repeat event so its handler can initialize itself with the loop option.
                    self._trigger($.jPlayer.event.ready);
                }, 100);
            }

            // Initialize the interface components with the options.
            this._updateNativeVideoControls(); // Must do this first, otherwise there is a bizarre bug in iOS 4.3.2, where the native controls are not shown. Fails in iOS if called after _updateButtons() below. Works if called later in setMedia too, so it odd.
            this._updateInterface();
            this._updateButtons(false);
            this._updateAutohide();
            this._updateVolume(this.options.volume);
            this._updateMute(this.options.muted);
            if (this.css.jq.videoPlay.length) {
                this.css.jq.videoPlay.hide();
            }

            $.jPlayer.prototype.count++; // Change static variable via prototype.
        },
        destroy:function () {
            // MJP: The background change remains. Would need to store the original to restore it correctly.
            // MJP: The jPlayer element's size change remains.

            // Clear the media to reset the GUI and stop any downloads. Streams on some browsers had persited. (Chrome)
            this.clearMedia();
            // Remove the size/sizeFull cssClass from the cssSelectorAncestor
            this._removeUiClass();
            // Remove the times from the GUI
            if (this.css.jq.currentTime.length) {
                this.css.jq.currentTime.text("");
            }
            if (this.css.jq.duration.length) {
                this.css.jq.duration.text("");
            }
            // Remove any bindings from the interface controls.
            $.each(this.css.jq, function (fn, jq) {
                // Check selector is valid before trying to execute method.
                if (jq.length) {
                    jq.unbind(".jPlayer");
                }
            });
            // Remove the click handlers for $.jPlayer.event.click
            this.internal.poster.jq.unbind(".jPlayer");
            if (this.internal.video.jq) {
                this.internal.video.jq.unbind(".jPlayer");
            }
            // Destroy the HTML bridge.
            if (this.options.emulateHtml) {
                this._destroyHtmlBridge();
            }
            this.element.removeData("jPlayer"); // Remove jPlayer data
            this.element.unbind(".jPlayer"); // Remove all event handlers created by the jPlayer constructor
            this.element.empty(); // Remove the inserted child elements

            delete this.instances[this.internal.instance]; // Clear the instance on the static instance object
        },
        enable:function () { // Plan to implement
            // options.disabled = false
        },
        disable:function () { // Plan to implement
            // options.disabled = true
        },
        _testCanPlayType:function (elem) {
            // IE9 on Win Server 2008 did not implement canPlayType(), but it has the property.
            try {
                elem.canPlayType(this.format.mp3.codec); // The type is irrelevant.
                return true;
            } catch (err) {
                return false;
            }
        },
        _uaBlocklist:function (list) {
            // list : object with properties that are all regular expressions. Property names are irrelevant.
            // Returns true if the user agent is matched in list.
            var ua = navigator.userAgent.toLowerCase(),
                block = false;

            $.each(list, function (p, re) {
                if (re && re.test(ua)) {
                    block = true;
                    return false; // exit $.each.
                }
            });
            return block;
        },
        _restrictNativeVideoControls:function () {
            // Fallback to noFullScreen when nativeVideoControls is true and audio media is being used. Affects when both media types are used.
            if (this.require.audio) {
                if (this.status.nativeVideoControls) {
                    this.status.nativeVideoControls = false;
                    this.status.noFullScreen = true;
                }
            }
        },
        _updateNativeVideoControls:function () {
            if (this.html.video.available && this.html.used) {
                // Turn the HTML Video controls on/off
                this.htmlElement.video.controls = this.status.nativeVideoControls;
                // Show/hide the jPlayer GUI.
                this._updateAutohide();
                // For when option changed. The poster image is not updated, as it is dealt with in setMedia(). Acceptable degradation since seriously doubt these options will change on the fly. Can again review later.
                if (this.status.nativeVideoControls && this.require.video) {
                    this.internal.poster.jq.hide();
                    this.internal.video.jq.css({'width':this.status.width, 'height':this.status.height});
                } else if (this.status.waitForPlay && this.status.video) {
                    this.internal.poster.jq.show();
                    this.internal.video.jq.css({'width':'0px', 'height':'0px'});
                }
            }
        },
        _addHtmlEventListeners:function (mediaElement, entity) {
            var self = this;
            mediaElement.preload = this.options.preload;
            mediaElement.muted = this.options.muted;
            mediaElement.volume = this.options.volume;

            // Create the event listeners
            // Only want the active entity to affect jPlayer and bubble events.
            // Using entity.gate so that object is referenced and gate property always current

            mediaElement.addEventListener("progress", function () {
                if (entity.gate) {
                    self._getHtmlStatus(mediaElement);
                    self._updateInterface();
                    self._trigger($.jPlayer.event.progress);
                }
            }, false);
            mediaElement.addEventListener("timeupdate", function () {
                if (entity.gate) {
                    self._getHtmlStatus(mediaElement);
                    self._updateInterface();
                    self._trigger($.jPlayer.event.timeupdate);
                }
            }, false);
            mediaElement.addEventListener("durationchange", function () {
                if (entity.gate) {
                    self.status.duration = this.duration;
                    self._getHtmlStatus(mediaElement);
                    self._updateInterface();
                    self._trigger($.jPlayer.event.durationchange);
                }
            }, false);
            mediaElement.addEventListener("play", function () {
                if (entity.gate) {
                    self._updateButtons(true);
                    self._html_checkWaitForPlay(); // So the native controls update this variable and puts the hidden interface in the correct state. Affects toggling native controls.
                    self._trigger($.jPlayer.event.play);
                }
            }, false);
            mediaElement.addEventListener("playing", function () {
                if (entity.gate) {
                    self._updateButtons(true);
                    self._seeked();
                    self._trigger($.jPlayer.event.playing);
                }
            }, false);
            mediaElement.addEventListener("pause", function () {
                if (entity.gate) {
                    self._updateButtons(false);
                    self._trigger($.jPlayer.event.pause);
                }
            }, false);
            mediaElement.addEventListener("waiting", function () {
                if (entity.gate) {
                    self._seeking();
                    self._trigger($.jPlayer.event.waiting);
                }
            }, false);
            mediaElement.addEventListener("seeking", function () {
                if (entity.gate) {
                    self._seeking();
                    self._trigger($.jPlayer.event.seeking);
                }
            }, false);
            mediaElement.addEventListener("seeked", function () {
                if (entity.gate) {
                    self._seeked();
                    self._trigger($.jPlayer.event.seeked);
                }
            }, false);
            mediaElement.addEventListener("volumechange", function () {
                if (entity.gate) {
                    // Read the values back from the element as the Blackberry PlayBook shares the volume with the physical buttons master volume control.
                    // However, when tested 6th July 2011, those buttons do not generate an event. The physical play/pause button does though.
                    self.options.volume = mediaElement.volume;
                    self.options.muted = mediaElement.muted;
                    self._updateMute();
                    self._updateVolume();
                    self._trigger($.jPlayer.event.volumechange);
                }
            }, false);
            mediaElement.addEventListener("suspend", function () { // Seems to be the only way of capturing that the iOS4 browser did not actually play the media from the page code. ie., It needs a user gesture.
                if (entity.gate) {
                    self._seeked();
                    self._trigger($.jPlayer.event.suspend);
                }
            }, false);
            mediaElement.addEventListener("ended", function () {
                if (entity.gate) {
                    // Order of the next few commands are important. Change the time and then pause.
                    // Solves a bug in Firefox, where issuing pause 1st causes the media to play from the start. ie., The pause is ignored.
                    if (!$.jPlayer.browser.webkit) { // Chrome crashes if you do this in conjunction with a setMedia command in an ended event handler. ie., The playlist demo.
                        self.htmlElement.media.currentTime = 0; // Safari does not care about this command. ie., It works with or without this line. (Both Safari and Chrome are Webkit.)
                    }
                    self.htmlElement.media.pause(); // Pause otherwise a click on the progress bar will play from that point, when it shouldn't, since it stopped playback.
                    self._updateButtons(false);
                    self._getHtmlStatus(mediaElement, true); // With override true. Otherwise Chrome leaves progress at full.
                    self._updateInterface();
                    self._trigger($.jPlayer.event.ended);
                }
            }, false);
            mediaElement.addEventListener("error", function () {
                if (entity.gate) {
                    self._updateButtons(false);
                    self._seeked();
                    if (self.status.srcSet) { // Deals with case of clearMedia() causing an error event.
                        clearTimeout(self.internal.htmlDlyCmdId); // Clears any delayed commands used in the HTML solution.
                        self.status.waitForLoad = true; // Allows the load operation to try again.
                        self.status.waitForPlay = true; // Reset since a play was captured.
                        if (self.status.video && !self.status.nativeVideoControls) {
                            self.internal.video.jq.css({'width':'0px', 'height':'0px'});
                        }
                        if (self._validString(self.status.media.poster) && !self.status.nativeVideoControls) {
                            self.internal.poster.jq.show();
                        }
                        if (self.css.jq.videoPlay.length) {
                            self.css.jq.videoPlay.show();
                        }
                        self._error({
                            type:$.jPlayer.error.URL,
                            context:self.status.src, // this.src shows absolute urls. Want context to show the url given.
                            message:$.jPlayer.errorMsg.URL,
                            hint:$.jPlayer.errorHint.URL
                        });
                    }
                }
            }, false);
            // Create all the other event listeners that bubble up to a jPlayer event from html, without being used by jPlayer.
            $.each($.jPlayer.htmlEvent, function (i, eventType) {
                mediaElement.addEventListener(this, function () {
                    if (entity.gate) {
                        self._trigger($.jPlayer.event[eventType]);
                    }
                }, false);
            });
        },
        _getHtmlStatus:function (media, override) {
            var ct = 0, d = 0, cpa = 0, sp = 0, cpr = 0;

            if (media.duration) { // Fixes the duration bug in iOS, where the durationchange event occurs when media.duration is not always correct.
                this.status.duration = media.duration;
            }
            ct = media.currentTime;
            cpa = (this.status.duration > 0) ? 100 * ct / this.status.duration : 0;
            if ((typeof media.seekable === "object") && (media.seekable.length > 0)) {
                sp = (this.status.duration > 0) ? 100 * media.seekable.end(media.seekable.length - 1) / this.status.duration : 100;
                cpr = 100 * media.currentTime / media.seekable.end(media.seekable.length - 1);
            } else {
                sp = 100;
                cpr = cpa;
            }

            if (override) {
                ct = 0;
                cpr = 0;
                cpa = 0;
            }

            this.status.seekPercent = sp;
            this.status.currentPercentRelative = cpr;
            this.status.currentPercentAbsolute = cpa;
            this.status.currentTime = ct;

            this.status.readyState = media.readyState;
            this.status.networkState = media.networkState;
            this.status.playbackRate = media.playbackRate;
            this.status.ended = media.ended;
        },
        _resetStatus:function () {
            this.status = $.extend({}, this.status, $.jPlayer.prototype.status); // Maintains the status properties that persist through a reset.
        },
        _trigger:function (eventType, error, warning) { // eventType always valid as called using $.jPlayer.event.eventType
            var event = $.Event(eventType);
            event.jPlayer = {};
            event.jPlayer.version = $.extend({}, this.version);
            event.jPlayer.options = $.extend(true, {}, this.options); // Deep copy
            event.jPlayer.status = $.extend(true, {}, this.status); // Deep copy
            event.jPlayer.html = $.extend(true, {}, this.html); // Deep copy
            event.jPlayer.flash = $.extend(true, {}, this.flash); // Deep copy
            if (error) {
                event.jPlayer.error = $.extend({}, error);
            }
            if (warning) {
                event.jPlayer.warning = $.extend({}, warning);
            }
            this.element.trigger(event);
        },
        jPlayerFlashEvent:function (eventType, status) { // Called from Flash
            if (eventType === $.jPlayer.event.ready) {
                if (!this.internal.ready) {
                    this.internal.ready = true;
                    this.internal.flash.jq.css({'width':'0px', 'height':'0px'}); // Once Flash generates the ready event, minimise to zero as it is not affected by wmode anymore.

                    this.version.flash = status.version;
                    if (this.version.needFlash !== this.version.flash) {
                        this._error({
                            type:$.jPlayer.error.VERSION,
                            context:this.version.flash,
                            message:$.jPlayer.errorMsg.VERSION + this.version.flash,
                            hint:$.jPlayer.errorHint.VERSION
                        });
                    }
                    this._trigger($.jPlayer.event.repeat); // Trigger the repeat event so its handler can initialize itself with the loop option.
                    this._trigger(eventType);
                } else {
                    // This condition occurs if the Flash is hidden and then shown again.
                    // Firefox also reloads the Flash if the CSS position changes. position:fixed is used for full screen.

                    // Only do this if the Flash is the solution being used at the moment. Affects Media players where both solution may be being used.
                    if (this.flash.gate) {

                        // Send the current status to the Flash now that it is ready (available) again.
                        if (this.status.srcSet) {

                            // Need to read original status before issuing the setMedia command.
                            var currentTime = this.status.currentTime,
                                paused = this.status.paused;

                            this.setMedia(this.status.media);
                            if (currentTime > 0) {
                                if (paused) {
                                    this.pause(currentTime);
                                } else {
                                    this.play(currentTime);
                                }
                            }
                        }
                        this._trigger($.jPlayer.event.flashreset);
                    }
                }
            }
            if (this.flash.gate) {
                switch (eventType) {
                    case $.jPlayer.event.progress:
                        this._getFlashStatus(status);
                        this._updateInterface();
                        this._trigger(eventType);
                        break;
                    case $.jPlayer.event.timeupdate:
                        this._getFlashStatus(status);
                        this._updateInterface();
                        this._trigger(eventType);
                        break;
                    case $.jPlayer.event.play:
                        this._seeked();
                        this._updateButtons(true);
                        this._trigger(eventType);
                        break;
                    case $.jPlayer.event.pause:
                        this._updateButtons(false);
                        this._trigger(eventType);
                        break;
                    case $.jPlayer.event.ended:
                        this._updateButtons(false);
                        this._trigger(eventType);
                        break;
                    case $.jPlayer.event.click:
                        this._trigger(eventType); // This could be dealt with by the default
                        break;
                    case $.jPlayer.event.error:
                        this.status.waitForLoad = true; // Allows the load operation to try again.
                        this.status.waitForPlay = true; // Reset since a play was captured.
                        if (this.status.video) {
                            this.internal.flash.jq.css({'width':'0px', 'height':'0px'});
                        }
                        if (this._validString(this.status.media.poster)) {
                            this.internal.poster.jq.show();
                        }
                        if (this.css.jq.videoPlay.length && this.status.video) {
                            this.css.jq.videoPlay.show();
                        }
                        if (this.status.video) { // Set up for another try. Execute before error event.
                            this._flash_setVideo(this.status.media);
                        } else {
                            this._flash_setAudio(this.status.media);
                        }
                        this._updateButtons(false);
                        this._error({
                            type:$.jPlayer.error.URL,
                            context:status.src,
                            message:$.jPlayer.errorMsg.URL,
                            hint:$.jPlayer.errorHint.URL
                        });
                        break;
                    case $.jPlayer.event.seeking:
                        this._seeking();
                        this._trigger(eventType);
                        break;
                    case $.jPlayer.event.seeked:
                        this._seeked();
                        this._trigger(eventType);
                        break;
                    case $.jPlayer.event.ready:
                        // The ready event is handled outside the switch statement.
                        // Captured here otherwise 2 ready events would be generated if the ready event handler used setMedia.
                        break;
                    default:
                        this._trigger(eventType);
                }
            }
            return false;
        },
        _getFlashStatus:function (status) {
            this.status.seekPercent = status.seekPercent;
            this.status.currentPercentRelative = status.currentPercentRelative;
            this.status.currentPercentAbsolute = status.currentPercentAbsolute;
            this.status.currentTime = status.currentTime;
            this.status.duration = status.duration;

            // The Flash does not generate this information in this release
            this.status.readyState = 4; // status.readyState;
            this.status.networkState = 0; // status.networkState;
            this.status.playbackRate = 1; // status.playbackRate;
            this.status.ended = false; // status.ended;
        },
        _updateButtons:function (playing) {
            if (playing !== undefined) {
                this.status.paused = !playing;
                if (this.css.jq.play.length && this.css.jq.pause.length) {
                    if (playing) {
                        this.css.jq.play.hide();
                        this.css.jq.pause.show();
                    } else {
                        this.css.jq.play.show();
                        this.css.jq.pause.hide();
                    }
                }
            }
            if (this.css.jq.restoreScreen.length && this.css.jq.fullScreen.length) {
                if (this.status.noFullScreen) {
                    this.css.jq.fullScreen.hide();
                    this.css.jq.restoreScreen.hide();
                } else if (this.options.fullScreen) {
                    this.css.jq.fullScreen.hide();
                    this.css.jq.restoreScreen.show();
                } else {
                    this.css.jq.fullScreen.show();
                    this.css.jq.restoreScreen.hide();
                }
            }
            if (this.css.jq.repeat.length && this.css.jq.repeatOff.length) {
                if (this.options.loop) {
                    this.css.jq.repeat.hide();
                    this.css.jq.repeatOff.show();
                } else {
                    this.css.jq.repeat.show();
                    this.css.jq.repeatOff.hide();
                }
            }
        },
        _updateInterface:function () {
            if (this.css.jq.seekBar.length) {
                this.css.jq.seekBar.width(this.status.seekPercent + "%");
            }
            if (this.css.jq.playBar.length) {
                this.css.jq.playBar.width(this.status.currentPercentRelative + "%");
            }
            if (this.css.jq.currentTime.length) {
                this.css.jq.currentTime.text($.jPlayer.convertTime(this.status.currentTime));
            }
            if (this.css.jq.duration.length) {
                this.css.jq.duration.text($.jPlayer.convertTime(this.status.duration));
            }
        },
        _seeking:function () {
            if (this.css.jq.seekBar.length) {
                this.css.jq.seekBar.addClass("jp-seeking-bg");
            }
        },
        _seeked:function () {
            if (this.css.jq.seekBar.length) {
                this.css.jq.seekBar.removeClass("jp-seeking-bg");
            }
        },
        _resetGate:function () {
            this.html.audio.gate = false;
            this.html.video.gate = false;
            this.flash.gate = false;
        },
        _resetActive:function () {
            this.html.active = false;
            this.flash.active = false;
        },
        setMedia:function (media) {

            /*	media[format] = String: URL of format. Must contain all of the supplied option's video or audio formats.
             *	media.poster = String: Video poster URL.
             *	media.subtitles = String: * NOT IMPLEMENTED * URL of subtitles SRT file
             *	media.chapters = String: * NOT IMPLEMENTED * URL of chapters SRT file
             *	media.stream = Boolean: * NOT IMPLEMENTED * Designating actual media streams. ie., "false/undefined" for files. Plan to refresh the flash every so often.
             */

            var self = this,
                supported = false,
                posterChanged = this.status.media.poster !== media.poster; // Compare before reset. Important for OSX Safari as this.htmlElement.poster.src is absolute, even if original poster URL was relative.

            this._resetMedia();
            this._resetGate();
            this._resetActive();

            $.each(this.formats, function (formatPriority, format) {
                var isVideo = self.format[format].media === 'video';
                $.each(self.solutions, function (solutionPriority, solution) {
                    if (self[solution].support[format] && self._validString(media[format])) { // Format supported in solution and url given for format.
                        var isHtml = solution === 'html';

                        if (isVideo) {
                            if (isHtml) {
                                self.html.video.gate = true;
                                self._html_setVideo(media);
                                self.html.active = true;
                            } else {
                                self.flash.gate = true;
                                self._flash_setVideo(media);
                                self.flash.active = true;
                            }
                            if (self.css.jq.videoPlay.length) {
                                self.css.jq.videoPlay.show();
                            }
                            self.status.video = true;
                        } else {
                            if (isHtml) {
                                self.html.audio.gate = true;
                                self._html_setAudio(media);
                                self.html.active = true;
                            } else {
                                self.flash.gate = true;
                                self._flash_setAudio(media);
                                self.flash.active = true;
                            }
                            if (self.css.jq.videoPlay.length) {
                                self.css.jq.videoPlay.hide();
                            }
                            self.status.video = false;
                        }

                        supported = true;
                        return false; // Exit $.each
                    }
                });
                if (supported) {
                    return false; // Exit $.each
                }
            });

            if (supported) {
                if (!(this.status.nativeVideoControls && this.html.video.gate)) {
                    // Set poster IMG if native video controls are not being used
                    // Note: With IE the IMG onload event occurs immediately when cached.
                    // Note: Poster hidden by default in _resetMedia()
                    if (this._validString(media.poster)) {
                        if (posterChanged) { // Since some browsers do not generate img onload event.
                            this.htmlElement.poster.src = media.poster;
                        } else {
                            this.internal.poster.jq.show();
                        }
                    }
                }
                this.status.srcSet = true;
                this.status.media = $.extend({}, media);
                this._updateButtons(false);
                this._updateInterface();
            } else { // jPlayer cannot support any formats provided in this browser
                // Send an error event
                this._error({
                    type:$.jPlayer.error.NO_SUPPORT,
                    context:"{supplied:'" + this.options.supplied + "'}",
                    message:$.jPlayer.errorMsg.NO_SUPPORT,
                    hint:$.jPlayer.errorHint.NO_SUPPORT
                });
            }
        },
        _resetMedia:function () {
            this._resetStatus();
            this._updateButtons(false);
            this._updateInterface();
            this._seeked();
            this.internal.poster.jq.hide();

            clearTimeout(this.internal.htmlDlyCmdId);

            if (this.html.active) {
                this._html_resetMedia();
            } else if (this.flash.active) {
                this._flash_resetMedia();
            }
        },
        clearMedia:function () {
            this._resetMedia();

            if (this.html.active) {
                this._html_clearMedia();
            } else if (this.flash.active) {
                this._flash_clearMedia();
            }

            this._resetGate();
            this._resetActive();
        },
        load:function () {
            if (this.status.srcSet) {
                if (this.html.active) {
                    this._html_load();
                } else if (this.flash.active) {
                    this._flash_load();
                }
            } else {
                this._urlNotSetError("load");
            }
        },
        play:function (time) {
            time = (typeof time === "number") ? time : NaN; // Remove jQuery event from click handler
            if (this.status.srcSet) {
                if (this.html.active) {
                    this._html_play(time);
                } else if (this.flash.active) {
                    this._flash_play(time);
                }
            } else {
                this._urlNotSetError("play");
            }
        },
        videoPlay:function (e) { // Handles clicks on the play button over the video poster
            this.play();
        },
        pause:function (time) {
            time = (typeof time === "number") ? time : NaN; // Remove jQuery event from click handler
            if (this.status.srcSet) {
                if (this.html.active) {
                    this._html_pause(time);
                } else if (this.flash.active) {
                    this._flash_pause(time);
                }
            } else {
                this._urlNotSetError("pause");
            }
        },
        pauseOthers:function () {
            var self = this;
            $.each(this.instances, function (i, element) {
                if (self.element !== element) { // Do not this instance.
                    if (element.data("jPlayer").status.srcSet) { // Check that media is set otherwise would cause error event.
                        element.jPlayer("pause");
                    }
                }
            });
        },
        stop:function () {
            if (this.status.srcSet) {
                if (this.html.active) {
                    this._html_pause(0);
                } else if (this.flash.active) {
                    this._flash_pause(0);
                }
            } else {
                this._urlNotSetError("stop");
            }
        },
        playHead:function (p) {
            p = this._limitValue(p, 0, 100);
            if (this.status.srcSet) {
                if (this.html.active) {
                    this._html_playHead(p);
                } else if (this.flash.active) {
                    this._flash_playHead(p);
                }
            } else {
                this._urlNotSetError("playHead");
            }
        },
        _muted:function (muted) {
            this.options.muted = muted;
            if (this.html.used) {
                this._html_mute(muted);
            }
            if (this.flash.used) {
                this._flash_mute(muted);
            }

            // The HTML solution generates this event from the media element itself.
            if (!this.html.video.gate && !this.html.audio.gate) {
                this._updateMute(muted);
                this._updateVolume(this.options.volume);
                this._trigger($.jPlayer.event.volumechange);
            }
        },
        mute:function (mute) { // mute is either: undefined (true), an event object (true) or a boolean (muted).
            mute = mute === undefined ? true : !!mute;
            this._muted(mute);
        },
        unmute:function (unmute) { // unmute is either: undefined (true), an event object (true) or a boolean (!muted).
            unmute = unmute === undefined ? true : !!unmute;
            this._muted(!unmute);
        },
        _updateMute:function (mute) {
            if (mute === undefined) {
                mute = this.options.muted;
            }
            if (this.css.jq.mute.length && this.css.jq.unmute.length) {
                if (this.status.noVolume) {
                    this.css.jq.mute.hide();
                    this.css.jq.unmute.hide();
                } else if (mute) {
                    this.css.jq.mute.hide();
                    this.css.jq.unmute.show();
                } else {
                    this.css.jq.mute.show();
                    this.css.jq.unmute.hide();
                }
            }
        },
        volume:function (v) {
            v = this._limitValue(v, 0, 1);
            this.options.volume = v;

            if (this.html.used) {
                this._html_volume(v);
            }
            if (this.flash.used) {
                this._flash_volume(v);
            }

            // The HTML solution generates this event from the media element itself.
            if (!this.html.video.gate && !this.html.audio.gate) {
                this._updateVolume(v);
                this._trigger($.jPlayer.event.volumechange);
            }
        },
        volumeBar:function (e) { // Handles clicks on the volumeBar
            if (this.css.jq.volumeBar.length) {
                var offset = this.css.jq.volumeBar.offset(),
                    x = e.pageX - offset.left,
                    w = this.css.jq.volumeBar.width(),
                    y = this.css.jq.volumeBar.height() - e.pageY + offset.top,
                    h = this.css.jq.volumeBar.height();

                if (this.options.verticalVolume) {
                    this.volume(y / h);
                } else {
                    this.volume(x / w);
                }
            }
            if (this.options.muted) {
                this._muted(false);
            }
        },
        volumeBarValue:function (e) { // Handles clicks on the volumeBarValue
            this.volumeBar(e);
        },
        _updateVolume:function (v) {
            if (v === undefined) {
                v = this.options.volume;
            }
            v = this.options.muted ? 0 : v;

            if (this.status.noVolume) {
                if (this.css.jq.volumeBar.length) {
                    this.css.jq.volumeBar.hide();
                }
                if (this.css.jq.volumeBarValue.length) {
                    this.css.jq.volumeBarValue.hide();
                }
                if (this.css.jq.volumeMax.length) {
                    this.css.jq.volumeMax.hide();
                }
            } else {
                if (this.css.jq.volumeBar.length) {
                    this.css.jq.volumeBar.show();
                }
                if (this.css.jq.volumeBarValue.length) {
                    this.css.jq.volumeBarValue.show();
                    this.css.jq.volumeBarValue[this.options.verticalVolume ? "height" : "width"]((v * 100) + "%");
                }
                if (this.css.jq.volumeMax.length) {
                    this.css.jq.volumeMax.show();
                }
            }
        },
        volumeMax:function () { // Handles clicks on the volume max
            this.volume(1);
            if (this.options.muted) {
                this._muted(false);
            }
        },
        _cssSelectorAncestor:function (ancestor) {
            var self = this;
            this.options.cssSelectorAncestor = ancestor;
            this._removeUiClass();
            this.ancestorJq = ancestor ? $(ancestor) : []; // Would use $() instead of [], but it is only 1.4+
            if (ancestor && this.ancestorJq.length !== 1) { // So empty strings do not generate the warning.
                this._warning({
                    type:$.jPlayer.warning.CSS_SELECTOR_COUNT,
                    context:ancestor,
                    message:$.jPlayer.warningMsg.CSS_SELECTOR_COUNT + this.ancestorJq.length + " found for cssSelectorAncestor.",
                    hint:$.jPlayer.warningHint.CSS_SELECTOR_COUNT
                });
            }
            this._addUiClass();
            $.each(this.options.cssSelector, function (fn, cssSel) {
                self._cssSelector(fn, cssSel);
            });
        },
        _cssSelector:function (fn, cssSel) {
            var self = this;
            if (typeof cssSel === 'string') {
                if ($.jPlayer.prototype.options.cssSelector[fn]) {
                    if (this.css.jq[fn] && this.css.jq[fn].length) {
                        this.css.jq[fn].unbind(".jPlayer");
                    }
                    this.options.cssSelector[fn] = cssSel;
                    this.css.cs[fn] = this.options.cssSelectorAncestor + " " + cssSel;

                    if (cssSel) { // Checks for empty string
                        this.css.jq[fn] = $(this.css.cs[fn]);
                    } else {
                        this.css.jq[fn] = []; // To comply with the css.jq[fn].length check before its use. As of jQuery 1.4 could have used $() for an empty set.
                    }

                    if (this.css.jq[fn].length) {
                        var handler = function (e) {
                            self[fn](e);
                            $(this).blur();
                            return false;
                        };
                        this.css.jq[fn].bind("click.jPlayer", handler); // Using jPlayer namespace
                    }

                    if (cssSel && this.css.jq[fn].length !== 1) { // So empty strings do not generate the warning. ie., they just remove the old one.
                        this._warning({
                            type:$.jPlayer.warning.CSS_SELECTOR_COUNT,
                            context:this.css.cs[fn],
                            message:$.jPlayer.warningMsg.CSS_SELECTOR_COUNT + this.css.jq[fn].length + " found for " + fn + " method.",
                            hint:$.jPlayer.warningHint.CSS_SELECTOR_COUNT
                        });
                    }
                } else {
                    this._warning({
                        type:$.jPlayer.warning.CSS_SELECTOR_METHOD,
                        context:fn,
                        message:$.jPlayer.warningMsg.CSS_SELECTOR_METHOD,
                        hint:$.jPlayer.warningHint.CSS_SELECTOR_METHOD
                    });
                }
            } else {
                this._warning({
                    type:$.jPlayer.warning.CSS_SELECTOR_STRING,
                    context:cssSel,
                    message:$.jPlayer.warningMsg.CSS_SELECTOR_STRING,
                    hint:$.jPlayer.warningHint.CSS_SELECTOR_STRING
                });
            }
        },
        seekBar:function (e) { // Handles clicks on the seekBar
            if (this.css.jq.seekBar) {
                var offset = this.css.jq.seekBar.offset();
                var x = e.pageX - offset.left;
                var w = this.css.jq.seekBar.width();
                var p = 100 * x / w;
                this.playHead(p);
            }
        },
        playBar:function (e) { // Handles clicks on the playBar
            this.seekBar(e);
        },
        repeat:function () { // Handle clicks on the repeat button
            this._loop(true);
        },
        repeatOff:function () { // Handle clicks on the repeatOff button
            this._loop(false);
        },
        _loop:function (loop) {
            if (this.options.loop !== loop) {
                this.options.loop = loop;
                this._updateButtons();
                this._trigger($.jPlayer.event.repeat);
            }
        },

        // Plan to review the cssSelector method to cope with missing associated functions accordingly.

        currentTime:function (e) { // Handles clicks on the text
            // Added to avoid errors using cssSelector system for the text
        },
        duration:function (e) { // Handles clicks on the text
            // Added to avoid errors using cssSelector system for the text
        },
        gui:function (e) { // Handles clicks on the gui
            // Added to avoid errors using cssSelector system for the gui
        },
        noSolution:function (e) { // Handles clicks on the error message
            // Added to avoid errors using cssSelector system for no-solution
        },

        // Options code adapted from ui.widget.js (1.8.7).  Made changes so the key can use dot notation. To match previous getData solution in jPlayer 1.
        option:function (key, value) {
            var options = key;

            // Enables use: options().  Returns a copy of options object
            if (arguments.length === 0) {
                return $.extend(true, {}, this.options);
            }

            if (typeof key === "string") {
                var keys = key.split(".");

                // Enables use: options("someOption")  Returns a copy of the option. Supports dot notation.
                if (value === undefined) {

                    var opt = $.extend(true, {}, this.options);
                    for (var i = 0; i < keys.length; i++) {
                        if (opt[keys[i]] !== undefined) {
                            opt = opt[keys[i]];
                        } else {
                            this._warning({
                                type:$.jPlayer.warning.OPTION_KEY,
                                context:key,
                                message:$.jPlayer.warningMsg.OPTION_KEY,
                                hint:$.jPlayer.warningHint.OPTION_KEY
                            });
                            return undefined;
                        }
                    }
                    return opt;
                }

                // Enables use: options("someOptionObject", someObject}).  Creates: {someOptionObject:someObject}
                // Enables use: options("someOption", someValue).  Creates: {someOption:someValue}
                // Enables use: options("someOptionObject.someOption", someValue).  Creates: {someOptionObject:{someOption:someValue}}

                options = {};
                var opts = options;

                for (var j = 0; j < keys.length; j++) {
                    if (j < keys.length - 1) {
                        opts[keys[j]] = {};
                        opts = opts[keys[j]];
                    } else {
                        opts[keys[j]] = value;
                    }
                }
            }

            // Otherwise enables use: options(optionObject).  Uses original object (the key)

            this._setOptions(options);

            return this;
        },
        _setOptions:function (options) {
            var self = this;
            $.each(options, function (key, value) { // This supports the 2 level depth that the options of jPlayer has. Would review if we ever need more depth.
                self._setOption(key, value);
            });

            return this;
        },
        _setOption:function (key, value) {
            var self = this;

            // The ability to set options is limited at this time.

            switch (key) {
                case "volume" :
                    this.volume(value);
                    break;
                case "muted" :
                    this._muted(value);
                    break;
                case "cssSelectorAncestor" :
                    this._cssSelectorAncestor(value); // Set and refresh all associations for the new ancestor.
                    break;
                case "cssSelector" :
                    $.each(value, function (fn, cssSel) {
                        self._cssSelector(fn, cssSel); // NB: The option is set inside this function, after further validity checks.
                    });
                    break;
                case "fullScreen" :
                    if (this.options[key] !== value) { // if changed
                        this._removeUiClass();
                        this.options[key] = value;
                        this._refreshSize();
                    }
                    break;
                case "size" :
                    if (!this.options.fullScreen && this.options[key].cssClass !== value.cssClass) {
                        this._removeUiClass();
                    }
                    this.options[key] = $.extend({}, this.options[key], value); // store a merged copy of it, incase not all properties changed.
                    this._refreshSize();
                    break;
                case "sizeFull" :
                    if (this.options.fullScreen && this.options[key].cssClass !== value.cssClass) {
                        this._removeUiClass();
                    }
                    this.options[key] = $.extend({}, this.options[key], value); // store a merged copy of it, incase not all properties changed.
                    this._refreshSize();
                    break;
                case "autohide" :
                    this.options[key] = $.extend({}, this.options[key], value); // store a merged copy of it, incase not all properties changed.
                    this._updateAutohide();
                    break;
                case "loop" :
                    this._loop(value);
                    break;
                case "nativeVideoControls" :
                    this.options[key] = $.extend({}, this.options[key], value); // store a merged copy of it, incase not all properties changed.
                    this.status.nativeVideoControls = this._uaBlocklist(this.options.nativeVideoControls);
                    this._restrictNativeVideoControls();
                    this._updateNativeVideoControls();
                    break;
                case "noFullScreen" :
                    this.options[key] = $.extend({}, this.options[key], value); // store a merged copy of it, incase not all properties changed.
                    this.status.nativeVideoControls = this._uaBlocklist(this.options.nativeVideoControls); // Need to check again as noFullScreen can depend on this flag and the restrict() can override it.
                    this.status.noFullScreen = this._uaBlocklist(this.options.noFullScreen);
                    this._restrictNativeVideoControls();
                    this._updateButtons();
                    break;
                case "noVolume" :
                    this.options[key] = $.extend({}, this.options[key], value); // store a merged copy of it, incase not all properties changed.
                    this.status.noVolume = this._uaBlocklist(this.options.noVolume);
                    this._updateVolume();
                    this._updateMute();
                    break;
                case "emulateHtml" :
                    if (this.options[key] !== value) { // To avoid multiple event handlers being created, if true already.
                        this.options[key] = value;
                        if (value) {
                            this._emulateHtmlBridge();
                        } else {
                            this._destroyHtmlBridge();
                        }
                    }
                    break;
            }

            return this;
        },
        // End of: (Options code adapted from ui.widget.js)

        _refreshSize:function () {
            this._setSize(); // update status and jPlayer element size
            this._addUiClass(); // update the ui class
            this._updateSize(); // update internal sizes
            this._updateButtons();
            this._updateAutohide();
            this._trigger($.jPlayer.event.resize);
        },
        _setSize:function () {
            // Determine the current size from the options
            if (this.options.fullScreen) {
                this.status.width = this.options.sizeFull.width;
                this.status.height = this.options.sizeFull.height;
                this.status.cssClass = this.options.sizeFull.cssClass;
            } else {
                this.status.width = this.options.size.width;
                this.status.height = this.options.size.height;
                this.status.cssClass = this.options.size.cssClass;
            }

            // Set the size of the jPlayer area.
            this.element.css({'width':this.status.width, 'height':this.status.height});
        },
        _addUiClass:function () {
            if (this.ancestorJq.length) {
                this.ancestorJq.addClass(this.status.cssClass);
            }
        },
        _removeUiClass:function () {
            if (this.ancestorJq.length) {
                this.ancestorJq.removeClass(this.status.cssClass);
            }
        },
        _updateSize:function () {
            // The poster uses show/hide so can simply resize it.
            this.internal.poster.jq.css({'width':this.status.width, 'height':this.status.height});

            // Video html or flash resized if necessary at this time, or if native video controls being used.
            if (!this.status.waitForPlay && this.html.active && this.status.video || this.html.video.available && this.html.used && this.status.nativeVideoControls) {
                this.internal.video.jq.css({'width':this.status.width, 'height':this.status.height});
            }
            else if (!this.status.waitForPlay && this.flash.active && this.status.video) {
                this.internal.flash.jq.css({'width':this.status.width, 'height':this.status.height});
            }
        },
        _updateAutohide:function () {
            var self = this,
                event = "mousemove.jPlayer",
                namespace = ".jPlayerAutohide",
                eventType = event + namespace,
                handler = function () {
                    self.css.jq.gui.fadeIn(self.options.autohide.fadeIn, function () {
                        clearTimeout(self.internal.autohideId);
                        self.internal.autohideId = setTimeout(function () {
                            self.css.jq.gui.fadeOut(self.options.autohide.fadeOut);
                        }, self.options.autohide.hold);
                    });
                };

            if (this.css.jq.gui.length) {

                // End animations first so that its callback is executed now.
                // Otherwise an in progress fadeIn animation still has the callback to fadeOut again.
                this.css.jq.gui.stop(true, true);

                // Removes the fadeOut operation from the fadeIn callback.
                clearTimeout(this.internal.autohideId);

                this.element.unbind(namespace);
                this.css.jq.gui.unbind(namespace);

                if (!this.status.nativeVideoControls) {
                    if (this.options.fullScreen && this.options.autohide.full || !this.options.fullScreen && this.options.autohide.restored) {
                        this.element.bind(eventType, handler);
                        this.css.jq.gui.bind(eventType, handler);
                        this.css.jq.gui.hide();
                    } else {
                        this.css.jq.gui.show();
                    }
                } else {
                    this.css.jq.gui.hide();
                }
            }
        },
        fullScreen:function () {
            this._setOption("fullScreen", true);
        },
        restoreScreen:function () {
            this._setOption("fullScreen", false);
        },
        _html_initMedia:function () {
            this.htmlElement.media.src = this.status.src;

            if (this.options.preload !== 'none') {
                this._html_load(); // See function for comments
            }
            this._trigger($.jPlayer.event.timeupdate); // The flash generates this event for its solution.
        },
        _html_setAudio:function (media) {
            var self = this;
            // Always finds a format due to checks in setMedia()
            $.each(this.formats, function (priority, format) {
                if (self.html.support[format] && media[format]) {
                    self.status.src = media[format];
                    self.status.format[format] = true;
                    self.status.formatType = format;
                    return false;
                }
            });
            this.htmlElement.media = this.htmlElement.audio;
            this._html_initMedia();
        },
        _html_setVideo:function (media) {
            var self = this;
            // Always finds a format due to checks in setMedia()
            $.each(this.formats, function (priority, format) {
                if (self.html.support[format] && media[format]) {
                    self.status.src = media[format];
                    self.status.format[format] = true;
                    self.status.formatType = format;
                    return false;
                }
            });
            if (this.status.nativeVideoControls) {
                this.htmlElement.video.poster = this._validString(media.poster) ? media.poster : "";
            }
            this.htmlElement.media = this.htmlElement.video;
            this._html_initMedia();
        },
        _html_resetMedia:function () {
            if (this.htmlElement.media) {
                if (this.htmlElement.media.id === this.internal.video.id && !this.status.nativeVideoControls) {
                    this.internal.video.jq.css({'width':'0px', 'height':'0px'});
                }
                this.htmlElement.media.pause();
            }
        },
        _html_clearMedia:function () {
            if (this.htmlElement.media) {
                this.htmlElement.media.src = "";
                this.htmlElement.media.load(); // Stops an old, "in progress" download from continuing the download. Triggers the loadstart, error and emptied events, due to the empty src. Also an abort event if a download was in progress.
            }
        },
        _html_load:function () {
            // This function remains to allow the early HTML5 browsers to work, such as Firefox 3.6
            // A change in the W3C spec for the media.load() command means that this is no longer necessary.
            // This command should be removed and actually causes minor undesirable effects on some browsers. Such as loading the whole file and not only the metadata.
            if (this.status.waitForLoad) {
                this.status.waitForLoad = false;
                this.htmlElement.media.load();
            }
            clearTimeout(this.internal.htmlDlyCmdId);
        },
        _html_play:function (time) {
            var self = this;
            this._html_load(); // Loads if required and clears any delayed commands.

            this.htmlElement.media.play(); // Before currentTime attempt otherwise Firefox 4 Beta never loads.

            if (!isNaN(time)) {
                try {
                    this.htmlElement.media.currentTime = time;
                } catch (err) {
                    this.internal.htmlDlyCmdId = setTimeout(function () {
                        self.play(time);
                    }, 100);
                    return; // Cancel execution and wait for the delayed command.
                }
            }
            this._html_checkWaitForPlay();
        },
        _html_pause:function (time) {
            var self = this;

            if (time > 0) { // We do not want the stop() command, which does pause(0), causing a load operation.
                this._html_load(); // Loads if required and clears any delayed commands.
            } else {
                clearTimeout(this.internal.htmlDlyCmdId);
            }

            // Order of these commands is important for Safari (Win) and IE9. Pause then change currentTime.
            this.htmlElement.media.pause();

            if (!isNaN(time)) {
                try {
                    this.htmlElement.media.currentTime = time;
                } catch (err) {
                    this.internal.htmlDlyCmdId = setTimeout(function () {
                        self.pause(time);
                    }, 100);
                    return; // Cancel execution and wait for the delayed command.
                }
            }
            if (time > 0) { // Avoids a setMedia() followed by stop() or pause(0) hiding the video play button.
                this._html_checkWaitForPlay();
            }
        },
        _html_playHead:function (percent) {
            var self = this;
            this._html_load(); // Loads if required and clears any delayed commands.
            try {
                if ((typeof this.htmlElement.media.seekable === "object") && (this.htmlElement.media.seekable.length > 0)) {
                    this.htmlElement.media.currentTime = percent * this.htmlElement.media.seekable.end(this.htmlElement.media.seekable.length - 1) / 100;
                } else if (this.htmlElement.media.duration > 0 && !isNaN(this.htmlElement.media.duration)) {
                    this.htmlElement.media.currentTime = percent * this.htmlElement.media.duration / 100;
                } else {
                    throw "e";
                }
            } catch (err) {
                this.internal.htmlDlyCmdId = setTimeout(function () {
                    self.playHead(percent);
                }, 100);
                return; // Cancel execution and wait for the delayed command.
            }
            if (!this.status.waitForLoad) {
                this._html_checkWaitForPlay();
            }
        },
        _html_checkWaitForPlay:function () {
            if (this.status.waitForPlay) {
                this.status.waitForPlay = false;
                if (this.css.jq.videoPlay.length) {
                    this.css.jq.videoPlay.hide();
                }
                if (this.status.video) {
                    this.internal.poster.jq.hide();
                    this.internal.video.jq.css({'width':this.status.width, 'height':this.status.height});
                }
            }
        },
        _html_volume:function (v) {
            if (this.html.audio.available) {
                this.htmlElement.audio.volume = v;
            }
            if (this.html.video.available) {
                this.htmlElement.video.volume = v;
            }
        },
        _html_mute:function (m) {
            if (this.html.audio.available) {
                this.htmlElement.audio.muted = m;
            }
            if (this.html.video.available) {
                this.htmlElement.video.muted = m;
            }
        },
        _flash_setAudio:function (media) {
            var self = this;
            try {
                // Always finds a format due to checks in setMedia()
                $.each(this.formats, function (priority, format) {
                    if (self.flash.support[format] && media[format]) {
                        switch (format) {
                            case "m4a" :
                            case "fla" :
                                self._getMovie().fl_setAudio_m4a(media[format]);
                                break;
                            case "mp3" :
                                self._getMovie().fl_setAudio_mp3(media[format]);
                                break;
                        }
                        self.status.src = media[format];
                        self.status.format[format] = true;
                        self.status.formatType = format;
                        return false;
                    }
                });

                if (this.options.preload === 'auto') {
                    this._flash_load();
                    this.status.waitForLoad = false;
                }
            } catch (err) {
                this._flashError(err);
            }
        },
        _flash_setVideo:function (media) {
            var self = this;
            try {
                // Always finds a format due to checks in setMedia()
                $.each(this.formats, function (priority, format) {
                    if (self.flash.support[format] && media[format]) {
                        switch (format) {
                            case "m4v" :
                            case "flv" :
                                self._getMovie().fl_setVideo_m4v(media[format]);
                                break;
                        }
                        self.status.src = media[format];
                        self.status.format[format] = true;
                        self.status.formatType = format;
                        return false;
                    }
                });

                if (this.options.preload === 'auto') {
                    this._flash_load();
                    this.status.waitForLoad = false;
                }
            } catch (err) {
                this._flashError(err);
            }
        },
        _flash_resetMedia:function () {
            this.internal.flash.jq.css({'width':'0px', 'height':'0px'}); // Must do via CSS as setting attr() to zero causes a jQuery error in IE.
            this._flash_pause(NaN);
        },
        _flash_clearMedia:function () {
            try {
                this._getMovie().fl_clearMedia();
            } catch (err) {
                this._flashError(err);
            }
        },
        _flash_load:function () {
            try {
                this._getMovie().fl_load();
            } catch (err) {
                this._flashError(err);
            }
            this.status.waitForLoad = false;
        },
        _flash_play:function (time) {
            try {
                this._getMovie().fl_play(time);
            } catch (err) {
                this._flashError(err);
            }
            this.status.waitForLoad = false;
            this._flash_checkWaitForPlay();
        },
        _flash_pause:function (time) {
            try {
                this._getMovie().fl_pause(time);
            } catch (err) {
                this._flashError(err);
            }
            if (time > 0) { // Avoids a setMedia() followed by stop() or pause(0) hiding the video play button.
                this.status.waitForLoad = false;
                this._flash_checkWaitForPlay();
            }
        },
        _flash_playHead:function (p) {
            try {
                this._getMovie().fl_play_head(p);
            } catch (err) {
                this._flashError(err);
            }
            if (!this.status.waitForLoad) {
                this._flash_checkWaitForPlay();
            }
        },
        _flash_checkWaitForPlay:function () {
            if (this.status.waitForPlay) {
                this.status.waitForPlay = false;
                if (this.css.jq.videoPlay.length) {
                    this.css.jq.videoPlay.hide();
                }
                if (this.status.video) {
                    this.internal.poster.jq.hide();
                    this.internal.flash.jq.css({'width':this.status.width, 'height':this.status.height});
                }
            }
        },
        _flash_volume:function (v) {
            try {
                this._getMovie().fl_volume(v);
            } catch (err) {
                this._flashError(err);
            }
        },
        _flash_mute:function (m) {
            try {
                this._getMovie().fl_mute(m);
            } catch (err) {
                this._flashError(err);
            }
        },
        _getMovie:function () {
            return document[this.internal.flash.id];
        },
        _checkForFlash:function (version) {
            // Function checkForFlash adapted from FlashReplace by Robert Nyman
            // http://code.google.com/p/flashreplace/
            var flashIsInstalled = false;
            var flash;
            if (window.ActiveXObject) {
                try {
                    flash = new ActiveXObject(("ShockwaveFlash.ShockwaveFlash." + version));
                    flashIsInstalled = true;
                }
                catch (e) {
                    // Throws an error if the version isn't available
                }
            }
            else if (navigator.plugins && navigator.mimeTypes.length > 0) {
                flash = navigator.plugins["Shockwave Flash"];
                if (flash) {
                    var flashVersion = navigator.plugins["Shockwave Flash"].description.replace(/.*\s(\d+\.\d+).*/, "$1");
                    if (flashVersion >= version) {
                        flashIsInstalled = true;
                    }
                }
            }
            return flashIsInstalled;
        },
        _validString:function (url) {
            return (url && typeof url === "string"); // Empty strings return false
        },
        _limitValue:function (value, min, max) {
            return (value < min) ? min : ((value > max) ? max : value);
        },
        _urlNotSetError:function (context) {
            this._error({
                type:$.jPlayer.error.URL_NOT_SET,
                context:context,
                message:$.jPlayer.errorMsg.URL_NOT_SET,
                hint:$.jPlayer.errorHint.URL_NOT_SET
            });
        },
        _flashError:function (error) {
            var errorType;
            if (!this.internal.ready) {
                errorType = "FLASH";
            } else {
                errorType = "FLASH_DISABLED";
            }
            this._error({
                type:$.jPlayer.error[errorType],
                context:this.internal.flash.swf,
                message:$.jPlayer.errorMsg[errorType] + error.message,
                hint:$.jPlayer.errorHint[errorType]
            });
            // Allow the audio player to recover if display:none and then shown again, or with position:fixed on Firefox.
            // This really only affects audio in a media player, as an audio player could easily move the jPlayer element away from such issues.
            this.internal.flash.jq.css({'width':'1px', 'height':'1px'});
        },
        _error:function (error) {
            this._trigger($.jPlayer.event.error, error);
            if (this.options.errorAlerts) {
                this._alert("Error!" + (error.message ? "\n\n" + error.message : "") + (error.hint ? "\n\n" + error.hint : "") + "\n\nContext: " + error.context);
            }
        },
        _warning:function (warning) {
            this._trigger($.jPlayer.event.warning, undefined, warning);
            if (this.options.warningAlerts) {
                this._alert("Warning!" + (warning.message ? "\n\n" + warning.message : "") + (warning.hint ? "\n\n" + warning.hint : "") + "\n\nContext: " + warning.context);
            }
        },
        _alert:function (message) {
            alert("jPlayer " + this.version.script + " : id='" + this.internal.self.id + "' : " + message);
        },
        _emulateHtmlBridge:function () {
            var self = this,
                methods = $.jPlayer.emulateMethods;

            // Emulate methods on jPlayer's DOM element.
            $.each($.jPlayer.emulateMethods.split(/\s+/g), function (i, name) {
                self.internal.domNode[name] = function (arg) {
                    self[name](arg);
                };

            });

            // Bubble jPlayer events to its DOM element.
            $.each($.jPlayer.event, function (eventName, eventType) {
                var nativeEvent = true;
                $.each($.jPlayer.reservedEvent.split(/\s+/g), function (i, name) {
                    if (name === eventName) {
                        nativeEvent = false;
                        return false;
                    }
                });
                if (nativeEvent) {
                    self.element.bind(eventType + ".jPlayer.jPlayerHtml", function () { // With .jPlayer & .jPlayerHtml namespaces.
                        self._emulateHtmlUpdate();
                        var domEvent = document.createEvent("Event");
                        domEvent.initEvent(eventName, false, true);
                        self.internal.domNode.dispatchEvent(domEvent);
                    });
                }
                // The error event would require a special case
            });

            // IE9 has a readyState property on all elements. The document should have it, but all (except media) elements inherit it in IE9. This conflicts with Popcorn, which polls the readyState.
        },
        _emulateHtmlUpdate:function () {
            var self = this;

            $.each($.jPlayer.emulateStatus.split(/\s+/g), function (i, name) {
                self.internal.domNode[name] = self.status[name];
            });
            $.each($.jPlayer.emulateOptions.split(/\s+/g), function (i, name) {
                self.internal.domNode[name] = self.options[name];
            });
        },
        _destroyHtmlBridge:function () {
            var self = this;

            // Bridge event handlers are also removed by destroy() through .jPlayer namespace.
            this.element.unbind(".jPlayerHtml"); // Remove all event handlers created by the jPlayer bridge. So you can change the emulateHtml option.

            // Remove the methods and properties
            var emulated = $.jPlayer.emulateMethods + " " + $.jPlayer.emulateStatus + " " + $.jPlayer.emulateOptions;
            $.each(emulated.split(/\s+/g), function (i, name) {
                delete self.internal.domNode[name];
            });
        }
    };

    $.jPlayer.error = {
        FLASH:"e_flash",
        FLASH_DISABLED:"e_flash_disabled",
        NO_SOLUTION:"e_no_solution",
        NO_SUPPORT:"e_no_support",
        URL:"e_url",
        URL_NOT_SET:"e_url_not_set",
        VERSION:"e_version"
    };

    $.jPlayer.errorMsg = {
        FLASH:"jPlayer's Flash fallback is not configured correctly, or a command was issued before the jPlayer Ready event. Details: ", // Used in: _flashError()
        FLASH_DISABLED:"jPlayer's Flash fallback has been disabled by the browser due to the CSS rules you have used. Details: ", // Used in: _flashError()
        NO_SOLUTION:"No solution can be found by jPlayer in this browser. Neither HTML nor Flash can be used.", // Used in: _init()
        NO_SUPPORT:"It is not possible to play any media format provided in setMedia() on this browser using your current options.", // Used in: setMedia()
        URL:"Media URL could not be loaded.", // Used in: jPlayerFlashEvent() and _addHtmlEventListeners()
        URL_NOT_SET:"Attempt to issue media playback commands, while no media url is set.", // Used in: load(), play(), pause(), stop() and playHead()
        VERSION:"jPlayer " + $.jPlayer.prototype.version.script + " needs Jplayer.swf version " + $.jPlayer.prototype.version.needFlash + " but found " // Used in: jPlayerReady()
    };

    $.jPlayer.errorHint = {
        FLASH:"Check your swfPath option and that Jplayer.swf is there.",
        FLASH_DISABLED:"Check that you have not display:none; the jPlayer entity or any ancestor.",
        NO_SOLUTION:"Review the jPlayer options: support and supplied.",
        NO_SUPPORT:"Video or audio formats defined in the supplied option are missing.",
        URL:"Check media URL is valid.",
        URL_NOT_SET:"Use setMedia() to set the media URL.",
        VERSION:"Update jPlayer files."
    };

    $.jPlayer.warning = {
        CSS_SELECTOR_COUNT:"e_css_selector_count",
        CSS_SELECTOR_METHOD:"e_css_selector_method",
        CSS_SELECTOR_STRING:"e_css_selector_string",
        OPTION_KEY:"e_option_key"
    };

    $.jPlayer.warningMsg = {
        CSS_SELECTOR_COUNT:"The number of css selectors found did not equal one: ",
        CSS_SELECTOR_METHOD:"The methodName given in jPlayer('cssSelector') is not a valid jPlayer method.",
        CSS_SELECTOR_STRING:"The methodCssSelector given in jPlayer('cssSelector') is not a String or is empty.",
        OPTION_KEY:"The option requested in jPlayer('option') is undefined."
    };

    $.jPlayer.warningHint = {
        CSS_SELECTOR_COUNT:"Check your css selector and the ancestor.",
        CSS_SELECTOR_METHOD:"Check your method name.",
        CSS_SELECTOR_STRING:"Check your css selector is a string.",
        OPTION_KEY:"Check your option name."
    };
})(jQuery);

// jquery.tweet.js - See http://tweet.seaofclouds.com/ or https://github.com/seaofclouds/tweet for more info
// Copyright (c) 2008-2011 Todd Matthews & Steve Purcell
(function ($) {
    $.fn.tweet = function (o) {
        var s = $.extend({
            username:null, // [string or array] required unless using the 'query' option; one or more twitter screen names (use 'list' option for multiple names, where possible)
            list:null, // [string]   optional name of list belonging to username
            favorites:false, // [boolean]  display the user's favorites instead of his tweets
            query:null, // [string]   optional search query (see also: http://search.twitter.com/operators)
            avatar_size:null, // [integer]  height and width of avatar if displayed (48px max)
            count:3, // [integer]  how many tweets to display?
            fetch:null, // [integer]  how many tweets to fetch via the API (set this higher than 'count' if using the 'filter' option)
            page:1, // [integer]  which page of results to fetch (if count != fetch, you'll get unexpected results)
            retweets:true, // [boolean]  whether to fetch (official) retweets (not supported in all display modes)
            intro_text:null, // [string]   do you want text BEFORE your your tweets?
            outro_text:null, // [string]   do you want text AFTER your tweets?
            join_text:null, // [string]   optional text in between date and tweet, try setting to "auto"
            auto_join_text_default:"i said,", // [string]   auto text for non verb: "i said" bullocks
            auto_join_text_ed:"i", // [string]   auto text for past tense: "i" surfed
            auto_join_text_ing:"i am", // [string]   auto tense for present tense: "i was" surfing
            auto_join_text_reply:"i replied to", // [string]   auto tense for replies: "i replied to" @someone "with"
            auto_join_text_url:"i was looking at", // [string]   auto tense for urls: "i was looking at" http:...
            loading_text:null, // [string]   optional loading text, displayed while tweets load
            refresh_interval:null, // [integer]  optional number of seconds after which to reload tweets
            twitter_url:"twitter.com", // [string]   custom twitter url, if any (apigee, etc.)
            twitter_api_url:"api.twitter.com", // [string]   custom twitter api url, if any (apigee, etc.)
            twitter_search_url:"search.twitter.com", // [string]   custom twitter search url, if any (apigee, etc.)
            template:"{avatar}{time}{join}{text}", // [string or function] template used to construct each tweet <li> - see code for available vars
            comparator:function (tweet1, tweet2) {    // [function] comparator used to sort tweets (see Array.sort)
                return tweet2["tweet_time"] - tweet1["tweet_time"];
            },
            filter:function (tweet) {                 // [function] whether or not to include a particular tweet (be sure to also set 'fetch')
                return true;
            }
        }, o);

        // See http://daringfireball.net/2010/07/improved_regex_for_matching_urls
        var url_regexp = /\b((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»“”‘’]))/gi;

        // Expand values inside simple string templates with {placeholders}
        function t(template, info) {
            if (typeof template === "string") {
                var result = template;
                for (var key in info) {
                    var val = info[key];
                    result = result.replace(new RegExp('{' + key + '}', 'g'), val === null ? '' : val);
                }
                return result;
            } else return template(info);
        }

        // Export the t function for use when passing a function as the 'template' option
        $.extend({tweet:{t:t}});

        function replacer(regex, replacement) {
            return function () {
                var returning = [];
                this.each(function () {
                    returning.push(this.replace(regex, replacement));
                });
                return $(returning);
            };
        }

        $.fn.extend({
            linkUrl:replacer(url_regexp, function (match) {
                var url = (/^[a-z]+:/i).test(match) ? match : "http://" + match;
                return "<a href=\"" + url + "\">" + match + "</a>";
            }),
            linkUser:replacer(/@(\w+)/gi, "<a href=\"http://" + s.twitter_url + "/$1\">@$1</a>"),
            // Support various latin1 (\u00**) and arabic (\u06**) alphanumeric chars
            linkHash:replacer(/(?:^| )[\#]+([\w\u00c0-\u00d6\u00d8-\u00f6\u00f8-\u00ff\u0600-\u06ff]+)/gi,
                ' <a href="http://' + s.twitter_search_url + '/search?q=&tag=$1&lang=all' + ((s.username && s.username.length == 1 && !s.list) ? '&from=' + s.username.join("%2BOR%2B") : '') + '">#$1</a>'),
            capAwesome:replacer(/\b(awesome)\b/gi, '<span class="awesome">$1</span>'),
            capEpic:replacer(/\b(epic)\b/gi, '<span class="epic">$1</span>'),
            makeHeart:replacer(/(&lt;)+[3]/gi, "<tt class='heart'>&#x2665;</tt>")
        });

        function parse_date(date_str) {
            // The non-search twitter APIs return inconsistently-formatted dates, which Date.parse
            // cannot handle in IE. We therefore perform the following transformation:
            // "Wed Apr 29 08:53:31 +0000 2009" => "Wed, Apr 29 2009 08:53:31 +0000"
            return Date.parse(date_str.replace(/^([a-z]{3})( [a-z]{3} \d\d?)(.*)( \d{4})$/i, '$1,$2$4$3'));
        }

        function relative_time(date) {
            var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
            var delta = parseInt((relative_to.getTime() - date) / 1000, 10);
            var r = '';
            if (delta < 60) {
                r = delta + ' seconds ago';
            } else if (delta < 120) {
                r = 'a minute ago';
            } else if (delta < (45 * 60)) {
                r = (parseInt(delta / 60, 10)).toString() + ' minutes ago';
            } else if (delta < (2 * 60 * 60)) {
                r = 'an hour ago';
            } else if (delta < (24 * 60 * 60)) {
                r = '' + (parseInt(delta / 3600, 10)).toString() + ' hours ago';
            } else if (delta < (48 * 60 * 60)) {
                r = 'a day ago';
            } else {
                r = (parseInt(delta / 86400, 10)).toString() + ' days ago';
            }
            return 'about ' + r;
        }

        function build_auto_join_text(text) {
            if (text.match(/^(@([A-Za-z0-9-_]+)) .*/i)) {
                return s.auto_join_text_reply;
            } else if (text.match(url_regexp)) {
                return s.auto_join_text_url;
            } else if (text.match(/^((\w+ed)|just) .*/im)) {
                return s.auto_join_text_ed;
            } else if (text.match(/^(\w*ing) .*/i)) {
                return s.auto_join_text_ing;
            } else {
                return s.auto_join_text_default;
            }
        }

        function maybe_https(url) {
            return ('https:' == document.location.protocol) ? url.replace(/^http:/, 'https:') : url;
        }

        function build_api_url() {
            var proto = ('https:' == document.location.protocol ? 'https:' : 'http:');
            var count = (s.fetch === null) ? s.count : s.fetch;
            if (s.list) {
                return proto + "//" + s.twitter_api_url + "/1/" + s.username[0] + "/lists/" + s.list + "/statuses.json?page=" + s.page + "&per_page=" + count + "&callback=?";
            } else if (s.favorites) {
                return proto + "//" + s.twitter_api_url + "/favorites/" + s.username[0] + ".json?page=" + s.page + "&count=" + count + "&callback=?";
            } else if (s.query === null && s.username.length == 1) {
                return proto + '//' + s.twitter_api_url + '/1/statuses/user_timeline.json?screen_name=' + s.username[0] + '&count=' + count + (s.retweets ? '&include_rts=1' : '') + '&page=' + s.page + '&callback=?';
            } else {
                var query = (s.query || 'from:' + s.username.join(' OR from:'));
                return proto + '//' + s.twitter_search_url + '/search.json?&q=' + encodeURIComponent(query) + '&rpp=' + count + '&page=' + s.page + '&callback=?';
            }
        }

        // Convert twitter API objects into data available for
        // constructing each tweet <li> using a template
        function extract_template_data(item) {
            var o = {};
            o.item = item;
            o.source = item.source;
            o.screen_name = item.from_user || item.user.screen_name;
            o.avatar_size = s.avatar_size;
            o.avatar_url = maybe_https(item.profile_image_url || item.user.profile_image_url);
            o.retweet = typeof(item.retweeted_status) != 'undefined';
            o.tweet_time = parse_date(item.created_at);
            o.join_text = s.join_text == "auto" ? build_auto_join_text(item.text) : s.join_text;
            o.tweet_id = item.id_str;
            o.twitter_base = "http://" + s.twitter_url + "/";
            o.user_url = o.twitter_base + o.screen_name;
            o.tweet_url = o.user_url + "/status/" + o.tweet_id;
            o.reply_url = o.twitter_base + "intent/tweet?in_reply_to=" + o.tweet_id;
            o.retweet_url = o.twitter_base + "intent/retweet?tweet_id=" + o.tweet_id;
            o.favorite_url = o.twitter_base + "intent/favorite?tweet_id=" + o.tweet_id;
            o.retweeted_screen_name = o.retweet && item.retweeted_status.user.screen_name;
            o.tweet_relative_time = relative_time(o.tweet_time);
            o.tweet_raw_text = o.retweet ? ('RT @' + o.retweeted_screen_name + ' ' + item.retweeted_status.text) : item.text; // avoid '...' in long retweets
            o.tweet_text = $([o.tweet_raw_text]).linkUrl().linkUser().linkHash()[0];
            o.tweet_text_fancy = $([o.tweet_text]).makeHeart().capAwesome().capEpic()[0];

            // Default spans, and pre-formatted blocks for common layouts
            o.user = t('<a class="tweet_user" href="{user_url}">{screen_name}</a>', o);
            o.join = s.join_text ? t(' <span class="tweet_join">{join_text}</span> ', o) : ' ';
            o.avatar = o.avatar_size ?
                t('<a class="tweet_avatar" href="{user_url}"><img src="{avatar_url}" height="{avatar_size}" width="{avatar_size}" alt="{screen_name}\'s avatar" title="{screen_name}\'s avatar" border="0"/></a>', o) : '';
            o.time = t('<span class="tweet_time"><a href="{tweet_url}" title="view tweet on twitter">{tweet_relative_time}</a></span>', o);
            o.text = t('<span class="tweet_text">{tweet_text_fancy}</span>', o);
            o.reply_action = t('<a class="tweet_action tweet_reply" href="{reply_url}">reply</a>', o);
            o.retweet_action = t('<a class="tweet_action tweet_retweet" href="{retweet_url}">retweet</a>', o);
            o.favorite_action = t('<a class="tweet_action tweet_favorite" href="{favorite_url}">favorite</a>', o);
            return o;
        }

        return this.each(function (i, widget) {
            var list = $('<ul class="tweet_list">').appendTo(widget);
            var intro = '<p class="tweet_intro">' + s.intro_text + '</p>';
            var outro = '<p class="tweet_outro">' + s.outro_text + '</p>';
            var loading = $('<p class="loading">' + s.loading_text + '</p>');

            if (s.username && typeof(s.username) == "string") {
                s.username = [s.username];
            }

            if (s.loading_text) $(widget).append(loading);
            $(widget).bind("tweet:load",
                function () {
                    $.getJSON(build_api_url(), function (data) {
                        if (s.loading_text) loading.remove();
                        if (s.intro_text) list.before(intro);
                        list.empty();

                        var tweets = $.map(data.results || data, extract_template_data);
                        tweets = $.grep(tweets, s.filter).sort(s.comparator).slice(0, s.count);
                        list.append($.map(tweets,
                            function (o) {
                                return "<li>" + t(s.template, o) + "</li>";
                            }).join('')).
                            children('li:first').addClass('tweet_first').end().
                            children('li:odd').addClass('tweet_even').end().
                            children('li:even').addClass('tweet_odd');

                        if (s.outro_text) list.after(outro);
                        $(widget).trigger("loaded").trigger((tweets.length === 0 ? "empty" : "full"));
                        if (s.refresh_interval) {
                            window.setTimeout(function () {
                                $(widget).trigger("tweet:load");
                            }, 1000 * s.refresh_interval);
                        }
                    });
                }).trigger("tweet:load");
        });
    };
})(jQuery);

/*
 * jQuery FlexSlider v1.8
 * http://flex.madebymufffin.com
 * Copyright 2011, Tyler Smith
 */
(function (a) {
    a.flexslider = function (c, b) {
        var d = c;
        d.init = function () {
            d.vars = a.extend({}, a.flexslider.defaults, b);
            d.data("flexslider", true);
            d.container = a(".slides", d);
            d.slides = a(".slides > li", d);
            d.count = d.slides.length;
            d.animating = false;
            d.currentSlide = d.vars.slideToStart;
            d.animatingTo = d.currentSlide;
            d.atEnd = (d.currentSlide == 0) ? true : false;
            d.eventType = ("ontouchstart" in document.documentElement) ? "touchstart" : "click";
            d.cloneCount = 0;
            d.cloneOffset = 0;
            d.manualPause = false;
            d.vertical = (d.vars.slideDirection == "vertical");
            d.prop = (d.vertical) ? "top" : "marginLeft";
            d.args = {};
            d.transitions = "webkitTransition" in document.body.style;
            if (d.transitions) {
                d.prop = "-webkit-transform"
            }
            if (d.vars.controlsContainer != "") {
                d.controlsContainer = a(d.vars.controlsContainer).eq(a(".slides").index(d.container));
                d.containerExists = d.controlsContainer.length > 0
            }
            if (d.vars.manualControls != "") {
                d.manualControls = a(d.vars.manualControls, ((d.containerExists) ? d.controlsContainer : d));
                d.manualExists = d.manualControls.length > 0
            }
            if (d.vars.randomize) {
                d.slides.sort(function () {
                    return(Math.round(Math.random()) - 0.5)
                });
                d.container.empty().append(d.slides)
            }
            if (d.vars.animation.toLowerCase() == "slide") {
                if (d.transitions) {
                    d.setTransition(0)
                }
                d.css({overflow:"hidden"});
                if (d.vars.animationLoop) {
                    d.cloneCount = 2;
                    d.cloneOffset = 1;
                    d.container.append(d.slides.filter(":first").clone().addClass("clone")).prepend(d.slides.filter(":last").clone().addClass("clone"))
                }
                d.newSlides = a(".slides > li", d);
                var m = (-1 * (d.currentSlide + d.cloneOffset));
                if (d.vertical) {
                    d.newSlides.css({display:"block", width:"100%", "float":"left"});
                    d.container.height((d.count + d.cloneCount) * 200 + "%").css("position", "absolute").width("100%");
                    setTimeout(function () {
                        d.css({position:"relative"}).height(d.slides.filter(":first").height());
                        d.args[d.prop] = (d.transitions) ? "translate3d(0," + m * d.height() + "px,0)" : m * d.height() + "px";
                        d.container.css(d.args)
                    }, 100)
                } else {
                    d.args[d.prop] = (d.transitions) ? "translate3d(" + m * d.width() + "px,0,0)" : m * d.width() + "px";
                    d.container.width((d.count + d.cloneCount) * 200 + "%").css(d.args);
                    setTimeout(function () {
                        d.newSlides.width(d.width()).css({"float":"left", display:"block"})
                    }, 100)
                }
            } else {
                d.transitions = false;
                d.slides.css({width:"100%", "float":"left", marginRight:"-100%"}).eq(d.currentSlide).fadeIn(d.vars.animationDuration)
            }
            if (d.vars.controlNav) {
                if (d.manualExists) {
                    d.controlNav = d.manualControls
                } else {
                    var e = a('<ol class="flex-control-nav"></ol>');
                    var s = 1;
                    for (var t = 0; t < d.count; t++) {
                        e.append("<li><a>" + s + "</a></li>");
                        s++
                    }
                    if (d.containerExists) {
                        a(d.controlsContainer).append(e);
                        d.controlNav = a(".flex-control-nav li a", d.controlsContainer)
                    } else {
                        d.append(e);
                        d.controlNav = a(".flex-control-nav li a", d)
                    }
                }
                d.controlNav.eq(d.currentSlide).addClass("active");
                d.controlNav.bind(d.eventType, function (i) {
                    i.preventDefault();
                    if (!a(this).hasClass("active")) {
                        (d.controlNav.index(a(this)) > d.currentSlide) ? d.direction = "next" : d.direction = "prev";
                        d.flexAnimate(d.controlNav.index(a(this)), d.vars.pauseOnAction)
                    }
                })
            }
            if (d.vars.directionNav) {
                var v = a('<ul class="flex-direction-nav"><li><a class="prev" href="#">' + d.vars.prevText + '</a></li><li><a class="next" href="#">' + d.vars.nextText + "</a></li></ul>");
                if (d.containerExists) {
                    a(d.controlsContainer).append(v);
                    d.directionNav = a(".flex-direction-nav li a", d.controlsContainer)
                } else {
                    d.append(v);
                    d.directionNav = a(".flex-direction-nav li a", d)
                }
                if (!d.vars.animationLoop) {
                    if (d.currentSlide == 0) {
                        d.directionNav.filter(".prev").addClass("disabled")
                    } else {
                        if (d.currentSlide == d.count - 1) {
                            d.directionNav.filter(".next").addClass("disabled")
                        }
                    }
                }
                d.directionNav.bind(d.eventType, function (i) {
                    i.preventDefault();
                    var j = (a(this).hasClass("next")) ? d.getTarget("next") : d.getTarget("prev");
                    if (d.canAdvance(j)) {
                        d.flexAnimate(j, d.vars.pauseOnAction)
                    }
                })
            }
            if (d.vars.keyboardNav && a("ul.slides").length == 1) {
                function h(i) {
                    if (d.animating) {
                        return
                    } else {
                        if (i.keyCode != 39 && i.keyCode != 37) {
                            return
                        } else {
                            if (i.keyCode == 39) {
                                var j = d.getTarget("next")
                            } else {
                                if (i.keyCode == 37) {
                                    var j = d.getTarget("prev")
                                }
                            }
                            if (d.canAdvance(j)) {
                                d.flexAnimate(j, d.vars.pauseOnAction)
                            }
                        }
                    }
                }

                a(document).bind("keyup", h)
            }
            if (d.vars.mousewheel) {
                d.mousewheelEvent = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel";
                d.bind(d.mousewheelEvent, function (y) {
                    y.preventDefault();
                    y = y ? y : window.event;
                    var i = y.detail ? y.detail * -1 : y.wheelDelta / 40, j = (i < 0) ? d.getTarget("next") : d.getTarget("prev");
                    if (d.canAdvance(j)) {
                        d.flexAnimate(j, d.vars.pauseOnAction)
                    }
                })
            }
            if (d.vars.slideshow) {
                if (d.vars.pauseOnHover && d.vars.slideshow) {
                    d.hover(function () {
                        d.pause()
                    }, function () {
                        if (!d.manualPause) {
                            d.resume()
                        }
                    })
                }
                d.animatedSlides = setInterval(d.animateSlides, d.vars.slideshowSpeed)
            }
            if (d.vars.pausePlay) {
                var q = a('<div class="flex-pauseplay"><span></span></div>');
                if (d.containerExists) {
                    d.controlsContainer.append(q);
                    d.pausePlay = a(".flex-pauseplay span", d.controlsContainer)
                } else {
                    d.append(q);
                    d.pausePlay = a(".flex-pauseplay span", d)
                }
                var n = (d.vars.slideshow) ? "pause" : "play";
                d.pausePlay.addClass(n).text((n == "pause") ? d.vars.pauseText : d.vars.playText);
                d.pausePlay.bind(d.eventType, function (i) {
                    i.preventDefault();
                    if (a(this).hasClass("pause")) {
                        d.pause();
                        d.manualPause = true
                    } else {
                        d.resume();
                        d.manualPause = false
                    }
                })
            }
            if ("ontouchstart" in document.documentElement) {
                var w, u, l, r, o, x, p = false;
                d.each(function () {
                    if ("ontouchstart" in document.documentElement) {
                        this.addEventListener("touchstart", g, false)
                    }
                });
                function g(i) {
                    if (d.animating) {
                        i.preventDefault()
                    } else {
                        if (i.touches.length == 1) {
                            d.pause();
                            r = (d.vertical) ? d.height() : d.width();
                            x = Number(new Date());
                            l = (d.vertical) ? (d.currentSlide + d.cloneOffset) * d.height() : (d.currentSlide + d.cloneOffset) * d.width();
                            w = (d.vertical) ? i.touches[0].pageY : i.touches[0].pageX;
                            u = (d.vertical) ? i.touches[0].pageX : i.touches[0].pageY;
                            d.setTransition(0);
                            this.addEventListener("touchmove", k, false);
                            this.addEventListener("touchend", f, false)
                        }
                    }
                }

                function k(i) {
                    o = (d.vertical) ? w - i.touches[0].pageY : w - i.touches[0].pageX;
                    p = (d.vertical) ? (Math.abs(o) < Math.abs(i.touches[0].pageX - u)) : (Math.abs(o) < Math.abs(i.touches[0].pageY - u));
                    if (!p) {
                        i.preventDefault();
                        if (d.vars.animation == "slide" && d.transitions) {
                            if (!d.vars.animationLoop) {
                                o = o / ((d.currentSlide == 0 && o < 0 || d.currentSlide == d.count - 1 && o > 0) ? (Math.abs(o) / r + 2) : 1)
                            }
                            d.args[d.prop] = (d.vertical) ? "translate3d(0," + (-l - o) + "px,0)" : "translate3d(" + (-l - o) + "px,0,0)";
                            d.container.css(d.args)
                        }
                    }
                }

                function f(j) {
                    d.animating = false;
                    if (d.animatingTo == d.currentSlide && !p && !(o == null)) {
                        var i = (o > 0) ? d.getTarget("next") : d.getTarget("prev");
                        if (d.canAdvance(i) && Number(new Date()) - x < 550 && Math.abs(o) > 20 || Math.abs(o) > r / 2) {
                            d.flexAnimate(i, d.vars.pauseOnAction)
                        } else {
                            d.flexAnimate(d.currentSlide, d.vars.pauseOnAction)
                        }
                    }
                    this.removeEventListener("touchmove", k, false);
                    this.removeEventListener("touchend", f, false);
                    w = null;
                    u = null;
                    o = null;
                    l = null
                }
            }
            if (d.vars.animation.toLowerCase() == "slide") {
                a(window).resize(function () {
                    if (!d.animating) {
                        if (d.vertical) {
                            d.height(d.slides.filter(":first").height());
                            d.args[d.prop] = (-1 * (d.currentSlide + d.cloneOffset)) * d.slides.filter(":first").height() + "px";
                            if (d.transitions) {
                                d.setTransition(0);
                                d.args[d.prop] = (d.vertical) ? "translate3d(0," + d.args[d.prop] + ",0)" : "translate3d(" + d.args[d.prop] + ",0,0)"
                            }
                            d.container.css(d.args)
                        } else {
                            d.newSlides.width(d.width());
                            d.args[d.prop] = (-1 * (d.currentSlide + d.cloneOffset)) * d.width() + "px";
                            if (d.transitions) {
                                d.setTransition(0);
                                d.args[d.prop] = (d.vertical) ? "translate3d(0," + d.args[d.prop] + ",0)" : "translate3d(" + d.args[d.prop] + ",0,0)"
                            }
                            d.container.css(d.args)
                        }
                    }
                })
            }
            d.vars.start(d)
        };
        d.flexAnimate = function (g, f) {
            if (!d.animating) {
                d.animating = true;
                d.animatingTo = g;
                d.vars.before(d);
                if (f) {
                    d.pause()
                }
                if (d.vars.controlNav) {
                    d.controlNav.removeClass("active").eq(g).addClass("active")
                }
                d.atEnd = (g == 0 || g == d.count - 1) ? true : false;
                if (!d.vars.animationLoop && d.vars.directionNav) {
                    if (g == 0) {
                        d.directionNav.removeClass("disabled").filter(".prev").addClass("disabled")
                    } else {
                        if (g == d.count - 1) {
                            d.directionNav.removeClass("disabled").filter(".next").addClass("disabled")
                        } else {
                            d.directionNav.removeClass("disabled")
                        }
                    }
                }
                if (!d.vars.animationLoop && g == d.count - 1) {
                    d.pause();
                    d.vars.end(d)
                }
                if (d.vars.animation.toLowerCase() == "slide") {
                    var e = (d.vertical) ? d.slides.filter(":first").height() : d.slides.filter(":first").width();
                    if (d.currentSlide == 0 && g == d.count - 1 && d.vars.animationLoop && d.direction != "next") {
                        d.slideString = "0px"
                    } else {
                        if (d.currentSlide == d.count - 1 && g == 0 && d.vars.animationLoop && d.direction != "prev") {
                            d.slideString = (-1 * (d.count + 1)) * e + "px"
                        } else {
                            d.slideString = (-1 * (g + d.cloneOffset)) * e + "px"
                        }
                    }
                    d.args[d.prop] = d.slideString;
                    if (d.transitions) {
                        d.setTransition(d.vars.animationDuration);
                        d.args[d.prop] = (d.vertical) ? "translate3d(0," + d.slideString + ",0)" : "translate3d(" + d.slideString + ",0,0)";
                        d.container.css(d.args).one("webkitTransitionEnd transitionend", function () {
                            d.wrapup(e)
                        })
                    } else {
                        d.container.animate(d.args, d.vars.animationDuration, function () {
                            d.wrapup(e)
                        })
                    }
                } else {
                    d.slides.eq(d.currentSlide).fadeOut(d.vars.animationDuration);
                    d.slides.eq(g).fadeIn(d.vars.animationDuration, function () {
                        d.wrapup()
                    })
                }
            }
        };
        d.wrapup = function (e) {
            if (d.vars.animation == "slide") {
                if (d.currentSlide == 0 && d.animatingTo == d.count - 1 && d.vars.animationLoop) {
                    d.args[d.prop] = (-1 * d.count) * e + "px";
                    if (d.transitions) {
                        d.setTransition(0);
                        d.args[d.prop] = (d.vertical) ? "translate3d(0," + d.args[d.prop] + ",0)" : "translate3d(" + d.args[d.prop] + ",0,0)"
                    }
                    d.container.css(d.args)
                } else {
                    if (d.currentSlide == d.count - 1 && d.animatingTo == 0 && d.vars.animationLoop) {
                        d.args[d.prop] = -1 * e + "px";
                        if (d.transitions) {
                            d.setTransition(0);
                            d.args[d.prop] = (d.vertical) ? "translate3d(0," + d.args[d.prop] + ",0)" : "translate3d(" + d.args[d.prop] + ",0,0)"
                        }
                        d.container.css(d.args)
                    }
                }
            }
            d.animating = false;
            d.currentSlide = d.animatingTo;
            d.vars.after(d)
        };
        d.animateSlides = function () {
            if (!d.animating) {
                d.flexAnimate(d.getTarget("next"))
            }
        };
        d.pause = function () {
            clearInterval(d.animatedSlides);
            if (d.vars.pausePlay) {
                d.pausePlay.removeClass("pause").addClass("play").text(d.vars.playText)
            }
        };
        d.resume = function () {
            d.animatedSlides = setInterval(d.animateSlides, d.vars.slideshowSpeed);
            if (d.vars.pausePlay) {
                d.pausePlay.removeClass("play").addClass("pause").text(d.vars.pauseText)
            }
        };
        d.canAdvance = function (e) {
            if (!d.vars.animationLoop && d.atEnd) {
                if (d.currentSlide == 0 && e == d.count - 1 && d.direction != "next") {
                    return false
                } else {
                    if (d.currentSlide == d.count - 1 && e == 0 && d.direction == "next") {
                        return false
                    } else {
                        return true
                    }
                }
            } else {
                return true
            }
        };
        d.getTarget = function (e) {
            d.direction = e;
            if (e == "next") {
                return(d.currentSlide == d.count - 1) ? 0 : d.currentSlide + 1
            } else {
                return(d.currentSlide == 0) ? d.count - 1 : d.currentSlide - 1
            }
        };
        d.setTransition = function (e) {
            d.container.css({"-webkit-transition-duration":(e / 1000) + "s"})
        };
        d.init()
    };
    a.flexslider.defaults = {animation:"fade", slideDirection:"horizontal", slideshow:true, slideshowSpeed:7000, animationDuration:600, directionNav:true, controlNav:true, keyboardNav:true, mousewheel:false, prevText:"Previous", nextText:"Next", pausePlay:false, pauseText:"Pause", playText:"Play", randomize:false, slideToStart:0, animationLoop:true, pauseOnAction:true, pauseOnHover:false, controlsContainer:"", manualControls:"", start:function () {
    }, before:function () {
    }, after:function () {
    }, end:function () {
    }};
    a.fn.flexslider = function (b) {
        return this.each(function () {
            if (a(this).find(".slides li").length == 1) {
                a(this).find(".slides li").fadeIn(400)
            } else {
                if (a(this).data("flexslider") != true) {
                    new a.flexslider(a(this), b)
                }
            }
        })
    }
})(jQuery);

/*
 *HOVER INTENT
 */
(function ($) {
    /* hoverIntent by Brian Cherne */
    $.fn.hoverIntent = function (f, g) {
        // default configuration options
        var cfg = {
            sensitivity:7,
            interval:100,
            timeout:0
        };
        // override configuration options with user supplied object
        cfg = $.extend(cfg, g ? { over:f, out:g } : f);

        // instantiate variables
        // cX, cY = current X and Y position of mouse, updated by mousemove event
        // pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
        var cX, cY, pX, pY;

        // A private function for getting mouse position
        var track = function (ev) {
            cX = ev.pageX;
            cY = ev.pageY;
        };

        // A private function for comparing current and previous mouse position
        var compare = function (ev, ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            // compare mouse positions to see if they've crossed the threshold
            if (( Math.abs(pX - cX) + Math.abs(pY - cY) ) < cfg.sensitivity) {
                $(ob).unbind("mousemove", track);
                // set hoverIntent state to true (so mouseOut can be called)
                ob.hoverIntent_s = 1;
                return cfg.over.apply(ob, [ev]);
            } else {
                // set previous coordinates for next time
                pX = cX;
                pY = cY;
                // use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
                ob.hoverIntent_t = setTimeout(function () {
                    compare(ev, ob);
                }, cfg.interval);
            }
        };

        // A private function for delaying the mouseOut function
        var delay = function (ev, ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            ob.hoverIntent_s = 0;
            return cfg.out.apply(ob, [ev]);
        };

        // A private function for handling mouse 'hovering'
        var handleHover = function (e) {
            // next three lines copied from jQuery.hover, ignore children onMouseOver/onMouseOut
            var p = (e.type == "mouseover" ? e.fromElement : e.toElement) || e.relatedTarget;
            while (p && p != this) {
                try {
                    p = p.parentNode;
                } catch (e) {
                    p = this;
                }
            }
            if (p == this) {
                return false;
            }

            // copy objects to be passed into t (required for event object to be passed in IE)
            var ev = jQuery.extend({}, e);
            var ob = this;

            // cancel hoverIntent timer if it exists
            if (ob.hoverIntent_t) {
                ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            }

            // else e.type == "onmouseover"
            if (e.type == "mouseover") {
                // set "previous" X and Y position based on initial entry point
                pX = ev.pageX;
                pY = ev.pageY;
                // update "current" X and Y position based on mousemove
                $(ob).bind("mousemove", track);
                // start polling interval (self-calling timeout) to compare mouse coordinates over time
                if (ob.hoverIntent_s != 1) {
                    ob.hoverIntent_t = setTimeout(function () {
                        compare(ev, ob);
                    }, cfg.interval);
                }

                // else e.type == "onmouseout"
            } else {
                // unbind expensive mousemove event
                $(ob).unbind("mousemove", track);
                // if hoverIntent state is true, then call the mouseOut function after the specified delay
                if (ob.hoverIntent_s == 1) {
                    ob.hoverIntent_t = setTimeout(function () {
                        delay(ev, ob);
                    }, cfg.timeout);
                }
            }
        };

        // bind the function to the two event listeners
        return this.mouseover(handleHover).mouseout(handleHover);
    };

})(jQuery);


/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

;
(function ($) {
    $.fn.superfish = function (op) {

        var sf = $.fn.superfish,
            c = sf.c,
            $arrow = $(['<span class="', c.arrowClass, '"> &#187;</span>'].join('')),
            over = function () {
                var $$ = $(this), menu = getMenu($$);
                clearTimeout(menu.sfTimer);
                $$.showSuperfishUl().siblings().hideSuperfishUl();
            },
            out = function () {
                var $$ = $(this), menu = getMenu($$), o = sf.op;
                clearTimeout(menu.sfTimer);
                menu.sfTimer = setTimeout(function () {
                    o.retainPath = ($.inArray($$[0], o.$path) > -1);
                    $$.hideSuperfishUl();
                    if (o.$path.length && $$.parents(['li.', o.hoverClass].join('')).length < 1) {
                        over.call(o.$path);
                    }
                }, o.delay);
            },
            getMenu = function ($menu) {
                var menu = $menu.parents(['ul.', c.menuClass, ':first'].join(''))[0];
                sf.op = sf.o[menu.serial];
                return menu;
            },
            addArrow = function ($a) {
                $a.addClass(c.anchorClass).append($arrow.clone());
            };

        return this.each(
            function () {
                var s = this.serial = sf.o.length;
                var o = $.extend({}, sf.defaults, op);
                o.$path = $('li.' + o.pathClass, this).slice(0, o.pathLevels).each(function () {
                    $(this).addClass([o.hoverClass, c.bcClass].join(' '))
                        .filter('li:has(ul)').removeClass(o.pathClass);
                });
                sf.o[s] = sf.op = o;

                $('li:has(ul)', this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over, out).each(function () {
                    if (o.autoArrows) addArrow($('>a:first-child', this));
                })
                    .not('.' + c.bcClass)
                    .hideSuperfishUl();

                var $a = $('a', this);
                $a.each(function (i) {
                    var $li = $a.eq(i).parents('li');
                    $a.eq(i).focus(
                        function () {
                            over.call($li);
                        }).blur(function () {
                        out.call($li);
                    });
                });
                o.onInit.call(this);

            }).each(function () {
                var menuClasses = [c.menuClass];
                if (sf.op.dropShadows && !($.browser.msie && $.browser.version < 7)) menuClasses.push(c.shadowClass);
                $(this).addClass(menuClasses.join(' '));
            });
    };

    var sf = $.fn.superfish;
    sf.o = [];
    sf.op = {};
    sf.IE7fix = function () {
        var o = sf.op;
        if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity != undefined)
            this.toggleClass(sf.c.shadowClass + '-off');
    };
    sf.c = {
        bcClass:'sf-breadcrumb',
        menuClass:'sf-js-enabled',
        anchorClass:'sf-with-ul',
        arrowClass:'sf-sub-indicator',
        shadowClass:'sf-shadow'
    };
    sf.defaults = {
        hoverClass:'sfHover',
        pathClass:'overideThisToUse',
        pathLevels:1,
        delay:800,
        animation:{opacity:'show'},
        speed:'normal',
        autoArrows:true,
        dropShadows:true,
        disableHI:false, // true disables hoverIntent detection
        onInit:function () {
        }, // callback functions
        onBeforeShow:function () {
        },
        onShow:function () {
        },
        onHide:function () {
        }
    };
    $.fn.extend({
        hideSuperfishUl:function () {
            var o = sf.op,
                not = (o.retainPath === true) ? o.$path : '';
            o.retainPath = false;
            var $ul = $(['li.', o.hoverClass].join(''), this).add(this).not(not).removeClass(o.hoverClass)
                .find('>ul').hide().css('visibility', 'hidden');
            o.onHide.call($ul);
            return this;
        },
        showSuperfishUl:function () {
            var o = sf.op,
                sh = sf.c.shadowClass + '-off',
                $ul = this.addClass(o.hoverClass)
                    .find('>ul:hidden').css('visibility', 'visible');
            sf.IE7fix.call($ul);
            o.onBeforeShow.call($ul);
            $ul.animate(o.animation, o.speed, function () {
                sf.IE7fix.call($ul);
                o.onShow.call($ul);
            });
            return this;
        }
    });

})(jQuery);


/*
 * Supersubs v0.2b - jQuery plugin
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 *
 * This plugin automatically adjusts submenu widths of suckerfish-style menus to that of
 * their longest list item children. If you use this, please expect bugs and report them
 * to the jQuery Google Group with the word 'Superfish' in the subject line.
 *
 */

;
(function ($) { // $ will refer to jQuery within this closure

    $.fn.supersubs = function (options) {
        var opts = $.extend({}, $.fn.supersubs.defaults, options);
        // return original object to support chaining
        return this.each(function () {
            // cache selections
            var $$ = $(this);
            // support metadata
            var o = $.meta ? $.extend({}, opts, $$.data()) : opts;
            // get the font size of menu.
            // .css('fontSize') returns various results cross-browser, so measure an em dash instead
            var fontsize = $('<li id="menu-fontsize">&#8212;</li>').css({
                'padding':0,
                'position':'absolute',
                'top':'-999em',
                'width':'auto'
            }).appendTo($$).width(); //clientWidth is faster, but was incorrect here
            // remove em dash
            $('#menu-fontsize').remove();
            // cache all ul elements
            $ULs = $$.find('ul');
            // loop through each ul in menu
            $ULs.each(function (i) {
                // cache this ul
                var $ul = $ULs.eq(i);
                // get all (li) children of this ul
                var $LIs = $ul.children();
                // get all anchor grand-children
                var $As = $LIs.children('a');
                // force content to one line and save current float property
                var liFloat = $LIs.css('white-space', 'nowrap').css('float');
                // remove width restrictions and floats so elements remain vertically stacked
                var emWidth = $ul.add($LIs).add($As).css({
                    'float':'none',
                    'width':'auto'
                })
                    // this ul will now be shrink-wrapped to longest li due to position:absolute
                    // so save its width as ems. Clientwidth is 2 times faster than .width() - thanks Dan Switzer
                    .end().end()[0].clientWidth / fontsize;
                // add more width to ensure lines don't turn over at certain sizes in various browsers
                emWidth += o.extraWidth;
                // restrict to at least minWidth and at most maxWidth
                if (emWidth > o.maxWidth) {
                    emWidth = o.maxWidth;
                }
                else if (emWidth < o.minWidth) {
                    emWidth = o.minWidth;
                }
                emWidth += 'em';
                // set ul to width in ems
                $ul.css('width', emWidth);
                // restore li floats to avoid IE bugs
                // set li width to full width of this ul
                // revert white-space to normal
                $LIs.css({
                    'float':liFloat,
                    'width':'100%',
                    'white-space':'normal'
                })
                    // update offset position of descendant ul to reflect new width of parent
                    .each(function () {
                        var $childUl = $('>ul', this);
                        var offsetDirection = $childUl.css('left') !== undefined ? 'left' : 'right';
                        $childUl.css(offsetDirection, emWidth);
                    });
            });

        });
    };
    // expose defaults
    $.fn.supersubs.defaults = {
        minWidth:9, // requires em unit.
        maxWidth:25, // requires em unit.
        extraWidth:0            // extra width can ensure lines don't sometimes turn over due to slight browser differences in how they round-off values
    };

})(jQuery); // plugin code ends

/**
 * jQuery Cookie plugin - https://github.com/carhartl/jquery-cookie
 *
 * Copyright (c) 2010 Klaus Hartl, @carhartl
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
(function ($) {
    $.cookie = function (key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path ? '; path=' + options.path : '',
                options.domain ? '; domain=' + options.domain : '',
                options.secure ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var decode = options.raw ? function (s) {
            return s;
        } : decodeURIComponent;

        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) return decode(pair[1] || ''); // IE saves cookies with empty string as "c; ", e.g. without "=" as opposed to EOMB, thus pair[1] may be undefined
        }
        return null;
    };
})(jQuery);

/* =============================================================
 * bootstrap-collapse.js v2.0.1
 * http://twitter.github.com/bootstrap/javascript.html#collapse
 * =============================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */

!function ($) {

    "use strict"

    var Collapse = function (element, options) {
        this.$element = $(element)
        this.options = $.extend({}, $.fn.collapse.defaults, options)

        if (this.options["parent"]) {
            this.$parent = $(this.options["parent"])
        }

        this.options.toggle && this.toggle()
    }

    Collapse.prototype = {

        constructor:Collapse, dimension:function () {
            var hasWidth = this.$element.hasClass('width')
            return hasWidth ? 'width' : 'height'
        }, show:function () {
            var dimension = this.dimension()
                , scroll = $.camelCase(['scroll', dimension].join('-'))
                , actives = this.$parent && this.$parent.find('.in')
                , hasData

            if (actives && actives.length) {
                hasData = actives.data('collapse')
                actives.collapse('hide')
                hasData || actives.data('collapse', null)
            }

            this.$element[dimension](0)
            this.transition('addClass', 'show', 'shown')

                //FF Hack for scrollHeight
            //http://stackoverflow.com/questions/4369990/scrollheight-property-in-firefox
            this.$element[0].style.overflow = "scroll"
            this.$element[dimension](this.$element[0][scroll])
            this.$element[0].style.overflow = "hidden"

        }, hide:function () {
            var dimension = this.dimension()
            this.reset(this.$element[dimension]())
            this.transition('removeClass', 'hide', 'hidden')
            this.$element[dimension](0)
        }, reset:function (size) {
            var dimension = this.dimension()

            this.$element
                .removeClass('collapse')
                [dimension](size || 'auto')
                [0].offsetWidth

            this.$element.addClass('collapse')
        }, transition:function (method, startEvent, completeEvent) {
            var that = this
                , complete = function () {
                if (startEvent == 'show') that.reset()
                that.$element.trigger(completeEvent)
            }

            this.$element
                .trigger(startEvent)
                [method]('in')

            $.support.transition && this.$element.hasClass('collapse') ?
                this.$element.one($.support.transition.end, complete) :
                complete()
        }, toggle:function () {
            this[this.$element.hasClass('in') ? 'hide' : 'show']()
        }

    }

    /* COLLAPSIBLE PLUGIN DEFINITION
     * ============================== */

    $.fn.collapse = function (option) {
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('collapse')
                , options = typeof option == 'object' && option
            if (!data) $this.data('collapse', (data = new Collapse(this, options)))
            if (typeof option == 'string') data[option]()
        })
    }

    $.fn.collapse.defaults = {
        toggle:true
    }

    $.fn.collapse.Constructor = Collapse


    /* COLLAPSIBLE DATA-API
     * ==================== */

    $(function () {
        $('body').on('click.collapse.data-api', '[data-toggle=collapse]', function (e) {
            var $this = $(this), href
                , target = $this.attr('data-target')
                || e.preventDefault()
                || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') //strip for ie7
                , option = $(target).data('collapse') ? 'toggle' : $this.data()
            $(target).collapse(option)
        })
    })

}(window.jQuery);

/*!
 * jQuery Smooth Scroll Plugin v1.4.4
 *
 * Date: Mon Feb 20 09:04:54 2012 EST
 * Requires: jQuery v1.3+
 *
 * Copyright 2010, Karl Swedberg
 * Dual licensed under the MIT and GPL licenses (just like jQuery):
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 *
 *
 *
 */
(function (b) {
    function m(c) {
        return c.replace(/(:|\.)/g, "\\$1")
    }

    var n = function (c) {
        var e = [], a = false, d = c.dir && c.dir == "left" ? "scrollLeft" : "scrollTop";
        this.each(function () {
            if (!(this == document || this == window)) {
                var f = b(this);
                if (f[d]() > 0)e.push(this); else {
                    f[d](1);
                    a = f[d]() > 0;
                    f[d](0);
                    a && e.push(this)
                }
            }
        });
        if (c.el === "first" && e.length)e = [e.shift()];
        return e
    }, o = "ontouchend"in document;
    b.fn.extend({scrollable:function (c) {
        return this.pushStack(n.call(this, {dir:c}))
    }, firstScrollable:function (c) {
        return this.pushStack(n.call(this,
            {el:"first", dir:c}))
    }, smoothScroll:function (c) {
        c = c || {};
        var e = b.extend({}, b.fn.smoothScroll.defaults, c), a = b.smoothScroll.filterPath(location.pathname);
        this.die("click.smoothscroll").live("click.smoothscroll", function (d) {
            var f = {}, j = b(this), g = location.hostname === this.hostname || !this.hostname, h = e.scrollTarget || (b.smoothScroll.filterPath(this.pathname) || a) === a, k = m(this.hash), i = true;
            if (!e.scrollTarget && (!g || !h || !k))i = false; else {
                g = e.exclude;
                h = 0;
                for (var l = g.length; i && h < l;)if (j.is(m(g[h++])))i = false;
                g = e.excludeWithin;
                h = 0;
                for (l = g.length; i && h < l;)if (j.closest(g[h++]).length)i = false
            }
            if (i) {
                d.preventDefault();
                b.extend(f, e, {scrollTarget:e.scrollTarget || k, link:this});
                b.smoothScroll(f)
            }
        });
        return this
    }});
    b.smoothScroll = function (c, e) {
        var a, d, f, j = 0;
        d = "offset";
        var g = "scrollTop", h = {}, k = false;
        f = [];
        if (typeof c === "number") {
            a = b.fn.smoothScroll.defaults;
            f = c
        } else {
            a = b.extend({}, b.fn.smoothScroll.defaults, c || {});
            if (a.scrollElement) {
                d = "position";
                a.scrollElement.css("position") == "static" && a.scrollElement.css("position", "relative")
            }
            f =
                e || b(a.scrollTarget)[d]() && b(a.scrollTarget)[d]()[a.direction] || 0
        }
        a = b.extend({link:null}, a);
        g = a.direction == "left" ? "scrollLeft" : g;
        if (a.scrollElement) {
            d = a.scrollElement;
            j = d[g]()
        } else {
            d = b("html, body").firstScrollable();
            k = o && "scrollTo"in window
        }
        h[g] = f + j + a.offset;
        a.beforeScroll.call(d, a);
        if (k) {
            f = a.direction == "left" ? [h[g], 0] : [0, h[g]];
            window.scrollTo.apply(window, f);
            a.afterScroll.call(a.link, a)
        } else d.animate(h, {duration:a.speed, easing:a.easing, complete:function () {
            a.afterScroll.call(a.link, a)
        }})
    };
    b.smoothScroll.version =
        "1.4.4";
    b.smoothScroll.filterPath = function (c) {
        return c.replace(/^\//, "").replace(/(index|default).[a-zA-Z]{3,4}$/, "").replace(/\/$/, "")
    };
    b.fn.smoothScroll.defaults = {exclude:[], excludeWithin:[], offset:0, direction:"top", scrollElement:null, scrollTarget:null, beforeScroll:function () {
    }, afterScroll:function () {
    }, easing:"swing", speed:400}
})(jQuery);

(function ($) {
    // Monkey patch jQuery 1.3.1+ css() method to support CSS 'transform'
    // property uniformly across Webkit/Safari/Chrome, Firefox 3.5+, and IE 9+.
    // 2009-2011 Zachary Johnson www.zachstronaut.com
    // Updated 2011.05.04 (May the fourth be with you!)
    function getTransformProperty(element) {
        // Try transform first for forward compatibility
        // In some versions of IE9, it is critical for msTransform to be in
        // this list before MozTranform.
        var properties = ['transform', 'WebkitTransform', 'msTransform', 'MozTransform', 'OTransform'];
        var p;
        while (p = properties.shift()) {
            if (typeof element.style[p] != 'undefined') {
                return p;
            }
        }

        // Default to transform also
        return 'transform';
    }

    var _propsObj = null;

    var proxied = $.fn.css;
    $.fn.css = function (arg, val) {
        // Temporary solution for current 1.6.x incompatibility, while
        // preserving 1.3.x compatibility, until I can rewrite using CSS Hooks
        if (_propsObj === null) {
            if (typeof $.cssProps != 'undefined') {
                _propsObj = $.cssProps;
            }
            else if (typeof $.props != 'undefined') {
                _propsObj = $.props;
            }
            else {
                _propsObj = {}
            }
        }

        // Find the correct browser specific property and setup the mapping using
        // $.props which is used internally by jQuery.attr() when setting CSS
        // properties via either the css(name, value) or css(properties) method.
        // The problem with doing this once outside of css() method is that you
        // need a DOM node to find the right CSS property, and there is some risk
        // that somebody would call the css() method before body has loaded or any
        // DOM-is-ready events have fired.
        if
            (
            typeof _propsObj['transform'] == 'undefined'
                &&
                (
                    arg == 'transform'
                        ||
                        (
                            typeof arg == 'object'
                                && typeof arg['transform'] != 'undefined'
                            )
                    )
            ) {
            _propsObj['transform'] = getTransformProperty(this.get(0));
        }

        // We force the property mapping here because jQuery.attr() does
        // property mapping with jQuery.props when setting a CSS property,
        // but curCSS() does *not* do property mapping when *getting* a
        // CSS property.  (It probably should since it manually does it
        // for 'float' now anyway... but that'd require more testing.)
        //
        // But, only do the forced mapping if the correct CSS property
        // is not 'transform' and is something else.
        if (_propsObj['transform'] != 'transform') {
            // Call in form of css('transform' ...)
            if (arg == 'transform') {
                arg = _propsObj['transform'];

                // User wants to GET the transform CSS, and in jQuery 1.4.3
                // calls to css() for transforms return a matrix rather than
                // the actual string specified by the user... avoid that
                // behavior and return the string by calling jQuery.style()
                // directly
                if (typeof val == 'undefined' && jQuery.style) {
                    return jQuery.style(this.get(0), arg);
                }
            }

            // Call in form of css({'transform': ...})
            else if
                (
                typeof arg == 'object'
                    && typeof arg['transform'] != 'undefined'
                ) {
                arg[_propsObj['transform']] = arg['transform'];
                delete arg['transform'];
            }
        }

        return proxied.apply(this, arguments);
    };
})(jQuery);

(function ($) {
    // Monkey patch jQuery 1.3.1+ to add support for setting or animating CSS
    // scale and rotation independently.
    // 2009-2010 Zachary Johnson www.zachstronaut.com
    // Updated 2010.11.06
    var rotateUnits = 'deg';

    $.fn.rotate = function (val) {
        var style = $(this).css('transform') || 'none';

        if (typeof val == 'undefined') {
            if (style) {
                var m = style.match(/rotate\(([^)]+)\)/);
                if (m && m[1]) {
                    return m[1];
                }
            }

            return 0;
        }

        var m = val.toString().match(/^(-?\d+(\.\d+)?)(.+)?$/);
        if (m) {
            if (m[3]) {
                rotateUnits = m[3];
            }

            $(this).css(
                'transform',
                style.replace(/none|rotate\([^)]*\)/, '') + 'rotate(' + m[1] + rotateUnits + ')'
            );
        }

        return this;
    }

    // Note that scale is unitless.
    $.fn.scale = function (val, duration, options) {
        var style = $(this).css('transform');

        if (typeof val == 'undefined') {
            if (style) {
                var m = style.match(/scale\(([^)]+)\)/);
                if (m && m[1]) {
                    return m[1];
                }
            }

            return 1;
        }

        $(this).css(
            'transform',
            style.replace(/none|scale\([^)]*\)/, '') + 'scale(' + val + ')'
        );

        return this;
    }

    // fx.cur() must be monkey patched because otherwise it would always
    // return 0 for current rotate and scale values
    var curProxied = $.fx.prototype.cur;
    $.fx.prototype.cur = function () {
        if (this.prop == 'rotate') {
            return parseFloat($(this.elem).rotate());
        }
        else if (this.prop == 'scale') {
            return parseFloat($(this.elem).scale());
        }

        return curProxied.apply(this, arguments);
    }

    $.fx.step.rotate = function (fx) {
        $(fx.elem).rotate(fx.now + rotateUnits);
    }

    $.fx.step.scale = function (fx) {
        $(fx.elem).scale(fx.now);
    }

    /*

     Starting on line 3905 of jquery-1.3.2.js we have this code:

     // We need to compute starting value
     if ( unit != "px" ) {
     self.style[ name ] = (end || 1) + unit;
     start = ((end || 1) / e.cur(true)) * start;
     self.style[ name ] = start + unit;
     }

     This creates a problem where we cannot give units to our custom animation
     because if we do then this code will execute and because self.style[name]
     does not exist where name is our custom animation's name then e.cur(true)
     will likely return zero and create a divide by zero bug which will set
     start to NaN.

     The following monkey patch for animate() gets around this by storing the
     units used in the rotation definition and then stripping the units off.

     */

    var animateProxied = $.fn.animate;
    $.fn.animate = function (prop) {
        if (typeof prop['rotate'] != 'undefined') {
            var m = prop['rotate'].toString().match(/^(([+-]=)?(-?\d+(\.\d+)?))(.+)?$/);
            if (m && m[5]) {
                rotateUnits = m[5];
            }

            prop['rotate'] = m[1];
        }

        return animateProxied.apply(this, arguments);
    }
})(jQuery);

/**
 * jCarouselLite - jQuery plugin to navigate images/any content in a carousel style widget.
 * @requires jQuery v1.2 or above
 *
 * http://gmarwaha.com/jquery/jcarousellite/
 *
 * Copyright (c) 2007 Ganeshji Marwaha (gmarwaha.com)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Version: 1.0.1
 * Note: Requires jquery 1.2 or above from version 1.0.1
 */

/**
 * Creates a carousel-style navigation widget for images/any-content from a simple HTML markup.
 *
 * The HTML markup that is used to build the carousel can be as simple as...
 *
 *  <div class="carousel">
 *      <ul>
 *          <li><img src="image/1.jpg" alt="1"></li>
 *          <li><img src="image/2.jpg" alt="2"></li>
 *          <li><img src="image/3.jpg" alt="3"></li>
 *      </ul>
 *  </div>
 *
 * As you can see, this snippet is nothing but a simple div containing an unordered list of images.
 * You don't need any special "class" attribute, or a special "css" file for this plugin.
 * I am using a class attribute just for the sake of explanation here.
 *
 * To navigate the elements of the carousel, you need some kind of navigation buttons.
 * For example, you will need a "previous" button to go backward, and a "next" button to go forward.
 * This need not be part of the carousel "div" itself. It can be any element in your page.
 * Lets assume that the following elements in your document can be used as next, and prev buttons...
 *
 * <button class="prev">&lt;&lt;</button>
 * <button class="next">&gt;&gt;</button>
 *
 * Now, all you need to do is call the carousel component on the div element that represents it, and pass in the
 * navigation buttons as options.
 *
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev"
 * });
 *
 * That's it, you would have now converted your raw div, into a magnificient carousel.
 *
 * There are quite a few other options that you can use to customize it though.
 * Each will be explained with an example below.
 *
 * @param an options object - You can specify all the options shown below as an options object param.
 *
 * @option btnPrev, btnNext : string - no defaults
 * @example
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev"
 * });
 * @desc Creates a basic carousel. Clicking "btnPrev" navigates backwards and "btnNext" navigates forward.
 *
 * @option btnGo - array - no defaults
 * @example
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev",
 *      btnGo: [".0", ".1", ".2"]
 * });
 * @desc If you don't want next and previous buttons for navigation, instead you prefer custom navigation based on
 * the item number within the carousel, you can use this option. Just supply an array of selectors for each element
 * in the carousel. The index of the array represents the index of the element. What i mean is, if the
 * first element in the array is ".0", it means that when the element represented by ".0" is clicked, the carousel
 * will slide to the first element and so on and so forth. This feature is very powerful. For example, i made a tabbed
 * interface out of it by making my navigation elements styled like tabs in css. As the carousel is capable of holding
 * any content, not just images, you can have a very simple tabbed navigation in minutes without using any other plugin.
 * The best part is that, the tab will "slide" based on the provided effect. :-)
 *
 * @option mouseWheel : boolean - default is false
 * @example
 * $(".carousel").jCarouselLite({
 *      mouseWheel: true
 * });
 * @desc The carousel can also be navigated using the mouse wheel interface of a scroll mouse instead of using buttons.
 * To get this feature working, you have to do 2 things. First, you have to include the mouse-wheel plugin from brandon.
 * Second, you will have to set the option "mouseWheel" to true. That's it, now you will be able to navigate your carousel
 * using the mouse wheel. Using buttons and mouseWheel or not mutually exclusive. You can still have buttons for navigation
 * as well. They complement each other. To use both together, just supply the options required for both as shown below.
 * @example
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev",
 *      mouseWheel: true
 * });
 *
 * @option auto : number - default is null, meaning autoscroll is disabled by default
 * @example
 * $(".carousel").jCarouselLite({
 *      auto: 800,
 *      speed: 500
 * });
 * @desc You can make your carousel auto-navigate itself by specfying a millisecond value in this option.
 * The value you specify is the amount of time between 2 slides. The default is null, and that disables auto scrolling.
 * Specify this value and magically your carousel will start auto scrolling.
 *
 * @option speed : number - 200 is default
 * @example
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev",
 *      speed: 800
 * });
 * @desc Specifying a speed will slow-down or speed-up the sliding speed of your carousel. Try it out with
 * different speeds like 800, 600, 1500 etc. Providing 0, will remove the slide effect.
 *
 * @option easing : string - no easing effects by default.
 * @example
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev",
 *      easing: "bounceout"
 * });
 * @desc You can specify any easing effect. Note: You need easing plugin for that. Once specified,
 * the carousel will slide based on the provided easing effect.
 *
 * @option vertical : boolean - default is false
 * @example
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev",
 *      vertical: true
 * });
 * @desc Determines the direction of the carousel. true, means the carousel will display vertically. The next and
 * prev buttons will slide the items vertically as well. The default is false, which means that the carousel will
 * display horizontally. The next and prev items will slide the items from left-right in this case.
 *
 * @option circular : boolean - default is true
 * @example
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev",
 *      circular: false
 * });
 * @desc Setting it to true enables circular navigation. This means, if you click "next" after you reach the last
 * element, you will automatically slide to the first element and vice versa. If you set circular to false, then
 * if you click on the "next" button after you reach the last element, you will stay in the last element itself
 * and similarly for "previous" button and first element.
 *
 * @option visible : number - default is 3
 * @example
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev",
 *      visible: 4
 * });
 * @desc This specifies the number of items visible at all times within the carousel. The default is 3.
 * You are even free to experiment with real numbers. Eg: "3.5" will have 3 items fully visible and the
 * last item half visible. This gives you the effect of showing the user that there are more images to the right.
 *
 * @option start : number - default is 0
 * @example
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev",
 *      start: 2
 * });
 * @desc You can specify from which item the carousel should start. Remember, the first item in the carousel
 * has a start of 0, and so on.
 *
 * @option scrool : number - default is 1
 * @example
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev",
 *      scroll: 2
 * });
 * @desc The number of items that should scroll/slide when you click the next/prev navigation buttons. By
 * default, only one item is scrolled, but you may set it to any number. Eg: setting it to "2" will scroll
 * 2 items when you click the next or previous buttons.
 *
 * @option beforeStart, afterEnd : function - callbacks
 * @example
 * $(".carousel").jCarouselLite({
 *      btnNext: ".next",
 *      btnPrev: ".prev",
 *      beforeStart: function(a) {
 *          alert("Before animation starts:" + a);
 *      },
 *      afterEnd: function(a) {
 *          alert("After animation ends:" + a);
 *      }
 * });
 * @desc If you wanted to do some logic in your page before the slide starts and after the slide ends, you can
 * register these 2 callbacks. The functions will be passed an argument that represents an array of elements that
 * are visible at the time of callback.
 *
 *
 * @cat Plugins/Image Gallery
 * @author Ganeshji Marwaha/ganeshread@gmail.com
 */
function max_height(el) {
    // Adapted 25/09/2011 - Tony Bolton - Return height of the largest item..
    var _height = 0;

    $.each(el, function () {
        var _compHeight = $(this).height();

        if (_compHeight > _height) {
            _height = _compHeight;
        }
    });

    return parseInt(_height);
}
;

(function ($) {                                          // Compliant with jquery.noConflict()
    $.fn.jCarouselLite = function (o) {
        o = $.extend({
            btnPrev:null,
            btnNext:null,
            btnGo:null,
            mouseWheel:false,
            auto:null,

            speed:200,
            easing:null,

            vertical:false,
            circular:true,
            visible:3,
            start:0,
            scroll:1,

            beforeStart:null,
            afterEnd:null
        }, o || {});

        return this.each(function () {                           // Returns the element collection. Chainable.

            var running = false, animCss = o.vertical ? "top" : "left", sizeCss = o.vertical ? "height" : "width";
            var div = $(this), ul = $("> ul", div), tLi = $("> ul > li", div), tl = tLi.size(), v = o.visible;

            if (o.circular) {
                ul.prepend(tLi.slice(tl - v - 1 + 1).clone())
                    .append(tLi.slice(0, v).clone());
                o.start += v;
            }

            var li = $("> li", ul), itemLength = li.size(), curr = o.start;
            div.css("visibility", "visible");

            li.css({ float:o.vertical ? "none" : "left"});
            ul.css({margin:"0", padding:"0", position:"relative", "list-style-type":"none", "z-index":"1"});
            div.css({overflow:"hidden", position:"relative", "z-index":"2", left:"0px"});

            var liSize = o.vertical ? height(li) : width(li);   // Full li size(incl margin)-Used for animation
            var ulSize = liSize * itemLength;                   // size of full ul(total length, not just for the visible items)
            var divSize = liSize * v;                           // size of entire div(total length for just the visible items)

            li.css({ width:'auto', height:'auto' });
            ul.css(sizeCss, ulSize + "px").css(animCss, -(curr * liSize));

            div.css(sizeCss, divSize + "px");                     // Width of the DIV. length of visible images

            if (o.btnPrev) {
                $(o.btnPrev).unbind("click");
                $(o.btnPrev).click(function () {
                    return go(curr - o.scroll);
                });
            }

            if (o.btnNext) {
                $(o.btnNext).unbind("click");
                $(o.btnNext).click(function () {
                    return go(curr + o.scroll);
                });
            }

            if (o.btnGo)
                $.each(o.btnGo, function (i, val) {
                    $(val).unbind("click");
                    $(val).click(function () {
                        return go(o.circular ? o.visible + i : i);
                    });
                });

            if (o.mouseWheel && div.mousewheel)
                div.mousewheel(function (e, d) {
                    return d > 0 ? go(curr - o.scroll) : go(curr + o.scroll);
                });

            if (o.auto)
                setInterval(function () {
                    go(curr + o.scroll);
                }, o.auto + o.speed);

            function vis() {
                return li.slice(curr).slice(0, v);
            }

            ;

            function go(to) {
                if (!running) {

                    if (o.beforeStart)
                        o.beforeStart.call(this, vis());

                    if (o.circular) {            // If circular we are in first or last, then goto the other end
                        if (to <= o.start - v - 1) {           // If first, then goto last
                            ul.css(animCss, -((itemLength - (v * 2)) * liSize) + "px");
                            // If "scroll" > 1, then the "to" might not be equal to the condition; it can be lesser depending on the number of elements.
                            curr = to == o.start - v - 1 ? itemLength - (v * 2) - 1 : itemLength - (v * 2) - o.scroll;
                        } else if (to >= itemLength - v + 1) { // If last, then goto first
                            ul.css(animCss, -( (v) * liSize ) + "px");
                            // If "scroll" > 1, then the "to" might not be equal to the condition; it can be greater depending on the number of elements.
                            curr = to == itemLength - v + 1 ? v + 1 : v + o.scroll;
                        } else curr = to;
                    } else {                    // If non-circular and to points to first or last, we just return.
                        if (to < 0 || to > itemLength - v) return;
                        else curr = to;
                    }                           // If neither overrides it, the curr will still be "to" and we can proceed.

                    running = true;

                    ul.animate(
                        animCss == "left" ? { left:-(curr * liSize) } : { top:-(curr * liSize) }, o.speed, o.easing,
                        function () {
                            if (o.afterEnd)
                                o.afterEnd.call(this, vis());
                            running = false;
                        }
                    );
                    // Disable buttons when the carousel reaches the last/first, and enable when not
                    if (!o.circular) {
                        $(o.btnPrev + "," + o.btnNext).removeClass("disabled");
                        $((curr - o.scroll < 0 && o.btnPrev)
                            ||
                            (curr + o.scroll > itemLength - v && o.btnNext)
                            ||
                            []
                        ).addClass("disabled");
                    }

                }
                return false;
            }

            ;
        });
    };

    function css(el, prop) {
        return parseInt($.css(el[0], prop)) || 0;
    }

    ;
    function width(el) {
        return  el[0].offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
    }

    ;
    function height(el) {
        return el[0].offsetHeight + css(el, 'marginTop') + css(el, 'marginBottom');
    }

    ;

})(jQuery);

/**
 * jQuery Plugin to obtain touch gestures from iPhone, iPod Touch and iPad, should also work with Android mobile phones (not tested yet!)
 * Common usage: wipe images (left and right to show the previous or next image)
 *
 * @author Andreas Waltl, netCU Internetagentur (http://www.netcu.de)
 * @version 1.1.1 (9th December 2010) - fix bug (older IE's had problems)
 * @version 1.1 (1st September 2010) - support wipe up and wipe down
 * @version 1.0 (15th July 2010)
 */
(function ($) {
    $.fn.touchwipe = function (settings) {
        var config = {
            min_move_x:20,
            min_move_y:20,
            wipeLeft:function () {
            },
            wipeRight:function () {
            },
            wipeUp:function () {
            },
            wipeDown:function () {
            },
            preventDefaultEvents:true
        };

        if (settings) $.extend(config, settings);

        this.each(function () {
            var startX;
            var startY;
            var isMoving = false;

            function cancelTouch() {
                this.removeEventListener('touchmove', onTouchMove);
                startX = null;
                isMoving = false;
            }

            function onTouchMove(e) {
                if (config.preventDefaultEvents) {
                    e.preventDefault();
                }
                if (isMoving) {
                    var x = e.touches[0].pageX;
                    var y = e.touches[0].pageY;
                    var dx = startX - x;
                    var dy = startY - y;
                    if (Math.abs(dx) >= config.min_move_x) {
                        cancelTouch();
                        e.preventDefault();
                        if (dx > 0) {
                            config.wipeLeft();
                        }
                        else {
                            config.wipeRight();
                        }
                    }
                    else if (Math.abs(dy) >= config.min_move_y) {
                        cancelTouch();
                        if (dy > 0) {
                            config.wipeDown();
                        }
                        else {
                            config.wipeUp();
                        }

                    }
                }
            }

            function onTouchStart(e) {
                if (e.touches.length == 1) {
                    startX = e.touches[0].pageX;
                    startY = e.touches[0].pageY;
                    isMoving = true;
                    this.addEventListener('touchmove', onTouchMove, false);
                }
            }

            if ('ontouchstart' in document.documentElement) {
                this.addEventListener('touchstart', onTouchStart, false);
            }
        });

        return this;
    };

})(jQuery);


/**
 * jQuery gMap - Google Maps API V3
 *
 * @url        http://github.com/marioestrada/jQuery-gMap
 * @author    Cedric Kastner <cedric@nur-text.de> and Mario Estrada <me@mario.ec>
 * @version    2.1
 */(function (a) {
    a.fn.gMap = function (b, c) {
        switch (b) {
            case"addMarker":
                return a(this).trigger("gMap.addMarker", [c.latitude, c.longitude, c.content, c.icon, c.popup]);
            case"centerAt":
                return a(this).trigger("gMap.centerAt", [c.latitude, c.longitude, c.zoom])
        }
        opts = a.extend({}, a.fn.gMap.defaults, b);
        return this.each(function () {
            var b = new google.maps.Map(this);
            $geocoder = new google.maps.Geocoder, opts.address ? $geocoder.geocode({address:opts.address}, function (a, c) {
                a.length > 0 && b.setCenter(a[0].geometry.location)
            }) : opts.latitude && opts.longitude ? b.setCenter(new google.maps.LatLng(opts.latitude, opts.longitude)) : a.isArray(opts.markers) && opts.markers.length > 0 ? opts.markers[0].address ? $geocoder.geocode({address:opts.markers[0].address}, function (a, c) {
                a.length > 0 && b.setCenter(a[0].geometry.location)
            }) : b.setCenter(new google.maps.LatLng(opts.markers[0].latitude, opts.markers[0].longitude)) : b.setCenter(new google.maps.LatLng(34.885931, 9.84375)), b.setZoom(opts.zoom), b.setMapTypeId(google.maps.MapTypeId[opts.maptype]), map_options = {scrollwheel:opts.scrollwheel}, opts.controls === !1 ? a.extend(map_options, {disableDefaultUI:!0}) : opts.controls.length != 0 && a.extend(map_options, opts.controls, {disableDefaultUI:!0}), b.setOptions(map_options);
            var c = new google.maps.Marker;
            marker_icon = new google.maps.MarkerImage(opts.icon.image), marker_icon.size = new google.maps.Size(opts.icon.iconsize[0], opts.icon.iconsize[1]), marker_icon.anchor = new google.maps.Point(opts.icon.iconanchor[0], opts.icon.iconanchor[1]), c.setIcon(marker_icon), opts.icon.shadow && (marker_shadow = new google.maps.MarkerImage(opts.icon.shadow), marker_shadow.size = new google.maps.Size(opts.icon.shadowsize[0], opts.icon.shadowsize[1]), marker_shadow.anchor = new google.maps.Point(opts.icon.shadowanchor[0], opts.icon.shadowanchor[1]), c.setShadow(marker_shadow)), a(this).bind("gMap.centerAt", function (a, c, d, e) {
                e && b.setZoom(e), b.panTo(new google.maps.LatLng(parseFloat(c), parseFloat(d)))
            });
            var d;
            a(this).bind("gMap.addMarker", function (a, e, f, g, h, i) {
                var j = new google.maps.LatLng(parseFloat(e), parseFloat(f)), k = new google.maps.Marker({position:j});
                h ? (marker_icon = new google.maps.MarkerImage(h.image), marker_icon.size = new google.maps.Size(h.iconsize[0], h.iconsize[1]), marker_icon.anchor = new google.maps.Point(h.iconanchor[0], h.iconanchor[1]), k.setIcon(marker_icon), h.shadow && (marker_shadow = new google.maps.MarkerImage(h.shadow), marker_shadow.size = new google.maps.Size(h.shadowsize[0], h.shadowsize[1]), marker_shadow.anchor = new google.maps.Point(h.shadowanchor[0], h.shadowanchor[1]), c.setShadow(marker_shadow))) : (k.setIcon(c.getIcon()), k.setShadow(c.getShadow()));
                if (g) {
                    g == "_latlng" && (g = e + ", " + f);
                    var l = new google.maps.InfoWindow({content:opts.html_prepend + g + opts.html_append});
                    google.maps.event.addListener(k, "click", function () {
                        d && d.close(), l.open(b, k), d = l
                    }), i && l.open(b, k)
                }
                k.setMap(b)
            });
            for (var e = 0; e < opts.markers.length; e++) {
                marker = opts.markers[e];
                if (marker.address) {
                    marker.html == "_address" && (marker.html = marker.address);
                    var f = this;
                    $geocoder.geocode({address:marker.address}, function (b, c) {
                        return function (d, e) {
                            d.length > 0 && a(c).trigger("gMap.addMarker", [d[0].geometry.location.lat(), d[0].geometry.location.lng(), b.html, b.icon])
                        }
                    }(marker, f))
                } else a(this).trigger("gMap.addMarker", [marker.latitude, marker.longitude, marker.html, marker.icon])
            }
        })
    }, a.fn.gMap.defaults = {address:"", latitude:0, longitude:0, zoom:1, markers:[], controls:[], scrollwheel:!1, maptype:"ROADMAP", html_prepend:'<div class="gmap_marker">', html_append:"</div>", icon:{image:"http://www.google.com/mapfiles/marker.png", shadow:"http://www.google.com/mapfiles/shadow50.png", iconsize:[20, 34], shadowsize:[37, 34], iconanchor:[9, 34], shadowanchor:[6, 34]}}
})(jQuery)

// Prettify JS
var q = null;
window.PR_SHOULD_USE_CONTINUATION = !0;
(function () {
    function L(a) {
        function m(a) {
            var f = a.charCodeAt(0);
            if (f !== 92)return f;
            var b = a.charAt(1);
            return(f = r[b]) ? f : "0" <= b && b <= "7" ? parseInt(a.substring(1), 8) : b === "u" || b === "x" ? parseInt(a.substring(2), 16) : a.charCodeAt(1)
        }

        function e(a) {
            if (a < 32)return(a < 16 ? "\\x0" : "\\x") + a.toString(16);
            a = String.fromCharCode(a);
            if (a === "\\" || a === "-" || a === "[" || a === "]")a = "\\" + a;
            return a
        }

        function h(a) {
            for (var f = a.substring(1, a.length - 1).match(/\\u[\dA-Fa-f]{4}|\\x[\dA-Fa-f]{2}|\\[0-3][0-7]{0,2}|\\[0-7]{1,2}|\\[\S\s]|[^\\]/g), a =
                [], b = [], o = f[0] === "^", c = o ? 1 : 0, i = f.length; c < i; ++c) {
                var j = f[c];
                if (/\\[bdsw]/i.test(j))a.push(j); else {
                    var j = m(j), d;
                    c + 2 < i && "-" === f[c + 1] ? (d = m(f[c + 2]), c += 2) : d = j;
                    b.push([j, d]);
                    d < 65 || j > 122 || (d < 65 || j > 90 || b.push([Math.max(65, j) | 32, Math.min(d, 90) | 32]), d < 97 || j > 122 || b.push([Math.max(97, j) & -33, Math.min(d, 122) & -33]))
                }
            }
            b.sort(function (a, f) {
                return a[0] - f[0] || f[1] - a[1]
            });
            f = [];
            j = [NaN, NaN];
            for (c = 0; c < b.length; ++c)i = b[c], i[0] <= j[1] + 1 ? j[1] = Math.max(j[1], i[1]) : f.push(j = i);
            b = ["["];
            o && b.push("^");
            b.push.apply(b, a);
            for (c = 0; c <
                f.length; ++c)i = f[c], b.push(e(i[0])), i[1] > i[0] && (i[1] + 1 > i[0] && b.push("-"), b.push(e(i[1])));
            b.push("]");
            return b.join("")
        }

        function y(a) {
            for (var f = a.source.match(/\[(?:[^\\\]]|\\[\S\s])*]|\\u[\dA-Fa-f]{4}|\\x[\dA-Fa-f]{2}|\\\d+|\\[^\dux]|\(\?[!:=]|[()^]|[^()[\\^]+/g), b = f.length, d = [], c = 0, i = 0; c < b; ++c) {
                var j = f[c];
                j === "(" ? ++i : "\\" === j.charAt(0) && (j = +j.substring(1)) && j <= i && (d[j] = -1)
            }
            for (c = 1; c < d.length; ++c)-1 === d[c] && (d[c] = ++t);
            for (i = c = 0; c < b; ++c)j = f[c], j === "(" ? (++i, d[i] === void 0 && (f[c] = "(?:")) : "\\" === j.charAt(0) &&
                (j = +j.substring(1)) && j <= i && (f[c] = "\\" + d[i]);
            for (i = c = 0; c < b; ++c)"^" === f[c] && "^" !== f[c + 1] && (f[c] = "");
            if (a.ignoreCase && s)for (c = 0; c < b; ++c)j = f[c], a = j.charAt(0), j.length >= 2 && a === "[" ? f[c] = h(j) : a !== "\\" && (f[c] = j.replace(/[A-Za-z]/g, function (a) {
                a = a.charCodeAt(0);
                return"[" + String.fromCharCode(a & -33, a | 32) + "]"
            }));
            return f.join("")
        }

        for (var t = 0, s = !1, l = !1, p = 0, d = a.length; p < d; ++p) {
            var g = a[p];
            if (g.ignoreCase)l = !0; else if (/[a-z]/i.test(g.source.replace(/\\u[\da-f]{4}|\\x[\da-f]{2}|\\[^UXux]/gi, ""))) {
                s = !0;
                l = !1;
                break
            }
        }
        for (var r =
        {b:8, t:9, n:10, v:11, f:12, r:13}, n = [], p = 0, d = a.length; p < d; ++p) {
            g = a[p];
            if (g.global || g.multiline)throw Error("" + g);
            n.push("(?:" + y(g) + ")")
        }
        return RegExp(n.join("|"), l ? "gi" : "g")
    }

    function M(a) {
        function m(a) {
            switch (a.nodeType) {
                case 1:
                    if (e.test(a.className))break;
                    for (var g = a.firstChild; g; g = g.nextSibling)m(g);
                    g = a.nodeName;
                    if ("BR" === g || "LI" === g)h[s] = "\n", t[s << 1] = y++, t[s++ << 1 | 1] = a;
                    break;
                case 3:
                case 4:
                    g = a.nodeValue, g.length && (g = p ? g.replace(/\r\n?/g, "\n") : g.replace(/[\t\n\r ]+/g, " "), h[s] = g, t[s << 1] = y, y += g.length,
                        t[s++ << 1 | 1] = a)
            }
        }

        var e = /(?:^|\s)nocode(?:\s|$)/, h = [], y = 0, t = [], s = 0, l;
        a.currentStyle ? l = a.currentStyle.whiteSpace : window.getComputedStyle && (l = document.defaultView.getComputedStyle(a, q).getPropertyValue("white-space"));
        var p = l && "pre" === l.substring(0, 3);
        m(a);
        return{a:h.join("").replace(/\n$/, ""), c:t}
    }

    function B(a, m, e, h) {
        m && (a = {a:m, d:a}, e(a), h.push.apply(h, a.e))
    }

    function x(a, m) {
        function e(a) {
            for (var l = a.d, p = [l, "pln"], d = 0, g = a.a.match(y) || [], r = {}, n = 0, z = g.length; n < z; ++n) {
                var f = g[n], b = r[f], o = void 0, c;
                if (typeof b ===
                    "string")c = !1; else {
                    var i = h[f.charAt(0)];
                    if (i)o = f.match(i[1]), b = i[0]; else {
                        for (c = 0; c < t; ++c)if (i = m[c], o = f.match(i[1])) {
                            b = i[0];
                            break
                        }
                        o || (b = "pln")
                    }
                    if ((c = b.length >= 5 && "lang-" === b.substring(0, 5)) && !(o && typeof o[1] === "string"))c = !1, b = "src";
                    c || (r[f] = b)
                }
                i = d;
                d += f.length;
                if (c) {
                    c = o[1];
                    var j = f.indexOf(c), k = j + c.length;
                    o[2] && (k = f.length - o[2].length, j = k - c.length);
                    b = b.substring(5);
                    B(l + i, f.substring(0, j), e, p);
                    B(l + i + j, c, C(b, c), p);
                    B(l + i + k, f.substring(k), e, p)
                } else p.push(l + i, b)
            }
            a.e = p
        }

        var h = {}, y;
        (function () {
            for (var e = a.concat(m), l = [], p = {}, d = 0, g = e.length; d < g; ++d) {
                var r = e[d], n = r[3];
                if (n)for (var k = n.length; --k >= 0;)h[n.charAt(k)] = r;
                r = r[1];
                n = "" + r;
                p.hasOwnProperty(n) || (l.push(r), p[n] = q)
            }
            l.push(/[\S\s]/);
            y = L(l)
        })();
        var t = m.length;
        return e
    }

    function u(a) {
        var m = [], e = [];
        a.tripleQuotedStrings ? m.push(["str", /^(?:'''(?:[^'\\]|\\[\S\s]|''?(?=[^']))*(?:'''|$)|"""(?:[^"\\]|\\[\S\s]|""?(?=[^"]))*(?:"""|$)|'(?:[^'\\]|\\[\S\s])*(?:'|$)|"(?:[^"\\]|\\[\S\s])*(?:"|$))/, q, "'\""]) : a.multiLineStrings ? m.push(["str", /^(?:'(?:[^'\\]|\\[\S\s])*(?:'|$)|"(?:[^"\\]|\\[\S\s])*(?:"|$)|`(?:[^\\`]|\\[\S\s])*(?:`|$))/,
            q, "'\"`"]) : m.push(["str", /^(?:'(?:[^\n\r'\\]|\\.)*(?:'|$)|"(?:[^\n\r"\\]|\\.)*(?:"|$))/, q, "\"'"]);
        a.verbatimStrings && e.push(["str", /^@"(?:[^"]|"")*(?:"|$)/, q]);
        var h = a.hashComments;
        h && (a.cStyleComments ? (h > 1 ? m.push(["com", /^#(?:##(?:[^#]|#(?!##))*(?:###|$)|.*)/, q, "#"]) : m.push(["com", /^#(?:(?:define|elif|else|endif|error|ifdef|include|ifndef|line|pragma|undef|warning)\b|[^\n\r]*)/, q, "#"]), e.push(["str", /^<(?:(?:(?:\.\.\/)*|\/?)(?:[\w-]+(?:\/[\w-]+)+)?[\w-]+\.h|[a-z]\w*)>/, q])) : m.push(["com", /^#[^\n\r]*/,
            q, "#"]));
        a.cStyleComments && (e.push(["com", /^\/\/[^\n\r]*/, q]), e.push(["com", /^\/\*[\S\s]*?(?:\*\/|$)/, q]));
        a.regexLiterals && e.push(["lang-regex", /^(?:^^\.?|[!+-]|!=|!==|#|%|%=|&|&&|&&=|&=|\(|\*|\*=|\+=|,|-=|->|\/|\/=|:|::|;|<|<<|<<=|<=|=|==|===|>|>=|>>|>>=|>>>|>>>=|[?@[^]|\^=|\^\^|\^\^=|{|\||\|=|\|\||\|\|=|~|break|case|continue|delete|do|else|finally|instanceof|return|throw|try|typeof)\s*(\/(?=[^*/])(?:[^/[\\]|\\[\S\s]|\[(?:[^\\\]]|\\[\S\s])*(?:]|$))+\/)/]);
        (h = a.types) && e.push(["typ", h]);
        a = ("" + a.keywords).replace(/^ | $/g,
            "");
        a.length && e.push(["kwd", RegExp("^(?:" + a.replace(/[\s,]+/g, "|") + ")\\b"), q]);
        m.push(["pln", /^\s+/, q, " \r\n\t\xa0"]);
        e.push(["lit", /^@[$_a-z][\w$@]*/i, q], ["typ", /^(?:[@_]?[A-Z]+[a-z][\w$@]*|\w+_t\b)/, q], ["pln", /^[$_a-z][\w$@]*/i, q], ["lit", /^(?:0x[\da-f]+|(?:\d(?:_\d+)*\d*(?:\.\d*)?|\.\d\+)(?:e[+-]?\d+)?)[a-z]*/i, q, "0123456789"], ["pln", /^\\[\S\s]?/, q], ["pun", /^.[^\s\w"-$'./@\\`]*/, q]);
        return x(m, e)
    }

    function D(a, m) {
        function e(a) {
            switch (a.nodeType) {
                case 1:
                    if (k.test(a.className))break;
                    if ("BR" === a.nodeName)h(a),
                        a.parentNode && a.parentNode.removeChild(a); else for (a = a.firstChild; a; a = a.nextSibling)e(a);
                    break;
                case 3:
                case 4:
                    if (p) {
                        var b = a.nodeValue, d = b.match(t);
                        if (d) {
                            var c = b.substring(0, d.index);
                            a.nodeValue = c;
                            (b = b.substring(d.index + d[0].length)) && a.parentNode.insertBefore(s.createTextNode(b), a.nextSibling);
                            h(a);
                            c || a.parentNode.removeChild(a)
                        }
                    }
            }
        }

        function h(a) {
            function b(a, d) {
                var e = d ? a.cloneNode(!1) : a, f = a.parentNode;
                if (f) {
                    var f = b(f, 1), g = a.nextSibling;
                    f.appendChild(e);
                    for (var h = g; h; h = g)g = h.nextSibling, f.appendChild(h)
                }
                return e
            }

            for (; !a.nextSibling;)if (a = a.parentNode, !a)return;
            for (var a = b(a.nextSibling, 0), e; (e = a.parentNode) && e.nodeType === 1;)a = e;
            d.push(a)
        }

        var k = /(?:^|\s)nocode(?:\s|$)/, t = /\r\n?|\n/, s = a.ownerDocument, l;
        a.currentStyle ? l = a.currentStyle.whiteSpace : window.getComputedStyle && (l = s.defaultView.getComputedStyle(a, q).getPropertyValue("white-space"));
        var p = l && "pre" === l.substring(0, 3);
        for (l = s.createElement("LI"); a.firstChild;)l.appendChild(a.firstChild);
        for (var d = [l], g = 0; g < d.length; ++g)e(d[g]);
        m === (m | 0) && d[0].setAttribute("value",
            m);
        var r = s.createElement("OL");
        r.className = "linenums";
        for (var n = Math.max(0, m - 1 | 0) || 0, g = 0, z = d.length; g < z; ++g)l = d[g], l.className = "L" + (g + n) % 10, l.firstChild || l.appendChild(s.createTextNode("\xa0")), r.appendChild(l);
        a.appendChild(r)
    }

    function k(a, m) {
        for (var e = m.length; --e >= 0;) {
            var h = m[e];
            A.hasOwnProperty(h) ? window.console && console.warn("cannot override language handler %s", h) : A[h] = a
        }
    }

    function C(a, m) {
        if (!a || !A.hasOwnProperty(a))a = /^\s*</.test(m) ? "default-markup" : "default-code";
        return A[a]
    }

    function E(a) {
        var m =
            a.g;
        try {
            var e = M(a.h), h = e.a;
            a.a = h;
            a.c = e.c;
            a.d = 0;
            C(m, h)(a);
            var k = /\bMSIE\b/.test(navigator.userAgent), m = /\n/g, t = a.a, s = t.length, e = 0, l = a.c, p = l.length, h = 0, d = a.e, g = d.length, a = 0;
            d[g] = s;
            var r, n;
            for (n = r = 0; n < g;)d[n] !== d[n + 2] ? (d[r++] = d[n++], d[r++] = d[n++]) : n += 2;
            g = r;
            for (n = r = 0; n < g;) {
                for (var z = d[n], f = d[n + 1], b = n + 2; b + 2 <= g && d[b + 1] === f;)b += 2;
                d[r++] = z;
                d[r++] = f;
                n = b
            }
            for (d.length = r; h < p;) {
                var o = l[h + 2] || s, c = d[a + 2] || s, b = Math.min(o, c), i = l[h + 1], j;
                if (i.nodeType !== 1 && (j = t.substring(e, b))) {
                    k && (j = j.replace(m, "\r"));
                    i.nodeValue =
                        j;
                    var u = i.ownerDocument, v = u.createElement("SPAN");
                    v.className = d[a + 1];
                    var x = i.parentNode;
                    x.replaceChild(v, i);
                    v.appendChild(i);
                    e < o && (l[h + 1] = i = u.createTextNode(t.substring(b, o)), x.insertBefore(i, v.nextSibling))
                }
                e = b;
                e >= o && (h += 2);
                e >= c && (a += 2)
            }
        } catch (w) {
            "console"in window && console.log(w && w.stack ? w.stack : w)
        }
    }

    var v = ["break,continue,do,else,for,if,return,while"], w = [
        [v, "auto,case,char,const,default,double,enum,extern,float,goto,int,long,register,short,signed,sizeof,static,struct,switch,typedef,union,unsigned,void,volatile"],
        "catch,class,delete,false,import,new,operator,private,protected,public,this,throw,true,try,typeof"
    ], F = [w, "alignof,align_union,asm,axiom,bool,concept,concept_map,const_cast,constexpr,decltype,dynamic_cast,explicit,export,friend,inline,late_check,mutable,namespace,nullptr,reinterpret_cast,static_assert,static_cast,template,typeid,typename,using,virtual,where"], G = [w, "abstract,boolean,byte,extends,final,finally,implements,import,instanceof,null,native,package,strictfp,super,synchronized,throws,transient"],
        H = [G, "as,base,by,checked,decimal,delegate,descending,dynamic,event,fixed,foreach,from,group,implicit,in,interface,internal,into,is,lock,object,out,override,orderby,params,partial,readonly,ref,sbyte,sealed,stackalloc,string,select,uint,ulong,unchecked,unsafe,ushort,var"], w = [w, "debugger,eval,export,function,get,null,set,undefined,var,with,Infinity,NaN"], I = [v, "and,as,assert,class,def,del,elif,except,exec,finally,from,global,import,in,is,lambda,nonlocal,not,or,pass,print,raise,try,with,yield,False,True,None"],
        J = [v, "alias,and,begin,case,class,def,defined,elsif,end,ensure,false,in,module,next,nil,not,or,redo,rescue,retry,self,super,then,true,undef,unless,until,when,yield,BEGIN,END"], v = [v, "case,done,elif,esac,eval,fi,function,in,local,set,then,until"], K = /^(DIR|FILE|vector|(de|priority_)?queue|list|stack|(const_)?iterator|(multi)?(set|map)|bitset|u?(int|float)\d*)/, N = /\S/, O = u({keywords:[F, H, w, "caller,delete,die,do,dump,elsif,eval,exit,foreach,for,goto,if,import,last,local,my,next,no,our,print,package,redo,require,sub,undef,unless,until,use,wantarray,while,BEGIN,END" +
        I, J, v], hashComments:!0, cStyleComments:!0, multiLineStrings:!0, regexLiterals:!0}), A = {};
    k(O, ["default-code"]);
    k(x([], [
        ["pln", /^[^<?]+/],
        ["dec", /^<!\w[^>]*(?:>|$)/],
        ["com", /^<\!--[\S\s]*?(?:--\>|$)/],
        ["lang-", /^<\?([\S\s]+?)(?:\?>|$)/],
        ["lang-", /^<%([\S\s]+?)(?:%>|$)/],
        ["pun", /^(?:<[%?]|[%?]>)/],
        ["lang-", /^<xmp\b[^>]*>([\S\s]+?)<\/xmp\b[^>]*>/i],
        ["lang-js", /^<script\b[^>]*>([\S\s]*?)(<\/script\b[^>]*>)/i],
        ["lang-css", /^<style\b[^>]*>([\S\s]*?)(<\/style\b[^>]*>)/i],
        ["lang-in.tag", /^(<\/?[a-z][^<>]*>)/i]
    ]),
        ["default-markup", "htm", "html", "mxml", "xhtml", "xml", "xsl"]);
    k(x([
        ["pln", /^\s+/, q, " \t\r\n"],
        ["atv", /^(?:"[^"]*"?|'[^']*'?)/, q, "\"'"]
    ], [
        ["tag", /^^<\/?[a-z](?:[\w-.:]*\w)?|\/?>$/i],
        ["atn", /^(?!style[\s=]|on)[a-z](?:[\w:-]*\w)?/i],
        ["lang-uq.val", /^=\s*([^\s"'>]*(?:[^\s"'/>]|\/(?=\s)))/],
        ["pun", /^[/<->]+/],
        ["lang-js", /^on\w+\s*=\s*"([^"]+)"/i],
        ["lang-js", /^on\w+\s*=\s*'([^']+)'/i],
        ["lang-js", /^on\w+\s*=\s*([^\s"'>]+)/i],
        ["lang-css", /^style\s*=\s*"([^"]+)"/i],
        ["lang-css", /^style\s*=\s*'([^']+)'/i],
        ["lang-css",
            /^style\s*=\s*([^\s"'>]+)/i]
    ]), ["in.tag"]);
    k(x([], [
        ["atv", /^[\S\s]+/]
    ]), ["uq.val"]);
    k(u({keywords:F, hashComments:!0, cStyleComments:!0, types:K}), ["c", "cc", "cpp", "cxx", "cyc", "m"]);
    k(u({keywords:"null,true,false"}), ["json"]);
    k(u({keywords:H, hashComments:!0, cStyleComments:!0, verbatimStrings:!0, types:K}), ["cs"]);
    k(u({keywords:G, cStyleComments:!0}), ["java"]);
    k(u({keywords:v, hashComments:!0, multiLineStrings:!0}), ["bsh", "csh", "sh"]);
    k(u({keywords:I, hashComments:!0, multiLineStrings:!0, tripleQuotedStrings:!0}),
        ["cv", "py"]);
    k(u({keywords:"caller,delete,die,do,dump,elsif,eval,exit,foreach,for,goto,if,import,last,local,my,next,no,our,print,package,redo,require,sub,undef,unless,until,use,wantarray,while,BEGIN,END", hashComments:!0, multiLineStrings:!0, regexLiterals:!0}), ["perl", "pl", "pm"]);
    k(u({keywords:J, hashComments:!0, multiLineStrings:!0, regexLiterals:!0}), ["rb"]);
    k(u({keywords:w, cStyleComments:!0, regexLiterals:!0}), ["js"]);
    k(u({keywords:"all,and,by,catch,class,else,extends,false,finally,for,if,in,is,isnt,loop,new,no,not,null,of,off,on,or,return,super,then,true,try,unless,until,when,while,yes",
        hashComments:3, cStyleComments:!0, multilineStrings:!0, tripleQuotedStrings:!0, regexLiterals:!0}), ["coffee"]);
    k(x([], [
        ["str", /^[\S\s]+/]
    ]), ["regex"]);
    window.prettyPrintOne = function (a, m, e) {
        var h = document.createElement("PRE");
        h.innerHTML = a;
        e && D(h, e);
        E({g:m, i:e, h:h});
        return h.innerHTML
    };
    window.prettyPrint = function (a) {
        function m() {
            for (var e = window.PR_SHOULD_USE_CONTINUATION ? l.now() + 250 : Infinity; p < h.length && l.now() < e; p++) {
                var n = h[p], k = n.className;
                if (k.indexOf("prettyprint") >= 0) {
                    var k = k.match(g), f, b;
                    if (b =
                        !k) {
                        b = n;
                        for (var o = void 0, c = b.firstChild; c; c = c.nextSibling)var i = c.nodeType, o = i === 1 ? o ? b : c : i === 3 ? N.test(c.nodeValue) ? b : o : o;
                        b = (f = o === b ? void 0 : o) && "CODE" === f.tagName
                    }
                    b && (k = f.className.match(g));
                    k && (k = k[1]);
                    b = !1;
                    for (o = n.parentNode; o; o = o.parentNode)if ((o.tagName === "pre" || o.tagName === "code" || o.tagName === "xmp") && o.className && o.className.indexOf("prettyprint") >= 0) {
                        b = !0;
                        break
                    }
                    b || ((b = (b = n.className.match(/\blinenums\b(?::(\d+))?/)) ? b[1] && b[1].length ? +b[1] : !0 : !1) && D(n, b), d = {g:k, h:n, i:b}, E(d))
                }
            }
            p < h.length ? setTimeout(m,
                250) : a && a()
        }

        for (var e = [document.getElementsByTagName("pre"), document.getElementsByTagName("code"), document.getElementsByTagName("xmp")], h = [], k = 0; k < e.length; ++k)for (var t = 0, s = e[k].length; t < s; ++t)h.push(e[k][t]);
        var e = q, l = Date;
        l.now || (l = {now:function () {
            return+new Date
        }});
        var p = 0, d, g = /\blang(?:uage)?-([\w.]+)(?!\S)/;
        m()
    };
    window.PR = {createSimpleLexer:x, registerLangHandler:k, sourceDecorator:u, PR_ATTRIB_NAME:"atn", PR_ATTRIB_VALUE:"atv", PR_COMMENT:"com", PR_DECLARATION:"dec", PR_KEYWORD:"kwd", PR_LITERAL:"lit",
        PR_NOCODE:"nocode", PR_PLAIN:"pln", PR_PUNCTUATION:"pun", PR_SOURCE:"src", PR_STRING:"str", PR_TAG:"tag", PR_TYPE:"typ"}
})();

/*!
 * jQuery Cycle Plugin (with Transition Definitions)
 * Examples and documentation at: http://jquery.malsup.com/cycle/
 * Copyright (c) 2007-2010 M. Alsup
 * Version: 2.9999.5 (10-APR-2012)
 * Dual licensed under the MIT and GPL licenses.
 * http://jquery.malsup.com/license.html
 * Requires: jQuery v1.3.2 or later
 */
;(function($, undefined) {
"use strict";

var ver = '2.9999.5';

// if $.support is not defined (pre jQuery 1.3) add what I need
if ($.support === undefined) {
	$.support = {
		opacity: !($.browser.msie)
	};
}

function debug(s) {
	if ($.fn.cycle.debug)
		log(s);
}
function log() {
	if (window.console && console.log)
		console.log('[cycle] ' + Array.prototype.join.call(arguments,' '));
}
$.expr[':'].paused = function(el) {
	return el.cyclePause;
};


// the options arg can be...
//   a number  - indicates an immediate transition should occur to the given slide index
//   a string  - 'pause', 'resume', 'toggle', 'next', 'prev', 'stop', 'destroy' or the name of a transition effect (ie, 'fade', 'zoom', etc)
//   an object - properties to control the slideshow
//
// the arg2 arg can be...
//   the name of an fx (only used in conjunction with a numeric value for 'options')
//   the value true (only used in first arg == 'resume') and indicates
//	 that the resume should occur immediately (not wait for next timeout)

$.fn.cycle = function(options, arg2) {
	var o = { s: this.selector, c: this.context };

	// in 1.3+ we can fix mistakes with the ready state
	if (this.length === 0 && options != 'stop') {
		if (!$.isReady && o.s) {
			log('DOM not ready, queuing slideshow');
			$(function() {
				$(o.s,o.c).cycle(options,arg2);
			});
			return this;
		}
		// is your DOM ready?  http://docs.jquery.com/Tutorials:Introducing_$(document).ready()
		log('terminating; zero elements found by selector' + ($.isReady ? '' : ' (DOM not ready)'));
		return this;
	}

	// iterate the matched nodeset
	return this.each(function() {
		var opts = handleArguments(this, options, arg2);
		if (opts === false)
			return;

		opts.updateActivePagerLink = opts.updateActivePagerLink || $.fn.cycle.updateActivePagerLink;

		// stop existing slideshow for this container (if there is one)
		if (this.cycleTimeout)
			clearTimeout(this.cycleTimeout);
		this.cycleTimeout = this.cyclePause = 0;
		this.cycleStop = 0; // issue #108

		var $cont = $(this);
		var $slides = opts.slideExpr ? $(opts.slideExpr, this) : $cont.children();
		var els = $slides.get();

		if (els.length < 2) {
			log('terminating; too few slides: ' + els.length);
			return;
		}

		var opts2 = buildOptions($cont, $slides, els, opts, o);
		if (opts2 === false)
			return;

		var startTime = opts2.continuous ? 10 : getTimeout(els[opts2.currSlide], els[opts2.nextSlide], opts2, !opts2.backwards);

		// if it's an auto slideshow, kick it off
		if (startTime) {
			startTime += (opts2.delay || 0);
			if (startTime < 10)
				startTime = 10;
			debug('first timeout: ' + startTime);
			this.cycleTimeout = setTimeout(function(){go(els,opts2,0,!opts.backwards);}, startTime);
		}
	});
};

function triggerPause(cont, byHover, onPager) {
	var opts = $(cont).data('cycle.opts');
	var paused = !!cont.cyclePause;
	if (paused && opts.paused)
		opts.paused(cont, opts, byHover, onPager);
	else if (!paused && opts.resumed)
		opts.resumed(cont, opts, byHover, onPager);
}

// process the args that were passed to the plugin fn
function handleArguments(cont, options, arg2) {
	if (cont.cycleStop === undefined)
		cont.cycleStop = 0;
	if (options === undefined || options === null)
		options = {};
	if (options.constructor == String) {
		switch(options) {
		case 'destroy':
		case 'stop':
			var opts = $(cont).data('cycle.opts');
			if (!opts)
				return false;
			cont.cycleStop++; // callbacks look for change
			if (cont.cycleTimeout)
				clearTimeout(cont.cycleTimeout);
			cont.cycleTimeout = 0;
			if (opts.elements)
				$(opts.elements).stop();
			$(cont).removeData('cycle.opts');
			if (options == 'destroy')
				destroy(cont, opts);
			return false;
		case 'toggle':
			cont.cyclePause = (cont.cyclePause === 1) ? 0 : 1;
			checkInstantResume(cont.cyclePause, arg2, cont);
			triggerPause(cont);
			return false;
		case 'pause':
			cont.cyclePause = 1;
			triggerPause(cont);
			return false;
		case 'resume':
			cont.cyclePause = 0;
			checkInstantResume(false, arg2, cont);
			triggerPause(cont);
			return false;
		case 'prev':
		case 'next':
			opts = $(cont).data('cycle.opts');
			if (!opts) {
				log('options not found, "prev/next" ignored');
				return false;
			}
			$.fn.cycle[options](opts);
			return false;
		default:
			options = { fx: options };
		}
		return options;
	}
	else if (options.constructor == Number) {
		// go to the requested slide
		var num = options;
		options = $(cont).data('cycle.opts');
		if (!options) {
			log('options not found, can not advance slide');
			return false;
		}
		if (num < 0 || num >= options.elements.length) {
			log('invalid slide index: ' + num);
			return false;
		}
		options.nextSlide = num;
		if (cont.cycleTimeout) {
			clearTimeout(cont.cycleTimeout);
			cont.cycleTimeout = 0;
		}
		if (typeof arg2 == 'string')
			options.oneTimeFx = arg2;
		go(options.elements, options, 1, num >= options.currSlide);
		return false;
	}
	return options;

	function checkInstantResume(isPaused, arg2, cont) {
		if (!isPaused && arg2 === true) { // resume now!
			var options = $(cont).data('cycle.opts');
			if (!options) {
				log('options not found, can not resume');
				return false;
			}
			if (cont.cycleTimeout) {
				clearTimeout(cont.cycleTimeout);
				cont.cycleTimeout = 0;
			}
			go(options.elements, options, 1, !options.backwards);
		}
	}
}

function removeFilter(el, opts) {
	if (!$.support.opacity && opts.cleartype && el.style.filter) {
		try { el.style.removeAttribute('filter'); }
		catch(smother) {} // handle old opera versions
	}
}

// unbind event handlers
function destroy(cont, opts) {
	if (opts.next)
		$(opts.next).unbind(opts.prevNextEvent);
	if (opts.prev)
		$(opts.prev).unbind(opts.prevNextEvent);

	if (opts.pager || opts.pagerAnchorBuilder)
		$.each(opts.pagerAnchors || [], function() {
			this.unbind().remove();
		});
	opts.pagerAnchors = null;
	$(cont).unbind('mouseenter.cycle mouseleave.cycle');
	if (opts.destroy) // callback
		opts.destroy(opts);
}

// one-time initialization
function buildOptions($cont, $slides, els, options, o) {
	var startingSlideSpecified;
	// support metadata plugin (v1.0 and v2.0)
	var opts = $.extend({}, $.fn.cycle.defaults, options || {}, $.metadata ? $cont.metadata() : $.meta ? $cont.data() : {});
	var meta = $.isFunction($cont.data) ? $cont.data(opts.metaAttr) : null;
	if (meta)
		opts = $.extend(opts, meta);
	if (opts.autostop)
		opts.countdown = opts.autostopCount || els.length;

	var cont = $cont[0];
	$cont.data('cycle.opts', opts);
	opts.$cont = $cont;
	opts.stopCount = cont.cycleStop;
	opts.elements = els;
	opts.before = opts.before ? [opts.before] : [];
	opts.after = opts.after ? [opts.after] : [];

	// push some after callbacks
	if (!$.support.opacity && opts.cleartype)
		opts.after.push(function() { removeFilter(this, opts); });
	if (opts.continuous)
		opts.after.push(function() { go(els,opts,0,!opts.backwards); });

	saveOriginalOpts(opts);

	// clearType corrections
	if (!$.support.opacity && opts.cleartype && !opts.cleartypeNoBg)
		clearTypeFix($slides);

	// container requires non-static position so that slides can be position within
	if ($cont.css('position') == 'static')
		$cont.css('position', 'relative');
	if (opts.width)
		$cont.width(opts.width);
	if (opts.height && opts.height != 'auto')
		$cont.height(opts.height);

	if (opts.startingSlide !== undefined) {
		opts.startingSlide = parseInt(opts.startingSlide,10);
		if (opts.startingSlide >= els.length || opts.startSlide < 0)
			opts.startingSlide = 0; // catch bogus input
		else
			startingSlideSpecified = true;
	}
	else if (opts.backwards)
		opts.startingSlide = els.length - 1;
	else
		opts.startingSlide = 0;

	// if random, mix up the slide array
	if (opts.random) {
		opts.randomMap = [];
		for (var i = 0; i < els.length; i++)
			opts.randomMap.push(i);
		opts.randomMap.sort(function(a,b) {return Math.random() - 0.5;});
		if (startingSlideSpecified) {
			// try to find the specified starting slide and if found set start slide index in the map accordingly
			for ( var cnt = 0; cnt < els.length; cnt++ ) {
				if ( opts.startingSlide == opts.randomMap[cnt] ) {
					opts.randomIndex = cnt;
				}
			}
		}
		else {
			opts.randomIndex = 1;
			opts.startingSlide = opts.randomMap[1];
		}
	}
	else if (opts.startingSlide >= els.length)
		opts.startingSlide = 0; // catch bogus input
	opts.currSlide = opts.startingSlide || 0;
	var first = opts.startingSlide;

	// set position and zIndex on all the slides
	$slides.css({position: 'absolute', top:0, left:0}).hide().each(function(i) {
		var z;
		if (opts.backwards)
			z = first ? i <= first ? els.length + (i-first) : first-i : els.length-i;
		else
			z = first ? i >= first ? els.length - (i-first) : first-i : els.length-i;
		$(this).css('z-index', z);
	});

	// make sure first slide is visible
	$(els[first]).css('opacity',1).show(); // opacity bit needed to handle restart use case
	removeFilter(els[first], opts);

	// stretch slides
	if (opts.fit) {
		if (!opts.aspect) {
	        if (opts.width)
	            $slides.width(opts.width);
	        if (opts.height && opts.height != 'auto')
	            $slides.height(opts.height);
		} else {
			$slides.each(function(){
				var $slide = $(this);
				var ratio = (opts.aspect === true) ? $slide.width()/$slide.height() : opts.aspect;
				if( opts.width && $slide.width() != opts.width ) {
					$slide.width( opts.width );
					$slide.height( opts.width / ratio );
				}

				if( opts.height && $slide.height() < opts.height ) {
					$slide.height( opts.height );
					$slide.width( opts.height * ratio );
				}
			});
		}
	}

	if (opts.center && ((!opts.fit) || opts.aspect)) {
		$slides.each(function(){
			var $slide = $(this);
			$slide.css({
				"margin-left": opts.width ?
					((opts.width - $slide.width()) / 2) + "px" :
					0,
				"margin-top": opts.height ?
					((opts.height - $slide.height()) / 2) + "px" :
					0
			});
		});
	}

	if (opts.center && !opts.fit && !opts.slideResize) {
		$slides.each(function(){
			var $slide = $(this);
			$slide.css({
				"margin-left": opts.width ? ((opts.width - $slide.width()) / 2) + "px" : 0,
				"margin-top": opts.height ? ((opts.height - $slide.height()) / 2) + "px" : 0
			});
		});
	}

	// stretch container
	var reshape = opts.containerResize && !$cont.innerHeight();
	if (reshape) { // do this only if container has no size http://tinyurl.com/da2oa9
		var maxw = 0, maxh = 0;
		for(var j=0; j < els.length; j++) {
			var $e = $(els[j]), e = $e[0], w = $e.outerWidth(), h = $e.outerHeight();
			if (!w) w = e.offsetWidth || e.width || $e.attr('width');
			if (!h) h = e.offsetHeight || e.height || $e.attr('height');
			maxw = w > maxw ? w : maxw;
			maxh = h > maxh ? h : maxh;
		}
		if (maxw > 0 && maxh > 0)
			$cont.css({width:maxw+'px',height:maxh+'px'});
	}

	var pauseFlag = false;  // https://github.com/malsup/cycle/issues/44
	if (opts.pause)
		$cont.bind('mouseenter.cycle', function(){
			pauseFlag = true;
			this.cyclePause++;
			triggerPause(cont, true);
		}).bind('mouseleave.cycle', function(){
				if (pauseFlag)
					this.cyclePause--;
				triggerPause(cont, true);
		});

	if (supportMultiTransitions(opts) === false)
		return false;

	// apparently a lot of people use image slideshows without height/width attributes on the images.
	// Cycle 2.50+ requires the sizing info for every slide; this block tries to deal with that.
	var requeue = false;
	options.requeueAttempts = options.requeueAttempts || 0;
	$slides.each(function() {
		// try to get height/width of each slide
		var $el = $(this);
		this.cycleH = (opts.fit && opts.height) ? opts.height : ($el.height() || this.offsetHeight || this.height || $el.attr('height') || 0);
		this.cycleW = (opts.fit && opts.width) ? opts.width : ($el.width() || this.offsetWidth || this.width || $el.attr('width') || 0);

		if ( $el.is('img') ) {
			// sigh..  sniffing, hacking, shrugging...  this crappy hack tries to account for what browsers do when
			// an image is being downloaded and the markup did not include sizing info (height/width attributes);
			// there seems to be some "default" sizes used in this situation
			var loadingIE	= ($.browser.msie  && this.cycleW == 28 && this.cycleH == 30 && !this.complete);
			var loadingFF	= ($.browser.mozilla && this.cycleW == 34 && this.cycleH == 19 && !this.complete);
			var loadingOp	= ($.browser.opera && ((this.cycleW == 42 && this.cycleH == 19) || (this.cycleW == 37 && this.cycleH == 17)) && !this.complete);
			var loadingOther = (this.cycleH === 0 && this.cycleW === 0 && !this.complete);
			// don't requeue for images that are still loading but have a valid size
			if (loadingIE || loadingFF || loadingOp || loadingOther) {
				if (o.s && opts.requeueOnImageNotLoaded && ++options.requeueAttempts < 100) { // track retry count so we don't loop forever
					log(options.requeueAttempts,' - img slide not loaded, requeuing slideshow: ', this.src, this.cycleW, this.cycleH);
					setTimeout(function() {$(o.s,o.c).cycle(options);}, opts.requeueTimeout);
					requeue = true;
					return false; // break each loop
				}
				else {
					log('could not determine size of image: '+this.src, this.cycleW, this.cycleH);
				}
			}
		}
		return true;
	});

	if (requeue)
		return false;

	opts.cssBefore = opts.cssBefore || {};
	opts.cssAfter = opts.cssAfter || {};
	opts.cssFirst = opts.cssFirst || {};
	opts.animIn = opts.animIn || {};
	opts.animOut = opts.animOut || {};

	$slides.not(':eq('+first+')').css(opts.cssBefore);
	$($slides[first]).css(opts.cssFirst);

	if (opts.timeout) {
		opts.timeout = parseInt(opts.timeout,10);
		// ensure that timeout and speed settings are sane
		if (opts.speed.constructor == String)
			opts.speed = $.fx.speeds[opts.speed] || parseInt(opts.speed,10);
		if (!opts.sync)
			opts.speed = opts.speed / 2;

		var buffer = opts.fx == 'none' ? 0 : opts.fx == 'shuffle' ? 500 : 250;
		while((opts.timeout - opts.speed) < buffer) // sanitize timeout
			opts.timeout += opts.speed;
	}
	if (opts.easing)
		opts.easeIn = opts.easeOut = opts.easing;
	if (!opts.speedIn)
		opts.speedIn = opts.speed;
	if (!opts.speedOut)
		opts.speedOut = opts.speed;

	opts.slideCount = els.length;
	opts.currSlide = opts.lastSlide = first;
	if (opts.random) {
		if (++opts.randomIndex == els.length)
			opts.randomIndex = 0;
		opts.nextSlide = opts.randomMap[opts.randomIndex];
	}
	else if (opts.backwards)
		opts.nextSlide = opts.startingSlide === 0 ? (els.length-1) : opts.startingSlide-1;
	else
		opts.nextSlide = opts.startingSlide >= (els.length-1) ? 0 : opts.startingSlide+1;

	// run transition init fn
	if (!opts.multiFx) {
		var init = $.fn.cycle.transitions[opts.fx];
		if ($.isFunction(init))
			init($cont, $slides, opts);
		else if (opts.fx != 'custom' && !opts.multiFx) {
			log('unknown transition: ' + opts.fx,'; slideshow terminating');
			return false;
		}
	}

	// fire artificial events
	var e0 = $slides[first];
	if (!opts.skipInitializationCallbacks) {
		if (opts.before.length)
			opts.before[0].apply(e0, [e0, e0, opts, true]);
		if (opts.after.length)
			opts.after[0].apply(e0, [e0, e0, opts, true]);
	}
	if (opts.next)
		$(opts.next).bind(opts.prevNextEvent,function(){return advance(opts,1);});
	if (opts.prev)
		$(opts.prev).bind(opts.prevNextEvent,function(){return advance(opts,0);});
	if (opts.pager || opts.pagerAnchorBuilder)
		buildPager(els,opts);

	exposeAddSlide(opts, els);

	return opts;
}

// save off original opts so we can restore after clearing state
function saveOriginalOpts(opts) {
	opts.original = { before: [], after: [] };
	opts.original.cssBefore = $.extend({}, opts.cssBefore);
	opts.original.cssAfter  = $.extend({}, opts.cssAfter);
	opts.original.animIn	= $.extend({}, opts.animIn);
	opts.original.animOut   = $.extend({}, opts.animOut);
	$.each(opts.before, function() { opts.original.before.push(this); });
	$.each(opts.after,  function() { opts.original.after.push(this); });
}

function supportMultiTransitions(opts) {
	var i, tx, txs = $.fn.cycle.transitions;
	// look for multiple effects
	if (opts.fx.indexOf(',') > 0) {
		opts.multiFx = true;
		opts.fxs = opts.fx.replace(/\s*/g,'').split(',');
		// discard any bogus effect names
		for (i=0; i < opts.fxs.length; i++) {
			var fx = opts.fxs[i];
			tx = txs[fx];
			if (!tx || !txs.hasOwnProperty(fx) || !$.isFunction(tx)) {
				log('discarding unknown transition: ',fx);
				opts.fxs.splice(i,1);
				i--;
			}
		}
		// if we have an empty list then we threw everything away!
		if (!opts.fxs.length) {
			log('No valid transitions named; slideshow terminating.');
			return false;
		}
	}
	else if (opts.fx == 'all') {  // auto-gen the list of transitions
		opts.multiFx = true;
		opts.fxs = [];
		for (var p in txs) {
			if (txs.hasOwnProperty(p)) {
				tx = txs[p];
				if (txs.hasOwnProperty(p) && $.isFunction(tx))
					opts.fxs.push(p);
			}
		}
	}
	if (opts.multiFx && opts.randomizeEffects) {
		// munge the fxs array to make effect selection random
		var r1 = Math.floor(Math.random() * 20) + 30;
		for (i = 0; i < r1; i++) {
			var r2 = Math.floor(Math.random() * opts.fxs.length);
			opts.fxs.push(opts.fxs.splice(r2,1)[0]);
		}
		debug('randomized fx sequence: ',opts.fxs);
	}
	return true;
}

// provide a mechanism for adding slides after the slideshow has started
function exposeAddSlide(opts, els) {
	opts.addSlide = function(newSlide, prepend) {
		var $s = $(newSlide), s = $s[0];
		if (!opts.autostopCount)
			opts.countdown++;
		els[prepend?'unshift':'push'](s);
		if (opts.els)
			opts.els[prepend?'unshift':'push'](s); // shuffle needs this
		opts.slideCount = els.length;

		// add the slide to the random map and resort
		if (opts.random) {
			opts.randomMap.push(opts.slideCount-1);
			opts.randomMap.sort(function(a,b) {return Math.random() - 0.5;});
		}

		$s.css('position','absolute');
		$s[prepend?'prependTo':'appendTo'](opts.$cont);

		if (prepend) {
			opts.currSlide++;
			opts.nextSlide++;
		}

		if (!$.support.opacity && opts.cleartype && !opts.cleartypeNoBg)
			clearTypeFix($s);

		if (opts.fit && opts.width)
			$s.width(opts.width);
		if (opts.fit && opts.height && opts.height != 'auto')
			$s.height(opts.height);
		s.cycleH = (opts.fit && opts.height) ? opts.height : $s.height();
		s.cycleW = (opts.fit && opts.width) ? opts.width : $s.width();

		$s.css(opts.cssBefore);

		if (opts.pager || opts.pagerAnchorBuilder)
			$.fn.cycle.createPagerAnchor(els.length-1, s, $(opts.pager), els, opts);

		if ($.isFunction(opts.onAddSlide))
			opts.onAddSlide($s);
		else
			$s.hide(); // default behavior
	};
}

// reset internal state; we do this on every pass in order to support multiple effects
$.fn.cycle.resetState = function(opts, fx) {
	fx = fx || opts.fx;
	opts.before = []; opts.after = [];
	opts.cssBefore = $.extend({}, opts.original.cssBefore);
	opts.cssAfter  = $.extend({}, opts.original.cssAfter);
	opts.animIn	= $.extend({}, opts.original.animIn);
	opts.animOut   = $.extend({}, opts.original.animOut);
	opts.fxFn = null;
	$.each(opts.original.before, function() { opts.before.push(this); });
	$.each(opts.original.after,  function() { opts.after.push(this); });

	// re-init
	var init = $.fn.cycle.transitions[fx];
	if ($.isFunction(init))
		init(opts.$cont, $(opts.elements), opts);
};

// this is the main engine fn, it handles the timeouts, callbacks and slide index mgmt
function go(els, opts, manual, fwd) {
	var p = opts.$cont[0], curr = els[opts.currSlide], next = els[opts.nextSlide];

	// opts.busy is true if we're in the middle of an animation
	if (manual && opts.busy && opts.manualTrump) {
		// let manual transitions requests trump active ones
		debug('manualTrump in go(), stopping active transition');
		$(els).stop(true,true);
		opts.busy = 0;
		clearTimeout(p.cycleTimeout);
	}

	// don't begin another timeout-based transition if there is one active
	if (opts.busy) {
		debug('transition active, ignoring new tx request');
		return;
	}


	// stop cycling if we have an outstanding stop request
	if (p.cycleStop != opts.stopCount || p.cycleTimeout === 0 && !manual)
		return;

	// check to see if we should stop cycling based on autostop options
	if (!manual && !p.cyclePause && !opts.bounce &&
		((opts.autostop && (--opts.countdown <= 0)) ||
		(opts.nowrap && !opts.random && opts.nextSlide < opts.currSlide))) {
		if (opts.end)
			opts.end(opts);
		return;
	}

	// if slideshow is paused, only transition on a manual trigger
	var changed = false;
	if ((manual || !p.cyclePause) && (opts.nextSlide != opts.currSlide)) {
		changed = true;
		var fx = opts.fx;
		// keep trying to get the slide size if we don't have it yet
		curr.cycleH = curr.cycleH || $(curr).height();
		curr.cycleW = curr.cycleW || $(curr).width();
		next.cycleH = next.cycleH || $(next).height();
		next.cycleW = next.cycleW || $(next).width();

		// support multiple transition types
		if (opts.multiFx) {
			if (fwd && (opts.lastFx === undefined || ++opts.lastFx >= opts.fxs.length))
				opts.lastFx = 0;
			else if (!fwd && (opts.lastFx === undefined || --opts.lastFx < 0))
				opts.lastFx = opts.fxs.length - 1;
			fx = opts.fxs[opts.lastFx];
		}

		// one-time fx overrides apply to:  $('div').cycle(3,'zoom');
		if (opts.oneTimeFx) {
			fx = opts.oneTimeFx;
			opts.oneTimeFx = null;
		}

		$.fn.cycle.resetState(opts, fx);

		// run the before callbacks
		if (opts.before.length)
			$.each(opts.before, function(i,o) {
				if (p.cycleStop != opts.stopCount) return;
				o.apply(next, [curr, next, opts, fwd]);
			});

		// stage the after callacks
		var after = function() {
			opts.busy = 0;
			$.each(opts.after, function(i,o) {
				if (p.cycleStop != opts.stopCount) return;
				o.apply(next, [curr, next, opts, fwd]);
			});
			if (!p.cycleStop) {
				// queue next transition
				queueNext();
			}
		};

		debug('tx firing('+fx+'); currSlide: ' + opts.currSlide + '; nextSlide: ' + opts.nextSlide);

		// get ready to perform the transition
		opts.busy = 1;
		if (opts.fxFn) // fx function provided?
			opts.fxFn(curr, next, opts, after, fwd, manual && opts.fastOnEvent);
		else if ($.isFunction($.fn.cycle[opts.fx])) // fx plugin ?
			$.fn.cycle[opts.fx](curr, next, opts, after, fwd, manual && opts.fastOnEvent);
		else
			$.fn.cycle.custom(curr, next, opts, after, fwd, manual && opts.fastOnEvent);
	}
	else {
		queueNext();
	}

	if (changed || opts.nextSlide == opts.currSlide) {
		// calculate the next slide
		var roll;
		opts.lastSlide = opts.currSlide;
		if (opts.random) {
			opts.currSlide = opts.nextSlide;
			if (++opts.randomIndex == els.length) {
				opts.randomIndex = 0;
				opts.randomMap.sort(function(a,b) {return Math.random() - 0.5;});
			}
			opts.nextSlide = opts.randomMap[opts.randomIndex];
			if (opts.nextSlide == opts.currSlide)
				opts.nextSlide = (opts.currSlide == opts.slideCount - 1) ? 0 : opts.currSlide + 1;
		}
		else if (opts.backwards) {
			roll = (opts.nextSlide - 1) < 0;
			if (roll && opts.bounce) {
				opts.backwards = !opts.backwards;
				opts.nextSlide = 1;
				opts.currSlide = 0;
			}
			else {
				opts.nextSlide = roll ? (els.length-1) : opts.nextSlide-1;
				opts.currSlide = roll ? 0 : opts.nextSlide+1;
			}
		}
		else { // sequence
			roll = (opts.nextSlide + 1) == els.length;
			if (roll && opts.bounce) {
				opts.backwards = !opts.backwards;
				opts.nextSlide = els.length-2;
				opts.currSlide = els.length-1;
			}
			else {
				opts.nextSlide = roll ? 0 : opts.nextSlide+1;
				opts.currSlide = roll ? els.length-1 : opts.nextSlide-1;
			}
		}
	}
	if (changed && opts.pager)
		opts.updateActivePagerLink(opts.pager, opts.currSlide, opts.activePagerClass);

	function queueNext() {
		// stage the next transition
		var ms = 0, timeout = opts.timeout;
		if (opts.timeout && !opts.continuous) {
			ms = getTimeout(els[opts.currSlide], els[opts.nextSlide], opts, fwd);
         if (opts.fx == 'shuffle')
            ms -= opts.speedOut;
      }
		else if (opts.continuous && p.cyclePause) // continuous shows work off an after callback, not this timer logic
			ms = 10;
		if (ms > 0)
			p.cycleTimeout = setTimeout(function(){ go(els, opts, 0, !opts.backwards); }, ms);
	}
}

// invoked after transition
$.fn.cycle.updateActivePagerLink = function(pager, currSlide, clsName) {
   $(pager).each(function() {
       $(this).children().removeClass(clsName).eq(currSlide).addClass(clsName);
   });
};

// calculate timeout value for current transition
function getTimeout(curr, next, opts, fwd) {
	if (opts.timeoutFn) {
		// call user provided calc fn
		var t = opts.timeoutFn.call(curr,curr,next,opts,fwd);
		while (opts.fx != 'none' && (t - opts.speed) < 250) // sanitize timeout
			t += opts.speed;
		debug('calculated timeout: ' + t + '; speed: ' + opts.speed);
		if (t !== false)
			return t;
	}
	return opts.timeout;
}

// expose next/prev function, caller must pass in state
$.fn.cycle.next = function(opts) { advance(opts,1); };
$.fn.cycle.prev = function(opts) { advance(opts,0);};

// advance slide forward or back
function advance(opts, moveForward) {
	var val = moveForward ? 1 : -1;
	var els = opts.elements;
	var p = opts.$cont[0], timeout = p.cycleTimeout;
	if (timeout) {
		clearTimeout(timeout);
		p.cycleTimeout = 0;
	}
	if (opts.random && val < 0) {
		// move back to the previously display slide
		opts.randomIndex--;
		if (--opts.randomIndex == -2)
			opts.randomIndex = els.length-2;
		else if (opts.randomIndex == -1)
			opts.randomIndex = els.length-1;
		opts.nextSlide = opts.randomMap[opts.randomIndex];
	}
	else if (opts.random) {
		opts.nextSlide = opts.randomMap[opts.randomIndex];
	}
	else {
		opts.nextSlide = opts.currSlide + val;
		if (opts.nextSlide < 0) {
			if (opts.nowrap) return false;
			opts.nextSlide = els.length - 1;
		}
		else if (opts.nextSlide >= els.length) {
			if (opts.nowrap) return false;
			opts.nextSlide = 0;
		}
	}

	var cb = opts.onPrevNextEvent || opts.prevNextClick; // prevNextClick is deprecated
	if ($.isFunction(cb))
		cb(val > 0, opts.nextSlide, els[opts.nextSlide]);
	go(els, opts, 1, moveForward);
	return false;
}

function buildPager(els, opts) {
	var $p = $(opts.pager);
	$.each(els, function(i,o) {
		$.fn.cycle.createPagerAnchor(i,o,$p,els,opts);
	});
	opts.updateActivePagerLink(opts.pager, opts.startingSlide, opts.activePagerClass);
}

$.fn.cycle.createPagerAnchor = function(i, el, $p, els, opts) {
	var a;
	if ($.isFunction(opts.pagerAnchorBuilder)) {
		a = opts.pagerAnchorBuilder(i,el);
		debug('pagerAnchorBuilder('+i+', el) returned: ' + a);
	}
	else
		a = '<a href="#">'+(i+1)+'</a>';

	if (!a)
		return;
	var $a = $(a);
	// don't reparent if anchor is in the dom
	if ($a.parents('body').length === 0) {
		var arr = [];
		if ($p.length > 1) {
			$p.each(function() {
				var $clone = $a.clone(true);
				$(this).append($clone);
				arr.push($clone[0]);
			});
			$a = $(arr);
		}
		else {
			$a.appendTo($p);
		}
	}

	opts.pagerAnchors =  opts.pagerAnchors || [];
	opts.pagerAnchors.push($a);

	var pagerFn = function(e) {
		e.preventDefault();
		opts.nextSlide = i;
		var p = opts.$cont[0], timeout = p.cycleTimeout;
		if (timeout) {
			clearTimeout(timeout);
			p.cycleTimeout = 0;
		}
		var cb = opts.onPagerEvent || opts.pagerClick; // pagerClick is deprecated
		if ($.isFunction(cb))
			cb(opts.nextSlide, els[opts.nextSlide]);
		go(els,opts,1,opts.currSlide < i); // trigger the trans
//		return false; // <== allow bubble
	};

	if ( /mouseenter|mouseover/i.test(opts.pagerEvent) ) {
		$a.hover(pagerFn, function(){/* no-op */} );
	}
	else {
		$a.bind(opts.pagerEvent, pagerFn);
	}

	if ( ! /^click/.test(opts.pagerEvent) && !opts.allowPagerClickBubble)
		$a.bind('click.cycle', function(){return false;}); // suppress click

	var cont = opts.$cont[0];
	var pauseFlag = false; // https://github.com/malsup/cycle/issues/44
	if (opts.pauseOnPagerHover) {
		$a.hover(
			function() {
				pauseFlag = true;
				cont.cyclePause++;
				triggerPause(cont,true,true);
			}, function() {
				if (pauseFlag)
					cont.cyclePause--;
				triggerPause(cont,true,true);
			}
		);
	}
};

// helper fn to calculate the number of slides between the current and the next
$.fn.cycle.hopsFromLast = function(opts, fwd) {
	var hops, l = opts.lastSlide, c = opts.currSlide;
	if (fwd)
		hops = c > l ? c - l : opts.slideCount - l;
	else
		hops = c < l ? l - c : l + opts.slideCount - c;
	return hops;
};

// fix clearType problems in ie6 by setting an explicit bg color
// (otherwise text slides look horrible during a fade transition)
function clearTypeFix($slides) {
	debug('applying clearType background-color hack');
	function hex(s) {
		s = parseInt(s,10).toString(16);
		return s.length < 2 ? '0'+s : s;
	}
	function getBg(e) {
		for ( ; e && e.nodeName.toLowerCase() != 'html'; e = e.parentNode) {
			var v = $.css(e,'background-color');
			if (v && v.indexOf('rgb') >= 0 ) {
				var rgb = v.match(/\d+/g);
				return '#'+ hex(rgb[0]) + hex(rgb[1]) + hex(rgb[2]);
			}
			if (v && v != 'transparent')
				return v;
		}
		return '#ffffff';
	}
	$slides.each(function() { $(this).css('background-color', getBg(this)); });
}

// reset common props before the next transition
$.fn.cycle.commonReset = function(curr,next,opts,w,h,rev) {
	$(opts.elements).not(curr).hide();
	if (typeof opts.cssBefore.opacity == 'undefined')
		opts.cssBefore.opacity = 1;
	opts.cssBefore.display = 'block';
	if (opts.slideResize && w !== false && next.cycleW > 0)
		opts.cssBefore.width = next.cycleW;
	if (opts.slideResize && h !== false && next.cycleH > 0)
		opts.cssBefore.height = next.cycleH;
	opts.cssAfter = opts.cssAfter || {};
	opts.cssAfter.display = 'none';
	$(curr).css('zIndex',opts.slideCount + (rev === true ? 1 : 0));
	$(next).css('zIndex',opts.slideCount + (rev === true ? 0 : 1));
};

// the actual fn for effecting a transition
$.fn.cycle.custom = function(curr, next, opts, cb, fwd, speedOverride) {
	var $l = $(curr), $n = $(next);
	var speedIn = opts.speedIn, speedOut = opts.speedOut, easeIn = opts.easeIn, easeOut = opts.easeOut;
	$n.css(opts.cssBefore);
	if (speedOverride) {
		if (typeof speedOverride == 'number')
			speedIn = speedOut = speedOverride;
		else
			speedIn = speedOut = 1;
		easeIn = easeOut = null;
	}
	var fn = function() {
		$n.animate(opts.animIn, speedIn, easeIn, function() {
			cb();
		});
	};
	$l.animate(opts.animOut, speedOut, easeOut, function() {
		$l.css(opts.cssAfter);
		if (!opts.sync)
			fn();
	});
	if (opts.sync) fn();
};

// transition definitions - only fade is defined here, transition pack defines the rest
$.fn.cycle.transitions = {
	fade: function($cont, $slides, opts) {
		$slides.not(':eq('+opts.currSlide+')').css('opacity',0);
		opts.before.push(function(curr,next,opts) {
			$.fn.cycle.commonReset(curr,next,opts);
			opts.cssBefore.opacity = 0;
		});
		opts.animIn	   = { opacity: 1 };
		opts.animOut   = { opacity: 0 };
		opts.cssBefore = { top: 0, left: 0 };
	}
};

$.fn.cycle.ver = function() { return ver; };

// override these globally if you like (they are all optional)
$.fn.cycle.defaults = {
    activePagerClass: 'activeSlide', // class name used for the active pager link
    after:            null,     // transition callback (scope set to element that was shown):  function(currSlideElement, nextSlideElement, options, forwardFlag)
    allowPagerClickBubble: false, // allows or prevents click event on pager anchors from bubbling
    animIn:           null,     // properties that define how the slide animates in
    animOut:          null,     // properties that define how the slide animates out
    aspect:           false,    // preserve aspect ratio during fit resizing, cropping if necessary (must be used with fit option)
    autostop:         0,        // true to end slideshow after X transitions (where X == slide count)
    autostopCount:    0,        // number of transitions (optionally used with autostop to define X)
    backwards:        false,    // true to start slideshow at last slide and move backwards through the stack
    before:           null,     // transition callback (scope set to element to be shown):     function(currSlideElement, nextSlideElement, options, forwardFlag)
    center:           null,     // set to true to have cycle add top/left margin to each slide (use with width and height options)
    cleartype:        !$.support.opacity,  // true if clearType corrections should be applied (for IE)
    cleartypeNoBg:    false,    // set to true to disable extra cleartype fixing (leave false to force background color setting on slides)
    containerResize:  1,        // resize container to fit largest slide
    continuous:       0,        // true to start next transition immediately after current one completes
    cssAfter:         null,     // properties that defined the state of the slide after transitioning out
    cssBefore:        null,     // properties that define the initial state of the slide before transitioning in
    delay:            0,        // additional delay (in ms) for first transition (hint: can be negative)
    easeIn:           null,     // easing for "in" transition
    easeOut:          null,     // easing for "out" transition
    easing:           null,     // easing method for both in and out transitions
    end:              null,     // callback invoked when the slideshow terminates (use with autostop or nowrap options): function(options)
    fastOnEvent:      0,        // force fast transitions when triggered manually (via pager or prev/next); value == time in ms
    fit:              0,        // force slides to fit container
    fx:               'fade',   // name of transition effect (or comma separated names, ex: 'fade,scrollUp,shuffle')
    fxFn:             null,     // function used to control the transition: function(currSlideElement, nextSlideElement, options, afterCalback, forwardFlag)
    height:           'auto',   // container height (if the 'fit' option is true, the slides will be set to this height as well)
    manualTrump:      true,     // causes manual transition to stop an active transition instead of being ignored
    metaAttr:         'cycle',  // data- attribute that holds the option data for the slideshow
    next:             null,     // element, jQuery object, or jQuery selector string for the element to use as event trigger for next slide
    nowrap:           0,        // true to prevent slideshow from wrapping
    onPagerEvent:     null,     // callback fn for pager events: function(zeroBasedSlideIndex, slideElement)
    onPrevNextEvent:  null,     // callback fn for prev/next events: function(isNext, zeroBasedSlideIndex, slideElement)
    pager:            null,     // element, jQuery object, or jQuery selector string for the element to use as pager container
    pagerAnchorBuilder: null,   // callback fn for building anchor links:  function(index, DOMelement)
    pagerEvent:       'click.cycle', // name of event which drives the pager navigation
    pause:            0,        // true to enable "pause on hover"
    pauseOnPagerHover: 0,       // true to pause when hovering over pager link
    prev:             null,     // element, jQuery object, or jQuery selector string for the element to use as event trigger for previous slide
    prevNextEvent:    'click.cycle',// event which drives the manual transition to the previous or next slide
    random:           0,        // true for random, false for sequence (not applicable to shuffle fx)
    randomizeEffects: 1,        // valid when multiple effects are used; true to make the effect sequence random
    requeueOnImageNotLoaded: true, // requeue the slideshow if any image slides are not yet loaded
    requeueTimeout:   250,      // ms delay for requeue
    rev:              0,        // causes animations to transition in reverse (for effects that support it such as scrollHorz/scrollVert/shuffle)
    shuffle:          null,     // coords for shuffle animation, ex: { top:15, left: 200 }
    skipInitializationCallbacks: false, // set to true to disable the first before/after callback that occurs prior to any transition
    slideExpr:        null,     // expression for selecting slides (if something other than all children is required)
    slideResize:      1,        // force slide width/height to fixed size before every transition
    speed:            1000,     // speed of the transition (any valid fx speed value)
    speedIn:          null,     // speed of the 'in' transition
    speedOut:         null,     // speed of the 'out' transition
    startingSlide:    undefined,// zero-based index of the first slide to be displayed
    sync:             1,        // true if in/out transitions should occur simultaneously
    timeout:          4000,     // milliseconds between slide transitions (0 to disable auto advance)
    timeoutFn:        null,     // callback for determining per-slide timeout value:  function(currSlideElement, nextSlideElement, options, forwardFlag)
    updateActivePagerLink: null,// callback fn invoked to update the active pager link (adds/removes activePagerClass style)
    width:            null      // container width (if the 'fit' option is true, the slides will be set to this width as well)
};

})(jQuery);


/*!
 * jQuery Cycle Plugin Transition Definitions
 * This script is a plugin for the jQuery Cycle Plugin
 * Examples and documentation at: http://malsup.com/jquery/cycle/
 * Copyright (c) 2007-2010 M. Alsup
 * Version:	 2.73
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 */
(function($) {
"use strict";

//
// These functions define slide initialization and properties for the named
// transitions. To save file size feel free to remove any of these that you
// don't need.
//
$.fn.cycle.transitions.none = function($cont, $slides, opts) {
	opts.fxFn = function(curr,next,opts,after){
		$(next).show();
		$(curr).hide();
		after();
	};
};

// not a cross-fade, fadeout only fades out the top slide
$.fn.cycle.transitions.fadeout = function($cont, $slides, opts) {
	$slides.not(':eq('+opts.currSlide+')').css({ display: 'block', 'opacity': 1 });
	opts.before.push(function(curr,next,opts,w,h,rev) {
		$(curr).css('zIndex',opts.slideCount + (rev !== true ? 1 : 0));
		$(next).css('zIndex',opts.slideCount + (rev !== true ? 0 : 1));
	});
	opts.animIn.opacity = 1;
	opts.animOut.opacity = 0;
	opts.cssBefore.opacity = 1;
	opts.cssBefore.display = 'block';
	opts.cssAfter.zIndex = 0;
};

// scrollUp/Down/Left/Right
$.fn.cycle.transitions.scrollUp = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var h = $cont.height();
	opts.cssBefore.top = h;
	opts.cssBefore.left = 0;
	opts.cssFirst.top = 0;
	opts.animIn.top = 0;
	opts.animOut.top = -h;
};
$.fn.cycle.transitions.scrollDown = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var h = $cont.height();
	opts.cssFirst.top = 0;
	opts.cssBefore.top = -h;
	opts.cssBefore.left = 0;
	opts.animIn.top = 0;
	opts.animOut.top = h;
};
$.fn.cycle.transitions.scrollLeft = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var w = $cont.width();
	opts.cssFirst.left = 0;
	opts.cssBefore.left = w;
	opts.cssBefore.top = 0;
	opts.animIn.left = 0;
	opts.animOut.left = 0-w;
};
$.fn.cycle.transitions.scrollRight = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push($.fn.cycle.commonReset);
	var w = $cont.width();
	opts.cssFirst.left = 0;
	opts.cssBefore.left = -w;
	opts.cssBefore.top = 0;
	opts.animIn.left = 0;
	opts.animOut.left = w;
};
$.fn.cycle.transitions.scrollHorz = function($cont, $slides, opts) {
	$cont.css('overflow','hidden').width();
	opts.before.push(function(curr, next, opts, fwd) {
		if (opts.rev)
			fwd = !fwd;
		$.fn.cycle.commonReset(curr,next,opts);
		opts.cssBefore.left = fwd ? (next.cycleW-1) : (1-next.cycleW);
		opts.animOut.left = fwd ? -curr.cycleW : curr.cycleW;
	});
	opts.cssFirst.left = 0;
	opts.cssBefore.top = 0;
	opts.animIn.left = 0;
	opts.animOut.top = 0;
};
$.fn.cycle.transitions.scrollVert = function($cont, $slides, opts) {
	$cont.css('overflow','hidden');
	opts.before.push(function(curr, next, opts, fwd) {
		if (opts.rev)
			fwd = !fwd;
		$.fn.cycle.commonReset(curr,next,opts);
		opts.cssBefore.top = fwd ? (1-next.cycleH) : (next.cycleH-1);
		opts.animOut.top = fwd ? curr.cycleH : -curr.cycleH;
	});
	opts.cssFirst.top = 0;
	opts.cssBefore.left = 0;
	opts.animIn.top = 0;
	opts.animOut.left = 0;
};

// slideX/slideY
$.fn.cycle.transitions.slideX = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$(opts.elements).not(curr).hide();
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.animIn.width = next.cycleW;
	});
	opts.cssBefore.left = 0;
	opts.cssBefore.top = 0;
	opts.cssBefore.width = 0;
	opts.animIn.width = 'show';
	opts.animOut.width = 0;
};
$.fn.cycle.transitions.slideY = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$(opts.elements).not(curr).hide();
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.animIn.height = next.cycleH;
	});
	opts.cssBefore.left = 0;
	opts.cssBefore.top = 0;
	opts.cssBefore.height = 0;
	opts.animIn.height = 'show';
	opts.animOut.height = 0;
};

// shuffle
$.fn.cycle.transitions.shuffle = function($cont, $slides, opts) {
	var i, w = $cont.css('overflow', 'visible').width();
	$slides.css({left: 0, top: 0});
	opts.before.push(function(curr,next,opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,true,true);
	});
	// only adjust speed once!
	if (!opts.speedAdjusted) {
		opts.speed = opts.speed / 2; // shuffle has 2 transitions
		opts.speedAdjusted = true;
	}
	opts.random = 0;
	opts.shuffle = opts.shuffle || {left:-w, top:15};
	opts.els = [];
	for (i=0; i < $slides.length; i++)
		opts.els.push($slides[i]);

	for (i=0; i < opts.currSlide; i++)
		opts.els.push(opts.els.shift());

	// custom transition fn (hat tip to Benjamin Sterling for this bit of sweetness!)
	opts.fxFn = function(curr, next, opts, cb, fwd) {
		if (opts.rev)
			fwd = !fwd;
		var $el = fwd ? $(curr) : $(next);
		$(next).css(opts.cssBefore);
		var count = opts.slideCount;
		$el.animate(opts.shuffle, opts.speedIn, opts.easeIn, function() {
			var hops = $.fn.cycle.hopsFromLast(opts, fwd);
			for (var k=0; k < hops; k++) {
				if (fwd)
					opts.els.push(opts.els.shift());
				else
					opts.els.unshift(opts.els.pop());
			}
			if (fwd) {
				for (var i=0, len=opts.els.length; i < len; i++)
					$(opts.els[i]).css('z-index', len-i+count);
			}
			else {
				var z = $(curr).css('z-index');
				$el.css('z-index', parseInt(z,10)+1+count);
			}
			$el.animate({left:0, top:0}, opts.speedOut, opts.easeOut, function() {
				$(fwd ? this : curr).hide();
				if (cb) cb();
			});
		});
	};
	$.extend(opts.cssBefore, { display: 'block', opacity: 1, top: 0, left: 0 });
};

// turnUp/Down/Left/Right
$.fn.cycle.transitions.turnUp = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.cssBefore.top = next.cycleH;
		opts.animIn.height = next.cycleH;
		opts.animOut.width = next.cycleW;
	});
	opts.cssFirst.top = 0;
	opts.cssBefore.left = 0;
	opts.cssBefore.height = 0;
	opts.animIn.top = 0;
	opts.animOut.height = 0;
};
$.fn.cycle.transitions.turnDown = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.animIn.height = next.cycleH;
		opts.animOut.top   = curr.cycleH;
	});
	opts.cssFirst.top = 0;
	opts.cssBefore.left = 0;
	opts.cssBefore.top = 0;
	opts.cssBefore.height = 0;
	opts.animOut.height = 0;
};
$.fn.cycle.transitions.turnLeft = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.cssBefore.left = next.cycleW;
		opts.animIn.width = next.cycleW;
	});
	opts.cssBefore.top = 0;
	opts.cssBefore.width = 0;
	opts.animIn.left = 0;
	opts.animOut.width = 0;
};
$.fn.cycle.transitions.turnRight = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.animIn.width = next.cycleW;
		opts.animOut.left = curr.cycleW;
	});
	$.extend(opts.cssBefore, { top: 0, left: 0, width: 0 });
	opts.animIn.left = 0;
	opts.animOut.width = 0;
};

// zoom
$.fn.cycle.transitions.zoom = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,false,true);
		opts.cssBefore.top = next.cycleH/2;
		opts.cssBefore.left = next.cycleW/2;
		$.extend(opts.animIn, { top: 0, left: 0, width: next.cycleW, height: next.cycleH });
		$.extend(opts.animOut, { width: 0, height: 0, top: curr.cycleH/2, left: curr.cycleW/2 });
	});
	opts.cssFirst.top = 0;
	opts.cssFirst.left = 0;
	opts.cssBefore.width = 0;
	opts.cssBefore.height = 0;
};

// fadeZoom
$.fn.cycle.transitions.fadeZoom = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,false);
		opts.cssBefore.left = next.cycleW/2;
		opts.cssBefore.top = next.cycleH/2;
		$.extend(opts.animIn, { top: 0, left: 0, width: next.cycleW, height: next.cycleH });
	});
	opts.cssBefore.width = 0;
	opts.cssBefore.height = 0;
	opts.animOut.opacity = 0;
};

// blindX
$.fn.cycle.transitions.blindX = function($cont, $slides, opts) {
	var w = $cont.css('overflow','hidden').width();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.animIn.width = next.cycleW;
		opts.animOut.left   = curr.cycleW;
	});
	opts.cssBefore.left = w;
	opts.cssBefore.top = 0;
	opts.animIn.left = 0;
	opts.animOut.left = w;
};
// blindY
$.fn.cycle.transitions.blindY = function($cont, $slides, opts) {
	var h = $cont.css('overflow','hidden').height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.animIn.height = next.cycleH;
		opts.animOut.top   = curr.cycleH;
	});
	opts.cssBefore.top = h;
	opts.cssBefore.left = 0;
	opts.animIn.top = 0;
	opts.animOut.top = h;
};
// blindZ
$.fn.cycle.transitions.blindZ = function($cont, $slides, opts) {
	var h = $cont.css('overflow','hidden').height();
	var w = $cont.width();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		opts.animIn.height = next.cycleH;
		opts.animOut.top   = curr.cycleH;
	});
	opts.cssBefore.top = h;
	opts.cssBefore.left = w;
	opts.animIn.top = 0;
	opts.animIn.left = 0;
	opts.animOut.top = h;
	opts.animOut.left = w;
};

// growX - grow horizontally from centered 0 width
$.fn.cycle.transitions.growX = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true);
		opts.cssBefore.left = this.cycleW/2;
		opts.animIn.left = 0;
		opts.animIn.width = this.cycleW;
		opts.animOut.left = 0;
	});
	opts.cssBefore.top = 0;
	opts.cssBefore.width = 0;
};
// growY - grow vertically from centered 0 height
$.fn.cycle.transitions.growY = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false);
		opts.cssBefore.top = this.cycleH/2;
		opts.animIn.top = 0;
		opts.animIn.height = this.cycleH;
		opts.animOut.top = 0;
	});
	opts.cssBefore.height = 0;
	opts.cssBefore.left = 0;
};

// curtainX - squeeze in both edges horizontally
$.fn.cycle.transitions.curtainX = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,false,true,true);
		opts.cssBefore.left = next.cycleW/2;
		opts.animIn.left = 0;
		opts.animIn.width = this.cycleW;
		opts.animOut.left = curr.cycleW/2;
		opts.animOut.width = 0;
	});
	opts.cssBefore.top = 0;
	opts.cssBefore.width = 0;
};
// curtainY - squeeze in both edges vertically
$.fn.cycle.transitions.curtainY = function($cont, $slides, opts) {
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,false,true);
		opts.cssBefore.top = next.cycleH/2;
		opts.animIn.top = 0;
		opts.animIn.height = next.cycleH;
		opts.animOut.top = curr.cycleH/2;
		opts.animOut.height = 0;
	});
	opts.cssBefore.height = 0;
	opts.cssBefore.left = 0;
};

// cover - curr slide covered by next slide
$.fn.cycle.transitions.cover = function($cont, $slides, opts) {
	var d = opts.direction || 'left';
	var w = $cont.css('overflow','hidden').width();
	var h = $cont.height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts);
		if (d == 'right')
			opts.cssBefore.left = -w;
		else if (d == 'up')
			opts.cssBefore.top = h;
		else if (d == 'down')
			opts.cssBefore.top = -h;
		else
			opts.cssBefore.left = w;
	});
	opts.animIn.left = 0;
	opts.animIn.top = 0;
	opts.cssBefore.top = 0;
	opts.cssBefore.left = 0;
};

// uncover - curr slide moves off next slide
$.fn.cycle.transitions.uncover = function($cont, $slides, opts) {
	var d = opts.direction || 'left';
	var w = $cont.css('overflow','hidden').width();
	var h = $cont.height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,true,true);
		if (d == 'right')
			opts.animOut.left = w;
		else if (d == 'up')
			opts.animOut.top = -h;
		else if (d == 'down')
			opts.animOut.top = h;
		else
			opts.animOut.left = -w;
	});
	opts.animIn.left = 0;
	opts.animIn.top = 0;
	opts.cssBefore.top = 0;
	opts.cssBefore.left = 0;
};

// toss - move top slide and fade away
$.fn.cycle.transitions.toss = function($cont, $slides, opts) {
	var w = $cont.css('overflow','visible').width();
	var h = $cont.height();
	opts.before.push(function(curr, next, opts) {
		$.fn.cycle.commonReset(curr,next,opts,true,true,true);
		// provide default toss settings if animOut not provided
		if (!opts.animOut.left && !opts.animOut.top)
			$.extend(opts.animOut, { left: w*2, top: -h/2, opacity: 0 });
		else
			opts.animOut.opacity = 0;
	});
	opts.cssBefore.left = 0;
	opts.cssBefore.top = 0;
	opts.animIn.left = 0;
};

// wipe - clip animation
$.fn.cycle.transitions.wipe = function($cont, $slides, opts) {
	var w = $cont.css('overflow','hidden').width();
	var h = $cont.height();
	opts.cssBefore = opts.cssBefore || {};
	var clip;
	if (opts.clip) {
		if (/l2r/.test(opts.clip))
			clip = 'rect(0px 0px '+h+'px 0px)';
		else if (/r2l/.test(opts.clip))
			clip = 'rect(0px '+w+'px '+h+'px '+w+'px)';
		else if (/t2b/.test(opts.clip))
			clip = 'rect(0px '+w+'px 0px 0px)';
		else if (/b2t/.test(opts.clip))
			clip = 'rect('+h+'px '+w+'px '+h+'px 0px)';
		else if (/zoom/.test(opts.clip)) {
			var top = parseInt(h/2,10);
			var left = parseInt(w/2,10);
			clip = 'rect('+top+'px '+left+'px '+top+'px '+left+'px)';
		}
	}

	opts.cssBefore.clip = opts.cssBefore.clip || clip || 'rect(0px 0px 0px 0px)';

	var d = opts.cssBefore.clip.match(/(\d+)/g);
	var t = parseInt(d[0],10), r = parseInt(d[1],10), b = parseInt(d[2],10), l = parseInt(d[3],10);

	opts.before.push(function(curr, next, opts) {
		if (curr == next) return;
		var $curr = $(curr), $next = $(next);
		$.fn.cycle.commonReset(curr,next,opts,true,true,false);
		opts.cssAfter.display = 'block';

		var step = 1, count = parseInt((opts.speedIn / 13),10) - 1;
		(function f() {
			var tt = t ? t - parseInt(step * (t/count),10) : 0;
			var ll = l ? l - parseInt(step * (l/count),10) : 0;
			var bb = b < h ? b + parseInt(step * ((h-b)/count || 1),10) : h;
			var rr = r < w ? r + parseInt(step * ((w-r)/count || 1),10) : w;
			$next.css({ clip: 'rect('+tt+'px '+rr+'px '+bb+'px '+ll+'px)' });
			(step++ <= count) ? setTimeout(f, 13) : $curr.css('display', 'none');
		})();
	});
	$.extend(opts.cssBefore, { display: 'block', opacity: 1, top: 0, left: 0 });
	opts.animIn	   = { left: 0 };
	opts.animOut   = { left: 0 };
};

})(jQuery);

/*!
 * jquery oembed plugin
 *
 * Copyright (c) 2009 Richard Chamorro
 * Licensed under the MIT license
 *
 * Author: Richard Chamorro
 */

(function ($) {
    $.fn.oembed = function (url, options, embedAction) {

        settings = $.extend(true, $.fn.oembed.defaults, options);

        initializeProviders();

        return this.each(function () {

            var container = $(this),
				resourceURL = (url != null) ? url : container.attr("href"),
				provider;

            if (embedAction) {
                settings.onEmbed = embedAction;
            } else {
                settings.onEmbed = function (oembedData) {
                    $.fn.oembed.insertCode(this, settings.embedMethod, oembedData);
                };
            }

            if (resourceURL != null) {
                provider = $.fn.oembed.getOEmbedProvider(resourceURL);

                if (provider != null) {
                    provider.params = getNormalizedParams(settings[provider.name]) || {};
                    provider.maxWidth = settings.maxWidth;
                    provider.maxHeight = settings.maxHeight;
                    embedCode(container, resourceURL, provider);
                } else {
                    settings.onProviderNotFound.call(container, resourceURL);
                }
            }

            return container;
        });


    };

    var settings, activeProviders = [];

    // Plugin defaults
    $.fn.oembed.defaults = {
        maxWidth: null,
        maxHeight: null,
        embedMethod: "replace",  	// "auto", "append", "fill"
        defaultOEmbedProvider: "oohembed", 	// "oohembed", "embed.ly", "none"
        allowedProviders: null,
        disallowedProviders: null,
        customProviders: null, // [ new $.fn.oembed.OEmbedProvider("customprovider", null, ["customprovider\\.com/watch.+v=[\\w-]+&?"]) ]
        defaultProvider: null,
        greedy: true,
        onProviderNotFound: function () { },
        beforeEmbed: function () { },
        afterEmbed: function () { },
        onEmbed: function () { },
		onError: function() {},
		ajaxOptions: {}
    };

    /* Private functions */
    function getRequestUrl(provider, externalUrl) {

        var url = provider.apiendpoint, qs = "", callbackparameter = provider.callbackparameter || "callback", i;

        if (url.indexOf("?") <= 0)
            url = url + "?";
        else
            url = url + "&";

        if (provider.maxWidth != null && provider.params["maxwidth"] == null)
            provider.params["maxwidth"] = provider.maxWidth;

        if (provider.maxHeight != null && provider.params["maxheight"] == null)
            provider.params["maxheight"] = provider.maxHeight;

        for (i in provider.params) {
            // We don't want them to jack everything up by changing the callback parameter
            if (i == provider.callbackparameter)
                continue;

            // allows the options to be set to null, don't send null values to the server as parameters
            if (provider.params[i] != null)
                qs += "&" + escape(i) + "=" + provider.params[i];
        }

        url += "format=json&url=" + escape(externalUrl) +
					qs +
					"&" + callbackparameter + "=?";

        return url;
    };

    function embedCode(container, externalUrl, embedProvider) {

        console.log(embedProvider);
        var datatype = 'json';

        var requestUrl = getRequestUrl(embedProvider, externalUrl),
			ajaxopts = $.extend({
				url: requestUrl,
				type: 'get',
				dataType: datatype,
				// error: jsonp request doesnt' support error handling
				success:  function (data) {
                    console.log(data);
					var oembedData = $.extend({}, data);
					switch (oembedData.type) {
						case "photo":
							oembedData.code = $.fn.oembed.getPhotoCode(externalUrl, oembedData);
							break;
						case "video":
							oembedData.code = $.fn.oembed.getVideoCode(externalUrl, oembedData);
							break;
						case "rich":
							oembedData.code = $.fn.oembed.getRichCode(externalUrl, oembedData);
							break;
						default:
							oembedData.code = $.fn.oembed.getGenericCode(externalUrl, oembedData);
							break;
					}
					settings.beforeEmbed.call(container, oembedData);
					settings.onEmbed.call(container, oembedData);
					settings.afterEmbed.call(container, oembedData);
				},
				error: settings.onError.call(container, externalUrl, embedProvider)
			}, settings.ajaxOptions || { } );

		$.ajax( ajaxopts );
    };

    function initializeProviders() {

        activeProviders = [];

        var defaultProvider, restrictedProviders = [], i, provider;

        if (!isNullOrEmpty(settings.allowedProviders)) {
            for (i = 0; i < $.fn.oembed.providers.length; i++) {
                if ($.inArray($.fn.oembed.providers[i].name, settings.allowedProviders) >= 0)
                    activeProviders.push($.fn.oembed.providers[i]);
            }
            // If there are allowed providers, jquery-oembed cannot be greedy
            settings.greedy = false;

        } else {
            activeProviders = $.fn.oembed.providers;
        }

        if (!isNullOrEmpty(settings.disallowedProviders)) {
            for (i = 0; i < activeProviders.length; i++) {
                if ($.inArray(activeProviders[i].name, settings.disallowedProviders) < 0)
                    restrictedProviders.push(activeProviders[i]);
            }
            activeProviders = restrictedProviders;
            // If there are allowed providers, jquery-oembed cannot be greedy
            settings.greedy = false;
        }

        if (!isNullOrEmpty(settings.customProviders)) {
            $.each(settings.customProviders, function (n, customProvider) {
                if (customProvider instanceof $.fn.oembed.OEmbedProvider) {
                    activeProviders.push(provider);
                } else {
                    provider = new $.fn.oembed.OEmbedProvider();
                    if (provider.fromJSON(customProvider))
                        activeProviders.push(provider);
                }
            });
        }

        // If in greedy mode, we add the default provider
        defaultProvider = getDefaultOEmbedProvider(settings.defaultOEmbedProvider);
        if (settings.greedy == true) {
            activeProviders.push(defaultProvider);
		}
        // If any provider has no apiendpoint, we use the default provider endpoint
        for (i = 0; i < activeProviders.length; i++) {
            if (activeProviders[i].apiendpoint == null)
                activeProviders[i].apiendpoint = defaultProvider.apiendpoint;
        }
    }

    function getDefaultOEmbedProvider(defaultOEmbedProvider) {
        var url = "http://oohembed.com/oohembed/";
        if (defaultOEmbedProvider == "embed.ly")
            url = "http://api.embed.ly/v1/api/oembed?";
        return new $.fn.oembed.OEmbedProvider(defaultOEmbedProvider, null, null, url, "callback");
    }

    function getNormalizedParams(params) {
        if (params == null)
            return null;
        var key, normalizedParams = {};
        for (key in params) {
            if (key != null)
                normalizedParams[key.toLowerCase()] = params[key];
        }
        return normalizedParams;
    }

    function isNullOrEmpty(object) {
        if (typeof object == "undefined")
            return true;
        if (object == null)
            return true;
        if ($.isArray(object) && object.length == 0)
            return true;
        return false;
    }

    /* Public functions */
    $.fn.oembed.insertCode = function (container, embedMethod, oembedData) {
        if (oembedData == null)
            return;

        switch (embedMethod) {
            case "auto":
                if (container.attr("href") != null) {
                    $.fn.oembed.insertCode(container, "append", oembedData);
                }
                else {
                    $.fn.oembed.insertCode(container, "replace", oembedData);
                };
                break;
            case "replace":
                container.replaceWith(oembedData.code);
                break;
            case "fill":
                container.html(oembedData.code);
                break;
            case "append":
                var oembedContainer = container.next();
                if (oembedContainer == null || !oembedContainer.hasClass("oembed-container")) {
                    oembedContainer = container
						.after('<div class="oembed-container"></div>')
						.next(".oembed-container");
                    if (oembedData != null && oembedData.provider_name != null)
                        oembedContainer.toggleClass("oembed-container-" + oembedData.provider_name);
                }
                oembedContainer.html(oembedData.code);
                break;
        }
    };

    $.fn.oembed.getPhotoCode = function (url, oembedData) {
        var code, alt = oembedData.title ? oembedData.title : '';
        alt += oembedData.author_name ? ' - ' + oembedData.author_name : '';
        alt += oembedData.provider_name ? ' - ' + oembedData.provider_name : '';
        code = '<div><a href="' + url + '" target=\'_blank\'><img src="' + oembedData.url + '" alt="' + alt + '"/></a></div>';
        if (oembedData.html)
            code += "<div>" + oembedData.html + "</div>";
        return code;
    };

    $.fn.oembed.getVideoCode = function (url, oembedData) {
        var code = oembedData.html;

        return code;
    };

    $.fn.oembed.getRichCode = function (url, oembedData) {
        var code = oembedData.html;
        return code;
    };

    $.fn.oembed.getGenericCode = function (url, oembedData) {
        var title = (oembedData.title != null) ? oembedData.title : url,
			code = '<a href="' + url + '">' + title + '</a>';
        if (oembedData.html)
            code += "<div>" + oembedData.html + "</div>";
        return code;
    };

    $.fn.oembed.isProviderAvailable = function (url) {
        var provider = getOEmbedProvider(url);
        return (provider != null);
    };

    $.fn.oembed.getOEmbedProvider = function (url) {
        for (var i = 0; i < activeProviders.length; i++) {
            if (activeProviders[i].matches(url))
                return activeProviders[i];
        }
        return null;
    };

    $.fn.oembed.OEmbedProvider = function (name, type, urlschemesarray, apiendpoint, callbackparameter) {
        this.name = name;
        this.type = type; // "photo", "video", "link", "rich", null
        this.urlschemes = getUrlSchemes(urlschemesarray);
        this.apiendpoint = apiendpoint;
        this.callbackparameter = callbackparameter;
        this.maxWidth = 500;
        this.maxHeight = 400;
        var i, property, regExp;

        this.matches = function (externalUrl) {
            for (i = 0; i < this.urlschemes.length; i++) {
                regExp = new RegExp(this.urlschemes[i], "i");
                if (externalUrl.match(regExp) != null)
                    return true;
            }
            return false;
        };

        this.fromJSON = function (json) {
            for (property in json) {
                if (property != "urlschemes")
                    this[property] = json[property];
                else
                    this[property] = getUrlSchemes(json[property]);
            }
            return true;
        };

        function getUrlSchemes(urls) {
            if (isNullOrEmpty(urls))
                return ["."];
            if ($.isArray(urls))
                return urls;
            return urls.split(";");
        }
    };

    /* Native & common providers */
    $.fn.oembed.providers = [
		new $.fn.oembed.OEmbedProvider("youtube", "video", ["youtube\\.com/watch.+v=[\\w-]+&?", , "http:\/\/youtu\.be\/.*"]), // "http://www.youtube.com/oembed"	(no jsonp)
		new $.fn.oembed.OEmbedProvider("flickr", "photo", ["flickr\\.com/photos/[-.\\w@]+/\\d+/?"], "http://flickr.com/services/oembed", "jsoncallback"),
		new $.fn.oembed.OEmbedProvider("viddler", "video", ["viddler\.com"]), // "http://lab.viddler.com/services/oembed/" (no jsonp)
		new $.fn.oembed.OEmbedProvider("blip", "video", ["blip\\.tv/.+"], "http://blip.tv/oembed/"),
		new $.fn.oembed.OEmbedProvider("hulu", "video", ["hulu\\.com/watch/.*"], "http://www.hulu.com/api/oembed.json"),
		new $.fn.oembed.OEmbedProvider("vimeo", "video", ["http:\/\/www\.vimeo\.com\/groups\/.*\/videos\/.*", "http:\/\/www\.vimeo\.com\/.*", "http:\/\/vimeo\.com\/groups\/.*\/videos\/.*", "http:\/\/vimeo\.com\/.*"], "http://vimeo.com/api/oembed.json"),
		new $.fn.oembed.OEmbedProvider("dailymotion", "video", ["dailymotion\\.com/.+"]), // "http://www.dailymotion.com/api/oembed/" (callback parameter does not return jsonp)
		new $.fn.oembed.OEmbedProvider("scribd", "rich", ["scribd\\.com/.+"]), // ", "http://www.scribd.com/services/oembed"" (no jsonp)
		new $.fn.oembed.OEmbedProvider("slideshare", "rich", ["slideshare\.net"], "http://www.slideshare.net/api/oembed/1"),
		new $.fn.oembed.OEmbedProvider("photobucket", "photo", ["photobucket\\.com/(albums|groups)/.*"], "http://photobucket.com/oembed/")
		// new $.fn.oembed.OEmbedProvider("vids.myspace.com", "video", ["vids\.myspace\.com"]), // "http://vids.myspace.com/index.cfm?fuseaction=oembed" (not working)
		// new $.fn.oembed.OEmbedProvider("screenr", "rich", ["screenr\.com"], "http://screenr.com/api/oembed.json") (error)
		// new $.fn.oembed.OEmbedProvider("qik", "video", ["qik\\.com/\\w+"], "http://qik.com/api/oembed.json"),
		// new $.fn.oembed.OEmbedProvider("revision3", "video", ["revision3\.com"], "http://revision3.com/api/oembed/")
	];
})(jQuery);


var Froogaloop=function(){function e(a){return new e.fn.init(a)}function h(a,c,b){if(!b.contentWindow.postMessage)return!1;var f=b.getAttribute("src").split("?")[0],a=JSON.stringify({method:a,value:c});"//"===f.substr(0,2)&&(f=window.location.protocol+f);b.contentWindow.postMessage(a,f)}function j(a){var c,b;try{c=JSON.parse(a.data),b=c.event||c.method}catch(f){}"ready"==b&&!i&&(i=!0);if(a.origin!=k)return!1;var a=c.value,e=c.data,g=""===g?null:c.player_id;c=g?d[g][b]:d[b];b=[];if(!c)return!1;void 0!==
a&&b.push(a);e&&b.push(e);g&&b.push(g);return 0<b.length?c.apply(null,b):c.call()}function l(a,c,b){b?(d[b]||(d[b]={}),d[b][a]=c):d[a]=c}var d={},i=!1,k="";e.fn=e.prototype={element:null,init:function(a){"string"===typeof a&&(a=document.getElementById(a));this.element=a;a=this.element.getAttribute("src");"//"===a.substr(0,2)&&(a=window.location.protocol+a);for(var a=a.split("/"),c="",b=0,f=a.length;b<f;b++){if(3>b)c+=a[b];else break;2>b&&(c+="/")}k=c;return this},api:function(a,c){if(!this.element||
!a)return!1;var b=this.element,f=""!==b.id?b.id:null,d=!c||!c.constructor||!c.call||!c.apply?c:null,e=c&&c.constructor&&c.call&&c.apply?c:null;e&&l(a,e,f);h(a,d,b);return this},addEvent:function(a,c){if(!this.element)return!1;var b=this.element,d=""!==b.id?b.id:null;l(a,c,d);"ready"!=a?h("addEventListener",a,b):"ready"==a&&i&&c.call(null,d);return this},removeEvent:function(a){if(!this.element)return!1;var c=this.element,b;a:{if((b=""!==c.id?c.id:null)&&d[b]){if(!d[b][a]){b=!1;break a}d[b][a]=null}else{if(!d[a]){b=
!1;break a}d[a]=null}b=!0}"ready"!=a&&b&&h("removeEventListener",a,c)}};e.fn.init.prototype=e.fn;window.addEventListener?window.addEventListener("message",j,!1):window.attachEvent("onmessage",j);return window.Froogaloop=window.$f=e}();