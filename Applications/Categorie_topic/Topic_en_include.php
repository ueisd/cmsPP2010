 <?php 
session_start();
include("noyau/configuration/base_de_donnee.php");

if(isset($_SESSION['autorisation']))
{
$table_categories_acessibles_table='Categorie_topic';
$id_table_categories_acessibles_table=$id_de_categorie_du_topic_selectionne;
include("noyau/Applications/categorie_d_utilisateurs/acces/acces_par_categorie_d_utilisateurs.php");
}
$adresse_de_la_derniere_page_avec_variables=$_SESSION['adresse_de_la_derniere_page_avec_variables'];


if(isset($_POST['Applications_en_include_modifier_table']) AND $_POST['Applications_en_include_modifier_table']=='topic')
{
include("Applications/Categorie_topic/topic/traitement/traitement.php");
}


if(isset($_POST['Applications_en_include_modifier_table']) AND $_POST['Applications_en_include_modifier_table']=='Categorie_topic' AND $_POST['Applications_en_include_modifier_id']==$id_de_categorie_du_topic_selectionne)
{
include("Applications/Categorie_topic/traitement/traitement.php");
}
?>



<?php include("Applications/Categorie_topic/style/Categorie_topic_css.php"); ?>


<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM Categorie_topic WHERE id='$id_de_categorie_du_topic_selectionne'");
while ($donnees = mysql_fetch_array($reponse) )
{
$id_modifier=$donnees['id'];
$afficher_titre=$donnees['afficher_titre'];
if($afficher_titre == 'rouge')
{ ?><h1 id="h1rouge"><?php echo $donnees['nom_de_categorie']; ?></h1><?php }
if($afficher_titre == 'noir')
{ ?><h1 id="h1noir"><?php echo $donnees['nom_de_categorie']; ?></h1><?php }
if($afficher_titre == 'non_centre')
{ ?><h1 id="non_centre"><?php echo $donnees['nom_de_categorie']; ?></h1><?php }
}
mysql_close();
?> 

<div id="topic_center">
<div id="lien_des_activites"> <?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM topic WHERE id_de_categorie_du_topic='$id_de_categorie_du_topic_selectionne' ORDER BY id DESC");
while ($donnees = mysql_fetch_array($reponse) )
{
?>
	<div class="activitediv">
<?php

if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ 
?>
<table>
<tr><td>
<form action="contenu_d_application_modifier.php?table_modifier=Categorie_topic/topic" method="post">
<input type="hidden" name="id_de_categorie_du_topic" value="<?php echo $id_de_categorie_du_topic_selectionne; ?>" />
<input type="hidden" name="Adresse_modifier_topic" value="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" />
<input type="hidden" name="Modifier_topic" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="Mod_topic000" value="Modifier" />
</form>
</td>

<td>
<form action="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" method="post">
<input type="hidden" name="id_de_categorie_du_topic" value="<?php echo $id_de_categorie_du_topic_selectionne; ?>" />
<input type="hidden" name="Supprimer_topic" value="<?php echo $donnees['id']; ?>" />
<input type="submit" name="Supr_topic000" value="Suprimer:" />
</form>
</td></tr>
</table>
<?php } ?>
	<a href="<?php echo $donnees['lien_du_topic']; ?>" class="lien_hover"><div class="contenu_du_lien"><div class="image_du_lien"><img src="image/topic/<?php echo $donnees['image_du_topic']; ?>" width="160" height="120" alt="Les camps" class="image_de _description" /></div>
		<div class="description_du_lien"><div class="titre"><?php echo $donnees['titre_du_topic']; ?></div>
		<p><?php echo $donnees['description_du_topic']; ?></p>
		</div></div></a>
	</div>

<?php }
mysql_close(); ?>

		</div>	
		</div>	

<?php
if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ 
?>
<center>
<table style="background-color:#ececec; border:4px double black;">
<tr>

<td valign="top">
<table style="background-color:#ececec;">
<form action="<?php echo $adresse_de_la_derniere_page_avec_variables; ?>" method="post" enctype="multipart/form-data">

<tr>
<td colspan="2"><center><strong>Nouveau topic</strong></center></td>
</tr>

<tr>
<td><label for="image">Photo du topic:</label></td>
<td><input type="file" name="image" /></td>
</tr>

<tr>
<td><label for="nom_du_topic">Titre du topic:</label></td>
<td><input type="text" name="titre_du_topic" /></td>
</tr>

<tr>
<td><label for="lien_du_topic">Lien du topic:</label></td>
<td><input type="text" name="lien_du_topic" /></td>
</tr>

<tr>
<td><label for="description_du_topic">Description du topic:</label></td>
<td><textarea name="description_du_topic"></textarea></td>
</tr>

<tr>
<td colspan="2">
<input type="hidden" name="id_de_categorie_du_topic" value="<?php echo $id_de_categorie_du_topic_selectionne; ?>" />
<input type="hidden" name="Nouveau_topic" value="valider" />
<input type="submit" name="Nouv_topic000" value="Enregistrer le nouveau topic" />
</td>
</tr>

</form>
</table>
</td>

<td style="background-color:#bbbbbb;" valign="top">
<center><strong>cat&#233;gories de topics</strong></center><br/>
<form action="contenu_d_application_modifier.php?table_modifier=Categorie_topic" method="post">
<input type="hidden" name="Modifier_categorie" value="<?php echo $id_modifier; ?>" />
<input type="submit" name="Mod_categorie000" value="Modifier la cat&#233;gorie de topic" />
</form></br>
<a href="contenu_d_application_gestion.php?table_gestion=Categorie_topic" >Gestion des cat&#233;gories de topics</a>
</td>

</tr>
</table>
</center>

<?php } ?>
<?php $Gestion_acessible=''; ?>