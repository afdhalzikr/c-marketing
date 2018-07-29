<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flat_Commerce
 */

	// Get the reading setting option
	$show_on_front = get_option( 'show_on_front' );

	// Check if "latest posts" is selected in reading setting
	if ( 'posts' == $show_on_front ) {

		// Load home.php
		get_template_part( 'home' );
	} else {

		// Load front page with additional sections
		get_header();
		if ( true === apply_filters( 'flat_commerce_filter_frontpage_content_enable', true ) ) : 
			$options = flat_commerce_get_theme_options();
			if ( is_front_page() ) :
			?>
				<section class="main-content">
					<div class="container">
				<?php
				/**
				 * flat_commerce_single_inner_wrapper_start hook
				 *
				 * @hooked flat_commerce_single_inner_wrapper_start -  10
				 *
				 */
				do_action( 'flat_commerce_single_inner_wrapper_start' );?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'page' ); ?>

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
				do_action( 'flat_commerce_single_end' );
				?>
					</div><!-- .container -->
				</section><!-- .main-content -->
			<?php
			endif;
		endif;
		get_footer();
	}