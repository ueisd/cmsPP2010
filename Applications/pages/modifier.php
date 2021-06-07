<?php 
if(isset($_POST['Modifier_ordre_application_de_la_page']) and $_POST['Modifier_ordre_application_de_la_page']!='')
{
$id_application_modifier=$_POST['Modifier_ordre_application_de_la_page'];
$ordre=$_POST['Ordre_de_la_page'];
echo 'id de l application: ' . $id_application . ' ordre de l appliation: ' . $ordre;
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("UPDATE Applications_des_pages SET ordre='$ordre' WHERE id='$id_application_modifier'");
mysql_close();
}
if(isset($_POST['Modifier_page_nouvelle_application']) and $_POST['Modifier_page_nouvelle_application']!='')
{
$id_de_la_page=$_POST['Modifier_page_nouvelle_application'];
$Nom_de_la_page=$_POST['Nom_de_la_page'];
$Tags=$_POST['Tags'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("UPDATE pages SET Nom_de_la_page='$Nom_de_la_page', Tags='$Tags'  WHERE id='$id_de_la_page'");


$reponse = mysql_query("SELECT * FROM liste_des_applications");
while ($donnees = mysql_fetch_array($reponse) )
{
$id_application=$donnees['id'];
if(isset($_POST["$id_application"]) and $_POST["$id_application"]!='')
{

$reponse_ordre = mysql_query("SELECT ordre FROM Applications_des_pages ORDER BY ordre DESC LIMIT 0,1");
while ($donnees_ordre = mysql_fetch_array($reponse_ordre) )
{
$ordre_dernier=$donnees_ordre['ordre'];
$ordre_nouveau=$ordre_dernier+1;
}
$id_de_la_page=$_POST['Modifier_page_nouvelle_application'];
$id_nom_application=$_POST["$id_application"];
mysql_query("INSERT INTO Applications_des_pages VALUES('', '$id_de_la_page', '$id_nom_application', '$id_application', '$ordre_nouveau')");
}
}

$id_Modifier_page=$_POST['Modifier_page'];

$categorie_acessible_au_connecte = $_SESSION['categorie_du_connecte'];
$form_categorie_d_utilisateur=$_POST["categorie_d_utilisateur"];
$id_bd_pour_Categorie_des_utilisateurs=$id_Modifier_page;
$nom_de_table_pour_Categorie_des_utilisateurs='pages';
include("traitement_Categorie_des_utilisateurs.php");


mysql_close();
echo 'enregistr&#233; la mise a jour';
}

include("Applications/pages/traitement/modifier_page/ajouter_aux_pages.php");

 
if(isset($_POST['Modifier_page']) and $_POST['Modifier_page']!='')
{

if(isset($_POST['Supprimer_application_de_la_page']) and $_POST['Supprimer_application_de_la_page']!='')
{
$id_supprimer_application_de_la_page=$_POST['Supprimer_application_de_la_page'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("DELETE FROM Applications_des_pages WHERE id='$id_supprimer_application_de_la_page'"); 
mysql_close();
}


$id_de_la_page=$_POST['Modifier_page'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM Applications_des_pages WHERE id_de_la_page='$id_de_la_page' ORDER BY ordre");
?> <table> <?php
while ($donnees = mysql_fetch_array($reponse) )
{
$id_Applications_des_pages=$donnees['id'];
$id_nom_application=$donnees['id_nom_application'];
$id_application=$donnees['id_application'];
$ordre=$donnees['ordre'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse_application = mysql_query("SELECT * FROM liste_des_applications WHERE id='$id_application'");
while ($donnees_application = mysql_fetch_array($reponse_application) )
{
$Nom_de_l_application=$donnees_application['Nom_de_l_application']; 
$table_de_l_application=$donnees_application['table_de_l_application'];
$Nom_du_Champ_des_noms=$donnees_application['Nom_du_Champ_des_noms'];
}

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse3 = mysql_query("SELECT * FROM $table_de_l_application WHERE id='$id_nom_application'");
while ($donnees3 = mysql_fetch_array($reponse3) )
{
$Nom_de_categorie_application=$donnees3["$Nom_du_Champ_des_noms"]; 
} 
?>
<tr>
<td><?php echo $Nom_de_l_application; ?></td>
<td><?php echo $Nom_de_categorie_application; ?></td>
<td>Supprimer: </td>
<td><form action="contenu_d_application_modifier.php?table_modifier=pages" method="post">
<input type="hidden" name="Modifier_page" value="<?php echo $id_de_la_page; ?>" />
<input type="submit" name="Supprimer_application_de_la_page" value="<?php echo $id_Applications_des_pages;  ?>" />
</form></td>
<td>Position de l'application: </td>
<td><form action="contenu_d_application_modifier.php?table_modifier=pages" method="post">
<input type="text" name="Ordre_de_la_page" value="<?php echo $ordre; ?>" />
<input type="hidden" name="Modifier_page" value="<?php echo $id_de_la_page; ?>" />
<input type="submit" name="Modifier_ordre_application_de_la_page" value="<?php echo $id_Applications_des_pages;  ?>" />
</form></td>
</tr>
<?php } ?> 
</table> 
<?php 
mysql_close();
?>


<table style="background-color:#ffffef; border:4px double black;">
<tr>
<form action="contenu_d_application_modifier.php?table_modifier=pages" method="post">
<?php 
$id_de_la_page=$_POST['Modifier_page'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM pages WHERE id='$id_de_la_page'");
while ($donnees = mysql_fetch_array($reponse) )
{ 
?>




<td valign="top">
<table style="background-color:#f5f5f5;">

<tr><td colspan="2"><h3>Caracteristiques de la page:</h3></td></tr>

<tr>
<td>Nom de la page: </td><td><input type="text" name="Nom_de_la_page" value="<?php echo $donnees['Nom_de_la_page']; ?>" /></td>
</tr>
<tr>
<td>Tags: </td><td><input type="text" name="Tags" value="<?php echo $donnees['Tags']; ?>" /></td>
</tr>

<tr>
<td colspan="2">
<h3>Categories d'utilisateurs</h3>	
<?php
$Categorie_des_utilisateurs=$donnees['Categorie_des_utilisateurs'];
$Array_Categorie_des_utilisateurs=explode(",", $Categorie_des_utilisateurs);
?>	
<div style="height:150px; width:250px;; overflow:auto;">
<table>
<?php 
$categorie_du_connecte = $_SESSION['categorie_du_connecte'];
foreach($categorie_du_connecte as $id_categorie_du_connecte)
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_Categorie_des_utilisateurs = mysql_query("SELECT * FROM Categorie_des_utilisateurs WHERE id='$id_categorie_du_connecte'");
while ($donnees_Categorie_des_utilisateurs = mysql_fetch_array($reponse_Categorie_des_utilisateurs) )
{ ?>
<tr>
<td>
<td><label for="categorie_d_utilisateur[]"><?php echo $donnees_Categorie_des_utilisateurs['categorie'];?></label></td>
<td><input type="checkbox" name="categorie_d_utilisateur[]" value="<?php echo $donnees_Categorie_des_utilisateurs['id'];?>" 

<?php
$id_de_la_categorie_du_formulaire=$donnees_Categorie_des_utilisateurs['id'];
if (in_array($id_de_la_categorie_du_formulaire, $Array_Categorie_des_utilisateurs))
{ ?>
 checked="checked"
<?php } ?> /></td>
</tr>
<?php } 
}
?>
</table>
</div>
</td>
</tr>

</table>
</td>


<?php } ?> 

<td valign="top">
<table style="background-color:#bbbbbb;">

<tr><td><h3>Nouvelle application: </h3></td></tr>
<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM liste_des_applications WHERE type_conteneur='page'");
while ($donnees = mysql_fetch_array($reponse) )
{
$id_application=$donnees['id'];
$Nom_de_l_application=$donnees['Nom_de_l_application'];
$table_de_l_application=$donnees['table_de_l_application'];
$Nom_du_Champ_des_noms=$donnees['Nom_du_Champ_des_noms']; 
$Nom_de_variable_id=$donnees['Nom_de_variable_id'];
$Adresse_dans_include=$donnees['Adresse_dans_include'];
$adresse_nouveau=$donnees['adresse_nouveau'];
?>

<tr><td colspan="2"><?php echo $Nom_de_l_application; ?></td></tr>

<tr><td colspan="2">
<select name="<?php echo $id_application; ?>" >
<option value=""></option>
<?php
$reponse2 = mysql_query("SELECT * FROM $table_de_l_application ORDER BY $Nom_du_Champ_des_noms");
while ($donnees2 = mysql_fetch_array($reponse2) )
{ ?>
<option value="<?php echo $donnees2['id']; ?>"><?php echo $donnees2['id'] . '  ' . $donnees2["$Nom_du_Champ_des_noms"]; ?></option>
<?php } ?>
</select>
<?php 
if(isset($adresse_nouveau) and $adresse_nouveau!='')
{ ?>
<a href="<?php echo $adresse_nouveau . '?ajouter_a_modifier_page=' . $id_de_la_page; ?>">Nouveau <?php echo $Nom_de_l_application; ?> pour la page</a>
<?php } ?>
</td></tr>

<?php } ?>


<tr><td><label for="Modifier_page">Enregistrer la nouvelle page:</label></td>
<td>
<input type="hidden" name="Modifier_page" value="<?php echo $id_de_la_page; ?>" />
<input type="submit" name="Modifier_page_nouvelle_application" value="<?php echo $_POST['Modifier_page']; ?>" /></td></tr>
</table>
</td>

</form>
</tr>
</table>

<a href="<?php echo 'page.php?page_numero=' . $_POST['Modifier_page']; ?>">Visiter la page</a><br/>
<a href="contenu_d_application_gestion.php?table_gestion=pages">Gestion des pages</a>
<?php
mysql_close();
} ?>	