primeShortcodeMeta = {
    attributes:[
        {
            label:"Content",
            id:"content",
            help: 'The content of your info box. Use a &lt;br /&gt; to start a new line.',
            isRequired:true
        },
        {
            label:"Style",
            id:"style",
            help:"The alignment of the quote",
            controlType:"select-control",
            selectValues:[
                'left',
                'right'],
            defaultValue: 'left',
            defaultText: 'left (Default)'
        }
    ],
    disablePreview: true,
    defaultContent:"This is an example quote",
    shortcode:"pullquote"
};
