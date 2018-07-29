<?php
    /**
     * Section Reorder
    **/
    add_action( 'wp_ajax_blaize_reorder_home_section', 'blaize_reorder_home_section' );
    add_action( 'wp_ajax_nopriv_blaize_reorder_home_section', 'blaize_reorder_home_section' );
    function blaize_reorder_home_section() {

        if ( isset( $_POST['sections'] ) ) {
            set_theme_mod( 'blaize_home_sections', $_POST['sections'] );
            echo 'succes';
        }
        wp_die(); // this is required to terminate immediately and return a proper response
    }

    if ( ! function_exists( 'blaize_get_sections_position' ) ) {
        function blaize_get_sections_position() {
            $defaults = array(
    			'blaize_service_section',
    			'blaize_about_section',
    			'blaize_counter_section',
    			'blaize_portfolio_section',
    			'blaize_team_section',
    			'blaize_video_section',
    			'blaize_testimonial_section',
    			'blaize_blog_section',
    			'blaize_partners_section'
            );
            $sections = get_theme_mod( 'blaize_home_sections', $defaults );
            return $sections;
        }
    }

    if ( ! function_exists( 'blaize_get_section_position' ) ) {
        function blaize_get_section_position( $key ) {
            $sections = blaize_get_sections_position();
            $position = array_search( $key, $sections );
            $return   = ( $position + 1 ) * 10;

            return $return;
        }
    }