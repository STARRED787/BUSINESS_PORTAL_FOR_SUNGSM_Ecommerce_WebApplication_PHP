<?php
include('../include/connect.php'); // Ensure this file includes your database connection

// Create the blog_images directory if it doesn't exist
if (!is_dir('./blog_images')) {
    mkdir('./blog_images', 0777, true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Blog Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h1 class="text-center">Create a Blog Post</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" name="admin_blog" class="btn btn-primary">Post Blog</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_blog'])) {
        $title = mysqli_real_escape_string($con, $_POST['title']);
        $content = mysqli_real_escape_string($con, $_POST['content']);
        $imagePath = '';

        // Check for duplicate records based on the title
        $checkDuplicate = "SELECT * FROM blog_posts WHERE title = '$title'";
        $result = mysqli_query($con, $checkDuplicate);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('A blog post with this title already exists!');</script>";
        } else {
            // Handle image upload if provided
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imagePath = './blog images/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            }

            // Insert into the blog table
            $sql = "INSERT INTO blog_posts (title, content, image) VALUES ('$title', '$content', '$imagePath')";
            if (mysqli_query($con, $sql)) {
                echo "<script>alert('Blog post submitted successfully!');</script>";
                // Optionally, you can redirect after submission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
            }
        }
    }
    ?>
</body>

</html>