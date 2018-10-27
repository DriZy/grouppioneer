<?php
/*Front end view of featured block shortcode
==================================*/

$pbar_striped = $pbar_perc = $pbar_title = $pbar_style = $pbar_shape = $pbar_animation = $pbar_height = $pbar_half = $pbar_style_color_custom = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$pbar_height_new = str_replace('px','',$pbar_height);
$pbar_half = $pbar_height_new/2;
if($pbar_height_new <= '10'){
	$pposition = 'progress-bar-perc-pos';
}else{
	$pposition = '';
}
if($pbar_perc != ''){
	$pbar_perc_final = $pbar_perc;
} else {
	$pbar_perc_final = '1%';
}
if($pbar_animation != ''){
	$pbar_animation_final = $pbar_animation;
} else {
	$pbar_animation_final = '100';
}
if($pbar_rounded){
	$pbar_corners = '';
} else {
	$pbar_corners = 'pbar-no-rcorners';
}


$title_classes = array();
$title_class = '';
if( !empty( $pbar_title_color ) && $pbar_title_color != 'custom' ) {
	$title_classes[] = ' '.esc_attr($pbar_title_color);
}
if( !empty( $title_classes ) ) {
	$title_class = join(' ', $title_classes);
}

$title_style = '';
$title_styles = array();
if( $pbar_title_color == 'custom' && !empty( $pbar_title_color_custom ) ) {
	$title_styles[] = 'color:' . $pbar_title_color_custom;
}
if( !empty($title_styles) ) {
	$title_style = ' style="'. implode( ';', $title_styles ) .'"';
}


$perc_classes = array();
$perc_class = '';
if( !empty( $pbar_perc_color ) && $pbar_perc_color != 'custom' ) {
	$perc_classes[] = ' '.esc_attr($pbar_perc_color);
}
if( !empty( $perc_classes ) ) {
	$perc_class = join(' ', $perc_classes);
}

$perc_color = '';
if( $pbar_perc_color == 'custom' && !empty( $pbar_perc_color_custom ) ) {
	$perc_color = 'color:' . $pbar_perc_color_custom;
}

$pbar_istyle = '';
if( !empty($pbar_height_new) ) {
	$pbar_istyle = 'height:' . esc_attr( $pbar_height_new ).'px;';
}

$pbar_color = '';
if($pbar_style == 'custom' ) {
	$pbar_color = 'background-color:' . esc_attr( $pbar_style_color_custom ).';';
}

$pbar_bcolor = '';
if($pbar_base_color != '' ) {
	$pbar_bcolor = 'background-color:' . esc_attr( $pbar_base_color ).';';
}

$output = '<div class="progress-bar-wrap '.esc_attr( $css_class ).' '.$pbar_corners.'">';
if($pbar_title != ''){
	$output .= '<h4 class="progress-bar-title'.$title_class.'"'.$title_style.'>'.$pbar_title.'</h4>';
}
$output .= '<div class="progress '.$pbar_striped.'" style="'.$pbar_istyle.$pbar_bcolor.'">
			  <div class="progress-bar progress-bar-'.$pbar_style.'" data-appear-progress-animation="'.$pbar_perc_final.'" data-appear-animation-delay="'.$pbar_animation_final.'" style="'.$pbar_istyle . $pbar_color.'">';
			if($pbar_show_perc){
				$output .= '<div class="progress-bar-perc '.$pposition.$perc_class.'" style="font-size:'.$pbar_half.'px;'.$perc_color.'">'.$pbar_perc_final.'</div>';
			}
$output .= '</div></div></div>';
		
global $capital_allowed_tags;
echo wp_kses($output, $capital_allowed_tags);
?>