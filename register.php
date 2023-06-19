<?php
include_once 'SQLConnection.php';

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (!$conn) {
        die("La connexion a échoué : " . mysqli_connect_error());
    }

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $error = "Username already exists";
    } else {
        $insertQuery = "INSERT INTO users (username, password, email, admin) VALUES ('$username', '$password', '$email', 0)";
        if (mysqli_query($conn, $insertQuery)) {
            $_SESSION['username'] = $username;
            header("Location: connection.php");
            exit;
        } else {
            $error = "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php
    if (isset($error)) {
        echo '<div style="color: red;">' . $error . '</div>';
    }
    ?>
    <form method="POST" action="">
        <div>
            <label for="username">Email:</label>
            <input type="mail" id="username" name="email" required>
        </div>

        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Submit</button> <?php echo ' or <button onclick="location.href=\'login.php\'">Login</button>' ?>
        </div>
    </form>
    <?php echo '<button onclick="location.href=\'index.php\'">Menu</button>' ?>
    
</body>
</html>
