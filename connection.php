<?php
$servername = "localhost:13306";
$username = "root";
$password = "";
$dbname = "gaetan.bondenet";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}
else {
    echo "ok";
}

$tableName = 'users';

// Check if the table exists
$result = mysqli_query($conn, "SHOW TABLES LIKE '$tableName'");
if (mysqli_num_rows($result) > 0) {
    echo "Table '$tableName' already exists.";
    // Handle the case when the table exists
} else {
    // Create the table
    $sql = "CREATE TABLE $tableName (
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        admin BOOLEAN NOT NULL
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Table '$tableName' created successfully.";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
