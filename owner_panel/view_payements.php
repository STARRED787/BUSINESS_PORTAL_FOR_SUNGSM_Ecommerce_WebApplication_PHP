<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
include('../include/connect.php');

// Check if the connection was successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Payments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">All Payments</h1>

                <table class="table table-bordered mt-4">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Payment ID</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Invoice Number</th>
                            <th scope="col">Amount Due</th>
                            <th scope="col">Payment Mode</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetching payment details from the database
                        $get_payments_details = "SELECT * FROM `user_payements`";
                        $result_payments = mysqli_query($con, $get_payments_details);

                        // Check if the query was successful
                        if (!$result_payments) {
                            echo "<tr><td colspan='6'>Error: " . mysqli_error($con) . "</td></tr>";
                        } else {
                            // Check if there are results
                            if (mysqli_num_rows($result_payments) > 0) {
                                while ($row_payments = mysqli_fetch_assoc($result_payments)) {
                                    $payment_id = $row_payments['payement_id'];
                                    $payment_order_id = $row_payments['order_id'];
                                    $payment_invoice_number = $row_payments['invoice_number'];
                                    $payment_amount = $row_payments['amount'];
                                    $payment_payment_mode = $row_payments['payement_mode'];
                                    $payment_date = $row_payments['date'];

                                    echo "
                                        <tr class='table-info'>
                                            <td>$payment_id</td>
                                            <td>$payment_order_id</td>
                                            <td>$payment_invoice_number</td>
                                            <td>$payment_amount</td>
                                            <td>$payment_payment_mode</td>
                                            <td>$payment_date</td>
                                        </tr>
                                    ";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No payments found.</td></tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>