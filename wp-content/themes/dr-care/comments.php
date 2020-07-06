<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dr.care
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

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
	?>
		<h3 class="mb-5 h4 font-weight-bold"><?= get_comments_number() ?> Comments</h3>

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">
			<?php 
			$comments = get_comments([ 'post_id' => get_the_ID(), 'status' => 'approve' ]); 
			foreach($comments as $comment): ?>
				<li class="comment">
					<div class="vcard bio">
						<?php 
						$avatar = $comment->user_id 
							? get_user_meta($comment->user_id, 'nickname', true) . '.jpg' 
							: 'default-user.png';
						?>

						<img src="<?= UPLOADS . "{$avatar}" ?>" alt="Image placeholder">
					</div>
					
					<div class="comment-body">
						<h3><?= $comment->comment_author ?></h3>
						<!-- January 03, 2019 at 2:21pm -->
						<div class="meta mb-2"><?= $comment->comment_date_gmt ?></div>
						<p><?= $comment->comment_content ?></p>
						<p><a href="#" class="reply">Reply</a></p>
					</div>
				</li>
			<?php endforeach ?>
		</ul><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'dr-care' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	$commentArgs = [
		'comment_field' => '
			<div class="form-group">
				<label for="message">Message</label>
				<textarea  id="comment" name="comment" cols="30" rows="10" class="form-control"></textarea>
			</div>
		',
		'submit_button' => 
			'<input name="%1$s" type="submit" id="%2$s" class="%3$s btn py-3 px-4 btn-primary" value="%4$s" />',
	];

	comment_form( $commentArgs );
	?>
</div>
