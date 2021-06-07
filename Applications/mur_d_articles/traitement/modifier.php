<?php
$array_id_categories_des_articles = $_POST['array_id_categories_des_articles'];
$mur_d_articles_id=$_POST['modifier_mur_d_articles'];
$array_id_categories_des_articles = explode("|",$array_id_categories_des_articles);
$nom_du_mur_d_articles_administration = $_POST['nom_du_mur_d_articles_administration'];
$titre_du_mur_d_articles = $_POST['titre_du_mur_d_articles'];
$champ_de_tri = $_POST['champ_de_tri'];
$ordre_de_tri = $_POST['ordre_de_tri'];
$rapport_avec_la_date_actuelle = $_POST['rapport_avec_la_date_actuelle'];
$nombre_d_articles_par_pages = $_POST['nombre_d_articles_par_pages'];
$afficher_toutes_les_categories=$_POST['afficher_toutes_les_categories'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("UPDATE mur_d_articles SET nom_du_mur_d_articles_administration='$nom_du_mur_d_articles_administration', titre_du_mur_d_articles='$titre_du_mur_d_articles', champ_de_tri='$champ_de_tri', ordre_de_tri='$ordre_de_tri', rapport_avec_la_date_actuelle='$rapport_avec_la_date_actuelle', nombre_d_articles_par_pages='$nombre_d_articles_par_pages', afficher_toutes_les_categories='$afficher_toutes_les_categories' WHERE id='$mur_d_articles_id'");
mysql_query("DELETE FROM applications_J_exclure_categories WHERE id_application='$mur_d_articles_id' AND nom_de_table_de_l_application='$table_de_l_application'");
mysql_query("DELETE FROM applications_J_inclure_categories WHERE id_application='$mur_d_articles_id' AND nom_de_table_de_l_application='$table_de_l_application'");

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
mysql_close();
?>