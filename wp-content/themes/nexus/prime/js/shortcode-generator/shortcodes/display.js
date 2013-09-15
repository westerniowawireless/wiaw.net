primeShortcodeMeta = {
    attributes:[
        {
            label:"Show on Desktop",
            id:"desktop",
            help:"Whether to show the content inside this shortcode in the desktop layout (960px+)",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'true',
            defaultText:'true'
        },
        {
            label:"Show on Tablet Landscape",
            id:"tablet_landscape",
            help:"Whether to show the content inside this shortcode on tablets in landscape mode (960px+)",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'true',
            defaultText:'true'
        },
        {
            label:"Show on Tablet Portrait",
            id:"tablet_portrait",
            help:"Whether to show the content inside this shortcode on tablets in portrait mode (768px - 959px)",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'true',
            defaultText:'true'
        },
        {
            label:"Show on Mobile Landscape",
            id:"mobile_landscape",
            help:"Whether to show the content inside this shortcode on smartphones in landscape mode (480px - 767px)",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'true',
            defaultText:'true'
        },
        {
            label:"Show on Mobile Portrait",
            id:"mobile_portrait",
            help:"Whether to show the content inside this shortcode on smartphones in portrait mode (below 480px)",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'true',
            defaultText:'true'
        }
    ],
    disablePreview:true,
    defaultContent:'Your content goes here.',
    shortcode:"display"
};
