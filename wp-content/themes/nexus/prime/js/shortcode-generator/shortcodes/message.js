primeShortcodeMeta = {
    attributes:[
        {
			label:"Content",
			id:"content",
			help: 'The content of your info box. Use a &lt;br /&gt; to start a new line.',
			isRequired:true
		},
        {
            label:"Type",
            id:"type",
            help:"Values: &lt;empty&gt;, info, alert, tick, download, note.",
            controlType:"select-control",
            selectValues:[
                'warning',
                'success',
                'info',
                'error'],
            defaultValue: 'warning',
            defaultText: 'warning (Default)'
        },
        {
            label:"Color",
            id:"color",
            help:'the background color of the message (you can choose any color you want in hex format)'
        },
        {
            label:"Border Color",
            id:"border",
            help:'the border color of the message content area'
        },
        {
            label:"Show Close",
            id:"show_close",
            help:"Show a close icon to close the alert?",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        }
    ],
    defaultContent:"Well done! You successfully read this alert message.",
    shortcode:"message"
};
