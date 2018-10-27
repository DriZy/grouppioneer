<?php
add_action( 'init', array( 'IMI_PostType', 'init' ), 1 );

class IMI_PostType {

	protected static $PostTypes = array();
	protected static $Taxonomies = array();

	public static function init() {

		self::register_custom_post_types();
		self::register_taxonomies();

	}

	public static function registerPostType( $postType, $title, $args ) {

		$pluralTitle = empty( $args['pluralTitle'] ) ? $title . 's' : $args['pluralTitle'];
		$allItems = empty( $args['all_items'] ) ? $pluralTitle : $args['all_items'];
		$labels      = array(
			'name'               => __( $pluralTitle, 'capital-core' ),
			'singular_name'      => __( $title, 'capital-core' ),
			'add_new'            => __( 'Add New', 'capital-core' ),
			'add_new_item'       => __( 'Add New ' . $title, 'capital-core' ),
			'edit_item'          => __( 'Edit ' . $title, 'capital-core' ),
			'new_item'           => __( 'New ' . $title, 'capital-core' ),
			'all_items'          => __( $allItems, 'capital-core' ),
			'view_item'          => __( 'View ' . $title, 'capital-core' ),
			'search_items'       => __( 'Search ' . $pluralTitle, 'capital-core' ),
			'not_found'          => __( 'No ' . $pluralTitle . ' found', 'capital-core' ),
			'not_found_in_trash' => __( 'No ' . $pluralTitle . '  found in Trash', 'capital-core' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( $pluralTitle, 'capital-core' )
		);

		$defaults = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => null,
			'supports'           => array( 'title', 'editor' )
		);

		$args                         = wp_parse_args( $args, $defaults );
		self::$PostTypes[ $postType ] = $args;

	}

	public static function register_custom_post_types() {
		foreach ( self::$PostTypes as $postType => $args ) {
			register_post_type( $postType, $args );
		}
	}

	public static function addTaxonomy( $slug, $taxonomyName, $post_type, $args = '' ) {

		$pluralName = empty( $args['plural'] ) ? $taxonomyName . 's' : $args['plural'];
		$labels     = array(
			'name'              => _x( $taxonomyName, 'taxonomy general name', 'capital-core' ),
			'singular_name'     => _x( $taxonomyName, 'taxonomy singular name', 'capital-core' ),
			'search_items'      => __( 'Search ' . $pluralName, 'capital-core' ),
			'all_items'         => __( 'All ' . $pluralName, 'capital-core' ),
			'parent_item'       => __( 'Parent ' . $taxonomyName, 'capital-core' ),
			'parent_item_colon' => __( 'Parent ' . $taxonomyName . ':', 'capital-core' ),
			'edit_item'         => __( 'Edit ' . $taxonomyName, 'capital-core' ),
			'update_item'       => __( 'Update ' . $taxonomyName, 'capital-core' ),
			'add_new_item'      => __( 'Add New ' . $taxonomyName, 'capital-core' ),
			'new_item_name'     => __( 'New ' . $taxonomyName . 'Name', 'capital-core' ),
			'menu_name'         => __( $taxonomyName, 'capital-core' )
		);

		$defaults = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_in_nav_menus' => true,
			'show_ui'           => null,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $slug )
		);

		$args                      = wp_parse_args( $defaults, $args );
		self::$Taxonomies[ $slug ] = array( 'post_type' => $post_type, 'args' => $args );

	}


	public static function register_taxonomies() {

		foreach ( self::$Taxonomies as $taxonomyName => $taxonomy ) {
			register_taxonomy( $taxonomyName, $taxonomy['post_type'], $taxonomy['args'] );
		}

	}

}