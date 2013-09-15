primeShortcodeMeta = {
    attributes:[
        {
            label:"Content",
            id:"content",
            help: 'Icon Text'
        },
        {
            label:"Color",
            id:"color",
            help:"the foreground color of the icon (HEX)",
            defaultValue: '#212121',
            defaultText: '#212121'
        },
        {
            label:"Circle",
            id:"circle",
            help:"the background color of the icon (the color of the circle). Leave blank to if no background circle is desired. (HEX)"
        },
        {
            label:"Icon",
            id:"icon",
            help:"the icon shape that should be displayed",
            controlType:"select-control",
            selectValues: window.iconIconOptions,
            defaultValue: 'star',
            defaultText: 'star (Default)'
        }
    ],
    disablePreview: true,
    defaultContent:"Icon Text",
    shortcode:"icon"
};
