<?php
/**
* Template Name: ACF
 */
global $post;

$creatives_home_partners = get_field('creatives_home_partners', $post->ID);
//var_dump($creatives_home_next); 
get_header(); ?>

	<section id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">



<div class="home-block creatives_home_partners">
	<div class="container home_partners_wrap">
		<?php 
			foreach ($creatives_home_partners as $key => $creatives_home_partners_) {
		 		$image = $creatives_home_partners_['creatives_home_partners_logo']['ID'];
				$size = 'full';
				if( $image ) {

					echo '<a href="#">' . wp_get_attachment_image( $image, $size ) . '</a>';
				}				
			}
		?>
	</div>

</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer();
