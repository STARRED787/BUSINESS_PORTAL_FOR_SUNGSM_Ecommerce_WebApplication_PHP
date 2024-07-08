<?php

include ('../include/connect.php');
if (isset($_POST['insert_product'])) {
    $product_tittle = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $product_categories = $_POST['product_categories'];
    $product_brand = $_POST['product_brands'];
    $product_Price = $_POST['product_Price'];
    $product_status = 'true';

    //image accsesing
    $product_image_1 = $_FILES['product_image_1']['name'];
    $product_image_2 = $_FILES['product_image_2']['name'];
    $product_image_3 = $_FILES['product_image_3']['name'];

    //image accsesing tmp
    $tmp_product_image_1 = $_FILES['product_image_1']['tmp_name'];
    $tmp_product_image_2 = $_FILES['product_image_2']['tmp_name'];
    $tmp_product_image_3 = $_FILES['product_image_3']['tmp_name'];


    // cheaking empty
    if (
        $product_tittle == '' or $product_description == ''
        or $product_keyword == '' or $product_categories == ''
        or $product_brand == '' or $product_Price == ''
        or $product_image_1 == '' or $product_image_2 == ''
        or $product_image_3 == ''
    ) {
        echo "<script>alert('Please Fill all available fields')</script>";
        exit();
    } else {
        move_uploaded_file($tmp_product_image_1, "./product_images/ $product_image_1");
        move_uploaded_file($tmp_product_image_2, "./product_images/ $product_image_2");
        move_uploaded_file($tmp_product_image_3, "./product_images/ $product_image_3");

        //insert query
        $insert_products = "INSERT INTO `products` (product_tittle, product_description, product_keyword, categorie_id,
        brand_id, product_image1, product_image2, product_image3, product_price, date, status)
        VALUES ('$product_tittle', '$product_description', '$product_keyword', '$product_categories',
        '$product_brand', '$product_image_1', '$product_image_2', '$product_image_3',
        '$product_Price', NOW(), '$product_status')";

        $result_query = mysqli_query($con, $insert_products);
        if ($result_query) {
            echo "<script>alert('Successefuly insert product')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <h1 class="text-center">
            Insert Products
        </h1>
        <!--Form-->

        <form action="" method="post" enctype="multipart/form-data">

            <!--tittle-->
            <div class="form-outline mb-4 m-auto" style="width: 600px;">
                <label for="product_title" class="form-label">
                    Product Tittle
                </label>
                <input type="text" name="product_title" id="product_title" class="form-control"
                    placeholder="Enter Product Name" required=" required">
            </div>

            <!--description-->
            <div class="form-outline mb-4 m-auto" style="width: 600px;">
                <label for="product_description" class="form-label">
                    Product Description
                </label>
                <input type="text" name="product_description" id="product_description" class="form-control"
                    placeholder="Enter Product Description" required=" required">
            </div>

            <!--keyword-->
            <div class="form-outline mb-4 m-auto" style="width: 600px;">
                <label for="product_keyword" class="form-label">
                    Product keyword
                </label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control"
                    placeholder="Enter Product keyword" required=" required">
            </div>

            <!--categories-->
            <div class="form-outline mb-4 m-auto" style="width: 600px;">
                <select name="product_categories" class="form-select">
                    <option value=""> Select a Category</option>
                    <?php
                    $select_query = "Select * from `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['categorie_tittle'];
                        $category_id = $row['categorie_id'];
                        echo "<option value=' $category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>

            <!--Brands-->
            <div class="form-outline mb-4 m-auto" style="width: 600px;">
                <select name="product_brands" class="form-select">
                    <option value=""> Select a Brand</option>
                    <?php
                    $select_query = "Select * from `brands`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_tittle'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>

            <!--Image 1-->
            <div class="form-outline mb-4 m-auto" style="width: 600px;">
                <label for="product_image_1" class="form-label">
                    Product Image 1
                </label>
                <input type="file" name="product_image_1" id="product_image_1" class="form-control"
                    required=" required">
            </div>

            <!--Image 2-->
            <div class="form-outline mb-4 m-auto" style="width: 600px;">
                <label for="product_image_2" class="form-label">
                    Product Image 2
                </label>
                <input type="file" name="product_image_2" id="product_image_2" class="form-control"
                    required=" required">
            </div>

            <!--Image 3-->
            <div class="form-outline mb-4 m-auto" style="width: 600px;">
                <label for="product_image_3" class="form-label">
                    Product Image 3
                </label>
                <input type="file" name="product_image_3" id="product_image_3" class="form-control"
                    required=" required">
            </div>

            <!--Price-->
            <div class="form-outline mb-4 m-auto" style="width: 600px;">
                <label for="product_Price" class="form-label">
                    Product Price
                </label>
                <input type="text" name="product_Price" id="product_Price" class="form-control"
                    placeholder="Enter Product price" required=" required">
            </div>

            <!--insert product-->
            <div class="form-outline mb-4 m-auto" style="width: 600px;">
                <input type="submit" name="insert_product" class="btn-home" value="Insert Products">
            </div>
        </form>
    </div>
</body>

</html>