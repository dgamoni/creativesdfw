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

    <header class="entry-header">
		<?php the_title( '<h1 class="container entry-title fonticon">', '</h1>' ); ?>
	</header><!-- .entry-header -->
    
	<div class="entry-content">
		<div class="container">
			<?php the_content(); ?>
		</div>
	</div><!-- .entry-content -->

	<?php get_template_part( 'template-parts/part', 'more' ); ?>
	<?php get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->
