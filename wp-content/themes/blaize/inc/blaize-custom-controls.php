<?php
/**
 * Pro customizer section.
 *
 * @since  1.0.0
 * @access public
 */
if( class_exists( 'WP_Customize_Section' ) ) {
    class Blaize_Customize_Section_Pro extends WP_Customize_Section {

        public $type = 'blaize-doc';
        public $pro_text = '';
        public $pro_url = '';

        public function json() {
            $json = parent::json();
            $json['pro_text'] = $this->pro_text;
            $json['pro_url']  = esc_url( $this->pro_url );
            return $json;
        }

        protected function render_template() { ?>

            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
                <h3 class="accordion-section-title">
                    {{ data.title }}
                    <# if ( data.pro_text && data.pro_url ) { #>
                        <a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            </li>
        <?php }
    }
}

function blaize_customize_scripts() {
    wp_enqueue_style( 'blz-custmzer-css', get_template_directory_uri() . '/css/customizer-styles.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'blaize_customize_scripts' );

function blaize_customize_register( $wp_customize ) {

    // Register custom section types.
    $wp_customize->register_section_type( 'Blaize_Customize_Section_Pro' );

    // Register sections.
    $wp_customize->add_section(
        new Blaize_Customize_Section_Pro(
            $wp_customize,
            'blaize-doc',
            array(
                'title'    => esc_html__( 'Easy Theme Guide', 'blaize' ),
                'pro_text' => esc_html__( 'Read Now','blaize' ),
                'pro_url'  => esc_url('http://doc.paglithemes.com/blaize'),
                'priority' => 1,
            )
        )
    );

}

add_action( 'customize_register', 'blaize_customize_register' );