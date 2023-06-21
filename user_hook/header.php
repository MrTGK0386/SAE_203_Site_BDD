<?php

function checkAdmin(){
    if (isset($_SESSION['admin'])){
        if ($_SESSION['admin'] = 1){
            include_once "HTML_elements/headers/headerAdmin.html";
        }
        else {
            include_once "HTML_elements/headers/headerUser.html";
        }
    }
    else {
        include_once "HTML_elements/headers/headerRandom.html";
    }
}




checkAdmin();

?>
<script> var session = <?php echo $_SESSION['admin']; ?>; alert(session);</script>

