<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_bootstrap_starter_creatives_widgets_init() {


    register_sidebar( array(
        'name'          => esc_html__( 'Top Right Search', 'wp-bootstrap-starter-sitelook' ),
        'id'            => 'top-right-search',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter-sitelook' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ) );



}
add_action( 'widgets_init', 'wp_bootstrap_starter_creatives_widgets_init' );