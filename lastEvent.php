<!DOCTYPE html>
<html>

<head>
    <title>Derniers événements en date</title>
    <script src="https://cesium.com/downloads/cesiumjs/releases/1.84/Build/Cesium/Cesium.js"></script>
    <script>
        Cesium.Ion.defaultAccessToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiI3NmJlOTBmZS0zMDQ4LTQyNmUtYTViOS04OTEyZDdmZThmMDciLCJpZCI6MTQ4MDA3LCJpYXQiOjE2ODcyNDI5ODR9.5BzgewFG_qqt70bHlei4_AtSAPYm7LZ0Gr32eo_tS3I';
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cesium.com/downloads/cesiumjs/releases/1.106/Build/Cesium/Widgets/widgets.css" rel="stylesheet">

    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="lastEvent.css">
</head>

<body>

    <?php
    session_start();
    include_once 'sql_usage/createTables.php';

    include_once 'sql_usage/SQLConnection.php';
    include_once 'lastEventFunctions.php';

    $events_eq = getEq($conn);
    $events_meteor = getMeteor($conn);
    $events_volcano = getVolcano($conn);

    include_once 'user_hook/header.php'; ?>

    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <div class="d-flex flex-nowrap justify-content-between">
                <?php foreach ($events_eq as $index => $event) : ?>
                    <div class="">
                        <div class="">
                            <div class="">
                                <div class="card" style="width: 18rem;">
                                    <div>
                                        <div id="map-<?php echo $index; ?>"></div>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Tremblement de Terre en <?php echo $event['location.name']; ?>.</h5>
                                        <p class="card-text">Ce tremblement de terre a eu lieu en : <?php echo $event['time.full']; ?></p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Magnitude : <?php echo $event['impact_magnitude']; ?></li>
                                        <li class="list-group-item">Profondeur : <?php echo $event['location.depth']; ?></li>
                                        <li class="list-group-item">Localisation précise :<br><?php echo $event['location.full']; ?></li>
                                        <li class="list-group-item">Latitude : <?php echo $event['location_latitude']; ?></li>
                                        <li class="list-group-item">Longitude : <?php echo $event['location_longitude']; ?></li>

                                    </ul>
                                    <div class="card-body">
                                        <a href="https://www.openstreetmap.org/#map=13/<?php echo $event['location_latitude']; ?>/<?php echo $event['location_longitude']; ?>" target="_blank" class="card-link">Ouvrir dans open street map</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            var map<?php echo $index; ?> = new Cesium.Viewer('map-<?php echo $index; ?>', {
                                shouldAnimate: true,
                                animation: false,
                                timeline: false,
                                baseLayerPicker: false,
                                imageryProvider: new Cesium.ArcGisMapServerImageryProvider({
                                    url: 'https://services.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer',
                                }),
                            });

                            addPoint<?php echo $index; ?>(<?php echo $event['location_latitude']; ?>, <?php echo $event['location_longitude']; ?>, 10, Cesium.Color.RED);

                            function addPoint<?php echo $index; ?>(latitude, longitude, size, color) {
                                var viewer = map<?php echo $index; ?>;
                                var entity = viewer.entities.add({
                                    position: Cesium.Cartesian3.fromDegrees(longitude, latitude),
                                    point: {
                                        pixelSize: size,
                                        color: color
                                    }
                                });

                                // Fly to the entity's position
                                viewer.camera.flyTo({
                                    destination: Cesium.Cartesian3.fromDegrees(longitude, latitude, 100000), // Adjust the third parameter (height) to change the zoom level
                                    duration: 8 // Animation duration in seconds
                                });
                            }
                        </script>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <div class="container d-flex justify-content-between align-items-center">
        <?php foreach ($events_meteor as $index => $event) : ?>
            <div class="">
                <div class="">
                    <div class="">
                        <div class="card" style="width: 18rem;">
                            <div>
                                <div id="map-meteor-<?php echo $index; ?>" class="cesium-container"></div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Météorite nommée : <br><?php echo $event['name']; ?>.</h5>
                                <p class="card-text">Cette météorite est tombée en : <?php echo $event['year']; ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Masse : <?php echo $event['mass_(g)']; ?></li>
                                <li class="list-group-item">Latitude : <?php
                                                                        $geolocation = $event['GeoLocation'];

                                                                        $cleanString = str_replace(array('(', ')', ' '), '', $geolocation);

                                                                        // Explode the string using the comma as the delimiter
                                                                        $values = explode(',', $cleanString);

                                                                        // Retrieve the first and second values
                                                                        $geofirstValue = $values[0];
                                                                        echo $geofirstValue ?>
                                </li>
                                <li class="list-group-item">Longitude : <?php $geolocation = $event['GeoLocation'];

                                                                        $cleanString = str_replace(array('(', ')', ' '), '', $geolocation);

                                                                        // Explode the string using the comma as the delimiter
                                                                        $values = explode(',', $cleanString);

                                                                        // Retrieve the first and second values
                                                                        $geosecondValue = $values[1];
                                                                        echo $geosecondValue ?>
                                </li>

                            </ul>
                            <div class="card-body">
                                <a href="https://www.openstreetmap.org/#map=13/<?php echo $geofirstValue; ?>/<?php echo $geosecondValue; ?>" target="_blank" class="card-link">Ouvrir dans open street map</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var meteorMap<?php echo $index; ?> = new Cesium.Viewer('map-meteor-<?php echo $index; ?>', {
                    shouldAnimate: true,
                    animation: false,
                    timeline: false,
                    baseLayerPicker: false,
                    imageryProvider: new Cesium.ArcGisMapServerImageryProvider({
                        url: 'https://services.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer',
                    }),
                });

                addMeteorPoint<?php echo $index; ?>(<?php echo $geofirstValue; ?>, <?php echo $geosecondValue; ?>, 10, Cesium.Color.BLUE);

                function addMeteorPoint<?php echo $index; ?>(latitude, longitude, size, color) {
                    var viewer = meteorMap<?php echo $index; ?>;
                    var entity = viewer.entities.add({
                        position: Cesium.Cartesian3.fromDegrees(longitude, latitude),
                        point: {
                            pixelSize: size,
                            color: color
                        }
                    });

                    // Fly to the entity's position
                    viewer.camera.flyTo({
                        destination: Cesium.Cartesian3.fromDegrees(longitude, latitude, 100000), // Adjust the third parameter (height) to change the zoom level
                        duration: 8 // Animation duration in seconds
                    });
                }
            </script>
        <?php endforeach; ?>
    </div>





    <div class="container d-flex justify-content-between align-items-center">
        <?php foreach ($events_volcano as $index => $event) : ?>
            <div class="">
                <div class="">
                    <div class="">
                        <div class="card" style="width: 18rem;">
                            <div>
                                <div id="map-volcano-<?php echo $index; ?>" class="cesium-container"></div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Volcan nommée : <br><?php echo $event['volcano_name']; ?>.</h5>
                                <p class="card-text">La dernière éruption de ce volcan remonte en : <?php echo $event['last_eruption_year']; ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Pays : <?php echo $event['country']; ?></li>
                                <li class="list-group-item">Latitude : <?php echo $event['latitude']; ?></li>
                                <li class="list-group-item">Longitude : <?php echo $event['longitude']; ?></li>

                            </ul>
                            <div class="card-body">
                                <a href="https://www.openstreetmap.org/#map=13/<?php echo $event['latitude']; ?>/<?php echo $event['longitude']; ?>" target="_blank" class="card-link">Ouvrir dans open street map</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <script>
        var volcanoMap<?php echo $index; ?> = new Cesium.Viewer('map-volcano-<?php echo $index; ?>', {
            shouldAnimate: true,
            animation: false,
            timeline: false,
            baseLayerPicker: false,
            imageryProvider: new Cesium.ArcGisMapServerImageryProvider({
                url: 'https://services.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer',
            }),
        });

        addVolcanoPoint<?php echo $index; ?>(<?php echo $event['latitude']; ?>, <?php echo $event['longitude']; ?>, 10, Cesium.Color.ORANGE);

        function addVolcanoPoint<?php echo $index; ?>(latitude, longitude, size, color) {
            var viewer = volcanoMap<?php echo $index; ?>;

            var entity = viewer.entities.add({
                position: Cesium.Cartesian3.fromDegrees(longitude, latitude),
                point: {
                    pixelSize: size,
                    color: color
                }
            });

            viewer.camera.flyTo({
                destination: Cesium.Cartesian3.fromDegrees(longitude, latitude, 100000), // Adjust the third parameter (height) to change the zoom level
                duration: 8 // Animation duration in seconds
            });
        }
    </script>
<?php endforeach; ?>
</div>













<button class="btn btn-dark" onclick="location.href='index.php'">Retour</button>
</div>
<?php include_once 'HTML_elements/footer.php';
include_once "HTML_elements/ligthSwitch.php"; ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="Scripts/main.js"></script>

</html>