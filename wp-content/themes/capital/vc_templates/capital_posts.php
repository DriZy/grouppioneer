<?php
/*Front end view of posts shortcode
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
	$bgstyle_styles[] = 'background-color:' . esc_attr( $capital_style_bg_custom );
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
if ( is_rtl() )	{
	$data_rtl = 'yes';
} else {
	$data_rtl = 'no';
}
if($view=="carousel")
{
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
	$post_output .= '<div class="capital-styled-row equal-heighter '.$carousel_pagi_class.'"><ul class="owl-carousel carousel-fw posts-carousel blog-posts" data-columns="'.esc_attr($carousel_col_class).'" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-auto-height="no" data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'" data-padding="'.$carousel_padding.'">';
}
elseif($view=="full" || $view=="medium")
{
	$post_output .= '<div class="blog-posts">';
}
elseif($view=="grid")
{
	if($capital_style_spacing == 'spaced-items' && $grid_column==3){
		$grid_width = '100.3%';
	} else {
		$grid_width = '';
	}
	$post_output .= '<ul class="grid-holder equal-heighter isotope blog-posts" data-sort-id="gallery" style="width:'.$grid_width.'">';
}


$post_args = array('post_type'=>'post', 'posts_per_page'=>$number, 'paged' => get_query_var('paged'));
if($terms!='')
{
    $terms = explode(',', $terms);
    $post_args['tax_query'] = [
        [
            'taxonomy' => 'category',
            'terms' => $terms,
            'field' => 'term_id',
			'operator'=>'IN'
        ]
    ];
}


$post_list = new WP_Query($post_args);
if($post_list->have_posts()):while($post_list->have_posts()):$post_list->the_post();
$post_format = get_post_format();
$post_format = ($post_format=="")?"image":$post_format;
$post_author_id = get_post_field( 'post_author', get_the_ID() );
$meta_data_date = esc_html(get_the_date(get_option('date_format'), get_the_ID()));
$meta_data_author = '<a href="'. esc_url(get_author_posts_url($post_author_id)).'">'.esc_attr(get_the_author_meta( 'display_name', $post_author_id )).'</a> ';
$comments_count = wp_count_comments(get_the_ID());
$categories = get_the_category();
$categories_list = '';
if(!empty($categories))
{
   foreach($categories as $category)
   {
		$categories_list = '<a href="'.get_category_link($category->term_id).'">'.$category->name.'</a>';
   }
}


$post_media = '';
// If only featured image show is active
if($media_image_only == 1){
	$thumbnail = '';
	if($img_size != ''){
		$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => $img_size) );
		$thumbnail = $post_thumbnail['thumbnail'];
	} else {
		$post_thumbnail = get_the_post_thumbnail(get_the_ID(),'capital-600x400');
		$thumbnail = $post_thumbnail;
	}
	if ( has_post_thumbnail() ) {
		$post_media = '<a href="'.get_the_permalink().'" class="media-box">'.$thumbnail.'</a>';
	}
} else
{
	// Else get post media as per the post format
	if($post_format == 'image' || $post_format == 'standard'){
		$thumbnail = '';
		if($img_size != ''){
			$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => $img_size) );
			$thumbnail = $post_thumbnail['thumbnail'];
		} else {
			$post_thumbnail = get_the_post_thumbnail(get_the_ID(),'capital-600x400');
			$thumbnail = $post_thumbnail;
		}
		if ( has_post_thumbnail() ) {
			$post_media = '<a href="'.get_the_permalink().'" class="media-box">'.$thumbnail.'</a>';
		}	
	}elseif($post_format == 'gallery'){
		$gallery = '';
		$speed = (get_post_meta(get_the_ID(), 'capital_post_slider_speed', true)!='')?get_post_meta(get_the_ID(), 'capital_post_slider_speed', true):5000;
		$cpagination = get_post_meta(get_the_ID(), 'capital_post_slider_pagination', true);
		$auto_slide = get_post_meta(get_the_ID(), 'capital_post_slider_auto_slide', true);
		$direction = get_post_meta(get_the_ID(), 'capital_post_slider_direction_arrows', true);
		$image_data=  get_post_meta(get_the_ID(),'capital_post_gallery_images',false);
		$cpagination = !empty($pagination) ? $pagination : 'yes';
		$direction = !empty($direction) ? $direction : 'yes';
		$auto_slide = !empty($auto_slide) ? $auto_slide : '';
		if (count($image_data) > 0) {
			$gallery .= '<div class="carousel-wrapper"><ul class="owl-carousel single-carousel post-media-carousel" data-columns="1" data-autoplay="'.$auto_slide.'" data-pagination="'.$cpagination.'" data-margin="0" data-arrows="'.$direction.'" data-rtl="'.$data_rtl.'" data-loop="no">';
			foreach ($image_data as $custom_gallery_images) {
				$large_src = wp_get_attachment_image_src($custom_gallery_images, 'full');
				$gallery .= '<li class="item"><a href="' . esc_url($large_src[0]) . '" class="popup-image">';
				if($view=="full"){
					$gallery .= wp_get_attachment_image($custom_gallery_images, 'full');
				} else {
					$gallery .= wp_get_attachment_image($custom_gallery_images, 'capital-600x400');
				}
				$gallery .= '</a></li>';
			}
			$gallery .= '</ul></div>';
		}
		$post_media = wp_kses($gallery, $capital_allowed_tags);

	}elseif($post_format == 'audio'){
		$audio_code = get_post_meta(get_the_ID(),'capital_post_uploaded_audio',true);
		if($audio_code != ''){
			$post_media = $audio_code;
		}

	}elseif($post_format == 'video'){
		$video_url = get_post_meta(get_the_ID(),'capital_post_video_url',true);
		if($video_url != ''){
			$post_media = capital_video_embed($video_url,"500","338");
		}
	}
}
if($show_date == 1 || $show_author == 1 || $show_categories == 1 || $show_comments == 1){
	$post_meta = '<div class="blog-post-details style-title">';
	if($show_date == 1){
		$post_meta .= '<div class="post-date"><span><i class="mi mi-date-range"></i> '.$meta_data_date.' </span></div>';
	}
	if($show_author == 1){
		$post_meta .= '<div class="post-author"><i class="icon-pencil"></i> '.$meta_data_author.' '.'</div>';
	}
	if($show_categories == 1){
		$post_meta .= '<div class="post-categories"><i class="fa fa-folder-o"></i> '; 
		$categories = get_the_category();
		$separator = ', ';
		$output = '';
		if ( ! empty( $categories ) ) {
			foreach( $categories as $category ) {
				$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
			}
			$post_meta .=  trim( $output, $separator );
		}
		$post_meta .= '</div>';
	}
	if($show_comments == 1){
		$post_meta .= '<div class="comments-likes"><a href="'.get_the_permalink().'"><i class="fa fa-comment-o"></i>  '.$comments_count->approved.'</a></div>';
	}
	$post_meta .= '</div>';
} else {
	$post_meta = '';
}

// Carousel View
if($view=="carousel")
{
	$post_output .= '<li class="item">
				 <div class="grid-item post blog-masonry-item post-carousel-item post-grid-item format-'.$post_format.'">';
	if($media_show == 1 && $post_media != ''){
		$post_output .= '<div class="post-media">'.$post_media.'</div>';
	}

	$post_output .= '<div class="grid-item-content equal-height-column post-item-content"'.$bgstyle_style.'>';

	$post_output .= '<h4 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
	$post_output .= $post_meta;
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="post-item-excerpt">'.capital_excerpt($excerpt_number).'</div>';
	}
	if($more == 1){
		$post_output .= '<div class="spacer-50"></div><a href="'.get_permalink().'" class="basic-link read-more-link">'.$more_text.'</a>';
	}
	$post_output .= '</div>
	</div></li>';
}
elseif($view=="medium")
{
	$post_output .= '<div class="post-list-item post post-item-content format-'.$post_format.'"'.$bgstyle_style.'>
						<div class="row">';
	if($media_show == 1 && $post_media != ''){
		$post_output .= '<div class="col-md-4"><div class="post-media">'.$post_media.'</div></div>';
	}
	if($media_show == 1 && $post_media != ''){
		$post_output .= '<div class="col-md-8">';
	} else {
		$post_output .= '<div class="col-md-12">';	
	}

	$post_output .= '<h4 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
	$post_output .= $post_meta;
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="post-item-excerpt">'.capital_excerpt($excerpt_number).'</div>';
	}
	if($more == 1){
		$post_output .= '<a href="'.get_permalink().'" class="btn btn-primary btn-secondary">'.$more_text.'</a>';
	}
	$post_output .= '</div>
			</div>
		</div>';
}
elseif($view=="full")
{
	$post_output .= '<div class="post post-list-item blog-full-item post-item-content format-'.$post_format.'"'.$bgstyle_style.'>';
	if($media_show == 1 && $post_media != ''){
		$post_output .= '<div class="post-media">'.$post_media.'</div>';
	}

	$post_output .= '<div class="full-item-content">';

	$post_output .= '<h4 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
	$post_output .= $post_meta;
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="post-item-excerpt">'.capital_excerpt($excerpt_number).'</div>';
	}
	if($more == 1){
		$post_output .= '<a href="'.get_permalink().'" class="btn btn-primary btn-secondary">'.$more_text.'</a>';
	}
	$post_output .= '</div></div>';
}
else
{
	$post_output .= '<li class="col-md-'.$grid_column.' col-sm-6 grid-item post post-grid-item blog-masonry-item format-'.$post_format.'">
					<div class="grid-item-inner">';

	if($media_show == 1 && $post_media != ''){
		$post_output .= '<div class="post-media">'.$post_media.'</div>';
	}

	$post_output .= '<div class="grid-item-content equal-height-column post-item-content"'.$bgstyle_style.'>';

	$post_output .= '<h4 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
	$post_output .= $post_meta;
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="post-item-excerpt">'.capital_excerpt($excerpt_number).'</div>';
	}
	if($more == 1){
		$post_output .= '<div class="spacer-50"></div><a href="'.get_permalink().'" class="basic-link read-more-link">'.$more_text.'</a>';
	}
	$post_output .= '</div>
					</div>
				</li>';
}
endwhile; endif; wp_reset_postdata();
if($view=="carousel")
{
	$post_output .= '</ul></div></div>';
}
elseif($view=="grid")
{
	$post_output .= '</ul></div>';
}
else
{
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