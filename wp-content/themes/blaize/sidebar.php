<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blaize
 */

$blaize_sidebar_layout = 'right-sidebar';

if( is_page() ) {
	global $post;
	
	$blaize_page_sidebar_layout = get_post_meta( $post->ID, 'blaize_page_sidebar_layout', true);
	$blaize_sidebar_layout = ($blaize_page_sidebar_layout == '') ? 'right-sidebar' : $blaize_page_sidebar_layout;
}

?>

<?php if( $blaize_sidebar_layout != 'no-sidebar' ) : ?>

	<?php if(is_active_sidebar( $blaize_sidebar_layout )) : ?>
		<aside id="secondary" class="widget-area">
			<?php dynamic_sidebar( esc_attr($blaize_sidebar_layout) ); ?>
		</aside><!-- #secondary -->
	<?php endif; ?>

<?php endif; ?>