<?php 


add_action( 'wp_ajax_sort_profile', 'sort_profile_func' );
add_action( 'wp_ajax_nopriv_sort_profile', 'sort_profile_func' );
function sort_profile_func() {
		
	$sort = $_POST['sort'];
	$tax = $_POST['tax'];
	$term = $_POST['term'];
	$search_query = $_POST['search_query'];
	$out = '';
	$countvalue = 0;
	ob_start();

	global $taxonomy;
	$taxonomy = $tax;


	if( $term == 'all' ) {
		$termss = get_terms( $tax ); 
		// convert array of term objects to array of term IDs
		$term_ids = wp_list_pluck( $termss, 'term_id' );
	} else {
		$term_ids =  array( $term );
	}


	if($sort == 'sponsor'):



		$args = array(
			'post_type'   => 'profile',
			'post_status' => 'publish',
			'order'               => 'DESC',
			'orderby'             => 'date',
			'posts_per_page'         => -1,
			// Taxonomy Parameters
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy'         => $tax,
					'field'            => 'id',
					//'terms'            => array( $term ),
					'terms'            => $term_ids,
					'include_children' => true,
					'operator'         => 'IN',
				)
			)
			,'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'sponsor',
					'value' => 1
				)
			)			
		);


		if($search_query){
			$args['s'] = $search_query;
		}

		$query = new WP_Query( $args );
		//relevanssi_do_query($query);
		//var_dump($query);

		if($search_query){
			relevanssi_do_query($query);
		}

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {

				$query->the_post();
				setup_postdata( $post );
				$countvalue++;
				get_template_part( 'template-parts/loop', 'profile-sponsor' );
			}
		}
		wp_reset_postdata();

		?>

		<?php 

		$args = array(
			'post_type'   => 'profile',
			'post_status' => 'publish',
			'order'               => 'DESC',
			'orderby'             => 'date',
			'posts_per_page'         => -1,
			// Taxonomy Parameters
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy'         => $tax,
					'field'            => 'id',
					//'terms'            => array( $term ),
					'terms'            => $term_ids,
					'include_children' => true,
					'operator'         => 'IN',
				)
			)
			,'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'sponsor',
					'value' => 0
				)
			)			
		);

		if($search_query){
			$args['s'] = $search_query;
		}

		$query = new WP_Query( $args );
		//relevanssi_do_query($query);
		//var_dump($query);

		if($search_query){
			relevanssi_do_query($query);
		}


		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$countvalue++;
				get_template_part( 'template-parts/loop', 'profile' );
			}
		}
		wp_reset_postdata();

	elseif($sort == 'DESC' || $sort == 'ASC'):

		$args = array(
			'post_type'   => 'profile',
			'post_status' => 'publish',
			'order'               => $sort,
			'orderby'             => 'date',
			'posts_per_page'         => -1,
			// Taxonomy Parameters
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy'         => $tax,
					'field'            => 'id',
					//'terms'            => array( $term ),
					'terms'            => $term_ids,
					'include_children' => true,
					'operator'         => 'IN',
				)
			)
			// ,'meta_query' => array(
			// 	'relation' => 'OR',
			// 	array(
			// 		'key' => 'sponsor',
			// 		'value' => 0
			// 	)
			// )			
		);

		if($search_query){
			$args['s'] = $search_query;
		}

		$query = new WP_Query( $args );
		//var_dump($args);
		//var_dump($query);
		//relevanssi_do_query($query);

		if($search_query){
			relevanssi_do_query($query);
		}		

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$countvalue++;
				if( get_field('sponsor', $post->ID) ){
					get_template_part( 'template-parts/loop', 'profile-sponsor' );
				} else {
					get_template_part( 'template-parts/loop', 'profile' );
				}
				
			}
		}
		wp_reset_postdata();

	endif;


	$out .= ob_get_contents();
	ob_end_clean();

	$res['value'] = $sort;
	$res['tax'] = $tax;
	$res['term'] = $term;
	$res['search_query'] = $search_query;
	$res['args'] = $args;
	$res['countvalue'] = $countvalue;
	$res['out'] = $out;

		//wp_send_json_success($res);
		echo json_encode( $res );
		exit;

}


add_action( 'wp_ajax_set_primary', 'set_primary_func' );
add_action( 'wp_ajax_nopriv_set_primary', 'set_primary_func' );
function set_primary_func() {
	
	$user = wp_get_current_user();

	$userid = $_POST['userid'];
	$level = $_POST['level'];
	$plan = $_POST['plan'];
	$gf_entries = $_POST['gf_entries'];

	$res['userid'] = $userid;
	$res['current_user'] = $user->ID;
	$res['level'] = $level;
	$res['plan'] = $plan;
	$res['gf_entries'] = $gf_entries;

	$entry = GFAPI::get_entry( $gf_entries );
	$res['entry'] = $entry;
	$d1 = new DateTime($entry['date_created']);
	$d2 = new DateTime('now');
	$diff = $d2->diff($d1);
	$res['diff'] = $diff->days;
	//$execude_cupon = array('GLOBEMONEY','ADMIN');

	// add support coupon
		$form_id = 1;
		$coupon_feed = get_gravity_coupon_feed($form_id);
		$execude_cupon = array();
		foreach ( $coupon_feed as $key => $feeds) {
			array_push($execude_cupon, $feeds["meta"]["couponCode"]);
		}
		//var_dump($execude_cupon);
	//end

	//if ( $entry['payment_status'] == 'Active' && $diff->days < 365 ) {
	if( $entry['payment_status'] == 'Active' || in_array( $entry[10], $execude_cupon) && $diff->days < 365) { // add cupon for admin

		update_field('subscription_primary_id', $entry['id'], 'user_'.$user->ID.'');
		update_field('subscription_plan', $plan, 'user_'.$user->ID.'');
		update_field('subscription_type', $level, 'user_'.$user->ID.'');

		wp_send_json_success($res);
	} else {
		wp_send_json_error($res);
	}

	// wp_send_json_success($res);
	//echo json_encode( $res );
	exit;	
}
