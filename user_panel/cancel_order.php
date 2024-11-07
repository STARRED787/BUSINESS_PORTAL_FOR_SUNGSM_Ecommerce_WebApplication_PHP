<?php
include('../include/connect.php'); // Include database connection file

// Check if Toastr is included (in your main layout or head section)
echo '
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
';

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Update order status to "Cancelled"
    $update_order_status = "UPDATE `orders` SET order_status='Cancelled' WHERE order_id='$order_id'";
    if (mysqli_query($con, $update_order_status)) {
        echo "<script>
                $(document).ready(function() {
                    toastr.success('Order has been cancelled successfully.');
                    setTimeout(function() {
                        window.location.href = 'profile.php?pending_orders';
                    }, 3000); // Redirect after 3 seconds
                });
              </script>";
    } else {
        echo "<script>
                $(document).ready(function() {
                    toastr.error('Error cancelling order. Please try again.');
                    setTimeout(function() {
                        window.location.href = 'profile.php?pending_orders';
                    }, 3000); // Redirect after 3 seconds
                });
              </script>";
    }
} else {
    echo "<script>
            $(document).ready(function() {
                toastr.warning('Invalid order ID.');
                setTimeout(function() {
                    window.location.href = 'profile.php?pending_orders';
                }, 3000); // Redirect after 3 seconds
            });
          </script>";
}
?>