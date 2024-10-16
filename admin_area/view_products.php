<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
</head>
<body>
    <h3 class="text-center text-success mt-4">All Products</h3>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //get products
                $select_query = "SELECT * FROM products";
                $result_query = mysqli_query($con, $select_query);
                while($row_products = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row_products['product_id'];
                    $product_title = $row_products['product_title'];
                    $product_image1 = $row_products['product_image1'];
                    $product_price = $row_products['product_price'];
                    $status = $row_products['product_price'];
                    echo "<tr>
                            <td>$product_id</td>
                            <td>$product_title</td>
                            <td><img src='./product_images/$product_image1' class='cart-img'></td>
                            <td>$product_price</td>
                            <td><a href='index.php?edit-products=$product_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
                            <td><a href='index.php?delete-products=$product_id' onclick='return confirm(\"Are you sure you want to delete this product?\")'><i class='fa-solid fa-trash text-danger'></i></a></td>
                        </tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>