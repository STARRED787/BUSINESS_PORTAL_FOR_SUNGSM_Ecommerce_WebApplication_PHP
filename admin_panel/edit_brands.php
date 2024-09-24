<?php
// PHP code to display tbl product data in edit form fields

if (isset($_GET['edit_brands'])) {
    $brand_id = $_GET['edit_brands'];

    $select_query = "SELECT * FROM `brands` WHERE brand_id ='$brand_id'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $brand_tittle = $row_fetch['brand_tittle'];

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
                <h1 class="text-center">Edit Brand</h1>
                <!--Form-->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Title -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-outline">
                                <label for="product_title" class="form-label">Brand Title</label>
                                <input type="text" name="brand_tittle" id="brand_tittle" class="form-control"
                                    value='<?php echo isset($brand_tittle) ? $brand_tittle : ''; ?>' required>

                            </div>
                        </div>

                    </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 mb-2">
                <input type="submit" name="categorie_update" class="btn btn-primary w-100" value="Update Product">
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
<?php
if (isset($_POST['categorie_update'])) {
    $brand_tittle = $_POST['brand_tittle'];

    // Update the category
    $update_query = "UPDATE `brands` SET 
        brand_tittle='$brand_tittle'
        WHERE brand_id=$brand_id";

    $result_update = mysqli_query($con, $update_query);
    if ($result_update) {
        echo "<script>$(document).ready(function() { 
            toastr.success('Category updated successfully.');
            setTimeout(function() { window.location.href = 'index.php?view_brands'; }, 2000); // Delay for 2 seconds
        });</script>";
    } else {
        echo "<script>toastr.error('Category update failed.');</script>";
    }
}
?>