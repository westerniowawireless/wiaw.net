primeShortcodeMeta = {
    attributes:[
        {
            label:"Sync",
            id:"sync",
            help:"whether to keep only one item open at a time",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true'
        },
        {
            label:"Number of Accordion Items",
            id:"accordion_item_count",
            help: 'The number of accordion items to include',
                        defaultValue:'3'
        }
    ],
    disablePreview:true,
    customMakeShortcode: function(b) {
        var values = b;
        console.log(b);
        var retString = '[accordion sync="' + values.sync + '"]<br/><br/>';

        for (i = 0; i < parseInt(values.accordion_item_count); i++) {
            retString += i == 0 ? '[accordion_item title="Accordion Item' +
                (i + 1) + '" open="true"]' : '[accordion_item title="Accordion Item' + (i + 1) + '"]';

            retString += '<br/><br/>Accordion Item Content Goes Here<br/><br/>[/accordion_item]<br/><br/>';
        }
        retString += '[/accordion]';

        return retString;
    }
};