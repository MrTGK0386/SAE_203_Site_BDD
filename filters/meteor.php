<?php

    $reqM = "SELECT GeoLocation FROM sae203_meteor WHERE `GeoLocation` IS NOT NULL AND `year` > ? AND `year` IS NOT NULL AND `mass_(g)` > ? AND `mass_(g)` IS NOT NULL  LIMIT ?";
        if (isset($_POST["totalM"])){
            $charge = $_POST["totalM"];
        }

        if (isset($_POST["mYear"])){
            $yearM = $_POST["mYear"];
        } else{
            $yearM = 860;
        }

        if (isset($_POST["mass"])){
            $massM = $_POST["mass"];
        } else{
            $massM = 0;
        }

        echo "$charge\n";
        echo "$yearM\n";
        echo "$massM\n";

        $stmtM = mysqli_prepare($conn, $reqM);
        mysqli_stmt_bind_param($stmtM, 'idi', $yearM, $massM, $charge);
        mysqli_stmt_execute($stmtM);
        $resultM = mysqli_stmt_get_result($stmtM);

        if (!$resultM) {
            die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
        }

        $cb = 0;
        while ($rowM = mysqli_fetch_assoc($resultM)) {
            $cleanString = str_replace(array('(', ')', ' '), '', $rowM['GeoLocation']);
            
            // Explode the string using the comma as the delimiter
            $values = explode(',', $cleanString);

            // Retrieve the first and second values
            $latitude = $values[0];

            $longitude = $values[1];

            $cb += 1;
            echo"<script>addPoint('$latitude', '$longitude', 4, Cesium.Color.BLACK);</script>";
        }
        echo"$cb"
?>

