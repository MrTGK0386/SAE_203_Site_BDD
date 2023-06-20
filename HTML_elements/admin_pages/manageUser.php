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
            } elseif ($action === 'create') {
                if (isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['admin'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    $admin = $_POST['admin'];

                    createUser($conn, $username, $password, $email, $admin);
                }
            }
        }
    }

    // Function to retrieve all rows from the users table
    
    function getUsers($conn) {
        $tableName = "sae203_users";
        $query = "SELECT * FROM $tableName";
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
        $tableName = "sae203_users";
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $email = mysqli_real_escape_string($conn, $email);
        $admin = mysqli_real_escape_string($conn, $admin);
    
        // Ensure the admin value is properly quoted in the SQL query
        $admin = $admin == '1' ? '1' : '0';
    
        $query = "UPDATE $tableName SET username='$username', password='$password', email='$email', admin=$admin WHERE id=$userId";
        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            die("Erreur lors de la mise à jour de l'utilisateur: " . mysqli_error($conn));
        }
    
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
    
    // Function to delete a user row
    function deleteUser($conn, $userId) {
        $tableName = "sae203_users";
        $query = "DELETE FROM $tableName WHERE id=$userId";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Erreur lors de la suppression de l'utilisateur: " . mysqli_error($conn));
        }

        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    // Function to create a new user
    function createUser($conn, $username, $password, $email, $admin) {
        $tableName = "sae203_users";
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $email = mysqli_real_escape_string($conn, $email);
        $admin = mysqli_real_escape_string($conn, $admin);
    
        // Ensure the admin value is properly quoted in the SQL query
        $admin = $admin == '1' ? '1' : '0';
    
        $query = "INSERT INTO $tableName (username, password, email, admin) VALUES ('$username', '$password', '$email', $admin)";
        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            die("Erreur lors de la création de l'utilisateur: " . mysqli_error($conn));
        }
    
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
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
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="action" value="update">
                        <input type="text" name="username" value="<?php echo $user['username']; ?>">
                </td>
                <td>
                    <input type="hidden" name="password" value="<?php echo $user['password']; ?>">
                    <input type="text" name="password" value="<?php echo $user['password']; ?>">
                </td>
                <td>
                    <input type="hidden" name="email" value="<?php echo $user['email']; ?>">
                    <input type="text" name="email" value="<?php echo $user['email']; ?>">
                </td>
                <td>
                    <input type="hidden" name="admin" value="<?php echo $user['admin']; ?>">
                    <input type="text" name="admin" value="<?php echo $user['admin']; ?>">
                </td>
                <td>
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
        <tr>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <td>
                    <input type="text" name="username" placeholder="Username">
                </td>
                <td>
                    <input type="text" name="password" placeholder="Password">
                </td>
                <td>
                    <input type="text" name="email" placeholder="Email">
                </td>
                <td>
                    <input type="text" name="admin" placeholder="Admin">
                </td>
                <td>
                    <input type="hidden" name="action" value="create">
                    <button type="submit">Create</button>
                </td>
            </form>
        </tr>
    </table>

</body>
</html>
