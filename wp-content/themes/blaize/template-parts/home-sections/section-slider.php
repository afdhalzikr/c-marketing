<?php
	/** Slider Section **/
	$blaize_slides = array();
	for( $i = 1; $i <= 3; $i++ ) {
		$blaize_slides[$i]['slide_img'] = get_theme_mod( 'blaize_slide_img_' . $i, '' );
		$blaize_slides[$i]['caption_title'] = get_theme_mod( 'blaize_slide_cap_title_' . $i, '' );
		$blaize_slides[$i]['caption_descr'] = get_theme_mod( 'blaize_slide_cap_descr_' . $i, '' );
		$blaize_slides[$i]['btn_text'] = get_theme_mod( 'blaize_slide_btn_text_' . $i, '' );
		$blaize_slides[$i]['btn_link'] = get_theme_mod( 'blaize_slide_btn_link_' . $i, '' );
	}

	if( !empty($blaize_slides) ) {
		?>
		<div class="blz-main-slider owl-carousel">
			<?php foreach( $blaize_slides as $slide ) : ?>
				<?php if( $slide['slide_img'] ) : ?>
					<div class="blz-slide">
						<img src="<?php echo esc_url( $slide['slide_img'] ); ?>" />
						<div class="caption">
							<?php if( $slide['caption_title'] ) : ?>
								<h2><?php echo wp_kses_post( $slide['caption_title'] ) ?></h2>
							<?php endif; ?>

							<?php if( $slide['caption_descr'] ) : ?>
								<div><?php echo wp_kses_post( $slide['caption_descr'] ); ?></div>
							<?php endif; ?>

							<?php if( $slide['btn_text'] && $slide['btn_link'] ) : ?>
								<a class="blz-primary-btn blz-btn" href="<?php echo esc_url( $slide['btn_link'] ); ?>"><?php echo esc_html( $slide['btn_text'] ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php
	}