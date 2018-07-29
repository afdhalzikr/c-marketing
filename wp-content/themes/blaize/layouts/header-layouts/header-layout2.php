<?php

	/** === Header Layout 2 === **/

	$blaize_display_top_header = get_theme_mod('blaize_display_top_header', 1);
	$blaize_header_layout = get_theme_mod('blaize_header_layout', 'layout1');
?>
	<?php if( $blaize_display_top_header ) : ?>
		<div class="top-header-wrap clearfix">
			<div class="blz-container">
				<div class="top-left-header">
					<?php
						$blaize_email_id = get_theme_mod('blaize_email_id', 'info@example.com');
						$blaize_phone_no = get_theme_mod('blaize_phone_no', '+987654321');
					?>

					<?php if($blaize_email_id) : ?>
						<a class="email" href="mailto:<?php echo esc_attr($blaize_email_id); ?>">
							<?php echo esc_attr($blaize_email_id); ?>
						</a>
					<?php endif; ?>

					<?php if($blaize_phone_no) : ?>
						<a class="phone" href="tel:<?php echo esc_attr($blaize_phone_no); ?>">
							<?php echo esc_attr($blaize_phone_no); ?>
						</a>
					<?php endif; ?>
				</div>

				<div class="top-right-header">
					<?php
						$blaize_top_social_links = get_theme_mod( 'blaize_top_social_links', '' );
						$social_links = json_decode( $blaize_top_social_links, true );
						
						if( $social_links ) {
							?>
							<ul class="social-links">
								<?php foreach($social_links as $social_link) : ?>
									<?php if( $social_link['social_link'] && $social_link['social_icon'] ) : ?>
										<li>
											<a href="<?php echo esc_url($social_link['social_link']); ?>"><i class="fab fa-<?php echo esc_attr($social_link['social_icon']); ?>"></i></a>
										</li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
							<?php
						}
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<header id="masthead" class="site-header clearfix <?php echo esc_attr($blaize_header_layout); ?>">
		<div class="menu-toggle-container clearfix">
			<div class="site-branding">
				<div class="blz-container">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$blaize_description = get_bloginfo( 'description', 'display' );
					if ( $blaize_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo wp_kses_post($blaize_description); /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<div class="blz-container">
					<a class="nav-toggle">
						<span></span>
						<span></span>
						<span></span>
					</a>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'main-menu',
						'menu_id'        => 'primary-menu',
						'container_class' => 'main-menu-container',
						'fallback_cb' => false,
					) );
					?>
				</div>
			</nav><!-- #site-navigation -->

			<?php do_action( 'blaize_popup_search_form' ); ?>
		</div>

		<?php
			wp_nav_menu( array(
				'theme_location' => 'main-menu',
				'menu_id'        => 'primary-menu',
				'container_class' => 'mbl-main-menu-container',
				'fallback_cb' => false,
			) );
		?>
	</header><!-- #masthead -->