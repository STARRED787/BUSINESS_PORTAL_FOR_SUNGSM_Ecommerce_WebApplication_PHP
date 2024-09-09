<style>
    h2 {
        text-align: center;
        color: green;

    }
</style>


<?php
include('../include/connect.php');



// Display products
function getproducts()
{
    global $con;

    // condition to is set or not
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "SELECT * from `products` order by product_tittle ASC limit 0,9";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_tittle'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $product_categoroy = $row['categorie_id'];
                $product_brand = $row['brand_id'];

                echo "
         <div class='col-md-4  mb-4' >
              <div class='card '>
                      <img src='../images/$product_image1' class='card-img-top' alt='...' style=' width: 100%;
                         height: 200px; 
                         object-fit:contain'>
            <div class='card-body '>
             <h5 class='card-title'> $product_title</h5>
            <p class='card-text'>$product_description</p>
            <p class='card-text'>Rs.$product_price</p>
            <a href='shop.php?add_to_cart=$product_id' class='btn btn-primary flex buy-btn'>Add to cart</a>
             <a href='product_details.php?product_id=$product_id' class='btn btn-primary m-1 buy-btn'>View more</a>
         </div>
      </div>
    </div>      
      ";
            }
        }
    }
}

//geting uniq category
function getUniqCategory()
{
    global $con;

    // condition to is set or not
    if (isset($_GET['category'])) {
        $categoroy_id = $_GET['category'];
        $select_query = "SELECT * from `products` where categorie_id='$categoroy_id'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center '> Stock Out </h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_tittle'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $product_categoroy = $row['categorie_id'];
            $product_brand = $row['brand_id'];

            echo "
         <div class='col-md-4  mb-4' >
              <div class='card '>
                      <img src='../images/$product_image1' class='card-img-top' alt='...' style=' width: 100%;
                         height: 200px; 
                         object-fit:contain'>
            <div class='card-body '>
             <h5 class='card-title'> $product_title</h5>
            <p class='card-text'>$product_description</p>
            <p class='card-text'>Rs.$product_price</p>
            <a href='shop.php?add_to_cart=$product_id' class='btn btn-primary flex buy-btn'>Add to cart</a>
             <a href='product_details.php?product_id=$product_id' class='btn btn-primary m-1 buy-btn'>View more</a>
         </div>
      </div>
    </div>      
      ";
        }
    }
}


//geting uniq brand
function getUniqbrand()
{
    global $con;

    // condition to is set or not
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_query = "SELECT * from `products` where brand_id='$brand_id'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class=' text-center font-semibold text-danger justyfy-center flex'> Stock Out </h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_tittle'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $product_categoroy = $row['categorie_id'];
            $product_brand = $row['brand_id'];

            echo "
         <div class='col-md-4  mb-4' >
              <div class='card '>
                      <img src='../images/$product_image1' class='card-img-top' alt='...' style=' width: 100%;
                         height: 200px; 
                         object-fit:contain'>
            <div class='card-body '>
             <h5 class='card-title'> $product_title</h5>
            <p class='card-text'>$product_description</p>
            <p class='card-text'>$product_price</p>
            <a href='shop.php?add_to_cart=$product_id' class='btn btn-primary flex buy-btn'>Add to cart</a>
             <a href='product_details.php?product_id=$product_id' class='btn btn-primary m-1 buy-btn'>View more</a>
         </div>
      </div>
    </div>      
      ";
        }
    }
}


//display category
function getCategory()
{
    global $con;
    $select_categorys = "SELECT * from `categories`";
    $result_categorys = mysqli_query($con, $select_categorys);

    while ($row_data = mysqli_fetch_assoc($result_categorys)) {
        $category_title = $row_data['categorie_tittle'];
        $category_id = $row_data['categorie_id'];
        echo "
          <li class='nav-item bg-info'>
            <a href= '../shop/shop.php?category=$category_id' class='nav-link'>
             $category_title
            </a> ";
    }

}

//display brands

function getBrands()
{
    global $con;
    $select_brands = "SELECT * from `brands` ";
    $result_brands = mysqli_query($con, $select_brands);

    while ($row_data = mysqli_fetch_assoc($result_brands)) {
        $brand_title = $row_data['brand_tittle'];
        $brand_id = $row_data['brand_id'];
        echo "
          <li class='nav-item bg-info'>
            <a href='../shop/shop.php?brand=$brand_id' class='nav-link'>
             $brand_title
            </a> ";
    }

}

//display Searh product
function search_Product()
{
    global $con;
    if (isset($_GET['search_data_product'])) {
        $search_data_value = mysqli_real_escape_string($con, $_GET['search_data']);
        $search_query = "SELECT * FROM products WHERE product_keyword LIKE '%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);

        if (mysqli_num_rows($result_query) > 0) {
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_tittle'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $product_categoroy = $row['categorie_id'];
                $product_brand = $row['brand_id'];

                echo "
                <div class='col-md-4 mb-4'>
                    <div class='card'>
                        <img src='../images/$product_image1' class='card-img-top' alt='$product_title' style='width: 100%; height: 200px; object-fit: contain'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>$$product_price</p>
                            <a href='search.php?add_to_cart=$product_id' class='btn btn-primary flex buy-btn'>Add to cart</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-primary m-1 buy-btn'>View more</a>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<p >No products found matching your search criteria.</p>";
        }
    }
}


//display Product Details
function product_Details()
{
    global $con;
    if (isset($_GET['product_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
                $product_id = $_GET['product_id'];
                $select_query = "SELECT * from `products` where product_id='$product_id'";
                $result_query = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_tittle'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];
                    $product_price = $row['product_price'];
                    $product_categoroy = $row['categorie_id'];
                    $product_brand = $row['brand_id'];

                    echo "
            <div class='row'>
                <div class='col-md-7 '>
                    <img src='../images/$product_image1' class='card-img-top' alt='$product_title' style='width: 100%; height: 400px; object-fit: contain'  id='ProductImg'>
                    <div class='row m-4'>
                        <div class='col-md-4 p-2 sm:m-2'>
                        <span class='py-5 border border-primary'>
                        <img src='../images/$product_image1' class='small-img' alt='$product_title' style='width: 100%; height: 100px; object-fit: contain' id='ProductImg' >
                        </span>
                         </div>

                        <div class='col-md-4 p-2 sm:m-2'>
                        <span class='py-5 border border-primary'>
                        <img src='../images/$product_image2' class='small-img' alt='$product_title' style='width: 100%; height: 100px; object-fit: contain' id='ProductImg' >
                        </span>
                         </div>

                        <div class='col-md-4 p-2 sm:m-2'>
                        <span class='py-5 border border-primary'>
                        <img src='../images/$product_image3' class='small-img' alt='$product_title' style='width: 100%; height: 100px; object-fit: contain' id='ProductImg' >
                        </span>
                         </div>
                    </div>
                </div>
                <div class='col-md-5'>
                    <h2 class='text-uppercase'>$product_title</h2>
                    <p class=''>$product_description</p>
                    <p>$product_price</p>
                    <a href='product_details.php?add_to_cart=$product_id' class='btn btn-primary flex buy-btn'>Add to cart</a>
                </div>
            </div>
            
            <script>
            var ProductImg = document.getElementById('ProductImg');
            var SmallImg = document.getElementsByClassName('small-img');

            
            SmallImg[0].onclick = function() {
                ProductImg.src = SmallImg[0].src;
            }
                   SmallImg[1].onclick = function() {
                ProductImg.src = SmallImg[1].src;
            }
                   SmallImg[2].onclick = function() {
                ProductImg.src = SmallImg[2].src;
            }
                   SmallImg[3].onclick = function() {
                ProductImg.src = SmallImg[3].src;
            }
            
            </script>
             
            ";
                }
            }
        }
    }
}

//geting user ip address
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//cart function
function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_ip_add = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "Select * from `cart` where ip_address= '$get_ip_add' 
        and product_id=$get_product_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows > 0) {
            echo "<script> alert('This item is already present inside cart') </script>";
            echo "<script> window.open('shop.php','_self')  </script>";
        } else {
            $insert_query = "insert into `cart` (product_id,ip_address,
            quantity) values ($get_product_id,'$get_ip_add',0)";
            $result_query = mysqli_query($con, $insert_query);
            echo "<script> alert('Item is added to cart') </script>";
            echo "<script> window.open('shop.php','_self') </script>";
        }


    }
    // Check if the function already exists before declaring it
    if (!function_exists('cart_item')) {
        function cart_item()
        {
            global $con;
            $get_ip_add = getIPAddress();
            $select_query = "SELECT * FROM `cart` WHERE ip_address='$get_ip_add'";
            $result_query = mysqli_query($con, $select_query);
            $count_cart_items = mysqli_num_rows($result_query);
            echo $count_cart_items;
        }
    }

    if (!function_exists('total_cart_price')) {
        function total_cart_price()
        {
            global $con;
            $get_ip_add = getIPAddress();
            $total_price = 0;
            $cart_query = "SELECT * FROM `cart` WHERE ip_address='$get_ip_add'";
            $result = mysqli_query($con, $cart_query);
            while ($row = mysqli_fetch_array($result)) {
                $product_id = $row['product_id'];
                $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                $result_products = mysqli_query($con, $select_products);
                while ($row_product_price = mysqli_fetch_array($result_products)) {
                    $product_price = array($row_product_price['product_price']);
                    $product_values = array_sum($product_price);
                    $total_price += $product_values;
                }
            }
            echo $total_price;
        }


    }
}

?>