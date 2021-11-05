<?php
/**
	* The template for displaying single
*/
get_header(); ?>

	<?php wikilogy_sub_content_before(); ?>
		<?php
			$post_title_style = ot_get_option( 'post_title_style' );
			$post_title_global = ot_get_option( 'post_title' );
			$title_single = get_post_meta( get_the_ID(), 'title_status', true );
			$full_with = get_post_meta( get_the_ID(), 'full_with', true );
			$post_title_text_global = ot_get_option( 'post_title_text' );

			if( $full_with == 'on' ) {
				$full_with_status = "full-width-active";
			} else {
				$full_with_status = "";
			}

			if( $post_title_text_global == 'on' or !$post_title_text_global == 'off' ) {
				$title_text = get_post_meta( get_the_ID(), 'title_text', true );
				if( !empty( $title_text ) ) {
					$post_title_text = get_post_meta( get_the_ID(), 'title_text', true );
				} else {
					$post_title_text = "";					
				}

			} else {
				$post_title_text = "";
			}

			if( $post_title_global == 'on' and $title_single == 'on' or !$title_single == 'off' ) {
				wikilogy_title_banner( $style = $post_title_style, $title_text = $post_title_text );
			}
		?>
	
		<?php wikilogy_container_before( $extra_class = $full_with_status ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php wikilogy_featured_image_post( $post_id = get_the_ID() ); ?>
				<?php wikilogy_layout_row_before(); ?>
					<?php wikilogy_content_area_before(); ?>
						<?php get_template_part( 'include/formats/content', get_post_format() ); ?>
						<?php
							$post_author_biography = ot_get_option( 'post_author_biography' );
							if ( !$post_author_biography == 'off' or $post_author_biography == 'on' ) {
								wikilogy_author_box();
							}
						?>
					<?php wikilogy_content_area_after(); ?>
					<?php get_sidebar(); ?> 
				<?php wikilogy_row_after(); ?>
				<?php
					$post_related_posts = ot_get_option( 'post_related_posts' );
					$post_related_count = ot_get_option( 'post_related_posts_column' );
					if( !$post_related_posts == 'off' or $post_related_posts == 'on' ) {
						wikilogy_related_posts( $count = $post_related_count );
					}
				?>

				<?php
					$post_suggested_posts = ot_get_option( 'post_suggested_posts' );
					$post_suggested_posts_column = ot_get_option( 'post_suggested_posts_column' );
					if( !$post_suggested_posts == 'off' or $post_suggested_posts == 'on' ) {
						wikilogy_suggested_contents( $count = $post_suggested_posts_column, $post_id = get_the_ID() );
					}
				?>
				<?php
					$post_comment_area = ot_get_option( 'post_comment_area' );
					if( $post_comment_area == "on" or !$post_comment_area == "off" ) {
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					}
				?>
				<?php
					$post_toolbar = ot_get_option( 'post_toolbar' );
					$toolbar_status = get_post_meta( get_the_ID(), 'toolbar_status', true );
					if( $post_toolbar == "on" or !$post_toolbar == "off" ) {
						if( $toolbar_status == "on" or !$toolbar_status == "off" ) {
							if( $post_comment_area == "on" or !$post_comment_area == "off" ) {
								$comments = "true";
							} else {
								$comments = "false";
							}
							echo wikilogy_toolbar( $comments = $comments );
						}
					}
				?>
			<?php endwhile; ?>
		<?php wikilogy_container_after(); ?>
	<?php wikilogy_sub_content_after(); ?>

<?php get_footer();