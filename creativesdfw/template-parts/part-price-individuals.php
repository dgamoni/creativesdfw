<?php

// check if the flexible content field has rows of data
if( have_rows('price') ):


	$i = 0;
	    
	    while ( have_rows('pricing_individuals') ) : the_row();
	    	$i++;
	        $price_name = get_sub_field('pricing_name');
	        $price_for_year = get_sub_field('pricing_for_a_year');
	        $price_for_month = get_sub_field('pricing_per_month');
	        $perks_listing_mains = get_sub_field('individual_perks_listing');
	        //var_dump($perks_listing_main);
	        ?>

	        <div class="col-lg-3 color-<?php echo $i;?>">
		        <div class="pricecard mb-5 mb-lg-0">
		          <div class="pricecard-body">
	        	
			        	<div class="price-header">
			        		<h5 class="price_name card-title text-uppercase text-center"><?php echo $price_name; ?></span>
			        	</div>
			        	<div class="price-header-border"></div>

			        	<?php if($price_for_year && $price_for_month): ?>
				        	<div class="price-money">
				        		<h6 class="price_for_year card-price text-center">$<?php echo $price_for_year; ?><span class="period">/yr</span></h6>
				        		<h6 class="price_for_month card-price text-center"><span class="price_for_month_value">$<?php echo $price_for_month; ?></span><span class="period">/mo</span></h6>
					        </div>
				        <?php endif; ?>

				        <div class="perks_listing_main">
					        <ul class="fa-ul">
					        	<?php foreach ($perks_listing_mains as $key => $perks_listing_main):
					        		//var_dump($perks_listing_main['perks_listing_sub']); ?>
					        		
					        		<div class="perks_listing_element ">
					        			
					        			<li>
						        			<?php if( $perks_listing_main['individual_perks_listing']['individual_css_icon']):?>
						        				<span class="fa-li"><i class="fas  <?php echo $perks_listing_main['individual_perks_listing']['individual_css_icon']; ?> "></i></span>
						        			<?php endif; ?>
						        			<?php echo $perks_listing_main['individual_perks_listing']['individual_perk']; ?>
					        			</li>

									</div>

					        	<?php endforeach; ?>
					        </ul>	
				        </div>

				        <div class="sign-up-now">
				        	<a href="<?php if($price_name == 'free listing'){ echo home_url('/add-profile/'); } else { echo home_url('/sign-up/'); } ?>" class="btn btn-block btn-primary ">
				 				<span>Sign up now</span>
				 			</a>
				        </div>



				    </div>
				</div>        
	        </div>

	    <?php
	    endwhile; 


endif; 


