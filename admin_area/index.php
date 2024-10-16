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
    <title>Admin Dashboard</title>

    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="../style.css">

    <style>
        .profile-image {
            width: 100%;
            margin: auto;
            display: block;
            object-fit: contain;
        }
    </style>

</head>
<body>
    <div class="container-fluid p-0">
        <!-- first child -->
        <!-- include header -->
        <?php
            include '../includes/header_inside.php';
        ?>

        <!-- second child -->
        <div class="mt-3">
            <h3 class="text-center p-2">ADMIN DASHBOARD</h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary text-center text-light">
                    <li class="nav-item bg-primary">
                        <a href="index.php" class="nav-link"><h5>Your Profile</h5></a>
                    </li>
                    <li class="nav-item">
                    <img src='../users_area/user_images/blank-profile-picture-973460_640.png' alt='profile image' class='profile-image'>
                        <?php
                            // $username = $_SESSION['username'];
                            // $user_image = "SELECT * FROM user_table WHERE username='$username'";
                            // $result_image = mysqli_query($con, $user_image);
                            // $row_image = mysqli_fetch_array($result_image);
                            // $user_image = $row_image['user_image'];
                            //echo "<img src='../users_area/user_images/$user_image' alt='profile image' class='profile-image'>";
                        ?>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?view-products" class="nav-link">View Products</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?insert-product" class="nav-link">Insert Products</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?view-categories" class="nav-link">View Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?insert-category" class="nav-link">Insert Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?view-orders" class="nav-link">All Orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?view-payments" class="nav-link">All Payments</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?view-users" class="nav-link">List Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="../users_area/logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 text-center">
                <?php
                    if(isset($_GET['view-products'])){
                        include 'view_products.php';
                    }
                    if(isset($_GET['edit-products'])){
                        include 'edit_products.php';
                    }
                    if(isset($_GET['delete-products'])){
                        include 'delete_products.php';
                    }
                    if(isset($_GET['view-categories'])){
                        include 'view_categories.php';
                    }
                    if(isset($_GET['edit-categories'])){
                        include 'edit_categories.php';
                    }
                    if(isset($_GET['delete-categories'])){
                        include 'delete_categories.php';
                    }
                    if(isset($_GET['insert-product'])){
                        include 'insert_product.php';
                    }
                    if(isset($_GET['insert-category'])){
                        include 'insert_categories.php';
                    }
                    if(isset($_GET['view-orders'])){
                        include 'view_orders.php';
                    }
                    if(isset($_GET['delete-orders'])){
                        include 'delete_orders.php';
                    }
                    if(isset($_GET['view-payments'])){
                        include 'view_payments.php';
                    }
                    if(isset($_GET['delete-payments'])){
                        include 'delete_payments.php';
                    }
                    if(isset($_GET['view-users'])){
                        include 'view_users.php';
                    }
                    if(isset($_GET['delete-users'])){
                        include 'delete_users.php';
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