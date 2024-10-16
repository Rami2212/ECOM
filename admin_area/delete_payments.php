<?php

    //delete payments
    if(isset($_GET['delete-payments'])) {
        $delete_id = $_GET['delete-payments'];
        $delete_query = "DELETE FROM user_payments WHERE payment_id=$delete_id";
        $result_delete = mysqli_query($con, $delete_query);    
        if($result_delete){
            echo "<script>alert('Payment deleted succesfully!')</script>";
            echo "<script>window.open('index.php?view-payments', '_self')</script>";
        }
    }

?>