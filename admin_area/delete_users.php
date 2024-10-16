<?php

    //delete users
    if(isset($_GET['delete-users'])) {
        $delete_id = $_GET['delete-users'];
        $delete_query = "DELETE FROM user_table WHERE user_id=$delete_id";
        $result_delete = mysqli_query($con, $delete_query);    
        if($result_delete){
            echo "<script>alert('User deleted succesfully!')</script>";
            echo "<script>window.open('index.php?view-users', '_self')</script>";
        }
    }

?>