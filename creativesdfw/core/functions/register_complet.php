<?php


// Redirect Registration Page
//add_filter( 'init', 'my_registration_page_redirect' );
function my_registration_page_redirect() {
    global $pagenow;
    if ( strtolower($pagenow) == 'wp-login.php') {
    	//var_dump($_POST);
    }
    if ( ( strtolower($pagenow) == 'wp-login.php') && ( strtolower( $_GET['action']) == 'resetpass' ) ) {

  //   	$user = get_user_by('login', $_POST['custom_login']);
  //   	//var_dump($user->data->ID);
  //   	nocache_headers();
		// wp_clear_auth_cookie();

		// wp_set_current_user ( $user->data->ID );
		// wp_set_auth_cookie( $user->data->ID );
        //wp_redirect( home_url('/registration-complete/?patient='.$_POST['user_login']));
        //wp_redirect( home_url('/registration-complete/'));
	    $redirect_to = home_url('/add-profile/');
	    wp_safe_redirect( $redirect_to );
	    exit();
    }
}


function wpse_lost_password_redirect() {
    wp_redirect( home_url('/add-profile/') ); 
    exit;
}
add_action('after_password_reset', 'wpse_lost_password_redirect');


add_action( 'gform_user_registered','we_autologin_gfregistration', 10, 4 );
/**
* Auto login to site after GF User Registration Form Submittal
*
*/
function we_autologin_gfregistration( $user_id, $config, $entry, $password ) {
        wp_set_auth_cookie( $user_id, false, '' );
}