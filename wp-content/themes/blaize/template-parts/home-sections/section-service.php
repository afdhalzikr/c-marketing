<?php
	/** Service Section **/
	$blaize_service_title = get_theme_mod( 'blaize_service_title', '' );
	$blaize_service_desc_text = get_theme_mod( 'blaize_service_desc_text', '' );
	$default_services = array(
     	array(
            'service_icon' => 'desktop' ,
            'service_title' => '',
            'service_description' => '',
        ),
        array(
            'service_icon' => 'briefcase' ,
            'service_title' => '',
            'service_description' => '',
        ),
        array(
            'service_icon' => 'clock' ,
            'service_title' => '',
            'service_description' => '',
        ),
 	);

	$blaize_service = get_theme_mod( 'blaize_service', json_encode( $default_services ));

	$all_services = json_decode($blaize_service);
	?>
	<div class='blz-container'>

		<?php
			if( $blaize_service_title || $blaize_service_desc_text ) {
				?>
				<div class="section-title-wrap wow fadeIn" data-wow-duration="2s" >
					<?php if($blaize_service_title) : ?>
						<h2 class="section-title"><?php echo esc_html($blaize_service_title); ?></h2>
					<?php endif; ?>

					<?php if($blaize_service_desc_text) : ?>
						<div class="section-desc">
							<?php echo esc_html( $blaize_service_desc_text ); ?>
						</div>
					<?php endif; ?>
				</div>
				<?php
			}
		?>

		<?php
			if( !empty($all_services) ) {
				?>
				<div class="blz-services-wrapper clearfix">
					<?php $counter = $animate_counter = 1; $animate_class = 'wow fadeInLeft'; ?>
					<?php foreach($all_services as $service) : ?>
						<?php
							if( $animate_counter == 2 ) {
								$animate_class = 'wow fadeInUp';
							} elseif( $animate_counter == 3 ) {
								$animate_class = 'wow fadeInRight';
							}
						?>
						<div class="blz-service <?php echo esc_attr($animate_class); ?>" >
							<span class="service-icon <?php echo esc_attr( $service->service_icon ); ?>"></span>
							<h3 class="service-title"><?php echo esc_html( $service->service_title ); ?></h3>
							<p class="service-description"><?php echo esc_html( $service->service_description ); ?></p>
						</div>

						<?php if( $counter%3 == 0 ) : $animate_counter = 1; ?>
							<div class="cls-height"></div>
						<?php endif; $counter++; $animate_counter++; ?>
					<?php endforeach; ?>
				</div>
				<?php
			}
		?>

	</div>