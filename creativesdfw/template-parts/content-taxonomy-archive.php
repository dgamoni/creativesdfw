<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

//var_dump(get_queried_object());
global $taxonomy;

$taxonomy_terms = get_terms( $taxonomy, array(
    'hide_empty' => 0,
    'fields' => 'ids'
) );
?>

<article <?php post_class('profile'); ?>>

    <header class="entry-header">
		<h1 class="container entry-title fonticon"><?php echo get_the_title() ?></h1>
	</header><!-- .entry-header -->
    
	<div class="entry-content">
		<div class="container">
			<?php echo get_the_content(); ?>
		</div>
	</div>
	
	<div class="profile-filter">
		<div class="container loop-container">
			<div class="row filter-row">
				<div class="col-md-6">
					<div class="countlabel">
						<span class="countvalue"><?php echo get_post_count_bytax($taxonomy); ?></span> <?php echo $taxonomy; ?>
					</div>
				</div>
				<div class="tax-filter col-md-6">
					<div class="row ">
						<div class="input-group col-xl-6">
						  <div class="input-group-prepend">
						    <button class="btn btn-outline-secondary" type="button">Sort by</button>
						  </div>
						  <select class="custom-select" id="sort_profile" aria-label="" data-tax="<?php echo $taxonomy; ?>" data-term="<?php echo 'all';  ?>">
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
		//global $taxonomy;
		//$taxonomy = get_queried_object()->taxonomy;
		


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
		            'taxonomy' => $taxonomy,
		            'field' => 'id',
		            'terms' => $taxonomy_terms
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
				// var_dump(get_field( 'category_to_be_promoted_ag',$post->ID));
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
		            'taxonomy' => $taxonomy,
		            'field' => 'id',
		            'terms' => $taxonomy_terms
				)
			)
			// ,'meta_query' => array(
			// 	'relation' => 'OR',
			// 	array(
			// 		'key' => 'sponsor',
			// 		'value' => 0
			// 	)
			// )			
		);



		$query = new WP_Query( $args );
		//var_dump($query->post_count);

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				setup_postdata( $post );
				//var_dump(get_field( 'category_to_be_promoted_ag',$post->ID));
				//var_dump($post);
				get_template_part( 'template-parts/loop', 'profile' );
			}
		}
		wp_reset_postdata();

		?>
	</div>

	<?php get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->
