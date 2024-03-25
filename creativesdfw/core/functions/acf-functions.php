<?php
function my_acf_google_map_api( $api ){
	
	$api['key'] = 'AIzaSyCx26rqWWNoELaGl1xA4SOSKzexmqk63UE';
	$api['language'] = 'en';
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api'); 


function fredy_custom_excerpt($text) {
  $text = strip_shortcodes( $text );
  $text = apply_filters('the_content', $text);
  $text = str_replace(']]>', ']]>', $text);
  $excerpt_length = apply_filters('excerpt_length', 55);
  $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
  return wp_trim_words( $text, $excerpt_length, $excerpt_more );
}