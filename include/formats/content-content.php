<?php
/*
	* The template used for displaying single content
*/
?>

<div class="single-content">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-wrapper">
			<div class="post-content">
				<div class="post-content-inner">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="post-content-footer">
				<?php
					wp_link_pages(
						array(
							'before' => '<div class="post-pages"><span class="title">' . esc_html__( 'Pages', 'wikilogy' ) . ':</span>',
							'after' => '</div>',
							'link_before' => '<span>',
							'link_after' => '</span>',
						)
					);

					$content_share_buttons = ot_get_option( 'content_share_buttons' );
					if ( !$content_share_buttons == 'off' or $content_share_buttons == 'on' ) {
						echo '<div class="post-share">';
							echo wikilogy_social_share();
						echo '</div>';
					}

					$content_categories = ot_get_option( 'content_categories' );
					if ( !$content_categories == 'off' or $content_categories == 'on' ) {
						$content_categories = wp_get_post_terms( get_the_ID(), 'content_category', array( 'fields' => 'ids' ) );
						$arg = array(
							'taxonomy' => 'content_category',
							'hide_empty' => 'false',
							'include' => $content_categories,
							'hierarchical' => true,
						);
						$terms = get_terms( $arg );
						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
							echo '<div class="content-categories">';
								echo '<div class="title">' . esc_html__( 'Categories', 'wikilogy' ) . ':</div>';
								echo '<div class="list">';
									foreach ( $terms as $term ) {
										if( !empty( $term ) ) {
											$name = $term->name;
											$id = $term->term_id;
											echo '<a href="' . get_term_link( $id ) . '">' . esc_attr( $name ) . '</a>';
										}
									}
								echo '</div>';
							echo '</div>';
						}
					}

					$content_tags = ot_get_option( 'content_tags' );
					if ( !$content_tags == 'off' or $content_tags == 'on' ) {
						$content_tags = wp_get_post_terms( get_the_ID(), 'content_tag', array( 'fields' => 'ids' ) );
						$tags_arg = array(
							'taxonomy' => 'content_tag',
							'hide_empty' => 'false',
							'include' => $content_tags,
							'hierarchical' => true,
						);
						$tags_terms = get_terms( $tags_arg );
						if ( ! empty( $tags_terms) && ! is_wp_error( $tags_terms ) ) {
							echo '<div class="content-categories">';
								echo '<div class="title">' . esc_html__( 'Content Tags', 'wikilogy' ) . ':</div>';
								echo '<div class="list">';
									foreach ( $tags_terms as $tags_term ) {
										if( !empty( $tags_term ) ) {
											$tag_name = $tags_term->name;
											$tag_id = $tags_term->term_id;
											echo '<a href="' . get_term_link( $tag_id ) . '">' . esc_attr( $tag_name ) . '</a>';
										}
									}
								echo '</div>';
							echo '</div>';
						}
					}
				?>
			</div>
		</div>
	</article>
</div>