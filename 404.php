<?php
/*
	* The template for displaying 404 page
*/
get_header(); ?>

	<?php wikilogy_sub_content_before(); ?>
		<?php wikilogy_title_banner( $style = "2", $title_text = esc_html__( 'Page not found!', 'wikilogy' ) ); ?>
		<?php wikilogy_container_before(); ?>
			<div class="page-404-content">
				<?php
					$page_404_search = ot_get_option( 'page_404_search' );
					if( $page_404_search == 'on' or !$page_404_search == 'off' ) {
						echo wikilogy_search_form();
					}

					$page_404_text = ot_get_option( 'page_404_text' );
					if( $page_404_text == 'on' or !$page_404_text == 'off' ) {
						echo '<div class="description">' . esc_html__( 'The page you are looking for cannot be found but you can search in the site with search form.', 'wikilogy' ) . '</div>';
					}
				?>
				
			</div>
		<?php wikilogy_container_after(); ?>
	<?php wikilogy_sub_content_after(); ?>
	
<?php get_footer();
