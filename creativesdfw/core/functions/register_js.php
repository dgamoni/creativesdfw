<?php
function custom_child_scripts() {

	// wp_enqueue_style(
	// 	'solid', 
	// 	'https://use.fontawesome.com/releases/v5.3.1/css/solid.css',
	// 	array(),
	// 	'5.3.1'
	// );

	// wp_enqueue_style(
	// 	'fontawesome', 
	// 	'https://use.fontawesome.com/releases/v5.3.1/css/fontawesome.css',
	// 	array('solid'),
	// 	'5.3.1'
	// );

	wp_enqueue_style(
		'jquery-bxslider', 
		CORE_URL . '/css/jquery.bxslider.css'
	);

	wp_enqueue_script(
	    'jquery-bxslider',
	    CORE_URL . '/js/jquery.bxslider.js',
	    array('jquery')
	);
		
	wp_enqueue_script(
	    'custom_script',
	    CORE_URL . '/js/custom.js',
        array('jquery'), 
        '1', 
        true  
	);

	wp_localize_script( 'custom_script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	
}
add_action( 'wp_enqueue_scripts', 'custom_child_scripts' ); 

