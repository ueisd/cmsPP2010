<?php
$nom_du_mur_d_articles_administration = $_POST['nom_du_mur_d_articles_administration'];
$titre_du_mur_d_articles = $_POST['titre_du_mur_d_articles'];
$champ_de_tri = $_POST['champ_de_tri'];
$ordre_de_tri = $_POST['ordre_de_tri'];
$rapport_avec_la_date_actuelle = $_POST['rapport_avec_la_date_actuelle'];
$nombre_d_articles_par_pages = $_POST['nombre_d_articles_par_pages'];
$afficher_toutes_les_categories = $_POST['afficher_toutes_les_categories'];
$array_id_categories_des_articles = $_POST['array_id_categories_des_articles'];
$array_id_categories_des_articles = explode("|",$array_id_categories_des_articles);

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("INSERT INTO mur_d_articles VALUES('', '$nom_du_mur_d_articles_administration', '$titre_du_mur_d_articles', 
'$champ_de_tri', '$ordre_de_tri', '$rapport_avec_la_date_actuelle', '$nombre_d_articles_par_pages', '$afficher_toutes_les_categories')");
$mur_d_articles_id = mysql_insert_id();

foreach ($array_id_categories_des_articles as $id_categorie_d_article)
{

    if($_POST[$id_categorie_d_article]=='inclure')
{
mysql_query("INSERT INTO applications_J_inclure_categories VALUES('$mur_d_articles_id', '$id_categorie_d_article', '$table_de_l_application')");
}

    if($_POST[$id_categorie_d_article]=='exclure')
{
mysql_query("INSERT INTO applications_J_exclure_categories VALUES('$mur_d_articles_id', '$id_categorie_d_article', '$table_de_l_application')");
}

}
?>