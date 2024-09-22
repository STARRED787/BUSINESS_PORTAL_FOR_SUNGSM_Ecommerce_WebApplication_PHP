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
    <!---- PHP code to get User Id to access orders table----->

    <div style="border-radius: 15px; font-family:Poppins">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center ">My Orders</h1>

                <h1>view</h1>

                <table class="table table-borderd mt-5">
                    <thead class="bg-table-primary">
                        <tr>
                            <th scope="col">Sl no</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Amount Due</th>
                            <th scope="col">Total products</th>
                            <th scope="col">Invoice Number</th>
                            <th scope="col">Date</th>
                            <th scope="col">Complete/Incomplete</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                </table>

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