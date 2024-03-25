<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

	<section id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">

			<?php	get_template_part( 'template-parts/content', 'taxonomy' );	?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer();
