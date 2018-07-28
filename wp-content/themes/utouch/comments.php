<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}


$comm_class = array();
if ( ! have_comments() ) {
$comm_class[] = 'has-not-comments';
}
?>

<div id="comments" class="comments comments-area <?php echo implode( ' ', $comm_class ) ?>">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<div class="d-flex--content-inline">
			<h3><?php printf( // WPCS: XSS OK.
					esc_html( _nx( 'One comment', '%1$s Comments', get_comments_number(), 'comments title', 'utouch' ) ),
					number_format_i18n( get_comments_number() )
				);
				?></h3>

			<a href="#leave-reply" class="btn btn--green">
				<span class="text"><?php echo esc_html__('Leave a Comment','utouch') ?></span>
			</a>
		</div>



		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

		<nav id="comment-nav-above" class="navigation comment-navigation pagination-arrow" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'utouch' ); ?></h2>
				<?php
				$prev_commnts_link_markup = '<span class="btn-content">
					<span class="btn-content-title">'. esc_html__( 'Older Comments', 'utouch' ) .'</span>
				</span>
				<svg class="btn-next">
					<use xlink:href="#arrow-right"></use>
				</svg>';
				$next_commnts_link_markup = '
				<svg class="btn-prev">
					<use xlink:href="#arrow-left"></use>
				</svg><span class="btn-content">
					<span class="btn-content-title">'. esc_html__( 'Newer Comments', 'utouch' ) .'</span>
				</span>'; ?>

				<?php previous_comments_link( $next_commnts_link_markup ); ?>
				<?php next_comments_link( $prev_commnts_link_markup ); ?>

		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comments__list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'callback' => 'utouch_comments'
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation  pagination-arrow" role="navigation">

			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'utouch' ); ?></h2>

				<?php previous_comments_link( $next_commnts_link_markup ); ?>
				<?php next_comments_link( $prev_commnts_link_markup ); ?>

			</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation.
	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<h6 class="no-comments"><?php esc_html_e( 'Comments are closed.', 'utouch' ); ?></h6>
	<?php endif; ?>
	<div class="leave-reply" id="leave-reply">
	<?php
	$fields        = array(
		'author' => '<div class="row"><div class="col-lg-6"><div class="with-icon">
				<input class="email input-standard-grey" name="author" id="author" placeholder="Your Full Name" value="' . esc_attr( $commenter['comment_author'] ) .'" type="text" required>		
					<svg class="utouch-icon utouch-icon-user"><use xlink:href="#utouch-icon-user"></use></svg></div></div>',
		'email'  => '<div class="col-lg-6"><div class="with-icon">
		<input class="email input-standard-grey" name="email" id="email" placeholder="' . esc_html__( 'Email', 'utouch' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" type="email" required>
		<svg class="utouch-icon utouch-icon-message-closed-envelope-1"><use xlink:href="#utouch-icon-message-closed-envelope-1"></use></svg></div></div></div>',
		'url'    => ''
	);
	$comments_args = array(
		'id_form'              => 'commentform',
		'class_submit'         => 'hide',
		'name_submit'          => 'submit',
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'title_reply'          => esc_html__( 'Leave a Comment', 'utouch' ),
		'title_reply_to'       => esc_html__( 'Leave a Comment to %s', 'utouch' ),
		'cancel_reply_link'    => esc_html__( 'Cancel Comment', 'utouch' ),
		'label_submit'         => esc_html__( 'Post Comment', 'utouch' ),
		'title_reply_before'   => '<h3>',
		'title_reply_after'    => '</h3>',
		'comment_notes_after'  => '<div class="row"><div class="submit-block display-flex">
									<div class="col-lg-4">
										<button class="btn btn--large btn--green btn--with-shadow full-width">
											<span class="text">' . esc_html__( 'Submit', 'utouch' ) . '</span>
										</button>
									</div>
									<div class="col-lg-8">
										<div class="submit-block-text">
										' . esc_html__('You may use these HTML tags and attributes', 'utouch') .': 
										<span> &lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt;
											&lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt;
											&lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; &lt;strong&gt; </span>
										</div>
									</div>

								</div></div>',
		'comment_notes_before' => '<p class="comment-notes  mb30">' . esc_html__( 'Your email address will not be published.', 'utouch' ) . '</p>',
		'comment_field'        => '<div class="row"><div class="col-sm-12"><div class="with-icon">
		<textarea class="input-text input-standard-grey" id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_html__( 'Comment', 'utouch' ) . '"></textarea>
		<svg class="utouch-icon utouch-icon-edit"><use xlink:href="#utouch-icon-edit"></use></svg></div></div></div>',
	);
    if (comments_open()){
        comment_form( $comments_args );
    } ?>
	</div>
</div><!-- #comments -->


