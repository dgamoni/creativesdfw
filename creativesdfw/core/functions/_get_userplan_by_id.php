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