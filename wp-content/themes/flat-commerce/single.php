<?php
/**
 * The Template for displaying all single posts
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */

get_header();

/**
 * flat_commerce_single_start hook
 *
 * @hooked flat_commerce_single_wrapper_start -  10
 *
 */
do_action( 'flat_commerce_single_start' );?>

<?php

/**
 * flat_commerce_single_inner_wrapper_start hook
 *
 * @hooked flat_commerce_single_inner_wrapper_start -  10
 *
 */
do_action( 'flat_commerce_single_inner_wrapper_start' );?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'template-parts/content', 'single' ); ?>

	<?php
		/**
		 * flat_commerce_after_post hook
		 *
		 * @hooked flat_commerce_post_navigation - 10
		 */
		do_action( 'flat_commerce_after_post' );

		/**
		 * flat_commerce_comment_section hook
		 *
		 * @hooked flat_commerce_get_comment_section - 10
		 */
		do_action( 'flat_commerce_comment_section' );?>

<?php endwhile; // end of the loop.
/**
 * flat_commerce_single_inner_wrapper_end hook
 *
 * @hooked flat_commerce_single_inner_wrapper_end -  100
 *
 */
do_action( 'flat_commerce_single_inner_wrapper_end' );
get_sidebar();

/**
 * flat_commerce_single_end hook
 *
 * @hooked flat_commerce_single_wrapper_end -  100
 *
 */
do_action( 'flat_commerce_single_end' );?>

<?php get_footer();