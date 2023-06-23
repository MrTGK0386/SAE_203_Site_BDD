<?php
    session_start();

    include_once '../../sql_usage/SQLConnection.php';
    include_once '../../user_hook/protection.php';
?>





<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <title>Gestion des événements</title>
  <link rel="stylesheet" href="configurationPanel.css">
</head>
<body>



<div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <h1 class="text-center">Gestion des événements</h1>
      </div>
    </div>
  </div>
  <div class="button-container" >
    <div class="button eq" onclick="location.href='EarthQuake.php'">
      <img class="button-icon" src="assets/eq.png" alt="Button 1 Icon">
      <div class="button-name"><p>Tremblements de Terre</p></div>
    </div>

    <div class="button volcano" onclick="alert('Cette partie du site est en construction.\nVeuillez nous excuser pour la gêne occasionnée.')">
      <img class="button-icon" src="assets/volcan.png" alt="Button 1 Icon">
      <div class="button-name"><p>Volcans</p></div>
    </div>

    <div class="button meteor" onclick="alert('Cette partie du site est en construction.\nVeuillez nous excuser pour la gêne occasionnée.')">
      <img class="button-icon" src="assets/meteorite.png" alt="Button 1 Icon">
      <div class="button-name"><p>Météorites</p></div>
    </div>

   
  </div>
  <br><button onclick="location.href='configurationPanel.php'">Retour</button>

</body>
</html>
