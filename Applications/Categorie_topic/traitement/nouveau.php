<?php
$nom_de_categorie=$_POST['nom_de_categorie'];
$afficher_titre=$_POST['afficher_titre'];

if(isset($_POST[categorie_d_utilisateur]) and $_POST[categorie_d_utilisateur]!='')
{
$Categorie_des_utilisateurs_form=$_POST[categorie_d_utilisateur];
$Categorie_des_utilisateurs=implode(",", $Categorie_des_utilisateurs_form);
}

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("INSERT INTO Categorie_topic VALUES('', '$nom_de_categorie', '$afficher_titre')");
mysql_close();
?>