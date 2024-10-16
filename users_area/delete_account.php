<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>

<?php
    $user_session_name = $_SESSION['username'];
    if(isset($_POST['delete'])) {
        $delete_query = "DELETE FROM user_table WHERE username='$user_session_name'";
        $result_delete = mysqli_query($con, $delete_query);
        if($result_delete) {
            session_destroy();
            echo "<script>alert('Account deleted Successfully!')</script>";
            echo "<script>window.open('../index.php', '_self')</script>";
        }
    }

    if(isset($_POST['dont_delete'])) {
        echo "<script>window.open('profile.php', '_self')</script>";
    }
?>

<body>
    <h3 class='text-danger text-center my-4'>Delete Account</h3>
    <form action="" method="post">
        <div class="form-outline mb-3">
            <input type="submit" class="btn btn-danger text-center w-50 m-auto" name="delete" value="DELETE ACCOUNT">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="form-control border-danger text-danger text-center w-50 m-auto" name="dont_delete" value="DON'T DELETE ACCOUNT">
        </div>
    </form>
</body>
</html>