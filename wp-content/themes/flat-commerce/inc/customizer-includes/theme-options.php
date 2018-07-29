<?php
/**
 * The template for adding additional theme options in Customizer
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */

// Additional Color Scheme (added to Color Scheme section in Theme Customizer)
if ( ! defined( 'FLAT_COMMERCE_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

//Theme Options
	$wp_customize->add_panel( 'flat_commerce_theme_options', array(
	    'description'    => __( 'Basic theme Options', 'flat-commerce' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => 700,
	    'title'    		 => __( 'Theme Options', 'flat-commerce' ),
	) );

	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		// Custom CSS Option
		$wp_customize->add_section( 'flat_commerce_custom_css', array(
			'description'	=> __( 'Custom/Inline CSS', 'flat-commerce'),
			'panel'  		=> 'flat_commerce_theme_options',
			'priority' 		=> 203,
			'title'    		=> __( 'Custom CSS Options', 'flat-commerce' ),
		) );

		$wp_customize->add_setting( 'flat_commerce_theme_options[custom_css]', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults['custom_css'],
			'sanitize_callback' => 'flat_commerce_sanitize_custom_css',
		) );

		$wp_customize->add_control( 'flat_commerce_theme_options[custom_css]', array(
				'label'		=> __( 'Enter Custom CSS', 'flat-commerce' ),
		        'priority'	=> 1,
				'section'   => 'flat_commerce_custom_css',
		        'settings'  => 'flat_commerce_theme_options[custom_css]',
				'type'		=> 'textarea',
		) );
	}
   // Custom CSS End

	//Homepage / Static Frontpage Options
	$wp_customize->add_section( 'flat_commerce_homepage_options', array(
		'description'	=> __( 'Go to ( Settings->Reading->Blog pages show at most) to change no of blog posts visible', 'flat-commerce' ),
		'panel'			=> 'flat_commerce_theme_options',
		'priority' 		=> 209,
		'title'   	 	=> __( 'Homepage / Static Frontpage Options', 'flat-commerce' ),
	) );

	 // Blog heading
    $wp_customize->add_setting( 'flat_commerce_theme_options[latest_blog_heading]', array(
        'capability'        => 'edit_theme_options',
        'default'           => $defaults['latest_blog_heading'],
        'sanitize_callback' => 'sanitize_text_field',
    ) );


    $wp_customize->add_control( 'flat_commerce_theme_options[latest_blog_heading]' , array(
        'label'         => __( 'Heading', 'flat-commerce' ),
        'priority'      => '5',
        'section'       => 'flat_commerce_homepage_options',
        'settings'      => 'flat_commerce_theme_options[latest_blog_heading]',
        )
    );

 	//Pagination Options
 	$wp_customize->add_section( 'flat_commerce_pagination_options', array(
 		'description'	=> __( 'Archive Paginationn Options', 'flat-commerce' ),
 		'panel'			=> 'flat_commerce_theme_options',
 		'priority' 		=> 210,
 		'title'   	 	=> __( 'Pagination', 'flat-commerce' ),
 	) );

 	 // Pagination type
     $wp_customize->add_setting( 'flat_commerce_theme_options[pagination_type]', array(
         'capability'        => 'edit_theme_options',
         'default'           => $defaults['pagination_type'],
         'sanitize_callback' => 'sanitize_text_field',
     ) );


     $wp_customize->add_control( 'flat_commerce_theme_options[pagination_type]' , array(
         'label'         => __( 'Pagination Type', 'flat-commerce' ),
         'priority'      => '6',
         'section'       => 'flat_commerce_pagination_options',
         'settings'      => 'flat_commerce_theme_options[pagination_type]',
         'type'			 => 'select',
         'choices'		 => flat_commerce_pagination_type()
         )
     );

	//Homepage / Static Frontpage Settings End
	
	// Breadcrumb Option
	$wp_customize->add_section( 'flat_commerce_breadcrumb_options', array(
		'description'	=> __( 'Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance.','flat-commerce' ),
		'panel'			=> 'flat_commerce_theme_options',
		'title'    		=> __( 'Breadcrumb Options', 'flat-commerce' ),
		'priority' 		=> 220,
	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[breadcrumb_option]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['breadcrumb_option'],
		'sanitize_callback' => 'flat_commerce_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[breadcrumb_option]', array(
		'label'    => __( 'Check to enable Breadcrumb', 'flat-commerce' ),
		'section'  => 'flat_commerce_breadcrumb_options',
		'settings' => 'flat_commerce_theme_options[breadcrumb_option]',
		'type'     => 'checkbox',
	) );


	// Single Post Navigation
	$wp_customize->add_section( 'flat_commerce_single_post_navigation', array(
		'panel'  => 'flat_commerce_theme_options',
		'priority' => 221,
		'title'    => __( 'Single Post Navigation', 'flat-commerce' ),
	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[disable_single_post_navigation]', array(
		'capability'		=> 'edit_theme_options',
        'default'			=> $defaults['disable_single_post_navigation'],
		'sanitize_callback' => 'flat_commerce_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[disable_single_post_navigation]', array(
		'label'		=> __( 'Check to disable Single Post Navigation', 'flat-commerce' ),
		'section'   => 'flat_commerce_single_post_navigation',
        'settings'  => 'flat_commerce_theme_options[disable_single_post_navigation]',
		'type'		=> 'checkbox',
	) );
	// Single Post Navigation End

	// Scrollup
	$wp_customize->add_section( 'flat_commerce_scrollup', array(
		'panel'    => 'flat_commerce_theme_options',
		'priority' => 215,
		'title'    => __( 'Scrollup Options', 'flat-commerce' ),
	) );

	$wp_customize->add_setting( 'flat_commerce_theme_options[disable_scrollup]', array(
		'capability'		=> 'edit_theme_options',
        'default'			=> $defaults['disable_scrollup'],
		'sanitize_callback' => 'flat_commerce_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'flat_commerce_theme_options[disable_scrollup]', array(
		'label'		=> __( 'Check to disable Scroll Up', 'flat-commerce' ),
		'section'   => 'flat_commerce_scrollup',
        'settings'  => 'flat_commerce_theme_options[disable_scrollup]',
		'type'		=> 'checkbox',
	) );
	// Scrollup End
	
//Theme Option End