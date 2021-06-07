<?php
if(isset($_POST['modifier_categorie']) and ($_POST['modifier_categorie']!=''))
{
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$nom_de_categorie_de_l_article=$_POST['categorie'];
$modifier_categorie=$_POST['modifier_categorie'];
$array_utilisateurs_a_mettre=$_POST['categories_a_mettre'];
mysql_query("UPDATE categories_des_applications SET categorie='$nom_de_categorie_de_l_article' WHERE id='$modifier_categorie'");

if(isset($_POST['categories_a_mettre']) and ($_POST['categories_a_mettre']!=''))
{
foreach($array_utilisateurs_a_mettre as $utilisateurs_a_mettre)
{
mysql_query("INSERT INTO Categorie_des_utilisateurs_pour_categories_des_articles VALUES('$utilisateurs_a_mettre', '$modifier_categorie')");
}
}

}




if(isset($_POST['supprimer_categorie']) and ($_POST['supprimer_categorie']!=''))
{
$id=$_POST['supprimer_categorie'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("DELETE FROM Categorie_des_utilisateurs_pour_categories_des_articles WHERE categories_des_articles='$id'");
mysql_query("DELETE FROM categories_des_applications WHERE id='$id'");
mysql_query("DELETE FROM categories_des_articles WHERE categorie='$id'");
}


if(isset($_POST['nouvelle_categorie']) and ($_POST['nouvelle_categorie']=='ok'))
{
$categorie_d_article_parentes=$_POST['categorie_d_article_parentes'];
$categorie=$_POST['categorie'];
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
mysql_query("INSERT INTO categories_des_applications VALUES('', '$categorie')");
$categorie_id= mysql_insert_id();

if(isset($_POST['categorie_d_utilisateur']) and $_POST['categorie_d_utilisateur']!='')
{
$array_categorie_d_utilisateur=$_POST['categorie_d_utilisateur'];
foreach($array_categorie_d_utilisateur as $id_categorie_d_utilisateur)
{
mysql_query("INSERT INTO Categorie_des_utilisateurs_pour_categories_des_articles VALUES('$id_categorie_d_utilisateur', '$categorie_id')");
}
}
}




mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee");
$reponse = mysql_query("SELECT * FROM categories_des_applications GROUP BY categorie");

?> <table> <?php
while ($donnees = mysql_fetch_array($reponse) )
{ ?>
<tr>

<td> <?php echo $donnees['categorie'];?> </td>

<td>
<?php 
$id_categories_des_articles=$donnees['id'];
$reponse2 = mysql_query("SELECT categorie_des_utilisateurs.nom_de_la_categorie AS Categorie_d_utilisateur, Categorie_des_utilisateurs_pour_categories_des_articles.categories_des_articles FROM categorie_des_utilisateurs, Categorie_des_utilisateurs_pour_categories_des_articles WHERE Categorie_des_utilisateurs_pour_categories_des_articles.categories_des_articles=$id_categories_des_articles AND categorie_des_utilisateurs.id=Categorie_des_utilisateurs_pour_categories_des_articles.Categorie_des_utilisateurs");
while ($donnees2 = mysql_fetch_array($reponse2) )
{ ?>
 <?php echo '    ' . $donnees2['Categorie_d_utilisateur']; ?>
<?php } ?>
</td>

<td>Modifier: </td>
<td><form action="contenu_de_noyeau_modifier.php?table_modifier=categories_des_applications" method="post">
<input type="submit" name="modifier_categorie" value="<?php echo $donnees['id']; ?>" />
</form></td>

<td>Supprimer: </td>
<td><form action="contenu_de_noyeau_gestion.php?table_gestion=categories_des_applications" method="post">
<input type="submit" name="supprimer_categorie" value="<?php echo $donnees['id']; ?>" />
</form></td>

</tr>

<?php } ?>
</table>



	nouvelle cat&#233;gories d'articles
<table style="background-color:#ececec; border:4px double black;">
<form action="contenu_de_noyeau_gestion.php?table_gestion=categories_des_applications" method="post">

<tr>
<td>Nom de la cat&#233;gorie: <input type="text" name="categorie" /></td>
</tr>


<tr>
<td>
<h3>Catégories d'utilisateurs ayant accès</h3>	
<div style="height:150px; width:250px;; overflow:auto;">

<table>
<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_Categorie_des_utilisateurs = mysql_query("SELECT * FROM categorie_des_utilisateurs");
while ($donnees_Categorie_des_utilisateurs = mysql_fetch_array($reponse_Categorie_des_utilisateurs) )
{ ?>
<tr>
<td><label for="categorie_d_utilisateur[]"><?php echo $donnees_Categorie_des_utilisateurs['nom_de_la_categorie'];?></label></td>
<td><input type="checkbox" name="categorie_d_utilisateur[]" value="<?php echo $donnees_Categorie_des_utilisateurs['id'];?>" /></td>
</tr>
<?php } ?>

</div>
</table>
</td>


</tr>


<tr>
<td><input type="submit" name="nouvelle_categorie" value="ok" /></td>
</tr>

</form>
</table>