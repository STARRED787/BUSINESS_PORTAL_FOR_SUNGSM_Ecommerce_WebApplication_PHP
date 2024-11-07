<?php
include('../include/connect.php'); // Ensure this file includes your database connection

// Fetch all blog posts from the database
$sql = "SELECT * FROM blog_posts ORDER BY created_at DESC"; // Assuming there's a created_at column to order posts
$result = mysqli_query($con, $sql);

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete_sql = "DELETE FROM blog_posts WHERE id = $id";
    mysqli_query($con, $delete_sql);
    header("Location: admin_home.php?blog_view.php"); // Redirect after deletion
    exit();
}

// Handle edit request
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    // Retrieve the current image from the database
    $currentImageSql = "SELECT image FROM blog_posts WHERE id = $id";
    $currentImageResult = mysqli_query($con, $currentImageSql);
    $currentImageRow = mysqli_fetch_assoc($currentImageResult);
    $imagePath = $currentImageRow['image']; // Use existing image by default

    // Handle image upload if provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imagePath = './blog images/' . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo "Error uploading the image.";
            exit();
        }
    }

    // Update the blog post
    $update_sql = "UPDATE blog_posts SET title='$title', content='$content', image='$imagePath' WHERE id=$id";
    if (!mysqli_query($con, $update_sql)) {
        echo "Error updating post: " . mysqli_error($con);
        exit();
    }

    // Redirect after update
    header("Location: index_home.php?blog_view");
    exit();
}

// Check if edit is requested
$editPost = null;
if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $editSql = "SELECT * FROM blog_posts WHERE id = $editId";
    $editPost = mysqli_fetch_assoc(mysqli_query($con, $editSql));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h1 class="text-center">Blog Posts</h1>

                <?php if ($editPost): ?>
                    <div class="mb-4">
                        <h2>Edit Blog Post</h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $editPost['id']; ?>">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="<?php echo htmlspecialchars($editPost['title']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="5"
                                    required><?php echo htmlspecialchars($editPost['content']); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload New Image (Leave blank to keep current)</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <?php if (!empty($editPost['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($editPost['image']); ?>" alt="Current Image"
                                        class="img-fluid mt-2" style="max-width: 100px;">
                                <?php endif; ?>
                            </div>
                            <button type="submit" name="edit" class="btn btn-warning">Update Blog</button>
                        </form>
                    </div>
                <?php endif; ?>

                <div class="mb-4">
                    <table class="table table-striped border-black">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <?php
                        // Function to limit words in content
                        function limitWords($content, $wordLimit)
                        {
                            $words = explode(' ', $content);
                            return implode(' ', array_slice($words, 0, $wordLimit)) . (count($words) > $wordLimit ? '...' : '');
                        }
                        ?>

                        <tbody>
                            <?php while ($post = mysqli_fetch_assoc($result)): ?>
                                <?php if ($editPost && $editPost['id'] == $post['id']):
                                    continue;
                                endif; ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($post['id']); ?></td>
                                    <td><?php echo htmlspecialchars($post['title']); ?></td>
                                    <td><?php echo nl2br(htmlspecialchars(limitWords($post['content'], 20))); ?></td>
                                    <!-- Limit to 20 words -->
                                    <td>
                                        <?php if ($post['image']): ?>
                                            <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Blog Image"
                                                style="width: 100px; height: auto;">
                                        <?php else: ?>
                                            No Image
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="blog_view.php?edit=<?php echo $post['id']; ?>"
                                            class="btn btn-info btn-sm mt-2 mb-2">Edit</a>
                                        <a href="blog_view.php?delete=<?php echo $post['id']; ?>"
                                            class="btn btn-danger btn-sm mt-2 mb-2"
                                            onclick="return confirm('Are you sure you want to delete this blog post?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>