<?php
/**
 * The main template for implementing Theme/Customzer Options
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
 * Implements flat-commerce theme options into Theme Customizer.
 *
 * @param $wp_customize Theme Customizer object
 * @return void
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport			= 'postMessage';

	/**
  	* Set priority of blogname (Site Title) to 1.
  	*  Strangly, if more than two options is added, Site title is moved below Tagline. This rectifies this issue.
  	*/
	$wp_customize->get_control( 'blogname' )->priority			= 1;

	$wp_customize->get_setting( 'blogdescription' )->transport	= 'postMessage';

	$options  = flat_commerce_get_theme_options();

	$defaults = flat_commerce_get_default_theme_options();

	//Custom Controls
	require get_template_directory() . '/inc/customizer-includes/custom-controls.php';

	$wp_customize->add_setting( 'flat_commerce_theme_options[move_title_tagline]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['move_title_tagline'],
		'sanitize_callback' => 'flat_commerce_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[move_title_tagline]', array(
		'label'    			=> __( 'Check to move Site Title and Tagline before logo', 'flat-commerce' ),
		'priority' 			=> 103,
		'section'  			=> 'title_tagline',
		'settings' 			=> 'flat_commerce_theme_options[move_title_tagline]',
		'type'     			=> 'checkbox',
	) );
	// Custom Logo End

	//topbar
	$wp_customize->add_section( 'flat_commerce_topbar_options', array(
		'title'    			=> __( 'Topbar Sections', 'flat-commerce' ),
		'priority' 			=> 40,

	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[enable_topbar]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['enable_topbar'],
		'sanitize_callback' => 'flat_commerce_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[enable_topbar]', array(
		'label'    			=> __( 'Check to enable topbar', 'flat-commerce' ),
		'priority' 			=> 103,
		'section'  			=> 'flat_commerce_topbar_options',
		'settings' 			=> 'flat_commerce_theme_options[enable_topbar]',
		'type'     			=> 'checkbox',
	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[topbar_location]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['topbar_location'],
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[topbar_location]', array(
		'label'    			=> __( 'Location', 'flat-commerce' ),
		'active_callback'	=> 'flat_commerce_is_topbar_enable',
		'priority' 			=> 103,
		'section'  			=> 'flat_commerce_topbar_options',
		'settings' 			=> 'flat_commerce_theme_options[topbar_location]',
		'type'     			=> 'text',
	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[topbar_contact]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['topbar_contact'],
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[topbar_contact]', array(
		'label'    			=> __( 'Contact', 'flat-commerce' ),
		'active_callback'	=> 'flat_commerce_is_topbar_enable',
		'priority' 			=> 103,
		'section'  			=> 'flat_commerce_topbar_options',
		'settings' 			=> 'flat_commerce_theme_options[topbar_contact]',
		'type'     			=> 'text',
	) );

	// Homepage (Static ) setting and control.
	$wp_customize->add_setting( 'flat_commerce_theme_options[enable_frontpage_content]', array(
		'sanitize_callback'   => 'flat_commerce_sanitize_checkbox',
		'default'             => $options['enable_frontpage_content'],
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[enable_frontpage_content]', array(
		'label'       	=> __( 'Enable Content', 'flat-commerce' ),
		'description' 	=> __( 'Check to enable content on static front page only.', 'flat-commerce' ),
		'section'     	=> 'static_front_page',
		'type'        	=> 'checkbox',
	) );

	// Header Options (added to Header section in Theme Customizer)
	require get_template_directory() . '/inc/customizer-includes/header-options.php';

	//Theme Options
	require get_template_directory() . '/inc/customizer-includes/theme-options.php';

	//About us Setting
	require get_template_directory() . '/inc/customizer-includes/bottom-section.php';

	//Featured Slider
	require get_template_directory() . '/inc/customizer-includes/featured-slider.php';

	//Promotional Headline
	require get_template_directory() . '/inc/customizer-includes/promotional-headline.php';

	//check if woocommerce plugin is activated
	if( class_exists( 'WooCommerce' )){

		//Featured Product Slider
		require get_template_directory() . '/inc/customizer-includes/product-slider.php';

		//Recent Products
		require get_template_directory() . '/inc/customizer-includes/recent-products.php';
	}

	// Reset all settings to default
	$wp_customize->add_section( 'flat_commerce_reset_all_settings', array(
		'description'		=> __( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'flat-commerce' ),
		'priority' 			=> 700,
		'title'    			=> __( 'Reset all settings', 'flat-commerce' ),
	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[reset_all_settings]', array(
		'capability'        => 'edit_theme_options',
		'default'           => $defaults['reset_all_settings'],
		'sanitize_callback' => 'flat_commerce_sanitize_checkbox',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[reset_all_settings]', array(
		'label'    			=> __( 'Check to reset all settings to default', 'flat-commerce' ),
		'section'  			=> 'flat_commerce_reset_all_settings',
		'settings' 			=> 'flat_commerce_theme_options[reset_all_settings]',
		'type'     			=> 'checkbox',
	) );
	// Reset all settings to default end


	//Important Links
	$wp_customize->add_section( 'important_links', array(
		'priority' 			=> 999,
		'title'   	 		=> __( 'Important Links', 'flat-commerce' ),
	) );

	/**
	 * Has dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'important_links', array(
		'sanitize_callback'	=> 'flat_commerce_sanitize_important_link',
	) );

	$wp_customize->add_control( new Flat_Commerce_Important_Links( $wp_customize, 'important_links', array(
		'label'   			=> __( 'Important Links', 'flat-commerce' ),
		'section'  			=> 'important_links',
		'settings' 			=> 'important_links',
		'type'     			=> 'important_links',
    ) ) );
    //Important Links End
}
add_action( 'customize_register', 'flat_commerce_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously for flat-commerce.
 * And flushes out all transient data on preview
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_customize_preview() {
	wp_enqueue_script( 'flat_commerce_customizer', get_template_directory_uri() . '/js/flat-commerce-customizer.min.js', array( 'customize-preview' ), '20120827', true );

	//Flush transients
	flat_commerce_flush_transients();
}
add_action( 'customize_preview_init', 'flat_commerce_customize_preview' );

//Active callbacks for customizer
require get_template_directory() . '/inc/customizer-includes/active-callbacks.php';


//Sanitize functions for customizer
require get_template_directory() . '/inc/customizer-includes/sanitize-functions.php';

//Validate functions for customizer
require get_template_directory() . '/inc/customizer-includes/validate-functions.php';

// Load customizer theme pro link
require get_template_directory() . '/inc/customizer-includes/upgrade-to-pro/class-customize.php';

/**
 * Reset all settings to default
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_reset_all_settings() {
	$options = flat_commerce_get_theme_options(); // get theme options
	if ( $options['reset_all_settings'] == 1 ) {
        // Set default values
        set_theme_mod( 'flat_commerce_theme_options', flat_commerce_get_default_theme_options() );

        // Remove background color and image
        remove_theme_mod( 'background_color' );
        remove_theme_mod( 'background_image' );
        remove_theme_mod( 'background_repeat' );
        remove_theme_mod( 'background_position_x' );
        remove_theme_mod( 'background_attachment' );
        remove_theme_mod( 'header_textcolor' );

        // Reset custom logo
        remove_theme_mod( 'custom_logo' );

        // Remove header image
        remove_theme_mod( 'header_image' );
        remove_theme_mod( 'header_image_data' );

        // Flush out all transients	on reset
        flat_commerce_flush_transients();
    }
    else {
        return '';
    }
}
add_action( 'customize_save_after', 'flat_commerce_reset_all_settings' );