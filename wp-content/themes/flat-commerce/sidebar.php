<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */
?>

<?php
/**
 * flat_commerce_before_secondary hook
 */
do_action( 'flat_commerce_before_secondary' );?>

<?php
	do_action( 'flat_commerce_before_primary_sidebar' );
	?>
		<div id="secondary" class="widget-area col col-1-of-4 fc-sidebar" role="complementary">
        <div class="sidebar-inner">
			<?php
			if ( ( is_active_sidebar( 'sidebar-optional-woocommmerce' ) ) && class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_shop()  ) ) {

	        	if( is_active_sidebar( 'sidebar-optional-woocommmerce' ) ){
	        		echo '<div class="widgets woocommerce-optional-sidebar">';
	        			dynamic_sidebar( 'sidebar-optional-woocommmerce' );
	        		echo '</div>';
	        	}
	   	}
   		elseif ( is_active_sidebar( 'sidebar-optional-woocommmerce' ) && class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() )  ) {
   			echo '<header class="header-title shop-by">
	            		<h1 class="entry-title">'. __( 'SHOP BY',  'flat-commerce' ).'</h1>
	            	</header>';
        	dynamic_sidebar( 'sidebar-optional-woocommmerce' );
   		}
			elseif ( is_active_sidebar( 'primary-sidebar' ) ) {
	        	dynamic_sidebar( 'primary-sidebar' );
	   	}
   		elseif( is_active_sidebar( 'sidebar-advertisement' ) ){
   			dynamic_sidebar( 'sidebar-advertisement' );

   		}
			else {
				//Helper Text
				if ( current_user_can( 'edit_theme_options' ) ) {
					$args = array(
					    'before_widget' => '<section id="widget-default-text" class="widget widget_text"><div class="widget-wrap">',
					    'after_widget' => '</div><!-- .widget-wrap --></section><!-- #widget-default-text -->',
					    'before_title' => '<h4 class="widget-title">',
					    'after_title' => '</h4>'
					    );
					$instance = array(
					    'title' => __( "Primary Sidebar Widget Area", "flat-commerce" ),
					    'text' => "<p>".__( 'This is the Primary Sidebar Widget Area if you are using a two or three column site 			layout option.', 'flat-commerce' )."</p>
		                   		<p>".sprintf( __( 'By default it will load Search and Archives widgets as shown below. You can add widget to this area by visiting your <a href="%s">Widgets Panel</a> which will replace default widgets.', 'flat-commerce' ), esc_url( admin_url( 'widgets.php' ) ) )."</p>"
					    );
					the_widget( 'WP_Widget_Text', $instance, $args );
				} ?>
				<section class="widget widget_search" id="default-search">
					<div class="widget-wrap">
						<?php get_search_form(); ?>
					</div><!-- .widget-wrap -->
				</section><!-- #default-search -->
				<section class="widget widget_archive" id="default-archives">
					<div class="widget-wrap">
						<h4 class="widget-title"><?php _e( 'Archives', 'flat-commerce' ); ?></h4>
						<ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
						</ul>
					</div><!-- .widget-wrap -->
				</section><!-- #default-archives -->
				<?php
			} ?>
		</div><!-- .sidebar-inner -->
		</div><!-- #secondary -->
	<?php
	/**
	 * flat_commerce_after_primary_sidebar hook
	 */
	do_action( 'flat_commerce_after_primary_sidebar' ); ?>

<?php
/**
 * flat_commerce_after_secondary hook
 *
 */
do_action( 'flat_commerce_after_secondary' );