<?php
/**
 * The template for displaying Search Results pages
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */

get_header(); ?>
	<section id="blog">
        <div class="container">
            <div class="row" id="row">

			<?php if ( have_posts() ) : ?>
				<div class="col col-1-of-1">
                    <header class="entry-header">
						<h2 class="entry-title">
				<!-- <header class="page-header"> -->
					<!-- <h1 class="page-title"> --><?php printf( __( 'Search Results for: %s', 'flat-commerce' ), '' . get_search_query() . '' ); ?><!-- </h1> -->
				<!-- </header> --><!-- .page-header -->
						</h2>
					</header>
				</div>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>


					<?php get_template_part( 'template-parts/content', 'search' ); ?>

				<?php endwhile; ?>

				<?php flat_commerce_archive_post_navigation(); ?>


			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

			</div><!-- .row -->
        </div><!-- .container -->
    </section><!-- #blog -->

<?php get_footer();
