<?php
require_once CAPITAL_FILEPATH . '/framework/tgm/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'capital_register_required_plugins' );

function capital_register_required_plugins() {
	$plugins_path = get_template_directory() . '/framework/tgm/plugins/';
    $plugins = array(
        array(
			'name' => esc_html__('Breadcrumb NavXT', 'capital'),
			'slug' => 'breadcrumb-navxt',
			'required' 	=> false,
		),
		array(
			'name' => esc_html__('Pojo Sidebars', 'capital'),
			'slug' => 'pojo-sidebars',
			'required' 	=> false,
		),
		array(
			'name' => esc_html__('Simple Twitter Tweets', 'capital'),
		    'slug' => 'simple-twitter-tweets',
			'required' 	=> false,
		),
       	array(
			'name' => esc_html__('WooCommerce', 'capital'),
		    'slug' => 'woocommerce',
			'required' 	=> false,
		),
		array(
			'name' => esc_html__('Contact Form 7', 'capital'),
		    'slug' => 'contact-form-7',
			'required' 	=> false,
		),
		array(
			'name' => esc_html__('TinyMCE Advanced', 'capital'),
		    'slug' => 'tinymce-advanced',
			'required' 	=> false,
		),
		array(
			'name' => esc_html__('Meta Box', 'capital'),
		   	'slug' => 'meta-box',
			'required' => true,
		),
		array(
            'name'               => esc_html__('Revolution Slider', 'capital'),
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => $plugins_path. 'revslider.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version' 			 => '5.4.6.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
			array(
            'name'               => esc_html__('CAPITAL Core', 'capital'),
            'slug'               => 'capital-core', // The plugin slug (typically the folder name).
            'source'             => $plugins_path. 'capital-core.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
		array(
            'name'               => esc_html__('Redux Framework', 'capital'),
            'slug'               => 'redux-framework', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
		array(
            'name'               => esc_html__('Visual Composer', 'capital'),
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
			'source'             => $plugins_path. 'js_composer.zip', // The plugin source.
			'version' 			 => '5.4.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
		array(
            'name'               => esc_html__('Envato Market', 'capital'),
            'slug'               => 'envato-market', // The plugin slug (typically the folder name).
			'source'             => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip', // The plugin source.
			'version' 			 => '1.0.0-RC2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
            
    );
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'capital' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'capital' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'capital' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'capital' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'capital' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'capital' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'capital' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'capital' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'capital' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'capital' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'capital' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'capital' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'capital' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'capital' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'capital' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'capital' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'capital' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa( $plugins, $config );
}