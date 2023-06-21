<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <title>Ajouter des événements</title>
  <link rel="stylesheet" href="styles/configurationPanel.css">
</head>
<body>



<div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <h1 class="text-center">Ajouter des événements</h1>
      </div>
    </div>
  </div>
  <div class="button-container" >
    <div class="button eq" onclick="location.href='event_adders/AddEq.php'">
      <img class="button-icon" src="assets/eq.png" alt="Button 1 Icon">
      <div class="button-name"><p>Tremblements de Terre</p></div>
    </div>

    <div class="button volcano" onclick="location.href='#'">
      <img class="button-icon" src="assets/volcan.png" alt="Button 1 Icon">
      <div class="button-name"><p>Volcans</p></div>
    </div>

    <div class="button meteor" onclick="location.href='#'">
      <img class="button-icon" src="assets/meteorite.png" alt="Button 1 Icon">
      <div class="button-name"><p>Météorites</p></div>
    </div>

    <div class="button country" onclick="location.href='#'">
      <img class="button-icon" src="assets/planete.png" alt="Button 1 Icon">
      <div class="button-name"><p>Pays</p></div>
    </div>

   
  </div>
  <br><button onclick="location.href='configurationPanel.php'">Retour</button>

</body>
</html>
