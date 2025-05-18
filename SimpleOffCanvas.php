<?php 
require_once('admin_page.php');
/*
 * Plugin Name: SimpleOffCanvas
 */

add_action('admin_enqueue_scripts', 'admin_css_enque');

function admin_css_enque() {
    // CSS do <head>
    wp_enqueue_style(
        'admin_css_simpleoffcanvas', // unikalna nazwa
        plugin_dir_url(__FILE__) . 'Assets/admin_page.css'
    );

      wp_enqueue_script(
        'admin_js_simpleoffcanvas', // unikalna nazwa
        plugin_dir_url(__FILE__) . 'Assets/admin_page.js'
    );
}



 add_action('admin_menu', function(){
    add_menu_page(
        'SimpleOffCanvas',
        'SimpleOffCanvas',
        'manage_options',
        'simpleoffcanvas_settings',
        'simpleoffcanvas_settings_page',
        'dashicons-format-chat',
        30
    );
 });


 