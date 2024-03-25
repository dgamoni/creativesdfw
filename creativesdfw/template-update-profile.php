<?php
/**
* Template Name: Update profile
 */

if ( is_user_logged_in() || current_user_can('publish_posts') ) { // Execute code if user is logged in
    acf_form_head();
    wp_deregister_style( 'wp-admin' );
}

get_header(); ?>

	<section id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">

			<?php	get_template_part( 'template-parts/content', 'update-profile' );	?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer();
