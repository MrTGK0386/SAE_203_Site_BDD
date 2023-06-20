<!DOCTYPE html>
<html>
<head>
    <title>Cesium Map</title>
</head>
<body>
    <div id="cesiumContainer"></div>
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
        function addPoint(latitude, longitude, type, size) {
            
            viewer.entities.add({
            position: Cesium.Cartesian3.fromDegrees(longitude, latitude),
                billboard: {
                    image: type,
                    scale: size,
                    // color: Cesium.Color.RED
                }
            });

        }


        </script>
        <?php
            include_once 'sql_usage/SQLconnection.php';
            $requete = "SELECT * FROM eq";
            $resultat = mysqli_query($conn, $requete);
            if (!$resultat) {
                die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_assoc($resultat)) {
                if ($row['impact_magnitude'] >1){
                echo"<script>addPoint($row[location_latitude], $row[location_longitude], 'assets/ico.png', 0.05);</script>";
                }

            else{
                echo"<script>addPoint($row[location_latitude], $row[location_longitude], 'assets/ico2.png', 0.02);</script>";

                }
            }

        ?>
    <script>
        viewer.zoomTo(viewer.entities);
    </script>
    <div>
		<form action="loginPassOk.php" method="post">
			Votre login : <input type="text" name="login">
		<br />
		Votre mot de passe : <input type="password" name="pwd"><br />
			<input type="submit" value="Connexion">
		</form>
        <?php
        if (isset($_GET['msg']))
            {echo "erreur ";echo $_GET['msg']."<br/>";}
        ?>
    </div>
</body>
</html>

<style>
        #cesiumContainer {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #cesiumContainer canvas{
            height: 600px;
        }
        #cesiumContainer .cesium-viewer-selectionIndicatorContainer{
            display: none;
        }
        #cesiumContainer .cesium-viewer-bottom{
            display: none;
        }
        #cesiumContainer .cesium-viewer-infoBoxContainer{
            display: none;
        }
        #cesiumContainer .cesium-viewer-toolbar{
            display: none;
        }
        #cesiumContainer .cesium-button{
            display: none;
        }

</style>