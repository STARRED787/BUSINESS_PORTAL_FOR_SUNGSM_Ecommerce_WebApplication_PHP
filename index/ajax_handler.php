<?php
include('../include/connect.php');
include('../functions/common_function.php');
session_start();

// Check if a specific AJAX request is made
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'cart_count') {
        echo cart_item();
    } elseif ($_GET['action'] == 'total_price') {
        echo total_cart_price();
    }
}

function cart_item()
{
    global $con;
    $get_ip_add = getIPAddress();
    $select_query = "SELECT * FROM `cart` WHERE ip_address='$get_ip_add'";
    $result_query = mysqli_query($con, $select_query);
    $count_cart_items = mysqli_num_rows($result_query);
    return $count_cart_items;
}

function total_cart_price()
{
    global $con;
    $get_ip_add = getIPAddress();
    $total_price = 0;
    $cart_query = "SELECT * FROM `cart` WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = $row_product_price['product_price'];
            $total_price += $product_price;
        }
    }
    return $total_price;
}
?>