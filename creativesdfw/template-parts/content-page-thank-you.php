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
			
			<?php if ( is_user_logged_in() ) { ?>
				<a class="front_log_out btn btn-outline-success btn-acf" id="" href="<?php echo home_url('/add-profile/'); ?>" ><?php esc_html_e( 'Add new Profile' ,'login-with-ajax') ?></a>
				<a class="front_log_out btn btn-outline-success btn-acf" id="" href="<?php echo home_url('/edit-profile/'); ?>" ><?php esc_html_e( 'Edit Profile' ,'login-with-ajax') ?></a> 

			<?php } ?>
		</div>
	</div><!-- .entry-content -->

	<?php get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->
