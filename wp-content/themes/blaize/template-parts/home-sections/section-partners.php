<?php
	/** Partners Section **/
	$blaize_partner_title = get_theme_mod( 'blaize_partner_title', '' );
	$blaize_partners = get_theme_mod( 'blaize_partners', '');
	$all_partners = json_decode($blaize_partners);
	?>
	<div class='blz-container'>
        <?php if($blaize_partner_title) : ?>
    		<div class="section-title-wrap">
    			<h2 class="section-title"><?php echo esc_html($blaize_partner_title); ?></h2>
    		</div>
        <?php endif; ?>
		
		<?php if( ! empty( $all_partners ) ) :  ?>
			<div class="blz-partners-slider owl-carousel clearfix">
				<?php foreach( $all_partners as $partner ) : ?>

					<?php if( $partner->partners_link ) : ?>
						<a href="<?php echo esc_url( $partner->partners_link ); ?>">
					<?php endif; ?>

						<?php if( $partner->partners_logo ) : ?>
							<img class="wow zoomInUp" data-wow-duration="2s" src="<?php echo esc_url( $partner->partners_logo ); ?>" />
						<?php endif; ?>

					<?php if( $partner->partners_link ) : ?>
						</a>
					<?php endif; ?>

				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>