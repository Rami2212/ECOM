<?php

    //delete product
    if(isset($_GET['delete-categories'])) {
        $delete_id = $_GET['delete-categories'];
        $delete_query = "DELETE FROM categories WHERE category_id=$delete_id";
        $result_delete = mysqli_query($con, $delete_query);    
        if($result_delete){
            echo "<script>alert('Category deleted succesfully!')</script>";
            echo "<script>window.open('index.php?view-categories', '_self')</script>";
        }
    }

?>