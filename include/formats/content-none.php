<?php
/*
	* The template used for displaying no content
*/
?>

<div class="post-list single-list">
	<article class="none-content-list clearfix">
		<div class="post-wrapper">
			<div class="post-content">
				<?php echo wikilogy_title( $title = esc_html__( 'No Content', 'wikilogy' ), $shadow_title = esc_html__( 'Content', 'wikilogy' ), $text = "", $style = "2" ); ?>
				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				
					<?php $get_started_here = esc_html__( 'Get started here.', 'wikilogy' ); ?>

					<p class="text-center"><?php printf( esc_html__( 'Ready to publish your first post?', 'wikilogy' ) . ' <a href="%s">' . $get_started_here . '</a>', admin_url( 'post-new.php' ) ); ?></p>

				<?php elseif ( is_search() ) : ?>

					<p class="text-center"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'wikilogy' ); ?></p>
					
					<div class="content-none-search">
						<?php get_search_form(); ?>
					</div>
				
				<?php else : ?>

					<p class="text-center"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wikilogy' ); ?></p>
					<div class="content-none-search">
						<?php get_search_form(); ?>
					</div>

				<?php endif; ?>
			</div>
		</div>
	</article>
</div>