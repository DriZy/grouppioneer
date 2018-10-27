<?php 
$options = get_option('capital_options');
global $capital_allowed_tags;
$feat_button_title2 = (isset($options['feat_button_title2']))?$options['feat_button_title2']:esc_html__('Button','capital');
$feat_button_url2 = (isset($options['feat_button_url2']))?$options['feat_button_url2']:'';
$feat_button_shape2 = (isset($options['feat_button_shape2']))?$options['feat_button_shape2']:'';
$feat_button_size2 = (isset($options['feat_button_size2']))?$options['feat_button_size2']:'';
?>
<?php if($feat_button_url2 != ''){ ?>
	<div class="featured-buttons header-equaler"><div><div>
		<a href="<?php echo esc_url($feat_button_url2); ?>" class="fbtn fbtn2 <?php echo esc_attr($feat_button_shape2); ?> <?php echo esc_attr($feat_button_size2); ?>"><?php echo wp_kses($feat_button_title2, $capital_allowed_tags); ?></a>
	</div></div></div>
<?php } ?>