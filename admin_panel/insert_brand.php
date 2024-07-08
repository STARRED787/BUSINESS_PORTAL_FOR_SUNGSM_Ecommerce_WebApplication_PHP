<?php

//database connection
include ('../include/connect.php');
if (isset($_POST['brand_insert'])) {
    $brand_title = $_POST['brand_title'];
    //cheack duplicate in database
    $select_query = "Select * from `brands` where brand_tittle='$brand_title'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);
    if ($number > 0) {
        echo "<script> alert('this brandy is already in the database')</script>";
    } else {
        //add categorys into database
        $insert_query = " insert into `brands` (brand_tittle) values ( '$brand_title')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script> alert('Brand has been inserted successfully')</script>";
        }
    }
}

?>
<style>
    .buy-btn {
        margin-top: 10px;
        font-family: "Barrio";
        font-size: 0.9rem;
        font-weight: 700;
        outline: none;
        border: none;
        background-color: rgb(255, 238, 1);
        color: rgb(0, 2, 3);
        padding: 13px 30px;
        text-transform: uppercase;
        cursor: pointer;
        transition: 0.5s ease;
        border-radius: 12px;
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
<section id="in-cate">
    <div class="container">
        <form action="" method="post" class="mb-2">
            <div class="mb-3 mt-3 container">
                <h1>Insert Brand</h1>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="brand_title"
                    placeholder="type name" style=" width:300px">

                <input type="submit" class=" mt-3 buy-btn " id="exampleFormControlInput1" name="brand_insert"
                    value="Insert Brand" style=" width:200px;">

            </div>
        </form>
    </div>
</section>