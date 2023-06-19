<?php
session_start();
?>

<?php
function estAdmin($pseudo)
{
//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","TPBDD")  or die(mysqli_error($conn));
$requete = "SELECT admin FROM utilisateurs where pseudo =?";
$statement =mysqli_prepare($conn, $requete)  or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"s",$pseudo) or die(mysqli_error($conn));
mysqli_execute($statement)  or die(mysqli_error($conn));

$resultat=mysqli_stmt_get_result($statement);
$row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
mysqli_close($conn) or die(mysqli_error($conn));

return $row['admin']==1;

}
//Fonction qui retourne si le couple login/password est dans la table utilisateurs
function loginPassOk($pseudo,$password)
{
$passEncode=md5($password.'$x21**');

//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","TPBDD")  or die(mysqli_error($conn));
$requete = "SELECT COUNT(*) as nb FROM utilisateurs where pseudo =? and pass=? ";
$statement =mysqli_prepare($conn, $requete)  or die(mysqli_error($conn));
mysqli_stmt_bind_param($statement,"ss",$pseudo,$passEncode) or die(mysqli_error($conn));
mysqli_execute($statement)  or die(mysqli_error($conn));

$resultat=mysqli_stmt_get_result($statement);
$row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
//print_r($row);
mysqli_close($conn) or die(mysqli_error($conn));

$nb=$row['nb'];
return $nb==1;
}

// reprise de l'ancien code de login.
if( isset($_POST["login"]))
{   
    $login=htmlspecialchars($_POST['login']);
    $pass=htmlspecialchars($_POST['pwd']);
    if (loginPassOk($login, $pass))
    {
        $_SESSION['OK']=$login;
        // on verifie s'il ne s'agit pas d'un admin.
        if (estAdmin($login))
        {
            $_SESSION['admin']=TRUE; // creation de cette variable seulement dans le cas admin.
            header("Location: pageAdmin.php");
            exit;
        }
        header("Location: pagevalide.php");
        exit;
    }
    
    else
    {
        print("Vous n'etes pas enregistré !");
        print("<br>");
        print("redirection dans 5 secondes...");

        print('<meta http-equiv="refresh" content="5;formulaireLogin.php">');

    }
}
?>
</BODY>
</HTML>