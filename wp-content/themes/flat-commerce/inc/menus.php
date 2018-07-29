<?php
/**
 * The template for displaying custom menus
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

if ( ! function_exists( 'flat_commerce_primary_menu' ) ) :
/**
 * Shows the Primary Menu
 *
 * default load in sidebar-header-right.php
 */
function flat_commerce_primary_menu() {
    	?>
    	<div class="col col-7-of-10">
            <div class="nav-wrapper">
                <nav class="main-navigation">
                    <?php
                    if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array( 'theme_location' => 'primary' ) );
                    }
                    ?>
             </nav><!-- .main-navigation -->
         </div><!-- .nav-wrapper -->
     	</div><!-- .col -->
     	<?php
}
endif; //flat_commerce_primary_menu
add_action( 'flat_commerce_header', 'flat_commerce_primary_menu', 50 );

if ( ! function_exists( 'flat_commerce_add_page_menu_class' ) ) :
/**
 * Filters wp_page_menu to add menu class  for default page menu
 *
 */
function flat_commerce_add_page_menu_class( $ulclass ) {
  return preg_replace( '/<ul>/', '<ul class="menu page-menu-wrap">', $ulclass, 1 );
}
endif; //flat_commerce_add_page_menu_class
add_filter( 'wp_page_menu', 'flat_commerce_add_page_menu_class' );