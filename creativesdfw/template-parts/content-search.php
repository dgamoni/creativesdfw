<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

//var_dump($wp_query->post->post_type);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="container">

			<?php if( $wp_query->post->post_type == 'profile') { ?>	
				<a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php get_template_part( 'template-parts/loop', 'profile' ); ?></a>
			<?php } else { ?>
				<div class="loop-profile-wrap">
					<?php the_title( sprintf( '<h2 class="loop-profile-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<?php the_excerpt(); ?>
				</div>
			<?php } ?>

		</div> 

</article><!-- #post-## -->

