<?php

//database connection
include('../include/connect.php');
include('../functions/common_function.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUN GSM</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="shop.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .buy-btn {
        margin: 1px;
        font-family: "Barrio";
        font-size: 0.9rem;
        font-weight: 700;
        outline: none;
        border: none;
        background-color: rgb(255, 238, 1);
        color: rgb(0, 2, 3);
        text-transform: uppercase;
        cursor: pointer;
        transition: 0.5s ease;
        border-radius: 5px;
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

    .tx {
        font-size: 50px;
        font-weight: 700;
        text-align: center;
    }

    .logo {
        width: 100px;
        height: auto;
        margin-bottom: 30px;
    }

    footer {
        width: 100%;
        bottom: 0;
        background: linear-gradient(to right, rgb(255, 89, 0), rgb(2, 32, 70));
        color: #fff;
        padding: 20px;
        margin-left: 0 5rem;
        font-size: 13px;
        line-height: 20px;
        font-family: "Anta";
        border-radius: 1px;
        padding-left: 5rem;
    }

    .search {
        background-color: #f8f9fa;
        color: #495057;
        border-color: black;
        border-radius: 0.25rem;
        padding: 0.5rem 0.1rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.3rem;
        margin-left: 10px;

    }
</style>

<body>

    <!--Navigation Bar-->
    <section>
        <?php
        //number of cart items
        function cart_item()
        {
            global $con;
            $get_ip_add = getIPAddress();

            // Query to select items from the cart where the IP address matches
            $select_query = "SELECT * FROM `cart` WHERE ip_address='$get_ip_add'";
            $result_query = mysqli_query($con, $select_query);

            // Count the number of rows returned by the query
            $count_cart_items = mysqli_num_rows($result_query);

            // Output the number of items in the cart
            echo $count_cart_items;
        }

        //total of cart items
        function total_cart_price()
        {
            global $con;
            $get_ip_add = getIPAddress();

            // Query to select items from the cart where the IP address matches
            $select_query = "SELECT * FROM `cart` WHERE ip_address='$get_ip_add'";
            $result_query = mysqli_query($con, $select_query);

            // Initialize the total price to 0
            $total_price = 0;

            // Loop through the items in the cart
            while ($row = mysqli_fetch_array($result_query)) {
                // Get the product ID
                $product_id = $row['product_id'];

                // Query to select the product from the products table where the product ID matches
                $select_product = "SELECT * FROM `products` WHERE product_id='$product_id'";
                $result_product = mysqli_query($con, $select_product);

                // Get the product details
                $product_row = mysqli_fetch_array($result_product);

                // Get the product price
                $product_price = $product_row['product_price'];

                // Add the product price to the total price
                $total_price += $product_price;
            }

            // Output the total price
            echo $total_price;
        }
        ?>
        <nav class="navbar navbar-expand-lg py-4 font">
            <div class=" container">
                <a href="index.php"><img src="../index/images/loogo.png" alt="logo" width="100px" height="70px" /></a>
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse animated-underline" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../index/index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../shop/shop.php">Shop</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Cantact Us</a>
                        </li>

                        <li class="nav-item">
                            <i class="fa-solid fa-user nav-link"></i>
                            <a href="../shop/cart.php"> <i class="fa-solid fa-cart-shopping nav-link">
                                    <sup><?php cart_item() ?></sup>
                                </i></a>
                        </li>
                    </ul>
                    </form>
                </div>

            </div>
        </nav>


    </section>

    <!--call cart function-->
    <?php
    cart();
    ?>
    <!--cart table-->
    <section>
        <form action="" method="POST">
            <table class="table table-hover table-dark container table-bordered
        text-center">

                <tbody>
                    <!--cart Delete-->
                    <?php
                    function cart_delete()
                    {
                        global $con;

                        if (isset($_POST['remove_cart'])) {
                            if (isset($_POST['removeitem']) && !empty($_POST['removeitem'])) {
                                foreach ($_POST['removeitem'] as $remove_id) {
                                    // Sanitize input to prevent SQL injection
                                    $remove_id = mysqli_real_escape_string($con, $remove_id);
                                    $delete_product = "DELETE FROM `cart` WHERE product_id='$remove_id'";
                                    $run_delete = mysqli_query($con, $delete_product);

                                    if ($run_delete) {
                                        // Redirect to cart page after deletion
                                        echo "<script>window.open('cart.php','_self')</script>";
                                    } else {
                                        // Handle error if the query fails
                                        echo "<script>alert('Failed to remove item from cart.'); window.open('cart.php','_self')</script>";
                                    }
                                }
                            } else {
                                // Show message if no items are selected
                                echo "<script>alert('Please select at least one item to remove.'); window.open('cart.php','_self')</script>";
                            }
                        }
                    }
                    // Call the function
                    cart_delete();
                    ?>

                    <!--cart Upadate -->
                    <?php
                    global $con;
                    $get_ip_add = getIPAddress();
                    $total_price = 0; // This will hold the subtotal
                    
                    // Fetch items in the cart for the given IP address
                    $cart_query = "SELECT * FROM `cart` WHERE ip_address='$get_ip_add'";
                    $result = mysqli_query($con, $cart_query);

                    // Get table headings only if there are items in the cart
                    $result_count = mysqli_num_rows($result);
                    if ($result_count > 0) {
                        echo ' 
                        <thead>
                        <tr>
                            <th scope="col">Product Title</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Remove</th>
                            <th scope="col" colspan="2">Operations</th>
                        </tr>
                    </thead>';
                    }

                    // Initialize an array to store updated quantities
                    $updated_quantities = [];

                    if (isset($_POST['update_cart'])) {
                        $updated_quantities = $_POST['qty'];
                    }

                    while ($row = mysqli_fetch_array($result)) {
                        $product_id = $row['product_id'];

                        // Fetch product details from the products table
                        $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                        $result_products = mysqli_query($con, $select_products);

                        while ($row_product_price = mysqli_fetch_array($result_products)) {
                            $product_price = $row_product_price['product_price'];
                            $product_tittle = $row_product_price['product_tittle'];
                            $product_image1 = $row_product_price['product_image1'];

                            // Update cart quantity and recalculate total price
                            if (isset($_POST['update_cart'])) {
                                $quantity = isset($updated_quantities[$product_id]) ? (int) $updated_quantities[$product_id] : $row['quantity'];
                                $update_cart = "UPDATE `cart` SET quantity='$quantity' WHERE ip_address='$get_ip_add' AND product_id='$product_id'";
                                mysqli_query($con, $update_cart);
                            } else {
                                $quantity = $row['quantity'];
                            }

                            // Calculate the total price based on updated quantity
                            $total_price += $product_price * $quantity;

                            ?>

                            <tr>
                                <td><?php echo $product_tittle; ?></td>
                                <td><img src="../images/<?php echo $product_image1; ?>"
                                        style="width: 100%; height: 70px; object-fit:contain;"></td>
                                <td>
                                    <input type="text" name="qty[<?php echo $product_id; ?>]" value="<?php echo $quantity; ?>"
                                        class="form-input w-50 bg-white rounded px-3 py-2 text-black">
                                </td>
                                <td> Rs. <?php echo $product_price * $quantity; ?></td>
                                <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                <td>
                                    <input type="submit" value="Add" class="bg-success px-3 py-2 border-0 rounded m-1"
                                        name="update_cart">
                                </td>
                                <td colspan="2">
                                    <input type="submit" value="Delete" class="bg-danger px-3 py-2 border-0 rounded m-1"
                                        name="remove_cart">
                                </td>
                            </tr>

                        <?php }
                    }


                    ?>
                </tbody>

            </table>
        </form>
    </section>

    <?php
    global $con;
    $get_ip_add = getIPAddress();

    // Fetch items in the cart for the given IP address
    $cart_query = "SELECT * FROM `cart` WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    $result_count = mysqli_num_rows($result);
    if ($result_count > 0) {
        // Subtotal Section
        echo "
        <div class='px-3 container'>
            <h3>Subtotal: <strong>Rs.$total_price</strong></h3>
            <a href='../user_panel/checkout.php'><button class='btn buy-btn mb-3'>Check Out</button></a>
            <a href='../shop/shop.php'><button class='btn buy-btn mb-3'>Continue Shopping</button></a>
        </div>";
    } else {
        echo "<h1 class='tx mb-5'>Your Cart is Empty</h1>
        <a href='../shop/shop.php'><button class='btn buy-btn mb-3 m-5'>Continue Shopping</button></a>
        ";
    }
    ?>



    <!--footer-------------->
    <footer class="footer col-md-12 col-lg-12 col-sm-12">
        <div class="row">
            <div class="col">
                <img style="margin-bottom: 1rem;" src="../index/images/logoo.jpg" width="180px" height="70px" />
                <p>
                    Immerse yourself in a world of visual wonder with SUN GSM,
                    your premier destination for captivating imagery. Explore the latest
                    releases, delve into exclusive interviews, and dive deep into expert
                    reviews. Unleash the power of visuals. 🎬✨ #SUNGSM
                </p>
            </div>
            <div class="col">
                <h3>
                    Location
                    <div class="underline"><span></span></div>
                </h3>
                <p>No 193/5 Bandaranayakepura</p>
                <p>POSTOL: 10240, Mattegoda.</p>
                <p class="email-id">sun.g.s.m.mobi@gmail.com</p>
                <h4>+94-113467895 <br />+94-713130053</h4>
            </div>
            <div class="col">
                <h3>
                    Links
                    <div class="underline"><span></span></div>
                </h3>
                <ul>
                    <li><a class="a" href="#">Home</a></li>
                    <li><a class="a" href="#">Shop</a></li>
                    <li><a class="a" href="#">Blog</a></li>
                    <li><a class="a" href="#">Contact Us</a></li>
                    <li><a class="a" href="#">Sign In</a></li>
                    <li>
                        <a class="a" href="#">Registration</a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <h3>
                    Newsletter
                    <div class="underline"><span></span></div>
                </h3>
                <form>
                    <i class="bx bxs-envelope" undefined></i>
                    <input type="text" placeholder="Enter Your Email ID" required />
                    <button type="submit">
                        <i class="bx bxs-right-arrow-circle"></i>
                    </button>
                </form>
                <div class="social-icons">
                    <h3>
                        Follow Us
                        <div class="underline"><span></span></div>
                    </h3>

                    <i class="bx bxl-facebook-circle"></i>
                    <i class="bx bxl-instagram-alt"></i>
                    <i class="bx bxl-twitter"></i>
                    <i class="bx bxl-whatsapp"></i>
                    <i class="bx bxl-youtube"></i>
                </div>
            </div>
        </div>
        <hr />
        <p class="copyright">SUN GSM © 2024 - All Right Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="../index/index.js"></script>
</body>

</html>