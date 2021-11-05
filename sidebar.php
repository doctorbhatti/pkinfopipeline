<?php
if ( is_attachment() ) {

	$attachment_sidebar_select = ot_get_option( 'attachment_sidebar_select' );

	if ( !empty( $attachment_sidebar_select) ) {
		if ( is_active_sidebar( $attachment_sidebar_select ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $attachment_sidebar_select ); 
			wikilogy_sidebar_after();
		}
		
	} else {
		if ( is_active_sidebar( 'general-sidebar' ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar("general-sidebar");
			wikilogy_sidebar_after(); 			
		}
	}
	
} elseif( get_post_type( get_the_ID() ) == 'content' ) {
	$post_id = get_the_ID();
	$content_sidebar_select = ot_get_option( 'content_sidebar_select' );
	$post_sidebar = get_post_meta( $post_id, 'sidebar_select', true );
	
	if( !empty( $post_sidebar ) ) {
		if ( is_active_sidebar( $post_sidebar ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $post_sidebar ); 
			wikilogy_sidebar_after();
		}
		
	} elseif ( !empty( $content_sidebar_select) ) {
		if ( is_active_sidebar( $content_sidebar_select ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $content_sidebar_select ); 
			wikilogy_sidebar_after();
		}
		
	} else {
		if ( is_active_sidebar( 'general-sidebar' ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar("general-sidebar");
			wikilogy_sidebar_after(); 			
		}
	}
	
} elseif( is_single() ) {
	
	$post_id = get_the_ID();
	$post_sidebar_select = ot_get_option( 'post_sidebar_select' );
	$post_sidebar = get_post_meta( $post_id, 'sidebar_select', true );
	
	if( !empty( $post_sidebar ) ) {
		if ( is_active_sidebar( $post_sidebar ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $post_sidebar ); 
			wikilogy_sidebar_after();
		}
		
	} elseif ( !empty( $post_sidebar_select) ) {
		if ( is_active_sidebar( $post_sidebar_select ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $post_sidebar_select ); 
			wikilogy_sidebar_after();
		}
		
	} else {
		if ( is_active_sidebar( 'general-sidebar' ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar("general-sidebar");
			wikilogy_sidebar_after(); 			
		}
	}
	
} elseif( is_page() ) {
	
	$post_id = get_the_ID();
	$page_sidebar_select = ot_get_option( 'page_sidebar_select' );
	$post_sidebar = get_post_meta( $post_id, 'sidebar_select', true );
	
	if( !empty( $post_sidebar ) ) {
		if ( is_active_sidebar( $post_sidebar ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $post_sidebar ); 
			wikilogy_sidebar_after();
		}
		
	} elseif ( !empty( $page_sidebar_select) ) {
		if ( is_active_sidebar( $page_sidebar_select ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $page_sidebar_select ); 
			wikilogy_sidebar_after();
		}
		
	} else {
		if ( is_active_sidebar( 'general-sidebar' ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar("general-sidebar");
			wikilogy_sidebar_after(); 			
		}
	}

} elseif ( is_category() ) {
	
	$cat = get_queried_object();
	$cat_id = $cat->term_id;
	$category_sidebar_settings = ot_get_option('sidebar_select_'. $cat_id); 

	if( !empty( $category_sidebar_settings ) ) {
		if ( is_active_sidebar( $category_sidebar_settings ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $category_sidebar_settings ); 
			wikilogy_sidebar_after();
		}
	} else {
		if ( is_active_sidebar( 'general-sidebar' ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar("general-sidebar");
			wikilogy_sidebar_after(); 			
		}
	}
	
}elseif ( is_tag() ) {

	$tag_sidebar_select = ot_get_option( 'tag_sidebar_select' );

	if ( !empty( $tag_sidebar_select) ) {
		if ( is_active_sidebar( $tag_sidebar_select ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $tag_sidebar_select ); 
			wikilogy_sidebar_after();
		}
		
	} else {
		if ( is_active_sidebar( 'general-sidebar' ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar("general-sidebar");
			wikilogy_sidebar_after(); 			
		}
	}
	
} elseif ( is_author() ) {

	$author_sidebar_select = ot_get_option( 'author_sidebar_select' );

	if ( !empty( $author_sidebar_select) ) {
		if ( is_active_sidebar( $author_sidebar_select ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $author_sidebar_select ); 
			wikilogy_sidebar_after();
		}
		
	} else {
		if ( is_active_sidebar( 'general-sidebar' ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar("general-sidebar");
			wikilogy_sidebar_after(); 			
		}
	}
	
} elseif ( is_search() ) {

	$search_sidebar_select = ot_get_option( 'search_sidebar_select' );

	if ( !empty( $search_sidebar_select) ) {
		if ( is_active_sidebar( $search_sidebar_select ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $search_sidebar_select ); 
			wikilogy_sidebar_after();
		}
		
	} else {
		if ( is_active_sidebar( 'general-sidebar' ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar("general-sidebar");
			wikilogy_sidebar_after(); 			
		}
	}
	
} elseif ( is_archive() ) {

	$archive_sidebar_select = ot_get_option( 'archive_sidebar_select' );

	if ( !empty( $archive_sidebar_select) ) {
		if ( is_active_sidebar( $archive_sidebar_select ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar( $archive_sidebar_select ); 
			wikilogy_sidebar_after();
		}
		
	} else {
		if ( is_active_sidebar( 'general-sidebar' ) ) {
			wikilogy_sidebar_before();
				dynamic_sidebar("general-sidebar");
			wikilogy_sidebar_after(); 			
		}
	}
	
} else {
	if ( is_active_sidebar( 'general-sidebar' ) ) {
		wikilogy_sidebar_before();
			dynamic_sidebar("general-sidebar");
		wikilogy_sidebar_after(); 			
	}
}
