<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login and Registration System</title>
</head>
<body>
    <header>
        <link rel="stylesheet" href="styles/style.css">
        <h1>placeholder</h1>
        <?php
        if (isset($_SESSION['username'])) {
            echo '<div class="login-state">Logged in as ' . $_SESSION['username'] . '</div>';
        } else {
            echo '<div class="login-state">Not logged in</div>';
        }
        ?>
        <button onclick="toggleProfilePopup()">Profile</button>
    </header>

    <div id="profile-popup" style="display: none;">
    <?php
    if (isset($_SESSION['username'])) {
        echo 'Welcome, ' . $_SESSION['username'] . '!';
        echo '<br><button onclick="location.href=\'logout.php\'">Logout</button>';
    } else {
        echo '<button onclick="location.href=\'login.php\'">Login</button> or <button onclick="location.href=\'register.php\'">Register</button>';
    }
    ?>
</div>

    <script>
        function toggleProfilePopup() {
            var popup = document.getElementById("profile-popup");
            if (popup.style.display === "none") {
                popup.style.display = "block";
            } else {
                popup.style.display = "none";
            }
        }
    </script>
</body>
</html>
