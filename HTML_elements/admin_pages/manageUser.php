<!DOCTYPE html>
<html>
<head>
    <title>User Table</title>
</head>
<body>
    <?php
    include_once '../../sql_usage/SQLConnection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'update') {
                if (isset($_POST['userId'], $_POST['username'], $_POST['password'], $_POST['email'], $_POST['admin'])) {
                    $userId = $_POST['userId'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    $admin = $_POST['admin'];

                    updateUser($conn, $userId, $username, $password, $email, $admin);
                }
            } elseif ($action === 'delete') {
                if (isset($_POST['userId'])) {
                    $userId = $_POST['userId'];

                    deleteUser($conn, $userId);
                }
            }
        }
    }

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

    // Function to delete a user row
    function deleteUser($conn, $userId) {
        $query = "DELETE FROM users WHERE id=$userId";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Erreur lors de la suppression de l'utilisateur: " . mysqli_error($conn));
        }

        echo "Utilisateur supprimé avec succès.";
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
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="action" value="update">
                        <button type="submit">Update</button>
                    </form>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
