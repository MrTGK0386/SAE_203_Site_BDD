<!DOCTYPE html>
<html>
<head>
    <title>Edit Event Page</title>
    <script src="https://cesium.com/downloads/cesiumjs/releases/1.84/Build/Cesium/Cesium.js"></script>
    <script>
        // Set your Cesium ion access token here
        Cesium.Ion.defaultAccessToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiI3NmJlOTBmZS0zMDQ4LTQyNmUtYTViOS04OTEyZDdmZThmMDciLCJpZCI6MTQ4MDA3LCJpYXQiOjE2ODcyNDI5ODR9.5BzgewFG_qqt70bHlei4_AtSAPYm7LZ0Gr32eo_tS3I';
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cesium.com/downloads/cesiumjs/releases/1.106/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
    
<link rel="stylesheet" href="lastEvent.css">
</head>

<style>
    .cesium-button{
    display: none;
}
</style>
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
    ?>
    <div class="row">
        <?php foreach ($events as $index => $event): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tremblement de Terre</h5>
                        <dl>
                            <dt>Magnitude:</dt>
                            <dd><?php echo $event['impact_magnitude']; ?></dd>

                            <dt>Depth:</dt>
                            <dd><?php echo $event['location.depth']; ?></dd>

                            <dt>Location:</dt>
                            <dd><?php echo $event['location.full']; ?></dd>

                            <dt>Latitude:</dt>
                            <dd><?php echo $event['location_latitude']; ?></dd>

                            <dt>Longitude:</dt>
                            <dd><?php echo $event['location_longitude']; ?></dd>

                            <dt>Location Name:</dt>
                            <dd><?php echo $event['location.name']; ?></dd>

                            <dt>Time:</dt>
                            <dd><?php echo $event['time.full']; ?></dd>
                        </dl>
                        <div style="display: flex; justify-content: center;">
                        <div id="map-<?php echo $index; ?>" class="cesium-container"></div>
                        </div>
                    </div>
                </div>


                <script>
                    var map<?php echo $index; ?> = new Cesium.Viewer('map-<?php echo $index; ?>', {
                        shouldAnimate: true,
                        animation: false,
                        timeline: false,
                    });

                    addPoint<?php echo $index; ?>(<?php echo $event['location_latitude']; ?>, <?php echo $event['location_longitude']; ?>, 10, Cesium.Color.RED);

                    function addPoint<?php echo $index; ?>(latitude, longitude, size, color) {
                        map<?php echo $index; ?>.entities.add({
                            position: Cesium.Cartesian3.fromDegrees(longitude, latitude),
                            point: {
                                pixelSize: size,
                                color: color
                            }
                        });
                    }
                </script>
            </div>
        <?php endforeach; ?>
    </div>

    <br>
    <button class="btn btn-dark" onclick="location.href='../editEventList.php'">Retour</button>

</body>
</html>


