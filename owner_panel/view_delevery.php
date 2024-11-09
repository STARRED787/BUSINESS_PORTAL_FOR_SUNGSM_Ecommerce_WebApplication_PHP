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
    <div class="d-flex justify-content-center" style="border-radius: 15px; font-family:Poppins">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h1 class="text-center">Delivery Details</h1>
                <div class="table-responsive">

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
                                <td>" . ($delivery_date ?: "Not yet") . "</td>
                                <td>{$row_delivery['shipping_method']}</td>
                                <td>{$row_delivery['delivery_partner']}</td>
                                <td>" . ($tracking_no ?: "Not added") . "</td>
                            </tr>";
                        }
                        echo '</tbody></table>';
                    } else {
                        echo "<div class='alert alert-warning'>No delivery details found.</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>