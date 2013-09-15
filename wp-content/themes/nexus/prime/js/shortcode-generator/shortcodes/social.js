primeShortcodeMeta = {
    attributes:[
        {
            label:"Show Facebook",
            id:"show_fb",
            help:"whether to show the Facebook Like button",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'true',
            defaultText:'true'
        },
        {
            label:"Show Google+",
            id:"show_google",
            help:"whether to show the Google+ button",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'true',
            defaultText:'true'
        },
        {
            label:"Show Tweet",
            id:"show_twitter",
            help:"whether to show the Twitter Tweet button",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'true',
            defaultText:'true'
        },
        {
            label:"Show Linked In",
            id:"show_linkedin",
            help:"whether to show the LinkedIn button",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'true',
            defaultText:'true'
        },
        {
            label:"Counter Position",
            id:"counter",
            help:"the position of the counter bubble (top or right)",
            controlType:"select-control",
            selectValues:['top', 'right'],
            defaultValue:'top',
            defaultText:'top (Default)'
        }
    ],
    disablePreview:true,
    shortcode:"social"
};
