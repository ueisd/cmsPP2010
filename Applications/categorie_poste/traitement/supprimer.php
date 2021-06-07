<?php
$categorie_poste = $_POST['categorie_poste_supprimer'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("DELETE FROM categorie_poste WHERE id='$categorie_poste'");
mysql_query("DELETE FROM poste WHERE type_poste='$categorie_poste'");
mysql_close();
?>