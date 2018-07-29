<?php
/**
 * The template for adding Additional Header Option in Customizer
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

	// Header Options
	$wp_customize->add_setting( 'flat_commerce_theme_options[enable_featured_header_image]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['enable_featured_header_image'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$flat_commerce_enable_featured_header_image_options = flat_commerce_enable_featured_header_image_options();
	$choices = array();
	foreach ( $flat_commerce_enable_featured_header_image_options as $flat_commerce_enable_featured_header_image_option ) {
		$choices[$flat_commerce_enable_featured_header_image_option['value']] = $flat_commerce_enable_featured_header_image_option['label'];
	}

	$wp_customize->add_control( 'flat_commerce_theme_options[enable_featured_header_image]', array(
		'label'				=> __( 'Enable Featured Header Image on ', 'flat-commerce' ),
		'section'   		=> 'header_image',
        'settings'  		=> 'flat_commerce_theme_options[enable_featured_header_image]',
        'type'	  			=> 'select',
		'choices'  			=> $choices,
	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[featured_header_image_alt]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_alt'],
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[featured_header_image_alt]', array(
		'label'				=> __( 'Featured Header Image Alt/Title Tag ', 'flat-commerce' ),
		'section'   		=> 'header_image',
        'settings'  		=> 'flat_commerce_theme_options[featured_header_image_alt]',
        'type'	  			=> 'text',
	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[featured_header_image_url]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_url'],
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[featured_header_image_url]', array(
		'label'				=> __( 'Featured Header Image Link URL', 'flat-commerce' ),
		'section'   		=> 'header_image',
        'settings'  		=> 'flat_commerce_theme_options[featured_header_image_url]',
        'type'	  			=> 'text',
	) );
// Header Options End