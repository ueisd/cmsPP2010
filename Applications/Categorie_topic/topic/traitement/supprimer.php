<?php
$id=$_POST['Supprimer_topic'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 

$reponse = mysql_query("SELECT image_du_topic FROM topic WHERE id='$id'");
while ($donnees = mysql_fetch_array($reponse) )
{
$nom_photo=$donnees['image_du_topic'];
$image='image/topic/' . $nom_photo;
}
unlink($image);

mysql_query("DELETE FROM topic WHERE id='$id'");
mysql_close();
?>