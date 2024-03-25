<?php

add_filter( 'cron_schedules', 'cron_add_five_min' );
function cron_add_five_min( $schedules ) {
	$schedules['one_min'] = array(
		'interval' => 60,
		'display' => 'One min'
	);
	return $schedules;
} 


add_action( 'wp', 'my_activation' );
function my_activation() {
	if ( ! wp_next_scheduled( 'my_five_min_event' ) )
		//wp_schedule_event( time(), 'one_min', 'my_five_min_event' );
		wp_schedule_event( time(), 'daily', 'my_five_min_event' );
}


add_action( 'my_five_min_event', 'do_every_five_min' );
function do_every_five_min(){

		$args = array(
			'post_type'   => 'profile',
			'post_status' => 'publish',
			'posts_per_page'         => -1,
		);

		$query = new WP_Query( $args );
		$message = '';

		foreach ($query->posts as $key => $post) {

				$role = get_user_by('id', $post->post_author )->roles[0];
				$sponsor = get_field('sponsor' , $post->ID);
				$premium_sponsor = get_field('premium_sponsor' , $post->ID);

				if( $role != 'administrator' ) {

					$user_email = get_user_by('id', $post->post_author )->user_email;
					$plan = check_status_plan($user_email)["plan"];
					
					if ( $plan == 'Free' && $sponsor ) {
						update_field('sponsor', 0,  $post->ID );
						$message .= '<a href="'.get_permalink( $post->ID ).'">'.$post->post_title. '</a> sposor to false ';
					}
					if ( $plan == 'Free' && $premium_sponsor ) {
						update_field('premium_sponsor', 0,  $post->ID );
						$message .= '<a href="'.get_permalink( $post->ID ).'">'.$post->post_title. '</a> premiumsposor to false ';
					}
					if ( $plan != 'Free' && !$sponsor) {
						update_field('sponsor', 1,  $post->ID );
						$message .= '<a href="'.get_permalink( $post->ID ).'">'.$post->post_title. '</a> sposor to true ';
					} 
					if ( $plan == 'Premium' && !$premium_sponsor ) {
						update_field('premium_sponsor', 1,  $post->ID );
						$message .= '<a href="'.get_permalink( $post->ID ).'">'.$post->post_title. '</a> premium_sponsor to true ';
					} else {
						$message .= $post->post_title. 'not updated ';
					}

					// echo '<pre>';
					$message .= '$user_email='.$user_email.'  ';
					$message .= '$plan='.$plan.'  ';
						$message .= 'ID='.$post->ID.'  ';
						$message .= 'post_author= '.$post->post_author.'   ';
						$message .=  'sponsor='.get_field('sponsor' , $post->ID).'   ';
						$message .= 'title='.$post->post_title.'   ';
						//$message .=  'user_by='.get_user_by('id', $post->post_author )->roles[0].'   ';
						$message .=  'check_status='.check_status_plan($user_email)["plan"].'   ';
						$message .= '------------------------------/n ';
					// echo '</pre>';

				}
			
		}
		wp_reset_postdata();
		//wp_mail( 'dgamoni@gmail.com', 'Автоматическое письмо', $message );
}