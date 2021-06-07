<?php
include("noyau/configuration/base_de_donnee.php");

if(isset($_SESSION['autorisation']))
{
$id_application_pour_acces_par_categorie_d_utilisateurs = $article_id;
$table_application_pour_acces_par_categorie_d_utilisateurs = 'articles';
include("noyau/Applications/categorie_d_utilisateurs/acces/acces_par_categorie_d_utilisateurs.php");
}

if(isset($_POST['Applications_en_include_modifier_table']) AND $_POST['Applications_en_include_modifier_table']=='articles' AND $_POST['Applications_en_include_modifier_id']==$article_id)
{
include("Applications/articles/traitement/traitement.php");
}

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
 
$reponse = mysql_query("SELECT * FROM articles WHERE id='$article_id'");

while ($donnees = mysql_fetch_array($reponse) )
{
$article_id=$donnees['id'];
$style=$donnees['style'];
$titre=$donnees['titre'];
$date=$donnees['date'];
$afficher=$donnees['afficher'];
$image=$donnees['image'];
$alt=$donnees['alt'];
$article=$donnees['article'];
$description_de_l_image=$donnees['description_de_l_image'];
$auteure=$donnees['auteure'];
$source=$donnees['source'];
$article_id=$donnees['id'];
}







if($style=='complet' or $style=='')
{
?>


<style type="text/css">
.article
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
.article_top
{
	height:35px;
	background-image:url("image/Frame_du_CMS/menu.jpg");
	background-repeat:repeat-x;
}
.article_top_titre
{
	text-align:center;
	font-size:20px;
	font-weight:bold;
	color:white;
	border-left:1px solid #3a5998;
	border-right:1px solid #3a5998;
	border-top:1px solid #3a5998;
	border-bottom:1px solid #f7f7f7;
}
.article_top_source
{
	text-align:center;
	border-left:1px solid #3a5998;
	border-right:1px solid #3a5998;
	border-top:1px solid #3a5998;
	border-bottom:1px solid #f7f7f7;
}
.article_top_date
{
	text-align:center;
	font-size:18px; 
	font-weight:bold;
	color:black;
	border-left:1px solid #3a5998;
	border-right:1px solid #3a5998;
	border-top:1px solid #3a5998;
	border-bottom:1px solid #f7f7f7;
}
.article_top_titre
{
	text-align:center;
	border-left:1px solid #3a5998;
	border-right:1px solid #3a5998;
	border-top:1px solid #3a5998;
	border-bottom:1px solid #f7f7f7;
}
.article_contenu
{
	background-color:#f7f7f7;
	vertical-align:top; 
}
.article_contenu_texte p
{
	margin:10px;
	padding:0px;
}
<?php if(isset($article_montrer_image_taille) and ($article_montrer_image_taille=='reduit_image'))
{ ?>
.article_contenu_texte_image
{
	width:200px;
	float:left;
	margin:0px;
	margin-top:5px;
	margin-right:10px;
	margin-left:5px;
	padding:0px;
	background-color:#bbbbbb;
}
.article_contenu_texte_image img
{
	width:200px;
	margin:0px;
	margin-left:0px;
	margin-top:0px;
	float:top;
}
<?php } 
else { ?>
.article_contenu_texte_image
{
	width:432px;
	float:left;
	margin:0px;
	margin-top:5px;
	margin-right:10px;
	margin-left:5px;
	padding:0px;
	background-color:#bbbbbb;
}
.article_contenu_texte_image img
{
	margin:0px;
	margin-left:0px;
	margin-top:0px;
	float:top;
}
<?php } ?>
.article_contenu_texte_image_description
{
	float:left;
	margin:0px; 
	padding:0px;
}
.article_contenu_texte_image_description p
{
	margin:0px;
	margin-left:4px;
	margin-right:4px;
	margin-bottom:5px;
	padding:0px;
}
.article_contenu_texte
{
	
}
.article_header 
{
	height:25px;
	background-color:#bbbbbb;
	border-left:1px solid #bbbbbb;
	border-right:1px solid #bbbbbb;
	border-top:1px solid #bbbbbb;
	border-bottom:1px solid #bbbbbb;
}
.article_header_auteur
{
	text-align:center;
}
.article_header_titre 
{
	text-align:center;
}
.article_date_centre
{
	text-align:center;
}
</style> 
		
	<table class="article">
	<tr class="article_top">
<?php if(isset($article_montrer_image_taille) and ($article_montrer_image_taille=='reduit_image'))
{ ?>	
	<td colspan="2" class="article_top_titre"><?php echo $titre; ?></td>
	
<?php } else
{ ?>
	<td class="article_top_date">
	<?php 
$reponse = mysql_query("SELECT *, DAYOFWEEK(date) AS jour_de_la_semaine, DAYOFMONTH(date) AS jour_du_mois, MONTH(date) AS date_mois, 
YEAR(date) AS date_an, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DAYOFWEEK(date_fin) AS jour_de_la_semaine_fin, DAYOFMONTH(date_fin) AS jour_du_mois_fin, MONTH(date_fin) AS date_fin_mois, 
YEAR(date_fin) AS date_fin_an, DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') 
AS date_fin_heure, date_fin FROM articles WHERE id='$article_id'");

while ($donnees = mysql_fetch_array($reponse) )
{ ?>
Date: <?php $jour_fr = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"); 
    	$mois_fr = array("Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao&#251;t", "Septembre", "Octobre", "Novembre", "Decembre"); $Date_aujourdhui=date('Y-m-d'); 
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
	}}
}
?>
	</td>
	<td class="article_top_titre">titre: <?php echo $titre;?></td>
	
<?php } ?>
	</tr>
	<tr class="article_contenu">
	


<td colspan="4" class="article_contenu_texte">

<?php if(isset($afficher) and ($afficher=='news'))
{ ?>
<?php } 
else
{ ?>	
		<div class="article_contenu_texte_image"><img  src="
<?php if($image=='adresse')
{ echo "image/Frame_du_CMS/vierge.jpg"; }
else
{ echo 'image/article/' . $image;}
?>" 
	alt="<?php echo $alt;?>">
		<div class="article_contenu_texte_image_description"><p>
	<?php echo $description_de_l_image;?>
	</p> 
	</div>
	</div>
<?php } ?>


<?php
if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ ?>
<table>
<tr>

<td>
<form action="contenu_d_application_modifier.php?table_modifier=articles" method="post">
<input type="hidden" name="article_id" value="<?php echo $article_id;?>" />
<input type="submit" name="modifier" value="modifier" />
</form>
</td>

<td>
<form action="traitement.php" method="post">
<input type="hidden" name="article_id" value="<?php echo $article_id;?>" />
<input type="submit" name="articles_supprimer" value="supprimer" />
</form>
</td>

</tr>
</table>
<?php } ?>


		<p>
		<?php echo $article;?>
		</p>
	</td>
	
	
	</tr>
	<tr class="article_header">
	
<?php if(isset($article_montrer_image_taille) and ($article_montrer_image_taille=='reduit_image'))
{ ?>	
	<td class="article_date_centre">
<?php 
$reponse = mysql_query("SELECT *, DAYOFWEEK(date) AS jour_de_la_semaine, DAYOFMONTH(date) AS jour_du_mois, MONTH(date) AS date_mois, 
YEAR(date) AS date_an, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DAYOFWEEK(date_fin) AS jour_de_la_semaine_fin, DAYOFMONTH(date_fin) AS jour_du_mois_fin, MONTH(date_fin) AS date_fin_mois, 
YEAR(date_fin) AS date_fin_an, DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') 
AS date_fin_heure, date_fin FROM articles WHERE id='$article_id'");

while ($donnees = mysql_fetch_array($reponse) )
{ ?>
Date: <?php $jour_fr = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"); 
    	$mois_fr = array("Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao&#251;t", "Septembre", "Octobre", "Novembre", "Decembre"); $Date_aujourdhui=date('Y-m-d'); 
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
	}}
}
?>	
 </td>
	
<?php } else
{ ?>

	<td class="article_header_auteur" >auteur(e): <?php echo $auteure;?></td>
	<td class="article_header_source" >source: <?php echo $source;?></td>

<?php } ?>


	</tr>
	</table>
<?php	}
elseif($style=='aucun_style')
{ ?>



<style type="text/css">
.article1
{

	margin:0px;

	margin-top:10px;
	margin-bottom:15px;
	empty-cells:show;
	border-collapse:collapse;
	overflow:hidden;
}
.article_contenu
{
	background-color:#f7f7f7;
	vertical-align:top; 
}

<?php if(isset($article_montrer_image_taille) and ($article_montrer_image_taille=='reduit_image'))
{ ?>
.article_contenu_texte_image
{
	width:200px;
	float:left;
	margin:0px;
	margin-top:5px;
	margin-right:10px;
	margin-left:5px;
	padding:0px;
	background-color:#bbbbbb;
}
.article_contenu_texte_image img
{
	width:200px;
	margin:0px;
	margin-left:0px;
	margin-top:0px;
	float:top;
}
<?php } 
else { ?>
.article_contenu_texte_image
{
	width:432px;
	float:left;
	margin:0px;
	margin-top:5px;
	margin-right:10px;
	margin-left:5px;
	padding:0px;
	background-color:#bbbbbb;
}
.article_contenu_texte_image img
{
	margin:0px;
	margin-left:0px;
	margin-top:0px;
	float:top;
}
<?php } ?>

</style> 
		
	<table class="article1">
	
	<tr>

<td colspan="4">

<?php if(isset($afficher) and ($afficher=='news'))
{ ?>
<?php } 
else
{ ?>	
		<div class="article_contenu_texte_image"><img  src="
<?php if($image=='adresse')
{ echo "image/Frame_du_CMS/vierge.jpg"; }
else
{ echo 'image/article/' . $image;}
?>" 
	alt="<?php echo $alt;?>">
	
	</div>
<?php } ?>	

<?php
if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ ?>
<table>
<tr>

<td>
<form action="contenu_d_application_modifier.php?table_modifier=articles" method="post">
<input type="hidden" name="article_id" value="<?php echo $article_id;?>" />
<input type="submit" name="modifier" value="modifier" />
</form>
</td>

<td>
<form action="traitement.php" method="post">
<input type="hidden" name="article_id" value="<?php echo $article_id;?>" />
<input type="submit" name="articles_supprimer" value="supprimer" />

</form> 
</td>

</tr>
</table>
<?php } ?>

		<p>
		<?php echo $article;?>

		</p>
	</td>
	</tr>

	</table>
<?php }	
	

mysql_close(); // D&eacute;connexion de MySQL
?>
<?php $Gestion_acessible=''; ?> 	