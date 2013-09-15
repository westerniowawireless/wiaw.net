<?php

/*
 * Extract the name of the webfont and enqueue its style.
 */
function shoestrap_typography_webfont() {
  $webfont           = get_theme_mod( 'shoestrap_google_webfonts' );
  $webfont_weight      = get_theme_mod( 'shoestrap_webfonts_weight' );
  $webfont_character_set = get_theme_mod( 'shoestrap_webfonts_character_set' );
  
  $f       = strlen( $webfont );
  if ($f > 3){
    $webfontname = str_replace( ' ', '+', $webfont );
    
  return '<link href="http://fonts.googleapis.com/css?family=' . $webfontname . ':' . $webfont_weight . '&subset=' . $webfont_character_set . '" rel="stylesheet" type="text/css">';
  
  }
}
