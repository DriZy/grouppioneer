<?php
/* 
 * Plugin Name: Capital Core
 * Plugin URI:  http://www.imithemes.com
 * Description: Create Post Types, Meta Boxes for Capital Theme
 * Author:      imithemes
 * Version:     1.2
 * Author URI:  http://www.imithemes.com
 * Licence:     GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Copyright:   (c) 2017 imithemes. All rights reserved
 * Text Domain: capital-core
 * Domain Path: /language
 */

// Do not allow direct access to this file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$path = plugin_dir_path( __FILE__ );
/* CUSTOM POST TYPES
================================================== */
require_once $path . '/post-type.class.php';
require_once $path .'post-types-config.php';
require_once $path .'inc/functions.php';

/* META BOX PLUGIN EXTENSIONS
================================================== */
require_once $path . '/meta-box-tabs.php';
require_once $path . '/mb-term-meta.php';
require_once $path . '/meta-box-conditional-logic.php';
require_once $path . '/meta-box-show-hide.php';

/* WIDGETS INCLUDES
================================================== */
require_once $path . '/widgets/custom_category.php';
require_once $path . '/widgets/recent_posts.php';
require_once $path . '/widgets/tabs_widget.php';
require_once $path . '/widgets/flickr_widget.php';

/* SET LANGUAGE FILE FOLDER
=================================================== */
add_action('after_setup_theme', 'capital_core_setup');
function capital_core_setup() {
    load_theme_textdomain('capital-core', plugin_dir_path( __FILE__ ) . '/language');
}

// DEMO IMPORTER FOR REDUX FRAMEWORK
if(!function_exists('capital_register_custom_extension_loader')) :
global $capital_options, $opt_name;
$opt_name = "capital_options";
	function capital_register_custom_extension_loader($ReduxFramework) {
		$path = plugin_dir_path( __FILE__ ). '/extensions/';
		$folders = scandir( $path);		   
		foreach($folders as $folder) {
			if ($folder === '.' or $folder === '..' or !is_dir($path . $folder) ) {
				continue;	
			} 
			$extension_class = 'ReduxFramework_Extension_' . $folder;
			if( !class_exists( $extension_class ) ) {
				// In case you wanted override your override, hah.
				$class_file = $path . $folder . '/extension_' . $folder . '.php';
				$class_file = apply_filters( 'redux/extension/'.$ReduxFramework->args['opt_name'].'/'.$folder, $class_file );
				if( $class_file ) {
					require_once( $class_file );
					$extension = new $extension_class( $ReduxFramework );
				}
			}
		}
	}
	add_action("redux/extensions/{$opt_name}/before", 'capital_register_custom_extension_loader', 0);
endif;