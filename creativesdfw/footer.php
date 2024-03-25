<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- #content -->
    
	<footer id="colophon" class="site-footer navbar-dark bg-primary" role="contentinfo">
	                


		<div class="container">

	        <?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
	            <a href="<?php echo esc_url( home_url( '/' )); ?>">
	                <img src="<?php echo esc_attr(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	            </a>
	        <?php else : ?>
	            <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
	        <?php endif; ?>

			<?php get_template_part( 'footer-widget' ); ?>
			
		</div>
	</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>