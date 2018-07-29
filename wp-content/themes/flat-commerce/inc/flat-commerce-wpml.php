<?php
/**
 * This functions makes the theme compatible with WPML Plugin
 *
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 3.0
 */


if ( ! function_exists( 'flat_commerce_wpml_invalidcache' ) ) :
/**
 * Template for Clearing WPML Invalid Cache
 *
 * To override this in a child theme
 * simply create your own flat_commerce_wpml_invalidcache(), and that function will be used instead.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_wpml_invalidcache() {
	delete_transient( 'flat_commerce_featured_slider' );
	delete_transient( 'flat_commerce_footer_content' );
	delete_transient( 'flat_commerce_featured_image' );
	delete_transient( 'all_the_cool_cats' );
} // flat_commerce_wpml_invalidcache
endif;

add_action( 'after_setup_theme', 'flat_commerce_wpml_invalidcache' );
