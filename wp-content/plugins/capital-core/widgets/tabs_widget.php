<?php
/*** Widget code for Tabbed Content ***/
class capital_tabs_widget extends WP_Widget {
	// constructor
	public function __construct() {
		 $widget_ops = array('description' => esc_html__( 'Show Recent Posts, Recent Comments, Tags','capital-core') );
         parent::__construct(false, $name = esc_html__('Tabbed content widget','capital-core'), $widget_ops);
	}
	// widget form creation
	function form($instance) {
		// Check values
		if( $instance) {
			 $posts_no = esc_attr($instance['posts_no']);
			 $comments_no = esc_attr($instance['comments_no']);
			 $tags_no = esc_attr($instance['tags_no']);
		} else {
			 $posts = '';
			 $comments = '';
			 $tags = '';
			 $posts_no = '';
			 $comments_no = '';
			 $tags_no = '';
		}
	?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts_no')); ?>"><?php esc_html_e('Number of recent posts to show', 'capital-core'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('posts_no')); ?>" name="<?php echo esc_attr($this->get_field_name('posts_no')); ?>" type="text" value="<?php echo esc_attr($posts_no); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('comments_no')); ?>"><?php esc_html_e('Number of recent comments to show', 'capital-core'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('comments_no')); ?>" name="<?php echo esc_attr($this->get_field_name('comments_no')); ?>" type="text" value="<?php echo esc_attr($comments_no); ?>" />
        </p> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('tags_no')); ?>"><?php esc_html_e('Number of tags to show', 'capital-core'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('tags_no')); ?>" name="<?php echo esc_attr($this->get_field_name('tags_no')); ?>" type="text" value="<?php echo esc_attr($tags_no); ?>" />
        </p> 
	<?php
	}
	// update widget
	function update($new_instance, $old_instance) {
		  $instance = $old_instance;
		  // Fields
		  $instance['posts_no'] = strip_tags($new_instance['posts_no']);
		  $instance['comments_no'] = strip_tags($new_instance['comments_no']);
		  $instance['tags_no'] = strip_tags($new_instance['tags_no']);
		  
		 return $instance;
	}
	// display widget
	function widget($args, $instance) {
	   extract( $args );
	   // these are the widget options
	   $posts_number = apply_filters('widget_posts_number', $instance['posts_no']);
	   $comments_number = apply_filters('widget_comments_number', $instance['comments_no']);
	   $tags_number = apply_filters('widget_tags_number', $instance['tags_no']);
	   
	   $numberPosts = (!empty($posts_number))? $posts_number : 3;	
	   $numberComments = (!empty($comments_number))? $comments_number : 3;	
	   $numberTags = (!empty($tags_number))? $tags_number : 10;	
	   	   
	   echo $args['before_widget'];
		
		if( !empty($instance['title']) ){
			echo $args['before_title'];
			echo apply_filters('widget_title',$instance['title'], $instance, $this->id_base);
			echo $args['after_title'];
		}
          	echo '<div class="tabbed_widgets tabs">
                 	<ul class="nav nav-tabs">
                    	<li class="active"> <a data-toggle="tab" href="#Trecent"><i class="fa fa-file-text-o"></i></a> </li>
                    	<li> <a data-toggle="tab" href="#Tcomments"><i class="fa fa-comment"></i></a> </li>
						<li> <a data-toggle="tab" href="#Ttags"><i class="fa fa-tags"></i></a> </li>
                </ul>
             		<div class="tab-content">';
		
			$args_posts = array('post_type' => 'post', 'posts_per_page' => $numberPosts, 'post_status' => 'publish');
			$posts_listing = new WP_Query( $args_posts );
			if ( $posts_listing->have_posts() ):
				echo '<div id="Trecent" class="tab-pane active widget_capital_recent_post"><ul>';
				$counter = 1;
				 while ( $posts_listing->have_posts() ):$posts_listing->the_post();
				 echo '<li class="format-standard">';
				 if(has_post_thumbnail(get_the_ID()))
				 {
					echo '<a href="'.get_the_permalink().'" class="post-thumbnail">';
						echo get_the_post_thumbnail(get_the_ID());
						echo '</a>';
					echo '<strong><a href="'.get_the_permalink().'">'.get_the_title().'</a></strong>
					<span class="meta-data grid-item-meta">'.get_the_date(get_option('date_format')).'</span>';
				 } else {
					echo '<strong class="padding-0"><a href="'.get_the_permalink().'">'.get_the_title().'</a></strong>
					<span class="meta-data grid-item-meta padding-0">'.get_the_date(get_option('date_format')).'</span>';
				 }
			  	echo '</li>';
				 endwhile;
				echo '</ul></div>';
			else:
				echo esc_html__('No posts found','capital-core');		
			endif; wp_reset_postdata();
		
		
				$output = '';
				$comments = get_comments( apply_filters( 'widget_comments_args', array(
					'number'      => $numberComments,
					'status'      => 'approve',
					'post_status' => 'publish'
				) ) );
				$output .= '<div id="Tcomments" class="tab-pane widget_recent_comments">';
				$output .= '<ul id="recentcomments">';
				if ( is_array( $comments ) && $comments ) {
					// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
					$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
					_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );
		
					foreach ( (array) $comments as $comment ) {
						$output .= '<li class="recentcomments">';
						/* translators: comments widget: 1: comment author, 2: post link */
						$output .= sprintf( _x( '%1$s on %2$s', 'widgets', 'capital-core' ),
							'<span class="comment-author-link">' . get_comment_author_link( $comment ) . '</span>',
							'<a href="' . esc_url( get_comment_link( $comment ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a>'
						);
						$output .= '</li>';
					}
		}
		$output .= '</ul></div>';
		
		echo ''.$output;
		
			if ( function_exists( 'wp_tag_cloud' ) ) :
				echo '<div id="Ttags" class="tab-pane"><div class="tagcloud">';
				wp_tag_cloud('taxonomy=post_tag&number='.$numberTags.'');
				echo "</div></div>\n";
			endif;
		
		
			echo '</div></div>';	
	   echo $args['after_widget'];
	}
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("capital_tabs_widget");'));
?>