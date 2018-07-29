<?php
/**
 *
 * Dynamic Styles
 *
 **/

function blaize_dynamic_styles() {

        /** Dynamic Background Styles **/
        $sections = array(
                'service',
                'about',
                'counter',
                'portfolio',
                'team',
                'video',
                'testimonial',
                'blog',
                'partners',
        );
        $custom_css = "";

        foreach( $sections as $section ) {
                $bg_color = esc_attr( get_theme_mod( 'blaize_' . $section . '_bg_color', '#fff' ) );
                $bg_img = esc_url( get_theme_mod( 'blaize_' . $section . '_bg_img', '' ) );
                $bg_repeat = esc_attr( get_theme_mod( 'blaize_' . $section . '_bg_repeat', 'no-repeat' ) );
                $bgpos_x = esc_attr( get_theme_mod( 'blaize_' . $section . '_bg_position_x', 'center' ) );
                $bgpos_y = esc_attr( get_theme_mod( 'blaize_' . $section . '_bg_position_y', 'center' ) );
                $bg_att = esc_attr( get_theme_mod( 'blaize_' . $section . '_bg_attachment', 'scroll' ) );
                $bg_size = esc_attr( get_theme_mod( 'blaize_' . $section . '_bg_size', 'cover' ) );

                $custom_css .= "
                        .blz-{$section}-section {
                                background: {$bg_color} url({$bg_img}) {$bg_repeat} {$bgpos_x} {$bgpos_y} {$bg_att};
                                background-size: {$bg_size};
                        }";
        }
        
        /** Banner Background **/
        $header_img = get_header_image();
        if($header_img) {
            $custom_css .= "
                .blz-inner-page-header {
                    background-image: url({$header_img});
                }
            ";
        }

        /** Template Color **/
        $tpl_color = get_theme_mod( 'blaize_tpl_color', '#00B0EC' );
        $tpl_color_transparent = blaize_hex2rgba($tpl_color, 0.6);

        // Color
        $custom_css .= "
                .blz-slide .caption h2 span,
                a.blz-primary-btn.blz-btn:hover,
                .blz-main-slider .owl-nav .owl-prev,
                .blz-main-slider .owl-nav .owl-next,
                .blz-service .service-icon,
                ul.blz-portfolio-filter li:hover,
                ul.blz-portfolio-filter li.active,
                .team-details h3 span,
                .widget_blaize_contact_info .info-section i,
                .blz-inner-page-header .header-pg-title,
                .header-breadcrumb li a:hover,
                .woocommerce #respond input#submit:hover,
                .woocommerce a.button:hover,
                .woocommerce button.button:hover,
                .woocommerce input.button:hover,
                .woocommerce #respond input#submit.alt:hover,
                .woocommerce a.button.alt:hover,
                .woocommerce button.button.alt:hover,
                .woocommerce input.button.alt:hover,
                #secondary .widget caption,
                #secondary .widget table a,
                #secondary .widget_rss a,
                .widget_tag_cloud .tagcloud a:hover,
                .woocommerce ul.products li.product .button:hover,
                .nav-previous a, .nav-next a,
                .woocommerce-info::before,
                .teamin-name span,
                .site-info a,
                button:hover,
                input[type=\"button\"]:hover,
                input[type=\"reset\"]:hover,
                input[type=\"submit\"]:hover,
                .classic_layout .entry-content .content .cat-tags a:hover,
                .pagination .nav-links .page-numbers.current,
                .pagination .nav-links .page-numbers:hover,
                .classic_layout .entry-title a:hover,
                .blz-blog-post .blog-meta span a,
                .blz-testimonial-slider.layout1 .client-details h3 span,
                .blz-testimonial-slider.layout2 .client-details span,
                .recentcomments a,
                .woocommerce ul.cart_list li a,
                .woocommerce ul.product_list_widget li a,
                .comment-list .author-name-comment-meta a,
                .logged-in-as a,
                .post-metas-content span i,
                .post-metas-content .post-metas a:hover,
                .main-navigation li.current-menu-item > a,
                .main-navigation li a:hover,
                .woocommerce-info a,
                .woocommerce-cart-form__cart-item a,
                .woocommerce-shipping-calculator a,
                .big_thumb_layout .entry-title a:hover,
                .woocommerce nav.woocommerce-pagination ul li a,
                .woocommerce nav.woocommerce-pagination ul li span,
                .product_meta a,
                .woocommerce-message::before,
                .woocommerce-message a,
                .blz-blog-post .blog-content a:hover h3 {
                        color: {$tpl_color};
                }";

        // Background Color
        $custom_css .= "
                a.blz-primary-btn.blz-btn,
                .main-navigation ul li ul.sub-menu li:hover,
                .owl-dot:hover,
                .owl-dot.active,
                ul.blz-portfolio-filter li:hover:before,
                ul.blz-portfolio-filter li.active:before,
                ul.blz-portfolio-filter li:hover:after,
                ul.blz-portfolio-filter li.active:after,
                .blog-feat-img span i:last-child,
                .footer-widget .widget-title:after,
                .footer-widget .tnp-widget-minimal form:before,
                .woocommerce #respond input#submit,
                .woocommerce a.button, .woocommerce button.button,
                .woocommerce input.button,
                .woocommerce #respond input#submit.alt,
                .woocommerce a.button.alt,
                .woocommerce button.button.alt,
                .woocommerce input.button.alt,
                .widget_search .search-form:before,
                .woocommerce ul.products li.product .button,
                .woocommerce-MyAccount-navigation ul li.is-active a,
                .woocommerce-MyAccount-navigation ul li a:hover,
                .woocommerce-MyAccount-navigation ul li a,
                a.nav-toggle span,
                .teamin-social-icons a,
                button,
                input[type=\"button\"],
                input[type=\"reset\"],
                input[type=\"submit\"],
                a.blaize-readmore-btn:hover,
                .classic_layout .entry-content .title-post-metas .pub-date,
                .pagination .nav-links .page-numbers,
                .blz-loader,
                .woocommerce .widget_shopping_cart .cart_list li a.remove,
                .woocommerce.widget_shopping_cart .cart_list li a.remove,
                .blz-vdo-contents h2:before,
                .widget_search .search-form:before,
                .woocommerce-product-search:before,
                .blz-slide .caption h2:after,
                .blz-post-content .post-date span.dt,
                .big_thumb_layout ul.post-metas li .comment span,
                .big_thumb_layout ul.post-categories a:hover,
                .top-header-wrap,
                .woocommerce .woocommerce-error .button,
                .woocommerce .woocommerce-info .button,
                .woocommerce .woocommerce-message .button,
                .woocommerce-page .woocommerce-error .button,
                .woocommerce-page .woocommerce-info .button,
                .woocommerce-page .woocommerce-message .button {
                        background: {$tpl_color};
                }";

        // Border Color
        $custom_css .= "
                a.blz-primary-btn.blz-btn,
                .main-navigation ul li ul.sub-menu li,
                .owl-dot:hover,
                .owl-dot.active,
                .main-navigation ul li ul.sub-menu,
                .woocommerce #respond input#submit,
                .woocommerce a.button,
                .woocommerce button.button,
                .woocommerce input.button,
                .woocommerce #respond input#submit.alt,
                .woocommerce a.button.alt,
                .woocommerce button.button.alt,
                .woocommerce input.button.alt,
                .widget_tag_cloud .tagcloud a:hover,
                .woocommerce ul.products li.product .button,
                .woocommerce-info,
                button,
                input[type=\"button\"],
                input[type=\"reset\"],
                input[type=\"submit\"],
                button:hover,
                input[type=\"button\"]:hover,
                input[type=\"reset\"]:hover,
                input[type=\"submit\"]:hover,
                a.blaize-readmore-btn:hover,
                .pagination .nav-links .page-numbers,
                .woocommerce .woocommerce-error .button,
                .woocommerce .woocommerce-info .button,
                .woocommerce .woocommerce-message .button,
                .woocommerce-page .woocommerce-error .button,
                .woocommerce-page .woocommerce-info .button,
                .woocommerce-page .woocommerce-message .button,
                .woocommerce-message {
                        border-color: {$tpl_color};
                }";

        // Top Border Color
            $custom_css .= "
                #secondary .widget{
                    border-top-color: {$tpl_color};
                }";

        // Transparent Background (0.6)
        $custom_css .= "
                .blz-popup-search.active{
                        background: {$tpl_color_transparent};
                }";

        wp_add_inline_style( 'blaize-style', $custom_css );

}

add_action( 'wp_enqueue_scripts', 'blaize_dynamic_styles' );

/**
  * Convert hexdec color string to rgb(a) string 
*/
if ( ! function_exists( 'blaize_hex2rgba' ) ) {
  function blaize_hex2rgba($color, $opacity = false) { 
     $default = 'rgb(0,0,0)'; 
     if(empty($color))
              return $default;  
          if ($color[0] == '#' ) {
           $color = substr( $color, 1 );
          }
          if (strlen($color) == 6) {
                  $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
          } elseif ( strlen( $color ) == 3 ) {
                  $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
          } else {
                  return $default;
          }
          $rgb =  array_map('hexdec', $hex);
          if($opacity){
           if(abs($opacity) > 1)
           $opacity = 1.0;
           $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
          } else {
           $output = 'rgb('.implode(",",$rgb).')';
          }
          return $output;
  }
}