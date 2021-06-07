<?php 
if(isset($_POST['modifier_categorie']) and ($_POST['modifier_categorie']!=''))
{
$modifier_categorie=$_POST['modifier_categorie']; 

if(isset($_POST['enlever_utilisateurs']) and ($_POST['enlever_utilisateurs']!=''))
{
$enlever_utilisateurs=$_POST['enlever_utilisateurs'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("DELETE FROM categorie_des_utilisateurs_J_utilisateurs WHERE categorie='$modifier_categorie' and utilisateurs='$enlever_utilisateurs'");
}


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM categorie_des_utilisateurs WHERE id='$modifier_categorie'");
while ($donnees = mysql_fetch_array($reponse) )
{ ?>

<form action="contenu_de_noyeau_gestion.php?table_gestion=categorie_d_utilisateurs" method="post">
Modifier le nom de la cat&#233;gorie: <input type="text" name="categorie" value="<?php echo $donnees['nom_de_la_categorie']; ?>" />
Enregistrer les changements: <input type="submit" name="modifier_categorie" value="<?php echo $_POST['modifier_categorie']; ?>" />

<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse_utilisateurs1 = mysql_query("SELECT * FROM utilisateurs WHERE categorie_d_utilisateur!='En approbation'");
while ($donnees_utilisateurs1 = mysql_fetch_array($reponse_utilisateurs1) )
{
$utilisateur1=$donnees_utilisateurs1['id'];
if(isset($array_tout_utilisateurs) and $array_tout_utilisateurs!='')
{
array_push ($array_tout_utilisateurs, "$utilisateur1");
}
else
{
$array_tout_utilisateurs = array ("$utilisateur1");
}
} 

$reponse_utilisateurs2 = mysql_query("SELECT * FROM categorie_des_utilisateurs_J_utilisateurs WHERE categorie='$modifier_categorie'");
while ($donnees_utilisateurs2 = mysql_fetch_array($reponse_utilisateurs2) )
{
$utilisateur2=$donnees_utilisateurs2['utilisateurs'];
if(isset($array_utilisateurs) and $array_utilisateurs!='')
{
array_push ($array_utilisateurs, "$utilisateur2");
}
else
{
$array_utilisateurs = array ("$utilisateur2");
}
}

if(isset($array_utilisateurs) and $array_utilisateurs!='')
{
$array_utilisateurs_a_mettre = array_diff($array_tout_utilisateurs,$array_utilisateurs);
}
else
{
$array_utilisateurs_a_mettre = $array_tout_utilisateurs;
}

foreach($array_utilisateurs_a_mettre as $utilisateurs_a_mettre_id)
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse_utilisateurs_a_mettre = mysql_query("SELECT * FROM utilisateurs WHERE id='$utilisateurs_a_mettre_id;'");
while ($donnees_utilisateurs_a_mettre = mysql_fetch_array($reponse_utilisateurs_a_mettre) )
{ ?> 
<?php echo $donnees_utilisateurs_a_mettre['nom'] . ': ';?><input type="checkbox" name="utilisateurs_a_mettre[]" value="<?php echo $donnees_utilisateurs_a_mettre['id']; ?>" /><br/>
<?php }
}
?>
</form>

<?php
if(isset($array_utilisateurs) and $array_utilisateurs!='')
{
foreach($array_utilisateurs as $utilisateur_id)
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse_utilisateurs = mysql_query("SELECT * FROM utilisateurs WHERE id='$utilisateur_id'");
while ($donnees_utilisateurs = mysql_fetch_array($reponse_utilisateurs) )
{ ?>

<img src="image/profil/<?php echo $donnees_utilisateurs['image']; ?>" />
<?php echo $donnees_utilisateurs['nom']; ?>
Enlever l utilisateur: <form action="contenu_de_noyeau_modifier.php?table_modifier=categorie_d_utilisateurs" method="post">
<input type="hidden" name="categorie" value="<?php echo $modifier_categorie; ?>" />
<input type="hidden" name="modifier_categorie" value="<?php echo $modifier_categorie; ?>" />
<input type="hidden" name="utilisateurs" value="<?php echo $utilisateurs; ?>" />
<input type="submit" name="enlever_utilisateurs" value="<?php echo $donnees_utilisateurs['id']; ?>" />
</form>

<?php } } } ?>

<?php } } ?>