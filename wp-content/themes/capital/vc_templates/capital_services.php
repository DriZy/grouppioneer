<?php
/*Front end view of services shortcode
==================================*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
global $capital_allowed_tags;

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if($grid_column==4)
{
	$carousel_col_class = 3;
}
elseif($grid_column==3)
{
	$carousel_col_class = 4;
}
elseif($grid_column==6)
{
	$carousel_col_class = 2;
}
elseif($grid_column==12)
{
	$carousel_col_class = 1;
}

if($carousel_pagi==1){
	$carousel_pagi_class = 'carousel-pagination-active';
} else {
	$carousel_pagi_class = '';
}

	
$bgstyle_classes = array();
$bgstyle_class = '';

if( !empty( $capital_style_bg ) ) {
	$bgstyle_classes[] = ' '.esc_attr($capital_style_bg);
}

if( !empty( $bgstyle_classes ) ) {
	$bgstyle_class = join(' ', $bgstyle_classes);
}

$bgstyle_style = '';
$bgstyle_styles = array();

if( $capital_style_bg == 'custom-bg-style' && !empty( $capital_style_bg_custom ) ) {
	$bgstyle_styles[] = 'background-color:' . $capital_style_bg_custom;
}
if( !empty( $bgstyle_styles ) ) {
	$bgstyle_style = ' style="'. implode( ';', $bgstyle_styles ) .'"';
}


$post_output = '<div class="'.esc_attr( $css_class ).' '.esc_html($capital_style_border).' '.esc_html($carousel_arrows_position).' '.esc_html($capital_style_spacing).' '.esc_html($capital_style_skin).'  '.esc_html($bgstyle_class).'">';
if($view=="carousel"){
	$post_output .= '<div class="carousel-wrapper">';
} elseif($view=="grid"){
	$post_output .= '<div class="row capital-styled-row">';
}
if($view=="carousel")
{
	if ( is_rtl() )	{
		$data_rtl = 'yes';
	} else {
		$data_rtl = 'no';
	}
	if($carousel_arrows==1){
		$carrows = 'yes';
	} else {
		$carrows = 'no';
	}
	if($carousel_pagi==1){
		$cpagi = 'yes';
	} else {
		$cpagi = 'no';
	}
	if($carousel_loop==1){
		$cloop = 'yes';
	} else {
		$cloop = 'no';
	}
	if($carousel_autoplay!=''){
		$cauto = 'yes';
	} else {
		$cauto = 'no';
	}
	if($capital_style_spacing == 'non-spaced-items'){
		$owl_margin = 0;
	} else {
		$owl_margin = 25;
	}
	$post_output .= '<div class="capital-styled-row equal-heighter '.$carousel_pagi_class.'"><ul class="owl-carousel carousel-fw services-carousel services-list" data-columns="'.esc_attr($carousel_col_class).'" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-auto-height="no" data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'" data-padding="'.$carousel_padding.'">';
}
elseif($view=="list")
{
	$post_output .= '<ul class="services-list">';
}
elseif($view=="grid")
{
	if($capital_style_spacing == 'spaced-items' && $grid_column==3){
		$grid_width = '100.3%';
	} else {
		$grid_width = '';
	}
	$post_output .= '<ul class="grid-holder equal-heighter isotope gallery-items services-list" data-sort-id="gallery" style="width:'.$grid_width.'">';
}

$post_args = array('post_type'=>'imi_services', 'posts_per_page'=>$number, 'paged' => get_query_var('paged'));
if($terms!='')
{
    $terms = explode(',', $terms);
    $post_args['tax_query'] = [
        [
            'taxonomy' => 'imi_services_category',
            'terms' => $terms,
            'field' => 'term_id',
			'operator'=>'IN'
        ]
    ];
}
$post_list = new WP_Query($post_args);
if($post_list->have_posts()):while($post_list->have_posts()):$post_list->the_post();
$thumbnail = get_the_post_thumbnail(get_the_ID(),$img_size);
if($img_size != ''){
	$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => $img_size) );
	$thumbnail = $post_thumbnail['thumbnail'];
} else {
	$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => '450x400') );
	$thumbnail = $post_thumbnail;
}

$icon = get_post_meta(get_the_ID(), 'capital_service_icon', true);
if($icon != ''){
	$icon = $icon;
} else {
	$icon = 'fa-camera';
}

// Carousel View
if($view=="carousel")
{
$post_output .= '<li class="item">
				 <div class="grid-item service-grid-item service-carousel-item format-standard '.$thumb.'">';
if($thumb != 'no-service-media'){
		if($linked == 1){
			$post_output .= '<a href="'.get_the_permalink().'" class="media-box">';
		}
		if($thumb == 'icon-service-media'){
			$post_output .= '<div class="service-media"><div class="service-icon">';
			$post_output .= '<i class="fa '.$icon.'"></i>';
			$post_output .= '</div></div>';
		} else {
			$post_output .= '<div class="service-media"><div class="service-imagen">';
			if(has_post_thumbnail())
			{
				$post_output .= $thumbnail;
			} else {
				$post_output .= '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" alt="" width="100%">';
			}
			$post_output .= '</div></div>';
		}

		if($linked == 1){
			$post_output .= '</a>';
		}
	}
	if($show_title == 1 || ($excerpt_number != '' && $excerpt_number != 0) || $more == 1){
		$post_output .= '<div class="service-item-grid-content post-item-content equal-height-column"'.$bgstyle_style.'>';
		if($show_title == 1){
			$post_output .= '<h4 class="style-title">';
			if($linked == 1){
				$post_output .= '<a href="'.get_the_permalink().'">';
			}
			$post_output .= get_the_title();
			if($linked == 1){
				$post_output .= '</a>';
			}
			$post_output .= '</h4>';
		}
		if($excerpt_number != '' && $excerpt_number != 0){
			$post_output .= '<div class="post-item-excerpt">'.capital_excerpt($excerpt_number).'</div>';
		}
		if($more == 1){
			$post_output .= '<div class="spacer-50"></div><a href="'.get_permalink().'" class="basic-link read-more-link">'.$more_text.'</a>';
		}
		$post_output .= '</div>';
	}
	$post_output .= '</div></li>';			 
}
elseif($view=="list")
// List View
{
	$post_output .= '<li class="service-list-item format-standard post-item-content '.$thumb.'"'.$bgstyle_style.'>';
	if($thumb != 'no-service-media'){
		if($linked == 1){
			$post_output .= '<a href="'.get_the_permalink().'" class="media-box">';
		}
		if($thumb == 'icon-service-media'){
			$post_output .= '<div class="pull-left"><div class="service-icon">';
			$post_output .= '<i class="fa '.$icon.'"></i>';
			$post_output .= '</div></div>';
		} else {
			$post_output .= '<div class="service-imagen">';
			if(has_post_thumbnail())
			{
				$post_output .= $thumbnail;
			} else {
				$post_output .= '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" alt="" width="100%">';
			}
			$post_output .= '</div>';
		}
	}
	if($linked == 1){
		$post_output .= '</a>';
	}
	if($show_title == 1 || ($excerpt_number != '' && $excerpt_number != 0) || $more == 1){
		$post_output .= '<div class="service-item-content">';
		if($show_title == 1){
			$post_output .= '<h3>';
			if($linked == 1){
				$post_output .= '<a href="'.get_the_permalink().'">';
			}
			$post_output .= get_the_title();
			if($linked == 1){
				$post_output .= '</a>';
			}
			$post_output .= '</h3>';
		}
		if($excerpt_number != '' && $excerpt_number != 0){
			$post_output .= '<div class="post-item-excerpt">'.capital_excerpt($excerpt_number).'</div>';
		}
		if($more == 1){
			$post_output .= '<a href="'.get_permalink().'" class="basic-link">'.$more_text.'</a>';
		}
		$post_output .= '</div>';
	}
	$post_output .= '</li>';
}
else
{
	$post_output .= '<li class="col-md-'.$grid_column.' col-sm-6 grid-item service-grid-item format-standard '.$thumb.'">
					<div class="grid-item-inner">';
	if($thumb != 'no-service-media'){
		if($linked == 1){
			$post_output .= '<a href="'.get_the_permalink().'" class="media-box">';
		}
		if($thumb == 'icon-service-media'){
			$post_output .= '<div class="service-media"><div class="service-icon">';
			$post_output .= '<i class="fa '.$icon.'"></i>';
			$post_output .= '</div></div>';
		} else {
			$post_output .= '<div class="service-media"><div class="service-imagen">';
			if(has_post_thumbnail())
			{
				$post_output .= $thumbnail;
			} else {
				$post_output .= '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" alt="" width="100%">';
			}
			$post_output .= '</div></div>';
		}

		if($linked == 1){
			$post_output .= '</a>';
		}
	}
	$post_output .= '<div class="service-item-grid-content equal-height-column post-item-content"'.$bgstyle_style.'>';
	if($show_title == 1){
		$post_output .= '<h4 class="style-title">';
		if($linked == 1){
			$post_output .= '<a href="'.get_the_permalink().'">';
		}
		$post_output .= get_the_title();
		if($linked == 1){
			$post_output .= '</a>';
		}
		$post_output .= '</h4>';
	}
	if($excerpt_number != '' && $excerpt_number != 0){
		$post_output .= '<div class="post-item-excerpt">'.capital_excerpt($excerpt_number).'</div>';
	}
	if($more == 1){
		$post_output .= '<div class="spacer-50"></div><a href="'.get_permalink().'" class="basic-link read-more-link">'.$more_text.'</a>';
	}
	$post_output .= '</div></li>';
}
endwhile; endif; wp_reset_postdata();
if($view=="carousel")
{
	$post_output .= '</ul></div></div>';
}
elseif($view=="list")
{
	$post_output .= '</ul>';
}
else
{
	$post_output .= '</ul></div>';
}

$post_output .= '</div>';
echo wp_kses($post_output, $capital_allowed_tags);
if($pagination == 1){
	$post_output .= '<div class="margin-10"></div>';
	$GLOBALS['wp_query'] = $post_list;
	$post_output .= capital_pagination();
	wp_reset_query();
}
?>