<?php
/**
 * The template for adding Customizer Custom Controls
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
	//Custom control for dropdown category multiple select
	class Flat_Commerce_Important_Links extends WP_Customize_Control {
        public $type = 'important-links';

        public function render_content() {
        	//Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links
            $important_links = array(
							'theme_instructions' => array(
								'link'	=> esc_url( 'http://themepalace.com/theme-instructions/flat-commerce/' ),
								'text' 	=> __( 'Theme Instructions', 'flat-commerce' ),
								),
							'support' => array(
								'link'	=> esc_url( 'http://themepalace.com/support-forum/' ),
								'text' 	=> __( 'Support', 'flat-commerce' ),
								),
							);
			foreach ( $important_links as $important_link) {
				echo '<p><a target="_blank" href="' . esc_url( $important_link['link'] ) .'" >' . esc_attr( $important_link['text'] ) .' </a></p>';
			}
      }
   }

  	//Custom control for WC dropdown single category select
 	class Flat_Commerce_Customize_WC_Dropdown_Product_Category extends WP_Customize_Control {
 		public $type = 'wc-dropdown-category';

 		public $name;

 		public function render_content() {
 			$dropdown = wp_dropdown_categories(
 				array(
 					'name'             => $this->name,
 					'echo'             => 0,
 					'hide_empty'       => false,
 					'show_option_none' => false,
 					'hide_if_empty'    => false,
 					'taxonomy'         => 'product_cat',
 				)
 			);

 			$dropdown = str_replace('<select', '<select style = "height:25px;" ' . $this->get_link(), $dropdown );

 			printf(
 				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
 				$this->label,
 				$dropdown
 			);

 			echo '<p class="description">'. __( 'Select Product Category', 'flat-commerce' ) . '</p>';
 		}
 	}