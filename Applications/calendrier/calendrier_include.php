<?php
session_start();
include("noyau/configuration/base_de_donnee.php");
if($_GET['visite']=="fin")
{ session_destroy();}

?>

<style>
<?php include("Applications/calendrier/calendrier.css"); ?>
#en_include
{
width:100%;
float:left;
position:relative;
}
#imagedefond
{
width:100%;
position:relative;
}
</style>

<?php $adresse_de_la_derniere_page_sans_variables=$_SESSION['adresse_de_la_derniere_page_sans_variables']; ?>
 


<div id="en_include">
<img src="image/Frame_du_CMS/fond1.JPG" id="imagedefond"/>
<div id="contenu">
<div id="contenu2">


<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 


$date_choisie=date("Y-m");

if(isset($_GET['date']))
{
$date_choisie=$_GET['date'];
}

$date_choisie_explosee = explode("-", $date_choisie);

$annee_choisie = $date_choisie_explosee[0];
$mois_choisie = $date_choisie_explosee[1];
$mois_calendrier = $mois_choisie;

$nombre_de_jour_du_mois = date("t", mktime(0, 0, 0, $mois_choisie, 1, $annee_choisie));
$premier_jour_de_la_semaine_lundi = date("N", mktime(0, 0, 0, $mois_choisie, 1, $annee_choisie));
$mois_sans_zero_choisie = date("n", mktime(0, 0, 0, $mois_choisie, 1, $annee_choisie));

if($premier_jour_de_la_semaine_lundi==7)
{
$premier_jour_de_la_semaine=1;
}
else
{
$premier_jour_de_la_semaine=$premier_jour_de_la_semaine_lundi+1;
}

$date_moin = $date_obtenue = date("Y-m", mktime(0, 0, 0, $mois_choisie - 1 ,1 , $annee_choisie ));
$date_plus = $date_obtenue = date("Y-m", mktime(0, 0, 0, $mois_choisie + 1 ,1 , $annee_choisie ));



$tableau_des_noms_de_mois=array();
$tableau_des_noms_de_mois[1]='Janvier';
$tableau_des_noms_de_mois[2]='F&#233;vrier';
$tableau_des_noms_de_mois[3]='Mars';
$tableau_des_noms_de_mois[4]='Avril';
$tableau_des_noms_de_mois[5]='Mai';
$tableau_des_noms_de_mois[6]='Juin';
$tableau_des_noms_de_mois[7]='Juillet';
$tableau_des_noms_de_mois[8]='Ao&#251;t';
$tableau_des_noms_de_mois[9]='Septembre';
$tableau_des_noms_de_mois[10]='Octobre';
$tableau_des_noms_de_mois[11]='Novembre';
$tableau_des_noms_de_mois[12]='D&#233;cembre';


$titremois = $tableau_des_noms_de_mois[$mois_sans_zero_choisie];
$titreannee = $annee_choisie;


$tableau_des_jours=array();
for ($compteur = 1 ; $compteur < $premier_jour_de_la_semaine ; $compteur++)
{
$tableau_des_jours[$compteur]=0;
}

$compteur=$premier_jour_de_la_semaine;
for ($jour = 1 ; $jour < $nombre_de_jour_du_mois+1 ; $jour++)
{
$tableau_des_jours[$compteur]=$jour;
$compteur++;
}

$jn1 = $tableau_des_jours[1];
$jn2 = $tableau_des_jours[2];
$jn3 = $tableau_des_jours[3];
$jn4 = $tableau_des_jours[4];
$jn5 = $tableau_des_jours[5];
$jn6 = $tableau_des_jours[6];
$jn7 = $tableau_des_jours[7];
$jn8 = $tableau_des_jours[8];
$jn9 = $tableau_des_jours[9];
$jn10 = $tableau_des_jours[10];
$jn11 = $tableau_des_jours[11];
$jn12 = $tableau_des_jours[12];
$jn13 = $tableau_des_jours[13];
$jn14 = $tableau_des_jours[14];
$jn15 = $tableau_des_jours[15];
$jn16 = $tableau_des_jours[16];
$jn17 = $tableau_des_jours[17];
$jn18 = $tableau_des_jours[18];
$jn19 = $tableau_des_jours[19];
$jn20 = $tableau_des_jours[20];
$jn21 = $tableau_des_jours[21];
$jn22 = $tableau_des_jours[22];
$jn23 = $tableau_des_jours[23];
$jn24 = $tableau_des_jours[24];
$jn25 = $tableau_des_jours[25];
$jn26 = $tableau_des_jours[26];
$jn27 = $tableau_des_jours[27];
$jn28 = $tableau_des_jours[28];
$jn29 = $tableau_des_jours[29];
$jn30 = $tableau_des_jours[30];
$jn31 = $tableau_des_jours[31];
$jn32 = $tableau_des_jours[32];
$jn33 = $tableau_des_jours[33];
$jn34 = $tableau_des_jours[34];
$jn35 = $tableau_des_jours[35];
$jn36 = $tableau_des_jours[36];
$jn37 = $tableau_des_jours[37];
?>



<?php
if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ ?>
 
<div id="menu_formulaire">
<table>

<tr>
<td>
<form action="calendrier.php" method="post">
<input type="hidden" name="modifier" value="ok" />
<input type="hidden" name="modifierselected" value="1" />
<input type="submit" value="modifier" /> 
</form>
</td>

<td>
<form action="calendrier.php" method="post">
<input type="hidden" name="suprimer1" value="ok" />
<input type="hidden" name="suprimerid1" value="1" />
<input type="submit" value="suprimer" /> 
</form>
</td>
</tr>

<tr>
<td><a href="contenu_d_application_nouveau.php?table_nouveau=articles">nouvel article</a></td>
</tr>

</table>
</div>
 
<?php } ?>






<table id="moisselectionne"><tr>  
<td class="fleche_suivant"> <a href="?page_numero=<?php echo $id_de_la_page; ?>&date=<?php echo $date_moin; ?>"><img src="image/Frame_du_CMS/gauche.png" /></a> </td>
<td id="tdmois"><span id="titremois"><?php echo $titremois; ?></span></td>  
<td id="tdannee"><span id="titreannee"><?php echo $titreannee; ?></span></td>  
<td><a href="<?php echo $adresse_de_la_derniere_page_sans_variables; ?>">Mois actuel</a></td> 
<td class="fleche_suivant"> <a href="?page_numero=<?php echo $id_de_la_page; ?>&date=<?php echo $date_plus; ?>"><img src="image/Frame_du_CMS/droite.png" /> </a> </td> 
</tr></table>





 	
<div id="calendrier_afficher">
<table id="affichertable">
<tr>
<td> <?php if($jn1!=0){ ?> <span class="aff_jour">Dimanche</span> <span class="aff_num"><?php echo $jn1; ?></span> <?php } ?> </td>
<td> <?php if($jn2!=0){ ?> <span class="aff_jour">Lundi</span> <span class="aff_num"><?php echo $jn2; ?></span> <?php } ?> </td>
<td> <?php if($jn3!=0){ ?> <span class="aff_jour">Mardi</span> <span class="aff_num"><?php echo $jn3; ?></span> <?php } ?> </td>
<td> <?php if($jn4!=0){ ?> <span class="aff_jour">Mercredi</span> <span class="aff_num"><?php echo $jn4; ?></span> <?php } ?> </td>
<td> <?php if($jn5!=0){ ?> <span class="aff_jour">Jeudi</span> <span class="aff_num"><?php echo $jn5; ?></span> <?php } ?> </td>
<td> <?php if($jn6!=0){ ?> <span class="aff_jour">Vendredi</span> <span class="aff_num"><?php echo $jn6; ?></span> <?php } ?> </td>
<td> <?php if($jn7!=0){ ?> <span class="aff_jour">Samedi</span> <span class="aff_num"><?php echo $jn7; ?></span> <?php } ?> </td>
</tr>
<tr>
<td class="textetd"> <?php if($jn1!=0){ ?> <span class="aff_texte"><?php 
$jourcase=$jn1; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> <?php } ?> </td>

<td class="textetd"> <?php if($jn2!=0){ ?> <span class="aff_texte"><?php 
$jourcase=$jn2; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> <?php } ?> </td>

<td class="textetd"> <?php if($jn3!=0){ ?> <span class="aff_texte"><?php 
$jourcase=$jn3; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> <?php } ?> </td>

<td class="textetd"> <?php if($jn4!=0){ ?> <span class="aff_texte"><?php 
$jourcase=$jn4; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> <?php } ?> </td>

<td class="textetd"> <?php if($jn5!=0){ ?> <span class="aff_texte"><?php 
$jourcase=$jn5; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php }  ?></span> <?php } ?> </td>

<td class="textetd"> <?php if($jn6!=0){ ?> <span class="aff_texte"><?php 
$jourcase=$jn6; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?> </span> <?php } ?> </td>

<td class="textetd"> <?php if($jn7!=0){ ?> <span class="aff_texte"><?php 
$jourcase=$jn7; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> <?php } ?> </td>
</tr>
<tr> 
<td> <span class="aff_jour">Dimanche</span> <span class="aff_num"><?php echo $jn8; ?></span> </td>
<td> <span class="aff_jour">Lundi</span> <span class="aff_num"><?php echo $jn9; ?></span> </td>
<td> <span class="aff_jour">Mardi</span> <span class="aff_num"><?php echo $jn10; ?></span> </td>
<td> <span class="aff_jour">Mercredi</span> <span class="aff_num"><?php echo $jn11; ?></span> </td>
<td> <span class="aff_jour">Jeudi</span> <span class="aff_num"><?php echo $jn12; ?></span> </td>
<td> <span class="aff_jour">Vendredi</span> <span class="aff_num"><?php echo $jn13; ?></span> </td>
<td> <span class="aff_jour">Samedi</span> <span class="aff_num"><?php echo $jn14; ?></span> </td>
</tr>
<tr>
<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn8; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn9; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn10; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn11; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn12; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn13; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>
<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn14; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php }  ?></span></td>

</tr>
<tr>
<td> <span class="aff_jour">Dimanche</span> <span class="aff_num"><?php echo $jn15; ?></span> </td>
<td> <span class="aff_jour">Lundi</span> <span class="aff_num"><?php echo $jn16; ?></span> </td>
<td> <span class="aff_jour">Mardi</span> <span class="aff_num"><?php echo $jn17; ?></span> </td>
<td> <span class="aff_jour">Mercredi</span> <span class="aff_num"><?php echo $jn18; ?></span> </td>
<td> <span class="aff_jour">Jeudi</span> <span class="aff_num"><?php echo $jn19; ?></span> </td>
<td> <span class="aff_jour">Vendredi</span> <span class="aff_num"><?php echo $jn20; ?></span> </td>
<td> <span class="aff_jour">Samedi</span> <span class="aff_num"><?php echo $jn21; ?></span> </td>
</tr>
<tr>
<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn15; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn16; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php }  ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn17; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn18; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn19; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn20; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn21; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

</tr>
<tr>
<td> <span class="aff_jour">Dimanche</span> <span class="aff_num"><?php echo $jn22; ?></span> </td>
<td> <span class="aff_jour">Lundi</span> <span class="aff_num"><?php echo $jn23; ?></span> </td>
<td> <span class="aff_jour">Mardi</span> <span class="aff_num"><?php echo $jn24; ?></span> </td>
<td> <span class="aff_jour">Mercredi</span> <span class="aff_num"><?php echo $jn25; ?></span> </td>
<td> <span class="aff_jour">Jeudi</span> <span class="aff_num"><?php echo $jn26; ?></span> </td>
<td> <span class="aff_jour">Vendredi</span> <span class="aff_num"><?php echo $jn27; ?></span> </td>
<td> <span class="aff_jour">Samedi</span> <span class="aff_num"><?php echo $jn28; ?></span> </td>
</tr>
<tr>
<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn22; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn23; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn24; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn25; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn26; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn27; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

<td class="textetd"><span class="aff_texte"><?php 
$jourcase=$jn28; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span></td>

</tr>
<tr>
<td> <span class="aff_jour">dimanche</span> <span class="aff_num"><?php echo $jn29; ?></span> </td>
<?php if($jn30!=0){ ?> <td> <span class="aff_jour">Lundi</span> <span class="aff_num"><?php echo $jn30; ?></span> </td> <?php } ?> 
<?php if($jn31!=0){ ?> <td> <span class="aff_jour">Mardi</span> <span class="aff_num"><?php echo $jn31; ?></span> </td> <?php } ?> 
<?php if($jn32!=0){ ?> <td> <span class="aff_jour">Mercredi</span> <span class="aff_num"><?php echo $jn32; ?></span> </td> <?php } ?> 
<?php if($jn33!=0){ ?> <td> <span class="aff_jour">Jeudi</span> <span class="aff_num"><?php echo $jn33; ?></span> </td> <?php } ?> 
<?php if($jn34!=0){ ?> <td> <span class="aff_jour">Vendredi</span> <span class="aff_num"><?php echo $jn34; ?></span> </td> <?php } ?> 
<?php if($jn35!=0){ ?> <td> <span class="aff_jour">Samedi</span> <span class="aff_num"><?php echo $jn35; ?></span> </td> <?php } ?> 
</tr>
<tr>
<td class="textetd"> <span class="aff_texte"><?php 
$jourcase=$jn29; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> </td>

 <?php if($jn30!=0){ ?> <td class="textetd"> <span class="aff_texte"><?php 
 $jourcase=$jn30; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> </td> <?php } ?> 

 <?php if($jn31!=0){ ?> <td class="textetd"> <span class="aff_texte"><?php 
 $jourcase=$jn31; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> </td> <?php } ?>
 
 <?php if($jn32!=0){ ?> <td class="textetd"> <span class="aff_texte"><?php 
 $jourcase=$jn32; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> </td> <?php } ?> 

 <?php if($jn33!=0){ ?> <td class="textetd"> <span class="aff_texte"><?php 
 $jourcase=$jn33; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> </td> <?php } ?> 

 <?php if($jn34!=0){ ?> <td class="textetd"> <span class="aff_texte"><?php 
 $jourcase=$jn34; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> </td> <?php } ?> 

 <?php if($jn35!=0){ ?> <td class="textetd"> <span class="aff_texte"><?php 
 $jourcase=$jn35; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> </td> <?php } ?> 

</tr>
<?php if($jn36!=0){ ?> <tr> <?php } ?>
<?php if($jn36!=0){ ?> <td> <span class="aff_jour">Dimanche</span> <span class="aff_num"><?php echo $jn36; ?></span> </td> <?php } ?> 
<?php if($jn37!=0){ ?> <td> <span class="aff_jour">Lundi</span> <span class="aff_num"><?php echo $jn37; ?></span> </td> <?php } ?> 
<?php if($jn36!=0){ ?> </tr> <?php } ?>
<?php if($jn36!=0){ ?> <tr> <?php } ?>
<?php if($jn36!=0){ ?> <td class="textetd"> <span class="aff_texte"><?php 
$jourcase=$jn36; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> </td> <?php } ?> 

<?php if($jn37!=0){ ?> <td class="textetd"> <span class="aff_texte"><?php 
$jourcase=$jn37; if($jourcase<'10'){$jourcase='0' . $jourcase;} $date_case=$titreannee . '-' . $mois_calendrier . '-' . $jourcase; 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$retour = mysql_query("SELECT *, articles.titre AS titre, categories_des_applications_J_applications.id_application, categories_des_calendriers.categorie, DATE_FORMAT(date, '%Y-%m-%d') AS date_An_Mois_jour, DATE_FORMAT(date, '%k:%i') AS date_heure, date, 
DATE_FORMAT(date_fin, '%Y-%m-%d') AS date_fin_An_Mois_jour, DATE_FORMAT(date_fin, '%k:%i') AS date_fin_heure FROM articles, categories_des_applications_J_applications, categories_des_calendriers WHERE 
(DATE_FORMAT(date, '%Y-%m-%d') = '$date_case' OR('$date_case'>=DATE_FORMAT(date, '%Y-%m-%d') AND '$date_case'<=DATE_FORMAT(date_fin, '%Y-%m-%d') )) AND (articles.id=categories_des_applications_J_applications.id_application 
AND categories_des_applications_J_applications.categorie=categories_des_calendriers.categorie AND categories_des_calendriers.calendrier=$calendrier_id) AND categories_des_applications_J_applications.nom_de_table_de_l_application='articles' ORDER BY date");
while ($donnees = mysql_fetch_array($retour) )
{ ?>
<a href="visionneur.php?id_contenu=<?php echo $donnees['id']; ?>&amp;table_de_l_application=articles"><?php echo $donnees['titre']; 
if($donnees['date_heure']!='0:00' AND ($donnees['date_fin_An_Mois_jour']=='0000-00-00' OR $donnees['date_fin_An_Mois_jour']==$donnees['date_An_Mois_jour'])){echo ' &agrave; ' . $donnees['date_heure'];}
if($donnees['date_heure']!='0:00' AND $date_case==$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!='0000-00-00'){echo ' Commence &agrave; ' . $donnees['date_heure'];}
if($donnees['date_fin_heure']!='0:00' AND $date_case==$donnees['date_fin_An_Mois_jour'] AND $donnees['date_fin_An_Mois_jour']!=$donnees['date_An_Mois_jour'] ){echo ' termine &agrave; ' . $donnees['date_fin_heure'];} ?></a> <br/>
<?php } ?></span> </td> <?php } ?> 

<?php if($jn36!=0){ ?> </tr> <?php } ?>
</table>
</div>






</div>
</div>
</div>