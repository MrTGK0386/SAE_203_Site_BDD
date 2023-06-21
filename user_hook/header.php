<?php
if (isset($_SESSION['username'])) {
    if ($_SESSION['admin'] == 1){
        include_once "HTML_elements/headers/headerAdmin.html";
    }
    else{
        include_once "HTML_elements/headers/headerUser.html";

    }
}else{
    include_once "HTML_elements/headers/headerRandom.html";

}

?>

