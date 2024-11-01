<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .blog-card img {
            height: 200px;
            object-fit: cover;
        }

        .blog-card {
            transition: transform 0.2s ease-in-out;
        }

        .blog-card:hover {
            transform: scale(1.03);
        }
    </style>
</head>

<body>

    <div class="container my-5">
        <h1 class="text-center mb-5">Our Blog</h1>

        <div class="row">
            <!-- Blog Post 1 -->
            <div class="col-md-4 mb-4">
                <div class="card blog-card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Blog Post 1">
                    <div class="card-body">
                        <h5 class="card-title">Blog Post 1</h5>
                        <p class="text-muted mb-2">Published on: October 5, 2024</p>
                        <p class="text-muted">Category: Technology</p>
                        <p class="card-text">This is a brief preview of the blog post content. Here you can write an
                            enticing snippet to draw the reader in...</p>
                        <a href="blog_details.html" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Blog Post 2 -->
            <div class="col-md-4 mb-4">
                <div class="card blog-card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Blog Post 2">
                    <div class="card-body">
                        <h5 class="card-title">Blog Post 2</h5>
                        <p class="text-muted mb-2">Published on: October 10, 2024</p>
                        <p class="text-muted">Category: Business</p>
                        <p class="card-text">This is a brief preview of the blog post content. Highlight the main idea
                            and encourage readers to click through...</p>
                        <a href="blog_details.html" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Blog Post 3 -->
            <div class="col-md-4 mb-4">
                <div class="card blog-card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Blog Post 3">
                    <div class="card-body">
                        <h5 class="card-title">Blog Post 3</h5>
                        <p class="text-muted mb-2">Published on: October 15, 2024</p>
                        <p class="text-muted">Category: Lifestyle</p>
                        <p class="card-text">Here’s another engaging snippet to preview the post. Briefly describe the
                            topic to catch your audience’s attention...</p>
                        <a href="blog_details.html" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>