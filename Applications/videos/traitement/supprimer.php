<?php
$supprimer_video_id=$_POST['supprimer_video'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT adresse_image FROM videos WHERE id='$supprimer_video_id'");
while ($donnees = mysql_fetch_array($reponse) )
{
$nom_photo=$donnees['adresse_image'];
$image='image/video/' . $nom_photo;
}
unlink($image);
mysql_query("DELETE FROM videos WHERE id='$supprimer_video_id'");
mysql_close();
?>