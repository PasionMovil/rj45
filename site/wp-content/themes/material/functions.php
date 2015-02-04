<?php

/*
|--------------------------------------------------------------------------
| Material Framework
|--------------------------------------------------------------------------
*/ 

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/framework/ReduxFramework/ReduxCore/framework.php' ) ) {
require_once( dirname( __FILE__ ) . '/framework/ReduxFramework/ReduxCore/framework.php' );
}
if ( file_exists( dirname( __FILE__ ) . '/framework/ReduxFramework/config.php' ) ) {
require_once( dirname( __FILE__ ) . '/framework/ReduxFramework/config.php' );
}
if ( is_admin() ) {
	require_once( dirname( __FILE__ ) . '/framework/envato-wordpress-toolkit-library/connect-wordpress-toolkit.php' );
}




/*
|--------------------------------------------------------------------------
| Content width
|--------------------------------------------------------------------------
*/ 

if ( ! isset( $content_width ) )
	$content_width = 739;

/*
|--------------------------------------------------------------------------
| Material recommend plugins
|--------------------------------------------------------------------------
*/ 

define('THEMENAME', 'Material');
define('THEMEVERSION', '1.0.2');

require_once ('framework/plugins/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'Material_required_plugins' ); 
function Material_required_plugins() {

	$plugins = array(

		array(
				'name'                  => 'Awesome Twitter', 
				'version'				=> '1.1.2',
				'slug'                  => 'awesome-twitter', 
				'source'                => get_stylesheet_directory() . '/framework/plugins/awesome-twitter/awesome-twitter.zip', 
				'required'              => false, 
			),	

		array(
				'name'                  => 'Envato WordPress Toolkit', 
				'version'				=> '1.6.3',
				'slug'                  => 'envato-wordpress-toolkit', 
				'source'                => get_stylesheet_directory() . '/framework/plugins/envato-wordpress-toolkit/envato-wordpress-toolkit.zip', 
				'required'              => false, 
			),	

		array(
				'name'                  => 'WP-PageNavi', 
				'version'				=> '2.85',
				'slug'                  => 'wp-pagenavi', 
				'source'                => get_stylesheet_directory() . '/framework/plugins/wp-pagenavi/wp-pagenavi.zip', 
				'required'              => false, 
			),

		array(
			   'name' 		            => 'Breadcrumb Navxt',
			   'slug' 		            => 'breadcrumb-navxt',
				'source'                => get_stylesheet_directory() . '/framework/plugins/breadcrumb-navxt/breadcrumb-navxt.zip', 
			   'required' 	            => false,
		),

		array(
			   'name' 		            => 'Contact Form 7',
			   'slug' 		            => 'contact-form-7',
			   'version'				=> '',
			   'required' 	            => false,
		),


	);

	$theme_text_domain = 'dankov';

	$config = array(
		'domain'       		=> 'dankov',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'dankov' ),
			'menu_title'                       			=> __( 'Install Plugins', 'dankov' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'dankov' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'dankov' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'dankov' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'dankov' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'dankov' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );
}


/*-----------------------------------------------------------------------------------*/
/*	Material Shortcodes
/*-----------------------------------------------------------------------------------*/

require_once ('framework/shortcodes/shortcodes-fn.php');
require_once ('framework/shortcodes/mce/shortcodes-tinymce.php');


/*-----------------------------------------------------------------------------------*/
/*	Material Meta boxes
/*-----------------------------------------------------------------------------------*/

include ('framework/image-resizer.php');
include ('framework/meta/metabox-class.php');
include ('framework/meta/classes.php');
include ("framework/widgets/widget-flickr.php");
include ("framework/widgets/widget-popular-posts-by-views.php");
include ("framework/widgets/widget-popular-posts-by-comments.php");

/*-----------------------------------------------------------------------------------*/
/*	Material Register menu
/*-----------------------------------------------------------------------------------*/

if( !function_exists('dankov_register_menu') ) {
	function dankov_register_menu() {
		register_nav_menus(
			array(
			'top_menu' => __('Main Menu', 'dankov' )
			)
		);
	}
	add_action( 'init', 'dankov_register_menu' );
}

/*
|--------------------------------------------------------------------------
| Material Audio Function
|--------------------------------------------------------------------------
*/ 

if(!function_exists('dankov_audio')) { 
	function dankov_audio($postid) { 
	
		$single_audio_item = get_post_meta($postid, 'dankov_external_audio_block', true);		
		
		if(($single_audio_item != '')) {
			if( strpos($single_audio_item, 'soundcloud') ) {


				$id = $single_audio_item;

				echo '<div class="post-audio"> ' .$id. ' </div>';
			}	
		}

	}
}


/*
|--------------------------------------------------------------------------
| Material Video Function
|--------------------------------------------------------------------------
*/ 

if(!function_exists('dankov_video')) { 
	function dankov_video($postid) { 
	
		$single_video_item = get_post_meta($postid, 'dankov_external_video_block', true);		
		
		if(($single_video_item != '')) {
			if( strpos($single_video_item, 'youtube') ) {
				preg_match(
						'/[\\?\\&]v=([^\\?\\&]+)/',
						$single_video_item,
						$matches
					);
				$id = $matches[1];
				 
				$width = '780';
				$height = '440';
				echo '<div class="post-video"><iframe class="main-youtube" width="' .$width. '" height="'.$height.'" src="//www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe></div>';
			}
			
			if( strpos($single_video_item, 'vimeo') ) {
				preg_match(
						'/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',
						$single_video_item,
						$matches
					);
				$id = $matches[2];	

				$width = '780';
				$height = '440';		
				
				echo '<div class="post-video"><iframe src="http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';	
			}			
		}

	}
}

/*
|--------------------------------------------------------------------------
| Material Gallery function
|--------------------------------------------------------------------------
*/ 

if ( !function_exists( 'dankov_gallery' ) ) {
	function dankov_gallery($postid) {  
	$token = wp_generate_password(5, false, false);
   	wp_enqueue_script('custom-gallery', get_template_directory_uri() . '/assets/js/custom-gallery.js', array('jquery'), '1.0', false );	
	wp_localize_script( 'custom-gallery', 'dankov_gallery_' . $token, array( 'post_id' => $postid) );
	
		$i=0;
		$gallery_images = get_post_meta($postid, 'dankov_gallery_block',true);

		if(!empty($gallery_images)) {	
	
				echo '<div class="owl-carousel gallery-slider" id="gs-'.$postid.'" data-token="' . $token . '">';	
					
					foreach ($gallery_images as $gallery_item) {
						$item_url = $gallery_item['dankov_gallery_post'];						
						$resizer_url = $item_url['url'];
						$resized_image = aq_resize( $resizer_url, 780, 408, true );

							echo  '<div class="slider-item">';
							echo  '<a rel="prettyPhoto[single_image_gallery_'.$postid.']" href="'.esc_url($resizer_url).'" >';
							echo  '<img src="'.esc_url($resized_image).'"/>';
							echo  '</a>';
							echo  '</div>';
					}

				echo  '</div><!--end slides-->';
		}
	}
}

/*
|--------------------------------------------------------------------------
| Show / Hide Admin Bar
|--------------------------------------------------------------------------
 
if ($data['show_adminbar'] == 0) {
    add_filter('show_admin_bar', array($this, 'dankov_remove_admin_bar'));
}
function dankov_remove_admin_bar() {
    return false;
}
*/
/*
|--------------------------------------------------------------------------
| Remove more link function
|--------------------------------------------------------------------------
*/ 

function dankov_remove_more_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'dankov_remove_more_link');



if(!function_exists('dankov_readmore')) { 
	function dankov_readmore($more_link)
	{
	return '';
	}
	add_filter('the_content_more_link', 'dankov_readmore', 10, 1);
}


if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );

http://wordpress.dankov-theme.com/Material/



/*
|--------------------------------------------------------------------------
| Material Google analitycs
|--------------------------------------------------------------------------
*/ 

function google_analytics(){
	global $data;
	if(isset($data['analytics_switch'])) {
		if ($data['analytics_switch'] === '1') { 

			wp_enqueue_script('google-analytics', get_template_directory_uri() . '/assets/js/google-analytics.js', array('jquery'), '1.0', false );	
			wp_localize_script( 'google-analytics', "ga", array( 'ga_id' => $data['ga_id']) );		

		}
	}
}

add_action('wp_footer', 'google_analytics');




/*
|--------------------------------------------------------------------------
| Material scripts
|--------------------------------------------------------------------------
*/ 

function dankov_scripts_styles() {
	global $data;

	$dankovURI = get_template_directory_uri();

	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	wp_enqueue_script("jquery");
	wp_enqueue_script('dankov-flexslider', $dankovURI . '/assets/js/jquery.flexslider-min.js' );	
	wp_enqueue_script('dankov-main', $dankovURI . '/assets/js/main.js' );
	wp_enqueue_script('dankov-navigation', $dankovURI . '/assets/js/navigation.js' );
	wp_enqueue_script('dankov-viewportchecker', $dankovURI . '/assets/js/viewportchecker.js' );
	wp_enqueue_script('dankov-fitvids',  $dankovURI . '/assets/js/jquery.fitvids.js' );
	wp_enqueue_script('dankov-owl-carousel', $dankovURI . '/assets/js/owl.carousel.min.js');
	wp_enqueue_script('dankov-modernizr', $dankovURI . '/assets/js/modernizr.custom.js');
	wp_enqueue_script('dankov-superfish', $dankovURI . '/assets/js/superfish.js');
	wp_enqueue_script('dankov-dlmenu', $dankovURI . '/assets/js/jquery.dlmenu.js');
	wp_enqueue_script('dankov-jflickrfeed', $dankovURI . '/assets/js/jflickrfeed.js' );
	wp_enqueue_script('dankov-prettyphoto-lightbox', $dankovURI . '/assets/js/jquery.prettyPhoto.js' );		
	wp_enqueue_script('dankov-retina', $dankovURI . '/assets/js/retina.min.js' );		
	wp_enqueue_script('dankov-js-nav', $dankovURI . '/assets/js/jquery.nav.js' );
	wp_enqueue_script('dankov-bxslider', $dankovURI . '/assets/js/jquery.bxslider.min.js' );
	wp_register_script('symple_tabs', $dankovURI . '/assets/js/shortcodes/symple_tabs.js', array ( 'jquery', 'jquery-ui-tabs'), '1.0', true );
	wp_register_script('symple_toggle', $dankovURI . '/assets/js/shortcodes/symple_toggle.js', 'jquery', '1.0', true );
	wp_register_script('symple_accordion', $dankovURI . '/assets/js/shortcodes/symple_accordion.js', array ( 'jquery', 'jquery-ui-accordion'), '1.0', true );
	wp_register_script('symple_googlemap',  $dankovURI . '/assets/js/shortcodes/symple_googlemap.js', array('jquery'), '1.0', true );
	wp_register_script('symple_googlemap_api', 'https://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '1.0', true );
	wp_register_script('symple_skillbar', $dankovURI . '/assets/js/shortcodes/symple_skillbar.js', array ( 'jquery' ), '1.0', true );
	wp_register_script('symple_scroll_fade', $dankovURI . '/assets/js/shortcodes/symple_scroll_fade.js', array ( 'jquery' ), '1.0', true );
	
	wp_register_script('phoenix-tiles', $dankovURI . '/assets/js/phoenix-tiles.js', array('jquery'), '1.0', true);
	wp_enqueue_script('phoenix-tiles');

	// Loads our main stylesheet.
	wp_dequeue_style('symple_shortcode_styles');
	wp_enqueue_style( 'dankov-bootstrap', $dankovURI . '/assets/css/bootstrap.css' );
	wp_enqueue_style( 'dankov-simple-icons', $dankovURI . '/assets/css/simple-line-icons.css' );
	wp_enqueue_style( 'dankov-awesome-icons', $dankovURI . '/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'dankov-animate', $dankovURI . '/assets/css/animate.css' );
	wp_enqueue_style( 'dankov-owl-carousel', $dankovURI . '/assets/css/owl.carousel.css' );
	wp_enqueue_style( 'dankov-owl-carousel-themes', $dankovURI . '/assets/css/owl.theme.css' );
	wp_enqueue_style( 'dankov-prettyphoto', $dankovURI . '/assets/css/prettyPhoto.css' );
	wp_enqueue_style( 'dankov-bxslider', $dankovURI . '/assets/css/jquery.bxslider.css' );
	wp_enqueue_style( 'dankov-flexslider-css', $dankovURI . '/assets/css/flexslider.css' );
	wp_enqueue_style( 'dankov-shortcodes-css', $dankovURI . '/assets/css/shortcodes.css' );
	wp_enqueue_style( 'dankov-buddypress-css', $dankovURI . '/assets/css/buddypress.css' );
	wp_enqueue_style( 'dankov-bbpress-css', $dankovURI . '/assets/css/bbpress.css' );
	wp_enqueue_style( 'dankov-woocommerce-css', $dankovURI . '/assets/css/woocommerce.css' );
	wp_enqueue_style( 'royalslider', $dankovURI . '/assets/plugins/royalslider/royalslider.css', false, null, 'all' );
	wp_enqueue_style( 'dankov-style', get_stylesheet_uri() );
	wp_enqueue_style( 'dankov-ie', $dankovURI . '/assets/css/ie.css' );
	wp_enqueue_style( 'dankov-responsive-css', $dankovURI . '/assets/css/responsive.css' );



	$custom_css = '';
	if(!empty($data['id_custom_css'])) {
		$custom_css .= $data['id_custom_css'];

		wp_add_inline_style( 'dankov-style', $custom_css );
	}	



	/*
|--------------------------------------------------------------------------
| Material custom scheme function
|--------------------------------------------------------------------------*/ 

		$color_scheme = '';
		$output_scheme = '';

		$scheme1 = isset($data['custom_color_scheme']) ? $data['custom_color_scheme'] : null;
		$scheme_alpha = isset($data['custom_color_scheme_alpha']) ? $data['custom_color_scheme_alpha'] : 1;

		if ($scheme1) {
			$color_scheme = $scheme1;
			$output_scheme = '
			.menu {background:'.$color_scheme.';} .menu-wrapper {background:'.$color_scheme.';} ul#main-nav li ul li {background:'.$color_scheme.';} ul#main-nav li ul li:last-child {background:'.$color_scheme.';} .footer {background:'.$color_scheme.';} .footer-area-cont {background:'.$color_scheme.';}';

			wp_add_inline_style( 'dankov-style', $output_scheme );
		}

		$color_scheme_two = '';
		$output_scheme_two = '';
		if((isset($data['custom_color_scheme_two'])) && ($data['custom_color_scheme_two'] != '')) {
			$color_scheme_two = $data['custom_color_scheme_two'];
			$output_scheme_two = '
				ul#top-nav li a:hover { color: '.$color_scheme_two.' } .meta-slider i {color: '.$color_scheme_two.'; } .paper-button:before, .paper-button:after {color: '.$color_scheme_two.'; } .two-colls-post .title:hover a, .two-colls-post .title:hover {color: '.$color_scheme_two.'; }
				a:hover {color: '.$color_scheme_two.';} h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {color: '.$color_scheme_two.';}
				.entry-meta ul li i {color: '.$color_scheme_two.';} .dankov_post_meta i {color: '.$color_scheme_two.';} .sidebar a {color: '.$color_scheme_two.';} .owl-theme .owl-controls .owl-page span {background: '.$color_scheme_two.';} .footer-widget .dankov_post_meta i {color: '.$color_scheme_two.'; }
				.tagcloud a:hover {color: '.$color_scheme_two.';} .tagcloud a {border: 1px solid '.$color_scheme_two.'; background: '.$color_scheme_two.';} 
				.tweet_list li:before {color: '.$color_scheme_two.';} button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover {color: '.$color_scheme_two.';} .archive-shop:before {color: '.$color_scheme_two.'; }
				.head-search span:hover:before {color: '.$color_scheme_two.';} .slider-meta li i {color: '.$color_scheme_two.';} .left-image-post .title:hover a, .left-image-post .title:hover {color: '.$color_scheme_two.';}
				.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale { color: '.$color_scheme_two.'; }
				.button, html input[type="button"], input[type="reset"], input[type="submit"] {border-color: '.$color_scheme_two.'; background: '.$color_scheme_two.';} .tagcloud a:hover { color: '.$color_scheme_two.' !important; } .no-thumbnail .post-thumbnail {background: '.$color_scheme_two.';}
				.flex-control-paging li a.flex-active {background: '.$color_scheme_two.';} .flex-control-paging li a:hover {background: '.$color_scheme_two.';}
				.widget_search form > div:before {color: '.$color_scheme_two.';} .nav-previous a:hover  {background: '.$color_scheme_two.';} .nav-next a:hover {background:'.$color_scheme_two.';} .sticky-post-slider .post-thumbnail:after {background: '.$color_scheme_two.';}
				.logged-in-as a {color: '.$color_scheme_two.';} .author-card {color: '.$color_scheme_two.';} .comment-reply-link {color: '.$color_scheme_two.';} .link-format a:before {color: '.$color_scheme_two.';}
				.archive-tags:before {color: '.$color_scheme_two.';} .archive-date:before {color: '.$color_scheme_two.';} .archive-search:before {color: '.$color_scheme_two.';} .archive-category:before {color: '.$color_scheme_two.';} .tweet_text a {color: '.$color_scheme_two.';} .dankov_post_content a:hover {color: '.$color_scheme_two.';} 
				.bbp-forum-info a {color: '.$color_scheme_two.';} .bbp-body .bbp-topic-title > a {color: '.$color_scheme_two.';} .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info {border-top: 2px solid '.$color_scheme_two.';}
				.woocommerce .woocommerce-info:before, .woocommerce-page .woocommerce-info:before {background-color: '.$color_scheme_two.';} .woocommerce span.onsale, .woocommerce-page span.onsale {color:'.$color_scheme_two.';} .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button {background:'.$color_scheme_two.';}
				.woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover {background: '.$color_scheme_two.';}
				.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content, .woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content {background: '.$color_scheme_two.';} .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range {background: '.$color_scheme_two.';box-shadow: inset 0 1px 0px '.$color_scheme_two.', inset 0 -1px 0px '.$color_scheme_two.', inset 0 2px 0px rgba(255,255,255,0.37);}
				.woocommerce ul.products li.product h3:hover, .woocommerce-page ul.products li.product h3:hover {color:'.$color_scheme_two.';} .woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins {color:'.$color_scheme_two.';}
				.woocommerce .price .amount {color: '.$color_scheme_two.';} .add_to_cart_button:before {color: '.$color_scheme_two.';} .added_to_cart:after {color: '.$color_scheme_two.';} .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price {color: '.$color_scheme_two.';} .widget_product_search form > div:before {color: '.$color_scheme_two.';}
				.woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt {background: '.$color_scheme_two.';} .woocommerce #content input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover {background: '.$color_scheme_two.';}
				.woocommerce .star-rating span:before, .woocommerce-page .star-rating span:before {color: '.$color_scheme_two.';} .single-product [itemprop="offers"] ins .amount {color: '.$color_scheme_two.';}
				#buddypress ul.item-list li div.item-title a {color: '.$color_scheme_two.';} #buddypress .activity-header a, #buddypress .comment-meta a, #buddypress .acomment-meta a  {color: '.$color_scheme_two.';} #buddypress div.item-list-tabs#subnav ul li.feed a {color: '.$color_scheme_two.';}
				#buddypress div.item-list-tabs ul li.selected a, #buddypress div.item-list-tabs ul li.current a {background-color: '.$color_scheme_two.';} 
				#buddypress button:hover, #buddypress a.button:hover, #buddypress a.button:focus, #buddypress input[type=submit]:hover, #buddypress input[type=button]:hover, #buddypress input[type=reset]:hover, #buddypress ul.button-nav li a:hover, #buddypress ul.button-nav li.current a, #buddypress div.generic-button a:hover, #buddypress .comment-reply-link:hover {border-color: '.$color_scheme_two.'; color: '.$color_scheme_two.';}  
				#buddypress button, #buddypress a.button, #buddypress input[type=submit], #buddypress input[type=button], #buddypress input[type=reset], #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, a.bp-title-button {background: '.$color_scheme_two.'; border-color: '.$color_scheme_two.';}';


			if ($scheme_alpha != 1) {
				$bgOpacity = "rgba(" . dankov_hex2rgb($color_scheme_two) . "," . $scheme_alpha . ")";
				$output_scheme_two .= '.post-thumbnail .single-item {background: '. $bgOpacity .'}';
			}


			wp_add_inline_style( 'dankov-style', $output_scheme_two );	
		} 

			
}

add_action( 'wp_enqueue_scripts', 'dankov_scripts_styles' );



/*
|--------------------------------------------------------------------------
| Material title
|--------------------------------------------------------------------------
*/ 

function dankov_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'dankov' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'dankov_wp_title', 10, 2 );


/*
|--------------------------------------------------------------------------
| HEX to RGB function
|--------------------------------------------------------------------------
*/ 
function dankov_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
}


/*
|--------------------------------------------------------------------------
| Material page menu
|--------------------------------------------------------------------------
*/ 

function dankov_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'dankov_page_menu_args' );


/*
|--------------------------------------------------------------------------
| Material widgets
|--------------------------------------------------------------------------
*/ 

function dankov_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'dankov' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'dankov' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


	register_sidebar( array(
		'name' => __( 'Footer Sidebar 1', 'dankov' ),
		'id' => 'footer-1',
		'description' => __( 'Appears on all pages at the bottom of site.', 'dankov' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


	register_sidebar( array(
		'name' => __( 'Footer Sidebar 2', 'dankov' ),
		'id' => 'footer-2',
		'description' => __( 'Appears on all pages at the bottom of site.', 'dankov' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Sidebar 3', 'dankov' ),
		'id' => 'footer-3',
		'description' => __( 'Appears on all pages at the bottom of site.', 'dankov' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	/*register_sidebar( array(
		'name' => __( 'BuddyPress Sidebar', 'dankov' ),
		'id' => 'buddypress',
		'description' => __( 'Appears on all pages at the bottom of site.', 'dankov' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );*/
	register_sidebar( array(
		'name' => __( 'WooCommerce Sidebar', 'dankov' ),
		'id' => 'woocommerce',
		'description' => __( 'Appears on all pages at the bottom of site.', 'dankov' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


}
add_action( 'widgets_init', 'dankov_widgets_init' );

/*
|--------------------------------------------------------------------------
| Material content navigation
|--------------------------------------------------------------------------
*/ 

if ( ! function_exists( 'dankov_content_nav' ) ) :

function dankov_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span>'.__('Older posts', 'dankov' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'dankov' ) . '<span class="meta-nav">&rarr;</span>' ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;



/*
|--------------------------------------------------------------------------
| Material comments
|--------------------------------------------------------------------------
*/ 

if ( ! function_exists( 'dankov_comment' ) ) :
function dankov_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'dankov' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'dankov' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 75 );
					printf( '<div class="author-card">%1$s</div>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'dankov' ) . '</span>' : ''
					);
					printf( '<div class="comment-time">%3$s</div>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( __( '%1$s at %2$s', 'dankov' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'dankov' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'dankov' ), '<div class="edit-link">', '</div>' ); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'dankov' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</section><!-- .comment-content -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;


/*
|--------------------------------------------------------------------------
| Material post types and functions
|--------------------------------------------------------------------------
*/ 

function dankov_setup() {

	load_theme_textdomain( 'dankov', get_template_directory() . '/lang' );
	add_editor_style();

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-formats', array( 'image', 'link', 'quote', 'video', 'audio', 'gallery' ) );
	register_nav_menu( 'primary', __( 'Top Menu', 'dankov' ) );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 739, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'dankov_setup' );




// post by views functionality
function dankov_set_post_views($postID) {
    $count_key = 'dankov_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function dankov_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    dankov_set_post_views($post_id);
}
add_action( 'wp_head', 'dankov_track_post_views');

function dankov_get_post_views($postID){
    $count_key = 'dankov_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}


/*-----------------------------------------------------------------------------------*/
/*	Other Functions
/*-----------------------------------------------------------------------------------*/

add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
function woo_hide_page_title() {
	
	return false;
	
}

	add_filter('loop_shop_columns', 'loop_columns');
		if (!function_exists('loop_columns')) {
			function loop_columns() {
				return 2; // 3 products per row
			}
		}

	add_filter('loop_shop_per_page', create_function('$cols', 'return 12;'));

function theme_custom_background () {
	global $data;

	if ($data['boxed_swtich'] == 2) {

		$bg_size       =  ( isset($data['boxed_background']['background-size']) && $data['boxed_background']['background-size'] != '' ) ? 'background-size: '. $data['boxed_background']['background-size'] . ";\n" : null;
		$bg_color      =  ( isset($data['boxed_background']['background-color']) && $data['boxed_background']['background-color'] != '' ) ? 'background-color: ' .$data['boxed_background']['background-color'] . ";\n" : null;
		$bg_image      =  ( isset($data['boxed_background']['background-image']) && $data['boxed_background']['background-image'] != '' ) ? 'background-image: url("' . $data['boxed_background']['background-image'] . '")' . ";\n" : null;
		$bg_repeat     =  ( isset($data['boxed_background']['background-repeat']) && $data['boxed_background']['background-repeat'] != '' ) ? 'background-repeat: ' . $data['boxed_background']['background-repeat'] . ";\n" : null;
		$bg_position   =  ( isset($data['boxed_background']['background-position']) && $data['boxed_background']['background-position'] != '' ) ? 'background-position: ' . $data['boxed_background']['background-position'] . ";\n" : null;
		$bg_attachment =  ( isset($data['boxed_background']['background-attachment']) && $data['boxed_background']['background-attachment'] != '' ) ? 'background-attachment: ' . $data['boxed_background']['background-attachment'] . ";\n" : null;

		echo "<style>\n";
			echo "body {\n";
				if ($bg_size) echo "\t" . $bg_size;
				if ($bg_color) echo "\t" . $bg_color;
				if ($bg_image) echo "\t" . $bg_image;
				if ($bg_repeat) echo "\t" . $bg_repeat;
				if ($bg_position) echo "\t" . $bg_position;
				if ($bg_attachment) echo "\t" . $bg_attachment;
			echo "}\n";
		echo "</style>\n";

		return true;
	}
	return false;
}


add_action('admin_bar_menu', 'material_add_element_to_menu', 1000);
function material_add_element_to_menu() {
 global $wp_admin_bar;
 if(!is_super_admin() || !is_admin_bar_showing()) return;


 $wp_admin_bar->add_menu( array(
 'id' => 'our_support_item',
 'meta' => array('title' => 'Support', 'target' => '_blank'),
 'title' => 'Material Support',
 'href' => 'http://themeforest.net/item/material-premium-magazine-wordpress-theme/8560059/comments' ));

}

function dankov_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'dankov_custom_excerpt_length', 999 );

add_filter('excerpt_more', 'dankov_excerpt_more');
function dankov_excerpt_more($excerpt) {
    return '...';
}