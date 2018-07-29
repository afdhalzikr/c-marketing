<?php
	/**
	 * Blaize Customizer Panels,
	 * Sections,
	 * Settings
	 * and Controls
	 **/

	/** Enqueue necessary scripts and styles **/
	function blaize_customizer_scripts_styles() {
		wp_enqueue_style( 'font-awesome', BLAIZE_COMPANION_DIR . '/customizer/assets/faw/css/fontawesome-all.min.css' );
		wp_enqueue_style( 'et-line', BLAIZE_COMPANION_DIR . '/customizer/assets/et-line/style.css' );
		wp_enqueue_style( 'blaize-companion-customizer-style', BLAIZE_COMPANION_DIR . '/customizer/assets/blaize-customizer-styles.css' );

		wp_enqueue_script( 'blaize-companion-customizer-scripts', BLAIZE_COMPANION_DIR . '/customizer/assets/blaize-customizer-script.js', array('jquery', 'customize-controls'));

		wp_localize_script( 'blaize-companion-customizer-scripts', 'BlaizeObj', array( 'ajax_url' => admin_url('admin-ajax.php') ) );
	}
	add_action( 'customize_controls_enqueue_scripts', 'blaize_customizer_scripts_styles');

	function blaize_customizer_register( $wp_customize ) {

		/** Necessary Variable **/
		$bg_repeat = array(
	        'no-repeat'  => esc_html__('No Repeat', 'blaize-companion'),
	        'repeat'     => esc_html__('Tile', 'blaize-companion'),
	        'repeat-x'   => esc_html__('Tile Horizontally', 'blaize-companion'),
	        'repeat-y'   => esc_html__('Tile Vertically', 'blaize-companion'),
	    );

	    $bg_size = array(
	        'auto' => esc_html__('Auto', 'blaize-companion'),
	        'cover' => esc_html__('Cover', 'blaize-companion'),
	        'contain' => esc_html__('Contain', 'blaize-companion'),
	    );
	    
	    $bg_attachment = array(
	        'fixed'      => esc_html__('Fixed', 'blaize-companion'),
	        'scroll'     => esc_html__('Scroll', 'blaize-companion'),
	    );

		/**
		* 
		* Header Panel
		* 
		**/
		$wp_customize->add_panel( 'blaize_header_panel', array(
	  		'title' => esc_html__( 'Header Settings', 'blaize-companion' ),
			'priority' => 4,
		) );

		/** Top Header Section **/
		$wp_customize->add_section( 'blaize_top_header_section' , array(
			'title' => esc_html__( 'Top Header Section', 'blaize-companion' ),
			'panel' => 'blaize_header_panel',
		) );


		/** Display Top Header **/
		$wp_customize->add_setting( 'blaize_display_top_header', array( 'default' => false, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
		$wp_customize->add_control( 'blaize_display_top_header', array(
				'type' => 'checkbox',
				'section' => 'blaize_top_header_section',
				'label' => esc_html__('Display Top Header', 'blaize-companion'),
				'description' => esc_html__( 'Check to display the top header section.', 'blaize-companion' ),
			)
		);

		/** Top Left Header **/
        $wp_customize->add_setting( 'blaize_top_left_header', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
		$wp_customize->add_control( new Blaize_Companion_Title( $wp_customize, 'blaize_top_left_header', array(
            'label'   => esc_html__('Top Left Header', 'blaize-companion'),
            'type' => 'blaize-title',
            'section' => 'blaize_top_header_section',
            'settings'   => 'blaize_top_left_header',
        ) ) );

		/** Email Id **/
		$wp_customize->add_setting( 'blaize_email_id', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_email' ) );
		$wp_customize->add_control( 'blaize_email_id', array(
				'type' => 'text',
				'section' => 'blaize_top_header_section',
				'label' => esc_html__('Email ID', 'blaize-companion'),
				'description' => esc_html__( 'Set the email id.', 'blaize-companion' ),
			)
		);

		/** Phone Number **/
		$wp_customize->add_setting( 'blaize_phone_no', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( 'blaize_phone_no', array(
				'type' => 'text',
				'section' => 'blaize_top_header_section',
				'label' => esc_html__('Phone Number', 'blaize-companion'),
				'description' => esc_html__( 'Set the Phone Number.', 'blaize-companion' ),
			)
		);

		/** Top Right Header **/
        $wp_customize->add_setting( 'blaize_top_right_header', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
		$wp_customize->add_control( new Blaize_Companion_Title( $wp_customize, 'blaize_top_right_header', array(
            'label'   => esc_html__('Top Right Header', 'blaize-companion'),
            'type' => 'blaize-title',
            'section' => 'blaize_top_header_section',
            'settings'   => 'blaize_top_right_header',
        ) ) );

		/** Social Links **/
		$wp_customize->add_setting( 'blaize_top_social_links', array( 'sanitize_callback' => 'blaize_sanitize_repeater',
		    'default' => json_encode(
		     	array(
		         	array(
			            'social_icon' => 'facebook-f' ,
			            'social_link' => ''
		            ),
		     	)
		    )
		) );

		$wp_customize->add_control(  new Blaize_Companion_Repeater_Controler( $wp_customize, 'blaize_top_social_links', 
	        array(
	            'label'   => esc_html__('Manage Social Icons','blaize-companion'),
	            'section' => 'blaize_top_header_section',
	            'settings' => 'blaize_top_social_links',
	            'box_label' => esc_html__('Social Icon','blaize-companion'),
	            'box_add_control' => esc_html__('Add Link','blaize-companion'),
	        ),
			array (
	        	'social_icon' => array(
		            'type'        => 'social-icon',
		            'label'       => esc_html__( 'Select Icon', 'blaize-companion' ),
		            'default'     => '',
		        ),
		        'social_link' => array(
		            'type'        => 'text',
		            'label'       => esc_html__( 'Set Link', 'blaize-companion' ),
		            'default'     => '',
		        ),
	        )
		));

		/** Main Header Section **/
		$wp_customize->remove_section( 'title_tagline' );
		$wp_customize->add_section(
	        'title_tagline',
	        array(
	            'title'=>__('Main Header Section', 'blaize-companion'),
	            'panel' => 'blaize_header_panel'
	        )
	    );

	    /** Display Search **/
	    $wp_customize->add_setting( 'blaize_display_search', array( 'default' => true, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
		$wp_customize->add_control( 'blaize_display_search', array(
				'type' => 'checkbox',
				'section' => 'title_tagline',
				'label' => esc_html__('Display Search', 'blaize-companion'),
				'description' => esc_html__( 'Check to search in header section.', 'blaize-companion' ),
			)
		);

		/** Header Layouts **/
			$wp_customize->add_setting( 'blaize_header_layout', array( 'default' => 'layout1', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( new Blaize_Companion_Radio_Image_Select( $wp_customize, 'blaize_header_layout', array(
	            'label'   => esc_html__('Header Layout', 'blaize-companion'),
	            'description'   => esc_html__('Choose a Header Layout.', 'blaize-companion'),
	            'type' => 'radio-image',
	            'section' => 'title_tagline',
	            'settings'   => 'blaize_header_layout',
	            'choices' => array(
	            	'layout1' => BLAIZE_COMPANION_DIR . '/customizer/assets/images/header1.png',
	            	'layout2' => BLAIZE_COMPANION_DIR . '/customizer/assets/images/header2.png',
	            ),
	        ) ) );


		/**
		* 
		* Home Page Panel
		* 
		**/
		$wp_customize->add_panel( 'blaize_home_panel', array(
	  		'title' => esc_html__( 'Frontpage Settings', 'blaize-companion' ),
	  		'priority' => 6,
	  		'description' => esc_html__( 'Configure the homepage sections', 'blaize-companion' )
		) );

		/** Slider Section **/
		$wp_customize->add_section( 'blaize_slider_section' , array(
			'priority' => 1,
			'title' => esc_html__( 'Slider Section', 'blaize-companion' ),
			'panel' => 'blaize_home_panel',
		) );

		/** Enable Section **/
		$wp_customize->add_setting( 'blaize_enable_slider_section', array( 'default' => false, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
		$wp_customize->add_control( 'blaize_enable_slider_section', array(
				'type' => 'checkbox',
				'section' => 'blaize_slider_section',
				'label' => esc_html__('Enable Section', 'blaize-companion'),
				'description' => esc_html__( 'Check to Enable the section.', 'blaize-companion' ),
			)
		);

		/** Auto Slide **/
		$wp_customize->add_setting( 'blaize_slider_auto_slide', array( 'default' => true, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
		$wp_customize->add_control( 'blaize_slider_auto_slide', array(
				'type' => 'checkbox',
				'section' => 'blaize_slider_section',
				'label' => esc_html__('Auto Slide', 'blaize-companion'),
				'description' => esc_html__( 'Set slider to automode.', 'blaize-companion' ),
			)
		);

		/** Slide One **/

			/** Slide One Heading **/
	        $wp_customize->add_setting( 'blaize_slide_title_1', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
			$wp_customize->add_control( new Blaize_Companion_Title( $wp_customize, 'blaize_slide_title_1', array(
	            'label'   => esc_html__('Slide One', 'blaize-companion'),
	            'type' => 'blaize-title',
	            'section' => 'blaize_slider_section',
	            'settings'   => 'blaize_slide_title_1',
	        ) ) );

	        /** Slide Image **/
			$wp_customize->add_setting('blaize_slide_img_1',array( 'sanitize_callback' => 'esc_url_raw' ));
		    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_slide_img_1', array(
		           'label'      => esc_html__( 'Slide Image', 'blaize-companion' ),
		           'description' => esc_html__('Set the Slide Image.', 'blaize-companion'),
		           'section'    => 'blaize_slider_section',
		        )
		    ) );

			/** Slide Caption Title **/
			$wp_customize->add_setting( 'blaize_slide_cap_title_1', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_slide_cap_title_1', array(
					'type' => 'text',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Caption Title', 'blaize-companion'),
					'description' => esc_html__( 'Set the Caption title for the Slide.', 'blaize-companion' ),
				)
			);

			/** Slide Caption Description **/
			$wp_customize->add_setting( 'blaize_slide_cap_descr_1', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_slide_cap_descr_1', array(
					'type' => 'textarea',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Slide Text', 'blaize-companion'),
					'description' => esc_html__( 'Set the slide text for Slide.', 'blaize-companion' ),
				)
			);

			/** Slide Button Text **/
			$wp_customize->add_setting( 'blaize_slide_btn_text_1', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_slide_btn_text_1', array(
					'type' => 'text',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Button Text', 'blaize-companion'),
					'description' => esc_html__( 'Set button text for Slide.', 'blaize-companion' ),
				)
			);

			/** Slide Button Link **/
			$wp_customize->add_setting( 'blaize_slide_btn_link_1', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'blaize_slide_btn_link_1', array(
					'type' => 'text',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Button Link', 'blaize-companion'),
					'description' => esc_html__( 'Set button link for Slide.', 'blaize-companion' ),
				)
			);

		/** Slide Two **/

			/** Slide Two Heading **/
	        $wp_customize->add_setting( 'blaize_slide_title_2', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
			$wp_customize->add_control( new Blaize_Companion_Title( $wp_customize, 'blaize_slide_title_2', array(
	            'label'   => esc_html__('Slide Two', 'blaize-companion'),
	            'type' => 'blaize-title',
	            'section' => 'blaize_slider_section',
	            'settings'   => 'blaize_slide_title_2',
	        ) ) );

	        /** Slide Image **/
			$wp_customize->add_setting('blaize_slide_img_2',array( 'sanitize_callback' => 'esc_url_raw' ));
		    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_slide_img_2', array(
		           'label'      => esc_html__( 'Slide Image', 'blaize-companion' ),
		           'description' => esc_html__('Set the Slide Image.', 'blaize-companion'),
		           'section'    => 'blaize_slider_section',
		        )
		    ) );

			/** Slide Caption Title **/
			$wp_customize->add_setting( 'blaize_slide_cap_title_2', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_slide_cap_title_2', array(
					'type' => 'text',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Caption Title', 'blaize-companion'),
					'description' => esc_html__( 'Set the Caption title for the Slide.', 'blaize-companion' ),
				)
			);

			/** Slide Caption Description **/
			$wp_customize->add_setting( 'blaize_slide_cap_descr_2', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_slide_cap_descr_2', array(
					'type' => 'textarea',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Slide Text', 'blaize-companion'),
					'description' => esc_html__( 'Set the slide text for Slide.', 'blaize-companion' ),
				)
			);

			/** Slide Button Text **/
			$wp_customize->add_setting( 'blaize_slide_btn_text_2', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_slide_btn_text_2', array(
					'type' => 'text',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Button Text', 'blaize-companion'),
					'description' => esc_html__( 'Set button text for Slide.', 'blaize-companion' ),
				)
			);

			/** Slide Button Link **/
			$wp_customize->add_setting( 'blaize_slide_btn_link_2', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'blaize_slide_btn_link_2', array(
					'type' => 'text',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Button Link', 'blaize-companion'),
					'description' => esc_html__( 'Set button link for Slide.', 'blaize-companion' ),
				)
			);

		/** Slide Three **/

			/** Slide Three Heading **/
	        $wp_customize->add_setting( 'blaize_slide_title_3', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
			$wp_customize->add_control( new Blaize_Companion_Title( $wp_customize, 'blaize_slide_title_3', array(
	            'label'   => esc_html__('Slide Three', 'blaize-companion'),
	            'type' => 'blaize-title',
	            'section' => 'blaize_slider_section',
	            'settings'   => 'blaize_slide_title_3',
	        ) ) );

	        /** Slide Image **/
			$wp_customize->add_setting('blaize_slide_img_3',array( 'sanitize_callback' => 'esc_url_raw' ));
		    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_slide_img_3', array(
		           'label'      => esc_html__( 'Slide Image', 'blaize-companion' ),
		           'description' => esc_html__('Set the Slide Image.', 'blaize-companion'),
		           'section'    => 'blaize_slider_section',
		        )
		    ) );

			/** Slide Caption Title **/
			$wp_customize->add_setting( 'blaize_slide_cap_title_3', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_slide_cap_title_3', array(
					'type' => 'text',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Caption Title', 'blaize-companion'),
					'description' => esc_html__( 'Set the Caption title for the Slide.', 'blaize-companion' ),
				)
			);

			/** Slide Caption Description **/
			$wp_customize->add_setting( 'blaize_slide_cap_descr_3', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_slide_cap_descr_3', array(
					'type' => 'textarea',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Slide Text', 'blaize-companion'),
					'description' => esc_html__( 'Set the slide text for Slide.', 'blaize-companion' ),
				)
			);

			/** Slide Button Text **/
			$wp_customize->add_setting( 'blaize_slide_btn_text_3', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_slide_btn_text_3', array(
					'type' => 'text',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Button Text', 'blaize-companion'),
					'description' => esc_html__( 'Set button text for Slide.', 'blaize-companion' ),
				)
			);

			/** Slide Button Link **/
			$wp_customize->add_setting( 'blaize_slide_btn_link_3', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'blaize_slide_btn_link_3', array(
					'type' => 'text',
					'section' => 'blaize_slider_section',
					'label' => esc_html__('Button Link', 'blaize-companion'),
					'description' => esc_html__( 'Set button link for Slide.', 'blaize-companion' ),
				)
			);

		/** Service Section **/
		$wp_customize->add_section( 'blaize_service_section' , array(
			'priority' => blaize_get_section_position('blaize_service_section'),
			'title' => esc_html__( 'Service Section', 'blaize-companion' ),
			'panel' => 'blaize_home_panel',
		) );

		/** Enable Section **/
		$wp_customize->add_setting( 'blaize_enable_service_section', array( 'default' => false, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
		$wp_customize->add_control( 'blaize_enable_service_section', array(
				'type' => 'checkbox',
				'section' => 'blaize_service_section',
				'label' => esc_html__('Enable Section', 'blaize-companion'),
				'description' => esc_html__( 'Check to Enable the section.', 'blaize-companion' ),
			)
		);

		/** Service Title **/
		$wp_customize->add_setting( 'blaize_service_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( 'blaize_service_title', array(
				'type' => 'text',
				'section' => 'blaize_service_section',
				'label' => esc_html__('Section Title', 'blaize-companion'),
				'description' => esc_html__( 'Set Section Title.', 'blaize-companion' ),
			)
		);

		/** Service Subtitle **/
		$wp_customize->add_setting( 'blaize_service_desc_text', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
		$wp_customize->add_control( 'blaize_service_desc_text', array(
				'type' => 'textarea',
				'section' => 'blaize_service_section',
				'label' => esc_html__('Section Subtitle', 'blaize-companion'),
				'description' => esc_html__( 'Set Section Description Text.', 'blaize-companion' ),
			)
		);

		/** Services **/
		$wp_customize->add_setting( 'blaize_service', array( 'sanitize_callback' => 'blaize_sanitize_repeater',
		    'default' => json_encode(
		     	array(
		         	array(
			            'service_icon' => 'desktop' ,
			            'service_title' => '',
			            'service_description' => '',
		            ),
		            array(
			            'service_icon' => 'briefcase' ,
			            'service_title' => '',
			            'service_description' => '',
		            ),
		            array(
			            'service_icon' => 'clock' ,
			            'service_title' => '',
			            'service_description' => '',
		            ),
		     	)
		    )
		) );

		$wp_customize->add_control(  new Blaize_Companion_Repeater_Controler( $wp_customize, 'blaize_service', 
	        array(
	            'label'   => esc_html__('Manage Services Section','blaize-companion'),
	            'section' => 'blaize_service_section',
	            'settings' => 'blaize_service',
	            'box_label' => esc_html__('Our Services Section','blaize-companion'),
	            'box_add_control' => esc_html__('Add Service','blaize-companion'),
	        ),
			array (
	        	'service_icon' => array(
		            'type'        => 'icon',
		            'label'       => esc_html__( 'Select Service Icon', 'blaize-companion' ),
		            'default'     => 'desktop',
		            'class'       => 'un-bottom-block-cat1'
		        ),
		        'service_title' => array(
		            'type'        => 'text',
		            'label'       => esc_html__( 'Service Title', 'blaize-companion' ),
		            'default'     => esc_html__( 'Service 1', 'blaize-companion' ),
		        ),
		        'service_description' => array(
		            'type'        => 'textarea',
		            'label'       => esc_html__( 'Service Description', 'blaize-companion' ),
		            'default'     => esc_html__( 'Service Description Text', 'blaize-companion' ),
		        )
	        )
		));

		/* Service Background */
			/** BG Color **/
		    $wp_customize->add_setting( 'blaize_service_bg_color', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_hex_color' ) );
		    $wp_customize->add_control(
		       new WP_Customize_Color_Control(
		           $wp_customize,
		           'blaize_service_bg_color',
		           array(
		               'label'=>esc_html__('Section Background Color','blaize-companion'),
		               'description' => esc_html__('Set the background color for the section.', 'blaize-companion'),
		               'section'    => 'blaize_service_section',
		               'settings'   => 'blaize_service_bg_color',
		           )
		       )
		    );

		    /* background Image */
		    $wp_customize->add_setting('blaize_service_bg_img',array( 'sanitize_callback' => 'esc_url_raw' ));
		    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_service_bg_img', array(
		           'label'      => esc_html__( 'Background Image', 'blaize-companion' ),
		           'description' => esc_html__('Set the Background Image for the section.', 'blaize-companion'),
		           'section'    => 'blaize_service_section',
		        )
		    ) );

		    /** Background Image Position **/
		    $wp_customize->add_setting( 'blaize_service_bg_position_x', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
		    $wp_customize->add_setting( 'blaize_service_bg_position_y', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
		    $wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'blaize_service_bg_position', array(
		                'label'           => esc_html__( 'Background Position', 'blaize-companion' ),
		                'section'         => 'blaize_service_section',
		                'settings'        => array(
		                    'x' => 'blaize_service_bg_position_x',
		                    'y' => 'blaize_service_bg_position_y',
		                ),
		                
		            )
		        )
		    );

		    /** Background Repeat **/
		    $wp_customize->add_setting('blaize_service_bg_repeat',array( 'default' => 'no-repeat', 'sanitize_callback' => 'sanitize_text_field' ));
		    $wp_customize->add_control( 'blaize_service_bg_repeat', array(
		        'label'    => esc_html__( 'Background Repeat', 'blaize-companion' ),
		        'section'  => 'blaize_service_section',
		        'type'     => 'select',
		        'choices' => $bg_repeat,
		    ) );

		    /** Background Size **/
		    $wp_customize->add_setting('blaize_service_bg_size',array( 'default' => 'cover', 'sanitize_callback' => 'sanitize_text_field' ));
		    $wp_customize->add_control( 'blaize_service_bg_size', array(
		        'label'    => esc_html__( 'Background Size', 'blaize-companion' ),
		        'section'  => 'blaize_service_section',
		        'type'     => 'select',
		        'choices' => $bg_size,
		    ) );

		    /** Background Attachment **/
		    $wp_customize->add_setting('blaize_service_bg_attachment',array( 'default' => 'scroll', 'sanitize_callback' => 'sanitize_text_field' ));
		    $wp_customize->add_control( 'blaize_service_bg_attachment', array(
		        'label'    => esc_html__( 'Background Attachment', 'blaize-companion' ),
		        'section'  => 'blaize_service_section',
		        'type'     => 'select',
		        'choices' => $bg_attachment,
		    ) );

		/** About Section **/
		$wp_customize->add_section( 'blaize_about_section' , array(
			'priority' => blaize_get_section_position('blaize_about_section'),
			'title' => esc_html__( 'About Section', 'blaize-companion' ),
			'panel' => 'blaize_home_panel',
		) );

		/** Enable Section **/
		$wp_customize->add_setting( 'blaize_enable_about_section', array( 'default' => false, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
		$wp_customize->add_control( 'blaize_enable_about_section', array(
				'type' => 'checkbox',
				'section' => 'blaize_about_section',
				'label' => esc_html__('Enable Section', 'blaize-companion'),
				'description' => esc_html__( 'Check to Enable the section.', 'blaize-companion' ),
			)
		);

		/** Section Title **/
		$wp_customize->add_setting( 'blaize_about_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( 'blaize_about_title', array(
				'type' => 'text',
				'section' => 'blaize_about_section',
				'label' => esc_html__('Section Title', 'blaize-companion'),
				'description' => esc_html__( 'Set Section Title.', 'blaize-companion' ),
			)
		);

		/** Section Subtitle **/
		$wp_customize->add_setting( 'blaize_about_desc_text', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
		$wp_customize->add_control( 'blaize_about_desc_text', array(
				'type' => 'textarea',
				'section' => 'blaize_about_section',
				'label' => esc_html__('Section Subtitle', 'blaize-companion'),
				'description' => esc_html__( 'Set Section Description Text.', 'blaize-companion' ),
			)
		);

		/** About Page **/
		$wp_customize->add_setting('blaize_about_page', array( 'default' => 0, 'sanitize_callback' => 'blaize_sanitize_dropdown_pages' ));
		$wp_customize->add_control('blaize_about_page', array(
			'label'      => esc_html__('About Us Page', 'blaize-companion'),
			'section'    => 'blaize_about_section',
			'type'    => 'dropdown-pages',
			'settings'   => 'blaize_about_page',
		));

		/** Readmore Text **/
		$wp_customize->add_setting( 'blaize_about_readmore_text', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( 'blaize_about_readmore_text', array(
				'type' => 'text',
				'section' => 'blaize_about_section',
				'label' => esc_html__('Readmore Text', 'blaize-companion'),
				'description' => esc_html__( 'Set Read More Text.', 'blaize-companion' ),
			)
		);

		/** Readmore Link **/
		$wp_customize->add_setting( 'blaize_about_readmore_link', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( 'blaize_about_readmore_link', array(
				'type' => 'text',
				'section' => 'blaize_about_section',
				'label' => esc_html__('Readmore Link', 'blaize-companion'),
				'description' => esc_html__( 'Set Read More Link.', 'blaize-companion' ),
			)
		);

		/* About Background */
			/** Background Color **/
		    $wp_customize->add_setting( 'blaize_about_bg_color', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_hex_color' ) );
		    $wp_customize->add_control(
		       new WP_Customize_Color_Control(
		           $wp_customize,
		           'blaize_about_bg_color',
		           array(
		               'label'=>esc_html__('Section Background Color','blaize-companion'),
		               'description' => esc_html__('Set the background color for the section.', 'blaize-companion'),
		               'section'    => 'blaize_about_section',
		               'settings'   => 'blaize_about_bg_color',
		           )
		       )
		    );

		    /* Background Image */
		    $wp_customize->add_setting('blaize_about_bg_img',array( 'sanitize_callback' => 'esc_url_raw' ));
		    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_about_bg_img', array(
		           'label'      => esc_html__( 'Background Image', 'blaize-companion' ),
		           'description' => esc_html__('Set the Background Image for the section.', 'blaize-companion'),
		           'section'    => 'blaize_about_section',
		        )
		    ) );

		    /** Background Image Position **/
		    $wp_customize->add_setting( 'blaize_about_bg_position_x', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
		    $wp_customize->add_setting( 'blaize_about_bg_position_y', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
		    $wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'blaize_about_bg_position', array(
		                'label'           => esc_html__( 'Background Position', 'blaize-companion' ),
		                'section'         => 'blaize_about_section',
		                'settings'        => array(
		                    'x' => 'blaize_about_bg_position_x',
		                    'y' => 'blaize_about_bg_position_y',
		                ),
		                
		            )
		        )
		    );

		    /** Background Repeat **/
		    $wp_customize->add_setting('blaize_about_bg_repeat',array( 'default' => 'no-repeat', 'sanitize_callback' => 'sanitize_text_field' ));
		    $wp_customize->add_control( 'blaize_about_bg_repeat', array(
		        'label'    => esc_html__( 'Background Repeat', 'blaize-companion' ),
		        'section'  => 'blaize_about_section',
		        'type'     => 'select',
		        'choices' => $bg_repeat,
		    ) );

		    /** Background Size **/
		    $wp_customize->add_setting('blaize_about_bg_size',array( 'default' => 'cover', 'sanitize_callback' => 'sanitize_text_field' ));
		    $wp_customize->add_control( 'blaize_about_bg_size', array(
		        'label'    => esc_html__( 'Background Size', 'blaize-companion' ),
		        'section'  => 'blaize_about_section',
		        'type'     => 'select',
		        'choices' => $bg_size,
		    ) );

		    /** Background Attachment **/
		    $wp_customize->add_setting('blaize_about_bg_attachment',array( 'default' => 'scroll', 'sanitize_callback' => 'sanitize_text_field' ));
		    $wp_customize->add_control( 'blaize_about_bg_attachment', array(
		        'label'    => esc_html__( 'Background Attachment', 'blaize-companion' ),
		        'section'  => 'blaize_about_section',
		        'type'     => 'select',
		        'choices' => $bg_attachment,
		    ) );


		/** Counter Section **/
		$wp_customize->add_section( 'blaize_counter_section' , array(
			'priority' => blaize_get_section_position('blaize_counter_section'),
			'title' => esc_html__( 'Counter Section', 'blaize-companion' ),
			'panel' => 'blaize_home_panel',
		) );

		/** Enable Section **/
		$wp_customize->add_setting( 'blaize_enable_counter_section', array( 'default' => false, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
		$wp_customize->add_control( 'blaize_enable_counter_section', array(
				'type' => 'checkbox',
				'section' => 'blaize_counter_section',
				'label' => esc_html__('Enable Section', 'blaize-companion'),
				'description' => esc_html__( 'Check to Enable the section.', 'blaize-companion' ),
			)
		);

		/** === Counter 1 === **/
			/** Counter 1 Heading **/
	        $wp_customize->add_setting( 'blaize_counter_heading1', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
			$wp_customize->add_control( new Blaize_Companion_Title( $wp_customize, 'blaize_counter_heading1', array(
	            'label'   => esc_html__('Counter 1', 'blaize-companion'),
	            'type' => 'blaize-title',
	            'section' => 'blaize_counter_section',
	            'settings'   => 'blaize_counter_heading1',
	        ) ) );

			/** Counter Icon **/
			$wp_customize->add_setting( 'blaize_counter_icon1', array( 'default' => 'trophy', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( new Blaize_Companion_Icon_Picker( $wp_customize, 'blaize_counter_icon1', array(
	            'label'   => esc_html__('Counter Icon', 'blaize-companion'),
	            'description'   => esc_html__('Select the Counter Icon.', 'blaize-companion'),
	            'type' => 'icon-picker',
	            'section' => 'blaize_counter_section',
	            'settings'   => 'blaize_counter_icon1',
	        ) ) );

			/** Counter Number **/
			$wp_customize->add_setting( 'blaize_counter1', array( 'sanitize_callback' => 'blaize_sanitize_number_absint', 'default' => 158 ) );

			$wp_customize->add_control( 'blaize_counter1', array(
				'type' => 'number',
				'section' => 'blaize_counter_section',
				'label' => esc_html__( 'Counter Number', 'blaize-companion' ),
				'description' => esc_html__( 'Set the Counter Number.', 'blaize-companion' ),
			) );

			/** Counter Title **/
			$wp_customize->add_setting( 'blaize_counter_title1', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '' ) );

			$wp_customize->add_control( 'blaize_counter_title1', array(
				'type' => 'text',
				'section' => 'blaize_counter_section',
				'label' => esc_html__( 'Counter Title', 'blaize-companion' ),
				'description' => esc_html__( 'Set the Counter Title.', 'blaize-companion' ),
			) );

		/** === Counter 2 === **/

			/** Counter 2 Heading **/
			$wp_customize->add_setting( 'blaize_counter_heading2', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( new Blaize_Companion_Title( $wp_customize, 'blaize_counter_heading2', array(
	            'label'   => esc_html__('Counter 2', 'blaize-companion'),
	            'description'   => esc_html__('Configure Second Counter.', 'blaize-companion'),
	            'type' => 'blaize-title',
	            'section' => 'blaize_counter_section',
	            'settings'   => 'blaize_counter_heading2',
	        ) ) );

			/** Counter Icon **/
			$wp_customize->add_setting( 'blaize_counter_icon2', array( 'default' => 'layers', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( new Blaize_Companion_Icon_Picker( $wp_customize, 'blaize_counter_icon2', array(
	            'label'   => esc_html__('Counter Icon', 'blaize-companion'),
	            'description'   => esc_html__('Select the Counter Icon.', 'blaize-companion'),
	            'type' => 'icon-picker',
	            'section' => 'blaize_counter_section',
	            'settings'   => 'blaize_counter_icon2',
	        ) ) );

			/** Counter Number **/
			$wp_customize->add_setting( 'blaize_counter2', array( 'sanitize_callback' => 'blaize_sanitize_number_absint', 'default' => 258 ) );

			$wp_customize->add_control( 'blaize_counter2', array(
				'type' => 'number',
				'section' => 'blaize_counter_section',
				'label' => esc_html__( 'Counter Number', 'blaize-companion' ),
				'description' => esc_html__( 'Set the Counter Number.', 'blaize-companion' ),
			) );

			/** Counter Title **/
			$wp_customize->add_setting( 'blaize_counter_title2', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '' ) );

			$wp_customize->add_control( 'blaize_counter_title2', array(
				'type' => 'text',
				'section' => 'blaize_counter_section',
				'label' => esc_html__( 'Counter Title', 'blaize-companion' ),
				'description' => esc_html__( 'Set the Counter Title.', 'blaize-companion' ),
			) );

		/** === Counter 3 === **/
			/** Counter 3 Heading **/
			$wp_customize->add_setting( 'blaize_counter_heading3', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( new Blaize_Companion_Title( $wp_customize, 'blaize_counter_heading3', array(
	            'label'   => esc_html__('Counter 3', 'blaize-companion'),
	            'description'   => esc_html__('Configure Second Counter.', 'blaize-companion'),
	            'type' => 'blaize-title',
	            'section' => 'blaize_counter_section',
	            'settings'   => 'blaize_counter_heading3',
	        ) ) );

			/** Counter Icon **/
			$wp_customize->add_setting( 'blaize_counter_icon3', array( 'default' => 'happy', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( new Blaize_Companion_Icon_Picker( $wp_customize, 'blaize_counter_icon3', array(
	            'label'   => esc_html__('Counter Icon', 'blaize-companion'),
	            'description'   => esc_html__('Select the Counter Icon.', 'blaize-companion'),
	            'type' => 'icon-picker',
	            'section' => 'blaize_counter_section',
	            'settings'   => 'blaize_counter_icon3',
	        ) ) );

			/** Counter Number **/
			$wp_customize->add_setting( 'blaize_counter3', array( 'sanitize_callback' => 'blaize_sanitize_number_absint', 'default' => 358 ) );

			$wp_customize->add_control( 'blaize_counter3', array(
				'type' => 'number',
				'section' => 'blaize_counter_section',
				'label' => esc_html__( 'Counter Number', 'blaize-companion' ),
				'description' => esc_html__( 'Set the Counter Number.', 'blaize-companion' ),
			) );

			/** Counter Title **/
			$wp_customize->add_setting( 'blaize_counter_title3', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '' ) );

			$wp_customize->add_control( 'blaize_counter_title3', array(
				'type' => 'text',
				'section' => 'blaize_counter_section',
				'label' => esc_html__( 'Counter Title', 'blaize-companion' ),
				'description' => esc_html__( 'Set the Counter Title.', 'blaize-companion' ),
			) );

		/** === Counter 4 === **/
			/** Counter 4 Heading **/
			$wp_customize->add_setting( 'blaize_counter_heading4', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( new Blaize_Companion_Title( $wp_customize, 'blaize_counter_heading4', array(
	            'label'   => esc_html__('Counter 4', 'blaize-companion'),
	            'description'   => esc_html__('Configure Second Counter.', 'blaize-companion'),
	            'type' => 'blaize-title',
	            'section' => 'blaize_counter_section',
	            'settings'   => 'blaize_counter_heading4',
	        ) ) );

			/** Counter Icon **/
			$wp_customize->add_setting( 'blaize_counter_icon4', array( 'default' => 'download', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( new Blaize_Companion_Icon_Picker( $wp_customize, 'blaize_counter_icon4', array(
	            'label'   => esc_html__('Counter Icon', 'blaize-companion'),
	            'description'   => esc_html__('Select the Counter Icon.', 'blaize-companion'),
	            'type' => 'icon-picker',
	            'section' => 'blaize_counter_section',
	            'settings'   => 'blaize_counter_icon4',
	        ) ) );

			/** Counter Number **/
			$wp_customize->add_setting( 'blaize_counter4', array( 'sanitize_callback' => 'blaize_sanitize_number_absint', 'default' => 458 ) );

			$wp_customize->add_control( 'blaize_counter4', array(
				'type' => 'number',
				'section' => 'blaize_counter_section',
				'label' => esc_html__( 'Counter Number', 'blaize-companion' ),
				'description' => esc_html__( 'Set the Counter Number.', 'blaize-companion' ),
			) );

			/** Counter Title **/
			$wp_customize->add_setting( 'blaize_counter_title4', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '' ) );

			$wp_customize->add_control( 'blaize_counter_title4', array(
				'type' => 'text',
				'section' => 'blaize_counter_section',
				'label' => esc_html__( 'Counter Title', 'blaize-companion' ),
				'description' => esc_html__( 'Set the Counter Title.', 'blaize-companion' ),
			) );

			/* Counter Background */
				/** Background Color **/
			    $wp_customize->add_setting( 'blaize_counter_bg_color', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_hex_color' ) );
			    $wp_customize->add_control(
			       new WP_Customize_Color_Control(
			           $wp_customize,
			           'blaize_counter_bg_color',
			           array(
			               'label'=>esc_html__('Section Background Color','blaize-companion'),
			               'description' => esc_html__('Set the background color for the section.', 'blaize-companion'),
			               'section'    => 'blaize_counter_section',
			               'settings'   => 'blaize_counter_bg_color',
			           )
			       )
			    );

			    /* Background Image */
			    $wp_customize->add_setting('blaize_counter_bg_img',array( 'sanitize_callback' => 'esc_url_raw' ));
			    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_counter_bg_img', array(
			           'label'      => esc_html__( 'Background Image', 'blaize-companion' ),
			           'description' => esc_html__('Set the Background Image for the section.', 'blaize-companion'),
			           'section'    => 'blaize_counter_section',
			        )
			    ) );

			    /** Background Image Position **/
			    $wp_customize->add_setting( 'blaize_counter_bg_position_x', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_setting( 'blaize_counter_bg_position_y', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'blaize_counter_bg_position', array(
			                'label'           => esc_html__( 'Background Position', 'blaize-companion' ),
			                'section'         => 'blaize_counter_section',
			                'settings'        => array(
			                    'x' => 'blaize_counter_bg_position_x',
			                    'y' => 'blaize_counter_bg_position_y',
			                ),
			                
			            )
			        )
			    );

			    /** Background Repeat **/
			    $wp_customize->add_setting('blaize_counter_bg_repeat',array( 'default' => 'no-repeat', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_counter_bg_repeat', array(
			        'label'    => esc_html__( 'Background Repeat', 'blaize-companion' ),
			        'section'  => 'blaize_counter_section',
			        'type'     => 'select',
			        'choices' => $bg_repeat,
			    ) );

			    /** Background Size **/
			    $wp_customize->add_setting('blaize_counter_bg_size',array( 'default' => 'cover', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_counter_bg_size', array(
			        'label'    => esc_html__( 'Background Size', 'blaize-companion' ),
			        'section'  => 'blaize_counter_section',
			        'type'     => 'select',
			        'choices' => $bg_size,
			    ) );

			    /** Background Attachment **/
			    $wp_customize->add_setting('blaize_counter_bg_attachment',array( 'default' => 'scroll', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_counter_bg_attachment', array(
			        'label'    => esc_html__( 'Background Attachment', 'blaize-companion' ),
			        'section'  => 'blaize_counter_section',
			        'type'     => 'select',
			        'choices' => $bg_attachment,
			    ) );

		/** Portfolio Section **/
			$wp_customize->add_section( 'blaize_portfolio_section' , array(
				'priority' => blaize_get_section_position('blaize_portfolio_section'),
				'title' => esc_html__( 'Portfolio Section', 'blaize-companion' ),
				'panel' => 'blaize_home_panel',
			) );

			/** Enable Section **/
			$wp_customize->add_setting( 'blaize_enable_portfolio_section', array( 'default' => false, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
			$wp_customize->add_control( 'blaize_enable_portfolio_section', array(
					'type' => 'checkbox',
					'section' => 'blaize_portfolio_section',
					'label' => esc_html__('Enable Section', 'blaize-companion'),
					'description' => esc_html__( 'Check to Enable the section.', 'blaize-companion' ),
				)
			);

			/** Section Title **/
			$wp_customize->add_setting( 'blaize_portfolio_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_portfolio_title', array(
					'type' => 'text',
					'section' => 'blaize_portfolio_section',
					'label' => esc_html__('Section Title', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Title.', 'blaize-companion' ),
				)
			);

			/** Section Subtitle **/
			$wp_customize->add_setting( 'blaize_portfolio_desc_text', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
			$wp_customize->add_control( 'blaize_portfolio_desc_text', array(
					'type' => 'textarea',
					'section' => 'blaize_portfolio_section',
					'label' => esc_html__('Section Subtitle', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Description Text.', 'blaize-companion' ),
				)
			);

        	/* Portfolio Background */
				/** Background Color **/
			    $wp_customize->add_setting( 'blaize_portfolio_bg_color', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_hex_color' ) );
			    $wp_customize->add_control(
			       new WP_Customize_Color_Control(
			           $wp_customize,
			           'blaize_portfolio_bg_color',
			           array(
			               'label'=>esc_html__('Section Background Color','blaize-companion'),
			               'description' => esc_html__('Set the background color for the section.', 'blaize-companion'),
			               'section'    => 'blaize_portfolio_section',
			               'settings'   => 'blaize_portfolio_bg_color',
			           )
			       )
			    );

			    /* Background Image */
			    $wp_customize->add_setting('blaize_portfolio_bg_img',array( 'sanitize_callback' => 'esc_url_raw' ));
			    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_portfolio_bg_img', array(
			           'label'      => esc_html__( 'Background Image', 'blaize-companion' ),
			           'description' => esc_html__('Set the Background Image for the section.', 'blaize-companion'),
			           'section'    => 'blaize_portfolio_section',
			        )
			    ) );

			    /** Background Image Position **/
			    $wp_customize->add_setting( 'blaize_portfolio_bg_position_x', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_setting( 'blaize_portfolio_bg_position_y', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'blaize_portfolio_bg_position', array(
			                'label'           => esc_html__( 'Background Position', 'blaize-companion' ),
			                'section'         => 'blaize_portfolio_section',
			                'settings'        => array(
			                    'x' => 'blaize_portfolio_bg_position_x',
			                    'y' => 'blaize_portfolio_bg_position_y',
			                ),
			                
			            )
			        )
			    );

			    /** Background Repeat **/
			    $wp_customize->add_setting('blaize_portfolio_bg_repeat',array( 'default' => 'no-repeat', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_portfolio_bg_repeat', array(
			        'label'    => esc_html__( 'Background Repeat', 'blaize-companion' ),
			        'section'  => 'blaize_portfolio_section',
			        'type'     => 'select',
			        'choices' => $bg_repeat,
			    ) );

			    /** Background Size **/
			    $wp_customize->add_setting('blaize_portfolio_bg_size',array( 'default' => 'cover', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_portfolio_bg_size', array(
			        'label'    => esc_html__( 'Background Size', 'blaize-companion' ),
			        'section'  => 'blaize_portfolio_section',
			        'type'     => 'select',
			        'choices' => $bg_size,
			    ) );

			    /** Background Attachment **/
			    $wp_customize->add_setting('blaize_portfolio_bg_attachment',array( 'default' => 'scroll', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_portfolio_bg_attachment', array(
			        'label'    => esc_html__( 'Background Attachment', 'blaize-companion' ),
			        'section'  => 'blaize_portfolio_section',
			        'type'     => 'select',
			        'choices' => $bg_attachment,
			    ) );

    	/** Team Section **/
			$wp_customize->add_section( 'blaize_team_section' , array(
				'priority' => blaize_get_section_position('blaize_team_section'),
				'title' => esc_html__( 'Team Section', 'blaize-companion' ),
				'panel' => 'blaize_home_panel',
			) );

			/** Enable Section **/
			$wp_customize->add_setting( 'blaize_enable_team_section', array( 'default' => false, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
			$wp_customize->add_control( 'blaize_enable_team_section', array(
					'type' => 'checkbox',
					'section' => 'blaize_team_section',
					'label' => esc_html__('Enable Section', 'blaize-companion'),
					'description' => esc_html__( 'Check to Enable the section.', 'blaize-companion' ),
				)
			);

			/** Section Title **/
			$wp_customize->add_setting( 'blaize_team_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_team_title', array(
					'type' => 'text',
					'section' => 'blaize_team_section',
					'label' => esc_html__('Section Title', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Title.', 'blaize-companion' ),
				)
			);

			/** Section Subtitle **/
			$wp_customize->add_setting( 'blaize_team_desc_text', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
			$wp_customize->add_control( 'blaize_team_desc_text', array(
					'type' => 'textarea',
					'section' => 'blaize_team_section',
					'label' => esc_html__('Section Subtitle', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Description Text.', 'blaize-companion' ),
				)
			);

	        /* Team Background */
				/** Background Color **/
			    $wp_customize->add_setting( 'blaize_team_bg_color', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_hex_color' ) );
			    $wp_customize->add_control(
			       new WP_Customize_Color_Control(
			           $wp_customize,
			           'blaize_team_bg_color',
			           array(
			               'label'=>esc_html__('Section Background Color','blaize-companion'),
			               'description' => esc_html__('Set the background color for the section.', 'blaize-companion'),
			               'section'    => 'blaize_team_section',
			               'settings'   => 'blaize_team_bg_color',
			           )
			       )
			    );

			    /* Background Image */
			    $wp_customize->add_setting('blaize_team_bg_img',array( 'sanitize_callback' => 'esc_url_raw' ));
			    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_team_bg_img', array(
			           'label'      => esc_html__( 'Background Image', 'blaize-companion' ),
			           'description' => esc_html__('Set the Background Image for the section.', 'blaize-companion'),
			           'section'    => 'blaize_team_section',
			        )
			    ) );

			    /** Background Image Position **/
			    $wp_customize->add_setting( 'blaize_team_bg_position_x', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_setting( 'blaize_team_bg_position_y', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'blaize_team_bg_position', array(
			                'label'           => esc_html__( 'Background Position', 'blaize-companion' ),
			                'section'         => 'blaize_team_section',
			                'settings'        => array(
			                    'x' => 'blaize_team_bg_position_x',
			                    'y' => 'blaize_team_bg_position_y',
			                ),
			                
			            )
			        )
			    );

			    /** Background Repeat **/
			    $wp_customize->add_setting('blaize_team_bg_repeat',array( 'default' => 'no-repeat', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_team_bg_repeat', array(
			        'label'    => esc_html__( 'Background Repeat', 'blaize-companion' ),
			        'section'  => 'blaize_team_section',
			        'type'     => 'select',
			        'choices' => $bg_repeat,
			    ) );

			    /** Background Size **/
			    $wp_customize->add_setting('blaize_team_bg_size',array( 'default' => 'cover', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_team_bg_size', array(
			        'label'    => esc_html__( 'Background Size', 'blaize-companion' ),
			        'section'  => 'blaize_team_section',
			        'type'     => 'select',
			        'choices' => $bg_size,
			    ) );

			    /** Background Attachment **/
			    $wp_customize->add_setting('blaize_team_bg_attachment',array( 'default' => 'scroll', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_team_bg_attachment', array(
			        'label'    => esc_html__( 'Background Attachment', 'blaize-companion' ),
			        'section'  => 'blaize_team_section',
			        'type'     => 'select',
			        'choices' => $bg_attachment,
			    ) );

        /** Video Section **/
        	$wp_customize->add_section( 'blaize_video_section' , array(
        		'priority' => blaize_get_section_position('blaize_video_section'),
				'title' => esc_html__( 'Video Section', 'blaize-companion' ),
				'panel' => 'blaize_home_panel',
			) );

			/** Enable Section **/
			$wp_customize->add_setting( 'blaize_enable_video_section', array( 'default' => false, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
			$wp_customize->add_control( 'blaize_enable_video_section', array(
					'type' => 'checkbox',
					'section' => 'blaize_video_section',
					'label' => esc_html__('Enable Section', 'blaize-companion'),
					'description' => esc_html__( 'Check to Enable the section.', 'blaize-companion' ),
				)
			);

			/** Section Title **/
			$wp_customize->add_setting( 'blaize_video_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_video_title', array(
					'type' => 'text',
					'section' => 'blaize_video_section',
					'label' => esc_html__('Section Title', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Title.', 'blaize-companion' ),
				)
			);

			/** Section Subtitle **/
			$wp_customize->add_setting( 'blaize_video_desc_text', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
			$wp_customize->add_control( 'blaize_video_desc_text', array(
					'type' => 'textarea',
					'section' => 'blaize_video_section',
					'label' => esc_html__('Section Subtitle', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Description Text.', 'blaize-companion' ),
				)
			);

			/** Video URL **/
			$wp_customize->add_setting( 'blaize_video_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'blaize_video_url', array(
					'type' => 'text',
					'section' => 'blaize_video_section',
					'label' => esc_html__('Video URL', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Title.', 'blaize-companion' ),
				)
			);

			/** Video Image **/
			$wp_customize->add_setting( 'blaize_video_placeholder', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'blaize_video_placeholder', array(
					'settings'		=> 'blaize_video_placeholder',
					'section'		=> 'blaize_video_section',
					'label'			=> esc_html__( 'Video Image Placeholder', 'blaize-companion' ),
					'description'	=> esc_html__( 'Set the image placeholder for video.', 'blaize-companion' )
				)
			) );

			/** Read More Text **/
			$wp_customize->add_setting( 'blaize_video_readmore_text', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_video_readmore_text', array(
					'type' => 'text',
					'section' => 'blaize_video_section',
					'label' => esc_html__('Readmore Text', 'blaize-companion'),
					'description' => esc_html__( 'Set Readmore Text.', 'blaize-companion' ),
				)
			);

			/** Readmore Link **/
			$wp_customize->add_setting( 'blaize_video_readmore_link', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'blaize_video_readmore_link', array(
					'type' => 'text',
					'section' => 'blaize_video_section',
					'label' => esc_html__('Readmore Link', 'blaize-companion'),
					'description' => esc_html__( 'Set Readmore Link.', 'blaize-companion' ),
				)
			);

			/* Video Background */
				/** Background Color **/
			    $wp_customize->add_setting( 'blaize_video_bg_color', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_hex_color' ) );
			    $wp_customize->add_control(
			       new WP_Customize_Color_Control(
			           $wp_customize,
			           'blaize_video_bg_color',
			           array(
			               'label'=>esc_html__('Section Background Color','blaize-companion'),
			               'description' => esc_html__('Set the background color for the section.', 'blaize-companion'),
			               'section'    => 'blaize_video_section',
			               'settings'   => 'blaize_video_bg_color',
			           )
			       )
			    );

			    /* Background Image */
			    $wp_customize->add_setting('blaize_video_bg_img',array( 'sanitize_callback' => 'esc_url_raw' ));
			    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_video_bg_img', array(
			           'label'      => esc_html__( 'Background Image', 'blaize-companion' ),
			           'description' => esc_html__('Set the Background Image for the section.', 'blaize-companion'),
			           'section'    => 'blaize_video_section',
			        )
			    ) );

			    /** Background Image Position **/
			    $wp_customize->add_setting( 'blaize_video_bg_position_x', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_setting( 'blaize_video_bg_position_y', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'blaize_video_bg_position', array(
			                'label'           => esc_html__( 'Background Position', 'blaize-companion' ),
			                'section'         => 'blaize_video_section',
			                'settings'        => array(
			                    'x' => 'blaize_video_bg_position_x',
			                    'y' => 'blaize_video_bg_position_y',
			                ),
			                
			            )
			        )
			    );

			    /** Background Repeat **/
			    $wp_customize->add_setting('blaize_video_bg_repeat',array( 'default' => 'no-repeat', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_video_bg_repeat', array(
			        'label'    => esc_html__( 'Background Repeat', 'blaize-companion' ),
			        'section'  => 'blaize_video_section',
			        'type'     => 'select',
			        'choices' => $bg_repeat,
			    ) );

			    /** Background Size **/
			    $wp_customize->add_setting('blaize_video_bg_size',array( 'default' => 'cover', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_video_bg_size', array(
			        'label'    => esc_html__( 'Background Size', 'blaize-companion' ),
			        'section'  => 'blaize_video_section',
			        'type'     => 'select',
			        'choices' => $bg_size,
			    ) );

			    /** Background Attachment **/
			    $wp_customize->add_setting('blaize_video_bg_attachment',array( 'default' => 'scroll', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_video_bg_attachment', array(
			        'label'    => esc_html__( 'Background Attachment', 'blaize-companion' ),
			        'section'  => 'blaize_video_section',
			        'type'     => 'select',
			        'choices' => $bg_attachment,
			    ) );



		/** Testimonial Section **/
			$wp_customize->add_section( 'blaize_testimonial_section' , array(
				'priority' => blaize_get_section_position('blaize_testimonial_section'),
				'priority' => blaize_get_section_position('blaize_testimonial_section'),
				'title' => esc_html__( 'Testimonial Section', 'blaize-companion' ),
				'panel' => 'blaize_home_panel',
			) );

			/** Enable Section **/
			$wp_customize->add_setting( 'blaize_enable_testimonial_section', array( 'default' => false, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
			$wp_customize->add_control( 'blaize_enable_testimonial_section', array(
					'type' => 'checkbox',
					'section' => 'blaize_testimonial_section',
					'label' => esc_html__('Enable Section', 'blaize-companion'),
					'description' => esc_html__( 'Check to Enable the section.', 'blaize-companion' ),
				)
			);

			/** Testimonial Section Layout **/
		    $wp_customize->add_setting('blaize_testimonial_layout',array( 'default' => 'layout1', 'sanitize_callback' => 'sanitize_text_field' ));
		    $wp_customize->add_control( 'blaize_testimonial_layout', array(
		        'label'    => esc_html__( 'Layout', 'blaize-companion' ),
		        'section'  => 'blaize_testimonial_section',
		        'type'     => 'select',
		        'choices' => array(
		        	'layout1' => esc_html__( 'Layout 1', 'blaize-companion' ),
		        	'layout2' => esc_html__( 'Layout 2', 'blaize-companion' ),
		        ),
		    ) );

			/** Section Title **/
			$wp_customize->add_setting( 'blaize_testimonial_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_testimonial_title', array(
					'type' => 'text',
					'section' => 'blaize_testimonial_section',
					'label' => esc_html__('Section Title', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Title.', 'blaize-companion' ),
				)
			);

			/** Section Subtitle **/
			$wp_customize->add_setting( 'blaize_testimonial_desc_text', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
			$wp_customize->add_control( 'blaize_testimonial_desc_text', array(
					'type' => 'textarea',
					'section' => 'blaize_testimonial_section',
					'label' => esc_html__('Section Subtitle', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Description Text.', 'blaize-companion' ),
				)
			);

	        /* Testimonial Background */
				/** Background Color **/
			    $wp_customize->add_setting( 'blaize_testimonial_bg_color', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_hex_color' ) );
			    $wp_customize->add_control(
			       new WP_Customize_Color_Control(
			           $wp_customize,
			           'blaize_testimonial_bg_color',
			           array(
			               'label'=>esc_html__('Section Background Color','blaize-companion'),
			               'description' => esc_html__('Set the background color for the section.', 'blaize-companion'),
			               'section'    => 'blaize_testimonial_section',
			               'settings'   => 'blaize_testimonial_bg_color',
			           )
			       )
			    );

			    /* Background Image */
			    $wp_customize->add_setting('blaize_testimonial_bg_img',array( 'sanitize_callback' => 'esc_url_raw' ));
			    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_testimonial_bg_img', array(
			           'label'      => esc_html__( 'Background Image', 'blaize-companion' ),
			           'description' => esc_html__('Set the Background Image for the section.', 'blaize-companion'),
			           'section'    => 'blaize_testimonial_section',
			        )
			    ) );

			    /** Background Image Position **/
			    $wp_customize->add_setting( 'blaize_testimonial_bg_position_x', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_setting( 'blaize_testimonial_bg_position_y', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'blaize_testimonial_bg_position', array(
			                'label'           => esc_html__( 'Background Position', 'blaize-companion' ),
			                'section'         => 'blaize_testimonial_section',
			                'settings'        => array(
			                    'x' => 'blaize_testimonial_bg_position_x',
			                    'y' => 'blaize_testimonial_bg_position_y',
			                ),
			                
			            )
			        )
			    );

			    /** Background Repeat **/
			    $wp_customize->add_setting('blaize_testimonial_bg_repeat',array( 'default' => 'no-repeat', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_testimonial_bg_repeat', array(
			        'label'    => esc_html__( 'Background Repeat', 'blaize-companion' ),
			        'section'  => 'blaize_testimonial_section',
			        'type'     => 'select',
			        'choices' => $bg_repeat,
			    ) );

			    /** Background Size **/
			    $wp_customize->add_setting('blaize_testimonial_bg_size',array( 'default' => 'cover', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_testimonial_bg_size', array(
			        'label'    => esc_html__( 'Background Size', 'blaize-companion' ),
			        'section'  => 'blaize_testimonial_section',
			        'type'     => 'select',
			        'choices' => $bg_size,
			    ) );

			    /** Background Attachment **/
			    $wp_customize->add_setting('blaize_testimonial_bg_attachment',array( 'default' => 'scroll', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_testimonial_bg_attachment', array(
			        'label'    => esc_html__( 'Background Attachment', 'blaize-companion' ),
			        'section'  => 'blaize_testimonial_section',
			        'type'     => 'select',
			        'choices' => $bg_attachment,
			    ) );

        /** Blog Section **/
        	$wp_customize->add_section( 'blaize_blog_section' , array(
        		'priority' => blaize_get_section_position('blaize_blog_section'),
        		'priority' => blaize_get_section_position('blaize_blog_section'),
				'title' => esc_html__( 'Blog Section', 'blaize-companion' ),
				'panel' => 'blaize_home_panel',
			) );

			/** Enable Section **/
			$wp_customize->add_setting( 'blaize_enable_blog_section', array( 'default' => false, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
			$wp_customize->add_control( 'blaize_enable_blog_section', array(
					'type' => 'checkbox',
					'section' => 'blaize_blog_section',
					'label' => esc_html__('Enable Section', 'blaize-companion'),
					'description' => esc_html__( 'Check to Enable the section.', 'blaize-companion' ),
				)
			);

			/** Section Title **/
			$wp_customize->add_setting( 'blaize_blog_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_blog_title', array(
					'type' => 'text',
					'section' => 'blaize_blog_section',
					'label' => esc_html__('Section Title', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Title.', 'blaize-companion' ),
				)
			);

			/** Section Subtitle **/
			$wp_customize->add_setting( 'blaize_blog_desc_text', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_nohtml' ) );
			$wp_customize->add_control( 'blaize_blog_desc_text', array(
					'type' => 'textarea',
					'section' => 'blaize_blog_section',
					'label' => esc_html__('Section Subtitle', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Description Text.', 'blaize-companion' ),
				)
			);

			/** Blog Exclude Category **/
			$wp_customize->add_setting( 'blaize_blog_exclude_category', array( 'default' => 0, 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( new Blaize_Companion_Multiple_Category( $wp_customize, 'blaize_blog_exclude_category', array(
	            'label'   => esc_html__('Blog Exclude Category', 'blaize-companion'),
	            'description'   => esc_html__('Select Categories to exclude from the Blog Section.', 'blaize-companion'),
	            'type' => 'multiple-category',
	            'section' => 'blaize_blog_section',
	            'settings'   => 'blaize_blog_exclude_category',
	        ) ) );
            
            /** Number of Post **/
			$wp_customize->add_setting( 'blaize_blog_no_of_post', array( 'default' => 3, 'sanitize_callback' => 'blaize_sanitize_number_absint' ) );
			$wp_customize->add_control( 'blaize_blog_no_of_post', array(
					'type' => 'number',
					'section' => 'blaize_blog_section',
					'label' => esc_html__('Number of Post', 'blaize-companion'),
					'description' => esc_html__( 'Set the number of posts to display.', 'blaize-companion' ),
				)
			);

	        /** Excerpt Length **/
			$wp_customize->add_setting( 'blaize_blog_excerpt_length', array( 'default' => 120, 'sanitize_callback' => 'blaize_sanitize_number_absint' ) );
			$wp_customize->add_control( 'blaize_blog_excerpt_length', array(
					'type' => 'number',
					'section' => 'blaize_blog_section',
					'label' => esc_html__('Excerpt Length ( Character )', 'blaize-companion'),
					'description' => esc_html__( 'Set the excerpt length for blog text.', 'blaize-companion' ),
				)
			);

			/** Readmore Text **/
			$wp_customize->add_setting( 'blaize_blog_readmore_text', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_blog_readmore_text', array(
					'type' => 'text',
					'section' => 'blaize_blog_section',
					'label' => esc_html__('Readmore Text', 'blaize-companion'),
					'description' => esc_html__( 'Set the readmore text for the blog post.', 'blaize-companion' ),
				)
			);

			/* Blog Background */
				/** Background Color **/
			    $wp_customize->add_setting( 'blaize_blog_bg_color', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_hex_color' ) );
			    $wp_customize->add_control(
			       new WP_Customize_Color_Control(
			           $wp_customize,
			           'blaize_blog_bg_color',
			           array(
			               'label'=>esc_html__('Section Background Color','blaize-companion'),
			               'description' => esc_html__('Set the background color for the section.', 'blaize-companion'),
			               'section'    => 'blaize_blog_section',
			               'settings'   => 'blaize_blog_bg_color',
			           )
			       )
			    );

			    /* Background Image */
			    $wp_customize->add_setting('blaize_blog_bg_img',array( 'sanitize_callback' => 'esc_url_raw' ));
			    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_blog_bg_img', array(
			           'label'      => esc_html__( 'Background Image', 'blaize-companion' ),
			           'description' => esc_html__('Set the Background Image for the section.', 'blaize-companion'),
			           'section'    => 'blaize_blog_section',
			        )
			    ) );

			    /** Background Image Position **/
			    $wp_customize->add_setting( 'blaize_blog_bg_position_x', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_setting( 'blaize_blog_bg_position_y', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'blaize_blog_bg_position', array(
			                'label'           => esc_html__( 'Background Position', 'blaize-companion' ),
			                'section'         => 'blaize_blog_section',
			                'settings'        => array(
			                    'x' => 'blaize_blog_bg_position_x',
			                    'y' => 'blaize_blog_bg_position_y',
			                ),
			                
			            )
			        )
			    );

			    /** Background Repeat **/
			    $wp_customize->add_setting('blaize_blog_bg_repeat',array( 'default' => 'no-repeat', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_blog_bg_repeat', array(
			        'label'    => esc_html__( 'Background Repeat', 'blaize-companion' ),
			        'section'  => 'blaize_blog_section',
			        'type'     => 'select',
			        'choices' => $bg_repeat,
			    ) );

			    /** Background Size **/
			    $wp_customize->add_setting('blaize_blog_bg_size',array( 'default' => 'cover', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_blog_bg_size', array(
			        'label'    => esc_html__( 'Background Size', 'blaize-companion' ),
			        'section'  => 'blaize_blog_section',
			        'type'     => 'select',
			        'choices' => $bg_size,
			    ) );

			    /** Background Attachment **/
			    $wp_customize->add_setting('blaize_blog_bg_attachment',array( 'default' => 'scroll', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_blog_bg_attachment', array(
			        'label'    => esc_html__( 'Background Attachment', 'blaize-companion' ),
			        'section'  => 'blaize_blog_section',
			        'type'     => 'select',
			        'choices' => $bg_attachment,
			    ) );

		/** Partners Section **/
			/** Enable Section **/
			$wp_customize->add_setting( 'blaize_enable_partners_section', array( 'default' => false, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
			$wp_customize->add_control( 'blaize_enable_partners_section', array(
					'type' => 'checkbox',
					'section' => 'blaize_partners_section',
					'label' => esc_html__('Enable Section', 'blaize-companion'),
					'description' => esc_html__( 'Check to Enable the section.', 'blaize-companion' ),
				)
			);

			$wp_customize->add_section( 'blaize_partners_section' , array(
				'priority' => blaize_get_section_position('blaize_partners_section'),
				'title' => esc_html__( 'Partners Section', 'blaize-companion' ),
				'panel' => 'blaize_home_panel',
			) );

			/** Section Title **/
			$wp_customize->add_setting( 'blaize_partner_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( 'blaize_partner_title', array(
					'type' => 'text',
					'section' => 'blaize_partners_section',
					'label' => esc_html__('Section Title', 'blaize-companion'),
					'description' => esc_html__( 'Set Section Title.', 'blaize-companion' ),
				)
			);


			/** Services **/
			$wp_customize->add_setting( 'blaize_partners', array( 'sanitize_callback' => 'blaize_sanitize_repeater',
			    'default' => json_encode(
			     	array(
			         	array(
				            'partners_logo' => '' ,
				            'partners_link' => ''
			            ),
			     	)
			    )
			) );

			$wp_customize->add_control(  new Blaize_Companion_Repeater_Controler( $wp_customize, 'blaize_partners', 
		        array(
		            'label'   => esc_html__('Manage Partners','blaize-companion'),
		            'section' => 'blaize_partners_section',
		            'settings' => 'blaize_partners',
		            'box_label' => esc_html__('Partners Section','blaize-companion'),
		            'box_add_control' => esc_html__('Add Partner','blaize-companion'),
		        ),
				array (
		        	'partners_logo' => array(
			            'type'        => 'upload',
			            'label'       => esc_html__( 'Set Partner Logo', 'blaize-companion' ),
			            'default'     => '',
			        ),
			        'partners_link' => array(
			            'type'        => 'text',
			            'label'       => esc_html__( 'Partner Link', 'blaize-companion' ),
			            'default'     => '',
			        ),
		        )
			));

			/* Partners Background */
				/** Background Color **/
			    $wp_customize->add_setting( 'blaize_partners_bg_color', array( 'default' => '', 'sanitize_callback' => 'blaize_sanitize_hex_color' ) );
			    $wp_customize->add_control(
			       new WP_Customize_Color_Control(
			           $wp_customize,
			           'blaize_partners_bg_color',
			           array(
			               'label'=>esc_html__('Section Background Color','blaize-companion'),
			               'description' => esc_html__('Set the background color for the section.', 'blaize-companion'),
			               'section'    => 'blaize_partners_section',
			               'settings'   => 'blaize_partners_bg_color',
			           )
			       )
			    );

			    /* Background Image */
			    $wp_customize->add_setting('blaize_partners_bg_img',array( 'sanitize_callback' => 'esc_url_raw' ));
			    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'blaize_partners_bg_img', array(
			           'label'      => esc_html__( 'Background Image', 'blaize-companion' ),
			           'description' => esc_html__('Set the Background Image for the section.', 'blaize-companion'),
			           'section'    => 'blaize_partners_section',
			        )
			    ) );

			    /** Background Image Position **/
			    $wp_customize->add_setting( 'blaize_partners_bg_position_x', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_setting( 'blaize_partners_bg_position_y', array( 'default' => 'center', 'sanitize_callback' => 'esc_html', 'transport' => 'postMessage' ) );
			    $wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'blaize_partners_bg_position', array(
			                'label'           => esc_html__( 'Background Position', 'blaize-companion' ),
			                'section'         => 'blaize_partners_section',
			                'settings'        => array(
			                    'x' => 'blaize_partners_bg_position_x',
			                    'y' => 'blaize_partners_bg_position_y',
			                ),
			                
			            )
			        )
			    );

			    /** Background Repeat **/
			    $wp_customize->add_setting('blaize_partners_bg_repeat',array( 'default' => 'no-repeat', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_partners_bg_repeat', array(
			        'label'    => esc_html__( 'Background Repeat', 'blaize-companion' ),
			        'section'  => 'blaize_partners_section',
			        'type'     => 'select',
			        'choices' => $bg_repeat,
			    ) );

			    /** Background Size **/
			    $wp_customize->add_setting('blaize_partners_bg_size',array( 'default' => 'cover', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_partners_bg_size', array(
			        'label'    => esc_html__( 'Background Size', 'blaize-companion' ),
			        'section'  => 'blaize_partners_section',
			        'type'     => 'select',
			        'choices' => $bg_size,
			    ) );

			    /** Background Attachment **/
			    $wp_customize->add_setting('blaize_partners_bg_attachment',array( 'default' => 'scroll', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_partners_bg_attachment', array(
			        'label'    => esc_html__( 'Background Attachment', 'blaize-companion' ),
			        'section'  => 'blaize_partners_section',
			        'type'     => 'select',
			        'choices' => $bg_attachment,
			    ) );

		/**
		* 
		* Design Settings Panel
		* 
		**/
		$wp_customize->add_panel( 'blaize_design_settings_panel', array(
	  		'title' => esc_html__( 'Design Settings', 'blaize-companion' ),
	  		'priority' => 6,
	  		'description' => esc_html__( 'Configure Basic Layouts and designs in the site.', 'blaize-companion' )
		) );

			/** Blog Page Design **/
			$wp_customize->add_section( 'blaize_blog_page_settings' , array(
				'title' => esc_html__( 'Blog Page Settings', 'blaize-companion' ),
				'panel' => 'blaize_design_settings_panel',
			) );

				/** Blog / Archive Layout **/
			    $wp_customize->add_setting('blaize_blog_layout',array( 'default' => 'big_thumb_layout', 'sanitize_callback' => 'sanitize_text_field' ));
			    $wp_customize->add_control( 'blaize_blog_layout', array(
			        'label'    => esc_html__( 'Layout', 'blaize-companion' ),
			        'section'  => 'blaize_blog_page_settings',
			        'type'     => 'select',
			        'choices' => array(
			        	'big_thumb_layout' => esc_html__( 'Big Thumb Layout', 'blaize-companion' ),
			        	'classic_layout' => esc_html__( 'Classical Layout', 'blaize-companion' ),
			        ),
			    ) );

				/** Excerpt Length **/
				$wp_customize->add_setting( 'blaize_blog_page_excerpt_length', array( 'default' => 450, 'blaize-companion', 'sanitize_callback' => 'absint' ) );	
				$wp_customize->add_control( 'blaize_blog_page_excerpt_length', array(
						'type' => 'text',
						'section' => 'blaize_blog_page_settings',
						'label' => esc_html__( 'Excerpt Length', 'blaize-companion' ),
						'description' => esc_html__( 'Set the Blog Excerpt Length.', 'blaize-companion' ),
					)
				);

				/** Excerpt Length **/
				$wp_customize->add_setting( 'blaize_blog_page_readmore_text', array( 'default' => '', 'blaize-companion', 'sanitize_callback' => 'sanitize_text_field' ) );	
				$wp_customize->add_control( 'blaize_blog_page_readmore_text', array(
						'type' => 'text',
						'section' => 'blaize_blog_page_settings',
						'label' => esc_html__( 'Read More', 'blaize-companion' ),
						'description' => esc_html__( 'Set the Read More Text.', 'blaize-companion' ),
					)
				);

		/**
		* 
		* Design Settings Panel
		* 
		**/
		$wp_customize->add_section( 'blaize_general_settings', array(
	  		'title' => esc_html__( 'General Settings', 'blaize-companion' ),
	  		'priority' => 6,
	  		'description' => esc_html__( 'Configure General Site Settings.', 'blaize-companion' )
		) );

			/** Enable Preloader **/
			$wp_customize->add_setting( 'blaize_enable_preloader', array( 'default' => true, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
			$wp_customize->add_control( 'blaize_enable_preloader', array(
					'type' => 'checkbox',
					'section' => 'blaize_general_settings',
					'label' => esc_html__('Enable Preloader', 'blaize-companion'),
					'description' => esc_html__( 'Check to enable site preloader.', 'blaize-companion' ),
				)
			);

			/** Enable Wow Animation **/
			$wp_customize->add_setting( 'blaize_enable_wow', array( 'default' => true, 'sanitize_callback' => 'blaize_sanitize_checkbox' ) );
			$wp_customize->add_control( 'blaize_enable_wow', array(
					'type' => 'checkbox',
					'section' => 'blaize_general_settings',
					'label' => esc_html__('Enable Wow Animation', 'blaize-companion'),
					'description' => esc_html__( 'Check to enable wow animation in the site.', 'blaize-companion' ),
				)
			);

			/** Template Color **/
			$wp_customize->add_setting( 'blaize_tpl_color', array( 'default' => '#00B0EC', 'sanitize_callback' => 'blaize_sanitize_hex_color' ) );
			$wp_customize->add_control( new Blaize_Companion_Radio_Image_Select( $wp_customize, 'blaize_tpl_color', array(
	            'label'   => esc_html__('Template Color', 'blaize-companion'),
	            'description'   => esc_html__('Choose Template Color.', 'blaize-companion'),
	            'type' => 'radio-image',
	            'section' => 'blaize_general_settings',
	            'settings'   => 'blaize_tpl_color',
	            'choices' => array(
	            	'#00B147' => BLAIZE_COMPANION_DIR . '/customizer/assets/images/green.png',
	            	'#00B0EC' => BLAIZE_COMPANION_DIR . '/customizer/assets/images/blue.png',
	            	'#009687' => BLAIZE_COMPANION_DIR . '/customizer/assets/images/teal.png',
	            	'#FF5607' => BLAIZE_COMPANION_DIR . '/customizer/assets/images/deep-orange.png',
	            ),
	        ) ) );

		/** Footer Section **/
		$wp_customize->add_section( 'blaize_footer_section' , array(
			'title' => esc_html__( 'Footer Settings', 'blaize-companion' ),
		) );

			/** Footer Copyright Text **/
			$wp_customize->add_setting( 'blaize_footer_text', array( 'default' => '', 'blaize-companion', 'sanitize_callback' => 'wp_kses_post' ) );
			$wp_customize->add_control( 'blaize_footer_text', array(
					'type' => 'textarea',
					'section' => 'blaize_footer_section',
					'label' => esc_html__('Footer Custom Text', 'blaize-companion'),
					'description' => esc_html__( 'Set the Custom Footer Text.', 'blaize-companion' ),
				)
			);

	}
	add_action( 'customize_register', 'blaize_customizer_register' );
