<?php
include_once 'sql_usage/SQLConnection.php';

function getEq($conn) {
    $tableName = "sae203_eq";
    $query = "SELECT * FROM $tableName ORDER BY `time.full` DESC LIMIT 5";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    return $events;
};
function getMeteor($conn) {
    $tableName = "sae203_meteor";
    $query = "SELECT * FROM $tableName WHERE `GeoLocation` != '(0.0, 0.0)' ORDER BY `year` DESC LIMIT 5";


    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    return $events;
};
function getVolcano($conn) {
    $tableName = "sae203_volcano";
    $query = "SELECT * FROM $tableName  WHERE `last_eruption_year` != 'Unknown'  ORDER BY `last_eruption_year` DESC LIMIT 5";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    return $events;
};



?>