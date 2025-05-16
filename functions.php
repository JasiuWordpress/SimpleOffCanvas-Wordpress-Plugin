<?php

//callback creating custom css files
function create_files_callback($input){
    //usuwanie
    $css_folder = plugin_dir_path(__FILE__) . 'Assets/custom_css_menus';
    $css_files = glob($css_folder . '/*.css');

    foreach($css_files as $cs){
        $filename = basename($cs, '.css');
        if(!in_array($filename,$input)){
             unlink($cs);
        }
    }

    if(is_array($input)){
        foreach($input as $in){
            $name = sanitize_file_name($in);
            if(!empty($name)){
                $folder = plugin_dir_path(__FILE__) . 'Assets/custom_css_menus';
                $filepath = $folder . '/' . $name . '.css';
                  if(!file_exists($filepath)){
                    file_put_contents($filepath, "/* Style your div here!*/");
                  }
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

                
                    <div class="simpleoffcanvas_custom_div_menu">
                    <h2 class="warning">Copy your css before you change classname. ALL YOUR CSS WILL BE GONE OTHERWISE</h2>
                    <input type="text" name="simpleoffcanvas_class[]" placeholder="Write your's div class without a dot." value="<?php echo $field ?>">
                    </div>

            </div>

            </div>

            <?php
        }
    }else{
        ?>
             <div class="simpleoffcanvas_custom_div_menu">
                <input type="text" name="simpleoffcanvas_class[]" placeholder="Write your's div class without a dot." value="<?php echo $fields ?>">
                </div>
        <?php
    }
  }
}