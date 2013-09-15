<?php
/*
 * PRIME MODIFIED. Setting theme options that aren't to be
 * exposed to end user.
 */
function roots_get_default_theme_options($default_framework = '')
{
    global $roots_css_frameworks;

    $default_theme_options = array(
        'css_framework' => '960gs_12',
        'container_class' => 'container_12',
        'main_class' => 'grid_7 suffix_1',
        'sidebar_class' => 'grid_4',
        'google_analytics_id' => '',
        'root_relative_urls' => true,
        'clean_menu' => true,
        'fout_b_gone' => false
    );

    return apply_filters('roots_default_theme_options', $default_theme_options);
}

/*
 * PRIME MODIFIED. Instead of getting theme options from the custom roots options
 * implementation, we use the default theme options defined in 'roots_get_default_themes_options'
 * and merge them with the OptionTree options array. That way we can use OptionTree for any
 * user facing options and the 'roots_get_default_theme_options' for any non-user-facing options
 */
function roots_get_theme_options()
{
    $roots_options = roots_get_default_theme_options();
    $ot_options = get_option(PRIME_OPTIONS_KEY);
    //  return get_option('roots_theme_options', roots_get_default_theme_options());
    if (empty($ot_options)) $ot_options = array();

    return array_merge($roots_options, $ot_options);
}

?>