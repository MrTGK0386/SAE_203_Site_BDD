<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("Location: formulaireLogin.php?msg=acces invalide");
    exit;
}
?>