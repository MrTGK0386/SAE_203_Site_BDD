<?php include "sql_usage/SQLConnection.php" ?>
<div class="blocFiltre">
    <br>
        <form classe="filtrage" method="post">
            <h4>Filtrer les volcans :</h4>

            <!-- RANGE FOR ERUPTION YEAR --->
            <label for="EruptionYear">Date de la dernière éruption</label>
            <input id="EruptionYear" type="range" name="EruptionYear" min="-10450" max="2023" <?php if (isset($_POST["EruptionYear"])) echo("value=".$_POST["EruptionYear"])?>>
            <input name="textEruptionYear" id="textEruptionYear" placeholder="Choisir une année"></input>

            <!-- TEXT FOR COUNTRY --->
            <label for="underwater">Voir les volcans sous-marins</label>
            <input id="Pays" type="checkbox" name="underwater">
            <br><br><br><br>

            <!-- RANGE FOR ALTITUDE ----->
            <label for="Elevation">Altitude minimale:</label>
            <input id="elevation" type="range" name="elevation" min="0" max="6879">
            <input name="textElevation" id="textElevation" placeholder="Choisir une altitude minimale"></input>
            <br><br><br><br>

            <!-- DROPDOWN FOR COUNTRIES -->
            <label for="countries">Cibler un pays:</label>  
            <select name="volcanCountries">
            <option value="">Tous</option>
            <?php
                // Code de la requête pour récupérer les pays distincts de votre table
                $volcanPays = "SELECT DISTINCT country FROM sae203_volcano";
                echo"$volcanPays";
                $statementVolcanPays = mysqli_prepare($conn, $volcanPays);
                mysqli_stmt_execute($statementVolcanPays);
                $resultVolcanPays = mysqli_stmt_get_result($statementVolcanPays);

                while ($rowVolcanPays = mysqli_fetch_assoc($resultVolcanPays)) {
                    $volcanPaysList = $rowVolcanPays['country'];
                    echo "<option value='$volcanPaysList'>$volcanPaysList</option>";
                }
            ?>
            </select>
            <br><br><br><br>
            <!-- BOUTON APPLIQUER LE FILTRE -->
            <input type="submit" name="filterVolcan" value="Appliquer le filtre">
        </form>
    <br>
</div>

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