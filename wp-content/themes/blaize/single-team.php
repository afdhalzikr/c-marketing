<?php
/**
 * The template for displaying all single team post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blaize
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="team-inner-wrapper">
				<?php
					while ( have_posts() ) : the_post();

						$designation = get_post_meta( $post->ID, 'designation', true );
			            $facebook = get_post_meta( $post->ID, 'facebook', true );
			            $twitter = get_post_meta( $post->ID, 'twitter', true );
			            $gplus = get_post_meta( $post->ID, 'gplus', true );
			            $linkedin = get_post_meta( $post->ID, 'linkedin', true );
			            $tumblr = get_post_meta( $post->ID, 'tumblr', true );

						if( has_post_thumbnail() ) {
							$img = wp_get_attachment_image_src( get_post_thumbnail_id(), $size = 'full' );
							$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
							?>
							<div class="team-thumbnail">
								<div class="teamin-img-wrap">
									<img src="<?php echo esc_url($img[0]); ?>" alt="<?php echo esc_attr($alt); ?>" />
								</div>

								<?php if( $facebook || $twitter || $gplus || $linkedin || $tumblr ) : ?>
									<div class="teamin-social-icons">
										<?php if($facebook) : ?>
											<a href="<?php echo esc_url($facebook); ?>"><i class="fab fa-facebook-f"></i></a>
										<?php endif; ?>

										<?php if($twitter) : ?>
											<a href="<?php echo esc_url($twitter); ?>"><i class="fab fa-twitter"></i></a>
										<?php endif; ?>

										<?php if($gplus) : ?>
											<a href="<?php echo esc_url($gplus); ?>"><i class="fab fa-google"></i></a>
										<?php endif; ?>

										<?php if($linkedin) : ?>
											<a href="<?php echo esc_url($linkedin); ?>"><i class="fab fa-linkedin-in"></i></a>
										<?php endif; ?>

										<?php if($tumblr) : ?>
											<a href="<?php echo esc_url($tumblr); ?>"><i class="fab fa-tumblr"></i></a>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
							<?php
						}

						?>
						<div class="team-member-name-content">
							<h2 class="teamin-name">
								<?php the_title(); ?>
								<?php if($designation) : ?>	
									<span><?php echo esc_html($designation); ?></span>
								<?php endif; ?>
							</h2>

							<div class="team-member-content">
								<?php the_content(); ?>
							</div>

						</div>
						<?php
					endwhile; // End of the loop.
					wp_reset_postdata();
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();