<?php session_start(); 
include("noyau/configuration/base_de_donnee.php"); 
$_SESSION['administration_adresse_de_modifier_bloc']=$_SERVER['REQUEST_URI'];
if(isset($_SESSION['autorisation']) and((($_SESSION['autorisation'])=='administrateur') or (($_SESSION['autorisation'])=='superadministrateur')) and(($_GET['visite'])!='fin'))
{

if(isset($_POST['id_bloc_dans_liste_des_applications']) and $_POST['id_bloc_dans_liste_des_applications']!='')
{
$id_bloc_dans_liste_des_applications=$_POST['id_bloc_dans_liste_des_applications'];
}


if(isset($_POST['Modifier_ordre_application_de_la_page']) and $_POST['Modifier_ordre_application_de_la_page']!='')
{
$id_application_modifier=$_POST['Modifier_ordre_application_de_la_page'];
$ordre=$_POST['Ordre_de_la_page'];
echo 'id de l application: ' . $id_application . ' ordre de l appliation: ' . $ordre;
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("UPDATE Applications_des_conteneurs SET ordre='$ordre' WHERE id='$id_application_modifier'");
mysql_close();
}
if(isset($_POST['Modifier_page_nouvelle_application']) and $_POST['Modifier_page_nouvelle_application']!='')
{
$id_bloc_dans_liste_des_applications=$_POST['id_bloc_dans_liste_des_applications'];
$id_du_conteneur=$_POST['Modifier_page_nouvelle_application'];
$Nom_du_conteneur=$_POST['Nom_de_la_page'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
mysql_query("UPDATE Conteneurs SET Nom_de_la_page='$Nom_du_conteneur' WHERE id='$id_du_conteneur'");


$reponse = mysql_query("
SELECT * FROM liste_des_applications
 INNER JOIN liste_des_applications_J_conteneur ON liste_des_applications.id = liste_des_applications_J_conteneur.id_application
 WHERE liste_des_applications_J_conteneur.id_conteneur='$id_bloc_dans_liste_des_applications'
");
while ($donnees = mysql_fetch_array($reponse) )
{
$id_application=$donnees['id'];
if(isset($_POST["$id_application"]) and $_POST["$id_application"]!='')
{

$reponse_ordre = mysql_query("SELECT ordre FROM Applications_des_conteneurs ORDER BY ordre DESC LIMIT 0,1");
while ($donnees_ordre = mysql_fetch_array($reponse_ordre) )
{
$ordre_dernier=$donnees_ordre['ordre'];
$ordre_nouveau=$ordre_dernier+1;
}
$id_du_conteneur=$_POST['Modifier_page_nouvelle_application'];
$id_nom_application=$_POST["$id_application"];
mysql_query("INSERT INTO Applications_des_conteneurs VALUES('', '$id_du_conteneur', '$id_nom_application', '$id_application', '$ordre_nouveau')");
}
}

$id_Modifier_conteneur=$_POST['Modifier_page'];


mysql_close();
echo 'enregistr&#233; la mise a jour';
}
 
 
 
 
 
 
 
if(isset($_POST['Modifier_page']) and $_POST['Modifier_page']!='')
{
$id_du_conteneur=$_POST['Modifier_page'];


if(isset($_POST['id_bloc_dans_liste_des_applications']) and $_POST['id_bloc_dans_liste_des_applications']!=''){}
else
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT id_bloc_dans_liste_des_applications FROM Conteneurs WHERE id='$id_du_conteneur'");
while ($donnees = mysql_fetch_array($reponse) )
{
$id_bloc_dans_liste_des_applications=$donnees['id_bloc_dans_liste_des_applications'];
}
}


if(isset($_POST['Supprimer_application_de_la_page']) and $_POST['Supprimer_application_de_la_page']!='')
{
$id_supprimer_application_du_conteneur=$_POST['Supprimer_application_de_la_page'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("DELETE FROM Applications_des_conteneurs WHERE id='$id_supprimer_application_du_conteneur'"); 
mysql_close();
}


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM Applications_des_conteneurs WHERE id_du_conteneur='$id_du_conteneur' ORDER BY ordre");
?> <table> <?php
while ($donnees = mysql_fetch_array($reponse) )
{
$id_Applications_des_conteneurs=$donnees['id'];
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
<td><form action="<?php echo $_SESSION['administration_adresse_de_modifier_bloc']; ?>" method="post">
<input type="hidden" name="id_bloc_dans_liste_des_applications" value="<?php echo $id_bloc_dans_liste_des_applications; ?>" />
<input type="hidden" name="Modifier_page" value="<?php echo $id_du_conteneur; ?>" />
<input type="submit" name="Supprimer_application_de_la_page" value="<?php echo $id_Applications_des_conteneurs;  ?>" />
</form></td>
<td>Position de l'application: </td>
<td><form action="<?php echo $_SESSION['administration_adresse_de_modifier_bloc']; ?>" method="post">
<input type="text" name="Ordre_de_la_page" value="<?php echo $ordre; ?>" />
<input type="hidden" name="id_bloc_dans_liste_des_applications" value="<?php echo $id_bloc_dans_liste_des_applications; ?>" />
<input type="hidden" name="Modifier_page" value="<?php echo $id_du_conteneur; ?>" />
<input type="submit" name="Modifier_ordre_application_de_la_page" value="<?php echo $id_Applications_des_conteneurs;  ?>" />
</form></td>
</tr>
<?php } ?> 
</table> 
<?php 
mysql_close();
?>


<table style="background-color:#ffffef; border:4px double black;">
<tr>
<form action="<?php echo $_SESSION['administration_adresse_de_modifier_bloc']; ?>" method="post">
<?php 
$id_du_conteneur=$_POST['Modifier_page'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse = mysql_query("SELECT * FROM Conteneurs WHERE id='$id_du_conteneur'");
while ($donnees = mysql_fetch_array($reponse) )
{ 
?>




<td valign="top">
<table style="background-color:#f5f5f5;">

<tr><td colspan="2"><h3>Caracteristiques du conteneur:</h3></td></tr>

<tr>
<td>Nom du conteneur: </td><td><input type="text" name="Nom_de_la_page" value="<?php echo $donnees['Nom_de_la_page']; ?>" /></td>
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


$reponse = mysql_query
("
SELECT * FROM liste_des_applications WHERE liste_des_applications.id IN (SELECT liste_des_applications_J_conteneur.id_application FROM liste_des_applications_J_conteneur
 INNER JOIN liste_des_applications ON liste_des_applications_J_conteneur.id_conteneur = liste_des_applications.id 
 WHERE liste_des_applications.id='$id_bloc_dans_liste_des_applications')
");

while ($donnees = mysql_fetch_array($reponse) )
{

$id_application=$donnees['id'];
$Nom_de_l_application=$donnees['Nom_de_l_application'];
$table_de_l_application=$donnees['table_de_l_application'];
$Nom_du_Champ_des_noms=$donnees['Nom_du_Champ_des_noms']; 
$Nom_de_variable_id=$donnees['Nom_de_variable_id'];
$Adresse_dans_include=$donnees['Adresse_dans_include'];
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
</select></td></tr>

<?php } ?>


<tr><td><label for="Modifier_page">Rajouter des applications:</label></td>
<td>
<input type="hidden" name="Modifier_page" value="<?php echo $id_du_conteneur; ?>" />
<input type="hidden" name="id_bloc_dans_liste_des_applications" value="<?php echo $id_bloc_dans_liste_des_applications; ?>" />
<input type="submit" name="Modifier_page_nouvelle_application" value="<?php echo $_POST['Modifier_page']; ?>" /></td></tr>
</table>
</td>

</form>
</tr>
</table>

<a href="" target="_blank">Visiter le bloc</a><br/>
<a href="">Retour &#224; la gestion des blocs</a>
<?php
mysql_close();
} ?>	
<?php } ?>