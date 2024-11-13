<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package An_Store
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<div class="comment-custom-respond">
		<div class="title-box">
			<h3 class="comment-custom-reply-title">Post a Comment</h3>
			<button class="toggle-comments">open ▾</button>
		</div>
		<div class="comments-accordion">
			<?php comment_form(); ?>
		</div>
	</div>

<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$an_store_comment_count = get_comments_number();

			echo esc_html('Comments ') . "(" . $an_store_comment_count . ")";
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'an-store' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	?>

</div><!-- #comments -->
