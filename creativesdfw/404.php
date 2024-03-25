<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

	<section id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				    <header class="entry-header">
						
					</header><!-- .entry-header -->
				    
					<div class="entry-content">
						<div class="container">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wp-bootstrap-starter' ); ?></h1>
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wp-bootstrap-starter' ); ?></p>
							<?php get_search_form(); ?>
						</div>
					</div><!-- .entry-content -->

					<?php get_template_part( 'template-parts/home', 'profile' ); ?>

				</article><!-- #post-## -->

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer();