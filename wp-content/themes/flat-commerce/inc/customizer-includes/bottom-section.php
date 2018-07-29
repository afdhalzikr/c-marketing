<?php
/**
 * The template for adding About us Content Settings in Customizer
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
    // Bottom Section Content Options
    $wp_customize->add_panel( 'flat_commerce_bottom_section_options', array(
        'capability'     => 'edit_theme_options',
        'description'    => __( 'Bottom Section', 'flat-commerce' ),
        'priority'       => 600,
        'title'          => __( 'Bottom Section Content', 'flat-commerce' ),
    ) );

    $wp_customize->add_section( 'flat_commerce_bottom_section_settings', array(
        'panel'         => 'flat_commerce_bottom_section_options',
        'priority'      => 1,
        'title'         => __( 'Bottom Section', 'flat-commerce' ),
    ) );

    $wp_customize->add_setting( 'flat_commerce_theme_options[bottom_section_enable_option]', array(
        'capability'        => 'edit_theme_options',
        'default'           => $defaults['bottom_section_enable_option'],
        'sanitize_callback' => 'flat_commerce_sanitize_select',
    ) );

    $bottom_section_enable_options = flat_commerce_bottom_section_enable_options(); //get options to enable about us section

    $choices = array();

    foreach ( $bottom_section_enable_options as $bottom_section_enable_option ) {
        $choices[ $bottom_section_enable_option['value']] = $bottom_section_enable_option['label'];
    }

    $wp_customize->add_control( 'flat_commerce_theme_options[bottom_section_enable_option]', array(
        'label'             => __( 'Enable Bottom Section on', 'flat-commerce' ),
        'priority'          => '10',
        'section'           => 'flat_commerce_bottom_section_settings',
        'settings'          => 'flat_commerce_theme_options[bottom_section_enable_option]',
        'type'              => 'select',
        'choices'           => $choices,
    ) );

    // Title
    $wp_customize->add_setting( 'flat_commerce_theme_options[bottom_section_title]', array(
        'capability'        => 'edit_theme_options',
        'default'           => $defaults['bottom_section_title'],
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'flat_commerce_theme_options[bottom_section_title]', array(
        'active_callback'   => 'flat_commerce_is_bottom_section_active',
        'label'             => __( 'Title', 'flat-commerce' ),
        'priority'          => '20',
        'section'           => 'flat_commerce_bottom_section_settings',
        'settings'          => 'flat_commerce_theme_options[bottom_section_title]',
        'type'              => 'text',
    ) );

    // Sub title
    $wp_customize->add_setting( 'flat_commerce_theme_options[bottom_section_sub_title]', array(
        'capability'        => 'edit_theme_options',
        'default'           => $defaults['bottom_section_sub_title'],
        'sanitize_callback' => 'esc_textarea',
    ) );

    $wp_customize->add_control( 'flat_commerce_theme_options[bottom_section_sub_title]', array(
        'active_callback'   => 'flat_commerce_is_bottom_section_active',
        'label'             => __( 'Sub Title', 'flat-commerce' ),
        'priority'          => '30',
        'section'           => 'flat_commerce_bottom_section_settings',
        'settings'          => 'flat_commerce_theme_options[bottom_section_sub_title]',
        'type'              => 'textarea',
    ) );

    // Background image
    $wp_customize->add_setting( 'flat_commerce_theme_options[bottom_section_bg_image]', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'flat_commerce_sanitize_image'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'flat_commerce_theme_options[bottom_section_bg_image]', array(
        'active_callback'   => 'flat_commerce_is_bottom_section_active',
        'label'             => esc_html__( 'Change section background', 'flat-commerce' ),
        'description'             => esc_html__( 'Recommended size is: 1600x1336.', 'flat-commerce' ),
        'priority'          => '75',
        'section'           => 'flat_commerce_bottom_section_settings',
        'settings'          => 'flat_commerce_theme_options[bottom_section_bg_image]',
    ) ) );
    
    //Link to url
    $wp_customize->add_setting( 'flat_commerce_theme_options[bottom_section_read_more_link_to]', array(
        'capability'        => 'edit_theme_options',
        'default'           => $defaults['bottom_section_read_more_link_to'],
        'sanitize_callback' => 'esc_url'
    ) );

    $wp_customize->add_control( 'flat_commerce_theme_options[bottom_section_read_more_link_to]', array(
        'label'             => esc_html__( 'Link To:', 'flat-commerce' ),
        'description'       => esc_html__( 'Enter the URL you want to link to', 'flat-commerce' ),
        'priority'          => '60',
        'section'           => 'flat_commerce_bottom_section_settings',
        'settings'          => 'flat_commerce_theme_options[bottom_section_read_more_link_to]',
        'type'              => 'url',
    ) );
    
    //loop for featured post content
    for ( $i=1; $i <= 3 ; $i++ ) {
        // Icon option
        $wp_customize->add_setting( 'flat_commerce_theme_options[bottom_section_social_media_icon'. $i .']', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_key',
        ) );

        $flat_commerce_get_social_icons_list = flat_commerce_get_social_icons_list();

        $choices = array();

        foreach ( $flat_commerce_get_social_icons_list as $flat_commerce_get_social_icons_list ) {
            $choices[$flat_commerce_get_social_icons_list['genericon_class']] = $flat_commerce_get_social_icons_list['label'];
        }

        $wp_customize->add_control( 'flat_commerce_theme_options[bottom_section_social_media_icon'. $i .']'. $i, array(
            'label'             => __( 'Social Media', 'flat-commerce' ) . ' ' . $i ,
            'active_callback'   => 'flat_commerce_is_bottom_section_active',
            'priority'          =>  '8' . $i,
            'section'           => 'flat_commerce_bottom_section_settings',
            'settings'          => 'flat_commerce_theme_options[bottom_section_social_media_icon'. $i .']',
            'type'              => 'select',
            'choices'           => $choices,
            'input_attrs'       => array(
                'style'             => 'width: 40px;'
                ),
            )
        );

        //icon url
        $wp_customize->add_setting( 'flat_commerce_theme_options[bottom_section_social_media_url'. $i .']', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_url',
        ) );

        $wp_customize->add_control( 'flat_commerce_theme_options[bottom_section_social_media_url'. $i .']'. $i, array(
            'label'             => __( 'URL', 'flat-commerce' ) . ' ' . $i ,
            'active_callback'   => 'flat_commerce_is_bottom_section_active',
            'priority'          =>  '8' .$i,
            'section'           => 'flat_commerce_bottom_section_settings',
            'settings'          => 'flat_commerce_theme_options[bottom_section_social_media_url'. $i .']',
            'type'              => 'url',
            )
        );
}