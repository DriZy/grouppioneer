<?php
$options = get_option('capital_options');
$breadcrumb_header_display = (isset($options['breadcrumb_header_display']))?$options['breadcrumb_header_display']:1;
if(is_home()) { $id = get_option('page_for_posts'); }
else { $id = get_the_ID(); }
$rev_slider = get_post_meta($id,'capital_pages_select_revolution_from_list',true);
$rev_slider = preg_replace('/\\\\/', '', $rev_slider); ?>
<div class="hero-area">
	<div class="slider-rev-cont">
     	<div class="tp-limited">
      		<?php echo do_shortcode($rev_slider); ?>
      	</div>
   	</div>
</div>
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