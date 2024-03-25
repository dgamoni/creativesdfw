<?php


add_action( 'template_redirect', 'subscription_redirect_post' );

function subscription_redirect_post() {
  $queried_post_type = get_query_var('post_type');
  if ( is_single() && 'profile' ==  $queried_post_type && !get_field('sponsor', get_the_ID()) ) {
    wp_redirect( home_url( ) );
    exit;
  }
}