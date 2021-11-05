<?php
/*
	* The template used for displaying single content
*/
?>

<div class="single-content">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-wrapper">
			<div class="post-content">
				<?php the_content(); ?>
			</div>
		
			<?php
				echo '<div class="post-content-footer">';
					wp_link_pages(
						array(
							'before' => '<div class="post-pages"><span class="title">' . esc_html__( 'Pages', 'wikilogy' ) . ':</span>',
							'after' => '</div>',
							'link_before' => '<span>',
							'link_after' => '</span>',
						)
					);

					$post_share_buttons = ot_get_option( 'post_share_buttons' );
					if ( !$post_share_buttons == 'off' or $post_share_buttons == 'on' ) {
						echo '<div class="post-share">';
							echo wikilogy_social_share();
						echo '</div>';
					}

					$post_tags = ot_get_option( 'post_tags' );
					if ( !$post_tags == 'off' or $post_tags == 'on' ) {
						$tags_title = esc_html__( 'Tags:', 'wikilogy' );
						the_tags( '<div class="post-tags"><div class="title">' . $tags_title . '</div><div class="list">', '', '</div></div>' );
					}
				echo '</div>';
			?>
		</div>
	</article>
</div>