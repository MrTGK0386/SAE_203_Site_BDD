<?php
require "protection.php";// code qui protege les pages qui ne doivent pas etre accessibles sans login/password
print("Bienvenue utilisateur: ".$_SESSION['OK']."<br/>");
?>