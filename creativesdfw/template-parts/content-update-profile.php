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

				<?php  if ( isset($_GET['profie']) ) { ?>
					<div class="notic"><p>You are editing now - <?php echo get_the_title( $_GET['profie'] ); ?>.</p></div>
				<?php } else { ?>
					<div class="notic"><p>Profile not found!</p></div>
				<?php } ?>

			<?php } else {
				echo '<p>'. __('Please log in to edit it.', ''). '</p>';
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
					
				<?php } else if ( isset($_GET['profie']) && check_user_post($_GET['profie']) ) {
							$profie_id = $_GET['profie'];

		

					?>

					<div class="new-profile">
						<div class="container loop-container">
							<!-- <div class="row"> -->
								<h2 class="">Update a Company Profile</h2>

								<?php 

								$user = wp_get_current_user();
								//var_dump($user);
								$info = check_status_plan($user->user_email);
								//var_dump($info);
								$plan = $info['plan'];

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
							         'post_id' => $profie_id,
							         'field_groups' => $acf_plan, // Used ID of the field groups here. array(188,167) 268
							         // 'post_title' => true, // This will show the title filed
							         // 'post_content' => false, // This will show the content field
							         'form' => true,
							         // 'new_post' => array(
							         //     'post_type' => 'profile',
							         //     'post_status' => 'draft' // You may use other post statuses like draft, private etc.
							         // ),
							         'return' => home_url('edit-profile/#profiles_list'),
							          'submit_value' => __('Update profile', ''),
							         'uploader' => 'wp', //'basic'
							         //'label_placement' => 'left',
							         'html_before_fields' => '',
							     )); ?>
							<!-- </div> -->
						</div>	
					 </div>

				<?php } else { ?>

					<div class="new-profile">
						<div class="container loop-container">
								<h2 class="">You do not have permission to edit</h2>
						</div>
					</div>

				<?php }


			?>


	<div class="acf_create_profile">

	</div>

	<?php //get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->

<script>
	jQuery(document).ready(function($) {
		$('.acf-field-5c66873f7b64d').remove();
		$('.acf-field-5bb08e83ec69a').remove();

	});
</script>
