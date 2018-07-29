<?php
	/** Testimoinal Section **/
	$blaize_testimonial_layout = get_theme_mod( 'blaize_testimonial_layout', 'layout1' );
	$blaize_testimonial_title = get_theme_mod( 'blaize_testimonial_title', '' );
	$blaize_testimonial_desc_text = get_theme_mod( 'blaize_testimonial_desc_text', '' );
	if( class_exists( 'Blaize_Companion' ) ) :
	?>
	<div class="blz-container">

		<?php if($blaize_testimonial_title || $blaize_testimonial_desc_text) : ?>
			<div class="section-title-wrap wow slideInUp">			
					<?php if($blaize_testimonial_title) : ?>
						<h2 class="section-title"><?php echo esc_html($blaize_testimonial_title); ?></h2>
					<?php endif; ?>

					<?php if($blaize_testimonial_desc_text) : ?>
					<div class="section-desc"><?php echo esc_html($blaize_testimonial_desc_text); ?></div>
					<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php
			$tsquery = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => -1, ) );

			if($tsquery->have_posts()) {
				?>
				<div class="blz-testimonial-slider owl-carousel clearfix wow zoomIn <?php echo esc_attr( $blaize_testimonial_layout ); ?>">
					<?php
						while($tsquery->have_posts()) {
							$tsquery->the_post();
                            $designation = get_post_meta( $post->ID, 'designation', true );
							if(has_post_thumbnail()) {
								$timg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blaize-portfolio-img' );
								$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
								?>
									<?php if($blaize_testimonial_layout == 'layout1') : ?>
										<div class="blz-client">
											<div class="client-img">
												<img src="<?php echo esc_url($timg[0]); ?>" alt="<?php echo esc_attr($alt); ?>" >		
											</div>
											<div class="blz-testimony">
												<?php echo esc_html(get_the_content()); ?>
											</div>
											<div class="client-details">
												
												<?php the_title( '<h3>', '</h3>' ); ?>
												
											</div>
										</div>
									<?php else : ?>
										<div class="blz-client">
											<div class="blz-testimony">
												<?php echo esc_html(get_the_content()); ?>
											</div>
											<div class="client-img-details clearfix">
												<div class="client-img">
													<img src="<?php echo esc_url($timg[0]); ?>" alt="<?php echo esc_attr($alt); ?>" >		
												</div>
												<div class="client-details">
													<h3>
                                                        <?php the_title(); ?>
                                                        <?php if($designation) : ?>
                                                            <span><?php echo esc_html($designation); ?></span>
                                                        <?php endif; ?>
                                                    </h3>													
												</div>
											</div>
										</div>
									<?php endif; ?>
								<?php
							}
						}
						wp_reset_postdata();
					?>
				</div>
				<?php
			}
		?>
	</div>
<?php endif; // If Blaize Companion Exists