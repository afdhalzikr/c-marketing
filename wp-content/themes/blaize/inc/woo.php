<?php
	/** Woocommerce Tweaks **/	
		// Change number or products per row to 3 for related products
		add_filter( 'woocommerce_output_related_products_args', 'blaize_related_products_args' );
	  	function blaize_related_products_args( $args ) {
			$args['posts_per_page'] = 3; // 4 related products
			$args['columns'] = 3; // arranged in 2 columns
			return $args;
		}