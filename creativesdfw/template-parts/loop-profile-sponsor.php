<?php
global $post;

$address = get_field('address', $post->ID );
$phone = get_field('phone', $post->ID );
$website = get_field('website', $post->ID );
//$website_ = preg_replace('#^https?://#', '', $website);
$blah = parse_url($website);
//var_dump($blah['host']);
$website_ = preg_replace('/^www\./', '', $blah['host']);

$logo = get_field('Logo', $post->ID);
$size = 'full'; 
$business_description = get_field('business_description', $post->ID);
$profile_testimonials = get_field('profile_testimonials', $post->ID);
$project_testimonial = get_field('project_testimonial', $profile_testimonials[0]);
$the_client = get_field('the_client', $profile_testimonials[0]);
$taxonomy = get_queried_object()->taxonomy;
$terms = get_the_terms( $post->ID, $taxonomy );
$info = get_field('info', $post->ID);
?>

<div class="loop-profile-wrap-sponsor">
	<div class="row sponsor-header">
		<div class="loop-profile-title-wrap col-md-10">
			<div class="loop-profile-title">
				<?php echo wp_get_attachment_image( $logo, $size ); ?>
				<span><?php echo get_the_title($post->ID); ?></span>
			</div>

			<div  class="loop-profile-description">
				<?php echo $business_description; ?>
			</div>
			<div class="row loop-profile-footer">
				<div class="col-md-5">
					<?php echo $project_testimonial; ?>
					<div class="the_client_name">- <?php echo $the_client['the_client_name']; ?></div>
				</div>
				<div class="col-md-4 specializing">
					<span class="service_lable">Specializing in:</span>
					<?php foreach ($terms as $key => $term) {
						echo '<span class="service_name">'. $term->name. '</span>';
					} ?>
				</div>
				<div class="col-md-3 sponsor-info">
					<div class="loop-profile-description-wrap">
						<div class="profile-info">
							<div class="profile-info-element total"><i class="fas fa-calculator"></i><span><?php echo $info['total']; ?></span></div>
							<div class="profile-info-element pricing"><i class="far fa-clock"></i><span>$<?php echo $info['pricing']; ?>/hr</span></div>
							<div class="profile-info-element headcount"><i class="fas fa-users"></i><span><?php echo $info['headcount']; ?></span></div>
							<div class="profile-info-element"><i class="fas fa-map-marker-alt"></i><span><?php echo $address; ?></span></div>
						</div>
					</div>					
				</div>				
			</div>
		</div>
		<div class="col-md-2 visit-wrap">
			<!-- <div class="visit"> -->
				<a href="<?php echo $website; ?>" class="visit bg" target="_blank"><span>Visit Website</span><i class="fas fa-globe"></i></a>
				<a href="<?php echo get_permalink($post->ID); ?>" class="visit" target="_blank"><span>View Profile</span><i class="fas fa-dot-circle"></i></a>
				<a href="#" class="visit" target="_blank"><span>Contact</span><i class="fas fa-comment-alt"></i></a>
			<!-- </div> -->
		</div>

	</div>
</div>
