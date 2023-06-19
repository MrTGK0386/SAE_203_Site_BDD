<?php
// fichier pour modifier la base de données et ajouter une colonne permettant
// d'indiquer si un utilisateur est administrateur ou non
function ajouteAdmin($pseudo,$pass,$email)
{
$passEncode=md5($pass.'$x21**');// ou $x21** est une chaîne ajoutée au mot de passe pour rentre plus complexe son déchiffrage
//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","TPBDD") or die("Connexion non possible! <br/>". mysqli_connect_error());;

$requete = 'INSERT INTO utilisateurs (pseudo, pass, email,admin) VALUES(?, ?, ?,1)';
$statement =mysqli_prepare($conn, $requete) or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"sss",$pseudo,$passEncode,$email) or die(mysqli_error($conn));
mysqli_execute($statement) or die(mysqli_error($conn));
mysqli_close($conn) or die(mysqli_error($conn));
}

//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","TPBDD")  or die(mysqli_error($conn));
$requete = "ALTER TABLE utilisateurs ADD admin int DEFAULT 0";
$statement =mysqli_prepare($conn, $requete)  or die(mysqli_error($conn));
mysqli_execute($statement)  or die(mysqli_error($conn));

// Ajout d'un utilisateur admin mot de passe admin
ajouteAdmin("admin","admin","test@iutbeziers.fr");
mysqli_close($conn);
?>