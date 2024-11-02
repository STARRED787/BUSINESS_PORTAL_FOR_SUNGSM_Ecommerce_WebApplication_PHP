<?php
// Example: cod_intro.php
include('../include/connect.php');
// Start session or any required user information retrieval
session_start();
// Check if the username exists in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // If no username in the session, stop execution and show an error message
    die('Username not found in session. Please login.');
}


// Get the order ID from the URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
} else {
    // If no order ID is found, redirect to a different page or display an error
    die('Order ID not found. Please go back and select an order.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash on Delivery</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Anta&family=Barrio&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=RocknRoll+One&display=swap");

    .blur-effect {
        background-color: rgba(255, 255, 255, 0.3);
        /* Semi-transparent background */
        backdrop-filter: blur(10px);
        /* Applies blur to the background */
        padding: 20px;
        border-radius: 10px;
    }

    .font {
        font-family: "Poppins";
    }
</style>

<body style="background-image: url('./images/dlevey.jpg'); background-attachment: fixed; background-position:center">


    <!---- PHP code to get User Id to access orders table----->

    <?php
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM `user` WHERE username='$username'";
    $result = mysqli_query($con, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];
    //echo $user_id;
    ?>
    <div class="container mt-5">
        <div class="card blur-effect font justify-content-center"> <!-- Apply blur to the whole card -->
            <div class="card-header">
                <h1 class="card-title text-center">Cash on Delivery (COD)</h1>
            </div>
            <div class="card-body  fw-bold">
                <p class="card-text">
                    Thank you for choosing Cash on Delivery. With COD, you can pay for your order when it's delivered.
                    Please ensure that you have the exact amount ready when your order arrives. Our delivery partner
                    will contact you prior to delivery, and you will have the opportunity to review
                    your order details before payment.
                    Once you're ready to proceed, click the button below to provide your delivery details.
                </p>
                <p class="card-text">

                </p>
                <div class="text-center">
                    <?php
                    // Fetching order details from database
                    $get_orders_details = "SELECT * FROM `orders` WHERE order_id='$order_id'";
                    $result_orders = mysqli_query($con, $get_orders_details);

                    if ($result_orders && mysqli_num_rows($result_orders) > 0) {
                        $row_orders = mysqli_fetch_assoc($result_orders);
                        $order_id = $row_orders['order_id'];
                    }
                    ?>
                    <a href="delivery_details.php?order_id=<?php echo $order_id; ?>" class="btn  blur-effect">Proceed to
                        Delivery Details</a>
                    <a href="profile.php?pending_orders" class="btn  blur-effect m-2"> Back</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>