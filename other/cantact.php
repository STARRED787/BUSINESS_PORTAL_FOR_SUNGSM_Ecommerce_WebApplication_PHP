<?php
// feedback.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
include('../include/connect.php');

// Initialize message variable
$message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $feedback = mysqli_real_escape_string($con, $_POST['feedback']);

    // Insert feedback into the database
    $sql = "INSERT INTO customer_feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";
    if (mysqli_query($con, $sql)) {
        $message = "Thank you for your feedback!";
    } else {
        $message = "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Customer Feedback</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="feedback" class="form-label">Feedback</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Feedback</button>

        </form>
        <a href="../index/index.php"><button class="mt-2 btn btn-danger">Back to home</button> </a>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            <?php if ($message): ?>
                toastr.success("<?php echo $message; ?>");
                setTimeout(function () {
                    window.location.href = '../index/index.php'; // Redirect to index_home
                }, 2000);
            <?php endif; ?>
        });
    </script>

</body>

</html>