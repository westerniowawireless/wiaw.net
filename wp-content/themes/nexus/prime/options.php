<?php
global $post_options_schema_factory;
global $page_options_schema_factory;
global $portfolio_options_schema_factory;
global $flex_slide_options_schema_factory;
global $cp_slide_options_schema_factory;

/**
 * Serves up the factory associated with the provided $post_type.
 * @param $post_type
 * @return OTSchemaFactory
 */
function prime_get_options_schema_factory($post_type)
{
    global $post_options_schema_factory;
    global $page_options_schema_factory;
    global $portfolio_options_schema_factory;
    global $flex_slide_options_schema_factory;
    global $content_slide_options_schema_factory;
    global $cp_slide_options_schema_factory;


    if (!(isset($post_options_schema_factory) &&
        isset($page_options_schema_factory) &&
        isset($portfolio_options_schema_factory) && isset($flex_slide_options_schema_factory)
        && isset($content_slide_options_schema_factory))
    ) prime_initialize_options();

    switch ($post_type) {
        case 'post':
            global $post_options_schema_factory;
            return $post_options_schema_factory;
            break;
        case 'portfolio':
            global $portfolio_options_schema_factory;
            return $portfolio_options_schema_factory;
            break;
        case 'page':
            global $page_options_schema_factory;
            return $page_options_schema_factory;
            break;
        case 'flex_slide':
            global $flex_slide_options_schema_factory;
            return $flex_slide_options_schema_factory;
        case 'content_slide':
            global $content_slide_options_schema_factory;
            return $content_slide_options_schema_factory;
        case 'cp_slide':
            global $cp_slide_options_schema_factory;
            return $cp_slide_options_schema_factory;
        default:
            return new OTSchemaFactory();
    }
}


function prime_initialize_options()
{
    global $post_options_schema_factory;
    global $page_options_schema_factory;
    global $portfolio_options_schema_factory;
    global $flex_slide_options_schema_factory;
    global $content_slide_options_schema_factory;
    global $cp_slide_options_schema_factory;

    /*
    * *************************************
    * MAKE SURE ALL POST META FIELDS START WITH '_' CHARACTER!!!
    */
    global $FRONTEND_STRINGS;

    /**
     * POST OPTIONS
     */
    $post_options_schema_factory = new OTSchemaFactory();

    $post_options_schema_factory->add_input('_prime_subtitle',
        $FRONTEND_STRINGS['subtitle'],
        $FRONTEND_STRINGS['post_subtitle_desc']);

    $post_options_schema_factory->add_upload('_prime_preview_image',
        $FRONTEND_STRINGS['preview_image'],
        $FRONTEND_STRINGS['post_preview_image_desc']);
    $post_options_schema_factory->add_background('_prime_background',
        $FRONTEND_STRINGS['bkgd'],
        $FRONTEND_STRINGS['post_bkgd_desc']);


    /**
     * PAGE OPTIONS
     */
    $page_options_schema_factory = new OTSchemaFactory();

    $page_options_schema_factory->add_input('_prime_subtitle',
        $FRONTEND_STRINGS['subtitle'],
        $FRONTEND_STRINGS['page_subtitle_desc']);

    $page_options_schema_factory->add_array_select('_prime_slider_type', 'Slider Type',
        array(
            'flex_slider' => 'Flex Slider',
            'content_slider' => 'Content Slider',
            'cp_slider' => 'CP Slider'
        ));

    //FLEXSLIDER Options
    $page_options_schema_factory->add_heading('_prime_flex_slider_options', 'Flex Slider Options');
    $page_options_schema_factory->add_categories('_prime_flex_slide_categories', 'Flex Slide Categories', 'flex_slide_category',
        'The Flex Slide Categories to display in this slider. All Flex Slides belonging to the categories checked above will display in this slider.');

    $page_options_schema_factory->add_array_select('_prime_flex_slider_order', 'Order Direction',
        array('ASC' => 'Ascending', 'DESC' => 'Descending'), $FRONTEND_STRINGS['page_slide_orderdir_desc']);
    $page_options_schema_factory->add_array_select('_prime_flex_slider_orderby', 'Order By',
        array(
            'none' => 'None', 'ID' => 'Item ID', 'author' => 'Author', 'title' => 'Title',
            'date' => 'Date', 'modified' => 'Modified', 'parent' => 'Parent', 'rand' => 'Random',
            'comment_count' => 'Comment Count', 'menu_order' => 'Menu Order'
        ), $FRONTEND_STRINGS['page_slide_orderby_desc']);

    $page_options_schema_factory->add_input('_prime_flex_slider_speed', 'Slideshow Speed',
        $FRONTEND_STRINGS['page_slideshow_speed_desc']);

    $page_options_schema_factory->add_heading('_prime_content_slider_options', 'Content Slider Options');
    $page_options_schema_factory->add_categories('_prime_content_slide_categories', 'Content SlideCategories', 'content_slide_category',
        'The Content Slide Categories to display in this slider. All Content Slides belonging to the categories checked above will display in this slider.');
    $page_options_schema_factory->add_array_select('_prime_content_slider_order', 'Order Direction',
        array('ASC' => 'Ascending', 'DESC' => 'Descending'), $FRONTEND_STRINGS['page_slide_orderdir_desc']);
    $page_options_schema_factory->add_array_select('_prime_content_slider_orderby', 'Order By',
        array(
            'none' => 'None', 'ID' => 'Item ID', 'author' => 'Author', 'title' => 'Title',
            'date' => 'Date', 'modified' => 'Modified', 'parent' => 'Parent', 'rand' => 'Random',
            'comment_count' => 'Comment Count', 'menu_order' => 'Menu Order'
        ), $FRONTEND_STRINGS['page_slide_orderby_desc']);
    $page_options_schema_factory->add_input('_prime_content_slider_speed', 'Slideshow Speed',
        $FRONTEND_STRINGS['page_slideshow_speed_desc']);

    $page_options_schema_factory->add_heading('_prime_cp_slider_options', 'CP Slider Options');
    $page_options_schema_factory->add_categories('_prime_cp_slide_categories', 'CP Slide Categories', 'cp_slide_category',
        'The CP Slide Categories to display in this slider. All CP Slides belonging to the categories checked above will display in this slider.');
    $page_options_schema_factory->add_array_select('_prime_cp_slider_order', 'Order Direction',
        array('ASC' => 'Ascending', 'DESC' => 'Descending'), $FRONTEND_STRINGS['page_slide_orderdir_desc']);
    $page_options_schema_factory->add_array_select('_prime_cp_slider_orderby', 'Order By',
        array(
            'none' => 'None', 'ID' => 'Item ID', 'author' => 'Author', 'title' => 'Title',
            'date' => 'Date', 'modified' => 'Modified', 'parent' => 'Parent', 'rand' => 'Random',
            'comment_count' => 'Comment Count', 'menu_order' => 'Menu Order'
        ), $FRONTEND_STRINGS['page_slide_orderby_desc']);
    $page_options_schema_factory->add_input('_prime_cp_slider_speed', 'Slideshow Speed',
        $FRONTEND_STRINGS['page_slideshow_speed_desc']);

    /**
     * PORTFOLIO ITEM OPTIONS
     */
    $portfolio_options_schema_factory = new OTSchemaFactory();



    $portfolio_options_schema_factory->add_input('_prime_subtitle',
        $FRONTEND_STRINGS['subtitle'],
        $FRONTEND_STRINGS['portfolio_subtitle_desc']);

    $portfolio_options_schema_factory->add_upload('_prime_preview_image',
        $FRONTEND_STRINGS['preview_image'],
        $FRONTEND_STRINGS['portfolio_preview_image_desc']);

    $portfolio_options_schema_factory->add_select('_prime_portfolio_item_type',
        'Preview Type',
        'Featured Image, Embedded Video', 'The Preview behavior of the image.');


    $portfolio_options_schema_factory->add_heading('_prime_video_embed_heading', 'Video Embed Type Options');
    $portfolio_options_schema_factory->add_input('_prime_video_embed_url',
        $FRONTEND_STRINGS['portfolio_video_embed_url'],
        $FRONTEND_STRINGS['portfolio_video_embed_desc']);

    $portfolio_options_schema_factory->add_heading('_prime_featured_image_heading', 'Featured Image Preview Type Options');
    $portfolio_options_schema_factory->add_select('_prime_image_portfolio_display', 'Image Display Type',
        'Preview Image, Lightbox');
    $portfolio_options_schema_factory->add_input('_prime_preview_image_href', 'Preview Image Link',
        'The link address for the Preview Image click');
    $portfolio_options_schema_factory->add_upload('_prime_lightbox_image',
        'Lightbox Image',
        'The image to show on Lightbox launch in the Portfolio. If not specified and Lightbox is enabled, the featured image will be displayed.');


    /**
     * Flex Slide Options
     */
    $flex_slide_options_schema_factory = new OTSchemaFactory();
    $flex_slide_options_schema_factory->add_input('_prime_slide_caption',
        $FRONTEND_STRINGS['caption'],
        $FRONTEND_STRINGS['flex_slide_caption_desc']);
    $flex_slide_options_schema_factory->add_input('_prime_slide_subcaption',
        $FRONTEND_STRINGS['subcaption'],
        $FRONTEND_STRINGS['flex_slide_subcaption_desc']);
    $flex_slide_options_schema_factory->add_select('_prime_caption_position',
        'Slider Caption Position',
        'top-right,top-left,bottom-right,bottom-left,center-right,center-left',
        $FRONTEND_STRINGS['flex_slide_caption_pos_desc']);
    $flex_slide_options_schema_factory->add_input('_prime_link_url',
        $FRONTEND_STRINGS['flex_slide_link_url'],
        $FRONTEND_STRINGS['flex_slide_link_url_desc']);

    $flex_slide_options_schema_factory->add_checkbox('_prime_gallery_link_new_window', 'Open Link in New Window', 'Yes');

    $flex_slide_options_schema_factory->add_heading('_prime_desktop_heading', 'Desktop layout - 980px');
    $flex_slide_options_schema_factory->add_upload('_prime_slide_image',
        $FRONTEND_STRINGS['fs_image_desktop'],
        $FRONTEND_STRINGS['fs_image_desktop_desc']);
    $flex_slide_options_schema_factory->add_input('_prime_desktop_height', 'Slide Height');

    $flex_slide_options_schema_factory->add_heading('_prime_tablet_heading', 'Tablet layout - 740px');
    $flex_slide_options_schema_factory->add_upload('_prime_slide_image_tablet',
        $FRONTEND_STRINGS['fs_image_tablet'],
        $FRONTEND_STRINGS['fs_image_tablet_desc']);
    $flex_slide_options_schema_factory->add_input('_prime_tablet_height', 'Slide Height');


    $flex_slide_options_schema_factory->add_heading('_prime_mlandscape_heading', 'Mobile Landscape layout - 460px');
    $flex_slide_options_schema_factory->add_upload('_prime_slide_image_mlandscape',
        $FRONTEND_STRINGS['fs_image_mlandscape'],
        $FRONTEND_STRINGS['fs_image_mlandscape_desc']);
    $flex_slide_options_schema_factory->add_input('_prime_mobile_landscape_height', 'Slide Height');


    $flex_slide_options_schema_factory->add_heading('_prime_mportrait_heading', 'Mobile Portrait layout - 300px');
    $flex_slide_options_schema_factory->add_upload('_prime_slide_image_mportrait',
        $FRONTEND_STRINGS['fs_image_mportrait'],
        $FRONTEND_STRINGS['fs_image_mportrait_desc']);
    $flex_slide_options_schema_factory->add_input('_prime_mobile_portrait_height', 'Slide Height');

    /**
     * Content Slide Options
     */
    $content_slide_options_schema_factory = new OTSchemaFactory();

    $content_slide_options_schema_factory->add_heading('_prime_desktop_heading', 'Desktop layout - 980px');
    $content_slide_options_schema_factory->add_upload('_prime_slide_image',
        $FRONTEND_STRINGS['cp_slide_image_title'],
        $FRONTEND_STRINGS['cp_slide_image_desc']);
    $content_slide_options_schema_factory->add_input('_prime_desktop_height', 'Slide Height');

    $content_slide_options_schema_factory->add_heading('_prime_tablet_heading', 'Tablet layout - 740px');
    $content_slide_options_schema_factory->add_upload('_prime_slide_image_tablet',
        $FRONTEND_STRINGS['cp_image'],
        $FRONTEND_STRINGS['cp_image_tablet_desc']);
    $content_slide_options_schema_factory->add_input('_prime_tablet_height', 'Slide Height');

    $content_slide_options_schema_factory->add_heading('_prime_mlandscape_heading', 'Mobile Landscape layout - 460px');
    $content_slide_options_schema_factory->add_upload('_prime_slide_image_mlandscape',
        $FRONTEND_STRINGS['cp_image'],
        $FRONTEND_STRINGS['cp_image_mlandscape_desc']);
    $content_slide_options_schema_factory->add_input('_prime_mobile_landscape_height', 'Slide Height');

    $content_slide_options_schema_factory->add_heading('_prime_mportrait_heading', 'Mobile Portrait layout - 300px');
    $content_slide_options_schema_factory->add_upload('_prime_slide_image_mportrait',
        $FRONTEND_STRINGS['cp_image'],
        $FRONTEND_STRINGS['cp_image_mportrait_desc']);
    $content_slide_options_schema_factory->add_input('_prime_mobile_portrait_height', 'Slide Height');

    /*
    * CP Slide options
    */
    $cp_slide_options_schema_factory = new OTSchemaFactory();

    $cp_slide_options_schema_factory->add_select('_prime_alignment', $FRONTEND_STRINGS['cp_layout'],
        'Left, Right', $FRONTEND_STRINGS['cp_layout_desc']);

    $cp_slide_options_schema_factory->add_heading('_prime_desktop_heading', 'Desktop layout - 980px');
    $cp_slide_options_schema_factory->add_upload('_prime_slide_image',
        $FRONTEND_STRINGS['cp_image'],
        $FRONTEND_STRINGS['cp_image_desktop_desc']);
    $cp_slide_options_schema_factory->add_upload('_prime_foreground_image',
        $FRONTEND_STRINGS['cp_fg_image'],
        $FRONTEND_STRINGS['cp_fg_image_desktop_desc']);

    $cp_slide_options_schema_factory->add_input('_prime_desktop_height', 'Slide Height');

    $cp_slide_options_schema_factory->add_heading('_prime_tablet_heading', 'Tablet layout - 740px');
    $cp_slide_options_schema_factory->add_upload('_prime_slide_image_tablet',
        $FRONTEND_STRINGS['cp_image'],
        $FRONTEND_STRINGS['cp_image_tablet_desc']);
    $cp_slide_options_schema_factory->add_upload('_prime_foreground_image_tablet',
        $FRONTEND_STRINGS['cp_fg_image'],
        $FRONTEND_STRINGS['cp_fg_image_tablet_desc']);
    $cp_slide_options_schema_factory->add_input('_prime_tablet_height', 'Slide Height');


    $cp_slide_options_schema_factory->add_heading('_prime_mlandscape_heading', 'Mobile Landscape layout - 460px');
    $cp_slide_options_schema_factory->add_upload('_prime_slide_image_mlandscape',
        $FRONTEND_STRINGS['cp_image'],
        $FRONTEND_STRINGS['cp_image_mlandscape_desc']);
    $cp_slide_options_schema_factory->add_upload('_prime_foreground_image_mlandscape',
        $FRONTEND_STRINGS['cp_fg_image'],
        $FRONTEND_STRINGS['cp_fg_image_mlandscape_desc']);
    $cp_slide_options_schema_factory->add_input('_prime_mobile_landscape_height', 'Slide Height');


    $cp_slide_options_schema_factory->add_heading('_prime_mportrait_heading', 'Mobile Portrait layout - 300px');
    $cp_slide_options_schema_factory->add_upload('_prime_slide_image_mportrait',
        $FRONTEND_STRINGS['cp_image'],
        $FRONTEND_STRINGS['cp_image_mportrait_desc']);
    $cp_slide_options_schema_factory->add_upload('_prime_foreground_image_mportrait',
        $FRONTEND_STRINGS['cp_fg_image'],
        $FRONTEND_STRINGS['cp_fg_image_mportrait_desc']);
    $cp_slide_options_schema_factory->add_input('_prime_mobile_portrait_height', 'Slide Height');


}