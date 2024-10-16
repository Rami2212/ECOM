<?php
    include '../includes/connect.php';
    include '../functions/common_function.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE</title>

    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <style>
        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
    
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <!-- include header -->
        <?php
            include '../includes/header_inside.php';
        ?>

        <!-- second child -->
        <div class="p-3">
            <h3 class="text-center">Welcome <?php echo $_SESSION['username']; ?></h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary text-center text-light">
                    <li class="nav-item bg-primary">
                        <a href="#" class="nav-link"><h5>Your Profile</h5></a>
                    </li>
                    <li class="nav-item">
                        <?php
                            $username = $_SESSION['username'];
                            $user_image = "SELECT * FROM user_table WHERE username='$username'";
                            $result_image = mysqli_query($con, $user_image);
                            $row_image = mysqli_fetch_array($result_image);
                            $user_image = $row_image['user_image'];
                            echo "<img src='./user_images/$user_image' alt='profile image' class='profile-image'>";
                        ?>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link">Pending Orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php?edit_account" class="nav-link">Edit Account</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php?my_orders" class="nav-link">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php?delete_account" class="nav-link">Delete Account</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 text-center">
                <?php
                    get_user_order_details();
                    if(isset($_GET['edit_account'])) {
                        include 'edit_account.php';
                    }
                    if(isset($_GET['my_orders'])) {
                        include 'user_orders.php';
                    }
                    if(isset($_GET['delete_account'])) {
                        include 'delete_account.php';
                    }
                ?>
            </div>
        </div>

        <!-- last child -->
        <!-- include footer -->'
        <?php
            include '../includes/footer.php';
        ?>

    </div>
    



    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>