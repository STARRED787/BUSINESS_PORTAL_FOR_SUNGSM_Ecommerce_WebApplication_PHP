<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include('../include/connect.php');  // Ensure this path is correct
require_once('../functions/common_function.php');  // Ensure this path is correct

@session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUN GSM | Login</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="index.css" />

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

<body class="font" style=" background:rgb(32, 30, 67)">

    <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-2">
        <div class="row rounded-5 p-3 bg-white shadow box w-100">
            <!-- Left Box -->
            <div
                class="col-md-6 col-12 rounded d-flex flex-column justify-content-center align-items-center p-3 mb-3 mb-md-0">
                <div class="featured-img mb-3">
                    <img src="./images/rgistration.jpg" class="img-fluid mt-2 rounded-4 w-100">
                    <p class="fs-2 text-center">Login</p>
                </div>

            </div>

            <!-- Right Box -->
            <div class="col-md-6 col-12 ">
                <div class="row align-items-center">
                    <div class="header-text mb-4 text-center">
                        <h4>SUN GSM Community</h4>

                    </div>

                    <form action="" method="post">
                        <!-- username -->
                        <label for="username" class="form-label"> Username</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Enter your Username" id="username" name="username" required>
                        </div>

                        <!-- password -->
                        <label for="password" class="form-label"> Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg bg-light fs-6"
                                placeholder="type your password" id="password" name="password" required>

                        </div>
                        <!-- submit-->

                        <div class="btn mb-3">
                            <input type="submit" value="Login" class="bg-info py-2 px-3 rounded" name="user_login">
                        </div>


                    </form>
                    <a href="user_registration.php"><small class="text-wrap text-center">You have not acount
                            Registraion
                            here </small></a>
                    <a href="../index/index.php"><small class="text-wrap text-center">Back to home click here
                        </small></a>

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

<!--PHP code for Loging Logic-->
<?php
if (isset($_POST['user_login'])) {
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    $select_query = "SELECT * FROM user WHERE username='$user_username'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();

    // Check if user exists
    if ($rows_count > 0) {
        if (password_verify($user_password, $row['password'])) {
            // Set session variables
            $_SESSION['username'] = $user_username;
            $_SESSION['user_id'] = $row['user_id']; // Store user_id in the session

            // Check if the cart has items
            $select_query_cart = "SELECT * FROM cart WHERE ip_address='$user_ip'";
            $select_cart = mysqli_query($con, $select_query_cart);
            $rows_count_cart = mysqli_num_rows($select_cart);

            if ($rows_count == 1 && $rows_count_cart == 0) {
                // Redirect to profile if no items in cart
                echo "
                <script>
                    $(document).ready(function() {
                        toastr.success('Login Successful');
                        setTimeout(function() {
                            window.open('profile.php', '_self');
                        }, 2000);
                    });
                </script>";
            } else {
                // Redirect to payment if there are items in the cart
                echo "
                <script>
                    $(document).ready(function() {
                        toastr.success('Login Successful');
                        setTimeout(function() {
                            window.open('payement.php', '_self');
                        }, 2000);
                    });
                </script>";
            }
        } else {
            echo "
            <script>
                $(document).ready(function() {
                    toastr.error('Invalid Credentials');
                });
            </script>";
        }
    } else {
        echo "
        <script>
            $(document).ready(function() {
                toastr.error('Invalid Credentials');
            });
        </script>";
    }
}


?>