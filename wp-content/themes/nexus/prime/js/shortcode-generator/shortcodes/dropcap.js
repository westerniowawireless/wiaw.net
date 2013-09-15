primeShortcodeMeta = {
    attributes:[
        {
            label:"Content",
            id:"content",
            help:'The content of your dropcap',
            isRequired:true
        },

        {
            label:'Style',
            id:'style',
            help:'set to "plain" if the dropcap should be a transparent background',
            controlType:"select-control",
            selectValues:[
                'circle',
                'plain'
            ]
        },
        {
            label:"Color",
            id:"color",
            help:'the background color of the dropcap (you can choose any color you want in hex format)'
        }
    ],
    defaultContent:"A",
    shortcode:"dropcap"
};
