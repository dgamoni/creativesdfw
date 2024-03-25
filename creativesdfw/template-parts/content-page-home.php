<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<!-- <div class="entry-content"> -->
		<?php //the_content(); ?>
	<!-- </div> -->

	<?php get_template_part( 'template-parts/home', 'next' ); ?>
	<?php get_template_part( 'template-parts/home', 'partners' ); ?>
	<?php get_template_part( 'template-parts/home', 'events' ); ?>
	<?php get_template_part( 'template-parts/home', 'more' ); ?>
	<?php get_template_part( 'template-parts/home', 'profile' ); ?>


</article><!-- #post-## -->
