<?php 
if (!defined('ABSPATH')) exit;
require_once('admin_page.php');
/*
 * Plugin Name: SimpleOffCanvas
 * Plugin URI: https://github.com/JasiuWordpress/SimpleOffCanvas-Wordpress-Plugin
 * Description: A lightweight plugin that allows developers to turn any div into a responsive offcanvas menu with fully customizable CSS.
 * Version: 1.0.0
 * Author: Jan Pańkowski Simplepage.pl
 * Author URI: https://simplepage.pl
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simpleoffcanvas
 * Domain Path: /languages
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
        'dashicons-menu',
        30
    );
 });


 