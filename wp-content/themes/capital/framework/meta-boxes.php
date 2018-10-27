<?php
/* * ** Meta Box Functions **** */
$prefix = 'capital_';
global $meta_boxes;
$options = get_option('capital_options');
$gmap_api_key = (isset($options['google_map_api']))?$options['google_map_api']:'';
load_theme_textdomain('capital', CAPITAL_FILEPATH . '/language');
/* FONT AWESOME DATA IN PHP
================================================== */
require_once CAPITAL_FILEPATH . '/framework/font-awesome.php';
$meta_boxes = array();
//Page Design Meta Box
$meta_boxes[] = array(
	'title'       => esc_html__( 'Page Design Options', 'capital' ),
	'tabs'      => array(
		'layout'    => array(
			'label' => esc_html__( 'Layout', 'capital' ),
		),
		'header'    => array(
			'label' => esc_html__( 'Header', 'capital' ),
		),
		'page_header'  => array(
			'label' => esc_html__( 'Page Header', 'capital' ),
		),
		'page_title'  => array(
			'label' => esc_html__( 'Page Title', 'capital' ),
		),
		'page_content' => array(
			'label' => esc_html__( 'Content', 'capital' ),
		),
		'social_share'    => array(
			'label' => esc_html__( 'Social Sharing', 'capital' ),
		),
	),
	// Tab style: 'default', 'box' or 'left'. Optional
	'tab_style' => 'left',
	// Show meta box wrapper around tabs? true (default) or false. Optional
	'tab_wrapper' => true,
   	'pages' => array('post','page','imi_team','imi_projects','imi_services','product'),
	'fields'    => array(
		array(
            'name' => esc_html__('Standard Logo', 'capital'),
            'id' => $prefix . 'page_logo',
            'desc' => esc_html__("Upload logo image to show on this page.", 'capital'),
            'type' => 'image_advanced',
			'tab'  => 'header',
            'max_file_uploads' => 1
        ),
		array(
            'name' => esc_html__('Retina Logo', 'capital'),
            'id' => $prefix . 'page_logo_retina',
            'desc' => esc_html__("Retina Display is a marketing term developed by Apple to refer to devices and monitors that have a resolution and pixel density so high &ndash; roughly 300 or more pixels per inch.", 'capital'),
            'type' => 'image_advanced',
			'tab'  => 'header',
            'max_file_uploads' => 1
        ),
		array(
            'name' => esc_html__('Standard Logo Width for Retina Logo', 'capital'),
            'desc' => esc_html__("If retina logo is uploaded, enter the standard logo (1x) version width, do not enter the retina logo width.", 'capital'),
            'id' => $prefix . 'page_logo_retina_width',
            'type' => 'text',
			'tab'  => 'header',
		),
		array(
            'name' => esc_html__('Standard Logo Height for Retina Logo', 'capital'),
            'desc' => esc_html__("If retina logo is uploaded, enter the standard logo (1x) version height, do not enter the retina logo height.", 'capital'),
            'id' => $prefix . 'page_logo_retina_height',
            'type' => 'text',
			'tab'  => 'header',
		),
		array(
            'name' => esc_html__('Topbar Show/Hide', 'capital'),
            'id' => $prefix . 'page_topbar_show',
            'type' => 'select',
			'tab'  => 'header',
            'options' => array(
                1 => esc_html__('Show', 'capital'),
                0 => esc_html__('Hide', 'capital'),
            ),
            'std' => 1,
        ),
		array(
            'name' => esc_html__('Page layout', 'capital'),
            'id' => $prefix . 'page_layout',
            'desc' => esc_html__("Select layout for the page.", 'capital'),
            'type' => 'select',
			'tab'  => 'layout',
            'options' => array(
				'' => esc_html__('Theme Default', 'capital'),
				'full-width-page' => esc_html__('Full Width', 'capital'),
				'boxed' => esc_html__('Boxed', 'capital'),
            )
        ),
		array(
            'name' => esc_html__('Content Width', 'capital'),
            'desc' => esc_html__("Enter width of content in px or %", 'capital'),
            'id' => $prefix . 'content_width',
            'type' => 'text',
			'tab'  => 'page_content',
		),
		array(
            'name' => esc_html__('Content Padding Top', 'capital'),
            'id' => $prefix . 'content_padding_top',
            'type' => 'number',
            'std' => 60,
			'tab'  => 'page_content',
		),
		array(
            'name' => esc_html__('Content Padding Bottom', 'capital'),
            'id' => $prefix . 'content_padding_bottom',
            'type' => 'number',
            'std' => '60',
			'tab'  => 'page_content',
		),
		array(
            'name' => esc_html__('Background Color', 'capital'),
            'id' => $prefix . 'pages_body_bg_color',
            'desc' => esc_html__("Choose background color for the outer area", 'capital'),
            'type' => 'color',
			'tab'  => 'layout',
			'visible' => array( 'capital_page_layout', '=', 'boxed' )
        ),
		array(
            'name' => esc_html__('Background Image', 'capital'),
            'id' => $prefix . 'pages_body_bg_image',
            'desc' => esc_html__("Choose background image for the outer area", 'capital'),
            'type' => 'image_advanced',
			'tab'  => 'layout',
            'max_file_uploads' => 1,
			'visible' => array( 'capital_page_layout', '=', 'boxed' )
        ),
		array(
            'name' => esc_html__('100% Background Image', 'capital'),
            'id' => $prefix . 'pages_body_bg_wide',
            'desc' => esc_html__("Choose to have the background image display at 100%.", 'capital'),
            'type' => 'select',
			'tab'  => 'layout',
            'options' => array(
                '1' => esc_html__('Yes', 'capital'),
                '0' => esc_html__('No', 'capital'),
            ),
            'std' => 0,
			'visible' => array( 'capital_page_layout', '=', 'boxed' )
        ),
		array(
            'name' => esc_html__('Background Repeat', 'capital'),
            'id' => $prefix . 'pages_body_bg_repeat',
            'desc' => esc_html__("Select how the background image repeats.", 'capital'),
            'type' => 'select',
			'tab'  => 'layout',
            'options' => array(
                'repeat' => esc_html__('Repeat', 'capital'),
                'repeat-x' => esc_html__('Repeat Horizontally', 'capital'),
                'repeat-y' => esc_html__('Repeat Vertically', 'capital'),
                'no-repeat' => esc_html__('No Repeat', 'capital'),
            ),
            'std' => 'repeat',
			'visible' => array( 'capital_page_layout', '=', 'boxed' )
        ),
		array(
            'name' => esc_html__('Background Color', 'capital'),
            'id' => $prefix . 'pages_content_bg_color',
            'desc' => esc_html__("Choose background color for the Content area", 'capital'),
            'type' => 'color',
			'tab'  => 'page_content',
        ),
		array(
            'name' => esc_html__('Background Image', 'capital'),
            'id' => $prefix . 'pages_content_bg_image',
            'desc' => esc_html__("Choose background image for the Content area", 'capital'),
            'type' => 'image_advanced',
			'tab'  => 'page_content',
            'max_file_uploads' => 1
        ),
		array(
            'name' => esc_html__('100% Background Image', 'capital'),
            'id' => $prefix . 'pages_content_bg_wide',
            'desc' => esc_html__("Choose to have the background image display at 100%.", 'capital'),
            'type' => 'select',
			'tab'  => 'page_content',
            'options' => array(
                1 => esc_html__('Yes', 'capital'),
                0 => esc_html__('No', 'capital'),
            ),
            'std' => 0,
        ),
		array(
            'name' => esc_html__('Background Repeat', 'capital'),
            'id' => $prefix . 'pages_content_bg_repeat',
            'desc' => esc_html__("Select how the background image repeats.", 'capital'),
            'type' => 'select',
			'tab'  => 'page_content',
            'options' => array(
                'repeat' => esc_html__('Repeat', 'capital'),
                'repeat-x' => esc_html__('Repeat Horizontally', 'capital'),
                'repeat-y' => esc_html__('Repeat Vertically', 'capital'),
                'no-repeat' => esc_html__('No Repeat', 'capital'),
            ),
            'std' => 'repeat',
        ),
		array(
            'name' => esc_html__('Page Header Show/Hide', 'capital'),
            'id' => $prefix . 'page_header_show',
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
                1 => esc_html__('Show', 'capital'),
                0 => esc_html__('Hide', 'capital'),
            ),
            'std' => 1,
        ),
		array(
            'name' => esc_html__('Choose Header Type', 'capital'),
            'id' => $prefix . 'pages_Choose_slider_display',
            'desc' => esc_html__("Select Banner Type.", 'capital'),
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
				1 => esc_html__('Colored Banner', 'capital'),
				2 => esc_html__('Image Banner', 'capital'),
                4 => esc_html__('Flex Slider', 'capital'),
                5 => esc_html__('Revolution Slider', 'capital'),
            ),
			'std' => 2,
			'visible' => array( 'capital_page_header_show', '=', '1' ),
        ),
		array(
			'name' => esc_html__( 'Banner Color', 'capital' ),
			'id' => $prefix.'pages_banner_color',
			'type' => 'color',
			'tab'  => 'page_header',
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'visible' => array( 'capital_pages_Choose_slider_display', '=', '1' ),
		),
		array(
            'name' => esc_html__('Use featured image as page banner', 'capital'),
            'id' => $prefix . 'featured_image_banner',
            'desc' => esc_html__("If checked then your page/post featured image will be used as it's page header banner image. Uncheck to upload your own new image for the page header banner.", 'capital'),
            'type' => 'checkbox',
			'tab'  => 'page_header',
			'std'  => 0,
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'visible' => array( 'capital_pages_Choose_slider_display', '=', '2' ),
        ),
		array(
            'name' => esc_html__('Banner Image', 'capital'),
            'id' => $prefix . 'header_image',
            'desc' => esc_html__("Upload banner image for header for this Page/Post.", 'capital'),
            'type' => 'image_advanced',
			'tab'  => 'page_header',
            'max_file_uploads' => 1,
			'hidden' => array( 'capital_featured_image_banner', true ),
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'visible' => array( 'capital_pages_Choose_slider_display', '=', '2' ),
        ),
		array(
            'name' => esc_html__('Banner image overlay', 'capital'),
            'id' => $prefix . 'header_image_overlay',
            'desc' => esc_html__("Choose over color for Image banner.", 'capital'),
            'type' => 'color',
			'tab'  => 'page_header',
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'hidden' => array( 'capital_pages_Choose_slider_display', 'between', [3,5] ),
        ),
		array(
            'name' => esc_html__('Banner image overlay opacity', 'capital'),
            'id' => $prefix . 'header_image_overlay_opacity',
            'desc' => esc_html__("Enter value for opacity of banner image overlay. Enter value between 0.1 to 1.", 'capital'),
            'type' => 'text',
			'tab'  => 'page_header',
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'hidden' => array( 'capital_pages_Choose_slider_display', 'between', [3,5] ),
        ),
        array(
		   'name' => esc_html__('Select Revolution Slider from list','capital'),
			'id' => $prefix . 'pages_select_revolution_from_list',
			'desc' => esc_html__("Select Revolution Slider from list", 'capital'),
			'type' => 'select',
			'tab'  => 'page_header',
			'options' => capital_RevSliderShortCode(),
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'visible' => array( 'capital_pages_Choose_slider_display', '=', '5' ),
		),
        //Slider Images
        array(
            'name' => esc_html__('Slider Images', 'capital'),
            'id' => $prefix . 'pages_slider_image',
            'desc' => esc_html__("Upload/select slider images.", 'capital'),
            'type' => 'image_advanced',
			'tab'  => 'page_header',
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'visible' => array( 'capital_pages_Choose_slider_display', '=', '4' ),
        ),
		array(
            'name' => esc_html__('Slider Pagination', 'capital'),
            'id' => $prefix . 'pages_slider_pagination',
            'desc' => esc_html__("Enable to show pagination for slider.", 'capital'),
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
                'yes' => esc_html__('Enable', 'capital'),
                'no' => esc_html__('Disable', 'capital'),
            ),
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'visible' => array( 'capital_pages_Choose_slider_display', '=', '4' ),
        ),
		array(
            'name' => esc_html__('Slider Auto Slide', 'capital'),
            'id' => $prefix . 'pages_slider_auto_slide',
            'desc' => esc_html__("Select Yes to slide automatically.", 'capital'),
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
                'yes' => esc_html__('Yes', 'capital'),
                'no' => esc_html__('No', 'capital'),
            ),
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'visible' => array( 'capital_pages_Choose_slider_display', '=', '4' ),
        ),
		array(
            'name' => esc_html__('Slider Direction Arrows', 'capital'),
            'id' => $prefix . 'pages_slider_direction_arrows',
            'desc' => esc_html__("Select Yes to show slider direction arrows.", 'capital'),
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
                'yes' => esc_html__('Yes', 'capital'),
                'no' => esc_html__('No', 'capital'),
            ),
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'visible' => array( 'capital_pages_Choose_slider_display', '=', '4' ),
        ),
		array(
            'name' => esc_html__('Slider Effects', 'capital'),
            'id' => $prefix . 'pages_slider_effects',
            'desc' => esc_html__("Select effects for slider.", 'capital'),
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
                'fade' => esc_html__('Fade', 'capital'),
                'slide' => esc_html__('Slide', 'capital'),
            ),
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'visible' => array( 'capital_pages_Choose_slider_display', '=', '4' ),
        ),
		array(
            'name' => esc_html__('Banner/Slider Height', 'capital'),
            'id' => $prefix . 'pages_slider_height',
            'desc' => esc_html__("Enter Height for Banner/Slider Ex-250. DO NOT ENTER px HERE", 'capital'),
            'type' => 'text',
			'tab'  => 'page_header',
			'visible' => array( 'capital_page_header_show', '=', '1' ),
			'hidden' => array( 'capital_pages_Choose_slider_display', '=', '4' ),
			'hidden' => array( 'capital_pages_Choose_slider_display', '=', '5' ),
        ),
		array(
            'name' => esc_html__('Page Title Show/Hide', 'capital'),
            'id' => $prefix . 'pages_title_show',
            'type' => 'select',
			'tab'  => 'page_title',
            'options' => array(
                1 => esc_html__('Show', 'capital'),
                0 => esc_html__('Hide', 'capital'),
            ),
            'std' => 1,
        ),
		array(
            'name' => esc_html__('Page Title Text Color', 'capital'),
            'id' => $prefix . 'pages_banner_text_color',
            'desc' => esc_html__("Select banner text color.", 'capital'),
            'type' => 'color',
			'tab'  => 'page_title'
        ),
		array(
            'name' => esc_html__('Page Title Alignment', 'capital'),
            'id' => $prefix . 'pages_title_alignment',
            'desc' => esc_html__("Choose aligment of the page title.", 'capital'),
            'type' => 'select',
			'tab'  => 'page_title',
            'options' => array(
				'' => esc_html__('Theme Default', 'capital'),
				'left' => esc_html__('Left', 'capital'),
				'center' => esc_html__('Center', 'capital'),
                'right' => esc_html__('Right', 'capital'),
            ),
        ),
		array(
            'name' => esc_html__('Page header sub title', 'capital'),
            'desc' => esc_html__("Enter sub title for the page that will show below the page title in the page header area.", 'capital'),
            'id' => $prefix . 'header_sub_title',
            'type' => 'text',
			'tab'  => 'page_title',
		),
		array(
            'name' => esc_html__('Breadcrumb Show/Hide', 'capital'),
            'id' => $prefix . 'pages_breadcrumb_show',
            'type' => 'select',
			'tab'  => 'page_title',
            'options' => array(
                1 => esc_html__('Show', 'capital'),
                0 => esc_html__('Hide', 'capital'),
            ),
            'std' => 1,
        ),
		array(
            'name' => esc_html__('Show social sharing buttons', 'capital'),
            'id' => $prefix . 'page_social_share',
            'type' => 'select',
			'tab'  => 'social_share',
            'options' => array(
                '1' => esc_html__('Show', 'capital'),
                '0' => esc_html__('Hide', 'capital'),
            ),
            'std' => 1,
        ),
	)
);

/* Post Meta Box
  ================================================== */
$meta_boxes[] = array(
    'id' => 'gallery_meta_box',
    'title' => __('Post media', 'capital'),
    'pages' => array('post'),
	'context' => 'side',
	'priority' => 'low',
    'fields' => array(
        // Video Url
        array(
            'name' => esc_html__('Video URL', 'capital'),
            'id' => $prefix . 'post_video_url',
            'desc' => esc_html__("Enter Youtube or Vimeo URL", 'capital'),
            'type' => 'url',
			'visible' => ['post_format','video']
        ),
        // Link URL
        array(
            'name' => esc_html__('Link', 'capital'),
            'id' => $prefix . 'post_link_url',
            'desc' => esc_html__("Enter the link URL", 'capital'),
            'type' => 'url',
			'visible' => ['post_format','link']
        ),
		array(
            'name' => esc_html__('Gallery images', 'capital'),
            'id' => $prefix . 'post_gallery_images',
            'desc' => esc_html__("Upload images for gallery/slider", 'capital'),
            'type' => 'image_advanced',
            'max_file_uploads' => 30,
			'visible' => ['post_format','gallery']
        ),
       array(
            'name' => esc_html__('Show slider pagination?', 'capital'),
            'id' => $prefix . 'post_slider_pagination',
            'desc' => esc_html__("Select yes to show pagination for slider.", 'capital'),
            'type' => 'select',
            'options' => array(
                'yes' => esc_html__('Yes', 'capital'),
                'no' => esc_html__('No', 'capital'),
            ),
			'visible' => ['post_format','gallery']
        ),
		array(
            'name' => esc_html__('Show next/prev arrows?', 'capital'),
            'id' => $prefix . 'post_slider_direction_arrows',
            'desc' => esc_html__("Select Yes to show slider direction arrows.", 'capital'),
            'type' => 'select',
            'options' => array(
                'yes' => esc_html__('Yes', 'capital'),
                'no' => esc_html__('No', 'capital'),
            ),
			'visible' => ['post_format','gallery']
        ),
		array(
            'name' => esc_html__('Slider autoplay?', 'capital'),
            'id' => $prefix . 'post_slider_auto_slide',
            'desc' => esc_html__("Select Yes to auto slide the posts gallery images.", 'capital'),
            'type' => 'select',
            'options' => array(
                'yes' => esc_html__('Yes', 'capital'),
                'no' => esc_html__('No', 'capital'),
            ),
			'visible' => ['post_format','gallery']
        ),
        //Audio Display
        array(
            'name' => esc_html__('Soundcloud Embed Code', 'capital'),
            'id' => $prefix . 'post_uploaded_audio',
            'desc' => esc_html__("Paste your soundcloud audio embed code here. Help: http://bit.ly/2gRU1is", 'capital'),
            'type' => 'textarea',
			'visible' => ['post_format','audio']
        ),
    )
);
/* Testimonials Meta Box
  ================================================== */
$meta_boxes[] = array(
    'title' => esc_html__('Testimonial Author Info', 'capital'),
    'pages' => array('imi_testimonials'),
    'fields' => array(
        array(
            'name' => esc_html__('Sub title', 'capital'),
            'id' => $prefix . 'testi_sub_title',
            'desc' => esc_html__("Enter sub title for the testimonial that will appear with the name of the author. It can be company name or job position.", 'capital'),
            'type' => 'text',
        ),
    )
);
/* Services Meta Box
  ================================================== */
$meta_boxes[] = array(
    'title' => esc_html__('Service Info', 'capital'),
    'pages' => array('imi_services'),
    'fields' => array(
        array(
            'name' => esc_html__('Choose Icon', 'capital'),
            'id' => $prefix . 'service_icon',
            'desc' => esc_html__("Choose icons from the list of Icon names here. All Font Awesome Icon can be found here: http://fontawesome.io/icons/", 'capital'),
            'type' => 'select',
			'options' => capital_smk_font_awesome('readable')
        ),
    )
);
/* Team Meta Box
  ================================================== */
$meta_boxes[] = array(
    'id' => 'team_meta_box',
    'title' => esc_html__('Team Member Information', 'capital'),
    'pages' => array('imi_team'),
	'priority' => 'high',
    'fields' => array(
		array(
            'name' => esc_html__('Job position', 'capital'),
            'id' => $prefix . 'staff_position',
            'desc' => esc_html__("Enter job designation/position of team member.", 'capital'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Email', 'capital'),
            'id' => $prefix . 'staff_member_email',
            'desc' => esc_html__("Enter the team member's email.", 'capital'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Phone no.', 'capital'),
            'id' => $prefix . 'staff_member_phone',
            'desc' => esc_html__("Enter the team member's phone number.", 'capital'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Address', 'capital'),
            'id' => $prefix . 'staff_member_address',
            'desc' => esc_html__("Enter the team member's postal address.", 'capital'),
            'type' => 'textarea',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Facebook', 'capital'),
            'id' => $prefix . 'staff_member_facebook',
            'desc' => esc_html__("Enter team member's Facebook account URL.", 'capital'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Twitter', 'capital'),
            'id' => $prefix . 'staff_member_twitter',
            'desc' => esc_html__("Enter team member's Twitter account URL.", 'capital'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Google Plus', 'capital'),
            'id' => $prefix . 'staff_member_gplus',
            'desc' => esc_html__("Enter team member's Google Plus profile URL.", 'capital'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Linkedin', 'capital'),
            'id' => $prefix . 'staff_member_linkedin',
            'desc' => esc_html__("Enter team member's Linkedin profile URL.", 'capital'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Pinterest', 'capital'),
            'id' => $prefix . 'staff_member_pinterest',
            'desc' => esc_html__("Enter team member's Pinterest profile URL.", 'capital'),
            'type' => 'text',
            'std' => '',
        ),
    )
);
/* * ******************* META BOX REGISTERING ********************** */
/**
 * Register meta boxes
 *
 * @return void
 */
function capital_register_meta_boxes() {
    global $meta_boxes;
    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if (class_exists('RW_Meta_Box')) {
        foreach ($meta_boxes as $meta_box) {
            new RW_Meta_Box($meta_box);
        }
    }
}
add_action('rwmb_meta_boxes', 'capital_register_taxonomy_meta_boxes');
function capital_register_taxonomy_meta_boxes($meta_boxes) {
$prefix = 'capital_';
/* Term Meta Box
  ================================================== */
$meta_boxes[] = array(
    'title' => esc_html__('Additional Info', 'capital'),
    'taxonomies' => array('imi_projects_category', 'imi_service_category', 'imi_team_category', 'category'),
    'fields' => array(
		array(
            'name' => esc_html__('Page banner image', 'capital'),
            'id' => $prefix . 'term_banner_image',
            'type' => 'image_advanced',
            'max_file_uploads' => 1
		),
    )
);
	return $meta_boxes;
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking Page template, categories, etc.
add_action('admin_init', 'capital_register_meta_boxes');
?>