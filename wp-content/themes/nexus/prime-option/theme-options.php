<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 2/16/12
 * Time: 9:41 AM
 * To change this template use File | Settings | File Templates.
 *
 * **************************************************************
 * Theme Options Usage
 * **************************************************************
 * The theme option framework for this theme is a highly modified version of OptionTree. The major changes to the
 * options framework are:
 * 1. Removed graphical interface for editing the options schema
 * 2. Moved options schema declaration to this file (theme-options.php). Declaration through array syntax.
 * 3. Extended the slider control so that it now is a 'Group' control that supports all the controls as subelements declared through an array value keyed against the 'item_options' key.
 * 4. Replaced the original OT_ADMIN class with a custom version defined in prime-class-admin.php that has the same responsibilities, but cuts out a lot of the overhead that was associated with DB management now that there are no direct database calls required. The only database interaction is routed through WordPress' get_option and set_option.
 */

global $theme_options_schema_factory;
$theme_options_schema_factory = new OTSchemaFactory();
$sf = $theme_options_schema_factory;

// EXAMPLE OPTIONS **********************************************************************

//$sf->add_heading("test_tab", "Title");
//$sf->add_background("test_background", "Title", "Description");
//$sf->add_category("test_category", "Test Category", "A test category");
//$sf->add_categories("test_categories", "Test Categories", "A test categories control.");
//$sf->add_checkbox("test_checkbox", "Title", "choice1,choice2,choice3", "Description");
//$sf->add_colorpicker("test_colorpicker", "Title", "Description");
//$sf->add_custom_post("test_custom_post", "Portfolio Item", "portfolio", "A test custom post selection");
//$sf->add_input("test_input", "Test Input", "A test input");
//$sf->add_measurement("test_measurement", "Test Measurement", "A Test Measurement");
//$sf->add_page("test_page", "Test Page", "A test page selection");
//$sf->add_post("test_post", "Test Post", "A test post selection");
//$sf->add_radio("test_radio", "Test Radio", "choice1,choice2,choice3", "Test Radio Buttons");
//$sf->add_select("test_select", "Title", "choice1,choice2,choice3", "Description");
//$sf->add_tag("test_tag", "Test Tag", "A test tag");
//$sf->add_textarea('test_textarea', 'Title', 'Description', 8);
//$sf->add_textblock("test_textblock", "Test Textblock", "<p>Lorem ipsum it dolor sepum</p>");
//$sf->add_typography("test_typographu", "Test Typography", "A test typography");
//$sf->add_upload('test_upload', 'Title', 'Text');

// GENERAL OPTIONS **********************************************************************

$sf->add_heading('general_default', 'General');

$sf->add_upload('placeholder_image', 'Placeholder Image', 'The placeholder image that will be used if a featured image isn\'t specified.');
$sf->add_input('prime_twitter_usr', 'Twitter Username', 'The Twitter Account to use throughout the site.');
$sf->add_input('google_maps_api_key', 'Google Maps API Key', 'Your <a href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">Google Maps API Key</a>');

$sf->add_input('prime_search_subtitle', 'Search Subtitle', 'The subtitle to display on search result pages.');
$sf->add_checkbox("hide_blog_featured_image", "Hide Featured Image in Blog?", "Enable", "Check this box if you don't want a featured image for each post to show in the blog");



// IMPORT DEMO DATA ************************************************************************
$sf->add_heading('demo_header', 'Demo Import');
$sf->add_demo_import('demo_import', 'Import Demo Content & Settings', 
    '<div><p>Click the button above to import demo content and settings. <strong>This can take several minutes to complete.</strong> This will make your site look like the preview site for the theme.</p>
    <p><strong style="font-size:1.2em;color:red;">If you want all the contact forms to work without creating them yourself later, you FIRST need to install the following plugins (before running demo import):</strong></p>
    <ul style="margin-top: 0;"><li><strong>Contact Form 7</strong> - the plugin we use to actually create and manage contact forms</li>
    <li><strong>Really Simple CAPTCHA</strong> - this plugin generates CAPTCHA images for Contact Form 7</li>
    <li><strong>Configure SMTP</strong> - works with Contact Form 7 to email you the data when someone fills out any of your contact forms</li>
    </ul></div>');


// LOGO OPTIONS ************************************************************************
$sf->add_heading('logo_header', 'Logo');
$sf->add_upload('logo_img', 'Header Logo', 'The logo image you wish to appear in the header.');
$sf->add_upload('logo_img_hires', 'Header Logo (Hi-Res)', 'A high-resolution version of the logo image you want to appear in the header, for use on high-DPI devices with "Retina" displays. Should be exactly twice the size of the normal-resolution logo image.');
$sf->add_input('logo_img_width', 'Header Logo Width', 'The width of the header logo image (standard resolution version). Must be set for high-DPI devices to work.');
$sf->add_input('logo_img_height', 'Header Logo Height', 'The height of the logo image (standard resolution version). Must be set for high-DPI devices to work.');

$sf->add_upload('mobile_logo_img', 'Mobile Header Logo', 'The logo image you wish to appear in the mobile header.');
$sf->add_upload('mobile_logo_img_hires', 'Mobile Header Logo (Hi-Res)', 'A high-resolution version of the logo image you want to appear in the mobile header, for use on high-DPI devices with "Retina" displays. Should be exactly twice the size of the normal-resolution logo image.');
$sf->add_input('mobile_logo_img_width', 'Mobile Header Logo Width', 'The width of the mobile header logo image (standard resolution version). Must be set for high-DPI devices to work.');
$sf->add_input('mobile_logo_img_height', 'Mobile Header Logo Height', 'The height of the mobile header logo image (standard resolution version). Must be set for high-DPI devices to work.');
//$sf->add_input('menu_padding', 'Header Menu Distance From Top', 'The distance (in pixels) between the top of the main menu and the top of the header.');

//$sf->add_input('header_link_1_text', 'Header Link 1 Display Text', 'The text to display for the first header link');
//$sf->add_input('header_link_1_href', 'Header Link 1 Location', 'The address used for the first header link');

//$sf->add_input('header_link_2_text', 'Header Link 2 Display Text', 'The text to display for the second header link');
//$sf->add_input('header_link_2_href', 'Header Link 2 Location', 'The address used for the second header link');

// HEADER OPTIONS ************************************************************************
$sf->add_heading('header', 'Header');

$sf->add_textblock("header_positioning", "", '<h3 style="font-size:2em;font-weight: 300;">Positioning</h3>');
$sf->add_input('header_top_margin', 'Header Top Margin', 'The distance between the header and the top edge of the page (default is 30px).');
$sf->add_input('header_bottom_margin', 'Header Bottom Margin', 'The distance between the header and the main menu bar (default is 10px).');
$sf->add_input('logo_top_margin', 'Logo Top Margin', 'Add space to the top of the logo to vertically position it (default is 0px).');
$sf->add_input('tagline_top_margin', 'Tagline Top Margin', 'Add space to the top of the tagline to vertically position it (default is 13px).');
$sf->add_input('header_content_top_margin', 'Header Content Top Margin', 'Add space to the top of the Social Links and Call Button to vertically position them (default is 0px).');


$sf->add_textblock("header_social_links", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Social Links</h3>');
$sf->add_checkbox("enable_facebook_link", "Show Facebook Link?", "Enable", "Check this box to show the Facebook link in the header");
$sf->add_input('facebook_text', 'Facebook Text', 'The text to show next to the Facebook icon.');
$sf->add_input('facebook_url', 'Facebook URL', 'The url the Facebook link should go to.');
$sf->add_checkbox("enable_twitter_link", "Show Twitter Link?", "Enable", "Check this box to show the Twitter link in the header");
$sf->add_input('twitter_text', 'Twitter Text', 'The text to show next to the Twitter icon.');
$sf->add_input('twitter_url', 'Twitter URL', 'The url the Twitter link should go to.');
$sf->add_checkbox("enable_linkedin_link", "Show LinkedIn Link?", "Enable", "Check this box to show the LinkedIn link in the header");
$sf->add_input('linkedin_text', 'LinkedIn Text', 'The text to show next to the LinkedIn icon.');
$sf->add_input('linkedin_url', 'LinkedIn URL', 'The url the LinkedIn link should go to.');

$sf->add_textblock("header_call_button", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Call Button</h3>');
$sf->add_checkbox("enable_call_button", "Show Call Button?", "Enable", "Check this box to show the Call Button in the header");
$sf->add_input('call_button_text', 'Call Button Text', 'The text that appears in the Call Button.');
$sf->add_input('call_button_number', 'Call Button Telephone Number', 'The phone number that is dialed when the Call Button is pressed on a mobile phone. (ex: +1-800-555-5555)');
$sf->add_input('call_button_url', 'Call Button URL', "The url that is visited when the call button is clicked on a device that doesn't have the ability to dial calls (recommend that you link to your contact page).");
$sf->add_checkbox("call_button_mobile_url", "Call Button Uses Link On Smartphones?", "Enable", "Enable this if you don't want the Call Button to launch a phone call when tapped on a smartphone. This will make the Call Button go to the <strong>Call Button URL</strong> defined above instead.");


$sf->add_textblock("header_alternate_content", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Alternate Content</h3>');
$sf->add_checkbox("enable_alternate_content", "Show Alternate Content?", "Enable", "Show different header content from the Social Links and the Call Button.");
$sf->add_textarea('alternate_content', 'Alternate Content (Desktop and Tablet)', 'The content to show instead of the social links and call button - displayed on desktop and tablet devices.');
$sf->add_textarea('alternate_content_mobile', 'Alternate Content (Mobile)', 'The content to show instead of the social links and call button - displayed on mobile devices.');

$sf->add_textblock("mobile_menu_button_header", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Mobile Menu Button</h3>');
$sf->add_checkbox("enable_mobile_menu_button_text", "Show Text In Mobile Menu Button?", "Enable", "Show text in the mobile menu button instead of the standard menu icon.");
$sf->add_input('mobile_menu_button_text', 'Mobile Menu Button Text', 'The text to put inside the mobile menu button.');





// COLOR OPTIONS ************************************************************************
$sf->add_heading('color_header', 'Colors');
$sf->add_select("skin", "Base Skin", "Autumn,Black,Blue Grey,Cherry,Coffee,Cool Blue,Fire,Forest Green,Golden,Grey,Lime Green,Periwinkle,Pink,Purple,Royal Blue,Silver,Sky Blue,Teal,Teal Grey,Violet", "Please choose the base skin you'd like your website to have.");
$sf->add_checkbox("enable_custom_colors", "Enable custom colors?", "Enable", "Check this box if you want to use the color theme options below to override the color values in the <em>Base Skin</em> you've chosen above.");

// HEADER COLORS
$sf->add_textblock("header_colors", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Header Colors</h3>');
$sf->add_textblock("header_note", "", 'Note: to change the background color of the header, navigate to the "Backgrounds" tab to the left. You can choose a color without specifying a background image, and it\'ll apply.');

// Divider Color
$sf->add_colorpicker("header_divider_color", "Divider Color", "The color of the vertical dividers in the header.");

// Tagline Color
$sf->add_colorpicker("header_tagline_color", "Tagline Color", "The color of the site tagline.");

// Facebook Icon Color
$sf->add_colorpicker("header_facebook_icon_color", "Facebook Icon Color", "The color of the Facebook icon (in the header social links).");

// Facebook Link Color
$sf->add_colorpicker("header_facebook_link_color", "Facebook Link Color", "The color of the Facebook link (in the header social links).");

// Facebook Button Color (Mobile)
$sf->add_colorpicker("header_facebook_button_color", "Facebook Button Color", "The color of the Facebook Button that appears in the mobile layouts.");

// Facebook Button Icon Color (Mobile)
$sf->add_colorpicker("header_facebook_button_icon_color", "Facebook Button Icon Color", "The icon color of the Facebook Button that appears in the mobile layouts.");

// Facebook Button Text Color (Mobile)
$sf->add_colorpicker("header_facebook_button_text_color", "Facebook Button Text Color", "The text color of the Facebook Button that appears in the mobile layouts.");

// Twitter Icon Color
$sf->add_colorpicker("header_twitter_icon_color", "Twitter Icon Color", "The color of the Twitter icon (in the header social links).");

// Twitter Link Color
$sf->add_colorpicker("header_twitter_link_color", "Twitter Link Color", "The color of the Twitter link (in the header social links).");

// Twitter Button Color (Mobile)
$sf->add_colorpicker("header_twitter_button_color", "Twitter Button Color", "The color of the Twitter Button that appears in the mobile layouts.");

// Twitter Button Icon Color (Mobile)
$sf->add_colorpicker("header_twitter_button_icon_color", "Twitter Button Icon Color", "The icon color of the Twitter Button that appears in the mobile layouts.");

// Twitter Button Text Color (Mobile)
$sf->add_colorpicker("header_twitter_button_text_color", "Twitter Button Text Color", "The text color of the Twitter Button that appears in the mobile layouts.");

// LinkedIn Icon Color
$sf->add_colorpicker("header_linkedin_icon_color", "LinkedIn Icon Color", "The color of the LinkedIn icon (in the header social links).");

// LinkedIn Link Color
$sf->add_colorpicker("header_linkedin_link_color", "LinkedIn Link Color", "The color of the LinkedIn link (in the header social links).");

// LinkedIn Button Color (Mobile)
$sf->add_colorpicker("header_linkedin_button_color", "LinkedIn Button Color", "The color of the LinkedIn Button that appears in the mobile layouts.");

// LinkedIn Button Icon Color (Mobile)
$sf->add_colorpicker("header_linkedin_button_icon_color", "LinkedIn Button Icon Color", "The icon color of the LinkedIn Button that appears in the mobile layouts.");

// LinkedIn Button Text Color (Mobile)
$sf->add_colorpicker("header_linkedin_button_text_color", "LinkedIn Button Text Color", "The text color of the LinkedIn Button that appears in the mobile layouts.");

// Call Button Color
$sf->add_colorpicker("header_call_button_color", "Call Button Color", "The color of the Call Button.");

// Call Button Text Color
$sf->add_colorpicker("header_call_button_icon_color", "Call Button Icon Color", "The color of the Call Button icon.");

// Call Button Text Color
$sf->add_colorpicker("header_call_button_text_color", "Call Button Text Color", "The color of the Call Button text.");

// Base Text Color
$sf->add_colorpicker("header_text_color", "Base Text Color", "The base text color of the header.");

// Note: to change the background color of the header, navigate to the "Backgrounds" tab. You can choose a color without specifying a background image, and it'll apply.

// MENU COLORS
$sf->add_textblock("menu_colors", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Menu Colors</h3>');

// Background Color
$sf->add_colorpicker("menu_background_color", "Menu Bar Background Color", "The background color of the main menu bar.");

// Top-level Menu Item Text Color
$sf->add_colorpicker("menu_item_color", "Top-level Menu Item Text Color", "The text color of the items that appear in the main menu bar.");

// Top-level Menu Item Hover Color
$sf->add_colorpicker("menu_item_hover_color", "Top-level Menu Item Hover Text Color", "The text hover color of the items that appear in the main menu bar.");

// Top-Level Menu Item Background Hover Color
$sf->add_colorpicker("menu_item_hover_background_color", "Top-Level Menu Item Hover Background Color", "The background hover color of the items that appear in the main menu bar.");

// Submenu Background Color
$sf->add_colorpicker("submenu_background_color", "Submenu Background Color", "The background color of the submenu popups.");

// Submenu Divider Color
$sf->add_colorpicker("submenu_divider_color", "Submenu Divider Color", "The color of the dividers between menu items in the submenu.");

// Submenu Item Text Color
$sf->add_colorpicker("submenu_item_color", "Submenu Item Text Color", "The text color of menu items in the submenu.");

// Submenu Item Hover Text Color
$sf->add_colorpicker("submenu_item_hover_color", "Submenu Item Hover Text Color", "The hover text color of menu items in the submenu.");

// Submenu Item Hover Background Color
$sf->add_colorpicker("submenu_item_hover_background_color", "Submenu Item Hover Background Color", "The hover background color of menu items in the submenu.");

// Mobile Menu Button Icon Color
$sf->add_colorpicker("mobile_menu_button_icon_color", "Mobile Menu Button Icon Color", "The icon color of the mobile menu button (that appears in the header mobile layouts).");

// Mobile Menu Button Background Color
$sf->add_colorpicker("mobile_menu_button_background_color", "Mobile Menu Button Background Color", "The background color of the mobile menu button (that appears in the header mobile layouts).");


// SLIDER COLORS
$sf->add_textblock("slider_colors", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Slider Colors</h3>');
// Play button color
$sf->add_colorpicker("play_button_color", "Play Button Color", "The color of the play button in the slider controls.");
// Play button hover color
$sf->add_colorpicker("play_button_hover_color", "Play Button Hover Color", "The hover color of the play button in the slider controls.");
// Play button active color
$sf->add_colorpicker("play_button_active_color", "Play Button Active Color", "The active color of the play button in the slider controls (the color when the play button is clicked).");
// Pause button color
$sf->add_colorpicker("pause_button_color", "Pause Button Color", "The color of the pause button in the slider controls.");
// Pause button hover color
$sf->add_colorpicker("pause_button_hover_color", "Pause Button Hover Color", "The hover color of the pause button in the slider controls.");
// Pause button active color
$sf->add_colorpicker("pause_button_active_color", "Pause Button Active Color", "The active color of the pause button in the slider controls (the color of the pause button when the slider is paused).");
// Pause button active glow color
$sf->add_colorpicker("pause_button_active_glow_color", "Pause Button Active Glow Color", "The glow color of the pause button when the slider is paused.");
// Paginator color
$sf->add_colorpicker("paginator_color", "Paginator Color", "The color of the slider paginators.");
// Paginator hover color
$sf->add_colorpicker("paginator_hover_color", "Paginator Hover Color", "The hover color of the slider paginators.");
// Current paginator color
$sf->add_colorpicker("paginator_current_color", "Current Paginator Color", "The color of the paginator that corresponds to the current slide.");
// Paginator background color
$sf->add_colorpicker("paginator_background_color", "Paginator Background Color", "The background color of the slider paginator control.");
// Flexslider caption background color
$sf->add_colorpicker("flexslider_caption_background_color", "Flexslider Caption Background Color", "The background color of captions in all Flexsliders.");
// Flexslider caption text color
$sf->add_colorpicker("flexslider_caption_text_color", "Flexslider Caption Text Color", "The text color of captions in all Flexsliders.");
// Flexslider subcaption text color
$sf->add_colorpicker("flexslider_subcaption_text_color", "Flexslider Subcaption Text Color", "The text color of subcaptions in all Flexsliders.");

// SUBHEADER COLORS
$sf->add_textblock("subheader_colors", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Subheader Colors</h3>');
// Title Color
$sf->add_colorpicker("subheader_title_color", "Subheader Title Color", "The color of page title contained in the subheader.");

// Subtitle Color
$sf->add_colorpicker("subheader_subtitle_color", "Subheader Subtitle Color", "The color of page subtitle contained in the subheader.");

// Subheader bottom border color
$sf->add_colorpicker("subheader_bottom_border_color", "Bottom Border Color", "The color of the border at the bottom of the subheader.");


// PAGE CONTENT COLORS
$sf->add_textblock("page_content_colors", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Page Content Colors</h3>');
// Heading Color
$sf->add_colorpicker("page_heading_color", "Heading Color", "The color of h1, h2, h3, h4, h5 and h6 elements in the page content.");
// Text Color
$sf->add_colorpicker("page_text_color", "Text Color", "The color of text in the page content.");
// Link Color
$sf->add_colorpicker("page_link_color", "Link Color", "The color of links in the page content.");
// Form input focus glow color
$sf->add_colorpicker("page_form_glow_color", "Form Input Focus Color", "The glow color of form inputs that have focus.");
// Image hover glow color
$sf->add_colorpicker("page_image_glow_color", "Image Glow Color", "The hover glow color of images and embeds.");

// SHORTCODE COLORS
$sf->add_textblock("shortcode_colors", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Shortcode Colors</h3>');
// Divider Color
$sf->add_colorpicker("divider_color", "Divider Color", "The color of dividers.");
;
// Pullquote and blockquote color
$sf->add_colorpicker("quote_color", "Pullquote and Blockquote Color", "The default text color of pullquotes and blockquotes.");
// Blockquote left border color
$sf->add_colorpicker("blockquote_left_color", "Blockquote Left Border Color", "The left border color of blockquotes.");
// Pricing plan button color
$sf->add_colorpicker("pricing_plan_button_color", "Pricing Plan Button Color", "The color of the buttons in pricing plans.");
// Pricing featured plan color
$sf->add_colorpicker("pricing_featured_plan_color", "Pricing Featured Plan Color", "The background color of the featured plan in pricing tables.");
// Recent Posts divider color
$sf->add_colorpicker("recent_posts_divider_color", "Recent Posts Divider Color", "The color of the dividers in the recent posts shortcode.");

// BLOG COLORS
$sf->add_textblock("blog_colors", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Blog Colors</h3>');
// Category text color
$sf->add_colorpicker("category_text_color", "Category Text Color", "The text color of categories in the post meta.");
// Category background color
$sf->add_colorpicker("category_background_color", "Category Background Color", "The background color of categories in the post meta.");
// Post meta separator color
$sf->add_colorpicker("post_meta_separator_color", "Post Meta Separator Color", "The color of the separators in the post meta.");
// Comment background color
$sf->add_colorpicker("comment_background_color", "Comment Background Color", "The background color of the comment bubbles.");
// Comment text color
$sf->add_colorpicker("comment_text_color", "Comment Text Color", "The text color of the comments.");
// Comment link color
$sf->add_colorpicker("comment_link_color", "Comment Link Color", "The link color of the comments.");

// PORTFOLIO COLORS
$sf->add_textblock("portfolio_colors", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Portfolio Colors</h3>');
// Filter Text Color
$sf->add_colorpicker("portfolio_filter_color", "Filter Color", "The color of the portfolio filters.");
// Filter Hover Text Color
$sf->add_colorpicker("portfolio_filter_hover_color", "Filter Hover Color", "The hover color of the portfolio filters.");
// Active Filter Text Color
$sf->add_colorpicker("portfolio_filter_active_color", "Active Filter Color", "The color of the active portfolio filter.");

// SIDEBAR COLORS
$sf->add_textblock("sidebar_colors", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Sidebar Colors</h3>');
// Heading color
$sf->add_colorpicker("sidebar_heading_color", "Sidebar Heading Color", "The color of widget titles in the sidebar.");
// Text color
$sf->add_colorpicker("sidebar_text_color", "Sidebar Text Color", "The color of text in the sidebar.");
// Link color
$sf->add_colorpicker("sidebar_link_color", "Sidebar Link Color", "The color of links in the sidebar.");


// FOOTER COLORS
$sf->add_textblock("footer_colors", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Footer Colors</h3>');
// Heading color
$sf->add_colorpicker("footer_heading_color", "Footer Heading Color", "The color of widget titles in the footer.");
// Text color
$sf->add_colorpicker("footer_text_color", "Footer Text Color", "The color of text in the footer.");
// Link color
$sf->add_colorpicker("footer_link_color", "Footer Link Color", "The color of links in the footer.");
// Subfooter Text Color
$sf->add_colorpicker("subfooter_text_color", "Subfooter Text Color", "The color of text in the subfooter.");
// Subfooter Link Color
$sf->add_colorpicker("subfooter_link_color", "Subfooter Link Color", "The color of links in the subfooter.");


// HEADER OPTIONS ************************************************************************
$sf->add_heading('background_header', 'Backgrounds');

$sf->add_textblock("header_bg", "", '<h3 style="font-size:2em;font-weight: 300;">Header Background</h3>');
$sf->add_checkbox("enable_custom_header_background", "Show Custom Header Background?", "Enable", "Check this box if you want to use the use a custom header background (specified below).");
$sf->add_background("header_background", "Custom Header Background", "The background of the header.");

$sf->add_textblock("page_bg", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Page Background</h3>');
$sf->add_checkbox("enable_custom_page_background", "Show Custom Page Background?", "Enable", "Check this box if you want to use the use a custom page background (specified below).");
$sf->add_background("page_background", "Custom Page Background", "The background of the page.");

$sf->add_textblock("page_content_bg", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Page Content Background</h3>');
$sf->add_checkbox("enable_custom_page_content_background", "Show Custom Page Content Background?", "Enable", "Check this box if you want to use the use a custom page content background (specified below).");
$sf->add_background("page_content_background", "Custom Page Content Background", "The background of the page content.");

$sf->add_textblock("subheader_bg", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Subheader Background</h3>');
$sf->add_checkbox("enable_custom_subheader_background", "Show Custom Subheader Background?", "Enable", "Check this box if you want to use the use a custom subheader background (specified below).");
$sf->add_background("subheader_background", "Custom Subheader Background", "The background of the subheader.");

$sf->add_textblock("sidebar_bg", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Sidebar Background</h3>');
$sf->add_checkbox("enable_custom_sidebar_background", "Show Custom Sidebar Background?", "Enable", "Check this box if you want to use the use a custom sidebar background (specified below).");
$sf->add_background("sidebar_background", "Custom Sidebar Background", "The background of the sidebar.");

$sf->add_textblock("footer_bg", "", '<h3 style="font-size:2em;font-weight: 300;padding-top:20px;">Footer Background</h3>');
$sf->add_checkbox("enable_custom_footer_background", "Show Custom Footer Background?", "Enable", "Check this box if you want to use the use a custom footer background (specified below).");
$sf->add_background("footer_background", "Custom Footer Background", "The background of the footer.");


// FRONT PAGE OPTIONS ************************************************************************
$sf->add_heading('frontpage_header', 'Front Page');
$sf->add_textblock('_frontpage_options_desc', 'The Front Page Options Description',
    '<p><b>NOTE:</b> The Front Page Options apply if the "Front page displays" is set to "Your latest posts".
    This means that when a Blog is displayed as the site\'s front page, these options are used for that page.</p>');

$options = get_option(PRIME_OPTIONS_KEY);
$sliders = isset($options['flexslider_slider']) ? $options['flexslider_slider'] : array();
$slider_choice_array = array();
foreach ($sliders as $s) {
    $slider_choice_array[$s['id']] = $s['title'];
}
global $FRONTEND_STRINGS;
//$sf->add_array_select('frontpage_slider_choice', 'Front Page Flexslider', $slider_choice_array);
$sf->add_input('front_page_blog_title', 'Front Page Blog Title', 'The title to display if the &amp;quot;Front page displays&amp;quot; is set to &amp;quot;Your latest posts&amp;quot;. This means that when a Blog is displayed as the site&amp;#039;s front page, this value will be that page&amp;#039;s title.');
$sf->add_input('front_page_blog_subtitle', 'Front Page Blog Subtitle', 'The subtitle to display if the &amp;quot;Front page displays&amp;quot; is set to &amp;quot;Your latest posts&amp;quot;. This means that when a Blog is displayed as the site&amp;#039;s front page, this value will be that page&amp;#039;s subtitle.');

$sf->add_array_select('_prime_slider_type', 'Slider Type',
    array(
        'flex_slider' => 'Flex Slider',
        'content_slider' => 'Content Slider',
        'cp_slider' => 'CP Slider'
    ));

$sf->add_categories('_prime_flex_slide_categories', 'Flex Slide Categories', 'flex_slide_category',
    'The Flex Slide Categories to display in this slider. All Flex Slides belonging to the categories checked above will display in this slider.');

$sf->add_categories('_prime_content_slide_categories', 'Content SlideCategories', 'content_slide_category',
    'The Content Slide Categories to display in this slider. All Content Slides belonging to the categories checked above will display in this slider.');

$sf->add_categories('_prime_cp_slide_categories', 'CP Slide Categories', 'cp_slide_category',
    'The CP Slide Categories to display in this slider. All CP Slides belonging to the categories checked above will display in this slider.');
$sf->add_array_select('_prime_slider_order', 'Order Direction',
    array('ASC' => 'Ascending', 'DESC' => 'Descending'), $FRONTEND_STRINGS['page_slide_orderdir_desc']);
$sf->add_array_select('_prime_slider_orderby', 'Order By',
    array(
        'none' => 'None', 'ID' => 'Item ID', 'author' => 'Author', 'title' => 'Title',
        'date' => 'Date', 'modified' => 'Modified', 'parent' => 'Parent', 'rand' => 'Random',
        'comment_count' => 'Comment Count', 'menu_order' => 'Menu Order'
    ), $FRONTEND_STRINGS['page_slide_orderby_desc']);

$sf->add_input('_prime_slider_speed', 'Slideshow Speed',
    $FRONTEND_STRINGS['page_slideshow_speed_desc']);

// SIDEBARS OPTIONS **********************************************************************

$sf->add_heading('sidebar_header', 'Custom Sidebars');
$slider_factory = new OTSliderOptionsSchemaFactory('unlimited_sidebar_slider', 'Sidebars',
    'Add and remove custom sidebars and assign them to various pages, portfolio items and posts. You can add an unlimited number of sidebars to any given page - they\'ll display stacked (on top of one another).', 'Sidebar Title', 'The name of the sidebar (how it will be labeled in Appearance > Widgets).');
$slider_factory->add_textarea('sidebar_description', 'Description', 'The description of the sidebar (how it will be described in Appearance > Widgets).');
$slider_factory->add_pages('sidebar_pages', 'Pages', 'Which of your pages this sidebar should be shown on.');
$slider_factory->add_categories('sidebar_categories', 'Post Categories', 'category', 'The Post Categories to apply this sidebar to. All posts belonging to the categories checked above will display this sidebar.');
$slider_factory->add_slider_to($sf);

// PORTFOLIO OPTIONS ********************************************************************

$sf->add_heading('portfolio_header', 'Portfolios');

$slider_factory = new OTSliderOptionsSchemaFactory('portfolio_instance_slider', 'Portfolios',
    'Add and remove portfolios and designate their location.', 'Portfolio Title', 'The portfolio title. (Note: this is only for admin usage - the actual title will be taken from the "Display Page" selected below.');
$slider_factory->add_page('portfolio_page', 'Display Page', 'The Page to display this portfolio on. This portfolio will now be rendered on this page, overriding the page content.');
$slider_factory->add_categories('portfolio_categories', 'Categories', 'portfolio_category',
    'The Portfolio Categories to display in this portfolio. All portfolio items belonging to the categories checked above will display in this portfolio.');

$slider_factory->add_checkbox('portfolio_show_filters', 'Show Filters?', 'Yes', 'If you want the portfolio filters to display in the subheader of the portfolio check this box.');
$slider_factory->add_categories('portfolio_filters', 'Filters', 'portfolio_filter',
    'The filters that will appear in the filter bar for this portfolio.');
$slider_factory->add_input('portfolio_posts_per_page', 'Items Per Page', 'The number of items to show per page.');

$slider_factory->add_input('portfolio_readmore_text', 'Read More Text', 'The text of the read more link of a portfolio item');

$slider_factory->add_array_select('portfolio_order', 'Order Direction',
    array(
        'ASC' => 'Ascending',
        'DESC' => 'Descending'
    ));
$slider_factory->add_array_select('portfolio_orderby', 'Order By',
    array(
        'none' => 'None',
        'ID' => 'Item ID',
        'author' => 'Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Modified',
        'parent' => 'Parent',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order'
    ));

$slider_factory->add_slider_to($sf);

$sf->add_input("all_filter_text", "All Portfolio Filter Text", "The text to use for the \"All\" filter in the Portfolio Filter bar.");


// FOOTER OPTIONS ************************************************************************
$sf->add_heading('footer_header', 'Footer');
$sf->add_input('subfooter_left_text', 'Subfooter Text', 'The text that is displayed in the bottom left of the footer. Usually this is a copyright message of some sort.');
//$sf->add_input('subfooter_right_text', 'Subfooter Right Text', 'The text displayed on the bottom right of the footer.');


// EXCERPT OPTIONS **********************************************************************
$sf->add_heading('excerpt_header', 'Excerpts');

$sf->add_input('archives_excerpt_length', 'Blog/Archives Excerpt Length', 'The character length of the post excerpt displays in the Blog and Archive pages.');
$sf->add_input('recent_posts_excerpt_length', 'Recent Posts Excerpt Length', 'The character length of the post excerpt displays in the recent_posts shortcode.');
$sf->add_checkbox('excerpt_nearest_sentence', 'Excerpts Only Contain Full Sentences?', 'Yes', 'If you want the excerpts to not cut off in the middle of a sentence check this box.');
$sf->add_input('excerpt_continuation_string', 'Excerpt Continuation String', 'The string to append to an excerpt when the excerpt ends in the middle of a sentence.');


// Flex Slider **********************************************************************
//$sf->add_heading('flex_slider_header', 'Flexsliders');
$slider_factory = new OTSliderOptionsSchemaFactory('flexslider_slider', 'Flexsliders',
    'Add and remove Flex Sliders and choose which slides to display in them.', 'Slider Title', 'The slider title. (Note: this is only for admin usage - the actual title will be taken from the "Display Page" selected below.');
$slider_factory->add_categories('slide_categories', 'Categories', 'flex_slide_category',
    'The Flex Slide Categories to display in this slider. All Flex Slides belonging to the categories checked above will display in this slider.');
$slider_factory->add_checkbox('slide_slideshow', 'Slider Autoplay', 'enable', 'Check this box if you want the slider to automatically advance through the slides.');
$slider_factory->add_input('slideshow_speed', 'Slideshow Speed', 'The speed of the slideshow in milliseconds (this applies only if the above option \'Slider Autoplay\' is checked).');
$slider_factory->add_input('slideshow_height', 'Slideshow Height', 'The height of the slideshow in pixels.');
$slider_factory->add_array_select('slider_order', 'Order Direction',
    array(
        'ASC' => 'Ascending',
        'DESC' => 'Descending'
    ));
$slider_factory->add_array_select('slider_orderby', 'Order By',
    array(
        'none' => 'None',
        'ID' => 'Item ID',
        'author' => 'Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Modified',
        'parent' => 'Parent',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order'
    ));

//$slider_factory->add_slider_to($sf);

// Content Slider **********************************************************************
//$sf->add_heading('content_slider_header', 'Content Sliders');
$slider_factory = new OTSliderOptionsSchemaFactory('contentslider_slider', 'Content Sliders',
    'Add and remove Content Sliders and choose which slides to display in them.',
    'Slider Title',
    'The slider title.');
$slider_factory->add_categories('slide_categories', 'Categories', 'content_slide_category',
    'The Content Slide Categories to display in this slider. All Content Slides belonging to the categories checked above will display in this slider.');
$slider_factory->add_checkbox('slide_slideshow', 'Slider Autoplay', 'enable', 'Check this box if you want the slider to automatically advance through the slides.');
$slider_factory->add_input('slideshow_speed', 'Slideshow Speed', 'The speed of the slideshow in milliseconds (this applies only if the above option \'Slider Autoplay\' is checked).');

$slider_factory->add_array_select('slider_order', 'Order Direction',
    array(
        'ASC' => 'Ascending',
        'DESC' => 'Descending'
    ));
$slider_factory->add_array_select('slider_orderby', 'Order By',
    array(
        'none' => 'None',
        'ID' => 'Item ID',
        'author' => 'Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Modified',
        'parent' => 'Parent',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order'
    ));

//$slider_factory->add_slider_to($sf);

// CP Slider **********************************************************************
//$sf->add_heading('cp_slider_header', 'CP Sliders');
//$slider_factory = new OTSliderOptionsSchemaFactory('cpslider_slider', 'CP Sliders',
//    'Add and remove CP Sliders and choose which slides to display in them.',
//    'Slider Title',
//    'The slider title.');
//$slider_factory->add_categories('slide_categories', 'Categories', 'cp_slide_category',
//                                'The CP Slide Categories to display in this slider. All CP Slides belonging to the categories checked above will display in this slider.');
//$slider_factory->add_checkbox('slide_slideshow', 'Slider Autoplay', 'enable', 'Check this box if you want the slider to automatically advance through the slides.');
//$slider_factory->add_input('slideshow_speed', 'Slideshow Speed', 'The speed of the slideshow in milliseconds (this applies only if the above option \'Slider Autoplay\' is checked).');
//
//$slider_factory->add_array_select('slider_order', 'Order Direction',
//                                  array(
//                                       'ASC' => 'Ascending',
//                                       'DESC' => 'Descending'
//                                  ));
//$slider_factory->add_array_select('slider_orderby', 'Order By',
//                                  array(
//                                       'none' => 'None',
//                                       'ID' => 'Item ID',
//                                       'author' => 'Author',
//                                       'title' => 'Title',
//                                       'date' => 'Date',
//                                       'modified' => 'Modified',
//                                       'parent' => 'Parent',
//                                       'rand' => 'Random',
//                                       'comment_count' => 'Comment Count',
//                                       'menu_order' => 'Menu Order'
//                                  ));
//
//$slider_factory->add_slider_to($sf);

// CUSTOM CSS OPTIONS ******************************************************
$sf->add_heading("custom_css", "Custom CSS");
$sf->add_textarea('custom_css_code', 'Custom CSS', 'Place any custom CSS you want to add in this textbox. It\'ll be inserted so it overrides default skin values.', 25);

// Fonts OPTIONS ******************************************************
$sf->add_heading("google_fonts", "Fonts");
$sf->add_array_select('font_stack', 'Default Font Stack',
    array(
        'Helvetica Neue, Segoe UI, Arial, sans-serif' => 'Helvetica Neue, Segoe UI, Arial, sans-serif',
        'Cambria, Georgia, serif' => 'Cambria, Georgia, serif',
        'Helvetica Neue, Helvetica, Arial, sans-serif' => 'Helvetica Neue, Helvetica, Arial, sans-serif',
        'Segoe UI, Tahoma, Geneva, sans-serif' => 'Segoe UI, Segoe, Tahoma, Geneva, sans-serif',
        'Optima, Candara, Calibri, Arial, sans-serif' => 'Optima, Segoe, Segoe UI, Candara, Calibri, Arial, sans-serif'
    ), 'The default font stack for the site.');
$sf->add_input('font_size', 'Font Size', 'The default font size for the site (in pixels). NOTE: don\'t add "px" at the end - only input the number.');

$link_text = esc_html("<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>");
$sf->add_textarea('google_font_links',
    'Google Font Link (HTML)',
    sprintf("The link tag provided by Google Fonts. (Ex. <code>%s</code>)", $link_text));

$sf->add_textblock('google_font_usage_block', 'Using Google Fonts',
    "<p>Add the Google Font provided <code><link></code> tag to the <b>Google Font Link (HTML)</b> theme option.
Once the link has been added, add custom css via the <b>Custom CSS</b> options tab. For example, you could add
the following css once adding the link tag for the 'Metrophobic' font:
<code>h1 { font-family: ‘Metrophobic’, Arial, serif; font-weight: 400; }</code>

To browse fonts and retrieve Google Font code, please use the <a href='http://www.google.com/webfonts#HomePlace:home' target=\"_blank\">Google Font Site</a>
</p>"
);