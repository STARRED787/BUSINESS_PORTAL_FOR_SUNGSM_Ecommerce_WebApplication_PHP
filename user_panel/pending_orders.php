<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

@session_start();

// Include database connection
include('../include/connect.php');  // Ensure this path is correct
require_once('../functions/common_function.php');  // Ensure this path is correct

// Check if the username exists in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    die('Username not found in session. Please login.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUN GSM</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./user_page.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM `user` WHERE username='$username'";
    $result = mysqli_query($con, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];
    ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-center" style="border-radius: 15px; font-family:Poppins;">
            <div class="card" style="width:100%;">
                <div class="card-body">
                    <?php

                    $get_orders_details = "SELECT * FROM `orders` WHERE user_id='$user_id'";
                    $result_orders = mysqli_query($con, $get_orders_details);
                    $order_count = mysqli_num_rows($result_orders); // Get the number of orders
                    $sl_order = 1;

                    if ($order_count > 0) {
                        echo " <h1 class='text-center'>Pending Orders</h1>";
                        echo '<div class="table-responsive">'; // Make the table responsive
                        echo '<table class="table table-bordered mt-5">';
                        echo '<thead class="table-primary">';
                        echo '<tr>';
                        echo '<th scope="col">Sl no</th>';
                        echo '<th scope="col">Order Number</th>';
                        echo '<th scope="col">Amount Due</th>';
                        echo '<th scope="col">Total Products</th>';
                        echo '<th scope="col">Invoice Number</th>';
                        echo '<th scope="col">Date</th>';
                        echo '<th scope="col">Status</th>';
                        echo '<th scope="col">Complete/Incomplete</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($row_orders = mysqli_fetch_assoc($result_orders)) {
                            $order_id = $row_orders['order_id'];
                            $order_amount_due = $row_orders['amount_due'];
                            $order_invoice_number = $row_orders['invoice_number'];
                            $order_order_date = $row_orders['order_date'];
                            $order_status = $row_orders['order_status'];

                            // Retrieve product details from orders_pending table
                            $get_pending_orders = "
                                SELECT op.product_id, op.quantity, p.product_price 
                                FROM `orders_pending` op 
                                JOIN `products` p ON op.product_id = p.product_id 
                                WHERE op.order_id='$order_id'";

                            $result_pending_orders = mysqli_query($con, $get_pending_orders);

                            $total_products = 0; // Initialize total products counter
                            $single_product_price = 0; // Initialize single product price variable
                            $calculated_total_products = 0; // Initialize calculated total products
                    
                            // Fetch product details
                            while ($row_pending_orders = mysqli_fetch_assoc($result_pending_orders)) {
                                $product_id = $row_pending_orders['product_id'];
                                $quantity = $row_pending_orders['quantity'];
                                $single_product_price = $row_pending_orders['product_price']; // Get the single product price
                    
                                // Calculate total products as order amount due divided by the price of one product
                                if ($single_product_price > 0) {
                                    $calculated_total_products = $order_amount_due / $single_product_price; // Calculate total products
                                } else {
                                    $calculated_total_products = 0; // Fallback if price is zero or not found
                                }
                            }

                            // Only display orders with status 'Pending'
                            if ($order_status == 'Pending') {
                                $order_status_display = "Incomplete";

                                echo "
                                    <tr class='table-info'>
                                        <td>$sl_order</td>
                                        <td>$order_id</td>
                                        <td>$order_amount_due</td>
                                        <td>" . round($calculated_total_products) . "</td> <!-- Show calculated total products -->
                                        <td>$order_invoice_number</td>
                                        <td>$order_order_date</td>
                                        <td>$order_status_display</td>
                                        <td class='text-center'><a href='./go_pay.php?order_id=$order_id' class='btn btn-primary btn-sm'>Confirm</a></td>
                                    </tr>";

                                $sl_order++;
                            }
                        }

                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>'; // End of table-responsive
                    } else {
                        echo "<div class='alert alert-warning' role='alert'>
                            No pending orders found.
                        </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
</body>

</html>