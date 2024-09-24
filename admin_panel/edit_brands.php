<?php
// PHP code to display tbl product data in edit form fields

if (isset($_GET['edit_product'])) {
    $product_id = $_GET['edit_product'];

    $select_query = "SELECT * FROM `products` WHERE product_id='$product_id'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $product_tittle = $row_fetch['product_tittle'];

}
?>

<head>

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
    <div class="d-flex justify-content-center" style="border-radius: 15px; font-family:Poppins">
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

    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>

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
</body>
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
        echo "<script>
            toastr.success('Product updated successfully!');
           
            </script>";
    } else {
        echo "<script>toastr.error('Product update failed.');</script>";
    }
}
?>