<?php
/**
 * Functions and definitions
 *
 * Sets up the theme using core flat-commerce-core and provides some helper functions using flat-commerce-custon-functions.
 * Others are attached to action and
 * filter hooks in WordPress to change core functionality
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */

//define theme version
if ( !defined( 'FLAT_COMMERCE_THEME_VERSION' ) ) {
    $theme_data = wp_get_theme();

    define ( 'FLAT_COMMERCE_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Implement the core functions
 */
require get_template_directory() . '/inc/core.php';