<?php
include('../include/connect.php');
include('../functions/send_email.php');

// Fetch all delivery details to ensure data is present
$get_delivery_details = "
SELECT dd.*, u.user_email
FROM delivery_details dd
JOIN user u ON dd.user_id = u.user_id"; // Joining with the user table to get user email
$result_delivery = mysqli_query($con, $get_delivery_details);

if (!$result_delivery) {
    die("Query Failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUN GSM Delivery Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" />
</head>

<body>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

<div class="d-flex justify-content-center" style="border-radius: 15px; font-family:Poppins">
    <div class="card" style="width:100%;">
        <div class="card-body">
            <h1 class="text-center">Delivery Details</h1>

            <?php
            if (mysqli_num_rows($result_delivery) > 0) {
                echo '<table class="table table-bordered mt-5">';
                echo '<thead class="table-primary">
                        <tr>
                            <th scope="col">Delivery ID</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Delivery Address</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Delivery Status</th>
                            <th scope="col">Delivery Date</th>
                            <th scope="col">Shipping Method</th>
                            <th scope="col">Delivery Partner</th>
                            <th scope="col">Tracking No</th>
                          </tr>
                      </thead><tbody>';

                while ($row_delivery = mysqli_fetch_assoc($result_delivery)) {
                    $delivery_id = $row_delivery['delivery_id'];
                    $tracking_no = $row_delivery['tracking_no'];
                    $delivery_date = $row_delivery['delivery_date'];

                    echo "<tr class='table-info'>
                            <td>{$delivery_id}</td>
                            <td>{$row_delivery['order_id']}</td>
                            <td>{$row_delivery['delivery_address']}</td>
                            <td>{$row_delivery['contact_number']}</td>
                            <td>{$row_delivery['delivery_status']}</td>
                            <td>";
                    echo $delivery_date ?: "Not yet <button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#editModal$delivery_id'>Edit</button>";
                    echo "</td><td>{$row_delivery['shipping_method']}</td>
                          <td>{$row_delivery['delivery_partner']}</td>
                          <td>";
                    echo $tracking_no ?: "<button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#addTrackingModal$delivery_id'>Add</button>";
                    echo "</td></tr>";

                    // Modal for "Add Tracking No"
                    echo "<div class='modal fade' id='addTrackingModal$delivery_id' tabindex='-1' aria-labelledby='addTrackingModalLabel$delivery_id' aria-hidden='true'>
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <h5 class='modal-title'>Add Tracking Number</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <form method='POST' action=''>
            <div class='modal-body'>
                <input type='hidden' name='delivery_id' value='$delivery_id' />
                <div class='mb-3'>
                    <label for='tracking_no' class='form-label'>Tracking Number</label>
                    <input type='text' class='form-control' name='tracking_no' required />
                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button type='submit' class='btn btn-primary' name='add_tracking_no'>Save changes</button>
            </div>
        </form>
    </div>
</div>
</div>";

                    // Modal for "Edit Delivery Date"
                    echo "<div class='modal fade' id='editModal$delivery_id' tabindex='-1' aria-labelledby='editModalLabel$delivery_id' aria-hidden='true'>
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <h5 class='modal-title'>Edit Delivery Date</h5>
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
                echo '</tbody></table>';
            } else {
                echo "<div class='alert alert-warning'>No delivery details found.</div>";
            }
            ?>
        </div>
    </div>
</div>

<?php
// Handle form submissions for tracking numbers and delivery dates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_tracking_no'])) {
        $delivery_id = $_POST['delivery_id'];
        $tracking_no = $_POST['tracking_no'];
        $update_tracking_query = "UPDATE delivery_details SET tracking_no='$tracking_no' WHERE delivery_id='$delivery_id'";
        if (mysqli_query($con, $update_tracking_query)) {
            echo "<script>$(document).ready(function () { toastr.success('Tracking number added successfully!'); });</script>";
        } else {
            echo "<script>$(document).ready(function () { toastr.error('Failed to add tracking number.'); });</script>";
        }
    }

    if (isset($_POST['update_delivery_date'])) {
        $delivery_id = $_POST['delivery_id'];
        $delivery_date = $_POST['delivery_date'];
        $update_delivery_query = "UPDATE delivery_details SET delivery_date='$delivery_date', delivery_status='Success' WHERE delivery_id='$delivery_id'";
        if (mysqli_query($con, $update_delivery_query)) {
            echo "<script>$(document).ready(function () { toastr.success('Delivery date updated successfully!'); });</script>";
        } else {
            echo "<script>$(document).ready(function () { toastr.error('Failed to update delivery date.'); });</script>";
        }
    }
}

// Fetch all delivery details to process emails
$delivery_query = "
    SELECT dd.order_id, dd.delivery_date, dd.tracking_no, dd.delivery_partner, dd.email_sent, c.user_email AS customer_email
    FROM delivery_details dd
    JOIN user c ON dd.user_id = c.user_id";

$delivery_result = mysqli_query($con, $delivery_query);

if ($delivery_result && mysqli_num_rows($delivery_result) > 0) {
    while ($delivery_row = mysqli_fetch_assoc($delivery_result)) {
        $order_id = $delivery_row['order_id'];
        $delivery_date = $delivery_row['delivery_date'];
        $tracking_no = $delivery_row['tracking_no'];
        $delivery_partner = $delivery_row['delivery_partner'];
        $email_sent = $delivery_row['email_sent'];
        $customerEmail = $delivery_row['customer_email'];

        if ($email_sent == 0) {
            if (!empty($delivery_date) && !empty($tracking_no) && !empty($customerEmail)) {
                $subject = "Delivery Update for Order #$order_id";
                $body = "
                    <h2>Delivery Update for Order #$order_id</h2>
                    <p>Your delivery is scheduled on: <strong>$delivery_date</strong></p>
                    <p>Tracking Code: <strong>$tracking_no</strong></p>
                    <p>Delivery Partner: <strong>$delivery_partner</strong></p>
                    <p>Contact Number: <strong>076 139 9247, 011 702 1145</strong></p>
                    <p>Thank you for shopping with us!</p>";

                $emailStatus = sendEmail($customerEmail, $subject, $body);

                if (strpos($emailStatus, 'successfully') !== false) {
                    $update_email_status = "UPDATE delivery_details SET email_sent = 1 WHERE order_id = '$order_id'";
                    mysqli_query($con, $update_email_status);
                    echo "<script>$(document).ready(function () { toastr.info('Email notification sent successfully!'); });</script>";
                }
            }
        }
    }
}
?>





</html>