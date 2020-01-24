<?php

function qt_show_quantity()
{
    wp_enqueue_script('qt_wpvue_vuejs');
    wp_enqueue_script('qt_my_vuecode');

    global $product;

    $sale_price = $product->get_sale_price();

    global $quantity;
    $quantity = 200;

    echo "<div id='quantity_el'>"
    .'<br>'
    .'<calc :price="'. $sale_price .'" :quantity="'. $quantity .'"></calc>'
    .'</div>'
    .'<br>';
}
add_action('woocommerce_before_add_to_cart_button', 'qt_show_quantity');
