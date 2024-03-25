<?php

global $post;

$creatives_home_next = get_field('creatives_home_next', $post->ID);
//var_dump($creatives_home_next);
$creatives_home_next_title = $creatives_home_next['creatives_home_next_title'];
$creatives_home_next_info = $creatives_home_next['creatives_home_next_info'];
$creatives_home_next_button = $creatives_home_next['creatives_home_next_button'];
//var_dump($creatives_home_next_info);
?>

<div class="container home-block home-next">
	 <h3 class="creatives_home_next_title"><?php echo $creatives_home_next_title; ?></h3>
	 <div class="creatives_home_next_info row">
	 	<?php
	 	foreach ($creatives_home_next_info as $key => $creatives_home_next_info_) { //var_dump($creatives_home_next_info_); ?>
	 		
	 		<div class="home_next_info_col col-md-4">
	 			<div class="home_next_info_col_wrap">
			 		<?php 
				 		$image = $creatives_home_next_info_['creatives_home_next_info_icon']['ID'];
						$size = 'full';
						if( $image ) {
							echo '<div class="creatives_home_next_info_icon">'.wp_get_attachment_image( $image, $size ).'</div>';
						}
					?>
					<?php 
						echo '<h4>'.$creatives_home_next_info_['creatives_home_next_info_title'].'</h4>';
						echo '<span>'.$creatives_home_next_info_['creatives_home_next_info_descriptions'].'</span>';
					?>
				</div>
	 		</div>

	 	<?php } ?>
	 </div>
	 <div class="creatives_home_next_button">
	 	<?php 
	 		foreach ($creatives_home_next_button as $key => $creatives_home_next_button_) { ?>

	 			<a href="<?php echo  $creatives_home_next_button_['creatives_home_next_button_link']; ?>" class="btn btn-outline-success btn-acf fonticon walking">
	 				<span><?php echo  $creatives_home_next_button_['creatives_home_next_button_name']; ?></span>
	 			</a>

	 	<?php }
	 	?>
	 </div>
</div>
