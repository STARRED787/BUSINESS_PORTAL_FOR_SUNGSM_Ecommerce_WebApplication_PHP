<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
include('../include/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">All Orders</h1>
                <div class="table-responsive">
                    <table class="table table-bordered mt-4">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Sl No</th>
                                <th scope="col">Order Number</th>
                                <th scope="col">Amount Due</th>
                                <th scope="col">Total Products</th>
                                <th scope="col">Invoice Number</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_orders_details = "SELECT * FROM `orders`";
                            $result_orders = mysqli_query($con, $get_orders_details);

                            if (mysqli_num_rows($result_orders) > 0) {
                                $sl_order = 1;
                                while ($row_orders = mysqli_fetch_assoc($result_orders)) {
                                    $order_id = $row_orders['order_id'];
                                    $order_amount_due = $row_orders['amount_due'];
                                    $order_total_products = $row_orders['total_products'];
                                    $order_invoice_number = $row_orders['invoice_number'];
                                    $order_date = $row_orders['order_date'];
                                    $order_status = ($row_orders['order_status'] == 'Pending') ? "Incomplete" : "Complete";
                                    $payment_status = ($order_status == "Complete") ? "Paid" : "Unpaid";

                                    echo "
                                    <tr class='table-info'>
                                        <td>{$sl_order}</td>
                                        <td>{$order_id}</td>
                                        <td>{$order_amount_due}</td>
                                        <td>{$order_total_products}</td>
                                        <td>{$order_invoice_number}</td>
                                        <td>{$order_date}</td>
                                        <td>{$order_status}</td>
                                        <td>{$payment_status}</td>
                                    </tr>";
                                    $sl_order++;
                                }
                            } else {
                                // Show message if no orders found
                                echo "<tr><td colspan='8' class='text-center'>No orders found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>