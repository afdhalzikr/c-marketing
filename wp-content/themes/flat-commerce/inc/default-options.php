<?php
/**
 * Implement Default Theme/Customizer Options
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
 * Returns the default options for flat-commerce.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_get_default_theme_options() {

	$theme_data = wp_get_theme();

	$default_theme_options = array(
		//Site Title an Tagline
		'move_title_tagline'                         => 0,
		'background_color'                         	=>'#fff',

		//Layout
		'theme_layout'                               => 'right-sidebar',
		'woocommerce_layout'                         => 'right-sidebar',

		//Header Image
		'enable_featured_header_image'               => 'disabled',
		'featured_header_image_position'             => 'before-menu',
		'featured_image_size'                        => 'full',
		'featured_header_image_url'                  => '',
		'featured_header_image_alt'                  => '',
		'featured_header_image_base'                 => 0,

		//Comment Options
		'disable_notes'                              => 0,
		'disable_website_field'                      => 0,
		'enable_topbar'								 => true,
		'topbar_contact'							 => '123456789',
		'topbar_location'							 => __( 'Jawalakhel,Lalitpur','flat-commerce' ),
		'enable_frontpage_content'					 => true,
		

		//Custom CSS
		'custom_css'                                 => '',
		//breadcrumb option
		'breadcrumb_option'							 => 0,
		//Single Post Navigation
		'disable_single_post_navigation'             => 0,

		//Header Right Sidebar Options
		'disable_header_right_sidebar'               => 0,

		//Homepage / Static Frontpage Settings
		'latest_blog_heading'                        => __( 'Latest Blog', 'flat-commerce' ),
		'front_page_category'                        => array(),
		'enable_blog_section'                        => false,

		// Pagination options
		'pagination_type'										=>'older-newer',

		//Promotion Headline Options
		'promotion_headline_option'                  => 'homepage',
		'promotion_headline_left_width'              => '80',
		'promotion_headline'                         => __( 'You can edit from Appearance->Customize->Promotional Headline', 'flat-commerce' ),
		'promotion_subheadline'                      => __( 'Promotional headline', 'flat-commerce' ),
		'promotion_headline_button'                  => __( 'Buy Now', 'flat-commerce' ),
		'promotion_headline_url'                     => esc_url( 'http://themepalace.com/' ),
		'promotion_headline_target'                  => 1,

		//Responsive Options
		'footer_mobile_menu_disable'                 => 1,

		//Search Options
		'search_text'                                => __( 'Search...', 'flat-commerce' ),

		//Feed Redirect
		'feed_redirect'                              => '',

		'latest_blog_content_type'                   => 'demo-latest-blog-content',
		'latest_blog_content_url_option'             => false,

		// bottom section options
		'bottom_section_title'                       => __( 'BOTTOM CONTENT', 'flat-commerce' ),
		'bottom_section_sub_title'                   => __( 'This is the bottom section.  You can edit by going to Appearance->Customize->Bottom Section.', 'flat-commerce' ) ,
		'bottom_section_enable_option'               => 'homepage',
		'bottom_section_read_more_link_to'           => '',

		//Featured Slider Options
		'featured_slider_option'                     => 'homepage',
		'featured_slider_image_loader'               => 'true',
		'featured_slide_transition_effect'           => 'fadeout',
		'featured_slide_transition_delay'            => '4',
		'featured_slide_transition_length'           => '1',
		'featured_slide_loop'                        => 'infinite',
		'featured_slider_type'                       => 'demo-featured-slider',
		'featured_slide_number'                      => '4',
		'featured_slider_select_category'            => array(),
		'exclude_slider_post'                        => 0,

		//Product Slider Options
		'product_slider_option'                      => 'homepage',
		'product_slider_type_select'                 => 'demo-product-slider',
		'product_slider_categories_select'           => array(),
		'product_slider_no_of_tabs'                  => '3',
		'product_slider_layout_option'               => '3',
		'product_slider_no_of_products_for_category' => '6',

		//Product Slider Controls
		'product_slide_transition_effect'            => 'scrollHorz',
		'product_slide_transition_delay'             => '1',
		'product_slide_transition_length'            => '1',

		//Recent Products Options
		'recent_products_option'                     => 'homepage',
		'recent_products_title'                      => __( 'Recent Products', 'flat-commerce' ),
		'recent_products_option_select'              => 'recent-product-demo',

		//Social Links
		'social_icon_size'                           => '20',
		'custom_social_icons'                        => '1',

		//scrollup
		'disable_scrollup'							 => 0,

		//Reset all settings
		'reset_all_settings'                         => 0,
	);

	return apply_filters( 'flat_commerce_default_theme_options', $default_theme_options );
}

/**
 * Returns an array of feature header enable options
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_enable_featured_header_image_options() {
	$enable_featured_header_image_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Static Frontpage', 'flat-commerce' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_enable_featured_header_image_options', $enable_featured_header_image_options );
}

/**
 * Returns an array of content and slider layout options registered for flat-commerce.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_featured_slider_content_options() {
	$featured_slider_content_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Static Frontpage', 'flat-commerce' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_featured_slider_content_options', $featured_slider_content_options );
}

/**
 * Returns an array of feature slider types registered for flat-commerce.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_featured_slider_types() {
	$featured_slider_types = array(
		'demo-featured-slider' => array(
			'value' => 'demo-featured-slider',
			'label' => __( 'Demo Featured Slider', 'flat-commerce' ),
		),

		'featured-page-slider' => array(
			'value' => 'featured-page-slider',
			'label' => __( 'Featured Page Slider', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_featured_slider_types', $featured_slider_types );
}


/**
 * Returns an array of feature slider transition effects
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_featured_slide_transition_effects() {
	$featured_slide_transition_effects = array(
		'fade' 		=> array(
			'value'	=> 'fade',
			'label' => __( 'Fade', 'flat-commerce' ),
		),
		'fadeout' 	=> array(
			'value'	=> 'fadeout',
			'label' => __( 'Fade Out', 'flat-commerce' ),
		),
		'none' 		=> array(
			'value' => 'none',
			'label' => __( 'None', 'flat-commerce' ),
		),
		'scrollHorz'=> array(
			'value' => 'scrollHorz',
			'label' => __( 'Scroll Horizontal', 'flat-commerce' ),
		),
		'scrollVert'=> array(
			'value' => 'scrollVert',
			'label' => __( 'Scroll Vertical', 'flat-commerce' ),
		),
		'flipHorz'	=> array(
			'value' => 'flipHorz',
			'label' => __( 'Flip Horizontal', 'flat-commerce' ),
		),
		'flipVert'	=> array(
			'value' => 'flipVert',
			'label' => __( 'Flip Vertical', 'flat-commerce' ),
		),
		'tileSlide'	=> array(
			'value' => 'tileSlide',
			'label' => __( 'Tile Slide', 'flat-commerce' ),
		),
		'tileBlind'	=> array(
			'value' => 'tileBlind',
			'label' => __( 'Tile Blind', 'flat-commerce' ),
		),
		'shuffle'	=> array(
			'value' => 'shuffle',
			'label' => __( 'Suffle', 'flat-commerce' ),
		)
	);

	return apply_filters( 'flat_commerce_featured_slide_transition_effects', $featured_slide_transition_effects );
}


/**
 * Returns an array of comment options for flat-commerce.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_comment_options() {
	$comment_options = array(
		'use-wordpress-setting' => array(
			'value' => 'use-wordpress-setting',
			'label' => __( 'Use WordPress Setting', 'flat-commerce' ),
		),
		'disable-in-pages' => array(
			'value' => 'disable-in-pages',
			'label' => __( 'Disable in Pages', 'flat-commerce' ),
		),
		'disable-completely' => array(
			'value' => 'disable-completely',
			'label' => __( 'Disable Completely', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_comment_options', $comment_options );
}


/**
 * Returns list of social icons currently supported
 *
 * @since Flat Commerce 0.1
*/
function flat_commerce_get_social_icons_list() {
	$flat_commerce_social_icons_list = array(
		'facebook_link'		=> array(
			'genericon_class' 	=> 'facebook-alt',
			'label' 			=> esc_html__( 'Facebook', 'flat-commerce' )
			),
		'twitter_link'		=> array(
			'genericon_class' 	=> 'twitter',
			'label' 			=> esc_html__( 'Twitter', 'flat-commerce' )
			),
		'googleplus_link'	=> array(
			'genericon_class' 	=> 'googleplus-alt',
			'label' 			=> esc_html__( 'Googleplus', 'flat-commerce' )
			),
		'youtube_link'		=> array(
			'genericon_class' 	=> 'youtube',
			'label' 			=> esc_html__( 'YouTube', 'flat-commerce' )
			),
	);

	return apply_filters( 'flat_commerce_social_icons_list', $flat_commerce_social_icons_list );
}


/**
 * Checks if there are options already present from flat-commerce free version and adds it to the flat-commerce Pro theme options
 *
 * @since Flat Commerce 0.1
 * @hook after_theme_switch
 */
function flat_commerce_setup_options() {
	//Perform action only if theme_mods_flat-commerce-pro[flat_commerce_theme_options] does not exist
	if( !get_theme_mod( 'flat_commerce_theme_options' ) ) {
		//Perform action only if theme_mods_flat-commerce free version exists
		if ( $flat_commerce_free_options = get_option ( 'theme_mods_flat-commerce' ) ) {
			if ( isset( $flat_commerce_free_options['flat_commerce_theme_options'] ) ) {
				$flat_commerce_pro_default_options = flat_commerce_get_default_theme_options();

				$flat_commerce_theme_options = $flat_commerce_free_options;

				$flat_commerce_theme_options['flat_commerce_theme_options'] = array_merge( $flat_commerce_pro_default_options , $flat_commerce_free_options['flat_commerce_theme_options'] );

				update_option( 'theme_mods_flat-commerce-pro', $flat_commerce_theme_options );
			}
		}
	}
}

add_action('after_switch_theme', 'flat_commerce_setup_options');

//Product Slider Options

function flat_commerce_get_product_slider_content_options() {
	/**

	* Options to display product slider in homepage or entire site or disable

	*

	* @since Flat Commerce 0.1

	* @hook flat_commerce_product_slider_content_options

	*/
	$product_slider_content_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Static Frontpage', 'flat-commerce' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_product_slider_content_options', $product_slider_content_options );
}

//Product Slider Type Select
function flat_commerce_get_product_slider_type() {
	$product_slider_type = array(
		'demo-product-slider' => array(
			'value'	=> 'demo-product-slider',
			'label' => __( 'Demo Product Slider', 'flat-commerce' ),
		),
		'category-product-slider' => array(
			'value' => 'category-product-slider',
			'label' => __( 'Category Product Slider', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_product_slider_type', $product_slider_type );
}

//Recent Products Content Options
function flat_commerce_get_recent_products_options() {
	$recent_products_content_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Static Frontpage', 'flat-commerce' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_product_slider_content_options', $recent_products_content_options );
}

// Latest Blog options
function flat_commerce_latest_blog_content_options() {
	$latest_blog_content_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Static Frontpage', 'flat-commerce' ),
		),
		'entire-site' 	=> array(
			'value' => 'entire-site',
			'label' => __( 'Entire Site', 'flat-commerce' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_product_slider_content_options', $latest_blog_content_options );
}

/**
 * Returns an array of latest blog content types registered for flat-commerce.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_latest_blog_content_types() {
	$latest_blog_content_types = array(
		'demo-latest-blog-content' => array(
			'value' => 'demo-latest-blog-content',
			'label' => __( 'Demo Content', 'flat-commerce' ),
		),
		'latest-blog-post-content' => array(
			'value' => 'latest-blog-post-content',
			'label' => __( 'Post Content', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_latest_blog_content_types', $latest_blog_content_types );
}



//Product Slider Slider Type Select
function flat_commerce_get_product_slider_type_select() {
	$product_slider_type_select = array(
		'demo-product-slider' => array(
			'value'	=> 'demo-product-slider',
			'label' => __( 'Demo Product Slider', 'flat-commerce' ),
		),
		'category-product-slider' => array(
			'value' => 'category-product-slider',
			'label' => __( 'Category Product Slider', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_product_slider_type_select', $product_slider_type_select );
}

//Recent Products Content Layout Options

function flat_commerce_get_recent_products_type_select() {
	$recent_products_type_select = array(
		'recent-product-demo' => array(
			'value'	=> 'recent-product-demo',
			'label' => __( 'Demo Recent Products', 'flat-commerce' ),
		),

		'recent-product-featured' => array(
			'value' => 'recent-product-featured',
			'label' => __( 'Recent Products', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_recent_products_type_select', $recent_products_type_select );
}


/** Bottom section options */
// Enable options
function flat_commerce_bottom_section_enable_options() {
	$bottom_section_enable_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Static Frontpage', 'flat-commerce' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'flat-commerce' ),
		),
	);

	return apply_filters( 'flat_commerce_product_slider_content_options', $bottom_section_enable_options );
}


/**
 * List of pagination types
 * @return array Pagination types
 * @since Flat Commerce 0.7
 */
function flat_commerce_pagination_type() {
	$flat_commerce_pagination_type = array(
		'numeric'     => 'Numeric',
		'older-newer' => 'Older/Newer',
	);

	$output = apply_filters( 'flat_commerce_pagination_type', $flat_commerce_pagination_type );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}