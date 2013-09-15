primeShortcodeMeta = {
    attributes:[
        {
            label:"Categories",
            id:"category_slugs",
            help:"which portfolio item categories to display",
            controlType:"multiselect-control",
            selectValues:_.pluck(PrimeSCGen['portfolio_categories'], 'slug')
        }
    ],
    defaultContent: '<h5 style="margin-top: 6px;">[icon icon="window" color="#ffffff" circle="#191919"]Our Portfolio[/icon]</h5>\
The portfolio shortcode lets you show off items in your portfolio -- your projects, products, services, tutorials, or anything else!\
<p><a href="http://www.themeforest.net">See the full portfolio &rarr;</a></p>',
    disablePreview: true,
    shortcode:"recent_projects"
};
