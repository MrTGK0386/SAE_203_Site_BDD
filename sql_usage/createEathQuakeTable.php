<?php

include_once 'SQLConnection.php';

$tableName = 'earthQuake';

// Check if the table exists
$result = mysqli_query($conn, "SHOW TABLES LIKE '$tableName'");
if (mysqli_num_rows($result) > 0) {
    echo "Table '$tableName' already exists.";
    // Handle the case when the table exists
} else {
    // Create the table
    $sql = "CREATE TABLE $tableName(
  `id` varchar(30) DEFAULT NULL,
  `impact.gap` float DEFAULT NULL,
  `impact_magnitude` float DEFAULT NULL,
  `impact.significance` int(11) DEFAULT NULL,
  `location.depth` float DEFAULT NULL,
  `location-distance` float DEFAULT NULL,
  `location.full` varchar(255) DEFAULT NULL,
  `location_latitude` float DEFAULT NULL,
  `location_longitude` float DEFAULT NULL,
  `location.name` varchar(255) DEFAULT NULL,
  `time.day` int(11) DEFAULT NULL,
  `time.epoch` varchar(255) DEFAULT NULL,
  `time.full` varchar(255) DEFAULT NULL,
  `time.hour` varchar(255) DEFAULT NULL,
  `time.minute` varchar(255) DEFAULT NULL,
  `time.month` varchar(255) DEFAULT NULL,
  `time.second` varchar(255) DEFAULT NULL,
  `time.year` varchar(255) DEFAULT NULL
)";

    if (mysqli_query($conn, $sql)) {
        echo "Table '$tableName' created successfully.";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
