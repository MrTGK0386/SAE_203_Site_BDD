<!DOCTYPE html>
<html>
<head>
    <title>User Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    session_start();
    include_once '../sql_usage/SQLConnection.php';
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'update') {
                if (isset($_POST['userId'], $_POST['username'], $_POST['email'], $_POST['password'])) {
                    $userId = $_POST['userId'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    updateUser($conn, $userId, $username, $email, $password);
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
        $tableName = "sae203_users";
        $username = $_SESSION["username"];
        $query = "SELECT * FROM $tableName WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
        }
    
        $users = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    
        return $users;
    }
    

    // Function to update a user row
    function updateUser($conn, $userId, $username, $email, $password) {
        $tableName = "sae203_users";
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
    
        $query = "UPDATE $tableName SET username='$username', email='$email', password='$password' WHERE id=$userId";
        $result = mysqli_query($conn, $query);
        $_SESSION["username"] = $username;
    
        if (!$result) {
            die("Erreur lors de la mise à jour de l'utilisateur: " . mysqli_error($conn));
        }
    
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    // Display the user table
    $users = getUsers($conn);
    ?>
    

<h1>Votre profil</h1>

<table class="table">
    <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="userId" value="<?php echo $users['id']; ?>">
                        <input type="hidden" name="action" value="update">
                        <div class="input-group">
                            <input type="text" class="form-control" name="username" value="<?php echo $users['username']; ?>">
                        </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="hidden" name="password" value="<?php echo $users['password']; ?>">
                        <input type="password class="form-control" name="password" value="<?php echo $users['password']; ?>">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="hidden" name="email" value="<?php echo $users['email']; ?>">
                        <input type="text" class="form-control" name="email" value="<?php echo $users['email']; ?>">
                    </div>
                </td>

                <td>
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                    </div>
                    </form>
                    
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="userId" value="<?php echo $users['id']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Supprimer</button>
                        </div>
                    </form>
                </td>
            </tr>
    </tbody>
</table>




    <br><button class="btn btn-dark" onclick="location.href='configurationPanel.php'">Retour</button>

</body>
</html>
