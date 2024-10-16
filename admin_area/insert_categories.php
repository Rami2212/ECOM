<?php
    include('../includes/connect.php');

    if(isset($_POST['insert_category'])) {
        $category_title = $_POST['category_title'];
        $select_query = "select * from categories where category_title='$category_title'";
        $result_select = mysqli_query($con, $select_query);
        $number = mysqli_num_rows($result_select);
        if($number>0) {
            echo "<script>alert('This category already has been inserted!')</script>";
        }else {
            $insert_query = "insert into categories(category_title) values('$category_title')";
            $result = mysqli_query($con, $insert_query);
            if($result) {
                echo "<script>alert('Category has been inserted successfully!')</script>";
            }
        }
    }
?>

<div class="container">
    <h4>Insert Categories</h4>
    <form action="" method="post" class="mb-2">
        <div class="input-group w-90 mb-2">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
            <input type="text" class="form-control" name="category_title" placeholder="Insert Categories" aria-label="Category Title" aria-describedby="basic-addon1">
        </div>
        <div class="input-group w-100 mb-2">
            <input type="submit" class="btn btn-primary" name="insert_category" value="Insert Categories">
        </div>
    </form>
</div>
