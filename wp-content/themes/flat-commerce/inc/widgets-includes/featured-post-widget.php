<?php
/**
 * The template for adding Featured post widget
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */

if ( ! defined( 'FLAT_COMMERCE_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * Widget that shows selected page content and the title.
 * Construct the widget.
 * i.e. Name, description and control options.
 * Has form to ask the title, select page
 * In the display function we show the title and selected page's content.
 * If the title is not set, it shows the page title as the title.
 *
 */
/**
 * Featured post widget
 *
 * @since Flat Commerce 0.1
 */
class Flatcommerce_featured_post_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'flat_commerce_post_widget', // Base ID
			__( 'TP: Featured Post', 'flat-commerce' ), // Name
			array( 'description' => __( 'Display Featured Post. Suitable for Home Top Area and Home Left Area', 'flat-commerce' ) ) // Args
		);
	}

	function form( $instance ) {
		global $flat_commerce_valid_id;

		//Defaults
 		$instance = wp_parse_args( (array) $instance, array(
							'title'                  => '',
							'post_id'                => '',
							'disable_featured_image' => 0,
							'image_position'         => 'above',
							'show_content'           => 'excerpt',
							'excerpt_length'         => 200
						) );

		$post_id                = absint( $instance['post_id'] );
		$title                  = esc_attr( $instance['title'] );
		$disable_featured_image = $instance['disable_featured_image'] ? 'checked="checked"' : '';
		$image_position         = $instance['image_position'];
		$show_content           = $instance['show_content'];
		$excerpt_length         = absint( $instance['excerpt_length'] ); ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'flat-commerce' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ), 'flat-commerce' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

	     <p>
			<?php _e( 'Displays the title of the Post if title input is empty.', 'flat-commerce' ); ?>
	     </p>

	     <p>
	     	<label for="<?php echo esc_attr( $this->get_field_id( 'post_id' ) ); ?>"><?php _e( 'ID of the Post:', 'flat-commerce'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'post_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_id' ), 'flat-commerce' ); ?>" type="text" value="<?php echo $post_id; ?>" size="5" /> <br />
			<?php
			if( ! empty( $flat_commerce_valid_id ) ) {
				if( $flat_commerce_valid_id=='not_valid') {
					echo '<strong>'. __( 'This Post ID is Not Valid', 'flat-commerce' ) .'</strong>';
				}
			}
			?>
	     </p>

	     <p>
	     	<input class="checkbox" type="checkbox" <?php checked( $instance['disable_featured_image'], true ) ?> id="<?php echo esc_attr( $this->get_field_id( 'disable_featured_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'disable_featured_image' ), 'flat-commerce' ); ?>" />
	     	<label for="<?php echo esc_attr( $this->get_field_id( 'disable_featured_image' ) );?>"><?php _e( 'Remove Featured image', 'flat-commerce' ); ?></label><br />
	     </p>

	    <?php if( $image_position == 'above' ) { ?>
            <p>
                <input type="radio" id="<?php echo esc_attr( $this->get_field_id( 'image_position' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_position' ), 'flat-commerce' ); ?>" value="above" style="" checked /><?php _e( 'Show Image Before Title', 'flat-commerce' );?><br />
                <input type="radio" id="<?php echo esc_attr( $this->get_field_id( 'image_position' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_position' ), 'flat-commerce' ); ?>" value="below" style="" /><?php _e( 'Show Image After Title', 'flat-commerce' );?><br />
            </p>
		<?php } else { ?>
            <p>
                <input type="radio" id="<?php echo esc_attr( $this->get_field_id( 'image_position' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_position' ), 'flat-commerce' ); ?>" value="above" style="" /><?php _e( 'Show Image Before Title', 'flat-commerce' );?><br />
                <input type="radio" id="<?php echo esc_attr( $this->get_field_id( 'image_position' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_position' ), 'flat-commerce' ); ?>" value="below" style="" checked /><?php _e( 'Show Image After Title', 'flat-commerce' );?><br />
            </p>
		<?php } ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>"><?php _e( 'Show Content', 'flat-commerce' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_content' ), 'flat-commerce' ); ?>">
				<option value="excerpt" <?php selected( 'excerpt', $instance['show_content'] ); ?>><?php _e( 'Excerpt', 'flat-commerce' ); ?></option>
				<option value="fullcontent" <?php selected( 'fullcontent', $instance['show_content'] ); ?>><?php _e( 'Full Content', 'flat-commerce' ); ?></option>
				<option value="hide" <?php selected( 'hide', $instance['show_content'] ); ?>><?php _e( 'Hide', 'flat-commerce' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>"><?php _e( 'Content Character Limit', 'flat-commerce' ); ?>: </label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt_length' ), 'flat-commerce' ); ?>" value="<?php echo $excerpt_length; ?>" type="number" min="5" />
       	</p>

       	<?php
	}

	function update( $new_instance, $old_instance ) {
		global $flat_commerce_valid_id;

		$instance                           = $old_instance;

		$instance['title']                  = sanitize_text_field( $new_instance['title'] );

		$instance['disable_featured_image'] = isset( $new_instance['disable_featured_image'] ) ? 1 : 0;

		$instance['image_position']         = isset( $new_instance['image_position'] ) ? 1 : 0;

		$instance['show_content']           = sanitize_key( $new_instance['show_content'] );

		$instance['excerpt_length']         = absint( $new_instance['excerpt_length'] );

		$instance['post_id']                = absint( $new_instance['post_id'] );

		$post_id                            = absint( $instance['post_id'] );

		$flat_commerce_valid_id             = 'not_valid';

		if( !empty( $post_id ) ){
			//check if post is valid or not
	   	if( get_post_type( $post_id ) == 'post' && get_post_status( $post_id ) == 'publish' ) {
				$flat_commerce_valid_id          = 'valid';

				$instance['post_id'] = absint( $new_instance['post_id'] );

			} else {
				$instance['post_id'] = '';
			}
		}
		return $instance;
	}

	function widget( $args, $instance ) {
		global $flat_commerce_valid_id, $post;

		extract( $args );

		if ( !empty( $instance ) ) {
			extract( $instance );
		}


		$title                  = isset( $instance['title'] ) ? $instance['title'] : '';

		$disable_featured_image = !empty( $instance['disable_featured_image'] ) ? 'true' : 'false';

		$image_position         = isset( $instance['image_position'] ) ? $instance['image_position'] : 'above' ;

		$show_content           = isset( $instance['show_content'] ) ? $instance['show_content'] : 'excerpt' ;

		$excerpt_length         = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 200;

		$valid         			= isset( $instance['v'] ) ? $instance['v'] : null;

		$options                = flat_commerce_get_theme_options();

		$more_tag_text          = __( 'Read More...', 'flat-commerce' );

		$post_id 					= isset( $instance['post_id'] ) ? absint( $instance['post_id'] ) : null;

		if ( empty( $post_id ) ) {
			$post_id = NULL;
		}

		// The Query
		if( $post_id != NULL ):
			$the_query = new WP_Query( 'p='.$post_id );

			// The Loop
			while ( $the_query->have_posts() ) :
				$the_query->the_post();

				$post_name = the_title( '', '', false );

				$output = $before_widget;

				$output .= '<article class="post-'. $post_id . ' page type-post entry">';

					//Image position set below
					if( $image_position == "below" ) {
						// Wiget title replace the page title is added
						if( $title ) {

							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" title="'. esc_attr( $title ) .'">'. esc_html( $title ) .'</a></h2></header>';
						}
						else {
							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" title="'. esc_attr( $post_name ) .'">'. $post_name .'</a></h2></header>';
						}
					}

					if( has_post_thumbnail() && $disable_featured_image != "true" ) {
						$output.= '<figure class="featured-image excerpt-landscape-featured-image"><a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( $post_name ) . '">' . get_the_post_thumbnail( $post->ID, 'flat-commerce-featured-landscape', array( 'title' => esc_attr( $post_name ), 'alt' => esc_attr( $post_name ) ) ).'</a></figure>';
					}

					//Image position set above
					if( $image_position == "above" ) {
						// Wiget title replace the page title is added
						if( $title ) {

							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" title="'. esc_attr( $title ) .'">'. esc_html( $title ) .'</a></h2></header>';
						}
						else {
							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" title="'. esc_attr( $post_name ) .'">'. $post_name .'</a></h2></header>';
						}
					}

					if ( 'excerpt' == $show_content ) {
						$output .= '<div class="entry-summery">';
						$output .= flat_commerce_get_the_content_limit( (int) $excerpt_length, $more_tag_text );
						$output .= '</div><!-- .entry-summery -->';
					}
					elseif ( 'fullcontent' == $show_content ) {
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						$output .= '<div class="entry-content">' . esc_html( $content ) . '</div><!-- .entry-content -->';
					}

				$output .= '</article><!-- .type-post -->';

				$output .= $after_widget;

			endwhile;

			// Reset Post Data
			wp_reset_postdata();

			echo $output;

		endif;

	}

}