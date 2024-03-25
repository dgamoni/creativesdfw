<?php
if ( ! function_exists( 'tax_event_cat' ) ) {

// Register Custom Taxonomy
function tax_event_cat() {

	$labels = array(
		'name'                       => _x( 'Event Category', 'Event Category', 'wp-bootstrap-starter-creativesdfw' ),
		'singular_name'              => _x( 'Event Category', 'Event Category', 'wp-bootstrap-starter-creativesdfw' ),
		'menu_name'                  => __( 'Event Category', 'wp-bootstrap-starter-creativesdfw' ),
		'all_items'                  => __( 'All Items', 'wp-bootstrap-starter-creativesdfw' ),
		'parent_item'                => __( 'Parent Item', 'wp-bootstrap-starter-creativesdfw' ),
		'parent_item_colon'          => __( 'Parent Item:', 'wp-bootstrap-starter-creativesdfw' ),
		'new_item_name'              => __( 'New Item Name', 'wp-bootstrap-starter-creativesdfw' ),
		'add_new_item'               => __( 'Add New Item', 'wp-bootstrap-starter-creativesdfw' ),
		'edit_item'                  => __( 'Edit Item', 'wp-bootstrap-starter-creativesdfw' ),
		'update_item'                => __( 'Update Item', 'wp-bootstrap-starter-creativesdfw' ),
		'view_item'                  => __( 'View Item', 'wp-bootstrap-starter-creativesdfw' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'wp-bootstrap-starter-creativesdfw' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'wp-bootstrap-starter-creativesdfw' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wp-bootstrap-starter-creativesdfw' ),
		'popular_items'              => __( 'Popular Items', 'wp-bootstrap-starter-creativesdfw' ),
		'search_items'               => __( 'Search Items', 'wp-bootstrap-starter-creativesdfw' ),
		'not_found'                  => __( 'Not Found', 'wp-bootstrap-starter-creativesdfw' ),
		'no_terms'                   => __( 'No items', 'wp-bootstrap-starter-creativesdfw' ),
		'items_list'                 => __( 'Items list', 'wp-bootstrap-starter-creativesdfw' ),
		'items_list_navigation'      => __( 'Items list navigation', 'wp-bootstrap-starter-creativesdfw' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'event_cat', array( 'e' ), $args );

}
add_action( 'init', 'tax_event_cat', 0 );

}