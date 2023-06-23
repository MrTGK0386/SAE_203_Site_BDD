<?php

    include_once '../../user_hook/protection.php';
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Supprimer des tremblements de terre</title>
</head>
<body>
    <?php
    include_once '../../sql_usage/SQLConnection.php';
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'update') {
                if (isset($_POST['eventId'], $_POST['gap'], $_POST['magnitude'], $_POST['significance'], $_POST['depth'], $_POST['distance'], $_POST['fullLocation'], $_POST['latitude'], $_POST['longitude'], $_POST['locationName'], $_POST['day'], $_POST['epoch'], $_POST['fullTime'], $_POST['hour'], $_POST['minute'], $_POST['month'], $_POST['second'], $_POST['year'])) {
                    $eventId = $_POST['eventId'];
                    $gap = $_POST['gap'];
                    $magnitude = $_POST['magnitude'];
                    $significance = $_POST['significance'];
                    $depth = $_POST['depth'];
                    $distance = $_POST['distance'];
                    $fullLocation = $_POST['fullLocation'];
                    $latitude = $_POST['latitude'];
                    $longitude = $_POST['longitude'];
                    $locationName = $_POST['locationName'];
                    $day = $_POST['day'];
                    $epoch = $_POST['epoch'];
                    $fullTime = $_POST['fullTime'];
                    $hour = $_POST['hour'];
                    $minute = $_POST['minute'];
                    $month = $_POST['month'];
                    $second = $_POST['second'];
                    $year = $_POST['year'];

                    updateEvent($conn, $eventId, $gap, $magnitude, $significance, $depth, $distance, $fullLocation, $latitude, $longitude, $locationName, $day, $epoch, $fullTime, $hour, $minute, $month, $second, $year);
                }
            } elseif ($action === 'delete') {
                if (isset($_POST['eventId'])) {
                    $eventId = $_POST['eventId'];

                    deleteEvent($conn, $eventId);
                }
            } 
        }
    }

    // Function to retrieve all rows from the earthquake table
    function getEvents($conn) {
        $tableName = "sae203_eq";
        $query = "SELECT * FROM $tableName";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error executing query: " . mysqli_error($conn));
        }

        $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);

        return $events;
    }

    // Function to update an event row
    function updateEvent($conn, $eventId, $gap, $magnitude, $significance, $depth, $distance, $fullLocation, $latitude, $longitude, $locationName, $day, $epoch, $fullTime, $hour, $minute, $month, $second, $year) {
        $tableName = "sae203_eq";
        $gap = mysqli_real_escape_string($conn, $gap);
        $magnitude = mysqli_real_escape_string($conn, $magnitude);
        $significance = mysqli_real_escape_string($conn, $significance);
        $depth = mysqli_real_escape_string($conn, $depth);
        $distance = mysqli_real_escape_string($conn, $distance);
        $fullLocation = mysqli_real_escape_string($conn, $fullLocation);
        $latitude = mysqli_real_escape_string($conn, $latitude);
        $longitude = mysqli_real_escape_string($conn, $longitude);
        $locationName = mysqli_real_escape_string($conn, $locationName);
        $day = mysqli_real_escape_string($conn, $day);
        $epoch = mysqli_real_escape_string($conn, $epoch);
        $fullTime = mysqli_real_escape_string($conn, $fullTime);
        $hour = mysqli_real_escape_string($conn, $hour);
        $minute = mysqli_real_escape_string($conn, $minute);
        $month = mysqli_real_escape_string($conn, $month);
        $second = mysqli_real_escape_string($conn, $second);
        $year = mysqli_real_escape_string($conn, $year);

        $query = "UPDATE $tableName SET `impact.gap`='$gap', `impact_magnitude`='$magnitude', `impact.significance`='$significance', `location.depth`='$depth', `location-distance`='$distance', `location.full`='$fullLocation', `location_latitude`='$latitude', `location_longitude`='$longitude', `location.name`='$locationName', `time.day`='$day', `time.epoch`='$epoch', `time.full`='$fullTime', `time.hour`='$hour', `time.minute`='$minute', `time.month`='$month', `time.second`='$second', `time.year`='$year' WHERE id='$eventId'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error updating event: " . mysqli_error($conn));
        }

        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
    
    // Function to delete an event row
    function deleteEvent($conn, $eventId) {
        $tableName = "sae203_eq";
        $query = "DELETE FROM $tableName WHERE id='$eventId'";
        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            die("Error deleting event: " . mysqli_error($conn));
        } else {
            echo "Event deleted successfully";
        }
    
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }


    // Display the earthquake table
    $events = getEvents($conn);
    ?>

<table>
    <tr>
        <th>ID</th>
        <th>Full Location</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Location Name</th>
        <th>Action</th>
    </tr>
    <?php foreach ($events as $event): ?>
        <tr>
            <td><?php echo $event['id']; ?></td>
            <td><?php echo $event['location.full']; ?></td>
            <td><?php echo $event['location_longitude']; ?></td>
            <td><?php echo $event['location_latitude']; ?></td>
            <td><?php echo $event['location.name']; ?></td>
            <td>
                
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="eventId" value="<?php echo $event['id']; ?>">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit" class="btn btn-danger" value="Delete" onclick="return confirm('Voulez vous vraiment supprimer ce tremblement de terre ?')">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>




    <br><button  class="btn btn-dark" onclick="location.href='deleteEventList.php'">Retour</button>

</body>
</html>