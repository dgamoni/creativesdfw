<?php
global $post;

$address = get_field('address', $post->ID );
$phone = get_field('phone', $post->ID );
$website = get_field('website', $post->ID );
//$website_ = preg_replace('#^https?://#', '', $website);
$blah = parse_url($website);
//var_dump($blah['host']);
$website_ = preg_replace('/^www\./', '', $blah['host']);
?>

<div class="loop-profile-wrap">
	<div class="loop-profile-title">
		<?php echo get_the_title($post->ID); ?>
	</div>
	<div class="loop-profile-description">
		<div class="row">
			<div class="_col-md-5">
				<div class="loop-profile-description-wrap">
					<span class="col-md-2 loop-profile-address"><i class="fas fa-map-marker-alt"></i><?php echo $address; ?></span>
					<span class="col-md-2 loop-profile-phone"><i class="fas fa-phone-square"></i><?php echo $phone; ?></span>
					<span class="col-md-2 loop-profile-website"><i class="fas fa-globe"></i><a href="<?php echo $website; ?>" target="_blank"><?php echo $website_; ?></a></span>
				</div>
			</div>
		</div>
	</div>
</div>
