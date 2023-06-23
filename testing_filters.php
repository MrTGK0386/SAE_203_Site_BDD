<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <?php
    include_once 'sql_usage/SQLConnection.php';
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La page de fou - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="HTML_elements/headers/style/style.css" rel="stylesheet">
    <link href="https://cesium.com/downloads/cesiumjs/releases/1.106/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">


<!-- LA MAP -->
<div id="cesiumContainer">
    <script src="https://cesium.com/downloads/cesiumjs/releases/1.84/Build/Cesium/Cesium.js"></script>
    <script>
        // Set your Cesium ion access token here
        Cesium.Ion.defaultAccessToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiI1ZGRlNTNhOC0wODJlLTRkMzktOTI4ZS00ODE1ZDAyZmIyOGIiLCJpZCI6MTQ4NzAxLCJpYXQiOjE2ODc1MjY1ODF9.irFmISao67gQD0eI2bjVyyvaZkpOCdcmHbuWft6v1QY';

        // Create a Cesium viewer
        var viewer = new Cesium.Viewer('cesiumContainer', {
            shouldAnimate: true,
            animation: false,
            timeline: false,
        });

        // Function to add a point at a given latitude and longitude
        function addPoint(latitude, longitude, size, color) {
            
            viewer.entities.add({
                position: Cesium.Cartesian3.fromDegrees(longitude, latitude),
                point: {
                    pixelSize: size, // Adjust the point size as desired
                    color: color // Set the desired point color
                }
            });

        }


    </script>
</div>


<?php
    include 'formVolcan.php';

    include 'formSeisme.php';

    include 'formMeteor.php';

    if (isset($_POST["filterVolcan"])) {
        include 'filters/volcan.php';
    }

    if (isset($_POST["filterSeisme"])) {
        include 'filters/seisme.php';
    }

    if (isset($_POST["filterMeteor"])) {
        include 'filters/meteor.php';
    }
    
?>


<!-- inclusion du bas de page du site -->
<?php //include_once('footer.php'); ?>

<script>viewer.zoomTo(viewer.entities);</script>
<script src="Scripts/main.js"></script>

</body>
</html>