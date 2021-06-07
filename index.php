<?php session_start(); 
include("noyau/configuration/base_de_donnee.php");
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Le Petit Peuple - Accueil</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<script type="text/javascript" src="noyau/style/csshover.js"></script>  
	</head>
	<body>	
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
	position:relative; top:20px;
}
</style>



<?php include("Applications/entete/entete.php"); ?>

<div id="contenu">	

<table>

<tr>
<td>
<?php include("Applications/banniere/application_banniere.php"); ?>
</td>
</tr>

<?php
 	$monfichier = fopen('Applications/compteur/compteur.txt', 'r+');
	$pages_vues = fgets($monfichier); 
 	$pages_vues++; 
 	fseek($monfichier, 0); 
 	fputs($monfichier, $pages_vues); 
 	fclose($monfichier);
 
?>


<?php 
$_SESSION['administration_adresse_de_la_derniere_page_avec_variables']=$_SERVER['REQUEST_URI'];
$_SESSION['adresse_de_la_derniere_page_avec_variables']=$_SERVER['REQUEST_URI'];
$_SESSION['adresse_de_la_derniere_page_sans_variables']=$_SERVER['PHP_SELF'] . '?page_numero=' . $_GET['page_numero'];
?>
	
		<!-- Page Principal-->
<tr>
<td>

	
		<?php $id_du_bloc='1'; include("Applications/blocs/central/application_bloc_central.php"); ?>

		<?php $id_du_bloc='4'; include("Applications/blocs/droite/application_bloc_droite.php"); ?>

	
	
</td>
</tr>
</table>

</div>

</body>
</html>