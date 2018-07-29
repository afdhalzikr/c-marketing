<?php
/**
 * Active callbacks for Theme Customizer Options
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */

if ( ! defined( 'FLAT_COMMERCE_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.0 403 Forbidden' );
	exit();
}


if( ! function_exists( 'flat_commerce_is_bottom_section_active' ) ) :
	/**
	* Return true if about us section  is not disabled
	* @since  Flat Commerce 0.2
	*/

	function flat_commerce_is_bottom_section_active( $control ) {
		global $wp_query;

		$page_id               = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
    	$page_on_front  = get_option('page_on_front') ;

		$enable = $control->manager->get_setting( 'flat_commerce_theme_options[bottom_section_enable_option]' )->value();
		//return true only if previwed page on customizer matches the option selected

		return  ( $enable == 'entire-site' || ( ( $page_id == $page_on_front && $page_id > 0  ) && $enable == 'homepage' ) );
	}

endif;

if( ! function_exists( 'flat_commerce_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since  Flat Commerce 0.1
	*/
	function flat_commerce_is_slider_active( $control ) {
		global $wp_query;

		$page_id        = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
    	$page_on_front  = get_option('page_on_front') ;

		$enable         = $control->manager->get_setting( 'flat_commerce_theme_options[featured_slider_option]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return ( ( ( $page_id == $page_on_front && $page_id > 0  ) && $enable == 'homepage' ) );
	}
endif;


if( ! function_exists( 'flat_commerce_is_page_slider_active' ) ) :
	/**
	* Return true if page slider is active
	*
	* @since  Flat Commerce 0.1
	*/
	function flat_commerce_is_page_slider_active( $control ) {
		global $wp_query;

		$page_id        = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
    	$page_on_front  = get_option('page_on_front') ;

		$enable         = $control->manager->get_setting( 'flat_commerce_theme_options[featured_slider_option]' )->value();

		$type           = $control->manager->get_setting( 'flat_commerce_theme_options[featured_slider_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and page slider
		return ( ( ( ( $page_id == $page_on_front && $page_id > 0  ) && $enable == 'homepage' ) ) && ( 'featured-page-slider' == $type ) );
	}
endif;


//Product Slider Active Callback Functions
if( ! function_exists( 'flat_commerce_is_product_slider_active' ) ):
	/**
	* Returns true is product slider is active
	*
	* @since Flat Commerce 0.1
	*/
	function flat_commerce_is_product_slider_active( $control ) {

		global $wp_query;

		$page_id        = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
    	$page_on_front  = get_option('page_on_front') ;

		$enable         = $control->manager->get_setting( 'flat_commerce_theme_options[product_slider_option]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return ( ( ( $page_id == $page_on_front && $page_id > 0  ) && $enable == 'homepage' ) );

	}
endif;

if( ! function_exists( 'flat_commerce_is_product_category_slider_active' ) ):
	/**
	* Returns true is product slider is active
	*
	* @since Flat Commerce 0.1
	*/
	function flat_commerce_is_product_category_slider_active( $control ) {

		global $wp_query;

		$page_id        = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
    	$page_on_front  = get_option('page_on_front') ;

		$enable         = $control->manager->get_setting( 'flat_commerce_theme_options[product_slider_option]' )->value();

		$type           = $control->manager->get_setting( 'flat_commerce_theme_options[product_slider_type_select]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and page slider
		return ( ( ( ( $page_id == $page_on_front && $page_id > 0  ) && $enable == 'homepage' ) ) && ( 'category-product-slider' == $type ) );
	}
endif;

//Recent Products Active Callback Functions
if( ! function_exists( 'flat_commerce_is_recent_products_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since  Flat Commerce 0.1
	*/
	function flat_commerce_is_recent_products_active( $control ) {
		global $wp_query;

		$page_id        = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
    	$page_on_front  = get_option('page_on_front') ;

		$enable         = $control->manager->get_setting( 'flat_commerce_theme_options[recent_products_option]' )->value();

		//return true only if previwed page on customizer matches the option selected
		return ( ( ( $page_id == $page_on_front && $page_id > 0  ) && $enable == 'homepage' ) );
	}
endif;


// google map active
if( ! function_exists( 'flat_commerce_is_google_map_enable' ) ) :
	/**
	* Return true if google map is enabled
	*
	* @since  Flat Commerce 0.1
	*/
	function flat_commerce_is_google_map_enable( $control ) {
		$banner_control = $control->manager->get_setting( 'flat_commerce_theme_options[disable_google_map]' )->value();

		return ( $banner_control == false ) ? true : false;
	}
endif;


if( ! function_exists( 'flat_commerce_is_contact_info_type_field_selected' ) ) :
	/**
	* Return true if page slider is active
	*
	* @since  Flat Commerce 0.1
	*/
	function flat_commerce_is_contact_social_type_field_selected( $control ) {
		$no_of_tabs = $control->manager->get_setting( 'flat_commerce_theme_options[additional_fields_number]' )->value();

		for( $i = 1; $i <= $no_of_tabs; $i++ ){
			$enable[] = $control->manager->get_setting( 'flat_commerce_theme_options[contact_type_of_field_1]' )->value();
		}

		if ( ( $enable == 'social' ) ) {
			return true;
		} else {
			return false;
		}
	}//return true only if previwed page on customizer matches the type of slider option selected and page slider
endif;


// topbar active
if( ! function_exists( 'flat_commerce_is_topbar_enable' ) ) :
	/**
	* Return true if topbar is enabled
	*
	* @since  Flat Commerce 1.0
	*/
	function flat_commerce_is_topbar_enable( $control ) {
		$topbar_control = $control->manager->get_setting( 'flat_commerce_theme_options[enable_topbar]' )->value();

		return ( $topbar_control == true ) ? true : false;
	}
endif;