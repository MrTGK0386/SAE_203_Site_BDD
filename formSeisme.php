<div class="blocFiltre">
    <br>
        <form classe="filtrage" method="post">
            <h4>Filtrer les séismes :</h4>

            <!-- DROPDOWN FOR MAGNITUDE -->
            <label for="magnitude">Magnitude minimale :</label>
            <select name="magnitude">
                <option value="">Tous</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <!-- BOUTON APPLIQUER LE FILTRE -->
            <input type="submit" name="filterSeisme" value="Appliquer le filtre">
        </form>
    <br>
</div>