<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories</title>
</head>
<body>
    <h3 class="text-center text-success mt-4">All Categories</h3>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Category Title</th>
                <th>edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //get categories
                $select_query = "SELECT * FROM categories";
                $result_query = mysqli_query($con, $select_query);
                while($row_products = mysqli_fetch_assoc($result_query)) {
                    $category_id = $row_products['category_id'];
                    $category_title = $row_products['category_title'];
                    echo "<tr>
                            <td>$category_id</td>
                            <td>$category_title</td>
                            <td><a href='index.php?edit-categories=$category_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
                            <td><a href='index.php?delete-categories=$category_id' onclick='return confirm(\"Are you sure you want to delete this category?\")'><i class='fa-solid fa-trash text-danger'></i></a></td>
                        </tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>