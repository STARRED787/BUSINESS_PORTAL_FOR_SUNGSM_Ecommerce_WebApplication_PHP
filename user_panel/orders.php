<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include('../include/connect.php');  // Ensure this path is correct
require_once('../functions/common_function.php');  // Ensure this path is correct
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
</head>

<body>
    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
</body>

</html>
<?php
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

//getting ip address
$get_ip_add = getIPAddress();
$total_price = 0;
$cart_query_price = "SELECT * FROM `cart` WHERE ip_address='$get_ip_add'";
$result_cart_price = mysqli_query($con, $cart_query_price);

//getting total products
$count_products = mysqli_num_rows($result_cart_price);

//getting inoice number
$invoice_number = mt_rand();

//getting status
$order_status = "Pending";

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

    //getting quantity from cart
    $get_cart = "SELECT *FROM `cart`";
    $run_cart = mysqli_query($con, $get_cart);
    $get_item_quantity = mysqli_fetch_array($run_cart);
    $quantity = $get_item_quantity['quantity'];
    if ($quantity == 0) {
        $quantity = 1;
        $subtotal = $total_price;
    } else {
        $quantity = $total_price;
        $subtotal = $total_price * $quantity;
    }

    //inserting order into database
    $insert_orders = "INSERT INTO `orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status) 
    VALUES ( $user_id, $subtotal, $invoice_number, $count_products, NOW(), 'Pending')";
    $result_query = mysqli_query($con, $insert_orders);
    if ($result_query) {
        echo "<script>$(document).ready(function() { 
            toastr.success('Order has been successfully');
            setTimeout(function() { window.open('profile.php','_self'); }, 2000); // Delay for 2 seconds
        });</script>";
    } else {
        echo "<script>$(document).ready(function() { 
            toastr.success('Order has been successfully');
            setTimeout(function() { window.open('profile.php','_self'); }, 2000); // Delay for 2 seconds
        });</script>";
    }

}
?>