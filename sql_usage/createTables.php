<?php
include_once 'SQLConnection.php';
include_once 'createMeteorite.php';
include_once 'createCountry.php';
include_once 'createEarthQuakeTable.php';
include_once 'createUserTable.php';
include_once 'createVolcano.php';

if (isset($_POST['trigger'])) {
    $sql = "SELECT CONCAT( 'DROP TABLE ', GROUP_CONCAT(table_name) , ';' ) 
    AS statement FROM information_schema.tables 
    WHERE table_schema = 'gaetan.bondenet' AND table_name LIKE 'sae203_%';";
    $resultat = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_column($resultat);
    echo $row;
    mysqli_query($conn,$row) or die(mysqli_error($conn));


    //and then execute a sql query here
} else {
    echo "<script>console.log(not dropped)</script>" ;
}
?>
