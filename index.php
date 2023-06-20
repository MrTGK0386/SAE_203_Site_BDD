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
    <?php
    include_once 'sql_usage/SQLconnection.php';
    include_once 'sql_usage/createUserTable.php';
    include_once 'sql_usage/createEarthQuakeTable.php';
    include_once  'sql_usage/createMeteorite.php';
    ?>
</head>
<body class="d-flex flex-column min-vh-100">

<div id="header" class="container dynamic">
    <?php  include_once('HTML_elements/headers/headerRandom.html'); ?>
    <!-- inclusion des variables et fonctions -->
</div>
<div>
    <div>
        <form action="index.php" method="post">
            Nom de la table : <input type="text" name="nomTable">
            <input type="submit" name="afficher">
        </form>
        <br><button onclick="location.href='user_hook/connection.php'">Login</button>
    </div>
    <?php
    function nbEnregistrement($nomTable, $conn) {
        $requete = "SELECT * FROM $nomTable";
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
</body>
</html>

