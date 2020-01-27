<?php

function qt_show_quantity()
{
    wp_enqueue_script('qt_wpvue_vuejs');
    wp_enqueue_script('qt_my_vuecode');

    global $product;
    $product_id = $product->get_id();
    $sale_price = $product->get_sale_price();

    global $quantity;

    if ($product_id == 11) {
        $quantity = 100;
    } elseif ($product_id == 21) {
        $quantity = 25;
    }

    echo "<div id='quantity_el'>"
    .'<br>'
    .'<calc :product_id="'. $product_id .'" :price="'. $sale_price .'" :quantity="'. $quantity .'"></calc>'
    .'</div>'
    .'<br>';
}
add_action('woocommerce_before_add_to_cart_button', 'qt_show_quantity');
