<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//database connection
include('../include/connect.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
    <title>View Brands</title>
</head>

<body>
    <div style="border-radius: 15px; font-family:Poppins">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">View Catogory</h1>
                <table class="table table-bordered mt-5">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Categorie</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="bg-info text-center">
                        <?php
                        // Fetch catagories details
                        $get_catagories_details = "SELECT * FROM `categories`";
                        $result_categories = mysqli_query($con, $get_catagories_details);
                        while ($row_atagories = mysqli_fetch_assoc($result_categories)) {
                            $categories_id = $row_atagories['categorie_id'];
                            $categories_title = $row_atagories['categorie_tittle'];
                            ?>

                            <tr class='table-info'>
                                <td><?php echo $categories_id ?></td>
                                <td><?php echo $categories_title ?></td>
                                <td><a href='edit_categories.php?edit_categories=<?php echo $categories_id ?>'><i
                                            class='bx bx-edit text-success'></i></a></td>
                                <td>
                                    <!-- Anchor tag for delete with confirmation -->
                                    <a href="delete_categories.php?delete_categories=<?php echo $categories_id ?>"
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class='bx bxs-trash mx-4 text-danger'></i>
                                    </a>
                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
</body>

</html>