<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//database connection
include('../include/connect.php');
include('../functions/common_function.php');
// Fetch all blog posts from the database
$sql = "SELECT * FROM blog_posts ORDER BY created_at DESC"; // Adjust the ORDER BY clause if needed
$result = mysqli_query($con, $sql);
?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUN GSM</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../index/index.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />

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

    .logoo {

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

    .font {
        font-family: 'Anta';
    }
</style>

<body style="background-image: url('../index/images/blog.jpg');">



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
            $total_price = 0;
            $cart_query = "Select * from `cart` where
                      ip_address='$get_ip_add'";
            $result = mysqli_query($con, $cart_query);
            while ($row = mysqli_fetch_array($result)) {
                $product_id = $row['product_id'];
                $select_products = "Select * from `products` where
                      product_id='$product_id'";
                $result_products = mysqli_query($con, $select_products);
                while ($row_product_price = mysqli_fetch_array($result_products)) {
                    $product_price = array($row_product_price['product_price']);
                    $price_table = $row_product_price['product_price'];
                    $product_tittle = $row_product_price['product_tittle'];
                    $product_image1 = $row_product_price['product_image1'];
                    $product_values = array_sum($product_price); // [500]
                    $total_price += $product_values; //500
                }
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
                            <a class="nav-link" href="../other/blog.php">Blog</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../other/cantact.php">Cantact Us</a>
                        </li>
                        <li class="nav-item">

                            <div data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                data-bs-placement="bottom" data-bs-content="<strong>Cart is here</strong>">
                                <a href="../shop/cart.php">
                                    <i class="fa-solid fa-cart-shopping nav-link">
                                        <sup><?php cart_item() ?></sup>
                                    </i>
                                </a>

                            </div>
                        </li>

                        <li class="nav-item">
                            Total price Rs. <?php total_cart_price() ?>
                        </li>

                    </ul>
                    <form class="d-flex" action="../shop/search.php" method="get">

                        <input class="form-control m-2 " type="search" palceholder="Search" aria-label="Search"
                            style="width: 230px;" name="search_data">

                        <input type="submit" value="search" class="btn-outline search" name="search_data_product">
                    </form>
                </div>

            </div>
        </nav>


    </section>

    <!--call cart function-->
    <?php
    cart();
    search_Product();
    ?>

    <!--Blog Section-->

    <div class="container">
        <h1 class="text-center">Blog Posts</h1>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($post = mysqli_fetch_assoc($result)): ?>
                <div class="card mb-4">
                    <div class="row g-0">
                        <?php if ($post['image']): ?>
                            <div class="col-md-6 col-12">
                                <img src="../admin_panel/<?php echo htmlspecialchars($post['image']); ?>" alt="Blog Image"
                                    class="img-fluid rounded-start w-100" style="height: 100%; object-fit: cover;">
                            </div>
                        <?php endif; ?>

                        <div class="col-md-6 col-12 d-flex flex-column">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h2>
                                <p class="card-text"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>

    <?php else: ?>
        <h2>No blog posts available.</h2>
    <?php endif; ?>
    </div>




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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
        });
    </script>

</body>

</html>