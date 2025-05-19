<?php
if (!defined('ABSPATH')) exit;
require_once plugin_dir_path(__FILE__) . 'functions.php';


function my_plugin_editor_assets($hook) {
    if ($hook !== 'toplevel_page_simpleoffcanvas_settings') return;

    // CodeMirror z WordPressa (wbudowany od wersji 4.9+)
    wp_enqueue_code_editor(['type' => 'text/css']);
    wp_enqueue_script('wp-theme-plugin-editor');
    wp_enqueue_style('wp-codemirror');
}
add_action('admin_enqueue_scripts', 'my_plugin_editor_assets');



function simpleoffcanvas_settings_page(){
    $logo_url = plugins_url('Assets/logo/simplepage.webp', __FILE__);
    $options = get_option('simpleoffcanvas_class');

     ?>
        <div class="head_simpleoffcanvas">
            <a href="https://simplepage.pl/" target="_blank">
            <img class="simplepage_logo" src="<?php echo $logo_url ?>" alt="simplepage.pl">
            </a>
            <h2 class="simpleoffcanvas_pluginname">SimpleOffCanvas - make any div a off canvas menu on mobile</h2>
        </div>
     <form method="post" action="options.php">
        <?php
     settings_fields('simpleoffcanvas_group');
     do_settings_sections('simpleoffcanvas_group');
     ?>
        <div class="simpleoffcanvas_parent">
            <?php 
            //sprawdzanie po css files
            if(!$options){
                echo '<p class="no_divs_p">You didn\'t add your divs yet, click Add new one button</p>';
            }else{
                show_fields($options);
            }

          ?>
            <button class="addmore">Add new one</button>
        </div>
            <?php submit_button(); ?>
     </form>
     <?php    
}
add_action('admin_init', function () {
        register_setting('simpleoffcanvas_group', 'simpleoffcanvas_class', [
        'sanitize_callback' => 'create_files_callback'
        ]);

         register_setting('simpleoffcanvas_group', 'css', [
        'sanitize_callback' => 'update_fils_callback'
        ]);

        register_setting('simpleoffcanvas_group', 'close_btn');
        register_setting('simpleoffcanvas_group', 'open_btn');


    });