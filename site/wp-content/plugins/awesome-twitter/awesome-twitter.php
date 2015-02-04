<?php
/*
Plugin Name: Awesome Twitter
Plugin URI: http://dankov-theme.com
Description: Special awesome twitter widget for Dankov themes with latest API 1.1. Need PHP 5.3 and higher.
Author: Dankov
Author URI: http://themeforest/user/dankov
Version: 1.1.2
 */

global $at_settings_page, $current_dir;

$twt_ck = get_option('twt_ck');
$twt_cs = get_option('twt_cs');
$twt_ut = get_option('twt_ut');
$twt_us = get_option('twt_us');

$current_dir = dirname(__File__);


// admin page
require_once( $current_dir . '/core/admin-page.php');
require_once ($current_dir . '/core/awesomeness/codebird_twitter.php');

// Register Widget
add_action('widgets_init', 'at_widgets');
function at_widgets() {

    global $current_dir;

    require_once( $current_dir . '/core/widget/awesome-twitter-widget.php');
    register_widget('AWESOME_Twitter_Widget');
}

function awt_install() {
    if (!isset($twt_ck))
        add_option('twt_ck');

    if (!isset($twt_cs))
        add_option('twt_ck');

    if (!isset($twt_ut))
        add_option('twt_ck');

    if (!isset($twt_us))
        add_option('twt_ck');
}

register_activation_hook(__File__, 'awt_install');