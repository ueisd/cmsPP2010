<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$modifier_calendrier=$_POST['modifier_calendrier'];
$nom_du_calendrier=$_POST['nom_du_calendrier'];
mysql_query("UPDATE calendrier SET nom='$nom_du_calendrier' WHERE id='$modifier_calendrier'");

mysql_query("DELETE FROM categories_des_calendriers WHERE calendrier='$modifier_calendrier'");
if(isset($_POST['categorie_des_articles']) and ($_POST['categorie_des_articles']!=''))
{
$array_categorie_des_articles=$_POST['categorie_des_articles'];
foreach($array_categorie_des_articles as $categorie_des_articles)
{
mysql_query("INSERT INTO categories_des_calendriers VALUES('$categorie_des_articles', '$modifier_calendrier')");
}
}
?>