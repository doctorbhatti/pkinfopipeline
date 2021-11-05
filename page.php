<?php
/**
	* The template for displaying single
*/
get_header(); ?>

	<?php wikilogy_sub_content_before(); ?>
		<?php
			$title_style_single = get_post_meta( get_the_ID(), 'title_style', true );
			$content_title_style = ot_get_option( 'content_title_style' );
			$page_title = ot_get_option( 'page_title' );
			$title_single = get_post_meta( get_the_ID(), 'title_status', true );
			$full_with = get_post_meta( get_the_ID(), 'full_with', true );
			$page_title_text_global = ot_get_option( 'page_title_text' );

			if( !empty( $title_style_single ) ) {
				$title_style = $title_style_single;
			} else {
				$title_style = $content_title_style;
			}

			if( $full_with == 'on' ) {
				$full_with_status = "full-width-active";
			} else {
				$full_with_status = "";
			}

			if( $page_title_text_global == 'on' or !$page_title_text_global == 'off' ) {
				$title_text = get_post_meta( get_the_ID(), 'title_text', true );
				if( !empty( $title_text ) ) {
					$post_title_text = get_post_meta( get_the_ID(), 'title_text', true );
				} else {
					$post_title_text = "";					
				}

			} else {
				$post_title_text = "";
			}

			if( $page_title == 'on' and $title_single == 'on' or !$title_single == 'off' ) {
				wikilogy_title_banner( $style = $title_style, $title_text = $post_title_text );
			}
		?>
	
		<?php wikilogy_container_before( $extra_class = $full_with_status ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php wikilogy_featured_image_post( $post_id = get_the_ID() ); ?>
				<?php wikilogy_layout_row_before(); ?>
					<?php wikilogy_content_area_before(); ?>
						<div class="post-content">
							<?php the_content(); ?>
						</div>
					<?php wikilogy_content_area_after(); ?>
					<?php get_sidebar(); ?> 
				<?php wikilogy_row_after(); ?>
				<?php
					$page_comment_area = ot_get_option( 'page_comment_area' );
					if( $page_comment_area == "on" or !$page_comment_area == "off" ) {
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					}
				?>
			<?php endwhile; ?>
		<?php wikilogy_container_after(); ?>
	<?php wikilogy_sub_content_after(); ?>

<?php get_footer();