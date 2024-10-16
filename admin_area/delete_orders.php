<?php

    //delete orders
    if(isset($_GET['delete-orders'])) {
        $delete_id = $_GET['delete-orders'];
        $delete_query = "DELETE FROM user_orders WHERE order_id=$delete_id";
        $result_delete = mysqli_query($con, $delete_query);    
        if($result_delete){
            echo "<script>alert('Order deleted succesfully!')</script>";
            echo "<script>window.open('index.php?view-orders', '_self')</script>";
        }
    }

?>