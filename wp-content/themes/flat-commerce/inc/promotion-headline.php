<?php
if ( ! function_exists( 'flat_commerce_promotion_headline' ) ) :
	/**
	 * Template for Promotion Headline
	 *
	 * To override this in a child theme
	 * simply create your own flat_commerce_promotion_headline(), and that function will be used instead.
	 *
	 * @uses flat_commerce_before_main action to add it in the header
	 * @since Flat Commerce 0.1
	 */
	function flat_commerce_promotion_headline() {
		global $post, $wp_query;

	   $options 	= flat_commerce_get_theme_options();

		$enable_promotion 	= $options['promotion_headline_option'];

		// Front page displays in Reading Settings
		$page_on_front = get_option( 'page_on_front' ) ;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		 if ( ( ( $page_id == $page_on_front && $page_id > 0  ) && 'homepage' ==  $enable_promotion  ) ) {

		 	if( ( ! $flat_commerce_promotion_headline = get_transient( 'flat_commerce_promotion_headline' ) ) ) {
		 	  echo '<!-- refreshing cache of product slider -->';

				$flat_commerce_promotion_headline = '
					<section id="main-heading">
				        <div class="container">
				            <div class="row">
				                <div class="col col-1-of-1 col-centered ">';

				    					//Promotion Headline Left

										if ( "" != $options['promotion_headline'] ) {
											$flat_commerce_promotion_headline .= '<span>' . esc_html( $options['promotion_headline'] ) . '</span>';
										}

										if ( "" != $options['promotion_subheadline'] ) {
											$flat_commerce_promotion_headline .= '<div class="entry-header">
							                        <h1 class="entry-title">'
							                            . esc_html( $options['promotion_subheadline'] ) .
							                        '</h1>
							                      </div> ';
										}
							    	//Promotion Headline Right

					$flat_commerce_promotion_headline .= '
						  </div><!-- .col -->
				        </div><!-- .row -->
				    </div><!-- .container -->
				</section><!-- #main-heading -->';
			set_transient( 'flat_commerce_promotion_headline', $flat_commerce_promotion_headline, 86940 );
		}
		echo $flat_commerce_promotion_headline;
	}
}
endif; // flat_commerce_promotion_featured_content
add_action( 'flat_commerce_before_content', 'flat_commerce_promotion_headline', 40 );