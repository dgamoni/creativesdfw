<?php 
$user = wp_get_current_user();
$info = check_status_plan($user->user_email);
var_dump($info);
//var_dump($user);
$date = date_create($user->user_registered);

 ?>

<div class="edit_profile_wrap">
    
    <div class="row">
  		<div class="col-sm-8">
  			<span class="loop-profile-title"><span class="lwa-title-sub" ><?php echo __( 'Hi', 'login-with-ajax' ) . " " . $user->display_name;  ?></span></span>
  		</div>
    	<div class="col-sm-4">
    		<!-- <a class="front_log_out btn btn-outline-success btn-acf pull-right" id="wp-logout" href="<?php echo wp_logout_url( home_url() ); ?>"><?php esc_html_e( 'Log Out' ,'login-with-ajax') ?></a> --> 
		</div>
    </div>
    <div class="row">
  		<div class="col-lg-3">
              
			<ul class="list-group user_info_left">
				<li class="list-group-item text-muted">Account details</li>
				<li class="list-group-item text-right"><span class="float-left"><strong>Login</strong></span><?php echo $user->user_login;?></li>
				<!-- <li class="list-group-item text-right"><span class="float-left"><strong>Nickname</strong></span><?php echo $user->user_nicename;?></li> -->
				<li class="list-group-item text-right"><span class="float-left"><strong>Email</strong></span><?php echo $user->user_email;?></li>
				<li class="list-group-item text-right"><span class="float-left"><strong>Subscription type</strong></span><span class="current_type"><?php echo $info['type']; ?></span></li>
				<li class="list-group-item text-right"><span class="float-left"><strong>Subscription plan</strong></span><span class="current_plan"><?php echo $info['plan']; ?></span></li>
				<!-- <li class="list-group-item text-right"><span class="float-left"><strong>Expiry date</strong></span><?php echo date_format($date, 'Y-m-d'); ?></li> -->

				<!-- <li class="list-group-item text-right"><span class="float-left"><strong>Date</strong></span><?php echo date_format($date, 'Y-m-d'); ?></li> -->
				<li class="list-group-item text-right">
					<span class="float-left">
						<a class="front_log_out btn-acf pull-right" id="wp-logout" href="<?php echo wp_logout_url( home_url() ); ?>"><?php esc_html_e( 'Log Out' ,'login-with-ajax') ?></a>
					</span>
				</li>
			</ul> 
            
        </div><!--/col-3-->

    	<div class="col-lg-9">


			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" href="#subscriptions"  data-toggle="tab"  role="tab" aria-controls="subscriptions" aria-selected="true">Subscriptions</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#profiles_list" data-toggle="tab" role="tab" aria-controls="profiles_list" aria-selected="false">Profiles list</a>
				</li>
<!-- 				<li class="nav-item">
					<a class="nav-link" href="#edit_accaunt" data-toggle="tab" role="tab" aria-controls="edit_accaunt" aria-selected="false">Edit Account</a>
				</li> -->
			</ul>
              
            <div class="tab-content">

          		<!-- Subscriptions  --> 
	            <div class="tab-pane active" id="subscriptions">
	              <div class="table-responsive">
		                <table class="table table-hover">
		                  <thead>
		                    <tr>
		                      <th>Subscriptions type</th>
		                      <th>Subscriptions plan</th>
		                      <th>Start Date</th>
		                      <th>Expiry date</th>
		                      <th>Modification</th>
		                    </tr>
		                  </thead>
		                  <tbody id="items">
		                    
		                    <?php 
		                    	//var_dump(get_userplan_by_email($user->user_email));

		                    	foreach ( get_userplan_by_email($user->user_email) as $key => $entries ) {
		                    		//var_dump($entries['id']);
		                    		//var_dump($entries[9]);
		                    		$sub_plan1 = explode('|', $entries[9]);
		                    		$sub_plan2 = explode('|', $entries[4]);
		                    		if($entries[9]) {
		                    			$sub_plan = $sub_plan1[0];
		                    		} else {
		                    			$sub_plan = $sub_plan2[0];
		                    		}
		                    		if(!$entries[8]) {
		                    			$level = 'agencies';
		                    		} else {
		                    			$level = $entries[8];
		                    		}
		                    		$expiryDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($entries['date_created'])) . " + 1 year"));
		                    		//var_dump( get_diff_interval( $entries['date_created'] ) );
		                    		//if ( $key == 1 && get_diff_interval( '2018-02-05' ) > 365 ) {
		                    		if ( get_diff_interval( $entries['date_created'] ) > 365 ) {
		                    			$expiry_class = 'expired';
		                    		} else {
		                    			$expiry_class = '';
		                    		}

		                    		echo '<tr class="'.$user->ID.'-'.$level.'-'.$sub_plan.'-'.$entries['id'].' '.$expiry_class.'">';
			                    		echo '<th>'.$level.'</th>';
			                    		echo '<th>'.$sub_plan.'</th>';
			                    		echo '<th>'.date_format(date_create($entries['date_created']), 'Y-m-d').'</th>';
			                    		echo '<th>'.$expiryDate.'</th>';
			                    		echo '<th class="make_primary"><a class="set_primary" href="#" data-gf_entries="'.$entries['id'].'" data-userid="'.$user->ID.'" data-level="'.$level.'" data-plan="'.$sub_plan.'">make primary</a><span class="active_primary">primary</span><a href="'.home_url('/sign-up/').'?type='.$level.'&plan='.$sub_plan.'" target="_blank" class="expired_info">upgrate</a></th>';
			                    	echo '</tr>';
		                    	}
		                    	if ( !get_userplan_by_email($user->user_email) ) {
		                    		echo '<tr>';
			                    		echo '<th></th>';
			                    		echo '<th>Free</th>';
			                    		echo '<th></th>';
			                    		echo '<th></th>';
			                    		echo '<th><a href="'.home_url('/listing-prices/').'">upgrade</a></th>';		                    		
		                    		echo '</tr>';
		                    	}
		                    ?>

		                  </tbody>
		                </table>	              
	              </div>
	            </div><!--/tab-pane-->

				<!-- profiles_list  -->            
	            <div class="tab-pane" id="profiles_list">

	                <div class="table-responsive">
		                <table class="table table-hover">
		                  <thead>
		                    <tr>
		                      <th>Title</th>
		                      <!-- <th>Created</th> -->
		                      <th>Status</th>
		                      <th>Categories</th>
		                      <th>Sponsor</th>
		                      <th>Premium</th>
		                    </tr>
		                  </thead>
		                  <tbody id="items">
							<?php
								$args = array(
									'author'      => $user->ID,
									'post_type'   => 'profile',
									'post_status' => 'any',
								);
								$query2 = new WP_Query( $args );
							
								if ( $query2->have_posts() ) {
									
									while( $query2->have_posts() ) {
										$query2->the_post();
										//var_dump($post);

										$tax = get_the_taxonomies($post->ID);
										//var_dump($tax);

										echo '<tr>';
											echo '<th>' . $post->post_title . '</th>';
											//echo '<th>' . get_the_date( 'Y-m-d', $post->ID ) . '</th>';
											echo '<th>' . $post->post_status . '</th>';
											echo '<th class="taxx">'; 
												foreach ($tax as $key => $tax_) {
													echo '<span>'.$tax_.' </span>';
												}
											echo '</th>';

											echo '<th>';
												if( get_field('sponsor',  $post->ID) ){
													echo 'yes';
												}
											echo '</th>';
											echo '<th>';
												if ( get_field('premium_sponsor',  $post->ID) ){
													echo 'yes';
												}
											echo '</th>';
										echo '</tr>';
									}
									wp_reset_postdata();
								} else {
									//echo '<tr><th>';
										//echo 'You do not have.';
										//echo '<a href="/listing-prices/" class=""><span>Get Listed</span></a>';
								 	//echo '</tr></th>';
								}

							?>
		                  </tbody>
		                </table>
		            </div>	              
   
	            </div><!--/tab-pane-->


				<!-- Edit Account  -->            
	         	<div class="tab-pane" id="edit_accaunt">
	         		<?php  ?>
	            </div>
               
            
            </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
</div>

<script>
	jQuery(document).ready(function($) {
		$('.<?php echo $user->ID.'-'.$info["type"].'-'.$info["plan"].'-'.$info["entryid"]; ?>').addClass('primary_col');
		$('.<?php echo $user->ID.'-'.$info["type"].'-'.$info["plan"].'-'.$info["entryid"]; ?> .make_primary .set_primary').hide();
		$('.<?php echo $user->ID.'-'.$info["type"].'-'.$info["plan"].'-'.$info["entryid"]; ?> .make_primary .active_primary').show();
	});
</script>