<?php
    session_start();
    if (!isset($_SESSION['admin'])){

        header("Location: ../../index.php");
    }
    else if ($_SESSION['admin'] != 1){
            header("Location: ../../index.php");
        }
    else {
        include_once "../../user_hook/protection.php";
    }
?>