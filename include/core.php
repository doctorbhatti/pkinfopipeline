<?php
	/*======
	*
	* Theme After Setup Start
	*
	======*/
	function wikilogy_setup() {
		load_theme_textdomain( 'wikilogy', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'quote', 'gallery', 'image', 'video', 'audio', 'chat', 'link' ) );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		if( function_exists( 'add_image_size' ) ) { 
			add_image_size( 'wikilogy-post-1', 1170, 570, true );
			add_image_size( 'wikilogy-post-2', 370, 218, true );
			add_image_size( 'wikilogy-post-3', 450, 320, true );
			add_image_size( 'wikilogy-post-4', 550, 500, true );
			add_image_size( 'wikilogy-post-5', 105, 92, true );
			add_image_size( 'wikilogy-post-6', 100, 100, true );
			add_image_size( 'wikilogy-post-7', 470, 610, true );
			add_image_size( 'wikilogy-post-8', 770, 500, true );
			add_image_size( 'wikilogy-post-9', 125, 96, true );
			add_image_size( 'wikilogy-content-table-gallery', 310, 310, true );
			add_image_size( 'wikilogy-full', 1920, 950, true );
			add_image_size( 'wikilogy-content-single-1', 500, 500, true );
		}
		
		if( ! isset( $content_width ) ) {
			$content_width = 600;
		}
		
		if( is_singular() ) wp_enqueue_script( 'comment-reply' );
	}
	add_action( 'after_setup_theme', 'wikilogy_setup' );



	/*======
	*
	* Theme Scripts & Styles
	*
	======*/
	function wikilogy_scripts() {
		wp_enqueue_script( 'popper', get_template_directory_uri() . '/include/assets/js/popper.min.js', array(), false, true );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/include/assets/js/bootstrap.min.js', array(), false, true );
		if(function_exists('vc_map')) {
			wp_enqueue_script( 'prettyphoto', true, array(), false, true );
		}

		if(function_exists('vc_map')) {
			$prettyphoto_variable = "a[rel^='prettyPhoto']";
			wp_add_inline_script( "prettyphoto", 'jQuery(document).ready(function($){
				$(function () {
					$("' . $prettyphoto_variable . '").prettyPhoto({ social_tools: false });
				});
			});' );			
		}
		wp_enqueue_script( 'jquery-ui-datepicker', true, array(), false, true );
		$wikilogy_fixed_sidebar = ot_get_option( 'wikilogy_fixed_sidebar' );
		if( $wikilogy_fixed_sidebar == 'on' or !$wikilogy_fixed_sidebar == 'off' ) {
			wp_enqueue_script( 'wikilogy-fixed-sidebar', get_template_directory_uri() . '/include/assets/js/fixed-sidebar.js', array(), false, true );
		}

		wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/include/assets/js/waypoints.js', array(), false, true );
		wp_enqueue_script( 'scrollbar', get_template_directory_uri() . '/include/assets/js/scrollbar.js', array(), false, true );
		wp_enqueue_script( 'flexmenu', get_template_directory_uri() . '/include/assets/js/flexmenu.js', array(), false, true );
		wp_enqueue_script( 'moment', get_template_directory_uri() . '/include/assets/js/moment.js', array(), false, true );
		wp_enqueue_script( 'fullcalendar', get_template_directory_uri() . '/include/assets/js/fullcalendar.js', array(), false, true );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/include/assets/js/slick.js', array(), false, true );
		wp_enqueue_script( 'plyr', get_template_directory_uri() . '/include/assets/js/plyr.js', array(), false, true );
		wp_enqueue_script( 'select-fx', get_template_directory_uri() . '/include/assets/js/select-fx.js', array(), false, true );
		wp_enqueue_script( 'classie-fx', get_template_directory_uri() . '/include/assets/js/classie-fx.js', array(), false, true );
		wp_enqueue_script( 'wikilogy', get_template_directory_uri() . '/include/assets/js/wikilogy.js', array(), false, true );
		wp_enqueue_script('ajax-app');
		wp_enqueue_script( 'ajax-login-register-script', get_template_directory_uri() . '/include/assets/js/user-box.js', array(), false, true );
		wp_localize_script('ajax-login-register-script', 'ptajax', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		));

		$header_fixed = ot_get_option( 'header_fixed' );
		if( $header_fixed == 'on' ) {
			wp_add_inline_script( "wikilogy", "jQuery(document).ready(function($){
				$(window).scroll(function(){
					if ($(window).scrollTop() >= 184) {
						$('.header').addClass('fixed-header');
						$('.mobile-header').addClass('fixed-header');
					}
					else {
						$('.header').removeClass('fixed-header');
						$('.mobile-header').removeClass('fixed-header');
					}
				});
			});" );
		}

		if(function_exists('vc_map')) {
			wp_enqueue_style( 'prettyphoto', true );
		}
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/include/assets/css/bootstrap.min.css' );
		wp_enqueue_style( 'scrollbar', get_template_directory_uri() . '/include/assets/css/scrollbar.css' );
		wp_enqueue_style( 'select', get_template_directory_uri() . '/include/assets/css/select.css' );
		wp_enqueue_style( 'plyr-io', get_template_directory_uri() . '/include/assets/css/plyr.css' );
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/include/assets/css/fontawesome.min.css' );
		wp_enqueue_style( 'wikilogy', get_stylesheet_uri() );
	}
	add_action( 'wp_enqueue_scripts', 'wikilogy_scripts' );



	/*======
	*
	* Admin Scripts & Styles
	*
	======*/
	function wikilogy_admin_scripts() {
		wp_enqueue_style( 'ot-admin-css', get_template_directory_uri() . '/include/admin/assets/css/ot-admin.css', false, '1.0' );
		wp_enqueue_style( 'wikilogy-admin', get_template_directory_uri() . '/include/assets/css/admin.css', false, '1.0' );
		wp_enqueue_script( 'wikilogy-admin', get_template_directory_uri() . '/include/assets/js/admin.js', false, '1.0' );
	}
	add_action( 'admin_enqueue_scripts', 'wikilogy_admin_scripts' );



	/*======
	*
	* Demo Importer
	*
	======*/
	function wikilogy_demo_content() {
		return array(
			array(
				'import_file_name' => esc_html__( 'Import Demo Content', 'wikilogy' ),
				'import_file_url' => get_template_directory_uri() . '/include/demos/demo-content.xml',
				'import_widget_file_url' => get_template_directory_uri() . '/include/demos/widget-content.wie',
			),
		);
	}
	add_filter( 'pt-ocdi/import_files', 'wikilogy_demo_content' );



	/*======
	*
	* Body Classes
	*
	======*/
	function wikilogy_class_names( $classes ) {
		$classes[] = 'wikilogy-theme';
		$woocommerce_shop_product_column = esc_attr( ot_get_option( 'woocommerce_shop_product_column' ) );
		if( !empty( $woocommerce_shop_product_column ) ) {
			$classes[] = ' wikilogy-shop-column-' . $woocommerce_shop_product_column;
		}
		return $classes;
	}
	add_filter( 'body_class', 'wikilogy_class_names' );



	/*======
	*
	* Excerpt More
	*
	======*/
	function wikilogy_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'wikilogy_excerpt_more' );



	/*======
	*
	* Excerpt for Pages
	*
	======*/
	function wikilogy_excerpts_for_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}
	add_action( 'init', 'wikilogy_excerpts_for_pages' );



	/*======
	*
	* Word Cutter
	*
	======*/
	function wikilogy_word_cutter( $string = "", $word_limit = "" ) {
		$words = explode( ' ', $string, ( $word_limit + 1 ) );
		if( count( $words ) > $word_limit ) {
			array_pop( $words );
		}
		return implode( ' ', $words );
	}



	/*======
	*
	* Author Box
	*
	======*/
	function wikilogy_author_box() {
		$author = get_the_author();
		$author_description = get_the_author_meta( 'description' );
		$author_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
		$author_avatar = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 110 ) );
		if ( $author_description ) { ?>
			<div class="post-author">
				<?php wikilogy_title( $text = esc_html__( "About The Author", "wikilogy" ) ); ?>
				<aside class="about-author">
					<?php if ( $author_avatar ) : ?>
						<div class="image">
							<a href="<?php echo esc_url( $author_url ); ?>" rel="author">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 110 ) ); ?>
							</a>
						</div>
					<?php endif; ?>
					<div class="content">
						<div class="author-name">
							<a href="<?php echo esc_url( $author_url ); ?>" rel="author">
								<?php printf( esc_html__( '%s', 'wikilogy' ), $author ); ?>
							</a>
						</div>
						<p><?php echo esc_attr( $author_description ); ?></p>
						<?php wikilogy_user_social_media_sites(); ?>
					</div>
				</aside>
			</div>
		<?php }
	}



	/*======
	*
	* Loader
	*
	======*/
	function wikilogy_loader() {
		$wikilogy_loader = ot_get_option( 'wikilogy_loader' );
		$loader_style = ot_get_option( 'loader_style' );
		if( !$wikilogy_loader == 'off' or $wikilogy_loader == 'on' ) {
			if( $loader_style == 'style2' ) {
				echo '<div class="loader-wrapper loader-style2">
					<div class="spinner">
						<div class="bounce1"></div>
						<div class="bounce2"></div>
						<div class="bounce3"></div>
					</div>
				</div>';
			} elseif( $loader_style == 'style3' ) {
				echo '<div class="loader-wrapper loader-style3">
					<div class="spinner"></div>
				</div>';
			} elseif( $loader_style == 'style4' ) {
				echo '<div class="loader-wrapper loader-style4">
					<div class="sk-fading-circle">
						<div class="sk-circle1 sk-circle"></div>
						<div class="sk-circle2 sk-circle"></div>
						<div class="sk-circle3 sk-circle"></div>
						<div class="sk-circle4 sk-circle"></div>
						<div class="sk-circle5 sk-circle"></div>
						<div class="sk-circle6 sk-circle"></div>
						<div class="sk-circle7 sk-circle"></div>
						<div class="sk-circle8 sk-circle"></div>
						<div class="sk-circle9 sk-circle"></div>
						<div class="sk-circle10 sk-circle"></div>
						<div class="sk-circle11 sk-circle"></div>
						<div class="sk-circle12 sk-circle"></div>
					</div>
				</div>';
			} else {
				echo '<div class="loader-wrapper loader-style1">
					<div class="spinner">
						<div class="double-bounce1"></div>
						<div class="double-bounce2"></div>
					</div>
				</div>';
			}
		}
	}



	/*======
	*
	* Global Date Converter
	*
	======*/
	function wikilogy_global_date_converter( $date = "" ) {
		$date = date_i18n( get_option( 'date_format' ), strtotime( $date ) );
		return $date;
	}



	/*======
	*
	* Header
	*
	======*/
	function wikilogy_header() {
		$hide_header = ot_get_option( 'hide_header' );
		$default_header_style = ot_get_option( 'default_header_style' );
		
		if( !$hide_header == 'off' or $hide_header == 'on' ) {
			if ( is_page() or is_single() ) {
				global $post;
				$header_style = get_post_meta( $post->ID, 'header_style', true);
				$header_status = get_post_meta( $post->ID, 'header_status', true);
				$header_gap = get_post_meta( $post->ID, 'header_gap', true);
			}
			else {
				$header_style = "";
				$header_status = "";
				$header_gap = "";
			}

			if( !$header_gap == 'off' or $header_gap == "on" ) {
				$header_gap_status = "remove-gap";
			} else {
				$header_gap_status = " remove-header-gap";
			}
			
			function wikilogy_headerstyle1() {
				if ( is_page() or is_single() ) {
					global $post;
					$header_gap = get_post_meta( $post->ID, 'header_gap', true);
				}
				else {
					$header_gap = "";
				}

				if( !$header_gap == 'off' or $header_gap == "on" ) {
					$header_gap_status = "";
				} else {
					$header_gap_status = " remove-header-gap";
				}
			?>
				<div class="header header-style-1<?php echo esc_attr( $header_gap_status ); ?>">
					<div class="header-content">
						<div class="container">
							<div class="main-content d-flex justify-content-between align-items-center">
								<?php
									$header_social_media = ot_get_option( 'header_social_media' );
									if( $header_social_media == 'on' or !$header_social_media == 'off' ) {
										echo '<div class="list-social-links">';
											echo wikilogy_social_media_sites();
										echo '</div>';
									}
								?>
								<?php wikilogy_site_logo(); ?>
								<?php wikilogy_header_elements( $social = "false", $search = "true", $language = "true", $user_box = "true", $sidebar = "true" ); ?>
							</div>
						</div>
					</div>
					<div class="mainmenu">
						<div class="container">
							<nav class="navbar navbar-expand-lg">
								<?php
									wp_nav_menu(
										array(
											'menu' => 'mainmenu',
											'theme_location' => 'mainmenu',
											'depth' => 5,
											'container' => 'div',
											'container_class' => 'collapse navbar-collapse',
											'menu_class' => 'navbar-nav m-auto',
											'fallback_cb' => 'wikilogy_walker::fallback',
											'walker' => new wikilogy_walker()
										)
									);
								?>
							</nav>
						</div>
					</div>
				</div>
			<?php
			}
			
			function wikilogy_headerstyle2() {
				if ( is_page() or is_single() ) {
					global $post;
					$header_gap = get_post_meta( $post->ID, 'header_gap', true);
				}
				else {
					$header_gap = "";
				}

				if( !$header_gap == 'off' or $header_gap == "on" ) {
					$header_gap_status = "";
				} else {
					$header_gap_status = " remove-header-gap";
				}
			?>
				<div class="header header-style-2<?php echo esc_attr( $header_gap_status ); ?>">
					<div class="header-content">
						<div class="container">
							<div class="main-content d-flex justify-content-between align-items-center">
								<?php wikilogy_site_logo(); ?>
								<div class="mainmenu">
									<nav class="navbar navbar-expand-lg">
										<?php
											wp_nav_menu(
												array(
													'menu' => 'mainmenu',
													'theme_location' => 'mainmenu',
													'depth' => 5,
													'container' => 'div',
													'container_class' => 'collapse navbar-collapse',
													'menu_class' => 'navbar-nav m-auto',
													'fallback_cb' => 'wikilogy_walker::fallback',
													'walker' => new wikilogy_walker()
												)
											);
										?>
									</nav>
								</div>
								<?php wikilogy_header_elements( $social = "true", $search = "true", $language = "true", $user_box = "true", $sidebar = "true" ); ?>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			
			function wikilogy_headerstyle3() {
				if ( is_page() or is_single() ) {
					global $post;
					$header_gap = get_post_meta( $post->ID, 'header_gap', true);
				}
				else {
					$header_gap = "";
				}

				if( !$header_gap == 'off' or $header_gap == "on" ) {
					$header_gap_status = "";
				} else {
					$header_gap_status = " remove-header-gap";
				}
			?>
				<div class="header header-style-3<?php echo esc_attr( $header_gap_status ); ?>">
					<div class="header-content">
						<div class="container">
							<div class="main-content d-flex justify-content-between align-items-center">
								<?php
									$header_social_media = ot_get_option( 'header_social_media' );
									if( $header_social_media == 'on' or !$header_social_media == 'off' ) {
										echo '<div class="list-social-links">';
											echo wikilogy_social_media_sites();
										echo '</div>';
									}
								?>
								<?php wikilogy_site_logo(); ?>
								<?php wikilogy_header_elements( $social = "false", $search = "true", $language = "true", $user_box = "true", $sidebar = "true" ); ?>
							</div>
						</div>
					</div>
					<div class="mainmenu">
						<div class="container">
							<nav class="navbar navbar-expand-lg">
								<?php
									wp_nav_menu(
										array(
											'menu' => 'mainmenu',
											'theme_location' => 'mainmenu',
											'depth' => 5,
											'container' => 'div',
											'container_class' => 'collapse navbar-collapse',
											'menu_class' => 'navbar-nav m-auto',
											'fallback_cb' => 'wikilogy_walker::fallback',
											'walker' => new wikilogy_walker()
										)
									);
								?>
							</nav>
						</div>
					</div>
				</div>
			<?php
			}
			
			function wikilogy_headerstyle4() {
				if ( is_page() or is_single() ) {
					global $post;
					$header_gap = get_post_meta( $post->ID, 'header_gap', true);
				}
				else {
					$header_gap = "";
				}

				if( !$header_gap == 'off' or $header_gap == "on" ) {
					$header_gap_status = "";
				} else {
					$header_gap_status = " remove-header-gap";
				}
			?>
				<div class="header header-style-4<?php echo esc_attr( $header_gap_status ); ?>">
					<div class="header-content">
						<div class="container">
							<div class="main-content d-flex justify-content-between align-items-center">
								<?php
									$header_social_media = ot_get_option( 'header_social_media' );
									if( $header_social_media == 'on' or !$header_social_media == 'off' ) {
										echo '<div class="list-social-links">';
											echo wikilogy_social_media_sites();
										echo '</div>';
									}
								?>
								<?php wikilogy_site_logo(); ?>
								<?php wikilogy_header_elements( $social = "false", $search = "true", $language = "true", $user_box = "true", $sidebar = "true" ); ?>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			
			function wikilogy_headerstyle5() {
				if ( is_page() or is_single() ) {
					global $post;
					$header_gap = get_post_meta( $post->ID, 'header_gap', true);
				}
				else {
					$header_gap = "";
				}

				if( !$header_gap == 'off' or $header_gap == "on" ) {
					$header_gap_status = "";
				} else {
					$header_gap_status = " remove-header-gap";
				}
			?>
				<div class="header header-style-5<?php echo esc_attr( $header_gap_status ); ?>">
					<div class="header-content">
						<?php wikilogy_fluid_container_before(); ?>
							<div class="main-content d-flex justify-content-between align-items-center">
								<?php wikilogy_site_alternative_logo(); ?>
								<div class="mainmenu">
									<nav class="navbar navbar-expand-lg">
										<?php
											wp_nav_menu(
												array(
													'menu' => 'mainmenu',
													'theme_location' => 'mainmenu',
													'depth' => 5,
													'container' => 'div',
													'container_class' => 'collapse navbar-collapse',
													'menu_class' => 'navbar-nav m-auto',
													'fallback_cb' => 'wikilogy_walker::fallback',
													'walker' => new wikilogy_walker()
												)
											);
										?>
									</nav>
								</div>
								<?php wikilogy_header_elements( $social = "false", $search = "true", $language = "true", $user_box = "true", $sidebar = "true" ); ?>
							</div>
						<?php wikilogy_fluid_container_after(); ?>
					</div>
				</div>
			<?php
			}
			
			if( !$header_status == 'off' or $header_status == "on" ) {
				if ( is_page() or is_single() ) {
					if( $header_style == "header-style-2" ) {
						wikilogy_headerstyle2();
					} elseif( $header_style == "header-style-3" ) {
						wikilogy_headerstyle3();
					} elseif( $header_style == "header-style-4" ) {
						wikilogy_headerstyle4();
					} elseif( $header_style == "header-style-5" ) {
						wikilogy_headerstyle5();
					} elseif( $header_style == "header-style-1" ) {
						wikilogy_headerstyle1();
					} else {
						if( $default_header_style == "header-style-2" ) {
							wikilogy_headerstyle2();
						} elseif( $default_header_style == "header-style-3" ) {
							wikilogy_headerstyle3();
						} elseif( $default_header_style == "header-style-4" ) {
							wikilogy_headerstyle4();
						} elseif( $default_header_style == "header-style-5" ) {
							wikilogy_headerstyle5();
						} else {
							wikilogy_headerstyle1();
						}
					}
				} else {
					if( $default_header_style == "header-style-2" ) {
						wikilogy_headerstyle2();
					} elseif( $default_header_style == "header-style-3" ) {
						wikilogy_headerstyle3();
					} elseif( $default_header_style == "header-style-4" ) {
						wikilogy_headerstyle4();
					} elseif( $default_header_style == "header-style-5" ) {
						wikilogy_headerstyle5();
					} else {
						wikilogy_headerstyle1();
					}
				}
			}
		}
	}



	/*======
	*
	* Mobile Header
	*
	======*/
	function wikilogy_mobile_header() { ?>
		<header class="mobile-header">
			<?php wikilogy_site_logo(); ?>
			<div class="mobile-menu-icon">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</header>

		<?php
		$header_search = ot_get_option( 'header_search' );
		$header_language = ot_get_option( 'header_language' );
		$header_language_shortcode = ot_get_option( 'header_language_shortcode' );
		$header_user_box = ot_get_option( 'header_user_box' );

		echo '<div class="mobile-header-sidebar header-sidebar">';
			echo '<div class="overlay"></div>';
			echo '<div class="content">';
				echo '<div class="close-button"></div>';
				echo '<div class="content-wrapper scrollbar-outer">';
					wikilogy_site_logo();

					echo '<div class="header-sidebar-menu">';
						echo '<nav class="navbar">';
							wp_nav_menu(
								array(
									'menu' => 'mainmenu',
									'theme_location' => 'mainmenu',
									'depth' => 5,
									'container' => 'div',
									'container_class' => 'collapse navbar-collapse',
									'menu_class' => 'navbar-nav m-auto',
									'fallback_cb' => 'wikilogy_walker::fallback',
									'walker' => new wikilogy_walker()
								)
							);
						echo '</nav>';
					echo '</div>';

					echo wikilogy_social_media_sites();
					
					if( $header_user_box == 'on' ) {
						echo '<div class="item header-user-box">';
							echo '<div class="icon">';
								if( ! is_user_logged_in() ) {
									echo '<a href="" data-target="#user_login_popup" data-toggle="modal" title="' . esc_html__( 'Login or Sign Up', 'wikilogy' ) . '">' . esc_html__( 'Login or Sign Up', 'wikilogy' ) . '</a>';
								} else {
									$current_user = wp_get_current_user();
									if( !empty( $current_user->ID ) ) {
										$loggined_user_id = $current_user->ID;
									} else {
										$loggined_user_id = "";
									}
									echo '<a href="' . esc_url( wp_logout_url( home_url( '/' ) ) ) . '" class="login-links" title="' . esc_html__( 'Logout', 'wikilogy' ) . '">' . esc_html__( 'Logout', 'wikilogy' ) . '</a>';
								}
							echo '</div>';
						echo '</div>';
					}

					if( $header_language == 'on' or !$header_language == 'off' and !empty( $header_language_shortcode ) ) {
						echo '<div class="item header-language">';
							echo do_shortcode( ot_get_option( 'header_language_shortcode' ) );
						echo '</div>';
					}

					if( $header_search == 'on' or !$header_search == 'off' ) {
						echo '<div class="item header-search">';
							echo wikilogy_search_form();
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}



	/*======
	*
	* Site Main Logo
	*
	======*/
	function wikilogy_site_logo() {
		echo '<div class="header-logo">';
			$logo = ot_get_option( 'wikilogy_logo' );
			$logo_height = ot_get_option( 'logo_height' ); if( !empty( $logo_height ) ) { $logo_height = 'height="' . esc_attr( $logo_height[0] ) . esc_attr( $logo_height[1] ) . '"'; }
			$logo_width = ot_get_option( 'logo_width' ); if( !empty( $logo_width ) ) { $logo_width = 'width="' . esc_attr( $logo_width[0] ) . esc_attr( $logo_width[1] ) . '"'; }
			if( !$logo == "" ) {
				echo '<div class="logo"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo" title="' . esc_attr( get_bloginfo( 'name' ) ) . '"><img alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( ot_get_option( 'wikilogy_logo' ) ) . '" ' . $logo_height . $logo_width . ' /></a></div>';
			} else {
				echo '<div class="logo"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo site-logo-texted" title="' . esc_attr( get_bloginfo( 'name' ) ) . '"><h1>' . esc_attr( get_bloginfo( 'name' ) ) . '</h1></a></div>';
			}
		echo '</div>';
	}



	/*======
	*
	* Site Alternative Logo
	*
	======*/
	function wikilogy_site_alternative_logo() {
		echo '<div class="header-logo header-alternative-logo">';
			$logo = ot_get_option( 'wikilogy_logo_alternative' );
			$logo_height = ot_get_option( 'logo_height' ); if( !empty( $logo_height ) ) { $logo_height = 'height="' . esc_attr( $logo_height[0] ) . esc_attr( $logo_height[1] ) . '"'; }
			$logo_width = ot_get_option( 'logo_width' ); if( !empty( $logo_width ) ) { $logo_width = 'width="' . esc_attr( $logo_width[0] ) . esc_attr( $logo_width[1] ) . '"'; }
			if( !$logo == "" ) {
				echo '<div class="logo"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img alt="' . esc_html__( 'Logo', 'wikilogy' ) . '" src="' . esc_url( ot_get_option( 'wikilogy_logo_alternative' ) ) . '" ' . $logo_height . $logo_width . ' /></a></div>';
			} else {
				echo '<div class="logo"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img alt="' . esc_html__( 'Logo', 'wikilogy' ) . '" src="' . get_template_directory_uri() . '/include/assets/img/logo-alternative.png" /></a></div>';
			}
		echo '</div>';
	}



	/*======
	*
	* Elements for Header
	*
	======*/
	function wikilogy_header_elements( $social = "true", $search = "true", $language = "true", $user_box = "true", $sidebar = "true" ) {
		$header_social_media = ot_get_option( 'header_social_media' );
		$header_home_search = ot_get_option( 'header_home_search' );
		$header_search = ot_get_option( 'header_search' );
		$header_language = ot_get_option( 'header_language' );
		$header_language_shortcode = ot_get_option( 'header_language_shortcode' );
		$header_user_box = ot_get_option( 'header_user_box' );
		$header_sidebar = ot_get_option( 'header_sidebar' );
		$header_sidebar_logo = ot_get_option( 'header_sidebar_logo' );
		$header_sidebar_menu = ot_get_option( 'header_sidebar_menu' );
		$header_sidebar_social_links = ot_get_option( 'header_sidebar_social_links' );
		echo '<div class="elements">';
			if( $user_box == "true" ) {
				if( $header_user_box == 'on' ) {
					echo '<div class="item header-user-box">';
						echo '<div class="icon">';
							if( ! is_user_logged_in() ) {
								echo '<a href="" data-target="#user_login_popup" data-toggle="modal" title="' . esc_html__( 'Login', 'wikilogy' ) . '"><i class="fas fa-user"></i></a>';
							} else {
								$current_user = wp_get_current_user();
								if( !empty( $current_user->ID ) ) {
									$loggined_user_id = $current_user->ID;
								} else {
									$loggined_user_id = "";
								}
								echo '<a href="' . esc_url( wp_logout_url( home_url( '/' ) ) ) . '" class="login-links" title="' . esc_html__( 'Logout', 'wikilogy' ) . '"><i class="fas fa-sign-out-alt"></i></a>';
							}
							echo '<div class="close-icon"></div>';
						echo '</div>';
					echo '</div>';
				}
			}

			if( $social == "true" ) {
				if( $header_social_media == 'on' or !$header_social_media == 'off' ) {
					echo '<div class="item hover-item header-social">';
						echo '<div class="icon">';
							echo '<i class="fas fa-share-alt"></i>';
							echo '<div class="close-icon"></div>';
						echo '</div>';
						echo '<div class="content">';
							echo wikilogy_social_media_sites();
						echo '</div>';	
					echo '</div>';	
				}
			}

			if( $search == "true" ) {
				if( is_home() ) {	
					if( !$header_home_search == 'on' or $header_home_search == 'off' ) {
						$header_search == "off";
					}
				}

				if( $header_search == 'on' or !$header_search == 'off' ) {
					echo '<div class="item hover-item header-search">';
						echo '<div class="icon">';
							echo '<i class="fas fa-search"></i>';
							echo '<div class="close-icon"></div>';
						echo '</div>';
						echo '<div class="content">';
							echo wikilogy_search_form();
						echo '</div>';
					echo '</div>';
				}
			}

			if( $language == "true" ) {
				if( $header_language == 'on' or !$header_language == 'off' and !empty( $header_language_shortcode ) ) {
					echo '<div class="item hover-item header-language">';
						echo '<div class="icon">';
							echo '<i class="fas fa-globe"></i>';
							echo '<div class="close-icon"></div>';
						echo '</div>';
						echo '<div class="content">';
							echo do_shortcode( ot_get_option( 'header_language_shortcode' ) );
						echo '</div>';
					echo '</div>';
				}
			}

			if( $sidebar == "true" ) {
				if( $header_sidebar == 'on' or !$header_sidebar == 'off' ) {
					echo '<div class="item hover-item header-sidebar">';
						echo '<div class="icon">';
							echo '<i class="sidebar-icon">';
								echo '<span></span>';
								echo '<span></span>';
								echo '<span></span>';
							echo '</i>';
							echo '<div class="close-icon"></div>';
						echo '</div>';
						echo '<div class="overlay"></div>';
						echo '<div class="content">';
							echo '<div class="close-button"></div>';
							echo '<div class="content-wrapper scrollbar-outer">';
								if( $header_sidebar_logo == 'on' or !$header_sidebar_logo == 'off' ) {
									wikilogy_site_logo();
								}

								if( $header_sidebar_menu == 'on' or !$header_sidebar_menu == 'off' ) {
									echo '<div class="header-sidebar-menu">';
										echo '<nav class="navbar">';
											wp_nav_menu(
												array(
													'menu' => 'headersidebarmenu',
													'theme_location' => 'headersidebarmenu',
													'depth' => 5,
													'container' => 'div',
													'container_class' => 'collapse navbar-collapse',
													'menu_class' => 'navbar-nav m-auto',
													'fallback_cb' => 'wikilogy_walker::fallback',
													'walker' => new wikilogy_walker()
												)
											);
										echo '</nav>';
									echo '</div>';
								}

								if( $header_sidebar_social_links == 'on' or !$header_sidebar_social_links == 'off' ) {
									echo wikilogy_social_media_sites();
								}

								if ( is_active_sidebar( 'header-sidebar' ) ) {
									dynamic_sidebar("header-sidebar");		
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
		echo '</div>';
	}



	/*======
	*
	* Register & Login Form
	*
	======*/
	function wikilogy_userbox() {
		$header_user_box = ot_get_option( 'header_user_box' );
		$header_social_login_system = ot_get_option( 'header_social_login_system' );
		if( !$header_user_box == 'off' or $header_user_box == 'on' ) {
			if( ! is_user_logged_in() ){ 
				?>
				<div class="modal fade pt-user-modal" id="user_login_popup" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="user-box">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
								<div class="user-box-login">
									<div class="pt-login">
										<div class="title"><?php echo esc_html__( 'Login', 'wikilogy' ) ?></div>
										<form id="pt_login_form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post">
											<div class="form-group">
												<input class="required" name="pt_user_login" type="text" placeholder="<?php echo esc_html__('Username', 'wikilogy') ?>" />
											</div>
											<div class="form-group">
												<input class="required" name="pt_user_pass" id="pt_user_pass" type="password" placeholder="<?php echo esc_html__('Password', 'wikilogy')?>" />
											</div>
											<div class="form-group login-form-remember-me">
												<div class="login-remember-me-wrapper">
													<input type="checkbox" value="None" id="login-remember-me-wrapper-input" name="pt_remember_me" />
													<label for="login-remember-me-wrapper-input" class="modern-checkbox"><?php echo esc_html__('Remember Me', 'wikilogy')?></label>
												</div>
											</div>
											<div class="form-group login-form-button">
												<input type="hidden" name="action" value="wikilogy_login"/>
												<button data-loading-text="<?php echo esc_html__('Loading...', 'wikilogy') ?>" type="submit"><?php echo esc_html__('Sign in', 'wikilogy'); ?></button>
											</div>
											<div class="bottom-links">
											<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>"><?php echo esc_html__('Lost Password?', 'wikilogy') ?></a>
											<a href="" data-target="#user_register_popup" data-toggle="modal" class="create-an-account" data-dismiss="modal"><?php echo esc_html__('Create an Account', 'wikilogy') ?></a>
											</div>
											<?php wp_nonce_field( 'ajax-login-nonce', 'login-security' ); ?>
										</form>
										<div class="pt-errors"></div>
									</div>
									<div class="pt-loading">
										<p><i class="fas fa-sync-alt fa-spin"></i><br><?php echo esc_html__('Loading...', 'wikilogy') ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade pt-user-modal" id="user_register_popup" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="user-box">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
								<div class="user-box-login">
									<div class="pt-register">
										<div class="title"><?php echo esc_html__( 'Register', 'wikilogy' ) ?></div>
										<?php
											if( get_option("users_can_register") == "0" ) {
												echo '<p class="users_can_register">' . esc_html__( 'New membership are not allowed.', 'wikilogy' ) . '</p>';
											} else {
										?>
										<form id="pt_registration_form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="POST">
											<div class="form-group">
												<input class="required" name="pt_user_login" placeholder="<?php echo esc_html__('Username', 'wikilogy'); ?>" type="text"/>
											</div>
											<div class="form-group">
												<input class="required" name="pt_user_email" id="pt_user_email" placeholder="<?php echo esc_html__('Email', 'wikilogy'); ?>" type="email"/>
											</div>
											<div class="form-group login-form-remember-me">
												<div class="login-remember-me-wrapper">
													<div class="description">
														<?php
															$page_terms_and_conditions = ot_get_option( 'page_terms_and_conditions' );
															if( !empty( $page_terms_and_conditions ) ) {
																$page_terms_and_conditions = get_the_permalink( $page_terms_and_conditions );
															} else {
																$page_terms_and_conditions = home_url( '/' );
															}

															$page_privacy_policy = ot_get_option( 'page_privacy_policy' );
															if( !empty( $page_privacy_policy ) ) {
																$page_privacy_policy = get_the_permalink( $page_privacy_policy );
															} else {
																$page_privacy_policy = home_url( '/' );
															}
														?>
														<?php echo esc_html__('By creating an account you agree to our', 'wikilogy' ); ?>
														<a href="<?php echo esc_url( $page_terms_and_conditions ); ?>" target="_blank"><?php echo esc_html__('terms and conditions', 'wikilogy' ); ?></a>
														<?php echo esc_html__('and our', 'wikilogy' ); ?>
														<a href="<?php echo esc_url( $page_privacy_policy ); ?>" target="_blank"><?php echo esc_html__('privacy policy.', 'wikilogy' ); ?></a>
													</div>
												</div>
											</div>
											<div class="form-group login-form-button register-form-button">
												<input type="hidden" name="action" value="wikilogy_register"/>
												<button data-loading-text="<?php echo esc_html__('Loading...', 'wikilogy') ?>" type="submit"><?php echo esc_html__('Be Member', 'wikilogy'); ?></button>
											</div>
											<?php wp_nonce_field( 'ajax-login-nonce', 'register-security' ); ?>
										</form>
										<div class="pt-errors"></div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
		}
	}
	add_action( 'wp_footer', 'wikilogy_userbox' );

	function wikilogy_login() {
		$user_login = $_POST['pt_user_login'];	
		$user_pass = $_POST['pt_user_pass'];
		$remember = $_POST['pt_remember_me'];
		if(isset($_POST['pt_remember_me'])) {
			$remember_me = "true";
		} else {
			$remember_me = "false";
		}

		if( !check_ajax_referer( 'ajax-login-nonce', 'login-security', false ) ){
			echo json_encode( array( 'error' => true, 'message' => '<div class="alert-no">' . esc_html__('Session token has expired, please reload the page and try again.', 'wikilogy') . '</div>' ) );
		}
		elseif( empty( $user_login ) || empty( $user_pass ) ){
			echo json_encode( array( 'error' => true, 'message' => '<div class="alert-no">' . esc_html__('Please fill all form fields.', 'wikilogy' ) . '</div>' ) );
		} else {
			$user = wp_signon( array( 'user_login' => $user_login, 'user_password' => $user_pass, 'remember' => $remember_me ), false );
			if( is_wp_error( $user ) ){
				echo json_encode( array( 'error' => true, 'message' => '<div class="alert-no">' . $user->get_error_message() . '</div>' ) );
			} else{
				echo json_encode( array( 'error' => false, 'message' => '<div class="alert-ok">' . esc_html__('Login successful, you are being redirected.', 'wikilogy') . '</div>' ) );
			}
		}
		die();
	}
	add_action( 'wp_ajax_nopriv_wikilogy_login', 'wikilogy_login' );

	function wikilogy_register() {
		$user_login	= $_POST['pt_user_login'];	
		$user_email	= $_POST['pt_user_email'];
		
		if( !check_ajax_referer( 'ajax-login-nonce', 'register-security', false ) ){
			echo json_encode( array( 'error' => true, 'message' => '<div class="alert-no">' . esc_html__( 'Session token has expired, please reload the page and try again', 'wikilogy' ).'</div>' ) );
			die();
		}
	 	
	 	elseif( empty( $user_login ) || empty( $user_email ) ){
			echo json_encode( array( 'error' => true, 'message' => '<div class="alert-no">' . esc_html__( 'Please fill all form fields', 'wikilogy' ) . '</div>' ) );
			die();
	 	}
		
		$errors = register_new_user($user_login, $user_email);
		if( is_wp_error( $errors ) ){
			$registration_error_messages = $errors->errors;
			$display_errors = '<div class="alert alert-no">';
				foreach( $registration_error_messages as $error ){
					$display_errors .= '<p>' . $error[0] . '</p>';
				}
			$display_errors .= '</div>';
			echo json_encode( array( 'error' => true, 'message' => $display_errors ) );
		} else {
			echo json_encode( array( 'error' => false, 'message' => '<div class="alert-ok">' . esc_html__( 'Registration completed. Please check your e-mail.', 'wikilogy' ) . '</p>' ) );
		}
	 	die();
	}
	add_action( 'wp_ajax_nopriv_wikilogy_register', 'wikilogy_register' );



	/*======
	*
	* Menu Walker
	*
	======*/
	class wikilogy_walker extends Walker_Nav_Menu {
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$li_attributes = '';
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			//Add class and attribute to LI element that contains a submenu UL.
			if ($args->has_children){
				$classes[] 		= 'dropdown';
				$li_attributes .= ' data-dropdown="dropdown"';
			}
			$classes[] = 'menu-item-' . $item->ID;
			//If we are on the current page, add the active class to that menu item.
			$classes[] = ($item->current) ? 'active' : '';

			//Make sure you still add all of the WordPress classes.
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="nav-item ' . esc_attr( $class_names ) . '"';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

			//Add attributes to link element.
			$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
			$attributes .= ! empty( $item->url ) ? ' class="nav-link"' : '';
			$attributes .= ($args->has_children) ? ' ' : ''; 

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before;
				$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= $args->link_after;
			$item_output .= ($args->has_children) ? '<i class="fas fa-chevron-down"></i>' : '';
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element )
				return;
				$id_field = $this->db_fields['id'];
				if ( is_object( $args[0] ) )
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
				parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
	}



	/*======
	*
	* Search Form
	*
	======*/
	function wikilogy_search_form() {
		$output = '<form role="search" method="get" class="searchform" action="' . esc_url( home_url( '/' ) ) . '">
			<div class="search-form">
				<input type="text" value="' . esc_attr( get_search_query() ) . '" placeholder="' . esc_html__( 'Enter the keyword...', 'wikilogy' ) . '" name="s" class="searchform-text" />
				<button><i class="fas fa-search"></i></button>
			</div>
		</form>';

		return $output;
	}



	/*======
	*
	* Footer
	*
	======*/
	function wikilogy_footer() {
		$hide_footer = ot_get_option( 'hide_footer' );
		$default_footer_style = ot_get_option( 'default_footer_style' );
		$page_footer = ot_get_option( 'page_footer' );
		$page_footer_style_2 = ot_get_option( 'page_footer' );
		
		if( !$hide_footer == 'off' or $hide_footer == 'on' ) {
			if ( is_page() or is_single() ) {
				global $post;
				$footer_gap = get_post_meta( $post->ID, 'footer_gap', true);
				$footer_style = get_post_meta( $post->ID, 'footer_style', true);
				$footer_status = get_post_meta( $post->ID, 'footer_status', true);
			}
			else {
				$post = "";
				$footer_gap = "";
				$footer_style = "";
				$footer_status = "";
			}

			if( !$footer_gap == 'off' or $footer_gap == "on" ) {
				$footer_gap_status = "remove-gap";
			} else {
				$footer_gap_status = "remove-gap-removed";			
			}

			function wikilogy_copyright() {
				$hide_footer_logo = ot_get_option( 'hide_footer_logo' );
				$wikilogy_footer_logo = ot_get_option( 'wikilogy_footer_logo' );
				$footer_copyright_text = ot_get_option( 'footer_copyright_text' );
				if( !empty( $footer_copyright_text ) or $hide_footer_logo == "on" or !$hide_footer_logo == "off" or !empty( $wikilogy_footer_logo ) ) {
					echo '<div class="footer-copyright">';
						echo wikilogy_container_before();
							if( $hide_footer_logo == "on" or !$hide_footer_logo == "off" ) {
								if( !empty( $wikilogy_footer_logo ) ) {
									echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="footer-logo" title="' . get_bloginfo( 'name' ) . '"><img src="' . esc_url( $wikilogy_footer_logo ) . '" alt="' . get_bloginfo( 'name' ) . '" /></a>';
								}
							}

						if( !empty( $footer_copyright_text ) ) {
							echo '<p>' . esc_attr( $footer_copyright_text ) . '</p>';
						}
						echo wikilogy_container_after();
					echo '</div>';
					}
			}
			
			function wikilogy_footerstyle1() {
				$page_footer = ot_get_option( 'page_footer' );
				if ( is_page() or is_single() ) {
					global $post;
					$footer_gap = get_post_meta( $post->ID, 'footer_gap', true);
				}
				else {
					$post = "";
					$footer_gap = "";
				}

				if( !$footer_gap == 'off' or $footer_gap == "on" ) {
					$footer_gap_status = "";
				} else {
					$footer_gap_status = "remove-gap";
				}
				?>
					<footer class="footer footer-style1 <?php echo esc_attr( $footer_gap_status ); ?>" id="Footer">
						<?php wikilogy_container_before(); ?>
							<div class="footer-content">
								<?php
									$args_footer_page_content = array(
										'p' => $page_footer,
										'ignore_sticky_posts' => true,
										'post_type' => 'page',
										'post_status' => 'publish'
									);
									$wp_query = new WP_Query( $args_footer_page_content );
									while ( $wp_query->have_posts() ) :
									$wp_query->the_post();
									$postid = get_the_ID();
								?>
									<?php echo do_shortcode( get_the_content() ); ?>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							</div>
						<?php wikilogy_container_after(); ?>
						<?php wikilogy_copyright(); ?>
					</footer>
				<?php
			}
			
			function wikilogy_footerstyle2() {
				$page_footer_style_2 = ot_get_option( 'page_footer' );
				if ( is_page() or is_single() ) {
					global $post;
					$footer_gap = get_post_meta( $post->ID, 'footer_gap', true);
				}
				else {
					$post = "";
					$footer_gap = "";
				}

				if( !$footer_gap == 'off' or $footer_gap == "on" ) {
					$footer_gap_status = "";
				} else {
					$footer_gap_status = "remove-gap";
				}
				?>
					<footer class="footer footer-style2 <?php echo esc_attr( $footer_gap_status ); ?>" id="Footer">
						<?php wikilogy_container_before(); ?>
							<?php
								$hide_footer_style_2_menu = ot_get_option( 'hide_footer_style_2_menu' );
								if( !$hide_footer_style_2_menu == 'off' or $hide_footer_style_2_menu == "on" ) {
							?>
								<nav class="footer-menu">
									<?php
										wp_nav_menu(
											array(
												'menu' => 'footermenu',
												'theme_location' => 'footermenu',
												'depth' => 1,
												'container' => 'div',
												'fallback_cb' => 'wikilogy_walker::fallback',
												'walker' => new wikilogy_walker()
											)
										);
									?>
								</nav>
							<?php } ?>
							<div class="footer-content">
								<?php
									$footer_style_2_ads = ot_get_option( 'footer_style_2_ads' );
									if( !empty( $footer_style_2_ads ) ) {
										echo '<div class="footer-ads">';
											echo ot_get_option( 'footer_style_2_ads' );
										echo '</div>';
									}
								?>
							</div>
						<?php wikilogy_container_after(); ?>
						<?php wikilogy_copyright(); ?>
					</footer>
				<?php
			}
			
			function wikilogy_footerstyle3() {
				$page_footer_style_2 = ot_get_option( 'page_footer' );
				if ( is_page() or is_single() ) {
					global $post;
					$footer_gap = get_post_meta( $post->ID, 'footer_gap', true);
				}
				else {
					$post = "";
					$footer_gap = "";
				}

				if( !$footer_gap == 'off' or $footer_gap == "on" ) {
					$footer_gap_status = "";
				} else {
					$footer_gap_status = "remove-gap";
				}
				?>
					<footer class="footer footer-style3 <?php echo esc_attr( $footer_gap_status ); ?>" id="Footer">
						<?php wikilogy_fluid_container_before(); ?>
							<?php
								$hide_footer_style_3_social = ot_get_option( 'hide_footer_style_3_social' );
								if( !$hide_footer_style_3_social == 'off' or $hide_footer_style_3_social == "on" ) {
									echo wikilogy_social_share();
								}

								$footer_copyright_text = ot_get_option( 'footer_copyright_text' );
								if( !empty( $footer_copyright_text ) ) {
									echo '<p>' . esc_attr( $footer_copyright_text ) . '</p>';
								}
							?>
						<?php wikilogy_fluid_container_after(); ?>
					</footer>
				<?php
			}
			
			if( !$footer_status == 'off' or $footer_status == "on" ) {
			
				if( !$page_footer == '0' and !empty( $page_footer ) or !$page_footer_style_2 == '0' and !empty( $page_footer_style_2 ) ) {
					
					if ( is_page() or is_single() ) {
						
						if( $footer_style == "footer-style-2" ) {
							wikilogy_footerstyle2();
						} elseif( $footer_style == "footer-style-1" ) {
							wikilogy_footerstyle1();
						} elseif( $footer_style == "footer-style-3" ) {
							wikilogy_footerstyle3();
						} else {
							
							if( $default_footer_style == "footer-style-2" ) {
								wikilogy_footerstyle2();
							} elseif( $default_footer_style == "footer-style-3" ) {
								wikilogy_footerstyle3();
							} else {
								wikilogy_footerstyle1();
							}
							
						}
						
					} else {
						
						if( $default_footer_style == "footer-style-2" ) {
							wikilogy_footerstyle2();
						} elseif( $default_footer_style == "footer-style-3" ) {
							wikilogy_footerstyle3();
						} else {
							wikilogy_footerstyle1();
						}
						
					}
				
				} else {
					echo '<div class="no-footer-blank"></div>';
				}
			} else {
			}
			
		} else {
		}
	}



	/*======
	*
	* Featured Image for Post
	*
	======*/
	function wikilogy_featured_image_post( $post_id = "" ) {
		$featured_header_status = get_post_meta( $post_id, 'featured_header_status', true );
		$featured_image_status = get_post_meta( $post_id, 'featured_image_status', true );
		$post_gallery_images_control = get_post_meta( $post_id, 'post_images', true );

		if( $featured_header_status == "on" or !$featured_header_status == "off" ) {
			if ( has_post_format( 'video' ) ) {
				$post_video_embed = get_post_meta( $post_id, 'post_video_embed', true );
				if( !empty( $post_video_embed ) ) {
					$post_video_embed_new = $post_video_embed;
					echo '<div class="post-featured-header">';
						echo get_post_meta( $post_id, 'post_video_embed', true );
					echo '</div>';
				}
			} elseif( has_post_format( 'audio' ) ) {
				$post_audio_embed = get_post_meta( $post_id, 'post_audio_embed', true );
				if( !empty( $post_audio_embed ) ) {
					$post_audio_embed_new = $post_audio_embed;
					echo '<div class="post-featured-header">';
						echo get_post_meta( $post_id, 'post_audio_embed', true );
					echo '</div>';
				}
			} elseif( has_post_format( 'gallery' ) and !empty( $post_gallery_images_control ) ) {
				$post_gallery_images = explode( ',', get_post_meta( $post_id, 'post_images', true ) );
				if( !empty( $post_gallery_images ) ) {
					echo '<div class="post-featured-header">';
						echo '<div class="wikilogy-slider post-featured-header-image-gallery" data-item="1" data-dots="true" data-arrows="true">';
							foreach ($post_gallery_images as $image) {
								echo '<div class="item">' . wp_get_attachment_image( $image, 'wikilogy-post-1', true, true ) . '</div>';
							}
						echo '</div>';
					echo '</div>';
				}
			} elseif ( get_post_type( $post_id ) == 'content' ) {
				$content_image = ot_get_option( 'content_image' );
				if ( !$content_image == 'off' or $content_image == 'on' ) {
					if ( has_post_thumbnail() ) {
						echo '<div class="post-featured-header">';
							echo get_the_post_thumbnail( $post_id, 'wikilogy-post-1' );
						echo '</div>';
					}
				}
			} else {
				$post_image = ot_get_option( 'post_image' );
				if ( !$post_image == 'off' or $post_image == 'on' ) {
					if( $featured_image_status == "on" or !$featured_image_status == "off" ) {
						if ( has_post_thumbnail() ) {
							echo '<div class="post-featured-header">';
								echo get_the_post_thumbnail( $post_id, 'wikilogy-post-1' );
							echo '</div>';
						}
					}
				}
			}
		}
	}



	/*======
	*
	* Finding Slug
	*
	======*/
	function wikilogy_to_slug( $string ) {
		return strtolower( trim( preg_replace('/[^A-Za-z0-9-]+/', '-', $string ) ) );
	}



	/*======
	*
	* Finding Attachment ID from Guid
	*
	======*/
	if( ! function_exists( 'wikilogy_attachment_id' ) ) {
		function wikilogy_attachment_id( $url ) {
			$attachment_id = 0;
			$dir = wp_upload_dir();
			if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
				$file = basename( $url );
				$query_args = array(
					'post_type' => 'attachment',
					'post_status' => 'inherit',
					'fields' => 'ids',
					'meta_query' => array(
						array(
							'value' => $file,
							'compare' => 'LIKE',
							'key' => '_wp_attachment_metadata',
						),
					)
				);
				$query = new WP_Query( $query_args );
				if ( $query->have_posts() ) {
					foreach ( $query->posts as $post_id ) {
						$meta = wp_get_attachment_metadata( $post_id );
						$original_file = basename( $meta['file'] );
						$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
						if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
							$attachment_id = $post_id;
							break;
						}
					}
				}
			}
			return $attachment_id;
		}
	}



	/*======
	*
	* Post Navigation
	*
	======*/
	function wikilogy_post_navigation() {
		$post_post_navigation = ot_get_option( 'post_post_navigation' );
		if ( !$post_post_navigation == 'off' or $post_post_navigation == 'on' ) {
		$wikilogy_post_navigation_prev = '<span>' . esc_html__( 'Previous', 'wikilogy' ) . '</span>';
		$wikilogy_post_navigation_next = '<span>' . esc_html__( 'Next', 'wikilogy' ) . '</span>';
		$prevPost = get_previous_post( false );
		$nextPost = get_next_post( false );
		?>
		<div class="post-navigation">
			<nav>
				<ul>
					<?php if( !empty( $prevPost ) ) { ?>
						<li class="previous">
							<?php previous_post_link( '%link', '<i class="fas fa-chevron-left"></i>' . $wikilogy_post_navigation_prev ); ?>
						</li>
					<?php } ?>
					<?php if( !empty( $nextPost ) ) { ?>
						<li class="next">
							<?php next_post_link( '%link', $wikilogy_post_navigation_next . '<i class="fas fa-chevron-right"></i>' ); ?>
						</li>
					<?php } ?>
				</ul>
			</nav>
		</div>
		<?php
		}
	}



	/*======
	*
	* Related Posts
	*
	======*/
	function wikilogy_related_posts( $count = "" ) {
		global $post;
		$tags = wp_get_post_tags( $post->ID );
		if( !empty( $count ) ) {
			$post_related_count = $count;
		} else {
			$post_related_count = "4";
		}
		
		echo '<div class="related-posts">';
			if ( $tags ) {
				echo wikilogy_title( $title = esc_html__( 'Related Posts', 'wikilogy' ), $shadow_title = esc_html__( 'Related', 'wikilogy' ), $text = esc_html__( 'Related contents and articles.', 'wikilogy' ), $style = "2" );
			?>
				<div class="related-posts-columns related-posts-column-<?php echo esc_attr( $post_related_count ); ?>">
					<?php
						$tag_ids = array();
						foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
						$args = array(
							'tag__in' => $tag_ids,
							'post__not_in' => array( $post->ID ),
							'post_status' => 'publish',
							'post_type' => 'post',
							'ignore_sticky_posts' => true,
							'posts_per_page' => $post_related_count
						);
						$my_query = new wp_query( $args );
						while( $my_query->have_posts() ) {
							$my_query->the_post();
							echo wikilogy_post_list_style_4( $post_id = get_the_ID(), $author = "false", $category = "true", $date = "true" );
						}
						wp_reset_postdata();
					?>
				</div>
			<?php }
		echo '</div>';
	}



	/*======
	*
	* Related Contents
	*
	======*/
	function wikilogy_related_contents( $count = "" ) {
		global $post;
		$tags = wp_get_post_terms( $post->ID, 'content_tag', array( 'fields' => 'ids' ) );
		if( !empty( $count ) ) {
			$post_related_count = $count;
		} else {
			$post_related_count = "4";
		}

		if ( $tags ) {
			$tag_ids = array();
			$args = array(
				'post__not_in' => array( $post->ID ),
				'post_status' => 'publish',
				'post_type' => 'content',
				'ignore_sticky_posts' => true,
				'posts_per_page' => $post_related_count,
				'tax_query' => array(
					array(
						'taxonomy' => 'content_tag',
						'field' => 'term_id',
						'terms' => $tags,
					),
				),
			);

			$wp_query = new wp_query( $args );
			if( $wp_query->have_posts() ) {
				echo '<div class="related-posts">';
					echo '<div class="related-posts-columns related-posts-column-' . esc_attr( $post_related_count ) . '">';
						echo wikilogy_title( $title = esc_html__( 'Related Posts', 'wikilogy' ), $shadow_title = esc_html__( 'Related', 'wikilogy' ), $text = esc_html__( 'Related contents and articles.', 'wikilogy' ), $style = "2" );
						while( $wp_query->have_posts() ) {
							$wp_query->the_post();
							echo wikilogy_post_list_style_4( $post_id = get_the_ID(), $author = "false", $category = "true", $date = "true" );
						}
					echo '</div>';
				echo '</div>';
			}
			wp_reset_postdata();
		}
	}



	/*======
	*
	* Suggested Contents
	*
	======*/
	function wikilogy_suggested_contents( $count = "", $post_id = "" ) {
		if( !empty( $post_id ) ) {
			if( !empty( $count ) ) {
				$suggested_contents_count = $count;
			} else {
				$suggested_contents_count = "3";
			}

			$content_list = get_post_meta( $post_id, 'suggested_contents_list', true );

			if( !empty( $content_list ) ) {
				$args = array(
					'post_status' => 'publish',
					'post_type' => array( 'post', 'content' ),
					'ignore_sticky_posts' => true,
					'post__in' => $content_list,
					'posts_per_page' => -1
				);
				$wp_query = new wp_query( $args );
				if( $wp_query->have_posts() ) {
					echo '<div class="suggested-contents">';
						echo wikilogy_title( $title = esc_html__( 'Suggested Contents', 'wikilogy' ), $shadow_title = esc_html__( 'Suggested', 'wikilogy' ), $text = esc_html__( 'Suggested contents and articles.', 'wikilogy' ), $style = "2" );
						echo '<div class="suggested-contents-columns suggested-contents-column-' . esc_attr( $suggested_contents_count ) . '">';
							while( $wp_query->have_posts() ) {
								$wp_query->the_post();
								echo wikilogy_post_list_style_3( $post_id = get_the_ID(), $image = "true", $excerpt = "true", $author = "true", $category = "true", $date = "true", $read_more = "false" );
							}
						echo '</div>';
					echo '</div>';
				}
				wp_reset_postdata();
			}
		}
	}



	/*======
	*
	* Random Content
	*
	======*/
	function wikilogy_random_add_rewrite() {
		global $wp;
		$wp->add_query_var('random');
		add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
	}
	add_action('init','wikilogy_random_add_rewrite');

	function wikilogy_random_template() {
		if (get_query_var('random') == 1) {
			$posts = get_posts('post_type=content&orderby=rand&numberposts=1');
			foreach($posts as $post) {
				$link = get_permalink($post);
			}
			wp_redirect($link,307);
			exit;
		}
	}
	add_action('template_redirect', 'wikilogy_random_template');



	/*======
	*
	* Toolbar
	*
	======*/
	function wikilogy_toolbar( $comments = "true" ) {
		$toolbar_comments = ot_get_option( 'toolbar_comments' );
		$toolbar_print = ot_get_option( 'toolbar_print' );
		$toolbar_edit = ot_get_option( 'toolbar_edit' );
		$toolbar_share = ot_get_option( 'toolbar_share' );
		$toolbar_font_selector = ot_get_option( 'toolbar_font_selector' );
		$toolbar_custom_links = ot_get_option( 'toolbar_custom_links' );

		if ( $toolbar_comments == 'on' or $toolbar_print == 'on' or $toolbar_share == 'on' or $toolbar_font_selector == 'on' or !empty( $toolbar_custom_links ) ) {
			$output = '<div class="wikilogy-toolbar">';
				$output .= '<div class="close-button"></div>';
				$output .= '<ul>';
					if ( !$toolbar_comments == 'off' or $toolbar_comments == 'on' ) {
						if ( comments_open() || get_comments_number() ) {
							if( $comments == "true" ) {
								$output .= '<li class="comments">';
									$output .= '<div class="icon">';
										$output .= '<i class="far fa-comment-dots" aria-hidden="true"></i>';
									$output .= '</div>';
									$output .= '<span>' . esc_html__( "Comments", "wikilogy" ) . '</span>';
								$output .= '</li>';							
							}
						}
					}

					if ( !$toolbar_print == 'off' or $toolbar_print == 'on' ) {
						$output .= '<li class="print">';
							$output .= '<div class="icon">';
								$output .= '<i class="fas fa-print" aria-hidden="true"></i>';
							$output .= '</div>';
							$output .= '<span>' . esc_html__( "Print", "wikilogy" ) . '</span>';
						$output .= '</li>';
					}

					if ( !$toolbar_edit == 'off' or $toolbar_edit == 'on' ) {
						$output .= '<li class="edit">';
							$output .= '<a href="' . get_edit_post_link() . '" title="' . esc_html__( "Edit", "wikilogy" ) . '">';
								$output .= '<div class="icon">';
									$output .= '<i class="fas fa-pencil-alt" aria-hidden="true"></i>';
								$output .= '</div>';
								$output .= '<span>' . esc_html__( "Edit", "wikilogy" ) . '</span>';
							$output .= '</a>';
						$output .= '</li>';
					}

					if ( !$toolbar_share == 'off' or $toolbar_share == 'on' ) {
						$output .= '<li class="share">';
							$output .= '<div class="icon">';
								$output .= '<i class="fas fa-share-alt" aria-hidden="true"></i>';
							$output .= '</div>';
							$output .= '<span>' . esc_html__( "Share", "wikilogy" ) . '</span>';
							$output .= '<ul class="submenu">';
								$output .= wikilogy_social_share();
							$output .= '</ul>';
						$output .= '</li>';
					}

					if ( !$toolbar_font_selector == 'off' or $toolbar_font_selector == 'on' ) {
						$output .= '<li class="font-selector">';
							$output .= '<div class="icon">';
								$output .= '<span class="plus">+</span>';
								$output .= '<i class="fas fa-font" aria-hidden="true"></i>';
								$output .= '<span class="minus">-</span>';
							$output .= '</div>';
							$output .= '<span>' . esc_html__( "Font Size", "wikilogy" ) . '</span>';
						$output .= '</li>';
					}

					if( !empty( $toolbar_custom_links ) ) {
						foreach ( $toolbar_custom_links as $link ) {
							if( !empty( $link ) ) {
								$output .= '<li class="custom-link">';
									$output .= '<a href="' . esc_url( $link["toolbar-link"] ) . '" target="' . esc_attr( $link["toolbar-target"] ) . '" title="' . esc_attr( $link["title"] ) . '">';
										$output .= '<div class="icon">';
											$output .= '<i class="' . esc_attr( $link["toolbar-icon"] ) . '"></i>';
										$output .= '</div>';
										$output .= '<span>' . esc_attr( $link["title"] ) . '</span>';
									$output .= '</a>';
								$output .= '</li>';
							}	
						}
					}
				$output .= '</ul>';
			$output .= '</div>';
			return $output;
		}
	}



	/*======
	*
	* Content Index
	*
	======*/
	function wikilogy_content_index( $post_id = "" ) {
		if( !empty( $post_id ) ) {
			$content_index = get_post_meta( get_the_ID(), 'content_index', true );	
			if( !empty( $content_index ) ) {
				$output = '<div class="content-index open">';
					$output .= '<div class="close-button"></div>';
					$output .= wikilogy_title( $title = esc_html__( 'Content Index', 'wikilogy' ), $shadow_title = "", $text = esc_html__( 'All headings of this content.', 'wikilogy' ), $style = "3" );
					$output .= '<ul class="scrollbar-outer">';
						foreach ( $content_index as $item ) {
							if( !empty( $item ) ) {
								if( !empty( $item["title"] ) ) {
									$title = $item["title"];
								} else {
									$title = "";
								}

								if( !empty( $item["content_index_number"] ) ) {
									$number = $item["content_index_number"];
								} else {
									$number = "";
								}

								if( !empty( $item["content_index_id"] ) ) {
									$id = $item["content_index_id"];
								} else {
									$id = "";
								}

								if( !empty( $item["content_index_sub_content"] ) ) {
									$sub = $item["content_index_sub_content"];
								} else {
									$sub = "";
								}

								if( !empty( $title ) ) {
									$output .= '<li class="sub-' . esc_attr( $sub ) . '">';
										$output .= '<a href="#' . $id . '">';
											if( !empty( $number ) ) {
												$output .= '<div class="number">' . $number . '</div>';
											}
											if( !empty( $title ) ) {
												$output .= '<div class="title">' . $title . '</div>';
											}
										$output .= '</a>';
									$output .= '</li>';
								}
							}
						}
					$output .= '</ul>';
				$output .= '</div>';
				return $output;
			}		
		}

	}



	/*======
	*
	* Content Table
	*
	======*/
	function wikilogy_content_table( $post_id = "" ) {
		if( !empty( $post_id ) ) {
			$content_table = get_post_meta( get_the_ID(), 'content_table', true );
			if( !empty( $content_table ) ) {
				$output = '<div class="content-table">';
					foreach ( $content_table as $table_item ) {
						if( !empty( $table_item ) ) {
							if( !empty( $table_item["title"] ) ) {
								$title = $table_item["title"];
							} else {
								$title = "";
							}
							if( !empty( $table_item["content_table_item_style"] ) ) {
								$style = $table_item["content_table_item_style"];
							} else {
								$style = "";
							}
							if( !empty( $table_item["content_table_item_type"] ) ) {
								$type = $table_item["content_table_item_type"];
							} else {
								$type = "";
							}
							if( !empty( $table_item["content_table_item_cover"] ) ) {
								$cover = $table_item["content_table_item_cover"];
								if( !$cover == "off" or $cover == "on" ) {
									$cover = "cover-item";
								} else {
									$cover = "";
								}
							} else {
								$cover = "";
							}
							if( !empty( $table_item["content_table_item_top_margin"] ) ) {
								$top_margin = $table_item["content_table_item_top_margin"];
								if( !$top_margin == "off" or $top_margin == "on" ) {
									$top_margin = "extra-top-margin";
								} else {
									$top_margin = "";
								}
							} else {
								$top_margin = "";
							}
							if( !empty( $table_item["content_table_item_description"] ) ) {
								$description = $table_item["content_table_item_description"];
							} else {
								$description = "";
							}


							if( !empty( $table_item["content_table_item_image"] ) ) {
								$item_image = $table_item["content_table_item_image"];
							} else {
								$item_image = "";
							}
							if( !empty( $table_item["content_table_item_image_style"] ) ) {
								$item_image_style = $table_item["content_table_item_image_style"];
							} else {
								$item_image_style = "";
							}
							if( !empty( $table_item["content_table_item_image_link"] ) ) {
								$item_image_link = $table_item["content_table_item_image_link"];
							} else {
								$item_image_link = "";
							}
							if( !empty( $table_item["content_table_item_image_link_target"] ) ) {
								$item_image_link_target = $table_item["content_table_item_image_link_target"];
							} else {
								$item_image_link_target = "";
							}


							if( !empty( $table_item["content_table_item_image_logo_image"] ) ) {
								$item_image_logo_image = $table_item["content_table_item_image_logo_image"];
							} else {
								$item_image_logo_image = "";
							}
							if( !empty( $table_item["content_table_item_image_logo_logo"] ) ) {
								$item_image_logo_logo = $table_item["content_table_item_image_logo_logo"];
							} else {
								$item_image_logo_logo = "";
							}
							if( !empty( $table_item["content_table_item_image_logo_logo_style"] ) ) {
								$item_image_logo_logo_style = $table_item["content_table_item_image_logo_logo_style"];
							} else {
								$item_image_logo_logo_style = "";
							}
							if( !empty( $table_item["content_table_item_image_logo_link"] ) ) {
								$item_image_logo_link = $table_item["content_table_item_image_logo_link"];
							} else {
								$item_image_logo_link = "";
							}
							if( !empty( $table_item["content_table_item_image_logo_link_target"] ) ) {
								$item_image_logo_link_target = $table_item["content_table_item_image_logo_link_target"];
							} else {
								$item_image_logo_link_target = "";
							}

							if( !empty( $table_item["content_table_item_image_gallery"] ) ) {
								$item_image_gallery = $table_item["content_table_item_image_gallery"];
							} else {
								$item_image_gallery = "";
							}


							if( !empty( $table_item["content_table_item_link"] ) ) {
								$item_link = $table_item["content_table_item_link"];
							} else {
								$item_link = "";
							}
							if( !empty( $table_item["content_table_item_link_target"] ) ) {
								$item_link_target = $table_item["content_table_item_link_target"];
							} else {
								$item_link_target = "";
							}

							if( !empty( $table_item["content_table_item_code"] ) ) {
								$item_code = $table_item["content_table_item_code"];
							} else {
								$item_code = "";
							}

							if( !empty( $title ) or !empty( $description ) or !empty( $item_image ) or !empty( $item_image_link ) or !empty( $item_image_logo_image ) or !empty( $item_image_logo_logo ) or !empty( $item_image_logo_link ) or !empty( $item_image_logo_link_title ) or !empty( $item_image_gallery ) or !empty( $item_link ) or !empty( $item_link_title ) or !empty( $item_code ) ) {
								$output .= '<div class="item ' . esc_attr( $style ) . ' ' . esc_attr( $type ) . ' ' . esc_attr( $cover ) . ' ' . esc_attr( $top_margin ) . '">';
									if( !empty( $title ) ) {
										$output .= '<div class="title">';
											$output .= $title;
											$output .= ':';
										$output .= '</div>';
									}
									if( !empty( $description ) or !empty( $item_image ) or !empty( $item_image_link ) or !empty( $item_image_logo_image ) or !empty( $item_image_logo_logo ) or !empty( $item_image_logo_link ) or !empty( $item_image_logo_link_title ) or !empty( $item_image_gallery ) or !empty( $item_link ) or !empty( $item_link_title ) or !empty( $item_code ) ) {
										$output .= '<div class="content ' . $type . '">';
											if( $type == "image" ) {
												if( !empty( $item_image ) ) {
													if( !empty( $item_image_link_target ) ) {
														$target = ' target="' . esc_attr( $item_image_link_target ) . '"';
													} else {
														$target = '';
													}

													if( !empty( $item_image_style ) ) {
														$style = ' class="' . esc_attr( $item_image_style ) . '"';
													} else {
														$style = "";
													}

													if( !empty( $item_image_link ) ) {
														$output .= '<a href="' . esc_url( $item_image_link ) . '" ' . $target . '>';
													}

														$output .= '<img src="' . esc_url( $item_image ) . '" ' . $style . '>';

													if( !empty( $item_image_link ) ) {
														$output .= '</a>';
													}

													if( !empty( $description ) ) {
														$output .= '<div class="type-description">';
															$output .= wpautop( $description );
														$output .= '</div>';
													}
												}
											} elseif( $type == "image-logo" ) {
												if( !empty( $item_image_logo_image ) or !empty( $item_image_logo_logo ) ) {
													if( !empty( $item_image_logo_link_target ) ) {
														$target = ' target="' . esc_attr( $item_image_logo_link_target ) . '"';
													} else {
														$target = '';
													}

													if( !empty( $item_image_logo_logo_style ) ) {
														$style = ' class="' . esc_attr( $item_image_logo_logo_style ) . '"';
													} else {
														$style = "";
													}

													if( !empty( $item_image_logo_image ) ) {
														if( !empty( $item_image_logo_link ) ) {
															$output .= '<a href="' . esc_url( $item_image_logo_link ) . '" class="top" ' . $target . '>';
														}

															$output .= '<img src="' . esc_url( $item_image_logo_image ) . '" ' . $style . '>';

														if( !empty( $item_image_logo_link ) ) {
															$output .= '</a>';
														}
													}

													if( !empty( $item_image_logo_logo ) ) {
														if( !empty( $item_image_logo_link ) ) {
															$output .= '<a href="' . esc_url( $item_image_logo_link ) . '" class="bottom" ' . $target . '>';
														}

															$output .= '<img src="' . esc_url( $item_image_logo_logo ) . '" ' . $style . '>';

														if( !empty( $item_image_logo_link ) ) {
															$output .= '</a>';
														}
													}

													if( !empty( $description ) ) {
														$output .= '<div class="type-description">';
															$output .= wpautop( $description );
														$output .= '</div>';
													}
												}
											} elseif( $type == "image-gallery" ) {
												if( !empty( $item_image_gallery ) ) {
													$item_image_gallery_images = explode( ',', $item_image_gallery );
													if( !empty( $item_image_gallery_images ) ) {
														$output .= '<div class="gallery">';
															$rand = rand( 0, 20000 );
															foreach ( $item_image_gallery_images as $image ) {
																$output .= '<div class="gallery-item">';
																	$lightbox_link = wp_get_attachment_image_src( $image, 'full', true, true );
																	$output .= '<a href="' . esc_url( $lightbox_link[0] ) . '" rel="prettyPhoto[media-content-gallery-' . esc_attr( $rand ) . ']">';
																		$output .= wp_get_attachment_image( $image, 'wikilogy-content-table-gallery', true, true );
																	$output .= '</a>';
																$output .= '</div>';
															}
														$output .= '</div>';
													}

													if( !empty( $description ) ) {
														$output .= '<div class="type-description">';
															$output .= wpautop( $description );
														$output .= '</div>';
													}
												}
											} elseif( $type == "link" ) {
												if( !empty( $item_link_target ) ) {
													$target = ' target="' . esc_attr( $item_link_target ) . '"';
												} else {
													$target = '';
												}

												if( !empty( $item_link ) and !empty( $title ) ) {
													$output .= '<a href="' . esc_url( $item_link ) . '"' . $target . '>' . $description . '</a>';
												}

												if( !empty( $description ) ) {
													$output .= '<div class="type-description">';
														$output .= wpautop( $description );
													$output .= '</div>';
												}

											} elseif( $type == "code" ) {

												if( !empty( $item_code ) ) {
													$output .= '<div class="code-field">';
														$output .= $item_code;
													$output .= '</div>';
												}

												if( !empty( $description ) ) {
													$output .= '<div class="type-description">';
														$output .= wpautop( $description );
													$output .= '</div>';
												}

											} elseif( !empty( $description ) ) {
												$output .= wpautop( $description );
											}
										$output .= '</div>';
									}
								$output .= '</div>';
							}
						}
					}
				$output .= '</div>';
				return $output;
			}
		}
	}



	/*======
	*
	* Post Type Support for Author Archive
	*
	======*/
	function wikilogy_author_post_type_support( $query ) {
		if ( $query -> is_author ) {
			$query -> set( 'post_type', 'any' );
		}
		remove_action( 'pre_get_posts', 'wikilogy_author_post_type_support' ); 
	}
	add_action( 'pre_get_posts', 'wikilogy_author_post_type_support' );



	/*======
	*
	* Pagination for Archive
	*
	======*/
	function wikilogy_pagination() {
		if( is_singular() )
			return;

		global $wp_query;

		if( $wp_query->max_num_pages <= 1 )
			return;

		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max = intval( $wp_query->max_num_pages );

		if( $paged >= 1 )
			$links[] = $paged;

		if( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		$prev_text = '<span>' . esc_html__( 'Previous', 'wikilogy' ) . '</span>';
		$next_text = '<span>' . esc_html__( 'Next', 'wikilogy' ) . '</span>';

		echo '<nav class="post-pagination"><ul>' . "\n";

		if( get_previous_posts_link() )
			printf( '<li>' . get_previous_posts_link( $prev_text ) . '</li>' );

		?>
			<li class="total-pages"><span><?php echo esc_html__( 'Page', 'wikilogy' ) . ' ' . $paged . ' ' . esc_html__( 'of', 'wikilogy' ) . ' ' . $max; ?></span></li>
		<?php
		if( get_next_posts_link() )
			printf( '<li>' . get_next_posts_link( $next_text ) . '</li>' );

		echo '</ul></nav>' . "\n";
	}



	/*======
	*
	* Pagination for Elements
	*
	======*/
	function wikilogy_element_pagination( $paged = "", $query = "" ) {

		if( !empty( $paged ) or !empty( $query ) ) {
			$output = "";
			$args = array(
				'prev_text' => esc_html__( 'Previous', 'luxe' ),
				'next_text' => esc_html__( 'Next', 'luxe' ),
				'type' => 'list',
				'show_all' => false,
				'total' => $query->max_num_pages,
				'current' => $paged
			);

			if( !empty( paginate_links( $args ) ) ) {
				$output .= '<nav class="post-pagination">';
					$output .= paginate_links( $args );
				$output .= '</nav>';
			}

			return $output;
		}

	}



	/*======
	*
	* Menus
	*
	======*/
	register_nav_menus( 
		array(
			'mainmenu' => esc_html__( 'Main Menu', 'wikilogy' ),
			'footermenu' => esc_html__( 'Footer Menu', 'wikilogy' ),
			'headersidebarmenu' => esc_html__( 'Header Sidebar Menu', 'wikilogy' ),
		)
	);



	/*======
	*
	* Social Media Sites
	*
	======*/
	function wikilogy_social_media_sites() {
		$output = '';
		$output .='<ul class="social-links">';
			if( !ot_get_option( 'social_media_facebook' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_facebook' ) . '" class="facebook" title="' . esc_html__( 'Facebook', 'wikilogy' ) . '" target="_blank"><i class="fab fa-facebook-f"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_twitter' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_twitter' ) . '" class="twitter" title="' . esc_html__( 'Twitter', 'wikilogy' ) . '" target="_blank"><i class="fab fa-twitter"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_googleplus' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_googleplus' ) . '" class="googleplus" title="' . esc_html__( 'Google+', 'wikilogy' ) . '" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_instagram' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_instagram' ) . '" class="instagram" title="' . esc_html__( 'Instagram', 'wikilogy' ) . '" target="_blank"><i class="fab fa-instagram"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_linkedin' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_linkedin' ) . '" class="linkedin" title="' . esc_html__( 'Linkedin', 'wikilogy' ) . '" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_vine' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_vine' ) . '" class="vine" title="' . esc_html__( 'Vine', 'wikilogy' ) . '" target="_blank"><i class="fab fa-vine"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_youtube' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_youtube' ) . '" class="youtube" title="' . esc_html__( 'YouTube', 'wikilogy' ) . '" target="_blank"><i class="fab fa-youtube"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_pinterest' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_pinterest' ) . '" class="pinterest" title="' . esc_html__( 'Pinterest', 'wikilogy' ) . '" target="_blank"><i class="fab fa-pinterest"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_behance' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_behance' ) . '" class="behance" title="' . esc_html__( 'Behance', 'wikilogy' ) . '" target="_blank"><i class="fab fa-behance"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_deviantart' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_deviantart' ) . '" class="deviantart" title="' . esc_html__( 'Deviantart', 'wikilogy' ) . '" target="_blank"><i class="fab fa-deviantart"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_digg' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_digg' ) . '" class="digg" title="' . esc_html__( 'Digg', 'wikilogy' ) . '" target="_blank"><i class="fab fa-digg"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_dribbble' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_dribbble' ) . '" class="dribbble" title="' . esc_html__( 'Dribbble', 'wikilogy' ) . '" target="_blank"><i class="fab fa-dribbble"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_flickr' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_flickr' ) . '" class="flickr" title="' . esc_html__( 'Flickr', 'wikilogy' ) . '" target="_blank"><i class="fab fa-flickr"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_github' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_github' ) . '" class="github"" title="' . esc_html__( 'GitHub', 'wikilogy' ) . '" target="_blank"><i class="fab fa-github"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_lastfm' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_lastfm' ) . '" class="lastfm" title="' . esc_html__( 'Last.fm', 'wikilogy' ) . '" target="_blank"><i class="fab fa-lastfm"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_reddit' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_reddit' ) . '" class="reddit" title="' . esc_html__( 'Reddit', 'wikilogy' ) . '" target="_blank"><i class="fab fa-reddit-alien"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_soundcloud' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_soundcloud' ) . '" class="soundcloud" title="' . esc_html__( 'SoundCloud', 'wikilogy' ) . '" target="_blank"><i class="fab fa-soundcloud"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_tumblr' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_tumblr' ) . '" class="tumblr" title="' . esc_html__( 'Tumblr', 'wikilogy' ) . '" target="_blank"><i class="fab fa-tumblr"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_vimeo' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_vimeo' ) . '" class="vimeo" title="' . esc_html__( 'Vimeo', 'wikilogy' ) . '" target="_blank"><i class="fab fa-vimeo-v"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_vk' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_vk' ) . '" class="vk" title="' . esc_html__( 'VK', 'wikilogy' ) . '" target="_blank"><i class="fab fa-vk"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_medium' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_medium' ) . '" class="medium" title="' . esc_html__( 'Medium', 'wikilogy' ) . '" target="_blank"><i class="fab fa-medium"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_wikipedia' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_wikipedia' ) . '" class="wikipedia" title="' . esc_html__( 'Wikipedia', 'wikilogy' ) . '" target="_blank"><i class="fab fa-wikipedia-w"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_custom' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_custom' ) . '" class="custom" title="' . esc_html__( 'Link', 'wikilogy' ) . '" target="_blank"><i class="fas fa-link"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_custom_2' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_custom_2' ) . '" class="custom" title="' . esc_html__( 'Link', 'wikilogy' ) . '" target="_blank"><i class="fas fa-link"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_rss' ) == "" ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_rss' ) . '" class="rss" title="' . esc_html__( 'RSS', 'wikilogy' ) . '" target="_blank"><i class="fas fa-rss"></i></a></li>';
			endif;
		$output .='</ul>';
		return $output;
	}



	/*======
	*
	* Social Share
	*
	======*/
	function wikilogy_social_share() {
		$social_share_facebook = ot_get_option( 'social_share_facebook' );
		$social_share_twitter = ot_get_option( 'social_share_twitter' );
		$social_share_googleplus = ot_get_option( 'social_share_googleplus' );
		$social_share_linkedin = ot_get_option( 'social_share_linkedin' );
		$social_share_pinterest = ot_get_option( 'social_share_pinterest' );
		$social_share_reddit = ot_get_option( 'social_share_reddit' );
		$social_share_delicious = ot_get_option( 'social_share_delicious' );
		$social_share_stumbleupon = ot_get_option( 'social_share_stumbleupon' );
		$social_share_tumblr = ot_get_option( 'social_share_tumblr' );
		$social_share_link_title = esc_html__( 'Share to', 'wikilogy' );
		$hide_general_post_share = ot_get_option( 'hide_general_post_share' );
		$share_post_id = get_the_ID();
		
		$title = "";
		$facebook = "";
		$twitter = "";
		$googleplus = "";
		$linkedin = "";
		$pinterest = "";	
		$reddit = "";
		$delicious = "";
		$stumbleupon = "";
		$tumblr = "";
		
		if( !$hide_general_post_share == 'off' or $hide_general_post_share == "on" ) {
			if( is_single() ) {
				$title = '<div class="title">' . esc_html__( 'Share:', 'wikilogy' ) . '</div>';
			}

			if( !$social_share_facebook == 'off' or $social_share_facebook == 'on' ) {
				$facebook = '<li><a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'wikilogy' ) . '" target="_blank"><i class="fab fa-facebook-f"></i>' . '<span>' . esc_html__( 'Facebook', 'wikilogy' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_twitter == 'off' or $social_share_twitter == 'on' ) {
				$twitter = '<li><a class="share-twitter" href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . urlencode( get_the_title() ). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'wikilogy' ) . '" target="_blank"><i class="fab fa-twitter"></i>' . '<span>' . esc_html__( 'Twitter', 'wikilogy' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_googleplus == 'off' or $social_share_googleplus == 'on' ) {
				$googleplus = '<li><a class="share-googleplus" href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'wikilogy' ) . '" target="_blank"><i class="fab fa-google-plus-g"></i>' . '<span>' . esc_html__( 'Google+', 'wikilogy' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_linkedin == 'off' or $social_share_linkedin == 'on' ) {
				$linkedin = '<li><a class="share-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'wikilogy' ) . '" target="_blank"><i class="fab fa-linkedin-in"></i>' . '<span>' . esc_html__( 'LinkedIn', 'wikilogy' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_pinterest == 'off' or $social_share_pinterest == 'on' ) {
				$pinterest = '<li><a class="share-pinterest" href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'wikilogy' ) . '" target="_blank"><i class="fab fa-pinterest-p"></i>' . '<span>' . esc_html__( 'Pinterest', 'wikilogy' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_reddit == 'off' or $social_share_reddit == 'on' ) {
				$reddit = '<li><a class="share-reddit" href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'wikilogy' ) . '" target="_blank"><i class="fab fa-reddit-alien"></i>' . '<span>' . esc_html__( 'Reddit', 'wikilogy' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_delicious == 'off' or $social_share_delicious == 'on' ) {
				$delicious = '<li><a class="share-delicious" href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'wikilogy' ) . '" target="_blank"><i class="fab fa-delicious"></i>' . '<span>' . esc_html__( 'Delicious', 'wikilogy' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_stumbleupon == 'off' or $social_share_stumbleupon == 'on' ) {
				$stumbleupon = '<li><a class="share-stumbleupon" href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'wikilogy' ) . '" target="_blank"><i class="fab fa-stumbleupon"></i>' . '<span>' . esc_html__( 'Stumbleupon', 'wikilogy' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_tumblr == 'off' or $social_share_tumblr == 'on' ) {
				$tumblr = '<li><a class="share-tumblr" href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'wikilogy' ) . '" target="_blank"><i class="fab fa-tumblr"></i>' . '<span>' . esc_html__( 'Tumblr', 'wikilogy' ) . '</span>' . '</a></li>';
			}
		}
		
		$before = '<div class="post-share">' . $title . '<ul>';
		$after = '</ul></div>';
		
		$output = $before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $after;
		return $output;
	}



	/*======
	*
	* Social Media Sites for User
	*
	======*/
	function wikilogy_user_social_media_sites( $user_id = "" ) {
		$user_profile_social_media_facebook = get_the_author_meta( 'facebook', $user_id );
		$user_profile_social_media_googleplus = get_the_author_meta( 'googleplus', $user_id );
		$user_profile_social_media_instagram = get_the_author_meta( 'instagram', $user_id );
		$user_profile_social_media_linkedin = get_the_author_meta( 'linkedin', $user_id );
		$user_profile_social_media_vine = get_the_author_meta( 'vine', $user_id );
		$user_profile_social_media_twitter = get_the_author_meta( 'twitter', $user_id );
		$user_profile_social_media_pinterest = get_the_author_meta( 'pinterest', $user_id );
		$user_profile_social_media_youtube = get_the_author_meta( 'youtube', $user_id );
		$user_profile_social_media_behance = get_the_author_meta( 'behance', $user_id );
		$user_profile_social_media_deviantart = get_the_author_meta( 'deviantart', $user_id );
		$user_profile_social_media_digg = get_the_author_meta( 'digg', $user_id );
		$user_profile_social_media_dribbble = get_the_author_meta( 'dribbble', $user_id );
		$user_profile_social_media_flickr = get_the_author_meta( 'flickr', $user_id );
		$user_profile_social_media_github = get_the_author_meta( 'github', $user_id );
		$user_profile_social_media_lastfm = get_the_author_meta( 'lastfm', $user_id );
		$user_profile_social_media_reddit = get_the_author_meta( 'reddit', $user_id );
		$user_profile_social_media_soundcloud = get_the_author_meta( 'soundcloud', $user_id );
		$user_profile_social_media_tumblr = get_the_author_meta( 'tumblr', $user_id );
		$user_profile_social_media_vimeo = get_the_author_meta( 'vimeo', $user_id );
		$user_profile_social_media_vk = get_the_author_meta( 'vk', $user_id );
		$user_profile_social_media_medium = get_the_author_meta( 'medium', $user_id );
		$user_profile_social_media_wikipedia = get_the_author_meta( 'wikipedia', $user_id );

		if( !$user_profile_social_media_medium == "" or!$user_profile_social_media_wikipedia == "" or !$user_profile_social_media_vk == "" or !$user_profile_social_media_vimeo == "" or !$user_profile_social_media_tumblr == "" or !$user_profile_social_media_soundcloud == "" or !$user_profile_social_media_reddit == "" or !$user_profile_social_media_lastfm == "" or !$user_profile_social_media_github == "" or !$user_profile_social_media_flickr == "" or !$user_profile_social_media_dribbble == "" or !$user_profile_social_media_digg == "" or !$user_profile_social_media_deviantart == "" or !$user_profile_social_media_behance == "" or !$user_profile_social_media_youtube == "" or !$user_profile_social_media_pinterest == "" or !$user_profile_social_media_twitter == "" or !$user_profile_social_media_vine == "" or !$user_profile_social_media_linkedin == "" or !$user_profile_social_media_facebook == "" or !$user_profile_social_media_googleplus == "" or !$user_profile_social_media_instagram == "" ) { ?>

			<div class="social-links">
				<ul>
					<?php if( !$user_profile_social_media_facebook == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_facebook ); ?>" title="<?php echo esc_html__( 'Facebook', 'wikilogy' ); ?>" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_googleplus == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_googleplus ); ?>" title="<?php echo esc_html__( 'Google+', 'wikilogy' ); ?>" target="_blank" class="googleplus"><i class="fab fa-google-plus-g"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_instagram == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_instagram ); ?>" title="<?php echo esc_html__( 'Instagram', 'wikilogy' ); ?>" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_linkedin == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_linkedin ); ?>" title="<?php echo esc_html__( 'LinkedIn', 'wikilogy' ); ?>" target="_blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_vine == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_vine ); ?>" title="<?php echo esc_html__( 'Vine', 'wikilogy' ); ?>" target="_blank" class="vine"><i class="fab fa-vine"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_twitter == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_twitter ); ?>" title="<?php echo esc_html__( 'Twitter', 'wikilogy' ); ?>" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_pinterest == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_pinterest ); ?>" title="<?php echo esc_html__( 'Pinterest', 'wikilogy' ); ?>" target="_blank" class="pinterest"><i class="fab fa-pinterest"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_youtube == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_youtube ); ?>" title="<?php echo esc_html__( 'YouTube', 'wikilogy' ); ?>" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_behance == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_behance ); ?>" title="<?php echo esc_html__( 'Behance', 'wikilogy' ); ?>" target="_blank" class="behance"><i class="fab fa-behance"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_deviantart == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_deviantart ); ?>" title="<?php echo esc_html__( 'DeviantArt', 'wikilogy' ); ?>" target="_blank" class="deviantart"><i class="fab fa-deviantart"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_digg == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_digg ); ?>" title="<?php echo esc_html__( 'Digg', 'wikilogy' ); ?>" target="_blank" class="digg"><i class="fab fa-digg"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_dribbble == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_dribbble ); ?>" title="<?php echo esc_html__( 'Dribbble', 'wikilogy' ); ?>" target="_blank" class="dribbble"><i class="fab fa-dribbble"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_flickr == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_flickr ); ?>" title="<?php echo esc_html__( 'Flickr', 'wikilogy' ); ?>" target="_blank" class="flickr"><i class="fab fa-flickr"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_github == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_github ); ?>" title="<?php echo esc_html__( 'GitHub', 'wikilogy' ); ?>" target="_blank" class="github"><i class="fab fa-github"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_lastfm == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_lastfm ); ?>" title="<?php echo esc_html__( 'Last.fm', 'wikilogy' ); ?>" target="_blank" class="lastfm"><i class="fab fa-lastfm"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_reddit == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_reddit ); ?>" title="<?php echo esc_html__( 'Reddit', 'wikilogy' ); ?>" target="_blank" class="reddit"><i class="fab fa-reddit-alien"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_soundcloud == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_soundcloud ); ?>" title="<?php echo esc_html__( 'SoundCloud', 'wikilogy' ); ?>" target="_blank" class="soundcloud"><i class="fab fa-soundcloud"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_tumblr == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_tumblr ); ?>" title="<?php echo esc_html__( 'Tumblr', 'wikilogy' ); ?>" target="_blank" class="tumblr"><i class="fab fa-tumblr"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_vimeo == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_vimeo ); ?>" title="<?php echo esc_html__( 'Vimeo', 'wikilogy' ); ?>" target="_blank" class="vimeo"><i class="fab fa-vimeo-v"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_vk == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_vk ); ?>" title="<?php echo esc_html__( 'VK', 'wikilogy' ); ?>" target="_blank" class="vk"><i class="fab fa-vk"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_medium == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_medium ); ?>" title="<?php echo esc_html__( 'Medium', 'wikilogy' ); ?>" target="_blank" class="medium"><i class="fab fa-medium"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_wikipedia == "" ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_wikipedia ); ?>" title="<?php echo esc_html__( 'Wikipedia', 'wikilogy' ); ?>" target="_blank" class="medium"><i class="fab fa-wikipedia-w"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		<?php
		}
	}



	/*======
	*
	* Global Post Information
	*
	======*/
	function wikilogy_post_information( $post_id = "", $author = "", $category = "", $date = "", $style = "" ) {
		if( !empty( $post_id ) ) {
			if( !empty( $style ) ) {
				$style = " style-" . esc_attr( $style );
			} else {
				$style = "";
			}

			if( $author == "true" or $category == "true" or $date == "true" ) {
				$output = '';
				$output .= '<div class="post-information' . esc_attr( $style ) . '">';
					$output .= '<ul>';
						if( $author == "true" ) {
							global $post;
							$get_the_author_id=$post->post_author;
							$author_avatar = get_avatar( get_the_author_meta( 'user_email', $get_the_author_id ), apply_filters( 'wpex_author_bio_avatar_size', 120 ) );
							$display_name = get_the_author_meta( 'display_name', $get_the_author_id );
							if( !empty( $display_name ) ) {
								$output .= '<li class="author">';
									$output .= '<a href="' . get_author_posts_url( get_the_author_meta( 'ID', $get_the_author_id ) ) . '">';
										if( !empty( $author_avatar ) ) {
											$output .= get_avatar( get_the_author_meta( 'user_email', $get_the_author_id ), apply_filters( 'thumbnail', 20 ) );
										}
										if( !empty( $display_name ) ) {
											$output .= '<span>' . get_the_author_meta( 'display_name', $get_the_author_id ) . '</span>';
										}
									$output .= '</a>';
								$output .= '</li>';
							}
						}
						if( $category == "true" ) {
							if ( get_post_type( $post_id ) == 'content' or is_single() ) {
								$output .= '<li class="category">';
									$output .= '<i class="far fa-folder-open"></i>';
									if ( get_post_type( $post_id ) == 'content' ) {
										$main_category = get_post_meta( get_the_ID(), 'content_main_category', true );
										if( !empty( $main_category ) ) {
											$cat = get_term( $main_category );
											if( !empty( $cat ) ) {
												$name = $cat->name;
												$id = $cat->term_id;
												$output .= '<div class="cat-list">';
													$output .= '<a href="' . get_term_link( $id ) . '" title="' . esc_attr( $name ) . '">' . esc_attr( $name ) . '</a>';
												$output .= '</div>';								
											}
										}
									} else {
										if( is_single() ) {
											$output .= get_the_category_list( ", ", '', $post_id );										
										}
									}
								$output .= '</li>';
							}
						}
						if( $date == "true" ) {
							$output .= '<li class="date">';
								$output .= '<i class="far fa-clock"></i>';
								$output .= get_the_time( get_option( 'date_format' ), $post_id );
							$output .= '</li>';
						}
					$output .= '</ul>';
				$output .= '</div>';
				return $output;
			}
		}
	}



	/*======
	*
	* Global Read More for Posts
	*
	======*/
	function wikilogy_post_read_more( $post_id = "", $style = "" ) {
		if( !empty( $post_id ) ) {
			if( !empty( $style ) ) {
				$style = " style-" . esc_attr( $style );
			} else {
				$style = "";
			}

			$output = '';
			$output .= '<div class="post-read-more' . esc_attr( $style ) . '">';
				$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . esc_html__( 'Read More', 'wikilogy' ) . '">' . esc_html__( 'Read More', 'wikilogy' ) . '</a>';
			$output .= '</div>';
			return $output;
		}
	}



	/*======
	*
	* Post Lists
	*
	======*/
	function wikilogy_post_list_style_1( $post_id = "", $image = "", $excerpt = "", $author = "", $category = "", $date = "", $read_more = "" ) {
		if( !empty( $post_id ) ) {
			$output = "";
			if ( is_sticky( $post_id ) ) {
				$output .= '<div class="post-list-styles post-list-style-1 sticky-post">';
			} else {
				$output .= '<div class="post-list-styles post-list-style-1">';
			}

				if( $image == 'true' ) {
					if ( has_post_thumbnail( $post_id ) ) {
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'wikilogy-post-1' );
					} else {
						$image_url = "";
					}

					if( !empty( $image_url ) ) {
						$output .= '<div class="image">';
							$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';
						$output .= '</div>';
					}
				}

				$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

				if( $excerpt == 'true' ) {
					$post_excerpt = get_the_excerpt( $post_id );
					if( !empty( $post_excerpt ) ) {
						$output .= '<div class="excerpt">' . wikilogy_word_cutter( $string = $post_excerpt, $word_limit = "50" ) . '</div>';
					}
				}

				$output .= wikilogy_post_information( $post_id = $post_id, $author = $author, $category = $category, $date = $date, $style = "1" );

				if( $read_more == 'true' ) {
					$output .= wikilogy_post_read_more( $post_id = $post_id, $style = "1" );
				}
			$output .= '</div>';
			return $output;
		}
	}
	
	function wikilogy_post_list_style_2( $post_id = "", $image = "", $excerpt = "", $author = "", $category = "", $date = "", $read_more = "" ) {
		if( !empty( $post_id ) ) {
			$output = "";
			if ( is_sticky( $post_id ) ) {
				$output .= '<div class="post-list-styles post-list-style-2 sticky-post">';
			} else {
				$output .= '<div class="post-list-styles post-list-style-2">';
			}

				if( $image == 'true' ) {
					if ( has_post_thumbnail( $post_id ) ) {
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'wikilogy-post-2' );
						$none_image = "";
					} else {
						$image_url = "";
						$none_image = " none-image";
					}

					if( !empty( $image_url ) ) {
						$output .= '<div class="image">';
							$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';
						$output .= '</div>';
					}
				} else {
					$none_image = " none-image";
				}

				$output .= '<div class="content' . esc_attr( $none_image ) . '">';
					$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

					if( $excerpt == 'true' ) {
						$post_excerpt = get_the_excerpt( $post_id );
						if( !empty( $post_excerpt ) ) {
							$output .= '<div class="excerpt">' . wikilogy_word_cutter( $string = $post_excerpt, $word_limit = "50" ) . '</div>';
						}
					}

					$output .= wikilogy_post_information( $post_id = $post_id, $author = $author, $category = $category, $date = $date, $style = "1" );

					if( $read_more == 'true' ) {
						$output .= wikilogy_post_read_more( $post_id = $post_id, $style = "1" );
					}
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	function wikilogy_post_list_style_3( $post_id = "", $image = "", $excerpt = "", $author = "", $category = "", $date = "", $read_more = "" ) {
		if( !empty( $post_id ) ) {
			$output = "";
			if ( is_sticky( $post_id ) ) {
				$output .= '<div class="post-list-styles post-list-style-3 sticky-post">';
			} else {
				$output .= '<div class="post-list-styles post-list-style-3">';
			}

				if( $image == 'true' ) {
					if ( has_post_thumbnail( $post_id ) ) {
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'wikilogy-post-2' );
					} else {
						$image_url = "";
					}

					if( !empty( $image_url ) ) {
						$output .= '<div class="image">';
							$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';
						$output .= '</div>';
					}
				}

				$output .= '<div class="content">';
					$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

					if( $excerpt == 'true' ) {
						$post_excerpt = get_the_excerpt( $post_id );
						if( !empty( $post_excerpt ) ) {
							$output .= '<div class="excerpt">' . wikilogy_word_cutter( $string = $post_excerpt, $word_limit = "50" ) . '</div>';
						}
					}

					$output .= wikilogy_post_information( $post_id = $post_id, $author = $author, $category = $category, $date = $date, $style = "1" );

					if( $read_more == 'true' ) {
						$output .= wikilogy_post_read_more( $post_id = $post_id, $style = "1" );
					}
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	function wikilogy_post_list_style_4( $post_id = "", $author = "", $category = "", $date = "" ) {
		if( !empty( $post_id ) ) {
			$output = "";
			$output .= '<div class="post-list-styles post-list-style-4">';

				if ( has_post_thumbnail( $post_id ) ) {
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'wikilogy-post-3' );
				} else {
					$image_url = "";
					$image_url[0] = "";
				}

				$output .= '<div class="content" style="background-image:url(' . esc_url( $image_url[0] ) . ');">';
					$output .= '<div class="inner">';
						$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"></a>';
						$output .= '<div class="title">' . get_the_title( $post_id ) . '</div>';
						$output .= wikilogy_post_information( $post_id = $post_id, $author = $author, $category = $category, $date = $date, $style = "1" );
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	function wikilogy_post_list_style_5( $post_id = "", $top_text = "" ) {
		if( !empty( $post_id ) ) {
			$output = "";
			$output .= '<div class="post-list-styles post-list-style-5">';

				if ( has_post_thumbnail( $post_id ) ) {
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'wikilogy-post-4' );
				} else {
					$image_url = "";
					$image_url[0] = "";
				}

				$output .= '<div class="content" style="background-image:url(' . esc_url( $image_url[0] ) . ');">';
					$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"></a>';
					$output .= '<div class="inner">';
						if( $top_text == "true" ) {
							$post_title_text = get_post_meta( $post_id, 'title_text', true );
							if( !empty( $post_title_text ) ) {
								$output .= '<div class="title-text">' . $post_title_text . '</div>';
							}
						}
						$output .= '<div class="title">' . get_the_title( $post_id ) . '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	function wikilogy_post_list_style_6( $post_id = "", $image = "", $category = "", $date = "" ) {
		if( !empty( $post_id ) ) {
			$output = "";
			if ( is_sticky( $post_id ) ) {
				$output .= '<div class="post-list-styles post-list-style-6 sticky-post">';
			} else {
				$output .= '<div class="post-list-styles post-list-style-6">';
			}

				if( $image == 'true' ) {
					if ( has_post_thumbnail( $post_id ) ) {
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'wikilogy-post-2' );
					} else {
						$image_url = "";
					}

					if( !empty( $image_url ) ) {
						$output .= '<div class="image">';
							$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';
						$output .= '</div>';
					}
				}

				$output .= '<div class="content">';
					$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

					$output .= wikilogy_post_information( $post_id = $post_id, $author = "false", $category = $category, $date = $date, $style = "1" );

				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	function wikilogy_post_list_style_7( $post_id = "", $image = "", $excerpt = "", $author = "", $category = "", $date = "" ) {
		if( !empty( $post_id ) ) {
			$output = "";
			if ( is_sticky( $post_id ) ) {
				$output .= '<div class="post-list-styles post-list-style-7 sticky-post">';
			} else {
				$output .= '<div class="post-list-styles post-list-style-7">';
			}

				$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';
					
				if( $image == 'true' ) {
					if ( has_post_thumbnail( $post_id ) ) {
						$output .= '<div class="image">';
							$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . wp_get_attachment_image( get_post_thumbnail_id( $post_id ), 'wikilogy-post-5' ) . '</a>';
						$output .= '</div>';
					}
				}

				$output .= '<div class="content">';
					if( $excerpt == 'true' ) {
						$post_excerpt = get_the_excerpt( $post_id );
						if( !empty( $post_excerpt ) ) {
							$output .= '<div class="excerpt">' . wikilogy_word_cutter( $string = $post_excerpt, $word_limit = "50" ) . '</div>';
						}
					}

					$output .= wikilogy_post_information( $post_id = $post_id, $author = $author, $category = $category, $date = $date, $style = "1" );
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	function wikilogy_post_list_style_8( $post_id = "", $image = "", $date = "" ) {
		if( !empty( $post_id ) ) {
			$output = "";
			if ( is_sticky( $post_id ) ) {
				$output .= '<div class="post-list-styles post-list-style-8 sticky-post">';
			} else {
				$output .= '<div class="post-list-styles post-list-style-8">';
			}

				if( $image == 'true' ) {
					if ( has_post_thumbnail( $post_id ) ) {
						$output .= '<div class="image">';
							$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . wp_get_attachment_image( get_post_thumbnail_id( $post_id ), 'wikilogy-post-9' ) . '</a>';
						$output .= '</div>';
					}
				}

				$output .= '<div class="content">';
					$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';
					$output .= wikilogy_post_information( $post_id = $post_id, $author = "false", $category = "false", $date = $date, $style = "1" );
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	function wikilogy_post_list_style_9( $post_id = "", $excerpt = "", $category = "", $date = "" ) {
		if( !empty( $post_id ) ) {
			$output = "";
			$output .= '<div class="post-list-styles post-list-style-9">';

				if ( has_post_thumbnail( $post_id ) ) {
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'wikilogy-post-7' );
				} else {
					$image_url = "";
					$image_url[0] = "";
				}

				$output .= '<div class="content" style="background-image:url(' . esc_url( $image_url[0] ) . ');">';
					$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"></a>';
					$output .= '<div class="inner">';
						$output .= wikilogy_post_information( $post_id = $post_id, $author = "false", $category = $category, $date = $date, $style = "1" );
						$output .= '<div class="title">' . get_the_title( $post_id ) . '</div>';
						if( $excerpt == 'true' ) {
							$post_excerpt = get_the_excerpt( $post_id );
							if( !empty( $post_excerpt ) ) {
								$output .= '<div class="excerpt">' . wikilogy_word_cutter( $string = $post_excerpt, $word_limit = "50" ) . '</div>';
							}
						}
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	function wikilogy_post_list_style_10( $post_id = "", $category = "", $date = "" ) {
		if( !empty( $post_id ) ) {
			$output = "";
			$output .= '<div class="post-list-styles post-list-style-10">';

				if ( has_post_thumbnail( $post_id ) ) {
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'wikilogy-post-7' );
				} else {
					$image_url = "";
					$image_url[0] = "";
				}

				$output .= '<div class="content" style="background-image:url(' . esc_url( $image_url[0] ) . ');">';
					$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"></a>';
					$output .= '<div class="inner">';
						$output .= '<div class="title">' . get_the_title( $post_id ) . '</div>';
						$output .= wikilogy_post_information( $post_id = $post_id, $author = "false", $category = $category, $date = $date, $style = "1" );
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}



	/*======
	*
	* Post Styles for Archives
	*
	======*/
	function wikilogy_archive_post_list() {
		function wikilogy_archive_post_list_style1() {
			echo '<div class="archive-post-list-style-1 post-list">';
				while ( have_posts() ) : the_post();
					echo wikilogy_post_list_style_1( $post_id = get_the_ID(), $image = "true", $excerpt = "true", $author = "true", $category = "true", $date = "", $read_more = "true" );
				endwhile;
			echo '</div>';
		}
		
		function wikilogy_archive_post_list_style2() {
			echo '<div class="archive-post-list-style-2 post-list">';
				while ( have_posts() ) : the_post();
					echo wikilogy_post_list_style_2( $post_id = get_the_ID(), $image = "true", $excerpt = "true", $author = "true", $category = "true", $date = "true", $read_more = "true" );
				endwhile;
			echo '</div>';
		}
		
		function wikilogy_archive_post_list_style3() {
			echo '<div class="archive-post-list-style-3 post-list">';
				while ( have_posts() ) : the_post();
					echo wikilogy_post_list_style_3( $post_id = get_the_ID(), $image = "true", $excerpt = "true", $author = "true", $category = "true", $date = "true", $read_more = "true" );
				endwhile;
			echo '</div>';
		}

		if( is_category() ) {
			$archive_archive_post_list_style = ot_get_option( 'blog_category_post_list_style' );
		} elseif( is_tag() ) {
			$archive_archive_post_list_style = ot_get_option( 'tag_tag_post_list_style' );
		} elseif( is_search() ) {
			$archive_archive_post_list_style = ot_get_option( 'search_search_post_list_style' );
		} else {
			$archive_archive_post_list_style = ot_get_option( 'archive_archive_post_list_style' );
		}
		
		if( is_category() ) {
			$cat = get_queried_object();
			$cat_id = $cat->term_id;
			$wikilogy_category_category_post_list_style = get_term_meta( $cat_id, 'wikilogy_category_category_post_list_style', true );
			if( $wikilogy_category_category_post_list_style == "post-list-style-1" ) {
				wikilogy_archive_post_list_style1();
			} elseif( $wikilogy_category_category_post_list_style == "post-list-style-2" ) {
				wikilogy_archive_post_list_style2();
			} elseif( $wikilogy_category_category_post_list_style == "post-list-style-3" ) {
				wikilogy_archive_post_list_style3();
			} else {
				if( $archive_archive_post_list_style == "style2" ) {
					wikilogy_archive_post_list_style2();
				} elseif( $archive_archive_post_list_style == "style3" ) {
					wikilogy_archive_post_list_style3();
				} else {
					wikilogy_archive_post_list_style1();
				}
			}

		} else {
			if( $archive_archive_post_list_style == "style2" ) {
				wikilogy_archive_post_list_style2();
			} elseif( $archive_archive_post_list_style == "style3" ) {
				wikilogy_archive_post_list_style3();
			} else {
				wikilogy_archive_post_list_style1();
			}
		}
	}



	/*======
	*
	* Title Banner
	*
	======*/
	function wikilogy_title_banner( $style = "1", $title_text = "" ) {
		echo '<div class="title-banner style-' . esc_attr( $style ) . '">';
			if( is_page() ) {
				if ( has_post_thumbnail() ) {
					$custom_breadcrumbs = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'wikilogy-page-banner' );
					echo '<div class="page-title-background" style="background-image:url(' . esc_url( $custom_breadcrumbs["0"] ) . ');"></div>';
				} else {
					echo '<div class="page-title-background"></div>';						
				}	
			} else {
				echo '<div class="page-title-background"></div>';
			}
			
			echo '<div class="content">';
				if( is_category() ) {
					echo wikilogy_title( $title = single_cat_title( '', false ), $shadow_title = "", $text = "", $style = "1" );
				} elseif( is_tag() ) {
					echo wikilogy_title( $title = single_tag_title( '', false ), $shadow_title = "", $text = "", $style = "1" );
				} elseif( is_search() ) {
					echo wikilogy_title( $title = get_search_query(), $shadow_title = "", $text = "", $style = "1" );
				} elseif( is_author() ) {
					$title = get_the_author();
					echo wikilogy_title( $title = $title, $shadow_title = "", $text = "", $style = "1" );
				} elseif( is_home() ) {
					echo wikilogy_title( $title = esc_html__( 'Home', 'wikilogy' ), $shadow_title = esc_html__( 'Homepage', 'wikilogy' ), $text = "", $style = "1" );
				} elseif( is_404() ) {
					echo wikilogy_title( $title = esc_html__( '404 Page', 'wikilogy' ), $shadow_title = esc_html__( '404PAGE', 'wikilogy' ), $text = $title_text, $style = "1" );
				} elseif( is_tax( 'content_category' ) ) {
					echo wikilogy_title( $title = single_term_title("", false), $shadow_title = esc_html__( 'Contents', 'wikilogy' ), $text = term_description(), $style = "1" );
				} elseif( is_archive( 'content' ) ) {
					echo wikilogy_title( $title = esc_html__( 'Contents', 'wikilogy' ), $shadow_title = "All Contents", $text = "", $style = "1" );
				} elseif( is_attachment() ) {
					echo wikilogy_title( $title = get_the_title(), $shadow_title = "", $text = "", $style = "1" );
				} elseif( is_page() ) {
					$page_title_global = ot_get_option( 'page_title' );
					$title_single = get_post_meta( get_the_ID(), 'title_status', true );
					if( !$page_title_global == 'off' or $page_title_global == 'on' ) {
						if( !$title_single == 'off' or $title_single == 'on' ) {
							echo wikilogy_title( $title = get_the_title(), $shadow_title = "", $text = $title_text, $style = "1" );
						}
					}
				} elseif ( get_post_type( get_the_ID() ) == 'content' ) {
					$content_title_global = ot_get_option( 'content_title' );
					$title_single = get_post_meta( get_the_ID(), 'title_status', true );
					if( !$content_title_global == 'off' or $content_title_global == 'on' ) {
						if( !$title_single == 'off' or $title_single == 'on' ) {
							echo wikilogy_title( $title = get_the_title(), $shadow_title = "", $text = $title_text, $style = "1" );
						}
					}

					$content_information = ot_get_option( 'content_information' );
					if( !$content_information == 'off' or $content_information == 'on' ) {
						echo wikilogy_post_information( $post_id = get_the_ID(), $author = "true", $category = "true", $date = "true", $style = "1" );
					}
				} elseif( is_single() ) {
					$post_title_global = ot_get_option( 'post_title' );
					$title_single = get_post_meta( get_the_ID(), 'title_status', true );
					if( !$post_title_global == 'off' or $post_title_global == 'on' ) {
						if( !$title_single == 'off' or $title_single == 'on' ) {
							echo wikilogy_title( $title = get_the_title(), $shadow_title = "", $text = $title_text, $style = "1" );
						}
					}

					$post_information = ot_get_option( 'post_information' );
					if( !$post_information == 'off' or $post_information == 'on' ) {
						echo wikilogy_post_information( $post_id = get_the_ID(), $author = "true", $category = "true", $date = "true", $style = "1" );
					}
				} else {
					if ( is_day() ) {
						$text = esc_html__( 'Daily Archives', 'wikilogy' );
						$title = get_the_date();
						echo wikilogy_title( $title = $title, $shadow_title = "", $text = $text, $style = "1" );
					} elseif( is_month() ) {
						$text = esc_html__( 'Monthly Archives', 'wikilogy' );
						$title = get_the_date( _x( 'F Y', 'Monthly archives date format', 'wikilogy' ) );
						echo wikilogy_title( $title = $title, $shadow_title = "", $text = $text, $style = "1" );
					} elseif( is_year() ) {
						$text = esc_html__( 'Yearly Archives', 'wikilogy' );
						$title = get_the_date( _x( 'Y', 'Yearly archives date format', 'wikilogy' ) );
						echo wikilogy_title( $title = $title, $shadow_title = "", $text = $text, $style = "1" );
					} else {
						echo wikilogy_title( $title = esc_html__( 'Archives', 'wikilogy' ), $shadow_title = "", $text = "", $style = "1" );
					}
				}
			echo '</div>';
		echo '</div>';
	}

	function wikilogy_archive_title_blank() {
		echo '<div class="archive-title-none"></div>';
	}



	/*======
	*
	* Content Titles
	*
	======*/
	function wikilogy_title( $title = "", $shadow_title = "", $text = "", $style = "" ) {
		if( !empty( $style ) ) {
			$style = " style-" . esc_attr( $style );
		} else {
			$style = "";
		}

		if( !empty( $shadow_title ) ) {
			$shadow_active = " shadow-active";
		} else {
			$shadow_active = "";
		}

		if( !empty( $title ) or !empty( $text ) or !empty( $shadow_title ) ) {
			$output = '<div class="wikilogy-title' . $style . $shadow_active . '">';
				if( !empty( $shadow_title ) ) {
					$output .= '<div class="shadow-title">' . $shadow_title . '</div>';
				}

				if( !empty( $text ) or !empty( $title ) ) {
					$output .= '<div class="title-text">';
						if( !empty( $text ) ) {
							$output .= '<div class="text">' . $text . '</div>';
						}

						if( !empty( $title ) ) {
							$output .= '<div class="title">' . $title . '</div>';
						}
					$output .= '</div>';
				}
			$output .= '</div>';

			return $output;
		}
	}

	function wikilogy_content_alternative_title( $text = "" ) {
		echo '<span class="content-alternative-wrapper-title">' . $text . '</span>';
	}



	/*======
	*
	* Sidebars
	*
	======*/
	if( !function_exists( 'wikilogy_sidebars_init' ) ) {
		function wikilogy_sidebars_init() {
			register_sidebar(array(
				'id' => 'general-sidebar',
				'name' => esc_html__( 'General Sidebar', 'wikilogy' ),
				'before_widget' => '<div id="%1$s" class="general-sidebar-wrap widget-box %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-title">',
				'after_title' => '</div>',
			));

			register_sidebar(array(
				'id' => 'header-sidebar',
				'name' => esc_html__( 'Header Sidebar', 'wikilogy' ),
				'before_widget' => '<div id="%1$s" class="general-sidebar-wrap widget-box %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-title">',
				'after_title' => '</div>',
			));

			register_sidebar(array(
				'id' => 'home-sidebar',
				'name' => esc_html__( 'Homepage Sidebar', 'wikilogy' ),
				'before_widget' => '<div id="%1$s" class="general-sidebar-wrap widget-box %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-title">',
				'after_title' => '</div>',
			));
		}
	}
	add_action( 'widgets_init', 'wikilogy_sidebars_init' );



	/*======
	*
	* Sidebar & Wrapper Layouts
	*
	======*/
	function wikilogy_content_area_before() {
		if( is_category() ) {
			$cat = get_queried_object();
			$cat_id = $cat->term_id;
			$wikilogy_category_sidebar_style = get_term_meta( $cat_id, 'wikilogy_category_sidebar_style', true );
			if( !empty( $wikilogy_category_sidebar_style ) ) {
				$sidebar_position = get_term_meta( $cat_id, 'wikilogy_category_sidebar_style', true );
			} else {
				$sidebar_position = ot_get_option('category_sidebar_position');
			}
		} elseif( is_tag() ) {
			$sidebar_position = ot_get_option('tag_sidebar_position');
		} elseif( is_author() ) {
			$sidebar_position = ot_get_option('author_sidebar_position');
		} elseif( is_search() ) {
			$sidebar_position = ot_get_option('search_sidebar_position');
		} elseif( is_archive() ) {
			$sidebar_position = ot_get_option('archive_sidebar_position');
		} elseif( is_attachment() ) {
			$sidebar_position = ot_get_option('attachment_sidebar_position');
		} elseif( get_post_type( get_the_ID() ) == 'content' ) {
			$sidebar_position = ot_get_option('content_sidebar_position');
		} elseif( is_single() ) {
			$sidebar_position = ot_get_option('post_sidebar_position');
		} elseif( is_page() ) {
			$sidebar_position = ot_get_option('page_sidebar_position');
		} else {
			$sidebar_position = ot_get_option( 'sidebar_position' );
		}
		
		if ( is_page() or is_single() ) {
			global $post;
			$post_id = $post->ID;
			$sidebar_position_control = get_post_meta( $post_id, 'sidebar_position', true );
			if( !empty( $sidebar_position_control ) ) {
				$sidebar_position = get_post_meta( $post->ID, 'sidebar_position', true );
			}
		}
		
		if( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fullwidthsidebar">';
		}
		
		elseif( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 site-content-right site-content-left pull-right fixed-sidebar">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 site-content-left fixed-sidebar">';
		}
		
		else {
			echo '<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 site-content-left fixed-sidebar">';
		}
	}

	function wikilogy_sidebar_before() {
		if( is_category() ) {
			$cat = get_queried_object();
			$cat_id = $cat->term_id;
			$wikilogy_category_sidebar_style = get_term_meta( $cat_id, 'wikilogy_category_sidebar_style', true );
			if( !empty( $wikilogy_category_sidebar_style ) ) {
				$sidebar_position = get_term_meta( $cat_id, 'wikilogy_category_sidebar_style', true );
			} else {
				$sidebar_position = ot_get_option('category_sidebar_position');
			}
		} elseif( is_tag() ) {
			$sidebar_position = ot_get_option('tag_sidebar_position');
		} elseif( is_author() ) {
			$sidebar_position = ot_get_option('author_sidebar_position');
		} elseif( is_search() ) {
			$sidebar_position = ot_get_option('search_sidebar_position');
		} elseif( is_archive() ) {
			$sidebar_position = ot_get_option('archive_sidebar_position');
		} elseif( is_attachment() ) {
			$sidebar_position = ot_get_option('attachment_sidebar_position');
		} elseif( get_post_type( get_the_ID() ) == 'content' ) {
			$sidebar_position = ot_get_option('content_sidebar_position');
		} elseif( is_single() ) {
			$sidebar_position = ot_get_option('post_sidebar_position');
		} elseif( is_page() ) {
			$sidebar_position = ot_get_option('page_sidebar_position');
		} else {
			$sidebar_position = ot_get_option( 'sidebar_position' );
		}

		if ( is_page() or is_single() ) {
			global $post;
			$sidebar_position_control = get_post_meta( $post->ID, 'sidebar_position', true );
			if( !empty( $sidebar_position_control ) ) {
				$sidebar_position = get_post_meta( $post->ID, 'sidebar_position', true );
			}
		}
		
		if( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hide fixed-sidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 site-content-right left fixed-sidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 site-content-right right fixed-sidebar"><div class="theiaStickySidebar">';
		}
		
		else {
			echo '<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 site-content-right fixed-sidebar"><div class="theiaStickySidebar">';
		}
	}

	function wikilogy_content_area_after() {
		echo '</div>';
	}

	function wikilogy_sidebar_after() {
		echo '</div></div>';
	}



	/*======
	*
	* Theme Wrapper
	*
	======*/
	function wikilogy_wrapper_before() {
		$wikilogy_boxed = ot_get_option('wikilogy_boxed');
		if( $wikilogy_boxed == "on" ) {
			$boxed = "boxed-true";
		} else {
			$boxed = "boxed-false";
		}
		echo '<div class="wikilogy-wrapper ' . esc_attr( $boxed ) . '" id="general-wrapper">';
	}
	function wikilogy_wrapper_after() {
		echo '</div>';
	}



	/*======
	*
	* Theme Content Wrapper
	*
	======*/
	function wikilogy_content_before() {
		echo '<div class="site-content">';
	}

	function wikilogy_content_after() {
		echo '</div>';
	}



	/*======
	*
	* Theme Sub Content Wrapper
	*
	======*/
	function wikilogy_sub_content_before() {
		echo '<div class="site-sub-content">';
	}

	function wikilogy_sub_content_after() {
		echo '</div>';
	}



	/*======
	*
	* Widget Wrapper
	*
	======*/
	function wikilogy_widget_before() {
		echo '<div class="widget-content">';
	}

	function wikilogy_widget_after() {
		echo '</div>';
	}



	/*======
	*
	* Page Content Wrapper
	*
	======*/
	function wikilogy_page_content_before() {
		echo '<div class="site-page-content">';
	}

	function wikilogy_page_content_after() {
		echo '</div>';
	}



	/*======
	*
	* Layout Row Wrapper
	*
	======*/
	function wikilogy_layout_row_before() {
		if( is_category() ) {
			$cat = get_queried_object();
			$cat_id = $cat->term_id;
			$wikilogy_category_sidebar_style = get_term_meta( $cat_id, 'wikilogy_category_sidebar_style', true );
			if( !empty( $wikilogy_category_sidebar_style ) ) {
				$sidebar_position = get_term_meta( $cat_id, 'wikilogy_category_sidebar_style', true );
			} else {
				$sidebar_position = ot_get_option('category_sidebar_position');
			}
		} elseif( is_tag() ) {
			$sidebar_position = ot_get_option('tag_sidebar_position');
		} elseif( is_author() ) {
			$sidebar_position = ot_get_option('author_sidebar_position');
		} elseif( is_search() ) {
			$sidebar_position = ot_get_option('search_sidebar_position');
		} elseif( is_archive() ) {
			$sidebar_position = ot_get_option('archive_sidebar_position');
		} elseif( is_attachment() ) {
			$sidebar_position = ot_get_option('attachment_sidebar_position');
		} elseif( get_post_type( get_the_ID() ) == 'content' ) {
			$sidebar_position = ot_get_option('content_sidebar_position');
		} elseif( is_single() ) {
			$sidebar_position = ot_get_option('post_sidebar_position');
		} elseif( is_page() ) {
			$sidebar_position = ot_get_option('page_sidebar_position');
		} else {
			$sidebar_position = ot_get_option( 'sidebar_position' );
		}

		if ( is_page() or is_single() ) {
			global $post;
			$sidebar_position = get_post_meta( $post->ID, 'sidebar_position', true );
			if( !empty( $sidebar_position ) ) {
				$sidebar_position = get_post_meta( $post->ID, 'sidebar_position', true );
			}
		}

		if( $sidebar_position == 'left' ) {
			$extra_class = ' flex-row-reverse';
		} else {
			$extra_class = "";
		}

		echo '<div class="row' . $extra_class . '">';
	}



	/*======
	*
	* Row Wrapper
	*
	======*/
	function wikilogy_row_before( $extra_class = "" ) {
		if( !empty( $extra_class ) ) {
			$extra_class = ' ' . $extra_class;
		}
		echo '<div class="row' . $extra_class . '">';
	}
	function wikilogy_row_after() {
		echo '</div>';
	}



	/*======
	*
	* Container Wrapper
	*
	======*/
	function wikilogy_container_before( $extra_class = "" ) {
		if( !empty( $extra_class ) ) {
			$extra_class = ' ' . $extra_class;
		}
		echo '<div class="container' . $extra_class . '">';
	}

	function wikilogy_container_after() {
		echo '</div>';
	}



	/*======
	*
	* Fluid Container Wrapper
	*
	======*/
	function wikilogy_fluid_container_before( $extra_class = "" ) {
		if( !empty( $extra_class ) ) {
			$extra_class = ' ' . $extra_class;
		}
		echo '<div class="fluid-container' . $extra_class . '">';
	}

	function wikilogy_fluid_container_after() {
		echo '</div>';
	}