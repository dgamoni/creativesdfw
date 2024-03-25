<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */


$logo = get_field('Logo', $post->ID);
$size = 'full'; 
$business_description = get_field('business_description', $post->ID);
$location = get_field('map', $post->ID);

// $pricing = get_field('pricing', $post->ID);
// $headcount = get_field('headcount', $post->ID);
// $founding_date = get_field('founding_date', $post->ID);
$info = get_field('info', $post->ID);

$awards = get_field('awards', $post->ID);

$portfolio_group = get_field('portfolio_group', $post->ID);
$porfolio_size = array( 'width' => 280, 'height' => 250 );
$profile_testimonials = get_field('profile_testimonials', $post->ID);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="container profile-container entry-header-profile">
	    <div class="row">
	    	<div class="profile-title col-md-6">
	    		<?php echo wp_get_attachment_image( $logo, $size ); ?>
				<?php the_title( '<h1 class="">', '</h1>' ); ?>
			</div>
			<div class="col-md-6">

				<nav class="nav profile-nav">
				  <div class="padded">
				    <ul>
				      <li class="active"><a id="link1" class="nav-summary" href="#summary">Summary</a></li>
				      <li><a id="link2" class="nav-focus" href="#focus">Focus</a></li>
				      <li><a id="link3" class="nav-portfolio" href="#portfolio">Portfolio</a></li>
				      <li><a id="link4" class="nav-reviews" href="#reviews">Reviews</a></li>
				      <!-- <li class="scrollTop"><a href="#"><span class="entypo-up-open"></span></a></li> -->
				    </ul>
				  </div>
				</nav>

			</div>
		</div>
	</header><!-- .entry-header -->
    
	<div class="container  profile-container  entry-content-profile">
		<div id="summary" class="section">
			<div class="row">
				<div class="col-md-6 business_description">
					<?php echo $business_description; ?>
				</div>
				<div class="col-md-2 profile-info">
					<div class="profile-info-element total"><i class="fas fa-calculator"></i><?php echo $info['total']; ?></div>
					<div class="profile-info-element pricing"><i class="far fa-clock"></i>$<?php echo $info['pricing']; ?>/hr</div>
					<div class="profile-info-element headcount"><i class="fas fa-users"></i><?php echo $info['headcount']; ?></div>
					<div class="profile-info-element founding_date"><i class="far fa-flag"></i>Founded  <?php echo $info['founding_date']; ?></div>
				</div>
				<div class="col-md-4">
					<?php //var_dump($location); ?>
					<div class="acf-map-address">
						<i class="fas fa-map-marker-alt"></i>
						<?php echo $location['address']; ?>
					</div>
					<div class="acf-map">
						<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
					</div>

				</div>				
			</div>
		</div>
		<div id="focus" class="section awards-wrap">
			<h2>Awards</h2>
			<?php 
				if( $awards ): ?>
				    <ul >
				        <?php foreach( $awards as $image ): ?>
				            <li>
				            	<?php echo wp_get_attachment_image( $image['ID'], $size ); ?>
				            </li>
				        <?php endforeach; ?>
				    </ul>
				<?php endif; ?>

		</div>
		<div id="portfolio" class="section col-md-10">
			<h2>Portfolio</h2>
			<div class="portfolio_descriptions">
				<?php echo $portfolio_group['portfolio_descriptions']; ?>
			</div>
			<div class="portfolio_wrap">
				<div class="row">
					<?php foreach ($portfolio_group['portfolio'] as $key => $portfolio) : ?>
						<?php //var_dump($portfolio['project_name']); ?>
						<?php //$thumb_url =  wp_get_attachment_url( $portfolio['project_image'] ); ?>

						<?php if($key > 5) { $more = 'p-more'; } else { $more = ''; } ?>

 			            <a href="<?php echo $portfolio['project_url']; ?>" class="lead-child-link col-md-4 <?php echo $more; ?>">
	                        <div class="leadership-content" style="background-image: url('<?php echo bfi_thumb( $portfolio['project_image'], $porfolio_size  ); ?>');">
	                            <h2 class="post-title leadership-title" >
	                                <?php echo $portfolio['project_name']; ?>
	                            </h2>
	                            <div class="leadership-description">
	                            	<p><?php echo $portfolio['project_name']; ?></p>
	                            	<?php echo $portfolio['project_description']; ?>
	                            	<!-- <div class="arrow_go">></div> -->
	                            </div>
	                        </div> 
	                    </a>
	    
	                <?php endforeach; ?>
	               
	            </div>
	             <?php if ( count($portfolio_group['portfolio']) > 5 ) { echo '<div class="show_all">Show All +</div>'; } ?>
			</div>
		</div>
		<?php $profile_testimonials = get_field('profile_testimonials_post', $post->ID); ?>
		
		<?php if ($profile_testimonials): ?>
			<div id="reviews" class="section">
			    <div class="row">
			    	<div class="reviews-title col-md-6">		
						<h2>Testimonials</h2>
						<div>It means more when others say how great you are.</div>
					</div> <!-- /reviews-title -->
					<div class="reviews-filter col-md-6">
						<div class="row">
							<div class="input-group col-md-6">
							  <div class="input-group-prepend">
							    <button class="btn btn-outline-secondary" type="button">Sort by</button>
							  </div>
							  <select class="custom-select" id="inputGroupSelect03" aria-label="">
							    <option selected>Relevance</option>
							    <option value="1">One</option>
							    <option value="2">Two</option>
							    <option value="3">Three</option>
							  </select>
							</div> <!-- /input-group -->

							<div class="input-group col-md-6">
								<input type="text" class="form-control" aria-label="Filter Reviews" placeholder="Filter Reviews">
							</div> <!-- /input-group -->
						</div> <!-- /row -->
					</div> <!-- /reviews-filter -->
					<div class="reviews-wrap col-md-12 col-lg-10">
						<?php //get_template_part( 'template-parts/part', 'testimonials' ); ?>
						<?php get_template_part( 'template-parts/part', 'testimonials-acf' ); ?>
					</div>
				</div> <!-- /row -->
			</div> <!-- /#reviews -->
		<?php endif; ?>

	</div><!-- .entry-content -->

	<?php get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->


<style type="text/css">

.acf-map {
	width: 100%;
	height: 170px;
	border: #ccc solid 1px;
	/*margin: 20px 0;*/
}

/* fixes potential theme css conflict */
.acf-map img {
   max-width: inherit !important;
}

</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCx26rqWWNoELaGl1xA4SOSKzexmqk63UE&language=en"></script>
<script type="text/javascript">
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {
	
	// var
	var $markers = $el.find('.marker');
	
	
	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};
	
	
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
	
	
	// add a markers reference
	map.markers = [];
	
	
	// add markers
	$markers.each(function(){
		
    	add_marker( $(this), map );
		
	});
	
	
	// center map
	center_map( map );
	
	
	// return
	return map;
	
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

	// ------------------------------
	// https://twitter.com/mattsince87
	// ------------------------------

	function scrollNav() {
	  $('.nav a').click(function(){  
	    //Toggle Class
	    $(".active").removeClass("active");      
	    $(this).closest('li').addClass("active");
	    var theClass = $(this).attr("class");
	    $('.'+theClass).parent('li').addClass('active');
	    //Animate
	    $('html, body').stop().animate({
	        scrollTop: $( $(this).attr('href') ).offset().top - 60
	    }, 400);
	    return false;
	  });
	  $('.scrollTop a').scrollTop();
	}
	scrollNav();

	$('.show_all').click(function (e) {
		e.preventDefault();
			var collapse_content_selector = $('.p-more');
			var toggle_switch = $(this);
			$(collapse_content_selector).toggle(function () {
	            if ($(this).css('display') == 'none') {
	                toggle_switch.html('SHOW ALL +');
	            } else {
	                toggle_switch.html('SHOW ALL -');
	            }
	        });
	});
    $('.nav-toggle').click(function (e) {
    	e.preventDefault();
        var collapse_content_selector = $(this).attr('href');
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(function () {
            if ($(this).css('display') == 'none') {
                toggle_switch.html('Read More...');
            } else {
                toggle_switch.html('Read Less');
            }
        });
    });

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

	});

});

})(jQuery);
</script>