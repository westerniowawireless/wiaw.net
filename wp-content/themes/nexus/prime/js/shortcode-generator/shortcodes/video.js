primeShortcodeMeta = {
    attributes:[
        {
            label:"Image Source",
            id:"src",
            help:"the URL of the video you want to embed",
            validateLink:true
        },
        {
            label:"Width",
            id:"width",
            help: 'the width and height will be used to maintain the aspect ratio of the video as it is resized'
        },
        {
            label:"Height",
            id:"height",
            help: 'the width and height will be used to maintain the aspect ratio of the video as it is resized'
        },
        {
            label:"Autosize",
            id:"autosize",
            help:"whether or not you want the responsive autoresize to run",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'false',
            defaultText: 'false'
        },
        {
            label:"Autoplay",
            id:"autoplay",
            help:"whether to start playing the video as soon as the page is loaded",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'false',
            defaultText: 'false'
        }
    ],
    shortcode:"video"
};