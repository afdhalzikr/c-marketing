<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blaize
 */

?>
<?php if( get_post_type() == 'post' ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blz-post-content clearfix">
		<div class="post-date">
			<span class="dt">
				<?php echo get_the_date('j, M'); ?>
			</span>
		</div>
		<div class="post-metas-content">
			<div class="post-metas">
				<span class="post-categories">
					<i class="fas fa-folder-open"></i>
					<?php the_category( ', ' ); ?>
				</span>
				<?php if( has_tag() ) : ?>
					<span class="post-tags">
						<i class="fas fa-tags"></i>
						<?php the_tags( '', ', ', '' ); ?>
					</span>
				<?php endif; ?>
				<?php if( get_comments_number() ) : ?>
					<span class="post-comments">
						<i class="fas fa-comments"></i>
						<?php comments_number( 'no responses', 'one response', '% responses' ); ?>
					</span>
				<?php endif; ?>
			</div>
			<div class="entry-content">
				
				<?php blaize_post_thumbnail(); ?>
				
				<div class="blz-post-innercontent">
					<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blaize' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blaize' ),
						'after'  => '</div>',
					) );
					?>
				</div>
			</div><!-- .entry-content -->
		</div>
	</div>

	<footer class="entry-footer">
		<?php blaize_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php else : ?>
	<?php the_content(); ?>
<?php endif; ?>