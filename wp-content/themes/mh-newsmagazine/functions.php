<?php

/***** Fetch Theme Data *****/

$mh_magazine_lite_data = wp_get_theme('mh-magazine-lite');
$mh_magazine_lite_version = $mh_magazine_lite_data['Version'];
$mh_newsmagazine_data = wp_get_theme('mh-newsmagazine');
$mh_newsmagazine_version = $mh_newsmagazine_data['Version'];

/***** Load Google Fonts *****/

function mh_newsmagazine_fonts() {
	wp_dequeue_style('mh-google-fonts');
	wp_enqueue_style('mh-newsmagazine-fonts', 'https://fonts.googleapis.com/css?family=Sarala:400,700%7cAdamina:400', array(), null);
}
add_action('wp_enqueue_scripts', 'mh_newsmagazine_fonts', 11);

/***** Load Stylesheets *****/

function mh_newsmagazine_styles() {
	global $mh_magazine_lite_version, $mh_newsmagazine_version;
    wp_enqueue_style('mh-magazine-lite', get_template_directory_uri() . '/style.css', array(), $mh_magazine_lite_version);
    wp_enqueue_style('mh-newsmagazine', get_stylesheet_uri(), array('mh-magazine-lite'), $mh_newsmagazine_version);
    if (is_rtl()) {
		wp_enqueue_style('mh-magazine-lite-rtl', get_template_directory_uri() . '/rtl.css', array(), $mh_magazine_lite_version);
	}
    wp_enqueue_style('mh-magazine-lite-preheader', get_template_directory_uri() . '/css/preheader.css', array(), $mh_magazine_lite_version);
}
add_action('wp_enqueue_scripts', 'mh_newsmagazine_styles');

/***** Load Translations *****/

function mh_newsmagazine_theme_setup(){
	load_child_theme_textdomain('mh-newsmagazine', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'mh_newsmagazine_theme_setup');





///  ----Mike Scripts-----
function load_slick(){

wp_enqueue_style( 'slick', 'http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
wp_enqueue_script('slick-js','http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js','','1.1',true);
}

function btc_ticker(){

require_once("inc/btc-ticker.php");

}

add_action('wp_enqueue_scripts','load_slick');

add_shortcode( "btc_ticker","btc_ticker");

//----End----------


/***** Load Scripts *****/
function load_price_index_mandatory_scripts() {
	if(is_page_template('template-price-index.php')) {
		$includes_url = includes_url();
		echo "<script src='${includes_url}js/jquery/ui/core.min.js'></script>";
		echo "<script src='${includes_url}js/jquery/ui/datepicker.min.js'></script>";
		wp_enqueue_style('price-index', get_template_directory_uri() . '/css/price-index.css');
	}

	wp_enqueue_style('font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
}
add_action('wp_head', 'load_price_index_mandatory_scripts');

// nav script
function load_nav_script() {
    wp_enqueue_script( 'nav-script', get_template_directory_uri() . '/js/nav.js' );
}
add_action( 'wp_enqueue_scripts', 'load_nav_script' );



function mg_news_pagination_rewrite() {
  add_rewrite_rule(get_option('category_base').'/page/?([0-9]{1,})/?$', 'index.php?pagename='.get_option('category_base').'&amp;paged=$matches[1]', 'top');
}
add_action('init', 'mg_news_pagination_rewrite');

?>


