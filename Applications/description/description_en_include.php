 <?php 
session_start();
include("noyau/configuration/base_de_donnee.php");

if(isset($_SESSION['autorisation']))
{
$table_categories_acessibles_table='description';
$id_table_categories_acessibles_table=$description_id;
include("noyau/Applications/categorie_d_utilisateurs/acces/acces_par_categorie_d_utilisateurs.php");
}
$adresse_de_la_derniere_page_avec_variables=$_SESSION['adresse_de_la_derniere_page_avec_variables'];
?>
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

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM description WHERE id='$description_id'");
while ($donnees = mysql_fetch_array($reponse) )
{

if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ ?>

<table>
<tr>
<td>
<form action="contenu_d_application_modifier.php?table_modifier=description" method="post">
<input type="hidden" name="Adresse_modifier_description" value="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" />
<input type="hidden" name="Modifier_description" value="<?php echo $description_id; ?>" />
<input type="submit" name="Mod_description000" value="Modifier" />
</form>
</td>

<td>
<form action="contenu_d_application_gestion.php?table_gestion=description" method="post">
<input type="hidden" name="Supprimer_description" value="<?php echo $description_id; ?>" />
<input type="submit" name="Supr000_description" value="Suprimer" />
</form>
</td>
<td>
<a href="contenu_d_application_gestion.php?table_gestion=description">Gestion des descriptions</a>
</td></tr>
</table>

<?php } ?>

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

<?php } ?>
<?php $Gestion_acessible=''; ?>