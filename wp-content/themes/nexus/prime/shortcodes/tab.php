<?php

$tab_content_ids = null;

function prime_shortcode_tabs($atts, $content = null)
{
    $defaults = array('style' => 'default', 'title' => '', 'color' => '', 'border' => '');

    extract(shortcode_atts($defaults, $atts));

    $style_att = $color == '' ? '' : 'style="background-color:' . $color . ';"';

	$border_css = $border == '' ? '' : 'border-color:' . $border . ';';
	$content_style_att = $border == ''? '' : 'style="' . $border_css . ';"';

    // Extract the tab titles for use in the tabber widget.
    preg_match_all('/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);

    $tab_titles = array();
    $tabs_class = 'tab_titles';

    if (isset($matches[1])) {
        $tab_titles = $matches[1];
    } // End IF Statement

    $titles_html = '';

    global $tab_content_ids;
    $tab_content_ids = array();

    if (count($tab_titles)) {

        if ($title) {
            $titles_html .= '<h4 class="tab_header"><span>' . esc_html($title) . '</span></h4>';
            $tabs_class .= ' has_title';
        } // End IF Statement

        $titles_html .= '<ul id="' . uniqid('tabs_') . '" class="tabs nav nav-tabs" data-tabs="tabs">' . "\n";

        $counter = 1;

        foreach ($tab_titles as $t) {

//            $id = $id = 'tab-' . sanitize_title($t[0]);

            $id = uniqid(sanitize_title($t[0]) . '_');
            if ($counter == 1) {
                $titles_html .= '<li class="active"><a href="#' . $id . '" data-toggle="tab" ' . $style_att . '>' . $t[0] . '</a></li>' . "\n";
            }
            else {
                $titles_html .= '<li class="nav-tab"><a href="#' . $id . '" data-toggle="tab" ' . $style_att . '>' . $t[0] . '</a></li>' . "\n";
            }
            $tab_content_ids[] = $id;

            $counter++;

        } // End FOREACH Loop

        $titles_html .= '</ul>' . "\n";

    }

    $ret_val = $titles_html . '<div class="tab-content" ' . $content_style_att . '>' . do_shortcode($content) . '</div><!--/.tabs-->';

    $tab_content_ids = null;

    return wpautop(prime_remove_autop($ret_val));

}

/*-----------------------------------------------------------------------------------*/
/* 16.1 A Single Tab - [tab title="The title goes here"][/tab]
/*-----------------------------------------------------------------------------------*/

function prime_shortcode_tab_single($atts, $content = null)
{

    $defaults = array('title' => 'Tab',
                      'active' => false);

    extract(shortcode_atts($defaults, $atts));

    $class = 'tab-pane ';
    if ($active) $class .= 'active ';


    global $tab_content_ids;
    $id = array_shift($tab_content_ids);

    return sprintf('<div id="%s" class="%s">%s</div>', $id, $class, do_shortcode($content));

}