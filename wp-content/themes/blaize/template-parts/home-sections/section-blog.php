<?php
	/** Blog Section **/
	$blaize_blog_title = get_theme_mod( 'blaize_blog_title', '' );
	$blaize_blog_desc_text = get_theme_mod( 'blaize_blog_desc_text', '' );
	$blaize_blog_exclude_category = get_theme_mod( 'blaize_blog_exclude_category', 0);
    $blaize_blog_no_of_post = get_theme_mod( 'blaize_blog_no_of_post', 3 );
	$blaize_blog_excerpt_length = get_theme_mod( 'blaize_blog_excerpt_length', 120 );
	$blaize_blog_readmore_text = get_theme_mod( 'blaize_blog_readmore_text', '' );
	?>
	<div class='blz-container'>

		<?php
			if( $blaize_blog_title || $blaize_blog_desc_text ) {
				?>
				<div class="section-title-wrap wow fadeInUp">
					<?php if($blaize_blog_title) : ?>
						<h2 class="section-title"><?php echo esc_html($blaize_blog_title); ?></h2>
					<?php endif; ?>

					<?php if($blaize_blog_desc_text) : ?>
						<div class="section-desc">
							<?php echo esc_html($blaize_blog_desc_text); ?>
						</div>
					<?php endif; ?>
				</div>
				<?php
			}
		?>

		<?php
			$cats = explode(',', $blaize_blog_exclude_category);
			$blg_query = new WP_Query( array( 'category__not_in' => $cats, 'posts_per_page' => $blaize_blog_no_of_post ) );
			$counter = 1;

			if($blg_query->have_posts()) {
				?>
				<div class="blz-blog-post-wrapper clearfix">
				<?php
				while($blg_query->have_posts()) : $blg_query->the_post();
				$blg_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blaize-blog-img' );
				$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
				$blg_day = get_the_date('j');
				$blg_month = get_the_date('M');
				?>
					<div class="wow fadeIn blz-blog-post <?php if( $counter%3 == 0 ) {echo "clearfix";} ?>">
						<figure class="blog-feat-img">
							<img src="<?php echo esc_url($blg_img[0]); ?>" alt="<?php echo esc_attr($alt); ?>" />
							<span>
								<i><?php echo esc_html($blg_day); ?></i>
								<i><?php echo esc_html($blg_month); ?></i>
							</span>
						</figure>
						<div class="blog-content">
							<a href="<?php the_permalink(); ?>">
								<h3><?php the_title(); ?></h3>
							</a>

							<p>
							<?php
								$content = substr( strip_tags( strip_shortcodes( get_the_content() ) ), 0, absint($blaize_blog_excerpt_length) );
								echo esc_html($content);
							?>
							</p>
						</div>
						<div class="blog-meta clearfix">
							<span>
								<a href="<?php the_permalink(); ?>"><?php echo esc_html($blaize_blog_readmore_text); ?></a>
							</span>
							<span><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></span>
						</div>
					</div>
				<?php
				$counter++;
				endwhile;
				wp_reset_postdata();
				?>
				<?php
			}
		?>

	</div>