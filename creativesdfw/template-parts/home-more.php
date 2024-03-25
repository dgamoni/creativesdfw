<?php

global $post;
$creatives_home_more = get_field('creatives_home_more', $post->ID);

$args_agencies = array(
	'taxonomy' => 'agencies',
	'hide_empty' => false,
	'number' 	=> 3
);
$terms_agencies = get_terms( $args_agencies );

$args_creatives = array(
	'taxonomy' => 'creatives',
	'hide_empty' => false,
	'number' 	=> 3
);
$terms_creatives = get_terms( $args_creatives );
?>

<div class="container home-block creatives_home_more">
	 <h3 class="creatives_home_more_title"><?php echo $creatives_home_more['creatives_home_more_title']; ?></h3>
	 <div class="home-block-description creatives_home_more_descriptions"><?php echo $creatives_home_more['creatives_home_more_descriptions']; ?></div>

	 <div class="home-tax-wrap _row">
		 <div class="home-tax home-agencies _col-md-5">
		 	<img class="home-tax-ico" src="<?php echo get_stylesheet_directory_uri().'/assets/img/ico_agency.png'; ?>">
		 		<h4 class="home-tax-title"><?php _e('Agencies', 'wp-bootstrap-starter-creativesdfw'); ?></h4>
		 		
		 		<div class="terms_col terms_agencies">
		 			<?php //var_dump($terms_agencies); ?>
		 			<?php foreach ($terms_agencies as $key => $terms_agencie) { //var_dump( $terms_agencie->name); ?>
			 			<div class="home-terms-element">
				 			<span class="home-terms-name"><?php echo $terms_agencie->name; ?></span>
				 			<a class="home-term-link" href='<?php echo get_term_link($terms_agencie->term_id, 'agencies'); ?>'><?php _e('SEE ALL', 'wp-bootstrap-starter-creativesdfw'); ?></a>
				 			<div class="home-term-description"><?php echo $terms_agencie->description; ?></div>
				 		</div>
			 		<?php } ?>
			 		<div class="home-tax-more-wrap"><a class="home-tax-more" href="<?php echo home_url('/find-agencies/'); ?>"><?php _e('SEE MORE', 'wp-bootstrap-starter-creativesdfw'); ?></a></div>
		 		</div>

		 </div>
		 <div class="home-tax home-creatives _col-md-5">
		 	<img class="home-tax-ico" src="<?php echo get_stylesheet_directory_uri().'/assets/img/ico_creatives.png'; ?>">
		 		<h4 class="home-tax-title"><?php _e('Other Creatives', 'wp-bootstrap-starter-creativesdfw'); ?></h4>

		 		<div class="terms_col terms_creatives">
		 			<?php //var_dump($terms_creatives); ?>
		 			<?php foreach ($terms_creatives as $key => $terms_creative) {  //var_dump( $terms_creative); ?>
				 		<div class="home-terms-element">
				 			<span class="home-terms-name"><?php echo $terms_creative->name; ?></span>
				 			<a class="home-term-link" href='<?php  echo get_term_link($terms_creative->term_id, 'creatives'); ?>'><?php _e('SEE ALL', 'wp-bootstrap-starter-creativesdfw'); ?></a>
				 			<div class="home-term-description"><?php if($terms_creative->description): echo $terms_creative->description; endif; ?></div>
				 		</div>
			 		<?php } ?>
			 		<div  class="home-tax-more-wrap" ><a class="home-tax-more" href="<?php echo home_url('/find-other-creatives/'); ?>"><?php _e('SEE MORE', 'wp-bootstrap-starter-creativesdfw'); ?></a></div>
		 		</div>
		 </div>
	</div>


	<div class="creatives_home_more_footer "><?php echo $creatives_home_more['creatives_home_more_footer']; ?></div>

</div>
 