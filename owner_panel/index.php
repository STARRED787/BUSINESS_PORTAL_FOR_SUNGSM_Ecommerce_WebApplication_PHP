<?php
session_start(); // Start the session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
include('../include/connect.php'); // Verify path to connect.php

// Check if the owner is already logged in
if (isset($_SESSION['owner_username'])) {
    header("Location: index_home.php?count_board"); // Redirect to dashboard
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Owner Dashboard</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
</head>

<body style="
  background-image: url(./image/back.jpg);
  height: 580px; 
  width: 100%;
  background-position: center;
  background-repeat: no-repeat; 
  background-size: cover;
  background-attachment: fixed;
">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ZOvcITpNrnYq8Xiwb6Orp9+7DSgqe3pA/NYopSKkPAUDT60e1iEFOkM8UEkUviLv"
        crossorigin="anonymous"></script>
</body>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow" style="
         width: 400px;
        padding: 20px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1); /* Minimal background color to ensure blur visibility */
        backdrop-filter: blur(10px); /* Adds blur to the background */
        -webkit-backdrop-filter: blur(10px); /* For Safari compatibility */
    ">
        <h3 class="text-center text-white">Owner Login</h3>
        <form method="POST" action="">
            <div class="mb-3 text-white">
                <label for="owner_username" class="form-label">Username</label>
                <input type="text" class="form-control" name="owner_username" id="owner_username" required>
            </div>
            <div class="mb-3 text-white">
                <label for="owner_password" class="form-label">Password</label>
                <input type="password" class="form-control" name="owner_password" id="owner_password" required>
            </div>
            <button type="submit" name="owner_login" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
<?php
// Check if form is submitted
if (isset($_POST['owner_login'])) {
    $owner_username = mysqli_real_escape_string($con, $_POST['owner_username']);
    $owner_password = mysqli_real_escape_string($con, $_POST['owner_password']); // Use the original password

    // Query to check if owner credentials are correct
    $query = "SELECT * FROM `owners` WHERE owner_username='$owner_username' AND password='$owner_password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) === 1) {
        $_SESSION['owner_username'] = $owner_username; // Set session variable
        echo "<script>
            toastr.success('Login successful!');
            setTimeout(function() {
                window.location.href = 'index_home.php?count_board'; // Redirect to dashboard
            }, 2000);
          </script>";
    } else {
        echo "<script>toastr.error('Invalid username or password');</script>";
    }
}

?>

</html>