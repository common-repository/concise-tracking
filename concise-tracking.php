<?php
/*
*Plugin Name: Concise Tracking
*Description: This plugin is used to customize Concise Tracking settings like header color, button color, google map api key etc.
*Version: 1.0.2
*/
if(!defined('ABSPATH')){
    exit;
}
define('CONCISE_DIR', dirname( __FILE__ ) );
include_once( CONCISE_DIR . '/includes/menu.php' );
include_once( CONCISE_DIR . '/includes/settings.php' );
include_once( CONCISE_DIR . '/pages/shipment-search.php' );
include_once( CONCISE_DIR . '/pages/shipment-grid.php' );
include_once( CONCISE_DIR . '/pages/single-shipment.php' );
include_once( CONCISE_DIR . '/includes/theme-styles.php' );
function cs_install_events_page(){
        $new_page_title = 'Concise Search';
        $new_page_content = '[shipment-search]';
        //don't change the code below, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);

        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
        }
        $new_page_title2 = 'Concise Grid';
        $new_page_content2 = '[shipment-grid]';
        //don't change the code below, unless you know what you're doing
        $page_check2 = get_page_by_title($new_page_title2);

        $new_page2 = array(
                'post_type' => 'page',
                'post_title' => $new_page_title2,
                'post_content' => $new_page_content2,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check2->ID)){
                $new_page_id2 = wp_insert_post($new_page2);
}
        $new_page_title3 = 'Concise Shipment';
        $new_page_content3 = '[single-shipment]';
        //don't change the code below, unless you know what you're doing
        $page_check3 = get_page_by_title($new_page_title3);

        $new_page3 = array(
                'post_type' => 'page',
                'post_title' => $new_page_title3,
                'post_content' => $new_page_content3,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check3->ID)){
                $new_page_id3 = wp_insert_post($new_page3);
        }
}//end install_events_pg function to add page to wp on plugin activation

register_activation_hook(__FILE__, 'cs_install_events_page');

?>
