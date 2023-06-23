<?php include "sql_usage/SQLConnection.php" ?>
<div class="blocFiltre">
    <br>
        <form classe="filtrage" method="post">
            <h4>Filtrer les météorites :</h4>

            <label for="year">Ancienneté minimale</label>
            <input id="mYear" type="range" name="mYear" min="860" max="2013">
            <input name="txtYearM" id="txtYearM" placeholder="Choisir une date minimale"></input>
            <br><br><br><br>

            <label for="mass">Masse(g) minimale</label>
            <input id="mass" type="range" name="mass" min="0" max="999.9">
            <input name="txtMass" id="txtMass" placeholder="Choisir une masse minimale"></input>
            <br><br><br><br>

            <label for="nombre">Nombre à afficher</label>
            <select name="totalM">
                <option value="5000">5000</option>
                <option value="10000">10000</option>
                <option value="15000">15000</option>
                <option value="20000">20000</option>
                <option value="25000">25000</option>
                <option value="30000">30000</option>
                <option value="35000">35000</option>
                <option value="40000">40000</option>
                <option value="45716">MAX</option>
            </select>
            <p> Attention, les grandes valeurs demandent un temps de chargement élevé ! <p>
            <br><br><br><br>

            <!-- BOUTON APPLIQUER LE FILTRE -->
            <input type="submit" name="filterMeteor" value="Appliquer le filtre">
        </form>
    <br>
</div>

<script>
var mYearRange = document.getElementById("mYear");
console.log(mYearRange);
var txt_mYearRange = document.getElementById("txtYearM");
console.log(txt_mYearRange);

mYearRange.addEventListener("input", function () {
    var indicatorPosition = mYearRange.value;
    console.log(indicatorPosition);

    // BOUGER LA RANGE = ÉCRIRE DANS LE PLACEHOLDER
    txt_mYearRange.value = indicatorPosition;
});

txt_mYearRange.addEventListener("input", function () {
    var customYear = parseInt(txt_mYearRange.value);

    // METTRE MIN ET MAX    
    if (customYear < -10450) {
        customYear = -10450;
    } else if (customYear > 2023) {
        customYear = 2023;
    }

    // ÉCRIRE DANS LE PLACEHOLDER = BOUGER LA RANGE 
    mYearRange.value = customYear;
});

// PAREIL QUE LES LIGNES DU DESSUS

var massIndicator = document.getElementById("mass");
console.log(massIndicator);
var textMass = document.getElementById("txtMass");
console.log(textMass);

massIndicator.addEventListener("input", function () {
    var indicatorPos = massIndicator.value;
    console.log(indicatorPos);
    textMass.value = indicatorPos;
});

textMass.addEventListener("input", function () {
    var lourd = parseInt(textMass.value);

    // METTRE MIN ET MAX SI L'UTILISATEUR EST BÊTE    
    if (lourd < -10450) {
        lourd = -10450;
    } else if (lourd > 2023) {
        lourd = 2023;
    }

    // ÉCRIRE DANS LE PLACEHOLDER = BOUGER LA RANGE
    elevationIndicator.value = lourd;
});
</script>