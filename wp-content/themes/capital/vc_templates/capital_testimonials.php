<?php
/*Front end view of testimonials shortcode
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
} else {
	$carousel_col_class = '';
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
	$bgstyle_styles[] = 'background-color:' . esc_attr( $capital_style_bg_custom );
}
if( !empty( $bgstyle_styles ) ) {
	$bgstyle_style = ' style="'. implode( ';', $bgstyle_styles ) .'"';
}

$post_output = '<div class="'.esc_attr( $css_class ).' '.esc_html($capital_style_border).' '.esc_html($carousel_arrows_position).' '.esc_html($capital_style_spacing).' '.esc_html($style).' '.esc_html($capital_style_skin).'  '.esc_html($bgstyle_class).'">';

if($style == 'testimonials-style1'){
	if($view=="carousel"){
		$post_output .= '<div class="carousel-wrapper">';
	} else {
		$post_output .= '<div class="row capital-styled-row">';
	}
} else {
	$post_output .= '<div class="carousel-wrapper">';
}
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


if($style=="testimonials-style1"){
	if($view=="carousel")
	{
		$post_output .= '<div class="capital-styled-row equal-heighter '.$carousel_pagi_class.'"><ul class="owl-carousel carousel-fw testimonials-carousel" data-columns="'.esc_attr($carousel_col_class).'" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'" data-padding="'.$carousel_padding.'">';
	}
	elseif($view=="grid")
	{
		if($capital_style_spacing == 'spaced-items' && $grid_column==3){
			$grid_width = '100.3%';
		} else {
			$grid_width = '';
		}
		$post_output .= '<ul class="grid-holder equal-heighter isotope gallery-items" data-sort-id="gallery" style="width:'.$grid_width.'">';
	}
} else {
	$post_output .= '<div class="'.$carousel_pagi_class.'"><ul class="owl-carousel carousel-fw testimonials-carousel" data-columns="1" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-auto-height="yes"  data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'" data-padding="'.$carousel_padding.'">';
}

$post_args = array('post_type'=>'imi_testimonials', 'posts_per_page'=>$number, 'paged' => get_query_var('paged'));
if($terms!='')
{
    $terms = explode(',', $terms);
    $post_args['tax_query'] = [
        [
            'taxonomy' => 'imi_testimonials_category',
            'terms' => $terms,
            'field' => 'term_id',
			'operator'=>'IN'
        ]
    ];
}
$post_list = new WP_Query($post_args);
if($post_list->have_posts()):while($post_list->have_posts()):$post_list->the_post();
$testi_subtitle = get_post_meta(get_the_ID(), 'capital_testi_sub_title', true);

if($style=="testimonials-style1")
{
	// Carousel View
	if($view=="carousel")
	{
		$post_output .= '<li class="item testimonial-item testimonial-grid-item">
					<div class="post-item-content equal-height-column"'.$bgstyle_style.'>';
	
		$post_output .= '<blockquote>'.get_the_excerpt().'</blockquote>';
		if(has_post_thumbnail() || $photo == 1 || $author == 1)
		{
			$post_output .= '<div class="testimonial-info">';
			if(has_post_thumbnail() && $photo == 1)
			{
				$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => '100x100') );
				$thumbnail = $post_thumbnail['thumbnail'];
				$post_output .= '<div class="testimonial-img-block '.$image_radius.'">'.$thumbnail.'</div>';
			}
			if($author == 1){
				$post_output .= '<cite><span><span><strong>'.get_the_title().'</strong>';
				if($subtitle == 1){
					$post_output .= $testi_subtitle;
				}
				$post_output .= '</span></span></cite>';
			}
			$post_output .= '</div>';
		}
		$post_output .= '</div></li>';
	}

	// Grid View
	else
	{
		$post_output .= '<li class="col-md-'.$grid_column.' col-sm-6 grid-item testimonial-item testimonial-grid-item format-standard">
						<div class="post-item-content equal-height-column"'.$bgstyle_style.'>';
		$post_output .= '<blockquote>'.get_the_excerpt().'</blockquote>';
		if($photo == 1 || $author == 1)
		{
			$post_output .= '<div class="testimonial-info">';
			if(has_post_thumbnail() && $photo == 1)
			{
				$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => '100x100') );
				$thumbnail = $post_thumbnail['thumbnail'];
				$post_output .= '<div class="testimonial-img-block '.$image_radius.'">'.$thumbnail.'</div>';
			}
			if($author == 1){
				$post_output .= '<cite><span><span><strong>'.get_the_title().'</strong>';
				if($subtitle == 1){
					$post_output .= $testi_subtitle;
				}
				$post_output .= '</span></span></cite>';
			}
			$post_output .= '</div>';
		}
		$post_output .= '</div></li>';
	}
} elseif($style == "testimonials-style2") {
	$post_output .= '<li class="item testimonial-item testimonial-grid-item">
					<div class="post-item-content"'.$bgstyle_style.'>';
	
	$post_output .= '<blockquote>'.get_the_excerpt().'</blockquote>';
	if($photo == 1 || $author == 1)
	{
		$post_output .= '<div class="testimonial-info">';
		if(has_post_thumbnail() && $photo == 1)
		{
			$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => '100x100') );
			$thumbnail = $post_thumbnail['thumbnail'];
			$post_output .= '<div class="testimonial-img-block '.$image_radius.'">'.$thumbnail.'</div>';
		}
		if($author == 1){
			$post_output .= '<cite><span><span><strong>'.get_the_title().'</strong>';
			if($subtitle == 1){
				$post_output .= $testi_subtitle;
			}
			$post_output .= '</span></span></cite>';
		}
		$post_output .= '</div>';
	}
	$post_output .= '</div></li>';
} elseif($style == "testimonials-style3") {
	$noimgeclass = '';
	if($photo == 0){
		$noimgeclass = 'testimonials-style3-no-image';
	}
	$post_output .= '<li class="item testimonial-item testimonial-grid-item equal-heighter '.$noimgeclass.'">
					<div class="post-item-content"'.$bgstyle_style.'>';
	
	if(has_post_thumbnail() && $photo == 1)
	{
		$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => '400x400') );
		$thumbnail = $post_thumbnail['thumbnail'];
		$post_output .= '<div class="testimonial-img-block equal-height-column '.$image_position.' '.$image_radius.'"><div class="vertical-center">'.$thumbnail.'</div></div>';
	}
	$post_output .= '<div class="equal-height-column testimonial-floated-content '.$image_position.'"><div class="vertical-center"><blockquote>'.get_the_excerpt().'</blockquote>';
	if($author == 1){
		$post_output .= '<div class="testimonial-info"><cite><strong>'.get_the_title().'</strong>';
		if($subtitle == 1){
			$post_output .= $testi_subtitle;
		}
		$post_output .= '</cite></div>';
	}
	$post_output .= '</div></div></div></li>';
}
endwhile; endif; wp_reset_postdata();
$post_output .= '</ul>';
if($style == 'testimonials-style1'){
	if($view=="carousel"){
		$post_output .= '</div></div>';
	} else {
		$post_output .= '</div>';
	}
} else {
	$post_output .= '</div></div>';
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