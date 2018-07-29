<?php
	/** Counter Section **/
		$blaize_counter = array();

		$blaize_counter['icon'][1] = get_theme_mod( 'blaize_counter_icon1', 'trophy' );
		$blaize_counter['number'][1] = get_theme_mod( 'blaize_counter1', 158 );
		$blaize_counter['title'][1] = get_theme_mod( 'blaize_counter_title1', '' );

		$blaize_counter['icon'][2] = get_theme_mod( 'blaize_counter_icon2', 'layers' );
		$blaize_counter['number'][2] = get_theme_mod( 'blaize_counter2', 258 );
		$blaize_counter['title'][2] = get_theme_mod( 'blaize_counter_title2', '' );

		$blaize_counter['icon'][3] = get_theme_mod( 'blaize_counter_icon3', 'happy' );
		$blaize_counter['number'][3] = get_theme_mod( 'blaize_counter3', 358 );
		$blaize_counter['title'][3] = get_theme_mod( 'blaize_counter_title3', '' );

		$blaize_counter['icon'][4] = get_theme_mod( 'blaize_counter_icon4', 'download' );
		$blaize_counter['number'][4] = get_theme_mod( 'blaize_counter4', 458 );
		$blaize_counter['title'][4] = get_theme_mod( 'blaize_counter_title4', '' );

	echo "<div class='blz-container clearfix'>";
		for( $i = 1; $i <= 4; $i++ ) :
			?>
			<div class="blz-counter wow fadeIn">

				<?php if( $blaize_counter['icon'][$i] ) : ?>
					<span class="counter-icon icon-<?php echo esc_attr($blaize_counter['icon'][$i]); ?>"></span>
				<?php endif; ?>

				<?php if( !empty($blaize_counter['number'][$i]) ) : ?>
			    	<div class="counter"><?php echo absint($blaize_counter['number'][$i]); ?></div>
			    <?php endif; ?>

			    <?php if( $blaize_counter['title'][$i] ) : ?>
			    	<h3 class="title"><?php echo esc_html($blaize_counter['title'][$i]); ?></h3>
				<?php endif; ?>
			</div>
			<?php
		endfor;
	echo "</div>";