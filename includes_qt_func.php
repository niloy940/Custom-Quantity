<?php

/**
 * Adjust the quantity input values
 */
function jk_woocommerce_quantity_input_args($args, $product)
{
    global $quantity;

    if (is_singular('product')) {
        $args['input_value']    = $quantity;    // Starting value (we only want to affect product pages, not cart)
    }
    $args['max_value']  = 50000;   // Maximum value
    $args['min_value']  = 100;    // Minimum value
    $args['step']       = 2;    // Quantity steps
    return $args;
}
add_filter('woocommerce_quantity_input_args', 'jk_woocommerce_quantity_input_args', 10, 2);



function qt_custom_add_to_cart()
{
    $cookie_quantity = (int) $_COOKIE['quantity'];

    global $woocommerce;
    foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
        $woocommerce->cart->set_quantity($cart_item_key, $cookie_quantity);
    }
}
add_action('woocommerce_add_to_cart', 'qt_custom_add_to_cart');


/**
 * Add custom price in cart
 */
add_action('woocommerce_before_calculate_totals', 'add_custom_price', 10, 1);
function add_custom_price($cart_object)
{
    if (is_admin() && ! defined('DOING_AJAX')) {
        return;
    }

    foreach ($cart_object->get_cart() as $hash => $value) {
        $cart_quantity = $value['quantity'];
    }

    foreach ($cart_object->get_cart() as $cart_item) {
        // Price calculation
        // $price = $cart_item['data']->get_price();

        if ($cart_quantity <= 249) {
            $price = 0.69;
        } elseif ($cart_quantity >= 250 && $cart_quantity <= 499) {
            $price = 0.59;
        } elseif ($cart_quantity >= 500 && $cart_quantity <= 999) {
            $price = 0.55;
        } elseif ($cart_quantity >= 1000) {
            $price = 0.49;
        } else {
            $price = 0.69;
        }
        $cart_item['data']->set_price($price); // WC 3.0+
    }
}
