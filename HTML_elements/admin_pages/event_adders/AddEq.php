<!DOCTYPE html>
<html>
<head>
    <title>Edit Event Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php
    include_once '../../../sql_usage/SQLConnection.php';
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'create') {
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


    <h2>Create New Event</h2>


    <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="action" value="create">
    <div class="form-group">
        <label>Gap:</label>
        <input class="form-control form-control-sm" type="text" name="gap">
    </div>
    <div class="form-group">
        <label>Magnitude:</label>
        <input class="form-control form-control-sm" type="text" name="magnitude">
    </div>
    <div class="form-group">
        <label>Significance:</label>
        <input class="form-control form-control-sm" type="text" name="significance">
    </div>
    <div class="form-group">
        <label>Depth:</label>
        <input class="form-control form-control-sm" type="text" name="depth">
    </div>
    <div class="form-group">
        <label>Distance:</label>
        <input class="form-control form-control-sm" type="text" name="distance">
    </div>
    <div class="form-group">
        <label>Full Location:</label>
        <input class="form-control form-control-sm" type="text" name="fullLocation">
    </div>
    <div class="form-group">
        <label>Latitude:</label>
        <input class="form-control form-control-sm" type="text" name="latitude">
    </div>
    <div class="form-group">
        <label>Longitude:</label>
        <input class="form-control form-control-sm" type="text" name="longitude">
    </div>
    <div class="form-group">
        <label>Location Name:</label>
        <input class="form-control form-control-sm" type="text" name="locationName">
    </div>
    <div class="form-group">
        <label>Day:</label>
        <input class="form-control form-control-sm" type="text" name="day">
    </div>
    <div class="form-group">
        <label>Epoch:</label>
        <input class="form-control form-control-sm" type="text" name="epoch">
    </div>
    <div class="form-group">
        <label>Full Time:</label>
        <input class="form-control form-control-sm" type="text" name="fullTime">
    </div>
    <div class="form-group">
        <label>Hour:</label>
        <input class="form-control form-control-sm" type="text" name="hour">
    </div>
    <div class="form-group">
        <label>Minute:</label>
        <input class="form-control form-control-sm" type="text" name="minute">
    </div>
    <div class="form-group">
        <label>Month:</label>
        <input class="form-control form-control-sm" type="text" name="month">
    </div>
    <div class="form-group">
        <label>Second:</label>
        <input class="form-control form-control-sm" type="text" name="second">
    </div>
    <div class="form-group">
        <label>Year:</label>
        <input class="form-control form-control-sm" type="text" name="year">
    </div>
    <input class="btn btn-primary" type="submit" value="Create">
</form>


    <br><button onclick="location.href='../addEventList.php'">Ajouter d'autres événements.</button>

</body>
</html>



