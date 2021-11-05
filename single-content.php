<?php
/**
	* The template for displaying single
*/
get_header(); ?>

	<?php wikilogy_sub_content_before(); ?>
		<?php
			$content_title_style = ot_get_option( 'content_title_style' );
			$content_title_global = ot_get_option( 'content_title' );
			$title_single = get_post_meta( get_the_ID(), 'title_status', true );
			$title_style_single = get_post_meta( get_the_ID(), 'title_style', true );
			$full_with = get_post_meta( get_the_ID(), 'full_with', true );
			$content_title_text_global = ot_get_option( 'content_title_text' );

			if( $full_with == 'on' ) {
				$full_with_status = "full-width-active";
			} else {
				$full_with_status = "";
			}

			if( !empty( $title_style_single ) ) {
				$title_style = $title_style_single;
			} else {
				$title_style = $content_title_style;
			}

			if( $content_title_text_global == 'on' or !$content_title_text_global == 'off' ) {
				$title_text = get_post_meta( get_the_ID(), 'title_text', true );
				if( !empty( $title_text ) ) {
					$post_title_text = get_post_meta( get_the_ID(), 'title_text', true );
				} else {
					$post_title_text = "";					
				}

			} else {
				$post_title_text = "";
			}

			if( $content_title_global == 'on' and $title_single == 'on' or !$title_single == 'off' ) {
				wikilogy_title_banner( $style = $title_style, $title_text = $post_title_text );
			}
		?>
	
		<?php wikilogy_container_before( $extra_class = $full_with_status ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php wikilogy_featured_image_post( $post_id = get_the_ID() ); ?>
				<?php wikilogy_layout_row_before(); ?>
					<?php wikilogy_content_area_before(); ?>
						<?php get_template_part( 'include/formats/content-content' ); ?>
						<?php
							$content_author_biography = ot_get_option( 'content_author_biography' );
							if ( !$content_author_biography == 'off' or $content_author_biography == 'on' ) {
								wikilogy_author_box();
							}
						?>
					<?php wikilogy_content_area_after(); ?>
					<?php get_sidebar(); ?> 
				<?php wikilogy_row_after(); ?>

				<?php
					$content_related_contents = ot_get_option( 'content_related_contents' );
					$content_related_contents_column = ot_get_option( 'content_related_contents_column' );
					if( !$content_related_contents == 'off' or $content_related_contents == 'on' ) {
						wikilogy_related_contents( $count = $content_related_contents_column );
					}
				?>

				<?php
					$content_suggested_contents = ot_get_option( 'content_suggested_contents' );
					$content_suggested_contents_column = ot_get_option( 'content_suggested_contents_column' );
					if( !$content_suggested_contents == 'off' or $content_suggested_contents == 'on' ) {
						wikilogy_suggested_contents( $count = $content_suggested_contents_column, $post_id = get_the_ID() );
					}
				?>
				<?php
					$content_comment_area = ot_get_option( 'content_comment_area' );
					if( $content_comment_area == "on" or !$content_comment_area == "off" ) {
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					}
				?>
				<?php
					$content_toolbar = ot_get_option( 'content_toolbar' );
					$toolbar_status = get_post_meta( get_the_ID(), 'toolbar_status', true );
					if( $content_toolbar == "on" or !$content_toolbar == "off" ) {
						if( $toolbar_status == "on" or !$toolbar_status == "off" ) {
							if( $content_comment_area == "on" or !$content_comment_area == "off" ) {
								$comments = "true";
							} else {
								$comments = "false";
							}
							echo wikilogy_toolbar( $comments = $comments );
						}
					}

					echo wikilogy_content_index( $post_id = get_the_ID() );
				?>
			<?php endwhile; ?>
		<?php wikilogy_container_after(); ?>
	<?php wikilogy_sub_content_after(); ?>

<?php get_footer();