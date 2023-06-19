<?php
//require "protectionAdmin.php";// code qui protege les HTML_elements qui ne doivent pas etre accessibles sans login/password
?>

<HTML>
	<meta charset="utf-8"/>
    <head>
    <style>
      .button {
        background-color: #1c87c9;
        border: none;
        color: white;
        padding: 20px 34px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 4px 2px;
        cursor: pointer;
      }
    </style>
    </head>
	<BODY>
<!--
    <input type="button" value="Liste des utilisateurs">
    <button onclick="window.location.href = 'https://fr.w3docs.com/';">Cliquez Ici</button>
    <form action="https://fr.w3docs.com/">
      <button type="submit">Cliquez sur moi</button>
    </form>
-->
    <a href="listeUtilisateurs.php" class="button">Liste des utilisateurs</a>
    <a href="formulaireDelete.php" class="button">Suppression via formulaire</a>
    <a href="deleteUtilisateurs.php" class="button">Suppression d'utilisateurs</a>
    </BODY>
</HTML>