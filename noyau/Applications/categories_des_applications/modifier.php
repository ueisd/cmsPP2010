<?php 
if(isset($_POST['modifier_categorie']) and ($_POST['modifier_categorie']!=''))
{
$modifier_categorie=$_POST['modifier_categorie']; 

if(isset($_POST['enlever_categorie']) and ($_POST['enlever_categorie']!=''))
{
$enlever_categorie=$_POST['enlever_categorie'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("DELETE FROM Categorie_des_utilisateurs_pour_categories_des_articles WHERE categories_des_articles='$modifier_categorie' and Categorie_des_utilisateurs='$enlever_categorie'");
}


mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM categories_des_applications WHERE id='$modifier_categorie'");
while ($donnees = mysql_fetch_array($reponse) )
{ ?>

<form action="contenu_de_noyeau_gestion.php?table_gestion=categories_des_applications" method="post">
Modifier le nom de la cat&#233;gorie: <input type="text" name="categorie" value="<?php echo $donnees['categorie']; ?>" />
Enregistrer les changements: <input type="submit" name="modifier_categorie" value="<?php echo $_POST['modifier_categorie']; ?>" />

<?php
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse_categorie1 = mysql_query("SELECT * FROM categories");
while ($donnees_categorie1 = mysql_fetch_array($reponse_categorie1) )
{
$categorie1=$donnees_categorie1['id'];
if(isset($array_tout_categorie) and $array_tout_categorie!='')
{
array_push ($array_tout_categorie, "$categorie1");
}
else
{
$array_tout_categorie = array ("$categorie1");
}
} 

$reponse_categorie2 = mysql_query("SELECT * FROM Categorie_des_utilisateurs_pour_categories_des_articles WHERE categories_des_articles='$modifier_categorie'");
while ($donnees_categorie2 = mysql_fetch_array($reponse_categorie2) )
{
$categorie2=$donnees_categorie2['Categorie_des_utilisateurs'];
if(isset($array_categorie) and $array_categorie!='')
{
array_push ($array_categorie, "$categorie2");
}
else
{
$array_categorie = array ("$categorie2");
}
}

if(isset($array_categorie) and $array_categorie!='')
{
$array_categorie_a_mettre = array_diff($array_tout_categorie,$array_categorie);
}
else
{
$array_categorie_a_mettre = $array_tout_categorie;
}

foreach($array_categorie_a_mettre as $utilisateurs_a_mettre_id)
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse_categorie_a_mettre = mysql_query("SELECT * FROM categories WHERE id='$utilisateurs_a_mettre_id;'");
while ($donnees_categorie_a_mettre = mysql_fetch_array($reponse_categorie_a_mettre) )
{ ?> 
<?php echo $donnees_categorie_a_mettre['categorie'] . ': ';?><input type="checkbox" name="categories_a_mettre[]" value="<?php echo $donnees_categorie_a_mettre['id']; ?>" /><br/>
<?php }
}
?>
</form>

<?php
if(isset($array_categorie) and $array_categorie!='')
{
foreach($array_categorie as $categorie_id)
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse_categorie = mysql_query("SELECT * FROM categories WHERE id='$categorie_id'");
while ($donnees_categorie = mysql_fetch_array($reponse_categorie) )
{ ?>

<?php echo $donnees_categorie['categorie']; ?>
Enlever l utilisateur: <form action="Modifier_categories_des_articles.php" method="post">
<input type="hidden" name="categorie" value="<?php echo $modifier_categorie; ?>" />
<input type="hidden" name="modifier_categorie" value="<?php echo $modifier_categorie; ?>" />
<input type="hidden" name="utilisateurs" value="<?php echo $utilisateurs; ?>" />
<input type="submit" name="enlever_categorie" value="<?php echo $donnees_categorie['id']; ?>" />
</form>

<?php } } } ?>

<?php } } ?>