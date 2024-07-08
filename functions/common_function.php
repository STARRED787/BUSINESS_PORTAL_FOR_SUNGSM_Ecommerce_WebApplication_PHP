<?php
include ('../include/connect.php');


// Display products
function getproducts()
{
    global $con;
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
          <p class='card-text'>$product_price</p>
          <a href='#' class='btn btn-primary flex buy-btn'>Add to cart</a>
          <a href='#' class='btn btn-primary m-1 buy-btn'>View more</a>
        </div>
      </div>
    </div>
  
      
      ";
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
            <a href='' class='nav-link'>
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
            <a href='' class='nav-link'>
             $brand_title
            </a> ";
    }

}
?>