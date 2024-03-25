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

//$profile_testimonials = get_field('profile_testimonials', $post->ID);
$profile_testimonials = get_field('profile_testimonials_post', $post->ID);
//echo "<pre>", var_dump($profile_testimonials), "</pre>";

//$project_testimonial = get_field('project_testimonial', $profile_testimonials[0]);
$project_testimonial = $profile_testimonials[0]['project_testimonial'];
//var_dump($project_testimonial);

//$the_client = get_field('the_client', $profile_testimonials[0]);
$the_client = $profile_testimonials[0]['the_client'];
//var_dump($the_client);

global $taxonomy;
// $taxonomy = get_queried_object()->taxonomy;
//var_dump($taxonomy);

$terms = get_the_terms( $post->ID, $taxonomy );
$info = get_field('info', $post->ID);
?>

<div class="loop-profile-wrap-sponsor">
	<div class="row sponsor-header">
		<div class="loop-profile-title-wrap col-xl-10">
			<div class="loop-profile-title">
				<?php echo wp_get_attachment_image( $logo, $size ); ?>
				<span><?php echo get_the_title($post->ID); ?></span>
				<div class="loop-profile-sponsor">SPONSOR</div>
			</div>

			<div  class="loop-profile-description">
				<?php echo $business_description; ?>
			</div>
			<div class="row loop-profile-footer">
				<div class="col-xl-5 profile-footer-testimonial">
					<?php echo $project_testimonial; ?>
					<div class="the_client_name">- <a href="<?php echo get_permalink($post->ID); ?>" class="visit" target="_blank"><?php echo $the_client['the_client_name']; ?></a></div>
				</div>
				<div class="col-xl-4 specializing">
					<span class="service_lable">Specializing in:</span>
					<?php foreach ($terms as $key => $term) {
						echo '<span class="service_name">'. $term->name. '</span>';
					} ?>
				</div>
				<div class="col-xl-3 sponsor-info">
					<div class="loop-profile-description-wrap">
						<div class="profile-info">
							<div class="profile-info-element headcount"><i class="fas fa-users"></i><span><?php echo $info['headcount']; ?></span></div>
							<div class="profile-info-element"><i class="fas fa-map-marker-alt"></i><span><?php echo $address; ?></span></div>
						</div>
					</div>					
				</div>				
			</div>
		</div>
		<div class="col-xl-2 visit-wrap">
			<!-- <div class="visit"> -->
				<a href="<?php echo $website; ?>" class="visit bg" target="_blank"><span>Visit Website</span><i class="fas fa-globe"></i></a>
				<a href="<?php echo get_permalink($post->ID); ?>" class="visit" target="_blank"><span>View Profile</span><i class="fas fa-dot-circle"></i></a>
				<a href="#" class="visit" target="_blank"><span>Contact</span><i class="fas fa-comment-alt"></i></a>
			<!-- </div> -->
		</div>

	</div>
</div>
