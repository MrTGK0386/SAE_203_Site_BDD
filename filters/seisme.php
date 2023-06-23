<?php
$requete = "SELECT location_latitude, location_longitude FROM sae203_eq";
    $resultat = mysqli_query($conn, $requete);
    if (!$resultat) {
        die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_assoc($resultat)) {
        echo"<script>addPoint($row[location_latitude], $row[location_longitude], 10, Cesium.Color.BROWN);</script>";
    }


?>