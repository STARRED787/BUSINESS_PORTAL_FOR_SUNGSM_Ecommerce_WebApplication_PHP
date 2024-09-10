<?php

//database connection
include('../include/connect.php');
require_once('../functions/common_function.php');  // Ensure this path is correct
;
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUN GSM</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .logo {
        width: 100px;
        height: auto;
        margin-bottom: 30px;
    }

    .font {
        font-family: "Anta";
        font-weight: bold;
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



    .row {
        width: 85%;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
    }

    .col {
        flex-basis: 25%;
        padding: 15px;
    }

    .col:nth-child(2),
    .col:nth-child(3) {
        flex-basis: 10%;
    }

    .logo {
        width: 50px;
        margin-bottom: 30px;
    }

    .col h3 {
        width: fit-content;
        margin-bottom: 10px;
        position: relative;
    }

    .email-id {
        width: fit-content;
        border-bottom: 1px solid #ccc;
        margin: 20px 0;
    }

    ul li {
        list-style: none;
        margin-bottom: 12px;
    }

    ul li a {
        text-decoration: none;
        color: whitesmoke;
    }

    li .a:hover {
        color: #ff1e1e;
    }


    .social-icons h3 {
        margin-top: -2.3rem;
    }

    .social-icons .bx {
        margin-top: 0.5rem;
        margin-left: 1rem;
        margin-bottom: 0.3rem;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        font-size: 20px;
        color: #000000;
        background: whitesmoke;
        margin-right: 15px;
        cursor: pointer;
    }

    .social-icons .bx:hover {
        color: #f30c00;
    }

    hr {
        width: 90%;
        border: 0;
        border-bottom: 1.6px solid #f8f8f8;
        margin: 20px auto;
    }

    .copyright {
        text-align: center;
        text-transform: uppercase;
        margin-top: -1rem;
    }

    .underline {
        width: 100%;
        height: 6px;
        background: #ffffff;
        border-radius: 3px;
        position: absolute;
        top: 30px;
        left: 0;
        overflow: hidden;
    }

    .underline span {
        width: 15px;
        height: 100%;
        background: #ff0000;
        border-radius: 3px;
        box-shadow: 0 0 10px white;
        position: absolute;
        top: 1px;
        left: 10px;
        animation: moving 2s linear infinite;
    }

    @keyframes moving {
        0% {
            left: 0px;
        }

        100% {
            left: 100px;
        }
    }
</style>

<body style=" background-image: url(../index/images/bannerwp.jpg);">

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
        <nav class="navbar navbar-expand-lg py-4 font container">
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
                            Total price Rs. <?php total_cart_price() ?>


                        </li>

                        <?php
                        if (!isset($_SESSION['username'])) {
                            echo " <li class='nav-item'>
                           <a class='nav-link' href='#'><button style='border-radius: 12px' class='font ms-3 bg-danger '>Guest</button></a> 
                        </li>";
                        } else {
                            $username = substr($_SESSION['username'], 0, 5);
                            echo "<li class='nav-item'>
                        <a class='nav-link' href='../user_panel/user_logout.php'><button style='border-radius: 12px' class='font ms-3 bg-danger'>Logout<br> " . $username . "</button></a> 
                    </li>";
                        }
                        ?>
                    </ul>

                </div>

            </div>
        </nav>
        <!--fourth section-->
        <div>
            <div>
                <!--products-->
                <div>
                    <?php
                    if (!isset($_SESSION['username'])) {
                        include('./user_login.php');
                    } else {
                        include('../user_panel/payement.php');
                    }
                    ?>
                </div>
                <!--call cart function-->
                <?php
                cart();

                ?>
    </section>


    </section>
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