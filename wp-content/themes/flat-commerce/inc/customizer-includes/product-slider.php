<?php
/**
 * The template for adding Product Slider Options in Customizer
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
	// add panel
	$wp_customize->add_panel( 'flat_commerce_product_slider_options', array(
	'capability'  			=> 'edit_theme_options',
	'description' 			=> __( 'Change ( Product Slider -> Select Product Slider Type ) for Custom product slider.', 'flat-commerce'),
	'title'       			=> __( 'Product Slider Options', 'flat-commerce' ),
	'priority'    			=> 400,
	) );

	// add section
	$wp_customize->add_section( 'flat_commerce_product_slider', array(
	'panel'       			=> 'flat_commerce_product_slider_options',
	'priority'    			=> 400,
	'title'       			=> __( 'Product Slider', 'flat-commerce' ),
	) );

	// product slide option
	$wp_customize->add_setting( 'flat_commerce_theme_options[product_slider_option]', array(
		'capability'        => 'edit_theme_options',
		'default'			=> $defaults['product_slider_option'],
		'sanitize_callback' => 'flat_commerce_sanitize_select',
	) );

	$product_slider_content_options = flat_commerce_get_product_slider_content_options();
	$choices = array();

	foreach ( $product_slider_content_options as $product_slider_content_option ) {

		$choices[$product_slider_content_option['value']] = $product_slider_content_option['label'];

	}

	$wp_customize->add_control( 'flat_commerce_theme_options[product_slider_option]', array(
		'label'    			=> __( 'Enable Slider on', 'flat-commerce' ),
		'priority'			=> '1.1',
		'section'  			=> 'flat_commerce_product_slider',
		'settings' 			=> 'flat_commerce_theme_options[product_slider_option]',
		'type'    			=> 'select',
		'choices'   		=> $choices,
	) );

	// product slider type
	$wp_customize->add_setting( 'flat_commerce_theme_options[product_slider_type_select]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['product_slider_type_select'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$product_slider_types_select = flat_commerce_get_product_slider_type_select();
	$choices = array();

	foreach ( $product_slider_types_select as $product_slider_type_select ) {

		$choices[$product_slider_type_select['value']] = $product_slider_type_select['label'];

	}

	$wp_customize->add_control( 'flat_commerce_theme_options[product_slider_type_select]', array(
		'active_callback'	=> 'flat_commerce_is_product_slider_active',
		'label'    			=> __( 'Select Product Slider Type', 'flat-commerce' ),
		'priority'			=> '1.2',
		'section'  			=> 'flat_commerce_product_slider',
		'settings' 			=> 'flat_commerce_theme_options[product_slider_type_select]',
		'type'    			=> 'select',
		'choices'			=> $choices,
	));

	// product category
	$wp_customize->add_setting( 'flat_commerce_theme_options[product_slider_category]', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_key',
	) );

	$wp_customize->add_control( new Flat_Commerce_Customize_WC_Dropdown_Product_Category( $wp_customize,
		'flat_commerce_theme_options[product_slider_category]', array(
		'active_callback' 	=> 'flat_commerce_is_product_category_slider_active',
		'label'    			=> __( 'Select Product Category for Tab ', 'flat-commerce' ),
		'priority'			=> '1.5.',
		'section'  			=> 'flat_commerce_product_slider',
		'settings'			=> 'flat_commerce_theme_options[product_slider_category]',
		'type'    			=> 'wc-dropdown-category',
	) ) );

	// transition delay
	$wp_customize->add_setting( 'flat_commerce_theme_options[product_slide_transition_delay]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['product_slide_transition_delay'],
		'sanitize_callback'	=> 'flat_commerce_sanitize_number_range',
		'validate_callback' => 'flat_commerce_validate_slide_transition_delay'
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[product_slide_transition_delay]' , array(
		'active_callback'	=> 'flat_commerce_is_product_category_slider_active',
		'description'		=> 	__( 'seconds(s)', 'flat-commerce' ),
    	'label'    			=> __( 'Transition Delay', 'flat-commerce' ),
		'priority'			=> '2.0',
		'section'  			=> 'flat_commerce_product_slider',
		'settings' 			=> 'flat_commerce_theme_options[product_slide_transition_delay]',
		'type'	   			=> 'number',
		'input_attrs' => array(
            'min'   		=> 1,
            'style' 		=> 'width: 60px;'
		),
	) );

	// transition length
	$wp_customize->add_setting( 'flat_commerce_theme_options[product_slide_transition_length]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['product_slide_transition_length'],
		'sanitize_callback'	=> 'flat_commerce_sanitize_number_range',
		'validate_callback' => 'flat_commerce_validate_slide_transition_length'
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[product_slide_transition_length]' , array(
		'active_callback'	=> 'flat_commerce_is_product_category_slider_active',
		'description'		=> __( 'seconds(s)', 'flat-commerce' ),
    	'label'    			=> __( 'Transition Length', 'flat-commerce' ),
		'priority'			=> '2.1',
		'section'  			=> 'flat_commerce_product_slider',
		'settings' 			=> 'flat_commerce_theme_options[product_slide_transition_length]',
		'type'	   			=> 'number',
		'input_attrs' 		=> array(
            'min'   		=> 1,
            'style' 		=> 'width: 60px;'
		),
	) );
// Product Slider End