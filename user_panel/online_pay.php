<?php
session_start();
include("../include/connect.php");  // Include your database connection

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    $current_username = $_SESSION['username']; // Retrieve the username
} else {
    $current_username = 'Guest'; // Default value if not logged in
}

// Retrieve the order_id from the URL
if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']); // Ensure it's treated as an integer
} else {
    die('Order ID not found. Please confirm your order.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(0, 0, 34);
            font-size: 0.9rem;
            color: #333;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            max-width: 1000px;
            margin: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        .card-top {
            padding: 1rem 3rem;
            background-color: #f7f7f7;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 2rem 3rem;
            background: url("https://i.imgur.com/4bg1e6u.jpg") no-repeat center;
            background-size: cover;
        }

        #logo {
            font-family: 'Dancing Script', cursive;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .form-check-input {
            width: 1.2em;
            height: 1.2em;
        }

        .btn {
            background-color: rgb(23, 4, 189);
            color: white;
        }

        .btn:hover {
            background-color: rgb(20, 4, 160);
            color: white;
        }

        #cvv {
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.575), rgba(255, 255, 255, 0.541)), url("https://img.icons8.com/material-outlined/24/000000/help.png");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center;
        }

        .icons img {
            width: 2rem;
            margin-left: 0.5rem;
        }

        .right .header {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card shadow">
            <div class="card-top text-center">
                <span id="logo" class="ms-4">SUN GSM Online Business Portal</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="p-4 bg-white border rounded">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="header">Payment</span>
                                <div class="icons">
                                    <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Visa">
                                    <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png"
                                        alt="MasterCard">
                                    <img src="https://img.icons8.com/color/48/000000/maestro.png" alt="Maestro">
                                </div>
                            </div>
                            <form id="paymentForm" method="POST" action="">
                                <div class="mb-3">
                                    <label for="cardholder-name" class="form-label">Cardholder's name:</label>
                                    <input type="text" id="cardholder-name" placeholder="Linda Williams"
                                        class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="card-number" class="form-label">Card Number:</label>
                                    <input type="text" id="card-number" placeholder="0125 6780 4567 9909"
                                        class="form-control" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="expiry-date" class="form-label">Expiry date:</label>
                                        <input type="text" id="expiry-date" placeholder="YY/MM" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cvv" class="form-label">CVV:</label>
                                        <input type="text" id="cvv" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-check mt-3">
                                    <input type="checkbox" class="form-check-input" id="save_card">
                                    <label class="form-check-label" for="save_card">Save card details to wallet</label>
                                </div>
                                <button type="submit" class="btn mt-3 w-100">Pay Now</button>
                            </form>
                            <a href="./profile.php?pending_orders"><button class="btn mt-3 w-100">Back</button></a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="p-4 bg-white border rounded">
                            <div class="header">Order Summary</div>

                            <?php
                            // Prepare and execute the query
                            $stmt = $con->prepare("SELECT op.quantity, o.amount_due, o.total_products, p.product_tittle, p.product_image1  
                                                    FROM orders_pending op 
                                                    JOIN orders o ON op.order_id = o.order_id 
                                                    JOIN products p ON op.product_id = p.product_id 
                                                    WHERE op.order_id = ?");

                            if ($stmt) {
                                $stmt->bind_param("i", $order_id);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0): ?>
                                    <p><?php echo $result->num_rows; ?> items</p>
                                    <?php $subtotal = 0; ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                            <div><img src="../images/<?php echo htmlspecialchars($row['product_image1']); ?>"
                                                    class="img-fluid" alt="<?php echo htmlspecialchars($row['product_tittle']); ?>"
                                                    width="50"></div>
                                            <div>
                                                <b>Rs.<?php echo number_format($row['amount_due'], 2); ?></b>
                                                <div class="text-muted"><?php echo htmlspecialchars($row['product_tittle']); ?>
                                                </div>
                                                <div>Qty: <?php echo htmlspecialchars($row['quantity']); ?></div>
                                            </div>
                                        </div>
                                        <?php $subtotal += $row['amount_due']; ?>
                                    <?php endwhile; ?>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <div>Subtotal</div>
                                        <div>Rs.<?php echo number_format($subtotal, 2); ?></div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div>Delivery</div>
                                        <div>Free</div>
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold">
                                        <div>Total to pay</div>
                                        <div>Rs.<?php echo number_format($subtotal, 2); ?></div>
                                    </div>
                                    <div class="mt-3"><a href="#" class="text-decoration-underline text-muted">Add promo
                                            code</a></div>
                                <?php else: ?>
                                    <p>No items in order summary.</p>
                                <?php endif; ?>
                            <?php } else { ?>
                                <p>Error fetching order summary.</p>
                            <?php } ?>
                            <p class="text-muted text-center mt-3">Complimentary Shipping & Returns</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-33oe7rM8U+cYqzD1vYVtKi+j2dr8jpXJm9yhiP+OYSHd7aYFG8GxDgh8hCtE72q4"
        crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#paymentForm').on('submit', function (e) {
                e.preventDefault(); // Prevent form submission

                // Get form values
                var cardholderName = $('#cardholder-name').val().trim();
                var cardNumber = $('#card-number').val().trim();
                var expiryDate = $('#expiry-date').val().trim();
                var cvv = $('#cvv').val().trim();

                // Validate fields
                if (cardholderName === "" || cardNumber === "" || expiryDate === "" || cvv === "") {
                    toastr.error("All fields are required.");
                    return;
                }

                // Validate card number format (e.g., using regex)
                var cardNumberPattern = /^\d{4} \d{4} \d{4} \d{4}$/;
                if (!cardNumberPattern.test(cardNumber)) {
                    toastr.error("Invalid card number format. Use 0000 0000 0000 0000 format.");
                    return;
                }

                // Validate expiry date format and check if it's a valid future date
                var expiryDatePattern = /^(0[1-9]|1[0-2])\/\d{2}$/; // MM/YY format
                if (!expiryDatePattern.test(expiryDate)) {
                    toastr.error("Invalid expiry date format. Use MM/YY format.");
                    return;
                }

                // Check if expiry date is in the future
                var currentDate = new Date();
                var [expMonth, expYear] = expiryDate.split("/").map(Number);
                expYear += 2000; // Convert YY to YYYY
                var expiryDateObj = new Date(expYear, expMonth - 1); // Month is zero-indexed
                if (expiryDateObj <= currentDate) {
                    toastr.error("Card is expired. Please use a valid card.");
                    return;
                }

                // Validate CVV (3 or 4 digits)
                var cvvPattern = /^\d{3,4}$/; // Matches 3 or 4 digits
                if (!cvvPattern.test(cvv)) {
                    toastr.error("Invalid CVV. It should be 3 or 4 digits.");
                    return;
                }

                // Simulate a successful payment process
                toastr.success("Payment processed successfully!");
                setTimeout(() => {
                    window.location.href = "profile.php?pending_orders"; // Redirect to the home page after processing
                }, 2000);
            });
        });
    </script>

</body>

</html>