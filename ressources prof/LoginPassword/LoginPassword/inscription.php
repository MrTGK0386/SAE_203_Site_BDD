<?php
session_start();
?>
<?php

//Fonction qui retourne si le userid $pseudo est present (true) ou non dans la table utilisateurs (false)
function existeUserid($pseudo)
{
//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","TPBDD")  or die(mysqli_error($conn));
$requete = "SELECT COUNT(*) as nbUserid FROM utilisateurs where pseudo =?";
$statement =mysqli_prepare($conn, $requete)  or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"s",$pseudo) or die(mysqli_error($conn));
mysqli_execute($statement)  or die(mysqli_error($conn));

$resultat=mysqli_stmt_get_result($statement);
$row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
//print_r($row);
mysqli_close($conn) or die(mysqli_error($conn));

$nb=$row['nbUserid'];
return $nb==1;
}

function ajouteUser($pseudo,$pass,$email)
{
    $passEncode=md5($pass.'$x21**');// ou $x21** est une chaîne ajoutée au mot de passe pour rentre plus complexe son déchiffrage
//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","TPBDD") or die("Connexion non possible! <br/>". mysqli_connect_error());;

$requete = 'INSERT INTO utilisateurs (pseudo, pass, email) VALUES(?, ?, ?)';
$statement =mysqli_prepare($conn, $requete) or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"sss",$pseudo,$passEncode,$email) or die(mysqli_error($conn));
mysqli_execute($statement) or die(mysqli_error($conn));
mysqli_close($conn) or die(mysqli_error($conn));
}

if (!isset($_POST['pseudo'])) 
    {header("Location: formInscription.php");
    exit;
    }

$pseudo=htmlspecialchars($_POST['pseudo']);

// si le userid est deja utilisé redirection
if (existeUserid($pseudo))
{
    header("Location: formInscription.php?msg=pseudo déjà utilisé");
    exit;
}
$pass=htmlspecialchars($_POST['pass']);

$email=htmlspecialchars($_POST['email']);

ajouteUser($pseudo,$pass,$email);
$_SESSION['OK']=$pseudo;
header ("Location: pagevalide.php");
?>