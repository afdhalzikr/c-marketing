<?php
/**
 * Adding support for WooCommerce Plugin
 *
 */
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// remove realted product hook;
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/** Single Product Removed hooks */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );


/** Archive page **/
// remove content wrapper
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

// remove woocommerce default breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// remove result count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );


if ( ! function_exists( 'return_false') ) :
    /**
     * return_false returns false
     * @return boolean always returns false
     */
    function return_false() {
        return false;
    }
endif;
add_filter('woocommerce_show_page_title', 'return_false');


if ( ! function_exists( 'flat_commerce_product_archive_site_content' ) ) :
    /**
     * Site content opening tags, sidebar, main wrapper starts, entry titile
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_product_archive_site_content() {
        ?>
        <div class="container">
            <div class="row">
            <?php if ( ! has_header_image() ) { ?>
                <header class="col col-1-of-1 entry-header proudct-title">
                    <h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>
                </header><!-- header -->
            <?php }
            $class = 'col col-3-of-4'; ?>
            <div id="primary" class="content-area <?php echo $class; ?>">
                <main id="main" class="site-main" role="main">
    <?php
    }
endif;
add_action( 'woocommerce_before_main_content', 'flat_commerce_product_archive_site_content', 30 );


if ( ! function_exists( 'flat_commerce_product_archive_site_section' ) ) :
    /**
     * Site section opening tags, sidebar, main wrapper starts, entry titile
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_product_archive_site_section() {
        if ( is_shop() ) {
            $class = 'product-lists';
        } elseif ( is_product() ) {
            $class = 'content-wrapper';
        } else {
            $class = '';
        }?>
        <section class="<?php echo $class; ?>">
    <?php
    }
endif;
add_action( 'woocommerce_before_main_content', 'flat_commerce_product_archive_site_section', 40 );


if ( ! function_exists( 'flat_commerce_product_archive_site_container' ) ) :
    /**
     * Site section opening tags, sidebar, main wrapper starts, entry titile
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_product_archive_site_container() {
        if ( is_product() ) {
            echo '<div class="container">';
        } ?>
                <div class="row">
                    <header class="col col-1-of-1 entry-header screen-reader-text">
                        <h3 class="entry-title"><?php esc_html_e( 'Product lists','flat-commerce' ); ?></h3>
                    </header><!-- .entry-header -->
    <?php
    }
endif;
add_action( 'woocommerce_before_main_content', 'flat_commerce_product_archive_site_container', 50 );

if ( ! function_exists( 'flat_commerce_product_archive_view' ) ) :
    /**
     * Archive view style
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_product_archive_view() {
        ?>
       <div class="col col-1-of-1">
            <div class="sort-view">
                <div id="sort-by" class="sort-by">
                    <label><?php esc_html_e( 'Sort By','flat-commerce' ); ?></label>
    <?php
    }
endif;
add_action( 'woocommerce_before_shop_loop', 'flat_commerce_product_archive_view', 10 );


if ( ! function_exists( 'flat_commerce_product_archive_view_end' ) ) :
    /**
     * Archive view ends
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_product_archive_view_end() {
        ?>
                </div>
            </div><!-- .display-style -->
        </div><!-- .col -->
    <?php
    }
endif;
add_action( 'woocommerce_before_shop_loop', 'flat_commerce_product_archive_view_end', 40 );



/** Content product */

// unhook functions from woocommerce_shop_loop_item_title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );


if ( ! function_exists( 'flat_commerce_content_product_item_wrapper_start' ) ) :
    /**
     * Product item wrapper start
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_content_product_item_wrapper_start() { ?>
            <div class="product-item product-hover">
    <?php
    }
endif;
add_action( 'woocommerce_before_shop_loop_item', 'flat_commerce_content_product_item_wrapper_start', 5 );

function flat_commerce_product_link_icon() {
    echo '<span class="genericon genericon-hierarchy"></span>';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'flat_commerce_product_link_icon', 15 );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 20 );


if ( ! function_exists( 'flat_commerce_content_product_item_mask_start' ) ) :
    /**
     * Product item mast start
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_content_product_item_mask_start() { ?>
        <div class="mask">
            <div class="v-center">
                 <div class="name-of-product">
                    <?php 
                    woocommerce_template_loop_product_link_open();
                    echo get_the_title(); 
                    woocommerce_template_loop_product_link_close();
                    ?>
                </div>
                <div class="product-action">
    <?php
    }
endif;
add_action( 'woocommerce_before_shop_loop_item_title', 'flat_commerce_content_product_item_mask_start', 25 );


if ( ! function_exists( 'flat_commerce_content_product_item_rate' ) ) :
    /**
     * Product item mast start
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_content_product_item_rate() { ?>
        <div class="rate">
    <?php
    }
endif;
add_action( 'woocommerce_before_shop_loop_item_title', 'flat_commerce_content_product_item_rate', 30 );


if ( ! function_exists( 'flat_commerce_content_product_item_rate_ends' ) ) :
    /**
     * Product item mast start
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_content_product_item_rate_ends() { ?>
        </div><!-- .rate -->
    <?php
    }
endif;
add_action( 'woocommerce_after_shop_loop_item_title', 'flat_commerce_content_product_item_rate_ends', 15 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

if ( ! function_exists( 'flat_commerce_content_product_item_wish_icon_start' ) ) :
    /**
     * Product item mast start
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_content_product_item_wish_icon_start() { ?>
         <div class="add-to-chart-wrapper">
                <!-- <span class="genericon genericon-heart"></span> -->
    <?php
    }
endif;
add_action( 'woocommerce_after_shop_loop_item_title', 'flat_commerce_content_product_item_wish_icon_start', 25 );



if ( ! function_exists( 'flat_commerce_content_product_item_ends' ) ) :
    /**
     * Product item mast start
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_content_product_item_ends() { ?>
                        </div> <!-- .add-to-chart-wrapper -->
                    </div> <!-- .product-action -->
                </div> <!-- .v-center -->
            </div> <!-- .mask -->
        </div> <!-- .product-item -->
    <?php
    }
endif;

add_action( 'woocommerce_after_shop_loop_item', 'flat_commerce_content_product_item_ends', 20 );


if ( ! function_exists( 'flat_commerce_product_archive_site_container_end' ) ) :
    /**
     * Site content opening tags, sidebar, main wrapper starts, entry titile end
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_product_archive_site_container_end() { ?>
            </div><!-- .row -->
        <?php if ( is_product() ) { ?>
            </div><!-- .container -->
       <?php }
    }
endif;
add_action( 'woocommerce_after_main_content', 'flat_commerce_product_archive_site_container_end', 70 );



if ( ! function_exists( 'flat_commerce_related_products' ) ) :
    /**
     * Site content opening tags, sidebar, main wrapper starts, entry titile end
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_related_products() {
        if (is_product()) {
            woocommerce_output_related_products();
        }
    }
endif;
add_action( 'woocommerce_after_main_content', 'flat_commerce_related_products', 100 );



if ( ! function_exists( 'flat_commerce_product_archive_site_section_end' ) ) :
    /**
     * Site content opening tags, sidebar, main wrapper starts, entry titile end
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_product_archive_site_section_end() { ?>
    </section><!-- .product-lists -->
    <?php
    }
endif;
add_action( 'woocommerce_after_main_content', 'flat_commerce_product_archive_site_section_end', 80 );


if ( ! function_exists( 'flat_commerce_product_archive_site_content_end' ) ) :
    /**
     * Site content opening tags, sidebar, main wrapper starts, entry titile end
     *
     * @since Flat Commerce Pro 1.0
     *
     */
    function flat_commerce_product_archive_site_content_end() { ?>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                    <?php if ( is_shop() ) {
                        get_sidebar();
                    } ?>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    <?php
    }
endif;
add_action( 'woocommerce_after_main_content', 'flat_commerce_product_archive_site_content_end', 90 );


/**
* Single product
*/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10  );

/**
* Cart Page
*/
// move cart total table in cart page before sample products
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals' );
add_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 5 );