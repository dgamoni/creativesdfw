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
			'order'               => 'DESC',
			'orderby'             => 'date',
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

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
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

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				get_template_part( 'template-parts/loop', 'profile' );
			}
		}
		wp_reset_postdata();

		?>
	</div>

	<?php get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->
