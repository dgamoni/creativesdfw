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

			<?php if ( is_user_logged_in() ) { ?>
				<?php 
					$user = wp_get_current_user();
					//var_dump($user);
					$info = check_status_plan($user->user_email);
					//var_dump($info);
					$plan = $info['plan'];

				?>
				<span class="loop-profile-title"><span class="lwa-title-sub" ><?php echo __( 'Hi', 'login-with-ajax' ) . " " . $user->display_name;  ?></span></span>
				<div class="notic"><p>Your subscription plan - <?php echo $plan; ?>.</p></div>
				<!-- <div class="notic <?php echo $plan; ?>"><a href="/listing-prices/">Please upgrade your plan to add more information</a></div> -->
				<a class="front_log_out btn btn-outline-success btn-acf" id="" href="<?php echo home_url('/edit-profile/'); ?>" ><?php esc_html_e( 'Edit Profile' ,'login-with-ajax') ?></a> 
				<a class="front_log_out btn btn-outline-success btn-acf" id="wp-logout" href="<?php echo wp_logout_url( home_url('/add-profile/') ); ?>"><?php esc_html_e( 'Log Out' ,'login-with-ajax') ?></a> 
				
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
					
				<?php } else { ?>

					<div class="new-profile">
						<div class="container loop-container">
							<!-- <div class="row"> -->
								<h2 class="">Create a Company Profile</h2>

								<?php 
								if( $plan == 'Free') {
									//$acf_plan = array(236);
									$acf_plan = array(1009);
									$post_status = 'draft';

								} else if( $plan == 'Gold' ) {
									//$acf_plan = array(877);
									// $acf_plan = array(1038);
									$acf_plan = array(1056);
									$post_status = 'publish';

								} else if( $plan == 'Premium' ) {
									// $acf_plan = array(877);
									$acf_plan = array(1121);
									$post_status = 'publish';
								
								} else if( $plan == 'Silver' ) {
									//$acf_plan = array(877);
									$acf_plan = array(1021);
									$post_status = 'publish';
								}
								
							     acf_form(array(
							         'post_id' => 'new_post',
							         'field_groups' => $acf_plan, // Used ID of the field groups here. array(188,167) 268
							         'post_title' => true, // This will show the title filed
							         'post_content' => false, // This will show the content field
							         'form' => true,
							         'new_post' => array(
							             'post_type' => 'profile',
							             'post_status' => $post_status // You may use other post statuses like draft, private etc.
							         ),
							         'return' => home_url('thank-you'),
							          'submit_value' => __('Add profile', ''),
							         'uploader' => 'wp', //'basic'
							         //'label_placement' => 'left',
							         'html_before_fields' => '',
							     )); ?>
							<!-- </div> -->
						</div>	
					 </div>

				<?php }


			?>


	<div class="acf_create_profile">

	</div>

	<?php //get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->
