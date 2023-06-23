<!DOCTYPE html>
<html>
<head>
  
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<title>Panneau de configuration</title>
  <link rel="stylesheet" href="configurationPanel.css">
</head>
<body>
<?php include_once "../../user_hook/protection.php" ;?>

<div class="container d-flex flex-column align-content-center mb-5">
    <h1 class="text-center my-5">Panneau de configuration</h1>
    <div class="d-flex justify-content-center my-5">
        <div class="button add" onclick="location.href='addEventList.php'">
            <img class="" src="assets/plus.png" width="64" height="64" alt="Button 1 Icon">
            <div class="button-name"><p>Ajouter</p></div>
        </div>

        <div class="button edit" onclick="location.href='editEventList.php'">
            <img class="button-icon" src="assets/editer.png" alt="Button 2 Icon">
            <div class="button-name"><p>Editer</p></div>
        </div>

        <div class="button delete" onclick="location.href='deleteEventList.php'">
            <img class="button-icon" src="assets/supprimer.png" alt="Button 3 Icon">
            <div class="button-name"><p>Supprimer</p></div>
        </div>

        <div class="button edit_user" onclick="location.href='manageUser.php'">
            <img class="button-icon" src="assets/user_gestion.png" alt="Button 4 Icon">
            <div class="button-name"><p>Gerer les utilisateurs</p></div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-dark my-5" onclick="location.href='../../index.php'">Retour</button>
    </div>
</div>

<footer class="pt-5 mt-5">
    <?php include_once'../footer.php'; include_once "../lightSwitch.php"; ?>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../../Scripts/main.js"></script>
</html>
