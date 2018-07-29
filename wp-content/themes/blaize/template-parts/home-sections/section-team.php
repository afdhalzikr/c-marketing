<?php
	/** Team Section **/
	$blaize_team_title = get_theme_mod( 'blaize_team_title', '' );
	$blaize_team_desc_text = get_theme_mod( 'blaize_team_desc_text', '' );
	if( class_exists( 'Blaize_Companion' ) ) :
	?>
	<div class="blz-container">

		<?php if($blaize_team_title || $blaize_team_desc_text) : ?>
			<div class="section-title-wrap wow fadeInUp">			
					<?php if($blaize_team_title) : ?>
						<h2 class="section-title"><?php echo esc_html($blaize_team_title); ?></h2>
					<?php endif; ?>

					<?php if($blaize_team_desc_text) : ?>
					<div class="section-desc"><?php echo esc_html($blaize_team_desc_text); ?></div>
					<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php
			$tquery = new WP_Query( array( 'post_type' => 'team', 'posts_per_page' => -1, ) );

			if($tquery->have_posts()) {
				?>
				<div class="blz-team-slider owl-carousel clearfix">
					<?php
						while($tquery->have_posts()) {
							$tquery->the_post();

							$designation = get_post_meta( $post->ID, 'designation', true );
				            $facebook = get_post_meta( $post->ID, 'facebook', true );
				            $twitter = get_post_meta( $post->ID, 'twitter', true );
				            $gplus = get_post_meta( $post->ID, 'gplus', true );
				            $linkedin = get_post_meta( $post->ID, 'linkedin', true );
				            $tumblr = get_post_meta( $post->ID, 'tumblr', true );

							if(has_post_thumbnail()) {
								$timg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
								$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
								?>
									<div class="blz-team-member wow fadeInUp">
										<div class="team-member-img-wrap">
											<img src="<?php echo esc_url($timg[0]); ?>" alt="<?php echo esc_attr($alt); ?>" />		
										</div>
										<div class="team-details">
											<a href="<?php the_permalink(); ?>">
												<h3>
													<?php the_title(); ?>
													<?php if($designation) : ?>
														<span><?php echo esc_html($designation); ?></span>
													<?php endif; ?>
												</h3>
											</a>
										</div>

										<?php if( $facebook || $twitter || $gplus || $linkedin || $tumblr ) : ?>
											<div class="team-social-icons">
												<?php if($facebook) : ?>
													<a href="<?php echo esc_url($facebook); ?>"><i class="icon-facebook"></i></a>
												<?php endif; ?>

												<?php if($twitter) : ?>
													<a href="<?php echo esc_url($twitter); ?>"><i class="icon-twitter"></i></a>
												<?php endif; ?>

												<?php if($gplus) : ?>
													<a href="<?php echo esc_url($gplus); ?>"><i class="icon-googleplus"></i></a>
												<?php endif; ?>

												<?php if($linkedin) : ?>
													<a href="<?php echo esc_url($linkedin); ?>"><i class="icon-linkedin"></i></a>
												<?php endif; ?>

												<?php if($tumblr) : ?>
													<a href="<?php echo esc_url($tumblr); ?>"><i class="icon-tumblr"></i></a>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									</div>
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
<?php endif; // check if Blaize Companion Exists