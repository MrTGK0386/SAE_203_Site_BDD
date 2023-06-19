<HTML>
	<meta charset="utf-8"/>
	<BODY>

<form action="inscription.php" method="post">
    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Nom utilisateur" name="pseudo" required>
      <br/>
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Mot de passe" name="pass" required>
      <br/>
      <label for="mail"><b>email</b></label>
      <input type="email" placeholder="email" name="email" required>
      <br/>
      <button type="submit">Ajouter</button>
    </div>
  </form>
  <?php
  if (isset($_GET['msg']))
    {echo "erreur ";echo $_GET['msg']."<br/>";}
  ?>
</BODY>
</HTML>