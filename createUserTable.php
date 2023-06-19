<?php

include_once 'SQLConnection.php';
$tableName = 'users';

// Check if the table exists
$result = mysqli_query($conn, "SHOW TABLES LIKE '$tableName'");
if (mysqli_num_rows($result) > 0) {
    echo "<script>console.log('Table $tableName already exists.');</script>";
    // Handle the case when the table exists
} else {
    // Create the table
    $sql = "CREATE TABLE $tableName (
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        admin BIT(1) NOT NULL
    )";

    $statement = mysqli_prepare($conn, $sql) or die(mysqli_error($conn));
    mysqli_stmt_execute($statement) or die(mysqli_error($conn));

    $addRoot = "INSERT INTO users (username, password, email, admin) VALUES ('root', 'root', 'root@gmail.com', 1)";
    $statement2 = mysqli_prepare($conn,$addRoot)

    if (mysqli_query($conn, $sql)) {
        // echo "Table '$tableName' created successfully.";
        $insertQuery = ;
        if (mysqli_query($conn, $insertQuery)){
            // echo "add user admin";
        };


    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
