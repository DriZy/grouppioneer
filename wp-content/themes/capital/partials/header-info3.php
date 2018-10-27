<?php 
$options = get_option('capital_options');
global $capital_allowed_tags;
$header_info = (isset($options['header_info_text3']))?$options['header_info_text3']:'';
?>
<?php if($header_info != ''){ ?>
	<!-- Header Info -->
	<div class="header_info_text header_info_text3 header-equaler"><div><div><?php echo wp_kses($header_info, $capital_allowed_tags); ?></div></div></div>
<?php } ?>