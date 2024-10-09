<!-- Content Area with Counts -->


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//database connection
include('../include/connect.php');



// Query to get counts from the relevant tables
$product_count = $con->query("SELECT COUNT(*) as count FROM products")->fetch_assoc()['count'];
$category_count = $con->query("SELECT COUNT(*) as count FROM categories")->fetch_assoc()['count'];
$brand_count = $con->query("SELECT COUNT(*) as count FROM brands")->fetch_assoc()['count'];
$order_count = $con->query("SELECT COUNT(*) as count FROM orders")->fetch_assoc()['count'];
$payment_count = $con->query("SELECT COUNT(*) as count FROM user_payements")->fetch_assoc()['count'];
$user_count = $con->query("SELECT COUNT(*) as count FROM user")->fetch_assoc()['count'];
$delevery_count = $con->query("SELECT COUNT(*) as count FROM delivery_details")->fetch_assoc()['count'];

?>



<div class="col py-3">
    <div class="row">
        <!-- Product Count -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text">Total Products: <?php echo $product_count; ?></p>
                </div>
            </div>
        </div>

        <!-- Category Count -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <p class="card-text">Total Categories: <?php echo $category_count; ?></p>
                </div>
            </div>
        </div>

        <!-- Brand Count -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Brands</h5>
                    <p class="card-text">Total Brands: <?php echo $brand_count; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Order Count -->
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>
                    <p class="card-text">Total Orders: <?php echo $order_count; ?></p>
                </div>
            </div>
        </div>

        <!-- Payment Count -->
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Payments</h5>
                    <p class="card-text">Total Payments: <?php echo $payment_count; ?></p>
                </div>
            </div>
        </div>

        <!-- User Count -->
        <div class="col-md-4">
            <div class="card text-white mb-3" style="background-color: #73014b;">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">Total Users: <?php echo $user_count; ?></p>
                </div>
            </div>
        </div>

        <!-- delevery_count -->
        <div class="col-md-4">
            <div class="card text-white mb-3" style="background-color: #e33500;">
                <div class="card-body">
                    <h5 class="card-title">Delevery</h5>
                    <p class="card-text">Total Delevery: <?php echo $delevery_count; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>