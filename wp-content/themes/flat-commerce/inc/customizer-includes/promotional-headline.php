<?php
	//Promotion Headline Options
    $wp_customize->add_section( 'flat_commerce_promotion_headline_options', array(
		'description'	=> __( 'To disable the fields, simply leave them empty.', 'flat-commerce' ),
		'priority' 		=> 300,
		'title'   	 	=> __( 'Promotion Headline', 'flat-commerce' ),
	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[promotion_headline_option]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['promotion_headline_option'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$flat_commerce_featured_slider_content_options = flat_commerce_featured_slider_content_options();
	$choices = array();
	foreach ( $flat_commerce_featured_slider_content_options as $flat_commerce_featured_slider_content_option ) {
		$choices[$flat_commerce_featured_slider_content_option['value']] = $flat_commerce_featured_slider_content_option['label'];
	}

	$wp_customize->add_control( 'flat_commerce_theme_options[promotion_headline_option]', array(
		'choices'  	=> $choices,
		'label'    	=> __( 'Enable Promotion Headline on', 'flat-commerce' ),
		'priority'	=> '0.5',
		'section'  	=> 'flat_commerce_promotion_headline_options',
		'settings' 	=> 'flat_commerce_theme_options[promotion_headline_option]',
		'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[promotion_headline]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['promotion_headline'],
		'sanitize_callback'	=> 'wp_kses_post'
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[promotion_headline]', array(
		'description'	=> __( 'Appropriate Words: 10', 'flat-commerce' ),
		'label'    	=> __( 'Promotion Headline Text', 'flat-commerce' ),
		'priority'	=> '1',
		'section' 	=> 'flat_commerce_promotion_headline_options',
		'settings'	=> 'flat_commerce_theme_options[promotion_headline]',
	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[promotion_subheadline]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['promotion_subheadline'],
		'sanitize_callback'	=> 'wp_kses_post'
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[promotion_subheadline]', array(
		'description'	=> __( 'Appropriate Words: 3', 'flat-commerce' ),
		'label'    	=> __( 'Promotion Subheadline Text', 'flat-commerce' ),
		'priority'	=> '2',
		'section' 	=> 'flat_commerce_promotion_headline_options',
		'settings'	=> 'flat_commerce_theme_options[promotion_subheadline]',
	) );