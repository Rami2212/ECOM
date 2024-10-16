<?php
    include_once '../functions/common_function.php';
    
    if(isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
    }

    $ip = getIPAddress();
    $total = 0;
    $cart_query_price = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
    $result_cart_price = mysqli_query($con, $cart_query_price);
    $invoice_number = mt_rand();
    $status = 'pending';
    $count_products = mysqli_num_rows($result_cart_price);
    while($row_price = mysqli_fetch_assoc($result_cart_price)) {
        $product_id = $row_price['product_id'];
        $select_products = "SELECT * FROM products WHERE product_id = '$product_id'";
        $run_price = mysqli_query($con, $select_products);
        while($row__product_price = mysqli_fetch_assoc($run_price)) {
            $product_price = array($row__product_price['product_price']);
            $product_values = array_sum($product_price);
            $total += $product_values;
        }
    }

    //getting quantity from cart
    $get_cart = "SELECT * FROM cart_details";
    $run_cart = mysqli_query($con, $get_cart);
    $get_item_quantity = mysqli_fetch_array($run_cart);
    $quantity = $get_item_quantity['quantity'];
    if($quantity == 0){
        $quantity = 1;
        $subtotal = $total;
    } else {
        $subtotal = $total*$quantity;
    }

    $insert_orders = "INSERT INTO user_orders (user_id, amount, invoice_number, total_products, order_date, order_status)
                      VALUES ($user_id, $subtotal, $invoice_number, $count_products, NOW(), '$status')";
    $result_query = mysqli_query($con, $insert_orders);
    if($result_query){
        echo "<script>alert('Oreders are submitted succesfully!')</script>";
        echo "<script>window.open('profile.php', '_self')</script>";
    }

    //orders pending
    $insert_pending_orders = "INSERT INTO pending_orders (user_id, invoice_number, product_id, quantity, order_status)
                              VALUES ($user_id, $invoice_number, $product_id, $quantity, '$status')";
    $result_pending_orders = mysqli_query($con, $insert_pending_orders);
    
    //delete items from cart
    $empty_cart = "DELETE FROM cart_details WHERE ip_address = '$ip'";
    $result_delete = mysqli_query($con, $empty_cart);
    
?>