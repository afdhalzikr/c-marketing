<?php
/**
 * The template for Managing Theme Structure
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


if ( ! function_exists( 'flat_commerce_doctype' ) ) :
	/**
	 * Doctype Declaration
	 *
	 * @since Flat Commerce 0.1
	 *
	 */
	function flat_commerce_doctype() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'flat_commerce_doctype', 'flat_commerce_doctype', 10 );


if ( ! function_exists( 'flat_commerce_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Flat Commerce 0.1
	 *
	 */
	function flat_commerce_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
           <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php endif; ?>
		<?php
	}
endif;
add_action( 'flat_commerce_before_wp_head', 'flat_commerce_head', 10 );


if ( ! function_exists( 'flat_commerce_page_start' ) ) :
	/**
	 * Start div id #page
	 *
	 * @since Flat Commerce 0.1
	 *
	 */
	function flat_commerce_page_start() {
		?>
		<div id="page" class="hfeed site">
		<?php
	}
endif;
add_action( 'flat_commerce_header', 'flat_commerce_page_start', 10 );




if ( ! function_exists( 'flat_commerce_header_start' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since Flat Commerce 0.1
	 *
	 */
	function flat_commerce_header_start() {
		$options = flat_commerce_get_theme_options(); // get theme options from customizer
		?>
		<header id="masthead" class="site-header header"  role="banner">
            <div class="row">
           		<?php if( $options['enable_topbar'] == true ) : ?>
                	<div class="site-topbar">	
                		<div class="container">
	                		<ul>
	                			<li class="address"><?php if( !empty( $options['topbar_location'] ) ) {
	                				echo esc_html( $options['topbar_location'] ); 
	                				} ?>
	                			</li>
	                			
	                			<li class="contact-number">
	                				<?php if( !empty( $options['topbar_contact'] ) ) { 
	                				echo '<a href="tel:'. preg_replace('/\D+/', '', $options['topbar_contact'] ) .'">'. esc_html( $options['topbar_contact'] ) .'</a>';  
	                			} ?>
	                			</li>
	                		</ul>
                		</div><!-- .container -->
            		</div><!-- .site-topbar -->
            	<?php endif; ?>
        		<div class="site-menu">
            		<div class="container">
		<?php
	}
endif;
add_action( 'flat_commerce_header', 'flat_commerce_header_start', 30 );


if ( ! function_exists( 'flat_commerce_header_end' ) ) :
	/**
	 * End Header id #masthead and class .wrapper
	 *
	 * @since Flat Commerce 0.1
	 *
	 */
	function flat_commerce_header_end() {
		?>
					</div><!-- .container -->
				</div><!-- .site-menu -->
			</div><!-- .row -->
	    </header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'flat_commerce_header', 'flat_commerce_header_end', 100 );


if ( ! function_exists( 'flat_commerce_content_start' ) ) :
	/**
	 * Start div id #content and class .wrapper
	 *
	 * @since Flat Commerce 0.1
	 *
	 */
	function flat_commerce_content_start() {
		?>
		<div id="content" class="site-content">
	<?php }
endif;
add_action('flat_commerce_before_content', 'flat_commerce_content_start', 10 );






if ( ! function_exists( 'flat_commerce_single_wrapper_start' ) ) :
/**
 * Header Right Sidebar
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_single_wrapper_start(){
    ?>
       <div class="container">
            <div class="row">

<?php
}
endif;
add_action( 'flat_commerce_single_start','flat_commerce_single_wrapper_start', 10 );


if ( ! function_exists( 'flat_commerce_single_inner_wrapper_start' ) ) :
/**
 * Header Right Sidebar
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_single_inner_wrapper_start(){
    ?>
        <div id="primary" class="content-area col <?php echo flat_commerce_primary_class(); ?>">
            <main id="main" class="site-main" role="main">

<?php
}
endif;
add_action( 'flat_commerce_single_inner_wrapper_start','flat_commerce_single_inner_wrapper_start', 10 );


if ( ! function_exists( 'flat_commerce_single_inner_wrapper_end' ) ) :
/**
 * Header Right Sidebar
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_single_inner_wrapper_end(){
    ?>
            </main><!-- #main -->
        </div><!-- #primary -->

<?php
}
endif;
add_action( 'flat_commerce_single_inner_wrapper_end','flat_commerce_single_inner_wrapper_end', 100 );


if ( ! function_exists( 'flat_commerce_single_wrapper_end' ) ) :
/**
 * Header Right Sidebar
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_single_wrapper_end(){
    ?>
       </div><!-- .row -->
    </div><!-- .container -->

<?php
}
endif;
add_action( 'flat_commerce_single_end','flat_commerce_single_wrapper_end', 100 );


if ( ! function_exists( 'flat_commerce_content_end' ) ) :
    /**
     * End div id #content and class .wrapper
     *
     * @since Flat Commerce 0.1
     */
    function flat_commerce_content_end() {
        ?>
        </div><!-- .site-content -->
        <?php
    }

endif;
add_action( 'flat_commerce_after_content', 'flat_commerce_content_end', 30 );


if ( ! function_exists( 'flat_commerce_inner_page_div_controls_before' ) ) :
/**
 * Header Right Sidebar
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_inner_page_div_controls_before(){
	?>
	<section id="blog">
    	<div class="container">
        	<div class="row">
<?php
}
endif;
add_action( 'flat_commerce_html_before_inner_page','flat_commerce_inner_page_div_controls_before', 10 );


if ( ! function_exists( 'flat_commerce_inner_page_div_controls_after' ) ) :
/**
 * Header Right Sidebar
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_inner_page_div_controls_after(){
	?>
		</div><!-- .row -->
    </div><!-- .container -->
</section>

<?php
}
endif;
add_action( 'flat_commerce_html_after_inner_page','flat_commerce_inner_page_div_controls_after', 10 );


if ( ! function_exists( 'flat_commerce_page_end' ) ) :
    /**
     * End div id #page
     *
     * @since Flat Commerce 0.1
     *
     */
    function flat_commerce_page_end() {
        ?>
        </div><!-- #page -->
        <?php
    }
endif;
add_action( 'flat_commerce_footer', 'flat_commerce_page_end', 200 );


if ( ! function_exists( 'flat_commerce_footer_content_start' ) ) :
/**
 * Start footer id #colophon
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_footer_content_start() {
    ?>
    <footer id="colophon" class="site-footer" role="contentinfo">
    <?php
}
endif;
add_action('flat_commerce_footer', 'flat_commerce_footer_content_start', 30 );


if ( ! function_exists( 'flat_commerce_footer_content_end' ) ) :
/**
 * End footer id #colophon
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_footer_content_end() {
    ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'flat_commerce_footer', 'flat_commerce_footer_content_end', 110 );