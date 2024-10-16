<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
</head>
<body>
    <h3 class="text-center text-success mt-4">All Users</h3>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Image</th>
                <th>Email</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //get users
                $select_query = "SELECT * FROM user_table";
                $result_query = mysqli_query($con, $select_query);
                while($row_users = mysqli_fetch_assoc($result_query)) {
                    $user_id = $row_users['user_id'];
                    $username = $row_users['username'];
                    $user_image = $row_users['user_image'];
                    $user_email = $row_users['user_email'];
                    $user_adress = $row_users['user_adress'];
                    $user_mobile = $row_users['user_mobile'];
                    echo "<tr>
                            <td>$user_id</td>
                            <td>$username</td>
                            <td><img src='../users_area/user_images/$user_image' class='cart-img'></td>
                            <td>$user_email</td>
                            <td>$user_adress</td>
                            <td>$user_mobile</td>
                            <td><a href='index.php?delete-user=$user_id' onclick='return confirm(\"Are you sure you want to delete this user?\")'><i class='fa-solid fa-trash text-danger'></i></a></td>
                        </tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>