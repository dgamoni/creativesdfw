<?php 
global $post;

$profile_testimonials = get_field('profile_testimonials_post', $post->ID);
//var_dump($profile_testimonials);
?>

<div class="container profile_testimonials_post_wrap">
	
		<?php foreach ($profile_testimonials as $key => $profile_testimonial) {
			// $project = get_sub_field('project', $profile_testimonial);
			// var_dump($project);
			// $project_testimonial = get_sub_field('project_testimonial', $profile_testimonial);
			// $project_feedback = get_sub_field('project_feedback', $profile_testimonial);
			// $the_client = get_sub_field('the_client', $profile_testimonial);

			//var_dump($project); ?>
		<div class="row masonry-grid project-reviews _card-columns">
			
			<div class="col-md-6 col-lg-3 masonry-column project-column _card">
				<h5>The Project</h5>
				<div class="project_name"><?php echo $profile_testimonial['project']['project_name']; ?></div>
				<div class="project_services_wrap">
					<div class="project_services">
					<i class="fas fa-images"></i>
						<?php foreach ( $profile_testimonial['project']['project_services'] as $key => $project_services) { ?>
							<span><?php echo $project_services; ?></span>
						<?php } ?>
					</div>
					<?php 
						$budget_arr = explode(' ',$profile_testimonial['project']['project_budget']);
						//var_dump($budget_arr[0]);
						$budget = preg_replace("/[^0-9,]/", "",  $budget_arr[0]); 
						//var_dump($budget);
					?>					
					<div class="project_budget" data-val="<?php echo $budget; ?>">
						<i class="fas fa-tag"></i>
						<?php echo  $profile_testimonial['project']['project_budget']; ?>
					</div>
					<?php 
						$present = preg_replace("/[^0-9,]/", "",  $profile_testimonial['project']['project_present']);
						//var_dump($present);
					?>
					<div class="project_present" data-val="<?php echo $present; ?>">
						<i class="fas fa-calendar-alt"></i>
						<?php echo  $profile_testimonial['project']['project_present']; ?>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-lg-6 masonry-column project_testimonial-column _card">
				<h5>Testimonial</h5>
				<div class="project_testimonial"><?php echo $profile_testimonial['project_testimonial']; ?></div>

			</div>


			<div class="col-md-6 col-lg-3 masonry-column the_client_co-column _card">
				<h5>The Client</h5>
				<div class="the_client_co"><?php echo $profile_testimonial['the_client']['the_client_co']; ?></div>
				<div class="the_client_name"><?php echo $profile_testimonial['the_client']['the_client_name']; ?></div>

			</div>	


			<div class="col-md-6 col-lg-3 masonry-column project_summary-column _card">
				<h6>Project Summary:</h6>
				<div class=""><?php echo $profile_testimonial['project']['project_summary']; ?></div>

			</div>



			<div class="col-md-6 col-lg-6 masonry-column project_feedback-column _card">
				<h6>Feedback:</h6>
				<div class=""><?php echo $profile_testimonial['project_feedback']; ?></div>

			</div>
									
			<div class="col-md-6 col-lg-3 masonry-column the_client-column _card">

				<div class="the_client_services">
					<i class="far fa-building"></i>
					<?php echo $profile_testimonial['the_client']['the_client_services']; ?>
				</div>
				<div class="the_client_employees">
					<i class="fas fa-users"></i>
					<?php echo $profile_testimonial['the_client']['the_client_employees']; ?>
					<span> Employees</span>
				</div>
				<div class="the_client_address">
					<i class="fas fa-map-marker-alt"></i>
					<?php echo $profile_testimonial['the_client']['the_client_address']; ?>
				</div>

			</div>

		</div>	
		<?php } ?>
	</div>
</div>

<script>
	jQuery(document).ready(function($){
		


	});
</script>


