<?php
// PHP code to display tbl product data in edit form fields

if (isset($_GET['edit_product'])) {

    $select_query = "SELECT * FROM `products` WHERE product_id";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);


    $product_tittle = $row_fetch['product_tittle'];
    $product_description = $row_fetch['product_description'];
    $product_keyword = $row_fetch['product_keyword'];
    $categorie_id = $row_fetch['categorie_id'];
    $brand_id = $row_fetch['brand_id'];
    $product_image1 = $row_fetch['product_image1'];
    $product_image2 = $row_fetch['product_image1'];
    $product_image3 = $row_fetch['product_image3'];
    $product_price = $row_fetch['product_price'];

}
?>

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
<div class="d-flex justify-content-center" style="border-radius: 15px; font-family:Poppins">
    <div class="card" style="width:100%; max-width: 600px;">
        <div class="card-body">
            <h1 class="text-center ">Edit Product</h1>
            <!--Form-->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <!-- Title -->
                    <div class="col-12 col-md-6 mb-4">
                        <div class="form-outline">
                            <label for="product_title" class="form-label">Product Title</label>
                            <input type="text" name="product_title" id="product_title" class="form-control"
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
                            <label for="product_categories" class="form-label">Product Category</label>
                            <select name="product_categories" id="product_categories" class="form-select" required>
                                <option value=""><?php echo isset($categorie_id) ? $categorie_id : ''; ?></option>
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
                                <option value=""><?php echo isset($brand_id) ? $brand_id : ''; ?></option>
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
                            <label for="product_Price" class="form-label">Product Price</label>
                            <input type="text" name="product_Price" id="product_Price" class="form-control"
                                value='<?php echo isset($product_price) ? $product_price : ''; ?>' required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 mb-2">
                        <input type="submit" name="insert_product" class="btn btn-primary w-100" value="Insert Product">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>