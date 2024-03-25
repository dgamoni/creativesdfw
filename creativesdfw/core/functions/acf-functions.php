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
          //$user_plan_by_email = get_userplan_by_email($user->user_email);
          $status = check_status_plan($user->user_email);
          $plan = $status['plan'];

          // foreach ($user_plan_by_email as $key => $user_plan_) {

          //     $d1=new DateTime($user_plan_['date_created']);
          //     $d2=new DateTime('now');
          //     $diff=$d2->diff($d1);
          //     $interval = date_diff($d1, $d2);
          //     $sub_plan = explode('|', $user_plan_[4]);

          //     if($user_plan_['payment_status'] == 'Active' && $diff->days < 365) { // fix for new stripe plugin
          //       if($plan == 'Free') {
          //         $plan = $sub_plan[0];
          //       } else if($plan == 'Silver' && $sub_plan[0] == 'Gold' || $sub_plan[0] == 'Premium') {
          //         $plan = $sub_plan[0];
          //       } else  if($plan == 'Gold' && $sub_plan[0] == 'Premium') {
          //         $plan = $sub_plan[0];
          //       }
          //     }

          // }

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


add_action('acf/save_post', 'my_save_post');
function my_save_post( $post_id ) {
  
  // bail early if not a contact_form post
  if( get_post_type($post_id) !== 'profile' ) {
     return;
  }
  
  // bail early if editing in admin
  if( is_admin() ) {
    return;
  }

  // vars
  $user = wp_get_current_user();
  $info = check_status_plan($user->user_email);
  $plan = $info['plan'];
  $post = get_post( $post_id );
  $user_url = 'user-edit.php?user_id='.$user->ID;
  $prof_url = 'post.php?post='.$post_id.'&action=edit';
  $business_name = get_field( 'business-name', $post_id ); 
  $post_status = $post->post_status;

  // update status post by plan
  if( $post_id !== 'new_post' ) {
      if( $plan == 'Free' && $post->post_status != 'draft' ) {
        wp_update_post( array('ID' => $post_id, 'post_status'  => 'draft') );
        $post_status = 'draft';

      } else if( $plan == 'Gold' && $post->post_status != 'publish' ) {
        wp_update_post( array('ID' => $post_id, 'post_status'  => 'publish') );
        $post_status = 'publish';

      } else if( $plan == 'Premium' && $post->post_status != 'publish' ) {
        wp_update_post( array('ID' => $post_id, 'post_status'  => 'publish') );
        $post_status = 'publish';
      
      } else if( $plan == 'Silver' && $post->post_status != 'publish' ) {
        wp_update_post( array('ID' => $post_id, 'post_status'  => 'publish') );
        $post_status = 'publish';
      }

  }
  

  
  // email data
  //$to = 'dgamoni@gmail.com';
  $multiple_to_recipients = get_administrator_email();
  $multiple_to_recipients[] = 'dgamoni@gmail.com';
  $to = $multiple_to_recipients;
  $headers = 'From: WordPress <wordpress@creativesindfw.com>' . "\r\n";
  $subject = '[Creatives in DFW] New profile added/updated';
  $body = 'Hi Admin' . "\r\n";
  $body .= 'User <a href="'. admin_url( $user_url, 'https' ).'" target="_blank">' .$user->display_name. '</a> <'.$user->user_email.'> added/updated Profile. <br>'. "\r\n";
  $body .= 'Post <a href="'. admin_url( $prof_url, 'https' ).'" target="_blank">' .$post->post_title. '</a> in status '.$post_status.' <br>'. "\r\n";
  $body .= 'Business Name: '.$business_name . '<br>' . "\r\n";
  $body .= 'User plan: '.$info['plan'].' '. $info['type'] .' <br>'. "\r\n";
  // send email
  wp_mail($to, $subject, $body, $headers );
  
}

function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );


function get_administrator_email(){
    $blogusers = get_users('role=Administrator');
    //print_r($blogusers);
    foreach ($blogusers as $user) {
        $multiple_to_recipients[] = $user->user_email;
      } 
  return $multiple_to_recipients;
}


//add_filter('acf/validate_value/key=_post_title', 'my_acf_validate_business_name', 10, 4);
function my_acf_validate_business_name( $valid, $value, $field, $input ){
  
  // bail early if value is already invalid
  // if( !$valid ) {
  //   return $valid;
  // }
  
  
  if( !$value ) {
    
    $value = 'no-title';
    
  }
  
  
  // return
  return $valid;
  
  
}