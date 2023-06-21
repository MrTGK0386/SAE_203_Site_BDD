<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La page de fou - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="HTML_elements/headers/style/style.css"
          rel="stylesheet">
    <link href="https://cesium.com/downloads/cesiumjs/releases/1.106/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
    <?php
    include_once 'sql_usage/createTables.php'
    ?>
</head>
<body class="d-flex flex-column min-vh-100">

<div id="header" class="container dynamic">
    <?php  //include_once('HTML_elements/headers/headerRandom.html'); ?>
    <!-- inclusion des variables et fonctions -->
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
        <p type="button" name="trigger" value="DROP TABLE"/>
    </div>
    <div>
        <form action="index.php" method="post">
            Nom de la table : <input type="text" name="nomTable">
            <input type="submit" name="afficher">
        </form>
        <br><button onclick="location.href='user_hook/connection.php'">Login</button>
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
<?php //include_once('footer.php'); ?>

<script>viewer.zoomTo(viewer.entities);</script>
<script src="Scripts/main.js"></script>
</body>
</html>
