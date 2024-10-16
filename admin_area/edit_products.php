<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>

    <style>
        .edit-image {
            width: 150px;
            object-fit: contain;
        }
    </style>
    
</head>


<?php

    //get product data
    if(isset($_GET['edit-products'])) {
        $edit_id = $_GET['edit-products'];
        $select_query = "SELECT * FROM products WHERE product_id=$edit_id";
        $result_query = mysqli_query($con, $select_query);
        $row_data = mysqli_fetch_assoc($result_query);
        
        $product_title = $row_data['product_title'];
        $product_description = $row_data['product_description'];
        $category_id = $row_data['category_id'];
        $product_price = $row_data['product_price'];
        $product_image1 = $row_data['product_image1'];
        $product_image2 = $row_data['product_image2'];
    }

    //update product
    if(isset($_POST['product_update'])) {
        $update_id = $edit_id;
        $product_title = $_POST['product_title'];
        $product_description = $_POST['product_description'];
        $category_id = $_POST['product_category'];
        $product_price = $_POST['product_price'];
        $product_image1 = $_FILES['product_image1']['name'];
        $product_image1_tmp = $_FILES['product_image1']['tmp_name'];
        $product_image2 = $_FILES['product_image2']['name'];
        $product_image2_tmp = $_FILES['product_image2']['tmp_name'];
        move_uploaded_file($product_image1_tmp, "./product_images/$product_image1");
        move_uploaded_file($product_image2_tmp, "./product_images/$product_image2");

        $update_query = "UPDATE products 
                        SET product_title='$product_title', 
                        product_description='$product_description', 
                        category_id='$category_id', 
                        product_price='$product_price', 
                        product_image1='$product_image1',
                        product_image2='$product_image2'  
                        WHERE product_id=$update_id";
        $result_update = mysqli_query($con, $update_query);
        if($result_update){
            echo "<script>alert('Data updated succesfully!')</script>";
            echo "<script>window.open('index.php?view-products', '_self')</script>";
        }
    }
?>


<body>
    <h3 class='text-success mb-4'>Edit Product</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-3">
            <label for="">Product title</label>
            <input type="text" class="form-control w-50 m-auto" name="product_title" value="<?php echo $product_title; ?>" required>
        </div>

        <div class="form-outline mb-5">
            <label for="product_description">Product description</label>
            <input type="text" class="form-control w-50 m-auto" name="product_description" value="<?php echo $product_description; ?>" required>
        </div>

        <div class="form-outline mb-3">
            <select name="product_category" class="form-select w-50 m-auto">
                
                <?php
                    //getting current category
                    $select_current_category = "SELECT * FROM categories WHERE category_id=$category_id";
                    $result_current_category = mysqli_query($con, $select_current_category);
                    $row_current_category = mysqli_fetch_assoc($result_current_category);
                    $current_category_id = $category_id;
                    $current_category_title = $row_current_category['category_title'];
                    echo "<option value='$current_category_id'>$current_category_title</option>";

                    //getting all categories
                    $select_category = "SELECT * FROM categories";
                    $result_category = mysqli_query($con, $select_category);
                    while($row_category = mysqli_fetch_assoc($result_category)) {
                        $category_id = $row_category['category_id'];
                        $category_title = $row_category['category_title'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                ?>
            </select>
        </div>
        
        <div class="form-outline mb-4">
            <label for="product_price">Product price</label>
            <input type="text" class="form-control w-50 m-auto" name="product_price" value="<?php echo $product_price; ?>" required>
        </div>

        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control" name="product_image1">
            <img src="./product_images/<?php echo $product_image1; ?>" alt="product image" class="edit-image" required>
        </div>

        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control" name="product_image2">
            <img src="./product_images/<?php echo $product_image2; ?>" alt="product image" class="edit-image" required>
        </div>

        <div class="form-outline mb-4">
            <input type="submit" class="btn btn-primary w-50 m-auto" name="product_update" value="UPDATE">
        </div>
    </form>
</body>
</html>