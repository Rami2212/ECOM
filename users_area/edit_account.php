<head>
    <style>
        .edit-image {
            width: 150px;
            object-fit: contain;
        }
    </style> 
</head>

<?php

    //get user data
    if(isset($_GET['edit_account'])) {
        $user_name = $_SESSION['username'];
        
        $select_query = "SELECT * FROM user_table WHERE username='$user_name'";
        $result_query = mysqli_query($con, $select_query);
        $row_data = mysqli_fetch_assoc($result_query);
        
        $user_id = $row_data['user_id'];
        $username = $row_data['username'];
        $user_email = $row_data['user_email'];
        $user_address = $row_data['user_address'];
        $user_mobile = $row_data['user_mobile'];
    }

    //update date
    if(isset($_POST['user_update'])) {
        $update_id = $user_id;
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        $user_address = $_POST['user_address'];
        $user_mobile = $_POST['user_mobile'];
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        $update_query = "UPDATE user_table 
                        SET username='$user_name', 
                        user_email='$user_email', 
                        user_image='$user_image', 
                        user_address='$user_address', 
                        user_mobile='$user_mobile' 
                        WHERE user_id=$user_id";
        $result_update = mysqli_query($con, $update_query);
        if($result_update){
            echo "<script>alert('Data updated succesfully!')</script>";
            echo "<script>window.open('logout.php', '_self')</script>";
        }
    }
?>
<body>
    <h3 class='text-success mb-4'>Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo $user_email; ?>">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control" name="user_image">
            <img src="./user_images/<?php echo $user_image; ?>" alt="profile image" class="edit-image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_address; ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile; ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="btn btn-primary w-50 m-auto" name="user_update" value="UPDATE">
        </div>
    </form>
</body>
