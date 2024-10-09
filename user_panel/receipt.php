<?php
include('../include/connect.php'); // Include database connection

// Get the user ID and order ID from the URL
if (isset($_GET['order_id']) && isset($_GET['user_id'])) {
    $order_id = $_GET['order_id'];
    $user_id = $_GET['user_id'];
} else {
    die('Order ID or User ID not provided.');
}

// Fetch user details
$get_user = "SELECT * FROM `user` WHERE user_id='$user_id'";
$result_user = mysqli_query($con, $get_user);
$user_data = mysqli_fetch_assoc($result_user);

// Fetch order details
$get_order = "SELECT * FROM `orders` WHERE order_id='$order_id'";
$result_order = mysqli_query($con, $get_order);
$order_data = mysqli_fetch_assoc($result_order);

// Fetch delivery details
$get_delivery = "SELECT * FROM `delivery_details` WHERE order_id='$order_id'";
$result_delivery = mysqli_query($con, $get_delivery);
$delivery_data = mysqli_fetch_assoc($result_delivery);

// Fetch ordered products from orders_pending and join with products
$get_order_products = "SELECT p.product_tittle, p.product_price, op.quantity 
                       FROM `orders_pending` op
                       JOIN `products` p ON op.product_id = p.product_id 
                       WHERE op.order_id='$order_id'";
$result_order_products = mysqli_query($con, $get_order_products);

// Shop details (static for now)
$shop_email = "shop@example.com";
$shop_address = "123, Main Street, Colombo, Sri Lanka";
$invoice_number = $order_data['invoice_number'];
$date = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }

            footer {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Order Receipt</h2>
                <h4>SUNGSM Shop</h4>
            </div>
            <div class="card-body row">
                <div class="col-md-6">
                    <!-- Shop Details on the left -->
                    <div>
                        <p><strong>Invoice Number:</strong> <?php echo $invoice_number; ?></p>
                        <p><strong>Date:</strong> <?php echo $date; ?></p>
                        <p><strong>Shop Email:</strong> <?php echo $shop_email; ?></p>
                        <p><strong>Shop Address:</strong> <?php echo $shop_address; ?></p>
                    </div>

                    <!-- User Details -->
                    <h4>User Details</h4>
                    <p><strong>Name:</strong> <?php echo $user_data['username']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user_data['user_email']; ?></p>

                    <!-- Delivery Details -->
                    <h4>Delivery Details</h4>
                    <p><strong>Address:</strong> <?php echo $delivery_data['delivery_address']; ?></p>
                    <p><strong>Contact Number:</strong> <?php echo $delivery_data['contact_number']; ?></p>
                    <p><strong>Shipping Method:</strong> <?php echo $delivery_data['shipping_method']; ?></p>
                </div>

                <div class="col-md-6">
                    <!-- Ordered Products -->
                    <h4>Ordered Products</h4>
                    <ul class="list-group">
                        <p><strong>Order ID:</strong> <?php echo $order_data['order_id']; ?></p>

                        <?php while ($product_data = mysqli_fetch_assoc($result_order_products)) { ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><?php echo $product_data['product_tittle']; ?>
                                    (x<?php echo $product_data['quantity']; ?>)</span>
                                <span>Rs
                                    <?php echo number_format($product_data['product_price'] * $product_data['quantity'], 2); ?></span>
                            </li>
                        <?php } ?>
                        <p class="text-end mt-3"><strong>Total Amount:</strong>
                            <?php echo "Rs " . number_format($order_data['amount_due'], 2); ?></p>
                    </ul>
                </div>
            </div>

            <!-- Button to print the receipt -->
            <div class="text-center mt-4 no-print ">
                <button onclick="window.print()" class="btn btn-primary">Print Receipt</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap