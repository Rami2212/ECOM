<?php

    //delete product
    if(isset($_GET['delete-products'])) {
        $delete_id = $_GET['delete-products'];
        $delete_query = "DELETE FROM products WHERE product_id=$delete_id";
        $result_delete = mysqli_query($con, $delete_query);    
        if($result_delete){
            echo "<script>alert('Product deleted succesfully!')</script>";
            echo "<script>window.open('index.php?view-products', '_self')</script>";
        }
    }

?>