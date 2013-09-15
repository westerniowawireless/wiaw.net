primeShortcodeMeta = {
    attributes:[
        {
            label:"Content",
            id:"content",
            help:'The content of your info box. Use a &lt;br /&gt; to start a new line.',
            isRequired:true
        },
        {
            label:"Type",
            id:"type",
            help:"the kind of alert it is (info, success, warning or error)",
            controlType:"select-control",
            selectValues:[
                'warning',
                'success',
                'info',
                'error'],
            defaultValue:'warning',
            defaultText:'warning (Default)'
        },
        {
            label:"Color",
            id:"color",
            help:'the background color of the alert (you can choose any color you want in hex format)'
        },
        {
            label:"Border Color",
            id:"border",
            help:'the border color of the alert content area'
        },
        {
            label:"Show Close",
            id:"show_close",
            help:"whether to show the close button 'x' on the right",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'true',
            defaultText:'true'
        }
    ],
    defaultContent:"Alert Example!",
    shortcode:"alert"
};
