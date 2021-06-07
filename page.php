<?php session_start(); 
include("noyau/configuration/base_de_donnee.php"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<?php 
if(isset($_GET['page_numero']) AND $_GET['page_numero']!='')
{ 
$id_de_la_page=$_GET['page_numero']; 
}
else
{ 
$id_de_la_page = $id_de_la_page_pour_include;
}

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_page = mysql_query("SELECT * FROM pages WHERE id='$id_de_la_page'");
while ($donnees_page = mysql_fetch_array($reponse_page) )
{
?>

	<head>
		<title><?php echo $donnees_page['Nom_de_la_page']; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="keywords" content="<?php echo $donnees_page['Tags']; ?>">
		<meta name="description" content="">
		<script type="text/javascript" src="noyau/style/csshover.js"></script> 
	</head>
<style>
#formulaire_administrer_la_page
{
width:100%;
background-color:#f5f5f5;
float:left;
position:fixed;
bottom:0px;
z-index:12;
}
</style>	
<?php
}
mysql_close();
?>
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


<?php
$_SESSION['administration_adresse_de_la_derniere_page_avec_variables']=$_SERVER['REQUEST_URI'];
$_SESSION['adresse_de_la_derniere_page_avec_variables']=$_SERVER['REQUEST_URI'];
$_SESSION['adresse_de_la_derniere_page_sans_variables']=$_SERVER['PHP_SELF'] . '?page_numero=' . $_GET['page_numero'];


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse1 = mysql_query("SELECT * FROM Applications_des_pages WHERE id_de_la_page='$id_de_la_page' ORDER BY ordre");
while ($donnees1 = mysql_fetch_array($reponse1) )
{
$id_application=$donnees1['id_application'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse_application = mysql_query("SELECT * FROM liste_des_applications WHERE id='$id_application'");
while ($donnees_application = mysql_fetch_array($reponse_application) )
{
$Nom_de_variable_id=$donnees_application['Nom_de_variable_id'];
$Adresse_dans_include=$donnees_application['Adresse_dans_include'];
${$Nom_de_variable_id}=$donnees1['id_nom_application']; 
}
include("$Adresse_dans_include");
}

if(isset($_SESSION['autorisation']))
{
$table_categories_acessibles_table='pages';
$id_table_categories_acessibles_table=$id_de_la_page;
include("noyau/Applications/categorie_d_utilisateurs/acces/acces_par_categorie_d_utilisateurs.php");
}
if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ 
?>

<div id="formulaire_administrer_la_page">

<table style="float:left;">
<tr>

<td>
<form action="contenu_d_application_modifier.php?table_modifier=pages" method="post">
<input type="hidden" name="Modifier_page" value="<?php echo $id_de_la_page; ?>" />
<input type="submit" name="Mod_page000" value="Administrer la page" />
</form>
</td>

<td><a href="contenu_d_application_gestion.php?table_gestion=pages">Gestion des pages</a></td>

</tr>
</table>


<table style="float:right;">
<tr>

<td><a href="gestionnaire.php?visite=fin">D&#233;connexion</a></td>
<td><a href="page_administration.php">Administration</a></td>
</tr>
</table>

</div>

<?php } ?>

	</div>
</body>
</html>
<?php $Gestion_acessible=''; ?>