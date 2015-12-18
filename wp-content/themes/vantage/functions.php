<?php
/**
 * vantage functions and definitions
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */

define( 'SITEORIGIN_THEME_VERSION' , '2.4.2' );
define('SITEORIGIN_THEME_ENDPOINT', 'http://updates.siteorigin.com/');

if( file_exists( get_template_directory() . '/premium/functions.php' ) ){
	include get_template_directory() . '/premium/functions.php';
}
else {
	include get_template_directory() . '/upgrade/upgrade.php';
}

// Include all the SiteOrigin extras
include get_template_directory() . '/extras/settings/settings.php';
include get_template_directory() . '/extras/premium/premium.php';
include get_template_directory() . '/extras/update/update.php';
include get_template_directory() . '/extras/adminbar/adminbar.php';
include get_template_directory() . '/extras/plugin-activation/plugin-activation.php';
include get_template_directory() . '/extras/metaslider/metaslider.php';

// Load the theme specific files
include get_template_directory() . '/inc/panels.php';
include get_template_directory() . '/inc/settings.php';
include get_template_directory() . '/inc/extras.php';
include get_template_directory() . '/inc/template-tags.php';
include get_template_directory() . '/inc/gallery.php';
include get_template_directory() . '/inc/metaslider.php';
include get_template_directory() . '/inc/widgets.php';
include get_template_directory() . '/inc/menu.php';
include get_template_directory() . '/inc/woocommerce.php';
include get_template_directory() . '/inc/seo.php';
include get_template_directory() . '/tour/tour.php';

include get_template_directory() . '/fontawesome/icon-migration.php';


if ( ! function_exists( 'vantage_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since vantage 1.0
 */
function vantage_setup() {

	// Initialize SiteOrigin settings
	siteorigin_settings_init();
	
	// Make the theme translatable
	load_theme_textdomain( 'vantage', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'siteorigin-panels', array(
		'home-page' => true,
		'margin-bottom' => 35,
		'home-page-default' => 'default-home',
		'home-demo-template' => 'home-panels.php',
		'responsive' => siteorigin_setting( 'layout_responsive' ),
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'vantage' ),
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// We support WooCommerce
	add_theme_support('woocommerce');
	// define('WOOCOMMERCE_USE_CSS', false);

	set_post_thumbnail_size(720, 380, true);
	add_image_size('vantage-thumbnail-no-sidebar', 1080, 380, true);
	add_image_size('vantage-slide', 960, 480, true);
	add_image_size('vantage-carousel', 272, 182, true);
	add_image_size('vantage-grid-loop', 436, 272, true);

	add_theme_support( 'site-logo', array(
		'size' => 'full',
	) );

	if( !defined('SITEORIGIN_PANELS_VERSION') && !siteorigin_plugin_activation_is_activating('siteorigin-panels') ){
		// Only include panels lite if the panels plugin doesn't exist
		include get_template_directory() . '/inc/panels-lite/panels-lite.php';
	}

	add_theme_support('siteorigin-premium-teaser', array(
		'customizer' => true,
		'settings' => true,
	));

	global $content_width, $vantage_site_width;
	if ( ! isset( $content_width ) ) $content_width = 720; /* pixels */

	if ( ! isset( $vantage_site_width ) ) {
		$vantage_site_width = siteorigin_setting('layout_bound') == 'full' ? 1080 : 1010;
	}

	$container = 'content';
	$render_function = '';
	$wrapper = true;
	// The posts_per_page setting only works when type is 'scroll'.
	// When type is set to 'click' either explicitly or automatically,
	// due to there being footer widgets, it uses the "Blog pages show at most X posts" setting
	// under Settings > Reading instead. :(
	// https://wordpress.org/support/topic/posts_per_page-not-having-any-effect
	$posts_per_page = 7;
	if ( siteorigin_setting( 'blog_archive_layout' ) == 'circleicon' ) {
		$container = 'vantage-circleicon-loop';
		$render_function = 'vantage_infinite_scroll_render';
		$wrapper = false;
		$posts_per_page = 6;
	}
	else if ( siteorigin_setting( 'blog_archive_layout' ) == 'grid' ) {
		$container = 'vantage-grid-loop';
		$render_function = 'vantage_infinite_scroll_render';
		$wrapper = false;
		$posts_per_page = 8;
	}

	add_filter( 'infinite_scroll_settings', 'vantage_infinite_scroll_settings' );

	add_theme_support( 'infinite-scroll', array(
		'container' => $container,
		'footer' => 'page',
		'render' => $render_function,
		'wrapper' => $wrapper,
		'posts_per_page' => $posts_per_page,
		'type' => 'click',
//		'footer_widgets' => 'sidebar-footer',
	) );
}
endif; // vantage_setup
add_action( 'after_setup_theme', 'vantage_setup' );

// Override Jetpack Infinite Scroll default behaviour of ignoring explicit posts_per_page setting when type is 'click'.
function vantage_infinite_scroll_settings( $settings ) {
	if ( $settings['type'] == 'click' ) {
		if( siteorigin_setting( 'blog_archive_layout' ) == 'circleicon' ) {
			$settings['posts_per_page'] = 6;
		}
		else if ( siteorigin_setting( 'blog_archive_layout' ) == 'grid' ) {
			$settings['posts_per_page'] = 8;
		}
	}
	return $settings;
}

function vantage_infinite_scroll_render() {
	ob_start();
	get_template_part( 'loops/loop', siteorigin_setting( 'blog_archive_layout' ) );
	$var = ob_get_clean();
	// Strip leading and trailing whitespace.
	$var = trim( $var );
	// Remove the opening and closing div tags for subsequent pages of posts for correct circleicon and grid layouts.
	$var = preg_replace( '/^<div.+>/', '', $var );
	$var = preg_replace( '/<\/div>$/', '', $var );
	echo $var;
}

/**
 * Setup the WordPress core custom background feature.
 * 
 * @since vantage 1.0
 */
function vantage_register_custom_background() {

	if(siteorigin_setting('layout_bound') == 'boxed') {
		$args = array(
			'default-color' => 'e8e8e8',
			'default-image' => '',
		);

		$args = apply_filters( 'vantage_custom_background_args', $args );
		add_theme_support( 'custom-background', $args );
	}

}
add_action( 'after_setup_theme', 'vantage_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since vantage 1.0
 */
function vantage_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'vantage' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer', 'vantage' ),
		'id' => 'sidebar-footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Header', 'vantage' ),
		'id' => 'sidebar-header',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'vantage_widgets_init' );

function vantage_print_styles(){
	if( !siteorigin_setting('layout_responsive') ) return;

	// Create the footer widget CSS
	$sidebars_widgets = wp_get_sidebars_widgets();
	$count = isset($sidebars_widgets['sidebar-footer']) ? count($sidebars_widgets['sidebar-footer']) : 1;
	$count = max($count,1);

	?>
	<style type="text/css" media="screen">
		#footer-widgets .widget { width: <?php echo round(100/$count,3) . '%' ?>; }
		@media screen and (max-width: 640px) {
			#footer-widgets .widget { width: auto; float: none; }
		}
	</style>
	<?php
}
add_action('wp_head', 'vantage_print_styles', 11);

/**
 * Enqueue scripts and styles
 */
function vantage_scripts() {
	wp_enqueue_style( 'vantage-style', get_stylesheet_uri(), array(), SITEORIGIN_THEME_VERSION );
	wp_enqueue_style( 'vantage-fontawesome', get_template_directory_uri().'/fontawesome/css/font-awesome.css', array(), '4.2.0' );
	$in_footer = siteorigin_setting( 'general_js_enqueue_footer' );
	$js_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_enqueue_script( 'vantage-flexslider' , get_template_directory_uri() . '/js/jquery.flexslider' . $js_suffix . '.js' , array('jquery'), '2.1', $in_footer );
	wp_enqueue_script( 'vantage-touch-swipe' , get_template_directory_uri() . '/js/jquery.touchSwipe' . $js_suffix . '.js' , array( 'jquery' ), '1.6.6', $in_footer );
	wp_enqueue_script( 'vantage-main' , get_template_directory_uri() . '/js/jquery.theme-main' . $js_suffix . '.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION, $in_footer );

	if( siteorigin_setting( 'layout_fitvids' ) ) {
		wp_enqueue_script( 'vantage-fitvids' , get_template_directory_uri() . '/js/jquery.fitvids' . $js_suffix . '.js' , array('jquery'), '1.0', $in_footer );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply', $in_footer );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'vantage-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation' . $js_suffix . '.js', array( 'jquery' ), '20120202', $in_footer );
	}
}
add_action( 'wp_enqueue_scripts', 'vantage_scripts' );

/**
 * Enqueue any webfonts we need
 */
function vantage_web_fonts(){
	if( !siteorigin_setting('logo_image') ) {
		wp_enqueue_style('vantage-google-webfont-roboto', '//fonts.googleapis.com/css?family=Roboto:300');
	}
}
add_action( 'wp_enqueue_scripts', 'vantage_scripts' );

function vantage_wp_head(){
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/selectivizr.js"></script>
	<![endif]-->
	<?php
}
add_action('wp_head', 'vantage_wp_head');

/**
 * Display some text in the text area.
 */
function vantage_top_text_area(){
	echo wp_kses_post( siteorigin_setting('logo_header_text') );
}
add_action('vantage_support_text', 'vantage_top_text_area');

/**
 * Display the scroll to top link.
 */
function vantage_back_to_top() {
	if( !siteorigin_setting('navigation_display_scroll_to_top') ) return;
	?><a href="#" id="scroll-to-top" title="<?php esc_attr_e('Back To Top', 'vantage') ?>"><span class="vantage-icon-arrow-up"></span></a><?php
}
add_action('wp_footer', 'vantage_back_to_top');

/**
 * @return mixed
 */
function vantage_get_query_variables(){
	global $wp_query;
	$vars = $wp_query->query_vars;
	foreach($vars as $k => $v) {
		if(empty($vars[$k])) unset ($vars[$k]);
	}
	unset($vars['update_post_term_cache']);
	unset($vars['update_post_meta_cache']);
	unset($vars['cache_results']);
	unset($vars['comments_per_page']);

	return $vars;
}

/**
 * Render the slider.
 */
function vantage_render_slider(){

	if( is_front_page() && siteorigin_setting('home_slider') != 'none' ) {
		$settings_slider = siteorigin_setting( 'home_slider' );
		$slider_stretch = siteorigin_setting( 'home_slider_stretch' );

		if(!empty($settings_slider)) {
			$slider = $settings_slider;
		}
	}

	if( is_page() && get_post_meta(get_the_ID(), 'vantage_metaslider_slider', true) != 'none' ) {
		$page_slider = get_post_meta(get_the_ID(), 'vantage_metaslider_slider', true);
		if( !empty($page_slider) ) {
			$slider = $page_slider;
		}
		$slider_stretch = get_post_meta(get_the_ID(), 'vantage_metaslider_slider_stretch', true);
		if( $slider_stretch === '' ) {
			// We'll default to whatever the home page slider stretch setting is
			$slider_stretch = siteorigin_setting('home_slider_stretch');
		}
	}

	if( empty($slider) ) return;

	global $vantage_is_main_slider;
	$vantage_is_main_slider = true;

	?><div id="main-slider" <?php if( $slider_stretch ) echo 'data-stretch="true"' ?>><?php


	if($slider == 'demo') get_template_part('slider/demo');
	elseif( substr($slider, 0, 5) == 'meta:' ) {
		list($null, $slider_id) = explode(':', $slider);
		$slider_id = intval($slider_id);

		echo do_shortcode("[metaslider id=" . $slider_id . "]");
	}

	?></div><?php
	$vantage_is_main_slider = false;
}

function vantage_post_class_filter($classes){
	$classes[] = 'post';

	if( has_post_thumbnail() && !is_singular() ) {
		$classes[] = 'post-with-thumbnail';
		$classes[] = 'post-with-thumbnail-' . siteorigin_setting('blog_featured_image_type');
	}

	$classes = array_unique($classes);
	return $classes;
}
add_filter('post_class', 'vantage_post_class_filter');

/**
 * Filter the posted on parts to remove the ones disabled in settings.
 *
 * @param $parts
 * @return mixed
 */
function vantage_filter_vantage_post_on_parts($parts){
	if(!siteorigin_setting('blog_post_author')) $parts['by'] = '';
	if(!siteorigin_setting('blog_post_date')) $parts['on'] = '';

	return $parts;
}
add_filter('vantage_post_on_parts', 'vantage_filter_vantage_post_on_parts');

/**
 * Get the site width.
 *
 * @return int The side width in pixels.
 */
function vantage_get_site_width(){
	return apply_filters('vantage_site_width', !empty($GLOBALS['vantage_site_width']) ? $GLOBALS['vantage_site_width'] : 1080);
}

/**
 * Add the responsive header
 */
function vantage_responsive_header(){
	if( siteorigin_setting('layout_responsive') ) {
		?><meta name="viewport" content="width=device-width, initial-scale=1" /><?php
	}
	else {
		?><meta name="viewport" content="width=1280" /><?php
	}
}
add_action('wp_head', 'vantage_responsive_header');




function add_custom_query_var( $vars ){
  $vars[] = "c";
  return $vars;
}
add_filter( 'query_vars', 'add_custom_query_var' );

   add_action( 'init', 'my_setcookie' );
    function my_setcookie() {
       setcookie( 'valgtKolonne', 'my-value', time() + 3600, COOKIEPATH, COOKIE_DOMAIN );
    }



/**

 * Handles the site title, copyright symbol and year string replace for the Footer Copyright theme option.

 */
function vantage_footer_site_info_sub($copyright){

	return str_replace(

		array('{site-title}', '{copyright}', '{year}'),

		array(get_bloginfo('name'), '&copy;', date('Y')),

		$copyright

	);

}

add_filter( 'vantage_site_info', 'vantage_footer_site_info_sub' );


function view_remove_submenu_item() {
	global $bp;

	unset($bp->bp_options_nav['profile']['public']);
}
add_action('bp_setup_nav', 'view_remove_submenu_item', 201);


/*Nytt felt wi woocommerce*/
function new_projects_fields( $fields ) {
	$fields['arrtittel'] = array(
	    'name' 			=> __( 'Arrangementtittel', 'projects' ),
	    'description' 	=> __( 'Tittelen på arrangementet', 'projects' ),
	    'type' 			=> 'text',
	    'default' 		=> '',
	    'section' 		=> 'info'
	);

	return $fields;
}
add_filter( 'projects_custom_fields', 'new_projects_fields' );


/** Exclude woocommerce products from wp default search results */
add_action( 'init', 'update_my_custom_type', 99 );
function update_my_custom_type() {
    global $wp_post_types;

    if ( post_type_exists( 'product' ) ) {

        // exclude from search results
        $wp_post_types['product']->exclude_from_search = true;
        $wp_post_types['job_listing']->exclude_from_search = true;



        
    }
}





add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js", false, null);
	wp_enqueue_script('jquery');
}


/*Logg inn wp job manager, blir sent på mail*/
add_filter( 'submit_job_form_login_url', 'custom_submit_job_form_login_url' );

function custom_submit_job_form_login_url() {
	return 'http://revent.no/logg-inn/';
}


/*Legge til telefonummer*/

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { ?>
	<h3>Extra profile information</h3>
	<table class="form-table">
		<tr>
			<th><label for="phone">Telefon</label></th>
			<td>
				<input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Vennligst angi ditt telefonummer slik ati </span>
			</td>
		</tr>
	</table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_usermeta( $user_id, 'phone', $_POST['phone'] );
}




function bp_custom_user_signup() {

}
add_action('bp_before_registration_submit_buttons', 'bp_custom_user_signup');

// Add field_name from sign-up to usermeta on registration
function bp_user_activate_field( $signup ) {

	$bpCustomField = $_POST['phone'];

	update_usermeta( $signup, 'phone', $bpCustomField );

	return $signup;
}
add_filter( 'user_register', 'bp_user_activate_field' );

//redirecte bruker til forsiden ved logg ut

function wpse_109694(){
	$redirect_to = home_url();
	wp_redirect($redirect_to);
	exit();
}

add_action('wp_logout', 'wpse_109694');

add_filter( 'nav_menu_link_attributes', 'wpse121123_contact_menu_atts', 10, 3 );
function wpse121123_contact_menu_atts( $atts, $item, $args )
{
	// The ID of the target menu item
	$menu_target = 1774;

	// inspect $item
	if ($item->ID == $menu_target) {
		$atts['data-toggle'] = 'modal';
		$atts['data-target'] = '#logginnmodal';
		$atts['id'] = 'logginnknappmodal';


	}
	return $atts;
}


/*Kjøre en kode daglig*/


add_action( 'wp', 'varsler_setup_schedule' );
/**
 * On an early action hook, check if the hook is scheduled - if not, schedule it.
 */
function varsler_setup_schedule() {
	if ( ! wp_next_scheduled( 'varsler_daily_event' ) ) {
		wp_schedule_event( time(), 'daily', 'varsler_daily_event');
	}
}


add_action( 'varsler_daily_event', 'varsler_do_this_daily' );
/**
 * On the scheduled action hook, run a function.
 */
function varsler_do_this_daily() {
//
//Sjekk ett urgåtte oppdrag daglig
//
//
	wp_mail("christopher@revent.no", 'Daglig mail', "Bare en test på om mailen kommer daglig");
	
}
