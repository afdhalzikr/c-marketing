<?php
/**
 * The template for displaying portfolio archive page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blaize
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			
		<?php
			$port_sub_cats = get_terms( array('taxonomy' => 'portfolio-category', 'hide_empty' => false) );
		?>

		<?php if( !empty($port_sub_cats) ) : ?>
			<ul class="blz-portfolio-filter clearfix">
				<li class="blz-cat-name active" data-filter="*"><?php echo esc_html__( 'All', 'blaize' ); ?></li>
				<?php foreach( $port_sub_cats as $cate ) : ?>
					<li class="blz-cat-name" data-filter=".<?php echo esc_attr($cate->slug); ?>"><?php echo esc_html($cate->name); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<div class="blz-portfolio-wrap clearfix">
			<?php while ( have_posts() ) : the_post();

				$cats = get_the_terms(get_the_ID(), 'portfolio-category');
				$cat_names = '';
				foreach($cats as $cat) {
					$cat_names .= $cat->slug.' ';
				} $cat_names = rtrim($cat_names);

				if(has_post_thumbnail()) :
					$blz_port_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blaize-portfolio-img' );
					$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
				?>
					<figure class="portfolio-post <?php echo esc_attr($cat_names); ?>">
						<div class="portfolio-content-in">
							<img src="<?php echo esc_url($blz_port_img[0]); ?>" alt="<?php echo esc_attr($alt); ?>"/>
							<figcaption>
								<a href="<?php the_permalink(); ?>">
									<h3><?php the_title(); ?></h3>
								</a>
								
								<span class="project-manager">
									<?php echo wp_kses_post( get_avatar( get_the_author_meta( 'user_email' ), 50 ) ); ?>

									<?php echo esc_html( get_the_author_meta( 'nickname' ) ); ?>
								</span>
							</figcaption>			
						</div>
					</figure>
				<?php
				endif;
			endwhile; ?>
			</div>
		<?php endif; ?>

	</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();