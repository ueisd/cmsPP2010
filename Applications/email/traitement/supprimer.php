<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$id_supprimer_inscription_email=$_POST['supprimer_inscription_email'];
mysql_query("DELETE FROM inscription_email WHERE id='$id_supprimer_inscription_email'");
?>