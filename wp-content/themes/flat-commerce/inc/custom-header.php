<?php
/**
 * Implement Custom Header functionality
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


if ( ! function_exists( 'flat_commerce_custom_header' ) ) :
/**
 * Implementation of the Custom Header feature
 * Setup the WordPress core custom header feature and default custom headers packaged with the theme.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
	function flat_commerce_custom_header() {

		/**
		 * Get Theme Options Values
		 */
		$options 	= flat_commerce_get_theme_options();

		$args = array(
		'default-text-color'		=> '000',
		// Header image default
		'default-image'			=> get_template_directory_uri() . '/images/headers/header-img.png',

		// Set height and width, with a maximum value for the width.
		'height'                 => 400,
		'width'                  => 1200,

		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,

		// Random image rotation off by default.
		'random-default'         => false,
	);

	// Add support for custom header
	add_theme_support( 'custom-header', $args );

	}
endif; // flat_commerce_custom_header
add_action( 'after_setup_theme', 'flat_commerce_custom_header' );


if ( ! function_exists( 'flat_commerce_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_admin_header_style() {
	$options 	= flat_commerce_get_theme_options();

	$defaults 	= flat_commerce_get_default_theme_options();
?>
	<style type="text/css">
	body {
		color: #404040;
		font-family: sans-serif;
		font-size: 15px;
		line-height: 1.5;
	}
	#site-logo,
	#site-header {
	    display: inline-block;
	    float: left;
	}
	#site-branding .site-title {
		font-size: 40px;
    	font-weight: bold;
    	line-height: 1.2;
    	margin: 0;
	}
	#site-branding .site-title a {
		color: #404040;
		text-decoration: none;
	}
	#site-branding .site-description {
		color: #404040;
		font-size: 13px;
		line-height: 1.2;
		font-style: italic;
		padding: 0;
	}
	.logo-left #site-header {
		padding-left: 10px;
	}
	.logo-right #site-header {
		padding-right: 10px;
	}
	#header-featured-image {
		clear: both;
		padding-top: 20px;
		max-width: 90%;
	}
	#header-featured-image img {
		height: auto;
		max-width: 100%;
	}
	</style>
<?php
}
endif; // flat_commerce_admin_header_style


if ( ! function_exists( 'flat_commerce_admin_header_image' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_admin_header_image() {

	flat_commerce_site_branding();
	flat_commerce_featured_image();
?>

<?php
}
endif; // flat_commerce_admin_header_image

if ( ! function_exists( 'flat_commerce_site_branding' ) ) :
	/**
	 * Get the logo and display
	 *
	 * @uses get_transient, flat_commerce_get_theme_options, get_header_textcolor, get_bloginfo, set_transient, display_header_text
	 * @get logo from options
	 *
	 * @display logo
	 *
	 * @action
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_site_branding() {
		$options  = flat_commerce_get_theme_options(); //get theme options from customizer
		$flat_commerce_site_logo = '';
		if ( has_custom_logo() ) {
			$flat_commerce_site_logo = '<div id="site-logo">'.get_custom_logo().'</div><!-- #site-logo -->';
		}

		$flat_commerce_header_text = '
		<div id="site-header-text">
			<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a></h1>
			<h2 class="site-description">' . esc_html( get_bloginfo( 'description' ) ) . '</h2>
		</div><!-- #site-header -->';


		if ( ! $options['move_title_tagline'] ) {
			$flat_commerce_site_branding  = '<div class="col col-3-of-10"><div id="site-branding" class="logo-left">';
			$flat_commerce_site_branding .= $flat_commerce_site_logo;
			$flat_commerce_site_branding .= $flat_commerce_header_text;
		}
		else {
			$flat_commerce_site_branding  = '<div class="col col-3-of-10"><div id="site-branding" class="logo-right">';
			$flat_commerce_site_branding .= $flat_commerce_header_text;
			$flat_commerce_site_branding .= $flat_commerce_site_logo;
		}



		$flat_commerce_site_branding 	.= '</div><!-- #site-branding--></div><!-- .col -->';

		echo $flat_commerce_site_branding ;
	}
endif; // flat_commerce_site_branding
add_action( 'flat_commerce_header', 'flat_commerce_site_branding', 40 );


if ( ! function_exists( 'flat_commerce_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own flat_commerce_featured_image(), and that function will be used instead.
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_featured_image() {
		$options      = flat_commerce_get_theme_options();

		$header_image = get_header_image();

		//Support Random Header Image
		if ( is_random_header_image() ) {
			delete_transient( 'flat_commerce_featured_image' );
		}

		if ( !$flat_commerce_featured_image = get_transient( 'flat_commerce_featured_image' ) ) {

			echo '<!-- refreshing cache -->';

			if ( $header_image != '' ) {

				// Header Image Link and Target
				if ( !empty( $options[ 'featured_header_image_url' ] ) ) {
					//support for qtranslate custom link
					if ( function_exists( 'qtrans_convertURL' ) ) {
						$link = qtrans_convertURL($options[ 'featured_header_image_url' ]);
					}
					else {
						$link = esc_url( $options[ 'featured_header_image_url' ] );
					}
				}
				else {
					$link = '';
				}

				// Header Image Title/Alt
				if ( !empty( $options[ 'featured_header_image_alt' ] ) ) {
					$title = esc_attr( $options[ 'featured_header_image_alt' ] );
				}
				else {
					$title = '';
				}

				// Header Image
				$feat_image = '<img class="wp-post-image" alt="'.$title.'" title="'.$title.'" src="'.esc_url(  $header_image ).'" />';

				$flat_commerce_featured_image = '<div id="header-featured-image">';
				// Header Image Link
				if ( !empty( $options[ 'featured_header_image_url' ] ) ) :
					$flat_commerce_featured_image .=
						'<a title="'. esc_attr( $title ).'" href="'. esc_url( $link ) .'">
							<div class="custom-header-wrapper">' . $feat_image . '</div><!-- .custom-header-wrapper -->
						</a>';
				else:
					// if empty featured_header_image on theme options, display default
					$flat_commerce_featured_image .= $feat_image;
				endif;

				$flat_commerce_featured_image .= '</div><!-- #header-featured-image -->';
			}

			set_transient( 'flat_commerce_featured_image', $flat_commerce_featured_image, 86940 );
		}

		echo $flat_commerce_featured_image;

	} // flat_commerce_featured_image
endif;


if ( ! function_exists( 'flat_commerce_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own flat_commerce_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_featured_overall_image() {
		global $post, $wp_query;
		$options				= flat_commerce_get_theme_options();
		$defaults 				= flat_commerce_get_default_theme_options();
		$enableheaderimage 		= $options['enable_featured_header_image'];
		$page_on_front  = get_option( 'page_on_front' ) ;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Check Homepage
		if ( $enableheaderimage == 'homepage' ) {
			if ( $page_id == $page_on_front && $page_id > 0  ) {
				flat_commerce_featured_image();
			}
		}
		else {
			echo '<div class="container no-custom-header">'.'</div>';
			echo '<!-- Disable Header Image -->';
		}
	} // flat_commerce_featured_overall_image
endif;


if ( ! function_exists( 'flat_commerce_featured_image_display' ) ) :
	/**
	 * Display Featured Header Image
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_featured_image_display() {
		$options = flat_commerce_get_theme_options();

		if ( class_exists( 'WooCommerce' ) && ( is_product() ) ) {
			/* return if woocommerce is active and is shop page or single product page*/
			return;
		}
		add_action( 'flat_commerce_header', 'flat_commerce_featured_overall_image', 20 );
	} // flat_commerce_featured_image_display
endif;

add_action( 'flat_commerce_before_wp_head', 'flat_commerce_featured_image_display' );