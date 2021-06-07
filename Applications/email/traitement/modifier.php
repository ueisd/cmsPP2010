<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$destinataire_final=$_POST['destinataire_final'];
$sujet=$_POST['sujet'];
$sujet_final=$_POST['sujet_final'];
$objet_inscription=$_POST['objet_inscription'];
$webmaster=$_POST['webmaster'];
$id_modifier_inscription_email=$_POST['modifier_inscription_email'];
mysql_query("UPDATE inscription_email SET destinataire_final='$destinataire_final', sujet='$sujet', sujet_final='$sujet_final', objet_inscription='$objet_inscription', 
webmaster='$webmaster' WHERE id='$id_modifier_inscription_email'");
?>