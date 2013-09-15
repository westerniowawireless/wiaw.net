primeShortcodeMeta = {
    attributes:[
        {
            label:"Content",
            id:"content",
            help: 'The content of your toggle',
            isRequired:true
        },
        {
            label:"title",
            id:"title",
            help: 'the title of the toggle'
        },
        {
            label:"Color",
            id:"color",
            help:'the background color of toggle header (you can choose any color you want in hex format)'
        },
        {
            label:"Border Color",
            id:"border",
            help:'the border color of the toggle content area'
        },
        {
            label:"Open by Default",
            id:"open",
            help:"whether the toggle should be open by default",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        }
    ],
    disablePreview: true,
    defaultContent:"Well done! This is your toggle content.",
    shortcode:"toggle"
};
