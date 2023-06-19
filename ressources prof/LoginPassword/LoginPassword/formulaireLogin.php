<html>
	<head>
	<title>Formulaire d'identification</title>
	</head>

	<body>
		<form action="loginPassOk.php" method="post">
			Votre login : <input type="text" name="login">
		<br />
		Votre mot de passe : <input type="password" name="pwd"><br />
			<input type="submit" value="Connexion">
		</form>

	</body>
<?php
  if (isset($_GET['msg']))
    {echo "erreur ";echo $_GET['msg']."<br/>";}
?>
</html>