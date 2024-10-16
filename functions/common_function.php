<?php
    include(__DIR__ . '/../includes/connect.php');

    //get products
    function getProducts() {
        global $con;

        //check isset or not
        if(!isset($_GET['category'])) {
            $select_query = "SELECT * FROM products ORDER BY rand() LIMIT 0,9";
            $result_query = mysqli_query($con, $select_query);
            while($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];

                echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text m-0'>LKR $product_price</p>
                            <p class='card-text'>$product_description</p>
                            <a href='?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                            <a href='single_product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                        </div>
                    </div>
                </div>";
            }
        }
    }

    //getting all products
    function getAllProducts() {
        global $con;

        //check isset or not
        if(!isset($_GET['category'])) {
            $select_query = "SELECT * FROM products";
            $result_query = mysqli_query($con, $select_query);
            while($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];

                echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text m-0'>LKR $product_price</p>
                            <p class='card-text'>$product_description</p>
                            <a href='?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                            <a href='single_product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                        </div>
                    </div>
                </div>";
            }
        }
    }


    //getting unique categories
    function getUniqueCategories() {
        global $con;

        //check isset or not
        if(isset($_GET['category'])) {
            $category_id = $_GET['category'];
            $select_query = "SELECT * FROM products WHERE category_id = $category_id";
            $result_query = mysqli_query($con, $select_query);
            $numOfRows = mysqli_num_rows($result_query);
            if($numOfRows == 0) {
                echo "<h2 class='text-center text-danger'> No stock for this category!</h2>";
            }
            while($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];

                echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text m-0'>LKR $product_price</p>
                            <p class='card-text'>$product_description</p>
                            <a href='?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                            <a href='single_product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                        </div>
                    </div>
                </div>";
            }
        }
    }

    //display categories
    function getCategories() {
        global $con;
        $select_categories = "SELECT * FROM categories ";
        $result_categories = mysqli_query($con, $select_categories);
        while ($row_data = mysqli_fetch_assoc($result_categories)) {
            $category_title = $row_data['category_title'];
            $category_id = $row_data['category_id'];

            echo "<li class='nav-item'>
                    <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
                </li>";
        }
    }

    //search products
    function searchProducts() {
        global $con;
        if(isset($_GET['search_data_products'])) {
            $search_data_value = $_GET['search_data'];
            $search_query = "SELECT * FROM products WHERE product_title LIKE '%$search_data_value%'";
            $result_query = mysqli_query($con, $search_query);
            $numOfRows = mysqli_num_rows($result_query);
            if($numOfRows == 0) {
                echo "<h2 class='text-center text-danger'> No result found!</h2>";
            }
            while($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];

                echo "<div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text m-0'>LKR $product_price</p>
                            <p class='card-text'>$product_description</p>
                            <a href='?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                            <a href='single_product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                        </div>
                    </div>
                </div>";
            }
        }
    }

    //getting single product details
    function getSingleProductDetails() {
        global $con;

        //check isset or not
        $product_id = $_GET['product_id'];
        if(isset($_GET['product_id'])) {
            if(!isset($_GET['category'])) {
                $select_query = "SELECT * FROM products WHERE product_id = $product_id";
                $result_query = mysqli_query($con, $select_query);
                while($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
    
                    echo "<div class='row'>
                            <div class='col-md-6 mt-2'>
                                <div class='m-4'>
                                    <img id='mainImage' src='./admin_area/product_images/$product_image1' class='' alt='$product_title'>
                                    <div class='row'>
                                        <div class='col-md-3 m-0 p-0'>
                                            <img id='thumbnailImage' src='./admin_area/product_images/$product_image2' class='w-100' alt='$product_title' onclick='swapImages()'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6 mt-2'>
                                <div class='mt-5'>
                                    <div class='m-4'>
                                        <h2 class='mb-3'>$product_title</h2>
                                        <h5 class='mb-3 text-primary'>LKR $product_price</h5>
                                        <p class='mb-3'>$product_description</p>
                                        <a href='?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row m-2'>
                            <h2 class='mb-3'>Related Products</h2>
                        </div>";
                }
        
                //getting related products
                $select_query = "SELECT * FROM products WHERE category_id = $category_id AND product_id != $product_id";
                $result_query = mysqli_query($con, $select_query);
                while($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
    
                    echo "<div class='col-md-4 m-2'>
                            <div class='card'>
                                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text m-0'>LKR $product_price</p>
                                    <p class='card-text'>$product_description</p>
                                    <a href='?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                    <a href='single_product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
                }
            }
        }
    }

    //getting ip address
    function getIPAddress() {  
        //whether ip is from the share internet  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }  
        //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        return $ip;  
    }

    //cart function
    function cart() {
        global $con;
        if(isset($_GET['add_to_cart'])) {
            $ip = getIPAddress();  
            $get_product_id = $_GET['add_to_cart'];
            $select_query = "SELECT * FROM cart_details WHERE ip_address = '$ip' AND product_id = $get_product_id";
            $result_query = mysqli_query($con, $select_query);
            $numOfRows = mysqli_num_rows($result_query);
            if($numOfRows > 0) {
                echo "<script>alert('This item is already in the cart!')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            } else {
                $insert_query = "INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ($get_product_id, '$ip', 0)";
                $result_query = mysqli_query($con, $insert_query);
                echo "<script>alert('Item is added to the cart!')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            }
            
        }
    }

    //getting cart item count
    function getCartItemCount() {
        global $con;
        if(isset($_GET['add_to_cart'])) {
            $ip = getIPAddress();  
            $select_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
            $result_query = mysqli_query($con, $select_query);
            $count = mysqli_num_rows($result_query);
        } else {
            $ip = getIPAddress();  
            $select_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
            $result_query = mysqli_query($con, $select_query);
            $count = mysqli_num_rows($result_query);
        }
        echo $count;
    }

    //getting cart total price
    function getCartTotalPrice() {
        global $con;
        $ip = getIPAddress();
        $total = 0;
        $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
        $result_query = mysqli_query($con, $cart_query);
        while($row = mysqli_fetch_array($result_query)) {
            $product_id = $row['product_id'];
            $select_query = "SELECT * FROM products WHERE product_id = '$product_id'";
            $result_products = mysqli_query($con, $select_query);
            while($row_product_price = mysqli_fetch_array($result_products)) {
                $product_price = array($row_product_price['product_price']);
                $product_values = array_sum($product_price);
                $total += $product_values;
            }
        }
        echo $total;
    }

    //get user order details
    function get_user_order_details() {
        global $con;
        $username = $_SESSION['username'];
        $get_details = "SELECT * FROM user_table WHERE username='$username'";
        $result_query = mysqli_query($con, $get_details);
        while($row_query = mysqli_fetch_array($result_query)) {
            $user_id = $row_query['user_id'];
            if(!isset($_GET['edit_account'])) {
                if(!isset($_GET['my_orders'])) {
                    if(!isset($_GET['delete_account'])) {
                        $get_details = "SELECT * FROM user_orders WHERE user_id=$user_id AND order_status='pending'";
                        $result_orders_query = mysqli_query($con, $get_details);
                        $row_count = mysqli_num_rows($result_orders_query);
                        if($row_count > 0) {
                            echo "<h3 class='text-success'>Your have <span class='text-danger'>$row_count</span> pending orders</h3>
                                  <p><a href='profile.php?my_orders'>Order details</a></p>";
                        } else {
                            echo "<h3 class='text-success'>Your have no pending orders</h3>
                                  <p><a href='../index.php'>Explore products</a></p>";
                        }
                    }
                }
            }
        }
    }
?>