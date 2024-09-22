<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
    <title>Edit Account</title>
</head>

<body>
    <!---- PHP code to get User Id to access orders table----->

    <div style="border-radius: 15px; font-family:Poppins">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center ">View Products</h1>
                <table class="table table-bordered mt-5">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">Product Id</th>
                            <th scope="col">Product Title</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">product Price</th>
                            <th scope="col">Total Sold</th>
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="bg-info text-center">

                        <!---- PHP code to get orders table data to display my orders tble ----->

                        <?php
                        $get_product_details = "SELECT * FROM `products`";
                        $result_product = mysqli_query($con, $get_product_details);
                        while ($row_product = mysqli_fetch_assoc($result_product)) {

                            $Product_Id = $row_product['product_id'];
                            $Product_Title = $row_product['product_tittle'];
                            $Product_Image = $row_product['product_image1'];
                            $product_Price = $row_product['product_price'];
                            $status = $row_product['status'];
                            ?>

                        <tr class='table-info'>
                            <td>
                                <?php echo $Product_Id ?>
                            </td>
                            <td>
                                <?php echo $Product_Title ?>
                            </td>
                            <td><img src='../images/<?php echo $Product_Image ?>' width='70px' height='70px'></td>
                            <td> Rs.
                                <?php echo $product_Price ?>
                            </td>
                            <td>
                                <?php
                                $get_total_sold_count = "SELECT * FROM `orders_pending` WHERE product_id = '$Product_Id'";
                                $result_count = mysqli_query($con, $get_total_sold_count);
                                $count = mysqli_num_rows($result_count);
                                echo $count;
                                ?>
                            </td>

                            <td>
                                <?php echo $status ?>
                            </td>
                            <td><a href='index.php?edit_product=<?php echo $Product_Id ?>'><i
                                        class='bx bx-edit text-success'></i></a></a></td>
                            <td><a href='delete_product.php'><i class='bx bxs-trash mx-4 text-danger'></i></a></td>
                        </tr>
                        <?php
                        }
                        ?>





                    </tbody>
                </table>

            </div>
        </div>
    </div>



    <!-- Corrected: Removed duplicate Bootstrap JS inclusion -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
</body>

</html>