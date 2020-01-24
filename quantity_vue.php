<?php
/**
 * Plugin Name: Custom Quantity
 * Description: Woocommerce Product Page Development.
 * Version: 1.7.2
 * Author: Niloy Quazi
 * Author URI: https://www.linkedin.com/in/niloyquazi/
 */

//Register scripts to use
function func_load_qt_scripts()
{
    wp_register_script('qt_wpvue_vuejs', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js');
    wp_register_script('qt_my_vuecode', plugin_dir_url(__FILE__).'assets/js/qt_vue_code.js', 'qt_wpvue_vuejs', true);
}
//Tell WordPress to register the scripts
add_action('wp_enqueue_scripts', 'func_load_qt_scripts');



function func_load_axios_scripts()
{
    wp_enqueue_script('qt_axios', 'https://unpkg.com/axios/dist/axios.min.js');
    wp_register_script('qt_axios_script', plugin_dir_url(__FILE__).'assets/js/qt_vue_code.js', 'qt_axios', true);
}
//Tell WordPress to register the scripts
add_action('wp_enqueue_scripts', 'func_load_axios_scripts');



include_once 'qt_fornt_end.php';

include_once 'includes_qt_func.php';



//hide quantity field in product page
function quantity_wp_head()
{
    if (is_product()) {
        ?>
        <style type="text/css">.quantity, .buttons_added { width:0; height:0; display: none; visibility: hidden; }</style>
        <?php
    }
}
add_action('wp_head', 'quantity_wp_head');
