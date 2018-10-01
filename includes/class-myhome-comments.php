<?php

/*
 * My_Home_Comments class
 *
 * This class setup all things related to comments
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'My_Home_Comments' ) ) :

class My_Home_Comments {

    /*
     * Set necessary hooks
     */
	public function __construct() {
		add_action( 'comment_form_before_fields', array( $this, 'fields_wrapper_start' ) );
		add_action( 'comment_form_after_fields', array( $this, 'fields_wrapper_end' ) );
		add_filter( 'comment_form_submit_field', array( $this, 'modify_submit' ), 10, 2 );
	}

	private $avatar_size = 70;
	private $max_depth = 2;

	/*
	 * modify_submit
	 *
	 * Change submit button structure
	 */
	public function modify_submit() {
	    ob_start();
	    ?>
        <p class="form-submit">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary">
                <?php esc_html_e( 'Send comment', 'myhome' ); ?>
            </button>
            <input type="hidden" name="comment_parent" id="comment_parent" value="0">
            <input type="hidden" name="comment_post_ID" value="" id="comment_post_ID">
        </p>
        <?php
        return ob_get_clean();
    }

    /*
     * fields_wrapper_start
     *
     * Add additional html before comments
     */
	public function fields_wrapper_start() {
		echo '<div class="comments-fields-wrapper">';
	}

	/*
	 * fields_wrapper_end
	 *
	 * Add additional html after comments
	 */
	public function fields_wrapper_end() {
		echo '</div>';
	}

	/*
	 * show_nav
	 *
	 * Check if comments should be displayed
	 */
	public function show_nav() {
		return get_comment_pages_count() > 1 && get_option( 'page_comments' );
	}

	/*
	 * nav
	 *
	 * Display comments navigation
	 */
	public function nav() {
		esc_html_e( 'Comment navigation', 'myhome' );
		previous_comments_link( esc_html__( '&larr; Older Comments', 'myhome' ) );
		next_comments_link( esc_html__( 'Newer Comments &rarr;', 'myhome' ) );
	}

	/*
	 * display
	 *
	 * Display comments
	 */
	public function display() {
		wp_list_comments( array(
			'style'      => 'div',
			'short_ping' => true,
			'avatar_size'=> 50,
			'callback' => array( $this, 'comment_cb' )
		) );
	}

	/*
	 * form
	 *
	 * Display comments form
	 */
	public function form() {
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$args = array(
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author'    => '<div class="mh-grid"><div class="mh-grid__1of3"><input type="text" name="author"'
                               . ' id="comment-author" value="' . esc_attr( $commenter['comment_author'] )
                               . '" size="22" tabindex="1" placeholder="' . esc_attr__( 'Name*', 'myhome' ) . '" '
                               . $aria_req . ' /></div>',
				'email'     => '<div class="mh-grid__1of3"><input type="text" name="email" id="comment-email" value="'
				               . esc_attr( $commenter['comment_author_email'] ) . '" size="22" tabindex="2"'
				               . ' placeholder="' . esc_attr__( 'Email*', 'myhome' ) . '" ' . $aria_req . ' /></div>',
				'url'       => '<div class="mh-grid__1of3"><input type="text" name="url" id="comment-url" value="'
				               . esc_attr( $commenter['comment_author_url'] ) . '" size="22" tabindex="3"'
				               . ' placeholder="' . esc_attr__( 'Website', 'myhome' ) . '" /></div></div>',
			) ),
			'comment_notes_after'   => '',
			'comment_notes_before'  => '',
			'comment_field'         => '<div class="comments-textarea-wrapper">'
			                           . '<textarea placeholder="' . esc_attr__( 'Comment', 'myhome' ) . '"'
			                           . ' name="comment" id="comment" cols="58" rows="10" tabindex="4">'
			                           . '</textarea></div>',
			'must_log_in'           => '<p>' . sprintf(
			                                       wp_kses( __(
			                                            'You must be <a href="%s">logged in</a> to post a comment.',
                                                        'myhome'
                                                    ), array( 'a' => array( 'href' => array() ) ) ),
													wp_login_url( get_permalink() )
                                                ) . '</p>',
			'logged_in_as'          => '<p class="comments-logged">' . sprintf(
													wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>.', 'myhome' ), array( 'a' => array( 'href' => array() ) ) ),
													get_edit_user_link(),
													wp_get_current_user()->display_name )
			                           . ' <a href="' . wp_logout_url( get_permalink() ) . '" title="'
			                           . esc_attr__( 'Log out of this account', 'myhome' ) . '">'
			                           . esc_html__( 'Log out &raquo;', 'myhome' ) . '</a></p>',
			'class_submit'			=> 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mdl-button--lg',
			'label_submit'          => esc_html__( 'Send Comment', 'myhome' ),
			'class_reply'			=> 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mdl-button--lg',
			'title_reply'           => esc_html__( 'Leave a reply', 'myhome' ),
			'title_reply_to'        => esc_html__( 'Comment to %s', 'myhome' )
		);
		comment_form( $args );
	}

	/*
	 * comment_cb
	 *
	 * Callback for wp_list_comments function
	 */
	public function comment_cb( $comment, $args, $depth ) { ?>
	<?php if ( ! $comment->comment_approved ) : ?>
		<em class="mh-comment-awaiting-moderation">
			<?php esc_html_e( 'Your comment is awaiting moderation', 'myhome' ); ?>
		</em>
	<?php endif; ?>
	<div <?php comment_class( empty( $args['has_children'] ) ? 'mh-comment' : 'mh-comment parent' ); ?> id="comment-<?php comment_ID(); ?>">
		<div class="mh-comment__avatar">
			<?php echo get_avatar( $comment, $this->avatar_size ); ?>
		</div>
		<div class="mh-comment__content">
			<h4 class="mh-comment__author">
				<?php comment_author_link(); ?>
			</h4>
			<div class="mh-comment__date">
			<?php echo esc_html( get_comment_date() );
			edit_comment_link(
				'<span class="comment-edit-icon"></span><i class="fa fa-pencil"></i>' . esc_html__( 'edit comment', 'myhome' ),
				'',
				''
			); ?>
			</div>
			<div class="mh-comment__text">
				<?php comment_text(); ?>
			</div>


			<?php comment_reply_link( array_merge( $args, array(
				'reply_text'    => esc_html__( 'Reply', 'myhome' ) . '<i class="fa fa-reply" aria-hidden="true"></i>',
				'depth'         => $depth,
				'max_depth'     => $this->max_depth,
				'before'        => '',
				'after'         => ''
			) ) );
			?>
		</div>
	<?php }

	/*
	 * number_text
	 *
	 * Comments number
	 */
	public function number_text() {
		printf(
            _n( '1 comment', '%1$s comments', get_comments_number(), 'myhome' ),
            number_format_i18n( get_comments_number() )
        );
	}

	/*
	 * closed
	 *
	 * Text displayed when comments are closed
	 */
	public function closed() {
		esc_html_e( 'Comments are closed.', 'myhome' );
	}

}

endif;
