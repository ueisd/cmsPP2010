<?php session_start(); 
include("noyau/configuration/base_de_donnee.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Le Petit Peuple - Stage humanitaire 2009</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<script type="text/javascript" src="noyau/style/csshover.js"></script> 
		<link rel="stylesheet" media="screen" type="text/css" title="mpceci" href="Applications/videos/style/info_page.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="mpceci" href="Applications/videos/style/video.css" />
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
	position:absolute;
	top:40px; left:0px; 
	margin:0px; padding:0px;
}
a
{
	text-decoration:none;
}
</style>

<?php include("Applications/entete/entete.php"); ?> 

		<!-- Page Principal-->
	<div id="contenu">

<table class="video">
<tr class="video_menutop">
<td class="video_menutop_type">Tous les vid&#233;os du Petit Peuple</td>
</tr>
<tr class="video_contenu">
<td class="video_contenu_menuleft">

<?php 
include("Applications/videos/traitement/traitement.php");


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM videos ORDER BY id");
while ($donnees = mysql_fetch_array($reponse) )
{ 

if(isset($_SESSION['autorisation']) and(($_SESSION['autorisation'])=='superadministrateur') and(($_GET['visite'])!='fin'))
{ ?>
<table class="video_table">
<tr><td>Suppr:</td>
<td><form action="application.php?table_de_l_application=videos" method="post">
<input type="submit" name="supprimer_video" value="<?php echo $donnees['id']; ?>" />
</form></td>
<td>Mod:</td>
<td><form action="contenu_d_application_modifier.php?table_modifier=videos" method="post">
<input type="submit" name="modifier_video_1" value="<?php echo $donnees['id']; ?>" />
</form></td></tr>
<tr><td colspan="4">
<a href="application.php?table_de_l_application=videos/page_des_videos&amp;video=<?php echo $donnees['id']; ?>" class="video_contenu_menuleft_a" ><div class="titre_video"><p><?php echo $donnees['titre_video']; ?></p></div> 
<img src="image/video/<?php echo $donnees['adresse_image']; ?>" width="160" height="120" alt="Entrevue du Petit Peuple &agrave; TVBL" class="video_contenu_menuleft_a_img"/></a>
</td></tr>
</table>
<?php } 
else
{ ?>

<a href="application.php?table_de_l_application=videos/page_des_videos&amp;video=<?php echo $donnees['id']; ?>" class="video_contenu_menuleft_a" ><div class="titre_video"><p><?php echo $donnees['titre_video']; ?></p></div> 
<img src="image/video/<?php echo $donnees['adresse_image']; ?>" width="160" height="120" alt="Entrevue du Petit Peuple &agrave; TVBL" class="video_contenu_menuleft_a_img"/></a>

<?php } ?>

<?php } ?>

<?php include("Applications/videos/nouveau.php"); ?>


</td>
</tr>	
</table>

		
</div>
	</body>
</html>