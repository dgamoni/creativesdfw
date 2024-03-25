<?php
/*
   This code snippet can be added to your functions.php file (without the <?php)
   to add a query string to the login link emailed to the user upon registration
   which when clicked will validate the user, log them in, and direct them to 
   the home page.
*/

/**
 * This first function is hooked to the 'user_register' action which fires
 * during the new user registration process. The process here gets some of
 * the data from the registration process that we will use later in the
 * new user registration email. It also creates and stores an activation
 * key that can be used as an extra security step.
 */
add_action( 'user_register', 'get_register_data_for_auto_login' );
function get_register_data_for_auto_login( $user_id ) {

	 // Create array that can be picked up later for the email.
	global $my_array;
	$my_array['ID'] = $user_id;

	// Get the username, add it to the array.
	if ( isset(  $_POST['user_login'] ) ) {
		$my_array['user_login'] =  $_POST['user_login'];
	} else {
		$user_info = get_userdata( $user_id );
		$my_array['user_login'] = $user_info->user_login;
	}

	// Create an activation key, add to array.
	$my_array['activation_key'] = md5( microtime() . rand() );
	update_user_meta( $user_id, 'auto_log_key', $my_array['activation_key'] );
}


/**
 * This is a filter function that filters the email content as it is being
 * handled by wp_mail(). I chose to do this rather than set up a function for
 * the new user registration email because that would need to be done as a 
 * plugin, since that function is a pluggable function. So this method checks
 * the email subject line to see if it is the new registration email. If it is
 * it replaces the original login link with the login link plus a query string
 * containing the user's ID, username, and activation key (from the previous
 * function above).
 */
add_filter( 'wp_mail', 'set_up_auto_login_link' );
function set_up_auto_login_link( $atts ) {
	
	// Check if email subject contains "Your username and password".
	if ( isset ( $atts ['subject'] ) && $atts['subject'] = '[Creatives in DFW] Your username and password info' ) {
		if ( isset( $atts['message'] ) ) {

			// Pick up the global array of user info from 'user_register' action.
			global $my_array;

			// Assemble the data for the query string.
			$query_args = array(
				'action'=> 'rp',
				'id' => $my_array['ID'],
				'u'  => $my_array['user_login'],
				'k'  => $my_array['activation_key'],
			);
			$query_args2 = array(
				'action'=> 'rp',
				'key'  => $my_array['activation_key'],
				'login'  => $my_array['user_login'],

			);
			// Prepare data for search/replace on the login link (to add the query string).
			$old = '/wp-login.php';
			$new = add_query_arg( $query_args, '/wp-login.php' );
			$new2 = add_query_arg( $query_args2, '/wp-login.php' );

			// Replace the original login link with the new one containing query string data for auto login.
			//$atts['message'] = str_replace( $old, $new, $atts['message'] );
			$atts['message'] .= 'Automaticlaly logged and add new profile page:'. get_site_url() . $new;
			

		}
	}

	return $atts;
}


/**
 * This action is hooked to 'init' which fires right away. The attached function
 * will look to see if the query string parameters we created for doing auto login
 * are there and if they are, it will validate them. To keep this process from 
 * being a giant security hole and allowing anyone with a user ID to become logged
 * in, all three elements must be present and must match the user account:
 * User ID, username, and the activation key.
 * 
 * @todo We could look for a better option that only fires on the wp-login.php.
 */
add_action( 'init', 'auto_log_user_in' );
function auto_log_user_in() {

	// If ID, user, and key are all present.
	if ( isset( $_GET['id'] ) 
	  && isset( $_GET['u'] ) 
	  && isset( $_GET['k'] ) ) {

		// Get the query string values.
		$user_id    = $_GET['id'];
		$user_login = $_GET['u'];
		$activation = $_GET['k'];

		// Get the user data for validation.
		$chk_user = get_user_by( 'id', $user_id );

		// If a user is returned and it's not an admin, validate and login.
		if ( $chk_user && ! user_can( $chk_user->ID, 'manage_options' ) ) {

			if ( $chk_user->user_login == $user_login && $chk_user->auto_log_key == $activation ) {

				wp_set_current_user( $chk_user->ID, $user_login );
				wp_set_auth_cookie( $chk_user->ID );
				do_action( 'wp_login', $user_login );
				wp_redirect( home_url('/add-profile/') );
				exit();

			}
		}
	}
}