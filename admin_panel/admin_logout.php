<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the admin session is set before unsetting
if (isset($_SESSION['admin_username'])) {
    // Set a session variable for logout message
    $_SESSION['logout_message'] = "You have been logged out successfully.";

    // Unset only admin-specific session variables
    unset($_SESSION['admin_username']);
    unset($_SESSION['admin_id']); // If there's an admin ID or other related variables
}

// Capture the logout message
$logout_message = 'You have been logged out successfully.';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>

<body>
    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Toastr Notification Script -->
    <script>
        toastr.success('Logout successful!');
        setTimeout(function () {
            window.location.href = 'index.php'; // Redirect to dashboard
        }, 2000);
    </script>
</body>

</html>