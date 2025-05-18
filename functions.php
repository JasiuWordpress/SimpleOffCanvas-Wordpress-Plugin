<?php
function css_first_content($name) {
    return "
    /* Style your div here!
    
  Hi! This is a short guide on how to use this plugin –

What you see below are preloader presets – so if you know what you're doing, you can easily change them :D
The color, the spinning speed of the circle, or anything else.

Regarding button styling and the offcanvas menu:
The close button will always have the class: close_[your custom class name]

The open button will always have the class: open_[your custom class name]

Regarding popup styling:
The popup body will always have the class: offcanvas_body_[your custom class name]

The wrapper itself will always have the class: .offcanvas_wrap[your custom class name]

CSS is already included at the bottom, and you’re free to change the animations, colors, paddings, etc.

P.S.
hidebefore is a class that hides the preloader. Don’t touch it!

⚠️ Very important note:
Please keep in mind that your original class will be removed from the element after the popup is generated.
So, make sure to assign a separate, unused class for popup initialization – one that you haven’t used before for styling the element!
    
    */

    @media (max-width: 768px) {
        .{$name} {
            position: relative;
            max-height: 60px !important;
            overflow: hidden !important;
             border-radius: 20px !important;
        }
        .{$name}::before {
            content: ''!important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 60px !important;
            backdrop-filter: blur(15px) !important;
            -webkit-backdrop-filter: blur(5px) !important;
            background-color: rgba(255, 255, 255, 0.85) !important;
            z-index: 9999 !important;
            pointer-events: all !important;
            border-radius: 20px !important;
        }
        .{$name}::after {
            content: '';
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            width: 40px;
            height: 40px;
            border: 4px solid #ccc;
            border-top: 4px solid #333;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            z-index: 10000;
        }
        .offcanvas_wrap_".$name."[aria-hidden=\"true\"] {
            position: fixed;
            left: -100%; /* całkowicie poza ekranem */
            top: 0px!important;
            width: 90vw;
            height: 100vh;
             z-index: 9999;
            pointer-events: none;
            background-color:white!important; /* popup background */
            transition: 0.7s ease!important;
            overflow-y:auto!important;
        }

        .offcanvas_wrap_".$name."[aria-hidden=\"false\"] {
            position: fixed;
            top: 0px!important;
            left: 0;
            width: 90vw;
            height: 100vh;
            transition:  0.7s ease!important;
            z-index: 9999;
            background-color: white; /* popup background */
             overflow-y:auto!important;
        }
        .hide-before::before {
        content:none!important;
        }
         .hide-before::after {
        content:none!important;
        }

         @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
}
    ";
}






//callback creating custom css files
function create_files_callback($input){
    //usuwanie
    if(!empty($input)){
    $css_folder = plugin_dir_path(__FILE__) . 'Assets/custom_css_menus';
    $css_files = glob($css_folder . '/*.css');

    foreach($css_files as $cs){
        $filename = basename($cs, '.css');
        if(!in_array($filename,$input)){
             unlink($cs);
        }
    }
  

    if(is_array($input)){
        foreach($input as $key => $in){
            $name = sanitize_file_name($in);
            if(!empty($name) && $name != ""){
                $folder = plugin_dir_path(__FILE__) . 'Assets/custom_css_menus';
                $filepath = $folder . '/' . $name . '.css';
                  if(!file_exists($filepath)){
                    file_put_contents($filepath, css_first_content($name));
                  }
            }else{
                unset( $input[ $key ] );
            }
        }
    } else {
        $name = sanitize_file_name($input);
         $folder = plugin_dir_path(__FILE__) . 'Assets/custom_css_menus';
        $filepath = $folder . '/' . $name . '.css';

       if(!file_exists($filepath)){
            file_put_contents($filepath, "/* Style your div here!*\/");
        }
    }
    return $input; 
}else{
     $css_folder = plugin_dir_path(__FILE__) . 'Assets/custom_css_menus';
    $css_files = glob($css_folder . '/*.css');

    foreach($css_files as $cs){
        $filename = basename($cs, '.css');
             unlink($cs);
    }
}
}

function update_fils_callback($input){
    foreach ($input as $filename => $content) {
            $folder = plugin_dir_path(__FILE__) . 'Assets/custom_css_menus';
         $filepath = $folder . '/' . $filename;
        file_put_contents($filepath, $content);

}
   return $input;
}


//showing custom fields already made
function show_fields($fields){
      $folder = plugin_dir_path(__FILE__) . 'Assets/custom_css_menus';
if($fields){
    if(is_array($fields)){
        foreach($fields as $field){
            ?>  
            <div class="classes_wrap">

            <div class="class_parent">
                <h2 class="class_name"><?php echo $field ?></h2>
                <span class="toggle_switch"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="9" viewBox="0 0 14 9" fill="none"><path d="M13 1L7 8L1 1" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
            </div>
                
            <div class="class_info closed_accordeon">
                    <div class="class_css">
                        <?php 
                             $filepath = $folder . '/' . $field. '.css';
                             $zawartosc = file_get_contents($filepath);
                        ?>
                        <textarea name="css[<?php echo $field ?>.css]" class="custom_css"  id="<?php echo $field ?>.css"> <?php echo $zawartosc  ?></textarea>
                    </div>
                    
                    <div class="class_buttons_text">
                        <?php 
                       $close_btn_options = get_option('close_btn');
                       $close_value = isset($close_btn_options[$field]) ? $close_btn_options[$field] : null;

                       $open_btn_options = get_option('open_btn');
                       $open_value = isset($open_btn_options[$field]) ? $open_btn_options[$field] : null;

                        ?>
                        <h2 class="class_name"> Close and open button's text content</h2>
                        <div class="class_button">
                              <input type="text" name="close_btn[<?php echo $field ?>]" placeholder="Close button text" value="<?php echo $close_value ?>">
                        </div>
                        <div class="class_button">
                             <input type="text" name="open_btn[<?php echo $field ?>]" placeholder="Open button text" value="<?php echo $open_value ?>">
                        </div>
                    </div>

                
                    <div class="simpleoffcanvas_custom_div_menu">
                    <h2 class="warning">Copy your css before you change classname. ALL YOUR CSS WILL BE GONE OTHERWISE</h2>
                    <input type="text" name="simpleoffcanvas_class[]" placeholder="Write your's div class without a dot." value="<?php echo $field ?>">
                    <button class="delete_offcanvas">Delete</button>
                    </div>

            </div>

            </div>

            <?php
        }
    }
  }
}


// enqueowanie wszystkich cssow z custom_css_menus

add_action('wp_enqueue_scripts', 'custom_styles_enque');

function custom_styles_enque() {
    $css_folder = plugin_dir_path(__FILE__) . 'Assets/custom_css_menus';
    $css_files = glob($css_folder . '/*.css');
    
      foreach($css_files as $cs){
           $filename = basename($cs, '.css');
          wp_enqueue_style(
            "custom".$filename, // unikalna nazwa
            plugin_dir_url(__FILE__) . 'Assets/custom_css_menus/'.$filename.'.css'
    );
      }    
}







//dodawanie skryptu odpowiadającego za offcanvas
add_action('wp_enqueue_scripts', 'simpleoffcanvas_script');

function simpleoffcanvas_script(){
      wp_enqueue_script(
        'simple_offcanvas_js', 
        plugin_dir_url(__FILE__) . 'Assets/offcanvas.js'
    );

//wysylanie klas do jsa - offcanvas
$opcje = get_option('simpleoffcanvas_class');
$open_btns = get_option('open_btn');
$close_btns = get_option('close_btn');

wp_localize_script('simple_offcanvas_js', 'SimpleOffCanvasData', array(
   'klasy' => $opcje,
   'open_btns' => $open_btns,
   'close_btns' => $close_btns
));

}






