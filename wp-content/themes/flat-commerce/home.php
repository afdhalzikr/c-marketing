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
 * @package Flat Commerce
 */
	get_header();
	$options  = flat_commerce_get_theme_options();
	$headline = isset ( $options ['latest_blog_heading'] ) ? $options ['latest_blog_heading'] : '';
?>

	<section id="blog">
        <div class="container">
            <div class="row" id="content_row">
            <?php if ( ! is_front_page() ) { ?>
            	<div class="col col-1-of-1">
                    <header class="entry-header">
                    		<h2 class="entry-title"><span><?php single_post_title(); ?></span></h2>
                    </header><!-- .entry-header -->
                </div>
            <?php } ?>
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
