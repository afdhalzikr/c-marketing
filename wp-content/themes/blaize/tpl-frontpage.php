<?php
/**
 * The template for displaying all pages
 *
 * Template Name: Front Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blaize
 */

get_header();
?>

	<?php
		$blaze_default_hm_sections = array(
			'blaize_service_section',
			'blaize_about_section',
			'blaize_counter_section',
			'blaize_portfolio_section',
			'blaize_team_section',
			'blaize_video_section',
			'blaize_testimonial_section',
			'blaize_blog_section',
			'blaize_partners_section'
		);

		$blaize_home_sections = get_theme_mod( 'blaize_home_sections', $blaze_default_hm_sections );

		$blaize_enable_slider_section = get_theme_mod( 'blaize_enable_slider_section', false );
	?>

	<!-- Slider Section -->
	<?php if( $blaize_enable_slider_section ) : ?>
		<section class="blz-slider-section home-section clearfix">
			<?php get_template_part( 'template-parts/home-sections/section', 'slider' ); ?>
		</section>
	<?php endif; ?>

	<!-- Home Sections -->
	<?php foreach( $blaize_home_sections as $section ) : ?>
		<?php
			$section = str_replace( array( 'blaize_', '_section' ), '', $section );
			$blaize_enable_section = get_theme_mod('blaize_enable_'.$section.'_section', false );
		?>

		<?php if($blaize_enable_section) : ?>
			<section class="blz-<?php echo esc_attr($section); ?>-section home-section clearfix">
				<?php get_template_part( 'template-parts/home-sections/section', $section ); ?>
			</section>
		<?php endif; ?>
	<?php endforeach; ?>

<?php
get_footer();