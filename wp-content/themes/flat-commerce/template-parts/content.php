<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flat_Commerce
 */
?>
<article id="post-<?php the_ID(); ?>" class="col col-1-of-3"  <?php post_class(); ?>>
    <div class="row">
        <div class="col col-12-of-12">
            <?php  do_action( 'flat_commerce_before_entry_container' ); ?>
            <header class="entry-header">
                <?php
                    the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
                ?>
            </header><!-- .entry-header -->

            <?php
            if ( 'post' == get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php flat_commerce_posted_on(); ?>
                </div><!-- .entry-meta -->
            <?php
            endif;?>

            <div class="entry-content">
                <?php
                the_content();
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flat-commerce' ),
                    'after'  => '</div>',
                ) );
                ?>
            </div><!-- .entry-content -->
        </div><!-- .col -->
    </div><!-- .row -->
</article><!-- #post-## -->
