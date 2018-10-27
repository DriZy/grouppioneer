<?php 
$options = get_option('capital_options');
global $capital_allowed_tags;
$feat_button_title3 = (isset($options['feat_button_title3']))?$options['feat_button_title3']:esc_html__('button','capital');
$feat_button_url3 = (isset($options['feat_button_url3']))?$options['feat_button_url3']:'';
$feat_button_shape3 = (isset($options['feat_button_shape3']))?$options['feat_button_shape3']:'';
$feat_button_size3 = (isset($options['feat_button_size3']))?$options['feat_button_size3']:'';
?>
<?php if($feat_button_url3 != ''){ ?>
	<div class="featured-buttons header-equaler"><div><div>
		<a href="<?php echo esc_url($feat_button_url3); ?>" class="fbtn fbtn3 <?php echo esc_attr($feat_button_shape3); ?> <?php echo esc_attr($feat_button_size3); ?>"><?php echo wp_kses($feat_button_title3, $capital_allowed_tags); ?></a>
	</div></div></div>
<?php } ?>