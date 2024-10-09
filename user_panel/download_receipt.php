<?php
require('../libs/fpdf/fpdf.php');
include('../include/connect.php'); // Include database connection
session_start();
// Get the user ID and order ID from the URL
if (isset($_GET['order_id']) && isset($_GET['user_id'])) {
    $order_id = $_GET['order_id'];
    $user_id = $_GET['user_id'];
} else {
    echo "
    <script>
        alert('Please follow the order process.');
        window.location.href = '../index/index.php'; // Redirect to index page
    </script>
    ";
    exit; // Stop further execution
}


// Fetch user details
$get_user = "SELECT * FROM `user` WHERE user_id='$user_id'";
$result_user = mysqli_query($con, $get_user);
$user_data = mysqli_fetch_assoc($result_user);

// Fetch order details
$get_order = "SELECT * FROM `orders` WHERE order_id='$order_id'";
$result_order = mysqli_query($con, $get_order);
$order_data = mysqli_fetch_assoc($result_order);

// Fetch delivery details
$get_delivery = "SELECT * FROM `delivery_details` WHERE order_id='$order_id'";
$result_delivery = mysqli_query($con, $get_delivery);
$delivery_data = mysqli_fetch_assoc($result_delivery);

// Fetch ordered products from orders_pending and join with products
$get_order_products = "SELECT p.product_tittle, p.product_price, op.quantity 
                       FROM `orders_pending` op
                       JOIN `products` p ON op.product_id = p.product_id 
                       WHERE op.order_id='$order_id'";
$result_order_products = mysqli_query($con, $get_order_products);

// Shop details (static for now)
$shop_email = "shop@example.com";
$shop_address = "123, Main Street, Colombo, Sri Lanka";
$invoice_number = $order_data['invoice_number'];
$date = date('Y-m-d');

// Initialize PDF
$pdf = new FPDF();
$pdf->AddPage();

// Shop and Invoice Details
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Order Receipt', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'SUNGSM Shop', 0, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Invoice Number: ' . $invoice_number, 0, 1);

$pdf->Cell(0, 10, 'Date: ' . $date, 0, 1);
$pdf->Cell(0, 10, 'Shop Email: ' . $shop_email, 0, 1);
$pdf->Cell(0, 10, 'Shop Address: ' . $shop_address, 0, 1);

$pdf->Ln(5); // Line break

// User Details
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'User Details', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Name: ' . $user_data['username'], 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $user_data['user_email'], 0, 1);

$pdf->Ln(5); // Line break

// Delivery Details
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Delivery Details', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Address: ' . $delivery_data['delivery_address'], 0, 1);
$pdf->Cell(0, 10, 'Contact Number: ' . $delivery_data['contact_number'], 0, 1);
$pdf->Cell(0, 10, 'Shipping Method: ' . $delivery_data['shipping_method'], 0, 1);

$pdf->Ln(5); // Line break

// Ordered Products
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Ordered Products', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Order ID: ' . $order_id, 0, 1);  // Added Order ID here
while ($product_data = mysqli_fetch_assoc($result_order_products)) {
    $product_title = $product_data['product_tittle'];
    $product_quantity = $product_data['quantity'];
    $product_total_price = number_format($product_data['product_price'] * $product_quantity, 2);
    $pdf->Cell(0, 10, $product_title . ' (x' . $product_quantity . ') - Rs ' . $product_total_price, 0, 1);
}

$pdf->Ln(5); // Line break

// Total Amount
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Total Amount: Rs ' . number_format($order_data['amount_due'], 2), 0, 1);

// Output PDF as a download
$pdf->Output('D', 'receipt_' . $invoice_number . '.pdf');
?>