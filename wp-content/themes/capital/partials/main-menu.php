<?php
$options = get_option('capital_options');
$menu_locations = get_nav_menu_locations();
$onepage_menu = get_post_meta($id,'capital_select_menu_from_list',true);
$dd_menu_style = (isset($options['dd_menu_style']) && $options['dd_menu_style'] != '')?$options['dd_menu_style']:'dd-style1';
if($onepage_menu != '' && is_page_template('template-onepage.php')){
	wp_nav_menu(array('menu' => $onepage_menu, 'container' => '','items_wrap' => '<ul id="%1$s" class="sf-menu dd-menu '.$dd_menu_style.'">%3$s</ul>', 'link_before' => '', 'link_after' => '', 'walker' => new Capital_Walker));
} else {
if (!empty($menu_locations['primary-menu'])) { 
	wp_nav_menu(array('theme_location' => 'primary-menu', 'container' => '','items_wrap' => '<ul id="%1$s" class="sf-menu dd-menu '.$dd_menu_style.'">%3$s</ul>', 'link_before' => '', 'link_after' => '', 'walker' => new Capital_Walker));
}
} ?>