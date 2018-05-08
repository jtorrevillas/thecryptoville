<?php
/**
*Plugin Name: Cryptoville Events
*Description: A plugin that will load the events on the EVENTS Page
**/

add_action( 'init', 'custom_post_types_events');
add_action( 'add_meta_boxes', 'add_events_meta_box' ); //ADD CUSTOM META BOX --EVENTS DETAILS
add_action( 'save_post', 'events_meta_box_save' );	// SAVE CUSTOM META BOX DATA --EVENTS DETAILS
add_action( 'wp_enqueue_scripts', 'wpse_load_plugin' );
add_shortcode( 'cv_events_nav', 'create_events_filter_nav');


function wpse_load_plugin() {
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_script('script', $plugin_url.'js/cryptoville_events_script.js', array('jquery'), 1, true);
    wp_enqueue_style( 'style', $plugin_url . 'css/cryptoville_events_style.css' );
    
}

function cryptoville_events_load_contents(){
	global $post;

	if(is_page('events')) :
		print_r($post);
	endif;
}

function create_events_filter_nav(){
	$content = '';
	$content .='<div class="cv-container" id="cv-nav">';
	$content .='	<div class="cv-item-filter"> <a href="#" > <i class="fa fa-flag-o" aria-hidden="true"></i> All Countries</a><div id="cv-dropdown-countries"></div></div>';
	$content .='	<div class="cv-item-filter"> <a href="#" ><i class="fa fa-flag-o" aria-hidden="true"></i> All Cities</a><div id="cv-dropdown-cities"></div></div>';
	$content .='	<div class="cv-item-filter"> <a href="#" ><i class="fa fa-flag-o" aria-hidden="true"></i> Any Month</a><div id="cv-dropdown-month"></div></div>';
	$content .='	<div class="cv-item-filter">Holding an event?<a href="#">   Let us know</a></div>';
	$content .='</div>';

	return $content;
}

function custom_post_types_events(){
	// POST TYPES
	/**
	 * Post Type: peoples.
	 */

	$labels0 = array(
		"name" => __( "Cryptoville Events"),
		"singular_name" => __( "event"),
	);

	$args0 = array(
		"label" => __( "events" ),
		"labels" => $labels0,
		"description" => "",
		"public" => true,
		"menu_icon" => "dashicons-calendar",
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "events", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail"),
		"taxonomies" => array("etype_tax"),
	);
	
	// TAXONOMIES
	/**
	 * Taxonomy: team.
	 */

	$labels1 = array(
		"name" => __( "Event Types"),
		"singular_name" => __( "etype" ),
	);

	$args1 = array(
		"label" => __( "etype" ),
		"labels" => $labels1,
		"public" => true,
		"hierarchical" => false,
		"label" => "etype",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'etype_tax', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	
	register_post_type( "events", $args0 );
	register_taxonomy( "etype_tax", array( "events" ), $args1 );
}

//CREATE CUSTOM METABOXES --EVENTS

function add_events_meta_box(){
	add_meta_box( 'events_id', 'Event Details', 'html_events_metabox', 'events', 'normal', 'default' );
}

function html_events_metabox(){
	global $post;
	$values = get_post_custom( $post->ID );
    $eurl_text = isset( $values['event_url_mb'] ) ? esc_attr($values['event_url_mb'][0]) : '';
	$from_text = isset( $values['from_date_mb'] ) ?  esc_attr($values['from_date_mb'][0]) : '';
	$to_text = isset( $values['to_date_mb'] ) ?  esc_attr($values['to_date_mb'][0]) : '';
    $eadd_text = isset( $values['event_address_mb'] ) ?  esc_attr($values['event_address_mb'][0]) : '';
	
	wp_nonce_field( 'events_nonce', 'meta_box_nonce' );
	?>


<label for="event_url_mb"><strong>Event URL</strong></label><br>
    <input type="text" name="event_url_mb" id="event_url_mb" value="<?=$eurl_text?>" />
<br><br>

	<label for="event_dates"><strong>Event Date</strong></label><br>
    &nbsp;&nbsp;<label for="from_date_mb"><i>From</i></label><input type="text" class="from-date" name="from_date_mb" id="from_date_mb" value="<?=$from_text?>" /><br>
	&nbsp;&nbsp;<label for="to_date_mb"><i>To</i></label><input type="text" class="to-date" name="to_date_mb" id="to_date_mb" value="<?=$to_text?>" /><br>

<br>
	<label for="event_dates"><strong>Event Location</strong></label><br>
	<input type="text" name="event_address_mb" id="event_address_mb" value="<?=$eadd_text?>"/>
    <?php
}

function events_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'events_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
	
	$allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
	
	// Make sure your data is set before trying to save it
    if( array_key_exists('event_url_mb', $_POST) )
        update_post_meta( $post_id, 'event_url_mb', wp_kses( $_POST['event_url_mb'], $allowed ) );

	
	if( array_key_exists('from_date_mb', $_POST) )
        update_post_meta( $post_id, 'from_date_mb', wp_kses( $_POST['from_date_mb'], $allowed ) );
	
	if( array_key_exists('to_date_mb', $_POST) )
        update_post_meta( $post_id, 'to_date_mb', wp_kses( $_POST['to_date_mb'], $allowed ) );
	
	if( array_key_exists('event_address_mb', $_POST) )
        update_post_meta( $post_id, 'event_address_mb', wp_kses( $_POST['event_address_mb'], $allowed ) );
	
      
}


?>