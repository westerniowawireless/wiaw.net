<?php

//import Prime
require_once get_template_directory() . '/prime/prime-functions.php';

require_once get_template_directory() . '/prime/options.php';

require_once get_template_directory() . '/prime/classes/helper-classes.php';
require_once get_template_directory() . '/prime/classes/class.admin.php';
require_once get_template_directory() . '/prime/classes/class.frontend.php';
require_once get_template_directory() . '/prime/classes/class.portfolio.php';
require_once get_template_directory() . '/prime/classes/class.slider.php';
require_once get_template_directory() . '/prime/classes/class.flexslider.php';

require_once get_template_directory() . '/prime/classes/class.content.slider.php';
require_once get_template_directory() . '/prime/classes/class.cpslider.php';


require_once get_template_directory() . '/prime/prime-cleanup.php';
require_once get_template_directory() . '/prime/shortcodes/shortcodes.load.php';
require_once get_template_directory() . '/prime/widgets/widgets.load.php';

require_once get_template_directory() . '/prime/admin-shortcode-generator.php';

global $po_admin;

$prime_admin = new PrimeAdmin();
//$prime_admin->add_activation_action('roots_activate_theme');

$prime_admin->add_activation_action(array($po_admin, 'option_tree_activate_theme'));
$prime_admin->theme_activate();

global $prime_frontend;
$prime_frontend = new PrimeFrontend();

global $prime_portfolio;
$prime_portfolio = new PrimePortfolio();

global $prime_flex_slider;
$prime_flex_slider = new PrimeFlexSlider();

global $prime_content_slider;
$prime_content_slider = new PrimeContentSlider();

global $prime_sc_helper;
$prime_sc_helper = new PrimeShortcodeHelper();

global $prime_cp_slider;
$prime_cp_slider = new PrimeCPSlider();



