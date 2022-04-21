<?php 
/*
Plugin Name: A RC SMS
Plugin URI:  https://ringcentral.com/
Description: RingCentral SMS Sample Plugin - FREE
Author:      Peter MacIntyre
Version:     0.5
Author URI:  https://paladin-bs.com/peter-macintyre/
Details URI: https://paladin-bs.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

RC SMS is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
RC SMS is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
See License URI for full details.

Copyright (C) 2022 Paladin Business Solutions
*/

/* ============================== */
/* Set RingCental Constant values */
/* ============================== */

error_reporting(E_ALL & ~E_WARNING);
ini_set('display_errors', 0);

if(!defined('RINGCENTRAL_PLUGINDIR')){
    define('RINGCENTRAL_PLUGINDIR', plugin_dir_path(__FILE__) ) ;
}
if(!defined('RINGCENTRAL_PLUGINURL')){
    define('RINGCENTRAL_PLUGINURL', plugin_dir_url(__FILE__) ) ;
    //  http path returned
}
if(!defined('RINGCENTRAL_PLUGIN_INCLUDES')){
    define('RINGCENTRAL_PLUGIN_INCLUDES', plugin_dir_path(__FILE__) . "includes/" ) ;
}
if(!defined('RINGCENTRAL_PLUGIN_FILENAME')){
    define ('RINGCENTRAL_PLUGIN_FILENAME', plugin_basename(dirname(__FILE__) . '/rc-sms.php') ) ;
}
if(!defined('RINGCENTRAL_LOGO')){
    define ('RINGCENTRAL_LOGO', RINGCENTRAL_PLUGINURL . 'images/ringcentral-logo.png' ) ;
}

/* ====================================== */
/* bring in generic ringcentral functions */
/* ====================================== */
require_once("includes/rc-functions.inc");

/* ================================= */
/* set ring central supporting cast  */
/* ================================= */
function rc_js_add_script() {
    $js_path = RINGCENTRAL_PLUGINURL . 'js/ringcentral-scripts.js' ;
    wp_enqueue_script('ringcentral-js', $js_path) ;    
}
add_action('init', 'rc_js_add_script');

function rc_js_add_admin_script() {
    $js_path = RINGCENTRAL_PLUGINURL . 'js/ringcentral-admin-scripts.js' ;
    wp_enqueue_script('ringcentral-admin-js', $js_path) ;
}
add_action('admin_enqueue_scripts', 'rc_js_add_admin_script');

function rc_load_custom_admin_css() {
    wp_register_style( 'rc_custom_admin_css', 
        RINGCENTRAL_PLUGINURL . 'css/ringcentral-custom.css', 
        false, '1.0.0' );
    wp_enqueue_style( 'rc_custom_admin_css' );
}

add_action( 'admin_print_styles', 'rc_load_custom_admin_css' );

/* ========================================= */
/* Make top level menu                       */
/* ========================================= */
function rc_menu(){
    add_menu_page(
        'RC SMS: RingCentral Configurations',    // Page & tab title
        'RC SMS',                                // Menu title
        'manage_options',                           // Capability option
        'rc_Admin',                        // Menu slug
        'rc_config_page',                  // menu destination function call
        RINGCENTRAL_PLUGINURL . 'images/ringcentral-icon.png', // menu icon path
//         'dashicons-phone', // menu icon path from dashicons library
        25                                       // menu position level 
	);     
    add_submenu_page(
        'rc_Admin',                   // parent slug
        'RC SMS: RingCentral Configurations', // page title
        'Settings',                            // menu title - can be different than parent
        'manage_options',                      // options
        'rc_Admin'                    // menu slug to match top level (go to the same link)
    );
    add_submenu_page(
        'rc_Admin',                // parent menu slug
        'RC SMS: Send an SMS', // page title
        'Send an SMS',                  // menu title
        'manage_options',                   // capability
        'rc_send_sms',             // menu slug
        'rc_send_sms_page'       // callable function
    );    
}  

/* ========================================= */
/* page / menu calling functions             */
/* ========================================= */

// call add action func on menu building function above.
add_action('admin_menu', 'rc_menu');

// function for default Admin page
function rc_config_page() {
    // check user capabilities
    if (!current_user_can('manage_options')) { return; }
	?>    
    <div class="wrap">
        <img id='page_title_img' title="RingCentral Plugin" src="<?= RINGCENTRAL_LOGO ;?>">
        <h1 id='page_title'><?= esc_html(get_admin_page_title()); ?></h1>
        
        <?php require_once(RINGCENTRAL_PLUGINDIR . "includes/rc-config-page.inc"); ?>
        
    </div>
    <?php
}
// function for calling SMS page
function rc_send_sms_page() {
    // check user capabilities
    if (!current_user_can('manage_options')) { return; }
    ?>
    <div class="wrap">
        <img id='page_title_img' title="RingCentral Plugin" src="<?= RINGCENTRAL_LOGO ;?>">
        <h1 id='page_title'><?= esc_html(get_admin_page_title()); ?></h1>
        
        <?php require_once(RINGCENTRAL_PLUGINDIR . "includes/rc-send-sms-page.inc"); ?>
        
    </div>
    <?php
}

/* ========================================================== */ 
/* Add action for the ringcentral Embedded Phone app toggle   */
/* ========================================================== */
add_action('admin_footer', 'rc_embed_phone');	

/* =============================================== */
/* Add custom footer action                        */
/* This toggles the ringcentral Embedded Phone app */
/* =============================================== */
function rc_embed_phone() {
    global $wpdb;    
    $result_rc = $wpdb->get_row( $wpdb->prepare("SELECT `embedded_phone` 
        FROM `ringcentral_control`
        WHERE `ringcentral_control_id` = %d", 1)
    );    
    if ($result_rc->embedded_phone == 1) { ?>
    	<script src="https://ringcentral.github.io/ringcentral-embeddable-voice/adapter.js"></script>
    <?php } 
}

/* ============================================= */
/* Add registration hook for plugin installation */
/* ============================================= */
function rc_install() {
    require_once(RINGCENTRAL_PLUGINDIR . "includes/rc-install.inc");
}
/* ========================================= */
/* Create default pages on plugin activation */
/* ========================================= */
function rc_activation(){
    require_once(RINGCENTRAL_PLUGINDIR . "includes/rc-activation.inc");
}

register_activation_hook(__FILE__, 'rc_install');
register_activation_hook(__FILE__, 'rc_activation');

?>