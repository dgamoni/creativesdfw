<?php
/**
* Template Name: Creatives
 */

get_header(); ?>

	<section id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">
			<?php
				global $taxonomy;
				$taxonomy = 'creatives';
			?>
			<?php	get_template_part( 'template-parts/content', 'taxonomy-archive' );	?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer();
