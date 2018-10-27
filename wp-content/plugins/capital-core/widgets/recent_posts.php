<?php
/*** Widget code for Popular Post ***/
class capital_recent_post extends WP_Widget {
	// constructor
	public function __construct() {
		 $widget_ops = array('description' => esc_html__( 'Show recent posts with thumbnail','capital-core') );
         parent::__construct(false, $name = esc_html__('Recent Posts with Thumbs','capital-core'), $widget_ops);
	}
	// widget form creation
	function form($instance) {
		// Check values
		if( $instance) {
			 $title = esc_attr($instance['title']);
			 $type = esc_attr($instance['type']);
			 $number = esc_attr($instance['number']);
		} else {
			 $title = '';
			 $type = '';
			 $number = '';
		}
	?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'capital-core'); ?></label>
            <input class="spTitle" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts to show', 'capital-core'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
        </p> 
	<?php
	}
	// update widget
	function update($new_instance, $old_instance) {
		  $instance = $old_instance;
		  // Fields
		  $instance['title'] = strip_tags($new_instance['title']);
		  $instance['type'] = strip_tags($new_instance['type']);
		  $instance['number'] = strip_tags($new_instance['number']);
		  
		 return $instance;
	}
	// display widget
	function widget($args, $instance) {
	   extract( $args );
	   // these are the widget options
	   $post_title = apply_filters('widget_title', $instance['title']);
	   $type = apply_filters('widget_type', $instance['type']);
	   $number = apply_filters('widget_number', $instance['number']);
		 $hightlight = 2;
	   
	   $numberPost = (!empty($number))? $number : 4 ;	
	   	   
	   echo $args['before_widget'];
		
		if( !empty($instance['title']) ){
			echo $args['before_title'];
			echo apply_filters('widget_title',$instance['title'], $instance, $this->id_base);
			echo $args['after_title'];
		}
			$args_posts = array('post_type' => 'post', 'posts_per_page' => $numberPost, 'post_status' => 'publish');
		$posts_listing = new WP_Query( $args_posts );
		if ( $posts_listing->have_posts() ):
			echo '<ul>';
			$counter = 1;
			 while ( $posts_listing->have_posts() ):$posts_listing->the_post();
			 echo '<li class="format-standard">';
			 if(has_post_thumbnail(get_the_ID()))
			 {
    			echo '<a href="'.get_the_permalink().'" class="post-thumbnail">';
					echo get_the_post_thumbnail(get_the_ID(),'thumbnail');
					echo '</a>';
				echo '<strong><a href="'.get_the_permalink().'">'.get_the_title().'</a></strong>
				<span class="meta-data grid-item-meta">'.get_the_date(get_option('date_format')).'</span>';
			 } else {
      			echo '<strong class="padding-0"><a href="'.get_the_permalink().'">'.get_the_title().'</a></strong>
				<span class="meta-data grid-item-meta padding-0">'.get_the_date(get_option('date_format')).'</span>';
			 }
          echo '</li>';
			 endwhile;
			echo '</ul>';
		else:
			echo esc_html__('No posts found','capital-core');		
		endif; wp_reset_postdata();
	   echo $args['after_widget'];
	}
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("capital_recent_post");'));
?>