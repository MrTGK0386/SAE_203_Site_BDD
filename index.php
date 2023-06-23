<!-- index.php -->
<!DOCTYPE html>
<html data-bs-theme="auto" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocket Planet - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link href="https://cesium.com/downloads/cesiumjs/releases/1.106/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
    <?php
    session_start();
    include_once 'sql_usage/createTables.php';
    ?>
    <!-- création des tables si elle n'existe pas et gestion de la $conn -->
</head>

<body class="d-flex flex-column min-vh-100">

<div id="header">
    <?php  include "user_hook/header.php"; ?>
    <!-- inclusion du header -->
</div>
<div id="mainContainerFront" class="d-flex">

    <div id="cesiumContainer" class="w-75">
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
        <?php
        include_once 'sql_usage/SQLconnection.php';
        ?>
    </div>
    <div id="filterContainer" class="p-5" <?php if (!isset($_SESSION['admin'])) { echo ' style="display: none; !important"'; } ?>>
        <div class="d-flex justify-content-between">
            <button class="btn btn-info" id="bt_volcan" >Filtrer les Volcans</button>
            <button class="btn btn-info" id="bt_seisme" >Filtrer les Seisme</button>
            <button class="btn btn-info" id="bt_meteor" >Filtrer les Météorites</button>
        </div>
        <div id="filter_Div">

        </div>

    <?php

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
    </div>
</div>


<!-- inclusion du bas de page du site -->
<?php include_once'HTML_elements/footer.php'; include_once "HTML_elements/lightSwitch.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>viewer.zoomTo(viewer.entities);</script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="Scripts/main.js"></script>
</body>
</html>

