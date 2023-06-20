<!DOCTYPE html>
<html>
<head>
    <title>Edit Event Page</title>
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
            } elseif ($action === 'create') {
                if (isset($_POST['gap'], $_POST['magnitude'], $_POST['significance'], $_POST['depth'], $_POST['distance'], $_POST['fullLocation'], $_POST['latitude'], $_POST['longitude'], $_POST['locationName'], $_POST['day'], $_POST['epoch'], $_POST['fullTime'], $_POST['hour'], $_POST['minute'], $_POST['month'], $_POST['second'], $_POST['year'])) {
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

                    createEvent($conn, $gap, $magnitude, $significance, $depth, $distance, $fullLocation, $latitude, $longitude, $locationName, $day, $epoch, $fullTime, $hour, $minute, $month, $second, $year);
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
    

    // Function to create a new event
    function createEvent($conn, $gap, $magnitude, $significance, $depth, $distance, $fullLocation, $latitude, $longitude, $locationName, $day, $epoch, $fullTime, $hour, $minute, $month, $second, $year) {
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

        $query = "INSERT INTO $tableName (`impact.gap`, `impact_magnitude`, `impact.significance`, `location.depth`, `location-distance`, `location.full`, `location_latitude`, `location_longitude`, `location.name`, `time.day`, `time.epoch`, `time.full`, `time.hour`, `time.minute`, `time.month`, `time.second`, `time.year`) VALUES ('$gap', '$magnitude', '$significance', '$depth', '$distance', '$fullLocation', '$latitude', '$longitude', '$locationName', '$day', '$epoch', '$fullTime', '$hour', '$minute', '$month', '$second', '$year')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error creating event: " . mysqli_error($conn));
        }

        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    // Display the earthquake table
    $events = getEvents($conn);
    ?>

    <table>
        <tr>
            <th>Gap</th>
            <th>Magnitude</th>
            <th>Significance</th>
            <th>Depth</th>
            <th>Distance</th>
            <th>Full Location</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Location Name</th>
            <th>Day</th>
            <th>Epoch</th>
            <th>Full Time</th>
            <th>Hour</th>
            <th>Minute</th>
            <th>Month</th>
            <th>Second</th>
            <th>Year</th>
            <th>Action</th>
        </tr>
        <?php foreach ($events as $event): ?>
            <tr>
                <td>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="eventId" value="<?php echo $event['id']; ?>">
                        <input type="hidden" name="action" value="update">
                        <input type="text" name="gap" value="<?php echo $event['impact.gap']; ?>">
                </td>
                <td>
                    <input type="text" name="magnitude" value="<?php echo $event['impact_magnitude']; ?>">
                </td>
                <td>
                    <input type="text" name="significance" value="<?php echo $event['impact.significance']; ?>">
                </td>
                <td>
                    <input type="text" name="depth" value="<?php echo $event['location.depth']; ?>">
                </td>
                <td>
                    <input type="text" name="distance" value="<?php echo $event['location-distance']; ?>">
                </td>
                <td>
                    <input type="text" name="fullLocation" value="<?php echo $event['location.full']; ?>">
                </td>
                <td>
                    <input type="text" name="latitude" value="<?php echo $event['location_latitude']; ?>">
                </td>
                <td>
                    <input type="text" name="longitude" value="<?php echo $event['location_longitude']; ?>">
                </td>
                <td>
                    <input type="text" name="locationName" value="<?php echo $event['location.name']; ?>">
                </td>
                <td>
                    <input type="text" name="day" value="<?php echo $event['time.day']; ?>">
                </td>
                <td>
                    <input type="text" name="epoch" value="<?php echo $event['time.epoch']; ?>">
                </td>
                <td>
                    <input type="text" name="fullTime" value="<?php echo $event['time.full']; ?>">
                </td>
                <td>
                    <input type="text" name="hour" value="<?php echo $event['time.hour']; ?>">
                </td>
                <td>
                    <input type="text" name="minute" value="<?php echo $event['time.minute']; ?>">
                </td>
                <td>
                    <input type="text" name="month" value="<?php echo $event['time.month']; ?>">
                </td>
                <td>
                    <input type="text" name="second" value="<?php echo $event['time.second']; ?>">
                </td>
                <td>
                    <input type="text" name="year" value="<?php echo $event['time.year']; ?>">
                </td>
                <td>
                    <input type="submit" value="Update">
                    </form>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="eventId" value="<?php echo $event['id']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this event?')">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Create New Event</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="action" value="create">
        <label>Gap:</label>
        <input type="text" name="gap"><br>
        <label>Magnitude:</label>
        <input type="text" name="magnitude"><br>
        <label>Significance:</label>
        <input type="text" name="significance"><br>
        <label>Depth:</label>
        <input type="text" name="depth"><br>
        <label>Distance:</label>
        <input type="text" name="distance"><br>
        <label>Full Location:</label>
        <input type="text" name="fullLocation"><br>
        <label>Latitude:</label>
        <input type="text" name="latitude"><br>
        <label>Longitude:</label>
        <input type="text" name="longitude"><br>
        <label>Location Name:</label>
        <input type="text" name="locationName"><br>
        <label>Day:</label>
        <input type="text" name="day"><br>
        <label>Epoch:</label>
        <input type="text" name="epoch"><br>
        <label>Full Time:</label>
        <input type="text" name="fullTime"><br>
        <label>Hour:</label>
        <input type="text" name="hour"><br>
        <label>Minute:</label>
        <input type="text" name="minute"><br>
        <label>Month:</label>
        <input type="text" name="month"><br>
        <label>Second:</label>
        <input type="text" name="second"><br>
        <label>Year:</label>
        <input type="text" name="year"><br>
        <input type="submit" value="Create">
    </form>

    <br><button onclick="location.href='configurationPanel.php'">Retour</button>

</body>
</html>
