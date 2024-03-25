<?php

if ( ! function_exists('bgt_cpt_testimonials') ) {

// Register Custom Post Type
function bgt_cpt_testimonials() {

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Testimonials', 'wp-bootstrap-starter-creativesdfw' ),
		'singular_name'         => _x( 'Testimonials', 'Testimonials', 'wp-bootstrap-starter-creativesdfw' ),
		'menu_name'             => __( 'Testimonials', 'wp-bootstrap-starter-creativesdfw' ),
		'name_admin_bar'        => __( 'Testimonials', 'wp-bootstrap-starter-creativesdfw' ),
		'archives'              => __( 'Item Archives', 'wp-bootstrap-starter-creativesdfw' ),
		'attributes'            => __( 'Item Attributes', 'wp-bootstrap-starter-creativesdfw' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wp-bootstrap-starter-creativesdfw' ),
		'all_items'             => __( 'All Items', 'wp-bootstrap-starter-creativesdfw' ),
		'add_new_item'          => __( 'Add New Item', 'wp-bootstrap-starter-creativesdfw' ),
		'add_new'               => __( 'Add New', 'wp-bootstrap-starter-creativesdfw' ),
		'new_item'              => __( 'New Item', 'wp-bootstrap-starter-creativesdfw' ),
		'edit_item'             => __( 'Edit Item', 'wp-bootstrap-starter-creativesdfw' ),
		'update_item'           => __( 'Update Item', 'wp-bootstrap-starter-creativesdfw' ),
		'view_item'             => __( 'View Item', 'wp-bootstrap-starter-creativesdfw' ),
		'view_items'            => __( 'View Items', 'wp-bootstrap-starter-creativesdfw' ),
		'search_items'          => __( 'Search Item', 'wp-bootstrap-starter-creativesdfw' ),
		'not_found'             => __( 'Not found', 'wp-bootstrap-starter-creativesdfw' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wp-bootstrap-starter-creativesdfw' ),
		'featured_image'        => __( 'Featured Image', 'wp-bootstrap-starter-creativesdfw' ),
		'set_featured_image'    => __( 'Set featured image', 'wp-bootstrap-starter-creativesdfw' ),
		'remove_featured_image' => __( 'Remove featured image', 'wp-bootstrap-starter-creativesdfw' ),
		'use_featured_image'    => __( 'Use as featured image', 'wp-bootstrap-starter-creativesdfw' ),
		'insert_into_item'      => __( 'Insert into item', 'wp-bootstrap-starter-creativesdfw' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wp-bootstrap-starter-creativesdfw' ),
		'items_list'            => __( 'Items list', 'wp-bootstrap-starter-creativesdfw' ),
		'items_list_navigation' => __( 'Items list navigation', 'wp-bootstrap-starter-creativesdfw' ),
		'filter_items_list'     => __( 'Filter items list', 'wp-bootstrap-starter-creativesdfw' ),
	);
	$args = array(
		'label'                 => __( 'Testimonials', 'wp-bootstrap-starter-creativesdfw' ),
		'description'           => __( 'Testimonials', 'wp-bootstrap-starter-creativesdfw' ),
		'labels'                => $labels,
		'supports'              => array( 'title',  'thumbnail', 'custom-fields', 'page-attributes', 'comments' ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'menu_icon'   			=> 'dashicons-format-aside',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'testimonials', $args );

}
add_action( 'init', 'bgt_cpt_testimonials', 0 );

}