<?php
// PHP code to display tbl product data in edit form fields
include("../include/connect.php");
if (isset($_GET['edit_brands'])) {
    $brand_id = $_GET['edit_brands'];

    $select_query = "SELECT * FROM `brands` WHERE brand_id ='$brand_id'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $brand_tittle = $row_fetch['brand_tittle'];

}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Brands</title>

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



<div class="d-flex justify-content-center mb-4" style="border-radius: 15px; font-family:Poppins">
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
            setTimeout(function() { window.location.href = 'index_home.php?view_brands'; }, 2000); // Delay for 2 seconds
        });</script>";
    } else {
        echo "<script>toastr.error('Category update failed.');</script>";
    }
}
?>