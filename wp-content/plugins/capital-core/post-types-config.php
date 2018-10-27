<?php
$options = get_option('capital_options');
$project_post_title = (isset($options['project_post_title'])&&$options['project_post_title'] != '')?$options['project_post_title']:esc_html__('Project','capital');
$project_post_plural_title = (isset($options['project_post_plural_title'])&&$options['project_post_plural_title'] != '')?$options['project_post_plural_title']:esc_html__('Projects','capital');
$project_post_all_title = (isset($options['project_post_all_title'])&&$options['project_post_all_title'] != '')?$options['project_post_all_title']:esc_html__('Projects','capital');
$project_post_slug = (isset($options['project_post_slug'])&&$options['project_post_slug'] != '')?$options['project_post_slug']:esc_html__('project','capital');
$project_post_icon = (isset($options['project_post_icon'])&&$options['project_post_icon'] != '')?$options['project_post_icon']:'dashicons-portfolio';
$disable_project_archive = (isset($options['disable_project_archive']))?$options['disable_project_archive']:0;
$project_archive = $disable_project_archive ? false : true;

$service_post_title = (isset($options['service_post_title'])&&$options['service_post_title'] != '')?$options['service_post_title']:esc_html__('Service','capital');
$service_post_plural_title = (isset($options['service_post_plural_title'])&&$options['service_post_plural_title'] != '')?$options['service_post_plural_title']:esc_html__('Services','capital');
$service_post_all_title = (isset($options['service_post_all_title'])&&$options['service_post_all_title'] != '')?$options['service_post_all_title']:esc_html__('Services','capital');
$service_post_slug = (isset($options['service_post_slug'])&&$options['service_post_slug'] != '')?$options['service_post_slug']:esc_html__('service','capital');
$service_post_icon = (isset($options['service_post_icon'])&&$options['service_post_icon'] != '')?$options['service_post_icon']:'dashicons-clipboard';
$disable_service_archive = (isset($options['disable_service_archive']))?$options['disable_service_archive']:0;
$service_archive = $disable_service_archive ? false : true;

$team_post_title = (isset($options['team_post_title'])&&$options['team_post_title'] != '')?$options['team_post_title']:esc_html__('Team','capital');
$team_post_plural_title = (isset($options['team_post_plural_title'])&&$options['team_post_plural_title'] != '')?$options['team_post_plural_title']:esc_html__('Team','capital');
$team_post_all_title = (isset($options['team_post_all_title'])&&$options['team_post_all_title'] != '')?$options['team_post_all_title']:esc_html__('Team','capital');
$team_post_slug = (isset($options['team_post_slug'])&&$options['team_post_slug'] != '')?$options['team_post_slug']:esc_html__('team','capital');
$team_post_icon = (isset($options['team_post_icon'])&&$options['team_post_icon'] != '')?$options['team_post_icon']:'dashicons-groups';
$disable_team_archive = (isset($options['disable_team_archive']))?$options['disable_team_archive']:0;
$team_archive = $disable_team_archive ? false : true;

$testimonial_post_title = (isset($options['testimonial_post_title'])&&$options['testimonial_post_title'] != '')?$options['testimonial_post_title']:esc_html__('Testimonial','capital');
$testimonial_post_plural_title = (isset($options['testimonial_post_plural_title'])&&$options['testimonial_post_plural_title'] != '')?$options['testimonial_post_plural_title']:esc_html__('Testimonials','capital');
$testimonial_post_all_title = (isset($options['testimonial_post_all_title'])&&$options['testimonial_post_all_title'] != '')?$options['testimonial_post_all_title']:esc_html__('Testimonials','capital');
$testimonial_post_slug = (isset($options['testimonial_post_slug'])&&$options['testimonial_post_slug'] != '')?$options['testimonial_post_slug']:esc_html__('testimonial','capital');
$testimonial_post_icon = (isset($options['testimonial_post_icon'])&&$options['testimonial_post_icon'] != '')?$options['testimonial_post_icon']:'dashicons-testimonial';
$disable_testimonial_archive = (isset($options['disable_testimonial_archive']))?$options['disable_testimonial_archive']:0;
$testimonial_archive = $disable_testimonial_archive ? false : true;

$defaultPostTypesOptions = array(
	'imi_services'     			=> array(
		'title'               	=> $service_post_title,
		'plural_title'        	=> $service_post_plural_title,
		'all_items'           	=> $service_post_all_title,
		'rewrite'             	=> $service_post_slug,
		'icon'                	=> $service_post_icon,
		'has_archive'		  	=> $service_archive,
		'supports'     			=> array( 'title', 'thumbnail', 'editor', 'excerpt' )
	),
	'imi_team'       			=> array(
		'title'               	=> $team_post_title,
		'plural_title'        	=> $team_post_plural_title,
		'all_items'           	=> $team_post_all_title,
		'rewrite'             	=> $team_post_slug,
		'icon'                	=> $team_post_icon,
		'has_archive'		  	=> $team_archive,
		'supports'            	=> array( 'title', 'excerpt', 'editor', 'thumbnail' )
	),
	'imi_projects'   			=> array(
		'title'         		=> $project_post_title,
		'plural_title' 			=> $project_post_plural_title,
		'all_items'     		=> $project_post_all_title,
		'rewrite'     			=> $project_post_slug,
		'icon'      			=> $project_post_icon,
		'has_archive'			=> $project_archive,
		'supports'     			=> array( 'title', 'excerpt', 'editor', 'thumbnail' )
	),
	'imi_testimonials' 			=> array(
		'title'       			=> $testimonial_post_title,
		'plural_title' 			=> $testimonial_post_plural_title,
		'all_items'           	=> $testimonial_post_all_title,
		'rewrite'             	=> $testimonial_post_slug,
		'icon'                	=> $testimonial_post_icon,
		'has_archive'		  	=> $testimonial_archive,
		'supports'            	=> array( 'title', 'excerpt', 'thumbnail' ),
		'exclude_from_search' 	=> true,
		'publicly_queryable'  	=> false
	),
	'imi_custom_sidebar'  => array(
		'title'               => esc_html__('VC Sections','capital'),
		'plural_title'        => esc_html__('VC Sections','capital'),
		'all_items'           => esc_html__('All VC Sections','capital'),
		'rewrite'             => 'vc_section',
		'icon'                => 'dashicons-align-left',
		'supports'            => array('title','editor'),
		'exclude_from_search' => true,
		'publicly_queryable'  => false
	),
);

foreach ( $defaultPostTypesOptions as $post_type => $data ) {
	$args = array();

	if ( ! empty( $data['plural_title'] ) ) {
		$args['pluralTitle'] = $data['plural_title'];
	}
	if ( ! empty( $data['all_items'] ) ) {
		$args['all_items'] = $data['all_items'];
	}
	if ( ! empty( $data['icon'] ) ) {
		$args['menu_icon'] = $data['icon'];
	}
	if ( ! empty( $data['rewrite'] ) ) {
		$args['rewrite'] = array( 'slug' => $data['rewrite'] );
	}
	if ( ! empty( $data['supports'] ) ) {
		$args['supports'] = $data['supports'];
	}
	if ( ! empty( $data['exclude_from_search'] ) ) {
		$args['exclude_from_search'] = $data['exclude_from_search'];
	}
	if ( ! empty( $data['publicly_queryable'] ) ) {
		$args['publicly_queryable'] = $data['publicly_queryable'];
	}
	if ( ! empty( $data['show_in_menu'] ) ) {
		$args['show_in_menu'] = $data['show_in_menu'];
	}
	if ( ! empty( $data['has_archive'] ) ) {
		$args['has_archive'] = $data['has_archive'];
	}
	IMI_PostType::registerPostType( $post_type, esc_html( $data['title'] ), $args );
}

IMI_PostType::addTaxonomy( 'imi_team_category', esc_html__( 'Categories', 'capital' ), 'imi_team' );
IMI_PostType::addTaxonomy( 'imi_projects_category', esc_html__( 'Categories', 'capital' ), 'imi_projects' );
IMI_PostType::addTaxonomy( 'imi_testimonials_category', esc_html__( 'Categories', 'capital' ), 'imi_testimonials' );
IMI_PostType::addTaxonomy( 'imi_services_category', esc_html__( 'Categories', 'capital' ), 'imi_services' );