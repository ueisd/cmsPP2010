<?php session_start(); ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<script type="text/javascript" src="noyau/style/csshover.js"></script> 
	</head>
	<body bgcolor="#14285f" link="#9900cc">	
<style type="text/css">
body
{
background-image:url(null);
background-attachment:fixed;  
background-repeat:no-repeat;
background-color:#f0f7f8;
margin:0px;
padding:0px;
}
#contenu
{
	width:100%;
	position:absolute;
	top:35px; left:0px; 
	margin:0px; padding:0px;
}
</style>
<?php include("Applications/entete/entete.php"); ?>
		<!-- Page Principal-->
	<div id="contenu">
	
<h2>Utilisateurs</h2>
<a href="contenu_de_noyeau_gestion.php?table_gestion=categorie_d_utilisateurs" target="_blank">G&#233;rer les cat&#233;gories d'utilisateurs</a><br/>
<a href="contenu_de_noyeau_gestion.php?table_gestion=utilisateurs" target="_blank">G&#233;rer les utilisateurs du site internet</a><br/>
<a href="inscription.php" target="_blank">Page des inscriptions</a><br/>

<h2>Pages</h2>
<a href="contenu_d_application_gestion.php?table_gestion=pages" target="_blank">Gestion des pages</a><br/>
<a href="contenu_d_application_gestion.php?table_gestion=gestion_des_applications" target="_blank">Gestion des applications</a><br/>

<h2>Blocs</h2>
<a href="contenu_d_application_gestion.php?table_gestion=blocs" target="_blank">Gestion des Conteneurs</a><br/>


<br/>
<h2>Gestion des applications</h2>
<h3>Cat&#233;gories</h3>
<a href="contenu_d_application_gestion.php?table_gestion=categorie_poste" target="_blank">G&#233;rer les cat&#233;gories des postes</a><br/>
<a href="contenu_de_noyeau_gestion.php?table_gestion=categories_des_applications" target="_blank">G&#233;rer les cat&#233;gories des applications</a><br/>
<a href="contenu_d_application_gestion.php?table_gestion=Categorie_topic" target="_blank">G&#233;rer les cat&#233;gories de topics</a><br/>
<h3>Applications</h3>
<a href="contenu_d_application_gestion.php?table_gestion=galerie_nom" target="_blank">Gestion des galeries de photos</a><br/>
<a href="contenu_d_application_gestion.php?table_gestion=description" target="_blank">Gestion des descriptions</a><br/>
<a href="contenu_d_application_nouveau.php?table_nouveau=articles" target="_blank">Nouvel article</a><br/>
<a href="contenu_d_application_gestion.php?table_gestion=calendrier" target="_blank">Calendrier</a><br/>
<a href="contenu_d_application_gestion.php?table_gestion=mur_d_articles" target="_blank">Murs d'articles</a><br/>
<a href="contenu_d_application_gestion.php?table_gestion=liste_d_articles" target="_blank">Liste d'articles</a><br/>

	</div>
</body>
</html>