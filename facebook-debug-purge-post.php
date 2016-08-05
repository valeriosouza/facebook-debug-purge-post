<?php 
/**
 * Plugin Name: Facebook Debugger and Purge Post
 * Plugin URI: 
 * Description: 
 * Version: 0.1.0
 * Author: Valerio
 * Author URI: http://valeriosouza.com.br/
 * Text Domain: facebook-debug-purge-post
 * Domain Path: /languages
 */


add_action( 'transition_post_status' , 'facebook_purge_future_post', 10, 3);

function facebook_purge_future_post( $new_status, $old_status, $post ) {
    if($new_status == 'publish') {
        facebook_purge_debug_cache($post);
    }
}
// Ping Facebook to recache the URL.
function facebook_purge_debug_cache($post_id) {
    $url = get_permalink($post_id);
    $fb_graph_url = "https://graph.facebook.com/?id=". urlencode($url) ."&scrape=true";
    $result = wp_remote_post($fb_graph_url);
}