<?php

include_once 'SQLConnection.php';
$tableName = 'sae203_users';

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

    $passwordRoot = "root";
    $HashedPSWDroot = password_hash($passwordRoot, PASSWORD_BCRYPT);
    
    $addRoot = "INSERT INTO $tableName (username, password, email, admin) VALUES ('root', $HashedPSWDroot, 'root@gmail.com', 1)";
    $statement2 = mysqli_prepare($conn,$addRoot) or die(mysqli_error($conn));
    // mysqli_stmt_bind_param($statement2,"isssi",$username,$password,$email,$admin) or die(mysqli_error($conn));
    mysqli_stmt_execute($statement2) or die(mysqli_error($conn));

    //echo "Error creating table: " . mysqli_error($conn);

}

?>
