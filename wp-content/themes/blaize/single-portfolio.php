<?php
/**
 * The template for displaying all single portfolio post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blaize
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
				while ( have_posts() ) : the_post();

					if( has_post_thumbnail() ) {
						$img = wp_get_attachment_image_src( get_post_thumbnail_id(), $size = 'full' );
						$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
						?>
						<div class="portfolio-thumbnail">
							<img src="<?php echo esc_url($img[0]); ?>" alt="<?php echo esc_attr($alt); ?>" />
						</div>
						<?php
					}

					the_content();

				endwhile; // End of the loop.
				wp_reset_postdata();
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
