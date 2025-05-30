<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

@session_start();

// Check if the username exists in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // If no username in the session, stop execution and show an error message
    die('Username not found in session. Please login.');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
    <title>Edit Account</title>
</head>

<body>
    <!---- PHP code to get User Id to access orders table----->

    <?php
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM `user` WHERE username='$username'";
    $result = mysqli_query($con, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];
    //echo $user_id;
    
    ?>

    <div class="d-flex justify-content-center" style="border-radius: 15px; font-family:Poppins">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h1 class="text-center ">My Orders</h1>
                <div class="table-responsive">
                    <table class="table table-bordered mt-5 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Sl no</th>
                                <th scope="col">Order Number</th>
                                <th scope="col">Amount Due</th>
                                <th scope="col">Total products</th>
                                <th scope="col">Invoice Number</th>
                                <th scope="col">Date</th>
                                <th scope="col">Complete/Incomplete</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!---- PHP code to get orders table data to display my orders tble ----->

                            <?php
                            $get_orders_details = "SELECT * FROM `orders` WHERE user_id='$user_id'";
                            $result_orders = mysqli_query($con, $get_orders_details);
                            $sl_order = 1; // Initialize outside the loop
                            while ($row_orders = mysqli_fetch_assoc($result_orders)) {
                                $order_id = $row_orders['order_id'];
                                $order_amount_due = $row_orders['amount_due'];
                                $order_invoice_number = $row_orders['invoice_number'];
                                $order_total_products = $row_orders['total_products'];
                                $order_order_date = $row_orders['order_date'];
                                $order_status = $row_orders['order_status'];

                                // Only display orders with status 'Pending' (i.e., 'Incomplete')
                                if ($order_status == 'Complete') {
                                    $order_status = "Complete";

                                    echo "
        <tr class='table-info'>
            <td>$sl_order</td>
            <td>$order_id</td>
            <td>$order_amount_due</td>
            <td>$order_total_products</td>
            <td>$order_invoice_number</td>
            <td>$order_order_date</td>
            <td>$order_status</td>
            <td>Paid</a></td>
        </tr>";

                                    $sl_order++; // Increment after displaying the row
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Corrected: Removed duplicate Bootstrap JS inclusion -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
</body>

</html>