<?php session_start(); 
include("noyau/configuration/base_de_donnee.php"); 
if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{



if(isset($_POST['id_bloc_dans_liste_des_applications']) and $_POST['id_bloc_dans_liste_des_applications']!='')
{
$id_bloc_dans_liste_des_applications=$_POST['id_bloc_dans_liste_des_applications'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_nom_application_conteneur = mysql_query("SELECT * FROM liste_des_applications WHERE id='$id_bloc_dans_liste_des_applications'");
while ($donnees_nom_application_conteneur = mysql_fetch_array($reponse_nom_application_conteneur))
{
$nom_application_conteneur=$donnees_nom_application_conteneur['Nom_de_l_application'];
}
}



if(isset($_POST['Supprimer_page']) and $_POST['Supprimer_page']!='')
{
$supprimer_page=$_POST['Supprimer_page'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("DELETE FROM Applications_des_conteneurs WHERE id_de_la_page='$supprimer_page'");
mysql_query("DELETE FROM Conteneurs WHERE id='$supprimer_page'");
mysql_close();
$adresse_page=$supprimer_page . '.php';
}

if(isset($_POST['Nouvelle_page']) and $_POST['Nouvelle_page']=='valider')
{
$Nom_de_la_page = $_POST['Nom_de_la_page'];

$id_bloc_dans_liste_des_applications=$_POST['id_bloc_dans_liste_des_applications'];

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("INSERT INTO Conteneurs VALUES('', '$Nom_de_la_page', '$Categorie_des_utilisateurs', '', '$id_bloc_dans_liste_des_applications')");
mysql_close();
}
?>

<center>
<table>
<tr>

<td>Type de conteneur s&#233;lectionn&#233;: <strong><?php echo $nom_application_conteneur; ?></strong></td>

<td>Type de conteneurs</td>

<td>
<form action="contenu_d_application_gestion.php?table_gestion=blocs" method="post">
   	<select name="id_bloc_dans_liste_des_applications">
<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_id_conteneur = mysql_query("SELECT * FROM liste_des_applications WHERE type='conteneur'");
while ($donnees_id_conteneur = mysql_fetch_array($reponse_id_conteneur))
{ ?>
<option value="<?php echo $donnees_id_conteneur['id'];?>"><?php echo $donnees_id_conteneur['Nom_de_l_application'];?></option>
<?php } ?>
       </select>       
</td>


<td>
<input type="submit" value="selectioner"/>
</form>
</td>


</tr>
</table>
</center>




<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM Conteneurs WHERE id_bloc_dans_liste_des_applications='$id_bloc_dans_liste_des_applications' ORDER BY id DESC");
?>
<table style="background-color:#ececec; border:4px double black;"> 
<?php
while ($donnees = mysql_fetch_array($reponse) )
{ ?>

<tr>


<td>
<a href="<?php echo 'page.php?page_numero=' . $donnees['id']; ?>" ><strong><?php echo $donnees['Nom_de_la_page'] . ' '; ?></strong></a>
</td>

<td>
<form action="contenu_d_application_modifier.php?table_modifier=blocs" method="post">
<input type="hidden" name="Modifier_page" value="<?php echo $donnees['id']; ?>" />
<input type="hidden" name="id_bloc_dans_liste_des_applications" value="<?php echo $id_bloc_dans_liste_des_applications; ?>" />
<input type="submit" name="Mod" value="Modifier" />
</form>
</td>

<td>
<form action="contenu_d_application_gestion.php?table_gestion=blocs" method="post">
<input type="hidden" name="Supprimer_page" value="<?php echo $donnees['id']; ?>" />
<input type="hidden" name="id_bloc_dans_liste_des_applications" value="<?php echo $id_bloc_dans_liste_des_applications; ?>" />
<input type="submit" name="Sup" value="Supprimer" />
</form>
</td>


</tr>

<?php } ?> 
</table> 

<?php
mysql_close();
?>
		
Cr&#233;ation de <?php echo $nom_application_conteneur; ?>:


<table style="background-color:#ececec; border:4px double black;">
<tr>
<form action="contenu_d_application_gestion.php?table_gestion=blocs" method="post">


<td>
<table>

<tr>
<td><label for="Nom_de_la_page">Titre de <?php echo $nom_application_conteneur; ?>:</label></td>
<td><input type="text" name="Nom_de_la_page" /></td>
</tr>

<tr>
<td colspan="2">
<input type="hidden" name="Nouvelle_page" value="valider" />
<input type="hidden" name="id_bloc_dans_liste_des_applications" value="<?php echo $id_bloc_dans_liste_des_applications; ?>" />
<input type="submit" name="Nouv_page000" value="Enregistrer le nouveau bloc" />
</td>
</tr>

</table>
</td>

</form>
</tr>
</table>


<a href="Gestion_des_applications.php">G&#233;rer les applications disponibles</a>

<?php } ?>