primeShortcodeMeta = {
    attributes:[

        {
            label:"Image Source",
            id:"src",
            help:"the URL of the image you want to display",
            validateLink:true
        },
        {
            label:"Link To",
            id:"linkto",
            help:"a URL that should be opened when the image is clicked. Note: clickthrough and lightbox must be set to false for this to work.",
            validateLink:true
        },
        {
            label:"Width",
            id:"width",
            help: ' the width and height will be used to maintain the aspect ratio of the image as it is resized'
        },
        {
            label:"Height",
            id:"height",
            help: ' the width and height will be used to maintain the aspect ratio of the image as it is resized'
        },
        {
            label:"Lightbox",
            id:"lightbox",
            help:"Enable prettyPhoto on click",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        },
        {
            label:"Title",
            id:"title",
            help:"the title of the image (will appear in the lightbox popup)"
        },
        {
            label:"Alt",
            id:"alt",
            help:"the alt of the image"
        },
        {
            label:"Autoresize",
            id:"autoresize",
            help:"whether or not you want the responsive autoresize to run",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'false',
            defaultText: 'false'
        },
        {
            label:"Clickthrough",
            id:"clickthrough",
            help:" whether you want to navigate to the image URL when the image is clicked",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        }
    ],
    shortcode:"image"
};