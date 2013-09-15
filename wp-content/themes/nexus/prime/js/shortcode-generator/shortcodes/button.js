primeShortcodeMeta = {
    attributes:[
        {
            label:"Text",
            id:"content",
            help:"what the button text should be",
            isRequired:true,
            defaultValue:'default',
            defaultText:'default'
        },
        {
            label:"Link",
            id:"link",
            help:" the URL address that should be opened when the button is clicked",
            validateLink:true
        },
        {
            label:"Color",
            id:"color",
            help:" the background color of the button (you can pick any color you like in a hex format)"
        },
        {
            label:"CSS Class",
            id:"class",
            help:"any css classes you'd like to add to the button"
        },
        {
            label:"Open in a new window",
            id:"window",
            help:" whether or not you want the link to open in a new window",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue:'',
            defaultText:'no (Default)'
        },
        {
            label:"Size",
            id:"size",
            help:"pick a small, medium or large button",
            controlType:"select-control",
            selectValues:['medium', 'large', 'small'],
            defaultValue:'medium',
            defaultText:'default'
        }

    ],
    defaultContent:'Example',
    shortcode:"button"
};
