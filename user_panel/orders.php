<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@session_start();
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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@session_start();
// Include database connection
include('../include/connect.php');  // Ensure this path is correct
require_once('../functions/common_function.php');  // Ensure this path is correct

// Getting user_id from GET request (ensure this is safe)
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Getting IP address
$get_ip_add = getIPAddress();
$total_price = 0;

// Query to get cart items based on IP address
$cart_query_price = "SELECT * FROM `cart` WHERE ip_address='$get_ip_add'";
$result_cart_price = mysqli_query($con, $cart_query_price);

// Getting total products count
$count_products = mysqli_num_rows($result_cart_price);

// Generating an invoice number
$invoice_number = mt_rand();

// Default order status
$order_status = "Pending";

// Loop through the cart to calculate total price and insert orders
while ($row_cart_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_cart_price['product_id'];
    $quantity = $row_cart_price['quantity']; // Get the quantity directly from the cart

    // Get product price
    $select_product = "SELECT * FROM `products` WHERE product_id='$product_id'";
    $run_product = mysqli_query($con, $select_product);

    if ($row_product = mysqli_fetch_array($run_product)) {
        $product_price = $row_product['product_price'];
        $subtotal = $product_price * $quantity; // Calculate subtotal for this product
        $total_price += $subtotal; // Accumulate total price

        // Insert order into the orders table
        $insert_orders = "INSERT INTO `orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status) 
                          VALUES ('$user_id', '$subtotal', '$invoice_number', '$quantity', NOW(), '$order_status')";
        $result_query = mysqli_query($con, $insert_orders);

        // Check if the insert was successful
        if ($result_query) {
            echo "<script>$(document).ready(function() { 
                toastr.success('Order has been successfully placed');
                setTimeout(function() { window.open('profile.php?pending_orders','_self'); }, 2000);
            });</script>";
        } else {
            echo "<script>$(document).ready(function() { 
                toastr.error('Order has not been placed successfully');
                setTimeout(function() { window.open('shop.php','_self'); }, 2000);
            });</script>";
        }

        // Insert pending orders
        $insert_pending_orders = "INSERT INTO `orders_pending` (user_id, invoice_number, product_id, quantity, order_status) 
                                   VALUES ('$user_id', '$invoice_number', '$product_id', '$quantity', '$order_status')";
        $result_pending = mysqli_query($con, $insert_pending_orders);
    }
}

// Deleting cart items after placing the order
$delete_cart = "DELETE FROM `cart` WHERE ip_address='$get_ip_add'";
$result_delete = mysqli_query($con, $delete_cart);
?>