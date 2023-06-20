<?php
include_once '../../sql_usage/SQLConnection.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Table</title>
</head>
<body>
    <?php

        // Function to retrieve all rows from the users table
        function getUsers($conn) {
            $query = "SELECT * FROM users";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
            }

            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_free_result($result);

            return $users;
        }

        // Function to update a user row
        function updateUser($conn, $userId, $username, $password, $email, $admin) {
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);
            $email = mysqli_real_escape_string($conn, $email);
            $admin = mysqli_real_escape_string($conn, $admin);

            $query = "UPDATE users SET username='$username', password='$password', email='$email', admin='$admin' WHERE id=$userId";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Erreur lors de la mise à jour de l'utilisateur: " . mysqli_error($conn));
            }

            echo "Utilisateur mis à jour avec succès.";
        }

        // Display the user table
        $users = getUsers($conn);
        ?>

        <table>
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <input type="text" name="username" value="<?php echo $user['username']; ?>">
                    </td>
                    <td>
                        <input type="text" name="password" value="<?php echo $user['password']; ?>">
                    </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $user['email']; ?>">
                    </td>
                    <td>
                        <input type="text" name="admin" value="<?php echo $user['admin']; ?>">
                    </td>
                    <td>
                        <button onclick="updateUser(<?php echo $user['id']; ?>)">Update</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <script>
            function updateUser(userId) {
                var username = document.getElementsByName("username")[userId - 1].value;
                var password = document.getElementsByName("password")[userId - 1].value;
                var email = document.getElementsByName("email")[userId - 1].value;
                var admin = document.getElementsByName("admin")[userId - 1].value;

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                    }
                };
                xhttp.open("GET", "update_user.php?userId=" + userId + "&username=" + username + "&password=" + password + "&email=" + email + "&admin=" + admin, true);
                xhttp.send();
            }
        </script>
</body>
</html>
