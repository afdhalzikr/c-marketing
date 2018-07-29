<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flat_Commerce
 */

?>

<article id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>
    <div class="entry-header">
        <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
    </div><!-- .entry-header -->
    <?php do_action( 'flat_commerce_before_page_container' ); ?>
    <div class="date">
        <?php flat_commerce_posted_on(); ?>
    </div><!-- .col -->
    <div class="category">
        <?php flat_commerce_tag_category(); ?>
    </div><!-- .col -->

    <?php do_action( 'flat_commerce_before_post_container' ); ?>
    <div class="entry-content">
       <?php
        the_content();
        wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flat-commerce' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

</article><!-- article -->

