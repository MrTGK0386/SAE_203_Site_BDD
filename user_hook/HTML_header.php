<?php
if (isset($_SESSION['username'])) {
    if ($_SESSION['admin'] == 1){
        include_once "headers/HTMLheaderAdmin.html";
    }
    else{
        include_once "headers/HTMLheaderUser.html";

    }
}else{
    include_once "headers/HTMLheaderRandom.html";

}
?>


