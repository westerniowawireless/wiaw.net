/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 3/27/12
 * Time: 10:30 AM
 * To change this template use File | Settings | File Templates.
 */

/**
 * This should be called on the select that is determining the heading displays
 * The mapping provided should be the value of the select to the heading that should be
 * displayed when that value is selected. All other value-id pairings will be hidden
 * when a given select value is selected.
 */
var PrimeToggleHeadings = {
    options:{
        valueToHeading:null
    },
    _build:function () {
        if (this.jQueryElem.length > 0) {
            var that = this;
            this.jQueryElem.change(function () {
                that.updateDisplay();
            });
            that.updateDisplay();
        }
    },
    updateDisplay:function () {
        var eleVal = this.jQueryElem.val();
        jQuery.each(this.options.valueToHeading, function (value, headingID) {
            if (value === eleVal) {
                jQuery(headingID).css('visibility', 'visible').css('display', 'block');
            }
            else {
                jQuery(headingID).css('visibility', 'collapse').css('display', 'none');
            }
        });
    }
}

jQuery.plugin('primeToggleHeadings', PrimeToggleHeadings);

jQuery(document).ready(function ($) {
//    $('#_prime_portfolio_item_type').primeTogglePortfolioTypeOptions({});

    $('#_prime_slider_type').primeToggleHeadings({
        valueToHeading:{
            flex_slider:'#option__prime_flex_slider_options',
            content_slider:'#option__prime_content_slider_options',
            cp_slider:'#option__prime_cp_slider_options'
        }
    });

    $('#_prime_portfolio_item_type').primeToggleHeadings({
        valueToHeading:{
            'Featured Image':'#option__prime_featured_image_heading',
            'Embedded Video':'#option__prime_video_embed_heading'
        }
    });
});

