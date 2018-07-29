<?php

/** register Contact Info widget **/
function blaize_register_contact_info_widget() {
    register_widget( 'Blaize_Contact_Info' );
}
add_action( 'widgets_init', 'blaize_register_contact_info_widget' );

/**
 * Adds Blaize_Contact_Info widget.
 */
class Blaize_Contact_Info extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'blaize_contact_info', // Base ID
			esc_html__( 'BLZ : Contact Info', 'blaize' ), // Name
			array( 'description' => esc_html__( 'A General Contact Info Widget', 'blaize' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		$location = ! empty( $instance['location'] ) ? $instance['location'] : '';
		$contact_no = ! empty( $instance['contact_no'] ) ? $instance['contact_no'] : '';
		$email = ! empty( $instance['email'] ) ? $instance['email'] : '';
		$office_time = ! empty( $instance['office_time'] ) ? $instance['office_time'] : '';

		$fb_url = ! empty( $instance['fb_url'] ) ? $instance['fb_url'] : '';
		$twitter_url = ! empty( $instance['twitter_url'] ) ? $instance['twitter_url'] : '';
		$gplus_url = ! empty( $instance['gplus_url'] ) ? $instance['gplus_url'] : '';
		$pin_url = ! empty( $instance['pin_url'] ) ? $instance['pin_url'] : '';
		$ytube_url = ! empty( $instance['ytube_url'] ) ? $instance['ytube_url'] : '';

		echo wp_kses_post($args['before_widget']);
		?>
			<?php if ( $title != '' ) : ?>
				<?php echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']); ?>
			<?php endif; ?>

			<?php if( $location != '' || $contact_no != '' || $email != '' || $office_time != '' ) : ?>
				<ul class="info-section">

					<?php if( $location ) : ?>
						<li><i class="fas fa-map-marker"></i><span><?php echo esc_html($location); ?></span></li>
					<?php endif; ?>

					<?php if( $contact_no ) : ?>
						<li><i class="fas fa-phone"></i><span><?php echo esc_html($contact_no); ?></span></li>
					<?php endif; ?>

					<?php if( $email ) : ?>
						<li><i class="fas fa-envelope"></i><span><?php echo esc_html($email); ?></span></li>
					<?php endif; ?>

					<?php if( $office_time ) : ?>
						<li><i class="fas fa-stopwatch"></i><span><?php echo esc_html($office_time); ?></span></li>
					<?php endif; ?>

				</ul>
			<?php endif; ?>

			<?php if( $fb_url != '' || $twitter_url != '' || $gplus_url != '' || $pin_url != '' || $ytube_url != '' ) : ?>
				<ul class="social-links clearfix">

					<?php if( $fb_url ) : ?>
						<li>
							<a href="<?php echo esc_url( $fb_url ); ?>"><i class="fab fa-facebook-f"></i></a>
						</li>
					<?php endif; ?>

					<?php if( $twitter_url ) : ?>
						<li>
							<a href="<?php echo esc_url( $twitter_url ); ?>"><i class="fab fa-twitter"></i></a>
						</li>
					<?php endif; ?>

					<?php if( $gplus_url ) : ?>
						<li>
							<a href="<?php echo esc_url( $gplus_url ); ?>"><i class="fab fa-google-plus-g"></i></a>
						</li>
					<?php endif; ?>

					<?php if( $pin_url ) : ?>
						<li>
							<a href="<?php echo esc_url( $pin_url ); ?>"><i class="fab fa-pinterest-p"></i></a>
						</li>
					<?php endif; ?>

					<?php if( $ytube_url ) : ?>
						<li>
							<a href="<?php echo esc_url( $ytube_url ); ?>"><i class="fab fa-youtube"></i></a>
						</li>
					<?php endif; ?>

				</ul>
			<?php endif; ?>
		<?php
		echo wp_kses_post($args['after_widget']);
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Contact Us', 'blaize' );

		$location = ! empty( $instance['location'] ) ? $instance['location'] : esc_html__( '25th Street, Westville California', 'blaize' );
		$contact_no = ! empty( $instance['contact_no'] ) ? $instance['contact_no'] : esc_html__( '+ 012 345 6789 / 9876 543 210', 'blaize' );
		$email = ! empty( $instance['email'] ) ? $instance['email'] : esc_html__( 'contact@example.com', 'blaize' );
		$office_time = ! empty( $instance['office_time'] ) ? $instance['office_time'] : esc_html__( 'Monday - Friday : 9:00 - 5:00', 'blaize' );

		$fb_url = ! empty( $instance['fb_url'] ) ? $instance['fb_url'] : '';
		$twitter_url = ! empty( $instance['twitter_url'] ) ? $instance['twitter_url'] : '';
		$gplus_url = ! empty( $instance['gplus_url'] ) ? $instance['gplus_url'] : '';
		$pin_url = ! empty( $instance['pin_url'] ) ? $instance['pin_url'] : '';
		$ytube_url = ! empty( $instance['ytube_url'] ) ? $instance['ytube_url'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'blaize' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>"><?php esc_attr_e( 'Location:', 'blaize' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'location' ) ); ?>" type="text" value="<?php echo esc_attr( $location ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_no' ) ); ?>"><?php esc_attr_e( 'Contact No.:', 'blaize' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_no' ) ); ?>" type="text" value="<?php echo esc_attr( $contact_no ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_attr_e( 'Email ID:', 'blaize' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'office_time' ) ); ?>"><?php esc_attr_e( 'Office Hours:', 'blaize' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'office_time' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'office_time' ) ); ?>" type="text" value="<?php echo esc_attr( $office_time ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fb_url' ) ); ?>"><?php esc_attr_e( 'Facebook Link:', 'blaize' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fb_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fb_url' ) ); ?>" type="text" value="<?php echo esc_attr( $fb_url ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter_url' ) ); ?>"><?php esc_attr_e( 'Twitter Link:', 'blaize' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter_url' ) ); ?>" type="text" value="<?php echo esc_url( $twitter_url ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'gplus_url' ) ); ?>"><?php esc_attr_e( 'Google Plus Link:', 'blaize' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'gplus_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gplus_url' ) ); ?>" type="text" value="<?php echo esc_url( $gplus_url ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pin_url' ) ); ?>"><?php esc_attr_e( 'Pinterest Link:', 'blaize' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pin_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pin_url' ) ); ?>" type="text" value="<?php echo esc_url( $pin_url ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ytube_url' ) ); ?>"><?php esc_attr_e( 'Youtube Link:', 'blaize' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ytube_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ytube_url' ) ); ?>" type="text" value="<?php echo esc_url( $ytube_url ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		$instance['location'] = ( ! empty( $new_instance['location'] ) ) ? strip_tags( $new_instance['location'] ) : '';
		$instance['contact_no'] = ( ! empty( $new_instance['contact_no'] ) ) ? strip_tags( $new_instance['contact_no'] ) : '';
		$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
		$instance['office_time'] = ( ! empty( $new_instance['office_time'] ) ) ? strip_tags( $new_instance['office_time'] ) : '';

		$instance['fb_url'] = ( ! empty( $new_instance['fb_url'] ) ) ? esc_url_raw( $new_instance['fb_url'] ) : '';
		$instance['twitter_url'] = ( ! empty( $new_instance['twitter_url'] ) ) ? esc_url_raw( $new_instance['twitter_url'] ) : '';
		$instance['gplus_url'] = ( ! empty( $new_instance['gplus_url'] ) ) ? esc_url_raw( $new_instance['gplus_url'] ) : '';
		$instance['pin_url'] = ( ! empty( $new_instance['pin_url'] ) ) ? esc_url_raw( $new_instance['pin_url'] ) : '';
		$instance['ytube_url'] = ( ! empty( $new_instance['ytube_url'] ) ) ? esc_url_raw( $new_instance['ytube_url'] ) : '';

		return $instance;
	}

}