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
		<link rel="stylesheet" media="screen" type="text/css" title="mpceci" href="Applications/Nos_videos/style/info_page.css" />
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
table
{
	width:100%;
}
#contenu
{
	position:absolute;
	top:140px; left:0px; 
	margin:0px; padding:0px;
}
.video
{
	
	width:400px;
	margin:auto;
  margin-left:40%;
	empty-cells:show;
	border-collapse:collapse;
	overflow:hidden;

}
.video td
{
	
}
.video_menutop
{
	height:35px;
	background-image:url("image/Frame_du_CMS/menu.jpg");
	background-repeat:repeat-x;
}
.video_menutop_type
{
	text-align:center;
	font-size:22px;
	color:#ffffff;
	font-weight:bold; 
	border-left:1px solid #3a5998;
	border-right:1px solid #3a5998;
	border-top:1px solid #3a5998;
	border-bottom:1px solid #f7f7f7;
}
.video_contenu
{
	background-color:#f7f7f7;
}
.video_contenu_menuleft
{
	width:400px;
	padding:0px;
	vertical-align:top;
	border-left:1px solid #bbbbbb;
	border-right:1px solid ##bbbbbb;
}
.video_contenu_menuleft embed
{
	margin:5px;
	margin-top:10px;
}
.video_header
{
	height:17px;
	background-color:#bbbbbb;
	border-left:1px solid #bbbbbb;
	border-right:1px solid #bbbbbb;
	border-top:1px solid #bbbbbb;
	border-bottom:1px solid #bbbbbb;
}
</style>
</style>
<![endif]-->
<?php include("Applications/entete/entete.php"); ?>
		<!-- Page Principal-->
	<div id="contenu">


<?php
$id_video=$_GET['video'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM videos WHERE id='$id_video'");
while ($donnees = mysql_fetch_array($reponse) )
{

$titre_video=$donnees['titre_video'];
$type_source_video=$donnees['type_source_video'];
$code_du_video=$donnees['code_du_video']; 

if($type_source_video=='natif')
{ ?>

<table class="video">
<tr class="video_menutop">
<td class="video_menutop_type"><?php echo $titre_video; ?></td>
</tr>
<tr class="video_contenu">
<td class="video_contenu_menuleft"> 





<script type='text/javascript' src='video/flv_player/swfobject.js'></script>



<script type='text/javascript' src='video/jwplayer5/swfobject.js'></script>

<div id='mediaspace'>This text will be replaced</div>

<script type='text/javascript'>
  var so = new SWFObject('video/jwplayer5/player.swf','ply','470','320','9','#000000');
  
  so.addParam('allowscriptaccess','always');

  
  so.addParam('allowfullscreen','true');
  so.addParam('allowscriptaccess','always');
  so.addParam('wmode','opaque');
  so.addVariable('file','http://www.lepetitpeuple.org/video/<?php echo $code_du_video; ?>');
  
  so.addVariable('plugins', 'fbit-1');
  so.addVariable('dock', 'true');

  
  so.addVariable('skin','http://www.lepetitpeuple.org/video/jwplayer5/skins/beelden.zip');
  so.write('mediaspace');
</script>


</td>
</tr>
<tr>
<td colspan="2"class="video_header"></td>
</tr>

</table>

<?php }


if($type_source_video=='code')
{ ?>

<table class="video">
<tr class="video_menutop">
<td class="video_menutop_type"><?php echo $titre_video; ?></td>
</tr>
<tr class="video_contenu">
<td class="video_contenu_menuleft"> 
<?php echo $code_du_video; ?>

</td>
</tr>
<tr>
<td colspan="2"class="video_header"></td>
</tr>

</table>

<?php }

} ?>			 

<?php
if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ ?>
<input type="text" name="lien_video_embed" value="<?php echo '<object type=text/html data=Applications/videos/page_des_videos/page_des_videos_en_include.php?video=' . $id_video . ' width=500px height=400px>
</object>'; ?>" />
<?php } ?>	
		
	</div>
</body>
</html>