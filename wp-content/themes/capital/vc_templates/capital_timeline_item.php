<?php
/*Front end view of timeline item shortcode
==================================*/

$timeline_date = $timeline_title = $timeline_content = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

?>
<div class="column">
	<div class="title">
		<span class="label label-primary"><?php echo esc_attr($timeline_date); ?></span>
		<h3><?php echo esc_attr($timeline_title); ?></h3>
	</div>
	<div class="description">
		<p><?php echo esc_attr($timeline_content); ?></p>
	</div>
</div>