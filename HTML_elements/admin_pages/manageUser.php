<!DOCTYPE html>
<html>
<head>
    <title>User Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <?php

    include_once '../../sql_usage/SQLConnection.php';
    include_once '../../user_hook/protection.php';
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'update') {
                if (isset($_POST['userId'], $_POST['username'], $_POST['email'])) {
                    $userId = $_POST['userId'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $admin = isset($_POST['admin']) ? 1 : 0;

                    updateUser($conn, $userId, $username, $email, $admin);
                }
            } elseif ($action === 'delete') {
                if (isset($_POST['userId'])) {
                    $userId = $_POST['userId'];

                    deleteUser($conn, $userId);
                }
            } elseif ($action === 'create') {
                if (isset($_POST['username'], $_POST['password'], $_POST['email'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    $admin = isset($_POST['admin']) ? 1 : 0;

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
    function updateUser($conn, $userId, $username, $email, $admin) {
        $tableName = "sae203_users";
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
    
        $query = "UPDATE $tableName SET username='$username', email='$email', admin=$admin WHERE id=$userId";
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
    

<h1>Edit Users</h1>

<table class="table">
    <thead>
        <tr>
            <th>Username</th>
            <!-- <th>Password</th> -->
            <th>Email</th>
            <th>Admin</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="action" value="update">
                        <div class="input-group">
                            <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>">
                        </div>
                </td>
                <!-- <td>
                    <div class="input-group">
                        <input type="hidden" name="password" value="<?php echo $user['password']; ?>">
                        <input type="text" class="form-control" name="password" value="<?php echo $user['password']; ?>">
                    </div>
                </td> -->
                <td>
                    <div class="input-group">
                        <input type="hidden" name="email" value="<?php echo $user['email']; ?>">
                        <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>">
                    </div>
                </td>
                <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="admin" value="1" <?php if ($user['admin'] == 1) echo 'checked'; ?>>
                        <label class="form-check-label">Admin</label>
                    </div>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                    </div>
                    </form>
                    
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Supprimer</button>
                        </div>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h1>Add user</h1>
<table class="table">
    <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                </td>
                <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="admin" value="1">
                        <label class="form-check-label">Admin</label>
                    </div>
                </td>
                <td>
                    <input type="hidden" name="action" value="create">
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </td>
            </form>
        </tr>
    </tbody>
</table>


    <br><button class="btn btn-dark" onclick="location.href='configurationPanel.php'">Retour</button>

</body>
</html>
