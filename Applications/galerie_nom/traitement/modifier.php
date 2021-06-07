<?php
$nom_galerie_nouveau=$_POST['nom_galerie_nouveau'];
$id_galerie_modifier=$_POST['id_galerie_modifier'];


$categorie_acessible_au_connecte = $_SESSION['categorie_du_connecte'];
$form_categorie_d_utilisateur=$_POST["categorie_d_utilisateur"];
$id_bd_pour_Categorie_des_utilisateurs=$id_galerie_modifier;
$nom_de_table_pour_Categorie_des_utilisateurs='galerie_nom';
include("traitement_Categorie_des_utilisateurs.php");


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse5 = mysql_query("SELECT * FROM galerie_nom WHERE id='$id_galerie_modifier'");
while ($donnees5 = mysql_fetch_array($reponse5) )
{
$nom_galerie_vieux=$donnees5['nom_galerie'];
}
mysql_query("UPDATE galerie SET galerie='$id_galerie_modifier' WHERE galerie='$nom_galerie_vieux'");


mysql_query("UPDATE galerie_nom SET nom_galerie='$nom_galerie_nouveau' WHERE id='$id_galerie_modifier'");
mysql_close();
?>