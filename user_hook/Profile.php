<!DOCTYPE html>
<html>

<head>
    <title>User Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100 container">
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
    
    // Function to retrieve user information
    function getUser($conn, $username)
    {
        $tableName = "sae203_users";
        $username = mysqli_real_escape_string($conn, $username);
        $query = "SELECT * FROM $tableName WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
        }

        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        return $user;
    }
    
    
    // Function to update a user row
    function updateUser($conn, $userId, $username, $email, $password)
    {
        $tableName = "sae203_users";
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
    
        // Vérifie si le mot de passe est non vide, puis le hache
        if (!empty($password)) {
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);
            $query = "UPDATE $tableName SET username='$username', email='$email', password='$password_hashed' WHERE id=$userId";
        } else {
            // Si le mot de passe est vide, effectue la mise à jour sans changer le mot de passe
            $query = "UPDATE $tableName SET username='$username', email='$email' WHERE id=$userId";
        }
    
        $result = mysqli_query($conn, $query);
        $_SESSION["username"] = $username;
    
        if (!$result) {
            die("Erreur lors de la mise à jour de l'utilisateur: " . mysqli_error($conn));
        }
    
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    
    // Display the user table
    $users = getUser($conn, $username);
    
    ?>


    <div class="form-signin m-auto">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <a href="index.php">
                <img src="../assets/rocket_planet.png" alt="Logo" class="rounded-circle" width="64" height="64">
            </a>
            <h1 class="h3 mb-3 fw-normal">Modifier votre profil</h1>

            <input type="hidden" name="userId" value="<?php echo $users['id']; ?>">
            <input type="hidden" name="action" value="update">
            <div class="form-floating mb-3 input-group">
                <span class="input-group-text" id="basic-addon1">Pseudonyme</span>
                <input type="text" class="form-control" name="username" value="<?php echo $users['username']; ?>">
            </div>

            <div class="form-floating mb-3 input-group">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="hidden" name="email" value="<?php echo $users['email']; ?>">
                <input type="text" class="form-control" name="email" value="<?php echo $users['email']; ?>">
            </div>

            <div class=" form-floating mb-3 input-group">
                <span class="input-group-text" id="basic-addon1">Mot de passe</span>
                <input type="hidden" name="password" value="<?php echo $users['password']; ?>">
                <input type="password" class=" form-control" name="password" value="<?php echo $users['password']; ?>">
            </div>

            <div class="btn-group w-100" role="group">
                <button type="submit" class="btn btn-success">Mettre à jour</button>
            </div>
        </form>

        <form class="w-100 py-2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="userId" value="<?php echo $users['id']; ?>">
            <input type="hidden" name="action" value="delete">
            <div class="btn-group w-100" role="group">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez vous vraiment supprimer votre compte ?')">Supprimer votre compte</button>
            </div>
        </form>

        <button class="btn btn-link w-100 py-2 mt-5" onclick="location.href='../index.php'">Retour</button>
    </div>


    <?php include_once '../HTML_elements/footer.php';
    include_once "../HTML_elements/lightSwitch.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="../Scripts/main.js"></script>
</body>

</html>