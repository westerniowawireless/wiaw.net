
/**
 * Prime Plugin JS Standards and Helpers
 */
!function( $ ){

/**
 * Prototype Based Object Creation as recommended by Crawford
 * pretty common pattern, so this might also be included by a
 * helper library
 */
if (typeof Object.create !== 'function') {
    Object.create = function (o) {
        var F = function () {
        };
        F.prototype = o;
        return new F();
    };
}

/**
 * Bridge for registering new plugins.
 * @param name the name of the plugin
 * @param object the prototype object
 */
jQuery.plugin = function(name, object) {

    //add init method that will automatically
    // merge the options and defaults
    // set elem and jQueryElem attributes
    // call the object's _build function
    // return the object
    object.init = function(options, elem) {
        return jQuery.pluginInit(options, elem, this);
    };

    jQuery.fn[name] = function(options) {
        var args = Array.prototype.slice.call(arguments, 1);
        return this.each(function() {
            var instance = jQuery.data(this, name);
            if (!instance) {
                instance = jQuery.data(this, name, Object.create(object).init(options, this));
            }
        });
    };
};

jQuery.pluginInit = function(options, elem, thisobj) {
    //Merge the defaults and passed in options
    thisobj.options = jQuery.extend({}, thisobj.options, options);
    //store DOM and jQuery element
    thisobj.elem = elem;
    thisobj.jQueryElem = jQuery(elem);
    //Build dom initial structure
    thisobj._build();
    //return this so we can chain/use the bridge with less code
    return thisobj;
};

}( window.jQuery || window.ender );