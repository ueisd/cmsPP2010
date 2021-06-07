<h2>nouveau calendrier</h2>
<table style="background-color:#ececec; border:4px double black;">
<form action="<?php echo $_SESSION['administration_adresse_de_la_derniere_page_avec_variables']; ?>" method="post">

<tr>
<td>Nom du calendrier: <input type="text" name="nom_du_calendrier" /></td>
</tr>


<tr>
<td>
<h3>catégories des articles à y afficher</h3>	
<div style="height:150px; width:250px;; overflow:auto;">

<table>
<?php 
mysql_connect("$type_hote_base_de_donnee", "$Utilisateur_base_de_donnee", "$Code_base_de_donnee"); 
mysql_select_db("$Nom_base_de_donnee"); 
$reponse_categorie_des_articles = mysql_query("SELECT * FROM categories_des_applications");
while ($donnees_categorie_des_articles = mysql_fetch_array($reponse_categorie_des_articles) )
{ ?>
<tr>
<td><label for="categorie_des_articles[]"><?php echo $donnees_categorie_des_articles['categorie'];?></label></td>
<td><input type="checkbox" name="categorie_des_articles[]" value="<?php echo $donnees_categorie_des_articles['id'];?>" /></td>
</tr>
<?php } ?>

</div>
</table>

</td>
</tr>


<tr>
<td><input type="submit" name="nouveau_calendrier" value="ok" /></td>
</tr>

</form>
</table>