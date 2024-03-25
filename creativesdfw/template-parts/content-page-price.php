<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">
		<?php the_title( '<h1 class="container entry-title fonticon">', '</h1>' ); ?>
	</header><!-- .entry-header -->
    
	<div class="entry-content">
		<div class="container">
			<?php the_content(); ?>
		</div>
	</div><!-- .entry-content -->

	<section class="pricing ">
  		<div class="container">

			<ul class="nav nav-tabs" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" href="#agencies" role="tab" data-toggle="tab">Agencies</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#individuals" role="tab" data-toggle="tab">Individuals</a>
			  </li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			  
			  <div role="tabpanel" class="tab-pane active" id="agencies">
	    		<div class="row">
					<?php get_template_part( 'template-parts/part', 'price' ); ?>
		    	</div>			  	
			  </div>
			  
			  <div role="tabpanel" class="tab-pane fade" id="individuals">
	    		<div class="row">
					<?php get_template_part( 'template-parts/part', 'price-individuals' ); ?>
		    	</div>			  	
			  </div>
			</div>


<!--     		<div class="row">
				<?php get_template_part( 'template-parts/part', 'price' ); ?>
	    	</div> -->
	  	</div>
	</section>

	<?php get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->
