<?php
/**
	* The template for displaying attachment
*/
get_header(); ?>

	<?php wikilogy_sub_content_before(); ?>
		<?php
			$attachment_attachment_title = ot_get_option( 'attachment_attachment_title' );
			if( !$attachment_attachment_title == 'off' or $attachment_attachment_title == 'on' ) {
				$style = ot_get_option( 'default_title_style' );
				if( empty( $style ) ) {
					$style = "1";
				}
				wikilogy_title_banner( $style = $style );
			}
		?>
		<?php wikilogy_container_before(); ?>
			<?php wikilogy_layout_row_before(); ?>
				<?php wikilogy_content_area_before(); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'include/formats/content-attachment' ); ?>
					<?php endwhile; ?>
					<?php
						$attachment_comment_area = ot_get_option( 'attachment_comment_area' );
						if( $attachment_comment_area == "on" or !$attachment_comment_area == "off" ) {
							while ( have_posts() ) : the_post(); 
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							endwhile;
						}
					?>
				<?php wikilogy_content_area_after(); ?>
				<?php get_sidebar(); ?>
			<?php wikilogy_row_after(); ?>
		<?php wikilogy_container_after(); ?>
	<?php wikilogy_sub_content_after(); ?>

<?php get_footer();