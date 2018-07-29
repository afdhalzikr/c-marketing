<?php
/**
 * The template for displaying the Recent Products
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

if( !function_exists( 'flat_commerce_recent_products' ) ) :
/**
* Add Recent Products
*
* @uses action hook flat_commerce_before_content.
*
* @since Flat Commerce 0.1
*/
function flat_commerce_recent_products() {
    global $post, $wp_query;

    //flat_commerce_flush_transients();
    // get data value from options
    $options                        = flat_commerce_get_theme_options();
    $enable_recent_products_on      = $options['recent_products_option'];
    $recent_products_title          = $options['recent_products_title'];
    $recent_products_option_select  = $options['recent_products_option_select'];

    // Get Page ID outside Loop
    $page_id = $wp_query->get_queried_object_id();

    // Front page displays in Reading Settings
    $page_on_front                 = get_option( 'page_on_front' );

    $flat_commerce_recent_products = '';

    if ( ( ( $page_id == $page_on_front && $page_id > 0  ) && $enable_recent_products_on == 'homepage' ) ) {

        if( ( !$flat_commerce_recent_products = get_transient( 'flat_commerce_recent_products' ) ) ) {
            echo '<!-- refreshing cache -->';

            $flat_commerce_recent_products = '
                <section id="recent-product">
                    <div class="container">
                        <div class="row" id="recent-product-row">';

                        $flat_commerce_recent_products .= '
                            <div class="col col-1-of-1">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <span>'.esc_html( $recent_products_title ) . '</span>
                                    </h2>
                                </header><!-- .entry-header -->
                            </div><!-- .col -->';

                        if( 'recent-product-demo' == $recent_products_option_select && function_exists( 'flat_commerce_recent_product_demo_content' ) ){

                            $flat_commerce_recent_products .= flat_commerce_recent_product_demo_content();

                        }

                        elseif( 'recent-product-featured' == $recent_products_option_select && function_exists( 'flat_commerce_recent_product_featured_content' ) ){

                            $flat_commerce_recent_products .= flat_commerce_recent_product_featured_content( $options );

                        }

                    $flat_commerce_recent_products .= '
                        </div><!-- .row -->

                        <div id="load-more-recent-product" data-page-no="2" class="col col-1-of-1">

                            <a href="'.esc_url( flat_commerce_recent_product_button_link() ).'" class="load-more"><span class="genericon genericon-next genericon-rotate-90"></span>' . __( 'More Products', 'flat-commerce' ) . '</a>

                        </div><!-- #load-more-recent-product -->

                    </div><!-- .container -->
                </section><!-- #recent-product -->';

                set_transient( 'flat_commerce_recent_products', $flat_commerce_recent_products, 86940 );

        }
        echo $flat_commerce_recent_products;
    }
}
endif; // flat_commerce_recent_products

add_action( 'flat_commerce_before_content', 'flat_commerce_recent_products', 60 );



if( ! function_exists( 'flat_commerce_recent_product_demo_content' ) ) :
/**
* Function to display demo content of recent product
*
* @since Flat Commerce 0.1
*
*/
function flat_commerce_recent_product_demo_content(){
    $flat_commerce_recent_products_demo = '
        <div class="col col-1-of-4 col-m-1-of-2">
            <div class="product-item product-hover"><a href="#">
                <img src="' . get_template_directory_uri() . '/images/gallery/women2.jpg" title="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'" width="250" height="320" alt="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'"/></a>

                <div class="mask">
                    <div class="v-center">
                        <div class="name-of-product"><a href="#">
                            '. esc_html__( 'Top Ulla coat','flat-commerce' ) .'</a>
                        </div>

                        <div class="product-action">
                            <div class="rate">'. esc_html__( '$150','flat-commerce' ) .'</div>
                            <div class="add-to-chart-wrapper">
                                <a href="#" class="button add-to-chart">'. esc_html__( 'Add to cart','flat-commerce' ) .'</a>
                            </div><!-- .add-to-chart-wrapper -->
                        </div><!-- .product-action -->
                    </div>
                </div> <!-- .mask -->

            </div>  <!-- .product-item -->
        </div><!-- .col -->

        <div class="col col-1-of-4 col-m-1-of-2">
            <div class="product-item product-hover"><a href="#">
                <img src="' . get_template_directory_uri() . '/images/gallery/women1.jpg" title="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'" width="250" height="320" alt="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'"/></a>

                <div class="mask">
                    <div class="v-center">
                        <div class="name-of-product"><a href="#">
                            '. esc_html__( 'Top Ulla coat','flat-commerce' ) .'</a>
                        </div>
                        <div class="product-action">
                            <div class="rate">
                                '. esc_html__( '$150','flat-commerce' ) .'
                            </div>
                            <div class="add-to-chart-wrapper">
                                <a href="#" class="button add-to-chart">'. esc_html__( 'Add to cart','flat-commerce' ) .'</a>
                            </div><!-- .add-to-chart-wrapper -->
                        </div><!-- .product-action -->
                    </div>
                </div> <!-- .mask -->

            </div>  <!-- .product-item -->
        </div><!-- .col -->

        <div class="col col-1-of-4 col-m-1-of-2">
            <div class="product-item product-hover"><a href="#">
                <img src="' . get_template_directory_uri() . '/images/gallery/recent-item1.jpg" title="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'" width="250" height="320" alt="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'"/></a>

                <div class="mask">
                    <div class="v-center">
                        <div class="name-of-product"><a href="#">
                            '. esc_html__( 'Top Ulla coat','flat-commerce' ) .'</a>
                        </div>

                        <div class="product-action">
                            <div class="rate">'. esc_html__( '$150','flat-commerce' ) .'</div>
                            <div class="add-to-chart-wrapper">
                                <a href="#" class="button add-to-chart">'. esc_html__( 'Add to cart','flat-commerce' ) .'</a>
                            </div><!-- .add-to-chart-wrapper -->
                        </div><!-- .product-action -->
                    </div>
                </div> <!-- .mask -->

            </div>  <!-- .product-item -->
        </div><!-- .col -->

        <div class="col col-1-of-4 col-m-1-of-2">
            <div class="product-item product-hover"><a href="#">
                <img src="' . get_template_directory_uri() . '/images/gallery/3.jpg" title="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'" width="250" height="320" alt="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'"/></a>

                <div class="mask">
                    <div class="v-center">
                        <div class="name-of-product"><a href="#">
                            '. esc_html__( 'Top Ulla coat','flat-commerce' ) .'</a>
                        </div>

                        <div class="product-action">
                            <div class="rate">
                                '. esc_html__( '$150','flat-commerce' ) .'
                            </div>
                            <div class="add-to-chart-wrapper">
                                <a href="#" class="button add-to-chart">'. esc_html__( 'Add to cart','flat-commerce' ) .'</a>
                            </div><!-- .add-to-chart-wrapper -->
                        </div><!-- .product-action -->
                    </div>
                </div> <!-- .mask -->

            </div>  <!-- .product-item -->
        </div><!-- .col -->

        <div class="col col-1-of-4 col-m-1-of-2">
            <div class="product-item product-hover"><a href="#">
                <img src="' . get_template_directory_uri() . '/images/gallery/watch.jpg" width="250" height="320" alt="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'"/></a>

                <div class="mask">
                    <div class="v-center">
                        <div class="name-of-product"><a href="#">
                            '. esc_html__( 'Top Ulla coat','flat-commerce' ) .'</a>
                        </div>

                        <div class="product-action">
                            <div class="rate">'. esc_html__( '$150','flat-commerce' ) .'</div>
                            <div class="add-to-chart-wrapper">
                                <a href="#" class="button add-to-chart">'. esc_html__( 'Add to cart','flat-commerce' ) .'</a>
                            </div><!-- .add-to-chart-wrapper -->
                        </div><!-- .product-action -->
                    </div>

                </div><!-- .mask -->
            </div>  <!-- .product-item -->
        </div><!-- .col -->

        <div class="col col-1-of-4 col-m-1-of-2">
            <div class="product-item product-hover"><a href="#">
                <img src="' . get_template_directory_uri() . '/images/gallery/boy.jpg" width="250" height="320" alt="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'"/></a>

                <div class="mask">
                    <div class="v-center">
                        <div class="name-of-product"><a href="#">
                            '. esc_html__( 'Top Ulla coat','flat-commerce' ) .'</a>
                        </div>

                        <div class="product-action">
                            <div class="rate">
                                '. esc_html__( '$150','flat-commerce' ) .'
                            </div>
                            <div class="add-to-chart-wrapper">
                                <a href="#" class="button add-to-chart">'. esc_html__( 'Add to cart','flat-commerce' ) .'</a>
                            </div><!-- .add-to-chart-wrapper -->
                        </div><!-- .product-action -->
                    </div>
                </div>  <!-- .mask -->

            </div>  <!-- .product-item -->
        </div><!-- .col -->

        <div class="col col-1-of-4 col-m-1-of-2">
            <div class="product-item product-hover"><a href="#">
                <img src="' . get_template_directory_uri() . '/images/gallery/recent-item2.jpg" width="250" height="320" alt="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'"/></a>

                <div class="mask">
                    <div class="v-center">
                        <div class="name-of-product"><a href="#">
                            '. esc_html__( 'Top Ulla coat','flat-commerce' ) .'</a>
                        </div>

                        <div class="product-action">
                            <div class="rate">'. esc_html__( '$150','flat-commerce' ) .'</div>
                            <div class="add-to-chart-wrapper">
                                <a href="#" class="button add-to-chart">'. esc_html__( 'Add to cart','flat-commerce' ) .'</a>
                            </div><!-- .add-to-chart-wrapper -->
                        </div><!-- .product-action -->
                    </div>
                </div> <!-- .mask -->

            </div> <!-- .product-item -->
        </div><!-- .col -->

        <div class="col col-1-of-4 col-m-1-of-2">
            <div class="product-item product-hover"><a href="#">
                <img src="' . get_template_directory_uri() . '/images/gallery/women.jpg" width="250" height="320" alt="'. esc_attr__( 'recent-product-1','flat-commerce' ) .'"/></a>

                <div class="mask">
                    <div class="v-center">
                        <div class="name-of-product"><a href="#">
                            '. esc_html__( 'Top Ulla coat','flat-commerce' ) .'</a>
                        </div>

                        <div class="product-action">
                            <div class="rate">
                                '. esc_html__( '$150','flat-commerce' ) .'
                            </div>
                            <div class="add-to-chart-wrapper">
                                <a href="#" class="button add-to-chart">'. esc_html__( 'Add to cart','flat-commerce' ) .'</a>
                            </div><!-- .add-to-chart-wrapper -->
                        </div><!-- .product-action -->
                    </div>
                </div>  <!-- .mask -->

            </div> <!-- .product-item -->
        </div><!-- .col -->';

    return $flat_commerce_recent_products_demo;
}
endif;


if( !function_exists( 'flat_commerce_recent_product_featured_content' )) :

/**
* Function to display featured content of recent product
*
* @param $options: flat_commerce_theme_options from customizer
*
* @since Flat Commerce 0.1
*
*/

function flat_commerce_recent_product_featured_content( $options ){
    global $post;

    $flat_commerce_recent_products_featured = '';

    $recent_products_category_args  = array(
        'post_type'      => 'product',
        'orderby'        => 'date',
        'order'          => 'desc',
        'posts_per_page' => 8,
    );

    $recent_products_category_query = new WP_Query( $recent_products_category_args );

    while( $recent_products_category_query -> have_posts() ){
            $recent_products_category_query -> the_post();

            $recent_product = wc_get_product( ); //set the global product object

            $flat_commerce_recent_products_featured .='
                <a href="' . esc_url( get_permalink() ) . '">
                    <div class="col col-1-of-4 col-m-1-of-2">
                        <div class="product-item product-hover">';

                if( has_post_thumbnail() ){
                    $flat_commerce_recent_products_featured .= get_the_post_thumbnail( $post->ID, 'flat-commerce-recent-product' );
                }

                else {
                    $flat_commerce_recent_products_featured .= wc_placeholder_img( 'flat-commerce-recent-product' );
                }

            $flat_commerce_recent_products_featured .= '
                        <div class="mask">
                            <div class="v-center">
                                <div class="name-of-product">
                                    <a href="' . esc_url( get_permalink() ) . '">
                                   ' . esc_html( $recent_product -> get_title() ) . '
                                   </a>
                                </div>

                                <div class="product-action">
                                    <div class="rate">' . wc_price( $recent_product -> get_price() ) . '</div>
                                    <div class="add-to-chart-wrapper">
                                    '.flat_commerce_woocommerce_add_to_cart().'</div>
                                </div><!-- .product-action -->
                            </div><!-- .v-center-->
                        </div> <!-- .mask -->
                    </div>  <!-- .product-item -->
                </div><!-- .col -->';

    }
    wp_reset_postdata();

return $flat_commerce_recent_products_featured;
}
endif;


/**
* Function to retrive WooCommerce shop page url
*
* @since Flat Commerce 0.1
*
*/
function flat_commerce_recent_product_button_link() {
    if ( class_exists( 'WooCommerce' ) ) {
        $shop = get_option( 'woocommerce_shop_page_id' );
        return get_permalink( $shop );
    } else {
        return '#';
    }
}