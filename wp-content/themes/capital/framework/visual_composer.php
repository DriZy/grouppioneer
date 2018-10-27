<?php

if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
	vc_set_default_editor_post_types( array(
		'page',
		'post',
		'imi_projects',
		'imi_team',
		'imi_services',
		'imi_testimonials',
		'imi_custom_sidebar',
	) );
}

add_action( 'vc_before_init', 'capital_vc_set_as_theme' );

if( ! function_exists( 'capital_vc_set_as_theme' ) ) {
	function capital_vc_set_as_theme() {
		vc_set_as_theme( true );
	}
}

if ( is_admin() ) {
	if ( ! function_exists( 'capital_vc_remove_teaser_metabox' ) ) {
		function capital_vc_remove_teaser_metabox() {
			$post_types = get_post_types( '', 'names' );
			foreach ( $post_types as $post_type ) {
				remove_meta_box( 'vc_teaser', $post_type, 'side' );
			}
		}

		add_action( 'do_meta_boxes', 'capital_vc_remove_teaser_metabox' );
	}
}

/* UPDATE VC DEFAULT SHORTCODES */
add_action( 'admin_init', 'capital_update_default_shortcodes' );

if ( ! function_exists( 'capital_update_default_shortcodes' ) ) {
	function capital_update_default_shortcodes() {

		if ( function_exists( 'vc_add_params' ) ) {

			vc_add_params( 'vc_btn', array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Color', 'capital' ),
					'param_name' => 'color',
					'description' => __( 'Select button color.', 'capital' ),
					// compatible with btn2, need to be converted from btn1
					'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
					'value' => array(
							// Btn1 Colors
							__( 'Theme Primary Color', 'capital' ) => 'theme_primary_btn',
							__( 'Theme Secondary Color', 'capital' ) => 'theme_secondary_btn',
							__( 'Classic Grey', 'capital' ) => 'default',
							__( 'Classic Blue', 'capital' ) => 'primary',
							__( 'Classic Turquoise', 'capital' ) => 'info',
							__( 'Classic Green', 'capital' ) => 'success',
							__( 'Classic Orange', 'capital' ) => 'warning',
							__( 'Classic Red', 'capital' ) => 'danger',
							__( 'Classic Black', 'capital' ) => 'inverse',
							// + Btn2 Colors (default color set)
						) + getVcShared( 'colors-dashed' ),
					'std' => 'grey',
					// must have default color grey
					'dependency' => array(
						'element' => 'style',
						'value_not_equal_to' => array(
							'custom',
							'outline-custom',
							'gradient',
							'gradient-custom',
						),
					),
				),
			) );

		}

	}
}
/* START THEME ELEMENTS */
if ( function_exists( 'vc_map' ) ) {
	add_action( 'init', 'capital_vc_elements' );
}

if ( ! function_exists( 'capital_vc_elements' ) ) {
	function capital_vc_elements() {
		
		$projectterms = array();
		$servicesterms = array();
		$poststerms = array();
		$testimonialsterms = array();
		$teamterms = array();
		
		$project_cats = get_terms('imi_projects_category');
		if(!is_wp_error($project_cats))
		{
			foreach($project_cats as $project_cat)
			{ 
				$projectterms[] = array('value'=>$project_cat->term_id, 'label'=>$project_cat->name); 
			}
		}
		$service_cats = get_terms('imi_services_category');
		if(!is_wp_error($service_cats))
		{
			foreach($service_cats as $service_cat)
			{ 
				$servicesterms[] = array('value'=>$service_cat->term_id, 'label'=>$service_cat->name); 
			}
		}
		$posts_cats = get_terms('category');
		if(!is_wp_error($posts_cats))
		{
			foreach($posts_cats as $posts_cat)
			{ 
				$poststerms[] = array('value'=>$posts_cat->term_id, 'label'=>$posts_cat->name); 
			}
		}
		$testimonials_cats = get_terms('imi_testimonials_category');
		if(!is_wp_error($testimonials_cats))
		{
			foreach($testimonials_cats as $testimonials_cat)
			{ 
				$testimonialsterms[] = array('value'=>$testimonials_cat->term_id, 'label'=>$testimonials_cat->name); 
			}
		}
		$team_cats = get_terms('imi_team_category');
		if(!is_wp_error($team_cats))
		{
			foreach($team_cats as $team_cat)
			{ 
				$teamterms[] = array('value'=>$team_cat->term_id, 'label'=>$team_cat->name); 
			}
		}
		$vc_sections_array = get_posts(array( 'post_type' => 'imi_custom_sidebar', 'posts_per_page' => - 1));
		$vc_sections = array( esc_html__('Select', 'capital' ) => 0);
		if ( $vc_sections_array && ! is_wp_error( $vc_sections_array ) ) {
			foreach ( $vc_sections_array as $vc_section ) {
				$vc_sections[ get_the_title( $vc_section ) ] = $vc_section->ID;
			}
		}
		/* Projects Grid/List Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Projects", "capital" ),
			"base" => "capital_project",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'View Style', 'capital' ),
					'param_name' => 'view',
					'value' => array(esc_html__( 'Grid', 'capital' ) => 'grid', esc_html__( 'Carousel', 'capital' ) => 'carousel' ) ,
					'description' => esc_html__( 'Select view style for projects.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grid Column', 'capital' ),
					'param_name' => 'grid_column',
					'value' => array( esc_html__( 'One Column', 'capital' ) => 12, esc_html__( 'Two Columns', 'capital' ) => 6, esc_html__( 'Three Columns', 'capital' ) => 4, esc_html__( 'Four Columns', 'capital' ) => 3, esc_html__( 'Six Columns', 'capital' ) => 2) ,
					'description' => esc_html__( 'Select columns of grid/carousel.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Style', 'capital' ),
					'param_name' => 'style',
					'value' => array( esc_html__( 'Style1', 'capital' ) => 'projects-grid-style1', esc_html__( 'Style 2', 'capital' ) => 'projects-grid-style2') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show project category filters?', 'capital'),
					'param_name' => 'filters',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('grid'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Filters style', 'capital' ),
					'param_name' => 'filters_style',
					'value' => array( esc_html__( 'Pills', 'capital' ) => 'pills', esc_html__( 'Tabs', 'capital' ) => 'tabs', esc_html__( 'Plain', 'capital' ) => 'plain' ) ,
					'description' => esc_html__( 'Select style for the category filters.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'filters',
						'value' => array( '1' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel next/prev arrows?', 'capital'),
					'param_name' => 'carousel_arrows',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel next/prev arrows position?', 'capital' ),
					'param_name' => 'carousel_arrows_position',
					'value' => array( esc_html__( 'Below Carousel', 'capital' ) => 'owl-arrows-bottom', esc_html__( 'Over Carousel', 'capital' ) => 'owl-arrows-over') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'carousel_arrows',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel pagination?', 'capital'),
					'param_name' => 'carousel_pagi',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Autoplay Carousel?', 'capital'),
					'param_name' => 'carousel_autoplay',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Auto Rotate Timeout?', 'capital' ),
					'param_name' => 'carousel_autoplay_timeout',
					'description' => esc_html__('Autoplay interval timeout. 1000 = 1 second.', 'capital'),
					'std' => '',
					'dependency' => array(
						'element' => 'carousel_autoplay',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Loop carousel?', 'capital' ),
					'param_name' => 'carousel_loop',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'description' => esc_html__('If you want the carousel to keep rotating using pagination and naxt/prev buttons without scrolling back.', 'capital'),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Carousel stage padding?', 'capital' ),
					'param_name' => 'carousel_padding',
					'description' => esc_html__('Padding left and right on stage. Allow to show neighbour items on left and right sides. Enter only in numbers, for example: 100', 'capital'),
					'std' => '',
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Link project image to big image in Lightbox?', 'capital' ),
					'param_name' => 'zoom',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show project title?', 'capital' ),
					'param_name' => 'show_title',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show project categories?', 'capital' ),
					'param_name' => 'show_category',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'autocomplete',
					'class' => '',
					'heading' => esc_html__( 'Project Categories', 'capital' ),
					'param_name' => 'terms',
					'description' => esc_html__( 'Show projects by specific categories. Search and enter by typing category names.', 'capital' ),
					'settings'		=> array( 'values' => $projectterms,'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true, ),
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of projects', 'capital' ),
					'param_name' => 'number',
					'value' => 4,
					'description' => esc_html__( 'Insert number of projects to show per page.', 'capital' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'capital' ),
					'param_name' => 'img_size',
					'value' => '600x400',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'capital' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'capital' ),
					'param_name' => 'pagination',
					'description' => esc_html__( 'Show pagination for Projects.', 'capital' ),
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid' ),
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Spaced items', 'capital' ),
					'param_name' => 'capital_style_spacing',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Spaced', 'capital' ) => 'spaced-items', esc_html__( 'No space', 'capital' ) => 'non-spaced-items') ,
					'description' => esc_html__( 'Choose if you want to have space/gutter between posts or not.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Border style for portfolio posts', 'capital' ),
					'param_name' => 'capital_style_border',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Shadow', 'capital' ) => 'shadow-border-style', esc_html__( 'Border', 'capital' ) => 'basic-border-style', esc_html__( 'None', 'capital' ) => 'no-border-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background style for portfolio posts', 'capital' ),
					'param_name' => 'capital_style_bg',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'White', 'capital' ) => 'white-bg-style', esc_html__( 'Theme primary color', 'capital' ) => 'primary-bg-style', esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-bg-style', esc_html__( 'Custom', 'capital' ) => 'custom-bg-style', esc_html__( 'None', 'capital' ) => 'no-bg-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom background color', 'capital' ),
					'param_name' => 'capital_style_bg_custom',
					'group'      => esc_html__( 'Style', 'capital' ),
					'dependency' => array('element' => 'capital_style_bg', 'value' => 'custom-bg-style'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Skin style for portfolio posts', 'capital' ),
					'param_name' => 'capital_style_skin',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Light', 'capital' ) => 'light-skin-style', esc_html__( 'Dark', 'capital' ) => 'dark-skin-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			)
		) 
	);
	
	/* Services Grid/List Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Services", "capital" ),
			"base" => "capital_services",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'View Style', 'capital' ),
					'param_name' => 'view',
					'value' => array( esc_html__( 'List', 'capital' ) => 'list', esc_html__( 'Grid', 'capital' ) => 'grid', esc_html__( 'Carousel', 'capital' ) => 'carousel' ) ,
					'description' => esc_html__( 'Select view style for services.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grid Column', 'capital' ),
					'param_name' => 'grid_column',
					'value' => array( esc_html__( 'One Column', 'capital' ) => 12, esc_html__( 'Two Columns', 'capital' ) => 6, esc_html__( 'Three Columns', 'capital' ) => 4, esc_html__( 'Four Columns', 'capital' ) => 3, esc_html__( 'Six Columns', 'capital' ) => 2) ,
					'description' => esc_html__( 'Select columns of grid/carousel.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','carousel' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel next/prev arrows?', 'capital'),
					'param_name' => 'carousel_arrows',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel next/prev arrows position?', 'capital' ),
					'param_name' => 'carousel_arrows_position',
					'value' => array( esc_html__( 'Below Carousel', 'capital' ) => 'owl-arrows-bottom', esc_html__( 'Over Carousel', 'capital' ) => 'owl-arrows-over') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'carousel_arrows',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel pagination?', 'capital'),
					'param_name' => 'carousel_pagi',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Autoplay Carousel?', 'capital'),
					'param_name' => 'carousel_autoplay',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Auto Rotate Timeout?', 'capital' ),
					'param_name' => 'carousel_autoplay_timeout',
					'description' => esc_html__('Autoplay interval timeout. 1000 = 1 second.', 'capital'),
					'std' => '',
					'dependency' => array(
						'element' => 'carousel_autoplay',
						'value' => '1',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Carousel stage padding?', 'capital' ),
					'param_name' => 'carousel_padding',
					'description' => esc_html__('Padding left and right on stage. Allow to show neighbour items on left and right sides. Enter only in numbers, for example: 100', 'capital'),
					'std' => '',
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Loop carousel?', 'capital' ),
					'param_name' => 'carousel_loop',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'description' => esc_html__('If you want the carousel to keep rotating using pagination and naxt/prev buttons without scrolling back.', 'capital'),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Link Image/Icon/Title to single service page?', 'capital' ),
					'param_name' => 'linked',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show services title?', 'capital' ),
					'param_name' => 'show_title',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of words to show as excerpt', 'capital' ),
					'description' => esc_html__('Leave empty or enter 0 for no excerpt.', 'capital'),
					'param_name' => 'excerpt_number',
					'value' => 20,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show read more link?', 'capital' ),
					'param_name' => 'more',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Read more link text', 'capital' ),
					'param_name' => 'more_text',
					'value' => 'Read More',
					'dependency' => array(
						'element' => 'more',
						'value' => '1',
					),
				),
				array(
					'type' => 'autocomplete',
					'class' => '',
					'heading' => esc_html__( 'Service Categories', 'capital' ),
					'param_name' => 'terms',
					'description' => esc_html__( 'Show services by specific categories. Search and enter by typing category names.', 'capital' ),
					'settings'		=> array( 'values' => $servicesterms,'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true, ),
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of Services', 'capital' ),
					'param_name' => 'number',
					'value' => 4,
					'description' => esc_html__( 'Insert number of services to show per page.', 'capital' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Show Thumbnail or Icon', 'capital' ),
					'param_name' => 'thumb',
					'value' => array( esc_html__( 'Icon', 'capital' ) => 'icon-service-media', esc_html__( 'Thumbnail', 'capital' ) => 'thumbnail-service-media', esc_html__( 'None', 'capital' ) => 'no-service-media') ,
					'description' => esc_html__( 'Select thumbnail or icon view for services.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'capital' ),
					'param_name' => 'img_size',
					'value' => '450x400',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'capital' ),
					'dependency' => array(
						'element' => 'thumb',
						'value' => array( 'thumbnail-service-media' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'capital' ),
					'param_name' => 'pagination',
					'description' => esc_html__( 'Show pagination for services.', 'capital' ),
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','list' ),
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Spaced items', 'capital' ),
					'param_name' => 'capital_style_spacing',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Spaced', 'capital' ) => 'spaced-items', esc_html__( 'No space', 'capital' ) => 'non-spaced-items') ,
					'description' => esc_html__( 'Choose if you want to have space/gutter between posts or not.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Border style for service posts', 'capital' ),
					'param_name' => 'capital_style_border',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Shadow', 'capital' ) => 'shadow-border-style', esc_html__( 'Border', 'capital' ) => 'basic-border-style', esc_html__( 'None', 'capital' ) => 'no-border-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background style for service posts', 'capital' ),
					'param_name' => 'capital_style_bg',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'White', 'capital' ) => 'white-bg-style', esc_html__( 'Theme primary color', 'capital' ) => 'primary-bg-style', esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-bg-style', esc_html__( 'Custom', 'capital' ) => 'custom-bg-style', esc_html__( 'None', 'capital' ) => 'no-bg-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom background color', 'capital' ),
					'param_name' => 'capital_style_bg_custom',
					'group'      => esc_html__( 'Style', 'capital' ),
					'dependency' => array('element' => 'capital_style_bg', 'value' => 'custom-bg-style'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Skin style for service posts', 'capital' ),
					'param_name' => 'capital_style_skin',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Light', 'capital' ) => 'light-skin-style', esc_html__( 'Dark', 'capital' ) => 'dark-skin-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			)
		) 
	);
	/* Posts Grid/List Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Blog Posts", "capital" ),
			"base" => "capital_posts",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'View Style', 'capital' ),
					'param_name' => 'view',
					'value' => array( esc_html__( 'Medium Thumbnails', 'capital' ) => 'medium',esc_html__( 'Full Width', 'capital' ) => 'full', esc_html__( 'Grid', 'capital' ) => 'grid', esc_html__( 'Carousel', 'capital' ) => 'carousel' ) ,
					'description' => esc_html__( 'Select view style for posts.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grid Column', 'capital' ),
					'param_name' => 'grid_column',
					'value' => array( esc_html__( 'One Column', 'capital' ) => 12, esc_html__( 'Two Columns', 'capital' ) => 6, esc_html__( 'Three Columns', 'capital' ) => 4, esc_html__( 'Four Columns', 'capital' ) => 3) ,
					'description' => esc_html__( 'Select columns of grid/carousel.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','carousel' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel next/prev arrows?', 'capital'),
					'param_name' => 'carousel_arrows',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel next/prev arrows position?', 'capital' ),
					'param_name' => 'carousel_arrows_position',
					'value' => array( esc_html__( 'Below Carousel', 'capital' ) => 'owl-arrows-bottom', esc_html__( 'Over Carousel', 'capital' ) => 'owl-arrows-over') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'carousel_arrows',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel pagination?', 'capital'),
					'param_name' => 'carousel_pagi',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Autoplay Carousel?', 'capital'),
					'param_name' => 'carousel_autoplay',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Auto Rotate Timeout?', 'capital' ),
					'param_name' => 'carousel_autoplay_timeout',
					'description' => esc_html__('Autoplay interval timeout. 1000 = 1 second.', 'capital'),
					'std' => '',
					'dependency' => array(
						'element' => 'carousel_autoplay',
						'value' => '1',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Carousel stage padding?', 'capital' ),
					'param_name' => 'carousel_padding',
					'description' => esc_html__('Padding left and right on stage. Allow to show neighbour items on left and right sides. Enter only in numbers, for example: 100', 'capital'),
					'std' => '',
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Loop carousel?', 'capital' ),
					'param_name' => 'carousel_loop',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'description' => esc_html__('If you want the carousel to keep rotating using pagination and naxt/prev buttons without scrolling back.', 'capital'),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post media?', 'capital' ),
					'param_name' => 'media_show',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post featured image only', 'capital' ),
					'description' => esc_html__( 'Check to show only featured image instead of different media content.', 'capital' ),
					'param_name' => 'media_image_only',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'media_show',
						'value' => array( '1' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post date?', 'capital' ),
					'param_name' => 'show_date',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post author name?', 'capital' ),
					'param_name' => 'show_author',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post categories?', 'capital' ),
					'param_name' => 'show_categories',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post comments number?', 'capital' ),
					'param_name' => 'show_comments',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Excerpt?', 'capital' ),
					'param_name' => 'show_excerpt',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of words to show as excerpt', 'capital' ),
					'param_name' => 'excerpt_number',
					'value' => 30,
					'dependency' => array(
						'element' => 'show_excerpt',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show read more button?', 'capital' ),
					'param_name' => 'more',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Read more button label', 'capital' ),
					'param_name' => 'more_text',
					'value' => 'Read More',
					'dependency' => array(
						'element' => 'more',
						'value' => '1',
					),
				),
				array(
					'type' => 'autocomplete',
					'class' => '',
					'heading' => esc_html__( 'Posts Categories', 'capital' ),
					'param_name' => 'terms',
					'description' => esc_html__( 'Show posts by specific categories. Search and enter by typing category names.', 'capital' ),
					'settings'		=> array( 'values' => $poststerms,'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true, ),
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of Posts', 'capital' ),
					'param_name' => 'number',
					'value' => 4,
					'description' => esc_html__( 'Insert number of posts to show per page.', 'capital' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'capital' ),
					'param_name' => 'img_size',
					'value' => '600x400',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size. This works for only standard or Image format posts.', 'capital' ),
					'dependency' => array(
						'element' => 'media_show',
						'value' => array( '1' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'capital' ),
					'param_name' => 'pagination',
					'description' => esc_html__( 'Show pagination for posts.', 'capital' ),
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','medium','full' ),
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Spaced items', 'capital' ),
					'param_name' => 'capital_style_spacing',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Spaced', 'capital' ) => 'spaced-items', esc_html__( 'No space', 'capital' ) => 'non-spaced-items') ,
					'description' => esc_html__( 'Choose if you want to have space/gutter between posts or not.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Border style for blog posts', 'capital' ),
					'param_name' => 'capital_style_border',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Shadow', 'capital' ) => 'shadow-border-style', esc_html__( 'Border', 'capital' ) => 'basic-border-style', esc_html__( 'None', 'capital' ) => 'no-border-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background style for blog posts', 'capital' ),
					'param_name' => 'capital_style_bg',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'White', 'capital' ) => 'white-bg-style', esc_html__( 'Theme primary color', 'capital' ) => 'primary-bg-style', esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-bg-style', esc_html__( 'Custom', 'capital' ) => 'custom-bg-style', esc_html__( 'None', 'capital' ) => 'no-bg-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom background color', 'capital' ),
					'param_name' => 'capital_style_bg_custom',
					'group'      => esc_html__( 'Style', 'capital' ),
					'dependency' => array('element' => 'capital_style_bg', 'value' => 'custom-bg-style'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Skin style for blog posts', 'capital' ),
					'param_name' => 'capital_style_skin',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Light', 'capital' ) => 'light-skin-style', esc_html__( 'Dark', 'capital' ) => 'dark-skin-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			)
		) 
	);
	
	
	/* Testimonial Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Testimonials", "capital" ),
			"base" => "capital_testimonials",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Style', 'capital' ),
					'param_name' => 'style',
					'value' => array( esc_html__( 'Style 1', 'capital' ) => 'testimonials-style1', esc_html__( 'Style2', 'capital' ) => 'testimonials-style2', esc_html__( 'Style3', 'capital' ) => 'testimonials-style3') ,
					'description' => esc_html__( 'Select style for testimonials.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'View Style', 'capital' ),
					'param_name' => 'view',
					'value' => array( esc_html__( 'Grid', 'capital' ) => 'grid', esc_html__( 'Carousel', 'capital' ) => 'carousel' ) ,
					'description' => esc_html__( 'Select view style for testimonials.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'style', 'value' => 'testimonials-style1'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grid Column', 'capital' ),
					'param_name' => 'grid_column',
					'value' => array( esc_html__( 'One Column', 'capital' ) => 12, esc_html__( 'Two Columns', 'capital' ) => 6, esc_html__( 'Three Columns', 'capital' ) => 4, esc_html__( 'Four Columns', 'capital' ) => 3) ,
					'description' => esc_html__( 'Select columns of grid/carousel.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'style', 'value' => 'testimonials-style1'),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel next/prev arrows?', 'capital'),
					'param_name' => 'carousel_arrows',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel next/prev arrows position?', 'capital' ),
					'param_name' => 'carousel_arrows_position',
					'value' => array( esc_html__( 'Below Carousel', 'capital' ) => 'owl-arrows-bottom', esc_html__( 'Over Carousel', 'capital' ) => 'owl-arrows-over') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'carousel_arrows',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel pagination?', 'capital'),
					'param_name' => 'carousel_pagi',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Autoplay Carousel?', 'capital'),
					'param_name' => 'carousel_autoplay',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Auto Rotate Timeout?', 'capital' ),
					'param_name' => 'carousel_autoplay_timeout',
					'description' => esc_html__('Autoplay interval timeout. 1000 = 1 second.', 'capital'),
					'std' => '',
					'dependency' => array(
						'element' => 'carousel_autoplay',
						'value' => '1',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Carousel stage padding?', 'capital' ),
					'param_name' => 'carousel_padding',
					'description' => esc_html__('Padding left and right on stage. Allow to show neighbour items on left and right sides. Enter only in numbers, for example: 100', 'capital'),
					'std' => '',
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Loop carousel?', 'capital' ),
					'param_name' => 'carousel_loop',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'description' => esc_html__('If you want the carousel to keep rotating using pagination and next/prev buttons without scrolling back. Auto height will not work if loop is enabled.', 'capital'),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show testimonial author photo?', 'capital' ),
					'param_name' => 'photo',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show testimonial author title?', 'capital' ),
					'param_name' => 'author',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show testimonial sub title?', 'capital' ),
					'param_name' => 'subtitle',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image position?', 'capital' ),
					'param_name' => 'image_position',
					'value' => array( esc_html__( 'Left', 'capital' ) => 'pull-left', esc_html__( 'Right', 'capital' ) => 'pull-right') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'style', 'value' => array('testimonials-style3')),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image shape?', 'capital' ),
					'param_name' => 'image_radius',
					'value' => array( esc_html__( 'Round', 'capital' ) => 'full-border-radius', esc_html__( 'Square', 'capital' ) => 'no-border-radius') ,
					'param_holder_class' => 'vc_colored-dropdown'
				),
				array(
					'type' => 'autocomplete',
					'class' => '',
					'heading' => esc_html__( 'Testimonial Categories', 'capital' ),
					'param_name' => 'terms',
					'description' => esc_html__( 'Show testimonials by specific categories. Search and enter by typing category names.', 'capital' ),
					'settings'		=> array( 'values' => $testimonialsterms,'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true, ),
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of Testimonials', 'capital' ),
					'param_name' => 'number',
					'value' => 4,
					'description' => esc_html__( 'Insert number of testimonials to show per page.', 'capital' )
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'capital' ),
					'param_name' => 'pagination',
					'description' => esc_html__( 'Show pagination for tesimonials.', 'capital' ),
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid' ),
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Spaced items', 'capital' ),
					'param_name' => 'capital_style_spacing',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Spaced', 'capital' ) => 'spaced-items', esc_html__( 'No space', 'capital' ) => 'non-spaced-items') ,
					'description' => esc_html__( 'Choose if you want to have space/gutter between posts or not.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Border style for testimonial posts', 'capital' ),
					'param_name' => 'capital_style_border',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Shadow', 'capital' ) => 'shadow-border-style', esc_html__( 'Border', 'capital' ) => 'basic-border-style', esc_html__( 'None', 'capital' ) => 'no-border-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'no-border-style'
				),
				array(
					'type' 	=> 'dropdown',
					'heading' => esc_html__( 'Background style for testimonial posts', 'capital' ),
					'param_name' => 'capital_style_bg',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'White', 'capital' ) => 'white-bg-style', esc_html__( 'Theme primary color', 'capital' ) => 'primary-bg-style', esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-bg-style', esc_html__( 'Custom', 'capital' ) => 'custom-bg-style', esc_html__( 'None', 'capital' ) => 'no-bg-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'no-bg-style'
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom background color', 'capital' ),
					'param_name' => 'capital_style_bg_custom',
					'group'      => esc_html__( 'Style', 'capital' ),
					'dependency' => array('element' => 'capital_style_bg', 'value' => 'custom-bg-style'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Skin style for testimonial posts', 'capital' ),
					'param_name' => 'capital_style_skin',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Light', 'capital' ) => 'light-skin-style', esc_html__( 'Dark', 'capital' ) => 'dark-skin-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			)
		) 
	);
	
	/* Team Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Team", "capital" ),
			"base" => "capital_team",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'View Style', 'capital' ),
					'param_name' => 'view',
					'value' => array( esc_html__( 'List', 'capital' ) => 'list', esc_html__( 'Grid', 'capital' ) => 'grid', esc_html__( 'Carousel', 'capital' ) => 'carousel' ) ,
					'description' => esc_html__( 'Select view style for team.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grid Column', 'capital' ),
					'param_name' => 'grid_column',
					'value' => array( esc_html__( 'One Column', 'capital' ) => 12, esc_html__( 'Two Columns', 'capital' ) => 6, esc_html__( 'Three Columns', 'capital' ) => 4, esc_html__( 'Four Columns', 'capital' ) => 3, esc_html__( 'Six Columns', 'capital' ) => 2) ,
					'description' => esc_html__( 'Select columns of grid/carousel.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','carousel' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel next/prev arrows?', 'capital'),
					'param_name' => 'carousel_arrows',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel next/prev arrows position?', 'capital' ),
					'param_name' => 'carousel_arrows_position',
					'value' => array( esc_html__( 'Below Carousel', 'capital' ) => 'owl-arrows-bottom', esc_html__( 'Over Carousel', 'capital' ) => 'owl-arrows-over') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'carousel_arrows',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel pagination?', 'capital'),
					'param_name' => 'carousel_pagi',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Autoplay Carousel?', 'capital'),
					'param_name' => 'carousel_autoplay',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Auto Rotate Timeout?', 'capital' ),
					'param_name' => 'carousel_autoplay_timeout',
					'description' => esc_html__('Autoplay interval timeout. 1000 = 1 second.', 'capital'),
					'std' => '',
					'dependency' => array(
						'element' => 'carousel_autoplay',
						'value' => '1',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Carousel stage padding?', 'capital' ),
					'param_name' => 'carousel_padding',
					'description' => esc_html__('Padding left and right on stage. Allow to show neighbour items on left and right sides. Enter only in numbers, for example: 100', 'capital'),
					'std' => '',
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Loop carousel?', 'capital' ),
					'param_name' => 'carousel_loop',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'description' => esc_html__('If you want the carousel to keep rotating using pagination and naxt/prev buttons without scrolling back.', 'capital'),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show team member designation?', 'capital' ),
					'param_name' => 'staff_position',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show team member contact/social links?', 'capital' ),
					'param_name' => 'staff_social',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Excerpt?', 'capital' ),
					'param_name' => 'show_excerpt',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of words to show as excerpt', 'capital' ),
					'param_name' => 'excerpt_number',
					'value' => 60,
					'dependency' => array(
						'element' => 'show_excerpt',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show read more button?', 'capital' ),
					'param_name' => 'more',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Read more button label', 'capital' ),
					'param_name' => 'more_text',
					'value' => 'View profile',
					'dependency' => array(
						'element' => 'more',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Link title/image to details page?', 'capital' ),
					'param_name' => 'permalink',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show thumnail?', 'capital' ),
					'param_name' => 'thumb',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'capital' ),
					'param_name' => 'img_size',
					'value' => '400x400',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'capital' ),
				),
				array(
					'type' => 'autocomplete',
					'class' => '',
					'heading' => esc_html__( 'Team Categories', 'capital' ),
					'param_name' => 'terms',
					'description' => esc_html__( 'Show team by specific categories. Search and enter by typing category names.', 'capital' ),
					'settings'		=> array( 'values' => $teamterms,'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true, ),
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of Team members', 'capital' ),
					'param_name' => 'number',
					'value' => 4,
					'description' => esc_html__( 'Insert number of team to show per page.', 'capital' )
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'capital' ),
					'param_name' => 'pagination',
					'description' => esc_html__( 'Show pagination. This will work on an individual team page not on homepage.', 'capital' ),
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','list' ),
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Spaced items', 'capital' ),
					'param_name' => 'capital_style_spacing',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Spaced', 'capital' ) => 'spaced-items', esc_html__( 'No space', 'capital' ) => 'non-spaced-items') ,
					'description' => esc_html__( 'Choose if you want to have space/gutter between posts or not.', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Border style for team posts', 'capital' ),
					'param_name' => 'capital_style_border',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Shadow', 'capital' ) => 'shadow-border-style', esc_html__( 'Border', 'capital' ) => 'basic-border-style', esc_html__( 'None', 'capital' ) => 'no-border-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background style for team posts', 'capital' ),
					'param_name' => 'capital_style_bg',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'White', 'capital' ) => 'white-bg-style', esc_html__( 'Theme primary color', 'capital' ) => 'primary-bg-style', esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-bg-style', esc_html__( 'Custom', 'capital' ) => 'custom-bg-style', esc_html__( 'None', 'capital' ) => 'no-bg-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom background color', 'capital' ),
					'param_name' => 'capital_style_bg_custom',
					'group'      => esc_html__( 'Style', 'capital' ),
					'dependency' => array('element' => 'capital_style_bg', 'value' => 'custom-bg-style'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Skin style for team posts', 'capital' ),
					'param_name' => 'capital_style_skin',
					'group'      => esc_html__( 'Style', 'capital' ),
					'value' => array( esc_html__( 'Light', 'capital' ) => 'light-skin-style', esc_html__( 'Dark', 'capital' ) => 'dark-skin-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			)
		) 
	);
		
	/* Team Info Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Team info", "capital" ),
			"base" => "capital_teaminfo",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Style', 'capital' ),
					'param_name' => 'tinfo_style',
					'value' => array( esc_html__( 'Horizontal', 'capital' ) => 'tinfo-horizontal-style', esc_html__( 'Vertical', 'capital' ) => 'tinfo-vertical-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Address?', 'capital' ),
					'param_name' => 'tinfo_address',
					'description' => esc_html__( 'Check to show team member postal address.', 'capital' ),
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Phone?', 'capital' ),
					'param_name' => 'tinfo_phone',
					'description' => esc_html__( 'Check to show team member phone number.', 'capital' ),
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Email?', 'capital' ),
					'param_name' => 'tinfo_email',
					'description' => esc_html__( 'Check to show team member email address.', 'capital' ),
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Social Icons?', 'capital' ),
					'param_name' => 'tinfo_social',
					'description' => esc_html__( 'Check to show team member social profile links.', 'capital' ),
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
			)
		)
	);
	
	/* Icon Box Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Icon Box", "capital" ),
			"base" => "capital_ibox",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon library', 'capital' ),
					'value' => array(
						esc_html__( 'Font Awesome', 'capital' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'capital' ) => 'openiconic',
						esc_html__( 'Typicons', 'capital' ) => 'typicons',
						esc_html__( 'Entypo', 'capital' ) => 'entypo',
						esc_html__( 'Linecons', 'capital' ) => 'linecons',
						esc_html__( 'Mono Social', 'capital' ) => 'monosocial',
						esc_html__( 'Material', 'capital' ) => 'material',
					),
					'admin_label' => true,
					'param_name' => 'type',
					'description' => esc_html__( 'Select icon library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-adjust',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'fontawesome',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_openiconic',
					'value' => 'vc-oi vc-oi-dial',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'openiconic',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'openiconic',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_typicons',
					'value' => 'typcn typcn-adjust-brightness',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'typicons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'typicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_entypo',
					'value' => 'entypo-icon entypo-icon-note',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'entypo',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_linecons',
					'value' => 'vc_li vc_li-heart',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'linecons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'linecons',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_monosocial',
					'value' => 'vc-mono vc-mono-fivehundredpx',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'monosocial',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'monosocial',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_material',
					'value' => 'vc-material vc-material-cake',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'material',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'material',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon - Size', 'capital' ),
					'param_name' => 'ibox_icon_size',
					'value' => array( esc_html__( '16px', 'capital' ) => '16px', esc_html__( '32px', 'capital' ) => '32px', esc_html__( '48px', 'capital' ) => '48px', esc_html__( '64px', 'capital' ) => '64px') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => '32px'
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Color', 'capital' ),
					'param_name' => 'ibox_icon_color',
					'value'      => array(
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color',
						esc_html__( 'Custom', 'capital' ) => 'custom'
					),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Color Custom', 'capital' ),
					'param_name' => 'ibox_icon_color_custom',
					'dependency' => array('element' => 'ibox_icon_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'capital' ),
					'param_name' => 'ibox_title',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title - Font Size (Add px)', 'capital' ),
					'param_name' => 'ibox_title_size',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'capital' ),
					'param_name' => 'ibox_title_color',
					'value'      => array(
						esc_html__( 'Custom', 'capital' ) => 'custom',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'capital' ),
					'param_name' => 'ibox_title_color_custom',
					'dependency' => array('element' => 'ibox_title_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Description', 'capital' ),
					'param_name' => 'ibox_desc',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Description - Font Size (Add px)', 'capital' ),
					'param_name' => 'ibox_desc_size',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Description - Color', 'capital' ),
					'param_name' => 'ibox_desc_color',
					'value'      => array(
						esc_html__( 'Custom', 'capital' ) => 'custom',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Description - Color Custom', 'capital' ),
					'param_name' => 'ibox_desc_color_custom',
					'dependency' => array('element' => 'ibox_desc_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'capital' ),
					'param_name' => 'ibox_link',
					'description' => esc_html__( 'Enter/Select URL that will be added to Icon and Title.', 'capital' )
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Center Align?', 'capital' ),
					'param_name' => 'ibox_calign',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 0,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Outline or Border', 'capital' ),
					'param_name' => 'ibox_border',
					'value' => array( esc_html__( 'Outline', 'capital' ) => 'ibox-outline', esc_html__( 'Border', 'capital' ) => 'ibox-border') ,
					'description' => esc_html__( 'Outline comes with background plus border', 'capital' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon box shape', 'capital' ),
					'param_name' => 'ibox_shape',
					'value' => array( esc_html__( 'Circle', 'capital' ) => '', esc_html__( 'Rounded', 'capital' ) => 'ibox-rounded', esc_html__( 'Plain', 'capital' ) => 'ibox-plain') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
			)
		) 
	);
	
	
	/* Featured Block Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Featured Block", "capital" ),
			"base" => "capital_fblock",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Featured Block Style', 'capital' ),
					'param_name' => 'fblock_style',
					'value' => array( esc_html__( 'Style1', 'capital' ) => 'fblock-style1', esc_html__( 'Style2', 'capital' ) => 'fblock-style2') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Featured Block Image', 'capital' ),
					'param_name' => 'fblock_image',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'capital' ),
					'param_name' => 'fblock_img_size',
					'value' => '600x400',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'capital' ),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Overlay Background Color', 'capital' ),
					'param_name' => 'fblock_bg_color',
					'value'      => array(
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-bg',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-bg',
						esc_html__( 'Custom', 'capital' ) => 'custom',
					),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Overlay/Content Background Color Custom', 'capital' ),
					'param_name' => 'fblock_bg_color_custom',
					'dependency' => array('element' => 'fblock_bg_color', 'value' => 'custom'),
					'weight'     => 1,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon library', 'capital' ),
					'value' => array(
						esc_html__( 'Font Awesome', 'capital' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'capital' ) => 'openiconic',
						esc_html__( 'Typicons', 'capital' ) => 'typicons',
						esc_html__( 'Entypo', 'capital' ) => 'entypo',
						esc_html__( 'Linecons', 'capital' ) => 'linecons',
						esc_html__( 'Mono Social', 'capital' ) => 'monosocial',
						esc_html__( 'Material', 'capital' ) => 'material',
					),
					'admin_label' => true,
					'param_name' => 'type',
					'description' => esc_html__( 'Select icon library.', 'capital' ),
					'dependency' => array(
						'element' => 'fblock_style',
						'value' => 'fblock-style2',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-adjust',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'fontawesome',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_openiconic',
					'value' => 'vc-oi vc-oi-dial',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'openiconic',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'openiconic',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_typicons',
					'value' => 'typcn typcn-adjust-brightness',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'typicons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'typicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_entypo',
					'value' => 'entypo-icon entypo-icon-note',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'entypo',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_linecons',
					'value' => 'vc_li vc_li-heart',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'linecons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'linecons',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_monosocial',
					'value' => 'vc-mono vc-mono-fivehundredpx',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'monosocial',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'monosocial',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_material',
					'value' => 'vc-material vc-material-cake',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'material',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'material',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Color', 'capital' ),
					'param_name' => 'fblock_icon_color',
					'value'      => array(
						esc_html__( 'Custom', 'capital' ) => 'custom',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color'
					),
					'dependency' => array(
						'element' => 'fblock_style',
						'value' => 'fblock-style2',
					),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Color Custom', 'capital' ),
					'param_name' => 'fblock_icon_color_custom',
					'dependency' => array('element' => 'fblock_icon_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Background Color', 'capital' ),
					'param_name' => 'fblock_icon_bgcolor',
					'value'      => array(
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-bg',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-bg',
						esc_html__( 'Custom', 'capital' ) => 'custom',
					),
					'dependency' => array(
						'element' => 'fblock_style',
						'value' => 'fblock-style2',
					),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Background Color Custom', 'capital' ),
					'param_name' => 'fblock_icon_bgcolor_custom',
					'dependency' => array('element' => 'fblock_icon_bgcolor', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'capital' ),
					'param_name' => 'fblock_title',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title - Font Size (Add px)', 'capital' ),
					'param_name' => 'fblock_title_size',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'capital' ),
					'param_name' => 'fblock_title_color',
					'value'      => array(
						esc_html__( 'Custom', 'capital' ) => 'custom',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'capital' ),
					'param_name' => 'fblock_title_color_custom',
					'dependency' => array('element' => 'fblock_title_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Description', 'capital' ),
					'param_name' => 'fblock_desc',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Description - Font Size (Add px)', 'capital' ),
					'param_name' => 'fblock_desc_size',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Description - Color', 'capital' ),
					'param_name' => 'fblock_desc_color',
					'value'      => array(
						esc_html__( 'Custom', 'capital' ) => 'custom',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Description - Color Custom', 'capital' ),
					'param_name' => 'fblock_desc_color_custom',
					'dependency' => array('element' => 'fblock_desc_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'capital' ),
					'param_name' => 'fblock_link',
					'description' => esc_html__( 'Enter/Select URL for the featured block.', 'capital' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
			)
		) 
	);
	
	
	/* Progress Bar Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Progress Bar", "capital" ),
			"base" => "capital_pbar",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'capital' ),
					'param_name' => 'pbar_title',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'capital' ),
					'param_name' => 'pbar_title_color',
					'value'      => array(
						esc_html__( 'Custom', 'capital' ) => 'custom',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'capital' ),
					'param_name' => 'pbar_title_color_custom',
					'dependency' => array('element' => 'pbar_title_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Percentage (add %)', 'capital' ),
					'description' => esc_html__( 'Maximum upto 100%', 'capital' ),
					'param_name' => 'pbar_perc',
					'value'      => ''
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show percentage?', 'capital' ),
					'description' => esc_html__( 'Uncheck to hide the percentage.', 'capital' ),
					'param_name' => 'pbar_show_perc',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Percentage - Color', 'capital' ),
					'param_name' => 'pbar_perc_color',
					'value'      => array(
						esc_html__( 'Custom', 'capital' ) => 'custom',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color'
					),
					'dependency' => array('element' => 'pbar_show_perc', 'value' => '1'),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Percentage - Color Custom', 'capital' ),
					'param_name' => 'pbar_perc_color_custom',
					'dependency' => array('element' => 'pbar_perc_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Animation delay (Milliseconds)', 'capital' ),
					'param_name' => 'pbar_animation',
					'value'      => '100'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Progress bar - Height', 'capital' ),
					'param_name' => 'pbar_height',
					'value' => '10px',
					'description' => esc_html__( 'Enter height of the bar (Add px)', 'capital' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Progress bar - Color', 'capital' ),
					'param_name' => 'pbar_style',
					'value' => array( esc_html__( 'Primary Color', 'capital' ) => 'primary',esc_html__( 'Secondary Color', 'capital' ) => 'secondary', esc_html__( 'Orange', 'capital' ) => 'warning', esc_html__( 'Green', 'capital' ) => 'success', esc_html__( 'Red', 'capital' ) => 'danger', esc_html__( 'Blue', 'capital' ) => 'info', esc_html__( 'Custom Color', 'capital' ) => 'custom') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'primary'
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Progress bar - Color Custom', 'capital' ),
					'param_name' => 'pbar_style_color_custom',
					'dependency' => array('element' => 'pbar_style', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Progress bar - Base Color', 'capital' ),
					'param_name' => 'pbar_base_color',
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Progress bar - Style', 'capital' ),
					'param_name' => 'pbar_striped',
					'value' => array( esc_html__( 'Striped', 'capital' ) => 'progress-striped', esc_html__( 'Non striped', 'capital' ) => 'no-progress-striped') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => '32px'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Progress bar rounded corners', 'capital' ),
					'description' => esc_html__( 'Uncheck to have square/plain corners of the progress bar', 'capital' ),
					'param_name' => 'pbar_rounded',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
			)
		) 
	);
	
	
	/* Round Progress Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Round Progress", "capital" ),
			"base" => "capital_rprogress",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'capital' ),
					'param_name' => 'rprogress_title',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'capital' ),
					'param_name' => 'rprogress_title_color',
					'value'      => array(
						esc_html__( 'Custom', 'capital' ) => 'custom',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'capital' ),
					'param_name' => 'rprogress_title_color_custom',
					'dependency' => array('element' => 'rprogress_title_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Percentage (DO NOT ADD %)', 'capital' ),
					'param_name' => 'rprogress_perc',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show percentage?', 'capital' ),
					'description' => esc_html__( 'Uncheck to hide the percentage.', 'capital' ),
					'param_name' => 'rprogress_show_perc',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'std' => 1,
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Percentage - Color', 'capital' ),
					'param_name' => 'rprogress_perc_color',
					'value'      => array(
						esc_html__( 'Custom', 'capital' ) => 'custom',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color'
					),
					'dependency' => array('element' => 'rprogress_show_perc', 'value' => '1'),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Percentage - Color Custom', 'capital' ),
					'param_name' => 'rprogress_perc_color_custom',
					'dependency' => array('element' => 'rprogress_perc_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Progress bar - Color', 'capital' ),
					'param_name' => 'rprogress_color',
					'weight'     => 1
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Progress bar - Base Color', 'capital' ),
					'param_name' => 'rprogress_base_color',
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Thickness', 'capital' ),
					'param_name' => 'rprogress_thickness',
					'value' => array( esc_html__( '.1', 'capital' ) => '.1', esc_html__( '.2', 'capital' ) => '.2', esc_html__( '.3', 'capital' ) => '.3', esc_html__( '.4', 'capital' ) => '.4', esc_html__( '.5', 'capital' ) => '.5') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => '.2'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
			)
		) 
	);
	
	
	/* Number Counter Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Number Counter", "capital" ),
			"base" => "capital_counter",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon library', 'capital' ),
					'value' => array(
						esc_html__( 'Font Awesome', 'capital' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'capital' ) => 'openiconic',
						esc_html__( 'Typicons', 'capital' ) => 'typicons',
						esc_html__( 'Entypo', 'capital' ) => 'entypo',
						esc_html__( 'Linecons', 'capital' ) => 'linecons',
						esc_html__( 'Mono Social', 'capital' ) => 'monosocial',
						esc_html__( 'Material', 'capital' ) => 'material',
					),
					'admin_label' => true,
					'param_name' => 'type',
					'description' => esc_html__( 'Select icon library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_fontawesome',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'fontawesome',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_openiconic',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'openiconic',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'openiconic',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_typicons',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'typicons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'typicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_entypo',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'entypo',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_linecons',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'linecons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'linecons',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_monosocial',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'monosocial',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'monosocial',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'capital' ),
					'param_name' => 'icon_material',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'material',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'material',
					),
					'description' => esc_html__( 'Select icon from library.', 'capital' ),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Color', 'capital' ),
					'param_name' => 'counter_icon_color',
					'value'      => array(
						esc_html__( 'Theme Secondary color', 'capital' ) => 'secondary-color',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Custom', 'capital' ) => 'custom',
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Color Custom', 'capital' ),
					'param_name' => 'counter_icon_color_custom',
					'dependency' => array('element' => 'counter_icon_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon - Font size', 'capital' ),
					'param_name' => 'counter_icon_font',
					'value' => '55px',
					'description' => esc_html__( 'Icon - font size (Add px)', 'capital' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Background Color', 'capital' ),
					'param_name' => 'counter_icon_bgcolor',
					'value'      => array(
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-bg',
						esc_html__( 'Theme Secondary color', 'capital' ) => 'secondary-bg',
						esc_html__( 'Custom', 'capital' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Background Color Custom', 'capital' ),
					'param_name' => 'counter_icon_bgcolor_custom',
					'dependency' => array('element' => 'counter_icon_bgcolor', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon background shape', 'capital' ),
					'param_name' => 'counter_icon_bgshape',
					'value'      => array(
						esc_html__( 'Round', 'capital' ) => 'counter-icon-round',
						esc_html__( 'Rounded', 'capital' ) => 'counter-icon-rounded',
						esc_html__( 'Square', 'capital' ) => 'counter-icon-square',
						esc_html__( 'Plain(With no background color)', 'capital' ) => 'counter-icon-plain'
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'capital' ),
					'param_name' => 'counter_title',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'capital' ),
					'param_name' => 'counter_title_color',
					'value'      => array(
						esc_html__( 'Custom', 'capital' ) => 'custom',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'capital' ),
					'param_name' => 'counter_title_color_custom',
					'dependency' => array('element' => 'counter_title_color', 'value' => 'custom'),
					'weight' => 1,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title - Font size (Add px)', 'capital' ),
					'param_name' => 'counter_title_font',
					'value' => '15px'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Number to count', 'capital' ),
					'param_name' => 'counter_number',
					'value'      => ''
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Text next to number', 'capital' ),
					'param_name' => 'counter_number_text',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Number - Color', 'capital' ),
					'param_name' => 'counter_number_color',
					'value'      => array(
						esc_html__( 'Custom', 'capital' ) => 'custom',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'capital' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Number - Color Custom', 'capital' ),
					'param_name' => 'counter_number_color_custom',
					'dependency' => array('element' => 'counter_number_color', 'value' => 'custom'),
					'weight' => 1,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number - Font size (Add px)', 'capital' ),
					'param_name' => 'counter_number_font',
					'value' => '30px'
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Align', 'capital' ),
					'param_name' => 'counter_align',
					'value'      => array(
						esc_html__( 'Center', 'capital' ) => 'counter-align-center',
						esc_html__( 'Left', 'capital' ) => 'counter-align-left',
						esc_html__( 'Right', 'capital' ) => 'counter-align-right'
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
			)
		) 
	);
	
	/* Pricing Table Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Pricing Table", "capital" ),
			"base" => "capital_pricing",
			'as_parent' => array( 'only' => 'capital_pricing_item' ),
			'show_settings_on_create' => true,
			"category" => esc_html__( "Capital", "capital"),
			"params" => array(
				array(
					'type' 					=> 'dropdown',
					'heading' 				=> esc_html__( 'Columns', 'capital' ),
					'param_name' 			=> 'pricing_columns',
					'value' 					=> array( esc_html__( '1', 'capital' ) => 'one-cols', esc_html__( '2', 'capital' ) => 'two-cols', esc_html__( '3', 'capital' ) => 'three-cols', esc_html__( '4', 'capital' ) => 'four-cols', esc_html__( '5', 'capital' ) => 'five-cols', esc_html__( '6', 'capital' ) => 'six-cols') ,
					'param_holder_class' 	=> 'vc_colored-dropdown',
					'std' 					=> 'three-cols'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				)
			),
			'js_view'                 => 'VcColumnView'
		) 
	);
	/* Pricing Table Column Shortcode
		=====================================================*/
		vc_map( array(
			'name'     => esc_html__( 'Pricing Column', 'capital' ),
			'base'     => 'capital_pricing_item',
			'as_child' => array( 'only' => 'capital_pricing' ),
			'category' => esc_html__( 'Capital', 'capital' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'capital' ),
					'param_name' => 'pricing_title',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Popular Plan?', 'capital' ),
					'param_name' => 'pricing_popular',
					'value' => array( esc_html__( 'Yes', 'capital' ) => true ),
					'description' => esc_html__( 'Check to highlight this plan among others. You should check this only for a plan to keep your pricing table in good looks.', 'capital' ),
					'std' => 0,
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Popular reason', 'capital' ),
					'param_name' => 'pricing_popular_reason',
					'description' => esc_html__( 'Enter couple of words to show why this plan is popular. Example: Big savings.', 'capital' ),
					'value'      => '',
					'weight'     => 1,
					'dependency' => array(
						'element' => 'pricing_popular',
						'value' => '1',
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Price', 'capital' ),
					'param_name' => 'pricing_price',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Currency', 'capital' ),
					'param_name' => 'pricing_currency',
					'value'      => '$',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Price Term', 'capital' ),
					'description' => esc_html__( 'Enter term for the price of the plan. Example: Per Month.', 'capital' ),
					'param_name' => 'pricing_term',
					'value'      => esc_html__( 'Per Month', 'capital' ),
					'weight'     => 1
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Features', 'capital' ),
					'group'      => esc_html__( 'Features', 'capital' ),
					'param_name' => 'pricing_features',
					'value' => urlencode( json_encode( array(
						array(
							'title' => esc_html__( 'This is included', 'capital' ),
						),
						array(
							'title' => esc_html__( 'And this too', 'capital' ),
						),
					) ) ),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Feature', 'capital' ),
							'param_name' => 'title',
							'description' => esc_html__( 'Enter features of the pricing plan.', 'capital' ),
							'admin_label' => true,
						),
					),
					'callbacks' => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Button Label', 'capital' ),
					'param_name' => 'pricing_button',
					'value'      => esc_html__( 'Sign Up Now!', 'capital' ),
					'group'      => esc_html__( 'Button', 'capital' ),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Color', 'capital' ),
					'group'      => esc_html__( 'Button', 'capital' ),
					'param_name' => 'pricing_button_color',
					'value' => array( esc_html__( 'Primary Color', 'capital' ) => 'btn-primary', esc_html__( 'Secondary Color', 'capital' ) => 'secondary-btn', esc_html__( 'Orange', 'capital' ) => 'btn-warning', esc_html__( 'Green', 'capital' ) => 'btn-success', esc_html__( 'Red', 'capital' ) => 'btn-danger', esc_html__( 'Blue', 'capital' ) => 'btn-info') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'primary'
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'capital' ),
					'group'      => esc_html__( 'Button', 'capital' ),
					'param_name' => 'pricing_button_link',
					'description' => esc_html__( 'Enter/Select URL for the button.', 'capital' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
			)
		)
	);
		
		
	/* Timeline Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Timeline", "capital" ),
			"base" => "capital_timeline",
			'as_parent' => array( 'only' => 'capital_timeline_item' ),
			'show_settings_on_create' => false,
			"category" => esc_html__( "Capital", "capital"),
			"params" => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				)
			),
			'js_view'                 => 'VcColumnView'
		) 
	);
	/* Timeline Item Shortcode
		=====================================================*/
		vc_map( array(
			'name'     => esc_html__( 'Timeline Item', 'capital' ),
			'base'     => 'capital_timeline_item',
			'as_child' => array( 'only' => 'capital_timeline' ),
			'category' => esc_html__( 'Capital', 'capital' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Year/Month/Date', 'capital' ),
					'param_name' => 'timeline_date',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'capital' ),
					'param_name' => 'timeline_title',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Content', 'capital' ),
					'param_name' => 'timeline_content',
					'value'      => '',
					'weight'     => 1
				),
			)
		)
	);
	/* VC Sections Shortcode
		=====================================================*/
		vc_map( array(
			'name'     => esc_html__( 'VC Section', 'capital' ),
			'base'     => 'capital_custom_sidebar',
			'category' => esc_html__( 'Capital', 'capital' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'VC Section', 'capital' ),
					'param_name' => 'sidebar',
					'value'      => $vc_sections
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				)
			)
		)
	);
		
	
	/* Popup video button Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Popup video button", "capital" ),
			"base" => "capital_video_button",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Video Link', 'capital' ),
					'param_name' => 'video_btn_link',
					'description' => esc_html__( 'Enter link to video (YouTube or Vimeo).', 'capital' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Button size', 'capital' ),
					'param_name' => 'video_btn_size',
					'value'      => array(
						esc_html__( 'Small', 'capital' ) => 'video-btn-small',
						esc_html__( 'Medium', 'capital' ) => 'video-btn-medium',
						esc_html__( 'Large', 'capital' ) => 'video-btn-large',
						esc_html__( 'Extra Large', 'capital' ) => 'video-btn-xlarge'
					),
					'std' => 'video-btn-small',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Button shape', 'capital' ),
					'param_name' => 'video_btn_shape',
					'value'      => array(
						esc_html__( 'Round', 'capital' ) => 'video-btn-round',
						esc_html__( 'Square', 'capital' ) => 'video-btn-square',
						esc_html__( 'Rounded', 'capital' ) => 'video-btn-rounded'
					),
					'std' => 'video-btn-round',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Button Align', 'capital' ),
					'param_name' => 'video_btn_align',
					'value'      => array(
						esc_html__( 'Center', 'capital' ) => 'video-btn-align-center',
						esc_html__( 'Left', 'capital' ) => 'video-btn-align-left',
						esc_html__( 'Right', 'capital' ) => 'video-btn-align-right'
					),
					'std' => 'video-btn-align-center',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Play icon - Color', 'capital' ),
					'param_name' => 'video_btn_icon_color',
					'value'      => array(
						esc_html__( 'Theme Secondary color', 'capital' ) => 'secondary-color',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Custom', 'capital' ) => 'custom',
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Play icon - Color Custom', 'capital' ),
					'param_name' => 'video_btn_icon_color_custom',
					'dependency' => array('element' => 'video_btn_icon_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Play icon - Background Color', 'capital' ),
					'param_name' => 'video_btn_icon_bgcolor',
					'value'      => array(
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-bg',
						esc_html__( 'Theme Secondary color', 'capital' ) => 'secondary-bg',
						esc_html__( 'Custom', 'capital' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Play icon - Background Color Custom', 'capital' ),
					'param_name' => 'video_btn_icon_bgcolor_custom',
					'dependency' => array('element' => 'video_btn_icon_bgcolor', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
			)
		) 
	);
		
		
	/* Opening Hours Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Opening Hours", "capital" ),
			"base" => "capital_opening_hours",
			"category" => esc_html__( "Capital", "capital"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Day row', 'capital' ),
					'param_name' => 'opening_days',
					'value' => urlencode( json_encode( array(
						array(
							'day' => esc_html__( 'Monday', 'capital' ),
							'hours' => esc_html__( '09:00 to 05:00', 'capital' ),
						),
						array(
							'day' => esc_html__( 'Tuesday', 'capital' ),
							'hours' => esc_html__( '09:00 to 05:00', 'capital' ),
						),
					) ) ),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Day', 'capital' ),
							'param_name' => 'day',
							'description' => esc_html__( 'Enter weekday', 'capital' ),
							'admin_label' => true,
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Hours', 'capital' ),
							'param_name' => 'hours',
							'description' => esc_html__( 'Enter working hours', 'capital' ),
							'admin_label' => true,
						),
					),
					'callbacks' => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Separator border style', 'capital' ),
					'param_name' => 'opening_hours_sstyle',
					'value'      => array(
						esc_html__( 'Dark', 'capital' ) => 'opening-hours-sstyle-dark',
						esc_html__( 'Light', 'capital' ) => 'opening-hours-sstyle-light'
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Text Color', 'capital' ),
					'param_name' => 'opening_hours_color',
					'value'      => array(
						esc_html__( 'Theme Secondary color', 'capital' ) => 'secondary-color',
						esc_html__( 'Theme primary color', 'capital' ) => 'accent-color',
						esc_html__( 'Custom', 'capital' ) => 'custom',
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Text Color Custom', 'capital' ),
					'param_name' => 'opening_hours_color_custom',
					'dependency' => array('element' => 'opening_hours_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'capital' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'capital' )
				),
			)
		) 
	);
	
	
	}
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Capital_Pricing extends WPBakeryShortCodesContainer {
	}
	class WPBakeryShortCode_Capital_Timeline extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Capital_Opening_Hours extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Video_Button extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Pricing_Item extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Timeline_Item extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Project extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Services extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Posts extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Testimonials extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Team extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Teaminfo extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Ibox extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Fblock extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Pbar extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Counter extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Rprogress extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Capital_Custom_Sidebar extends WPBakeryShortCode {
	}
}