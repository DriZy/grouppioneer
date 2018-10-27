<?php
/*Front end view of project shortcode
==================================*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
global $capital_allowed_tags;


$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if($grid_column==2)
{
	$carousel_col_class = 6;
}
elseif($grid_column==4)
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
	$bgstyle_styles[] = 'background-color:' . esc_attr( $capital_style_bg_custom );
}
if( !empty( $bgstyle_styles ) ) {
	$bgstyle_style = ' style="'. implode( ';', $bgstyle_styles ) .'"';
}

$post_output = '<div class="sort-destination-parent '.esc_attr( $css_class ).' '.esc_html($capital_style_border).' '.esc_html($carousel_arrows_position).' '.esc_html($capital_style_spacing).' '.esc_html($capital_style_skin).'  '.esc_html($bgstyle_class).'">';
// Project Filters
if($filters_style == 'pills'){
	$filter_style = 'nav-pills nav';
} elseif($filters_style == 'plain') {
	$filter_style = 'plain-filters ';
} else {
	$filter_style = 'nav-tabs nav nav-justified ';
}
if($filters == 1 && $view != "carousel"){
	$post_output .= '<ul class="project-filter-nav '.$filter_style.' sort-source" data-sort-id="portfolio" data-option-key="filter">';
	$project_cats = get_terms("imi_projects_category");
	$post_output .= '<li data-option-value="*" class="active"><a href="#"><span>' .esc_html__('Show All', 'capital').'</span></a></li>';
	foreach($project_cats as $project_cat) {
		$post_output .= '<li data-option-value=".cat-'.$project_cat->slug.'"><a href="#"><span>'. $project_cat->name.'</span></a></li>';
	}
	$post_output .= '</ul>';
} else {
	$post_output .= '';
}
if($view=="carousel"){
	$post_output .= '<div class="carousel-wrapper">';
} else {
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
	$post_output .= '<div class="capital-styled-row '.$carousel_pagi_class.'"><ul class="owl-carousel equal-heighter carousel-fw project-carousel" data-columns="'.esc_attr($carousel_col_class).'" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-auto-height="no" data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-padding="'.$carousel_padding.'" data-margin="'.$owl_margin.'">';
}
elseif($view=="grid")
{
	if($capital_style_spacing == 'spaced-items' && $grid_column==3){
		$grid_width = '100.3%';
	} else {
		$grid_width = '';
	}
	if($filters == 1){
		$post_output .= '<ul class="portfolio-list equal-heighter isotope sort-destination" data-sort-id="portfolio" style="width:'.$grid_width.'">';
	} else {
		$post_output .= '<ul class="portfolio-list equal-heighter isotope isotope-grid" style="width:'.$grid_width.'">';
	}
}


$post_args = array('post_type'=>'imi_projects', 'posts_per_page'=>$number, 'paged' => get_query_var('paged'));
if($terms!='')
{
    $terms = explode(',', $terms);
    $post_args['tax_query'] = [
        [
            'taxonomy' => 'imi_projects_category',
            'terms' => $terms,
            'field' => 'term_id',
			'operator'=>'IN'
        ]
    ];
}

$post_list = new WP_Query($post_args);
if($post_list->have_posts()):while($post_list->have_posts()):$post_list->the_post();
$thumbnail = '';
if($img_size != ''){
	$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => $img_size) );
	$post_full_thumbnail = get_the_post_thumbnail_url(get_the_ID(),'full');
	$thumbnail = $post_thumbnail['thumbnail'];
} else {
	$post_thumbnail = get_the_post_thumbnail(get_the_ID(),'capital-600x400');
	$post_full_thumbnail = get_the_post_thumbnail_url(get_the_ID(),'full');
	$thumbnail = $post_thumbnail;
}
// Carousel View
if($view=="carousel")
{
	$post_output .= '<li class="item">
					 <div class="grid-item project-grid-item portfolio-item portfolio-carousel-item '.$style;
	if($zoom == 1){
		$post_output .= ' format-zoom">';
	} else {
		$post_output .= ' format-link">';	
	}
	if($zoom == 1){
		$post_output .= '<a href="'.$post_full_thumbnail.'" class="magnific-image">';
	} else {
		$post_output .= '<a href="'.get_the_permalink().'">';
	}
	if(has_post_thumbnail())
	{
		if($style == 'projects-grid-style2'){
			$post_output .= '<div class="project-media media-box">';
		} else {
			$post_output .= '<div class="project-media">';
		}
		$post_output .= $thumbnail;
	} else {
		$post_output .= '<div class="portfolio-image">';
		$post_output .= '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" alt="" height="100%">';

	}
	$post_output .= '<div class="project-overlay">';
	if($style == 'projects-grid-style1'){
		$post_output .= '<div class="project-info"><div>';
		if($show_title == 1){
			$post_output .= '<h4><span class="project-name">'.get_the_title().'</span></h4>';
		}
		if($show_category == 1){
			$post_output .= '<div class="project-categories">';
			$post = get_post();
			$categories = get_the_terms( $post->ID, 'imi_projects_category' );
			foreach( $categories as $category ) {
				$post_output .= '<span>'.esc_html( $category->name ).'</span>';
			}
			$post_output .= '</div>';
		}
		$post_output .= '</div></div>';
	}
	$post_output .= '</div></div></a>';
	if($style == 'projects-grid-style2'){
		if($show_title == 1 || $show_category == 1){
			$post_output .= '<div class="project-info-static equal-height-column post-item-content"'.$bgstyle_style.'>';
			if($show_title == 1){
				$post_output .= '<h4><a href="'.get_the_permalink().'"><span class="project-name">'.get_the_title().'</span></a></h4>';
			}
			if($show_category == 1){
				$post_output .= '<div class="project-categories">';
				$post = get_post();
				$categories = get_the_terms( $post->ID, 'imi_projects_category' );
				foreach( $categories as $category ) {
					$post_output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
				}
				$post_output .= '</div>';
			}
			$post_output .= '</div>';
		}
	}
	$post_output .= '</div></li>';
}

// Grid View
else

{
	$post_output .= '<li class="col-md-'.$grid_column.' col-sm-6 grid-item portfolio-item project-grid-item format-standard ';
	$term_slug = get_the_terms(get_the_ID(), 'imi_projects_category');
	if (!empty($term_slug)) {
		foreach ($term_slug as $term) {
		  $post_output .= ' cat-'.$term->slug.' ';
		}
	}
	if($zoom == 1){
		$post_output .= ' format-image">';
	} else {
		$post_output .= ' format-link">';	
	}
	$post_output .= '<div class="grid-item-inner">';
	if($zoom == 1){
		$post_output .= '<a href="'.$post_full_thumbnail.'" class="magnific-image">';
	} else {
		$post_output .= '<a href="'.get_the_permalink().'">';
	}
	if(has_post_thumbnail())
	{
		if($style == 'projects-grid-style2'){
			$post_output .= '<div class="project-media media-box">';
		} else {
			$post_output .= '<div class="project-media">';
		}
		$post_output .= $thumbnail;
	} else {
		if($style == 'projects-grid-style2'){
			$post_output .= '<div class="project-media media-box">';
		} else {
			$post_output .= '<div class="project-media">';
		}
		$post_output .= '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" alt="" height="100%">';
	}
	$post_output .= '<div class="project-overlay">';
	if($style == 'projects-grid-style1'){
		$post_output .= '<div class="project-info"><div>';
		if($show_title == 1){
			$post_output .= '<h4><span class="project-name">'.get_the_title().'</span></h4>';
		}
		if($show_category == 1){
			$post_output .= '<div class="project-categories">';
			$post = get_post();
			$categories = get_the_terms( $post->ID, 'imi_projects_category' );
			foreach( $categories as $category ) {
				$post_output .= '<span>'.esc_html( $category->name ).'</span>';
			}
			$post_output .= '</div>';
		}
		$post_output .= '</div></div>';
	}
	$post_output .= '</div></div></a>';
	if($style == 'projects-grid-style2'){
		if($show_title == 1 || $show_category == 1){
			$post_output .= '<div class="project-info-static equal-height-column post-item-content"'.$bgstyle_style.'>';
			if($show_title == 1){
				$post_output .= '<h4><a href="'.get_the_permalink().'"><span class="project-name">'.get_the_title().'</span></a></h4>';
			}
			if($show_category == 1){
				$post_output .= '<div class="project-categories">';
				$post = get_post();
				$categories = get_the_terms( $post->ID, 'imi_projects_category' );
				foreach( $categories as $category ) {
					$post_output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
				}
				$post_output .= '</div>';
			}
			$post_output .= '</div>';
		}
	}
	$post_output .= '</div></li>';
}
endwhile; endif; wp_reset_postdata();
$post_output .= '</ul>';
if($view=="carousel"){
	$post_output .= '</div></div>';
} else {
	$post_output .= '</div>';
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