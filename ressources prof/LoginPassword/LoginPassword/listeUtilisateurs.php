<?php
require "protectionAdmin.php";// code qui protege les HTML_elements qui ne doivent pas etre accessibles sans login/password
?>
<HTML>
	<meta charset="utf-8"/>
	<BODY>
<?php

function affichRow($row)
{
  echo "<tr>";
  echo "<td>";
  echo($row['pseudo']);
  echo "</td>";
  echo "<td>";
  echo($row['email']);
  echo "</td>";
  echo "</tr>";
}
//Essai de connexion au serveur local sur le port 13306 avec comme userid root et password une chaîne vide
$conn=mysqli_connect("localhost:13306", "root","","TPBDD") or die("Connexion non possible! <br/>". mysqli_connect_error());;
echo "Liste des utilisateurs<br/>";
$requete = 'SELECT * FROM utilisateurs';
$statement =mysqli_prepare($conn, $requete) or die(mysqli_error($conn));
//mysqli_stmt_bind_param($statement,"sss",$pseudo,$pass,$email) or die(mysqli_error($conn));
mysqli_execute($statement) or die(mysqli_error($conn));
$resultat=mysqli_stmt_get_result($statement);
//affichage table https://www.w3schools.com/html/tryit.asp?filename=tryhtml_table_intro
?>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<table>
    <thead>
        <tr>
          <th>
            Pseudo
          </th>
          <th>
           Email
          </th>
        </tr>
    </thead>

<?php
while($row = mysqli_fetch_array($resultat, MYSQLI_ASSOC))
{
    //echo($row['pseudo']." ".$row['email']);
    //echo ("<br/>");
   affichRow($row);
}
?>
</table>
<?php
mysqli_close($conn) or die(mysqli_error($conn));
/* exemple table html
<table>
    <thead>
        <tr>
            <th colspan="2">The table header</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>The table body</td>
            <td>with two columns</td>
        </tr>
    </tbody>
</table>
<table>
  <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
</table>
*/
?>
</BODY>
</HTML>