<?php
$servername = "localhost:13306";
$username = "root";
$password = "";
$dbname = "gaetan.bondenet";

// Créez une connexion
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifiez la connexion
if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}
else{
    echo "ok";
};

?>