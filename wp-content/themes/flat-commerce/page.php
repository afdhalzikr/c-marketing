<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
do_action( 'flat_commerce_single_start' );



/**
 * flat_commerce_single_inner_wrapper_start hook
 *
 * @hooked flat_commerce_single_inner_wrapper_start -  10
 *
 */
do_action( 'flat_commerce_single_inner_wrapper_start' );?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php
				/**
				 * flat_commerce_comment_section hook
				 *
				 * @hooked flat_commerce_get_comment_section - 10
				 */
				do_action( 'flat_commerce_comment_section' );
			?>

		<?php endwhile; // end of the loop.

/**
 * flat_commerce_single_inner_wrapper_end hook
 *
 * @hooked flat_commerce_single_inner_wrapper_end -  100
 *
 */
do_action( 'flat_commerce_single_inner_wrapper_end' );

/**
 * flat_commerce_single_end hook
 *
 * @hooked flat_commerce_single_wrapper_end -  100
 *
 */
get_sidebar();
do_action( 'flat_commerce_single_end' );

get_footer();
