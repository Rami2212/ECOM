<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
</head>
<body>
    <h3 class="text-center text-success mt-4">All Order</h3>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Invoice Number</th>
                <th>Total Products</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //get orders
                $select_query = "SELECT * FROM user_orders";
                $result_query = mysqli_query($con, $select_query);
                $num_rows = mysqli_num_rows($result_query);
                if($num_rows == 0) {
                    echo "<h2 class='text-center text-danger mt-4'>No orders yet!</h2>";
                } else {
                    while($row_orders = mysqli_fetch_assoc($result_query)) {
                        $order_id = $row_orders['order_id'];
                        $amount = $row_orders['amount'];
                        $invoice_number = $row_orders['invoice_number'];
                        $total_products = $row_orders['total_products'];
                        $status = $row_orders['order_status'];
                        echo "<tr>
                                <td>$order_id</td>
                                <td>$amount</td>
                                <td>$invoice_number</td>
                                <td>$total_products</td>
                                <td>$status</td>
                                <td><a href='index.php?delete-orders=$order_id' onclick='return confirm(\"Are you sure you want to delete this order?\")'><i class='fa-solid fa-trash text-danger'></i></a></td>
                            </tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>