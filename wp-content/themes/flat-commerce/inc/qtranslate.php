<?php
/**
 * This functions makes the theme compatible with qTranslate Plugin
 *
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */

if ( ! function_exists( 'flat_commerce_menuitem' ) ) :
/**
 * Template for Converting Home link in Custom Menu
 *
 * To override this in a child theme
 * simply create your own flat_commerce_menuitem(), and that function will be used instead.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_menuitem( $menu_item ) {
	// convert local URLs in custom menu items
	if ( $menu_item->type == 'custom' && stripos($menu_item->url, get_site_url()) !== false) {
		$menu_item->url = qtrans_convertURL($menu_item->url);
	}
		return $menu_item;
} // flat_commerce_menuitem
endif;

add_filter( 'wp_setup_nav_menu_item' , 'flat_commerce_menuitem', 0 );


if ( ! function_exists( 'flat_commerce_qtranslate_invalidcache' ) ) :
/**
 * Template for Clearing qtranslate Invalid Cache
 *
 * To override this in a child theme
 * simply create your own flat_commerce_qtranslate_invalidcache(), and that function will be used instead.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_qtranslate_invalidcache() {
	delete_transient( 'flat_commerce_featured_slider' );
	delete_transient( 'flat_commerce_footer_content' );
	delete_transient( 'flat_commerce_featured_image' );
	delete_transient( 'all_the_cool_cats' );
} // flat_commerce_qtranslate_invalidcache
endif;

add_action( 'after_setup_theme', 'flat_commerce_qtranslate_invalidcache' );
