<?php
/**
 * Extension-Boilerplate
 * @link https://github.com/ReduxFramework/extension-boilerplate
 *
 * Radium Importer - Modified For ReduxFramework
 * @link https://github.com/FrankM1/radium-one-click-demo-install
 *
 * @package     WBC_Importer - Extension for Importing demo content
 * @author      Webcreations907
 * @version     1.0.1
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if ( !class_exists( 'ReduxFramework_extension_wbc_importer' ) ) {


	/************************************************************************
	* Extended Example:
	* Way to set menu, import revolution slider, and set home page.
	*************************************************************************/
	if ( !function_exists( 'wbc_extended_example' ) ) {
		function wbc_extended_example( $demo_active_import , $demo_directory_path ) {
			reset( $demo_active_import );
			$current_key = key( $demo_active_import );
			/************************************************************************
			* Import slider(s) for the current demo being imported
			*************************************************************************/
			if ( class_exists( 'RevSlider' ) ) {
				//If it's demo3 or demo5
				$wbc_sliders_array = array(
					'Demo1' => 'slider1.zip', //Set slider zip name
					'Demo2' => 'slider1.zip', //Set slider zip name
					'Demo3' => 'slider1.zip', //Set slider zip name
					'Demo4' => 'slider1.zip', //Set slider zip name
				);
				if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
					$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
					if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
						$slider = new RevSlider();
						$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
					}
				}
			}
			/************************************************************************
			* Setting Menus
			*************************************************************************/
			// If it's Demo1
			$wbc_menu_array = array( 'Demo1' );
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
				$main = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
				if ( isset( $main->term_id ) ) {
					set_theme_mod( 'nav_menu_locations', array(
						'primary-menu' => $main->term_id
					)
				);
				}
				global $wp_filesystem;
				$blog_id = get_current_blog_id();
    		$filename = CAPITAL_FILEPATH . '/css/custom-option_'.$blog_id.'.css';
				$demo_css = plugin_dir_path( __FILE__ ).'demo-data/Demo1/custom-css1.css';
				if( empty( $wp_filesystem ) ) {
        require_once ABSPATH .'/wp-admin/includes/file.php';
        WP_Filesystem();
				}

				if( $wp_filesystem ) {
					$css = $wp_filesystem->get_contents($demo_css);
					$wp_filesystem->put_contents(
            $filename,
            $css,
            FS_CHMOD_FILE // predefined mode settings for WP files
        );
				}
			}
			// If it's Demo2
			$wbc_menu_array = array( 'Demo2' );
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
				$main = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
				if ( isset( $main->term_id ) ) {
					set_theme_mod( 'nav_menu_locations', array(
						'primary-menu' => $main->term_id
					)
				);
				}
				global $wp_filesystem;
				$blog_id = get_current_blog_id();
    		$filename = CAPITAL_FILEPATH . '/css/custom-option_'.$blog_id.'.css';
				$demo_css = plugin_dir_path( __FILE__ ).'demo-data/Demo2/custom-css2.css';
				if( empty( $wp_filesystem ) ) {
        require_once ABSPATH .'/wp-admin/includes/file.php';
        WP_Filesystem();
				}

				if( $wp_filesystem ) {
					$css = $wp_filesystem->get_contents($demo_css);
					$wp_filesystem->put_contents(
            $filename,
            $css,
            FS_CHMOD_FILE // predefined mode settings for WP files
        );
				}
			}
			// If it's Demo3
			$wbc_menu_array = array( 'Demo3' );
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
				$main = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
				if ( isset( $main->term_id ) ) {
					set_theme_mod( 'nav_menu_locations', array(
						'primary-menu' => $main->term_id
					)
				);
				}
				global $wp_filesystem;
				$blog_id = get_current_blog_id();
    		$filename = CAPITAL_FILEPATH . '/css/custom-option_'.$blog_id.'.css';
				$demo_css = plugin_dir_path( __FILE__ ).'demo-data/Demo3/custom-css3.css';
				if( empty( $wp_filesystem ) ) {
        require_once ABSPATH .'/wp-admin/includes/file.php';
        WP_Filesystem();
				}

				if( $wp_filesystem ) {
					$css = $wp_filesystem->get_contents($demo_css);
					$wp_filesystem->put_contents(
            $filename,
            $css,
            FS_CHMOD_FILE // predefined mode settings for WP files
        );
				}
			}
			// If it's Demo4
			$wbc_menu_array = array( 'Demo4' );
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
				$main = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
				if ( isset( $main->term_id ) ) {
					set_theme_mod( 'nav_menu_locations', array(
						'primary-menu' => $main->term_id
					)
				);
				}
				global $wp_filesystem;
				$blog_id = get_current_blog_id();
    		$filename = CAPITAL_FILEPATH . '/css/custom-option_'.$blog_id.'.css';
				$demo_css = plugin_dir_path( __FILE__ ).'demo-data/Demo4/custom-css4.css';
				if( empty( $wp_filesystem ) ) {
        require_once ABSPATH .'/wp-admin/includes/file.php';
        WP_Filesystem();
				}

				if( $wp_filesystem ) {
					$css = $wp_filesystem->get_contents($demo_css);
					$wp_filesystem->put_contents(
            $filename,
            $css,
            FS_CHMOD_FILE // predefined mode settings for WP files
        );
				}
			}
		/************************************************************************
		* Set HomePage
		*************************************************************************/
		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'Demo1' => 'Home',
			'Demo2' => 'Home',
			'Demo3' => 'Home',
			'Demo4' => 'Home',
		);
		$wbc_blog_pages = array(
			'Demo1' => 'Blog',
			'Demo2' => 'Blog',
			'Demo3' => 'Blog',
			'Demo4' => 'Blog',
		);
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_blog_pages ) ) {
			$bpage = get_page_by_title( $wbc_blog_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $bpage->ID ) ) {
				update_option( 'page_for_posts', $bpage->ID );
			}
		}
	}
	// Uncomment the below
	add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 10, 2 );
	}


    class ReduxFramework_extension_wbc_importer {

        public static $instance;

        static $version = "1.0.1";

        protected $parent;

        private $filesystem = array();

        public $extension_url;

        public $extension_dir;

        public $demo_data_dir;

        public $wbc_import_files = array();

        public $active_import_id;

        public $active_import;


        /**
         * Class Constructor
         *
         * @since       1.0
         * @access      public
         * @return      void
         */
        public function __construct( $parent ) {

            $this->parent = $parent;

            if ( !is_admin() ) return;

            //Hides importer section if anything but true returned. Way to abort :)
            if ( true !== apply_filters( 'wbc_importer_abort', true ) ) {
                return;
            }

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
                $this->demo_data_dir = apply_filters( "wbc_importer_dir_path", $this->extension_dir . 'demo-data/' );
            }

            //Delete saved options of imported demos, for dev/testing purpose
            // delete_option('wbc_imported_demos');

            $this->getImports();

            $this->field_name = 'wbc_importer';

            self::$instance = $this;

            add_filter( 'redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array( &$this,
                    'overload_field_path'
                ) );

            add_action( 'wp_ajax_redux_wbc_importer', array(
                    $this,
                    'ajax_importer'
                ) );

            add_filter( 'redux/'.$this->parent->args['opt_name'].'/field/wbc_importer_files', array(
                    $this,
                    'addImportFiles'
                ) );

            //Adds Importer section to panel
            $this->add_importer_section();


        }


        public function getImports() {

            if ( !empty( $this->wbc_import_files ) ) {
                return $this->wbc_import_files;
            }

            $this->filesystem = $this->parent->filesystem->execute( 'object' );

            $imports = $this->filesystem->dirlist( $this->demo_data_dir, false, true );

            $imported = get_option( 'wbc_imported_demos' );

            if ( !empty( $imports ) ) {
                $x = 1;
                foreach ( $imports as $import ) {

                    if ( !isset( $import['files'] ) || empty( $import['files'] ) ) {
                        continue;
                    }

                    if ( $import['type'] == "d" && !empty( $import['name'] ) ) {
                        $this->wbc_import_files['wbc-import-'.$x] = isset( $this->wbc_import_files['wbc-import-'.$x] ) ? $this->wbc_import_files['wbc-import-'.$x] : array();
                        $this->wbc_import_files['wbc-import-'.$x]['directory'] = $import['name'];

                        if ( !empty( $imported ) && is_array( $imported ) ) {
                            if ( array_key_exists( 'wbc-import-'.$x, $imported ) ) {
                                $this->wbc_import_files['wbc-import-'.$x]['imported'] = 'imported';
                            }
                        }

                        foreach ( $import['files'] as $file ) {
                            switch ( $file['name'] ) {
                            case 'content.xml':
                                $this->wbc_import_files['wbc-import-'.$x]['content_file'] = $file['name'];
                                break;

                            case 'theme-options.txt':
                            case 'theme-options.json':
                                $this->wbc_import_files['wbc-import-'.$x]['theme_options'] = $file['name'];
                                break;

                            case 'widgets.json':
                            case 'widgets.txt':
                                $this->wbc_import_files['wbc-import-'.$x]['widgets'] = $file['name'];
                                break;

                            case 'screen-image.png':
                            case 'screen-image.jpg':
                            case 'screen-image.gif':
                                $this->wbc_import_files['wbc-import-'.$x]['image'] = $file['name'];
                                break;
                            }

                        }

                        if ( !isset( $this->wbc_import_files['wbc-import-'.$x]['content_file'] ) ) {
                            unset( $this->wbc_import_files['wbc-import-'.$x] );
                            if ( $x > 1 ) $x--;
                        }

                    }

                    $x++;
                }

            }

        }

        public function addImportFiles( $wbc_import_files ) {

            if ( !is_array( $wbc_import_files ) || empty( $wbc_import_files ) ) {
                $wbc_import_files = array();
            }

            $wbc_import_files = wp_parse_args( $wbc_import_files, $this->wbc_import_files );

            return $wbc_import_files;
        }

        public function ajax_importer() {
            if ( !isset( $_REQUEST['nonce'] ) || !wp_verify_nonce( $_REQUEST['nonce'], "redux_{$this->parent->args['opt_name']}_wbc_importer" ) ) {
                die( 0 );
            }
            if ( isset( $_REQUEST['type'] ) && $_REQUEST['type'] == "import-demo-content" && array_key_exists( $_REQUEST['demo_import_id'], $this->wbc_import_files ) ) {

                $reimporting = false;

                if( isset( $_REQUEST['wbc_import'] ) && $_REQUEST['wbc_import'] == 're-importing'){
                    $reimporting = true;
                }

                $this->active_import_id = $_REQUEST['demo_import_id'];

                $import_parts         = $this->wbc_import_files[$this->active_import_id];

                $this->active_import = array( $this->active_import_id => $import_parts );

                $content_file        = $import_parts['directory'];
                $demo_data_loc       = $this->demo_data_dir.$content_file;

                if ( file_exists( $demo_data_loc.'/'.$import_parts['content_file'] ) && is_file( $demo_data_loc.'/'.$import_parts['content_file'] ) ) {

                    if ( !isset( $import_parts['imported'] ) || true === $reimporting ) {
                        include $this->extension_dir.'inc/init-installer.php';
                        $installer = new Radium_Theme_Demo_Data_Importer( $this, $this->parent );
                    }else {
                        echo esc_html__( "Demo Already Imported", 'capital-core' );
                    }
                }

                die();
            }

            die();
        }

        public static function get_instance() {
            return self::$instance;
        }

        // Forces the use of the embeded field path vs what the core typically would use
        public function overload_field_path( $field ) {
            return dirname( __FILE__ ) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
        }

        function add_importer_section() {
            // Checks to see if section was set in config of redux.
            for ( $n = 0; $n < count( $this->parent->sections ); $n++ ) {
                if ( isset( $this->parent->sections[$n]['id'] ) && $this->parent->sections[$n]['id'] == 'wbc_importer_section' ) {
                    return;
                }
            }
						$this->parent->sections[] = array(
    'icon' => 'el-icon-share',
    'title' => esc_html__('Social Sharing', 'capital-core'),
    'fields' => array(
        array(
            'id' => 'switch_sharing',
            'type' => 'switch',
            'title' => esc_html__('Social Sharing', 'capital-core'),
            'subtitle' => esc_html__('Enable/Disable theme default social sharing buttons for posts/projects/services/team single pages', 'capital-core'	
			),
            "default" => 1,
       	),
		array(
			'id'       => 'share_icon',
			'type'     => 'checkbox',
			'required' => array('switch_sharing','equals','1'),
			'title'    => esc_html__('Social share options', 'capital-core'),
			'subtitle' => esc_html__('Click on the buttons to disable/enable share buttons', 'capital-core'),
			'options'  => array(
				'1' => 'Facebook',
				'2' => 'Twitter',
				'3' => 'Google',
				'4' => 'Tumblr',
				'5' => 'Pinterest',
				'6' => 'Reddit',
				'7' => 'Linkedin',
				'8' => 'Email',
				'9' => 'VKontakte',
				'10' => 'Whatsapp'
			),
			'default' => array(
				'1' => '1',
				'2' => '1',
				'3' => '1',
				'4' => '1',
				'5' => '1',
				'6' => '1',
				'7' => '1',
				'8' => '1',
				'9' => '0',
				'10' => '0'
			)
		),
		array(
			'id'       => 'share_post_types',
			'type'     => 'checkbox',
			'required' => array('switch_sharing','equals','1'),
			'title'    => esc_html__('Select share buttons for post types', 'capital-core'),
			'subtitle'     => esc_html__('Uncheck to disable for any type', 'capital-core'),
			'options'  => array(
				'1' => esc_html__('Posts','capital-core'),
				'2' => esc_html__('Pages','capital-core'),
				'3' => esc_html__('Team','capital-core'),
				'4' => esc_html__('Projects','capital-core'),
				'5' => esc_html__('Services','capital-core')
			),
			'default' => array(
				'1' => 1,
				'2' => 1,
				'3' => 1,
				'4' => 1,
				'5' => 1,
			)
		),
		array(
			'id'       => 'share_style_alt_start',
			'type'     => 'accordion',
			'position' => 'start',
			'title'    => esc_html__('Sharing icons styling', 'capital-core'),
		),
		array(
			'id'       => 'share_before_icon',
			'type'     => 'checkbox',
			'title'    => esc_html__('Show sharing icon before the sharing icons', 'capital-core'),
			'default' => 0
		),
		array(
			'id'       => 'share_before_text',
			'type'     => 'text',
			'title'    => esc_html__('Enter title to show before the sharing icons', 'capital-core'),
			'default' => ''
		),
		array(
			'id'       => 'share_before_typo',
			'type'     => 'typography',
			'title'    => esc_html__('Share before text typography', 'capital-core'),
			'compiler'   => array('.social-share-bar .share-title'),
			'default' => array(
				'line-height' => '30px'
			)
		),
		array(
			'id'=>'share_social_shape',
			'type' => 'button_set',
			'compiler'=>true,
			'title' => esc_html__('Shape', 'capital-core'), 
			'options' => array(
					'imi-social-icons-round' => esc_html__('Round','capital-core'),
					'imi-social-icons-rounded' => esc_html__('Rounded','capital-core'),
					'imi-social-icons-square' => esc_html__('Square','capital-core'),
					'imi-social-icons-plain' => esc_html__('Plain','capital-core')
				),
			'default' => 'imi-social-icons-round',
		),
		array(
			'id'=>'share_social_size',
			'type' => 'button_set',
			'compiler'=>true,
			'title' => esc_html__('Size', 'capital-core'), 
			'options' => array(
					'imi-social-icons-small' => esc_html__('Small','capital-core'),
					'imi-social-icons-medium' => esc_html__('Medium','capital-core'),
					'imi-social-icons-large' => esc_html__('Large','capital-core'),
					'imi-social-icons-xlarge' => esc_html__('Extra Large','capital-core'),
					'imi-social-icons-custom' => esc_html__('Custom','capital-core')
				),
			'default' => 'imi-social-icons-medium',
		),
		array(
			'id'=>'share_social_custom_size',
			'type' => 'dimensions',
			'compiler'=>true,
			'compiler' => array('.social-share-bar .imi-social-icons li a'),
			'title' => esc_html__('Custom size', 'capital-core'),
			'desc' => esc_html__('Keep the width and height fields filled with same values to keep the social icons boxes in square.', 'capital-core'),
			'required' => array('share_social_size','=','imi-social-icons-custom')
		),
		array(
			'id'=>'share_social_custom_spacing',
			'type' => 'spacing',
			'mode' => 'margin',
			'units' => array('px'),
			'compiler'=>true,
			'compiler' => array('.social-share-bar .imi-social-icons li'),
			'title' => esc_html__('Custom spacing', 'capital-core'),
			'desc' => esc_html__('Enter the margin from all sides for each social icon link.', 'capital-core'),
			'required' => array('share_social_size','=','imi-social-icons-custom')
		),
		array(
			'id'=>'share_social_custom_typo',
			'type' => 'typography',
			'compiler'=>true,
			'font-family' => false,
			'preview' => false,
			'text-align' => false,
			'line-height' => false,
			'color' => false,
			'word-spacing' => false,
			'letter-spacing' => false,
			'font-weight' => false,
			'font-style' => false,
			'compiler' => array('.social-share-bar .imi-social-icons li a'),
			'title' => esc_html__('Custom icon size', 'capital-core'),
			'required' => array('share_social_size','=','imi-social-icons-custom')
		),
		array(
			'id'=>'share_social_style',
			'type' => 'button_set',
			'compiler'=>true,
			'title' => esc_html__('Style', 'capital-core'), 
			'options' => array(
					'imi-social-icons-bc' => esc_html__('Brand colors','capital-core'),
					'imi-social-icons-tc' => esc_html__('Theme primary color','capital-core'),
					'imi-social-icons-sc' => esc_html__('Theme secondary color','capital-core'),
					'imi-social-icons-gc' => esc_html__('Grayscale','capital-core')
				),
			'default' => 'imi-social-icons-bc',
		),
		array(
			'id'=>'share_social_hover_style',
			'type' => 'button_set',
			'compiler'=>true,
			'title' => esc_html__('Hover style', 'capital-core'), 
			'options' => array(
					'imi-social-icons-hover-bc' => esc_html__('Brand colors','capital-core'),
					'imi-social-icons-hover-tc' => esc_html__('Theme primary color','capital-core'),
					'imi-social-icons-hover-sc' => esc_html__('Theme secondary color','capital-core'),
					'imi-social-icons-hover-gc' => esc_html__('Grayscale','capital-core')
				),
			'default' => 'imi-social-icons-hover-sc',
		),
		array(
			'id'       => 'share_social_icon_color',
			'type'     => 'link_color',
			'visited'  => false,
			'required' => array('share_social_shape','=','imi-social-icons-plain'),
			'compiler'   => array('.social-share-bar .imi-social-icons li a'),
			'title'    => esc_html__('Social Links Color', 'capital-core'),
		),
		array(
			'id'       => 'share_style_alt_end',
			'type'     => 'accordion',
			'position' => 'end',
		),
		array(
			'id'       => 'share_links_alt_start',
			'type'     => 'accordion',
			'position' => 'start',
			'title'    => esc_html__('Sharing links alt/title text', 'capital-core'),
		),
		array(
            'id' => 'facebook_share_alt',
            'type' => 'text',
            'title' => esc_html__('Tooltip text for Facebook share icon', 'capital-core'),
            'subtitle' => esc_html__('Text for the Facebook share icon browser tooltip.', 'capital-core'),
            'default' => 'Share on Facebook'
        ),
		array(
            'id' => 'twitter_share_alt',
            'type' => 'text',
            'title' => esc_html__('Tooltip text for Twitter share icon', 'capital-core'),
            'subtitle' => esc_html__('Text for the Twitter share icon browser tooltip.', 'capital-core'),
            'default' => 'Tweet'
        ),
		array(
            'id' => 'google_share_alt',
            'type' => 'text',
            'title' => esc_html__('Tooltip text for Google Plus share icon', 'capital-core'),
            'subtitle' => esc_html__('Text for the Google Plus share icon browser tooltip.', 'capital-core'),
            'default' => 'Share on Google+'
        ),
		array(
            'id' => 'tumblr_share_alt',
            'type' => 'text',
            'title' => esc_html__('Tooltip text for Tumblr share icon', 'capital-core'),
            'subtitle' => esc_html__('Text for the Tumblr share icon browser tooltip.', 'capital-core'),
            'default' => 'Post to Tumblr'
        ),
		array(
            'id' => 'pinterest_share_alt',
            'type' => 'text',
            'title' => esc_html__('Tooltip text for Pinterest share icon', 'capital-core'),
            'subtitle' => esc_html__('Text for the Pinterest share icon browser tooltip.', 'capital-core'),
            'default' => 'Pin it'
        ),
		array(
            'id' => 'reddit_share_alt',
            'type' => 'text',
            'title' => esc_html__('Tooltip text for Reddit share icon', 'capital-core'),
            'subtitle' => esc_html__('Text for the Reddit share icon browser tooltip.', 'capital-core'),
            'default' => 'Submit to Reddit'
        ),
		array(
            'id' => 'linkedin_share_alt',
            'type' => 'text',
            'title' => esc_html__('Tooltip text for Linkedin share icon', 'capital-core'),
            'subtitle' => esc_html__('Text for the Linkedin share icon browser tooltip.', 'capital-core'),
            'default' => 'Share on Linkedin'
        ),
		array(
            'id' => 'email_share_alt',
            'type' => 'text',
            'title' => esc_html__('Tooltip text for Email share icon', 'capital-core'),
            'subtitle' => esc_html__('Text for the Email share icon browser tooltip.', 'capital-core'),
            'default' => 'Email'
        ),
		array(
            'id' => 'vk_share_alt',
            'type' => 'text',
            'title' => esc_html__('Tooltip text for VK share icon', 'capital-core'),
            'subtitle' => esc_html__('Text for the vk share icon browser tooltip.', 'capital-core'),
            'default' => 'Share on vk'
        ),
		array(
            'id' => 'whatsapp_share_alt',
            'type' => 'text',
            'title' => esc_html__('Tooltip text for Whatsapp share icon', 'capital-core'),
            'subtitle' => esc_html__('Text for the whatsapp share icon browser tooltip.', 'capital-core'),
            'default' => 'Share on Whatsapp'
        ),
		array(
			'id'       => 'share_links_alt_end',
			'type'     => 'accordion',
			'position' => 'end',
		),
	)
);
					
					
						$this->parent->sections[] = array(
    'icon' => 'el-icon-folder',
	'id'   => 'post-types',
    'title' => esc_html__('Custom Post Types', 'capital-core'),
    'fields' => array(
		array(
			'id'    => 'info_post_types',
			'type'  => 'info',
			'title' => esc_html__('Sub sections here for each post type will help you change the permalinks slug for each post type. Also would be able to change the Title for menu on the left sidebar of WP Dashboard.', 'capital-core'),
			'style' => 'warning',
			'desc'  => esc_html__('Make sure you go to Settings > Permalinks page once you make any change to any post type here to flush the permalinks structure cache. You just need to go to that permalinks page, no need to save the options.', 'capital-core')
		),
		array(
			'id'       => 'info_post_project_start',
			'type'     => 'accordion',
			'position' => 'start',
			'title'    => esc_html__('Projects', 'capital-core'),
		),
		array(
            'id' => 'project_post_title',
            'type' => 'text',
            'title' => esc_html__('Title', 'capital-core'),
        ),
		array(
            'id' => 'project_post_plural_title',
            'type' => 'text',
            'title' => esc_html__('Plural title', 'capital-core'),
        ),
		array(
            'id' => 'project_post_all',
            'type' => 'text',
            'title' => esc_html__('All items title', 'capital-core'),
        ),
		array(
            'id' => 'project_post_slug',
            'type' => 'text',
            'title' => esc_html__('Permalink slug', 'capital-core'),
            'desc' => esc_html__('All lowercase, no spaces in between words.', 'capital-core'),
        ),
		array(
            'id' => 'project_post_icon',
            'type' => 'text',
            'title' => esc_html__('Icon', 'capital-core'),
            'desc' => esc_html__('Enter dashboard icon class name for this post type. Get class names from https://developer.wordpress.org/resource/dashicons/', 'capital-core'),
        ),
		array(
			'id'       => 'disable_project_archive',
			'type'     => 'checkbox',
			'title'    => esc_html__('Disable post type archive page.', 'capital-core'),
            'desc' => esc_html__('By default WordPress create a page for all post types which makes it impossible for you to create a new page with the same slug as of custom post type. Check this to disable the default cpt page.', 'capital-core'),
			'default' => 0
		),
		array(
			'id'       => 'info_post_project_end',
			'type'     => 'accordion',
			'position' => 'end',
		),
		array(
			'id'       => 'info_post_services_start',
			'type'     => 'accordion',
			'position' => 'start',
			'title'    => esc_html__('Services', 'capital-core'),
		),
		array(
            'id' => 'service_post_title',
            'type' => 'text',
            'title' => esc_html__('Title', 'capital-core'),
        ),
		array(
            'id' => 'service_post_plural_title',
            'type' => 'text',
            'title' => esc_html__('Plural title', 'capital-core'),
        ),
		array(
            'id' => 'service_post_all',
            'type' => 'text',
            'title' => esc_html__('All items title', 'capital-core'),
        ),
		array(
            'id' => 'service_post_slug',
            'type' => 'text',
            'title' => esc_html__('Permalink slug', 'capital-core'),
            'desc' => esc_html__('All lowercase, no spaces in between words.', 'capital-core'),
        ),
		array(
            'id' => 'service_post_icon',
            'type' => 'text',
            'title' => esc_html__('Icon', 'capital-core'),
            'desc' => esc_html__('Enter dashboard icon class name for this post type. Get class names from https://developer.wordpress.org/resource/dashicons/', 'capital-core'),
        ),
		array(
			'id'       => 'disable_service_archive',
			'type'     => 'checkbox',
			'title'    => esc_html__('Disable post type archive page.', 'capital-core'),
            'desc' => esc_html__('By default WordPress create a page for all post types which makes it impossible for you to create a new page with the same slug as of custom post type. Check this to disable the default cpt page.', 'capital-core'),
			'default' => 0
		),
		array(
			'id'       => 'info_post_services_end',
			'type'     => 'accordion',
			'position' => 'end',
		),
		array(
			'id'       => 'info_post_team_start',
			'type'     => 'accordion',
			'position' => 'start',
			'title'    => esc_html__('Team', 'capital-core'),
		),
		array(
            'id' => 'team_post_title',
            'type' => 'text',
            'title' => esc_html__('Title', 'capital-core'),
        ),
		array(
            'id' => 'team_post_plural_title',
            'type' => 'text',
            'title' => esc_html__('Plural title', 'capital-core'),
        ),
		array(
            'id' => 'team_post_all',
            'type' => 'text',
            'title' => esc_html__('All items title', 'capital-core'),
        ),
		array(
            'id' => 'team_post_slug',
            'type' => 'text',
            'title' => esc_html__('Permalink slug', 'capital-core'),
            'desc' => esc_html__('All lowercase, no spaces in between words.', 'capital-core'),
        ),
		array(
            'id' => 'team_post_icon',
            'type' => 'text',
            'title' => esc_html__('Icon', 'capital-core'),
            'desc' => esc_html__('Enter dashboard icon class name for this post type. Get class names from https://developer.wordpress.org/resource/dashicons/', 'capital-core'),
        ),
		array(
			'id'       => 'disable_team_archive',
			'type'     => 'checkbox',
			'title'    => esc_html__('Disable post type archive page.', 'capital-core'),
            'desc' => esc_html__('By default WordPress create a page for all post types which makes it impossible for you to create a new page with the same slug as of custom post type. Check this to disable the default cpt page.', 'capital-core'),
			'default' => 0
		),
		array(
			'id'       => 'info_post_team_end',
			'type'     => 'accordion',
			'position' => 'end',
		),
		array(
			'id'       => 'info_post_testimonials_start',
			'type'     => 'accordion',
			'position' => 'start',
			'title'    => esc_html__('Testimonials', 'capital-core'),
		),
		array(
            'id' => 'testimonial_post_title',
            'type' => 'text',
            'title' => esc_html__('Title', 'capital-core'),
        ),
		array(
            'id' => 'testimonial_post_plural_title',
            'type' => 'text',
            'title' => esc_html__('Plural title', 'capital-core'),
        ),
		array(
            'id' => 'testimonial_post_all',
            'type' => 'text',
            'title' => esc_html__('All items title', 'capital-core'),
        ),
		array(
            'id' => 'testimonial_post_slug',
            'type' => 'text',
            'title' => esc_html__('Permalink slug', 'capital-core'),
            'desc' => esc_html__('All lowercase, no spaces in between words.', 'capital-core'),
        ),
		array(
            'id' => 'testimonial_post_icon',
            'type' => 'text',
            'title' => esc_html__('Icon', 'capital-core'),
            'desc' => esc_html__('Enter dashboard icon class name for this post type. Get class names from https://developer.wordpress.org/resource/dashicons/', 'capital-core'),
        ),
		array(
			'id'       => 'disable_testimonial_archive',
			'type'     => 'checkbox',
			'title'    => esc_html__('Disable post type archive page.', 'capital-core'),
            'desc' => esc_html__('By default WordPress create a page for all post types which makes it impossible for you to create a new page with the same slug as of custom post type. Check this to disable the default cpt page.', 'capital-core'),
			'default' => 0
		),
		array(
			'id'       => 'info_post_testimonials_end',
			'type'     => 'accordion',
			'position' => 'end',
		),
	)
);
            $wbc_importer_label = trim( esc_html( apply_filters( 'wbc_importer_label', __( 'Demo Importer', 'capital-core' ) ) ) );

            $wbc_importer_label = ( !empty( $wbc_importer_label ) ) ? $wbc_importer_label : __( 'Demo Importer', 'capital-core' );

            $this->parent->sections[] = array(
                'id'     => 'wbc_importer_section',
                'title'  => $wbc_importer_label,
                'desc'   => '<p class="description">'. apply_filters( 'wbc_importer_description', esc_html__( 'Works best to import on a new install of WordPress', 'capital-core' ) ).'</p>',
                'icon'   => 'el-icon-website',
                'fields' => array(
                    array(
                        'id'   => 'wbc_demo_importer',
                        'type' => 'wbc_importer'
                    )
                )
            );
        }

    } // class
} // if
