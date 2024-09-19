<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//database connection
include('../include/connect.php');
include('../functions/common_function.php');
session_start();

//check if user order id
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];


    //get order details to confirm payement fields
    $select_order = "SELECT * FROM `orders` WHERE order_id = '$order_id'";
    $result_orders = mysqli_query($con, $select_order);
    $row_order = mysqli_fetch_assoc($result_orders);
    $order_id = $row_order['order_id'];
    $order_invoice_number = $row_order['invoice_number'];
    $order_total_products = $row_order['total_products'];

}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
    <!-- Corrected: Only one version of Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">

    <title>Confirm Payement</title>
</head>
<style>
    .toast-success {
        background-color: #28a745 !important;
        /* Hard green color */
    }
</style>

<body>
    <section class="h-100 h-custom" style="background-color: #8fc4b7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3 ">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="./images/payment-confirmed-icon-vector-40355337.jpg" width="30%"
                                style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                                alt="Sample photo">
                        </div>

                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Confirm Payement</h3>

                            <form class="px-md-2" method="POST" action="">

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="invoice_number" name="invoice_number" class="form-control"
                                        value="<?php echo $order_invoice_number ?>" />
                                    <label class="form-label" for="form3Example1q">Invoice Number</label>
                                </div>


                                <div data-mdb-input-init class="form-outline mb-4">

                                    <input type="text" id="total_amount" name="total_amount" class="form-control"
                                        value="<?php echo $order_total_products ?>" />
                                    <label class="form-label" for="form3Example1q">Amount</label>
                                </div>

                                <div class="mb-4">
                                    <select class="form-select" name="payement_mode" required>
                                        <option value="" disabled selected>Select a Payment Option</option>
                                        <!-- Empty value -->
                                        <option value="Paypal">Paypal</option>
                                        <option value="Cash On Delivery">Cash On Delivery</option>
                                    </select>
                                </div>


                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="payement_confirm" data-mdb-button-init
                                        data-mdb-ripple-init class="btn btn-success btn-lg mb-1 ">Confirm</button>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Corrected: Removed duplicate Bootstrap JS inclusion -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
</body>

</html>

<?php

// Insert payment details into `user_payments` table
if (isset($_POST['payement_confirm'])) {
    $invoice_number = $_POST['invoice_number'];
    $order_total_amount = $_POST['total_amount'];
    $payement_mode = $_POST['payement_mode'];


    //insert query code
    $insert_confirm_payement = "INSERT INTO `user_payements` (invoice_number, amount, payement_mode) 
                                    VALUES ('$invoice_number', '$order_total_amount', '$payement_mode')";
    $result_confirm_payement = mysqli_query($con, $insert_confirm_payement);

    // Display success/error message for payment confirmation
    if ($result_confirm_payement) {
        echo "<script>$(document).ready(function() { 
        toastr.success('Payment Successfully Confirmed');
        setTimeout(function() { window.open('profile.php?my_orders','_self'); }, 2000); // Delay for 2 seconds
    });</script>";
    } else {
        echo "<script>toastr.error('Payment Not Confirmed')</script>";
    }
}
?>