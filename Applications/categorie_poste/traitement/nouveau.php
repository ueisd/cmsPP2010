<?php
$categorie_poste = $_POST['nouvelle_categorie_poste'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");

if(isset($_POST[categorie_d_utilisateur]) and $_POST[categorie_d_utilisateur]!='')
{
$Categorie_des_utilisateurs_form=$_POST[categorie_d_utilisateur];
$Categorie_des_utilisateurs=implode(",", $Categorie_des_utilisateurs_form);
}

mysql_query("INSERT INTO categorie_poste VALUES('', '$categorie_poste')");
mysql_close();
?>