<?php
/**
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


if( !function_exists( 'flat_commerce_footer_section' ) ) :
/**
 * Add slider.
 *
 * @uses action hook flat_commerce_before_content.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_footer_section() {

/* The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if (   ! is_active_sidebar( 'footer-1'  )
    && ! is_active_sidebar( 'footer-2' )
    && ! is_active_sidebar( 'footer-3'  )
    && ! is_active_sidebar( 'footer-4'  )
) {
    return;
}
// If we get this far, we have widgets. Let do this.
?>
     <div class="site-info">
        <div class="container">
            <div class="row">

            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
            <div class="col col-1-of-<?php echo flat_commerce_footer_sidebar_class();?> widget-area" role="complementary">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div><!-- #first .widget-area -->
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
            <div class="col col-1-of-<?php echo flat_commerce_footer_sidebar_class();?> widget-area" role="complementary">
                <?php dynamic_sidebar( 'footer-2' ); ?>
            </div><!-- #second .widget-area -->
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
            <div class="col col-1-of-<?php echo flat_commerce_footer_sidebar_class();?> widget-area" role="complementary">
                <?php dynamic_sidebar( 'footer-3' ); ?>
            </div><!-- #third .widget-area -->
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
            <div class="col col-1-of-<?php echo flat_commerce_footer_sidebar_class();?> widget-area" role="complementary">
                <?php dynamic_sidebar( 'footer-4' ); ?>
            </div><!-- #fourth .widget-area -->
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-5' ) ) : ?>
            <div class="col col-1-of-<?php flat_commerce_footer_sidebar_class();?> widget-area" role="complementary">
                <?php dynamic_sidebar( 'footer-5' ); ?>
            </div><!-- #fourth .widget-area -->
            <?php endif; ?>
        </div><!-- .row -->
       </div><!-- .container -->
   </div><!-- .site-info -->
<?php }
endif;
add_action( 'flat_commerce_footer', 'flat_commerce_footer_section', 40 );