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
				<?php 
					$user = wp_get_current_user(); 
					// $info = check_status_plan($user->user_email);
					//var_dump($info);
					//var_dump($user);
					?>

				<!-- <span class="loop-profile-title"><span class="lwa-title-sub" ><?php echo __( 'Hi', 'login-with-ajax' ) . " " . $user->display_name;  ?></span></span> -->
				<!-- <div class="notic"><p>Your subscription plan - <?php echo $info['plan']; ?>.</p></div> -->

				<?php get_template_part( 'template-parts/part', 'profile' ); ?>
					

				<!-- <a class="front_log_out btn btn-outline-success btn-acf" id="wp-logout" href="<?php echo wp_logout_url( home_url() ); ?>"><?php esc_html_e( 'Log Out' ,'login-with-ajax') ?></a>  -->

			<?php } else {
				echo '<p>'. __('Please register to begin creating your profile <br>or log in to edit it.', ''). '</p>';
				} ?>			
		</div>
	</div><!-- .entry-content -->

			<?php 
				// Bail if not logged in or able to post
				if ( !is_user_logged_in() ) { ?>

					<div class="container loop-container login-wrap">
						<?php 
							echo do_shortcode('[login-with-ajax]');
						?>
					</div>
					
				<?php } ?>


	<?php //get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->
