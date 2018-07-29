<?php
/**
 * Validation functions for Theme/Customzer Options
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.9
 */

/*
 * Function to validate social media number
 */
function flat_commerce_validate_social_media_number( $validity, $value ){
    $value = intval( $value );
    if ( $value < 0 ) {
       $validity->add( 'min_social_media_number', __( 'Minimum social media number is 0', 'flat-commerce' ) );
    } elseif ( $value > 5 ) {
       $validity->add( 'max_social_media_number', __( 'Maximum social media number is 5', 'flat-commerce' ) );
    }elseif ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'flat-commerce' ) );
    }
    return $validity;
}

/*
 * Function to validate product content number
 */
function flat_commerce_validate_product_content_number( $validity, $value ){
    $value = intval( $value );
   	if ( $value < 1 ) {
       $validity->add( 'min_product_content_number', __( 'Minimum product content number is 1', 'flat-commerce' ) );
    } elseif ( $value > 6 ) {
       $validity->add( 'max_product_content_number', __( 'Maximum product content number is 6', 'flat-commerce' ) );
    }elseif ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'flat-commerce' ) );
    }
    return $validity;
}

/*
 * Function to validate slide transition delay
 */
function flat_commerce_validate_slide_transition_delay( $validity, $value ){
    $value = intval( $value );
    if ( $value < 1 ) {
       $validity->add( 'min_slider_transition_delay', __( 'Minimum slide transition delay is 1', 'flat-commerce' ) );
    }
    elseif ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'flat-commerce' ) );
    }
    return $validity;
}

/*
 * Function to validate slide transition length
 */
function flat_commerce_validate_slide_transition_length( $validity, $value ){
    $value = intval( $value );
   	if ( $value < 1 ) {
       $validity->add( 'min_slider_transition_length', __( 'Minimum slide transition length is 1', 'flat-commerce' ) );
    }
    elseif ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'flat-commerce' ) );
    }
    return $validity;
}

/*
 * Function to validate featureds slide number
 */
function flat_commerce_validate_featured_slide_number( $validity, $value ){
    $value = intval( $value );
    if ( $value < 0 ) {
       $validity->add( 'min_featured_slide_number', __( 'Minimum featured slide number is 0', 'flat-commerce' ) );
    }elseif ( $value > 10 ) {
       $validity->add( 'max_featured_slide_number', __( 'Maximum featured slide number is 10', 'flat-commerce' ) );
    }
    elseif ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'flat-commerce' ) );
    }
    return $validity;
}

/*
 * Function to validate no of products for category
 */
function flat_commerce_validate_no_of_products_for_category( $validity, $value ){
    $value = intval( $value );
    if ( $value < 1 ) {
       $validity->add( 'min_products_for_category', __( 'Minimum number of products is 1', 'flat-commerce' ) );
    }elseif ( $value > 15 ) {
       $validity->add( 'max_products_for_category', __( 'Maximum number of products is 15', 'flat-commerce' ) );
    }
    elseif ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'flat-commerce' ) );
    }
    return $validity;
}

/*
 * Function to validate recent products visible number
 */
function flat_commerce_validate_recent_products_visible_no( $validity, $value ){
    $value = intval( $value );
    if ( $value < 1 ) {
       $validity->add( 'min_recent_products_visible_no', __( 'Minimum number of recent product visible is 1', 'flat-commerce' ) );
    }elseif ( $value > 10 ) {
       $validity->add( 'max_recent_products_visible_no', __( 'Maximum  number of recent product visible is 10', 'flat-commerce' ) );
    }
    elseif ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'flat-commerce' ) );
    }
    return $validity;
}

/*
 * Function to validate custom social icons
 */
function flat_commerce_validate_custom_social_icons( $validity, $value ){
    $value = intval( $value );
    if ( $value < 0 ) {
       $validity->add( 'min_custom_social_icons', __( 'Minimum number of custom social icons is 1', 'flat-commerce' ) );
    }elseif ( $value > 10 ) {
       $validity->add( 'max_custom_social_icons', __( 'Maximum  number of custom social icons is 10', 'flat-commerce' ) );
    }
    elseif ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'flat-commerce' ) );
    }
    return $validity;
}

/*
 * Function to validate latest blog layout
 */
function flat_commerce_validate_latest_blog_layout( $validity, $value ){
    $value = intval( $value );
    if ( $value < 1 ) {
       $validity->add( 'min_latest_blog_layout', __( 'Minimum  latest blog layout is 1', 'flat-commerce' ) );
    }elseif ( $value > 3 ) {
       $validity->add( 'max_latest_blog_layout', __( 'Maximum  latest blog layout is 3', 'flat-commerce' ) );
    }
    elseif ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'flat-commerce' ) );
    }
    return $validity;
}

/*
 * Function to validate latest blog number
 */
function flat_commerce_latest_blog_posts_number( $validity, $value ){
    $value = intval( $value );
    if ( $value < 1 ) {
       $validity->add( 'min_latest_blog_posts_number', __( 'Minimum  latest blog number is 1', 'flat-commerce' ) );
    }elseif ( $value > 6 ) {
       $validity->add( 'max_latest_blog_posts_number', __( 'Maximum  latest blog number is 6', 'flat-commerce' ) );
    }
    elseif ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'flat-commerce' ) );
    }
    return $validity;
}