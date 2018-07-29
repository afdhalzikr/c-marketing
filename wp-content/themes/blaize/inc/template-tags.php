<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Blaize
 */

if ( ! function_exists( 'blaize_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function blaize_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'blaize' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'blaize_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function blaize_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'blaize' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'blaize_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blaize_entry_footer() {
		// Hide category and tag text for pages.

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'blaize' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'blaize' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'blaize_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function blaize_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

if( !function_exists( 'blaize_custom_comment' ) ) {
    function blaize_custom_comment($comment, $args, $depth) {
        if ( 'div' === $args['style'] ) {
            $tag       = 'div';
            $add_below = 'comment';
        } else {
            $tag       = 'li';
            $add_below = 'div-comment';
        }?>
        <<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
        if ( 'div' != $args['style'] ) { ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix"><?php
        } ?>
            <div class="comment-author vcard">
                <?php 
                    if ( $args['avatar_size'] != 0 ) {
                        echo get_avatar( $comment, $args['avatar_size'] ); 
                    } 
                ?>
            </div>
            <div class="author-name-comment-meta">
                <div class="author-name">
                    <?php //printf( __( '<span class="fn">%s</span> <span class="says">says:</span>', 'blaize' ), get_comment_author_link() ); ?>
                    <span class="fn"><?php echo wp_kses_post( get_comment_author_link() ); ?></span> <span class="says"><?php esc_html_e( 'says:', 'blaize' ); ?></span>
                </div>
                <?php 
                    if ( $comment->comment_approved == '0' ) { ?>
                        <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'blaize' ); ?></em><br/><?php 
                    }
                ?>
                <div class="comment-data-reply">

                    <?php comment_text(); ?>

                    <div class="reply"><?php 
                            comment_reply_link( 
                                array_merge( 
                                    $args, 
                                    array( 
                                        'add_below' => $add_below, 
                                        'depth'     => $depth, 
                                        'max_depth' => $args['max_depth'] 
                                    ) 
                                ) 
                            ); ?>
                    </div>
                </div>
            </div>

            <?php 
        if ( 'div' != $args['style'] ) : ?>
            </div><?php 
        endif;

    }
}

if( !function_exists( 'blaize_custom_comment_fields' ) ) {
    function blaize_custom_comment_fields() {

        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );

        $blaize_comment_fields = array(
          'email' =>
            '<input id="email" name="email" type="text" placeholder="'. esc_html__( 'Email ID', 'blaize' ) .'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" size="30"' . $aria_req . ' /></p>',

          'author' =>
            '<input id="author" name="author" type="text" placeholder="' . esc_html__('Name', 'blaize') .'" value="' . esc_attr( $commenter['comment_author'] ) .
            '" size="30"' . $aria_req . ' /></p>',


          'url' =>
            '<input id="url" name="url" type="text" placeholder="'. esc_html__('Website URL', 'blaize') .'" value="' . esc_attr( $commenter['comment_author_url'] ) .
            '" size="30" /></p>',
        );

        return $blaize_comment_fields;
    }
}