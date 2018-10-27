<?php
/*Front end view of team shortcode
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
elseif($grid_column==2)
{
	$carousel_col_class = 6;
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

$post_output = '<div class="'.esc_attr( $css_class ).' '.esc_html($capital_style_border).' '.esc_html($carousel_arrows_position).' '.esc_html($capital_style_spacing).' '.esc_html($capital_style_skin).'  '.esc_html($bgstyle_class).'">';
if($view=="carousel"){
	$post_output .= '<div class="carousel-wrapper">';
} elseif($view=="grid") {
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
	$post_output .= '<div class="capital-styled-row equal-heighter '.$carousel_pagi_class.'"><ul class="owl-carousel carousel-fw team-carousel" data-columns="'.esc_attr($carousel_col_class).'" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-auto-height="no" data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'" data-padding="'.$carousel_padding.'">';
}
elseif($view=="list")
{
	$post_output .= '<div class="listings-block">';
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


$post_args = array('post_type'=>'imi_team', 'posts_per_page'=>$number, 'paged' => get_query_var('paged'));
if($terms!='')
{
    $terms = explode(',', $terms);
    $post_args['tax_query'] = [
        [
            'taxonomy' => 'imi_team_category',
            'terms' => $terms,
            'field' => 'term_id',
			'operator'=>'IN'
        ]
    ];
}
$post_list = new WP_Query($post_args);
if($post_list->have_posts()):while($post_list->have_posts()):$post_list->the_post();
$position = get_post_meta(get_the_ID(), 'capital_staff_position', true);
$facebook = get_post_meta(get_the_ID(), 'capital_staff_member_facebook', true);
$twitter = get_post_meta(get_the_ID(), 'capital_staff_member_twitter', true);
$gplus = get_post_meta(get_the_ID(), 'capital_staff_member_gplus', true);
$linkedin = get_post_meta(get_the_ID(), 'capital_staff_member_linkedin', true);
$pinterest = get_post_meta(get_the_ID(), 'capital_staff_member_pinterest', true);
$email = get_post_meta(get_the_ID(), 'capital_staff_member_email', true);
$phone = get_post_meta(get_the_ID(), 'capital_staff_member_phone', true);
$social = '';
$social_data = array();
$social_data = array('phone'=>$phone, 'envelope'=>$email, 'facebook'=>$facebook, 'twitter'=>$twitter, 'google-plus'=>$gplus, 'linkedin'=>$linkedin, 'pinterest'=>$pinterest);
if($facebook!=''||$twitter!=''||$gplus!=''||$linkedin!=''||$pinterest!=''||$email!=''||$phone!='')
{
	$social .= '<div class="social-icons-list">';
	foreach($social_data as $key=>$value)
	{
		if($value!='')
		{
			$url = $value;
			if($key=="envelope")
			{
				$url = 'mailto:'.$value;
			}
			if($key=="phone")
			{
				$url = 'tel:'.$value;
			}
			$social .= '<a href="'.$url.'">
						  <i class="fa fa-'.$key.'"></i>
					  </a>';
		}
	}
	$social .= '</div>';
}
$thumbnail = '';
if($img_size != ''){
	$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => $img_size) );
	$thumbnail = $post_thumbnail['thumbnail'];
} else {
	$post_thumbnail = get_the_post_thumbnail(get_the_ID(),'capital-400x400');
	$thumbnail = $post_thumbnail;
}

// Carousel View
if($view=="carousel")
{
	$post_output .= '<li class="item">
					 <div class="grid-item team-item team-grid-item team-carousel-item format-standard">';

	if(has_post_thumbnail() && $thumb == 1)
	{
		$post_output .= '<div class="team-media">';
		if($permalink == 1){
			$post_output .= '<a href="'.get_permalink().'" class="media-box">';
		}
		$post_output .= $thumbnail;
		if($permalink == 1){
			$post_output .= '</a>';
		}
		$post_output .= '</div>';
	}
	$post_output .= '<div class="equal-height-column post-item-content"'.$bgstyle_style.'>';
	$post_output .= '<h4>';
	if($permalink == 1){
		$post_output .= '<a  href="'.get_permalink().'">';
	}
	$post_output .= get_the_title ();
	if($permalink == 1){
		$post_output .= '</a>';
	}
	$post_output .= '</h4>';
	if($staff_position == 1 && $position != ''){
		$post_output .= '<div class="meta-data">'.$position.'</div>';
	}
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="team-item-excerpt post-item-excerpt">'.capital_excerpt($excerpt_number).'</div>';
	}
	if($staff_social == 1){
		$post_output .= $social;
	}
	if($more == 1){
		$post_output .= '<div class="spacer-50"></div><a href="'.get_permalink().'" class="basic-link read-more-link">'.$more_text.'</a>';
	}
	$post_output .= '</div></div></li>';
}

// List View
elseif($view=="list")


{
	$post_output .= '<div class="team-list-item team-item post-item-content format-standard"'.$bgstyle_style.'>
						<div class="row">';
	if(has_post_thumbnail() && $thumb == 1)
	{
		$post_output .= '<div class="col-md-4 col-sm-4 team-list-thumb">';
		if($permalink == 1){
			$post_output .= '<a href="'.get_permalink().'" class="media-box">';
		}
		$post_output .= '<div class="team-media">'.$thumbnail.'</div>';
		if($permalink == 1){
			$post_output .= '</a>';
		}
		$post_output .= '</div><div class="col-md-8 col-sm-8"><h3>';
	} else {
		$post_output .= '<div class="col-md-12 col-sm-12"><h3>';
	}
	if($permalink == 1){
		$post_output .= '<a href="'.get_permalink().'">';
	}
	$post_output .= ''.get_the_title().'';
	if($permalink == 1){
		$post_output .= '</a>';
	}
	$post_output .= '</h3>';
	if($staff_position == 1 && $position != ''){
		$post_output .= '<span class="meta-data">'.$position.'</span>';
	}
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="team-item-excerpt post-item-excerpt">'.capital_excerpt($excerpt_number).'</div>';
	}
	if($staff_social == 1){
		$post_output .= $social;
	}
	if($more == 1){
		$post_output .= '<a href="'.get_permalink().'" class="btn btn-primary read-more-link">'.$more_text.'</a>';
	}
	$post_output .= '</div>
			</div>
		</div>';
}

// Grid View
else


{
	$post_output .= '<li class="col-md-'.$grid_column.' col-sm-6 grid-item team-grid-item format-standard team-item"><div class="grid-item-content"'.$bgstyle_style.'>';

	if(has_post_thumbnail() && $thumb == 1)
	{
		$post_output .= '<div class="team-media">';
		if($permalink == 1){
			$post_output .= '<a href="'.get_permalink().'" class="media-box">';
		}
		$post_output .= $thumbnail;
		if($permalink == 1){
			$post_output .= '</a>';
		}
		$post_output .= '</div>';
	}
	$post_output .= '<div class="equal-height-column post-item-content">';
	$post_output .= '<h4>';
	if($permalink == 1){
		$post_output .= '<a href="'.get_permalink().'">';
	}
	$post_output .= get_the_title();
	if($permalink == 1){
		$post_output .= '</a>';
	}
	$post_output .= '</h4>';
	if($staff_position == 1 && $position != ''){
		$post_output .= '<div class="meta-data">'.$position.'</div>';
	}
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="team-item-excerpt post-item-excerpt">'.capital_excerpt($excerpt_number).'</div>';
	}
	if($staff_social == 1){
		$post_output .= $social;
	}
	if($more == 1){
		$post_output .= '<div class="spacer-50"></div><a href="'.get_permalink().'" class="basic-link read-more-link">'.$more_text.'</a>';
	}
	$post_output .= '</div></div></li>';
}
endwhile; endif; wp_reset_postdata();
if($view=="carousel")
{
	$post_output .= '</ul></div></div>';
}
elseif($view=="list")
{
	$post_output .= '</div>';
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