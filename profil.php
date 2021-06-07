<?php 
session_start();
include("noyau/configuration/base_de_donnee.php");

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM utilisateurs");
while ($donnees = mysql_fetch_array($reponse) )
{
if((isset($_POST['password']) and(($_POST['password'])==$donnees['mot_de_passe'])) and (isset($_POST['nom']) and(($_POST['nom'])==$donnees['nom'])))
{ 
$_SESSION['id_utilisateur']=$donnees['id'];
$_SESSION['autorisation']=$donnees['categorie_d_utilisateur']; 
$_SESSION['nom_utilisateur']=$donnees['nom'];


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");

$id_utilisateur=$_SESSION['id_utilisateur'];
$array_categorie_d_utilisateurs_du_connecte = array();

$reponse2 = mysql_query("SELECT categorie FROM categorie_des_utilisateurs_J_utilisateurs WHERE utilisateurs='$id_utilisateur'");
while ($donnees2 = mysql_fetch_array($reponse2) )
{
$id_de_categorie=$donnees2['categorie'];
array_push ($array_categorie_d_utilisateurs_du_connecte, "$id_de_categorie");
}

$_SESSION['categorie_d_utilisateurs_du_connecte']=$array_categorie_d_utilisateurs_du_connecte;

}
}
mysql_close();
 ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Le Petit Peuple - Profil</title>
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

	</div>
</body>
</html>