<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Flat_Commerce
 */

if ( ! function_exists( 'flat_commerce_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function flat_commerce_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="entry-date updated" datetime="%3$s">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date( get_option( 'date_format' ) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	echo $time_string;

	if( is_single() ) {
		//No byline in single post/pages
		return;
	}
}
endif;

 //flat_commerce_archive_content_image

if ( ! function_exists( 'flat_commerce_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function flat_commerce_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'flat-commerce' ) );
		if ( $categories_list && flat_commerce_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'flat-commerce' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'flat-commerce' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'flat-commerce' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'flat-commerce' ), esc_html__( '1 Comment', 'flat-commerce' ), esc_html__( '% Comments', 'flat-commerce' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'flat-commerce' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function flat_commerce_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'flat_commerce_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'flat_commerce_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so flat_commerce_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so flat_commerce_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in flat_commerce_categorized_blog.
 */
function flat_commerce_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'flat_commerce_categories' );
}
add_action( 'edit_category', 'flat_commerce_category_transient_flusher' );
add_action( 'save_post',     'flat_commerce_category_transient_flusher' );
