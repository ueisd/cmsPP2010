<?php
$categorie_poste = $_POST['categorie_poste'];
$modifier_categorie_poste = $_POST['modifier_categorie_poste'];


$categorie_acessible_au_connecte = $_SESSION['categorie_du_connecte'];
$form_categorie_d_utilisateur=$_POST["categorie_d_utilisateur"];
$id_bd_pour_Categorie_des_utilisateurs=$categorie_poste;
$nom_de_table_pour_Categorie_des_utilisateurs='categorie_poste';
include("traitement_Categorie_des_utilisateurs.php");


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("UPDATE categorie_poste SET categorie_poste='$modifier_categorie_poste' WHERE id='$categorie_poste'");
mysql_close();
?>