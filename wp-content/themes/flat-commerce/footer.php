<?php
/**
 * The template for displaying the footer
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */
?>

<?php
    /**
     * flat_commerce_after_content hook
     *
     * @hooked flat_commerce_bottom_section - 20
     * @hooked flat_commerce_content_end - 30
     *
     */
    do_action( 'flat_commerce_after_content' );
?>

<?php
    /**
     * flat_commerce_footer hook
     *
     * @hooked flat_commerce_footer_content_start - 30
     * @hooked flat_commerce_footer_section - 40
     * @hooked flat_commerce_get_footer_content - 100
     * @hooked flat_commerce_footer_content_end - 110
     * @hooked flat_commerce_page_end - 200
     *
     */
    do_action( 'flat_commerce_footer' );
?>

<?php
/**
 * flat_commerce_after hook
 *
 */
do_action( 'flat_commerce_after' );?>

<?php wp_footer(); ?>

</body>
</html>