<?php
include("../include/connect.php");
// PHP code to display tbl product data in edit form fields

if (isset($_GET['edit_product'])) {
    $product_id = $_GET['edit_product'];

    $select_query = "SELECT * FROM `products` WHERE product_id='$product_id'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $product_tittle = $row_fetch['product_tittle'];
    $product_description = $row_fetch['product_description'];
    $product_keyword = $row_fetch['product_keyword'];
    $categorie_id = $row_fetch['categorie_id'];
    $brand_id = $row_fetch['brand_id'];
    $product_image1 = $row_fetch['product_image1'];
    $product_image2 = $row_fetch['product_image2'];
    $product_image3 = $row_fetch['product_image3'];
    $product_price = $row_fetch['product_price'];
}
?>




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <style>
        div {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>



<div class="d-flex justify-content-center mt-4" style="border-radius: 15px; font-family:Poppins">
    <div class="card" style="width:100%; max-width: 600px;">
        <div class="card-body">
            <h1 class="text-center">Edit Product</h1>
            <!--Form-->
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <div class="row">
                    <!-- Title -->
                    <div class="col-12 col-md-6 mb-4">
                        <div class="form-outline">
                            <label for="product_title" class="form-label">Product Title</label>
                            <input type="text" name="product_tittle" id="product_tittle" class="form-control"
                                value='<?php echo isset($product_tittle) ? $product_tittle : ''; ?>' required>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12 col-md-6 mb-4">
                        <div class="form-outline">
                            <label for="product_description" class="form-label">Product Description</label>
                            <input type="text" name="product_description" id="product_description" class="form-control"
                                value='<?php echo isset($product_description) ? $product_description : ''; ?>' required>
                        </div>
                    </div>

                    <!-- Keyword -->
                    <div class="col-12 col-md-6 mb-4">
                        <div class="form-outline">
                            <label for="product_keyword" class="form-label">Product Keyword</label>
                            <input type="text" name="product_keyword" id="product_keyword" class="form-control"
                                value='<?php echo isset($product_keyword) ? $product_keyword : ''; ?>' required>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="col-12 col-md-6 mb-4">
                        <div class="form-outline">
                            <label for="categorie_id" class="form-label">Product Category</label>
                            <select name="categorie_id" id="categorie_id" class="form-select" required>
                                <!-- Default selected option based on fetched data -->
                                <option value="">
                                    <?php echo isset($category_title) ? $category_title : 'Select a Category'; ?>
                                </option>
                                <?php
                                // Fetch all categories
                                $select_query = "SELECT * FROM `categories`";
                                $result_query = mysqli_query($con, $select_query);
                                while ($row = mysqli_fetch_assoc($result_query)) {
                                    $category_title = $row['categorie_tittle'];
                                    $category_id = $row['categorie_id'];

                                    // Check if this category is the one that was already selected for the product
                                    $selected = ($category_id == $categorie_id) ? "selected" : "";

                                    // Display each category with the corresponding value and selected state
                                    echo "<option value='$category_id' $selected>$category_title</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Brands -->
                    <div class="col-12 col-md-6 mb-4">
                        <div class="form-outline">
                            <label for="brand_id" class="form-label">Product Brand</label>
                            <select name="brand_id" id="brand_id" class="form-select" required>
                                <!-- Default selected option based on fetched data -->
                                <option value="">
                                    <?php echo isset($brand_title) ? $brand_title : ""; ?>
                                </option>
                                <?php
                                // Fetch all brands
                                $select_query = "SELECT * FROM `brands`";
                                $result_query = mysqli_query($con, $select_query);
                                while ($row = mysqli_fetch_assoc($result_query)) {
                                    $brand_title = $row['brand_tittle'];
                                    $brand_id = $row['brand_id'];

                                    // Check if this brand is the one that was already selected for the product
                                    $selected = ($brand_id == $brand_id) ? "selected" : "";

                                    // Display each brand with the corresponding value and selected state
                                    echo "<option value='$brand_id' $selected>$brand_title</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
        </div>

        <!-- Product Images (1, 2, 3) -->
        <div class="col-12">
            <div class="row">
                <!-- Image 1 -->
                <div class="col-4 mb-4 text-center">
                    <img src="../images/<?php echo $product_image1; ?>" alt="Image 1" class="img-fluid mb-2"
                        style="width:100px; height:100px; object-fit:cover; border-radius:10px;">
                    <label for="product_image_1" class="form-label">Image 1</label>
                    <input type="file" name="product_image_1" id="product_image_1" class="form-control">
                </div>

                <!-- Image 2 -->
                <div class="col-4 mb-4 text-center">
                    <img src="../images/<?php echo $product_image2; ?>" alt="Image 2" class="img-fluid mb-2"
                        style="width:100px; height:100px; object-fit:cover; border-radius:10px;">
                    <label for="product_image_2" class="form-label">Image 2</label>
                    <input type="file" name="product_image_2" id="product_image_2" class="form-control">
                </div>

                <!-- Image 3 -->
                <div class="col-4 mb-4 text-center">
                    <img src="../images/<?php echo $product_image3; ?>" alt="Image 3" class="img-fluid mb-2"
                        style="width:100px; height:100px; object-fit:cover; border-radius:10px;">
                    <label for="product_image_3" class="form-label">Image 3</label>
                    <input type="file" name="product_image_3" id="product_image_3" class="form-control">
                </div>
            </div>
        </div>

        <!-- Price -->
        <div class="col-12 col-md-6 mb-4">
            <div class="form-outline">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control"
                    value='<?php echo isset($product_price) ? $product_price : ''; ?>' required>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-12 mb-2">
            <input type="submit" name="product_update" class="btn btn-primary w-100" value="Update Product">
        </div>
    </div>
    </form>
</div>
</div>
</div>

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>

<!-- PHP code to update product data -->
<?php
if (isset($_POST['product_update'])) {
    $product_tittle = $_POST['product_tittle'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $categorie_id = $_POST['categorie_id'];
    $brand_id = $_POST['brand_id'];
    $product_price = $_POST['product_price'];

    // Handling product images
    $product_image1 = $_FILES['product_image_1']['name'];
    $product_image1_tmp = $_FILES['product_image_1']['tmp_name'];

    $product_image2 = $_FILES['product_image_2']['name'];
    $product_image2_tmp = $_FILES['product_image_2']['tmp_name'];

    $product_image3 = $_FILES['product_image_3']['name'];
    $product_image3_tmp = $_FILES['product_image_3']['tmp_name'];

    // If new image uploaded, move to the folder, else keep the existing one
    if (!empty($product_image1)) {
        move_uploaded_file($product_image1_tmp, "../images/$product_image1");
    } else {
        $product_image1 = $row_fetch['product_image1'];
    }

    if (!empty($product_image2)) {
        move_uploaded_file($product_image2_tmp, "../images/$product_image2");
    } else {
        $product_image2 = $row_fetch['product_image2'];
    }

    if (!empty($product_image3)) {
        move_uploaded_file($product_image3_tmp, "../images/$product_image3");
    } else {
        $product_image3 = $row_fetch['product_image3'];
    }

    // Update the product
    $update_query = "UPDATE `products` SET 
        product_tittle='$product_tittle',
        product_description='$product_description',
        product_keyword='$product_keyword',
        categorie_id='$categorie_id',
        brand_id='$brand_id',
        product_image1='$product_image1',
        product_image2='$product_image2',
        product_image3='$product_image3',
        product_price='$product_price' 
        WHERE product_id='$product_id'";

    $result_update = mysqli_query($con, $update_query);
    if ($result_update) {
        echo "<script>$(document).ready(function() { 
            toastr.success('Product Update Sucessful.');
            setTimeout(function() { window.location.href = 'index_home.php?view_product'; }, 2000); // Delay for 2 seconds
        });</script>";
    } else {
        echo "<script>toastr.error('Product update failed.');</script>";
    }
}
?>