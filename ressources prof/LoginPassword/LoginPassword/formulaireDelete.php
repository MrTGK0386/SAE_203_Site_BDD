<?php
require "protectionAdmin.php";// code qui protege les HTML_elements qui ne doivent pas etre accessibles sans login/password
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

function deleteUserid($pseudo)
{
//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","TPBDD")  or die(mysqli_error($conn));
$requete = "DELETE FROM utilisateurs  where pseudo =?";
$statement =mysqli_prepare($conn, $requete)  or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"s",$pseudo) or die(mysqli_error($conn));
mysqli_execute($statement)  or die(mysqli_error($conn));
}

function  createConfirmationmbox($url) {  
    echo '<script type="text/javascript"> ';  
    echo '  if (confirm("Are you sure you want to open new URL"))';  
	echo '    document.location = "formulaireDelete.php?destruction=ok";';
	echo ' else';
	echo '    document.location = "formulaireDelete.php?destruction=non";';
    echo '</script>';  
}  

?>
<html>
	<head>
	<title>Formulaire de destruction</title>
	</head>

	<body>
		<form action="#" method="post">
			Nom utilisateur : <input type="text" name="utilisateur">
		<br />
			<input type="submit" value="Destruction">
		</form>

	</body>
<?php
//echo $_GET["destruction"];
/*if (isset($_GET["destruction"]))
	echo "destruction";
else
	echo "non destruction";*/
  if (isset($_POST['utilisateur']))
    { 
		//echo $_POST['utilisateur'];
		$userid=htmlspecialchars($_POST['utilisateur']);
		// verifier que l'utilisateur existe.
		if (existeUserid($userid))
		{
			deleteUserid($userid);
			echo "destruction de l'utilisateur ".$userid." <br/>";
			//echo "valide";
			//createConfirmationmbox("http:www.amazon.fr");
		}
		else
			echo "cet utilisateur n'existe pas <br/>";
	// affichage des informations sur l'utilisateur et  message de confirmation
	}
?>

</html>