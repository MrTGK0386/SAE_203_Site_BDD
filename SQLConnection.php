<?php

$servername = "localhost:13306";
$username = "root";
$password = "";
$dbname = "gaetan.bondenet";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}
else{
    echo "<script>console.log('connection reussie')</script>";
};

?>