<?php
/**
 * The template for adding Featured Slider Options in Customizer
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
	$wp_customize -> add_section( 'flat_commerce_recent_products', array(
		'priority'			=> 500,
		'title'				=> __( 'Recent Products', 'flat-commerce' ),
	) );

	// recent product options
	$wp_customize -> add_setting( 'flat_commerce_theme_options[recent_products_option]', array(
		'capability'        => 'edit_theme_options',
		'default'           => $defaults['recent_products_option'],
		'sanitize_callback' => 'flat_commerce_sanitize_select',
	) );

	$recent_products_content_options = flat_commerce_get_recent_products_options();
	$choices = array();

	foreach ( $recent_products_content_options as $recent_products_content_option ) {

		$choices[$recent_products_content_option['value']] = $recent_products_content_option['label'];

	}

	$wp_customize -> add_control( 'flat_commerce_theme_options[recent_products_option]', array(
		'choices'   		=> $choices,
		'label'    			=> __( 'Enable Recent Products on', 'flat-commerce' ),
		'priority'			=> '1.1',
		'section'  			=> 'flat_commerce_recent_products',
		'setting'			=> 'flat_commerce_theme_options[recent_products_option]',
		'type'    			=> 'select',
	) );

	// recent product title
	$wp_customize -> add_setting( 'flat_commerce_theme_options[recent_products_title]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['recent_products_title'],
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize -> add_control( 'flat_commerce_theme_options[recent_products_title]', array(
		'active_callback'   => 'flat_commerce_is_recent_products_active',
		'label'    			=> __( 'Title', 'flat-commerce' ),
		'priority'			=> '1.2',
		'section'  			=> 'flat_commerce_recent_products',
		'setting'			=> 'flat_commerce_theme_options[recent_products_title]',
	) );


	// recent products options select
	$wp_customize -> add_setting( 'flat_commerce_theme_options[recent_products_option_select]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['recent_products_option_select'],
		'sanitize_callback' => 'sanitize_key',

	) );

	$recent_product_options = flat_commerce_get_recent_products_type_select();
	$choices 		= array();

	foreach ( $recent_product_options as $recent_product_option ) {
		$choices[ $recent_product_option['value'] ] = $recent_product_option['label'];
	}

	$wp_customize -> add_control( 'flat_commerce_theme_options[recent_products_option_select]', array(
		'active_callback' 	=> 'flat_commerce_is_recent_products_active',
		'label'    			=> __( 'Select Recent Product Type', 'flat-commerce' ),
		'priority'			=> '1.3',
		'section'  			=> 'flat_commerce_recent_products',
		'setting'			=> 'flat_commerce_theme_options[recent_products_option_select]',
		'type'    			=> 'select',
		'choices'			=> $choices
	));
// Recent Products Customizer Options End