<?php
    include '../includes/connect.php';

    if(isset($_POST['insert_product'])) {
        $product_title = $_POST['product_title'];
        $product_description = $_POST['product_description'];
        $product_categories = $_POST['product_categories'];
        $product_price = $_POST['product_price'];
        $product_status = 'true';

        //accessing image name
        $product_image1 = $_FILES['product_image1']['name'];
        $product_image2 = $_FILES['product_image2']['name'];

        //accessing image temp name
        $temp_image1 = $_FILES['product_image1']['tmp_name'];
        $temp_image2 = $_FILES['product_image2']['tmp_name'];

        //checking empty condition
        if (empty($product_title) || empty($product_description) || empty($product_categories) || empty($product_price) || empty($product_image1) || empty($product_image2)) {
            echo "<script>alert('Please fill all the available fields!');</script>";
            exit();
        } else {
            move_uploaded_file($temp_image1, "./product_images/$product_image1");
            move_uploaded_file($temp_image2, "./product_images/$product_image2");

            //insert query
            $insert_query = "INSERT INTO products (product_title, product_description, category_id, product_image1, product_image2, product_price, date, status) 
                            VALUES ('$product_title', '$product_description', '$product_categories', '$product_image1', '$product_image2', '$product_price', NOW(), '$product_status')";
            $result_query = mysqli_query($con, $insert_query);
            if($result_query) {
                echo "<script>alert('Product has been inserted successfully!')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products - Admin Dashboard</title>

    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="../style.css">

</head>
<body>
    <div class="container mt-2">
        <h4 class="text-center mt-4">Insert Products</h4>
        <form action="" method="post" class="mb-2" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="product_title" class="form-label mt-2">Product title</label>
                <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Enter product title" autocomplete="off">
            </div>
            <!-- description -->
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="product_description" class="form-label mt-2">Product Description</label>
                <input type="text" class="form-control" name="product_description" id="product_description" placeholder="Enter product description" autocomplete="off">
            </div>
            <!-- categories -->
            <div class="form-outline mb-2 w-50 m-auto">
                <select name="product_categories" class="form-select mt-4">
                    <option value="">Select a Category</option>
                    <?php
                        $select_query = "SELECT * FROM categories";
                        $result_query = mysqli_query($con, $select_query);

                        while ($row_data = mysqli_fetch_assoc($result_query)) {
                            $category_title = $row_data['category_title'];
                            $category_id = $row_data['category_id'];

                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>
                </select>
            </div>
            <!-- image 1 -->
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="product_image1" class="form-label mt-2">Product Image 1</label>
                <input type="file" class="form-control" name="product_image1" class="form-control">
            </div>
            <!-- image 2 -->
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="product_image2" class="form-label mt-2">Product Image 1</label>
                <input type="file" class="form-control" name="product_image2" class="form-control">
            </div>
            <!-- price -->
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="product_price" class="form-label mt-2">Product Price</label>
                <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter product price" autocomplete="off">
            </div>
            <!-- submit -->
            <div class="form-outline mb-2 w-50 m-auto">
                <input type="submit" class="btn btn-primary mt-2" name="insert_product" value="Insert Products">
            </div>
        </form>
    </div>
    
</body>
</html>