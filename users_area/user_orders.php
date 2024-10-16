<head>
    <style>
        .edit-image {
            width: 150px;
            object-fit: contain;
        }
    </style> 
</head>
<body>
    <h3 class='text-success mb-4'>My Orders</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SI No</th>
                <th>Amout</th>
                <th>Total Products</th>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Complete/Imcomplete</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //get user data
                if(isset($_GET['my_orders'])) {
                    $user_name = $_SESSION['username'];
                    
                    $select_query = "SELECT * FROM user_table WHERE username='$user_name'";
                    $result_query = mysqli_query($con, $select_query);
                    $row_data = mysqli_fetch_assoc($result_query);
                    $user_id = $row_data['user_id'];

                    //get order details
                    $select_orders = "SELECT * FROM user_orders WHERE user_id=$user_id";
                    $result_orders = mysqli_query($con, $select_orders);
                    $number = 1;    
                    while($row_orders = mysqli_fetch_assoc($result_orders)) {
                        $order_id = $row_orders['order_id'];
                        $amount = $row_orders['amount'];
                        $total_products = $row_orders['total_products'];
                        $invoice_number = $row_orders['invoice_number'];
                        $order_date = $row_orders['order_date'];
                        $order_status = $row_orders['order_status'];
                        if($order_status == 'pending') {
                            $order_status = 'Incomplete';
                        } else {
                            $order_status = 'Complete';
                        }
                        echo "<tr>
                                <td>$number</td>
                                <td>$amount</td>
                                <td>$total_products</td>
                                <td>$invoice_number</td>
                                <td>$order_date</td>
                                <td>$order_status</td>";
            ?>
            <?php
                        if($order_status == 'Complete') {
                            echo "<td>Paid</td>";
                        } else {
                            echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>
                                </tr>";
                        }       
                        $number++;
                    }
                }
            ?>
        </tbody>

    </table>
</body>
