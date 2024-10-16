<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments</title>
</head>
<body>
    <h3 class="text-center text-success mt-4">All Payments</h3>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Amount</th>
                <th>Total Products</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //get payments
                $select_query = "SELECT * FROM user_payments";
                $result_query = mysqli_query($con, $select_query);
                $num_rows = mysqli_num_rows($result_query);
                if($num_rows == 0) {
                    echo "<h2 class='text-center text-danger mt-4'>No payments yet!</h2>";
                } else {
                    while($row_payments = mysqli_fetch_assoc($result_query)) {
                        $payment_id = $row_payments['payment_id'];
                        $amount = $row_payments['amount'];
                        $invoice_number = $row_payments['invoice_number'];
                        $order_date = $row_payments['date'];
                        $payment_method = $row_payments['payment_method'];
                        echo "<tr>
                                <td>$payment_id</td>
                                <td>$amount</td>
                                <td>$invoice_number</td>
                                <td>$order_date</td>
                                <td>$payment_method</td>
                                <td><a href='index.php?delete-payments=$payment_id' onclick='return confirm(\"Are you sure you want to delete this payment?\")'><i class='fa-solid fa-trash text-danger'></i></a></td>
                            </tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>