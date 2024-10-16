<?php
    include(__DIR__ . '/../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>

    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="style.css">

    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <!-- first child -->
        <h2 class="text-center">Register</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" autocomplete="off" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email" autocomplete="off" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">Profile Picture</label>
                        <input type="file" id="user_image" name="user_image" class="form-control" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" autocomplete="off" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="conf_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_password" name="conf_password" class="form-control" placeholder="Confirm your password" autocomplete="off" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address" autocomplete="off" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="mobile" class="form-label">Phone Number</label>
                        <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Enter your phone number" autocomplete="off" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" name="register" value="Register" class="btn btn-primary w-100">
                        <p class="small fw-bold mt-2">Already have an account? <a href="user_login.php">Login</a></p>
                    </div>
                </form>
            </div> 
        </div>
    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
    if(isset($_POST['register'])) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $conf_password = $_POST['conf_password'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        $ip = getIPAddress();

        $select_query = "SELECT * FROM user_table WHERE username = '$username' OR user_email = '$email'";
        $result_select = mysqli_query($con, $select_query);
        $rows_count = mysqli_num_rows($result_select);
        if($rows_count > 0) {
            echo "<script>alert('Username or email already exist!')</script>";
        } else if($password != $conf_password) {
            echo "<script>alert('Password does not match!')</script>";
        } else {
            move_uploaded_file($user_image_tmp, "user_images/$user_image");
            $insert_query = "INSERT INTO user_table (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) 
                            VALUES ('$username', '$email', '$hash_password', '$user_image', '$ip', '$address', '$mobile')";
            $result_query = mysqli_query($con, $insert_query);
            if($result_query) {
                echo "<script>alert('User account created successfully!')</script>";
            } else {    
                die(mysqli_error($con));
            }
        }
        
        $select_cart_items = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
        $result_cart = mysqli_query($con, $select_cart_items);
        $rows_count = mysqli_num_rows($result_cart);
        if($rows_count > 0) {
            $_SESSION['username'] = $username;
            echo "<script>alert('You have items in your cart.')</script>";
            echo "<script>window.open('checkout.php', '_self')</script>";
        } else {
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
?>