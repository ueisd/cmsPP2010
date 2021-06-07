<?php 
session_start();
include("noyau/configuration/base_de_donnee.php");

$table_de_l_application='liste_d_articles';

if(isset($_SESSION['autorisation']))
{
$table_categories_acessibles_table='description';
$id_table_categories_acessibles_table=$description_id;
include("noyau/Applications/categorie_d_utilisateurs/acces/acces_par_categorie_d_utilisateurs.php");
include("Applications/liste_d_articles/traitement/traitement.php");
}
?>
<style type="text/css">
a
{
text-decoration:none;
}
.menu_des_archives
{
	width:235px;
	margin:0px; 
	padding:0px;
	background-color:white; 
	border-top:3px solid #90a8cd;
	border-left:3px solid #90a8cd;
	border-right:3px solid #90a8cd;
	 
}
.menu_des_archives_lien 
{
	menu_article_titre1.jpg
	margin:4px;
	padding:2px;
	
	text-decoration:none;
	color:black;
	padding-left:7px;
	background-image:url("image/Frame_du_CMS/menu_article_titre2.jpg");
	background-repeat:repeat;
	background-color:#90a8cd;
}
.menu_des_archives_lien:hover
{
	cursor:pointer;
	background-image:url("image/Frame_du_CMS/menu_article_titre1.jpg");
	background-repeat:repeat;
	background-color:#90a8cd;
}
#description_du_petit_peuple_contennu_avance_menu
{
background-color:#ffffcb;
border:5px double #c5d4f6;
color:#00005e;
height:270px;
width:235px;
overflow:auto;
}
</style>

<?php

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 

$Date_aujourdhui= date('Y/m/d/h/i/s');

$reponse7 = mysql_query("SELECT * FROM liste_d_articles WHERE id='$id_liste_d_articles'");
while ($donnees7 = mysql_fetch_array($reponse7))
{ 
$titre_du_mur_d_article=$donnees7['titre_de_la_liste_d_articles'];
$champ_de_tri=$donnees7['champ_de_tri'];
$ordre_de_tri=$donnees7['ordre_de_tri'];
$rapport_avec_la_date_actuelle=$donnees7['rapport_avec_la_date_actuelle'];
$afficher_toutes_les_categories=$donnees7['afficher_toutes_les_categories'];
}


if(isset($afficher_toutes_les_categories) AND $afficher_toutes_les_categories!='on')
{
$partie1_requete_inclure="INNER JOIN categories_des_applications_J_applications ON articles.id=categories_des_applications_J_applications.id_application INNER JOIN applications_J_inclure_categories ON categories_des_applications_J_applications.categorie=applications_J_inclure_categories.id_categorie";
$partie2_requete_inclure="AND applications_J_inclure_categories.id_application='$id_liste_d_articles' AND applications_J_inclure_categories.nom_de_table_de_l_application='$table_de_l_application' AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles'";
}

if(isset($rapport_avec_la_date_actuelle) AND $rapport_avec_la_date_actuelle=='apres')
{
$requete__tri_par_position_envers_aujourdhui="AND articles.date >= '$Date_aujourdhui'";
}

if(isset($rapport_avec_la_date_actuelle) AND $rapport_avec_la_date_actuelle=='avant')
{
$requete__tri_par_position_envers_aujourdhui="AND articles.date <= '$Date_aujourdhui'";
}

$requete_de_tri="ORDER BY articles." . $champ_de_tri . " " . $ordre_de_tri;

$requete_globale="SELECT DISTINCT articles.id AS article_id, DAYOFWEEK(articles.date) AS jour_de_la_semaine, DAYOFMONTH(articles.date) AS jour_du_mois, MONTH(articles.date) AS date_mois, 
YEAR(articles.date) AS date_an, DATE_FORMAT(articles.date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(articles.date, '%k:%i') AS date_heure, articles.date, 
DAYOFWEEK(articles.date_fin) AS jour_de_la_semaine_fin, DAYOFMONTH(articles.date_fin) AS jour_du_mois_fin, MONTH(articles.date_fin) AS date_fin_mois, 
YEAR(articles.date_fin) AS date_fin_an, DATE_FORMAT(articles.date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(articles.date_fin, '%k:%i') AS date_fin_heure, articles.date_fin, 
articles.titre AS article_titre FROM articles $partie1_requete_inclure WHERE 
articles.id NOT IN (SELECT articles.id 
FROM articles 
INNER JOIN categories_des_applications_J_applications ON articles.id = categories_des_applications_J_applications.id_application
INNER JOIN applications_J_exclure_categories ON categories_des_applications_J_applications.categorie = applications_J_exclure_categories.id_categorie
WHERE applications_J_exclure_categories.id_application = '$id_liste_d_articles' AND applications_J_exclure_categories.nom_de_table_de_l_application = '$table_de_l_application') 
$partie2_requete_inclure $requete__tri_par_position_envers_aujourdhui $requete_de_tri";


if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{
?>
<form action="contenu_d_application_modifier.php?table_modifier=liste_d_articles" method="post">
<input type="hidden" name="modifier_liste_d_article" value="<?php echo $id_liste_d_articles; ?>" />
<input type="submit" name="mod_liste_d_articles000" value="Modifier la liste d'articles" />
</form>
<a href="contenu_d_application_gestion.php?table_gestion=liste_d_articles">Gerer les listes d'articles</a> 
<?php } ?>

<h2><?php echo $titre_du_mur_d_article; ?></h2>

<?php
if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ ?> 
<a href="contenu_d_application_nouveau.php?table_nouveau=articles"><div class="menu_des_archives_lien" style="width:220px;">Nouvel article</div></a> 
<?php } ?>	

<div class="menu_des_archives">			
<div id="description_du_petit_peuple_contennu_avance_menu">

<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 

 
$reponse9 = mysql_query("$requete_globale");


while ($donnees9 = mysql_fetch_array($reponse9))
{
?>
  
    <a href="visionneur.php?id_contenu=<?php echo $donnees9['article_id']; ?>&amp;table_de_l_application=articles"><div class="menu_des_archives_lien"><?php echo $donnees9['article_titre']; ?><?php echo '    '; ?> 
    	<?php $jour_fr = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"); 
    	$mois_fr = array("Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao&ucirc;t", "Septembre", "Octobre", "Novembre", "D&eacute;cembre"); $Date_aujourdhui=date('Y-m-d'); 
    	if($donnees9['date_An_Mois_jour']==$Date_aujourdhui){ 
    	if($donnees9['date_An_Mois_jour']==$donnees9['date_fin_An_Mois_jour']){}elseif($donnees9['date_fin']!='0000-00-00 00:00:00'){echo ' de ';}
    	echo "Aujourd'hui"; if($donnees9['date_heure']=='0:00'){}else{
    	if($donnees9['date_An_Mois_jour']==$donnees9['date_fin_An_Mois_jour']){echo ' de ';}else{echo ' &agrave; ';} echo $donnees9['date_heure'];} } 
	else { 
	echo $jour_fr[$donnees9['jour_de_la_semaine']-1]; echo ' ' . $donnees9['jour_du_mois']; echo ' ' . $mois_fr[$donnees9['date_mois']-1]; echo ' ' . $donnees9['date_an']; 
	if($donnees9['date_heure']=='0:00'){}else{ 
	if($donnees9['date_An_Mois_jour']==$donnees9['date_fin_An_Mois_jour']){echo ' de ';}else{echo ' &agrave; ';}
	 echo $donnees9['date_heure'];}
	 }
	 if($donnees9['date_fin']=='0000-00-00 00:00:00'){}else{
	 if($donnees9['date_An_Mois_jour']==$donnees9['date_fin_An_Mois_jour']){echo ' &agrave; ' . $donnees9['date_fin_heure'];}else{
	 echo ', &agrave; ' . $jour_fr[$donnees9['jour_de_la_semaine_fin']-1]; echo ' ' . $donnees9['jour_du_mois_fin']; echo ' ' . $mois_fr[$donnees9['date_fin_mois']-1]; echo ' ' . $donnees9['date_fin_an']; 
	if($donnees9['date_fin_heure']=='0:00'){}else{echo ' &agrave; ' . $donnees9['date_fin_heure'];}
	}
	}
	 ?>
	 
    </div></a>
  
<?php
}

mysql_close();
?>

</div>		
</div>

<?php 
$Gestion_acessible=''; 

$titre_du_mur_d_article=''; 
$champ_de_tri=''; 
$ordre_de_tri=''; 
$rapport_avec_la_date_actuelle=''; 
$afficher_toutes_les_categories='';
$id_liste_d_articles=''; 
$partie1_requete_inclure=''; 
$partie2_requete_inclure=''; 
$requete__tri_par_position_envers_aujourdhui=''; 
$requete_de_tri=''; 
$requete_globale=''; 
?>