<?php
$galerie_suprimer = $_POST['galerie_suprimer'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");  
$reponse = mysql_query("SELECT nom_photo FROM galerie WHERE galerie='$galerie_suprimer'");
while ($donnees = mysql_fetch_array($reponse) )
{
$nom_photo=$donnees['nom_photo'];
$image='image/galerie/' . $nom_photo;
unlink($image);
}
mysql_query("DELETE FROM galerie WHERE galerie='$galerie_suprimer'");
mysql_query("DELETE FROM galerie_nom WHERE nom_galerie='$galerie_suprimer'");
mysql_close();
?>