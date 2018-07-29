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
$wp_customize->add_panel( 'flat_commerce_featured_slider', array(
	'priority'      => 200,
	'title'			=> __( 'Featured Slider', 'flat-commerce' ),
) );

$wp_customize->add_section( 'flat_commerce_featured_slider_control', array(
	'panel' 			=> 'flat_commerce_featured_slider',
	'priority'      => 10,
	'title'			=> __( 'Featured Slider Control', 'flat-commerce' ),
) );

$wp_customize->add_section( 'flat_commerce_featured_slider_type', array(
	'panel' 			=> 'flat_commerce_featured_slider',
	'priority'      => 20,
	'title'			=> __( 'Featured Slider Type', 'flat-commerce' ),
) );

$wp_customize->add_setting( 'flat_commerce_theme_options[featured_slider_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_option'],
	'sanitize_callback' => 'flat_commerce_sanitize_select',
) );

$featured_slider_content_options = flat_commerce_featured_slider_content_options();
$choices = array();

foreach ( $featured_slider_content_options as $featured_slider_content_option ) {

	$choices[$featured_slider_content_option['value']] = $featured_slider_content_option['label'];

}

$wp_customize->add_control( 'flat_commerce_theme_options[featured_slider_option]', array(
	'label'    			=> __( 'Enable Slider on', 'flat-commerce' ),
	'priority'			=> '1',
	'section'  			=> 'flat_commerce_featured_slider_control',
	'settings' 			=> 'flat_commerce_theme_options[featured_slider_option]',
	'type'    			=> 'select',
	'choices'   		=> $choices,
));

$wp_customize->add_setting( 'flat_commerce_theme_options[featured_slider_type]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_type'],
	'sanitize_callback'	=> 'sanitize_key',
) );

$featured_slider_types = flat_commerce_featured_slider_types();
$choices = array();

foreach ( $featured_slider_types as $featured_slider_type ) {
	$choices[$featured_slider_type['value']] = $featured_slider_type['label'];
}

$wp_customize->add_control( 'flat_commerce_theme_options[featured_slider_type]', array(
	'active_callback' 	=> 'flat_commerce_is_slider_active',
	'label'           	=> __( 'Select Slider Type', 'flat-commerce' ),
	'priority'        	=> '2.1.3',
	'section'         	=> 'flat_commerce_featured_slider_type',
	'settings'        	=> 'flat_commerce_theme_options[featured_slider_type]',
	'type'            	=> 'select',
	'choices'         	=> $choices,
) );

$wp_customize->add_setting( 'flat_commerce_theme_options[featured_slide_transition_delay]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slide_transition_delay'],
	'sanitize_callback'	=> 'flat_commerce_sanitize_number_range',
	'validate_callback' => 'flat_commerce_validate_slide_transition_delay',
));

$wp_customize->add_control( 'flat_commerce_theme_options[featured_slide_transition_delay]' , array(
	'active_callback'	=> 'flat_commerce_is_slider_active',
	'description'		=> __( 'seconds(s)', 'flat-commerce' ),
	'input_attrs' 		=> array(
         'min'   			=> 1,
         'style' 			=> 'width: 60px;'
	),
 	'label'    			=> __( 'Transition Delay', 'flat-commerce' ),
	'priority'			=> '2.1.4',
	'section'  			=> 'flat_commerce_featured_slider_control',
	'settings' 			=> 'flat_commerce_theme_options[featured_slide_transition_delay]',
	'type'	   			=> 'number',
));

$wp_customize->add_setting( 'flat_commerce_theme_options[featured_slide_transition_length]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slide_transition_length'],
	'sanitize_callback'	=> 'flat_commerce_sanitize_number_range',
	'validate_callback'	=> 'flat_commerce_validate_slide_transition_length'
));

$wp_customize->add_control( 'flat_commerce_theme_options[featured_slide_transition_length]' , array(
	'active_callback'	=> 'flat_commerce_is_slider_active',
		'description'	=> __( 'seconds(s)', 'flat-commerce' ),
		'input_attrs' 	=> array(
			'min'   		=> 1,
			'style' 		=> 'width: 60px;'
		),
		'label'    		=> __( 'Transition Length', 'flat-commerce' ),
		'priority'		=> '2.1.5',
		'section'  		=> 'flat_commerce_featured_slider_control',
		'settings' 		=> 'flat_commerce_theme_options[featured_slide_transition_length]',
		'type'	   		=> 'number',
));

//loop for featured post sliders
for ( $i=1; $i <=  3; $i++ ) {
	$wp_customize->add_setting( 'flat_commerce_theme_options[featured_slider_page_'. $i .']', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'flat_commerce_sanitize_page',
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[featured_slider_page_'. $i .']', array(
		'active_callback' => 'flat_commerce_is_page_slider_active',
		'label'           => __( 'Featured Page', 'flat-commerce' ) . ' # ' . $i ,
		'priority'        => '4' . $i,
		'section'         => 'flat_commerce_featured_slider_type',
		'settings'        => 'flat_commerce_theme_options[featured_slider_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}
// Featured Slider End