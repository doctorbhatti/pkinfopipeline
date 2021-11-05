<?php
/*
	* The template used for displaying attachment
*/
?>

<div class="single-content">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-wrapper">
			<div class="post-content">
				<p><?php echo wp_get_attachment_link( get_the_ID(), 'full', true, true ); ?></p>
				<?php the_content(); ?>
			</div>
		
			<?php
				$attachment_social_share = ot_get_option( 'attachment_social_share' );
				if ( !$attachment_social_share == 'off' or $attachment_social_share == 'on' ) {
					echo '<div class="post-content-footer">';
						echo '<div class="post-share">';
							echo wikilogy_social_share();
						echo '</div>';
					echo '</div>';
				}
			?>
		</div>
	</article>
</div>