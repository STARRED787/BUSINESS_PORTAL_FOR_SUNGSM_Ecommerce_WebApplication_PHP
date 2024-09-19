<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include('../include/connect.php');  // Ensure this path is correct
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUN GSM | Registration</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Anta&family=Barrio&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=RocknRoll+One&display=swap"
        rel="stylesheet">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
</head>

<style>
    .box {
        width: 930px;
    }

    .bg-body {
        background: red;
    }

    .font {
        font-family: "Anta";
    }
</style>

<body class="font" style="background: rgb(32, 30, 67)">

    <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-2">
        <div class="row rounded-5 p-3 bg-white shadow box w-100">
            <!-- Left Box -->
            <div
                class="col-md-6 col-12 rounded d-flex flex-column justify-content-center align-items-center p-3 mb-3 mb-md-0">
                <div class="featured-img mb-3">
                    <img src="./images/rgistration.jpg" class="img-fluid rounded-4 w-100">
                </div>
                <p class="fs-2 text-center">Registration</p>
                <a href="./user_login.php"><small class="text-wrap text-center">Already have an account? Login
                        here</small></a>
                <a href="../index/index.php"><small class="text-wrap text-center">Back to home, click here</small></a>
            </div>

            <!-- Right Box -->
            <div class="col-md-6 col-12">
                <div class="row align-items-center">
                    <div class="header-text mb-4 text-center">
                        <h4>SUN GSM Community</h4>
                    </div>

                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- username -->
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Enter your Username" id="username" name="username" required>
                        </div>
                        <!-- email -->
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Enter your Email" id="email" name="email" required>
                        </div>
                        <!-- user image -->
                        <label for="user_image" class="form-label">User Image</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control form-control-lg bg-light fs-6" id="user_image"
                                name="user_image" required>
                        </div>
                        <!-- password -->
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Type your password" id="password" name="password" required>
                        </div>
                        <!-- confirm password -->
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Type your password" id="confirm_password" name="confirm_password" required>
                        </div>
                        <!-- Address -->
                        <label for="address" class="form-label">Address</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Type your address" id="address" name="address" required>
                        </div>
                        <!-- mobile number -->
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Type your mobile number" id="mobile_number" name="mobile_number" required>
                        </div>

                        <!-- submit -->
                        <div class="btn mb-3">
                            <input type="submit" value="Register" class="bg-info py-2 px-3 rounded"
                                name="user_registration">
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- jQuery (required for Toastr) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            referrerpolicy="no-referrer"></script>

        <script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        </script>

</body>

</html>

<?php
if (isset($_POST['user_registration'])) {
    $user_username = $_POST['username'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $user_confirm_password = $_POST['confirm_password'];
    $user_address = $_POST['address'];
    $user_mobile_number = $_POST['mobile_number'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress(); // Use the function defined above

    // Check if passwords match
    if ($user_password != $user_confirm_password) {
        echo "<script>$(document).ready(function() { toastr.error('Password does not match'); });</script>";
        exit();
    }

    // Check if the user already exists by username or email
    $check_query = "SELECT * FROM `user` WHERE user_email = '$user_email' OR username = '$user_username'";
    $check_result = mysqli_query($con, $check_query);
    $rows_count = mysqli_num_rows($check_result);

    if ($rows_count > 0) {
        echo "<script>$(document).ready(function() { toastr.error('Username or Email already exists'); });</script>";
        exit();
    }

    // Handle the image upload (Add checks for the file upload)
    if (!empty($user_image)) {
        $image_extension = pathinfo($user_image, PATHINFO_EXTENSION);
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array(strtolower($image_extension), $allowed_extensions)) {
            echo "<script>$(document).ready(function() { toastr.error('Invalid image format. Allowed: JPG, JPEG, PNG, GIF'); });</script>";
            exit();
        }

        // Move the uploaded file to the desired folder
        if (!move_uploaded_file($user_image_tmp, "./user_images/$user_image")) {
            echo "<script>$(document).ready(function() { toastr.error('Failed to upload image.'); });</script>";
            exit();
        }
    } else {
        echo "<script>$(document).ready(function() { toastr.error('Please upload an image.'); });</script>";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $insert_query = "INSERT INTO `user` (username, user_email, password, user_image, user_ip, user_address, user_mobile)
                     VALUES ('$user_username', '$user_email', '$hashed_password', '$user_image', '$user_ip', '$user_address', '$user_mobile_number')";

    $insert_result = mysqli_query($con, $insert_query);

    if ($insert_result) {
        echo "<script>$(document).ready(function() { toastr.success('Registration Successful'); });</script>";
    } else {
        echo "<script>$(document).ready(function() { toastr.error('Error: " . mysqli_error($con) . "'); });</script>";
        exit();
    }

    // Check if the user has items in their cart
    $select_cart_items = "SELECT * FROM `cart` WHERE ip_address = '$user_ip'";
    $cart_items_result = mysqli_query($con, $select_cart_items);
    $cart_rows_count = mysqli_num_rows($cart_items_result);

    // If items exist in the cart, redirect to checkout, otherwise, redirect to home
    if ($cart_rows_count > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>$(document).ready(function() { 
            toastr.success('You have items in your cart');
            setTimeout(function() { window.location.href = 'checkout.php'; }, 2000); // Delay for 2 seconds
        });</script>";
    } else {
        $_SESSION['username'] = $user_username;
        echo "<script>$(document).ready(function() { 
            toastr.success('You have Not items in your cart');
            setTimeout(function() { window.location.href = '../index/index.php'; }, 2000); // Delay for 2 seconds
        });</script>";
    }
}
?>