<?php

global $post;

$creatives_home_partners = get_field('creatives_home_partners', $post->ID);
//var_dump($creatives_home_next); 


?>

<div class="home-block creatives_home_partners">
	<div class="container home_partners_wrap">
	<?php if ( have_rows( 'creatives_home_partners' ) ) : ?>
	<?php while ( have_rows( 'creatives_home_partners' ) ) : the_row(); ?>
		<?php $creatives_home_partners_logo = get_sub_field( 'creatives_home_partners_logo' ); ?>
		<?php if ( $creatives_home_partners_logo ) { ?>
			<a href="<?php the_sub_field( 'link_to_partner_website' ); ?>" target="_blank"><img src="<?php echo $creatives_home_partners_logo['url']; ?>" alt="<?php echo $creatives_home_partners_logo['alt']; ?>" /></a>
		<?php } ?>
		
	<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
	</div>

</div>