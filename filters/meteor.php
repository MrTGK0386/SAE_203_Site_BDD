<?php

    $reqM = "SELECT GeoLocation FROM sae203_meteor WHERE `year` > ? AND `mass_(g)` > ? LIMIT ?";
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
        mysqli_stmt_bind_param($stmtM, 'iid', $charge, $yearM, $massM);
        mysqli_stmt_execute($stmtM);
        $resultM = mysqli_stmt_get_result($stmtM);

        var_dump($resultM); //le résultat est vide

        if (!$resultM) {
            die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
        }

        echo"ALED";
        while ($rowM = mysqli_fetch_assoc($resultM)) {
            echo"ALED MILIEU";
            $cleanString = str_replace(array('(', ')', ' '), '', $rowM['GeoLocation']);
            
            echo"ALED V2";
            // Explode the string using the comma as the delimiter
            $values = explode(',', $cleanString);
            print_r($values);

            // Retrieve the first and second values
            $latitude = $values[0];

            $longitude = $values[1];

            echo"$longitude";
            echo"<script>addPoint('$latitude', '$longitude', 4, Cesium.Color.GOLD);</script>";
        }
?>

