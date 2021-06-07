<?php 
if(isset($_POST['modifier_calendrier']) and ($_POST['modifier_calendrier']!=''))
{
$modifier_calendrier=$_POST['modifier_calendrier']; 

mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM calendrier WHERE id='$modifier_calendrier'");
while ($donnees = mysql_fetch_array($reponse) )
{ ?>

<form action="<?php echo $_SESSION['administration_adresse_de_la_derniere_page_avec_variables']; ?>" method="post">

<input type="text" name="nom_du_calendrier" value="<?php echo $donnees['nom'];?>" />
	


<h3>Cat&#233;gories d'articles pour les calendriers</h3>	

<table>
<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_2 = mysql_query("SELECT categorie FROM categories_des_calendriers WHERE calendrier='$modifier_calendrier'");
$categories_des_articles_pour_le_calendrier = array();
while($donnes_2 = mysql_fetch_array($reponse_2))
{
    $categories_des_articles_pour_le_calendrier[] = $donnes_2['categorie'];
}


$reponse_Categorie_des_articles = mysql_query("SELECT * FROM categories_des_applications");
while ($donnees_Categorie_des_articles = mysql_fetch_array($reponse_Categorie_des_articles) )
{ ?>
<tr>
<td><input type="checkbox" name="categorie_des_articles[]" value="<?php echo $donnees_Categorie_des_articles['id'];?>" 

<?php 
$id_de_Categorie_des_articles=$donnees_Categorie_des_articles['id'];
if(isset($categories_des_articles_pour_le_calendrier) and $categories_des_articles_pour_le_calendrier!='')
{ if (in_array("$id_de_Categorie_des_articles", $categories_des_articles_pour_le_calendrier))
{ echo 'checked="checked"'; }}?> /></td>
<td><label for="categorie_des_articles[]"><?php echo $donnees_Categorie_des_articles['categorie'];?></label></td>
</tr>
<?php } ?>
</table>

	
	
<input type="hidden" name="modifier_calendrier" value="<?php echo $modifier_calendrier; ?>" />	
<input type="submit" name="soumettre" value="enregistrer les modifications" />

</form>

<?php }

} ?>