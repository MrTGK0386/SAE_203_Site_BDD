<?php
session_start();
if(!isset($_SESSION['OK']))
{
    header("Location: formulaireLogin.php?msg=acces invalide");
    exit;
}
?>