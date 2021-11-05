<?php
/*
 * The template for displaying comments part
*/
if ( post_password_required() )
	return;
?>	

	<div id="comments" class="comments-area">
		<?php echo wikilogy_title( $title = esc_html__( 'Comments', 'wikilogy' ), $shadow_title = esc_html__( 'Comments', 'wikilogy' ), $text = esc_html__( 'All comments.', 'wikilogy' ), $style = "2" ); ?>
		<div class="comment-form">
			<?php
				$comments_args = array(
					'id_form' => 'commentform',
					'id_submit' => 'submit',
					'class_submit' => '',
					'title_reply_before' => '<div class="content-title-wrapper"><div class="title">',
					'title_reply_after' => '</div></div>',
					'title_reply' => '',
					'title_reply_to' => '<div class="comment-title">' . esc_html__('Leave a Reply to', 'wikilogy') . ' %s' . '</div>',
					'cancel_reply_link' => esc_html__( 'Cancel Reply', 'wikilogy'),
					'label_submit' => esc_html__( 'Post Comment', 'wikilogy'),
					'comment_field' => '<div class="form-textarea"><textarea class="form-control" placeholder="' . esc_html__('Your Comment', 'wikilogy') . '" name="comment" class="commentbody" id="comment" rows="4" tabindex="4"></textarea></div>',
					'comment_notes_before' => '',
					'fields' => apply_filters( 'comment_form_default_fields', array(
						'author' =>
							'<div class="form-inputs"><div class="form-group name"><input class="form-control" type="text" placeholder="' . esc_html__('Name', 'wikilogy') . '" name="author" id="author" value="' . esc_attr($comment_author) . '" size="22" tabindex="1"' . ($req ? "aria-required='true'" : '' ). ' /></div>',

						'email' =>
							'<div class="form-group email"><input class="form-control" type="text" placeholder="' . esc_html__('Email', 'wikilogy') . '" name="email" id="email" value="' . esc_attr($comment_author_email) . '" size="22" tabindex="1"' . ($req ? "aria-required='true'" : '' ). ' /></div>',

						'url' =>
							'<div class="form-group website"><input class="form-control" type="text" placeholder="' . esc_html__('Website URL', 'wikilogy') . '" name="url" id="url" value="' . esc_attr($comment_author_url) . '" size="22" tabindex="1" /></div></div>'
						)
					),

				);
				comment_form( $comments_args );
			?>
		</div>

		<?php if ( have_comments() ) { ?>
			<ol class="comment-list">
				<?php
					if (function_exists('wikilogy_comment')) {
						$callback = 'wikilogy_comment';
					} else {
						$callback = '';
					}
					
					wp_list_comments( array(
						'style' => 'ol',
						'short_ping' => true,
						'avatar_size' => 90,
						'callback' => $callback,
						'reply_text' => '' . esc_html__( 'Reply', 'wikilogy' ),
					) );
				?>
			
				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
					<nav class="navigation comment-navigation" role="navigation">
						<h1 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment Navigation', 'wikilogy' ); ?></h1>
						<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'wikilogy' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'wikilogy' ) ); ?></div>
					</nav>
				<?php } ?>

				<?php if ( ! comments_open() && get_comments_number() ) { ?>
					<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'wikilogy' ); ?></p>
				<?php } ?>
			</ol>
		<?php } ?>
	</div>