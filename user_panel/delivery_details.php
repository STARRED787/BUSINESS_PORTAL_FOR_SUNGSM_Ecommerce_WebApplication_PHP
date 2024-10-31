<?php
include('../include/connect.php'); // Include database connection

// Start session to get user ID
session_start();
if (!isset($_SESSION['username'])) {
    die('You must be logged in to access this page.');
}

// Fetch the user's details from session
$username = $_SESSION['username'];
$get_user = "SELECT * FROM `user` WHERE username='$username'";
$result_user = mysqli_query($con, $get_user);
$user_data = mysqli_fetch_assoc($result_user);
$user_id = $user_data['user_id'];
$contact_number = $user_data['user_mobile']; // Fetch contact number from user table
$delivery_address = $user_data['user_address']; // Fetch address from user table

// Get the order ID from URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
} else {
    die('Order ID not provided.');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Delivery Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Enter Delivery Details</h2>

        <div class="card rounded-5">
            <div class="card-body rounded-5" style="background-color:#bdffbf;">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="delivery_address" class="form-label">Delivery Address</label>
                        <input type="text" name="delivery_address" class="form-control" id="delivery_address"
                            value="<?php echo htmlspecialchars($delivery_address); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" id="contact_number"
                            value="<?php echo htmlspecialchars($contact_number); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="shipping_method" class="form-label">Shipping Method</label>
                        <select name="shipping_method" id="shipping_method" class="form-control">
                            <option value="Standard">Standard</option>
                            <option value="Express">Express</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="delivery_partner" class="form-label">Delivery Partner</label>
                        <select name="delivery_partner" id="delivery_partner" class="form-control">
                            <option value="Prompt Express">Prompt Express</option>
                        </select>
                    </div>

                    <button type="submit" class="btn text-dark fw-bold" style="background-color:#fc8505;">Submit
                        Delivery Details</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
</body>

</html>

<?php

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $delivery_address = mysqli_real_escape_string($con, $_POST['delivery_address']);
    $contact_number = mysqli_real_escape_string($con, $_POST['contact_number']);
    $shipping_method = mysqli_real_escape_string($con, $_POST['shipping_method']);
    $delivery_partner = mysqli_real_escape_string($con, $_POST['delivery_partner']);

    // Check if delivery details already exist for this order and user
    $check_delivery = "SELECT * FROM delivery_details WHERE user_id='$user_id' AND order_id='$order_id'";
    $result_check = mysqli_query($con, $check_delivery);

    if (mysqli_num_rows($result_check) > 0) {
        // Delivery details already exist
        echo "<script>
        $(document).ready(function() { 
            toastr.warning('Delivery details already exist for this order.');
        });
    </script>";
    } else {
        // Insert delivery details into the database
        $insert_delivery = "INSERT INTO delivery_details (user_id, order_id, delivery_address, contact_number, shipping_method, delivery_partner) 
                            VALUES ('$user_id', '$order_id', '$delivery_address', '$contact_number', '$shipping_method', '$delivery_partner')";
        $result_insert = mysqli_query($con, $insert_delivery);

        if ($result_insert) {
            echo "<script>
            $(document).ready(function() { 
                toastr.success('Order Delivered Successfully!');
                setTimeout(function() { window.open('./confirm_payement.php?order_id=$order_id&user_id=$user_id', '_self'); }, 2000); // Delay for 2 seconds
            });
        </script>";
        } else {
            echo "<script>
            $(document).ready(function() { 
                toastr.error('Error delivering the order.');
            });
        </script>";
        }
    }
}

?>