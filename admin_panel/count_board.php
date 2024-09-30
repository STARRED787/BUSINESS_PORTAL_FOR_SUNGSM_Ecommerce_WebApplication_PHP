<!-- Content Area with Counts -->
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
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">Total Users: <?php echo $user_count; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>