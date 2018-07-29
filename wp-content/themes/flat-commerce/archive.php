<?php
/**
 * The template for displaying Archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */

get_header(); ?>

	<section id="blog" class="content-area">
		<div class="container">
			<div class="row" id="content_row">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
		<div class="col col-1-of-1">
			<header class="entry-header">
				<h2 class="entry-title">
					<?php the_archive_title(); ?>
				</h2>
				<?php
					// Show an optional term description.
					the_archive_description ( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
		</div><!-- .col .col-1-of-1 -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php wp_reset_query(); ?>

			<?php flat_commerce_archive_post_navigation(); ?>
		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
		</div>
		</div>
	</section><!-- #primary -->

<?php get_footer();
