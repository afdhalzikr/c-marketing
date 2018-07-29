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
	get_header();
?>

	<section id="blog">
        <div class="container">
            <div class="row" id="content_row">
            	<div class="col col-1-of-1">
                    <header class="entry-header">
                    	<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                    </header><!-- .entry-header -->
                </div>
                <?php
					if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;
               wp_reset_query();
					flat_commerce_archive_post_navigation();

				else :

				get_template_part( 'template-parts/content', 'none' );

				endif; ?>

            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- #blog -->

<?php
get_footer();
