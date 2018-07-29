<?php
	/** About Us Section **/
	$blaize_about_title = get_theme_mod( 'blaize_about_title', '' );
	$blaize_about_desc_text = get_theme_mod( 'blaize_about_desc_text', '' );
	$blaize_about_page = get_theme_mod( 'blaize_about_page', 0);
	$blaize_about_readmore_text = get_theme_mod( 'blaize_about_readmore_text', '' );
	$blaize_about_readmore_link = get_theme_mod( 'blaize_about_readmore_link', '' );

	?>
	<div class='blz-container layout1'>
	<?php

	if( $blaize_about_title || $blaize_about_desc_text ) {
		?>
		<div class="section-title-wrap wow fadeInUp">
			<?php if($blaize_about_title) : ?>
				<h2 class="section-title"><?php echo esc_html($blaize_about_title); ?></h2>
			<?php endif; ?>

			<?php if($blaize_about_desc_text) : ?>
				<div class="section-desc">
					<?php echo esc_html($blaize_about_desc_text); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	if( $blaize_about_page ) {
		$about_pgquery = new WP_Query( array( 'page_id' => $blaize_about_page ) );

		if($about_pgquery->have_posts()) {
			while($about_pgquery->have_posts()) : $about_pgquery->the_post();
			?>
			<div class="aboutus-content-wrap clearfix">
				<div class="about-page-content wow slideInLeft">
					<div class="aboutus-section-pgcontent"><?php the_content(); ?></div>
					<?php if( $blaize_about_readmore_text ) : ?>
						<?php $blaize_about_readmore_link = ($blaize_about_readmore_link == '') ? get_the_permalink() : $blaize_about_readmore_link ?>
						<a class="blz-primary-btn blz-btn" href="<?php echo esc_url($blaize_about_readmore_link); ?>"><?php echo esc_html($blaize_about_readmore_text); ?></a>
					<?php endif; ?>
				</div>
				<?php
					if( has_post_thumbnail() ) {
						$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
						?>
						<div class="about-feat-image wow slideInRight">
							<figure>
								<img src="<?php echo esc_url($img[0]) ?>" alt="<?php echo esc_attr($alt); ?>" />
							</figure>	
						</div>
						<?php
					}
				?>
			</div>
			<?php
			endwhile;
			wp_reset_postdata();
		}
	}
?>
	</div>