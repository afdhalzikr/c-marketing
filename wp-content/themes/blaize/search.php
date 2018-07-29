<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Blaize
 */

get_header();

$blaize_blog_page_excerpt_length = get_theme_mod( 'blaize_blog_page_excerpt_length', 450 );
$blaize_blog_page_readmore_text = get_theme_mod( 'blaize_blog_page_readmore_text', '' );
$blaize_blog_layout = get_theme_mod( 'blaize_blog_layout', 'big_thumb_layout' );
?>

	<div id="primary" class="content-area <?php echo esc_attr($blaize_blog_layout); ?>">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>

				<?php if( $blaize_blog_layout == 'big_thumb_layout' ) : ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php if( has_post_thumbnail() ) :
								$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blaize-blog-arch-img' );
								$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
							?>
								<header class="entry-header">
									<a href="<?php the_permalink(); ?>">
										<img src="<?php echo esc_url($img[0]); ?>" alt="<?php echo esc_attr($alt); ?>" />
									</a>
									<?php the_category(); ?> 
								</header>
							<?php endif; ?>

							<div class="entry-content">
								<div class="title-post-metas">
									<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
									<ul class="post-metas">
										<li>
											<?php echo esc_html__( 'Posted By', 'blaize' ); ?>
										</li>

										<li>
											<?php echo wp_kses_post( get_avatar( get_the_author_meta( 'user_email' ), 35 ) ); ?>
										</li>

										<li>
											<?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?>
										</li>

										<li>
											<span class="comment">
												<i class="icon-chat"></i>
												<span><?php echo intval(get_comments_number()); ?></span>
											</span>
										</li>

										<li>
											<span class="date">
												<?php echo get_the_date(); ?>
											</span>
										</li>
									</ul>
								</div>

								<div class="content">
									<?php
										$content = substr( strip_tags( strip_shortcodes( get_the_content() ) ), 0, absint($blaize_blog_page_excerpt_length) );
										echo esc_html($content);
									?>
								</div>

							</div>

							<?php if( $blaize_blog_page_readmore_text ) : ?>
							<footer class="entry-footer">
								<a href="<?php the_permalink(); ?>" class="blaize-btn blaize-readmore-btn"><?php echo esc_html($blaize_blog_page_readmore_text); ?></a>
							</footer><!-- .entry-footer -->
							<?php endif; ?>
						</article>
					<?php else : ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php if( has_post_thumbnail() ) :
								$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blaize-blog-arch-img' );
								$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
							?>
								<header class="entry-header">
									<a href="<?php the_permalink(); ?>">
										<img src="<?php echo esc_url($img[0]); ?>" alt="<?php echo esc_attr($alt); ?>" />
									</a>
								</header>
							<?php endif; ?>

							<div class="entry-content clearfix">
								<div class="title-post-metas">
										<div class="pub-date">

											<span class="day">
												<?php echo get_the_date( 'd' ); ?>
											</span>
											
											<span class="month">
												<?php echo get_the_date( 'M' ); ?>
											</span>
											
										</div>

										<div class="user">
											<?php echo wp_kses_post( get_avatar( get_the_author_meta( 'user_email' ), 65 ) ); ?>
											<span><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></span>
										</div>

										<div class="comment">
											<i class="icon-chat"></i>
											<span><?php echo intval(get_comments_number()); ?></span>
										</div>
								</div>

								<div class="content">
									<?php if( has_category() || has_tag() ) : ?>
										<div class="cat-tags">
											<?php if( has_category() ) : ?>
												<span class="cats"><i class="fas fa-folder"></i><?php the_category(', '); ?></span>
											<?php endif; ?>
											<?php if( has_tag() ) : ?>
												<span class="tags"><i class="fas fa-tag"></i><?php the_tags(); ?></span>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
									<div>
										<?php
											$content = substr( strip_tags( strip_shortcodes( get_the_content() ) ), 0, absint($blaize_blog_page_excerpt_length) );
											echo esc_html($content);
										?>
									</div>

									<?php if( $blaize_blog_page_readmore_text ) : ?>
									<a href="<?php the_permalink(); ?>" class="blaize-btn blaize-readmore-btn"><?php echo esc_html($blaize_blog_page_readmore_text); ?></a>
									<?php endif; ?>
								</div>

							</div>

						</article>
					<?php endif; ?>
				<?php
				
			endwhile;
			wp_reset_postdata();
			the_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();