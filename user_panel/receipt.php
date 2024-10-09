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

// Fetch order and delivery details
$get_order = "SELECT * FROM `orders` WHERE order_id='$order_id'";
$result_order = mysqli_query($con, $get_order);
$order_data = mysqli_fetch_assoc($result_order);

// Fetch delivery details
$get_delivery = "SELECT * FROM `delivery_details` WHERE order_id='$order_id'";
$result_delivery = mysqli_query($con, $get_delivery);
$delivery_data = mysqli_fetch_assoc($result_delivery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Order Receipt</h2>
            </div>
            <div class="card-body">
                <h4>User Details</h4>
                <p><strong>Name:</strong> <?php echo $user_data['username']; ?></p>
                <p><strong>Email:</strong> <?php echo $user_data['user_email']; ?></p>

                <h4>Order Details</h4>
                <p><strong>Order ID:</strong> <?php echo $order_data['order_id']; ?></p>
                <p><strong>Total Amount:</strong> <?php echo "Rs " . $order_data['amount_due']; ?></p>

                <h4>Delivery Details</h4>
                <p><strong>Address:</strong> <?php echo $delivery_data['delivery_address']; ?></p>
                <p><strong>Contact Number:</strong> <?php echo $delivery_data['contact_number']; ?></p>
                <p><strong>Shipping Method:</strong> <?php echo $delivery_data['shipping_method']; ?></p>

                <!-- Button to print the receipt -->
                <div class="text-center mt-4">
                    <button onclick="window.print()" class="btn btn-primary">Print Receipt</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>