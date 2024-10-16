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
    <title>SHOP</title>

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
            <h3 class="text-center">CART</h3>
        </div>

        <!-- third child -->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered">
                        <?php
                            global $con;
                            $ip = getIPAddress();
                            $total = 0;
                            $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
                            $result_query = mysqli_query($con, $cart_query);
                            $result_count = mysqli_num_rows($result_query);
                            if($result_count > 0) {
                                echo "<thead>
                                        <tr>
                                            <th>Product Title</th>
                                            <th>Product Image</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th>Remove</th>
                                            <th colspan='2'>Operations</th>
                                        </tr>
                                    </thead>";
                                while($row = mysqli_fetch_array($result_query)) {
                                    $product_id = $row['product_id'];
                                    $select_query = "SELECT * FROM products WHERE product_id = '$product_id'";
                                    $result_products = mysqli_query($con, $select_query);
                                    while($row_product_price = mysqli_fetch_array($result_products)) {
                                        $product_price = array($row_product_price['product_price']);
                                        $price_table = $row_product_price['product_price'];
                                        $product_title = $row_product_price['product_title'];
                                        $product_image1 = $row_product_price['product_image1'];
                                        $price_table = $row_product_price['product_price'];
                                        $product_values = array_sum($product_price);
                                        $total += $product_values;
                                
                        ?>
                        <tbody>
                            <tr class="align-middle">
                                <td><?php echo $product_title; ?></th>
                                <td><img src="./admin_area/product_images/<?php echo $product_image1; ?>" alt="<?php echo $product_title; ?>" class="cart-img"></td>
                                <td><input type="number" name="qty" class="form-control w-50" min="1" value=""></td>
                                <?php
                                    $ip = getIPAddress();
                                    if(isset($_POST['update_cart'])) {
                                        $quantity = $_POST['qty'];
                                        $update_cart = "UPDATE cart_details SET quantity = $quantity WHERE ip_address = '$ip'";
                                        $result_cart_update = mysqli_query($con, $update_cart);
                                        $total *= $quantity;
                                    }
                                ?>
                                <td>LKR <?php echo $price_table; ?></td>
                                <td><input type="checkbox" class="" name="remove_item[]" value="<?php echo $product_id; ?>"></td>
                                <td><input type="submit" value="Update" class="btn btn-primary mx-2" name="update_cart"></td>
                                <td><input type="submit" value="Remove" class="btn btn-danger mx-2" name="remove_cart"></td>
                            </tr>
                        </tbody>
                        <?php
                                    }
                                }
                            } else {
                                echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                            }
                        ?>
                    </table>
                </form>

                <!-- function to remove item -->
                <?php
                    function remove_cart_item() {
                        global $con;
                        if(isset($_POST['remove_cart'])) {
                            foreach($_POST['remove_item'] as $remove_id) {
                                $delete_query = "DELETE FROM cart_details WHERE product_id = $remove_id";
                                $results_delete = mysqli_query($con, $delete_query);
                                if($results_delete) {
                                    echo "<script>window.open('cart.php', '_self')</script>";
                                }
                            }
                        }
                    }
                    remove_cart_item();
                ?>

                <div class="d-flex">
                    <?php
                        $ip = getIPAddress();
                        $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
                        $result_query = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result_query);
                        if($result_count > 0) {
                            echo "<h4 class='px-3'>Subtotal: <strong class='text-primary'>LKR $total</strong></h4>
                                <a href='index.php'><button class='btn btn-secondary mx-2'>Continue Shopping</button></a>
                                <a href='users_area/checkout.php'><button class='btn btn-primary'>Checkout</button></a>";
                        } else {
                            echo "<a href='index.php'><button class='align-center btn btn-secondary mx-2'>Continue Shopping</button></a>";
                        }
                    ?>
                </div>
                
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