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

<?php 

	$creativesdfw_event_category = get_field('creativesdfw_event_category', $post->ID);
	$creativesdfw_event_date = get_field('creativesdfw_event_date', $post->ID);
	$creativesdfw_event_start_time = get_field('creativesdfw_event_start_time', $post->ID);
	$creativesdfw_event_end_time = get_field('creativesdfw_event_end_time', $post->ID);

?>
    <header class="entry-header">
		<?php the_title( '<h1 class="container entry-title fonticon">', '</h1>' ); ?>
							
			<div class="event_text_wrap">
				<span class="event_cat"><?php echo $creativesdfw_event_category->name; ?> </span>
				<span class="event_text">
					<?php //echo get_the_title(); ?>
					<div class="event_time">
						<?php echo date("F j",strtotime($creativesdfw_event_date)); ?>
						<span> @ </span>
						<?php echo date("g a",strtotime($creativesdfw_event_start_time)); ?>
						<span> - </span>
						<?php echo date("g a",strtotime($creativesdfw_event_end_time)); ?>
					</div>		
				</span>
			</div>

	</header><!-- .entry-header -->
    
	<div class="entry-content">
		<div class="container">
			<?php the_content(); ?>
		</div>
	</div><!-- .entry-content -->

	<?php //get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->
