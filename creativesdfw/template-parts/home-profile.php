<?php

global $post;

$creatives_home_profile_ = get_field('creatives_home_profile', $post->ID);

?> 

<div class="home-block creatives_home_profile">
	<div class="container creatives_home_profile_wrap">
			
				<h3 class="creatives_home_profile_title"><?php echo $creatives_home_profile_['creatives_home_profile_title']; ?></h3>
				<div class="home-block-description creatives_home_profile_descriptions"><?php echo $creatives_home_profile_['creatives_home_profile_descriptions']; ?></div>
				<a href="<?php echo  $creatives_home_profile_['creatives_home_profile_button_link']; ?>" class="btn btn-outline-success btn-acf fonticon walking">
	 				<span><?php echo  $creatives_home_profile_['creatives_home_profile_button_label']; ?></span>
	 			</a>

	</div>

</div>