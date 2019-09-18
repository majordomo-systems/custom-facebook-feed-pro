<?php

//Use the token from the shortcode
$shortcode_token = false;
if( isset($_GET['at']) ){

    $at = $_GET['at'];
    $pageid = $_GET['pageid'];
    // $shortcode_token = $at;

    if (strpos($at, '02Sb981f26534g75h091287a46p5l63') !== false) {
        $at = str_replace("02Sb981f26534g75h091287a46p5l63","",$at);
    }
    $shortcode_token = $at;

    // if( strpos($at, ':') !== false ){
    //     $shortcode_token = cffDecodeToken($at,$pageid);        
    // }
}

function cffDecodeToken($at,$pageid){
    $access_token_pieces = explode(",", $at);
    $access_token_multiple = array();
    $shortcode_token = '';

    foreach ( $access_token_pieces as $at_piece ) {
        $access_token_split = explode(":", $at_piece);
        $token_only = trim($access_token_split[1]);
        $page_id_only = str_replace("%20","",$access_token_split[0]);

        //Find the token which matches the Page ID passed in
        if( $page_id_only == $pageid ){
            if (strpos($token_only, '02Sb981f26534g75h091287a46p5l63') !== false) {
                $token_only = str_replace("02Sb981f26534g75h091287a46p5l63","",$token_only);
            }
            $shortcode_token = $token_only;
        }
    }
    return $shortcode_token;
}



//If displaying albums from a group then get the User Access Token from the DB
$users_token = false;
if( ( (isset($usegrouptoken) && $usegrouptoken != false) || $useowntoken ) && !$shortcode_token ){

    function cff_get_wp_config_path(){
        $base = dirname(__FILE__);
        $path = false;
        if (@file_exists(dirname(dirname($base))."/wp-config.php")){
            $path = dirname(dirname($base))."/wp-config.php";
        } else if (@file_exists(dirname(dirname(dirname($base)))."/wp-config.php")){
            $path = dirname(dirname(dirname($base)))."/wp-config.php";
        } else {
            $path = false;
        }
        if ($path != false){
            $path = str_replace("\\", "/", $path);
        }
        return $path;
    }

    $config_path = cff_get_wp_config_path();
    $check_path = realpath($config_path);
    if($check_path && $config_path){
        define( 'SHORTINIT', true );
        require_once( $config_path );

        $table_name = $wpdb->prefix . "options";
        $sql_query = "SELECT * FROM " . $table_name . " WHERE option_name = 'cff_access_token'";
        $results = $wpdb->get_results( $sql_query, ARRAY_A );
        $users_token = $results[0]['option_value'];
    }

}

//Set the kind of token to use
if( $shortcode_token ){
    $access_token = $shortcode_token;
} else {
    if($users_token){
        $access_token = $users_token;
    } else {
        $access_token = '';
    }
}

function cff_fetchUrl($url){
    //Can we use cURL?
    if(is_callable('curl_init')){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
        $feedData = curl_exec($ch);
        curl_close($ch);
    //If not then use file_get_contents
    } elseif ( ini_get('allow_url_fopen') == 1 || ini_get('allow_url_fopen') === TRUE ) {
        $feedData = @file_get_contents($url);
    //Or else use the WP HTTP API
    } else {
        $request = new WP_Http;
        $response = $request->request($urls, array('timeout' => 60, 'sslverify' => false));
        if( is_wp_error( $response ) ) {
            //Don't display an error, just use the Server config Error Reference message
           echo '';
        } else {
            $feedData = wp_remote_retrieve_body($response);
        }
    }
    
    return $feedData;
}

?>