<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

//var_dump(get_queried_object());
?>

<article <?php post_class(); ?>>

    <header class="entry-header">
		<h1 class="container entry-title fonticon"><?php echo get_the_archive_title() ?></h1>
	</header><!-- .entry-header -->
    
	<div class="entry-content">
		<div class="container">
			<?php echo term_description(); ?>
		</div>
	</div><!-- .entry-content -->
	
	<div class="profile-filter">
		<div class="container loop-container">
			<div class="row filter-row">
				<div class="col-md-6">
					<div class="countlabel">
						<span class="countvalue"><?php echo get_queried_object()->count; ?></span> <?php echo get_queried_object()->taxonomy; ?>
					</div>
				</div>
				<div class="tax-filter col-md-6">
					<div class="row ">
						<div class="input-group col-xl-6">
						  <div class="input-group-prepend">
						    <button class="btn btn-outline-secondary" type="button">Sort by</button>
						  </div>
						  <select class="custom-select" id="sort_profile" aria-label="" data-tax="<?php echo get_queried_object()->taxonomy; ?>" data-term="<?php echo get_queried_object()->term_id; ?>">
						    <option value="sponsor" selected>Sponsored</option>
						    <option value="DESC">DESC</option>
						    <option value="ASC">ASC</option>
						    <!-- <option value="date">Date</option> -->
						    <!-- <option value="name">Name</option> -->
						  </select>
						</div> <!-- /input-group -->

						<div class="input-group col-xl-6">
							<input id="search_profile" type="text" class="form-control" aria-label="Filter Results" placeholder="Filter Results">
						</div> <!-- /input-group -->
					</div> <!-- /row -->
				</div> <!-- /reviews-filter -->
			</div>
		</div>
		
	</div>
<!-- 	<div class="container loop-container">
		<div class="filter-divider"></div>
	</div> -->
	<div id="profile-loop-wrap" class="container loop-container profile-loop-wrap">

		<?php 
		global $taxonomy;
		$taxonomy = get_queried_object()->taxonomy;
		//var_dump(get_queried_object()->term_id );
		
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
			,'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'sponsor',
					'value' => 1
				)
			)			
		);



		$query = new WP_Query( $args );
		//var_dump($query);
		global $status_sponsor;


// sponsor + premium_sponsor + Premium user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				//var_dump($status);
				$status_sponsor = 'premium sponsor';
				if ( $status['plan'] == "Premium" ) {
					$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
					if ( $premium_sponsor) {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				} 
			}
		}

// sponsor + premium_sponsor + Gold user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				$status_sponsor = 'premium sponsor';
				if ( $status['plan'] == "Gold" ) {
					$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
					if ( $premium_sponsor) {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				} 
			}
		}

// sponsor + premium_sponsor + Silver user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				$status_sponsor = 'premium sponsor';
				if ( $status['plan'] == "Silver" ) {
					$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
					if ( $premium_sponsor) {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				} 
			}
		}

// sponsor + premium_sponsor + Free user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				$status_sponsor = 'premium sponsor';
				if ( $status['plan'] == "Free" ) {
					$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
					if ( $premium_sponsor) {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				} 
			}
		}

//sponsor + promoted + Premium user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				$status_sponsor = 'promoted';
				if ( $status['plan'] == "Premium" ) {				
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies' && !$premium_sponsor) {
					//if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					} else 
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives' && !$premium_sponsor) {
					//if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				}
			}
		}

//sponsor + promoted + Gold user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				$status_sponsor = 'promoted';
				if ( $status['plan'] == "Gold" ) {				
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies' && !$premium_sponsor) {
					//if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					} else 
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives' && !$premium_sponsor) {
					//if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				}
			}
		}

//sponsor + promoted + Silver user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				$status_sponsor = 'promoted';
				if ( $status['plan'] == "Silver" ) {				
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies' && !$premium_sponsor) {
					//if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					} else 
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives' && !$premium_sponsor) {
					//if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				}
			}
		}

//sponsor + promoted + Free user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				$status_sponsor = 'promoted';
				if ( $status['plan'] == "Free" ) {				
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies' && !$premium_sponsor) {
					//if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					} else 
					if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives' && !$premium_sponsor) {
					//if (in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				}
			}
		}

//sponsor + Premium user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				//get_template_part( 'template-parts/loop', 'profile-sponsor' );
				$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				$status_sponsor = 'sponsor';
				if ( $status['plan'] == "Premium" ) {				
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies' && !$premium_sponsor) {
					//if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
					//if ( $taxonomy == 'agencies' ) {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					} else 
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives' && !$premium_sponsor) {
					//if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
					//if ( $taxonomy == 'creatives' ) {	
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				}
			}
		}

//sponsor + Gold user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				//get_template_part( 'template-parts/loop', 'profile-sponsor' );
				$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				$status_sponsor = 'sponsor';
				if ( $status['plan'] == "Gold" ) {				
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies' && !$premium_sponsor) {
					//if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
					//if ($taxonomy == 'agencies') {	
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					} else 
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives' && !$premium_sponsor) {
					//if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
					//if ($taxonomy == 'creatives') {	
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				}
			}
		}

//sponsor + Silver user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				//get_template_part( 'template-parts/loop', 'profile-sponsor' );
				$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				$status_sponsor = 'sponsor';
				if ( $status['plan'] == "Silver" ) {				
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies' && !$premium_sponsor) {
					//if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
					//if ($taxonomy == 'agencies') {	
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					} else 
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives' && !$premium_sponsor) {
					//if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
					//if ($taxonomy == 'creatives') {	
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				}
			}
		}

//sponsor + Free user
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				//get_template_part( 'template-parts/loop', 'profile-sponsor' );
				$premium_sponsor = get_field( 'premium_sponsor',$post->ID);
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				$status_sponsor = 'sponsor';
				if ( $status['plan'] == "Free" ) {				
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies' && !$premium_sponsor) {
					//if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_ag',$post->ID) ) && $taxonomy == 'agencies') {
					//if ($taxonomy == 'agencies') {
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					} else 
					if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives' && !$premium_sponsor) {
					//if (!in_array( get_queried_object()->term_id, get_field( 'category_to_be_promoted_cr',$post->ID) ) && $taxonomy == 'creatives') {
					//if ($taxonomy == 'creatives') {	
						get_template_part( 'template-parts/loop', 'profile-sponsor' );
					}
				}
			}
		}


		wp_reset_postdata();

		?>

		<?php //get_template_part( 'template-parts/content-taxonomy', 'query-free' );	?>

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




// all
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				$user_author = get_user_by('id', $post->post_author);
				$status = check_status_plan($user_author->user_email);
				//if ( $status['plan'] == "Free" ) {
					if ( $taxonomy == 'agencies' ) {
						get_template_part( 'template-parts/loop', 'profile' );
					} else 
					if ( $taxonomy == 'creatives' ) {
						get_template_part( 'template-parts/loop', 'profile' );
					}
				//}
			}
		}



		wp_reset_postdata();

		?>
	</div>

	<?php get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->
