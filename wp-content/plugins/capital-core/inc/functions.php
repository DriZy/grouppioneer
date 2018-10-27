<?php
/**
 * IMITHEMES SHARE BUTTONS
 */
if(!function_exists('imithemes_share_buttons')){
function imithemes_share_buttons(){
$output = '';
$posttitle = get_the_title();
$postpermalink = get_permalink();
$postexcerpt = wp_trim_words(get_the_excerpt());
$options = get_option('capital_options');
$facebook_share_alt = (isset($options['facebook_share_alt']))?$options['facebook_share_alt']:'';
$twitter_share_alt = (isset($options['twitter_share_alt']))?$options['twitter_share_alt']:'';
$google_share_alt = (isset($options['google_share_alt']))?$options['google_share_alt']:'';
$tumblr_share_alt = (isset($options['tumblr_share_alt']))?$options['tumblr_share_alt']:'';
$pinterest_share_alt = (isset($options['pinterest_share_alt']))?$options['pinterest_share_alt']:'';
$reddit_share_alt = (isset($options['reddit_share_alt']))?$options['reddit_share_alt']:'';
$linkedin_share_alt = (isset($options['linkedin_share_alt']))?$options['linkedin_share_alt']:'';
$email_share_alt = (isset($options['email_share_alt']))?$options['email_share_alt']:'';
$vk_share_alt = (isset($options['vk_share_alt']))?$options['vk_share_alt']:'';
$whatsapp_share_alt = (isset($options['whatsapp_share_alt']))?$options['whatsapp_share_alt']:'';
$share_social_shape = (isset($options['share_social_shape']))?$options['share_social_shape']:'';
$share_social_size = (isset($options['share_social_size']))?$options['share_social_size']:'';
$share_social_style = (isset($options['share_social_style']))?$options['share_social_style']:'';
$share_social_hover_style = (isset($options['share_social_hover_style']))?$options['share_social_hover_style']:'';
$share_before_icon = (isset($options['share_before_icon']))?$options['share_before_icon']:'';
			
            $output .= '<div class="social-share-bar">';
			$output .='<ul class="imi-social-icons '.esc_attr($share_social_shape).' '. esc_attr($share_social_size).' '. esc_attr($share_social_style).' '.esc_attr($share_social_hover_style).'">';
					if($share_before_icon == 1){
						$output .= '<li class="share-title"><i class="fa fa-share-alt"></i></li>';
					}
					if(isset($options['share_before_text'])&&$options['share_before_text'] != ''){
						$output .= '<li class="share-title">'.$options['share_before_text'].'</li>';
					}
					if(isset($options['share_icon']['1'])&&$options['share_icon']['1'] == 1){
						$url = 'https://www.facebook.com/sharer/sharer.php?u=' . esc_url($postpermalink) . '&amp;t=' . esc_html($posttitle);
                   		$output .= '<li class="facebook"><a href="'.esc_url($url).'" target="_blank" title="' . esc_html($facebook_share_alt) . '"><i class="fa fa-facebook"></i></a></li>';
					}
					if(isset($options['share_icon']['2'])&&$options['share_icon']['2'] == 1){
						$url = 'https://twitter.com/intent/tweet?source=' . $postpermalink . '&amp;text=' . $posttitle . ':' . $postpermalink;
                     	$output .= '<li class="twitter"><a href="'.esc_url($url).'" target="_blank" title="' . esc_html($twitter_share_alt) . '"><i class="fa fa-twitter"></i></a></li>';
					}
					if(isset($options['share_icon']['3'])&&$options['share_icon']['3'] == 1){
						$url = 'https://plus.google.com/share?url=' . $postpermalink;
                    $output .= '<li class="google"><a href="'.esc_url($url).'" target="_blank" title="' . esc_html($google_share_alt) . '"><i class="fa fa-google-plus"></i></a></li>';
					}
					if(isset($options['share_icon']['4'])&&$options['share_icon']['4'] == 1){
						$url = 'http://www.tumblr.com/share?v=3&amp;u=' . $postpermalink . '&amp;t=' . $posttitle . '&amp;s=';
                    	$output .= '<li class="tumblr"><a href="'.esc_url($url).'" target="_blank" title="' . esc_html($tumblr_share_alt) . '"><i class="fa fa-tumblr"></i></a></li>';
					}
					if(isset($options['share_icon']['5'])&&$options['share_icon']['5'] == 1){
						$url = 'http://pinterest.com/pin/create/button/?url=' . $postpermalink . '&amp;description=' . $postexcerpt;
                    	$output .= '<li class="pinterest"><a href="'.esc_url($url).'" target="_blank" title="' . esc_html($pinterest_share_alt) . '"><i class="fa fa-pinterest"></i></a></li>';
					}
					if(isset($options['share_icon']['6'])&&$options['share_icon']['6'] == 1){
						$url = 'http://www.reddit.com/submit?url=' . $postpermalink . '&amp;title=' . $posttitle;
                    	$output .= '<li class="reddit"><a href="'.esc_url($url).'" target="_blank" title="' . esc_html($linkedin_share_alt) . '"><i class="fa fa-reddit"></i></a></li>';
					}
					if(isset($options['share_icon']['7'])&&$options['share_icon']['7'] == 1){
						$url = 'http://www.linkedin.com/shareArticle?mini=true&url=' . $postpermalink . '&amp;title=' . esc_html($posttitle) . '&amp;summary=' . esc_html($postexcerpt) . '&amp;source=' . $postpermalink;
                    	$output .= '<li class="linkedin"><a href="'.esc_url($url).'" target="_blank" title="' . esc_html($linkedin_share_alt) . '"><i class="fa fa-linkedin"></i></a></li>';
					}
					if(isset($options['share_icon']['8'])&&$options['share_icon']['8'] == 1){
                    	$url = 'mailto:?subject=' . esc_html($posttitle) . '&amp;body=' . esc_html($postexcerpt) . ':' . $postpermalink;
                        $output .= '<li class="envelope"><a href="'.esc_url($url).'" target="_blank" title="' . esc_html($email_share_alt) . '"><i class="fa fa-envelope"></i></a></li>';
					}
					if(isset($options['share_icon']['9'])&&$options['share_icon']['9'] == 1){
						$url = 'http://vk.com/share.php?url=' . $postpermalink;
                    	$output .= '<li class="vk"><a href="'.esc_url($url).'" target="_blank" title="' . esc_html($vk_share_alt) . '"><i class="fa fa-vk"></i></a></li>';
					}
					if(isset($options['share_icon']['10'])&&$options['share_icon']['10'] == 1){
                    	$output .= '<li class="whatsapp"><a href="whatsapp://send?text=' . esc_url($postpermalink) . '" target="_blank" title="' . esc_html($whatsapp_share_alt) . '" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a></li>';
					}
                $output .= '</ul></div>';
		return $output;
	}
	add_action('init', 'imithemes_share_buttons');
}