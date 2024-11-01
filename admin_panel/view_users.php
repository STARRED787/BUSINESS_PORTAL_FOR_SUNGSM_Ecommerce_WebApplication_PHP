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
    <title>View User</title>
</head>

<body>
    <div style="border-radius: 15px; font-family:Poppins">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">View Users</h1>
                <table class="table table-bordered mt-5">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">User ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Image</th>
                            <th scope="col">Adress</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="bg-info text-center">
                        <?php
                        // Fetch product details
                        $get_product_details = "SELECT * FROM `user`";
                        $result_product = mysqli_query($con, $get_product_details);
                        while ($row_product = mysqli_fetch_assoc($result_product)) {
                            $user_id = $row_product['user_id'];
                            $user_username = $row_product['username'];
                            $user_email = $row_product['user_email'];
                            $user_image = $row_product['user_image'];
                            $user_address = $row_product['user_address'];
                            $user_mobile = $row_product['user_mobile'];
                            ?>
                            <tr class='table-info'>
                                <td><?php echo $user_id ?></td>
                                <td><?php echo $user_username ?></td>
                                <td><?php echo $user_email ?></td>
                                <td><img src='../images/<?php echo $user_image ?>' width='70px' height='70px'></td>
                                <td> <?php echo $user_address ?></td>
                                <td><?php echo $user_mobile ?></td>
                                <td>
                                    <!-- Anchor tag for delete with confirmation -->
                                    <a href="delete_users.php?delete_users=<?php echo $user_id ?>"
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