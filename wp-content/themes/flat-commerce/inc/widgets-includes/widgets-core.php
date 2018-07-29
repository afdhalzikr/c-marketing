<?php
/**
 * The template for adding Custom Sidebars and Widgets
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */

if ( ! defined( 'FLAT_COMMERCE_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}
/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_widgets_init() {
	//Primary Sidebar
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'flat-commerce' ),
		'id'            => 'primary-sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div><!-- .widget-wrap --></section><!-- #widget-default-search -->',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		'description'	=> __( 'This is the primary sidebar if you are using a two column site layout option.', 'flat-commerce' ),
	) );

	if ( class_exists( 'WooCommerce' ) ) {
		//Optional Primary Sidebar for Shop
		register_sidebar( array(
			'name' 				=> __( 'WooCommerce Primary Sidebar', 'flat-commerce' ),
			'id' 				=> 'sidebar-optional-woocommmerce',
			'description'		=> __( 'This is Optional Primary Sidebar for WooCommerce', 'flat-commerce' ),
			'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 		=> "</aside>",
			'before_title' 		=> '<h3 class="widget-title">',
			'after_title' 		=> '</h3>'
		) );
	}

	$footer_sidebar_number = 4; //Number of footer sidebars

	for( $i=1; $i <= $footer_sidebar_number; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( __( 'Footer Area %d', 'flat-commerce' ), $i ),
			'id'            => sprintf( 'footer-%d', $i ),
			'before_widget' => '<aside class="widget"><div class="widget-wrap">',
			'after_widget'  => '</div><!-- .widget-wrap --></aside><!-- #widget-default-search -->',
			'before_title'  => '<div class="entry-header"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
			'description'	=> sprintf( __( 'Footer %d widget area.', 'flat-commerce' ), $i ),
		) );
	}

}
add_action( 'widgets_init', 'flat_commerce_widgets_init' );

/**
* Load Featured Post Widget
*/
require get_template_directory() . '/inc/widgets-includes/featured-post-widget.php';

/**
 * Register Widgets
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_register_widgets() {
	register_widget( 'Flatcommerce_featured_post_widget' );
}
add_action( 'widgets_init', 'flat_commerce_register_widgets' );