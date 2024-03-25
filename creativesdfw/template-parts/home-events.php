<?php

global $post;

//$creatives_home_profile_ = get_field('creatives_home_profile', $post->ID);

?> 

<div class="container home-block creatives_home_events">
	<h3 class="creatives_home_profile_title"><?php _e('Upcoming Events in DFW', 'wp-bootstrap-starter-creativesdfw'); ?></h3>
	
	<div class="bxslider">
		<?php 


			$args = array(
				'post_type'   => 'e',
				'post_status' => 'publish',
				'order'               => 'ASC',
				'orderby'             => 'date',
				'posts_per_page'         => -1,
			);
		
			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post(); 
					//echo '<div>' . get_the_title() . '</div>';
					$creativesdfw_event_category = get_field('creativesdfw_event_category', $post->ID);
					$creativesdfw_event_date = get_field('creativesdfw_event_date', $post->ID);
					$creativesdfw_event_start_time = get_field('creativesdfw_event_start_time', $post->ID);
					$creativesdfw_event_end_time = get_field('creativesdfw_event_end_time', $post->ID);
					//var_dump($creativesdfw_event_date);
					?>

					<div class="event_element_wrap">
						<div class="event_element">
							<div class="event_date_wrap">
								<div class="event_date_month"><?php echo date("M",strtotime($creativesdfw_event_date)); ?></div>
								<div class="event_date"><?php echo date("j",strtotime($creativesdfw_event_date)); ?></div>
							</div>
							<div class="event_text_wrap">
								<span class="event_cat"><?php echo $creativesdfw_event_category->name; ?> :</span>
								<span class="event_text">
									<?php echo get_the_title(); ?>
									<div class="event_time">
										<?php echo date("F j",strtotime($creativesdfw_event_date)); ?>
										<span> @ </span>
										<?php echo date("g a",strtotime($creativesdfw_event_start_time)); ?>
										<span> - </span>
										<?php echo date("g a",strtotime($creativesdfw_event_end_time)); ?>
									</div>		
								</span>
							</div>
						</div>
					</div>


				<?php
				}
			} 

			wp_reset_postdata();		



		?>
	</div>

</div>