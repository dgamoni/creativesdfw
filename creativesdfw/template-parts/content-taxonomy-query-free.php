<?php
		$args = array(
			'post_type'   => 'profile',
			'post_status' => 'publish',
			'order'               => 'ASC',
			//'orderby'             => 'date',
			'orderby'             => 'meta_value',
			'meta_key'			  => 'business-name',
			'posts_per_page'         => -1,
			//'s'				=> 'test',
			// Taxonomy Parameters
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy'         => get_queried_object()->taxonomy,
					'field'            => 'id',
					'terms'            => array( get_queried_object()->term_id ),
					'include_children' => true,
					'operator'         => 'IN',
				)
			)
			// ,'meta_query' => array(
			// 	'relation' => 'OR',
			// 	array(
			// 		'key' => 'sponsor',
			// 		'value' => null
			// 	)
			// )			
		);



		$query = new WP_Query( $args );
		//var_dump($query);


// Premium promoted
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				//var_dump($post->post_author);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				//var_dump($status['plan']);
				if ( $status['plan'] == "Premium" ) {
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile' );
					} else 
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile' );
					}
				}
			}
		}

// Gold promoted
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				//var_dump($post->post_author);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				//var_dump($status['plan']);
				if ( $status['plan'] == "Gold" ) {
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile' );
					} else 
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile' );
					}
				}
			}
		}

// Silver promoted
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				//var_dump($post->post_author);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				//var_dump($status['plan']);
				if ( $status['plan'] == "Silver" ) {
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile' );
					} else 
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile' );
					}
				}
			}
		}

// Free promoted
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				//var_dump($post->post_author);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				//var_dump($status['plan']);
				if ( $status['plan'] == "Free" ) {
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile' );
					} else 
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile' );
					}
				}
			}
		}

// Premium NON promoted
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				if ( $status['plan'] == "Premium" ) {
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile' );
					} else 
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile' );
					}
				}
			}
		}
// Gold NON promoted
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				if ( $status['plan'] == "Gold" ) {
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile' );
					} else 
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile' );
					}
				}
			}
		}

// Silver NON promoted
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				if ( $status['plan'] == "Silver" ) {
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile' );
					} else 
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile' );
					}
				}
			}
		}

// Free NON promoted
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				if ( $status['plan'] == "Free" ) {
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile' );
					} else 
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile' );
					}
				}
			}
		}



		wp_reset_postdata(); 