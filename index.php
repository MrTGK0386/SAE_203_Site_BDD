<!-- index.php -->
<!DOCTYPE html>
<html data-bs-theme="dark" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La page de fou - Page d'accueil</title>
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

<div id="cesiumContainer">
    <script src="https://cesium.com/downloads/cesiumjs/releases/1.84/Build/Cesium/Cesium.js"></script>
    <script>
        // Set your Cesium ion access token here
        Cesium.Ion.defaultAccessToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiI3NmJlOTBmZS0zMDQ4LTQyNmUtYTViOS04OTEyZDdmZThmMDciLCJpZCI6MTQ4MDA3LCJpYXQiOjE2ODcyNDI5ODR9.5BzgewFG_qqt70bHlei4_AtSAPYm7LZ0Gr32eo_tS3I';

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
    $requete = "SELECT * FROM sae203_eq";
    $resultat = mysqli_query($conn, $requete);
    if (!$resultat) {
        die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_assoc($resultat)) {
        if ($row['impact_magnitude'] >1){
            echo"<script>addPoint($row[location_latitude], $row[location_longitude],  10, Cesium.Color.RED);</script>";
        }

        else{
            echo"<script>addPoint($row[location_latitude], $row[location_longitude],  15, Cesium.Color.GREEN);</script>";

        }
    }
    ?>
</div>

<div>
    <div>
        <form action="index.php" method="post">
            Nom de la table : <input type="text" name="nomTable">
            <input type="submit" name="afficher">
        </form><br>
    </div>

    <?php
    function nbEnregistrement($nomTable, $conn) {
        $requete = "SELECT * FROM SAE203_$nomTable";
        $resultat = mysqli_query($conn, $requete);
        if (!$resultat) {
            die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($resultat)) {
            print_r($row);
        }

        mysqli_free_result($resultat);
        mysqli_close($conn);
    }

    // Vérifier si le formulaire a été soumis
    if (isset($_POST["nomTable"])) {
        $nomTable = $_POST["nomTable"];
        nbEnregistrement($nomTable, $conn);
    }
    ?>

</div>

<!-- inclusion du bas de page du site -->
<?php include_once'HTML_elements/footer.php'; include_once "HTML_elements/lightSwitch.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>viewer.zoomTo(viewer.entities);</script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="Scripts/main.js"></script>
</body>
</html>
