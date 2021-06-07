<?php
$id=$_POST['Supprimer_categorie'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("DELETE FROM Categorie_topic WHERE id='$id'");
mysql_close();

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT image_du_topic FROM topic WHERE id_de_categorie_du_topic='$id'");
while ($donnees = mysql_fetch_array($reponse) )
{
$image='image/topic/' . $donnees['image_du_topic'];
unlink($image);
}
mysql_query("DELETE FROM topic WHERE id_de_categorie_du_topic='$id'");
mysql_close();
?>