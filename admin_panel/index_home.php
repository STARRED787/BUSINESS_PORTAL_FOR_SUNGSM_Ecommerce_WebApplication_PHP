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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./index.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    referrerpolicy="no-referrer" />
</head>

<body>
  <!--Admin Bar-->
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <!-- Sidebar -->
      <div class="col-auto col-md-3 col-xl-3 px-sm-2 px-0 bg-dark">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 font">
          <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Admin Dashboard</span>
          </a>
          <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
              <a href="index_home.php?count_board" class="nav-link align-middle px-0 text-white">
                <i class='bx bxs-objects-vertical-bottom'></i>
                <span class="ms-1 d-none d-sm-inline">Count Board</span>
              </a>
              <a href="index_home.php?insert_product" class="nav-link align-middle px-0 text-white">
                <i class="bx bxs-home"></i>
                <span class="ms-1 d-none d-sm-inline">Insert Products</span>
              </a>
              <a href="index_home.php?view_product" class="nav-link align-middle px-0 text-white">
                <i class="bx bxs-package"></i>
                <span class="ms-1 d-none d-sm-inline">View Products</span>
              </a>
              <a href="index_home.php?insert_categori" class="nav-link align-middle px-0 text-white">
                <i class="fa-solid fa-layer-group"></i>
                <span class="ms-1 d-none d-sm-inline">Insert Categories</span>
              </a>
              <a href="index_home.php?view_categories" class="nav-link align-middle px-0 text-white">
                <i class="fa-solid fa-list"></i>
                <span class="ms-1 d-none d-sm-inline">View Categories</span>
              </a>
              <a href="index_home.php?insert_brand" class="nav-link align-middle px-0 text-white">
                <i class="fa-solid fa-tag"></i>
                <span class="ms-1 d-none d-sm-inline">Insert Brands</span>
              </a>
              <a href="index_home.php?view_brands" class="nav-link align-middle px-0 text-white">
                <i class="fa-solid fa-tags"></i>
                <span class="ms-1 d-none d-sm-inline">View Brands</span>
              </a>
              <a href="index_home.php?view_orders" class="nav-link align-middle px-0 text-white">
                <i class="fa-solid fa-truck"></i>
                <span class="ms-1 d-none d-sm-inline">All Orders</span>
              </a>
              <a href="index_home.php?view_payements" class="nav-link align-middle px-0 text-white">
                <i class="fa-solid fa-credit-card"></i>
                <span class="ms-1 d-none d-sm-inline">All Payments</span>
              </a>
              <a href="index_home.php?view_users" class="nav-link align-middle px-0 text-white">
                <i class="fa-solid fa-user"></i>
                <span class="ms-1 d-none d-sm-inline">List Users</span>
              </a>
              <a href="#" class="nav-link align-middle px-0 text-white">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="ms-1 d-none d-sm-inline">Logout</span>
              </a>
            </li>
          </ul>
          <hr />
        </div>
      </div>

      <!-- Dynamic Content Area -->
      <div class="col py-3">
        <?php
        if (isset($_GET['insert_categori'])) {
          include('insert_categories.php');
        }
        if (isset($_GET['count_board'])) {
          include('count_board.php');
        }
        if (isset($_GET['view_categories'])) {
          include('view_categories.php');
        }
        if (isset($_GET['insert_brand'])) {
          include('insert_brand.php');
        }
        if (isset($_GET['view_brands'])) {
          include('view_brands.php');
        }
        if (isset($_GET['insert_product'])) {
          include('insert_product.php');
        }
        if (isset($_GET['view_product'])) {
          include('view_product.php');
        }
        if (isset($_GET['view_orders'])) {
          include('view_orders.php');
        }
        if (isset($_GET['view_payements'])) {
          include('view_payements.php');
        }
        if (isset($_GET['view_users'])) {
          include('view_users.php');
        }
        if (isset($_GET['delete_users'])) {
          include('delete_users.php');
        }
        ?>
      </div>
    </div>
  </div>

  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    referrerpolicy="no-referrer"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ZOvcITpNrnYq8Xiwb6Orp9+7DSgqe3pA/NYopSKkPAUDT60e1iEFOkM8UEkUviLv" crossorigin="anonymous">
    </script>
</body>

</html>