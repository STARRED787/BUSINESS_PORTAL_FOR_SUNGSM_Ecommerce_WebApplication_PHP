<!---PHP code to display tbl user data in edit form fields---->
<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM `user` WHERE username='$user_session_name'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $useremail = $row_fetch['user_email'];
    $useraddress = $row_fetch['user_address'];
    $usermobile = $row_fetch['user_mobile'];

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <div class="d-flex justify-content-center" style="border-radius: 15px; font-family:Poppins">

        <div class="card" style="width:100%; max-width: 600px;">
            <div class="card-body">
                <h1 class="text-center ">Edit account</h1>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="row g-3">

                        <div class="col-12">
                            <div class="form-outline">
                                <input type="text" name="username" class="form-control form-control-lg"
                                    value='<?php echo $username ?>' />
                                <label class="form-label" for="firstName1">Name</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-outline">
                                <input type="text" name="useremail" class="form-control form-control-lg"
                                    value='<?php echo $useremail ?>' />
                                <label class="form-label" for="firstName2">Email</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-outline  mb-auto d-flex ">
                                <input type="file" name="userimage" class="form-control form-control-lg" />
                                <img src="./user_images/<?php echo $user_image ?>" alt="">

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-outline">
                                <input type="text" name="useraddress" class="form-control form-control-lg"
                                    value='<?php echo $useraddress ?>' />
                                <label class="form-label" for="firstName4">Address</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-outline">
                                <input type="text" name="usermobile" class="form-control form-control-lg"
                                    value='<?php echo $usermobile ?>' />
                                <label class="form-label" for="firstName5">Mobile Number</label>
                            </div>
                        </div>

                        <div class="col-12 mt-4 pt-2">
                            <input data-mdb-ripple-init class="btn btn-primary btn-lg" type="submit" value="Submit"
                                name="user_update" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!---PHP code to display tbl user data in edit form fields---->
<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];


}
?>