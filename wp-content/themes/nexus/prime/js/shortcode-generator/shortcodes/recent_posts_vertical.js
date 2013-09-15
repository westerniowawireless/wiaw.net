primeShortcodeMeta = {
    attributes:[
        {
            label:"Number of Posts",
            id:"num_posts",
            help: 'The number of posts to display'
        },
        {
            label:"Show Featured Images",
            id:"show_image",
            help:"whether to show the featured image thumbnail",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        }
    ],
    disablePreview: true,
    shortcode:"recent_posts_vert"
};
