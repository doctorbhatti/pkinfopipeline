<?php
/*
	* The template for displaying archive
*/
get_header(); ?>
	<?php wikilogy_sub_content_before(); ?>
		<?php
			$style = ot_get_option( 'default_title_style' );
			if( empty( $style ) ) {
				$style = "1";
			}

			if( is_category() ) {
				$blog_category_title = ot_get_option( 'blog_category_title' );
				if( !$blog_category_title == 'off' or $blog_category_title == 'on' ) {
					wikilogy_title_banner( $style = $style );
				}
			} elseif( is_tag() ) {
				$tag_tag_title = ot_get_option( 'tag_tag_title' );
				if( !$tag_tag_title == 'off' or $tag_tag_title == 'on' ) {
					wikilogy_title_banner( $style = $style );
				}
			} else {
				$archive_wikilogy_archive_title = ot_get_option( 'archive_wikilogy_archive_title' );
				if( !$archive_wikilogy_archive_title == 'off' or $archive_wikilogy_archive_title == 'on' ) {
					wikilogy_title_banner( $style = $style );
				}
			}
		?>
		<?php wikilogy_container_before(); ?>
			<?php wikilogy_layout_row_before(); ?>
				<?php wikilogy_content_area_before(); ?>
					<?php
					if ( have_posts() ) {
						wikilogy_archive_post_list();
						wikilogy_pagination();		
					} else {
						get_template_part( 'include/formats/content', 'none' );
					}
					?>
				<?php wikilogy_content_area_after(); ?>
				
				<?php get_sidebar(); ?> 
			<?php wikilogy_row_after(); ?>
			
		<?php wikilogy_container_after(); ?>
	<?php wikilogy_sub_content_after(); ?>
	
<?php get_footer();