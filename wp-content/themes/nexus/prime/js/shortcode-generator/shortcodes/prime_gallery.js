primeShortcodeMeta = {
    attributes:[
        {
            label:"Width",
            id:"width",
            help: 'the width and height are used to determine the aspect ratio of the images in the gallery'
        },
        {
            label:"Height",
            id:"height",
            help: 'the width and height are used to determine the aspect ratio of the images in the gallery'
        },
        {
            label:"Desktop Columns",
            id:"desktop",
            help:" the number of columns in the desktop layout",
            controlType:"range-control",
            defaultValue: 2,
            rangeValues:[1, 6]
        },
        {
            label:"Tablet Columns",
            id:"tablet",
            help:" the number of columns in the tablet layout",
            controlType:"range-control",
            defaultValue: 2,
            rangeValues:[1, 6]
        },
        {
            label:"Mobile Columns",
            id:"mobile",
            help:"the number of columns in the mobile layout",
            controlType:"range-control",
            defaultValue: 2,
            rangeValues:[1, 6]
        },
        {
            label:"Auto Resize",
            id:"autoresize",
            help:"Set to true if the images should be resized so the columns will fit the width of the gallery",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'false',
            defaultText: 'false'
        }
    ],
    shortcode:"prime_gallery"
};