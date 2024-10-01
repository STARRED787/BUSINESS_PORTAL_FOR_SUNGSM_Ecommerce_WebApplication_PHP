<div class="d-flex justify-content-center" style="border-radius: 15px; font-family:Poppins">
    <div class="card" style="width:100%;">
        <div class="card-body">
            <h1 class="text-center ">All Payments</h1>

            <table class="table table-bordered mt-5 ">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Payment ID</th>
                        <th scope="col">Order Number</th>
                        <th scope="col">Invoice Number</th>
                        <th scope="col">Amount Due</th>
                        <th scope="col">Payment Mode</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP code to get orders table data -->
                    <?php
                    $get_payments_details = "SELECT * FROM `user_payements`";
                    $result_payments = mysqli_query($con, $get_payments_details);

                    while ($row_orders = mysqli_fetch_assoc($result_payments)) {
                        $payment_id = $row_orders['payement_id'];
                        $payment_order_id = $row_orders['order_id'];
                        $payment_invoice_number = $row_orders['invoice_number'];
                        $payment_amount = $row_orders['amount'];
                        $payment_payment_mode = $row_orders['payement_mode'];
                        $payment_date = $row_orders['date'];

                        echo "
                            <tr class='table-info'>
                                <td>$payment_id</td>
                                <td>$payment_order_id</td>
                                <td>$payment_invoice_number</td>
                                <td>$payment_amount</td>
                                <td>$payment_payment_mode</td>
                                <td>$payment_date</td>
                                <td>
                                    <form action='' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this payment?')\">
                                        <input type='hidden' name='delete_payment' value='$payment_id'>
                                        <button type='submit' class='btn btn-danger'>
                                            <i class='bx bxs-trash mx-4 text-white'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

<!-- jQuery (required for Toastr) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    referrerpolicy="no-referrer"></script>

<?php
// Handle payment deletion if 'delete_payment' is set
if (isset($_POST['delete_payment'])) {
    $delete_payment_id = $_POST['delete_payment'];

    // Perform the delete query (sanitizing the input)
    $delete_query = "DELETE FROM user_payements WHERE payement_id = $delete_payment_id";
    $delete_result = mysqli_query($con, $delete_query);

    // Provide feedback using Toastr
    if ($delete_result) {
        echo "<script>
                $(document).ready(function() {
                    toastr.success('Payment deleted successfully!');
                    setTimeout(function() {
                        window.location.href = 'index_home.php?view_payements'; // Redirect to the same page after deletion
                    }, 2000); // Delay of 2 seconds before redirection
                });
              </script>";
    } else {
        echo "<script>
                $(document).ready(function() {
                    toastr.error('Failed to delete payment. Please try again.');
                });
              </script>";
    }
}
?>