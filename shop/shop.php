<?php

//database connection
include ('../include/connect.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop</title>
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
</style>

<body>
  <!--Navigation Bar-->
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
            <a class="nav-link" href="#">Shop</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Cantact Us</a>
          </li>

          <li class="nav-item">
            <i class="fa-solid fa-cart-shopping nav-link"></i>
            <i class="fa-solid fa-user nav-link"></i>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-outline-success" type="submit">
            Search
          </button>
        </form>
      </div>
    </div>
  </nav>

  <section class=" bg-light">
    <!--heading Bar-->
    <div class="bg-light">
      <h3 class="text-center">Our Products</h3>
    </div>

    <!--fourth section-->
    <div class="row m-5">
      <div class="col-md-10  ">
        <!--products-->
        <div class="row">

          <div class="col-md-4  mb-4 ">
            <div class="card  ">
              <img src="../images/game2.jpg" class="card-img-top" alt="..." style=" width: 100%;
                     height: 200px; 
                     object-fit:contain">
              <div class="card-body ">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                  card's content.</p>
                <a href="#" class="btn btn-primary flex buy-btn">Add to cart</a>
                <a href="#" class="btn btn-primary m-1 buy-btn">View more</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-2 mb-4 bg-secondary p-10">
        <!--side nav-->
        <ul class=" navbar-nav me-auto m-0 text-center">
          <li class="nav-item bg-info">
            <a href="" class="nav-link">
              <h4>Category</h4>
            </a>
          </li>

          <!--PHP code to display category in DB-->
          <?php
          $select_categorys = "SELECT * from `categories`";
          $result_categorys = mysqli_query($con, $select_categorys);

          while ($row_data = mysqli_fetch_assoc($result_categorys)) {
            $category_title = $row_data['categorie_tittle'];
            $category_id = $row_data['categorie_id'];
            echo "
          <li class='nav-item bg-info'>
            <a href='' class='nav-link'>
             $category_title
            </a> ";
          }
          ?>
          </li>
          <li class="nav-item bg-info">
            <a href="" class="nav-link">
              <h4>Brands</h4>
            </a>
          </li>
          <!--PHP code to display category in DB-->
          <?php
          $select_brand = "SELECT * from `brands`";
          $result_brand = mysqli_query($con, $select_brand);

          while ($row_data = mysqli_fetch_assoc($result_brand)) {
            $brand_title = $row_data['brand_tittle'];
            $brand_id = $row_data['brand_id'];
            echo "
          <li class='nav-item bg-info'>
            <a href='' class='nav-link'>
             $brand_title
            </a> ";
          }
          ?>
        </ul>
  </section>
  <!--footer-------------->
  <footer class="footer col-md-12 col-lg-12 col-sm-12 mb-3">
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