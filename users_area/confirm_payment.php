<?php
    include '../includes/connect.php';
    session_start();
    if(isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $select_query = "SELECT * FROM user_orders WHERE order_id=$order_id";
        $result_query = mysqli_query($con, $select_query);
        $row_data = mysqli_fetch_assoc($result_query);
        $invoice_number = $row_data['invoice_number'];
        $amount = $row_data['amount'];
    }

    if(isset($_POST['confirm_payment'])) {
        $invoice_number = $_POST['invoice_number'];
        $amount = $_POST['amount'];
        $payment_method = $_POST['payment_method'];

        $insert_query = "INSERT INTO user_payments (order_id, invoice_number, amount, payment_method)
                         VALUES ($order_id, $invoice_number, $amount, '$payment_method')";
        $result_query = mysqli_query($con, $insert_query);
        if($result_query){
            echo "<script>alert('Payment is completed succesfully!')</script>";
            echo "<script>window.open('profile.php?my_orders', '_self')</script>";
        }

        $update_orders = "UPDATE user_orders SET order_status='complete' WHERE order_id=$order_id";
        $result_orders = mysqli_query($con, $update_orders);
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYMENT</title>

    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    
</head>
<body>
    <h1 class="text-center mt-5">Confirm Payment</h1>
    <div class="container my-5">
        <form action="" method="post">
            <div class="form-outline mb- text-center">
                <label for="invoice_number">Invoice Number</label>
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number; ?>">
            </div>
            <div class="form-outline mb-4 text-center">
                <label for="amount">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount; ?>">
            </div>
            <div class="form-outline mb-4 text-center">
                <select name="payment_method" class="form-select w-50 m-auto">
                    <option>Select payment method</option>
                    <option>Direct bank transfer</option>
                    <option>PayPal</option>
                    <option>Cash on delevery</option>
                </select>
            </div>
            <div class="form-outline mb-4 text-center">
                <input type="submit" class="btn btn-primary w-50 m-auto" name="confirm_payment" value="CONFIRM">
            </div>
        </form>
    </div>
</body>