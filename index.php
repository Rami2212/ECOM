<?php
    include 'includes/connect.php';
    include 'functions/common_function.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIST SHOP</title>

    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <!-- include header -->
        <?php
            include './includes/header.php';
        ?>

        <!-- calling cart function -->
        <?php
            cart();
        ?>

        <!-- second child -->
        <div class="p-3">
            <h3 class="text-center">SHOP</h3>
            <p class="text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa, quis.</p>
        </div>

        <!-- third child -->
         <div class="row mb-3">
            <div class="col-md-10">
                <!-- products -->
                <div class="row m-1">
                    <!-- fetching products -->
                    <?php
                        getProducts();
                        getUniqueCategories();
                    ?>
                </div>
            </div>
            <div class="col-md-2 bg-primary">
                <!-- sidenav -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-light"><h5>Categories</h5></a>
                    </li>
                    <?php
                        getCategories();
                    ?>

                </ul>
            </div>
         </div>

        <!-- last child -->
        <!-- include footer -->'
        <?php
            include './includes/footer.php';
        ?>

    </div>
    



    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>