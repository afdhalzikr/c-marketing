<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blaize
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'blaize_preloader' ); ?>
<div id="page" class="site">
	
	<?php $blaize_header_layout = get_theme_mod( 'blaize_header_layout', 'layout1' ); ?>

	<?php get_template_part('layouts/header-layouts/header', esc_attr($blaize_header_layout) ); ?>

	<?php do_action( 'blaize_page_header' ); ?>

	<div id="content" class="site-content">

		<?php if( ! is_page_template( 'tpl-frontpage.php' ) ) : ?>
			<div class="blz-container clearfix">
		<?php endif; ?>