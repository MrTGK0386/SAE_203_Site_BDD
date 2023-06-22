<!DOCTYPE html>
<html>
<head>
    <title>Edit Event Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php
    include_once 'sql_usage/SQLConnection.php';

    function getEvents($conn) {
        $tableName = "sae203_eq";
        $query = "SELECT * FROM $tableName ORDER BY `time.full` DESC LIMIT 5";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error executing query: " . mysqli_error($conn));
        }

        $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);

        return $events;
    }

    // Display the earthquake table
    $events = getEvents($conn);
    foreach ($events as $event):
    ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Event</h5>
                <p class="card-text">
                    <?php echo $event['impact_magnitude']; ?><br>
                    <?php echo $event['location.depth']; ?><br>
                    <?php echo $event['location.full']; ?><br>
                    <?php echo $event['location_latitude']; ?><br>
                    <?php echo $event['location_longitude']; ?><br>
                    <?php echo $event['location.name']; ?><br>
                    <?php echo $event['time.full']; ?><br>
                </p>
                <a href="https://www.openstreetmap.org/?mlat=<?php echo $event['location_latitude']; ?>&mlon=<?php echo $event['location_longitude']; ?>&zoom=13#map=13/<?php echo $event['location_latitude']; ?>/<?php echo $event['location_longitude']; ?>" class="btn btn-primary">View Location</a>
            </div>
        </div>
        <br>
    <?php endforeach; ?>

    <h2>Create New Event</h2>

    <br><button onclick="location.href='../event_adders/AddEq.php'">Ajouter un tremblement de Terre.</button>
    <br><button onclick="location.href='../editEventList.php'">Retour</button>

</body>
</html>
