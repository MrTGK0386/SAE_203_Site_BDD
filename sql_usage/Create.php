<?php
include_once 'sql_usage/SQLConnection.php';
$tableName = "";

// Check if the table exists
$result = mysqli_query($conn, "SHOW TABLES LIKE '$tableName'");
if (mysqli_num_rows($result) > 0) {
    echo "<script>console.log('Table '$tableName' already exists.');</script>";
    // Handle the case when the table exists
} else {
    // Create the table

    $sql = "";
    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($statement) or die(mysqli_error($conn));

    $addData = "";

    $statement2 = mysqli_prepare($conn, $addData) or die(mysqli_error($conn));
    mysqli_stmt_execute($statement2) or die(mysqli_error($conn));

}
?>
