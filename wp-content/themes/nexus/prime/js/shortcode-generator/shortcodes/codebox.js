primeShortcodeMeta = {
    attributes:[
        {
            label:"Display Line Numbers",
            id:"line_numbers",
            help:"Set true to display line numbers in the codebox",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true (Default)'
        },
        {
            label:"Remove Breaks",
            id:"remove_breaks",
            help:"Set true to remove breaks from the code in the codebox",
            controlType:"select-control",
            selectValues:['false', 'true'],
            defaultValue: 'true',
            defaultText: 'true (Default)'
        },
        {
            label:"Language",
            id:"lang",
            help:"The code language",
            controlType:"select-control",
            selectValues:[
                "bsh", "c", "cc", "cpp", "cs", "csh", "cyc", "cv", "htm", "html",
                "java", "js", "m", "mxml", "perl", "pl", "pm", "py", "rb", "sh",
                "xhtml", "xml", "xsl"],
            defaultValue: 'html',
            defaultText: 'HTML (Default)'
        }
    ],
    disablePreview: true,
    defaultContent:'"Paste code here..."',
    shortcode:"codebox"
};
