<?php
$adresse_galerie=$_POST['adresse_galerie'];

if(isset($_POST[categorie_d_utilisateur]) and $_POST[categorie_d_utilisateur]!='')
{
$Categorie_des_utilisateurs_form=$_POST[categorie_d_utilisateur];
$Categorie_des_utilisateurs=implode(",", $Categorie_des_utilisateurs_form);
}

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");  
mysql_query("INSERT INTO galerie_nom VALUES('', '$adresse_galerie')");
mysql_close();
?>