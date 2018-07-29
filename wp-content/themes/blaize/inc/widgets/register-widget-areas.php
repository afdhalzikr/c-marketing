<?php
	/** Custom Widgets **/
	require get_template_directory() . '/inc/widgets/widget-contact-info.php';

	/** Register widget area. **/
	function blaize_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar', 'blaize' ),
			'id'            => 'right-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'blaize' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Left Sidebar', 'blaize' ),
			'id'            => 'left-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'blaize' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 1', 'blaize' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'blaize' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 2', 'blaize' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'blaize' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 3', 'blaize' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'blaize' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 4', 'blaize' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here.', 'blaize' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
	add_action( 'widgets_init', 'blaize_widgets_init' );