<?php

function get_post_count_bytax($taxonomy) {
		

		$taxonomy_terms = get_terms( $taxonomy, array(
		    'hide_empty' => 0,
		    'fields' => 'ids'
		) );

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
		            'taxonomy' => $taxonomy,
		            'field' => 'id',
		            'terms' => $taxonomy_terms
				)
			)
		);



		$query = new WP_Query( $args );
		$count = $query->post_count;
		wp_reset_postdata();

	return $count;
} 