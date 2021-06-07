<?php
session_start(); 
include("noyau/configuration/base_de_donnee.php");

$table_de_l_application='mur_d_articles';

if(isset($_SESSION['autorisation']))
{
$table_categories_acessibles_table='mur_d_article';
$id_table_categories_acessibles_table=$id_mur_d_article;
include("noyau/Applications/categorie_d_utilisateurs/acces/acces_par_categorie_d_utilisateurs.php");
}


$Date_aujourdhui= date('Y/m/d/h/i/s');
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");

$reponse7 = mysql_query("SELECT * FROM mur_d_articles WHERE id='$id_mur_d_article'");
while ($donnees7 = mysql_fetch_array($reponse7))
{ 
$titre_du_mur_d_article=$donnees7['titre_du_mur_d_articles'];
$champ_de_tri=$donnees7['champ_de_tri'];
$ordre_de_tri=$donnees7['ordre_de_tri'];
$rapport_avec_la_date_actuelle=$donnees7['rapport_avec_la_date_actuelle'];
$nombre_d_articles_par_pages=$donnees7['nombre_d_articles_par_pages'];
$afficher_toutes_les_categories=$donnees7['afficher_toutes_les_categories'];

}


if(isset($afficher_toutes_les_categories) AND $afficher_toutes_les_categories!='on')
{
$partie1_requete_inclure="INNER JOIN categories_des_applications_J_applications ON articles.id=categories_des_applications_J_applications.id_application INNER JOIN applications_J_inclure_categories ON categories_des_applications_J_applications.categorie=applications_J_inclure_categories.id_categorie";
$partie2_requete_inclure="AND applications_J_inclure_categories.id_application='$id_mur_d_article' AND applications_J_inclure_categories.nom_de_table_de_l_application='$table_de_l_application' AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles'";
}



if(isset($rapport_avec_la_date_actuelle) AND $rapport_avec_la_date_actuelle=='apres')
{
$requete__tri_par_position_envers_aujourdhui="AND articles.date >= '$Date_aujourdhui'";
}

if(isset($rapport_avec_la_date_actuelle) AND $rapport_avec_la_date_actuelle=='avant')
{
$requete__tri_par_position_envers_aujourdhui="AND articles.date <= '$Date_aujourdhui'";
}

$requete_de_tri="ORDER BY articles." . $champ_de_tri . " " . $ordre_de_tri . " LIMIT 0," . $nombre_d_articles_par_pages;

$requete_globale="SELECT DISTINCT articles.id AS special FROM articles $partie1_requete_inclure WHERE 
articles.id NOT IN (SELECT articles.id 
FROM articles 
INNER JOIN categories_des_applications_J_applications ON articles.id = categories_des_applications_J_applications.id_application
INNER JOIN applications_J_exclure_categories ON categories_des_applications_J_applications.categorie = applications_J_exclure_categories.id_categorie
WHERE applications_J_exclure_categories.id_application = '$id_mur_d_article' AND applications_J_exclure_categories.nom_de_table_de_l_application = '$table_de_l_application') 
$partie2_requete_inclure $requete__tri_par_position_envers_aujourdhui $requete_de_tri";

if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ ?>
<table>
<tr>

<td>
<form action="contenu_d_application_modifier.php?table_modifier=mur_d_articles" method="post">
<input type="hidden" name="modifier_mur_d_article" value="<?php echo $id_mur_d_article; ?>" /> 
<input type="submit" name="mod_mur_article000" value="Modifier le mur d'articles" />
</form>
</td>

<td>
<a href="contenu_d_application_gestion.php?table_gestion=mur_d_articles">Gerer le mur des articles</a>
</td>

</tr>
</table> 
<?php } ?>

<h2><?php echo $titre_du_mur_d_article; ?></h2>

<?php

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 

$reponse9 = mysql_query("$requete_globale");


while ($donnees9 = mysql_fetch_array($reponse9))
{
?>   

<?php $article_id=$donnees9['special'];  include("Applications/articles/article_contenu.php"); ?>  

<?php
}
?>
<?php 
$Gestion_acessible=''; 

$titre_du_mur_d_article=''; 
$champ_de_tri=''; 
$ordre_de_tri=''; 
$nombre_d_articles_par_pages='';
$rapport_avec_la_date_actuelle=''; 
$afficher_toutes_les_categories='';
$id_mur_d_article=''; 
$partie1_requete_inclure=''; 
$partie2_requete_inclure=''; 
$requete__tri_par_position_envers_aujourdhui=''; 
$requete_de_tri=''; 
$requete_globale='';
?>