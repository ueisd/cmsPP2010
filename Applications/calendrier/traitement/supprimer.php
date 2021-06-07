<?php
$id=$_POST['supprimer_calendrier'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("DELETE FROM categories_des_calendriers WHERE calendrier='$id'");
mysql_query("DELETE FROM calendrier WHERE id='$id'");
?>