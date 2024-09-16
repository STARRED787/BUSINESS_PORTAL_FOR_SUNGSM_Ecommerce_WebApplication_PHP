<?php
// PHP code to display tbl user data in edit form fields
if (isset($_GET['edit_account'])) {
    // Check if session 'username' is set
    if (isset($_SESSION['username'])) {
        $user_session_name = $_SESSION['username'];

        // Query to fetch user data
        $select_query = "SELECT * FROM `user` WHERE username='$user_session_name'";
        $result_query = mysqli_query($con, $select_query);

        // Check if the query is successful and returned rows
        if (isset($_GET['edit_account'])) {
            $user_session_name = $_SESSION['username'];
            $select_query = "SELECT * FROM user WHERE username='$user_session_name'";
            $result_query = mysqli_query($con, $select_query);
            $row_fetch = mysqli_fetch_assoc($result_query);
            $user_id = $row_fetch['user_id'];
            $username = $row_fetch['username'];
            $useremail = $row_fetch['user_email'];
            $useraddress = $row_fetch['user_address'];
            $usermobile = $row_fetch['user_mobile'];

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
    <title>Edit Account</title>
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
                                    value='<?php echo isset($username) ? $username : ''; ?>' required />
                                <label class="form-label" for="firstName1">Name</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-outline">
                                <input type="email" name="user_email" class="form-control form-control-lg"
                                    value='<?php echo isset($useremail) ? $useremail : ''; ?>' required />
                                <label class="form-label" for="firstName2">Email</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-outline mb-auto d-flex">
                                <input type="file" name="user_image" class="form-control form-control-lg" />
                                <img src="./user_images/<?php echo isset($userimage) ? $userimage : '5432747.png'; ?>"
                                    alt="User Image" style="width: 50px; height: 50px;">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-outline">
                                <input type="text" name="user_address" class="form-control form-control-lg"
                                    value='<?php echo isset($useraddress) ? $useraddress : ''; ?>' required />
                                <label class="form-label" for="firstName4">Address</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-outline">
                                <input type="text" name="user_mobile" class="form-control form-control-lg"
                                    value='<?php echo isset($usermobile) ? $usermobile : ''; ?>' required />
                                <label class="form-label" for="firstName5">Mobile Number</label>
                            </div>
                        </div>

                        <div class="col-12 mt-4 pt-2">
                            <input data-mdb-ripple-init class="btn btn-primary btn-lg" type="submit" value="Update"
                                name="user_update" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Corrected: Removed duplicate Bootstrap JS inclusion -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        referrerpolicy="no-referrer"></script>
</body>

</html>

<!-- PHP code to update account data -->
<?php
if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $username = $_POST['username'];
    $useremail = $_POST['user_email'];
    $useraddress = $_POST['user_address'];
    $usermobile = $_POST['user_mobile'];
    $userimage = $_FILES['user_image']['name'];
    $userimage_tmp = $_FILES['user_image']['tmp_name'];

    // Only move uploaded file if a new image was selected
    if ($userimage) {
        move_uploaded_file($userimage_tmp, "./user_images/$userimage");
    } else {
        // If no new image was selected, retain the current image
        $userimage = $userimage ?: $row_fetch['user_image'];
    }

    // Update query
    $update_user = "UPDATE `user` SET username='$username', user_email='$useremail',
    user_address='$useraddress', user_mobile='$usermobile', user_image='$userimage' 
    WHERE user_id='$user_id'";

    $result_update_query = mysqli_query($con, $update_user);

    if ($result_update_query) {
        echo "<script>$(document).ready(function() { toastr.success('Update Successful'); });</script>";
    } else {
        echo "<script>$(document).ready(function() { toastr.error('Update Failed'); });</script>";
    }
}
?>