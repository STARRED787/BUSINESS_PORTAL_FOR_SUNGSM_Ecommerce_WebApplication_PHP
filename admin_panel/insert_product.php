<?php
include('../include/connect.php');

if (isset($_POST['insert_product'])) {
    $product_tittle = mysqli_real_escape_string($con, $_POST['product_tittle']);
    $product_description = mysqli_real_escape_string($con, $_POST['product_description']);
    $product_keyword = mysqli_real_escape_string($con, $_POST['product_keyword']);
    $product_categories = mysqli_real_escape_string($con, $_POST['product_categories']);
    $product_brand = mysqli_real_escape_string($con, $_POST['product_brands']);
    $product_Price = mysqli_real_escape_string($con, $_POST['product_Price']);
    $product_status = 'true';

    // Image accessing
    $product_image_1 = $_FILES['product_image_1']['name'];
    $product_image_2 = $_FILES['product_image_2']['name'];
    $product_image_3 = $_FILES['product_image_3']['name'];

    // Image accessing tmp
    $tmp_product_image_1 = $_FILES['product_image_1']['tmp_name'];
    $tmp_product_image_2 = $_FILES['product_image_2']['tmp_name'];
    $tmp_product_image_3 = $_FILES['product_image_3']['tmp_name'];

    // Checking empty
    if (
        $product_tittle == '' || $product_description == ''
        || $product_keyword == '' || $product_categories == ''
        || $product_brand == '' || $product_Price == ''
        || $product_image_1 == '' || $product_image_2 == ''
        || $product_image_3 == ''
    ) {
        echo "<script>alert('Please Fill all available fields')</script>";
        exit();
    } else {
        // Check if the product already exists
        $check_product_query = "SELECT * FROM `products` WHERE product_tittle='$product_tittle'";
        $check_result = mysqli_query($con, $check_product_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Product already exists
            echo "<script>alert('Product already exists!')</script>";
            exit();
        } else {
            move_uploaded_file($tmp_product_image_1, "../images/$product_image_1");
            move_uploaded_file($tmp_product_image_2, "../images/$product_image_2");
            move_uploaded_file($tmp_product_image_3, "../images/$product_image_3");

            // Insert query
            $insert_products = "INSERT INTO `products` (product_tittle, product_description, product_keyword, categorie_id,
            brand_id, product_image1, product_image2, product_image3, product_price, date, status)
            VALUES ('$product_tittle', '$product_description', '$product_keyword', '$product_categories',
            '$product_brand', '$product_image_1', '$product_image_2', '$product_image_3',
            '$product_Price', NOW(), '$product_status')";

            $result_query = mysqli_query($con, $insert_products);
            if ($result_query) {
                echo "<script>alert('Successfully inserted product')</script>";
            } else {
                echo "<script>alert('Error inserting product: " . mysqli_error($con) . "')</script>";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products - Admin Dashboard</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Anta&family=Barrio&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=RocknRoll+One&display=swap">
</head>
<style>
    .buy-btn {
        margin-top: 10px;
        font-family: "Barrio";
        font-size: 0.9rem;
        font-weight: 700;
        outline: none;
        border: none;
        background-color: rgb(255, 238, 1);
        color: rgb(0, 2, 3);
        padding: 13px 30px;
        text-transform: uppercase;
        cursor: pointer;
        transition: 0.5s ease;
        border-radius: 12px;
    }

    .buy-btn:hover {
        background-color: rgba(0, 7, 2, 0.918);
        border-radius: 12px;
        color: rgb(255, 254, 254);
        box-shadow: antiquewhite 5px;
    }

    #in-cate {
        font-family: "Poppins";
    }
</style>

<body>
    <div class="container">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h1 class="text-center mb-4">Insert Products</h1>
                <!--Form-->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Title -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-outline">
                                <label for="product_tittle" class="form-label">Product Title</label>
                                <input type="text" name="product_tittle" id="product_tittle" class="form-control"
                                    placeholder="Enter Product Name" required>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-outline">
                                <label for="product_description" class="form-label">Product Description</label>
                                <input type="text" name="product_description" id="product_description"
                                    class="form-control" placeholder="Enter Product Description" required>
                            </div>
                        </div>

                        <!-- Keyword -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-outline">
                                <label for="product_keyword" class="form-label">Product Keyword</label>
                                <input type="text" name="product_keyword" id="product_keyword" class="form-control"
                                    placeholder="Enter Product Keyword" required>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-outline">
                                <label for="product_categories" class="form-label">Product Category</label>
                                <select name="product_categories" id="product_categories" class="form-select" required>
                                    <option value="">Select a Category</option>
                                    <?php
                                    $select_query = "SELECT * FROM `categories`";
                                    $result_query = mysqli_query($con, $select_query);
                                    while ($row = mysqli_fetch_assoc($result_query)) {
                                        $category_title = $row['categorie_tittle'];
                                        $category_id = $row['categorie_id'];
                                        echo "<option value='$category_id'>$category_title</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Brands -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-outline">
                                <label for="product_brands" class="form-label">Product Brand</label>
                                <select name="product_brands" id="product_brands" class="form-select" required>
                                    <option value="">Select a Brand</option>
                                    <?php
                                    $select_query = "SELECT * FROM `brands`";
                                    $result_query = mysqli_query($con, $select_query);
                                    while ($row = mysqli_fetch_assoc($result_query)) {
                                        $brand_title = $row['brand_tittle'];
                                        $brand_id = $row['brand_id'];
                                        echo "<option value='$brand_id'>$brand_title</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Image 1 -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-outline">
                                <label for="product_image_1" class="form-label">Product Image 1</label>
                                <input type="file" name="product_image_1" id="product_image_1" class="form-control"
                                    required>
                            </div>
                        </div>

                        <!-- Image 2 -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-outline">
                                <label for="product_image_2" class="form-label">Product Image 2</label>
                                <input type="file" name="product_image_2" id="product_image_2" class="form-control"
                                    required>
                            </div>
                        </div>

                        <!-- Image 3 -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-outline">
                                <label for="product_image_3" class="form-label">Product Image 3</label>
                                <input type="file" name="product_image_3" id="product_image_3" class="form-control"
                                    required>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-outline">
                                <label for="product_Price" class="form-label">Product Price</label>
                                <input type="text" name="product_Price" id="product_Price" class="form-control"
                                    placeholder="Enter Product Price" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 mb-2">
                            <input type="submit" name="insert_product" class="buy-btn" value="Insert Product">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>