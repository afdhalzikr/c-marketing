<?php
/**
 * The template for displaying the Breadcrumb
 *
 * @package Theme Palace
 * @subpackage Flat Commerce Pro
 * @since Flat Commerce 0.8
 */

/**
 * Add breadcrumb.
 *
 * @action flat_commerce_after_header
 *
 * @since Flat Commerce 0.8
 */
if( !function_exists( 'flat_commerce_add_breadcrumb' ) ) :

	function flat_commerce_add_breadcrumb() {
		$options 	= flat_commerce_get_theme_options(); // Get options

		if( isset ( $options['breadcrumb_option'] ) && $options['breadcrumb_option'] ){

			echo flat_commerce_custom_breadcrumbs();
		}
		else
			return false;
	}

endif;
add_action( 'flat_commerce_after_header', 'flat_commerce_add_breadcrumb', 50 );

/**
 * Breadcrumb Lists
 * Allows visitors to quickly navigate back to a previous section or the root page.
 *
 * Adopted from Dimox
 *
 * @since Flat Commerce 0.8
 */
if( !function_exists( 'flat_commerce_custom_breadcrumbs' ) ) :

	function flat_commerce_custom_breadcrumbs() {

		/* === OPTIONS === */
		$text['home']     = __( 'Home', 'flat-commerce' ); // text for the 'Home' link
		$text['category'] = __( '%1$s Archive for %2$s', 'flat-commerce' ); // text for a category page
		$text['search']   = __( '%1$sSearch results for: %2$s', 'flat-commerce' ); // text for a search results page
		$text['tag']      = __( '%1$sPosts tagged %2$s', 'flat-commerce' ); // text for a tag page
		$text['author']   = __( '%1$sView all posts by %2$s', 'flat-commerce' ); // text for an author page
		$text['404']      = __( 'Error 404', 'flat-commerce' ); // text for the 404 page

		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$before      = '<li class="breadcrumb-current">'; // tag before the current crumb
		$after       = '</li>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post, $paged, $page;
		$homeLink   = home_url( '/' );
		$delimiter  = '>>';
		$linkBefore = '<li class="breadcrumb" typeof="v:Breadcrumb">';
		$linkAfter  = '</li>';
		$linkAttr   = ' rel="v:url" property="v:title"';
		$link       = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s ' . $delimiter . '</a>' . $linkAfter;

		$breadcrumb_output = "";
		if( ! is_front_page() ) {			
		
			$breadcrumb_output .= '<div class="breadcrumb-wrapper">
					<ul>';

			$breadcrumb_output .= sprintf( $link, $homeLink, $text['home'] );

			if( is_category() ) {
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if( $thisCat->parent != 0 ) {
					$cats = get_category_parents( $thisCat->parent, true, false );
					$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
					$cats = str_replace( '</a>', $delimiter .'</a>' . $linkAfter, $cats );
					$breadcrumb_output .= $cats;
				}
				$breadcrumb_output .= $before . sprintf( $text['category'], '<span class="archive-text">', '&nbsp</span>' . single_cat_title( '', false ) ) . $after;

			}
			elseif( is_search() ) {
				$breadcrumb_output .= $before . sprintf( $text['search'], '<span class="search-text">', '&nbsp</span>' . get_search_query() ) . $after;

			}
			elseif( is_day() ) {
				$breadcrumb_output .= sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) ;
				$breadcrumb_output .= sprintf( $link, get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ) );
				$breadcrumb_output .= $before . get_the_time( 'd' ) . $after;

			}
			elseif( is_month() ) {
				$breadcrumb_output .= sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) ;
				$breadcrumb_output .= $before . get_the_time( 'F' ) . $after;

			}
			elseif( is_year() ) {
				$breadcrumb_output .= $before . get_the_time( 'Y' ) . $after;

			}
			elseif( is_single() && !is_attachment() ) {
				if( get_post_type() != 'post' ) {
					$post_type = get_post_type_object( get_post_type() );
					$slug      = $post_type->rewrite;
					printf( $link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name );
					if( $showCurrent == 1 ) {
						$breadcrumb_output .= $before . get_the_title() . $after;
					}
				}
				else {
					$cat  = get_the_category();
					$cat  = $cat[0];
					$cats = get_category_parents( $cat, true, ''	 );
					if( $showCurrent == 0 ) {
						$cats = preg_replace( "#^(.+)$#", "$1", $cats );
					}
					$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
					$cats = str_replace( '</a>', $delimiter .'</a>' . $linkAfter, $cats );
					$breadcrumb_output .= $cats;
					if( $showCurrent == 1 ) {
						$breadcrumb_output .= $before . get_the_title() . $after;
					}
				}
			}
			elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object( get_post_type() );
				$breadcrumb_output .= $before . $post_type->labels->singular_name . $after;
			}
			elseif( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				$cat    = get_the_category( $parent->ID );

				if( isset( $cat[0] ) ) {
					$cat = $cat[0];
				}

				if( $cat ) {
					$cats = get_category_parents( $cat, true );
					$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
					$cats = str_replace( '</a>', $delimiter .'</a>' . $linkAfter, $cats );
					$breadcrumb_output .= $cats;
				}

				printf( $link, get_permalink( $parent ), $parent->post_title );
				if( $showCurrent == 1 ) {
					$breadcrumb_output .= $before . get_the_title() . $after;
				}

			}
			elseif( is_page() && !$post->post_parent ) {
				if( $showCurrent == 1 ) {
					$breadcrumb_output .= $before . get_the_title() . $after;
				}

			}
			elseif( is_page() && $post->post_parent ) {
				$parent_id   = $post->post_parent;
				$breadcrumbs = array();
				while( $parent_id ) {
					$page_child    = get_post( $parent_id );
					$breadcrumbs[] = sprintf( $link, get_permalink( $page_child->ID ), get_the_title( $page_child->ID ) );
					$parent_id     = $page_child->post_parent;
				}
				$breadcrumbs = array_reverse( $breadcrumbs );
				for( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
					$breadcrumb_output .= $breadcrumbs[$i];
				}
				if( $showCurrent == 1 ) {
					$breadcrumb_output .= $before . get_the_title() . $after;
				}

			}
			elseif( is_tag() ) {
				$breadcrumb_output .= $before . sprintf( $text['tag'], '<span class="tag-text">', '&nbsp</span>' . single_tag_title( '', false ) ) . $after;

			}
			elseif( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				$breadcrumb_output .= $before . sprintf( $text['author'], '<span class="author-text">', '&nbsp</span>' . $userdata->display_name ) . $after;

			}
			elseif( is_404() ) {
				$breadcrumb_output .= $before . $text['404'] . $after;

			}
			if( get_query_var( 'paged' ) ) {
				if( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					$breadcrumb_output .= ' (';
				}
				$breadcrumb_output .= sprintf( __( 'Page %s', 'flat-commerce' ), max( $paged, $page ) );
				if( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					$breadcrumb_output .= ')';
				}
			}

			$breadcrumb_output .= '</ul>
			</div><!-- #breadcrumb-list -->';
		}
		return $breadcrumb_output;
	} // end flat_commerce_breadcrumb_lists
endif;