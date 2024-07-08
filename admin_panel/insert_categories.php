<?php
include ('../include/connect.php');
//database connection
if (isset($_POST['cate_insert'])) {
    $cate_title = $_POST['cate_title'];
    //cheack duplicate in database
    $select_query = "Select * from `categories` where categorie_tittle='$cate_title'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);
    if ($number > 0) {
        echo "<script> alert('this category is already in the database')</script>";
    } else {
        //add categorys into database
        $insert_query = " insert into `categories` (categorie_tittle) values ( '$cate_title')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script> alert('Category has been inserted successfully')</script>";
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
                <h1>Insert Categories</h1>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="cate_title"
                    placeholder="type name" style=" width:300px">

                <input type="submit" class=" mt-3 buy-btn " id="exampleFormControlInput1" name="cate_insert"
                    value="Insert Categorie" style=" width:200px;">


        </form>
    </div>
</section>