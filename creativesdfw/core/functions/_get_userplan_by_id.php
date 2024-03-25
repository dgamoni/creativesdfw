<?php

function get_userplan_by_id($user_id) {
	$form_id = 1;
	
	$search_criteria = array(
	    'status'        => 'active',
	    'field_filters' => array(
	        'mode' => 'any',
	        array(
	            'key'   => 'created_by',
	            'value' => $user_id
	        )
	    )
	);
	$entries   = GFAPI::get_entries( $form_id, $search_criteria ); 

	return $entries;
}

function get_userplan_by_email($user_email) {
	$form_id = 1;
	
	$search_criteria = array(
	    'status'        => 'active',
	    'field_filters' => array(
	        'mode' => 'any',
	        array(
	            'key'   => '6',
	            'value' => $user_email
	        )
	    )
	);
	$entries   = GFAPI::get_entries( $form_id, $search_criteria ); 

	return $entries;
}

function check_status_plan($user_email) {
	$plan = 'Free';
	$form_id = 1;
	$info = array();
	
	$search_criteria = array(
	    'status'        => 'active',
	    'field_filters' => array(
	        'mode' => 'any',
	        array(
	            'key'   => '6',
	            'value' => $user_email
	        )
	    )
	);
	$entries   = GFAPI::get_entries( $form_id, $search_criteria ); 

	// add support coupon
		$coupon_feed = get_gravity_coupon_feed($form_id);
		$execude_cupon = array();
		foreach ( $coupon_feed as $key => $feeds) {
			array_push($execude_cupon, $feeds["meta"]["couponCode"]);
		}
		//var_dump($execude_cupon);
	//end 	

	foreach ($entries as $key => $user_plan_) {

		//echo "<pre>", var_dump($user_plan_), "</pre>";
		//var_dump($user_plan_[4]);
		//var_dump($user_plan_[9]);

		$d1=new DateTime($user_plan_['date_created']);
		//var_dump($d1);
		$d2=new DateTime('now');
		//$d2=new DateTime('2019-02-29');
		//var_dump($d2);
		$diff=$d2->diff($d1);
		//var_dump($diff);
		$interval = date_diff($d1, $d2);
		//var_dump($interval->days);
		// $sub_plan = explode('|', $user_plan_[1]);

		//$sub_plan = explode('|', $user_plan_[4]);
		$sub_plan1 = explode('|', $user_plan_[9]);
		//var_dump($sub_plan1);
		$sub_plan2 = explode('|', $user_plan_[4]);
		//var_dump($sub_plan2);
		if($user_plan_[9]) {
			$sub_plan = $sub_plan1;
		} else {
			$sub_plan = $sub_plan2;
		}

		//var_dump($sub_plan);

		$type = $user_plan_[8];
		if(!$user_plan_[8]) {
			$type = 'agencies';
		}

		//$entryid = '';

		//var_dump($diff->days);
		//var_dump($user_plan_['payment_status']);
		//var_dump($user_plan_[10]);
		//$execude_cupon = array('GLOBEMONEY','ADMIN');
		//$execude_cupon = array('ADMIN');
		//$execude_cupon = array();
		//var_dump($user_plan_['payment_status']);
		//var_dump(in_array( $user_plan_[10], $execude_cupon));

		//if($user_plan_['payment_status'] == 'Paid' && $diff->days < 365) {
		//if($user_plan_['payment_status'] == 'Active' && $diff->days < 365) { // fix for new stripe plugin
		// if($user_plan_['payment_status'] == 'Active' || $user_plan_[10] == 'ADMIN' && $diff->days < 365) { // add cupon for admin
		if($user_plan_['payment_status'] == 'Active' || in_array( $user_plan_[10], $execude_cupon) && $diff->days < 365) { // add cupon for admin
			$status = 'Active';
			
			if($plan == 'Free') {
				$plan = $sub_plan[0];
				$days = $diff->days;
				$interval_ = date_diff($d1, $d2);
				//$sub_plan_ = explode('|', $user_plan_[4]);
				//$sub_plan_ = $sub_plan;
				$type_ = $type;

			} else if($plan == 'Silver' && $sub_plan[0] == 'Gold' || $sub_plan[0] == 'Premium') {
				$plan = $sub_plan[0];
				$days = $diff->days;
				$interval_ = date_diff($d1, $d2);
				//$sub_plan_ = explode('|', $user_plan_[4]);
				//$sub_plan_ = $sub_plan;
				$type_ = $type;
				$entryid = $user_plan_['id'];

			} else  if($plan == 'Gold' && $sub_plan[0] == 'Premium') {
				$plan = $sub_plan[0];
				$days = $diff->days;
				$interval_ = date_diff($d1, $d2);
				//$sub_plan_ = explode('|', $user_plan_[4]);
				//$sub_plan_ = $sub_plan;
				$type_ = $type;
				$entryid = $user_plan_['id'];
			}
			
		} else {
			//$status = 'inactive';
			//$days = $diff->days;
		}

	//var_dump($plan);	

		//var_dump($sub_plan[0]);

		// if($user_plan_['payment_status'] == 'Active' && $sub_plan[0] == 'Silver' && $interval->days < 30 ) {
		// 	$plan = $sub_plan[0];
		// } else 
		// if($user_plan_['payment_status'] == 'Active' && $sub_plan[0] == 'Gold' && $interval->days < 30 ) {
		// 	$plan = $sub_plan[0];
		// }
	}

	$userid = get_user_by('email', $user_email)->ID;

	$subscription_primary_id = get_field('subscription_primary_id', 'user_'.$userid.'');
	$subscription_plan = get_field('subscription_plan', 'user_'.$userid.'');
	$subscription_type = get_field('subscription_type', 'user_'.$userid.'');
	
	$info['primary']['id'] = $subscription_primary_id;
	$info['primary']['plan'] = $subscription_plan;
	$info['primary']['type'] = $subscription_type;
	

	$info['plan'] = $plan;
	//$info['days'] = $days;
	//$info['interval'] = $interval_;
	$info['type'] = $type_;
	$info['entryid'] = $entryid;

	if ( $subscription_primary_id ) {
		$entry_primary = GFAPI::get_entry($subscription_primary_id);
		if ( $entry_primary['status'] == 'active' && get_diff_interval( $entry_primary['date_created'] ) < 365 ) {
			$info['plan'] = $subscription_plan;
			$info['type'] = $subscription_type;
			$info['entryid'] = $subscription_primary_id;
			$info['status'] = $entry_primary['status'];
		}
		
	}

	return $info;
}


function get_diff_interval($date) {
	$d1 = new DateTime($date);
	$d2 = new DateTime('now');
	$diff = $d2->diff($d1);
	return $diff->days;
}

function check_user_post($profie_id) {
	$author_id = get_post_field ('post_author', $profie_id);
	$user = wp_get_current_user();
	if ( $author_id == $user->ID ) {
		return true;
	} else {
		return false;
	}
}

function get_gravity_coupon_feed( $form_id = null ) {
		global $wpdb;

		$form_filter     = is_numeric( $form_id ) ? $wpdb->prepare( 'AND form_id=%d', absint( $form_id ) ) : '';
		$form_table_name = RGFormsModel::get_form_table_name();

		//only get coupons associated with active forms (is_trash = 0) per discussion with alex/dave
		//use is_trash is null to get the coupons associated with the "Any form" option because form id will be zero and the join will not include the coupon without this
		$sql = $wpdb->prepare(
			"SELECT af.* FROM {$wpdb->prefix}gf_addon_feed af LEFT JOIN {$form_table_name} f ON af.form_id = f.id
                               WHERE addon_slug=%s {$form_filter} AND (is_trash = 0 OR is_trash is null)", 'gravityformscoupons'
		);

		$results = $wpdb->get_results( $sql, ARRAY_A );
		foreach ( $results as &$result ) {
			$result['meta'] = json_decode( $result['meta'], true );
		}

		return $results;
	}