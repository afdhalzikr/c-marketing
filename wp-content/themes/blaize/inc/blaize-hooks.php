<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Blaize
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blaize_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$blaize_sidebar_layout = 'right-sidebar';

	if( is_page() ) {
		global $post;
		
		$blaize_page_sidebar_layout = get_post_meta( $post->ID, 'blaize_page_sidebar_layout', true);
		$blaize_sidebar_layout = ($blaize_page_sidebar_layout == '') ? 'right-sidebar' : $blaize_page_sidebar_layout;
	} elseif ( is_post_type_archive( 'portfolio' ) || is_singular( 'portfolio' ) || is_singular( 'team' ) || is_404() ) {
		$blaize_sidebar_layout = 'no-sidebar';
	}

	$classes[] = esc_attr($blaize_sidebar_layout);

	return $classes;
}
add_filter( 'body_class', 'blaize_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function blaize_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'blaize_pingback_header' );

/** Add Search to The Primary menu **/
function blaize_add_search_form($items, $args) {

	$blaize_display_search = get_theme_mod( 'blaize_display_search', 1 );

	if( $blaize_display_search ) {
		if( $args->theme_location == 'main-menu' ) {
			$items .= '<li class="menu-item"><i class="fas fa-search"></i></li>';
		}	
	}
	
	return $items;
}
add_filter('wp_nav_menu_items', 'blaize_add_search_form', 10, 2);

/** Popup Search Form **/
function blaize_popup_search_form_cb() {
	$blaize_display_search = get_theme_mod( 'blaize_display_search', 1 );

	if( $blaize_display_search ) {
		?>
		<div class="blz-popup-search">
			<span class="close-popup-search"><i class="fa fa-times"></i></span>
			<?php get_search_form(); ?>
		</div>
		<?php
	}

}
add_action( 'blaize_popup_search_form', 'blaize_popup_search_form_cb' );

/** Site Header **/
add_action( 'blaize_page_header', 'blaize_page_header_cb' );
function blaize_page_header_cb() {
	if( ! is_page_template( 'tpl-frontpage.php' ) ) :
    $header_img = get_header_image();
    $inner_header_bg = '';
    if($header_img) {
        $inner_header_bg = 'has-bg';
    }
	?>
	<div class="blz-inner-page-header clearfix <?php echo esc_attr($inner_header_bg); ?>">
		<div class="blz-container clearfix">
			<h1 class="header-pg-title"><?php echo esc_html(blaize_page_title()); ?></h1>
            <div class="header-breadcrumb">
                <?php blaize_breadcrumb(); ?>
            </div>
		</div>
	</div>
	<?php
	endif;
}

function blaize_page_title() {
	$page_title = '';

	if( is_singular() )  {
		$page_title = get_the_title();
	} else if ( is_404() ) {
		$page_title = esc_html__( '404 Error', 'blaize' );
	} else if ( is_archive()) {
		$page_title = the_archive_title();
	} else if ( is_home() ) {
		$page_title = single_post_title( '', false );
		$page_title = (is_home() && is_front_page()) ? esc_html__('Blogs', 'blaize') : $page_title;
	}

	return $page_title;
}

if( ! function_exists( 'blaize_preloader_cb' ) ) {
	function blaize_preloader_cb() {
		$blaize_enable_preloader = get_theme_mod( 'blaize_enable_preloader', true );
		if( $blaize_enable_preloader ) :
		?>
			<div class="blz-loader">
				<div class="loader-inner ball-pulse-rise">
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>
		<?php
		endif;
	}

	add_action( 'blaize_preloader', 'blaize_preloader_cb' );
}