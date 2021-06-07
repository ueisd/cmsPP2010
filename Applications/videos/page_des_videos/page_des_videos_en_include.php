<?php session_start(); 
include("noyau/configuration/base_de_donnee.php");
?>	
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
.video
{	
	width:400px;
	margin:auto;
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
  <div id='mediaspace'>This div will be replaced</div>
  <script type='text/javascript'>
  var s1 = new SWFObject('video/flv_player/player.swf','ply','470','320','9','#ffffff');
  s1.addParam('allowfullscreen','true');
  s1.addParam('allowscriptaccess','always');
  s1.addParam('wmode','opaque');
  s1.addParam('flashvars','&file=../<?php echo $code_du_video; ?>&backcolor=00FF00');
  s1.write('mediaspace');
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
</body>
</html>