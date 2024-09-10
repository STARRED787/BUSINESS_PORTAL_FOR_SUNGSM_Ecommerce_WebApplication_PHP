<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include('../include/connect.php');  // Ensure this path is correct
require_once('../functions/common_function.php');  // Ensure this path is correct

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

//getting total items and total price of the cart
$get_ip_add = getIPAddress();
$total_price = 0;
$cart_query_price = "SELECT * FROM `cart` WHERE ip_address='$get_ip_add'";
$result_cart_price = mysqli_query($con, $cart_query_price);
$count_products = mysqli_num_rows($result_cart_price);

//getting total items
while ($row_cart_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_cart_price['product_id'];
    $select_product = "SELECT * FROM `products` WHERE product_id='$product_id'";
    $run_product = mysqli_query($con, $select_product);

    //getting total price   
    while ($row_product = mysqli_fetch_array($run_product)) {
        $product_price = array($row_product['product_price']);
        $values = array_sum($product_price);
        $total_price += $values;
    }
}
?>