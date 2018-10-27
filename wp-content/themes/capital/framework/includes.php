<?php
if (!defined('ABSPATH'))
exit; // Exit if accessed directly 
/*
* Here you include files which is required by theme
*/
require_once CAPITAL_FILEPATH. '/framework/theme-functions.php';
/* META BOX FRAMEWORK
================================================== */
require_once CAPITAL_FILEPATH. '/framework/meta-boxes.php';

/* VISUAL COMPOSER INCLUDE
================================================== */
require_once CAPITAL_FILEPATH. '/framework/visual_composer.php';

/* PLUGIN INCLUDES
================================================== */
require_once CAPITAL_FILEPATH. '/framework/tgm/plugin-includes.php';

/* LOAD STYLESHEETS
================================================== */
if (!function_exists('capital_enqueue_styles')) {
	function capital_enqueue_styles() {
		$options = get_option('capital_options');
		$switch_responsive = (isset($options['switch-responsive']))?$options['switch-responsive']:1;
		$theme_info = wp_get_theme();
		$theme_color_scheme = (isset($options['theme_color_scheme']))?$options['theme_color_scheme']:'color1.css';
		$fonts_args = array(
					'family' => 'Material+Icons',
					'subset' => '',
			);
		$blog_id = get_current_blog_id();
			wp_enqueue_style('bootstrap', CAPITAL_THEME_PATH . '/css/bootstrap.css', array(), $theme_info->get( 'Version' ), 'all');
			wp_enqueue_style('line-icons', CAPITAL_THEME_PATH . '/css/line-icons.css', array(), $theme_info->get( 'Version' ), 'all');
			wp_enqueue_style('material', add_query_arg( $fonts_args, "//fonts.googleapis.com/css" ), array(), $theme_info->get( 'Version' ), 'all');
			wp_enqueue_style('material-icons', CAPITAL_THEME_PATH . '/css/material-icons.css', array(), $theme_info->get( 'Version' ), 'all');
			wp_enqueue_style('font-awesome', CAPITAL_THEME_PATH . '/css/font-awesome.min.css', array(), $theme_info->get( 'Version' ), 'all');
			wp_enqueue_style('animations', CAPITAL_THEME_PATH . '/css/animations.css', array(), $theme_info->get( 'Version' ), 'all');
			wp_enqueue_style('bootstrap-theme', CAPITAL_THEME_PATH . '/css/bootstrap-theme.css', array(), $theme_info->get( 'Version' ), 'all');
			wp_enqueue_style('capital-main', get_stylesheet_uri(), array(), $theme_info->get( 'Version' ), 'all');
			if ($switch_responsive == 1 || $switch_responsive == ''){
				wp_enqueue_style('responsive-media', CAPITAL_THEME_PATH . '/css/responsive.css', array(), $theme_info->get( 'Version' ), 'all');
			}
        	wp_enqueue_style('magnific-popup', CAPITAL_THEME_PATH . '/vendor/magnific/magnific-popup.css', array(), $theme_info->get( 'Version' ), 'all');
			wp_enqueue_style('owl-carousel', CAPITAL_THEME_PATH . '/vendor/owl-carousel/css/owl.carousel.css', array(), $theme_info->get( 'Version' ), 'all');
			wp_enqueue_style('owl-carousel2', CAPITAL_THEME_PATH . '/vendor/owl-carousel/css/owl.theme.css', array('owl-carousel'), $theme_info->get( 'Version' ), 'all');
			if (isset($options['theme_color_type'])&&$options['theme_color_type'][0] == 0) {
				wp_enqueue_style('capital-colors', CAPITAL_THEME_PATH . '/colors/' . $theme_color_scheme, array(), $theme_info->get( 'Version' ), 'all');
			} else {
				wp_enqueue_style('capital-colors', CAPITAL_THEME_PATH . '/colors/color1.css', array(), $theme_info->get( 'Version' ), 'all');
			}
			wp_enqueue_style('capital-custom-options-style', CAPITAL_THEME_PATH . '/css/custom-option_'.$blog_id.'.css', array(), $theme_info->get( 'Version' ), 'all');
			//**End Enqueue STYLESHEETPATH**//
		}
		add_action('wp_enqueue_scripts', 'capital_enqueue_styles', 999);
}
if (!function_exists('capital_enqueue_scripts')) {
    function capital_enqueue_scripts() {
      $options = get_option('capital_options');
			$theme_info = wp_get_theme();
			$custom_js = (isset($options['custom_js']))?$options['custom_js']:'';
        //**register script**//
		wp_enqueue_script('modernizr', CAPITAL_THEME_PATH . '/js/modernizr.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('magnific', CAPITAL_THEME_PATH . '/vendor/magnific/jquery.magnific-popup.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('waypoints', CAPITAL_THEME_PATH . '/js/waypoints.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('capital-ui-plugins', CAPITAL_THEME_PATH . '/js/ui-plugins.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('capital-helper-plugins', CAPITAL_THEME_PATH . '/js/helper-plugins.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('owlcarousel', CAPITAL_THEME_PATH . '/vendor/owl-carousel/js/owl.carousel.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('flexslider', CAPITAL_THEME_PATH . '/vendor/flexslider/js/jquery.flexslider.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('bootstrap', CAPITAL_THEME_PATH . '/js/bootstrap.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('capital-init', CAPITAL_THEME_PATH . '/js/init.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_add_inline_script('capital-init', $custom_js);
		$site_width = (isset($options['site_width']))?$options['site_width']:1170;
		$topbarwidgets = (isset($options['topbar_opener_dimension']))?$options['topbar_opener_dimension']['width']:'400px';
		$enable_sticky_header = (isset($options['enable_sticky_header']) && $options['enable_sticky_header'] != '')?$options['enable_sticky_header']:1;
		wp_localize_script('capital-init', 'imi_local', array('homeurl' => get_template_directory_uri(), 'sticky_header' => $enable_sticky_header, 'siteWidth' => $site_width, 'topbar_widgets' => $topbarwidgets));
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
    add_action('wp_enqueue_scripts', 'capital_enqueue_scripts');
}
/* LOAD BACKEND SCRIPTS
  ================================================== */
function capital_admin_scripts() 
{
 	wp_register_script('capital-admin-functions', CAPITAL_THEME_PATH . '/js/admin_scripts.js', 'jquery', NULL, TRUE);
	global $pagenow;
	if(($pagenow=='user-edit.php')||($pagenow=='profile.php'))
	{
		wp_enqueue_media();
	}
  wp_enqueue_script('capital-admin-functions');
	if(isset($_REQUEST['taxonomy'])){
      wp_enqueue_script('capital-upload', CAPITAL_THEME_PATH . '/js/imic-upload.js', 'jquery', NULL, TRUE);
      wp_enqueue_media();
  }
}
add_action('admin_init', 'capital_admin_scripts');
/* LOAD BACKEND STYLE
  ================================================== */
function capital_admin_styles() {
    add_editor_style(CAPITAL_THEME_PATH . '/css/editor-style.css');
}
add_action('admin_head', 'capital_admin_styles');
?>