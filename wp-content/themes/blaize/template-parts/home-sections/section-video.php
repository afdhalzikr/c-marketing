<?php
	/** Video Section **/
	$blaize_video_title = get_theme_mod( 'blaize_video_title', '' );
	$blaize_video_desc_text = get_theme_mod( 'blaize_video_desc_text', '' );
	$blaize_video_placeholder = get_theme_mod( 'blaize_video_placeholder', '' );
	$blaize_video_url = get_theme_mod( 'blaize_video_url', '');
	$blaize_video_readmore_text = get_theme_mod( 'blaize_video_readmore_text', '' );
	$blaize_video_readmore_link = get_theme_mod( 'blaize_video_readmore_link', '' );
	?>
	<?php if( $blaize_video_placeholder && ( $blaize_video_title || $blaize_video_desc_text ) ) : ?>
		<div class="blz-container clearfix">

			<div class="blz-vdo-placeholder wow fadeInLeft">
				<img class="vdo-img" src="<?php echo esc_url( $blaize_video_placeholder ); ?>" />

				<?php if( $blaize_video_url ) : ?>
					<?php $vid_arr = explode( '?v=', $blaize_video_url ); ?>
					<a class="blz-video-popup" href="javascript:void(0)" data-video-id="<?php echo esc_attr($vid_arr[1]); ?>">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/images/youtube.png' ); ?>" />
					</a>
				<?php endif; ?>

			</div>

			<div class="blz-vdo-contents wow fadeInRight">
				<?php if($blaize_video_title) : ?>
					<h2 class="vdo-title"><?php echo esc_html($blaize_video_title); ?></h2>
				<?php endif; ?>

				<?php if( $blaize_video_desc_text ) : ?>
					<div class="vdo-desc">
						<?php echo esc_html( $blaize_video_desc_text ); ?>
					</div>
				<?php endif; ?>

				<?php if( $blaize_video_readmore_text && $blaize_video_readmore_link ) : ?>
					<a class="blz-primary-btn blz-btn" href="<?php echo esc_url($blaize_video_readmore_link); ?>">
						<?php echo esc_html($blaize_video_readmore_text); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>