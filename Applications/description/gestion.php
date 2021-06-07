<?php $adresse_description=$_SERVER['PHP_SELF']; ?>
<style type="text/css">
.info_page
{
	width:98%;
	margin:0px;
	margin-left:1%;
	margin-right:1%;
	margin-top:10px;
	margin-bottom:15px;
	empty-cells:show;
	border-collapse:collapse;
	overflow:hidden;
}
.info_page td
{
	
}
.info_page_menutop
{
	height:35px;
	background-image:url("image/Frame_du_CMS/menu.jpg");
	background-repeat:repeat-x;
}
.info_page_menutop_type
{
	text-align:center;
	border-left:1px solid #3a5998;
	border-right:1px solid #3a5998;
	border-top:1px solid #3a5998;
	border-bottom:1px solid #f7f7f7;
}
.info_page_menutop_titre
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
.info_page_contenu
{
	background-color:#f7f7f7;
}
.info_page_contenu_menuleft
{
	width:170px;
	padding:0px;
	vertical-align:top;
	border-left:1px solid #bbbbbb;
	border-right:1px solid #f7f7f7;
}
.info_page_contenu_menuleft img
{
	margin:5px;
	margin-right:10px;
	margin-top:10px;
}
.info_page_description
{
	vertical-align:top;
	overflow:hidden;
	border-left:1px solid #f7f7f7;
	border-right:1px solid #bbbbbb;
}
.info_page_description p
{
	margin:0px;
	margin-left:3px;
	margin-right:3px;
	padding:0px;
}
.info_page_description_type
{
	text-decoration:underline;
}
.info_page_header
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
include("Applications/description/traitement/traitement.php");
?>


<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM description ORDER BY id DESC");
while ($donnees = mysql_fetch_array($reponse) )
{
?>

<table>
<tr><td>
<form action="contenu_d_application_modifier.php?table_modifier=description" method="post">
Modifier:
<input type="hidden" name="Adresse_modifier_description" value="<?php echo $adresse_description; ?>" />
<input type="submit" name="Modifier_description" value="<?php echo $donnees['id']; ?>" />
</form>
</td>

<td>
<form action="contenu_d_application_gestion.php?table_gestion=description" method="post">
Supprimer:
<input type="submit" name="Supprimer_description" value="<?php echo $donnees['id']; ?>" />
</form>
</td>
<td>
<input type="text" name="code" value="<?php echo '<?php $description_id=' . 
$donnees['id'] . ';' . ' $adresse_description=$_SERVER[\'PHP_SELF\'];' . ' include \'description_en_include.php\'; ?>'; ?>" />
</td></tr>
</table>

<table class="info_page">

<tr class="info_page_menutop">
<td class="info_page_menutop_type">description</td>
<td class="info_page_menutop_titre"><?php echo $donnees['Titre_de_la_description']; ?></td>
</tr>

<tr class="info_page_contenu">
<td class="info_page_contenu_menuleft"><img src="image/description/<?php echo $donnees['image']; ?>" width="160" height="120" alt="Artisanat" /></td>
<td class="info_page_description"><p><span class="info_page_description_type">description: </span><?php echo $donnees['Texte_de_la_description']; ?></p></td>
</tr>

<tr>
<td colspan="2"class="info_page_header"></td>
</tr>

</table>

<?php }

include("Applications/description/nouveau.php");
?>