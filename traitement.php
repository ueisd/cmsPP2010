<?php session_start(); 
include("noyau/configuration/base_de_donnee.php");
$table_application='articles';
if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Le Petit Peuple - </title>
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
	position:absolute;
	top:35px; left:0px; 
	margin:0px; padding:0px;
}
</style>

<?php include("Applications/entete/entete.php"); ?> 

		<!-- Page Principal-->
	<div id="contenu">

<?php
include("Applications/articles/traitement/traitement.php");

if(isset($_POST['articles_nouveau']) and ($_POST['articles_nouveau']=='Enregistrer'))
{ ?>
Enregistr&#233;... 
<a href="article_nouveau.php">Envoyer un autre article</a>
<a href="article.php?article_id=<?php echo $article_id; ?>">Termin&#233; </a>
<?php } 

if(isset($_POST['articles_modifier']) and ($_POST['articles_modifier']=='Enregistrer'))
{
?>
<?php echo ' Enregistr&#233;... '; ?>
<a href="article.php?article_id=<?php echo $article_id; ?>">Termin&#233; </a>
<?php } 




?>

	</div>
</body>
</html>
<?php } ?>