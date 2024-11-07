<?php
// Database connection
include('../include/connect.php');

// Fetch all feedbacks
$sql = "SELECT * FROM customer_feedback ORDER BY created_at DESC"; // Assuming there is a created_at timestamp column
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Owner - View Feedback</title>

</head>

<body>
    <div class="container mt-5">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h1 class="text-center">Customer Feedbacks</h1>
                <div class="row">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo htmlspecialchars($row['name']); ?></h5>
                                        <h6 class="text-muted"><?php echo htmlspecialchars($row['email']); ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <p><?php echo htmlspecialchars($row['feedback']); ?></p>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <?php echo date('Y-m-d H:i:s', strtotime($row['created_at'])); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12 text-center">
                            <div class="alert alert-info">No feedbacks found.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>