<?php
/**
 * Core functions and definitions
 *
 * Sets up the theme
 *
 * The first function, flat_commerce_initial_setup(), sets up the theme by registering support
 * for various features in WordPress, such as theme support, post thumbnails, navigation menu, and the like.
 *
 * flatcommerce functions and definitions
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




if ( ! function_exists( 'flat_commerce_content_width' ) ) :
    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * Priority 0 to make it available to lower priority callbacks.
     *
     * @global int $content_width
     */
    function flat_commerce_content_width() {
        $content_width = 780; /* pixels */

        $GLOBALS['content_width'] = apply_filters( 'flat_commerce_content_width', $content_width );
    }
endif;
add_action( 'after_setup_theme', 'flat_commerce_content_width', 0 );

if ( ! function_exists( 'flat_commerce_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function flat_commerce_setup() {
		/**
		 * Get Theme Options Values
		 */
		$options 	= flat_commerce_get_theme_options();
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on flatcommerce, use a find and replace
		 * to change 'flat-commerce' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'flat-commerce', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'custom-logo', array(
			'flex-height' => true,
			'flex-width'  => true,
		) );

		$defaults = array(
			'default-color'          => '#ffff',
			'default-image'          => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		);
		add_theme_support( 'custom-background', $defaults );


		// Add Flat Commerce's custom image sizes
		add_image_size( 'flat-commerce-slider', 1350, 560, true ); // Used for Featured slider Ratio 21:9

		add_image_size( 'flat-commerce-latest-blog', 270, 270, true ); // used in Latest Blog

		//Archive Images
		add_image_size( 'flat-commerce-featured', 860, 484, true); // used in Archive Top Ratio 16:9

		//Product slider image size
		add_image_size( 'flat-commerce-product-slider', 300, 340, true ); // used in Product Slider

		//Recent Products image size
		add_image_size( 'flat-commerce-recent-product', 250, 320, true ); // used in Recent Products


		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' 	=> __( 'Primary Menu', 'flat-commerce' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Setup Editor style
		 */
		add_editor_style( 'css/editor-style.css' );

		/**
		 * Setup title support for theme
		 * Supported from WordPress version 4.1 onwards
		 * More Info: https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
		 */
		add_theme_support( 'title-tag' );
	}
endif; // flat_commerce_setup
add_action( 'after_setup_theme', 'flat_commerce_setup' );

/**
 * Register custom fonts.
 */
function flat_commerce_fonts_url() {
	$fonts_url = '';

	$font_families = array();

	$font_families[] = 'Roboto Slab:300,400,700';
	$font_families[] = 'Nunito Sans:300,400,600,700';

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}

if ( ! function_exists( 'flat_commerce_scripts' ) ) :

	/**
	 * Enqueue scripts and styles
	 *
	 * @uses  wp_register_script, wp_enqueue_script, wp_register_style, wp_enqueue_style, wp_localize_script
	 * @action wp_enqueue_scripts
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_scripts() {
		$options = flat_commerce_get_theme_options();

		// Add custom fonts, used in the main stylesheet.
		wp_enqueue_style( 'flat-commerce-fonts', flat_commerce_fonts_url(), array(), null );

		wp_enqueue_style( 'flat-commerce-style', get_stylesheet_uri(), 'flat-commerce-fonts', FLAT_COMMERCE_THEME_VERSION );

		wp_enqueue_style( 'flat-commerce-responsive', get_template_directory_uri() . '/css/responsive.css', 'flat-commerce-fonts', FLAT_COMMERCE_THEME_VERSION );

		wp_enqueue_script( 'flat-commerce-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20120206', true );

		wp_enqueue_script( 'flat-commerce-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );

		/**
		 * Adds JavaScript to pages with the comment form to support
		 * sites with threaded comments (when in use).
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		//For genericons
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/css/genericons/genericons.css', false, '3.4.1' );

		/**
		 * Loads up Responsive Menu JS and fit vids
		 */
		wp_enqueue_script('sidr', get_template_directory_uri() . '/js/jquery.sidr.min.js', array('jquery'), '1.2.1.1', false );

		/**
		 * Loads up fit vids
		 */
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/fitvids.min.js', array( 'jquery' ), '1.1', true );

		/**
		 * Loads up Cycle JS Featured Slider Section
		 */
		if( $options['featured_slider_option'] != 'disabled' ) {

			wp_register_script( 'jquery-cycle2', get_template_directory_uri() . '/js/jquery-cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );
			wp_enqueue_script( 'jquery-cycle2' );

		}

		/**
		 * Loads up Cycle JS product Slider Section
		 */
		if( $options['product_slider_option'] != 'disabled' ) {
			wp_register_script( 'jquery-cycle2', get_template_directory_uri() . '/js/jquery-cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );
				wp_enqueue_script( 'jquery-cycle2' );
		}

		/**
		 * Loads up Scroll Up script
		 */
		if( $options['disable_scrollup'] == 0 ){
			wp_enqueue_script( 'flat-commerce-scrollup', get_template_directory_uri() . '/js/flat-commerce-scrollup.min.js', array( 'jquery' ), '20072014', true  );
		}

		/**
		 * Enqueue custom script for flatcommerce.
		 */
		wp_enqueue_script( 'flat-commerce-custom-scripts', get_template_directory_uri() . '/js/flat-commerce-custom-scripts.min.js', array( 'jquery' ), null );


		/**
		 * Enqueue meanmenu script for flatcommerce.
		 */
		wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/js/meanmenu.min.js', array( 'jquery' ), null   );

		// Load the html5 shiv.
		wp_enqueue_script( 'flat-commerce-html5', get_template_directory_uri() . '/js/html5.min.js', array() );
		wp_script_add_data( 'flat-commerce-html5', 'conditional', 'lt IE 9' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'flat_commerce_scripts' );


if ( ! function_exists( 'flat_commerce_get_theme_options' ) ) :
	/**
	 * Returns the options array for flatcommerce.
	 * @uses  get_theme_mod
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_get_theme_options() {
		$flat_commerce_default_options = flat_commerce_get_default_theme_options();

		return array_merge( $flat_commerce_default_options , get_theme_mod( 'flat_commerce_theme_options', $flat_commerce_default_options ) ) ;
	}
endif;


/**
 * Default Options.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Default Options.
 */
require get_template_directory() . '/inc/default-options.php';

/**
 * Custom Header.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Structure for flatcommerce
 */
require get_template_directory() . '/inc/structure.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer-includes/customizer-core.php';


/**
 * Custom Menus
 */
require get_template_directory() . '/inc/menus.php';


/**
 * Load Slider file.
 */
require get_template_directory() . '/inc/promotion-headline.php';


/**
 * Load Slider file.
 */
require get_template_directory() . '/inc/featured-slider.php';

if ( class_exists( 'WooCommerce' ) ) {
	/**
	 * Load Product Slider File.
	 */
	require get_template_directory() . '/inc/product-slider.php';


	/**
	 * Load Recent Products.
	 */
	require get_template_directory() . '/inc/recent-products.php';
}

/**
 * Load Latest Blog.
 */
require get_template_directory() . '/inc/bottom-section.php';


/**
 * Load Latest Blog.
 */
require get_template_directory() . '/inc/footer-section.php';

/**
 * Load Latest Blog.
 */
require get_template_directory() . '/inc/breadcrumb.php';

/**
 * Load Widgets and Sidebars
 */
require get_template_directory() . '/inc/widgets-includes/widgets-core.php';


/**
 * Flush out all transients
 *
 * @uses delete_transient
 *
 * @action customize_save, flat_commerce_customize_preview (see flat_commerce_customizer function: flat_commerce_customize_preview)
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_flush_transients(){

	delete_transient( 'flat_commerce_featured_slider' );

	delete_transient( 'flat_commerce_promotion_headline' );

	delete_transient( 'flat_commerce_product_slider' );

	delete_transient( 'flat_commerce_recent_products' );

	delete_transient( 'flat_commerce_latest_blog' );

	delete_transient( 'flat_commerce_featured_product' );

	delete_transient( 'flat_commerce_custom_css' );

	delete_transient( 'flat_commerce_footer_content' );

	delete_transient( 'flat_commerce_featured_image' );

	delete_transient( 'flat_commerce_social_icons' );

	delete_transient( 'flat_commerce_scrollup' );

	delete_transient( 'all_the_cool_cats' );

	delete_transient( 'flat_commerce_bottom_section' );

	//Add flatcommerce default themes if there is no values
	if ( !get_theme_mod('flat_commerce_theme_options') ) {
		set_theme_mod( 'flat_commerce_theme_options', flat_commerce_get_default_theme_options() );
	}
}
add_action( 'customize_save', 'flat_commerce_flush_transients' );

/**
 * Flush out category transients
 *
 * @uses delete_transient
 *
 * @action edit_category
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_flush_category_transients(){
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'flat_commerce_flush_category_transients' );


/**
 * Flush out post related transients
 *
 * @uses delete_transient
 *
 * @action save_post
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_flush_post_transients(){

	delete_transient( 'flat_commerce_featured_slider' );

	delete_transient( 'flat_commerce_product_slider' );

	delete_transient( 'flat_commerce_recent_products' );

	delete_transient( 'flat_commerce_featured_product' );

	delete_transient( 'flat_commerce_latest_blog' );

	delete_transient( 'flat_commerce_featured_image' );

	delete_transient( 'all_the_cool_cats' );
}
add_action( 'save_post', 'flat_commerce_flush_post_transients' );


if ( ! function_exists( 'flat_commerce_custom_css' ) ) :
	/**
	 * Enqueue Custon CSS
	 *
	 * @uses  set_transient, wp_head, wp_enqueue_style
	 *
	 * @action wp_enqueue_scripts
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_custom_css() {
		//flat_commerce_flush_transients();
		$options 	= flat_commerce_get_theme_options();

		$defaults 	= flat_commerce_get_default_theme_options();

		if ( ( !$flat_commerce_custom_css = get_transient( 'flat_commerce_custom_css' ) ) ) {
			$flat_commerce_custom_css ='';

			$header_text_color = get_header_textcolor();
			/*
			 * If no custom options for text are set, let's bail.
			 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
			 */
			if ( get_theme_support( 'custom-header', 'default-text-color' ) != $header_text_color ) {

				// If we get this far, we have custom styles. Let's do this.
					// Has the text been hidden?
				if ( ! display_header_text() ) :
					$flat_commerce_custom_css .= ".site-title,
					.site-description {
						position: absolute;
						clip: rect(1px, 1px, 1px, 1px);
					}";
				// If the user has set a custom color for the text use that.
				else :
					$flat_commerce_custom_css .= ".site-title a,
					.site-description {
						color: #" . esc_attr( $header_text_color ) . "}";
				endif;
			}

			$flat_commerce_custom_css .= '#bottom-section { background: url('. get_template_directory_uri(). '/images/bottom-section-bg.jpg'.') no-repeat; background-size: cover;}' . "\n";

			// //Custom CSS Option
			$css = '';
			// Check if the custom CSS feature of 4.7 exists
			if ( function_exists( 'wp_update_custom_css_post' ) ) {
			    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
			    $css= '';
   			    if( !empty( $options['custom_css'] ) )	
			    	$css = $options['custom_css'];
			    
			    if ( ! empty( $css ) ) {
			        $core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			        $return = wp_update_custom_css_post( $core_css . $css );
					
			        if ( ! is_wp_error( $return ) ) {
			            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
			   			$options['custom_css'] = '';
						set_theme_mod( 'flat_commerce_theme_options', $options );
			        }
			    }
			} else {
			    // Back-compat for WordPress < 4.7.
				if ( !empty( $options['custom_css'] ) ) {
					$flat_commerce_custom_css .= $options['custom_css'];
				}
			}
			set_transient( 'flat_commerce_custom_css', htmlspecialchars_decode( $flat_commerce_custom_css ), 86940 );
		}
//
		wp_add_inline_style( 'flatcommerce-style', $flat_commerce_custom_css );
	}
endif; //flat_commerce_custom_css
add_action( 'wp_enqueue_scripts', 'flat_commerce_custom_css', 10  );

/*
 * Custom conditional function to use with pre_get_posts hook
 */
function flat_commerce_is_front_page($query = false){
    if(!$query) :
        global $wp_query;
        $query = $wp_query;
    endif;

    return (get_option('show_on_front') == 'page' && get_option('page_on_front') && $query->get('page_id') == get_option('page_on_front'));
}


if ( ! function_exists( 'flat_commerce_post_navigation' ) ) :
	/**
	 * Displays Single post Navigation
	 *
	 * @uses  the_post_navigation
	 *
	 * @action flat_commerce_after_post
	 *
	 * @since Flat Commerce 0.8
	 */
	function flat_commerce_post_navigation() {
		$options	= flat_commerce_get_theme_options();

		$disable_single_post_navigation = isset($options['disable_single_post_navigation']) ? $options['disable_single_post_navigation'] : 0;

		if ( !$disable_single_post_navigation ) {
			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true"></span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'flat-commerce' ) . '</span> ' .
					'<span class="post-title">%title</span> <span class="meta-nav">→</span>',
				'prev_text' => '<span class="meta-nav">←</span> <span class="post-title">%title</span><span class="meta-nav" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Previous post:', 'flat-commerce' ) . '</span> ',
			) );
		}
	}
endif; //flat_commerce_post_navigation
add_action( 'flat_commerce_after_post', 'flat_commerce_post_navigation', 10 );


if ( ! function_exists( 'flat_commerce_archive_post_navigation' ) ) :
/**
 * Displays an optional archive navigation
 *
 *
 * Create your own flat_commerce_archive_post_navigation() function to override in a child theme.
 *
 * @since Business Park 0.1
 */
function flat_commerce_archive_post_navigation() {
	$options = flat_commerce_get_theme_options();
	?>
	<nav role="navigation" id="nav-below">
	   <h3 class="screen-reader-text"><?php _e( 'Post navigation', 'flat-commerce' ); ?></h3>
		<?php
		if ( 'numeric' == $options['pagination_type'] ) {
			echo paginate_links( array( 'type' => 'list' ) );
		} else {
			echo the_posts_navigation( array(
				'prev_text' =>  __( '<span class="meta-nav">&larr;</span> Older posts', 'flat-commerce' ),
				'next_text' => __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'flat-commerce' )
			) );
		}
		?>
	</nav>
<?php
}
endif;


if ( ! function_exists( 'flat_commerce_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_comment( $comment, $args, $depth ) {

		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php _e( 'Pingback:', 'flat-commerce' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'flat-commerce' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php printf( __( '%s <span class="says">says:</span>', 'flat-commerce' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'flat-commerce' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit', 'flat-commerce' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'flat-commerce' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
					) ) );
				?>
			</article><!-- .comment-body -->

		<?php
		endif;
	}
endif; // flat_commerce_comment()




if ( ! function_exists( 'flat_commerce_tag_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_tag_category() {
		echo '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {
			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'flat-commerce' ) );
			if ( $categories_list && flat_commerce_categorized_blog() ) {
				printf( 'Categories: <span class="cat-links">%1$s%2$s</span><br />',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'flat-commerce' ) ),
					$categories_list
				);
			}

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'flat-commerce' ) );
			if ( $tags_list ) {
				printf( 'Tags: <span class="tags-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'flat-commerce' ) ),
					$tags_list
				);
			}
		}

		echo '</p><!-- .entry-meta -->';
	}
endif; //flat_commerce_tag_category


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'flat_commerce_page_menu_args' );


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'flat_commerce_enhanced_image_navigation', 10, 2 );


/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_footer_sidebar_class() {
    $count = 0;

    if ( is_active_sidebar( 'footer-1' ) )
        $count++;

    if ( is_active_sidebar( 'footer-2' ) )
        $count++;

    if ( is_active_sidebar( 'footer-3' ) )
        $count++;

    if ( is_active_sidebar( 'footer-4' ) )
        $count++;

    if ( is_active_sidebar( 'footer-5' ) )
        $count++;

    $class = '';

    switch ( $count ) {
        case '1':
            $class = '1';
            break;
        case '2':
            $class = '2';
            break;
        case '3':
            $class = '3';
            break;
        case '4':
            $class = '4';
            break;
        case '5':
            $class = '5';
            break;
    }

	if ( $class )
		echo $class;
}


if ( ! function_exists( 'flat_commerce_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_continue_reading() {
		// Getting data from Customizer Options
		$more_tag_text	= __( 'Read more ...', 'flat-commerce' );

		return ' <a class="more-link" href="' . esc_url( get_permalink() ) . '">' .  esc_html( $more_tag_text ) . '</a>';
	}
endif; //flat_commerce_continue_reading


if ( ! function_exists( 'flat_commerce_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with flat_commerce_continue_reading().
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_excerpt_more( $more ) {
		return flat_commerce_continue_reading();
	}
endif; //flat_commerce_excerpt_more
add_filter( 'excerpt_more', 'flat_commerce_excerpt_more' );


if ( ! function_exists( 'flat_commerce_custom_excerpt' ) ) :
	/**
	 * Adds Continue Reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= flat_commerce_continue_reading();
		}
		return $output;
	}
endif; //flat_commerce_custom_excerpt
add_filter( 'get_the_excerpt', 'flat_commerce_custom_excerpt' );


if ( ! function_exists( 'flat_commerce_more_link' ) ) :
	/**
	 * Replacing Continue Reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_more_link( $more_link, $more_link_text ) {
	 	$options		=	flat_commerce_get_theme_options();
		$more_tag_text	= __( 'Read more ...', 'flat-commerce' );

		return str_replace( $more_link_text, $more_tag_text, $more_link );
	}
endif; //flat_commerce_more_link
add_filter( 'the_content_more_link', 'flat_commerce_more_link', 10, 2 );


if ( ! function_exists( 'flat_commerce_body_classes' ) ) :
	/**
	 * Adds flatcommerce layout classes to the array of body classes.
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_body_classes( $classes ) {
		global $post, $wp_query;

		// Adds a class of group-blog to blogs with more than 1 published author
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		$options = flat_commerce_get_theme_options();

		if ( ! is_404() ) {
			$classes[] = 'right-sidebar';
		}

		if ( class_exists( 'WooCommerce' ) && is_shop() ) {
			$classes[] = 'shop';
		}

		$enableheaderimage 		= $options['enable_featured_header_image'];

		if ( $enableheaderimage == 'disabled' ) {
			$classes[] = 'custom-header-enable';
		}

		$classes 	= apply_filters( 'flat_commerce_body_classes', $classes );

		return $classes;
	}
endif; //flat_commerce_body_classes
add_filter( 'body_class', 'flat_commerce_body_classes' );


if ( ! function_exists( 'flat_commerce_post_classes' ) ) :
	/**
	 * Adds flatcommerce post classes to the array of post classes.
	 * used for supporting different content layouts
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_post_classes( $classes ) {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Front page displays in Reading Settings
		$page_on_front = get_option('page_on_front') ;

		if( ( $page_id == absint( $page_on_front ) ) && $page_id > 0 ){
			$classes[] = 'col col-1-of-1';
		}
		elseif( is_home() || is_front_page() || is_archive() ) {
			//For Archives and index pages for three column width
			$classes[] = 'col col-1-of-3';
		}elseif (  class_exists( 'WooCommerce' ) && is_woocommerce() && is_shop() ) {
			//$classes[] = 'col col-1-of-3 col-m-1-of-2';
		}

		return $classes;
	}
endif; //flat_commerce_post_classes
add_filter( 'post_class', 'flat_commerce_post_classes' );


if ( ! function_exists( 'flat_commerce_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own flat_commerce_archive_content_image(), and that function will be used instead.
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_archive_content_image() {
		$options        = flat_commerce_get_theme_options();

		if ( has_post_thumbnail() ) { ?>
			<figure class="featured-image">
	            <a rel="bookmark" href="<?php echo esc_url( get_permalink() ); ?>">
	            <?php
		            the_post_thumbnail( 'flat-commerce-latest-blog' );
					?>
				</a>
	        </figure>
	   	<?php
		}
	}
endif; //flat_commerce_archive_content_image
add_action( 'flat_commerce_before_entry_container', 'flat_commerce_archive_content_image', 10 );


if ( ! function_exists( 'flat_commerce_single_content_image' ) ) :
	/**
	 * Template for Featured Image in Single Post
	 *
	 * To override this in a child theme
	 * simply create your own flat_commerce_single_content_image(), and that function will be used instead.
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_single_content_image() {
		global $post, $wp_query;
		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Getting data from Theme Options
	   	$options = flat_commerce_get_theme_options();

		if ( '' == get_the_post_thumbnail() ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		}
		else { ?>
			<figure class="featured-image">
            <?php the_post_thumbnail( 'full' ); ?>
	      </figure>
	   	<?php
		}
	}
endif; //flat_commerce_single_content_image
add_action( 'flat_commerce_before_page_container', 'flat_commerce_single_content_image', 10 );


if ( ! function_exists( 'flat_commerce_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @get comment setting from theme options and display comments sections accordingly
	 * @display comments_template
	 * @action flat_commerce_comment_section
	 *
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_get_comment_section() {
		if( is_front_page() ){
			return false;
		}
		elseif ( comments_open() || '0' != get_comments_number() ) {
			comments_template();
		}
	}
endif;
add_action( 'flat_commerce_comment_section', 'flat_commerce_get_comment_section', 10 );


/**
 * Footer Text
 *
 * @get footer text from theme options and display them accordingly
 * @display footer_text
 * @action flat_commerce_footer
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_footer_content() {
	// get the data value from theme options
	$search = array( '[the-year]', '[site-link]' );
		$flat_commerce_footer_content =  '
    	<div id="site-generator">
    		<div class="wrapper">
    			<div id="footer-content" class="copyright">'.__( 'Copyright &copy; ', 'flat-commerce' ).date( 'Y' ).'</a>. '.__( 'All Rights Reserved', 'flat-commerce' );
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		$flat_commerce_footer_content .= get_the_privacy_policy_link( '<span> | </span>' );
	}	
	$flat_commerce_footer_content .= '</div>
    		</div><!-- .wrapper -->
		</div><!-- #site-generator -->';

   echo $flat_commerce_footer_content;
  
}
add_action( 'flat_commerce_footer', 'flat_commerce_footer_content', 100 );


/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since Flat Commerce 0.1
 */

function flat_commerce_get_first_image( $postID, $size, $attr ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if( isset( $matches [1] [0] ) ) {
		//Get first image
		$first_img = $matches [1] [0];

		return '<img class="pngfix wp-post-image" src="'. esc_url( $first_img ) .'">';
	}

	return false;
}


if ( ! function_exists( 'flat_commerce_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action flat_commerce_footer action
	 * @uses set_transient and delete_transient
	 */
	function flat_commerce_scrollup() {
		//flat_commerce_flush_transients();
		if ( !$flat_commerce_scrollup = get_transient( 'flat_commerce_scrollup' ) ) {

			echo '<!-- refreshing cache -->';

			//site stats, analytics header code
			$flat_commerce_scrollup =  '<a href="#masthead" id="scrollup" class="genericon"><span class="screen-reader-text">' . __( 'Scroll Up', 'flat-commerce' ) . '</span></a>' ;

			set_transient( 'flat_commerce_scrollup', $flat_commerce_scrollup, 86940 );
		}
		echo $flat_commerce_scrollup;
	}
}
add_action( 'flat_commerce_after', 'flat_commerce_scrollup', 10 );


if ( ! function_exists( 'flat_commerce_page_post_meta' ) ) :
	/**
	 * Post/Page Meta for Google Structure Data
	 */
	function flat_commerce_page_post_meta() {
		$flat_commerce_author_url = esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) );

		$flat_commerce_page_post_meta = '<span class="post-time">' . __( 'Posted on', 'flat-commerce' ) . ' <time class="entry-date updated" datetime="' . esc_attr( get_the_date( 'c' ) ) . '" pubdate>' . esc_html( get_the_date() ) . '</time></span>';
	    $flat_commerce_page_post_meta .= '<span class="post-author">' . __( 'By', 'flat-commerce' ) . ' <span class="author vcard"><a class="url fn n" href="' . esc_url( $flat_commerce_author_url ) . '" title="View all posts by ' . esc_attr( get_the_author() ) . '" rel="author">' .get_the_author() . '</a></span>';

		return $flat_commerce_page_post_meta;
	}
endif; //flat_commerce_page_post_meta


if ( ! function_exists( 'flat_commerce_truncate_phrase' ) ) :
	/**
	 * Return a phrase shortened in length to a maximum number of characters.
	 *
	 * Result will be truncated at the last white space in the original string. In this function the word separator is a
	 * single space. Other white space characters (like newlines and tabs) are ignored.
	 *
	 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
	 *
	 * @since 1.5
	 *
	 * @param string $text            A string to be shortened.
	 * @param integer $max_characters The maximum number of characters to return.
	 *
	 * @return string Truncated string
	 */
	function flat_commerce_truncate_phrase( $text, $max_characters ) {

		$text = trim( $text );

		if ( mb_strlen( $text ) > $max_characters ) {
			//* Truncate $text to $max_characters + 1
			$text = mb_substr( $text, 0, $max_characters + 1 );

			//* Truncate to the last space in the truncated string
			$text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
		}

		return $text;
	}
endif; //flat_commerce_truncate_phrase


if ( ! function_exists( 'flat_commerce_get_the_content_limit' ) ) :
	/**
	 * Return content stripped down and limited content.
	 *
	 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
	 *
	 * @param integer $max_characters The maximum number of characters to return.
	 * @param string  $more_link_text Optional. Text of the more link. Default is "(more...)".
	 * @param bool    $stripteaser    Optional. Strip teaser content before the more text. Default is false.
	 *
	 * @return string Limited content.
	 */
	function flat_commerce_get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

		$content = get_the_content( '', $stripteaser );

		//* Strip tags and shortcodes so the content truncation count is done correctly
		$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

		//* Remove inline styles / scripts
		$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

		//* Truncate $content to $max_char
		$content = flat_commerce_truncate_phrase( $content, $max_characters );

		//* More link?
		if ( $more_link_text ) {
			$link   = apply_filters( 'get_the_content_more_link', sprintf( '<a href="%s" class="more-link">%s</a>', esc_url( get_permalink() ), esc_attr( $more_link_text ) ), $more_link_text );
			$output = sprintf( '<p>%s %s</p>', $content, $link );
		} else {
			$output = sprintf( '<p>%s</p>', $content );
			$link = '';
		}

		return apply_filters( 'flat_commerce_get_the_content_limit', $output, $content, $link, $max_characters );

	}
endif; //flat_commerce_get_the_content_limit

/**
 * Add Support for WooCommerce Plugin
 */
if ( class_exists( 'WooCommerce' ) ) {
	add_theme_support( 'woocommerce' );
	require get_template_directory() . '/inc/woocommerce.php';
}


/**
 * Add Support for mqTranslate and qTranslate Plugin
 */
if ( in_array( 'qtranslate/qtranslate.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ||
in_array( 'mqtranslate/mqtranslate.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/qtranslate.php';
}


/**
 * Add Support for WPML, qTranslate X & Polylang Plugin
 */
if ( defined( 'ICL_SITEPRESS_VERSION' ) || defined( 'QTX_VERSION' ) || class_exists( 'Polylang' ) ) {
	require get_template_directory() . '/inc/wpml.php';
}

if ( ! function_exists( 'flat_commerce_primary_class' ) ) :

	function flat_commerce_primary_class() {
		/**
		 * Add grid system classes to primary div
		 */
		if ( is_front_page() ) {
			return "col-1-of-1";
		}
		return "col-3-of-4";
	}
endif;

/**
 * Return woocommerce default breadcrumb
 */
if ( ! function_exists( 'flat_commerce_woocommerce_breadcrumb' ) ) :

	function flat_commerce_woocommerce_breadcrumb( $wrap_before, $wrap_after, $delimiter, $linkBefore, $linkAfter ) {
		ob_start();
		woocommerce_breadcrumb( array( 'wrap_before'=>$wrap_before,
													'wrap_after'=> $wrap_after,
													'delimiter' => $delimiter,
													'before' => $linkBefore,
													'after' => $linkAfter,
													'home' => false
												) );
		$output = ob_get_clean();
		return $output;
	}
endif;


/*
 * Get add to cart html
 */
if ( ! function_exists( 'flat_commerce_woocommerce_add_to_cart' ) ) :
	function flat_commerce_woocommerce_add_to_cart( ) {
			ob_start();
			woocommerce_template_loop_add_to_cart();
			$output = ob_get_clean();
			return $output;
		}
endif;

/*
* Write message for featured image upload
 */
add_filter( 'admin_post_thumbnail_html', 'flat_commerce_featured_image_instruction');
function flat_commerce_featured_image_instruction( $content ) {
    return $content .= '<p>'. __( 'Note: The recommended size for image is 1350px x 560px while using it for slider', 'flat-commerce' ) .'</p>';
}


/*
* Add a custom class when there is gallery images is empty
 */
add_filter( 'woocommerce_single_product_image_html', 'flat_commerce_woocommerce_single_product_image_html', 10, 2 );
function flat_commerce_woocommerce_single_product_image_html( $sprintf, $post_id ){
	global $post, $woocommerce, $product;

	$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
	$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
	$image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
		'title'	=> esc_html( get_the_title( get_post_thumbnail_id() ) )
	) );

	$attachment_count = count( $product->get_gallery_attachment_ids() );

	if ( $attachment_count > 0 ) {
		$gallery = '[product-gallery]';
	} else {
		$gallery = '';
	}

	$attachment_ids = $product->get_gallery_attachment_ids();

	( ! $attachment_ids ) ? $class = 'no-product-gallery' : $class = '';

	return sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom '.$class.'" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image );
}

if ( ! function_exists( 'flat_commerce_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function flat_commerce_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = flat_commerce_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}

endif;

add_filter( 'flat_commerce_filter_frontpage_content_enable', 'flat_commerce_is_frontpage_content_enable' );