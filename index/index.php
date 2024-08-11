<?php

//database connection
include ('../include/connect.php');
include ('../functions/common_function.php');

?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>IrishVisuals</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../index/index.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
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
        <a href="index.php"><img src="../index/images/logo.png" alt="logo" width="70px" height="70px" /></a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
              <i class="fa-solid fa-cart-shopping nav-link">
                <sup><?php cart_item() ?></sup>
              </i>
              Total price Rs. <?php total_cart_price() ?>

            </li>

          </ul>
          <form class="d-flex" action="search.php" method="get">

            <input class="form-control m-2" type="search" palceholder="Search" aria-label="Search" style="width: 300px;"
              name="search_data">

            <input type="submit" value="search" class="btn-outline search" name="search_data_product">
          </form>
        </div>

      </div>
    </nav>


  </section>
  <!--Home-->
  <section id="home">
    <div class="container">
      <h5>NEW ARRIVALS</h5>
      <h1 style="color: rgb(0, 0, 0)">Best Prices For Deals</h1>
      <p style="color: rgb(0, 0, 0)">IRISH Offers for the best products</p>
      <button style="border-radius: 12px" class="homebtn">Shop Now</button>
    </div>
  </section>

  <!--new-------------->
  <section id="new">
    <div class="p-0 m-0">
      <div class="one p-0">
        <img src="../index/images/phone.jpg" alt="" class="img-fluid" />
        <div class="details">
          <h2>Get New Phone</h2>
          <button class="text-uppercase" id="newbtn">Shop Now</button>
        </div>
      </div>

      <div class="one p-0">
        <img src="../index/images/accessories.jfif" alt="" class="img-fluid" />
        <div class="details">
          <h2>Mobile Accessories</h2>

          <button class="text-uppercase" id="newbtn">Shop Now</button>
        </div>
      </div>

      <div class="one p-0">
        <img src="../index/images/laptop.jpg" alt="" class="img-fluid" />
        <div class="details">
          <h2>Laptop for Study</h2>
          <button class="text-uppercase" id="newbtn">Shop Now</button>
        </div>
      </div>

      <div class="one p-0">
        <img src="../index/images/movies.jpg" alt="" class="img-fluid" />
        <div class="details">
          <h2>Buy DVD Games</h2>
          <button class="text-uppercase" id="newbtn">Shop Now</button>
        </div>
      </div>
    </div>
  </section>


  <!--footer-------------->
  <footer class="footer col-md-12 col-lg-12 col-sm-12">
    <div class="row">
      <div class="col">
        <img src="logo.png" class="logo" />
        <p>
          Immerse yourself in a world of visual wonder with IRISH Visuals,
          your premier destination for captivating imagery. Explore the latest
          releases, delve into exclusive interviews, and dive deep into expert
          reviews. Unleash the power of visuals. 🎬✨ #IRISHVisuals
        </p>
      </div>
      <div class="col">
        <h3>
          Location
          <div class="underline"><span></span></div>
        </h3>
        <p>Mattegoda Bus Stop</p>
        <p>Polgasowita,</p>
        <p>POSTOL: 10240, Mattegoda.</p>
        <p class="email-id">irishvisuals@gmail.com</p>
        <h4>+94-113467895 <br />+94-716634743</h4>
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
    <p class="copyright">IRISH Visuals © 2024 - All Right Reserved</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script src="../index/index.js"></script>
</body>

</html>