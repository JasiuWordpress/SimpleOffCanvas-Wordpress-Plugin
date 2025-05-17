<?php 
add_action('wp_footer', function() {
    echo '<pre>';
    var_dump( get_option('simpleoffcanvas_class') );
    echo '</pre>';
});
