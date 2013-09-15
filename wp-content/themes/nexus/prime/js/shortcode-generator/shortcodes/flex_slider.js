primeShortcodeMeta = {
    attributes:[
        {
            label:"Categories",
            id:"categories",
            help:"the flex slide categories to display in the slider",
            controlType:"multiselect-control",
            selectValues:_.pluck(PrimeSCGen['flex_slide_categories'], 'slug')
        },
        {
            label:"Slideshow Speed (Milliseconds)",
            id:"slideshow_speed",
            help:'how long to stay on each slide before auto-advancing (set to -1 to disable auto-advance)(Ex. 8000)'
        },
        {
            label:"Slider Order",
            id:"slider_order",
            help:"whether to use ascending or descending order",
            controlType:"select-control",
            selectValues:[
                'ASC',
                'DESC']
        },
        {
            label:"Slider Orderby",
            id:"slider_orderby",
            help:"what parameter to order the slides by",
            controlType:"select-control",
            selectValues:[
                'none',
                'ID',
                'author',
                'title',
                'date',
                'modified',
                'parent',
                'rand' ,
                'comment_count',
                'menu_order'
            ]

        }

    ],
    disablePreview:true,
    shortcode:"flex_slider"
};
