<?php 
session_start(); 
include("noyau/configuration/base_de_donnee.php");
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Le Petit Peuple</title>
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
<a href="<?php echo $_SESSION['adresse_de_la_derniere_page_avec_variables'];; ?>"><h3>Retour &agrave; la page</h3></a> 	

<?php
$_SESSION['administration_adresse_de_la_derniere_page_avec_variables']=$_SERVER['REQUEST_URI'];
$_SESSION['adresse_visionneur']=$_SERVER['REQUEST_URI'];

$table_de_l_application=$_GET['table_de_l_application'];
$id_contenu=$_GET['id_contenu'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");

$reponse = mysql_query("SELECT * FROM liste_des_applications WHERE table_de_l_application='$table_de_l_application' AND type_conteneur='page'");
while ($donnees = mysql_fetch_array($reponse) )
{
$Nom_de_variable_id=$donnees['Nom_de_variable_id'];
${$Nom_de_variable_id}=$id_contenu;
$adresse_include='Applications/' . $donnees['table_de_l_application'] . '/visionneur.php';
}

include($adresse_include);
?>

	</div>
</body>
</html>