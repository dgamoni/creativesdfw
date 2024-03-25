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
		
			<?php if ( have_rows( 'creatives_home_partners' ) ) : ?>
	<?php while ( have_rows( 'creatives_home_partners' ) ) : the_row(); ?>
		<?php $creatives_home_partners_logo = get_sub_field( 'creatives_home_partners_logo' ); ?>
		<?php if ( $creatives_home_partners_logo ) { ?>
			<img src="<?php echo $creatives_home_partners_logo['url']; ?>" alt="<?php echo $creatives_home_partners_logo['alt']; ?>" />
		<?php } ?>
		<?php the_sub_field( 'link_to_partner_website' ); ?>
	<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
		</div>
	</div><!-- .entry-content -->

	<?php get_template_part( 'template-parts/home', 'profile' ); ?>

</article><!-- #post-## -->
