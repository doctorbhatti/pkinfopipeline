<?php
	/*======
	*
	* Theme Options
	*
	======*/
	function wikilogy_theme_options() {
		if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
		return false;

		$saved_settings = get_option( ot_settings_id(), array() );
		
		$custom_settings = array(
			'contextual_help' => array(
				'content' => array(
					array(
						'id' => 'option_types_help',
						'title' => esc_html__( 'Header Settings', 'wikilogy' ),
						'content' => '<p>' . esc_html__( 'Help content goes here!', 'wikilogy' ) . '</p>'
					)
				),
				'sidebar' => '<p>' . esc_html__( 'Sidebar content goes here!', 'wikilogy' ) . '</p>'
			),
			
			'sections' => array(
				array(
					'title' => '<span class="dashicons dashicons-admin-site"></span>' . esc_html__( 'General', 'wikilogy' ),
					'id' => 'general'
				),
				array(
					'title' => '<span class="dashicons dashicons-editor-kitchensink"></span>' . esc_html__( 'Header', 'wikilogy' ),
					'id' => 'header'
				),
				array(
					'title' => '<span class="dashicons dashicons-image-rotate-left"></span>' . esc_html__( 'Footer', 'wikilogy' ),
					'id' => 'footer'
				),
				array(
					'title' => '<span class="dashicons dashicons-admin-appearance"></span>' . esc_html__( 'Color', 'wikilogy' ),
					'id' => 'colors'
				),
				array(
					'title' => '<span class="dashicons dashicons-editor-justify"></span>' . esc_html__( 'Typography', 'wikilogy' ),
					'id' => 'fonts'
				),
				array(
					'title' => '<span class="dashicons dashicons-list-view"></span>' . esc_html__( 'Contents', 'wikilogy' ),
					'id' => 'contents'
				),
				array(
					'title' => '<span class="dashicons dashicons-media-text"></span>' . esc_html__( 'Posts', 'wikilogy' ),
					'id' => 'posts'
				),
				array(
					'title' => '<span class="dashicons dashicons-admin-page"></span>' . esc_html__( 'Pages', 'wikilogy' ),
					'id' => 'pages'
				),
				array(
					'title' => '<span class="dashicons dashicons-admin-tools"></span>' . esc_html__( 'Toolbar', 'wikilogy' ),
					'id' => 'toolbar'
				),
				array(
					'title' => '<span class="dashicons dashicons-archive"></span>' . esc_html__( 'Archives', 'wikilogy' ),
					'id' => 'archives'
				),
				array(
					'title' => '<span class="dashicons dashicons-share"></span>' . esc_html__( 'Social Media', 'wikilogy' ),
					'id' => 'socialmedia'
				),
			),

			'settings' => array(
				/*====== General ======*/
				array(
					'label' => esc_html__( 'General', 'wikilogy' ),
					'id' => 'general_tab1',
					'type' => 'tab',
					'section' => 'general'
				),
					array(
						'label' => esc_html__( 'General Sidebar Position', 'wikilogy' ),
						'id' => 'sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select general sidebar position.', 'wikilogy' ),
						'std' => 'nosidebar',
						'section' => 'general'
					),
					array(
						'label' => esc_html__( 'Loader Status', 'wikilogy' ),
						'id' => 'wikilogy_loader',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can select loader status.', 'wikilogy' ),
						'std' => 'off',
						'section' => 'general'
					),
					array(
						'label' => esc_html__( 'Loader Style', 'wikilogy' ),
						'id' => 'loader_style',
						'type' => 'radio',
						'desc' => esc_html__( 'You can select style for loader.', 'wikilogy' ),
						'std' => 'style1',
						'section' => 'general',
						'condition' => 'wikilogy_loader:is(on)',
						'choices' => array(
							array(
								'label' => esc_html__( 'Style 1', 'wikilogy' ),
								'value' => 'style1'
							),
							array(
								'label' => esc_html__( 'Style 2', 'wikilogy' ),
								'value' => 'style2'
							),
							array(
								'label' => esc_html__( 'Style 3', 'wikilogy' ),
								'value' => 'style3'
							),
							array(
								'label' => esc_html__( 'Style 4', 'wikilogy' ),
								'value' => 'style4'
							),
						),
					),
					array(
						'label' => esc_html__( 'Boxed Layout', 'wikilogy' ),
						'id' => 'wikilogy_boxed',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can select boxed layout.', 'wikilogy' ),
						'std' => 'off',
						'section' => 'general'
					),
					array(
						'id' => 'default_title_style',
						'label' => esc_html__( 'Default Title Style', 'wikilogy' ),
						'type' => 'radio',
						'std' => '1',
						'desc' => esc_html__( 'You can select default title style.', 'wikilogy' ),
						'choices' => array(
							array(
								'label' => esc_html__( 'Style 1', 'wikilogy' ),
								'value' => '1'
							),
							array(
								'label' => esc_html__( 'Style 2', 'wikilogy' ),
								'value' => '2'
							),
							array(
								'label' => esc_html__( 'Style 3', 'wikilogy' ),
								'value' => '3'
							),
						),
						'section' => 'general'
					),
				array(
					'label' => esc_html__( 'Create Sidebar', 'wikilogy' ),
					'id' => 'general_tab4',
					'type' => 'tab',
					'section' => 'general'
				),
					array(
						'id' => 'custom_sidebars',
						'desc' => '',
						'label' => esc_html__('Create Sidebar','wikilogy'),
						'type' => 'list-item',
						'section' => 'general',
						'settings' => array(
							array(
								'label' => esc_html__('ID','wikilogy'),
								'id' => 'id',
								'type' => 'text',
								'desc' => esc_html__('Please write a lowercase id, with <strong>no spaces</strong>','wikilogy'),
							)
						)
					),

				/*====== Header ======*/
				array(
					'label' => esc_html__( 'Header Status', 'wikilogy' ),
					'id' => 'hide_header',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide header.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'header'
				),
				array(
					'label' => esc_html__( 'General Header Style', 'wikilogy' ),
					'id' => 'default_header_style',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select general header style.', 'wikilogy' ),
					'std' => 'header-style-1',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Logo', 'wikilogy' ),
					'id' => 'wikilogy_logo',
					'type' => 'upload',
					'desc' => esc_html__( 'You can upload site logo for header.', 'wikilogy' ),
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Alternative Logo', 'wikilogy' ),
					'id' => 'wikilogy_logo_alternative',
					'type' => 'upload',
					'desc' => esc_html__( 'You can upload alternative site logo for header.', 'wikilogy' ),
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Logo Height', 'wikilogy' ),
					'id' => 'logo_height',
					'type' => 'measurement',
					'desc' => esc_html__( 'You can enter logo height for header. Recommended type px.', 'wikilogy' ),
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Logo Weight', 'wikilogy' ),
					'id' => 'logo_width',
					'type' => 'measurement',
					'desc' => esc_html__( 'You can enter logo weight for header. Recommended type px.', 'wikilogy' ),
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Fixed Header', 'wikilogy' ),
					'id' => 'header_fixed',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can make fixed header.', 'wikilogy' ),
					'std' => 'off',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Social Media', 'wikilogy' ),
					'id' => 'header_social_media',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide social links from header.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Search', 'wikilogy' ),
					'id' => 'header_search',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide search form from header.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Search from Home', 'wikilogy' ),
					'id' => 'header_home_search',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide search form from home header.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Language Selector', 'wikilogy' ),
					'id' => 'header_language',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide language selector from header.', 'wikilogy' ),
					'std' => 'off',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Language Selector Shortcode', 'wikilogy' ),
					'id' => 'header_language_shortcode',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter your language plugin shortcode.', 'wikilogy' ),
					'section' => 'header',
					'condition' => 'hide_header:is(on),header_language:is(on)'
				),
				array(
					'label' => esc_html__( 'User Box', 'wikilogy' ),
					'id' => 'header_user_box',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide user box for header.', 'wikilogy' ),
					'std' => 'off',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Sidebar', 'wikilogy' ),
					'id' => 'header_sidebar',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide sidebar from header.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Sidebar Logo', 'wikilogy' ),
					'id' => 'header_sidebar_logo',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide logo from sidebar header.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'header',
					'condition' => 'hide_header:is(on),header_sidebar:is(on)'
				),
				array(
					'label' => esc_html__( 'Sidebar Menu', 'wikilogy' ),
					'id' => 'header_sidebar_menu',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide menu from sidebar header.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'header',
					'condition' => 'hide_header:is(on),header_sidebar:is(on)'
				),
				array(
					'label' => esc_html__( 'Sidebar Social Links', 'wikilogy' ),
					'id' => 'header_sidebar_social_links',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide social links from sidebar header.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'header',
					'condition' => 'hide_header:is(on),header_sidebar:is(on)'
				),

				/*====== Footer ======*/
				array(
					'label' => esc_html__( 'Footer Status', 'wikilogy' ),
					'id' => 'hide_footer',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide footer.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'footer'
				),
				array(
					'label' => esc_html__( 'General Footer Style', 'wikilogy' ),
					'id' => 'default_footer_style',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select general footer style.', 'wikilogy' ),
					'std' => 'footer-style-1',
					'section' => 'footer',
					'condition' => 'hide_footer:is(on)'
				),
				array(
					'label' => esc_html__( 'Footer Content Page', 'wikilogy' ),
					'id' => 'page_footer',
					'type' => 'page-select',
					'desc' => esc_html__( 'You can select content page for footer.', 'wikilogy' ),
					'section' => 'footer',
					'condition' => 'hide_footer:is(on)'
				),
				array(
					'label' => esc_html__( 'Copyright Text', 'wikilogy' ),
					'id' => 'footer_copyright_text',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter copyright text.', 'wikilogy' ),
					'section' => 'footer',
					'condition' => 'hide_footer:is(on)'
				),
				array(
					'label' => esc_html__( 'Logo for Copyright', 'wikilogy' ),
					'id' => 'hide_footer_logo',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide copyright logo.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'footer'
				),
				array(
					'label' => esc_html__( 'Logo Upload for Copyright', 'wikilogy' ),
					'id' => 'wikilogy_footer_logo',
					'type' => 'upload',
					'desc' => esc_html__( 'You can upload logo for copyright.', 'wikilogy' ),
					'section' => 'footer',
					'condition' => 'hide_footer:is(on),hide_footer_logo:is(on)'
				),
				array(
					'label' => esc_html__( 'Ads for Footer Style 2', 'wikilogy' ),
					'id' => 'footer_style_2_ads',
					'type' => 'textarea',
					'desc' => esc_html__( 'You can enter ads code for footer style 2.', 'wikilogy' ),
					'section' => 'footer',
					'condition' => 'hide_footer:is(on)'
				),
				array(
					'label' => esc_html__( 'Menu for Footer Style 2', 'wikilogy' ),
					'id' => 'hide_footer_style_2_menu',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide footer style 2 menu.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'footer'
				),
				array(
					'label' => esc_html__( 'Social Links for Footer Style 3', 'wikilogy' ),
					'id' => 'hide_footer_style_3_social',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide social links for footer style 3.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'footer'
				),

				/*====== Colors ======*/
				array(
					'label' => esc_html__( 'General', 'wikilogy' ),
					'id' => 'colors_tab1',
					'type' => 'tab',
					'section' => 'colors'
				),
					array(
						'label' => esc_html__( 'Body Background ', 'wikilogy' ),
						'id' => 'body_background',
						'type' => 'background',
						'desc' => esc_html__( 'This is body background of site.', 'wikilogy' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Wrapper Background', 'wikilogy' ),
						'id' => 'wrapper_background',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is wrapper background color of site.', 'wikilogy' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Theme Main Color', 'wikilogy' ),
						'id' => 'theme_main_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is main color one of site. By setting a color here, all of your elements will use this color instead of default blue color.', 'wikilogy' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Link Color', 'wikilogy' ),
						'id' => 'link_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is link color of site.', 'wikilogy' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Link Hover Color', 'wikilogy' ),
						'id' => 'link_hover_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is link hover color of site.', 'wikilogy' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Heading Color', 'wikilogy' ),
						'id' => 'heading_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is heading(h1, h2, h3, h4, h5 and h6) color of site.', 'wikilogy' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Input Border Color', 'wikilogy' ),
						'id' => 'input_border_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is input border color of site.', 'wikilogy' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Input Background Color', 'wikilogy' ),
						'id' => 'input_background_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is input background color of site.', 'wikilogy' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Input Placeholder Color', 'wikilogy' ),
						'id' => 'input_placeholder_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is input placeholder color of site.', 'wikilogy' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Button Background Color', 'wikilogy' ),
						'id' => 'button_background_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is button background color of site.', 'wikilogy' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Button Hover Background Color', 'wikilogy' ),
						'id' => 'button_hover_background_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is button hover background color of site.', 'wikilogy' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Button Hover Text Color', 'wikilogy' ),
						'id' => 'button_hover_text_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is button hover text color of site.', 'wikilogy' ),
						'section' => 'colors'
					),
				
				/*====== Typography ======*/
				array(
					'label' => esc_html__( 'General', 'wikilogy' ),
					'id' => 'fonts_tab1',
					'type' => 'tab',
					'section' => 'fonts'
				),
					array(
						'label'       => esc_html__('Latin Extended', 'wikilogy'),
						'id'          => 'font_subsets_latin',
						'type'        => 'on_off',
						'desc'        =>  esc_html__( 'You can select character status for Latin Extended.', 'wikilogy' ),
						'section'     => 'fonts',
						'std'     => 'off'
					),
					array(
						'label'       => esc_html__('Cyrillic Extended', 'wikilogy'),
						'id'          => 'font_subsets_cyrillic',
						'type'        => 'on_off',
						'desc'        =>  esc_html__( 'You can select character status for Cyrillic.', 'wikilogy' ),
						'section'     => 'fonts',
						'std'     => 'off'
					),
					array(
						'label'       => esc_html__('Greek Extended', 'wikilogy'),
						'id'          => 'font_subsets_greek',
						'type'        => 'on_off',
						'desc'        =>  esc_html__( 'You can select character status for Greek language.', 'wikilogy' ),
						'section'     => 'fonts',
						'std'     => 'off'
					),
					array(
						'label' => esc_html__( 'Theme Main One Font', 'wikilogy' ),
						'id' => 'theme_one_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select one font of theme.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Theme Main Two Font', 'wikilogy' ),
						'id' => 'theme_two_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select two font of theme.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Body', 'wikilogy' ),
						'id' => 'body_text',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font of body.', 'wikilogy' ),
						'section' => 'fonts',
						'std' => '',
					),
					array(
						'label' => esc_html__( 'H1', 'wikilogy' ),
						'id' => 'h1_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h1.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'H2', 'wikilogy' ),
						'id' => 'h2_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h2.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'H3', 'wikilogy' ),
						'id' => 'h3_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h3.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'H4', 'wikilogy' ),
						'id' => 'h4_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h4.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'H5', 'wikilogy' ),
						'id' => 'h5_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h5.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'H6', 'wikilogy' ),
						'id' => 'h6_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h6.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Input Font', 'wikilogy' ),
						'id' => 'input_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for inputs.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Input Placeholder Font', 'wikilogy' ),
						'id' => 'input_placeholder_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for input placeholder.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Button Font', 'wikilogy' ),
						'id' => 'button_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for button.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Post Content Font', 'wikilogy' ),
						'id' => 'post_posts_content_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font content.', 'wikilogy' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Page Content Font', 'wikilogy' ),
						'id' => 'page_content_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font of page content.', 'wikilogy' ),
						'section' => 'fonts'
					),

				/*====== Contents ======*/
				array(
					'label' => esc_html__( 'General Content Sidebar Position', 'wikilogy' ),
					'id' => 'content_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select general sidebar position.', 'wikilogy' ),
					'std' => 'right',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'General Content Sidebar Select', 'wikilogy' ),
					'id' => 'content_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select general sidebar.', 'wikilogy' ),
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Content Information', 'wikilogy' ),
					'id' => 'content_information',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide content information.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Content Image', 'wikilogy' ),
					'id' => 'content_image',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide content image.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Share Buttons', 'wikilogy' ),
					'id' => 'content_share_buttons',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide content share buttons.', 'wikilogy' ),
					'std' => 'off',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Categories', 'wikilogy' ),
					'id' => 'content_categories',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide content categories.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Tags', 'wikilogy' ),
					'id' => 'content_tags',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide content tags.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Content Title', 'wikilogy' ),
					'id' => 'content_title',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide content title.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'contents'
				),
				array(
					'id' => 'content_title_style',
					'label' => esc_html__( 'Title Style', 'wikilogy' ),
					'type' => 'radio',
					'condition' => 'content_title:is(on)',
					'std' => '1',
					'desc' => esc_html__( 'You can select title style.', 'wikilogy' ),
					'choices' => array(
						array(
							'label' => esc_html__( 'Style 1', 'wikilogy' ),
							'value' => '1'
						),
						array(
							'label' => esc_html__( 'Style 2', 'wikilogy' ),
							'value' => '2'
						),
						array(
							'label' => esc_html__( 'Style 3', 'wikilogy' ),
							'value' => '3'
						),
					),
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Content Title Text', 'wikilogy' ),
					'id' => 'content_title_text',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide content title text.', 'wikilogy' ),
					'std' => 'on',
					'condition' => 'content_title:is(on)',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Author Biography', 'wikilogy' ),
					'id' => 'content_author_biography',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide author biography.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Related Contents', 'wikilogy' ),
					'id' => 'content_related_contents',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide related contents.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Related Contents Column', 'wikilogy' ),
					'id' => 'content_related_contents_column',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter related contents column.', 'wikilogy' ),
					'condition' => 'content_related_contents:is(on)',
					'std' => '4',
					'min_max_step'=> '2,6,1',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Suggested Contents', 'wikilogy' ),
					'id' => 'content_suggested_contents',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide suggested contents.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Suggested Contents Column', 'wikilogy' ),
					'id' => 'content_suggested_contents_column',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter suggested contents column.', 'wikilogy' ),
					'condition' => 'content_suggested_contents:is(on)',
					'std' => '3',
					'min_max_step'=> '2,4,1',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Comment Area', 'wikilogy' ),
					'id' => 'content_comment_area',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide comment area.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'contents'
				),
				array(
					'label' => esc_html__( 'Toolbar', 'wikilogy' ),
					'id' => 'content_toolbar',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide toolbar.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'contents'
				),

				/*====== Posts ======*/
				array(
					'label' => esc_html__( 'General Post Sidebar Position', 'wikilogy' ),
					'id' => 'post_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select general sidebar position.', 'wikilogy' ),
					'std' => 'right',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'General Post Sidebar Select', 'wikilogy' ),
					'id' => 'post_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select general sidebar.', 'wikilogy' ),
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Post Information', 'wikilogy' ),
					'id' => 'post_information',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post information.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Post Image', 'wikilogy' ),
					'id' => 'post_image',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post image.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Share Buttons', 'wikilogy' ),
					'id' => 'post_share_buttons',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post share buttons.', 'wikilogy' ),
					'std' => 'off',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Tags', 'wikilogy' ),
					'id' => 'post_tags',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post tags.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Post Title', 'wikilogy' ),
					'id' => 'post_title',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post title.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'id' => 'post_title_style',
					'label' => esc_html__( 'Title Style', 'wikilogy' ),
					'type' => 'radio',
					'condition' => 'post_title:is(on)',
					'std' => '1',
					'desc' => esc_html__( 'You can select title style.', 'wikilogy' ),
					'choices' => array(
						array(
							'label' => esc_html__( 'Style 1', 'wikilogy' ),
							'value' => '1'
						),
						array(
							'label' => esc_html__( 'Style 2', 'wikilogy' ),
							'value' => '2'
						),
						array(
							'label' => esc_html__( 'Style 3', 'wikilogy' ),
							'value' => '3'
						),
					),
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Post Title Text', 'wikilogy' ),
					'id' => 'post_title_text',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post title text.', 'wikilogy' ),
					'std' => 'on',
					'condition' => 'post_title:is(on)',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Author Biography', 'wikilogy' ),
					'id' => 'post_author_biography',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide author biography.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Related Posts', 'wikilogy' ),
					'id' => 'post_related_posts',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide related posts.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Related Posts Column', 'wikilogy' ),
					'id' => 'post_related_posts_column',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter related posts column.', 'wikilogy' ),
					'condition' => 'post_related_posts:is(on)',
					'std' => '4',
					'min_max_step'=> '2,6,1',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Suggested Posts', 'wikilogy' ),
					'id' => 'post_suggested_posts',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide suggested posts.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Suggested Posts Column', 'wikilogy' ),
					'id' => 'post_suggested_posts_column',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter suggested posts column.', 'wikilogy' ),
					'condition' => 'post_suggested_posts:is(on)',
					'std' => '3',
					'min_max_step'=> '2,4,1',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Comment Area', 'wikilogy' ),
					'id' => 'post_comment_area',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide comment area.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Toolbar', 'wikilogy' ),
					'id' => 'post_toolbar',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide toolbar.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'posts'
				),

				/*====== Pages ======*/
				array(
					'label' => esc_html__( 'General Page Sidebar Position', 'wikilogy' ),
					'id' => 'page_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select general sidebar position of page.', 'wikilogy' ),
					'std' => 'nosidebar',
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'General Page Sidebar Select', 'wikilogy' ),
					'id' => 'page_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select sidebar of page.', 'wikilogy' ),
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'Page Title', 'wikilogy' ),
					'id' => 'page_title',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide page title of page.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'pages'
				),
				array(
					'id' => 'page_title_style',
					'label' => esc_html__( 'Title Style', 'wikilogy' ),
					'type' => 'radio',
					'condition' => 'page_title:is(on)',
					'std' => '1',
					'desc' => esc_html__( 'You can select title style.', 'wikilogy' ),
					'choices' => array(
						array(
							'label' => esc_html__( 'Style 1', 'wikilogy' ),
							'value' => '1'
						),
						array(
							'label' => esc_html__( 'Style 2', 'wikilogy' ),
							'value' => '2'
						),
						array(
							'label' => esc_html__( 'Style 3', 'wikilogy' ),
							'value' => '3'
						),
					),
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'Page Title Text', 'wikilogy' ),
					'id' => 'page_title_text',
					'condition' => 'page_title:is(on)',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide page title text..', 'wikilogy' ),
					'std' => 'on',
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'Comment Area', 'wikilogy' ),
					'id' => 'page_comment_area',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide comment area on pages.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'Terms and Conditions Page', 'wikilogy' ),
					'id' => 'page_terms_and_conditions',
					'type' => 'page-select',
					'desc' => esc_html__( 'You can select page for terms and conditions.', 'wikilogy' ),
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'Privacy Policy Page', 'wikilogy' ),
					'id' => 'page_privacy_policy',
					'type' => 'page-select',
					'desc' => esc_html__( 'You can select page for privacy policy.', 'wikilogy' ),
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'Search Form for 404 Page', 'wikilogy' ),
					'id' => 'page_404_search',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide search form in 404 page.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'Search for 404 Page', 'wikilogy' ),
					'id' => 'page_404_text',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide text in 404 page.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'pages'
				),

				/*====== Toolbar ======*/
				array(
					'label' => esc_html__( 'Comments', 'wikilogy' ),
					'id' => 'toolbar_comments',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide comment button on toolbar.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'toolbar'
				),
				array(
					'label' => esc_html__( 'Print', 'wikilogy' ),
					'id' => 'toolbar_print',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide print button on toolbar.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'toolbar'
				),
				array(
					'label' => esc_html__( 'Edit', 'wikilogy' ),
					'id' => 'toolbar_edit',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide edit button on toolbar.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'toolbar'
				),
				array(
					'label' => esc_html__( 'Share', 'wikilogy' ),
					'id' => 'toolbar_share',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide share buttons on toolbar.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'toolbar'
				),
				array(
					'label' => esc_html__( 'Font Selector', 'wikilogy' ),
					'id' => 'toolbar_font_selector',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can font selector button on toolbar.', 'wikilogy' ),
					'std' => 'on',
					'section' => 'toolbar'
				),
				array(
					'id' => 'toolbar_custom_links',
					'desc' => esc_html__( 'You can create custom links for the toolbar.', 'wikilogy' ),
					'label' => esc_html__( 'Custom Toolbar Links', 'wikilogy' ),
					'type' => 'list-item',
					'section' => 'toolbar',
					'settings' => array(
						array(
							'label' => esc_html__( 'Link', 'wikilogy' ),
							'id' => 'toolbar-link',
							'type' => 'text',
							'desc' => esc_html__( 'You can enter a link.', 'wikilogy' ),
						),
						array(
							'id' => 'toolbar-target',
							'label' => esc_html__( 'Link Target', 'wikilogy' ),
							'type' => 'radio',
							'desc' => esc_html__( 'You can select target style. Default: Self.', 'wikilogy' ),
							'std' => '_self',
							'choices' => array(
								array(
									'label' => esc_html__( 'Blank', 'wikilogy' ),
									'value' => '_blank',
								),
								array(
									'label' => esc_html__( 'Self', 'wikilogy' ),
									'value' => '_self',
								),
							),
						),
						array(
							'label' => esc_html__( 'Icon', 'wikilogy' ),
							'id' => 'toolbar-icon',
							'type' => 'text',
							'desc' => esc_html__( 'You can enter a link icon. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'wikilogy' ),
						),
					)
				),

				/*====== Archives ======*/
				array(
					'label' => esc_html__( 'Category', 'wikilogy' ),
					'id' => 'blog_tab1',
					'type' => 'tab',
					'section' => 'archives'
				),
					array(
						'label' => esc_html__( 'General Category Sidebar Position', 'wikilogy' ),
						'id' => 'category_sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select general sidebar position of category.', 'wikilogy' ),
						'std' => 'right',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'General Category Post List Style', 'wikilogy' ),
						'id' => 'blog_category_post_list_style',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select general post list style of category.', 'wikilogy' ),
						'std' => 'style1',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'General Category Title', 'wikilogy' ),
						'id' => 'blog_category_title',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide title of category.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'archives'
					),
					array(
						'id' => 'sidebar_select',
						'desc' => '',
						'label' => esc_html__( 'Sidebar For Categories', 'wikilogy' ),
						'type' => 'sidebar_select_category',
						'section' => 'archives',
					),
				array(
					'label' => esc_html__( 'Tag', 'wikilogy' ),
					'id' => 'blog_tab3',
					'type' => 'tab',
					'section' => 'archives'
				),
					array(
						'label' => esc_html__( 'Sidebar Position for Tag Archive', 'wikilogy' ),
						'id' => 'tag_sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select general sidebar position of tag archive.', 'wikilogy' ),
						'std' => 'right',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Sidebar Select for Tag Archive', 'wikilogy' ),
						'id' => 'tag_sidebar_select',
						'type' => 'sidebar-select',
						'desc' => esc_html__( 'You can select sidebar of tag archive.', 'wikilogy' ),
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Post List Style for Tag Archive', 'wikilogy' ),
						'id' => 'tag_tag_post_list_style',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select tag post list style of tag archive.', 'wikilogy' ),
						'std' => 'style1',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Title for Tag Archive', 'wikilogy' ),
						'id' => 'tag_tag_title',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide tag title of tag archive.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'archives'
					),
				array(
					'label' => esc_html__( 'Search', 'wikilogy' ),
					'id' => 'blog_tab4',
					'type' => 'tab',
					'section' => 'archives'
				),
					array(
						'label' => esc_html__( 'Sidebar Position for Search', 'wikilogy' ),
						'id' => 'search_sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select sidebar position of search page.', 'wikilogy' ),
						'std' => 'right',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Sidebar Select for Search', 'wikilogy' ),
						'id' => 'search_sidebar_select',
						'type' => 'sidebar-select',
						'desc' => esc_html__( 'You can select sidebar of search page.', 'wikilogy' ),
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Post List Style for Search', 'wikilogy' ),
						'id' => 'search_search_post_list_style',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select post list style of search page.', 'wikilogy' ),
						'std' => 'style1',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Title for Search', 'wikilogy' ),
						'id' => 'search_search_title',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide search title of search page.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'archives'
					),
				array(
					'label' => esc_html__( 'Archive', 'wikilogy' ),
					'id' => 'blog_tab5',
					'type' => 'tab',
					'section' => 'archives'
				),
					array(
						'label' => esc_html__( 'Sidebar Position for Archives', 'wikilogy' ),
						'id' => 'archive_sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select sidebar position of archives.', 'wikilogy' ),
						'std' => 'right',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Sidebar Select for Archives', 'wikilogy' ),
						'id' => 'archive_sidebar_select',
						'type' => 'sidebar-select',
						'desc' => esc_html__( 'You can select sidebar of archives.', 'wikilogy' ),
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Post List Style for Archives', 'wikilogy' ),
						'id' => 'archive_archive_post_list_style',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select post list style of archives.', 'wikilogy' ),
						'std' => 'style1',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Title for Archives', 'wikilogy' ),
						'id' => 'archive_wikilogy_archive_title',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide title of archives.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'archives'
					),
				array(
					'label' => esc_html__( 'Attachment', 'wikilogy' ),
					'id' => 'blog_tab6',
					'type' => 'tab',
					'section' => 'archives'
				),
					array(
						'label' => esc_html__( 'Sidebar Position for Attachment', 'wikilogy' ),
						'id' => 'attachment_sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select general sidebar position of attachment page.', 'wikilogy' ),
						'std' => 'nosidebar',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Sidebar Select for Attachment', 'wikilogy' ),
						'id' => 'attachment_sidebar_select',
						'type' => 'sidebar-select',
						'desc' => esc_html__( 'You can select sidebar of attachment page.', 'wikilogy' ),
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Title for Attachment', 'wikilogy' ),
						'id' => 'attachment_attachment_title',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide attachment title of attachment page.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Social Share for Attachment', 'wikilogy' ),
						'id' => 'attachment_social_share',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide social share buttons of attachment page.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Comment Area for Attachment', 'wikilogy' ),
						'id' => 'attachment_comment_area',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide comment area of attachment page.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'archives'
					),

				/*====== Social Media ======*/
				array(
					'label' => esc_html__( 'Social Links', 'wikilogy' ),
					'id' => 'socialmedia_tab1',
					'type' => 'tab',
					'section' => 'socialmedia'
				),
					array(
						'label' => esc_html__( 'Facebook URL', 'wikilogy' ),
						'id' => 'social_media_facebook',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Facebook url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Twitter URL', 'wikilogy' ),
						'id' => 'social_media_twitter',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Twitter url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Google+ URL', 'wikilogy' ),
						'id' => 'social_media_googleplus',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Google+ url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Instagram URL', 'wikilogy' ),
						'id' => 'social_media_instagram',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Instagram url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'LinkedIn URL', 'wikilogy' ),
						'id' => 'social_media_linkedin',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter LinkedIn url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Vine URL', 'wikilogy' ),
						'id' => 'social_media_vine',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Vine url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Pinterest URL', 'wikilogy' ),
						'id' => 'social_media_pinterest',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Pinterest url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'YouTube URL', 'wikilogy' ),
						'id' => 'social_media_youtube',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter YouTube url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Behance URL', 'wikilogy' ),
						'id' => 'social_media_behance',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Behance url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'DeviantArt URL', 'wikilogy' ),
						'id' => 'social_media_deviantart',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter DeviantArt url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Digg URL', 'wikilogy' ),
						'id' => 'social_media_digg',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Digg url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Dribbble URL', 'wikilogy' ),
						'id' => 'social_media_dribbble',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Dribbble url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Flickr URL', 'wikilogy' ),
						'id' => 'social_media_flickr',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Flickr url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'GitHub URL', 'wikilogy' ),
						'id' => 'social_media_github',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter GitHub url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Last.fm URL', 'wikilogy' ),
						'id' => 'social_media_lastfm',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Last.fm url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Reddit URL', 'wikilogy' ),
						'id' => 'social_media_reddit',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Reddit url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'SoundCloud URL', 'wikilogy' ),
						'id' => 'social_media_soundcloud',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter SoundCloud url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Tumblr URL', 'wikilogy' ),
						'id' => 'social_media_tumblr',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Tumblr url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Vimeo URL', 'wikilogy' ),
						'id' => 'social_media_vimeo',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Vimeo url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'VK URL', 'wikilogy' ),
						'id' => 'social_media_vk',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter VK url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Medium URL', 'wikilogy' ),
						'id' => 'social_media_medium',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Medium url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Wikipedia URL', 'wikilogy' ),
						'id' => 'social_media_wikipedia',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Wikipedia url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Custom URL', 'wikilogy' ),
						'id' => 'social_media_custom',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter custom url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Custom URL', 'wikilogy' ),
						'id' => 'social_media_custom_2',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter custom url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'RSS URL', 'wikilogy' ),
						'id' => 'social_media_rss',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter RSS url.', 'wikilogy' ),
						'section' => 'socialmedia'
					),
				array(
					'label' => esc_html__( 'Social Share', 'wikilogy' ),
					'id' => 'socialmedia_tab2',
					'type' => 'tab',
					'section' => 'socialmedia'
				),
					array(
						'label' => esc_html__( 'General Post Share', 'wikilogy' ),
						'id' => 'hide_general_post_share',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide general post social share buttons.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Social Links For User Profile', 'wikilogy' ),
						'id' => 'user_profile_social_links',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide social links for user profile.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Facebook Share', 'wikilogy' ),
						'id' => 'social_share_facebook',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Facebook for social share.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Twitter Share', 'wikilogy' ),
						'id' => 'social_share_twitter',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Twitter for social share.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Google+ Share', 'wikilogy' ),
						'id' => 'social_share_googleplus',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Google+ for social share.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Linkedin Share', 'wikilogy' ),
						'id' => 'social_share_linkedin',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Linkedin for social share.', 'wikilogy' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Pinterest Share', 'wikilogy' ),
						'id' => 'social_share_pinterest',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Pinterest for social share.', 'wikilogy' ),
						'std' => 'off',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Reddit Share', 'wikilogy' ),
						'id' => 'social_share_reddit',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Reddit for social share.', 'wikilogy' ),
						'std' => 'off',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Delicious Share', 'wikilogy' ),
						'id' => 'social_share_delicious',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Delicious for social share.', 'wikilogy' ),
						'std' => 'off',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Stumbleupon Share', 'wikilogy' ),
						'id' => 'social_share_stumbleupon',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Stumbleupon for social share.', 'wikilogy' ),
						'std' => 'off',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Tumblr Share', 'wikilogy' ),
						'id' => 'social_share_tumblr',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Tumblr for social share.', 'wikilogy' ),
						'std' => 'off',
						'section' => 'socialmedia'
					),
			),
		);

		$custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

		if ( $saved_settings !== $custom_settings ) {
			update_option( ot_settings_id(), $custom_settings ); 
		}
		
		global $ot_has_wikilogy_theme_options;
		$ot_has_wikilogy_theme_options = true;
	}
	add_action( 'init', 'wikilogy_theme_options' );

	/*======
	*
	* Meta Boxes
	*
	======*/
	function wikilogy_meta_boxes() {
		/*====== Post Meta Boxes ======*/
		$post_meta_box = array(
			'id' => 'post_settings',
			'title' => esc_html__( 'Post Settings', 'wikilogy' ),
			'pages' => array( 'post' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'tab1-header-settings',
					'label' => esc_html__( 'Header Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'header_status',
						'label' => esc_html__( 'Header Status', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide header.', 'wikilogy' ),
					),
					array(
						'id' => 'header_style',
						'label'	=> esc_html__( 'Header Style', 'wikilogy' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select header style.', 'wikilogy' ),
						'condition' => 'header_status:is(on)',
					),
					array(
						'id' => 'header_gap',
						'label' => esc_html__( 'Header Gap', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can remove header gap.', 'wikilogy' ),
						'condition' => 'header_status:is(on)',
					),
					array(
						'id' => 'title_status',
						'label' => esc_html__( 'Title Status', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide title.', 'wikilogy' ),
					),
					array(
						'id' => 'title_text',
						'label' => esc_html__( 'Title Text', 'wikilogy' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter title text.', 'wikilogy' ),
						'condition' => 'title_status:is(on)',
					),
				array(
					'id' => 'tab2-layout-settings',
					'label' => esc_html__( 'Layout Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'sidebar_position',
						'label'	=> esc_html__( 'Sidebar Position', 'wikilogy' ),
						'desc' => esc_html__( 'You can select sidebar position.', 'wikilogy' ),
						'type' => 'radio-image',
					),
					array(
						'id' => 'sidebar_select',
						'label' => esc_html__( 'Sidebar', 'wikilogy' ),
						'desc' => esc_html__( 'You can select sidebar.', 'wikilogy' ),
						'type' => 'sidebar-select'
					),
					array(
						'id' => 'suggested_contents_list',
						'label' => esc_html__( 'Suggested Posts', 'wikilogy' ),
						'desc' => esc_html__( 'You can select posts for suggested contents block.', 'wikilogy' ),
						'type' => 'custom-post-type-checkbox',
						'post_type' => 'post',
					),
					array(
						'id' => 'full_with',
						'label' => esc_html__( 'Full Width', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'off',
						'desc' => esc_html__( 'You can make full width.', 'wikilogy' ),
					),
					array(
						'id' => 'toolbar_status',
						'label' => esc_html__( 'Toolbar', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide toolbar.', 'wikilogy' ),
					),
				array(
					'id' => 'tab3-featured-header',
					'label' => esc_html__( 'Featured Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'featured_header_status',
						'label' => esc_html__( 'Featured Header Status', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide featured header. If you want to use featured header, you should choose post format from Format.', 'wikilogy' ),
					),
					array(
						'id' => 'post_video_embed',
						'label' => esc_html__( 'Video Embed Code', 'wikilogy' ),
						'desc' => esc_html__( 'You can enter video embed code.', 'wikilogy' ) . esc_attr( '<br><i>' ) . esc_html__( 'Example:', 'wikilogy' ) . htmlspecialchars( ' &lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube-nocookie.com/embed/OYbXaqQ3uuo&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;' ) . esc_attr( '</i>' ),
						'type' => 'text',
						'condition' => 'featured_header_status:is(on)',
					),
					array(
						'id' => 'post_audio_embed',
						'label' => esc_html__( 'Audio Embed Code', 'wikilogy' ),
						'desc' => esc_html__( 'You can enter audio embed code.', 'wikilogy' ) . esc_attr( '<br><i>' ) . esc_html__( 'Example:', 'wikilogy' ) . htmlspecialchars( ' &lt;iframe width=&quot;100%&quot; height=&quot;450&quot; scrolling=&quot;no&quot; frameborder=&quot;no&quot; src=&quot;https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/90909412&amp;amp;auto_play=false&amp;amp;hide_related=false&amp;amp;show_comments=true&amp;amp;show_user=true&amp;amp;show_reposts=false&amp;amp;visual=true&quot;&gt;&lt;/iframe&gt;' ) . esc_attr( '</i>' ),
						'type' => 'text',
						'condition' => 'featured_header_status:is(on)',
					),
					array(
						'id' => 'post_images',
						'label' => esc_html__( 'Images for Gallery', 'wikilogy' ),
						'desc' => esc_html__( 'You can upload images for gallery.', 'wikilogy' ),
						'type' => 'gallery',
						'condition' => 'featured_header_status:is(on)',
					),
				array(
					'id' => 'tab3-footer-settings',
					'label' => esc_html__( 'Footer Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'footer_status',
						'label' => esc_html__( 'Footer Status', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide footer.', 'wikilogy' ),
					),
					array(
						'id' => 'footer_style',
						'label'	=> esc_html__( 'Footer Style', 'wikilogy' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select footer style.', 'wikilogy' ),
						'condition' => 'footer_status:is(on)',
					),
					array(
						'id' => 'footer_gap',
						'label' => esc_html__( 'Footer Gap', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can remove footer gap.', 'wikilogy' ),
						'condition' => 'footer_status:is(on)',
					),
			)
		);
		ot_register_meta_box( $post_meta_box );
		
		/*====== Page Meta Boxes ======*/
		$page_meta_box = array( 
			'id' => 'page_settings',
			'title' => esc_html__( 'Page Settings', 'wikilogy' ),
			'pages' => array( 'page' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'tab1-header-settings',
					'label' => esc_html__( 'Header Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'header_status',
						'label' => esc_html__( 'Header Status', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide header.', 'wikilogy' ),
					),
					array(
						'id' => 'header_style',
						'label'	=> esc_html__( 'Header Style', 'wikilogy' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select header style.', 'wikilogy' ),
						'condition' => 'header_status:is(on)',
					),
					array(
						'id' => 'header_gap',
						'label' => esc_html__( 'Header Gap', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can remove header gap.', 'wikilogy' ),
						'condition' => 'header_status:is(on)',
					),
					array(
						'id' => 'featured_image_status',
						'label' => esc_html__( 'Featured Image', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'off',
						'desc' => esc_html__( 'You can hide featured image.', 'wikilogy' ),
					),
					array(
						'id' => 'title_status',
						'label' => esc_html__( 'Title Status', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide title.', 'wikilogy' ),
					),
					array(
						'id' => 'title_style',
						'label' => esc_html__( 'Title Style', 'wikilogy' ),
						'type' => 'radio',
						'desc' => esc_html__( 'You can select title style.', 'wikilogy' ),
						'condition' => 'title_status:is(on)',
						'choices' => array(
							array(
								'label' => esc_html__( 'Style 1', 'wikilogy' ),
								'value' => '1'
							),
							array(
								'label' => esc_html__( 'Style 2', 'wikilogy' ),
								'value' => '2'
							),
							array(
								'label' => esc_html__( 'Style 3', 'wikilogy' ),
								'value' => '3'
							),
						),
					),
					array(
						'id' => 'title_text',
						'label' => esc_html__( 'Title Text', 'wikilogy' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter title text.', 'wikilogy' ),
						'condition' => 'title_status:is(on)',
					),
				array(
					'id' => 'tab2-layout-settings',
					'label' => esc_html__( 'Layout Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'sidebar_position',
						'label'	=> esc_html__( 'Sidebar Position', 'wikilogy' ),
						'desc' => esc_html__( 'You can select sidebar position.', 'wikilogy' ),
						'type' => 'radio-image',
					),
					array(
						'id' => 'sidebar_select',
						'label' => esc_html__( 'Sidebar', 'wikilogy' ),
						'desc' => esc_html__( 'You can select sidebar.', 'wikilogy' ),
						'type' => 'sidebar-select'
					),
					array(
						'id' => 'full_with',
						'label' => esc_html__( 'Full Width', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'off',
						'desc' => esc_html__( 'You can make full width.', 'wikilogy' ),
					),
				array(
					'id' => 'tab3-footer-settings',
					'label' => esc_html__( 'Footer Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'footer_status',
						'label' => esc_html__( 'Footer Status', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide footer.', 'wikilogy' ),
					),
					array(
						'id' => 'footer_style',
						'label'	=> esc_html__( 'Footer Style', 'wikilogy' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select footer style.', 'wikilogy' ),
						'condition' => 'footer_status:is(on)',
					),
					array(
						'id' => 'footer_gap',
						'label' => esc_html__( 'Footer Gap', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can remove footer gap.', 'wikilogy' ),
						'condition' => 'footer_status:is(on)',
					),
			)
		);
		ot_register_meta_box( $page_meta_box );

		/*====== Content Meta Boxes ======*/
		$page_meta_box = array( 
			'id' => 'event_settings',
			'title' => esc_html__( 'Content Settings', 'wikilogy' ),
			'pages' => array( 'content' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'tab1-content-settings',
					'label' => esc_html__( 'Content Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'content_main_category',
						'label' => esc_html__( 'Main Category', 'wikilogy' ),
						'desc' => esc_html__( 'You can select main category.', 'wikilogy' ),
						'type' => 'taxonomy-select',
						'taxonomy' => 'content_category',
					),
					array(
						'id' => 'suggested_contents_list',
						'label' => esc_html__( 'Suggested Contents', 'wikilogy' ),
						'desc' => esc_html__( 'You can select contents for suggested contents block.', 'wikilogy' ),
						'type' => 'custom-post-type-checkbox',
						'post_type' => 'content',
					),
					array(
						'id' => 'content_table',
						'label' => esc_html__( 'Content Table', 'wikilogy' ),
						'desc' => esc_html__( 'You can create a content table for content.', 'wikilogy' ),
						'type' => 'list-item',
				        'settings' => array(
							array(
								'label' => esc_html__( 'Item Style', 'wikilogy' ),
								'id' => 'content_table_item_style',
								'type' => 'radio',
								'desc' => esc_html__( 'You can select item style.', 'wikilogy' ),
								'choices' => array(
									array(
										'label' => esc_html__( 'Style 1', 'wikilogy' ),
										'value' => 'style1'
									),
									array(
										'label' => esc_html__( 'Style 2', 'wikilogy' ),
										'value' => 'style2'
									),
									array(
										'label' => esc_html__( 'Style 3', 'wikilogy' ),
										'value' => 'style3'
									),
								),
								'std' => 'style1',
							),
							array(
								'label' => esc_html__( 'Item Type', 'wikilogy' ),
								'id' => 'content_table_item_type',
								'type' => 'radio',
								'desc' => esc_html__( 'You can select item type.', 'wikilogy' ),
								'choices' => array(
									array(
										'label' => esc_html__( 'Simple Text', 'wikilogy' ),
										'value' => 'simple-text'
									),
									array(
										'label' => esc_html__( 'Image', 'wikilogy' ),
										'value' => 'image'
									),
									array(
										'label' => esc_html__( 'Image with Logo', 'wikilogy' ),
										'value' => 'image-logo'
									),
									array(
										'label' => esc_html__( 'Image Gallery', 'wikilogy' ),
										'value' => 'image-gallery'
									),
									array(
										'label' => esc_html__( 'Link', 'wikilogy' ),
										'value' => 'link'
									),
									array(
										'label' => esc_html__( 'Code', 'wikilogy' ),
										'value' => 'code'
									),
								),
								'std' => 'simple-text',
							),
							array(
								'id' => 'content_table_item_top_margin',
								'label' => esc_html__( '- Top Margin', 'wikilogy' ),
								'type' => 'on_off',
								'std' => 'off',
								'desc' => esc_html__( 'You can add top margin.', 'wikilogy' ),
							),
							array(
								'id' => 'content_table_item_cover',
								'label' => esc_html__( 'Cover Item', 'wikilogy' ),
								'type' => 'on_off',
								'std' => 'off',
								'desc' => esc_html__( 'You can make cover.', 'wikilogy' ),
							),
							array(
								'id' => 'content_table_item_description',
								'label' => esc_html__( 'Description', 'wikilogy' ),
								'type' => 'textarea',
								'desc' => esc_html__( 'You can enter description.', 'wikilogy' ),
							),
							array(
								'id' => 'content_table_item_image',
								'label' => esc_html__( 'Image', 'wikilogy' ),
								'desc' => esc_html__( 'You can upload image.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(image)',
								'type' => 'upload',
							),
							array(
								'id' => 'content_table_item_image_style',
								'label' => esc_html__( 'Image Style', 'wikilogy' ),
								'type' => 'radio',
								'desc' => esc_html__( 'You can select image style. Default: Flat.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(image)',
								'choices' => array(
									array(
										'label' => esc_html__( 'Flat', 'wikilogy' ),
										'value' => 'flat',
									),
									array(
										'label' => esc_html__( 'Radius', 'wikilogy' ),
										'value' => 'radius',
									),
									array(
										'label' => esc_html__( 'Round', 'wikilogy' ),
										'value' => 'round',
									),
								),
							),
							array(
								'id' => 'content_table_item_image_link',
								'label' => esc_html__( 'Link', 'wikilogy' ),
								'type' => 'text',
								'desc' => esc_html__( 'You can enter link.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(image)',
							),
							array(
								'id' => 'content_table_item_image_link_target',
								'label' => esc_html__( 'Link Target', 'wikilogy' ),
								'type' => 'radio',
								'desc' => esc_html__( 'You can select target style. Default: Self.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(image)',
								'choices' => array(
									array(
										'label' => esc_html__( 'Blank', 'wikilogy' ),
										'value' => '_blank',
									),
									array(
										'label' => esc_html__( 'Self', 'wikilogy' ),
										'value' => '_self',
									),
								),
							),
							array(
								'id' => 'content_table_item_image_logo_image',
								'label' => esc_html__( 'Image', 'wikilogy' ),
								'desc' => esc_html__( 'You can upload image.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(image-logo)',
								'type' => 'upload',
							),
							array(
								'id' => 'content_table_item_image_logo_logo',
								'label' => esc_html__( 'Logo', 'wikilogy' ),
								'desc' => esc_html__( 'You can upload logo.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(image-logo)',
								'type' => 'upload',
							),
							array(
								'id' => 'content_table_item_image_logo_logo_style',
								'label' => esc_html__( 'Logo Style', 'wikilogy' ),
								'type' => 'radio',
								'desc' => esc_html__( 'You can select logo style. Default: Flat.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(image-logo)',
								'choices' => array(
									array(
										'label' => esc_html__( 'Flat', 'wikilogy' ),
										'value' => 'flat',
									),
									array(
										'label' => esc_html__( 'Radius', 'wikilogy' ),
										'value' => 'radius',
									),
									array(
										'label' => esc_html__( 'Round', 'wikilogy' ),
										'value' => 'round',
									),
								),
							),
							array(
								'id' => 'content_table_item_image_logo_link',
								'label' => esc_html__( 'Link', 'wikilogy' ),
								'type' => 'text',
								'desc' => esc_html__( 'You can enter link.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(image-logo)',
							),
							array(
								'id' => 'content_table_item_image_logo_link_target',
								'label' => esc_html__( 'Link Target', 'wikilogy' ),
								'type' => 'radio',
								'desc' => esc_html__( 'You can select target style. Default: Self.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(image-logo)',
								'choices' => array(
									array(
										'label' => esc_html__( 'Blank', 'wikilogy' ),
										'value' => '_blank',
									),
									array(
										'label' => esc_html__( 'Self', 'wikilogy' ),
										'value' => '_self',
									),
								),
							),
							array(
								'id' => 'content_table_item_image_gallery',
								'label' => esc_html__( 'Image Gallery', 'wikilogy' ),
								'desc' => esc_html__( 'You can upload images.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(image-gallery)',
								'type' => 'gallery'
							),
							array(
								'id' => 'content_table_item_link',
								'label' => esc_html__( 'Link', 'wikilogy' ),
								'type' => 'text',
								'desc' => esc_html__( 'You can enter link.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(link)',
							),
							array(
								'id' => 'content_table_item_link_target',
								'label' => esc_html__( 'Link Target', 'wikilogy' ),
								'type' => 'radio',
								'desc' => esc_html__( 'You can select target style. Default: Self.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(link)',
								'choices' => array(
									array(
										'label' => esc_html__( 'Blank', 'wikilogy' ),
										'value' => '_blank',
									),
									array(
										'label' => esc_html__( 'Self', 'wikilogy' ),
										'value' => '_self',
									),
								),
							),
							array(
								'id' => 'content_table_item_code',
								'label' => esc_html__( 'Codes', 'wikilogy' ),
								'type' => 'textarea',
								'desc' => esc_html__( 'You can enter codes.', 'wikilogy' ),
								'condition' => 'content_table_item_type:is(code)',
							),
				        ),
			        ),
					array(
						'id' => 'content_index',
						'label' => esc_html__( 'Content Index', 'wikilogy' ),
						'desc' => esc_html__( 'You can create a content index for content.', 'wikilogy' ),
						'type' => 'list-item',
				        'settings' => array(
							array(
								'id' => 'content_index_number',
								'label' => esc_html__( 'Heading Number', 'wikilogy' ),
								'type' => 'text',
								'desc' => esc_html__( 'You can enter heading number. Example: 1, 2, 2.1', 'wikilogy' ),
							),
							array(
								'id' => 'content_index_id',
								'label' => esc_html__( 'Heading ID', 'wikilogy' ),
								'type' => 'text',
								'desc' => esc_html__( 'You can enter heading ID.', 'wikilogy' ),
							),
							array(
								'id' => 'content_index_sub_content',
								'label' => esc_html__( 'Sub Content', 'wikilogy' ),
								'type' => 'on_off',
								'std' => 'off',
								'desc' => esc_html__( 'You can make sub content. If you this item is a sub content, choose "On". Example: 2.1, 2.2, 3.1', 'wikilogy' ),
							),
				        ),
			        ),
					array(
						'id' => 'content_history_table',
						'label' => esc_html__( 'Date for History Table', 'wikilogy' ),
						'desc' => esc_html__( 'You can enter date for history table.', 'wikilogy' ),
						'type' => 'date-picker',
					),
				array(
					'id' => 'tab2-featured-header',
					'label' => esc_html__( 'Featured Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'featured_header_status',
						'label' => esc_html__( 'Featured Header Status', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide featured header. If you want to use featured header, you should choose post format from Format.', 'wikilogy' ),
					),
					array(
						'id' => 'post_video_embed',
						'label' => esc_html__( 'Video Embed Code', 'wikilogy' ),
						'desc' => esc_html__( 'You can enter video embed code.', 'wikilogy' ) . esc_attr( '<br><i>' ) . esc_html__( 'Example:', 'wikilogy' ) . htmlspecialchars( ' &lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube-nocookie.com/embed/OYbXaqQ3uuo&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;' ) . esc_attr( '</i>' ),
						'type' => 'text',
						'condition' => 'featured_header_status:is(on)',
					),
					array(
						'id' => 'post_audio_embed',
						'label' => esc_html__( 'Audio Embed Code', 'wikilogy' ),
						'desc' => esc_html__( 'You can enter audio embed code.', 'wikilogy' ) . esc_attr( '<br><i>' ) . esc_html__( 'Example:', 'wikilogy' ) . htmlspecialchars( ' &lt;iframe width=&quot;100%&quot; height=&quot;450&quot; scrolling=&quot;no&quot; frameborder=&quot;no&quot; src=&quot;https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/90909412&amp;amp;auto_play=false&amp;amp;hide_related=false&amp;amp;show_comments=true&amp;amp;show_user=true&amp;amp;show_reposts=false&amp;amp;visual=true&quot;&gt;&lt;/iframe&gt;' ) . esc_attr( '</i>' ),
						'type' => 'text',
						'condition' => 'featured_header_status:is(on)',
					),
					array(
						'id' => 'post_images',
						'label' => esc_html__( 'Images for Gallery', 'wikilogy' ),
						'desc' => esc_html__( 'You can upload images for gallery.', 'wikilogy' ),
						'type' => 'gallery',
						'condition' => 'featured_header_status:is(on)',
					),
				array(
					'id' => 'tab3-layout-settings',
					'label' => esc_html__( 'Layout Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'sidebar_position',
						'label'	=> esc_html__( 'Sidebar Position', 'wikilogy' ),
						'desc' => esc_html__( 'You can select sidebar position.', 'wikilogy' ),
						'type' => 'radio-image',
					),
					array(
						'label' => esc_html__( 'Sidebar', 'wikilogy' ),
						'desc' => esc_html__( 'You can select sidebar.', 'wikilogy' ),
						'id' => 'sidebar_select',
						'type' => 'sidebar-select'
					),
					array(
						'id' => 'full_with',
						'label' => esc_html__( 'Full Width', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'off',
						'desc' => esc_html__( 'You can make full width page.', 'wikilogy' ),
					),
					array(
						'id' => 'toolbar_status',
						'label' => esc_html__( 'Toolbar', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide toolbar.', 'wikilogy' ),
					),
				array(
					'id' => 'tab4-header-settings',
					'label' => esc_html__( 'Header Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'header_status',
						'label' => esc_html__( 'Header Status', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide header.', 'wikilogy' ),
					),
					array(
						'id' => 'header_style',
						'label'	=> esc_html__( 'Header Style', 'wikilogy' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select header style for page.', 'wikilogy' ),
						'condition' => 'header_status:is(on)',
					),
					array(
						'id' => 'title_status',
						'label' => esc_html__( 'Title Status', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide title.', 'wikilogy' ),
					),
					array(
						'id' => 'title_style',
						'label' => esc_html__( 'Title Style', 'wikilogy' ),
						'type' => 'radio',
						'desc' => esc_html__( 'You can select title style.', 'wikilogy' ),
						'condition' => 'title_status:is(on)',
						'choices' => array(
							array(
								'label' => esc_html__( 'Style 1', 'wikilogy' ),
								'value' => '1'
							),
							array(
								'label' => esc_html__( 'Style 2', 'wikilogy' ),
								'value' => '2'
							),
							array(
								'label' => esc_html__( 'Style 3', 'wikilogy' ),
								'value' => '3'
							),
						),
					),
					array(
						'id' => 'title_text',
						'label' => esc_html__( 'Title Text', 'wikilogy' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter title text.', 'wikilogy' ),
						'condition' => 'title_status:is(on)',
					),
				array(
					'id' => 'tab4-footer-settings',
					'label' => esc_html__( 'Footer Settings', 'wikilogy' ),
					'type' => 'tab'
				),
					array(
						'id' => 'footer_status',
						'label' => esc_html__( 'Footer Status', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can hide footer.', 'wikilogy' ),
					),
					array(
						'id' => 'footer_style',
						'label'	=> esc_html__( 'Footer Style', 'wikilogy' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select footer style.', 'wikilogy' ),
						'condition' => 'footer_status:is(on)',
					),
					array(
						'id' => 'footer_gap',
						'label' => esc_html__( 'Footer Gap', 'wikilogy' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can remove footer gap.', 'wikilogy' ),
						'condition' => 'footer_status:is(on)',
					),
			)
		);
		ot_register_meta_box( $page_meta_box );
	}
	add_action( 'admin_init', 'wikilogy_meta_boxes' );

	/*======
	*
	* Font List for Theme Options
	*
	======*/
	$wikilogy_font_list = array();
	function wikilogy_google_webfont() {
		global $wikilogy_font_list;
		$options = array( 
			array( 
				'option' => "theme_one_font", 
				'default' => "Merriweather"
			),
			array( 
				'option' => "theme_two_font", 
				'default' => "Oswald"
			),
			array( 
				'option' => "body_text", 
				'default' => ""
			),
			array( 
				'option' => "h1_font", 
				'default' => ""
			),
			array( 
				'option' => "h2_font", 
				'default' => ""
			),
			array( 
				'option' => "h3_font", 
				'default' => ""
			),
			array( 
				'option' => "h4_font", 
				'default' => ""
			),
			array( 
				'option' => "h5_font", 
				'default' => ""
			),
			array( 
				'option' => "h6_font", 
				'default' => ""
			),
			array( 
				'option' => "input_font", 
				'default' => ""
			),
			array( 
				'option' => "input_placeholder_font", 
				'default' => ""
			),
			array( 
				'option' => "button_font", 
				'default' => ""
			),
			array( 
				'option' => "header_default_menu_font", 
				'default' => ""
			),
			array( 
				'option' => "header_default_submenu_font", 
				'default' => ""
			),
			array( 
				'option' => "header_classic_menu_font", 
				'default' => ""
			),
			array( 
				'option' => "header_classic_submenu_font", 
				'default' => ""
			),
			array( 
				'option' => "post_posts_title_font", 
				'default' => ""
			),
			array( 
				'option' => "post_posts_content_font", 
				'default' => ""
			),
			array( 
				'option' => "post_posts_bottom_element_title_font", 
				'default' => ""
			),
			array( 
				'option' => "page_title_font", 
				'default' => ""
			),
			array( 
				'option' => "page_content_font", 
				'default' => ""
			),
			array( 
				'option' => "404_page_title", 
				'default' => ""
			),
			array( 
				'option' => "404_page_text", 
				'default' => ""
			),
			array( 
				'option' => "404_page_icon", 
				'default' => ""
			),
		);
		
		$import = '';	
		
		$language = 'latin,latin-ext';
		$font_language = ot_get_option('fonts_languages');

		if ( 'cyrillic' == $font_language )
			$language .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $font_language )
			$language .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $font_language )
			$language .= ',vietnamese';
				
		$url_check = is_ssl() ? 'https' : 'http';

		foreach($options as $option) {
			$array = ot_get_option($option['option']);
			
			if (!empty($array['font-family'])) { 
				if (!in_array($array['font-family'], $wikilogy_font_list)) {
					array_push($wikilogy_font_list, $array['font-family']);
				}
			} else if ($option['default']) {
				if (!in_array($option['default'], $wikilogy_font_list)) {
					array_push($wikilogy_font_list, $option['default']);
				}
			}
		}
		
		$fonts_list_unique = array_unique($wikilogy_font_list);
			
		foreach($fonts_list_unique as $fonts) {
			$cssfont = str_replace(' ', '+', $fonts);
			$query_args = array(
				'family' => $cssfont.':200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i',
				'subset' => $language,
			);
			$font_url = add_query_arg( $query_args, "$url_check://fonts.googleapis.com/css" );
			$import .= "<link href='".$font_url."' rel='stylesheet' type='text/css'>\n";
		}
		return $import;
	}

	function wikilogy_font_dropdown( $array, $field_id ) {
		if ( $field_id == "theme_one_font" ) {
			$array = array( 'font-family');
		}
		
		if ( $field_id == "theme_two_font" ) {
			$array = array( 'font-family');
		}
		
		return $array;
	}
	add_filter( 'ot_recognized_typography_fields', 'wikilogy_font_dropdown', 10, 2 );

	/*======
	*
	* Types for Theme Options
	*
	======*/
	function wikilogy_type_echo($array_value, $important = false, $default = false) {
		global $wikilogy_font_list;
		
		if(!empty($array_value)) {
			//Font Family Array
			if (!empty($array_value['font-family'])) { 
				echo "font-family: '" . $array_value['font-family'] . "';\n";
			}
			else if ($default) {
				echo "font-family: '" . $default . "';\n";
			}
			//Font Color Array
			if (!empty($array_value['font-color'])) { 
				echo "color: " . $array_value['font-color'] . ";\n";
			}
			//Font Style Array
			if (!empty($array_value['font-style'])) { 
				echo "font-style: " . $array_value['font-style'] . ";\n";
			}
			//Font Variant Array
			if (!empty($array_value['font-variant'])) { 
				echo "font-variant: " . $array_value['font-variant'] . ";\n";
			}
			//Font Weight Array
			if (!empty($array_value['font-weight'])) { 
				echo "font-weight: " . $array_value['font-weight'] . ";\n";
			}
			//Font Size Array
			if (!empty($array_value['font-size'])) { 
				
				if ($important) {
					echo "font-size: " . $array_value['font-size'] . "!important;\n";
				} else {
					echo "font-size: " . $array_value['font-size'] . "!important;\n";
				}
			}
			//Font Decoration Array
			if (!empty($array_value['text-decoration'])) { 
					echo "text-decoration: " . $array_value['text-decoration'] . " !important;\n";
			}
			//Font Transform Array
			if (!empty($array_value['text-transform'])) { 
					echo "text-transform: " . $array_value['text-transform'] . " !important;\n";
			}
			//Font Height Array
			if (!empty($array_value['line-height'])) { 
					echo "line-height: " . $array_value['line-height'] . " !important;\n";
			}
			//Font Spacing Array
			if (!empty($array_value['letter-spacing'])) { 
					echo "letter-spacing: " . $array_value['letter-spacing'] . " !important;\n";
			}
		}
		if(empty($array_value) && !empty($default)) {
			echo "font-family: '" . $default . "';\n";
		}
	}

	/*======
	*
	* Background Input Type for Theme Options
	*
	======*/
	function wikilogy_background_input( $background_settings, $background_class, $identifier){ 
		$background_settings = ot_get_option( $background_settings, array() );  
			if($background_settings['background-color'] | $background_settings['background-repeat'] | $background_settings['background-attachment'] | $background_settings['background-position'] | $background_settings['background-image'] ){
				echo esc_attr( $identifier.$background_class );

				if( !empty( $background_settings['background-color'] ) ) {
					echo "background-color: " . $background_settings['background-color'] . ";";
				}

				if( !empty( $background_settings['background-repeat'] ) ) {
					echo "background-repeat: " . $background_settings['background-repeat'] . ";";
				}

				if( !empty( $background_settings['background-attachment'] ) ) {
					echo "background-attachment: " . $background_settings['background-attachment'] . ";";
				}

				if( !empty( $background_settings['background-position'] ) ) {
					echo "background-position: " . $background_settings['background-position'] . ";";
				}

				if( !empty( $background_settings['background-image'] ) ) {
					echo "background-image: url(" . $background_settings['background-image'] . ");";
				}

				if( !empty( $background_settings['background-size'] ) ) {
					echo "background-size: " . $background_settings['background-size'] . ";";
				}
		} 
	}

	/*======
	*
	* Theme Company for Theme Options
	*
	======*/
	function wikilogy_options_name() {
		$web_site = esc_url( 'http://gloriathemes.com' );
		$web_site_title = esc_attr( "Gloria Themes" );
		$html = '<a href="' . esc_url( $web_site ) . '" target="_blank">' . esc_attr( $web_site_title ) . '</a>';
		return $html;
	}
	add_filter( 'ot_header_version_text', 'wikilogy_options_name', 10, 2 );

	/*======
	*
	* Theme Company for Theme Options
	*
	======*/
	function wikilogy_upload_name() {
		return esc_html__('Send to Theme Options', 'wikilogy');
	}
	add_filter( 'ot_upload_text', 'wikilogy_upload_name', 10, 2 );

	/*======
	*
	* Adding Theme Options from Menu
	*
	======*/
	add_filter( 'ot_theme_options_parent_slug', '__return_false' );

	/*======
	*
	* Adding Theme Options from Menu
	*
	======*/
	function wikilogy_theme_options_logo() {
		$web_site = esc_url( 'https://gloriathemes.com/' );
		$web_site_title = esc_attr( "Gloria Themes" );
		echo '<li id="option-tree-logo"><span><a href="' . esc_url( $web_site ) . '" target="_blank"></a></span>';
		$theme_version = wp_get_theme();
		echo '<span class="theme-name"><b>' . esc_attr( $theme_version->get( 'Name' ) ) . '</b><span>' . esc_attr( $theme_version->get( 'Version' ) ) . '</span></li>';
	}
	add_filter( 'ot_header_logo_link', 'wikilogy_theme_options_logo' );

	/*======
	*
	* Adding Theme Options from Menu
	*
	======*/
	function wikilogy_theme_options_header() {
		$support_site = esc_url( 'https://support.gloriathemes.com/' );
		$support_site_title = esc_attr( "Support Center" );
		$documentation_site = esc_url( 'https://docs.gloriathemes.com/' );
		$documentation_site_title = esc_attr( "Theme Documentation" );
		echo '<li id="option-tree-version"><span><a href="' . esc_url( $support_site ) . '" target="_blank">' . esc_attr( $support_site_title ) . '</a></span></li>';
		echo '<li id="option-tree-version"><span><a href="' . esc_url( $documentation_site ) . '" target="_blank">' . esc_attr( $documentation_site_title ) . '</a></span></li>';
	}
	add_filter( 'ot_header_list', 'wikilogy_theme_options_header' );

	/*======
	*
	* Sidebar Creation for Theme Options
	*
	======*/
	function wikilogy_sidebar_creation() {
		$sidebars = ot_get_option('custom_sidebars');
		if(!empty($sidebars)) {
			foreach($sidebars as $sidebar) {
				register_sidebar( array(
					'id' => 'sidebar-'.$sidebar['id'],
					'name' => $sidebar['title'],
					'before_widget' => '<aside id="%1$s" class="widget-box animate anim-fadeIn %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<div class="widget-title"><h4>',
					'after_title' => '</h4></div>',
				));
			}
		}
	}
	add_action( 'after_setup_theme', 'wikilogy_sidebar_creation' );

	if ( ! function_exists( 'ot_type_sidebar_select_category' ) ) {
		function ot_type_sidebar_select_category( $args = array() ) {
			extract( $args );
			$has_desc = $field_desc ? true : false;
			$args = array(
				'type' => 'post',
				'child_of' => 0,
				'parent' => '',
				'orderby' => 'name',
				'order' => 'ASC',
				'hide_empty' => 0,
				'hierarchical' => 0,
				'taxonomy' => 'category',
				'pad_counts' => false
			);
			$categories = get_terms( 'category', array( 'hide_empty' => false ) );
			foreach ($categories as $category) {
				$field_id = 'sidebar_select_'.$category->term_id;
				$field_name = 'option_tree[sidebar_select_'.$category->term_id.']';
				$field_value = ot_get_option($field_id);
				echo '<div class="format-setting type-sidebar-select has-desc">';
					echo '<div class="description">' . esc_html__( "You can the select sidebar for", 'wikilogy' ) . ' "' . esc_attr( $category->name ) . '."</div>';
					echo '<div class="format-setting-inner">';
						echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';

						$sidebars = $GLOBALS['wp_registered_sidebars'];

						if ( ! empty( $sidebars ) ) {
						echo '<option value="">-- ' . esc_html__( 'Choose One', 'wikilogy' ) . ' --</option>';
						foreach ( $sidebars as $sidebar ) {
							echo '<option value="' . esc_attr( $sidebar['id'] ) . '"' . selected( $field_value, $sidebar['id'], false ) . '>' . esc_attr( $sidebar['name'] ) . '</option>';
						}
						} else {
							echo '<option value="">' . esc_html__( 'No Sidebars Found', 'wikilogy' ) . '</option>';
						}
						echo '</select>';
					echo '</div>';
				echo '</div>';
			}
		}
	}

	/*======
	*
	* Image Selector for Radio Button
	*
	======*/
	function wikilogy_radio_image_selector( $array, $field_id ) {
		if ( $field_id == 'sidebar_position' or $field_id == 'post_sidebar_position' or $field_id == 'attachment_sidebar_position' or $field_id == 'category_sidebar_position' or $field_id == 'search_sidebar_position' or $field_id == 'archive_sidebar_position' or $field_id == 'author_sidebar_position' or $field_id == 'tag_sidebar_position' or $field_id == 'page_sidebar_position' or $field_id == 'content_sidebar_position' ) {
			$array = array(
				array(
					'value' => 'nosidebar',
					'label' => esc_html__( 'None Sidebar', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/none-sidebar.jpg'
				),
				array(
					'value' => 'left',
					'label' => esc_html__( 'Left Sidebar', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/left-sidebar.jpg'
				),
				array(
					'value' => 'right',
					'label' => esc_html__( 'Right Sidebar', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/right-sidebar.jpg'
				)
			);
		}

		if ( $field_id == 'default_header_style' ) {
			$array = array(
				array(
					'value' => 'header-style-1',
					'label' => esc_html__( 'Header Style 1', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-1.jpg'
				),
				array(
					'value' => 'header-style-2',
					'label' => esc_html__( 'Header Style 2', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-2.jpg'
				),
				array(
					'value' => 'header-style-3',
					'label' => esc_html__( 'Header Style 3', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-3.jpg'
				),
				array(
					'value' => 'header-style-4',
					'label' => esc_html__( 'Header Style 4', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-4.jpg'
				),
			);
		}

		if ( $field_id == 'header_style' ) {
			$array = array(
				array(
					'value' => 'header-style-1',
					'label' => esc_html__( 'Header Style 1', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-1.jpg'
				),
				array(
					'value' => 'header-style-2',
					'label' => esc_html__( 'Header Style 2', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-2.jpg'
				),
				array(
					'value' => 'header-style-3',
					'label' => esc_html__( 'Header Style 3', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-3.jpg'
				),
				array(
					'value' => 'header-style-4',
					'label' => esc_html__( 'Header Style 4', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-4.jpg'
				),
				array(
					'value' => 'header-style-5',
					'label' => esc_html__( 'Header Style 5', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-4.jpg'
				),
			);
		}

		if ( $field_id == 'footer_style'  or $field_id == 'default_footer_style' ) {
			$array = array(
				array(
					'value' => 'footer-style-1',
					'label' => esc_html__( 'Footer Style 1', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/footer-1.jpg'
				),
				array(
					'value' => 'footer-style-2',
					'label' => esc_html__( 'Footer Style 2', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/footer-2.jpg'
				),
				array(
					'value' => 'footer-style-3',
					'label' => esc_html__( 'Footer Style 3', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/footer-3.jpg'
				)
			);
		}

		if ( $field_id == 'blog_category_post_list_style' or $field_id == 'tag_tag_post_list_style' or $field_id == 'author_author_post_list_style' or $field_id == 'search_search_post_list_style' or $field_id == 'archive_archive_post_list_style' ) {
			$array = array(
				array(
					'value' => 'style1',
					'label' => esc_html__( 'Style 1', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/post-style1.jpg'
				),
				array(
					'value' => 'style2',
					'label' => esc_html__( 'Style 2', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/post-style2.jpg'
				),
				array(
					'value' => 'style3',
					'label' => esc_html__( 'Style 3', 'wikilogy' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/post-style2.jpg'
				)
			);
		}
		
		return $array;
	}
	add_filter( 'ot_radio_images', 'wikilogy_radio_image_selector', 10, 2 );

	/*======
	*
	* Fonts for Theme Options
	*
	======*/
	class wikilogy_font_settings {
		public  $ot_typography_id;
		public  $wikilogy_css_output = array();
		public  $wikilogy_font_output = array();
		public  $id_array = array();
		private $css_echo = array(
				'font-color' => 'color', 
				'font-family' => 'font-family', 
				'font-size' => 'font-size', 
				'font-style' => 'font-style',
				'font-variant'	=> 'font-variant',
				'font-weight' => 'font-weight',
				'letter-spacing' => 'letter-spacing',
				'line-height' => 'line-height',
				'text-decoration' => 'text-decoration',
				'text-transform' => 'text-transform'
				);

		/*====== Font List from Json  ======*/
		public function wikilogy_font_google_api(){
			ob_start();
			require get_template_directory() .'/include/assets/json/webfonts.json';
			$fonts_list = ob_get_clean();

			$fonts_list = json_decode( $fonts_list, true );
			if ( ! is_array( $fonts_list ) ) {
				$fonts_list = array();
			}
			$fonts = $fonts_list;

			$font_list_arrray = array();
			foreach ( $fonts['items'] as $key => $value) {
				$font_list_arrray[$value['family']] = $value['family'];
			}
			return $font_list_arrray;
		}
		
		/*====== Font Echo ======*/
		public function wikilogy_font_settings_echo($ot_typography_id,$selector, $default_font='Arial'){
			
			//$this->id_array[] = array('id'=>$ot_typography_id, 'default'=>$default_font );
			//Font Features Output
			$ot_typography_name = ot_get_option($ot_typography_id);

			if (!empty($ot_typography_name)) {
				$css = '';
				foreach ($ot_typography_name as $key => $value) {
					if ($this->css_echo[$key]=='font-family' && $value=='') {
						$value=$default_font;
					}
					if ($this->css_echo[$key]=='font-family') {
						$this->wikilogy_font_output[]=$value;
					}
					if (!empty($ot_typography_name[$key])) {
						$css .= $this->css_echo[$key].':'.$value.';';
					}
					if (empty($ot_typography_name['font-family'])) {
						if ($this->css_echo[$key]=='font-family') {
							$css .= 'font-family:'.$default_font .';';
						}
					}
				}
				$this->wikilogy_css_output[$ot_typography_id] = $selector."{".$css."}";
			}
			else{
				if( !empty( $default_font ) ) { 
					$this->wikilogy_css_output[$ot_typography_id] = 'font-family:'.$default_font.';';
					$this->wikilogy_css_output[$ot_typography_id] = $selector."{".'font-family:'.$default_font.';'."}";
					$this->wikilogy_font_output[]=$default_font;
				}
			}
			$font_echo = $this->wikilogy_font_output;										
		}

		/*====== CSS Output ======*/
		public function wikilogy_css_output(){
			$output = '';
			foreach ($this->wikilogy_css_output as $value) {
				$output .= $value."\n";
			}
			return $output;
		}

		/*====== CSS Echo ======*/
		public function wikilogy_css_echo( $ot_typography_id = "", $selector = "", $where = "", $default='' ){
			$css = '';
			//Background
			if ( $where == 'backgroundType' ) {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$ot_typography_id = ot_get_option( $ot_typography_id, array() );  
					if($ot_typography_id['background-color'] | $ot_typography_id['background-repeat'] | $ot_typography_id['background-attachment'] | $ot_typography_id['background-position'] | $ot_typography_id['background-image'] ){
						if( !empty( $ot_typography_id['background-color'] ) ) {
							$css .= $selector;
							$css .= "{background-color: " . $ot_typography_id['background-color'] . ";}";
						}

						if( !empty( $ot_typography_id['background-repeat'] ) ) {
							$css .= $selector;
							$css .= "{background-repeat: " . $ot_typography_id['background-repeat'] . ";}";
						}

						if( !empty( $ot_typography_id['background-attachment'] ) ) {
							$css .= $selector;
							$css .= "{background-attachment: " . $ot_typography_id['background-attachment'] . ";}";
						}

						if( !empty( $ot_typography_id['background-position'] ) ) {
							$css .= $selector;
							$css .= "{background-position: " . $ot_typography_id['background-position'] . ";}";
						}

						if( !empty( $ot_typography_id['background-image'] ) ) {
							$css .= $selector;
							$css .= "{background-image: url(" . $ot_typography_id['background-image'] . ");}";
						}

						if( !empty( $ot_typography_id['background-size'] ) ) {
							$css .= $selector;
							$css .= "{background-size: " . $ot_typography_id['background-size'] . ";}";
						}
					}
				}
			}

			//Background
			if ($where == 'background') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= '{background:'.ot_get_option($ot_typography_id).';}';
				}
			}

			//Background Color
			if ($where == 'background-color') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= '{background-color:'.ot_get_option($ot_typography_id).';}';
				}
			}

			//Background Image
			if ($where == 'background-image') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= '{background-image:url('.ot_get_option($ot_typography_id).');}';
				}
			}

			//Border Color
			elseif ($where == 'border-color') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= '{border-color:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'color') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= '{color:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'max-height') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= '{max-height:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'paddingTopBottom') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= '{padding:'.ot_get_option($ot_typography_id).' 0px;}';
				}
			}

			elseif ($where == 'stroke') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= '{stroke:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'border-top-color') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= '{border-top-color:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'border-bottom-color') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= '{border-bottom-color:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'just-code') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= '{'.ot_get_option($ot_typography_id).'}';
				}
			}

			elseif ($where == 'custom-css-code') {
				$typography_control = ot_get_option( $ot_typography_id );
				if ( !empty( $typography_control ) ) {
					$css .= $selector;
					$css .= ot_get_option($ot_typography_id);
				}
			}

			return $css;
		}

		/*====== Font Output ======*/
		public function wikilogy_font_output(){

			$ot_font_subset_latin = ot_get_option ('font_subsets_latin');
			$font_subsets_cyrillic = ot_get_option ('font_subsets_cyrillic');
			$font_subsets_greek = ot_get_option ('font_subsets_greek');

			if ($ot_font_subset_latin == 'on' && $font_subsets_cyrillic == 'on' && $font_subsets_greek == 'on') {
				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,greek,greek-ext,latin-ext';
			}
			elseif ($ot_font_subset_latin == 'on' && $font_subsets_cyrillic == 'on') {
				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,latin-ext';
			}
			elseif ($font_subsets_greek == 'on' && $font_subsets_cyrillic == 'on') {
				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,greek,greek-ext';
			}
			elseif ($ot_font_subset_latin == 'on' && $font_subsets_greek == 'on') {
				$ot_font_subset_echo = 'greek,greek-ext,latin-ext';
			}
			elseif($ot_font_subset_latin == 'on'){
				$ot_font_subset_echo = 'latin-ext';
			}
			elseif($font_subsets_cyrillic == 'on'){
				$ot_font_subset_echo = 'cyrillic,cyrillic-ext';
			}
			elseif($font_subsets_greek == 'on'){
				$ot_font_subset_echo = 'greek,greek-ext';
			}
			else{
				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,greek,greek-ext,latin-ext';
			}

			if (is_ssl()) {
				$ssl_control = 'https';
			}
			else{
				$ssl_control = 'http';
			}

			$font_uniq = array_unique($this->wikilogy_font_output);
			foreach ($font_uniq as $value) {
				$font_name = str_replace(' ', '+', $value);
				echo "<link href='$ssl_control://fonts.googleapis.com/css?family=".$font_name.":200,200i,300,300i,400,400i,500,500i,600,600i,700,700i&subset=".$ot_font_subset_echo."' rel='stylesheet' type='text/css'>\n";
			}
		}
	}
	add_filter( 'ot_recognized_font_families', array('wikilogy_font_settings','wikilogy_font_google_api'));

	/*======
	*
	* Design for Category
	*
	======*/
	function wikilogy_category_edit_settings( $term, $taxonomy ) {
		$wikilogy_category_sidebar_style  = get_term_meta( $term->term_id, 'wikilogy_category_sidebar_style', true );
		$wikilogy_category_category_post_list  = get_term_meta( $term->term_id, 'wikilogy_category_category_post_list', true );
		$wikilogy_category_title  = get_term_meta( $term->term_id, 'wikilogy_category_title', true );
	?>

		<tr class="form-field gloria-custom-admin-row gloria-custom-admin-row-column">
			<th scope="row" valign="top">
				<label><?php esc_html_e( 'Sidebar Style', 'wikilogy' ); ?></label>
			</th>
				
			<td>
				<div>
					<p>
						<input type="radio" name="wikilogy_category_sidebar_style" id="wikilogy-category-sidebar-1" value="nosidebar" class="radio" <?php if( $wikilogy_category_sidebar_style == 'nosidebar' ){ echo 'checked="checked"'; } ?>>
						<label for="wikilogy-category-sidebar-1"><img for="wikilogy-category-header-1" src="<?php echo get_template_directory_uri() . '/include/assets/img/admin/none-sidebar.jpg'; ?>" alt="<?php echo esc_html__( 'None Sidebar', 'wikilogy' ); ?>"></label>
					</p>
				</div>

				<div>
					<p>
						<input type="radio" name="wikilogy_category_sidebar_style" id="wikilogy-category-sidebar-2" value="left" class="radio" <?php if( $wikilogy_category_sidebar_style == 'left' ){ echo 'checked="checked"'; } ?>>
						<label for="wikilogy-category-sidebar-2"><img for="wikilogy-category-header-2" src="<?php echo get_template_directory_uri() . '/include/assets/img/admin/left-sidebar.jpg'; ?>" alt="<?php echo esc_html__( 'Left Sidebar', 'wikilogy' ); ?>"></label>
					</p>
				</div>

				<div>
					<p>
						<input type="radio" name="wikilogy_category_sidebar_style" id="wikilogy-category-sidebar-3" value="right" class="radio" <?php if( $wikilogy_category_sidebar_style == 'right' ){ echo 'checked="checked"'; } ?>>
						<label for="wikilogy-category-sidebar-3"><img for="wikilogy-category-header-3" src="<?php echo get_template_directory_uri() . '/include/assets/img/admin/right-sidebar.jpg'; ?>" alt="<?php echo esc_html__( 'Right Sidebar', 'wikilogy' ); ?>"></label>
					</p>
				</div>
			</td>
		</tr>

		<tr class="form-field gloria-custom-admin-row gloria-custom-admin-row-column">
			<th scope="row" valign="top">
				<label><?php esc_html_e( 'Post List Style', 'wikilogy' ); ?></label>
			</th>
				
			<td>
				<div>
					<p>
						<input type="radio" name="wikilogy_category_category_post_list" id="wikilogy-category-post-list-style-1" value="post-list-style-1" class="radio" <?php if( $wikilogy_category_category_post_list == 'post-list-style-1' ){ echo 'checked="checked"'; } ?>>
						<label for="wikilogy-category-post-list-style-1"><img for="wikilogy-category-post-list-style-1" src="<?php echo get_template_directory_uri() . '/include/assets/img/admin/post-style1.jpg'; ?>" alt="<?php echo esc_html__( 'Style 1', 'wikilogy' ); ?>"></label>
					</p>
				</div>

				<div>
					<p>
						<input type="radio" name="wikilogy_category_category_post_list" id="wikilogy-category-post-list-style-2" value="post-list-style-2" class="radio" <?php if( $wikilogy_category_category_post_list == 'post-list-style-2' ){ echo 'checked="checked"'; } ?>>
						<label for="wikilogy-category-post-list-style-2"><img for="wikilogy-category-post-list-style-2" src="<?php echo get_template_directory_uri() . '/include/assets/img/admin/post-style2.jpg'; ?>" alt="<?php echo esc_html__( 'Style 2', 'wikilogy' ); ?>"></label>
					</p>
				</div>
			</td>
		</tr>

		<tr class="form-field gloria-custom-admin-row gloria-custom-admin-row-column gloria-custom-admin-row-radio-active">
			<th scope="row" valign="top">
				<label><?php esc_html_e( 'Category Title', 'wikilogy' ); ?></label>
			</th>
				
			<td>
				<div>
					<p>
						<input type="radio" name="wikilogy_category_title" id="wikilogy-category-title-1" value="on" class="radio" <?php if( $wikilogy_category_title == 'on' ){ echo 'checked="checked"'; } ?>>
						<label for="wikilogy-category-title-1"><?php echo esc_html__( 'On', 'wikilogy' ); ?></label>
					</p>
				</div>

				<div>
					<p>
						<input type="radio" name="wikilogy_category_title" id="wikilogy-category-title-2" value="off" class="radio" <?php if( $wikilogy_category_title == 'off' ){ echo 'checked="checked"'; } ?>>
						<label for="wikilogy-category-title-2"><?php echo esc_html__( 'Off', 'wikilogy' ); ?></label>
					</p>
				</div>
			</td>
		</tr>

	  <?php
	}
	add_action( 'category_edit_form_fields', 'wikilogy_category_edit_settings', 10,2 );

	function wikilogy_category_settings_save( $term_id, $tt_id, $taxonomy ) { 
		if ( isset( $_POST['wikilogy_category_sidebar_style'] ) ) {
			update_term_meta( $term_id, 'wikilogy_category_sidebar_style', $_POST['wikilogy_category_sidebar_style'] );
		}

		if ( isset( $_POST['wikilogy_category_category_post_list'] ) ) {
			update_term_meta( $term_id, 'wikilogy_category_category_post_list', $_POST['wikilogy_category_category_post_list'] );
		}

		if ( isset( $_POST['wikilogy_category_title'] ) ) {
			update_term_meta( $term_id, 'wikilogy_category_title', $_POST['wikilogy_category_title'] );
		}
	}
	add_action( 'edit_term', 'wikilogy_category_settings_save', 10,3 );