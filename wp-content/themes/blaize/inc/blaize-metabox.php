<?php
	/** Variable Used **/
	$blaize_sidebar_options = array(
	    'right-sidebar' => array(
	        'value' => 'right-sidebar',
	        'label' => esc_html__( 'Right Sidebar', 'blaize' ),
	        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'
	    ),
	    'left-sidebar' => array(
	        'value'     => 'left-sidebar',
	        'label' => esc_html__( 'Left Sidebar', 'blaize' ),
	        'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'
	    ),
	    'no-sidebar' => array(
	        'value'     => 'no-sidebar',
	        'label' => esc_html__( 'No Sidebar', 'blaize' ),
	        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png'
	    )

	);

	/**
	 * Register meta box(es).
	 */
	function blaize_register_meta_boxes() {
	    add_meta_box(
	        'blaize_page_sidebar_layout', // $id
	        esc_html__( 'Sidebar Layout', 'blaize' ),
	        'blaize_page_sidebar_layout_callback', // $callback
	        'page', // $page
	        'normal', // $context
	        'high'
        ); // $priority
	}
	add_action( 'add_meta_boxes', 'blaize_register_meta_boxes' );
	 
	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	function blaize_page_sidebar_layout_callback( $post ) {
	    global $post , $blaize_sidebar_options;
	    wp_nonce_field( basename( __FILE__ ), 'blaize_page_sidebar_layout_nonce' );
	    ?>

	    <table class="form-table page-meta-box">
	        <tr>
	            <td colspan="4"><?php esc_html_e( 'Choose Sidebar Template', 'blaize' ); ?></td>
	        </tr>

	        <tr>
	            <td>
	                <?php
	                foreach ($blaize_sidebar_options as $field) {
	                    $blaize_page_sidebar_layout = get_post_meta( $post->ID, 'blaize_page_sidebar_layout', true ); 

	                    $blaize_page_sidebar_layout = ( $blaize_page_sidebar_layout != '' ) ? $blaize_page_sidebar_layout : 'right-sidebar';
	                    ?>

	                    <div style="float:left; margin-right:30px;">
                            <div class="blz-meta-img">
                            	<img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        	</div>
	                        <label>
	                            <input id="<?php echo esc_attr($field['value']); ?>" type="radio" name="blaize_page_sidebar_layout" value="<?php echo esc_attr($field['value']); ?>" <?php checked($field['value'], $blaize_page_sidebar_layout ); ?>/>
	                        	<span><?php echo esc_html( $field['label'] ); ?></span>
	                        </label>
	                    </div>
	                <?php } // end foreach
	                ?>
	                <div class="clear"></div>
	            </td>
	        </tr>
	    </table>
    <?php
	}
	 
	/**
	 * Save meta box content.
	 *
	 * @param int $post_id Post ID
	 */
	function blaize_save_meta_box( $post_id ) {
	    global $blaize_page_sidebar_layout, $post;

	    // Verify the nonce before proceeding.
	    if ( !isset( $_POST[ 'blaize_page_sidebar_layout_nonce' ] ) || !wp_verify_nonce( sanitize_text_field(wp_unslash($_POST[ 'blaize_page_sidebar_layout_nonce' ])), basename( __FILE__ ) ) )
	        return;

	    // Stop WP from clearing custom fields on autosave
	    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
	        return;

	    if ( isset($_POST['post_type']) && 'page' == sanitize_text_field( wp_unslash($_POST['post_type']) ) ) {
	        if (!current_user_can( 'edit_page', $post_id ) )
	            return $post_id;
	    } elseif (!current_user_can( 'edit_post', $post_id ) ) {
	        return $post_id;
	    }

	    $old = get_post_meta( $post_id, 'blaize_page_sidebar_layout', true );
	    $new = (isset($_POST['blaize_page_sidebar_layout'])) ? sanitize_text_field(wp_unslash($_POST['blaize_page_sidebar_layout'])) : $old;

	    if ($new && $new != $old) {
            update_post_meta($post_id, 'blaize_page_sidebar_layout', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'blaize_page_sidebar_layout', $old);
        }
	}
	add_action( 'save_post', 'blaize_save_meta_box' );