<?php
$options = get_option('capital_options');
global $capital_btn_allowed_tags;
$show_topbar_widgets = (isset($options['enable_topbar_opener']))?$options['enable_topbar_opener']:1;
$topbar_opener_text = (isset($options['topbar_opener_link_text']))?$options['topbar_opener_link_text']:__('Our Locations','capital');
$topbar_opener_position = (isset($options['topbar_opener_position']))?$options['topbar_opener_position']:'widgets-at-top';
if($show_topbar_widgets == 1 ) { ?>
	<div class="topbar-blocks topbar-topper-opener"><div><div>
		<a href="#" class="topper-opener <?php echo esc_attr($topbar_opener_position); ?>-opener"><?php echo wp_kses($topbar_opener_text, $capital_btn_allowed_tags); ?></a>
	</div></div></div>
<?php } ?>