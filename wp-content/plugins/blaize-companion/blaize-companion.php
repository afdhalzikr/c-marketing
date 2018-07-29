<?php
defined('ABSPATH') or die("No script kiddies please!");
/**
 * Plugin Name: Blaize Companion
 * Plugin URI: http://www.paglithemes.com/blaize-companion
 * Description: A Plugin that adds customizer options and custom post types for the blaize theme.
 * Version: 1.0.3
 * Author: bnayawpbguy
 * Author URI: http://paglithemes.com
 * Text Domain: blaize-companion
 * Domain Path: /languages/
 * License:GPLv2 or later
 * */

if(!class_exists('Blaize_Companion')) :
    class Blaize_Companion {

        /** Initializing Plugin Constructor **/
        function __construct() {
            /** Defining Necessary Constants **/
            $this->define_constants();

            /** Registering Custom Post Types **/
            add_action( 'init', array($this, 'register_post_type'), 0 );

            /** Customizer Options **/
            add_action( 'init', array($this, 'customizer_options'), 0 );

            /** Custom Meta Options **/
            add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );

            /** Enqueue Admin Styles **/
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles_scripts' ) );
        }

        /**
         * Declartion of necessary constants for plugin
         * 
         * Previously declare outside the class
         * 
         * @since 1.6.3
         * 
         * */ 
        function define_constants(){

            defined( 'BLAIZE_COMPANION_VERSION' ) or define( 'BLAIZE_COMPANION_VERSION', '1.0.0' ); //plugin version
            defined( 'BLAIZE_COMPANION_JS_DIR' ) or define( 'BLAIZE_COMPANION_JS_DIR', plugin_dir_url( __FILE__ ) . 'js/' );  //plugin js directory
            defined( 'BLAIZE_COMPANION_CSS_DIR' ) or define( 'BLAIZE_COMPANION_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css/' ); // plugin css dir
            defined( 'BLAIZE_COMPANION_DIR' ) or define( 'BLAIZE_COMPANION_DIR', plugin_dir_url( __FILE__ ) ); // plugin css dir
            defined( 'BLAIZE_COMPANION_PATH' ) or define( 'BLAIZE_COMPANION_PATH', plugin_dir_path( __FILE__ ) ); // plugin path
            defined( 'BLAIZE_COMPANION_LANG_DIR' ) or define( 'BLAIZE_COMPANION_LANG_DIR', plugin_dir_path( __FILE__ ) ); // plugin language directory

        }

        function admin_styles_scripts() {
            wp_enqueue_style( 'blaize-companion-admin-styles', BLAIZE_COMPANION_CSS_DIR . 'admin-styles.css' );
        }

        // Register Custom Post Type
        function register_post_type() {
            /** Portfolio Post Type **/
            require_once BLAIZE_COMPANION_PATH.'/post-types/portfolio-post-type.php';

            /** Team Post Type **/
            require_once BLAIZE_COMPANION_PATH.'/post-types/team-post-type.php';

            /** Testimonial Post Type **/
            require_once BLAIZE_COMPANION_PATH.'/post-types/testimonial-post-type.php';
        }

        /** Adding Customizer Options **/
        function customizer_options() {
            require BLAIZE_COMPANION_PATH . 'customizer/customizer.php';
            require BLAIZE_COMPANION_PATH . 'customizer/blaize-iconset.php';
            require BLAIZE_COMPANION_PATH . 'customizer/blaize-custom-controls.php';
            require BLAIZE_COMPANION_PATH . 'customizer/blaize-sanitize.php';
            require BLAIZE_COMPANION_PATH . 'customizer/blaize-customizer.php';
            require BLAIZE_COMPANION_PATH . 'customizer/customizer-tabs/init.php';
        }

        /**
         * Meta box initialization.
         */
        public function init_metabox() {
            add_action( 'add_meta_boxes', array( $this, 'add_metabox'  ) );
            add_action( 'save_post', array( $this, 'save_team_metabox' ), 10, 2 );
            add_action( 'save_post', array( $this, 'save_testimonial_metabox' ), 10, 2 );
        }

        /**
         * Adds the meta box.
         */
        public function add_metabox() {
            add_meta_box(
                'team-metas',
                esc_html__( 'Team Member Details', 'blaize-companion' ),
                array( $this, 'render_team_metabox' ),
                'team',
                'advanced',
                'default'
            );
     
            add_meta_box(
                'testimonial-metas',
                esc_html__( 'Client Designation', 'blaize-companion' ),
                array( $this, 'render_testimonial_metabox' ),
                'testimonial',
                'advanced',
                'default'
            );
        }

        /**
         * Renders the team meta box.
         */
        public function render_team_metabox( $post ) {
            // Add nonce for security and authentication.
            wp_nonce_field( basename( __FILE__ ), 'blz_team_details' );

            $designation = get_post_meta( $post->ID, 'designation', true );
            $designation = empty($designation) ? '' : $designation;

            $facebook = get_post_meta( $post->ID, 'facebook', true );
            $facebook = empty($facebook) ? '' : $facebook;

            $twitter = get_post_meta( $post->ID, 'twitter', true );
            $twitter = empty($twitter) ? '' : $twitter;

            $gplus = get_post_meta( $post->ID, 'gplus', true );
            $gplus = empty($gplus) ? '' : $gplus;

            $linkedin = get_post_meta( $post->ID, 'linkedin', true );
            $linkedin = empty($linkedin) ? '' : $linkedin;

            $tumblr = get_post_meta( $post->ID, 'tumblr', true );
            $tumblr = empty($tumblr) ? '' : $tumblr;

            ?>
                <div class="blz-meta-options">
                    <label for="designation"><?php esc_html_e('Designation : ', 'blaize-companion'); ?></label>
                    <input type="text" name="designation" id="designation" value="<?php echo esc_attr($designation); ?>" />
                </div>

                <div class="blz-meta-heading"><?php esc_html_e( 'Social Icons', 'blaize-companion' ); ?></div>

                <div class="blz-meta-options">
                    <label for="facebook"><?php esc_html_e('Facebook URL : ', 'blaize-companion'); ?></label>
                    <input type="text" name="facebook" id="facebook" value="<?php echo esc_url($facebook); ?>" />
                </div>

                <div class="blz-meta-options">
                    <label for="twitter"><?php esc_html_e('Twitter URL : ', 'blaize-companion'); ?></label>
                    <input type="text" name="twitter" id="twitter" value="<?php echo esc_url($twitter); ?>" />
                </div>

                <div class="blz-meta-options">
                    <label for="gplus"><?php esc_html_e('Google+ URL : ', 'blaize-companion'); ?></label>
                    <input type="text" name="gplus" id="gplus" value="<?php echo esc_url($gplus); ?>" />
                </div>

                <div class="blz-meta-options">
                    <label for="linkedin"><?php esc_html_e('LinkedIn URL : ', 'blaize-companion'); ?></label>
                    <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_url($linkedin); ?>" />
                </div>

                <div class="blz-meta-options">
                    <label for="tumblr"><?php esc_html_e('Tumblr URL : ', 'blaize-companion'); ?></label>
                    <input type="text" name="tumblr" id="tumblr" value="<?php echo esc_url($tumblr); ?>" />
                </div>
            <?php
        }
        
        /**
         * Renders the testimonial meta box.
         */
        public function render_testimonial_metabox( $post ) {
            // Add nonce for security and authentication.
            wp_nonce_field( basename( __FILE__ ), 'blz_client_designation' );

            $designation = get_post_meta( $post->ID, 'designation', true );
            $designation = empty($designation) ? '' : $designation;
            ?>
                <div class="blz-meta-options">
                    <label for="designation"><?php esc_html_e('Designation : ', 'blaize-companion'); ?></label>
                    <input type="text" name="designation" id="designation" value="<?php echo esc_attr($designation); ?>" />
                </div>
            <?php
        }
     
        /**
         * Handles saving the team meta box.
         *
         * @param int     $post_id Post ID.
         * @param WP_Post $post    Post object.
         * @return null
         */
        public function save_team_metabox( $post_id, $post ) {
            // Add nonce for security and authentication.
            $nonce_name   = isset( $_POST['blz_team_details'] ) ? $_POST['blz_team_details'] : '';
            $nonce_action = basename( __FILE__ );
     
            // Check if nonce is set.
            if ( ! isset( $nonce_name ) ) {
                return;
            }
     
            // Check if nonce is valid.
            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
                return;
            }
     
           // Stop WP from clearing custom fields on autosave
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
                return;
            
            if ('team' == $_POST['post_type']) {  
                if (!current_user_can( 'edit_post', $post_id ) ) {  
                    return $post_id;
                }
            }

            /** Sanitize Meta Options **/
            $designation = isset($_POST['designation']) ? sanitize_text_field( $_POST['designation'] ) : '';
            $facebook = isset($_POST['facebook']) ? esc_url_raw( $_POST['facebook'] ) : '';
            $twitter = isset($_POST['twitter']) ? esc_url_raw( $_POST['twitter'] ) : '';
            $gplus = isset($_POST['gplus']) ? esc_url_raw( $_POST['gplus'] ) : '';
            $linkedin = isset($_POST['linkedin']) ? esc_url_raw( $_POST['linkedin'] ) : '';
            $tumblr = isset($_POST['tumblr']) ? esc_url_raw( $_POST['tumblr'] ) : '';

            /** Save Meta Options **/
            update_post_meta( $post_id, 'designation', $designation );
            update_post_meta( $post_id, 'facebook', $facebook );
            update_post_meta( $post_id, 'twitter', $twitter );
            update_post_meta( $post_id, 'gplus', $gplus );
            update_post_meta( $post_id, 'linkedin', $linkedin );
            update_post_meta( $post_id, 'tumblr', $tumblr );
        }
        
        /**
         * Handles saving the testimonial meta box.
         *
         * @param int     $post_id Post ID.
         * @param WP_Post $post    Post object.
         * @return null
         */
        public function save_testimonial_metabox( $post_id, $post ) {
            // Add nonce for security and authentication.
            $nonce_name   = isset( $_POST['blz_client_designation'] ) ? $_POST['blz_client_designation'] : '';
            $nonce_action = basename( __FILE__ );
     
            // Check if nonce is set.
            if ( ! isset( $nonce_name ) ) {
                return;
            }
     
            // Check if nonce is valid.
            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
                return;
            }
     
           // Stop WP from clearing custom fields on autosave
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
                return;
            
            if ('testimonial' == $_POST['post_type']) {  
                if (!current_user_can( 'edit_post', $post_id ) ) {  
                    return $post_id;
                }
            }

            /** Sanitize Meta Options **/
            $designation = isset($_POST['designation']) ? sanitize_text_field( $_POST['designation'] ) : '';

            /** Save Meta Options **/
            update_post_meta( $post_id, 'designation', $designation );
        }
    }

    new Blaize_Companion;
endif;