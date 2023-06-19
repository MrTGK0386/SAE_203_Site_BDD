<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page d'accueil</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <?php
    include_once 'sql_usage/SQLconnection.php';
    include_once 'sql_usage/createUserTable.php';
    include_once 'sql_usage/createEarthQuakeTable.php';
    ?>
</head>
<body class="d-flex flex-column min-vh-100">

<div id="header" class="container dynamic">
    <?php include_once('header.php'); ?>
    <!-- inclusion des variables et fonctions -->
</div>
<div>
    <form action="index.php" method="post">
        Nom de la table : <input type="text" name="nomTable">
        <input type="submit" name="afficher">
    </form>
    <?php
    $nomTable=$_POST['nomTable'];
    function nbEnregistrement ($nomTable){

        $requete = "SELECT * FROM $nomTable";
        $statement = mysqli_prepare($conn, $requete) or die (mysqli_error($conn));
        mysqli_stmt_execute($statement) or die (mysqli_error($conn));

        $resultat = mysqli_stmt_get_result($statement);
        while ($row = mysqli_fetch_array($resultat, MYSQLI_ASSOC)){
            echo ($row);
        }

        mysqli_close($conn) or die(mysqli_error($conn));

    }


    ?>
</div>


<!-- inclusion du bas de page du site -->
<?php //include_once('footer.php'); ?>
</body>
</html>

