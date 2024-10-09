<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../include/connect.php')
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUN GSM</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./user_page.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
</head>

<body>
    <?php

    // Fetch user details (Replace with session-based logic if needed)
    $get_user = "SELECT * FROM `user` ";
    $result = mysqli_query($con, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];
    ?>

    <div class="d-flex justify-content-center" style="border-radius: 15px; font-family:Poppins">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h1 class="text-center">Delivery Details</h1>

                <?php
                // Fetch delivery details
                $get_delivery_details = "SELECT * FROM `delivery_details` WHERE user_id='$user_id'";
                $result_delivery = mysqli_query($con, $get_delivery_details);
                $delivery_count = mysqli_num_rows($result_delivery); // Get the number of delivery records
                
                if ($delivery_count > 0) {
                    // If there are delivery records, show the table
                    echo '<table class="table table-bordered mt-5">';
                    echo '<thead class="table-primary">';
                    echo '<tr>';
                    echo '<th scope="col">Delivery ID</th>';
                    echo '<th scope="col">Order ID</th>';
                    echo '<th scope="col">Delivery Address</th>';
                    echo '<th scope="col">Contact Number</th>';
                    echo '<th scope="col">Delivery Status</th>';
                    echo '<th scope="col">Delivery Date</th>';
                    echo '<th scope="col">Shipping Method</th>';
                    echo '<th scope="col">Delivery Partner</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // Display each delivery record
                    while ($row_delivery = mysqli_fetch_assoc($result_delivery)) {
                        $delivery_id = $row_delivery['delivery_id'];
                        $order_id = $row_delivery['order_id'];
                        $delivery_address = $row_delivery['delivery_address'];
                        $contact_number = $row_delivery['contact_number'];
                        $delivery_status = $row_delivery['delivery_status'];
                        $delivery_date = $row_delivery['delivery_date'];
                        $shipping_method = $row_delivery['shipping_method'];
                        $delivery_partner = $row_delivery['delivery_partner'];

                        // Check if the delivery date is NULL and set the display value
                        $display_date = $delivery_date ? $delivery_date : "Not yet";

                        echo "
                        <tr class='table-info'>
                            <td>$delivery_id</td>
                            <td>$order_id</td>
                            <td>$delivery_address</td>
                            <td>$contact_number</td>
                            <td>$delivery_status</td>
                            <td>$display_date";

                        // Show the "Edit" button only if the delivery date is "Not yet"
                        if (!$delivery_date) {
                            echo " <button class='btn btn-info' data-bs-toggle='modal' data-bs-target='#editModal$delivery_id'>Edit</button>";
                        }

                        echo "</td>  <!-- Display date or 'Not yet' -->
                            <td>$shipping_method</td>
                            <td>$delivery_partner</td>
                        </tr>";

                        // Add modal for each "Edit" button
                        echo "
                        <div class='modal fade' id='editModal$delivery_id' tabindex='-1' aria-labelledby='editModalLabel$delivery_id' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='editModalLabel$delivery_id'>Edit Delivery Date</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <form method='POST' action=''>
                                        <div class='modal-body'>
                                            <input type='hidden' name='delivery_id' value='$delivery_id' />
                                            <div class='mb-3'>
                                                <label for='delivery_date' class='form-label'>New Delivery Date</label>
                                                <input type='date' class='form-control' name='delivery_date' required />
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            <button type='submit' class='btn btn-primary' name='update_delivery_date'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    // No delivery details found, hide the table
                    echo "<div class='alert alert-warning' role='alert'>
                            No delivery details found.
                          </div>";
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    // Update delivery date
    if (isset($_POST['update_delivery_date'])) {
        $new_delivery_date = $_POST['delivery_date'];
        $delivery_id = $_POST['delivery_id'];

        // Update query to set the new delivery date and mark status as 'Success'
        $update_query = "UPDATE `delivery_details` SET delivery_date='$new_delivery_date', delivery_status='Success' WHERE delivery_id='$delivery_id'";
        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {
            echo "<script>toastr.success('Delivery date updated successfully!');</script>";
            // Optionally, redirect to refresh the page
            echo "<script>window.location.href = window.location.href;</script>";
        } else {
            echo "<script>toastr.error('Failed to update delivery date.');</script>";
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
</body>

</html>