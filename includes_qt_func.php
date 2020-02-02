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
    // $args['max_value']  = 500000;   // Maximum value

    $args['min_value']  = $quantity;

    $args['step']       = 1;    // Quantity steps
    return $args;
}
add_filter('woocommerce_quantity_input_args', 'jk_woocommerce_quantity_input_args', 10, 2);


/**
 * Add custom price in cart
 */
add_action('woocommerce_before_calculate_totals', 'add_custom_price', 10, 1);
function add_custom_price($cart_object)
{
    if (is_admin() && ! defined('DOING_AJAX')) {
        return;
    }

    // foreach ($cart_object->get_cart() as $hash => $value) {
    //     $cart_quantity = $value['quantity'];
    // }

    foreach (WC()->cart->get_cart() as $cart_item) {
        if ($cart_item['product_id'] == 11) {
            $cart_qty =  $cart_item['quantity'];
        } elseif ($cart_item['product_id'] == 21) {
            $cart_quantity = $cart_item['quantity'];
        }
    }

    foreach ($cart_object->get_cart() as $cart_item) {
        // Price calculation
        $sale_price = $cart_item['data']->get_price();

        $product_id = $cart_item['product_id'];

        // Pen Klasico
        if ($product_id == 11) {
            if ($cart_qty >= 100 && $cart_qty <= 249) {
                $price = $sale_price;
            } elseif ($cart_qty >= 250 && $cart_qty <= 499) {
                $price = 0.59;
            } elseif ($cart_qty >= 500 && $cart_qty <= 999) {
                $price = 0.55;
            } elseif ($cart_qty >= 1000) {
                $price = 0.49;
            } else {
                $price = $sale_price;
            }

            $cart_item['data']->set_price($price);
        }

        // Pen Artio
        if ($product_id == 21) {
            if ($cart_quantity >= 25 && $cart_quantity <= 49) {
                $price = $sale_price;
            } elseif ($cart_quantity >= 50 && $cart_quantity <= 74) {
                $price = 5.49;
            } elseif ($cart_quantity >= 75 && $cart_quantity <= 99) {
                $price = 5.10;
            } elseif ($cart_quantity >= 100) {
                $price = 4.99;
            } else {
                $price = $sale_price;
            }

            $cart_item['data']->set_price($price);
        }
    }
}
