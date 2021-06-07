<?php 
include("Applications/blocs/style/application_bloc_style.php");


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_page = mysql_query("SELECT * FROM Conteneurs WHERE id='$id_du_bloc'");
while ($donnees_page = mysql_fetch_array($reponse_page) )
{
?>

<div id="application_bloc_droite">
<div id="titre">
<img id="image_left" src="image/Frame_du_CMS/description_du_petit_peuple_titre_left.png" />
<div id="bord_du_haut"><div id="titre_centre"><p><?php echo $donnees_page['Nom_de_la_page']; ?></p></div></div>
<img id="image_right" src="image/Frame_du_CMS/description_du_petit_peuple_titre_right.png" />
</div>
<div id="contennu_du_bloc_bord">
<div id="contennu_du_bloc">	
<div id="contennu_du_bloc_avance">
<?php $article_montrer_image_taille='reduit_image'; ?>
<?php
}
mysql_close();
?>

	
<?php

$adresse_galerie_poste=$_SERVER['PHP_SELF'] . '?page_numero=' . $_GET['page_numero'];
$adresse_galerie=$_SERVER['PHP_SELF'] . '?page_numero=' . $_GET['page_numero'];
$adresse_topic_en_include=$_SERVER['PHP_SELF'] . '?page_numero=' . $_GET['page_numero']; 
$adresse_description=$_SERVER['PHP_SELF'] . '?page_numero=' . $_GET['page_numero'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse3 = mysql_query("SELECT * FROM Applications_des_conteneurs WHERE id_du_conteneur='$id_du_bloc' ORDER BY ordre");
while ($donnees3 = mysql_fetch_array($reponse3) )
{
$id_application=$donnees3['id_application'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse_application = mysql_query("SELECT * FROM liste_des_applications WHERE id='$id_application'");
while ($donnees_application2 = mysql_fetch_array($reponse_application) )
{
$Nom_de_variable_id=$donnees_application2['Nom_de_variable_id'];
$Adresse_dans_include=$donnees_application2['Adresse_dans_include'];
${$Nom_de_variable_id}=$donnees3['id_nom_application']; 
}
include("$Adresse_dans_include");
}

if(isset($_SESSION['autorisation']))
{
$table_categories_acessibles_table='Conteneurs';
$id_table_categories_acessibles_table=$id_du_bloc;
include("noyau/Applications/categorie_d_utilisateurs/acces/acces_par_categorie_d_utilisateurs.php");
}
if(isset($_SESSION['autorisation']) and(((($_SESSION['autorisation'])=='administrateur') and isset($Gestion_acessible) and $Gestion_acessible=='ok') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{ 
?>

<table>
<tr>
<td>
<form action="contenu_d_application_modifier.php?table_modifier=blocs" method="post">
<input type="hidden" name="type_conteneur" value="bloc_droite" />
<input type="hidden" name="Modifier_page" value="<?php echo $id_du_bloc; ?>" />
<input type="submit" name="Mod_page000" value="Administrer le bloc de droite" />
</form>
</td>
</tr>
</table>

<?php } ?>


</div>
</div>
</div>
<div id="titre">
<img id="image_left" src="image/Frame_du_CMS/description_du_petit_peuple_titre_left_bas.png" />
<div id="bord_du_bas"><div id="titre_centre"></div></div>
<img id="image_right" src="image/Frame_du_CMS/description_du_petit_peuple_titre_right_bas.png" />
</div>	
</div>	
<?php $Gestion_acessible=''; ?>