<?php
/**
 * Tabs test file
 *
 * @package Blaize Companion
 * @since 1.1.43
 */

/**
 * Hook controls for Header to Customizer.
 *
 * @since 1.1.40
 */
function blaize_tabs_customize_register( $wp_customize ) {

	if ( class_exists( 'Blaize_Companion_Customize_Control_Tabs' ) ) {
		
        /**
        * Service section Tabs
        *
        */
        $wp_customize->add_setting( 'blaize_service_tabs', array( 'sanitize_callback' => 'sanitize_text_field', ));
        $wp_customize->add_control( new Blaize_Companion_Customize_Control_Tabs( $wp_customize, 'blaize_service_tabs', array(
            'section' => 'blaize_service_section',
            'tabs'    => array(
                'general' => array(
                    'nicename' => esc_html__( 'General', 'blaize-companion' ),
                    'icon'     => 'cogs',
                    'controls' => array(
                        'blaize_enable_service_section',
                        'blaize_service_title',
                        'blaize_service_desc_text',
                        'blaize_service',
                    ),
                ),

                'design' => array(
                    'nicename' => esc_html__( 'Background', 'blaize-companion' ),
                    'icon'     => 'adjust',
                    'controls' => array(
                        'blaize_service_bg_color',
                        'blaize_service_bg_img',
                        'blaize_service_bg_position',
                        'blaize_service_bg_repeat',
                        'blaize_service_bg_size',
                        'blaize_service_bg_attachment',
                    ),
                ),
            ),
        ) ) );

        /**
        * About section Tabs
        *
        */
        $wp_customize->add_setting( 'blaize_about_tabs', array( 'sanitize_callback' => 'sanitize_text_field', ));
        $wp_customize->add_control( new Blaize_Companion_Customize_Control_Tabs( $wp_customize, 'blaize_about_tabs', array(
            'section' => 'blaize_about_section',
            'tabs'    => array(
                'general' => array(
                    'nicename' => esc_html__( 'General', 'blaize-companion' ),
                    'icon'     => 'cogs',
                    'controls' => array(
                        'blaize_enable_about_section',
                        'blaize_about_layout',
                        'blaize_about_title',
                        'blaize_about_desc_text',
                        'blaize_about_page',
                        'blaize_about_readmore_text',
                        'blaize_about_readmore_link',
                    ),
                ),

                'design' => array(
                    'nicename' => esc_html__( 'Background', 'blaize-companion' ),
                    'icon'     => 'adjust',
                    'controls' => array(
                        'blaize_about_bg_color',
                        'blaize_about_bg_img',
                        'blaize_about_bg_position',
                        'blaize_about_bg_repeat',
                        'blaize_about_bg_size',
                        'blaize_about_bg_attachment',
                    ),
                ),
            ),
        ) ) );

        /**
        * Counter section Tabs
        *
        */
        $wp_customize->add_setting( 'blaize_counter_tabs', array( 'sanitize_callback' => 'sanitize_text_field', ));
        $wp_customize->add_control( new Blaize_Companion_Customize_Control_Tabs( $wp_customize, 'blaize_counter_tabs', array(
            'section' => 'blaize_counter_section',
            'tabs'    => array(
                'general' => array(
                    'nicename' => esc_html__( 'General', 'blaize-companion' ),
                    'icon'     => 'cogs',
                    'controls' => array(
                        'blaize_enable_counter_section',
                        'blaize_counter_heading1',
                        'blaize_counter_icon1',
                        'blaize_counter1',
                        'blaize_counter_title1',
                        'blaize_counter_heading2',
                        'blaize_counter_icon2',
                        'blaize_counter2',
                        'blaize_counter_title2',
                        'blaize_counter_heading3',
                        'blaize_counter_icon3',
                        'blaize_counter3',
                        'blaize_counter_title3',
                        'blaize_counter_heading4',
                        'blaize_counter_icon4',
                        'blaize_counter4',
                        'blaize_counter_title4',
                    ),
                ),

                'design' => array(
                    'nicename' => esc_html__( 'Background', 'blaize-companion' ),
                    'icon'     => 'adjust',
                    'controls' => array(
                        'blaize_counter_bg_color',
                        'blaize_counter_bg_img',
                        'blaize_counter_bg_position',
                        'blaize_counter_bg_repeat',
                        'blaize_counter_bg_size',
                        'blaize_counter_bg_attachment',
                    ),
                ),
            ),
        ) ) );

        /**
        * Portfolio section Tabs
        *
        */
        $wp_customize->add_setting( 'blaize_portfolio_tabs', array( 'sanitize_callback' => 'sanitize_text_field', ));
        $wp_customize->add_control( new Blaize_Companion_Customize_Control_Tabs( $wp_customize, 'blaize_portfolio_tabs', array(
            'section' => 'blaize_portfolio_section',
            'tabs'    => array(
                'general' => array(
                    'nicename' => esc_html__( 'General', 'blaize-companion' ),
                    'icon'     => 'cogs',
                    'controls' => array(
                        'blaize_enable_portfolio_section',
                        'blaize_portfolio_title',
                        'blaize_portfolio_desc_text',
                        'blaize_portfolio_category',
                    ),
                ),

                'design' => array(
                    'nicename' => esc_html__( 'Background', 'blaize-companion' ),
                    'icon'     => 'adjust',
                    'controls' => array(
                        'blaize_portfolio_bg_color',
                        'blaize_portfolio_bg_img',
                        'blaize_portfolio_bg_position',
                        'blaize_portfolio_bg_repeat',
                        'blaize_portfolio_bg_size',
                        'blaize_portfolio_bg_attachment',
                    ),
                ),
            ),
        ) ) );

        /**
        * Team section Tabs
        *
        */
        $wp_customize->add_setting( 'blaize_team_tabs', array( 'sanitize_callback' => 'sanitize_text_field', ));
        $wp_customize->add_control( new Blaize_Companion_Customize_Control_Tabs( $wp_customize, 'blaize_team_tabs', array(
            'section' => 'blaize_team_section',
            'tabs'    => array(
                'general' => array(
                    'nicename' => esc_html__( 'General', 'blaize-companion' ),
                    'icon'     => 'cogs',
                    'controls' => array(
                        'blaize_enable_team_section',
                        'blaize_team_title',
                        'blaize_team_desc_text',
                        'blaize_team_category',
                    ),
                ),

                'design' => array(
                    'nicename' => esc_html__( 'Background', 'blaize-companion' ),
                    'icon'     => 'adjust',
                    'controls' => array(
                        'blaize_team_bg_color',
                        'blaize_team_bg_img',
                        'blaize_team_bg_position',
                        'blaize_team_bg_repeat',
                        'blaize_team_bg_size',
                        'blaize_team_bg_attachment',
                    ),
                ),
            ),
        ) ) );

        /**
        * Video section Tabs
        *
        */
        $wp_customize->add_setting( 'blaize_video_tabs', array( 'sanitize_callback' => 'sanitize_text_field', ));
        $wp_customize->add_control( new Blaize_Companion_Customize_Control_Tabs( $wp_customize, 'blaize_video_tabs', array(
            'section' => 'blaize_video_section',
            'tabs'    => array(
                'general' => array(
                    'nicename' => esc_html__( 'General', 'blaize-companion' ),
                    'icon'     => 'cogs',
                    'controls' => array(
                        'blaize_enable_video_section',
                        'blaize_video_title',
                        'blaize_video_desc_text',
                        'blaize_video_placeholder',
                        'blaize_video_url',
                        'blaize_video_readmore_text',
                        'blaize_video_readmore_link',
                    ),
                ),

                'design' => array(
                    'nicename' => esc_html__( 'Background', 'blaize-companion' ),
                    'icon'     => 'adjust',
                    'controls' => array(
                        'blaize_video_bg_color',
                        'blaize_video_bg_img',
                        'blaize_video_bg_position',
                        'blaize_video_bg_repeat',
                        'blaize_video_bg_size',
                        'blaize_video_bg_attachment',
                    ),
                ),
            ),
        ) ) );

        /**
        * Testimonial section Tabs
        *
        */
        $wp_customize->add_setting( 'blaize_testimonial_tabs', array( 'sanitize_callback' => 'sanitize_text_field', ));
        $wp_customize->add_control( new Blaize_Companion_Customize_Control_Tabs( $wp_customize, 'blaize_testimonial_tabs', array(
            'section' => 'blaize_testimonial_section',
            'tabs'    => array(
                'general' => array(
                    'nicename' => esc_html__( 'General', 'blaize-companion' ),
                    'icon'     => 'cogs',
                    'controls' => array(
                        'blaize_enable_testimonial_section',
                        'blaize_testimonial_layout',
                        'blaize_testimonial_title',
                        'blaize_testimonial_desc_text',
                        'blaize_testimonial_category',
                    ),
                ),

                'design' => array(
                    'nicename' => esc_html__( 'Background', 'blaize-companion' ),
                    'icon'     => 'adjust',
                    'controls' => array(
                        'blaize_testimonial_bg_color',
                        'blaize_testimonial_bg_img',
                        'blaize_testimonial_bg_position',
                        'blaize_testimonial_bg_repeat',
                        'blaize_testimonial_bg_size',
                        'blaize_testimonial_bg_attachment',
                    ),
                ),
            ),
        ) ) );

        /**
        * Blog section Tabs
        *
        */
        $wp_customize->add_setting( 'blaize_blog_tabs', array( 'sanitize_callback' => 'sanitize_text_field', ));
        $wp_customize->add_control( new Blaize_Companion_Customize_Control_Tabs( $wp_customize, 'blaize_blog_tabs', array(
            'section' => 'blaize_blog_section',
            'tabs'    => array(
                'general' => array(
                    'nicename' => esc_html__( 'General', 'blaize-companion' ),
                    'icon'     => 'cogs',
                    'controls' => array(
                        'blaize_enable_blog_section',
                        'blaize_blog_title',
                        'blaize_blog_desc_text',
                        'blaize_blog_exclude_category',
                        'blaize_blog_no_of_post',
                        'blaize_blog_excerpt_length',
                        'blaize_blog_readmore_text',
                    ),
                ),

                'design' => array(
                    'nicename' => esc_html__( 'Background', 'blaize-companion' ),
                    'icon'     => 'adjust',
                    'controls' => array(
                        'blaize_blog_bg_color',
                        'blaize_blog_bg_img',
                        'blaize_blog_bg_position',
                        'blaize_blog_bg_repeat',
                        'blaize_blog_bg_size',
                        'blaize_blog_bg_attachment',
                    ),
                ),
            ),
        ) ) );

        /**
        * Partners section Tabs
        *
        */
        $wp_customize->add_setting( 'blaize_partners_tabs', array( 'sanitize_callback' => 'sanitize_text_field', ));
        $wp_customize->add_control( new Blaize_Companion_Customize_Control_Tabs( $wp_customize, 'blaize_partners_tabs', array(
            'section' => 'blaize_partners_section',
            'tabs'    => array(
                'general' => array(
                    'nicename' => esc_html__( 'General', 'blaize-companion' ),
                    'icon'     => 'cogs',
                    'controls' => array(
                        'blaize_enable_partners_section',
                        'blaize_partner_title',
                        'blaize_partners',
                    ),
                ),

                'design' => array(
                    'nicename' => esc_html__( 'Background', 'blaize-companion' ),
                    'icon'     => 'adjust',
                    'controls' => array(
                        'blaize_partners_bg_color',
                        'blaize_partners_bg_img',
                        'blaize_partners_bg_position',
                        'blaize_partners_bg_repeat',
                        'blaize_partners_bg_size',
                        'blaize_partners_bg_attachment',
                    ),
                ),
            ),
        ) ) );
	}
}
add_action( 'customize_register', 'blaize_tabs_customize_register' );