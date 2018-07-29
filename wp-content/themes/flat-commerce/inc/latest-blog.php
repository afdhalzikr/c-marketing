<?php
/**
 * The template for displaying the Featured Content
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


if( ! function_exists( 'flat_commerce_latest_display' ) ) :
/**
* Add Featured content.
*
* @uses action hook flat_commerce_before_content.
*
* @since Flat Commerce 0.1
*/
function flat_commerce_latest_blog_display() {
    //flat_commerce_flush_transients();
    global $post, $wp_query;

    // get data value from options
    $options        = flat_commerce_get_theme_options();
    $enablecontent  = $options['latest_blog_content_option'];
    $contentselect  = $options['latest_blog_content_type'];

    // Front page displays in Reading Settings
    $page_on_front  = get_option( 'page_on_front' ) ;

    $flat_commerce_latest_blog = '';

    // Get Page ID outside Loop
    $page_id = $wp_query->get_queried_object_id();
    if ( $enablecontent == 'entire-site' || ( ( $page_id == $page_on_front && $page_id > 0  ) && $enablecontent == 'homepage' ) ) {

            if ( ( !$flat_commerce_latest = get_transient( 'flat_commerce_latest_blog' ) ) ) {
                echo '<!-- refreshing cache -->';

                $flat_commerce_latest_blog .='
                   <section id="blog">
                        <div class="container">
                            <div class="row">
                                <div class="col col-1-of-1">
                                    <header class="entry-header">
                                        <h2 class="entry-title">'.__( 'Latest Blog', 'flat-commerce' ).'</h2>
                                    </header><!-- .entry-header -->
                                </div><!-- .col -->';

                                $flat_commerce_latest_blog .='</div>
                                                                </div><!-- .col -->';


                                // Select content
                                if ( $contentselect == 'demo-latest-blog-content' && function_exists( 'flat_commerce_latest_blog_demo' ) ) {
                                    $flat_commerce_latest_blog .= flat_commerce_latest_blog_demo( $options );
                                }
                                else if ( $contentselect == 'latest-blog-post-content' && function_exists( 'flat_commerce_latest_blog_post' ) ) {
                                    $flat_commerce_latest_blog .= flat_commerce_latest_blog_post( $options );
                                }

                $flat_commerce_latest_blog .='
                             </div><!-- .row -->
                        </div><!-- .container -->
                    </section><!-- #blog -->';
                set_transient( 'flat_commerce_latest_blog', $flat_commerce_latest_blog, 86940 );

            }
            echo $flat_commerce_latest_blog;
    }
}
endif;
add_action( 'flat_commerce_before_content', 'flat_commerce_latest_blog_display', 80 );

// Demo Content Function
if( !function_exists( 'flat_commerce_latest_blog_demo' ) ) :
/**
* Add Featured content.
*
* @uses action hook flat_commerce_before_content.
*
* @since Flat Commerce 0.1
*/
function flat_commerce_latest_blog_demo() {
    $flat_commerce_latest_blog =
    '<article class="col col-1-of-3 col-m-1-of-3">
                    <div class="row">
                        <div class="col col-2-of-12 left-part">
                            <time class="entry-date" datetime="2008-10-17">
                                <span>
                                    30
                                </span>
                                <span>
                                    '.__( 'nov', 'flat-commerce' ).'
                                </span>
                            </time><!-- .entry-date -->
                            <span class="genericon genericon-user"></span>
                        </div><!-- .col -->

                        <div class="col col-10-of-12">
                            <a href="#">
                                <img src="'.get_template_directory_uri().'/images/gallery/shopping tricks.jpg" width="270" height="270" alt="'.__( 'shoping tricks','flat-commerce').'"/>
                            </a>
                            <div class="entry-header">
                                <h3 class="entry-title">
                                    <a href="#">
                                        '.__( 'shopping tricks', 'flat-commerce' ).'
                                    </a>
                                </h3>
                            </div><!-- .entry-header -->
                            <div class="entry-content">
                                <p>
                                    '.__( 'Eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'flat-commerce' ).'
                                </p>
                            </div><!-- .entry-content -->
                        </div><!-- .col -->
                    </div><!-- .row -->
    </article><!-- article -->
    <article class="col col-1-of-3 col-m-1-of-3">
        <div class="row">
            <div class="col col-2-of-12 left-part">
                <time class="entry-date" datetime="2008-10-17">
                    <span>
                        30
                    </span>
                    <span>
                        '.__( ' nov.', 'flat-commerce' ).'
                    </span>
                </time><!-- .entry-date -->
                <span class="genericon genericon-user"></span>
            </div><!-- .col -->
            <div class="col col-10-of-12">
                <a href="#">
                    <img src="'.get_template_directory_uri().'/images/gallery/style-fashion.png" width="270" height="270" alt="'.__( 'style & fashion','flat-commerce').'"/>
                </a>
                <div class="entry-header">
                    <h3 class="entry-title">
                        <a href="#">
                            '.__( 'style & fashion.', 'flat-commerce' ).'
                        </a>
                    </h3>
                </div><!-- .entry-header -->
                <div class="entry-content">
                    <p>
                        '.__( ' Eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'flat-commerce' ).'
                    </p>
                </div><!-- .entry-content -->
            </div><!-- .col -->
        </div><!-- .row -->
    </article><!-- article -->
    <article class="col col-1-of-3 col-m-1-of-3">
        <div class="row">
            <div class="col col-2-of-12 left-part">
                <time class="entry-date" datetime="2008-10-17">
                    <span>
                        30
                    </span>
                    <span>
                        '.__( 'nov', 'flat-commerce' ).'
                    </span>
                </time><!-- .entry-date -->
                <span class="genericon genericon-user"></span>
            </div><!-- .col -->
            <div class="col col-10-of-12">
                <a href="#">
                    <img src="'.get_template_directory_uri().'/images/gallery/travel-Fashion.jpg" width="270" height="270" alt="'.__( 'travel & Fashion','flat-commerce').'"/>

                </a>
                <div class="entry-header">
                    <h3 class="entry-title">
                        <a href="#">
                            '.__( 'travel & Fashion', 'flat-commerce' ).'
                        </a>
                    </h3>
                </div><!-- .entry-header -->
                <div class="entry-content">
                    <p>
                        '.__( 'Eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'flat-commerce' ).'
                    </p>
                </div><!-- .entry-content -->
            </div><!-- .col -->
        </div><!-- .row -->
    </article><!-- article -->';

    return $flat_commerce_latest_blog;
}
endif;

// Demo Content Function
if( !function_exists( 'flat_commerce_latest_blog_post' ) ) :
/**
* Add Featured content.
*
* @uses action hook flat_commerce_before_content.
*
* @since Flat Commerce 0.1
*/
function flat_commerce_latest_blog_post( $options ) {
    global $post;

    $number_of_post = $options['latest_blog_number'];        // for number of posts

    $category_list  = array_filter( (array) $options['latest_blog_select_category'] );

    $flat_commerce_latest_blog = '';

    if ( !empty( $category_list ) && $number_of_post > 0 ) {
        $get_latest_posts = new WP_Query( array(
                    'posts_per_page' => $number_of_post,
                    'cat'            => $category_list,
                    'orderby'        => 'post__in',
                ));
    while ( $get_latest_posts->have_posts()) :
        $get_latest_posts->the_post();
        $flat_commerce_latest_blog .= '
            <article class="col col-1-of-3 col-m-1-of-3">
                    <div class="row">
                        <div class="col col-2-of-12 left-part">
                            <time class="entry-date" datetime="'.esc_html(get_the_date( 'Y-m-d' ) ).'">
                                <span>
                                    '.esc_html(get_the_date( 'd' ) ).'
                                </span>
                                <span>
                                    '.esc_html(get_the_date( 'M' ) ).'
                                </span>
                            </time><!-- .entry-date -->
                            <span class="genericon genericon-user"></span>
                        </div><!-- .col -->

                        <div class="col col-10-of-12">
                            <a href="'.esc_url( get_permalink() ).'">
                                '.get_the_post_thumbnail( $post->ID, 'flat-commerce-latest-blog' ).'
                            </a>
                            <div class="entry-header">
                                <h3 class="entry-title">
                                    <a href="'.esc_url( get_permalink() ).'">
                                        '.esc_html( get_the_title() ).'
                                    </a>
                                </h3>
                            </div><!-- .entry-header -->
                            <div class="entry-content">
                                <p>
                                   '.esc_html( get_the_excerpt() ).'
                                </p>
                            </div><!-- .entry-content -->
                        </div><!-- .col -->
                    </div><!-- .row -->
        </article><!-- article -->';
    endwhile;
    wp_reset_query();
    }

    return $flat_commerce_latest_blog;
}
endif;