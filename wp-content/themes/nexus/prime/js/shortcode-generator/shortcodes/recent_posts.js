primeShortcodeMeta = {
    attributes:[
        {
            label:"Categories",
            id:"category_slugs",
            help:"which post categories to display",
            controlType:"multiselect-control",
            selectValues:_.pluck(PrimeSCGen['post_categories'], 'slug')
        },
        {
            label:"Show Featured Images",
            id:"show_image",
            help:"whether to show the featured image thumbnail",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'true',
            defaultText:'true'
        }
    ],
    defaultContent:'<h5 style="margin-top: 6px;">[icon icon="opendocument" color="#ffffff" circle="#191919"]Recent Posts[/icon]</h5>\
The recent posts shortcode shows off\
your latest blog entries. It’s available\
with both horizontal and vertical layouts.\
\
<p><a href="http://www.themeforest.net">Visit the blog &rarr;</a></p>\
',
    disablePreview:true,
    shortcode:"recent_posts"
};
