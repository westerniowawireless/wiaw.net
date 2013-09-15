<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 2/21/12
 * Time: 10:34 AM
 * To change this template use File | Settings | File Templates.
 */

/**
 * A factory for create a schema that can by used by OT_Admin in order to render the theme options.
 */
class OTSchemaFactory
{
    protected $option_elements;
    private $header_count;

    function OTSchemaFactory()
    {
        $this->__construct();
    }

    function __construct()
    {
        $this->option_elements = array();
        $this->header_count = 0;
    }

    /**
     * Adds a Background type control to the schema. A background is used to define the properties associated with
     * the CSS background attribute.
     * Example Usage:
     * $sf->add_background('default_background_id', 'Default Background Title', 'The background to display on all pages');
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     * @return void
     */
    function add_background($id, $title, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'background');
    }

    /**
     * Adds a Select control that is populated with the Categories on the site to the schema.
     * Example Usage:
     * $sf->add_category('test_category_id', 'Test Category Title', 'A test category desc');
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     */
    function add_category($id, $title, $taxonomy = 'category', $description = '')
    {
        $this->add_option_element($id, $title, $description, 'category', $taxonomy);
    }

    /**
     * Adds a control consisting of a Checkbox for each Category on the site to the schema. This
     * should be used to select multiple categories
     * Example Usage:
     * $sf->add_categories('test_categories_id', 'Test Categories Title', 'A test categories control desc');
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     */
    function add_categories($id, $title, $taxonomy = 'category', $description = '')
    {
        $this->add_option_element($id, $title, $description, 'categories', $taxonomy);
    }

    /**
     * Adds a a collection of Checkboxes defined by the $comma_delimited choices to the
     * schema.
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $comma_delimited_choices a comma delimited string of choices
     * @param string $description the option description
     * @return void
     */
    function add_checkbox($id, $title, $comma_delimited_choices, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'checkbox', $comma_delimited_choices);
    }

    /**
     * Adds a Hex colorpicker to the schema
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     */
    function add_colorpicker($id, $title, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'colorpicker');
    }

    /**
     * Adds a Select populated by the ($post_type)s defined on the site to the schema.
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $post_type the post type to populate the select with
     * @param string $description the option description
     * @return void
     */
    function add_custom_post($id, $title, $post_type, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'custom_post', $post_type);
    }

    function add_demo_import($id, $title, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'demo_import');
    }

    /**
     * Adds a new tab to the schema. Any elements added to the schema after this heading and before another heading
     * will be included in the tab defined by this heading.
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     */
    function add_heading($id, $title, $description = '')
    {
        $this->header_count++;
        $this->add_option_element($id, $title, $description, 'heading', $this->header_count);
    }

    /**
     * Adds a plain text input to the schema
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     */
    function add_input($id, $title, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'input');
    }

    /**
     * Add a CSS measurement field to the schema.
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     */
    function add_measurement($id, $title, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'measurement');
    }


    /**
     * Adds a TextArea to the schema
     * @param $id
     * @param $title
     * @param string $description
     * @param int $row_count
     * @return void
     */
    function add_option_data($id, $title, $description = '', $row_count = 8)
    {
        $this->add_option_element($id, $title, $description, 'option_data', $row_count);
    }

    /**
     * Adds a Select populated by the Pages on the site to the schema
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     */
    function add_page($id, $title, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'page');
    }

    function add_pages($id, $title, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'pages');
    }

    /**
     * Adds a Select populated by the Posts on the site to the schema.
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     */
    function add_post($id, $title, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'post');
    }

    /**
     * Adds a collection of radio buttons that are defined by the $comma_delimited list to the schema
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $comma_delimited_choices a comma delimited string of choices
     * @param string $description the option description
     * @return void
     */
    function add_radio($id, $title, $comma_delimited_choices, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'radio', $comma_delimited_choices);
    }

    /**
     * Adds a Select populated by the $comma_delimited_list's values to the schema
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $comma_delimited_choices a comma delimited string of choices
     * @param string $description the option description
     * @return void
     */
    function add_select($id, $title, $comma_delimited_choices, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'select', $comma_delimited_choices);
    }

        /**
     * Adds a Select populated by the $comma_delimited_list's values to the schema
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $comma_delimited_choices a comma delimited string of choices
     * @param string $description the option description
     * @return void
     */
    function add_array_select($id, $title, $value_display_pairs, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'array_select', $value_display_pairs);
    }

    /**
     * Adds a slider with the defined subelements to the schema. This method is used by the OTSliderOptionsSchemaFactory
     * in order to add its schema to the main schema. It isn't recommended that you use this methods directly. Instead,
     * use an instance of OTSliderOptionsSchemaFactory and call $slider_schema_factory->add_slider_to($main_schema_factory).
     *
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @param array $subelements
     * @return void
     */
    function add_slider($id, $title, $description, $subelements)
    {
        $this->add_option_element($id, $title, $description, 'slider', $subelements);
    }

    /**
     * Adds a Select populated by the Tags on the site to the schema
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     */
    function add_tag($id, $title, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'tag');
    }

    /**
     * Adds a TextArea to the schema
     * @param $id
     * @param $title
     * @param string $description
     * @param int $row_count
     * @return void
     */
    function add_textarea($id, $title, $description = '', $row_count = 8)
    {
        $this->add_option_element($id, $title, $description, 'textarea', $row_count);
    }

    /**
     * Renders the HTML defined by the $main_text param to schema
     * @param $id the unique ud associated with the option
     * @param $title the option title
     * @param $main_text the HTML that will be rendered as this textblock
     * @return void
     */
    function add_textblock($id, $title, $main_text)
    {
        $this->add_option_element($id, $title, $main_text, 'textblock');
    }

    /**
     * Adds a collection of controls for defining CSS typography options to the schema
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     */
    function add_typography($id, $title, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'typography');
    }

    /**
     * Add an Image Upload control to the schema
     * @param string $id the unique id associated with the option
     * @param string $title the option title
     * @param string $description the option description
     * @return void
     */
    function add_upload($id, $title, $description = '')
    {
        $this->add_option_element($id, $title, $description, 'upload');
    }

    /**
     * Adds the options element specified to the internal schema array
     * @param $item_id
     * @param $item_title
     * @param $item_desc
     * @param $item_type
     * @param string $item_options
     * @return void
     */
    function add_option_element($item_id, $item_title, $item_desc, $item_type, $item_options = '')
    {
        $this->option_elements[] = array(
            'item_id' => $item_id,
            'item_title' => $item_title,
            'item_desc' => $item_desc,
            'item_type' => $item_type,
            'item_options' => $item_options
        );
    }

    /**
     * @return StdObject the schema in object form
     */
    function get_schema_object()
    {
        return arrayToObject($this->option_elements);
    }

    function get_schema_array(){
        return $this->option_elements;
    }
}

/**
 * This is a factory for defining a slider sub-schema and adding it to an instance of OTSchemaFactory.
 */
class OTSliderOptionsSchemaFactory extends OTSchemaFactory
{
    private $slider_id;
    private $slider_title;
    private $slider_description;
    private $slide_title_field_title, $slide_title_field_description;

    /**
     * @param string $slider_id slider option's unique id
     * @param string $slider_title slider option's title
     * @param string $slider_description slider option's description
     * @param string $slide_title_field_title the title of the title field that appears on each slide
     * @param string $slide_title_field_description the description field of the title that appears on each slider
     */
    function OTSliderOptionsSchemaFactory($slider_id, $slider_title, $slider_description, $slide_title_field_title,
        $slide_title_field_description)
    {
        $this->__construct($slider_id, $slider_title, $slider_description, $slide_title_field_title,
                           $slide_title_field_description);
    }

    /**
     * @param string $slider_id slider option's unique id
     * @param string $slider_title slider option's title
     * @param string $slider_description slider option's description
     * @param string $slide_title_field_title the title of the title field that appears on each slide
     * @param string $slide_title_field_description the description field of the title that appears on each slider
     */
    function __construct($slider_id, $slider_title, $slider_description, $slide_title_field_title,
        $slide_title_field_description)
    {
        parent::__construct();
        $this->slider_id = $slider_id;
        $this->slider_title = $slider_title;
        $this->slider_description = $slider_description;

        $this->slide_title_field_title = $slide_title_field_title;
        $this->slide_title_field_description = $slide_title_field_description;

        $this->add_option_element('order', 'Order', 'the hidden order field', 'hidden', array('class' => 'option-tree-slider-order'));
        $this->add_option_element('id', 'ID', 'the hidden id field', 'hidden', array('class' => 'option-tree-slider-id'));
        $this->add_option_element('title', $this->slide_title_field_title, $this->slide_title_field_description,
                                  'input', array('class' => 'option-tree-slider-title'));
    }

    /**
     * We override the add_option_element methods so that the arrays added are of the correct format
     * for the slider sub-schema
     * @param $item_id
     * @param $item_title
     * @param $item_desc
     * @param $item_type
     * @param string $item_options
     * @return void
     */
    function add_option_element($item_id, $item_title, $item_desc, $item_type, $item_options = '')
    {
        $this->option_elements[] = array(
            'item_local_id' => $item_id,
            'item_title' => $item_title,
            'item_desc' => $item_desc,
            'item_type' => $item_type,
            'item_options' => $item_options
        );
    }

    /**
     * Add the slider control defined by this factory to the $schema_factory provided
     * @param OTSchemaFactory $schema_factory the factory to add this slider definition to
     * @return void
     */
    function add_slider_to($schema_factory)
    {
        $schema_factory->add_slider($this->slider_id,
                                    $this->slider_title,
                                    $this->slider_description,
                                    $this->option_elements);
    }
}


function array_to_obj($array, &$obj)
{
    foreach ($array as $key => $value)
    {
        if (is_array($value)) {
            $obj->$key = new stdClass();
            array_to_obj($value, $obj->$key);
        }
        else
        {
            $obj->$key = $value;
        }
    }
    return $obj;
}

/*
 * Recursively creates an object from the array.
 */
function arrayToObject($array)
{
    $object = new stdClass();
    return array_to_obj($array, $object);
}

