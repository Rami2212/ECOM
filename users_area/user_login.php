<?php
    include_once '../functions/common_function.php';
    @session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

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
        <h2 class="text-center">Login</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" autocomplete="off" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" name="login" value="Login" class="btn btn-primary w-100">
                        <p class="small fw-bold mt-2">Don't have an account? <a href="user_registration.php">Register</a></p>
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
    if(isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $select_query = "SELECT * FROM user_table WHERE username = '$username'";
        $result_select = mysqli_query($con, $select_query);
        $row_count = mysqli_num_rows($result_select);
        $row_data = mysqli_fetch_assoc($result_select);
        $ip = getIPAddress();

        $select_cart_items = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
        $result_cart = mysqli_query($con, $select_cart_items);
        $rows_count_cart = mysqli_num_rows($result_cart);

        if($row_count > 0) {
            if(password_verify($password, $row_data['user_password'])) {
                if($row_count == 1 AND $rows_count_cart == 0) {
                    $_SESSION['username'] = $username;
                    echo "<script>alert('Login Successful!')</script>";
                    echo "<script>window.open('profile.php', '_self')</script>";
                } else {
                    $_SESSION['username'] = $username;
                    echo "<script>alert('You have items in your cart.')</script>";
                    echo "<script>window.open('payment.php', '_self')</script>";
                }
            } else {
                echo "<script>alert('Invalid password!')</script>";
            }
        } else {
            echo "<script>alert('Invalid username!')</script>";
        }
    }
?>