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
    .cesium-button {
        display: none;
    }
</style>

<body>
    <?php
    include_once 'sql_usage/SQLConnection.php';
    include_once 'lastEventFunctions.php';

    $events_eq = getEq($conn);
    $events_meteor = getMeteor($conn);
    $events_volcano = getVolcano($conn);


    ?>
    <div class="row">
        <?php foreach ($events_eq as $index => $event): ?>
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
        <div class="row">
        <?php foreach ($events_meteor as $index => $event): ?>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Meteor Event</h5>
                        <dl>
                            <dt>Name:</dt>
                            <dd><?php echo $event['name']; ?></dd>

                            <dt>Mass</dt>
                            <dd><?php echo $event['mass_(g)']; ?></dd>

                            <dt>Location:</dt>
                            <dd><?php 
                            echo $event['GeoLocation']; 
                            ?></dd>

                            <dt>Latitude:</dt>
                            <dd><?php
                                $geolocation = $event['GeoLocation'];

                                $cleanString = str_replace(array('(', ')', ' '), '', $geolocation);
                            
                                // Explode the string using the comma as the delimiter
                                $values = explode(',', $cleanString);
                            
                                // Retrieve the first and second values
                                $geofirstValue = $values[0];
                                echo $geofirstValue ?></dd>

                            <dt>Longitude:</dt>
                            <dd><?php $geolocation = $event['GeoLocation'];

                                $cleanString = str_replace(array('(', ')', ' '), '', $geolocation);
                            
                                // Explode the string using the comma as the delimiter
                                $values = explode(',', $cleanString);
                            
                                // Retrieve the first and second values
                                $geosecondValue = $values[1];
                                echo $geosecondValue ?></dd>

                            <dt>Year:</dt>
                            <dd><?php echo $event['year']; ?></dd>
                        </dl>
                        <div style="display: flex; justify-content: center;">
                            <div id="map-meteor-<?php echo $index; ?>" class="cesium-container"></div>
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
            </div>
        <?php endforeach; ?>
        <div class="row">

        <?php foreach ($events_volcano as $index => $event): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Volcano Event</h5>
                        <dl>
                            <dt>Name:</dt>
                            <dd><?php echo $event['volcano_name']; ?></dd>

                            <dt>Location:</dt>
                            <dd><?php echo $event['country']; ?></dd>

                            <dt>Latitude:</dt>
                            <dd><?php echo $event['latitude']; ?></dd>

                            <dt>Longitude:</dt>
                            <dd><?php echo $event['longitude']; ?></dd>

                            <dt>Year:</dt>
                            <dd><?php echo $event['last_eruption_year']; ?></dd>
                        </dl>
                        <div style="display: flex; justify-content: center;">
                            <div id="map-volcano-<?php echo $index; ?>" class="cesium-container"></div>
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
            </div>
        <?php endforeach; ?>
    </div>

    <br>
    <button class="btn btn-dark" onclick="location.href='index.php'">Retour</button>

</body>
</html>
