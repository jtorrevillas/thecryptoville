<?php
/**
*Plugin Name: Cryptoville Events
*Description: A plugin that will load the events on the EVENTS Page
**/

add_action( 'init', 'custom_post_types_events');
add_action( 'add_meta_boxes', 'add_events_meta_box' ); //ADD CUSTOM META BOX --EVENTS DETAILS
add_action( 'save_post', 'events_meta_box_save' );	// SAVE CUSTOM META BOX DATA --EVENTS DETAILS
add_action( 'wp_enqueue_scripts', 'wpse_load_plugin' );
add_shortcode( 'cv_events_content', 'cryptoville_events_load_contents');
//add_shortcode( 'cv_events_nav', 'create_events_filter_nav');

function wpse_load_plugin() {
    $plugin_url = plugin_dir_url( __FILE__ );

    if(is_page('events')) :
	    wp_register_script( 'jQueryUI', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', null, null, true );
		wp_enqueue_script('jQueryUI');
	    wp_enqueue_script('script', $plugin_url.'js/cryptoville_events_script.js', array('jquery'), 1, true);
	    wp_enqueue_style( 'style', $plugin_url . 'css/cryptoville_events_style.css' );
	endif;
    
}


function cryptoville_events_load_contents(){
	
	if(is_page('events')) :
		$params = array(
	        'post_type'   => 'events',
	        'tax_query' => array(
				        array(
				            'taxonomy' => 'etype_tax',
				            'field' => 'slug',
				            'terms' => array('featured_events','bitcoin_events','financial_events','technology_events')
				        )
				    )
	    );
		
	    $events = new WP_Query($params);

	    if( $events->have_posts() ) :
	$all = '';
	$btc = '';
	$fin = '';
	$tech = '';
	$tempo = '';
	            while( $events->have_posts()) :
	                $events->the_post();
	                
	          		// $tags = $events->get_the_tags( get_the_ID() );

					$eurl = (filter_var(get_post_meta(get_the_ID(),'event_url_mb',true),FILTER_VALIDATE_URL) 
							 ? get_post_meta(get_the_ID(),'event_url_mb',true) : 'You entered an invalid URL!') ;
		
					$from = get_post_meta(get_the_ID(),'from_date_mb',true); 
				    $to = get_post_meta(get_the_ID(),'to_date_mb',true);
					$add = get_post_meta(get_the_ID(),'event_address_mb',true);
					
					$time = concat_date($from,$to);
					

					if(has_term('featured_events','etype_tax')){
						$tempo .= '
						<div class="col-lg-12" style="background-color: white;padding:15px;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);margin-top: 15px;">
							<div class="col-lg-4" >
								<img class="vc_img-placeholder vc_single_image-img" src="'.get_the_post_thumbnail_url().'" />
							</div>
							<div class="col-lg-8" style="display:inline-block;">
								<div><a href="'.$eurl.'"><h4>'.get_the_title().'</h4></a></div>
								<div style="display: inline-block; color: black; font-weight:600;margin-top:10px;">'.$time.'</div> 
									<div style="display: inline-block;font-weight: 900;margin-top:10px;">|</div> 
									<div style="color: #a1a1a1; display: inline-block; font-weight:600;margin-top:10px;">'.$add.'</div>
								<div style="width: 100%; padding-top:15px;margin-top:10px;">

										'.get_the_content().'

								</div>
							</div>
						</div><hr>
						';
					}


					$all.='
						<div style="margin-bottom:10px;margin-top:15px;"><a href="'.$eurl.'"><h4>'.get_the_title().'</h4></a></div>
						<div style="display: inline-block; color: black; font-weight:600;">'.$time.'</div> <div style="display: inline-block;font-weight: 800;">|</div> <div style="display: inline-block; font-weight:600;">'.$add.'</div>
						<div style="width: 100%; padding-top:15px;">
						
								'.get_the_content().'
						
						</div>
						<hr>';


					if(has_term('bitcoin_events','etype_tax')){
						$btc.='<div style="margin-bottom:10px;margin-top:15px;"><a href="'.$eurl.'"><h4>'.get_the_title().'</h4></a></div>
						<div style="display: inline-block; color: black; font-weight:600;">'.$time.'</div> <div style="display: inline-block;font-weight: 800;">|</div> <div style="display: inline-block; font-weight:600;">'.$add.'</div>
						<div style="width: 100%; padding-top:15px;">
						
								'.get_the_content().'
						
						</div>
						<hr>';
					}
					if(has_term('financial_events','etype_tax')){
						$fin .= '<div style="margin-bottom:10px;margin-top:15px;"><a href="'.$eurl.'"><h4>'.get_the_title().'</h4></a></div>
						<div style="display: inline-block; color: black; font-weight:600;">'.$time.'</div> <div style="display: inline-block;font-weight: 800;">|</div> <div style="display: inline-block; font-weight:600;">'.$add.'</div>
						<div style="width: 100%; padding-top:15px;">
						
								'.get_the_content().'
						
						</div>
						<hr>';
					}

					if(has_term('technology_events','etype_tax')){
						$tech .= '<div style="margin-bottom:10px;margin-top:15px;"><a href="'.$eurl.'"><h4>'.get_the_title().'</h4></a></div>
						<div style="display: inline-block; color: black; font-weight:600;">'.$time.'</div> <div style="display: inline-block;font-weight: 800;">|</div> <div style="display: inline-block; font-weight:600;">'.$add.'</div>
						<div style="width: 100%; padding-top:15px;">
						
								'.get_the_content().'
						
						</div>
						<hr>';
					}

	            endwhile;
	            wp_reset_postdata();

	            $tempo.='
<div class="col-lg-12" style="margin:20px 0 0 0;padding:0;">
	<div class="col-lg-8" style="padding:0;">
		<div style="border:none;padding-left:0;" id="tabs">
		  <ul style="background:none;border:none;">
		    <li style="font-size:18px;border:none;"><a style="font-weight:300;" href="#tabs-1">All</a></li>
		    <li style="font-size:18px;border:none;"><a style="font-weight:300;" href="#tabs-2">Bitcoin Events</a></li>
		    <li style="font-size:18px;border:none;"><a style="font-weight:300;" href="#tabs-3">Financial Events</a></li>
		    <li style="font-size:18px;border:none;"><a style="font-weight:300;" href="#tabs-4">Technology Events</a></li>
		  </ul>
		  <div style="padding-left:0;" id="tabs-1">
		    '.$all.'
		  </div>
		  <div style="padding-left:0;" id="tabs-2">
		    '.$btc.'
		  </div>
		  <div style="padding-left:0;" id="tabs-3">
		    '.$fin.'
		  </div>
		  <div style="padding-left:0;" id="tabs-4">
		   	'.$tech.'
		  </div>
		</div>
	</div>
	<div class="col-lg-4">
	</div>
</div>
	     ';

	    endif;

	     
	    return $tempo;
	endif;
}

function concat_date($from,$to){
				$time = "";
	
				$f = explode("/",$from);
				$t = explode("/",$to);
	
				$fd = date("F d, Y", mktime(0, 0, 0, $f[0], $f[1], $f[2]));
				$td = date("F d, Y", mktime(0, 0, 0, $t[0], $t[1], $t[2]));

				$fdd = explode(" ",$fd);
				$tdd = explode(" ",$td);



				if($fdd[0] == $tdd[0] && $fdd[1] == $tdd[1] && $fdd[2] == $tdd[2]){
					$time = implode($fdd," ");
				}else if ($fdd[0] == $tdd[0] && $fdd[2] == $tdd[2]){
				$time = $fdd[0]." ".str_replace(",","",$fdd[1])."-".$tdd[1]." ".$fdd[2];

				}else{
					$time = implode($fdd," ")." - ".implode($tdd," ");
				}
				
		return $time;
	
}

function create_events_filter_nav(){
	$content = '';
	$content .='<div class="cv-container" id="cv-nav">';
	$content .='	<div class="cv-item-filter"> <a href="#" id="cv-countries"> <i class="fa fa-flag-o" aria-hidden="true"></i> All Countries</a><div id="cv-dropdown-countries"></div></div>';
	$content .='	<div class="cv-item-filter"> <a href="#" id="cv-cities" ><i class="fa fa-map-marker" aria-hidden="true"></i> All Cities</a><div id="cv-dropdown-cities"></div></div>';
	$content .='	<div class="cv-item-filter"> <a href="#" id="cv-month" ><i class="fa fa-calendar" aria-hidden="true"></i> Any Month</a><div id="cv-dropdown-month"></div></div>';
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