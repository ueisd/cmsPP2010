<?php
$id=$_POST['suprimer_image'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");

$reponse = mysql_query("SELECT adresse FROM poste WHERE id='$id'");
while ($donnees = mysql_fetch_array($reponse) )
{
$nom_photo=$donnees['adresse'];
$image='image/poste/' . $nom_photo;
}
unlink($image);

mysql_query("DELETE FROM poste WHERE id='$id'");
mysql_close();
?>