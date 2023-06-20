<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <title>Four Big Buttons with Custom Icons</title>
  <link rel="stylesheet" href="styles/configurationPanel.css">
</head>
<body>
  <div class="button-container" >
    <div class="button add" onclick="location.href='addEvent.php'">
      <img class="button-icon" src="assets/plus.png" alt="Button 1 Icon">
      <div class="button-name">Ajouter</div>
    </div>

    <div class="button edit" onclick="location.href='editEvent.php'">
      <img class="button-icon" src="assets/editer.png" alt="Button 2 Icon">
      <div class="button-name">Editer</div>
    </div>

    <div class="button delete" onclick="location.href='deleteEvent.php'">
      <img class="button-icon" src="assets/supprimer.png" alt="Button 3 Icon">
      <div class="button-name">Supprimer</div>
    </div>

    <div class="button edit_user" onclick="location.href='manageUser.php'">
      <img class="button-icon" src="assets/user_gestion.png" alt="Button 4 Icon">
      <div class="button-name">Gerer les utilisateurs</div>
    </div>
  </div>
</body>
</html>
