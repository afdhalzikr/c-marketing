<?php
	/** Blaize Custom Controls **/
	if( class_exists( 'WP_Customize_Control' ) ) {

		/**
		 * Blaize Menu Control
		 */
		/**
		 * Class to create a custom menu control
		 */
		class Blaize_Companion_Menu_Control extends WP_Customize_Control {

			public $type = 'dropdown-menus';
		    
		    public function render_content() {
		    	$menus = wp_get_nav_menus();
		    	?>
		    	<label>
			    	<?php if ( ! empty( $this->label ) ) : ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php endif; ?>

					<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
					<?php endif; ?>

					<?php if( !empty($menus) ) : ?>

		                    <select <?php echo $this->get_link(); ?> name="<?php echo esc_attr($this->id); ?>" id="<?php echo esc_attr($this->id); ?>">
		                    	<option <?php selected( $this->value(), '0', true); ?> value="0"><?php echo esc_html__('Select Menu', 'blaize-companion'); ?></option>
		                    	<?php foreach($menus as $menu ) : ?>
		                    		<option <?php selected( $this->value(), $menu->slug, true); ?> value="<?php echo esc_attr($menu->slug); ?>"><?php echo esc_html($menu->name); ?></option>
		                    	<?php endforeach; ?>
		                    </select>

				    <?php endif; ?>
			    </label>
			    <?php
		    }
		}

		/**
		* Category Drowpdown Control
		*/
		class Blaize_Companion_Category_Control extends WP_Customize_Control {

			public $type = 'dropdown-category';

			protected $dropdown_args = false;

			protected function render_content() {
			?>
				<label>
					<?php if ( ! empty( $this->label ) ) : ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php endif; ?>

					<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
					<?php endif; ?>

					<?php
						$dropdown_args = wp_parse_args( $this->dropdown_args, array(
							'taxonomy'          => 'category',
							'show_option_none' => __( 'Select category', 'blaize-companion' ),
							'selected'          => $this->value(),
							'show_option_all'   => '',
							'orderby'           => 'id',
							'order'             => 'ASC',
							'show_count'        => 1,
							'hide_empty'        => 1,
							'child_of'          => 0,
							'exclude'           => '',
							'hierarchical'      => 1,
							'depth'             => 1,
							'tab_index'         => 0,
							'hide_if_empty'     => false,
							'option_none_value' => 0,
							'value_field'       => 'term_id',
						) );

						$dropdown_args['echo'] = false;

						$dropdown = wp_dropdown_categories( $dropdown_args );
						$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
						echo $dropdown;
					?>
				</label>
				<?php

			}
		}

		/** Exclude Multiple Category Control **/
        class Blaize_Companion_Multiple_Category extends WP_Customize_Control {

        	public $type = 'multiple-category';

            public function render_content() {
                $cats = $this->get_catlist();
                $values = $this->value();
                
                if ( empty( $cats ) )
                return;
                ?>
                <label>
                    <?php if ( ! empty( $this->label ) ) : ?>
                        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php endif;

                    if ( ! empty( $this->description ) ) : ?>
                        <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $this->label ) ) : ?>
                        <div id="ex-cat-wrap">
                            <?php $cat_arr = explode(',', $values); array_pop($cat_arr); $count = 1; ?>
                            
                            <?php foreach($cats as $id => $label) : ?>
                                <div class="chk-group <?php if($count++%2 == 0){echo "right";}else{echo "left";} ?>">
                                    <input id="ex-cat-<?php echo $id; ?>" type="checkbox" value="<?php echo $id; ?>" <?php if(in_array($id,$cat_arr)){ echo "checked"; }; ?> />
                                    <label for="ex-cat-<?php echo $id; ?>"><?php echo $label; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
                    <?php endif; ?>    
                </label>
                <?php
            }
            
            public function get_catlist() {
                $catlist = array();
                $categories = get_categories( array('hide_empty' => 0) );
                
                foreach($categories as $cat){
                    $catlist[$cat->term_id] = $cat->name;
                }
                
                return $catlist;
            }

        }

		 /**
		 * Simple Title 
		 */
		class Blaize_Companion_Title extends WP_Customize_Control {

			public $type = 'blaize-title';

			public function render_content() {
				?>
				<div class="blz-title">
					<?php echo esc_html($this->label); ?>
				</div>
				<?php
			}
		}

		/**
		 * Blaize Menu Control
		 */
		class Blaize_Companion_Icon_Picker extends WP_Customize_Control {

			private $icons = array();

		    public $type = 'icon-picker';

		    public function __construct($manager, $id, $args = array(), $options = array()) {
		        $this->icons = blaize_et_iconset();
		        parent::__construct( $manager, $id, $args );
		    }
		    /**
		     * Render the content on the theme customizer page
		    */
		    public function render_content() {

		        if(!empty($this->icons)) {
		        	$val = ($this->value() == '') ? 'balance-scale' : $this->value();
		            ?>
		            	<label>
		            		<?php if(!empty($this->label)) : ?>
	    				    	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	    					<?php endif; ?>

	    				    <?php if ( ! empty( $this->description ) ) : ?>
		                        <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
		                    <?php endif; ?>

    				    	<span class="current-icon">
    				    		<i class="icon-<?php echo esc_attr($val); ?>"></i>
    				    	</span>

			                <ul class="blaize-iconset">
		                    	<?php foreach($this->icons as $icon) : ?>

		                    		<?php
		                    			$li_class = '';
		                    			if($icon == $val) {
		                    				$li_class = 'active';
		                    			}
		                    		?>

		                    		<li data-icons="<?php echo esc_attr($icon); ?>" class="<?php echo esc_attr($li_class); ?>"><span class="icon-<?php echo esc_attr($icon); ?>"></span></li>
		                    	<?php endforeach; ?>
		                    </ul>

		                    <input type="hidden" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $val ); ?>" <?php $this->link(); ?> />
	                    </label>
		            <?php
		        }
		    }
		}

		/**
		 * Blaize Radio Image Control
		 */
		class Blaize_Companion_Radio_Image_Select extends WP_Customize_Control {

			private $icons = array();

		    public $type = 'radio-image';

		    /**
		     * Render the content on the theme customizer page
		    */
		    public function render_content() {
		        if(!empty($this->choices)) {
		            ?>
		            	<label>
		            		<?php if(!empty($this->label)) : ?>
	    				    	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	    					<?php endif; ?>

	    				    <?php if ( ! empty( $this->description ) ) : ?>
		                        <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
		                    <?php endif; ?>

			                <ul class="blz-img-choices">
		                    	<?php foreach($this->choices as $val => $img) : ?>
		                    		<?php $active_cls = ( $val == $this->value() ) ? 'active' : ''; ?>
		                    		<li data-val="<?php echo esc_attr($val); ?>" class="<?php echo esc_attr($active_cls); ?>">
		                    			<img src="<?php echo esc_url($img); ?>">
		                    		</li>
		                    	<?php endforeach; ?>
		                    </ul>

		                    <input type="hidden" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $val ); ?>" <?php $this->link(); ?> />
	                    </label>
		            <?php
		        }
		    }
		}

		/**
		* Blaize Repeater Control
		*/
		class Blaize_Companion_Repeater_Controler extends WP_Customize_Control {

			public $type = 'repeater';

			public $box_label = '';

			public $box_add_control = '';

			/**
			* The fields that each container row will contain.
			*/
			public $fields = array();

			/**
			* Repeater drag and drop controler
			*/
			public function __construct( $manager, $id, $args = array(), $fields = array() ) {
				$this->fields = $fields;
				$this->box_label = $args['box_label'] ;
				$this->box_add_control = $args['box_add_control'];
				parent::__construct( $manager, $id, $args );
			}

			public function render_content() {

				$values = json_decode($this->value());
				?>

				<?php if( $this->label ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>

				<?php if( $this->description ) : ?>
					<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php endif; ?>

				<ul class="blz-repeater-field-control-wrap">
					<?php $this->get_fields(); ?>
				</ul>

				<input type="hidden" <?php esc_attr( $this->link() ); ?> class="blz-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
				<button type="button" class="button blz-add-control-field"><?php echo esc_html( $this->box_add_control ); ?></button>
				<?php
			}

			private function get_fields(){
				$fields = $this->fields;
				$values = json_decode($this->value()) ;

				if(is_array($values)){

					foreach($values as $value){
						?>
						<li class="blz-repeater-field-control">
							<h3 class="blz-repeater-field-title"><?php echo esc_html( $this->box_label ); ?></h3>

							<div class="blz-repeater-fields">
								<?php foreach ($fields as $key => $field) : ?>

									<?php $class = isset($field['class']) ? $field['class'] : ''; ?>
									<div class="blz-fields blz-type-<?php echo esc_attr($field['type']).' '.$class; ?>">
										<?php 
											$label = isset($field['label']) ? $field['label'] : '';
											$description = isset($field['description']) ? $field['description'] : '';
										?>

										<?php if($field['type'] != 'checkbox') : ?>
											<span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
											<span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
										<?php endif; ?>

										<?php
											$new_value = isset($value->$key) ? $value->$key : '';
											$default = isset($field['default']) ? $field['default'] : '';

											switch ($field['type']) {
												case 'text':
													echo '<input data-default="'.esc_attr($default).'" data-name="'.esc_attr($key).'" type="text" value="'.esc_attr($new_value).'"/>';
													break;

												case 'textarea':
													echo '<textarea data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">'.esc_textarea($new_value).'</textarea>';
													break;

												case 'upload':
						    						$image = $image_class= "";
						    						if($new_value){	
						    							$image = '<img src="'.esc_url($new_value).'" style="max-width:100%;"/>';	
						    							$image_class = ' hidden';
						    						}
						    						echo '<div class="blz-fields-wrap">';
						    						echo '<div class="attachment-media-view">';
						    						echo '<div class="placeholder'.$image_class.'">';
						    						_e('No image selected', 'blaize-companion');
						    						echo '</div>';
						    						echo '<div class="thumbnail thumbnail-image">';
						    						echo $image;
						    						echo '</div>';
						    						echo '<div class="actions clearfix">';
						    						echo '<button type="button" class="button blz-delete-button align-left">'.esc_html__('Remove', 'blaize-companion').'</button>';
						    						echo '<button type="button" class="button blz-upload-button alignright">'.esc_html__('Select Image', 'blaize-companion').'</button>';
						    						echo '<input data-default="'.esc_attr($default).'" class="upload-id" data-name="'.esc_attr($key).'" type="hidden" value="'.esc_attr($new_value).'"/>';
						    						echo '</div>';
						    						echo '</div>';
						    						echo '</div>';							
						    						break;

												case 'icon':
													echo '<div class="blz-selected-icon">';
													echo '<i class="icon-'.esc_attr($new_value).'"></i>';
													echo '<span><i class="fas fa-arrow-down"></i></span>';
													echo '</div>';
													echo '<ul class="blz-icon-list clearfix">';
													$blaize_icons_array = blaize_et_iconset();
													foreach ($blaize_icons_array as $icon) {
													$icon_class = $new_value == $icon ? 'icon-active' : '';
													echo '<li class='.$icon_class.'><i class="icon-'.$icon.'"></i></li>';
													}
													echo '</ul>';
													echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
													break;

												case 'social-icon':
													echo '<div class="blz-selected-icon">';
													echo '<i class="fab fa-'.esc_attr($new_value).'"></i>';
													echo '<span><i class="fas fa-arrow-down"></i></span>';
													echo '</div>';
													echo '<ul class="blz-icon-list clearfix">';
													$blaize_icons_array = blaize_social_iconset();
													foreach ($blaize_icons_array as $icon) {
													$icon_class = $new_value == $icon ? 'icon-active' : '';
													echo '<li class='.$icon_class.'><i class="fab fa-'.$icon.'"></i></li>';
													}
													echo '</ul>';
													echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
													break;

												default:
												break;
											}
										?>
									</div>
								<?php endforeach; ?>

								<div class="clearfix blz-repeater-footer">
								<div class="alignright">
								<a class="blz-repeater-field-remove" href="#remove"><?php esc_html_e('Delete', 'blaize-companion') ?></a> |
								<a class="blz-repeater-field-close" href="#close"><?php esc_html_e('Close', 'blaize-companion') ?></a>
								</div>
								</div>
							</div>
						</li>
						<?php	
					}
				}
			}
		}
	}