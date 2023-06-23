<?php
// BOUTON APPLICATION DES FILTRES


    // TEST DES FILTRES QUI VONT ÊTRE APPLIQUÉS, SI PAS CHOISI ALORS VALEUR PAR DÉFAUT

    // DERNIERE ERUPTION EN DATE
    if (isset($_POST["EruptionYear"])) {
        $lastEruptionYear = $_POST["EruptionYear"];
    } else{
        $lastEruptionYear = -10500;
    }

    // ALTITUDE MINIMALE
    if (isset($_POST["elevation"])) {
        $altitude = $_POST["elevation"];
    } else{
        $altitude = 0;
    }

    // AFFICHAGE DES VOLCANS SOUS-MARINS 
    if (isset($_POST["underwater"])) {
        $udw = 0;
        $query2 = "SELECT latitude, longitude FROM SAE203_volcano WHERE elevation < ? AND last_eruption_year>= ?";
        $statement2 = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($statement2, 'ii', $udw, $lastEruptionYear);
        mysqli_stmt_execute($statement2);
        $result2 = mysqli_stmt_get_result($statement2);
        
        if (!$result2) {
            die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
        }

        $aled = 0;
        while ($row2 = mysqli_fetch_assoc($result2)) {
            echo "<script>addPoint($row2[latitude], $row2[longitude], 10, Cesium.Color.BLUE);</script>";
            //$aled += 1;
        }
        //echo "udw $aled";
    }

    // REQUÊTE POUR L'APPLICATION DES FILTRES

    $queryBig = "SELECT latitude, longitude, population_within_5_km + population_within_10_km AS total_population  FROM SAE203_volcano WHERE last_eruption_year >= ? AND elevation >= ?";

    // VÉRIFIE SI UN PAYS À ÉTÉ SÉLECTIONNÉ POUR L'AJOUTER À LA REQUÊTE
    if (isset($_POST["volcanCountries"]) && $_POST["volcanCountries"] !== "Tous" && $_POST["volcanCountries"] !== "") {
        $pays = $_POST["volcanCountries"];
        //echo"$pays";
        $queryBig .= " AND country = ?";
        $statementBig = mysqli_prepare($conn, $queryBig);
        mysqli_stmt_bind_param($statementBig, 'iis', $lastEruptionYear, $altitude, $pays);
        //echo"$queryBig";
    } else {
        $statementBig = mysqli_prepare($conn, $queryBig);
        mysqli_stmt_bind_param($statementBig, 'ii', $lastEruptionYear, $altitude);
    }

    mysqli_stmt_execute($statementBig);
    $resultBig = mysqli_stmt_get_result($statementBig);

    if (!$resultBig) {
        die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
    }

    //$count = 0;
    //$violet = 0;

    // AFFICHAGE DES POINTS
    while ($rowBig = mysqli_fetch_assoc($resultBig)) {
        // CALCUL DE LA DANGEROSITÉ DU VOLCAN AFIN DE CHANGER LA COULEUR DU POIN

        // VOLCANS DANGEREUX = ROUGE
        if ($rowBig['total_population'] >= 100000){
            $oskour = "RED";
            echo "<script>addPoint($rowBig[latitude], $rowBig[longitude], 10, Cesium.Color.$oskour);</script>";
            //$violet += 1;

        // VOLCANS PAS DANGEREUX = ORANGE
        } else {
            echo "<script>addPoint($rowBig[latitude], $rowBig[longitude], 10, Cesium.Color.ORANGE);</script>";
        }
        //$count += 1;
    }
    // echo "Volcans = $count";
    // echo "Volcans dangereux = $violet";
    // var_dump($rowBig);
    // var_dump($row2);
    // var_dump($oskour);

?>