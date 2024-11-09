<?php
include('../include/connect.php'); // Ensure this file includes your database connection

// Fetch all blog posts from the database
$sql = "SELECT * FROM blog_posts ORDER BY created_at DESC"; // Assuming there's a created_at column to order posts
$result = mysqli_query($con, $sql);
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

                <div class="mb-4">
                    <div class="table-responsive">
                        <table class="table table-striped border-black">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Image</th>
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
                                    <tr>
                                        <td><?php echo htmlspecialchars($post['id']); ?></td>
                                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                                        <td><?php echo nl2br(htmlspecialchars(limitWords($post['content'], 20))); ?></td>
                                        <!-- Limit to 20 words -->
                                        <td>
                                            <?php if ($post['image']): ?>
                                                <img src="../admin_panel/<?php echo htmlspecialchars($post['image']); ?>"
                                                    alt="Blog Image" style="width: 100px; height: auto;">
                                            <?php else: ?>
                                                No Image
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>