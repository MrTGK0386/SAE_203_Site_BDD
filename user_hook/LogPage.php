<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La page de fou - Page de connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <link href="https://cesium.com/downloads/cesiumjs/releases/1.106/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
    <?php
    session_start();
    include_once '../sql_usage/createUserTable.php';

    if (isset($_SESSION['username'])) {
        header("Location: ../index.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    session_unset();
    session_destroy();
    session_start();


    if (!$conn) {
        die("La connexion a échoué : " . mysqli_connect_error());
    }

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM sae203_users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['admin'] = $row['admin']; // Store the admin state in the session
        header("Location: ../index.php");
        exit;
    } else {
        $error = "Il y a une erreur dans votre pseudo ou votre mot de passe";
    }

    mysqli_close($conn);
}

    ?>
</head>

<body class="d-flex flex-column min-vh-100 container">
<div class="form-signin m-auto">
    <form method="post" action="">
        <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Connectez-vous s'il vous plaît</h1>
        <?php
        if (isset($error)) {
            echo '<div class="mt-5 mb-3 text-danger">' . $error . '</div>';
        }
        ?>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Xx_DarkTitouanDu34_xX" required>
            <label for="floatingInput">Pseudo</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Your Password" required>
            <label for="floatingPassword">Mot de passe</label>
        </div>

        <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Se connecter</button>
        <button class="btn btn-secondary w-100 py-2" onclick="location.href='register.php'">Créer un compte</button>
        <p class="mt-5 mb-3 text-body-secondary w-100 text-center">© 2023 Rocket Planet</p>
    </form>
</div>


</body>