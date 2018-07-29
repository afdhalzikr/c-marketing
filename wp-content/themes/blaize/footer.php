<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blaize
 */

?>
		<?php if( ! is_page_template( 'tpl-frontpage.php' ) ) : ?>
			</div> <!-- blz-container -->
		<?php endif; ?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<?php if( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
				<div class="footer-top-widgets clearfix">

					<div class="blz-container clearfix">
						<?php if( is_active_sidebar( 'footer-1' ) ) : ?>
							<div class="footer-widget footer-1">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div>
						<?php endif; ?>

						<?php if( is_active_sidebar( 'footer-2' ) ) : ?>
							<div class="footer-widget footer-2">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</div>
						<?php endif; ?>

						<?php if( is_active_sidebar( 'footer-3' ) ) : ?>
							<div class="footer-widget footer-3">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</div>
						<?php endif; ?>

						<?php if( is_active_sidebar( 'footer-4' ) ) : ?>
							<div class="footer-widget footer-4">
								<?php dynamic_sidebar( 'footer-4' ); ?>
							</div>
						<?php endif; ?>
					</div>

				</div>

		<?php endif; ?>
		<div>
			
		</div>

		<?php
			$blaize_footer_text = get_theme_mod('blaize_footer_text', '');
		?>

		<?php if( $blaize_footer_text ) : ?>
			<div class="site-info">

				<div class="blz-container">
					<?php echo wp_kses_post( $blaize_footer_text ); ?>	
				</div>

			</div><!-- .site-info -->
		<?php endif; ?>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>