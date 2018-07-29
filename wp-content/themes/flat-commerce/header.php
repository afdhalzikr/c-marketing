<?php
/**
 * The default template for displaying header
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */

	/**
	 * flat_commerce_doctype hook
	 *
	 * @hooked flat_commerce_doctype -  10
	 *
	 */
	do_action( 'flat_commerce_doctype' );?>

<head>
<?php
	/**
	 * flat_commerce_before_wp_head hook
	 *
	 * @hooked flat_commerce_head -  10
	 * @hooked flat_commerce_featured_image_display -10
	 *
	 */
	do_action( 'flat_commerce_before_wp_head' );

	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	/**
     *
     * flat_commerce_before_header hook
     *
     */
	/**
	 * flat_commerce_header hook
	 *
	 * @hooked flat_commerce_page_start -  10
	 * @hooked flat_commerce_featured_overall_image (before-header) - 20
	 * @hooked flat_commerce_header_start- 30
	 * @hooked flat_commerce_site_branding - 40
    * @hooked flat_commerce_primary_menu - 50
	 * @hooked flat_commerce_header_end - 100
	 *
	 */
	do_action( 'flat_commerce_header' );

	/**
     * flat_commerce_after_header hook
     *
     * @hooked flat_commerce_featured_overall_image (before-menu) - 10
     * @hooked flat_commerce_featured_overall_image (after-menu) - 40
     * @hooked flat_commerce_add_breadcrumb -50
     */
	do_action( 'flat_commerce_after_header' );

	/**
	 * flat_commerce_before_content hook
	 *
     * @hooked flat_commerce_content_start - 10
     * @hooked flat_commerce_featured_slider - 20
     * @hooked flat_commerce_promotion_headline - 40
     * @hooked flat_commerce_product_slider - 50
     * @hooked flat_commerce_recent_products - 60
     */
    do_action( 'flat_commerce_before_content' );