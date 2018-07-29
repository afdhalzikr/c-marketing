<?php
/**
 * The template for displaying the Product Slider
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


if( !function_exists( 'flat_commerce_product_slider' ) ) :
/**
 * Add Product slider.
 *
 * @uses action hook flat_commerce_before_content.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_product_slider() {
    global $post, $wp_query;

    //flat_commerce_flush_transients();
    // get data value from options
    $options          = flat_commerce_get_theme_options();
    $defaults         = flat_commerce_get_default_theme_options();

    $enableslider     = $options['product_slider_option'];
    $sliderselect     = $options['product_slider_type_select'];

    // Get Page ID outside Loop
    $page_id = $wp_query->get_queried_object_id();

    // Front page displays in Reading Settings
    $page_on_front     = get_option('page_on_front') ;

    if ( ( ( $page_id == $page_on_front && $page_id > 0  ) && $enableslider == 'homepage' ) ) {
          if( ( ! $flat_commerce_product_slider = get_transient( 'flat_commerce_product_slider' ) ) ) {
            echo '<!-- refreshing cache of product slider -->';

            $flat_commerce_product_slider = '
                <section id="product-section">
                    <div class="container">
                        <div class="product-wrapper">
                            <div class="row">
                                <div class="col col-1-of-1">
                                    <header class="entry-header screen-reader-text">
                                        <h2 class="entry-title">' . __( 'Product Slider', 'flat-commerce' ) .
                                        '</h2>
                                    </header><!-- .entry-header -->';

                                            // Select Product Slider
                                            if ( $sliderselect == 'demo-product-slider' && function_exists( 'flat_commerce_product_demo_slider' ) ) {
                                                $flat_commerce_product_slider .=  flat_commerce_product_demo_slider();
                                            }
                                            elseif( $sliderselect == 'category-product-slider' && function_exists( 'flat_commerce_product_category_slider' ) ){
                                                $flat_commerce_product_slider .=  flat_commerce_product_category_slider( $options , $defaults );
                                            }

                            $flat_commerce_product_slider .='
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .product-wrapper -->
                    </div><!-- .container -->
                </section><!-- #product-section -->';

            set_transient( 'flat_commerce_product_slider', $flat_commerce_product_slider, 86940 );
        }
        echo $flat_commerce_product_slider;
    }
}
endif;
add_action( 'flat_commerce_before_content', 'flat_commerce_product_slider', 50 );


if ( ! function_exists( 'flat_commerce_product_demo_slider' ) ) :
/**
 * This function to display product demo slider
 *
 * @since Flat Commerce 0.1
 *
 */
function flat_commerce_product_demo_slider() {
    $flat_commerce_product_demo_slider ='
            <div id="tabs" class="tab-content">
                <ul class="ui-tabs-nav">
                    <li><a href="#tabs-1">mens wear</a></li>
                </ul>
                <div id="tabs-1">
                    <div class="" id="mens">
                        <div class="tab-slider-wrapper">
                            <div class="responsive cycle-slideshow"
                                 data-cycle-swipe="true"
                                 data-cycle-speed="1000"
                                 data-cycle-loader="true"
                                 data-cycle-slides="> ul"
                                 data-cycle-prev="#prev1"
                                 data-cycle-next="#next1"
                                 >

                                <ul class="slides">
                                    <li class="col col-1-of-3 col-m-1-of-2">
                                        <a href="'.esc_url( home_url( '/' ) ).'">
                                            <img src="'.get_template_directory_uri().'/images/gallery/men1.jpg" alt="'.esc_attr__( 'men','flat-commerce' ) .'"/>
                                            <div class="product-item-wrapper">
                                                <div class="type-of-product">
                                                    '. esc_html__( 'Hiking and Adventure','flat-commerce' ) .'
                                                </div>
                                                <div class="total">
                                                    <a href="#">
                                                        '. esc_html__( '$170.00','flat-commerce' ) .'
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="col col-1-of-3 col-m-1-of-2">
                                        <a href="'.esc_url( home_url( '/' ) ).'">
                                            <img src="'.get_template_directory_uri().'/images/gallery/men2.png" alt="'.esc_attr__( 'men','flat-commerce' ) .'"/>
                                            <div class="product-item-wrapper">
                                                <div class="type-of-product">
                                                    '. esc_html__( 'Party wear clothes','flat-commerce' ) .'
                                                </div>
                                                <div class="total">
                                                    <a href="#">
                                                        '. esc_html__( '$55.00','flat-commerce' ) .'
                                                    </a>
                                                </div>
                                            </div>
                                        </a>

                                    </li>
                                    <li class="col col-1-of-3 col-m-1-of-2">
                                        <a href="'.esc_url( home_url( '/' ) ).'">
                                            <img src="'.get_template_directory_uri().'/images/gallery/men3.jpg" alt="'.esc_attr__( 'men','flat-commerce' ) .'"/>
                                            <div class="product-item-wrapper">
                                                <div class="type-of-product">
                                                    '. esc_html__( 'Hiking and adventure','flat-commerce' ) .'
                                                </div>
                                                <div class="total">
                                                    <a href="#">
                                                        '. esc_html__( '$300.00','flat-commerce' ) .'
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                </ul><!-- .slides -->
                                <ul class="slides">
                                    <li class="col col-1-of-3 col-m-1-of-2">
                                        <a href="'.esc_url( home_url( '/' ) ).'">
                                            <img src="'.get_template_directory_uri().'/images/gallery/men1.jpg" alt="'.esc_attr__( 'men','flat-commerce' ) .'" />
                                            <div class="product-item-wrapper">
                                                <div class="type-of-product">
                                                    '. esc_html__( 'Stich Fashion collection','flat-commerce' ) .'
                                                </div>
                                                <div class="total">
                                                    <a href="#">
                                                        '. esc_html__( '$599.00','flat-commerce' ) .'
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="col col-1-of-3 col-m-1-of-2">
                                        <a href="'.esc_url( home_url( '/' ) ).'">
                                            <img src="'.get_template_directory_uri().'/images/gallery/men2.png" alt="'.esc_attr__( 'men','flat-commerce' ) .'" />
                                            <div class="product-item-wrapper">
                                                <div class="type-of-product">
                                                    '. esc_html__( 'Stich Fashion collection','flat-commerce' ) .'
                                                </div>
                                                <div class="total">
                                                    <a href="#">
                                                        '. esc_html__( '$290.00','flat-commerce' ) .'
                                                    </a>
                                                </div>
                                            </div>
                                        </a>

                                    </li>
                                    <li class="col col-1-of-3 col-m-1-of-2">
                                        <a href="'.esc_url( home_url( '/' ) ).'">
                                            <img src="'.get_template_directory_uri().'/images/gallery/men3.jpg" alt="'.esc_attr__( 'men','flat-commerce' ) .'"/>
                                            <div class="product-item-wrapper">
                                                <div class="type-of-product">
                                                    '. esc_html__( 'Stich Fashion collection','flat-commerce' ) .'
                                                </div>
                                                <div class="total">
                                                    <a href="#">
                                                        '. esc_html__( '$290.00','flat-commerce' ) .'
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul><!-- .slides -->
                            </div><!-- cycle-slideshow -->
                            <span href="#" class="cycle-previous" id="prev1"><span class="genericon genericon-previous"></span></span>
                            <span href="#" class="cycle-next" id="next1"><span class="genericon genericon-next"></span></span>
                        </div><!-- .tab-slider-wrapper -->
                    </div><!-- .#mens -->
                </div><!-- #tabs-1 -->
            </div><!-- #tabs -->';
    return $flat_commerce_product_demo_slider;
}
endif; // flat_commerce_product_demo_slider

if ( ! function_exists( 'flat_commerce_product_category_slider' ) ) :
/**
 * This function to display Product category slider
 *
 * @get the data value from customizer options
 *
 * @since Flat Commerce 0.1
 *
 */
function flat_commerce_product_category_slider( $options, $defaults ) {
    global $post;

    $flat_commerce_product_category_slider  = '';

        $flat_commerce_product_category_slider ='
            <div id="tabs" class="tab-content">
                <ul class="ui-tabs-nav">';
            if( isset( $options['product_slider_category'] ) && $options['product_slider_category'] > 0 ){
                $flat_commerce_product_category_slider .='
                    <li><a href="#tabs-' . intval( $options['product_slider_category'] ) . '" >' .flat_commerce_get_product_category_by_id( intval( $options['product_slider_category'] ) ) . '</a></li>';
            }
        $flat_commerce_product_category_slider .='
                </ul>';

            if( !empty( $options['product_slider_category'] ) ){
                $flat_commerce_product_category_slider .='
                    <div id="tabs-' . intval( $options['product_slider_category'] ) . '">
                        <div class="" id="mens">
                            <div class="tab-slider-wrapper">
                                <div class="cycle-slideshow"
                                    data-cycle-swipe="true"
                                    data-cycle-loop = "1"
                                    data-cycle-fx="scrollHorz"
                                    data-cycle-loader="true"
                                    data-cycle-slides="> ul"
                                    data-cycle-prev="#cycle-prev"
                                    data-cycle-next="#cycle-next"
                                    >
                                    <ul class="slides">';


                            $li_count = 1;

                            $category_args      = array(
                                'post_type'     => 'product',
                                'post_status'   => 'publish',
                                'posts_per_page'=> 8,
                                'tax_query'     => array(
                                    array(
                                    'taxonomy'      => 'product_cat',
                                    'terms'         => $options['product_slider_category'],
                                    )
                                ),
                            );
                            $category_query     = new WP_Query( $category_args );

                            while(  $category_query->have_posts() ){
                                    $category_query->the_post();

                                    $slider_product = wc_get_product();

                                    $flat_commerce_product_category_slider .= '
                                        <li class="col col-1-of-3 col-m-1-of-2" >
                                            <a href="' . esc_url( get_permalink() ) . '">';

                                                if( has_post_thumbnail() ){
                                                    $flat_commerce_product_category_slider .= woocommerce_get_product_thumbnail( 'flat-commerce-product-slider');
                                                }
                                                else{
                                                    $flat_commerce_product_category_slider .= wc_placeholder_img( 'flat-commerce-product-slider' );
                                                }

                                    $flat_commerce_product_category_slider .= '
                                                </a><div class="product-item-wrapper">
                                                    <div class="type-of-product"><a href="' . esc_url( get_permalink() ) . '">' . $slider_product -> get_title() . '</a></div>
                                                    <div class="total">
                                                       ' . wc_price( $slider_product -> get_price() ) . '

                                                    </div>
                                                </div>

                                        </li>';

                                if ( 0 == ( $li_count % 3 ) ) { // insert new ul element if posts_per_page is greater than layout option
                                    $flat_commerce_product_category_slider .= '
                                    </ul><!-- .slides -->
                                    <ul class="slides">';
                                }

                            $li_count++;
                            }

                            wp_reset_query();
                            $flat_commerce_product_category_slider .= '
                                    </ul>';
                            $flat_commerce_product_category_slider.= '
                                </div><!-- cycle-slideshow -->';

                                    $flat_commerce_product_category_slider .= '
                                        <span href="#" class="cycle-previous" id="cycle-prev"><span class="genericon genericon-previous"></span></span>
                                        <span href="#" class="cycle-next" id="cycle-next"><span class="genericon genericon-next"></span></span>';

                            $flat_commerce_product_category_slider.='
                            </div><!-- .tab-slider-wrapper -->
                        </div><!-- .tab-pane -->
                    </div><!-- #tabs-' . $options['product_slider_category'] . '-->';
            }
        $flat_commerce_product_category_slider .='
            </div><!-- #tabs --></ul>';
    return  $flat_commerce_product_category_slider;
}
endif; // flat_commerce_product_category_slider

//Function to get Woocommerce category name using category id
/**
 * Product by category id
 * @param  int $category_id Category id
 * @return string              Terms of the respective product category
 * @since 0.5
 */
function flat_commerce_get_product_category_by_id( $category_id ) {
    $term = get_term_by( 'id', $category_id, 'product_cat', 'ARRAY_A' );
    return $term['name'];
}