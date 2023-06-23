<?php
if (isset($_SESSION['username'])) {
    if ($_SESSION['admin'] == 1){
        include_once "headers/headerAdmin.html";
    }
    else{
        include_once "headers/headerUser.html";

    }
}else{
    include_once "headers/headerRandom.html";

}
?>


