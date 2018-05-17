<?php

/***** MH Custom Posts [lite] *****/
// add admin scripts
add_action('admin_enqueue_scripts', 'ctup_wdscript');
function ctup_wdscript() {
    wp_enqueue_media();
    wp_enqueue_script('ads_script', get_template_directory_uri() . '/js/widget.js', false, '1.0', true);
}

class mh_footer_about extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_footer_about', esc_html_x('MH About Us [lite]', 'widget name', 'mh-magazine-lite'),
			array(
				'classname' => 'mh_footer_about',
				'description' => esc_html__('Custom Posts Widget to display posts based on categories or tags.', 'mh-magazine-lite'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
	    $defaults = array('title' => '','description' => '', 'category' => 0, 'tags' => '', 'postcount' => 5, 'offset' => 0, 'sticky' => 1);
		$instance = wp_parse_args($instance, $defaults);
	   	$query_args = array();
	   	if (0 !== $instance['category']) {
			$query_args['cat'] = $instance['category'];
		}
		if (!empty($instance['tags'])) {
			$tag_slugs = explode(',', $instance['tags']);
			$tag_slugs = array_map('trim', $tag_slugs);
			$query_args['tag_slug__in'] = $tag_slugs;
		}
		if (!empty($instance['postcount'])) {
			$query_args['posts_per_page'] = $instance['postcount'];
		}
		if (0 !== $instance['offset']) {
			$query_args['offset'] = $instance['offset'];
		}
		if (1 === $instance['sticky']) {
			$query_args['ignore_sticky_posts'] = true;
		}
		$widget_loop = new WP_Query($query_args);
        echo $args['before_widget'];
			?>

			<div class="mh-author-bio-widget">
			    <h4 class="mh-author-bio-title"><?php echo esc_html(apply_filters('widget_title', $instance['title'])); ?></h4>
			    <figure class="mh-author-bio-avatar mh-author-bio-image-frame">
			        <a href="https://demo.mhthemes.com/magazine4/author/mh-themes/"> 
			        	<!-- <img src="<?php echo esc_html(apply_filters('widget_title', $instance['image_uri'])); ?>" width="120" height="120" alt="MH Themes" class="avatar avatar-120 wp-user-avatar wp-user-avatar-120 alignnone photo"> -->
			        	<img src="<?php echo get_template_directory_uri() . '/images/cryptoville-footer.jfif';?>" width="120" height="120" alt="MH Themes" class="avatar avatar-120 wp-user-avatar wp-user-avatar-120 alignnone photo">
			        </a>
			    </figure>
			    <div class="mh-author-bio-text"><?php echo esc_html(apply_filters('widget_title', $instance['description'])); ?></div>
			</div>

			<?php
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
        $instance = array();
        if (!empty($new_instance['title'])) {
			$instance['title'] = sanitize_text_field($new_instance['title']);
		}
		if(!empty($new_instance['image_uri'])){
			$instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
		}
        if (!empty($new_instance['description'])) {
			$instance['description'] = sanitize_text_field($new_instance['description']);
		}
        if (0 !== absint($new_instance['category'])) {
			$instance['category'] = absint($new_instance['category']);
		}
		if (!empty($new_instance['tags'])) {
			$tag_slugs = explode(',', $new_instance['tags']);
			$tag_slugs = array_map('sanitize_title', $tag_slugs);
			$instance['tags'] = implode(', ', $tag_slugs);
		}
		if (0 !== absint($new_instance['postcount'])) {
			if (absint($new_instance['postcount']) > 50) {
				$instance['postcount'] = 50;
			} else {
				$instance['postcount'] = absint($new_instance['postcount']);
			}
		}
		if (0 !== absint($new_instance['offset'])) {
			if (absint($new_instance['offset']) > 50) {
				$instance['offset'] = 50;
			} else {
				$instance['offset'] = absint($new_instance['offset']);
			}
		}
		$instance['sticky'] = (!empty($new_instance['sticky'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
	    $defaults = array('title' => '','description' => '', 'category' => 0, 'tags' => '', 'postcount' => 5, 'offset' => 0, 'sticky' => 1);
        $instance = wp_parse_args($instance, $defaults); ?>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-magazine-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>

	    <p>
	        <label for="<?php echo $this->get_field_id('image_uri'); ?>">Image</label><br />

	        <?php
	            if ( $instance['image_uri'] != '' ) :
	                echo '<img class="custom_media_image" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
	            endif;
	        ?>

	        <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>" style="margin-top:5px;">

	        <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name('image_uri'); ?>" value="Upload Image" style="margin-top:5px;" />
	    </p>

		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php esc_html_e('Description:', 'mh-magazine-lite'); ?></label>
			<textarea class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('description')); ?>" id="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php echo esc_attr($instance['description']); ?></textarea>
        </p>

    	<p>
    		<strong><?php esc_html_e('Info:', 'mh-magazine-lite'); ?></strong> <?php esc_html_e('This is the lite version of this widget with basic features. More features and options are available in the premium version of MH Magazine.', 'mh-magazine-lite'); ?>
    	</p><?php
    }
}

?>