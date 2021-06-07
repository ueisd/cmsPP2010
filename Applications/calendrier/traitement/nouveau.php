<?php
$nom_du_calendrier=$_POST['nom_du_calendrier'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("INSERT INTO calendrier VALUES('', '$nom_du_calendrier')");
$calendrier_id = mysql_insert_id();

if(isset($_POST['categorie_des_articles']) and $_POST['categorie_des_articles']!='')
{
$array_categorie_des_articles=$_POST['categorie_des_articles'];
foreach($array_categorie_des_articles as $id_categorie_des_articles)
{
mysql_query("INSERT INTO categories_des_calendriers VALUES('$id_categorie_des_articles', '$calendrier_id')");
}
}
?>