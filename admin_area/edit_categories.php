<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Categories</title>
</head>


<?php

    //get categories
    if(isset($_GET['edit-categories'])) {
        $edit_id = $_GET['edit-categories'];
        $select_query = "SELECT * FROM categories WHERE category_id=$edit_id";
        $result_query = mysqli_query($con, $select_query);
        $row_data = mysqli_fetch_assoc($result_query);
        $category_title = $row_data['category_title'];
    }

    //update categories
    if(isset($_POST['category_update'])) {
        $update_id = $edit_id;
        $category_title = $_POST['category_title'];
        $update_query = "UPDATE categories
                        SET category_title='$category_title'  
                        WHERE category_id=$update_id";
        $result_update = mysqli_query($con, $update_query);
        if($result_update){
            echo "<script>alert('Category updated succesfully!')</script>";
            echo "<script>window.open('index.php?view-categories', '_self')</script>";
        }
    }
?>


<body>
    <h3 class='text-success mb-4'>Edit Product</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-3">
            <label for="category_title">Category title</label>
            <input type="text" class="form-control w-50 m-auto" name="category_title" value="<?php echo $category_title; ?>" required>
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="btn btn-primary w-50 m-auto" name="category_update" value="UPDATE">
        </div>
    </form>
</body>
</html>