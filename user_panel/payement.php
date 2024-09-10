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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUN GSM | Payment</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Anta&family=Barrio&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=RocknRoll+One&display=swap"
        rel="stylesheet">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
</head>

<body>
    <!--php code to access user id -->
    <?php
    // Ensure the getIPAddress() function is defined
    $user_ip = getIPAddress(); // Define the function if not already done
    $get_user = "SELECT * FROM `user` WHERE user_ip = '$user_ip'";
    $run_user = mysqli_query($con, $get_user);
    $run_query = mysqli_fetch_array($run_user);
    $user_id = $run_query['user_id'];
    ?>

    <!-- Payment Options Section -->
    <div class="d-flex flex-column align-items-center justify-content-center">
        <h1 class="text-center mb-4">Payment Options</h1> <!-- Centered title with margin-bottom -->
        <div class="row justify-content-center">
            <!-- Column for Pay Online -->
            <div class="col-md-4 col-8 text-center mb-4">
                <h2>Pay Online</h2>
                <a href="https://www.paypal.com" target="_blank">
                    <img src="./images/e-wallet-digital-payment-online-transaction-with-woman-standing-and-holding-mobile-phone-concept-illustration-free-vector.jpg"
                        alt="Pay Online Image" class="img-fluid" width="50%">
                </a>
            </div>
            <!-- Column for Pay Offline -->
            <div class="col-md-4 col-8 text-center mb-4">
                <h2>Delevery</h2>
                <a href="./delevery.php?user_id=<?php echo $user_id ?>">
                    <img src="./images/Delever.jpg" alt="Pay Offline Image" class="img-fluid" width="50%">
                </a>
            </div>

            <!-- Column for Process Order -->
            <div class="col-md-4 col-8 text-center mb-4">
                <h2>Process Order</h2>
                <a href="./orders.php?user_id=<?php echo $user_id ?>">
                    <img src="./images/offline.jpg" alt="Pay Offline Image" class="img-fluid" width="50%">
                </a>
            </div>
        </div>
    </div>

    <!-- Call cart function and search product -->
    <?php
    // Ensure that the cart() and search_Product() functions are only outputting what they need
    cart();
    search_Product();
    ?>


    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
</body>

</html>