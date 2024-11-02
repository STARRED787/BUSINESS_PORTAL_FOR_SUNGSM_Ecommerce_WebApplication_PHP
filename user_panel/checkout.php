<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
// Database connection
include('../include/connect.php');
require_once('../functions/common_function.php');  // Ensure this path is correct

// Example order_id retrieval, ensure this is populated based on your application's logic
$order_id = $_GET['order_id'];  // Adjust as needed

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />

    <style>
        body {
            background-image: url('./images/pexels-emirkhan-bal-221704-953864.jpg');
            background-size: cover;
            background-position: center;
            color: #fff;
        }

        .payment-option {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            background: navy;
            /* Change to navy blue */
            color: #fff;
            transition: transform 0.3s ease;
            text-decoration: none;
            /* Remove underline from links */
        }

        .text {
            text-decoration: none;
            /* Remove underline from links */
        }

        .payment-option:hover {
            transform: scale(1.05);
        }

        .payment-option img {
            width: 100%;
            max-height: 180px;
            object-fit: contain;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .payment-option h3 {
            font-size: 1.5rem;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-5 text-dark"></h1>
        <div class="row justify-content-center">
            <!-- Cash on Delivery Option -->
            <div class="col-md-4 mb-4">
                <a class="text" href="./go_pay.php?order_id=<?php echo $order_id ?>">
                    <div class="payment-option">
                        <img src="./images/bearded-delivery-man-red-uniform-cap-holding-box-package-making-call-me-gesture-smiling-standing-orange-wall_141793-48121.jpg"
                            alt="Cash on Delivery">
                        <h3>Cash on Delivery</h3>
                        <p>Pay at the time of delivery. Safe and easy for all customers.</p>
                    </div>
                </a>
            </div>

            <!-- Online Payment Option -->
            <div class="col-md-4 mb-4">
                <a class="text" href="./online_pay.php?order_id=<?php echo $order_id ?>">
                    <div class="payment-option">
                        <img src="./images/hand-showing-credit-card-laptop_23-2148304996.jpg" alt="Online Payment">
                        <h3>Online Payment</h3>
                        <p>Secure online payments for a faster, convenient experience.</p>
                    </div>
                </a>
            </div>
        </div>


    </div>

    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
</body>

</html>