<?php 
if(is_home()) { $id = get_option('page_for_posts'); }
else { $id = get_the_ID(); }
wp_enqueue_script('capital_jquery_flexslider');
$options = get_option('capital_options');
$breadcrumb_header_display = (isset($options['breadcrumb_header_display']))?$options['breadcrumb_header_display']:1;
$type = get_post_meta($id,'capital_pages_Choose_slider_display',true);
$pagination = get_post_meta($id,'capital_pages_slider_pagination',true);
$autoplay = get_post_meta($id,'capital_pages_slider_auto_slide',true);
$arrows = get_post_meta($id,'capital_pages_slider_direction_arrows',true);
$effects = get_post_meta($id,'capital_pages_slider_effects',true);
if($type==1 || $type==2 || $type==4) {
	$height = get_post_meta($id,'capital_pages_slider_height',true);
} else {
	$height = '';
}
$images = get_post_meta($id,'capital_pages_slider_image',false);
$PageBannerMinHeight = (isset($options['inner_page_header_min_height']))?$options['inner_page_header_min_height']:'';
if(!empty($images)) {
	 if($height != ''){$rheight = $height;} elseif($PageBannerMinHeight != ''){$rheight = $PageBannerMinHeight;} else {$rheight = 250;} ?>
<!-- Hero Area -->
    <div class="hero-area">
    	<!-- Start Hero Slider -->
      	<div class="flexslider heroflex hero-slider" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-pagination="<?php echo esc_attr($pagination); ?>" data-arrows="<?php echo esc_attr($arrows); ?>" data-style="<?php echo esc_attr($effects); ?>" data-pause="yes" style="height:<?php echo esc_attr($rheight); ?>px;">
            <ul class="slides">
            <?php foreach($images as $image) {
									$image_data = capital_wp_get_attachment($image);
									$image_src = wp_get_attachment_image_src( $image, 'full', '', array() ); ?>
                <li class="parallax" style="height:<?php echo esc_attr($rheight); ?>px; background-image:url(<?php echo esc_url($image_src[0]); ?>);">
                	<div class="flex-caption">
                    	<div class="container">
                        	<div class="flex-caption-table">
                            	<div class="flex-caption-cell">
                                	<div class="flex-caption-text">
                                  <?php if($image_data['postid']) { ?>
                            			<h3><a href="<?php echo get_the_permalink($image_data['postid']); ?>"><?php echo get_the_title($image_data['postid']); ?></a></h3>
                    					<p><?php wp_trim_words(capital_post_excerpt_by_id($image_data['postid']), 20); ?></p>
                                  <?php } else { ?>
                                       <?php echo ''.$image_data['description']; ?>
                                        <?php } ?>
                                    </div>
                               	</div>
                          	</div>
                        </div>
                    </div>
                </li>
                <?php } ?>
          	</ul>
       	</div>
        <!-- End Hero Slider -->
    </div>
    <?php } ?>
    <?php if($breadcrumb_header_display != '' || $breadcrumb_header_display == 1){ ?>
    <div class="breadcrumb-wrapper">
    	<div class="container">
			<?php if(function_exists('bcn_display')){ ?>
				<ol class="breadcrumb">
					<?php bcn_display(); ?>
				</ol>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
    <!-- End Page Header -->