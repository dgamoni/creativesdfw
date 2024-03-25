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


// add_filter('acf/validate_value/name=fron_agencies', 'only_allow_3', 20, 4);
// add_filter('acf/validate_value/name=front_creatives', 'only_allow_3', 20, 4);
function only_allow_3($valid, $value, $field, $input) {
  if (count($value) > 3) {
    $valid = 'Only Select 3';
  }
  return $valid;
}

function only_allow_1($valid, $value, $field, $input) {
  if (count($value) > 1) {
    $valid = 'Only Select One';
  }
  return $valid;
}

function only_allow_5($valid, $value, $field, $input) {
  if (count($value) > 5) {
    $valid = 'Only Select 5';
  }
  return $valid;
}

function only_allow_10($valid, $value, $field, $input) {
  if (count($value) > 10) {
    $valid = 'Only Select 10';
  }
  return $valid;
}

if ( is_user_logged_in() ) {

          $user = wp_get_current_user();
          //$user_plan = get_userplan_by_id($user->id);
          $user_plan_by_email = get_userplan_by_email($user->user_email);
          $plan = 'Free';

          foreach ($user_plan_by_email as $key => $user_plan_) {

              $d1=new DateTime($user_plan_['date_created']);
              $d2=new DateTime('now');
              $diff=$d2->diff($d1);
              $interval = date_diff($d1, $d2);
              $sub_plan = explode('|', $user_plan_[4]);

              if($user_plan_['payment_status'] == 'Active' && $diff->days < 365) { // fix for new stripe plugin
                if($plan == 'Free') {
                  $plan = $sub_plan[0];
                } else if($plan == 'Silver' && $sub_plan[0] == 'Gold' || $sub_plan[0] == 'Premium') {
                  $plan = $sub_plan[0];
                } else  if($plan == 'Gold' && $sub_plan[0] == 'Premium') {
                  $plan = $sub_plan[0];
                }
              }

          }

          if( $plan == 'Free') {
            add_filter('acf/validate_value/name=fron_agencies', 'only_allow_3', 20, 4);
            add_filter('acf/validate_value/name=front_creatives', 'only_allow_3', 20, 4);
          } else if( $plan == 'Silver' ) {
            add_filter('acf/validate_value/name=fron_agencies', 'only_allow_3', 20, 4);
            add_filter('acf/validate_value/name=front_creatives', 'only_allow_3', 20, 4);

            add_filter('acf/validate_value/name=category_to_be_promoted_ag', 'only_allow_1', 20, 4);
            add_filter('acf/validate_value/name=category_to_be_promoted_cr', 'only_allow_1', 20, 4);

          } else if( $plan == 'Gold' ) {

            add_filter('acf/validate_value/name=fron_agencies', 'only_allow_5', 20, 4);
            add_filter('acf/validate_value/name=front_creatives', 'only_allow_5', 20, 4);

            add_filter('acf/validate_value/name=category_to_be_promoted_ag', 'only_allow_5', 20, 4);
            add_filter('acf/validate_value/name=category_to_be_promoted_cr', 'only_allow_5', 20, 4);

          } else if( $plan == 'Premium' ) {

            add_filter('acf/validate_value/name=fron_agencies', 'only_allow_10', 20, 4);
            add_filter('acf/validate_value/name=front_creatives', 'only_allow_10', 20, 4);

            add_filter('acf/validate_value/name=category_to_be_promoted_ag', 'only_allow_10', 20, 4);
            add_filter('acf/validate_value/name=category_to_be_promoted_cr', 'only_allow_10', 20, 4);            
          }



}