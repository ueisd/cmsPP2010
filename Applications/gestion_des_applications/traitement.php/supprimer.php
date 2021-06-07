<?php
$id_suprimer=$_POST['form_suprimer'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("DELETE FROM liste_des_applications WHERE id='$id_suprimer'");
mysql_query("DELETE FROM liste_des_applications_J_conteneur WHERE id_application='$id_suprimer'");
?>