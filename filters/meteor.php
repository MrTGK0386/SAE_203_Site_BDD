<?php

// BOUTON APPLICATION DES FILTRES

if (isset($_POST["filter"])) {

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

    $queryBig = "SELECT latitude, longitude FROM SAE203_volcano WHERE last_eruption_year >= ? AND elevation >= ?";

    // VÉRIFIE SI UN PAYS À ÉTÉ SÉLECTIONNÉ POUR L'AJOUTER À LA REQUÊTE
    if (isset($_POST["country"]) && $_POST["country"] !== "Tous" && $_POST["country"] !== "") {
        $pays = $_POST["country"];
        $queryBig .= " AND country = ?";
        $statementBig = mysqli_prepare($conn, $queryBig);
        mysqli_stmt_bind_param($statementBig, 'iis', $lastEruptionYear, $altitude, $pays);
        echo"$queryBig";
    } else {
        $statementBig = mysqli_prepare($conn, $queryBig);
        mysqli_stmt_bind_param($statementBig, 'ii', $lastEruptionYear, $altitude);
    }

    mysqli_stmt_execute($statementBig);
    $resultBig = mysqli_stmt_get_result($statementBig);

    if (!$resultBig) {
        die("Erreur lors de l'exécution de la requête: " . mysqli_error($conn));
    }

    $count = 0;
    $violet = 0;

    // AFFICHAGE DES POINTS
    while ($rowBig = mysqli_fetch_assoc($resultBig)) {

        // CALCUL DE LA DANGEROSITÉ DU VOLCAN AFIN DE CHANGER LA COULEUR DU POINT
        $lati = $rowBig["latitude"];
        $longi = $rowBig["longitude"];
        $danger = "SELECT SUM(population_within_5_km) + SUM(population_within_10_km) AS total_population FROM sae203_volcano WHERE latitude = ? AND longitude = ?";
        $statementDanger = mysqli_prepare($conn, $danger);
        mysqli_stmt_bind_param($statementDanger, 'dd', $lati, $longi);
        mysqli_stmt_execute($statementDanger);
        $resultDanger = mysqli_stmt_get_result($statementDanger);
        $rowDanger = mysqli_fetch_assoc($resultDanger);
        // print_r($rowDanger);

        // VOLCANS DANGEREUX = ROUGE
        if ($rowDanger['total_population'] >= 100000){
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
    var_dump($rowBig);
    var_dump($row2);
    var_dump($oskour);
}
?>

<!-- JAVASCRIPT -->

<!-- PERMET D'AFFICHER EN TEMPS RÉEL LES VALEURS CHOISIES PAR L'UTILISATEUR -->

<script>
    var eruptionYearRange = document.getElementById("EruptionYear");
    console.log(eruptionYearRange);
    var textEruptionYear = document.getElementById("textEruptionYear");
    console.log(textEruptionYear);
    
    eruptionYearRange.addEventListener("input", function () {
        var indicatorPosition = eruptionYearRange.value;
        console.log(indicatorPosition);

        // BOUGER LA RANGE = ÉCRIRE DANS LE PLACEHOLDER
        textEruptionYear.value = indicatorPosition;
    });

    textEruptionYear.addEventListener("input", function () {
        var customYear = parseInt(textEruptionYear.value);

        // METTRE MIN ET MAX    
        if (customYear < -10450) {
            customYear = -10450;
        } else if (customYear > 2023) {
            customYear = 2023;
        }

        // ÉCRIRE DANS LE PLACEHOLDER = BOUGER LA RANGE 
        eruptionYearRange.value = customYear;
    });

    // PAREIL QUE LES LIGNES DU DESSUS

    var elevationIndicator = document.getElementById("elevation");
    console.log(elevationIndicator);
    var textElevation = document.getElementById("textElevation");
    console.log(textElevation);

    elevationIndicator.addEventListener("input", function () {
        var indicatorPos = elevationIndicator.value;
        console.log(indicatorPos);
        textElevation.value = indicatorPos;
    });

    textElevation.addEventListener("input", function () {
        var alti = parseInt(textElevation.value);

        // METTRE MIN ET MAX SI L'UTILISATEUR EST BÊTE    
        if (alti < -10450) {
            alti = -10450;
        } else if (alti > 2023) {
            alti = 2023;
        }

        // ÉCRIRE DANS LE PLACEHOLDER = BOUGER LA RANGE
        elevationIndicator.value = alti;
    });
</script>