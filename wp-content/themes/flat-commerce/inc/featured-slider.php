<?php
/**
 * The template for displaying the Slider
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


if( !function_exists( 'flat_commerce_featured_slider' ) ) :
/**
 * Add slider.
 *
 * @uses action hook flat_commerce_before_content.
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_featured_slider() {
	global $post, $wp_query;

	//flat_commerce_flush_transients();
	// get data value from options
	$options 		= flat_commerce_get_theme_options();
	$enableslider 	= $options['featured_slider_option'];
	$sliderselect 	= $options['featured_slider_type'];

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	// Front page displays in Reading Settings
	$page_on_front = get_option('page_on_front') ;

	if ( $enableslider == 'entire-site' || ( ( $page_id == $page_on_front && $page_id > 0  ) && $enableslider == 'homepage' ) ) {
		if( ( !$flat_commerce_featured_slider = get_transient( 'flat_commerce_featured_slider' ) ) ) {
			echo '<!-- refreshing cache of featured slider -->';

			$flat_commerce_featured_slider = '
			<section id="feature-slider">
                            <div class="cycle-slideshow"
                                 data-cycle-log="false"
                                 data-cycle-swipe="true"
                                 data-cycle-fx="fadeout"
                                 data-cycle-loop="0"
                                 data-cycle-slides="> article"
                                 data-cycle-caption=".custom-caption"
                                 data-cycle-caption-template="{{slideNum}} of {{slideCount}}"
                                 data-cycle-prev="#prev"
                                 data-cycle-next="#next">

                                 <!-- empty element for pager links -->
                                 <div class="cycle-pager"></div>

                                	<!-- prev/next links -->
                                	<div class="control-wrapper">
                                    <div class="control">
                                        <span href=# id="prev"><span class="genericon genericon-expand genericon-rotate-90"></span></span>
                                        <span href=# id="next"><span class="genericon genericon-collapse genericon-rotate-90"></span></span>
                                    </div><!-- .control -->
                                	</div><!-- .control-wrapper -->';

							// Select Slider
							if ( $sliderselect == 'demo-featured-slider' && function_exists( 'flat_commerce_demo_slider' ) ) {
								$flat_commerce_featured_slider .=  flat_commerce_demo_slider( $options );
							}
							elseif ( $sliderselect == 'featured-page-slider' && function_exists( 'flat_commerce_page_slider' ) ) {
								$flat_commerce_featured_slider .=  flat_commerce_page_slider( $options );
							}

			$flat_commerce_featured_slider .= '
						</div><!-- .cycle-slideshow -->
                    </section><!-- #feature-slider -->';

			set_transient( 'flat_commerce_featured_slider', $flat_commerce_featured_slider, 86940 );
		}
		echo $flat_commerce_featured_slider;
	}
}
endif;
add_action( 'flat_commerce_before_content', 'flat_commerce_featured_slider', 20 );


if ( ! function_exists( 'flat_commerce_demo_slider' ) ) :
/**
 * This function to display featured posts slider
 *
 * @get the data value from customizer options
 *
 * @since Flat Commerce 0.1
 *
 */
function flat_commerce_demo_slider( $options ) {
	$flat_commerce_demo_slider ='
								<article class="slides">
												<div class="black-overlay"></div>
                                    <figure class="slider-image">
                                        <a title="'.__( 'Slider Image 1','flat-commerce').'" href="'.esc_url( home_url( '/' ) ).'">
                                            <img src="'.get_template_directory_uri().'/images/gallery/banner1.jpg" width="1800" height="720" alt="'.__( 'banner','flat-commerce' ).'"/>
                                        </a>
                                    </figure>
                                    <div class="entry-container">
                                        <header class="entry-header">
                                            <h1 class="entry-title">
                                                <span>'.__( 'Wear It Once In a Lifetime', 'flat-commerce' ).'</span>
                                                <a title="'.__( 'Slider Image 1','flat-commerce').'" href="#">'.__( 'vine clothing', 'flat-commerce' ).'</a>
                                            </h1>
                                        </header><!-- .entry-header -->
                                        <a href="#" class="read-more">'
                                            .__( 'Shop Now', 'flat-commerce' ).'
                                        </a>
                                    </div><!-- .entry-container -->
                                </article><!-- .slides -->

                                <article class="slides">
												<div class="black-overlay"></div>

                                    <figure class="slider-image">
                                        <a title="'.__( 'Slider Image 2','flat-commerce').'" href="'.esc_url( home_url( '/' ) ).'">
                                            <img src="'.get_template_directory_uri().'/images/gallery/banner2.jpg" width="1800" height="720" alt="'.__( 'banner','flat-commerce' ).'"/>
                                        </a>
                                    </figure>
                                    <div class="entry-container">
                                        <header class="entry-header">
                                            <h1 class="entry-title">
                                                <span>'. __( 'Wear It Once In a Lifetime', 'flat-commerce') .'</span>
                                                <a title="'.__( 'Slider Image 1','flat-commerce').'" href="#">'.__( 'vine clothing', 'flat-commerce' ).'</a>
                                            </h1>
                                        </header><!-- .entry-header -->
                                        <a href="#" class="read-more">'.
                                           __( 'Shop Now', 'flat-commerce' )
                                            .'</a>
                                    </div> <!-- .entry-container -->
                                </article><!-- .slides --> ';
	return $flat_commerce_demo_slider;
}
endif; // flat_commerce_demo_slider


if ( ! function_exists( 'flat_commerce_page_slider' ) ) :
/**
 * This function to display featured page slider
 *
 * @param $options: flat_commerce_theme_options from customizer
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_page_slider( $options ) {
    global $post;

	$quantity                  = $options['featured_slide_number'];
	$number_of_page            = 0; 		// for number of pages
	$page_list                 = array();	// list of valid page ids
	$flat_commerce_page_slider = '';  //set empty value

	//Get number of valid pages
	for( $i = 1; $i <= $quantity; $i++ ){
		if( isset ( $options['featured_slider_page_' . $i] ) && $options['featured_slider_page_' . $i] > 0 ){
			$number_of_page++;

			$page_list	=	array_merge( $page_list, array( $options['featured_slider_page_' . $i] ) );
		}
	}

	if ( !empty( $page_list ) && $number_of_page > 0 ) {
		$get_featured_posts = new WP_Query( array(
		'posts_per_page'	=> $quantity,
		'post_type'			=> 'page',
		'post__in'			=> $page_list,
		'orderby' 			=> 'post__in'
		));

		$i = 0;

		while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
			$title_attribute = the_title_attribute( array( 'before' => __( 'Permalink to: ', 'flat-commerce' ), 'echo' => false ) );
			$excerpt = get_the_excerpt();

			$flat_commerce_page_slider .= '
			<article class="slides">
				<div class="black-overlay"></div>
				<figure class="slider-image">';
				if ( has_post_thumbnail() ) {
					$flat_commerce_page_slider .= '<a title="'. the_title_attribute( array( 'before' => __( 'Permalink to: ', 'flat-commerce' ), 'echo' => false ) ) .'" href="' . esc_url( get_permalink() ) . '">
						'. get_the_post_thumbnail( $post->ID, 'flat-commerce-slider', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class'	=> 'attached-page-image' ) ).'
					</a>';
				}
				else {
					//Default value if there is no first image
					$flat_commerce_image = '<img class="pngfix wp-post-image" src="'.get_template_directory_uri().'/images/gallery/no-featured-image-1366x585.png" >';

					//Get the first image in page, returns false if there is no image
					$flat_commerce_first_image = flat_commerce_get_first_image( $post->ID, 'flat-commerce-slider', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class' => 'attached-page-image' ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' != $flat_commerce_first_image ) {
						$flat_commerce_image =	$flat_commerce_first_image;
					}

					$flat_commerce_page_slider .= '<a title="'. the_title_attribute( array( 'before' => __( 'Permalink to: ', 'flat-commerce' ), 'echo' => false ) ) .'" href="' . esc_url(  get_permalink() ) . '">
						'. $flat_commerce_image .'
					</a>';
				}

				$flat_commerce_page_slider .= '
				</figure><!-- .slider-image -->
				<div class="entry-container">
					<header class="entry-header">
						<h1 class="entry-title">
							<a title="'. the_title_attribute( array( 'before' => __( 'Permalink to: ', 'flat-commerce' ), 'echo' => false ) ) .'" href="' . esc_url( get_permalink() ) . '">'.esc_html( get_the_title() ).'
							</a>
						</h1>
					</header><!-- .entry-header -->
					 <a href="'. esc_url( get_permalink() ) .'" class="read-more">
                             '.__( 'Shop Now','flat-commerce' ).'
                      </a>';
					$flat_commerce_page_slider .= '
				</div><!-- .entry-container -->
			</article><!-- .slides -->';
		endwhile;

		wp_reset_query();
  	}
	return $flat_commerce_page_slider;
}
endif; // flat_commerce_page_slider