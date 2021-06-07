<?php session_start(); 
include("noyau/configuration/base_de_donnee.php");


$article_id=$article_id;

if(isset($_POST['Applications_en_include_modifier_table']) AND $_POST['Applications_en_include_modifier_table']=='articles' AND $_POST['Applications_en_include_modifier_id']==$article_id)
{
include("Applications/articles/traitement/traitement.php");
}


$_SESSION['administration_adresse_de_la_derniere_page_avec_variables']=$_SERVER['REQUEST_URI'];


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
 

$reponse = mysql_query("SELECT * FROM articles WHERE id='$article_id'");
while ($donnees = mysql_fetch_array($reponse) )
{
if($donnees['afficher']=='' OR $donnees['afficher']=='article')
{ 

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT *, DAYOFWEEK(date) AS jour_de_la_semaine, DAYOFMONTH(date) AS jour_du_mois, MONTH(date) AS date_mois, 
YEAR(date) AS date_an, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DAYOFWEEK(date_fin) AS jour_de_la_semaine_fin, DAYOFMONTH(date_fin) AS jour_du_mois_fin, MONTH(date_fin) AS date_fin_mois, 
YEAR(date_fin) AS date_fin_an, DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure, date_fin FROM articles WHERE id='$article_id'"); // Requ&#195;&#170;te SQL


while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<?php $article_id=$donnees['id'];
 if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{?>
<form action="traitement.php" method="post">
<input type="hidden" name="article_id" value="<?php echo $article_id;?>" />
<input type="submit" name="articles_supprimer" value="supprimer" />
</form> 
<form action="contenu_d_application_modifier.php?table_modifier=articles" method="post">
<input type="hidden" name="article_id" value="<?php echo $article_id;?>" />
<input type="submit" name="modifier" value="modifier" />
<input type="text" name="rien" value="<?php echo $article_id; ?>" /> 
</form> 
<?php } ?>
	
	<?php include("Applications/articles/style/css_article.php") ?>
	<table class="article">
	<tr class="article_top">
	<td class="article_top_date">Date: <?php $jour_fr = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"); 
    	$mois_fr = array("Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao&ucirc;t", "Septembre", "Octobre", "Novembre", "D&eacute;cembre"); $Date_aujourdhui=date('Y-m-d'); 
    	if($donnees['date_An_Mois_jour']==$Date_aujourdhui){ 
    	if($donnees['date_An_Mois_jour']==$donnees['date_fin_An_Mois_jour']){}elseif($donnees['date_fin']!='0000-00-00 00:00:00'){echo ' de ';}
    	echo "Aujourd'hui"; if($donnees['date_heure']=='0:00'){}else{
    	if($donnees['date_An_Mois_jour']==$donnees['date_fin_An_Mois_jour']){echo ' de ';}else{echo ' &agrave; ';} echo $donnees['date_heure'];} } 
	else { 
	echo $jour_fr[$donnees['jour_de_la_semaine']-1]; echo ' ' . $donnees['jour_du_mois']; echo ' ' . $mois_fr[$donnees['date_mois']-1]; echo ' ' . $donnees['date_an']; 
	if($donnees['date_heure']=='0:00'){}else{ 
	if($donnees['date_An_Mois_jour']==$donnees['date_fin_An_Mois_jour']){echo ' de ';}else{echo ' &agrave; ';}
	 echo $donnees['date_heure'];}
	 }
	 if($donnees['date_fin']=='0000-00-00 00:00:00'){}else{
	 if($donnees['date_An_Mois_jour']==$donnees['date_fin_An_Mois_jour']){echo ' &agrave; ' . $donnees['date_fin_heure'];}else{
	 echo ', &agrave; ' . $jour_fr[$donnees['jour_de_la_semaine_fin']-1]; echo ' ' . $donnees['jour_du_mois_fin']; echo ' ' . $mois_fr[$donnees['date_fin_mois']-1]; echo ' ' . $donnees['date_fin_an']; 
	if($donnees['date_fin_heure']=='0:00'){}else{echo ' &agrave; ' . $donnees['date_fin_heure'];}
	}}?>
	</td>
	<td class="article_top_titre">titre: <?php echo $donnees['titre'];?></td>
	</tr>
	<tr class="article_contenu">
	<td colspan="4" class="article_contenu_texte">
		<div class="article_contenu_texte_image"><img  src="
<?php if($donnees['image']=='adresse')
{ echo "image/Frame_du_CMS/vierge.jpg"; }
else
{ echo 'image/article/' . $donnees['image'];}
?>" 
	alt="<?php echo $donnees['alt'];?>">
		<div class="article_contenu_texte_image_description"><p>
	<?php echo $donnees['description_de_l_image'];?>
	</p> 
	</div>
	</div>
		<p>
		<?php echo $donnees['article'];?>
		</p>
	</td>
	</tr>
	<tr class="article_header">
	<td class="article_header_auteur" >auteur(e): <?php echo $donnees['auteure'];?></td>
	<td class="article_header_source" >source: <?php echo $donnees['source'];?></td>
	</tr>
	</table>
<?php }






}
elseif($donnees['afficher']=='news')
{ 

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
 
$reponse = mysql_query("SELECT *, DAYOFWEEK(date) AS jour_de_la_semaine, DAYOFMONTH(date) AS jour_du_mois, MONTH(date) AS date_mois, 
YEAR(date) AS date_an, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DAYOFWEEK(date_fin) AS jour_de_la_semaine_fin, DAYOFMONTH(date_fin) AS jour_du_mois_fin, MONTH(date_fin) AS date_fin_mois, 
YEAR(date_fin) AS date_fin_an, DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure, date_fin FROM articles WHERE id='$article_id'"); 


while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<?php $article_id=$donnees['id'];
 if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{?>
<form action="traitement.php" method="post">
<input type="hidden" name="article_id" value="<?php echo $article_id;?>" />
<input type="submit" name="articles_supprimer" value="supprimer" />
</form> 
<form action="contenu_d_application_modifier.php?table_modifier=articles" method="post">
<input type="hidden" name="article_id" value="<?php echo $article_id;?>" />
<input type="submit" name="modifier" value="modifier" />
<input type="text" name="rien" value="<?php echo $article_id; ?>" /> 
</form> 
<?php } ?>
	
	<?php include("Applications/articles/style/css_article.php") ?>
	<table class="article">
	<tr class="article_top">
	<td class="article_top_titre">titre: <?php echo $donnees['titre'];?></td>
	</tr>
	<tr class="article_contenu">
	<td colspan="4" class="article_contenu_texte">

		<p>
		<?php echo $donnees['article'];?>
		</p>
	</td>
	</tr>
	<tr class="article_header">
	<td class="article_header_auteur" >Date: <?php $jour_fr = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"); 
    	$mois_fr = array("Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao&#230;&#178;&#161;t", "Septembre", "Octobre", "Novembre", "Decembre"); $Date_aujourdhui=date('Y-m-d'); 
    	if($donnees['date_An_Mois_jour']==$Date_aujourdhui){ 
    	if($donnees['date_An_Mois_jour']==$donnees['date_fin_An_Mois_jour']){}elseif($donnees['date_fin']!='0000-00-00 00:00:00'){echo ' de ';}
    	echo "Aujourd'hui"; if($donnees['date_heure']=='0:00'){}else{
    	if($donnees['date_An_Mois_jour']==$donnees['date_fin_An_Mois_jour']){echo ' de ';}else{echo ' &agrave; ';} echo $donnees['date_heure'];} } 
	else { 
	echo $jour_fr[$donnees['jour_de_la_semaine']-1]; echo ' ' . $donnees['jour_du_mois']; echo ' ' . $mois_fr[$donnees['date_mois']-1]; echo ' ' . $donnees['date_an']; 
	if($donnees['date_heure']=='0:00'){}else{ 
	if($donnees['date_An_Mois_jour']==$donnees['date_fin_An_Mois_jour']){echo ' de ';}else{echo ' &agrave; ';}
	 echo $donnees['date_heure'];}
	 }
	 if($donnees['date_fin']=='0000-00-00 00:00:00'){}else{
	 if($donnees['date_An_Mois_jour']==$donnees['date_fin_An_Mois_jour']){echo ' &agrave; ' . $donnees['date_fin_heure'];}else{
	 echo ', &agrave; ' . $jour_fr[$donnees['jour_de_la_semaine_fin']-1]; echo ' ' . $donnees['jour_du_mois_fin']; echo ' ' . $mois_fr[$donnees['date_fin_mois']-1]; echo ' ' . $donnees['date_fin_an']; 
	if($donnees['date_fin_heure']=='0:00'){}else{echo ' &agrave; ' . $donnees['date_fin_heure'];}
	}}?>
	</td> 
	</tr>
	</table>
<?php }


	



}
}
mysql_close(); ?>