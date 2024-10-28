<?php

include('../include/connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendEmail($to, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'malithamalshan7@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'zjlb qcqv azkw ycbw'; // Replace with your Gmail password or App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email setup
        $mail->setFrom('malithamalshan7@gmail.com', 'SUN GSM');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->isHTML(true); // Set email format to HTML if needed

        $mail->send();
        return "Email sent successfully";
    } catch (Exception $e) {
        return "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
}

// Check if the session username is set
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch user ID and email based on username
    $get_user_query = "SELECT user_id, user_email FROM `user` WHERE username = '$username'";
    $result_user = mysqli_query($con, $get_user_query);
    $user_data = mysqli_fetch_assoc($result_user);

    if ($user_data) {
        $user_id = $user_data['user_id'];
        $email = $user_data['user_email'];

        // Fetch the most recent order for the user
        $get_order_query = "SELECT order_id FROM `orders` WHERE user_id = '$user_id' ORDER BY order_date DESC LIMIT 1";
        $result_order = mysqli_query($con, $get_order_query);
        $order_data = mysqli_fetch_assoc($result_order);

        if ($order_data) {
            $order_id = $order_data['order_id'];

            // Email parameters
            $customerEmail = $email;
            $subject = "Order Confirmation - Your Order #$order_id";
            $body = "<h1>Your payment has been confirmed!</h1><p>Your order #$order_id is being processed.</p>";

            // Send the email
            $emailStatus = sendEmail($customerEmail, $subject, $body);

            // Toastr notification (example)
            echo "<script>
                $(document).ready(function() { 
                    toastr.success('$emailStatus');
                });
            </script>";
        } else {
            echo "<script>console.error('No recent orders found for this user.');</script>";
        }
    } else {
        echo "<script>console.error('User data not found.');</script>";
    }
} else {
    echo "<script>console.error('Session username is not set. Please log in.');</script>";
}
?>