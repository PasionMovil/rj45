<?php

add_action( 'init', 'awesome_twitter_api' );

function awesome_twitter_api() {
    global $cb;

    // Your Twitter App Consumer Key
    // $consumer_key = isset($gen_sets['twt_ck']) ? $gen_sets['twt_ck'] : '';
    $consumer_key = get_option('twt_ck');
    // Your Twitter App Consumer Secret
    // $consumer_secret = isset($gen_sets['twt_cs']) ? $gen_sets['twt_cs'] : '';
    $consumer_secret = get_option('twt_cs');
    // Your Twitter App Access Token
    // $access_token = isset($gen_sets['twt_ut']) ? $gen_sets['twt_ut'] : '';
    $access_token = $twt_ut = get_option('twt_ut');
    // Your Twitter App Access Token Secret
    // $access_secret = isset($gen_sets['twt_us']) ? $gen_sets['twt_us'] : '';
    $access_secret = get_option('twt_us');
    
    require_once( 'codebird.php' );
    Codebird\Codebird::setConsumerKey( $consumer_key, $consumer_secret );
    $cb = Codebird\Codebird::getInstance();
    $cb->setToken( $access_token, $access_secret );
}