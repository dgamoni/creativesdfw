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


// $user_author = get_user_by('id', $post->post_author);
// $status = check_status_plan($user_author->user_email);
// $premium_sponsor = get_field( 'premium_sponsor',$post->ID);
// var_dump($premium_sponsor);
// var_dump($status['plan']);


global $taxonomy;
// $taxonomy = get_queried_object()->taxonomy;
//var_dump($taxonomy);

$terms = get_the_terms( $post->ID, $taxonomy );
$info = get_field('info', $post->ID);


$adwords_pixel_code = get_field('adwords_pixel_code',$post->ID);
//var_dump($adwords_pixel_code);
if($adwords_pixel_code) {
	echo $adwords_pixel_code;
}

global $status_sponsor;
if ( $status_sponsor ) {
	$status_sponsor_ = $status_sponsor;
} else {
	$status_sponsor_ = 'sponsor';
}
?>

<div class="loop-profile-wrap-sponsor status_sponsor_<?php echo $status_sponsor_; ?>">
	<div class="row sponsor-header">
		<div class="loop-profile-title-wrap col-xl-10">
			<div class="loop-profile-title">
				<?php echo wp_get_attachment_image( $logo, $size ); ?>
				<span><?php echo get_the_title($post->ID); ?></span>
				<div class="loop-profile-sponsor"><?php echo $status_sponsor_; ?></div>
			</div>

			<div  class="loop-profile-description">
				<?php echo $business_description; ?>
			</div>
			<div class="row loop-profile-footer">
				<div class="col-xl-5 profile-footer-testimonial">
					<?php echo $project_testimonial; ?>
					<?php if ( $the_client['the_client_name'] ) : ?>
						<div class="the_client_name">- <a href="<?php echo get_permalink($post->ID); ?>" class="visit" target="_blank"><?php echo $the_client['the_client_name']; ?></a></div>
					<?php endif; ?>
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
							<?php if ( $info['headcount'] ): ?>
								<div class="profile-info-element headcount"><i class="fas fa-users"></i><span><?php echo $info['headcount']; ?></span></div>
							<?php endif; ?>
							<?php if ( $address ): ?>
								<div class="profile-info-element"><i class="fas fa-map-marker-alt"></i><span><?php echo $address; ?></span></div>
							<?php endif; ?>
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
