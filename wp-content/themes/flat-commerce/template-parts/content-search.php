<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flat_Commerce
 */
$options = flat_commerce_get_theme_options();
?>
<article class="col col-1-of-3 col-m-1-of-3" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col col-2-of-12 left-part">
            <?php
            if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php flat_commerce_posted_on(); ?>
			</div><!-- .entry-meta -->
            <div class="category">
                <?php flat_commerce_tag_category(); ?>
            </div><!-- .col -->
			<?php
			endif;?>
        </div><!-- .col -->

        <div class="col col-10-of-12">
        	<?php
            if ( has_post_thumbnail() ) { ?>
            <figure class="featured-image">
                <a rel="bookmark" href="<?php the_permalink(); ?>">
                <?php
                    the_post_thumbnail( 'flat-commerce-latest-blog' );
                ?>
                </a>
            </figure>
            <?php } ?>

            <header class="entry-header">
				<?php
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				?>
			</header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                    the_excerpt();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flat-commerce' ),
						'after'  => '</div>',
					) );
				?>
            </div><!-- .entry-content -->
        </div><!-- .col -->
	</div><!-- .row -->
</article><!-- #post-## -->
