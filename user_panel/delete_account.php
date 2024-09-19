<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        referrerpolicy="no-referrer" />
    <title>delete Account</title>
</head>

<body>


    <h1 class="d-flex justify-content-center">Delete</h1>
    <form action="" method="POST" class="d-flex justify-content-center">

        <div class="row ">
            <div class="col-12 mt-4 pt-2">
                <input data-mdb-ripple-init class="btn btn-danger btn-lg" type="submit" value="Delete My Account"
                    name="user_Delete" />
            </div>
            <div class="col-12 mt-4 pt-2">
                <input data-mdb-ripple-init class="btn btn-primary btn-lg" type="submit" value="Not Delete"
                    name="user_Not_Delete" />
            </div>
        </div>


    </form>


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

<?php
$username_session = $_SESSION['username'];
if (isset($_POST['user_Delete'])) {
    // Enclose the username in single quotes to treat it as a string in the SQL query
    $delete_query = "DELETE FROM `user` WHERE username='$username_session'";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        session_destroy();
        echo "<script>
            $(document).ready(function() { 
                toastr.success('Account Deleted Successfully!');
                setTimeout(function() { window.open('../index/index.php', '_self'); }, 2000); // Delay for 2 seconds
            });
        </script>";
    } else {
        echo "<script>
            $(document).ready(function() { 
                toastr.error('Error Deleting Account!');
            });
        </script>";
    }
}

if (isset($_POST['user_Not_Delete'])) {
    echo "<script>
        $(document).ready(function() { 
            toastr.success('Account Not Deleted');
            setTimeout(function() { window.open('./profile.php', '_self'); }, 2000); // Delay for 2 seconds
        });
    </script>";
}
?>