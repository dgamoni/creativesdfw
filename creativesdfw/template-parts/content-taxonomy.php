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
						<?php echo get_queried_object()->count; ?> <?php echo get_queried_object()->taxonomy; ?>
					</div>
				</div>
				<div class="tax-filter col-md-6">
					<div class="row ">
						<div class="input-group col-md-6">
						  <div class="input-group-prepend">
						    <button class="btn btn-outline-secondary" type="button">Sort by</button>
						  </div>
						  <select class="custom-select" id="inputGroupSelect03" aria-label="">
						    <option selected>Sponsored</option>
						    <option value="1">One</option>
						    <option value="2">Two</option>
						    <option value="3">Three</option>
						  </select>
						</div> <!-- /input-group -->

						<div class="input-group col-md-6">
							<input type="text" class="form-control" aria-label="Filter Results" placeholder="Filter Results">
						</div> <!-- /input-group -->
					</div> <!-- /row -->
				</div> <!-- /reviews-filter -->
			</div>
		</div>
		
	</div>
<!-- 	<div class="container loop-container">
		<div class="filter-divider"></div>
	</div> -->
	<div class="container loop-container profile-loop-wrap">

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
					'value' => 0
				)
			)			
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
