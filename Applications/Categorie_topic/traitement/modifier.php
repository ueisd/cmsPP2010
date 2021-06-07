<?php
$id=$_POST['Modifier_categorie'];
$nom_de_categorie=$_POST['nom_de_categorie'];
$afficher_titre=$_POST['afficher_titre'];

$categorie_acessible_au_connecte = $_SESSION['categorie_du_connecte'];
$form_categorie_d_utilisateur=$_POST["categorie_d_utilisateur"];
$id_bd_pour_Categorie_des_utilisateurs=$id;
$nom_de_table_pour_Categorie_des_utilisateurs='Categorie_topic';
include("traitement_Categorie_des_utilisateurs.php");

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("UPDATE Categorie_topic SET nom_de_categorie='$nom_de_categorie', afficher_titre='$afficher_titre' WHERE id='$id'");
mysql_close();
?>