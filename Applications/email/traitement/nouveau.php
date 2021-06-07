<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$destinataire_final=$_POST['destinataire_final'];
$sujet=$_POST['sujet'];
$sujet_final=$_POST['sujet_final'];
$objet_inscription=$_POST['objet_inscription'];
$webmaster=$_POST['webmaster'];
mysql_query("INSERT INTO inscription_email VALUES('', '$destinataire_final', '$sujet', '$sujet_final', '$objet_inscription', '$webmaster')");
?>