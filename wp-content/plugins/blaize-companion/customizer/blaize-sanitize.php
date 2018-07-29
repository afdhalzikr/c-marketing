<?php

	/**
	 * Blaize Custom Sanitization Functions
	 **/

	/** Sanitize Checkbox **/
	function blaize_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

	/** Sanitize Dropdown Pages **/
	function blaize_sanitize_dropdown_pages( $page_id, $setting ) {
		// Ensure $input is an absolute integer.
		$page_id = absint( $page_id );
		
		// If $page_id is an ID of a published page, return it; otherwise, return the default.
		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	/** Sanitize Email ID **/
	function blaize_sanitize_email( $email, $setting ) {
		// Strips out all characters that are not allowable in an email address.
		$email = sanitize_email( $email );
		
		// If $email is a valid email, return it; otherwise, return the default.
		return ( ! is_null( $email ) ? $email : $setting->default );
	}

	/** Sanitize Hex Color **/
	function blaize_sanitize_hex_color( $hex_color, $setting ) {
		// Sanitize $input as a hex value without the hash prefix.
		$hex_color = sanitize_hex_color( $hex_color );
		
		// If $input is a valid hex value, return it; otherwise, return the default.
		return ( ! is_null( $hex_color ) ? $hex_color : $setting->default );
	}


	function blaize_sanitize_html( $html ) {
		return wp_filter_post_kses( $html );
	}

	/** Sanitize Image **/
	function blaize_sanitize_image( $image, $setting ) {
	    $mimes = array(
	        'jpg|jpeg|jpe' => 'image/jpeg',
	        'gif'          => 'image/gif',
	        'png'          => 'image/png',
	        'bmp'          => 'image/bmp',
	        'tif|tiff'     => 'image/tiff',
	        'ico'          => 'image/x-icon'
	    );

	    $file = wp_check_filetype( $image, $mimes );

	    return ( $file['ext'] ? $image : $setting->default );
	}

	/** Sanitize Textarea with no html allowed **/
	function blaize_sanitize_nohtml( $nohtml ) {
		return wp_filter_nohtml_kses( $nohtml );
	}

	/** Sanitize Number **/
	function blaize_sanitize_number_absint( $number, $setting ) {
		// Ensure $number is an absolute integer (whole number, zero or greater).
		$number = absint( $number );

		return ( $number ? $number : $setting->default );
	}

	/** Sanitize Select Options **/
	function blaize_sanitize_select( $input, $setting ) {
		
		$input = sanitize_key( $input );
		
		$choices = $setting->manager->get_control( $setting->id )->choices;
		
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	/** Repeater Sanitize **/
	function blaize_sanitize_repeater($input) {
	    $input_decoded = json_decode( $input, true );
	    $allowed_html = array(
	        'br' => array(),
	        'em' => array(),
	        'strong' => array(),
	        'a' => array(
	            'href' => array(),
	            'class' => array(),
	            'id' => array(),
	            'target' => array()
	        ),
	        'button' => array(
	            'class' => array(),
	            'id' => array()
	        )
	    );    
	    
	    if(!empty($input_decoded)) {
	        foreach ($input_decoded as $boxes => $box ){
	            foreach ($box as $key => $value){
	                $input_decoded[$boxes][$key] = sanitize_text_field( $value );
	            }
	        }
	        return json_encode($input_decoded);
	    }    
	    return $input;
	}